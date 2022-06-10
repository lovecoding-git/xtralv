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

class search_format_classifieds extends search_format
{
	/**
	 * Constructor
	 */
	public function __construct( ipsRegistry $registry )
	{
		parent::__construct( $registry );

        if( ! ipsRegistry::isClassLoaded( 'classifieds' ) )
		{
			/* Classifieds Object */
			require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
			$registry->setClass( 'classifieds', new classifieds( $this->registry ) );
		}
		
		if ( ipsRegistry::$settings['classifieds_locale'] )
		{
			setlocale( LC_MONETARY, ipsRegistry::$settings['classifieds_locale'] );
			ipsRegistry::getClass('class_localization')->local_data = localeconv();
		}		
                
	}
	
	/**
	 * Parse search results
	 *
	 * @access	private
	 * @param	array 	$r				Search result
	 * @return	array 	$html			Blocks of HTML
	 */
	public function parseAndFetchHtmlBlocks( $rows )
	{
		return parent::parseAndFetchHtmlBlocks( $rows );
	}
	
	/**
	 * Formats the forum search result for display
	 *
	 * @access	public
	 * @param	array   $search_row		Array of data from search_index
	 * @return	mixed	Formatted content, ready for display, or array containing a $sub section flag, and content
	 **/
	public function formatContent( $data )
	{		
			return array( ipsRegistry::getClass( 'output' )->getTemplate( 'classifieds' )->search_row( $data, IPSSearchRegistry::get('display.onlyTitles') ), 0 );
	}

	/**
	 * Formats / grabs extra data for results
	 * Takes an array of IDS (can be IDs from anything) and returns an array of expanded data.
	 *
	 * @access public
	 * @return array
	 */
	public function processResults( $ids )
	{
		$rows = array();
		
		foreach( $ids as $i => $d )
		{
			$rows[ $i ] = $this->genericizeResults( $d );
		}
		
		return $rows;	
	}

        	/**
	 * Reassigns fields in a generic way for results output
	 *
	 * @param  array  $r
	 * @return array
	 **/
	public function genericizeResults( $r )
	{
		$r['app']                 = 'classifieds';
		$r['content']             = $r['description'];
		$r['content_title']       = $r['name'];
		$r['updated']             = $r['date_updated'];

		return $r;
	}


}