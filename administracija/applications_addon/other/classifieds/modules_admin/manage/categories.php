<?php

/**
 *
 * Classifieds 1.2.1
 *
 * @author		$Author: Andrew Millne $
 * @copyright   2011 Andrew Millne. All Rights Reserved.
 * @license		http://dev.millne.com/license.html
 * @package		Classifieds
 * @link		http://dev.millne.com
 *
 */

if ( ! defined( 'IN_ACP' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
    exit();
}

class admin_classifieds_manage_categories extends ipsCommand {
    /**
     * Skin object
     *
     * @access	private
     * @var		object			Skin templates
     */
    private $html;

    /**
     * Shortcut for url
     *
     * @access	private
     * @var		string			URL shortcut
     */
    private $form_code;

    /**
     * Shortcut for url (javascript)
     *
     * @access	private
     * @var		string			JS URL shortcut
     */
    private $form_code_js;

    /**
     * Main class entry point
     *
     * @access	public
     * @param	object		ipsRegistry reference
     * @return	void		[Outputs to screen]
     */
    public function doExecute( ipsRegistry $registry ) {

        //-----------------------------------------
        // Load libraries
        //-----------------------------------------

        $this->categories = $this->registry->classifieds->helper('categories');
        $this->fields = $this->registry->classifieds->helper('fields');

        //-----------------------------------------
        // Load Skin Template
        //-----------------------------------------

        $this->html = $this->registry->output->loadTemplate( 'cp_skin_classifieds' );

        $this->html->form_code    = $this->form_code    = 'module=manage&amp;section=categories&amp;';
        $this->html->form_code_js = $this->form_code_js = 'module=manage&section=categories&';

        ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
        $this->lang->loadLanguageFile( array( 'admin_lang' ), "classifieds" );

        switch( $this->request['do'] ) {

            case 'managecategories':
                $this->manageCategories();
                break;

            case 'addcat':
                $this->categoryForm( 'add' );
                break;

            case 'doaddcat':
                $this->categorySave( 'add' );
                break;

            case 'editcat':
                $this->categoryForm( 'edit' );
                break;

            case 'doeditcat':
                $this->categorySave( 'edit' );
                break;

            case 'deletecat':
                $this->deleteCategoryForm();
                break;

            case 'dodeletecat':
                $this->doDeleteCategory();
                break;

            case 'doemptycat':
                $this->doEmptyCategory();
                break;

            case 'reorder':
                $this->reorder();
                break;

            default:
                $this->manageCategories();
                break;
        }

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }


    public function manageCategories() {
        if ( $this->request['parent'] ) {

            $categories = $this->categories->getDescendants(intval($this->request['parent']), TRUE, FALSE, 1);
            
			$parent = array_shift($categories);
		            
            $nav = $this->categories->getPath( $parent, TRUE);

            if ( is_array( $nav )) {

                array_shift( $nav );

            	foreach( $nav as $_nav )
				{		
					$this->registry->output->extra_nav[] = array( "{$this->settings['base_url']}&amp;{$this->form_code}parent={$_nav['category_id']}", $_nav['name'] );
				}

            }
        } else {
            $categories = $this->categories->getDescendants(1, FALSE, FALSE, 0);       
        }

        $this->registry->output->html .= $this->html->manageCategory( $categories );
    }

    public function categoryForm( $type='add' ) {
        
        $form = array();

        if( $type == 'edit' ) {
            $this->request['id'] = intval( $this->request['id'] );

            $cat = $this->categories->getNode($this->request['id']);

            $form['formcode']	= 'doeditcat';
            $form['button']	= $this->lang->words['cfds_edit_cat_title'];
        }
        else {
            if ( $this->request['parent']) {
                $parent = intval($this->request['parent']);
            } else {
                $parent = 0;
            }
            $cat = array(
                    'parent' => $parent,
                    'id'     => 0,
            );

            $form['formcode'] = 'doaddcat';
            $form['button']   = $this->lang->words['cfds_add_cat_title'];
        }

        $form['name'] 	= $this->registry->output->formInput( 'name', $this->request['name'] ? $this->request['name'] : $cat['name'] );
        $form['parent']	= $this->registry->output->formDropdown( 'parent', $this->categories->buildJumpList(TRUE, FALSE, FALSE), $this->request['parent'] ? $this->request['parent'] : $cat['parent_id'] );
        $form['description'] 	= $this->registry->output->formTextArea( 'description', $this->request['description'] ? $this->request['description'] : $cat['description'] );
		$form['fieldset_id']	= $this->registry->output->formDropdown( 'fieldset_id', $this->fields->getSetJumpList(), $this->request['fieldset_id'] ? $this->request['fieldset_id'] : $cat['fieldset_id'] );
		$form['advert_types']	= $this->registry->output->formMultiDropdown( 'advert_types[]', $this->registry->classifieds->helper('types')->getTypeJumpList(), ( empty( $cat ) or $cat['advert_types'] == '*' ) ? NULL : explode( ',', $cat['advert_types'] ) );
		

		
        $this->registry->output->html .= $this->html->categoryForm( $cat, $form, $type );
    }

    /**
     * Handles the add/edit category form
     *
     * @access	public
     * @param	string  $type  Either add or edit
     * @return	void
     */
    public function categorySave( $type = 'add' ) {
        $this->request['name'] = trim( $this->request['name'] );

        if( $this->request['name'] == "" ) {
            $this->registry->output->showError( $this->lang->words['cfds_no_cat_name'], 1191 );
        }

        if( $this->request['parent'] == $this->request['id'] AND $this->request['id'] > 0 ) {
            $this->registry->output->showError( $this->lang->words['cfds_cat_save_parent'], 1192 );
        }
        
        if ( empty( $this->request['advert_types'] ) )
		{
			$advert_types = '*';
		}
		else
		{
			$advert_types = implode( ',', $this->request['advert_types'] );
		}        

        if( $type == 'edit' ) {
            $this->request['id'] = intval($this->request['id']);

            if( !$this->request['id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_cat_noid'], 1193 );
            }

            $cat = $this->categories->getNode($this->request['id'] );

            if( !$cat['category_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_cat_noid'], 1194 );
            }
        }

        // Ok, some users seem to love setting a category as a child of one of it's own
        // children, causing endless loops - need to stop them from doing it

        if( $this->request['parent'] > 1 AND $type == 'edit' ) {

            if( $this->categories->isDescendantOf( $this->request['parent'], $cat['category_id'] )) {
                $this->registry->output->showError( $this->lang->words['cfds_cat_save_subcat'], 1195 );
            }
        }
        

         // Process editor
        IPSText::getTextClass('bbcode')->parse_html = 0;
        IPSText::getTextClass('bbcode')->parse_smilies = 1;
        IPSText::getTextClass('bbcode')->parse_bbcode = 1;
        IPSText::getTextClass('bbcode')->parsing_section = 'classifieds_cat_description';

        $editor_content = IPSText::getTextClass('editor')->processRawPost('description');
        $description = IPSText::getTextClass('bbcode')->preDbParse($editor_content);

        // Make seo name
        $seo_title = IPSText::makeSeoTitle(IPSText::stripslashes($this->request['name']));

        $db_arr =  array (
                'name'          => IPSText::stripslashes($this->request['name']),
                'parent_id'	=> intval($this->request['parent']),
                'seo_title'     => $seo_title,
                'description'   => $description,
        		'fieldset_id' => intval($this->request['fieldset_id']),
        		'advert_types' => $advert_types,
        );

        if( $type == 'edit' ) {

            $this->DB->update( 'classifieds_categories', $db_arr, 'category_id=' . $cat['category_id'] );
            $this->categories->rebuildTree();
            $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managecategories&parent={$cat['parent_id']}", sprintf( $this->lang->words['cfds_cat_save_edit'], $db_arr['name'] ) );

        } else {

            $max = $this->DB->buildAndFetch( array( 'select' => 'MAX(sort_order) as pos', 'from' => 'classifieds_categories' ) );
            $db_arr['sort_order'] = $max['pos'] + 1;
            $this->DB->insert( 'classifieds_categories', $db_arr );
            $catid = $this->DB->getInsertId();
            $this->categories->rebuildTree();

        }


        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managecategories&parent={$db_arr['parent_id']}", sprintf( $this->lang->words['cfds_cat_save_add'], $db_arr['name'] ) );
    }

    /**
     * Displays the delete category form
     *
     * @access	public
     * @return	void
     */
    public function deleteCategoryForm() {
        
        $this->request['cat'] = intval( $this->request['cat'] );
        $cat = $this->categories->getNode( $this->request['cat'] );

        //-----------------------------------------
        // Category Dropdown
        //-----------------------------------------

        $move_cat = $this->registry->output->formDropdown( 'move_cat', $this->categories->buildJumpList(FALSE, TRUE, FALSE) );

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html .= $this->html->categoryDeleteForm( $cat, $move_cat );
    }

    /**
     * Handle the delete category form
     *
     * @access	public
     * @return	void
     */
    public function doDeleteCategory() {
        
        $this->request['cat'] 		= intval( $this->request['cat'] );
        $this->request['move_cat']	= intval( $this->request['move_cat'] );

        $category = $this->categories->getNode($this->request['cat']);
        if( !$category['category_id'] ) {
            $this->registry->output->showError( $this->lang->words['cfds_category_noid'], 1199 );
        } else {
            if( $this->request['move_cat'] > 0 ) {

                $this->DB->update( 'classifieds_items', array( 'category_id' => $this->request['move_cat']), 'category_id = ' . $category['category_id'] );
                $this->DB->update( 'classifieds_categories', array( 'parent_id' => $this->request['move_cat']), 'parent_id = ' . $category['category_id'] );
                $this->DB->delete( 'classifieds_categories', 'category_id = ' . $this->request['cat'] );
                $this->registry->output->main_msg = $this->lang->words['cfds_cat_deleted_msg_move'];

            } else {

                // Delete category,  Items and subcats here
                $this->categories->emptyCategory($category['category_id']);
                $this->DB->delete( 'classifieds_categories', 'lft >= ' . $category['lft'] . ' AND rgt <= ' . $category['rgt'] );

            }
        }
        $this->categories->rebuildTree();
        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managecategories&parent={$catid}", $this->lang->words['cfds_cat_deleted'] );
    }


    /**
     * Handle the empty category form
     *
     * @access	public
     * @return	void
     */
    public function doEmptyCategory() {

        $this->categories->emptyCategory($this->request['cat']);

        $this->registry->output->redirect( $this->settings['base_url']."&{$this->form_code}", $this->lang->words['cfds_cat_emptied_msg_nomove'] );
    }

    /**
     * Reorder Categories
     *
     * @access	public
     * @return	void
     */
    public function reorder() {

		$classToLoad			= IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classAjax.php', 'classAjax' );
		$ajax					= new $classToLoad();

        //-----------------------------------------
        // Checks...
        //-----------------------------------------

        if( $this->registry->adminFunctions->checkSecurityKey( $this->request['md5check'], true ) === false ) {
            $ajax->returnString( $this->lang->words['cfds_cat_badmd5'] );
            exit();
        }

        //-----------------------------------------
        // Save new position
        //-----------------------------------------

        $position	= 1;

        if( is_array($this->request['categories']) AND count($this->request['categories']) ) {

            foreach( $this->request['categories'] as $category ) {
                $this->DB->update( 'classifieds_categories', array( 'sort_order' => $position ), 'category_id=' . $category );

                $position++;
            }
        }

        $this->categories->rebuildTree();
        $ajax->returnString( 'OK' );
        exit();
    }


}