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

if ( ! defined( 'IN_IPB' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit();
}

class public_classifieds_core_core extends ipsCommand {
	
	/**
	 * Sorting column options
	 *
	 * @access	protected
	 * @var 	array
	 */

    public function doExecute( ipsRegistry $registry ) {
        
        //-----------------------------------------
        // Load Languages
        //-----------------------------------------

        $this->lang->loadLanguageFile( array( 'public_profile' ), 'members' );

        //-----------------------------------------
        // Load libraries
        //-----------------------------------------

        $this->categories = $this->registry->classifieds->helper('categories');
        $this->items = $this->registry->classifieds->helper('items');
        $this->fields = $this->registry->classifieds->helper('fields');
        $this->questions = $this->registry->classifieds->helper('questions');

        //-----------------------------------------
        // Add Navigation
        //-----------------------------------------

        $this->registry->output->addNavigation( $this->settings['classifieds_public_name'], 'app=classifieds', "classifieds", "index" );

        //-----------------------------------------
        // Which section are we looking for?
        //-----------------------------------------

        switch ( ipsRegistry::$request['do'] ) {
            case 'index':
                //$this->index();
                $this->viewCategory();
                break;

            case 'view_category':
                $this->viewCategory();
                break;

            case 'view_item':
                $this->viewItem();
                break;

            case 'view_my_items':
                $this->viewMyItems();
                break;

            case 'close_item':
                $this->closeItem();
                break;

            case 'open_item':
                $this->openItem();
                break;

            case 'delete_item':
                $this->deleteItemForm();
                break;

            case 'do_delete_item':
                $this->deleteItem();
                break;

            default:
                $this->viewCategory();
                break;
        }

        if ($this->registry->output->getTitle() == "") {
            $this->registry->output->setTitle( $this->settings['board_name'] .' -> '. $this->settings['classifieds_public_name'] );
        }

       // $this->registry->output->addToDocumentHead('raw', "<link rel='stylesheet' type='text/css' title='Main' media='screen' href='public/style_css/master_css/classifieds_styles.css' />");
        $this->registry->output->addContent( $this->output );
        $this->registry->output->addContent( base64_decode("PGRpdiBzdHlsZT0ndGV4dC1hbGlnbjpyaWdodDtmb250LXNpemU6MC45ZW07JyBjbGFzcz0naXBzUGFkIGNsZWFyJz5Qb3dlcmVkIGJ5IDxhIGhyZWY9J2h0dHA6Ly9kZXYubWlsbG5lLmNvbS9saW5rL2NsYXNzaWZpZWRzLyc+Q2xhc3NpZmllZHM8L2E+PC9kaXY+"));
        $this->registry->output->sendOutput();
    }

    /**
     * Category Index
     */
    function index() {

    	
        // Retrieve categories from db
        $categories = $this->categories->getDescendants(1, false, true);

        if ($categories) {
            $categories = $this->categories->buildNestedList($categories);
        }

        // Get Latest/Random Ad

        $highlightedAd = $this->items->getRandom();
        
        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->sidebar('', $highlightedAd);
        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->category_index($categories);

    }

    /**
     * Category view
     */
    function viewCategory() {
        if ( empty( $this->request['category_id'] ) ) {
            //$this->registry->output->silentRedirect( $this->settings['base_url']."app=classifieds" );
           $cat_id = 1;

        } else {
            $cat_id = intval($this->request['category_id']);
        }
        
        //-----------------------------------------
        // Filters
        //-----------------------------------------  

        $filters = array();

        $filters[] = 'i.active = 1';
        if (!$this->memberData['g_classifieds_can_moderate']) {
        	$filters[] = 'i.open = 1';
        }
        $filters[] = "(i.date_expiry > " . (time() - ($this->settings['classifieds_display_after_expiry'] * 86400)) .")";
        
        $filter = intval($this->request['filter']);
        
        if ( $filter && $filter != 0 ) {
        	$filters[] = "i.advert_type = '{$this->request['filter']}'";        	
        }
        
        // Get Categories
        $categories = $this->categories->getDescendants($cat_id, TRUE, TRUE, '', TRUE, $filters);
        $category = array_shift($categories);
        
        // Get Siblings if leaf node
        
        if ($category['rgt'] - $category['lft'] == 1) {
        	$siblings = $this->categories->getDescendants($category['parent_id'], false, true, 1, false, $filters);
        }


        //-----------------------------------------
        // Is category watched
        //-----------------------------------------

        $category['watched'] = $this->categories->isSubscribed($cat_id, $this->memberData['member_id']);
     
        
        //-----------------------------------------
        // Order
        //-----------------------------------------

        $sort = array();
        $sort['order']		= ( $this->request['sort_order'] == 'asc' ) ? 'asc' : 'desc';
		$sort['key']		= ( $this->request['sort_key'] && in_array( $this->request['sort_key'], array('date_added', 'price', 'date_expiry', 'views') ) ) ? $this->request['sort_key'] : 'date_added';
		$order = "featured DESC, " . $sort['key'] . " " . $sort['order'];
		
		//-----------------------------------------
        // Get items from DB
        //-----------------------------------------
		
        $items = $this->items->getItems($category, '', TRUE, $order, $filters);

        $total_items = $this->items->countItems($category, $filters);
        
		$i=0;
		foreach($items as $item)
		{
			$item['fields_groups'] = array();
			$fields = $this->fields->getFieldsByItemId($item['item_id'], $includeEmpty = false, $this->categories->getNode($item['category_id']));
			foreach ($fields as $field) {
				$item['fields_groups'][] = $field;
			}
			if($i==0)
			{
				//var_dump($item['name']);
				//var_dump($item['fields_groups']);
			}
			$i++;
			$final_items[] = $item;
		}
		
		$items = $final_items;
				
        //-----------------------------------------
        // Which advert types are in use
        //-----------------------------------------
		
        $distinct_types = $this->items->distinctTypes($category, array_pop($filters));
        $types = $this->registry->classifieds->helper( 'types' )->getTypes($distinct_types);

        
        //-----------------------------------------
        // Start Pagination
        //-----------------------------------------

        $after_magic_quote .= "&amp;do=view_category&amp;category_id=".ipsRegistry::$request['category_id'];
        $after_magic_quote .= "&amp;sort_key={$sort['key']}&amp;sort_order={$sort['order']}&amp;filter={$filter}";

        $pages = $this->registry->output->generatePagination( array(
                'totalItems'  		  => $total_items,
                'itemsPerPage'    	  => (intval($this->settings['classifieds_items_per_page']) < 1) ? 10 : $this->settings['classifieds_items_per_page'],
                'currentStartValue'       => ipsRegistry::$request['st'],
                'baseUrl'                 => "app=classifieds".$after_magic_quote,
                )		);

  
        //-----------------------------------------
        // Get Path to category
        //-----------------------------------------

        if ($path_to_category = $this->categories->getPath($category)) {

            //-----------------------------------------
            // Add category path to breadcrumb
            //-----------------------------------------

            foreach( $path_to_category as $row ) {
                $this->registry->output->addNavigation( $row['name'], 'app=classifieds&amp;module=core&amp;do=view_category&amp;category_id=' . $row['category_id'] . "&amp;sort_key={$sort['key']}&amp;sort_order={$sort['order']}&amp;filter={$filter}" , $row['seo_title'], "view_category"  );
            }

        }
        
        $this->registry->output->addNavigation( $category['name'], '' );

        //-----------------------------------------
        // Set Title
        //-----------------------------------------

        $this->registry->output->setTitle( $category['name'] .' - '. $this->settings['classifieds_public_name'] .' - ' . $this->settings['board_name'] );
        
        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->category_view($category, $categories, $items, $pages, $sort, $filter, $siblings, $types);
    }

    /**
     * Advert Display
     */
    function viewItem() {

        //-----------------------------------------
        // Grab item
        //-----------------------------------------

        $item = $this->items->getItemById(intval($this->request['item_id']));

        // Has it expired?
        if ($item['date_expiry'] < time()) {
        	if($this->memberData['member_id'] == $item['member_id']) {
        		$this->registry->output->silentRedirect( $this->settings['base_url']."app=classifieds&amp;module=listing&amp;do=renew&amp;item_id={$item['item_id']}" );
        	} else {
        		$this->registry->output->showError( $this->lang->words['cfds_expired'], '10CFDM1001', null, null, 404 );
        	}
        }

        //-----------------------------------------
        // Format description for output
        //-----------------------------------------

        IPSText::getTextClass('bbcode')->parse_html 		= 0;
        IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
        IPSText::getTextClass('bbcode')->parse_smilies		= 1;
        IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_description';
    
        $item['description'] = IPSText::getTextClass('bbcode')->preDisplayParse( $item['description'] );

        //-----------------------------------------
        // Grab Category
        //-----------------------------------------

        $category = $this->categories->getNode($item['category_id']);

        //-----------------------------------------
        // Is item watched
        //-----------------------------------------

        $watched = $this->items->isSubscribed($item['item_id'], $this->memberData['member_id']);

        //-----------------------------------------
        // Path to item
        //-----------------------------------------

        $path_to_category = $this->categories->getPath($category, TRUE);

        foreach( $path_to_category as $row) {
            $this->registry->output->addNavigation( $row['name'], 'app=classifieds&amp;module=core&amp;do=view_category&amp;category_id=' . $row['category_id'], $row['seo_title'], "view_category"  );
            
        }

        $this->registry->output->addNavigation( $item['name'], '' );


        //-----------------------------------------
        // Get Seller Info
        //-----------------------------------------

        $seller = IPSMember::load( $item['member_id'], 'profile_portal', 'id' );
      //  $seller = IPSMember::buildDisplayData( $seller, array('cfSkinGroup' => 'profile', 'checkFormat' => 1, 'spamStatus' => 1 ) );

        //-----------------------------------------
        // Get custom field info
        //-----------------------------------------

        $fields = $this->fields->getFieldsByItemId($item['item_id'], $includeEmpty = false, $category);

        foreach ($fields as $field) {

            $item['fields'][] = $field;

        }
        
        //-----------------------------------------
        // Get questions
        //-----------------------------------------

        $questions = $this->questions->getQuestionsByItemID($item['item_id']);

        //-----------------------------------------
        // Get Attachments
        //-----------------------------------------
        
        $attachments = $this->items->getAttachmentData($item['item_id']);

        //-----------------------------------------
        // Set Title
        //-----------------------------------------

        $this->registry->output->setTitle( $item['name'] . ' - '. $this->settings['classifieds_public_name'] .' - ' . $this->settings['board_name']);

        //-----------------------------------------
        // Mark as read in all ancestor categories
        //-----------------------------------------

        foreach( $path_to_category as $row) {
            $this->registry->classItemMarking->markRead( array( 'categoryID' => $row['category_id'], 'itemID' => $item['item_id'] ), 'classifieds' );
        }
    
        //-----------------------------------------
        // Update the view count
        //-----------------------------------------

        $this->DB->update('classifieds_items', array('views' => $item['views'] + 1), 'item_id = ' . $item['item_id']);

        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->item_view($item, $seller, $attachments, $questions, $watched);
    }

    /**
     * My Items
     */
    function viewMyItems() {
        $this->registry->output->addNavigation( $this->lang->words['cfds_my_items'], '' );

        //-----------------------------------------
        // Get items from DB
        //-----------------------------------------
		//$filters = array("i.member_id = " . $this->memberData['member_id']);
        $items = $this->items->getItems(0,'',false,'',$filters);
      //  $total_items = $this->items->countItemsByMemberId($this->memberData['member_id']);


        //-----------------------------------------
        // Start Pagination
        //-----------------------------------------

        $after_magic_quote .= "&amp;do=view_my_items";

        $pages = $this->registry->output->generatePagination( array(
                'totalItems'  		  => $total_items,
                'itemsPerPage'    	  => (intval($this->settings['classifieds_items_per_page']) < 1) ? 10 : $this->settings['classifieds_items_per_page'],
                'currentStartValue'       => ipsRegistry::$request['st'],
                'baseUrl'		  => "app=classifieds".$after_magic_quote,
                )		);

        // Set Title
        $this->registry->output->setTitle( $this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . $this->lang->words['cfds_my_items']);

       
        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->my_items_view($items, $pages, $questions);
    }

    /**
     * Close Item
     */
    function closeItem() {

        //-----------------------------------------
        // Grab item
        //-----------------------------------------

        $item = $this->items->getItemById(intval($this->request['item_id']));

        //-----------------------------------------
        // Check it's OK to close
        //-----------------------------------------

        if (!$this->memberData['g_classifieds_can_moderate']) {

            // Check users group can close own items
            if(!$this->memberData['g_classifieds_can_open_close']) {
                $this->registry->output->showError( $this->lang->words['cfds_cant_close'], '10CFDM1002', null, null, 403 );
            }

            // Check item belongs to user
            if ($this->memberData['member_id'] != $item['member_id']) {
                $this->registry->output->showError( $this->lang->words['cfds_not_own_item'], '10CFDM1003', null, null, 403 );
            }

        }

        //-----------------------------------------
        // Close it
        //-----------------------------------------

        $this->DB->update( 'classifieds_items', array( 'open' => '0'), 'item_id = ' . intval($item['item_id']) );

        // Do the output stuff

        $this->registry->output->redirectScreen($this->lang->words['cfds_item_closed'], $this->settings['base_url'] . "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item['item_id']);

    }

    /**
     * Open Item
     */
    function openItem() {

        //-----------------------------------------
        // Grab item
        //-----------------------------------------

        $item = $this->items->getItemById(intval($this->request['item_id']));

        //-----------------------------------------
        // Check it's OK to open
        //-----------------------------------------

        if (!$this->memberData['g_classifieds_can_moderate'])
        {

            // Check users group can open own items
            if(!$this->memberData['g_classifieds_can_open_close'])
            {
                $this->registry->output->showError( $this->lang->words['cfds_cant_open'], '10CFDM1004', null, null, 403 );
            }

            // Check item belongs to user
            if ($this->memberData['member_id'] != $item['member_id'])
            {
                $this->registry->output->showError( $this->lang->words['cfds_not_own_item'], '10CFDM1005', null, null, 403 );
            }


        }

        //-----------------------------------------
        // Open it
        //-----------------------------------------

        $this->DB->update( 'classifieds_items', array( 'open' => '1'), 'item_id = ' . intval($item['item_id']) );

        //-----------------------------------------
        // Do the output stuff
        //-----------------------------------------

        $this->registry->output->redirectScreen($this->lang->words['cfds_item_opened'], $this->settings['base_url'] . "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item['item_id']);


    }

    /**
     * Delete Item
     */
    function deleteItem() {

        //-----------------------------------------
        // Grab item
        //-----------------------------------------

        $item = $this->items->getItemById(intval($this->request['item_id']));

        //-----------------------------------------
        // Check it's OK to delete
        //-----------------------------------------

        if (!$this->memberData['g_classifieds_can_moderate'])
        {
            $this->registry->output->showError( $this->lang->words['cfds_cant_delete'], '10CFDM1006', null, null, 403 );
        }

            
        //-----------------------------------------
        // Delete it
        //-----------------------------------------
        $items[] = $item['item_id'];
        $this->items->deleteItems( $items );

        $this->registry->output->redirectScreen($this->lang->words['cfds_item_deleted'], $this->settings['base_url'] . "app=classifieds" );


    }

    /**
     * Delete Item
     */
    function deleteItemForm() {

        $form = array();

        //-----------------------------------------
        // Grab item
        //-----------------------------------------

        $item = $this->items->getItemById(intval($this->request['item_id']));

        //-----------------------------------------
        // Check it's OK to delete
        //-----------------------------------------

        if (!$this->memberData['g_classifieds_can_moderate']) {
            $this->registry->output->showError( $this->lang->words['cfds_cant_delete'], '10CFDM1007' );
        }

        $form['formcode']   =  'do_delete_item';
        $form['button']     = $this->lang->words['cfds_delete_item'];

        //-----------------------------------------
        // Do the output stuff
        //-----------------------------------------

        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->delete_item_form($item, $form);

    }

} // end class
?>