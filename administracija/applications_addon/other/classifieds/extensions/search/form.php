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
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class search_form_classifieds
{
	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		/* Make object */
		$this->registry   =  ipsRegistry::instance();
		$this->DB         =  $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->lang       =  $this->registry->getClass('class_localization');

		
		/* Language */
		$this->registry->class_localization->loadLanguageFile( array( 'public_lang' ), 'classifieds' );
	}
	

	/**
	 * Return sort drop down
	 * 
	 *
	 * @access	public
	 * @return	array
	 */
	public function fetchSortDropDown()
	{
		return array(
											'price'		=> "Price",
					    					
										);


	}
	
	
	/**
	 * Retuns the html for displaying the extra classifieds search filters
	 *
	 * @access	public
	 * @return	string	Filter HTML
	 **/
	public function getHtml()
	{
		

		//return array( 'title' => ipsRegistry::$applications['classifieds']['app_public_title'], 'html' => ipsRegistry::getClass( 'output' )->getTemplate( 'classifieds' )->advanced_search(  ) );
	}
}
