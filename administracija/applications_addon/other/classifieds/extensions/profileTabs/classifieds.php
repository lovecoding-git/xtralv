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

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

class profile_classifieds extends profile_plugin_parent
{
	/**
	 * return HTML block
	 *
	 * @access	public
	 * @param	array		Member information
	 * @return	@e string		HTML block
	 */
	public function return_html_block( $member=array() ) 
	{
		/* Can we use gallery? */
		if(!$this->memberData['g_classifieds_can_access'])
		{
			return $this->lang->words['err_no_posts_to_show'];
		}
		
		/* Load Language */
		$this->lang->loadLanguageFile( array( 'public_lang' ), 'classifieds' );
		
	    if ( ! $this->registry->isClassLoaded('classifieds') )
        {
                /* Classifieds Object */
                require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
                $this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
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
        $filters[] = "i.member_id = " . $member['member_id'];
        
        $items = $this->registry->classifieds->helper( 'items' )->getItems(0, '', TRUE, 'featured DESC, date_added DESC', $filters);
		
		
		return count($items) ? $this->registry->getClass('output')->getTemplate('classifieds')->profileBlock( $items ) : '';
	}
	
}