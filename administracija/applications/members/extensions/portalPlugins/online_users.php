<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * Portal plugin: online users
 * Last Updated: $Date: 2010-10-21 07:08:38 -0400 (Thu, 21 Oct 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @subpackage	Members
 * @link		http://www.invisionpower.com
 * @since		1st march 2002
 * @version		$Revision: 7007 $
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

class ppi_online_users extends public_portal_portal_portal 
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
	 * Show the online users
	 *
	 * @return	string		HTML content to replace tag with
	 */
	public function online_users_show()
	{
		//-----------------------------------------
		// Get the users from the DB
		//-----------------------------------------
		
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'forums', 'forums' ) . '/boards.php', 'public_forums_forums_boards' );
		$boards	= new $classToLoad();
		$boards->makeRegistryShortcuts( $this->registry );
		
		$active				= $boards->getActiveUserDetails();
		$active['visitors']	= $active['GUESTS']  + $active['ANON'];
		$active['members']	= $active['MEMBERS'];

 		return $this->registry->getClass('output')->getTemplate('portal')->onlineUsers( $active );
 	}
}