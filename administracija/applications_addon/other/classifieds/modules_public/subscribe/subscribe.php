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

class public_classifieds_subscribe_subscribe extends ipsCommand {
    /**
     * Main class entry point
     *
     * @access	public
     * @param	object		ipsRegistry reference
     * @return	void		[Outputs to screen]
     */
    public function doExecute( ipsRegistry $registry ) {
        if( !$this->memberData['member_id'] ) {
            $this->registry->output->showError( 'no_permission', '10CFDM6001', null, null, 403 );
        }

         //-----------------------------------------
        // Load libraries
        //-----------------------------------------


        $this->categories = $this->registry->classifieds->helper('categories');
        $this->items = $this->registry->classifieds->helper('items');

        $this->registry->class_localization->loadLanguageFile( array( 'public_lang' ), 'classifieds' );

        //--------------------------------------------------
        // What are we doing?
        //--------------------------------------------------

        switch( $this->request['do'] ) {
            case 'cat_subscribe':
                $this->doSubscribe( 'cat' );
                break;

            case 'cat_unsubscribe':
                $this->doUnsubscribe( 'cat' );
                break;
            case 'item_subscribe':
                $this->doSubscribe( 'item' );
                break;

            case 'item_unsubscribe':
                $this->doUnsubscribe( 'item' );
                break;

            default:
                $this->registry->output->showError( 'error_generic', '10CFDM6002' );
                break;
        }
    }

    /**
     * Unsubscribe
     *
     * @access	public
     * @return	void
     */
    public function doUnsubscribe( $type='cat' ) {

                $id = intval($this->request['id']);

        switch( $type ) {


            case 'cat':
                $url 	= "app=classifieds&amp;module=core&amp;do=view_category&amp;category_id=" . $id;
                $this->categories->unsubscribe($id, $this->memberData['member_id']);
                $this->registry->output->redirectScreen( $this->lang->words['cfds_unsubbed_succesfully'], $this->settings['base_url'] . $url );
            break;
            case 'item':
                $url 	= "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $id;
                $this->items->unsubscribe($id, $this->memberData['member_id']);
                $this->registry->output->redirectScreen( $this->lang->words['cfds_item_unsubbed_succesfully'], $this->settings['base_url'] . $url );
            break;


        }


    }

    /**
     * Subscribe
     *
     * @access	public
     * @param	string  $type
     * @return	void
     */
    public function doSubscribe( $type='cat' ) {

        $id = intval($this->request['id']);
        
        switch( $type ) {


            case 'cat':
                $url 	= "app=classifieds&amp;module=core&amp;do=view_category&amp;category_id=" . $id;
                $this->categories->subscribe($id, $this->memberData['member_id']);
                $this->registry->output->redirectScreen( $this->lang->words['cfds_subbed_succesfully'], $this->settings['base_url'] . $url );
            break;
            case 'item':
                $url 	= "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $id;
                $this->items->subscribe($id, $this->memberData['member_id']);
                $this->registry->output->redirectScreen( $this->lang->words['cfds_item_subbed_succesfully'], $this->settings['base_url'] . $url );
            break;


        }
       
    }
}