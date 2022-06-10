<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * Portal plugin: poll
 * Last Updated: $Date: 2010-10-22 06:13:38 -0400 (Fri, 22 Oct 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @subpackage	Forums
 * @link		http://www.invisionpower.com
 * @since		1st march 2002
 * @version		$Revision: 7016 $
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

class ppi_poll extends public_portal_portal_portal 
{
	/**
	 * Initialize module
	 *
	 * @return	void
	 */
	public function init()
 	{
 	}
 	
	/**
	 * Display a poll
	 *
	 * @return	string		HTML content to replace tag with
	 * @todo	We need to update the code below to load the furlTemplates file and check against it, then add a fallback on the normal url as a default.
	 */
	public function poll_show_poll()
	{
		//-----------------------------------------
		// INIT
		//-----------------------------------------
		
 		$extra	= "";
 		$sql	= "";
 		$check	= 0;
 		
 		//-----------------------------------------
 		// Got a poll?
 		//-----------------------------------------
 		
 		if ( ! $this->settings['poll_poll_url'] )
 		{
 			return;
 		}
 		
 		//-----------------------------------------
		// Get the topic ID of the entered URL
		//-----------------------------------------
		
		/* Friendly URL */
		if( $this->settings['use_friendly_urls'] )
		{
			preg_match( "#/topic/(\d+)(.*?)/#", $this->settings['poll_poll_url'], $match );
			$tid = intval( trim( $match[1] ) );
		}
		/* Normal URL */
		else
		{
			preg_match( "/(\?|&amp;)(t|showtopic)=(\d+)($|&amp;)/", $this->settings['poll_poll_url'], $match );
			$tid = intval( trim( $match[3] ) );
		}
		
		if ( !$tid )
		{
			return;
		}
		
		//-----------------------------------------
		// Get topic...
		//-----------------------------------------
		
		$this->registry->class_localization->loadLanguageFile( array( 'public_boards', 'public_topic' ), 'forums' );
		$this->registry->class_localization->loadLanguageFile( array( 'public_editors' ), 'core' );

		if( !$this->registry->isClassLoaded('class_forums') )
		{
			$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . "/sources/classes/forums/class_forums.php", 'class_forums', 'forums' );
			$this->registry->setClass( 'class_forums', new $classToLoad( $this->registry ) );
			
			$this->registry->getClass('class_forums')->strip_invisible = 1;
			$this->registry->getClass('class_forums')->forumsInit();
		}
		
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'forums', 'forums' ) . '/topics.php', 'public_forums_forums_topics', 'forums' );
		$topic = new $classToLoad();
		$topic->makeRegistryShortcuts( $this->registry );

		$topic->topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from'   => 'topics', 'where'  => "tid=" . $tid ) );
		$topic->forum = ipsRegistry::getClass('class_forums')->forum_by_id[ $topic->topic['forum_id'] ];
	
		$this->request['f'] =  $topic->forum['id'] ;
		$this->request['t'] =  $tid ;
		
		if ( $topic->topic['poll_state'] )
		{
 			return $this->registry->getClass('output')->getTemplate('portal')->pollWrapper( $topic->_generatePollOutput(), $tid );
 		}
 		else
 		{
 			return;
 		}
 	}
}