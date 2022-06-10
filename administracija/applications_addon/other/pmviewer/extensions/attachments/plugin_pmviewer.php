<?php

/**
 * (SN) PM Viewer
 * PM Viewer Attachment Plugin
 * Last Updated: June 25th 2010
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

class plugin_pmviewer extends class_attach_pm
{
	/**
	 * Module type
	 *
	 * @access	public
	 * @var		string
	 */
	public $module = 'msg';
	
	/**
	 * Checks the attachment and checks for download / show perms
	 *
	 * @access	public
	 * @param	integer		Attachment id
	 * @return	array 		Attachment data
	 */
	public function getAttachmentData( $attach_id )
	{
		//-----------------------------------------
		// INIT
		//-----------------------------------------
		
		$_ok = 0;
		
		//-----------------------------------------
		// Grab 'em
		//-----------------------------------------
		
		$this->DB->build( array( 'select'   => 'a.*',
								 'from'     => array( 'attachments' => 'a' ),
								 'where'    => "a.attach_rel_module='".$this->module."' AND a.attach_id=".$attach_id,
								 'add_join' => array( 0 => array( 'select' => 'p.*',
																  'from'   => array( 'message_posts' => 'p' ),
																  'where'  => "p.msg_id=a.attach_rel_id",
																  'type'   => 'left' ),
											          1 => array( 'select' => 't.*',
																  'from'   => array( 'message_topics' => 't' ),
																  'where'  => "t.mt_id=p.msg_topic_id",
																  'type'   => 'left' ),
													  2 => array( 'select' => 'u.*',
																  'from'   => array( 'message_topic_user_map' => 'u' ),
																  'where'  => "u.map_topic_id=t.mt_id AND u.map_user_id=t.mt_starter_id",
																  'type'   => 'left' ) ) ) );

		$attach_sql = $this->DB->execute();
		
		$attach     = $this->DB->fetch( $attach_sql );
		
		//-----------------------------------------
		// Check..
		//-----------------------------------------
		
		if ( ! isset( $attach['msg_id'] ) OR empty( $attach['msg_id'] ) )
		{
			if( $attach['attach_member_id'] != $this->memberData['member_id'] )
			{
				return FALSE;
			}
		}
		
		//-----------------------------------------
    	// For previews
    	//-----------------------------------------
		
		if ( $attach['attach_rel_id'] == 0 AND $attach['attach_member_id'] == $this->memberData['member_id'] )
    	{
    		$_ok = 1;
    	}
    	else if ( $attach['map_user_id'] )
    	{ 
    		$_ok = 1;
    	}
		
		//$_ok = 1;
		
		//-----------------------------------------
		// Check admin permissions
		//-----------------------------------------

		$this->checkPermissions( 'pmviewer_view_attach' );	
		$this->checkPermissions( 'pmviewer_topic' );
		$this->checkPermissions( 'pmviewer_view' );

		//-----------------------------------------
		// Ok?
		//-----------------------------------------

		if ( $_ok )
		{
			return $attach;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * Check the attachment and make sure its OK to display
	 *
	 * @access	public
	 * @param	array		Array of ids
	 * @param	array 		Array of relationship ids
	 * @return	array 		Attachment data
	 */
	public function renderAttachment( $attach_ids, $rel_ids=array(), $attach_post_key=0 )
	{
		//-----------------------------------------
		// INIT
		//-----------------------------------------
		
		$rows  		= array();
		$query_bits	= array();
		$query 		= '';
		$match 		= 0;
		
		/* Check that we have permission to view attachments */
		$permission = $this->checkPermissions( 'pmviewer_view_attach', true );
		
		//-----------------------------------------
		// Check
		//-----------------------------------------
		
		if ( is_array( $attach_ids ) AND count( $attach_ids ) )
		{
			$query_bits[] = "attach_id IN (" . implode( ",", $attach_ids ) .")";
		}
		
		if ( is_array( $rel_ids ) and count( $rel_ids ) )
		{
			// We need to reset the array - this query bit will return everything we need, but
			// if we "OR" join the above query bit with this one, it causes bigger mysql loads
			$query_bits	  = array();
			$query_bits[] = "attach_rel_id IN (" . implode( ",", $rel_ids ) . ")";
			//$query = " OR attach_rel_id IN (-1," . implode( ",", $rel_ids ) . ")";
			$match = 1;
		}
		
		if ( $attach_post_key )
		{
			$query_bits[] = "attach_post_key='".$this->DB->addSlashes( $attach_post_key )."'";
			//$query .= " OR attach_post_key='".$this->DB->addSlashes( $attach_post_key )."'";
			$match  = 2;
		}
		
		if( !count($query_bits) )
		{
			$query = "attach_id IN (-1)";
		}
		else
		{
			$query = implode( " OR ", $query_bits );
		}
		
		//-----------------------------------------
		// Grab 'em
		//-----------------------------------------
		
		$this->DB->build( array( 'select' => '*', 'from' => 'attachments', 'where' => "attach_rel_module='{$this->module}' AND ( {$query} )" ) );
		$attach_sql = $this->DB->execute();
		
		//-----------------------------------------
		// Loop through and filter off naughty ids
		//-----------------------------------------
		
		while( $db_row = $this->DB->fetch( $attach_sql ) )
		{
			$_ok = 1;
			
			if ( $match == 1 )
			{
				if ( ! in_array( $db_row['attach_rel_id'], $rel_ids ) )
				{
					$_ok = 0;
				}
			}
			else if ( $match == 2 )
			{
				if ( $db_row['attach_post_key'] != $attach_post_key )
				{
					$_ok = 0;
				}
			}
			
			//-----------------------------------------
			// Ok?
			//-----------------------------------------
			
			if ( $_ok )
			{
				$rows[ $db_row['attach_id'] ] = $db_row;
			}
		}
		
		//-----------------------------------------
		// Return
		//-----------------------------------------
		
		if ( $permission )
		{
			return $rows;
		}
		else
		{
			return array();
		}
	}
	
	/**
	 * Returns an array of settings:
	 * 'siu_thumb' = Allow thumbnail creation?
	 * 'siu_height' = Height of the generated thumbnail in pixels
	 * 'siu_width' = Width of the generated thumbnail in pixels
	 * 'upload_dir' = Base upload directory (must be a full path)
	 *
	 * You can omit any of these settings and IPB will use the default
	 * settings (which are the ones entered into the ACP for post thumbnails)
	 *
	 * @access	public
	 * @return	boolean
	 */
	public function getSettings()
	{
		$this->mysettings = array();
		
		return true;
	}
	
	/**
	 * Check our admin permissions
	 *
	 * @access	public
	 * @param	string		Permission key
	 * @param	bool		If true, the error message is supressed
	 * @return	mixed		True if has permission or outputs html error message if not, unless error messages are being supressed in which case false is returned
	 */
	public function checkPermissions( $key, $error_sup=FALSE )
	{	
		$return = FALSE;
		
		/* Get our permissions - don't really want to supress these, as if we don't have a member ID or access to the ACP something is wrong */
		if( !$this->memberData['member_id'] )
		{
			ipsRegistry::getClass('output')->showError( 'no_permission', 'Not Logged In' );
		}
		
		if( !$this->memberData['g_access_cp'] )
		{
			ipsRegistry::getClass('output')->showError( 'no_permission', 'No admin permissions' );
		}
		
		if ( $this->in_dev and IN_DEV )
		{
			$return = TRUE;
		}
		
		// Support member + group

		$member_restrictions	= $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'admin_permission_rows', 'where' => "row_id_type='member' AND row_id=" . $this->memberData['member_id'] ) );
		
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
			
			$this->DB->build( array( 'select' => '*', 'from' => 'admin_permission_rows', 'where' => "row_id_type='group' AND row_id IN(" . implode( ',', $groups ) . ")" ) );
			$this->DB->execute();
			
			while( $r = $this->DB->fetch() )
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
			$return = TRUE;
		}
		
		if( $key )
		{	
			if( is_array($this->restrictions_row) AND count($this->restrictions_row) )
			{
				if( isset($this->restrictions_row['items']) )
				{
					if( isset($this->restrictions_row['items'][ $mod_id ]) )
					{
						if( in_array( $key, $this->restrictions_row['items'][ $mod_id ] ) )
						{
							$return = TRUE;
						}
					}
				}
			}
		}

		if ( $return OR $error_sup )
		{
			return $return;
		}
		else
		{
			if ( $return === FALSE )
			{
				ipsRegistry::getClass('output')->showError( 'no_permission', 'No view attachment permission' );
			}
			else
			{
				return $return;
			}
		}
	}
}