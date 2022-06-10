<?php

/**
 * (SN) PM Viewer
 * Set up the notification bits
 * Last Updated: February 21st 2011
 *
 * @author 		signet51
 * @copyright	(c) 2011 signet51 Modding
 * @version		1.6.0 (1600)
 *
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class pmviewer_notifications
{
	public function getConfiguration()
	{
		$this->registry		= $registry;
		ipsRegistry::instance()->class_localization->loadLanguageFile( array( 'public_notifications' ), 'pmviewer' );
		
		$_NOTIFY 	= array(
							array( 'key' => 'pmviewer_keyword_monitor', 'default' => array(), 'disabled' => array(), 'show_callback' => TRUE, 'icon' => 'notify_statusreply' ),
							);
		return $_NOTIFY;
	}
	
	public function pmviewer_keyword_monitor()
	{	
		if( !$this->memberData['member_id'] OR !$this->memberData['g_access_cp'] )
		{
			return false;
		}
		
		$member_restrictions = ipsRegistry::DB()->buildAndFetch( array( 'select' => '*', 'from' => 'admin_permission_rows', 'where' => "row_id_type='member' AND row_id=" . $this->memberData['member_id'] ) );
		
		if( is_array($member_restrictions) AND count($member_restrictions) )
		{
			$this->restrictions_row = unserialize($member_restrictions['row_perm_cache']);
			$this->restricted		= true;
		}
		else
		{
			$groups[]	= $this->memberData['member_group_id'];
			
			if( $this->memberData['mgroup_others'] )
			{
				$groups	= array_merge( $groups, explode( ',', IPSText::cleanPermString( $this->memberData['mgroup_others'] ) ) );
			}
			
			$this->restrictions_row = array();
			
			ipsRegistry::DB()->build( array( 'select' => '*', 'from' => 'admin_permission_rows', 'where' => "row_id_type='group' AND row_id IN(" . implode( ',', $groups ) . ")" ) );
			ipsRegistry::DB()->execute();
			
			while( $r = ipsRegistry::DB()->fetch() )
			{
				$this->restrictions_row = array_merge( $this->restrictions_row, unserialize($r['row_perm_cache']) );
				$this->restricted		= true;
			}
		}
		
		$app		= 'pmviewer';
		$app_id		= ipsRegistry::$applications[ $app ]['app_id'];
		$module		= 'main';
		$modules	= ipsRegistry::$modules[ $app ];
		$mod_id		= 0;
		
		if( is_array($modules) AND count($modules) )
		{
			foreach( $modules as $module_id => $module_data )
			{
				if( $module_data['sys_module_key'] == $module AND $module_data['sys_module_admin'] == 1 )
				{
					$mod_id = $module_data['sys_module_id'];
					break;
				}
			}
		}
		
		if ( !$this->restricted )
		{
			return true;
		}
		
		if( is_array($this->restrictions_row) AND count($this->restrictions_row) )
		{
			if( isset($this->restrictions_row['items']) )
			{
				if( isset($this->restrictions_row['items'][ $mod_id ]) )
				{
					if( in_array( 'pmviewer_keyword_monitor', $this->restrictions_row['items'][ $mod_id ] ) )
					{
						return true;
					}
				}
			}
		}

		/* If we are still here we don't have permission */
		return false;
	}
}