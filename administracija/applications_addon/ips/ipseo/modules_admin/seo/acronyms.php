<?php
/**
 * Invision Power Services
 * IP.SEO Acronym Expansion
 * Last Updated: $Date: 2011-08-16 09:41:42 -0400 (Tue, 16 Aug 2011) $
 *
 * @author 		$Author: mark $ (Orginal: Mark)
 * @copyright	© 2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		16th August 2011
 * @version		$Revision: 9394 $
 */

if ( ! defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly.";
	exit();
}

class admin_ipseo_seo_acronyms extends ipsCommand
{
	
	/**
	 * Main class entry point
	 *
	 * @access	public
	 * @param	object		ipsRegistry reference
	 * @return	@e void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
	
		//-----------------------------------------
		// Init
		//-----------------------------------------
		
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
				
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_seo' );
		
		//-----------------------------------------
		// What are we doing
		//-----------------------------------------
		
		switch ( $this->request['do'] )
		{
			case 'add':
				$this->form( 'add' );
				break;
				
			case 'edit':
				$this->form( 'edit' );
				break;
				
			case 'save':
				$this->save();
				break;
				
			case 'delete':
				$this->delete();
				break;
		
			default:
				$this->manage();
				break;
		}	
	
		//-----------------------------------------
		// Pass to CP output hander
		//-----------------------------------------
		
		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
		$this->registry->getClass('output')->sendOutput();
	}
	
	/**
	 * Action: Manage
	 */
	private function manage()
	{
		$acronyms = array();
		$this->DB->build( array( 'select' => '*', 'from' => 'seo_acronyms', 'order' => 'a_short' ) );
		$this->DB->execute();
		while( $row = $this->DB->fetch() )
		{
			$acronyms[ $row['a_id'] ] = $row;
		}
		
		$this->registry->output->html .= $this->html->acronyms( $acronyms );
	}
	
	/**
	 * Action: Show form
	 */
	private function form( $type )
	{
		/* Normal form logic */
		$current = array();
		if ( $type == 'edit' )
		{			
			$id = intval( $this->request['id'] );
			$current = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'seo_acronyms', 'where' => "a_id={$id}" ) );
			if ( !$current['a_id'] )
			{
				ipsRegistry::getClass('output')->showError( 'err_no_acronym', '11SEO100', FALSE, '', 404 );
			}
			
			$this->registry->output->html .= $this->html->acronymForm( $current );
		}
		else
		{
			$this->registry->output->html .= $this->html->acronymForm( array() );
		}
	}
	
	/**
	 * Action: Save
	 */
	private function save()
	{
		//-----------------------------------------
		// Validate Data
		//-----------------------------------------
		
		if ( !$this->request['short'] or !$this->request['long'] )
		{
			ipsRegistry::getClass('output')->showError( 'err_acronym_details', '11SEO101', FALSE, '', 500 );
		}
		
		if ( strlen( $this->request['short'] ) > 255 or strlen( $this->request['long'] ) > 255 )
		{
			ipsRegistry::getClass('output')->showError( 'err_acronym_toolong', '21SEO102', FALSE, '', 500 );
		}
			
		//-----------------------------------------
		// Save
		//-----------------------------------------
				
		$save = array( 
			'a_short'			=> $this->request['short'],
			'a_long'			=> $this->request['long'],
			'a_semantic'		=> intval( $this->request['semantic'] ),
			);
						
		if ( $this->request['id'] )
		{
			$id = intval( $this->request['id'] );
			$this->DB->update( 'seo_acronyms', $save, "a_id={$id}" );
		}
		else
		{
			$this->DB->insert( 'seo_acronyms', $save );
		}		
		
		// And recache
		$this->recache();
				
		//-----------------------------------------
		// Display
		//-----------------------------------------
		
		$this->registry->output->global_message = $this->lang->words['acronym_saved'];
		$this->manage();
	}
	
	/**
	 * Action: Delete
	 */
	private function delete()
	{
		$id = intval( $this->request['id'] );
		$current = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'seo_acronyms', 'where' => "a_id={$id}" ) );
		if ( !$current['a_id'] )
		{
			ipsRegistry::getClass('output')->showError( 'err_no_acronym', '11SEO103', FALSE, '', 404 );
		}
		
		$this->DB->delete( 'seo_acronyms', "a_id={$id}" );
		
		$this->recache();
		
		$this->registry->output->global_message = $this->lang->words['acronym_deleted'];
		$this->manage();
	}
	
	/**
	 * Recache
	 */
	public function recache()
	{
		$this->cache->rebuildCache( 'badwords' );		
	}
	
}