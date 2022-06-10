<?php

/**
 * (SN) PM Viewer
 * Main  module
 * Last Updated: July 2nd 2011
 *
 * @author 		signet51
 * @copyright	(c) 2011 signet51 Modding
 * @version		1.6.4a (1641)
 *
 */
 
if ( !defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly.";
	exit();
}

class admin_pmviewer_main_overview extends ipsCommand
{
	/**
	 * Skin object
	 *
	 * @access	private
	 * @var		object			Skin templates
	 */
	private $html;
	
	/**
	 * Shortcut for url
	 *
	 * @access	private
	 * @var		string			URL shortcut
	 */
	private $form_code;
	
	/**
	 * Shortcut for url (javascript)
	 *
	 * @access	private
	 * @var		string			JS URL shortcut
	 */
	private $form_code_js;
	
	/**
	 * Main class entry point
	 *
	 * @access	public
	 * @param	object		ipsRegistry reference
	 * @return	void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
		/* Load skin */
		$this->html			= $this->registry->output->loadTemplate('cp_skin_pmviewer');
		
		/* Set up stuff */
		$this->form_code	= $this->html->form_code	= 'module=main&amp;section=overview';
		$this->form_code_js	= $this->html->form_code_js	= 'module=main&section=overview';
		
		/* Load lang */
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_pmviewer' ) );
		
		switch( $this->request['do'] )
		{
			case 'main':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_view' );
				$this->overview();
			break;
			
			case 'viewTopic':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_topic' );
				$this->viewTopic();
			break;
			
			case 'hideTopic':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_hide_topic' );
				$this->hide_Topic( 'single' );
			break;
			
			case 'hideTopics':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_hide_topic' );
				$this->hide_Topic( 'selected' );
			break;
			
			case 'hideTopics_all':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_hide_topic' );
				$this->hide_Topic( 'all' );
			break;
			
			case 'deleteTopic':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_delete_topic' );
				$this->delete_Topic();
			break;
			
			case 'deletePost':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_delete_posts' );
				$this->delete_Message();
			break;
			
			case 'joinTopic':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_join_topic' );
				$this->join_Topic();
			break;
			
			case 'blockUser':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_block_user' );
				$this->blockUser();
			break;
			
			case 'editSettings':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_settings' );
				$this->editSettings();
			break;
			
			case 'editMessage':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_edit_post' );
				$this->editPost_form();
			break;
			
			case 'editMessage_do':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_edit_post' );
				$this->editPost_save();
			break;
			
			case 'tools':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_tools' );
				$this->tools();
			break;
			
			case 'unhide':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_tools' );
				$this->unhide();
			break;
			
			case 'oldmessages':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_prune_convos' );
				$this->prune_convos();
			break;
			
			case 'prune_convos':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_prune_convos' );
				$this->prune_convos();
			break;
			
			case 'deleteLogs':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_empty_logs' );
				$this->delete_logs();
			break;
			
			default:
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_view' );
				$this->overview();
			break;
		}
			
		/* Pass to CP output hander */
		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
		$this->registry->getClass('output')->sendOutput();
	}
	
	/**
	 * List all the conversations
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function overview()
	{
		/* See if we are searching for anything currently */
		$url_query		= array();
		$db_query		= array();
		$post_needed	= 0;
		$skip_queries	= 0;
		$hide_query 	= '';
		$valid 			= array();
		$type 			= '';
		$match 			= '';
		$string 		= '';
		$id 			= '';
		$do				= '';
		$st				= '';
		
		/* Temporarily disable this */
		if ( $this->settings['pmviewer_invited'] )
		{
			$this->settings['pmviewer_invited'] = 0;
			$this->DB->update( 'core_sys_conf_settings', array( 'conf_value' => '0' ), 'conf_key="pmviewer_invited"' );
			
			/* Rebuild settings cache */
			$settings = array();
		
			$this->DB->build( array( 'select' => '*', 'from' => 'core_sys_conf_settings', 'where' => 'conf_add_cache=1' ) );
			$info = $this->DB->execute();
		
			while ( $r = $this->DB->fetch($info) )
			{	
				$value = $r['conf_value'] != "" ?  $r['conf_value'] : $r['conf_default'];
				
				if ( $value == '{blank}' )
				{
					$value = '';
				}

				$settings[ $r['conf_key'] ] = $value;
			}
			
			$this->cache->setCache( 'settings', $settings, array( 'array' => 1 ) );
			
			$this->registry->output->global_message = 'The ability to check the groups of invited members has been temporarily disabled, this functionality will hopefully be restored in a future build. Apologies for any inconvenience caused.';
		}
		
		if ( $this->request['type'] AND $this->request['type'] != "" )
		{
			$this->registry->output->html_help_title .= $this->lang->words['pm_search'];
			
			if ( $this->settings['pmviewer_hide'] != '' )
			{
				$safetopass = 0;
				$hidebit	= " AND member_group_id NOT IN ({$this->settings['pmviewer_hide']})";
			}
			else
			{
				$safetopass = 1;
				$hidebit	= '';
			}

			switch( $this->request['type'] )
			{
				case 'fromid':
					$url_query[]	= 'type=fromid';
					$url_query[]	= 'id=' . intval($this->request['id']);
					$db_query[]		= 'AND t.mt_starter_id=' . intval($this->request['id']);
				break;

				case 'toid':
					$url_query[]	= 'type=toid';
					$url_query[]	= 'id=' . intval($this->request['id']);
					$db_query[]		= "AND t.mt_to_member_id=" . intval($this->request['id']) . " OR t.mt_invited_members LIKE '%:" . intval($this->request['id']) . ";%'";
				break;
				
				case 'topic_id':
					$id				= intval($this->request['id']) > 0 ? $this->request['id'] : $this->request['string'];
					
					if ( ! $id OR ! is_int($id) )
					{
						if( intval($id) < 1 )
						{
							$this->registry->output->showError( $this->lang->words['pm_no_topic_id_block'] );
						}
					}
					
					$url_query[]	= 'type=topic_id';
					$url_query[]	= 'id=' . $id;
					
					if ( $this->request['match'] == 'loose' )
					{
						$test_topic_id = $this->DB->buildAndFetch( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'pmviewer_hide = 0 AND mt_id LIKE "%'.$id.'%"' ) );
						if ( ! $test_topic_id['mt_id'] )
						{
							$skip_queries = 1;
							$ccnt = 0;
						}
						
						$db_query[]		= "AND t.mt_id LIKE '%" . $id ."%'";
					}
					else
					{
						$test_topic_id = $this->DB->buildAndFetch( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'pmviewer_hide = 0 AND mt_id='.$id ) );
						if ( ! $test_topic_id['mt_id'] )
						{
							$skip_queries = 1;
							$ccnt = 0;
						}
						
						$db_query[]		= "AND t.mt_id=" . $id;
					}
				break;

				case 'subject':
					$string = $this->request['string'];

					if ( ! $string )
					{
						$this->registry->output->showError( $this->lang->words['pm_nothing_searched'] );
					}

					$url_query[]	= 'type=' . $this->request['type'];
					$url_query[]	= 'string=' . urlencode($string);
					$db_query[]		= $this->request['match'] == 'loose' ? 'AND '.$this->DB->buildSearchStatement( 't.mt_title', $string, true, false, $this->settings['use_fulltext'] ) : "AND t.mt_title='{$string}'";
				break;

				case 'name_from':
					if ( is_numeric($this->request['string']) )
					{
						$id = $this->request['string'];
						
						if ( $this->request['match'] == 'loose' )
						{
							if ( !$safetopass )
							{
								$person_check = $this->DB->buildAndFetch( array( 'select' => 'member_id', 'from' => 'members', 'where' => 'member_id LIKE "%'.$id.'%" AND member_group_id NOT IN ('.$this->settings['pmviewer_hide'].')' ) );
								if ( !$person_check['member_id'] )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
								else
								{
									$safetopass = 1;
								}
							}
							
							if ( $safetopass )
							{
								$test_topic_id = $this->DB->buildAndFetch( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'pmviewer_hide = 0 AND mt_starter_id LIKE "%'.$id.'%"' ) );
								if ( ! $test_topic_id['mt_id'] )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
							}
							
							$db_query[]		= "AND t.mt_starter_id LIKE '%" . $id ."%'";
						}
						else
						{
							if ( !$safetopass )
							{
								$person_check = $this->DB->buildAndFetch( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id = '.$id ) );
								if ( in_array( $person_check['member_group_id'], explode( ',', $this->settings['pmviewer_hide']) ) )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
								else
								{
									$safetopass = 1;
								}
							}
							
							if ( $safetopass )
							{
								$test_topic_id = $this->DB->buildAndFetch( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'pmviewer_hide = 0 AND mt_starter_id='.$id ) );
								if ( ! $test_topic_id['mt_id'] )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
							}
							
							$db_query[]		= "AND t.mt_starter_id=" . $id;
						}
					}
					else
					{
						$string = urldecode($this->request['string']);

						if ( ! $string )
						{
							$this->registry->output->showError( $this->lang->words['pm_nothing_searched'] );
						}

						if ( $this->request['match'] == 'loose' )
						{
							$this->DB->build( array( 'select' => 'member_id', 'from' => 'members', 'where' => $this->DB->buildSearchStatement( 'members_display_name', $string, true, false, $this->settings['use_fulltext'] . $hidebit ) ) );
							$this->DB->execute();

							if ( ! $this->DB->getTotalRows() )
							{
								$skip_queries = 1;
								$ccnt = 0;
							}
							
							$ids = array();
							
							while ( $r = $this->DB->fetch() )
							{
								$ids[] = $r['member_id'];
							}
							
							$db_query[] = 'AND t.mt_starter_id IN(' . implode( ',', $ids ) . ')';
						}
						else
						{
							$r = $this->DB->buildAndFetch( array( 'select' => 'member_id', 'from' => 'members', 'where' => "members_display_name='{$string}' {$hidebit}" ) );

							if ( ! $r['member_id'] )
							{
								$skip_queries = 1;
								$ccnt = 0;
							}

							$db_query[] = 'AND t.mt_starter_id=' . $r['member_id'];
						}
					}
					
					$url_query[]	= 'type=' . $this->request['type'];
					$url_query[]	= 'string=' . urlencode($string);
				break;

				case 'name_to':
					if ( is_numeric($this->request['string']) )
					{
						$id = $this->request['string'];
						
						if ( $this->request['match'] == 'loose' )
						{
							if ( !$safetopass )
							{
								$person_check = $this->DB->buildAndFetch( array( 'select' => 'member_id', 'from' => 'members', 'where' => 'member_id LIKE "%'.$id.'%" AND member_group_id NOT IN ('.$this->settings['pmviewer_hide'].')' ) );
								if ( !$person_check['member_id'] )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
								else
								{
									$safetopass = 1;
								}
							}
							
							if( $safetopass )
							{
								$test_topic_id = $this->DB->buildAndFetch( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'pmviewer_hide = 0 AND ( mt_to_member_id LIKE "%'.$id.'%" OR mt_invited_members LIKE "%'.$id.'%" )' ) );
								if ( ! $test_topic_id['mt_id'] )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
							}
							
							$db_query[]		= "AND ( t.mt_to_member_id LIKE '%" . $id . "%' OR t.mt_invited_members LIKE '%" . $id . "%' )";
						}
						else
						{
							if ( !$safetopass )
							{
								$person_check = $this->DB->buildAndFetch( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id = '.$id ) );
								if ( in_array( $person_check['member_group_id'], explode( ',', $this->settings['pmviewer_hide']) ) )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
								else
								{
									$safetopass = 1;
								}
							}
							
							if ( $safetopass )
							{
								$test_topic_id = $this->DB->buildAndFetch( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'pmviewer_hide = 0 AND ( mt_to_member_id='.$id.' OR mt_invited_members LIKE "%:'.$id.';%")' ) );
								if ( ! $test_topic_id['mt_id'] )
								{
									$skip_queries = 1;
									$ccnt = 0;
								}
							}
							
							$db_query[]		= "AND ( t.mt_to_member_id=" . $id . " OR t.mt_invited_members LIKE '%:" . $id . ";%' )";
						}
					}
					else
					{
						$string = urldecode($this->request['string']);
						
						if ( ! $string )
						{
							$this->registry->output->showError( $this->lang->words['pm_nothing_searched'] );
						}

						if ( $this->request['match'] == 'loose' )
						{
							$this->DB->build( array( 'select' => 'member_id,member_group_id', 'from' => 'members', 'where' => $this->DB->buildSearchStatement( 'members_display_name', $string, true, false, $this->settings['use_fulltext'] . $hidebit ) ) );
							$this->DB->execute();
							
							if ( ! $this->DB->getTotalRows() )
							{
								$skip_queries = 1;
								$ccnt = 0;
							}

							$ids = array();
							
							while ( $r = $this->DB->fetch() )
							{
								if ( !in_array( $r['member_group_id'], explode( ',', $this->settings['pmviewer_hide'] ) ) )
								{
									$ids[] = $r['member_id'];
								}
							}
							
							if( count( $ids ) )
							{
								$db_query[] = "AND ( t.mt_to_member_id IN(" . implode( ",", $ids ) . ") OR (t.mt_invited_members LIKE '%:" . implode( ";%' OR '%:", $ids ) . ";%') )";
							}
							else
							{
								$skip_queries = 1;
								$ccnt = 0;
							}
						}
						else
						{
							$r = $this->DB->buildAndFetch( array( 'select' => 'member_id,member_group_id', 'from' => 'members', 'where' => "members_display_name='{$string}' {$hidebit}" ) );

							if ( ! $r['member_id'] )
							{
								$skip_queries = 1;
								$ccnt = 0;
							}
							
							if ( !in_array( $r['member_group_id'], explode( ',', $this->settings['pmviewer_hide'] ) ) )
							{
								$db_query[] = "AND ( t.mt_to_member_id=" . $r['member_id'] . " OR t.mt_invited_members LIKE '%:" . $r['member_id'] . ";%' )";
							}
							else
							{
								$skip_queries = 1;
								$ccnt = 0;
							}
						}
					}
					
					$url_query[]	= 'type=' . $this->request['type'];
					$url_query[]	= 'string=' . urlencode($string);
				break;
				
				case 'message':
					$string = IPSText::parseCleanValue(urldecode($this->request['string']));
					
					if ( ! $string )
					{
						$this->registry->output->showError( $this->lang->words['pm_nothing_searched'] );
					}
					
					if ( $this->request['match'] == 'loose' )
					{
						if ( ! $this->settings['use_fulltext'] )
						{
							$words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $string, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
							if ( is_array( $words ) AND count( $words ) )
							{
								foreach( $words as $word )
								{
									$where_clauses[] = $this->DB->buildSearchStatement( 'p.msg_post', $word, true, false, $this->settings['use_fulltext'] );
								}
								$loose_init_query = '('. implode( ' OR ', $where_clauses ) .')';
							}
						}
						else
						{
							$loose_init_query = $this->DB->buildSearchStatement( 'p.msg_post', $string, true, false, $this->settings['use_fulltext'] );
						}
						$r = $this->DB->buildAndFetch( array( 'select' => 'p.msg_id', 'from' => 'message_posts p', 'where' => $loose_init_query ) );
						
						if ( ! $r['msg_id'] )
						{
							/* Check the deleted ones if we can */
							if ( $this->settings['pmviewer_show_deleted'] )
							{
								$rd = $this->DB->buildAndFetch( array( 'select' => 'p.msg_id', 'from' => 'pmviewer_message_posts p', 'where' => $loose_init_query ) );
							}
							
							if ( ! $rd['msg_id'] )
							{
								$skip_queries = 1;
								$ccnt = 0;
							}
						}
						$db_query[] = 'AND '.$loose_init_query;
						$post_needed = 1;
					}
					else
					{
						$r = $this->DB->buildAndFetch( array( 'select' => 'msg_id', 'from' => 'message_posts', 'where' => "msg_post = '". $string ."'" ) );
						
						if ( ! $r['msg_id'] )
						{
							/* Try seeing if there are any deleted ones that will match this if we can */
							if ( $this->settings['pmviewer_show_deleted'] )
							{
								$rd = $this->DB->buildAndFetch( array( 'select' => 'msg_id', 'from' => 'pmviewer_message_posts', 'where' => "msg_post = '". $string ."'" ) );
							}
							
							if ( ! $rd['msg_id'] )
							{
								$skip_queries = 1;
								$ccnt = 0;
							}
						}
						
						$db_query[] = "AND p.msg_post = '". $string ."'";
						$post_needed = 1;
					}
					
					$url_query[]	= 'type=' . $this->request['type'];
					$url_query[]	= 'string=' . urlencode($string);
					
				break;
			}
		}
		
		if( $this->request['match'] )
		{
			$url_query[]	= 'match=' . $this->request['match'];
		}
				
		/* INIT */
		$conversations	= array();
		$cperpage 		= 20;
		$last_posters	= array();
		$dbe			= "";
		$url			= "";
		$dbpre   		= ips_DBRegistry::getPrefix();
		$stc			= intval($this->request['st']) >=0 ? intval($this->request['st']) : 0;
		$showgroups		= $this->settings['pmviewer_show'];
		
		if ( $showgroups )
		{
			foreach( $this->caches['group_cache'] as $group_id => $gdata )
			{
				$full_groups[] = $group_id;
			}
			
			/* Assume that the cache is up to date, so any extras in showgroups are old */
			if ( ! count( array_diff( $full_groups, explode( ',', $showgroups ) ) ) )
			{
				if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 1 )
				{
					$show_query	= "";
					$join_tables = "n";
				}
				else if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 0 )
				{
					/* This might look backward, but it's fine in that it will show all starters (including deleted) but not deleted recipients */
					$show_query  = " AND f.member_group_id IS NOT NULL ";
					$join_tables = "f";
				}
				else if ( $this->settings['pmviewer_starter'] == 0 AND $this->settings['pmviewer_recipient'] == 1 )
				{
					$show_query  = " AND m.member_group_id IS NOT NULL ";
					$join_tables = "m";
				}
			}
			else
			{
				if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 1 )
				{
					if ( $this->settings['pmviewer_invited'] )
					{
						$show_query	 = " AND (m.member_group_id IN (". $showgroups .") OR f.member_group_id IN (". $showgroups .") OR m.member_group_id IS NULL OR f.member_group_id IS NULL OR t.mt_invited_members LIKE '%i:%')";
					}
					else
					{
						$show_query	 = " AND (m.member_group_id IN (". $showgroups .") OR f.member_group_id IN (". $showgroups .") OR m.member_group_id IS NULL OR f.member_group_id IS NULL)";
					}
					
					$join_tables = "b";
				}
				else if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 0 )
				{
					$show_query  = " AND (m.member_group_id IN (". $showgroups .") OR m.member_group_id IS NULL) AND f.member_group_id IS NOT NULL ";
					$join_tables = "b";
				}
				else if ( $this->settings['pmviewer_starter'] == 0 AND $this->settings['pmviewer_recipient'] == 1 )
				{
					if ( $this->settings['pmviewer_invited'] )
					{
						$show_query  = " AND (f.member_group_id IN (". $showgroups .") OR f.member_group_id IS NULL OR t.mt_invited_members LIKE '%i:%') AND m.member_group_id IS NOT NULL ";
					}
					else
					{
						$show_query  = " AND (f.member_group_id IN (". $showgroups .") OR f.member_group_id IS NULL) AND m.member_group_id IS NOT NULL ";
					}
					$join_tables = "b";
				}
				else
				{
					$this->registry->output->global_message = $this->lang->words['pm_starter_recipient'];
					$this->editSettings();
					return;
				}
			}
		}
		else
		{
			$this->registry->output->global_message = $this->lang->words['pm_no_group'];
			$this->editSettings();
			return;
		}		
			
		$hidegroups		= $this->settings['pmviewer_hide'];
		if ( $hidegroups )
		{
			if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 1 )
			{
				$hide_query	= " AND (m.member_group_id NOT IN (". $hidegroups .") AND f.member_group_id NOT IN (". $hidegroups ."))";
				$join_tables = "b";
			}
			else if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 0 )
			{
				$hide_query	= " AND m.member_group_id NOT IN (". $hidegroups .")";
				$join_tables = "b";
			}
			else if ( $this->settings['pmviewer_starter'] == 0 AND $this->settings['pmviewer_recipient'] == 1 )
			{
				$hide_query = " AND f.member_group_id NOT IN (". $hidegroups .")";
				$join_tables = "b";
			}
		}
		elseif ( ! count( array_diff( $full_groups, explode( ',', $showgroups ) ) ) AND $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] AND $this->settings['pmviewer_starter'] )
		{
			$skip_validbuild = 1;
		}
		
		if ( $showgroups == $hidegroups )
		{
			$this->registry->output->global_message = $this->lang->words['pm_no_difference'];
			$this->editSettings();
			return;
		}
		
		$show_groups = explode( ',', $showgroups);
		$hide_groups = explode( ',', $hidegroups);
		$group_check = array_diff($show_groups, $hide_groups);
		if ( !$group_check )
		{
			$this->registry->output->global_message = $this->lang->words['pm_show_no'];
			$this->editSettings();
			return;
		}
		
		$hidesystem = $this->settings['pmviewer_system_hide'];
		if ( $hidesystem )
		{
			$system_query = "AND t.mt_is_system = 0";
		}
		
		$keywords = $this->settings['pmviewer_keywords'];
		if ( $keywords AND trim($keywords) != '' AND ! $skip_queries )
		{
			/* Set up the keyword search queries - and just check if there is any matches - no point wasting resources if there aren't */
			if( $this->settings['use_fulltext'] )
			{
				$where_clause = $this->DB->buildSearchStatement( 'p.msg_post', $keywords, true, false, $this->settings['use_fulltext'] );
			}
			else
			{
				$words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $keywords, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
				if ( is_array( $words ) AND count( $words ) )
				{
					foreach( $words as $word )
					{
						$where_clauses[] = $this->DB->buildSearchStatement( 'p.msg_post', $word, true, false, $this->settings['use_fulltext'] );
					}
					$where_clause = '('. implode( ' OR ', $where_clauses ) .')';
				}
			}
			$init_keyword = $this->DB->buildAndFetch( array( 'select' => 'p.msg_id', 'from' => 'message_posts p', 'where' => $where_clause ) );
			$keyword_query = ' AND '.$where_clause;
			
			if ( ! $init_keyword['msg_id'] )
			{
				/* Check for deleted if we can */
				if ( $this->settings['pmviewer_show_deleted'] )
				{
					$init_keyword = $this->DB->buildAndFetch( array( 'select' => 'p.msg_id', 'from' => 'pmviewer_message_posts p', 'where' => $where_clause ) );
				}
				
				if ( ! $init_keyword['msg_id'] )
				{
					$skip_queries = 1;
					$ccnt = 0;
				}
			}
			
			if( $init_keyword['msg_id'] )
			{
				$post_needed = 1;
			}
		}		
		
		if ( count($db_query) > 0 )
		{
			$dbe = implode(' AND ', $db_query );
		}
		
		if ( count($url_query) > 0 )
		{
			$url = '&amp;' . implode( '&amp;', $url_query );
		}
		
		/* Basic admin page stuff */
		//$this->registry->output->html_help_title  = sprintf( $this->lang->words['main_page_title'], $this->lang->words['mod_title'] );
		//$this->registry->output->html_help_msg = $this->lang->words['main_page_detail'];
		$inviteList = array();
		$discard	= array();
		
		if ( ! $skip_queries )
		{
			if ( $post_needed )
			{
				if ( ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] AND !$skip_validbuild ) OR $this->request['type'] == 'name_to' )
				{
					/* Run the initial tests to see who passes then refine with respect to invited members (check groups and who is in them as per keyword searches */
					if ( ! $this->settings['pmviewer_show_deleted'] )
					{
						if ( $join_tables == 'n' )
						{
							$this->DB->build( array( 'select'	=> 'mt_id as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_posts' => 'p'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
													 'add_join'	=> array(
													 array ('from'	=> array('message_topics' => 't'),
															'where'	=> 't.mt_id=p.msg_topic_id',
															'type'	=> 'left' ) ),
													 'order'	=> 't.mt_last_post_time DESC' ) );
						}
						elseif ( $join_tables == 'f' )
						{
							$this->DB->build( array( 'select'	=> 'distinct(mt_id) as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_posts' => 'p'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
													 'add_join'	=> array(
													 array ('from'	=> array('message_topics' => 't'),
															'where'	=> 't.mt_id=p.msg_topic_id',
															'type'	=> 'left' ),
													 array ('from'  => array('members' => 'f'),
															'where' => 'f.member_id=t.mt_to_member_id',
															'type'	=> 'left' ) ),
													 'order'	=> 't.mt_last_post_time DESC' ) );
						}
						elseif ( $join_tables == 'm' )
						{
							$this->DB->build( array( 'select'	=> 'distinct(mt_id) as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_posts' => 'p'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
													 'add_join'	=> array(
													 array ('from'	=> array('message_topics' => 't'),
															'where'	=> 't.mt_id=p.msg_topic_id',
															'type'	=> 'left' ),
													 array ('from'  => array('members' => 'm'),
															'where' => 'm.member_id=t.mt_starter_id',
															'type'	=> 'left' ) ),
													 'order'	=> 't.mt_last_post_time DESC' ) );
						}
						else
						{
							$this->DB->build( array( 'select'	=> 'distinct(mt_id) as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_posts' => 'p'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
													 'add_join'	=> array(
													 array ('from'	=> array('message_topics' => 't'),
															'where'	=> 't.mt_id=p.msg_topic_id',
															'type'	=> 'left' ),
													 array ('from'  => array('members' => 'm'),
															'where' => 'm.member_id=t.mt_starter_id',
															'type'	=> 'left' ),
													 array ('from'  => array('members' => 'f'),
															'where' => 'f.member_id=t.mt_to_member_id',
															'type'	=> 'left' ) ),
													 'order'	=> 't.mt_last_post_time DESC' ) );
						}
						
						$this->DB->execute();
						while( $d = $this->DB->fetch() )
						{
							$uninvite			= 0;
							$invited[$d['id']] 	= unserialize($d['mt_invited_members']);
							
							if ( $this->request['type'] == 'name_to' )
							{
								if ( is_numeric($this->request['string']) )
								{
									$id = $this->request['string'];
								
									if ( $this->request['match'] == 'loose' )
									{
										if ( !preg_match( "/{$id}/", $d['mt_to_member_id'] ) AND !preg_match( "/{$id}/", implode( ',', $invited[$d['id']] ) ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $id != $d['mt_to_member_id'] AND !in_array( $id, $invited[$d['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
								else
								{
									if ( $this->request['match'] == 'loose' )
									{
										if ( !in_array( $d['mt_to_member_id'], $ids ) AND !array_intersect( $ids, $invited[$d['id']] ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $r['member_id'] != $d['mt_to_member_id'] AND !in_array( $r['member_id'], $invited[$d['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
							}
							
							if ( !$uninvite )
							{
								$inviteList	= array_merge( $inviteList, $invited[$d['id']] );
								$inviteList	= array_unique( $inviteList );
								
								$valid[] = $d['id'];
								$valid = array_filter( $valid );
								$valid = array_unique( $valid );
							}
							else
							{
								unset($invited[$d['id']]);
							}
						}
					}
					else
					{
						$this->DB->allow_sub_select = 1;
						
						if ( $join_tables == 'n' )
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_posts p
												LEFT JOIN {$dbpre}message_topics t ON (t.mt_id=p.msg_topic_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_posts p
													LEFT JOIN {$dbpre}pmviewer_message_topics t ON (t.mt_id=p.msg_topic_id )
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												ORDER BY mt_last_post_time DESC" );
						}
						elseif ( $join_tables == 'f' )
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_posts p
												LEFT JOIN {$dbpre}message_topics t ON (t.mt_id=p.msg_topic_id )
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_posts p
													LEFT JOIN {$dbpre}pmviewer_message_topics t ON (t.mt_id=p.msg_topic_id )
													LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												ORDER BY mt_last_post_time DESC" );
						}
						elseif( $join_tables == 'm' )
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_posts p
												LEFT JOIN {$dbpre}message_topics t ON (t.mt_id=p.msg_topic_id )
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_posts p
													LEFT JOIN {$dbpre}pmviewer_message_topics t ON (t.mt_id=p.msg_topic_id )
													LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												ORDER BY mt_last_post_time DESC" );
						}
						else
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_posts p
												LEFT JOIN {$dbpre}message_topics t ON (t.mt_id=p.msg_topic_id )
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_posts p
													LEFT JOIN {$dbpre}pmviewer_message_topics t ON (t.mt_id=p.msg_topic_id )
													LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
													LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
												ORDER BY mt_last_post_time DESC" );
						}
						
						while( $de = $this->DB->fetch() )
						{
							$uninvite				= 0;
							$invited[$de['id']] 	= unserialize($de['mt_invited_members']);
							
							if ( $this->request['type'] == 'name_to' )
							{
								if ( is_numeric($this->request['string']) )
								{
									$id = $this->request['string'];
								
									if ( $this->request['match'] == 'loose' )
									{
										if ( !preg_match( "/{$id}/", $de['mt_to_member_id'] ) AND !preg_match( "/{$id}/", implode( ',', $invited[$de['id']] ) ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $id != $de['mt_to_member_id'] AND !in_array( $id, $invited[$de['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
								else
								{
									if ( $this->request['match'] == 'loose' )
									{
										if ( !in_array( $de['mt_to_member_id'], $ids ) AND !array_intersect( $ids, $invited[$de['id']] ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $r['member_id'] != $de['mt_to_member_id'] AND !in_array( $r['member_id'], $invited[$de['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
							}
							
							if ( !$uninvite )
							{
								$inviteList	= array_merge( $inviteList, $invited[$de['id']] );
								$inviteList	= array_unique( $inviteList );
								
								$valid[] = $de['id'];
								$valid = array_filter($valid);
								$valid = array_unique($valid);
							}
							else
							{
								unset($invited[$de['id']]);
							}
							
							$this->DB->allow_sub_select = 0;
						}
					}
					
					/* Check if there is need to actually run through this whole thing */
					if( $this->settings['pmviewer_hide'] != '' )
					{
						if( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] )
						{
							if ( is_array( $inviteList ) AND count( $inviteList ) )
							{
								$this->DB->build( array( 'select' => 'member_id', 'from' => 'members', 'where' => "member_group_id IN ( {$this->settings['pmviewer_hide']} ) AND member_id IN ( ". implode ( ',', $inviteList ) .")" ) );
								$this->DB->execute();
								while( $me = $this->DB->fetch() )
								{
									$remove[] = $me['member_id'];
								}
								
								if( is_array($remove) AND count($remove) )
								{
									foreach( $invited as $topic => $list )
									{
										if( array_intersect( $list, $remove ) )
										{
											$discard[] = $topic;
										}
									}
									
									$valid = array_diff( $valid, $discard );
									$valid = array_filter($valid);
									$ccnt  		= count($valid);
									$skipcount 	= 1;
									$valid = array_slice( $valid, $stc, $cperpage, TRUE );
								}
							}
						}
					}
					
					if ( !$skipcount )
					{
						$ccnt = count($valid);
					}
				}
				else
				{
					/* Count how many rows we have got - need to look at distinct topic ID's to keep correct count as including post table would throw it out */
					if ( $join_tables == 'n' )
					{
						$row = $this->DB->buildAndFetch( array( 'select' => 'count(DISTINCT(mt_id)) as count',
																'from'		=> array('message_posts' => 'p'),
																'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																'add_join'	=> array(
																array ( 'from'	=> array('message_topics' => 't'),
																		'where'	=> 't.mt_id=p.msg_topic_id',
																		'type'	=> 'left' ) ) ) );
					}
					elseif( $join_tables == 'f' )
					{
						$row = $this->DB->buildAndFetch( array( 'select' => 'count(DISTINCT(mt_id)) as count',
																'from'		=> array('message_posts' => 'p'),
																'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																'add_join'	=> array(
																array ( 'from'	=> array('message_topics' => 't'),
																		'where'	=> 't.mt_id=p.msg_topic_id',
																		'type'	=> 'left' ),
																array ( 'from'  => array('members' => 'f'),
																		'where' => 'f.member_id=t.mt_to_member_id',
																		'type'	=> 'left' ) ) ) );
					}
					elseif( $join_tables == 'm' )
					{
						$row = $this->DB->buildAndFetch( array( 'select' => 'count(DISTINCT(mt_id)) as count',
																'from'		=> array('message_posts' => 'p'),
																'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																'add_join'	=> array(
																array ( 'from'	=> array('message_topics' => 't'),
																		'where'	=> 't.mt_id=p.msg_topic_id',
																		'type'	=> 'left' ),
																array ( 'from'  => array('members' => 'm'),
																		'where' => 'm.member_id=t.mt_starter_id',
																		'type'	=> 'left' ) ) ) );
					}
					else
					{
						$row = $this->DB->buildAndFetch( array( 'select' => 'count(DISTINCT(mt_id)) as count',
																'from'		=> array('message_posts' => 'p'),
																'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																'add_join'	=> array(
																array ( 'from'	=> array('message_topics' => 't'),
																		'where'	=> 't.mt_id=p.msg_topic_id',
																		'type'	=> 'left' ),
																array ( 'from'  => array('members' => 'm'),
																		'where' => 'm.member_id=t.mt_starter_id',
																		'type'	=> 'left' ),
																array ( 'from'  => array('members' => 'f'),
																		'where' => 'f.member_id=t.mt_to_member_id',
																		'type'	=> 'left' ) ) ) );
					}
														
					/* Now count the deleted tables ones if we can */
					if ( $this->settings['pmviewer_show_deleted'] )
					{
						if ( $join_tables == 'n' )
						{
							$rowd = $this->DB->buildAndFetch( array('select' => 'count(DISTINCT(mt_id)) as count',
																	'from'		=> array('pmviewer_message_posts' => 'p'),
																	'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																	'add_join'	=> array(
																	array ( 'from'	=> array('pmviewer_message_topics' => 't'),
																			'where'	=> 't.mt_id=p.msg_topic_id',
																			'type'	=> 'left' ) ) ) );
						}
						elseif ( $join_tables == 'f' )
						{
							$rowd = $this->DB->buildAndFetch( array('select' => 'count(DISTINCT(mt_id)) as count',
																	'from'		=> array('pmviewer_message_posts' => 'p'),
																	'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																	'add_join'	=> array(
																	array ( 'from'	=> array('pmviewer_message_topics' => 't'),
																			'where'	=> 't.mt_id=p.msg_topic_id',
																			'type'	=> 'left' ),
																	array ( 'from'  => array('members' => 'f'),
																			'where' => 'f.member_id=t.mt_to_member_id',
																			'type'	=> 'left' ) ) ) );
						}
						elseif( $join_tables == 'm' )
						{
							$rowd = $this->DB->buildAndFetch( array('select' => 'count(DISTINCT(mt_id)) as count',
																	'from'		=> array('pmviewer_message_posts' => 'p'),
																	'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																	'add_join'	=> array(
																	array ( 'from'	=> array('pmviewer_message_topics' => 't'),
																			'where'	=> 't.mt_id=p.msg_topic_id',
																			'type'	=> 'left' ),
																	array ( 'from'  => array('members' => 'm'),
																			'where' => 'm.member_id=t.mt_starter_id',
																			'type'	=> 'left' ) ) ) );
						}
						else
						{
							$rowd = $this->DB->buildAndFetch( array('select' => 'count(DISTINCT(mt_id)) as count',
																	'from'		=> array('pmviewer_message_posts' => 'p'),
																	'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ." ". $keyword_query,
																	'add_join'	=> array(
																	array ( 'from'	=> array('pmviewer_message_topics' => 't'),
																			'where'	=> 't.mt_id=p.msg_topic_id',
																			'type'	=> 'left' ),
																	array ( 'from'  => array('members' => 'm'),
																			'where' => 'm.member_id=t.mt_starter_id',
																			'type'	=> 'left' ),
																	array ( 'from'  => array('members' => 'f'),
																			'where' => 'f.member_id=t.mt_to_member_id',
																			'type'	=> 'left' ) ) ) );
						}
						
						$ccnt = intval( $row['count'] + $rowd['count'] );
					}
					else
					{
						$ccnt = intval( $row['count']);
					}
				}
			}
			else
			{
				if ( ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] AND !$skip_validbuild ) OR $this->request['type'] == 'name_to' )
				{
					if ( ! $this->settings['pmviewer_show_deleted'] )
					{
						/* Run the initial tests to see who passes then refine with respect to invited members (check groups and who is in them as per keyword searches */
						if ( $join_tables == 'n' )
						{
							$this->DB->build( array( 'select' 	=> 'mt_id as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_topics' => 't'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
													 'order' 	=> 't.mt_last_post_time DESC' ) );
						}
						elseif ( $join_tables == 'f' )
						{
							$this->DB->build( array( 'select' 	=> 'mt_id as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_topics' => 't'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
													 'add_join'	=> array(
													 array ('from'  => array('members' => 'f'),
															'where' => 'f.member_id=t.mt_to_member_id',
															'type'	=> 'left' ) ),
													 'order' 	=> 't.mt_last_post_time DESC' ) );
						}
						elseif ( $join_tables == 'm' )
						{
							$this->DB->build( array( 'select' 	=> 'mt_id as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_topics' => 't'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
													 'add_join'	=> array( 
													 array ('from'  => array('members' => 'm'),
															'where' => 'm.member_id=t.mt_starter_id',
															'type'	=> 'left' ) ),
													 'order' 	=> 't.mt_last_post_time DESC' ) );
						}
						else
						{
							$this->DB->build( array( 'select' 	=> 'mt_id as id,mt_invited_members,mt_to_member_id',
													 'from'		=> array('message_topics' => 't'),
													 'where'	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
													 'add_join'	=> array( 
													 array ('from'  => array('members' => 'm'),
															'where' => 'm.member_id=t.mt_starter_id',
															'type'	=> 'left' ),
													 array ('from'  => array('members' => 'f'),
															'where' => 'f.member_id=t.mt_to_member_id',
															'type'	=> 'left' ) ),
													 'order' 	=> 't.mt_last_post_time DESC' ) );
						}
							
						$this->DB->execute();
						while( $d = $this->DB->fetch() )
						{
							$uninvite			= 0;
							$invited[$d['id']] 	= unserialize($d['mt_invited_members']);
							
							if ( $this->request['type'] == 'name_to' )
							{
								if ( is_numeric($this->request['string']) )
								{
									$id = $this->request['string'];
								
									if ( $this->request['match'] == 'loose' )
									{
										if ( !preg_match( "/{$id}/", $d['mt_to_member_id'] ) AND !preg_match( "/{$id}/", implode( ',', $invited[$d['id']] ) ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $id != $d['mt_to_member_id'] AND !in_array( $id, $invited[$d['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
								else
								{
									if ( $this->request['match'] == 'loose' )
									{
										if ( !in_array( $d['mt_to_member_id'], $ids ) AND !array_intersect( $ids, $invited[$d['id']] ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $r['member_id'] != $d['mt_to_member_id'] AND !in_array( $r['member_id'], $invited[$d['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
							}
							
							if ( !$uninvite )
							{
								$inviteList	= array_merge( $inviteList, $invited[$d['id']] );
								$inviteList	= array_unique( $inviteList );
								
								$valid[] = $d['id'];
								$valid = array_filter($valid);
							}
							else
							{
								unset($invited[$d['id']]);
							}
						}
					}
					else
					{
						$this->DB->allow_sub_select = 1;
						
						if ( $join_tables == 'n' )
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_topics t
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_topics t
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												ORDER BY mt_last_post_time DESC" );
						}
						elseif ( $join_tables == 'f' )
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_topics t
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_topics t
													LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												ORDER BY mt_last_post_time DESC" );
						}
						elseif ( $join_tables == 'm' )
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_topics t
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_topics t
													LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												ORDER BY mt_last_post_time DESC" );
						}
						else
						{
							$this->DB->query(  "SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
												FROM {$dbpre}message_topics t
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												UNION
													SELECT t.mt_id as id,t.mt_invited_members,t.mt_to_member_id,t.mt_last_post_time
													FROM {$dbpre}pmviewer_message_topics t
													LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
													LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
													WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
												ORDER BY mt_last_post_time DESC" );
						}
						
						while( $de = $this->DB->fetch() )
						{
							$uninvite				= 0;
							$invited[$de['id']] 	= unserialize($de['mt_invited_members']);
							
							if ( $this->request['type'] == 'name_to' )
							{
								if ( is_numeric($this->request['string']) )
								{
									$id = $this->request['string'];
								
									if ( $this->request['match'] == 'loose' )
									{
										if ( !preg_match( "/{$id}/", $de['mt_to_member_id'] ) AND !preg_match( "/{$id}/", implode( ',', $invited[$de['id']] ) ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $id != $de['mt_to_member_id'] AND !in_array( $id, $invited[$de['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
								else
								{
									if ( $this->request['match'] == 'loose' )
									{
										if ( !in_array( $de['mt_to_member_id'], $ids ) AND !array_intersect( $ids, $invited[$de['id']] ) )
										{
											$uninvite	= 1;
										}
									}
									else
									{
										if ( $r['member_id'] != $de['mt_to_member_id'] AND !in_array( $r['member_id'], $invited[$de['id']] ) )
										{
											$uninvite	= 1;
										}
									}
								}
							}
							
							if ( !$uninvite )
							{
								$inviteList	= array_merge( $inviteList, $invited[$de['id']] );
								$inviteList	= array_unique( $inviteList );
								
								$valid[] = $de['id'];
								$valid = array_filter($valid);
							}
							else
							{
								unset($invited[$de['id']]);
							}
							
							$this->DB->allow_sub_select = 0;
						}
					}
					
					/* Check if there is need to actually run through this whole thing */
					if( $this->settings['pmviewer_hide'] != '' )
					{
						if( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] )
						{
							if ( is_array( $inviteList ) AND count( $inviteList ) )
							{
								$this->DB->build( array( 'select' => 'member_id', 'from' => 'members', 'where' => "member_group_id IN ( {$this->settings['pmviewer_hide']} ) AND member_id IN ( ". implode ( ',', $inviteList ) .")" ) );
								$this->DB->execute();
								while( $me = $this->DB->fetch() )
								{
									$remove[] = $me['member_id'];
								}
								
								if( is_array($remove) AND count($remove) )
								{
									foreach( $invited as $topic => $list )
									{
										if( array_intersect( $list, $remove ) )
										{
											$discard[] = $topic;
										}
									}
									
									$valid 		= array_diff( $valid, $discard );
									$valid 		= array_filter($valid);
									$ccnt  		= count($valid);
									$skipcount 	= 1;
									$valid 		= array_slice( $valid, $stc, $cperpage, TRUE );
								}
							}
						}
					}
					if ( !$skipcount )
					{
						$ccnt = count($valid);
					}
				}
				else
				{
					/* Count how many rows we have got */
					if ( $join_tables == 'n' )
					{
						$row = $this->DB->buildAndFetch( array( 'select' => 'count(mt_id) as count',
																'from'	 => array('message_topics' => 't'),
																'where'	 => "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ) );
					}
					elseif ( $join_tables == 'f' )
					{
						$row = $this->DB->buildAndFetch( array( 'select' 	=> 'count(mt_id) as count',
																'from'	 	=> array('message_topics' => 't'),
																'where'	 	=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
																'add_join'	=> array(
																array ( 'from'  => array('members' => 'f'),
																		'where' => 'f.member_id=t.mt_to_member_id',
																		'type'	=> 'left' ) ) ) );
					}
					elseif ( $join_tables == 'm' )
					{
						$row = $this->DB->buildAndFetch( array( 'select' 	=> 'count(mt_id) as count',
																'from'		=> array('message_topics' => 't'),
																'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
																'add_join'	=> array( 
																array ( 'from'  => array('members' => 'm'),
																		'where' => 'm.member_id=t.mt_starter_id',
																		'type'	=> 'left' ) ) ) );
					}
					else
					{
						$row = $this->DB->buildAndFetch( array( 'select' 	=> 'count(mt_id) as count',
																'from'		=> array('message_topics' => 't'),
																'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
																'add_join'	=> array( 
																array ( 'from'  => array('members' => 'm'),
																		'where' => 'm.member_id=t.mt_starter_id',
																		'type'	=> 'left' ),
																array ( 'from'  => array('members' => 'f'),
																		'where' => 'f.member_id=t.mt_to_member_id',
																		'type'	=> 'left' ) ) ) );
					}
					
					/* Now count the deleted tables ones if we can */
					if ( $this->settings['pmviewer_show_deleted'] )
					{
						if ( $join_tables == 'n' )
						{
							$rowd = $this->DB->buildAndFetch( array('select' => 'count(mt_id) as count',
																	'from'	 => array('pmviewer_message_topics' => 't'),
																	'where'	 => "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query ) );
						}
						elseif ( $join_tables == 'f' )
						{
							$rowd = $this->DB->buildAndFetch( array('select' 	=> 'count(mt_id) as count',
																	'from'		=> array('pmviewer_message_topics' => 't'),
																	'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
																	'add_join'	=> array(
																	array ( 'from'  => array('members' => 'f'),
																			'where' => 'f.member_id=t.mt_to_member_id',
																			'type'	=> 'left' ) ) ) );
						}
						elseif ( $join_tables == 'm' )
						{
							$rowd = $this->DB->buildAndFetch( array('select' 	=> 'count(mt_id) as count',
																	'from'		=> array('pmviewer_message_topics' => 't'),
																	'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
																	'add_join'	=> array( 
																	array ( 'from'  => array('members' => 'm'),
																			'where' => 'm.member_id=t.mt_starter_id',
																			'type'	=> 'left' ) ) ) );
						}
						else
						{
							$rowd = $this->DB->buildAndFetch( array('select' 	=> 'count(mt_id) as count',
																	'from'		=> array('pmviewer_message_topics' => 't'),
																	'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ." ". $hide_query ." ". $system_query,
																	'add_join'	=> array( 
																	array ( 'from'  => array('members' => 'm'),
																			'where' => 'm.member_id=t.mt_starter_id',
																			'type'	=> 'left' ),
																	array ( 'from'  => array('members' => 'f'),
																			'where' => 'f.member_id=t.mt_to_member_id',
																			'type'	=> 'left' ) ) ) );
						}
							
						$ccnt = intval( $row['count'] + $rowd['count'] );
					}
					else
					{
						$ccnt = intval( $row['count']);
					}
				}
			}
		}
		
		if ( $ccnt > 0 )
		{
			$group_cache = $this->caches['group_cache'];
			
			if ( ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] ) OR $this->request['type'] == 'name_to' )
			{
				if ( is_array( $valid ) AND count ( $valid ) )
				{
					/* Ensure there aren't too many first */
					$valid = array_slice( $valid, $stc, $cperpage, TRUE );
					$where 	= "t.mt_id IN ( ".implode( ',', $valid ).")";
				}
			}
			
			if ( $post_needed )
			{			
				/* Let's get this party started by getting the conversations  */
				if ( $this->settings['pmviewer_show_deleted'] )
				{			
					if ( ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] AND !$skip_validbuild ) OR $this->request['type'] == 'name_to' )
					{
						$this->DB->allow_sub_select = 1;
						$this->DB->query(  "SELECT t.mt_id,t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'current' as source
											FROM {$dbpre}message_topics t
											LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
											LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
											WHERE {$where}
											UNION
												SELECT t.mt_id,t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'deleted' as source
												FROM {$dbpre}pmviewer_message_topics t
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE {$where}
											ORDER BY mt_last_post_time DESC" );
					}
					else
					{
						$this->DB->allow_sub_select = 1;
						$this->DB->query(  "SELECT DISTINCT(t.mt_id),t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'current' as source
											FROM {$dbpre}message_posts p
											LEFT JOIN {$dbpre}message_topics t ON ( t.mt_id=p.msg_topic_id )
											LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
											LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id ) 
											WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
											UNION
												SELECT DISTINCT(t.mt_id),t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'deleted' as source
												FROM {$dbpre}pmviewer_message_posts p
												LEFT JOIN {$dbpre}pmviewer_message_topics t ON ( t.mt_id=p.msg_topic_id )
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query} {$keyword_query}
											ORDER BY mt_last_post_time DESC
											LIMIT {$stc},{$cperpage}" );
					}
					
					while( $conversation = $this->DB->fetch() )
					{
						$conversation['id'] = $conversation['mt_id'];
						$conversation['count'] = intval( $conversation['mt_to_count'] - 1 );
						$conversation['lastupdated'] = $this->registry->getClass( 'class_localization')->getDate( $conversation['mt_last_post_time'], $format='LONG', $relative='true' );
						$conversation['a_prefix'] = $group_cache[$conversation['a_group']]['prefix'];
						$conversation['a_suffix'] = $group_cache[$conversation['a_group']]['suffix'];
						$conversation['r_prefix'] = $group_cache[$conversation['r_group']]['prefix'];
						$conversation['r_suffix'] = $group_cache[$conversation['r_group']]['suffix'];
						$conversations[] = $conversation;
					}
					
					$this->DB->allow_sub_select = 0;
				}
				else
				{
					if ( ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] AND !$skip_validbuild ) OR $this->request['type'] == 'name_to' )
					{
						$this->DB->build( array('select' => 't.mt_id,t.mt_is_draft,m.member_group_id AS a_group,f.member_group_id AS r_group,m.members_display_name AS author,t.mt_title,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id',
												'from'		=> array('message_topics' => 't'),
												'where'		=> $where,
												'add_join'	=> array( 
												# AUTHOR MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'm'),
														'where'  	=> 'm.member_id=t.mt_starter_id',
														'type'		=> 'left' ),
												# MAIN RECIPIENT MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'f'),
														'where'  	=> 'f.member_id=t.mt_to_member_id',
														'type'		=> 'left' ) ),
												'order' 	=> 't.mt_last_post_time DESC' ) );
					}
					else
					{
						/* Before we do anything work out what topic's we need */					
						$this->DB->build( array('select' => 'DISTINCT(t.mt_id),t.mt_is_draft,m.member_group_id AS a_group,f.member_group_id AS r_group,m.members_display_name AS author,t.mt_title,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id',
												'from'		=> array('message_posts' => 'p'),
												'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ."". $hide_query ."". $system_query ."". $keyword_query,
												'add_join'	=> array( 
												array ( 'from'		=> array('message_topics' => 't'),
														'where'		=> 't.mt_id=p.msg_topic_id',
														'type'		=> 'left' ),
												# AUTHOR MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'm'),
														'where'  	=> 'm.member_id=t.mt_starter_id',
														'type'		=> 'left' ),
												# MAIN RECIPIENT MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'f'),
														'where'  	=> 'f.member_id=t.mt_to_member_id',
														'type'		=> 'left' ) ),
												'order' 	=> 't.mt_last_post_time DESC',
												'limit'		=> array($stc,$cperpage) ) );
					}
											
					$this->DB->execute();
					
					while( $conversation = $this->DB->fetch() )
					{
						$conversation['id'] = $conversation['mt_id'];
						$conversation['count'] = intval( $conversation['mt_to_count'] - 1 );
						$conversation['lastupdated'] = $this->registry->getClass( 'class_localization')->getDate( $conversation['mt_last_post_time'], $format='LONG', $relative='true' );
						$conversation['a_prefix'] = $group_cache[$conversation['a_group']]['prefix'];
						$conversation['a_suffix'] = $group_cache[$conversation['a_group']]['suffix'];
						$conversation['r_prefix'] = $group_cache[$conversation['r_group']]['prefix'];
						$conversation['r_suffix'] = $group_cache[$conversation['r_group']]['suffix'];
						$conversations[] = $conversation;
					}
				}
			}
			else
			{
				/* Let's get this party started by getting the conversations  */
				if ( $this->settings['pmviewer_show_deleted'] )
				{			
					if ( ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] AND !$skip_validbuild ) OR $this->request['type'] == 'name_to' )
					{
						$this->DB->allow_sub_select = 1;
						$this->DB->query(  "SELECT t.mt_id,t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'current' as source
											FROM {$dbpre}message_topics t
											LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
											LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
											WHERE {$where}
											UNION
												SELECT t.mt_id,t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'deleted' as source
												FROM {$dbpre}pmviewer_message_topics t
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE {$where}
											ORDER BY mt_last_post_time DESC" );
					}
					else
					{
						$this->DB->allow_sub_select = 1;
						$this->DB->query(  "SELECT t.mt_id,t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'current' as source
											FROM {$dbpre}message_topics t
											LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
											LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
											WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
											UNION
												SELECT t.mt_id,t.mt_is_draft,m.members_display_name AS author,t.mt_title,m.member_group_id AS a_group,f.member_group_id AS r_group,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id,'deleted' as source
												FROM {$dbpre}pmviewer_message_topics t
												LEFT JOIN {$dbpre}members m ON (m.member_id=t.mt_starter_id )
												LEFT JOIN {$dbpre}members f ON ( f.member_id=t.mt_to_member_id )
												WHERE t.pmviewer_hide = 0 {$dbe} {$show_query} {$hide_query} {$system_query}
											ORDER BY mt_last_post_time DESC
											LIMIT {$stc},{$cperpage}" );
					}
					
					while( $conversation = $this->DB->fetch() )
					{
						$conversation['id'] = $conversation['mt_id'];
						$conversation['count'] = intval( $conversation['mt_to_count'] - 1 );
						$conversation['lastupdated'] = $this->registry->getClass( 'class_localization')->getDate( $conversation['mt_last_post_time'], $format='LONG', $relative='true' );
						$conversation['a_prefix'] = $group_cache[$conversation['a_group']]['prefix'];
						$conversation['a_suffix'] = $group_cache[$conversation['a_group']]['suffix'];
						$conversation['r_prefix'] = $group_cache[$conversation['r_group']]['prefix'];
						$conversation['r_suffix'] = $group_cache[$conversation['r_group']]['suffix'];
						$conversations[] = $conversation;
					}
					
					$this->DB->allow_sub_select = 0;
				}
				else
				{
					if ( ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] AND !$skip_validbuild ) OR $this->request['type'] == 'name_to' )
					{
						$this->DB->build( array('select' => 't.mt_id,t.mt_is_draft,m.member_group_id AS a_group,f.member_group_id AS r_group,m.members_display_name AS author,t.mt_title,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id',
												'from'		=> array('message_topics' => 't'),
												'where'		=> $where,
												'add_join'	=> array( 
												# AUTHOR MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'm'),
														'where'  	=> 'm.member_id=t.mt_starter_id',
														'type'		=> 'left' ),
												# MAIN RECIPIENT MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'f'),
														'where'  	=> 'f.member_id=t.mt_to_member_id',
														'type'		=> 'left' ) ),
												'order' 	=> 't.mt_last_post_time DESC' ) );
					}
					else
					{
						$this->DB->build( array('select' => 't.mt_id,t.mt_is_draft,m.member_group_id AS a_group,f.member_group_id AS r_group,m.members_display_name AS author,t.mt_title,f.members_display_name AS recipient,t.mt_to_member_id,t.mt_replies,t.mt_last_post_time,t.mt_starter_id,t.mt_to_count,t.mt_last_msg_id',
												'from'		=> array('message_topics' => 't'),
												'where'		=> "t.pmviewer_hide = 0 ". $dbe ." ". $show_query ."". $hide_query ."". $system_query,
												'add_join'	=> array( 
												# AUTHOR MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'm'),
														'where'  	=> 'm.member_id=t.mt_starter_id',
														'type'		=> 'left' ),
												# MAIN RECIPIENT MEMBER TABLE JOIN
												array ( 'from'   	=> array('members' => 'f'),
														'where'  	=> 'f.member_id=t.mt_to_member_id',
														'type'		=> 'left' ) ),
												'order' 	=> 't.mt_last_post_time DESC',
												'limit'		=> array($stc,$cperpage)
						) );
					}
											
					$this->DB->execute();
					
					while( $conversation = $this->DB->fetch() )
					{
						$conversation['id'] 		= $conversation['mt_id'];
						$conversation['count'] 		= intval( $conversation['mt_to_count'] - 1 );
						$conversation['lastupdated']= $this->registry->getClass( 'class_localization')->getDate( $conversation['mt_last_post_time'], $format='LONG', $relative='true' );
						$conversation['a_prefix'] 	= $group_cache[$conversation['a_group']]['prefix'];
						$conversation['a_suffix'] 	= $group_cache[$conversation['a_group']]['suffix'];
						$conversation['r_prefix'] 	= $group_cache[$conversation['r_group']]['prefix'];
						$conversation['r_suffix'] 	= $group_cache[$conversation['r_group']]['suffix'];
						$conversations[] 			= $conversation;
					}
				}
			}
		}
		
		/* Create the pages */
		$clinks = $this->registry->output->generatePagination( array( 'totalItems'        => $ccnt,
																	  'itemsPerPage'      => $cperpage,
																	  'currentStartValue' => $stc,
																	  'baseUrl'           => "{$this->settings['base_url']}app=pmviewer&amp;{$this->form_code}&do=viewconversations" . $url,
																	)	   );
																	
		/* Get hooks file for update check */
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'core' ) . '/modules_admin/applications/hooks.php', 'admin_core_applications_hooks' );
		$hooksClass = new $classToLoad();
		$hooksClass->makeRegistryShortcuts( $this->registry );

		$pmviewer_details = $this->caches['app_cache']['pmviewer'];

		$return = $hooksClass->_updateAvailable( $pmviewer_details['app_update_check'], $pmviewer_details['app_long_version'] );

		if ( $return[0] == 1 )
		{
			//Temporarily disable download point until we know the url of the file
			//$download_point = urlencode($pmviewer_details['app_website']);
			$link = '<a href="'.$pmviewer_details['app_update_check'].'download=1&boardVersion='.IPB_LONG_VERSION.'&link=32IPS">';
			$update_link = sprintf( $this->lang->words['pm_new_update_text'], $link );
			$this->registry->output->setMessage( '<span style="font-weight:bold;font-size:14px">'.$this->lang->words['pm_new_update'].'</span><br />'.$update_link.'</a>', 1 );
		}
		
		/* Build the table */
		$this->registry->output->html .= $this->html->list_conversations( $conversations, $clinks );
		
		/* Copyright */
		$this->registry->output->html .= $this->html->copyright();
	}
	
	/**
	 * View the individual conversations and the messages they are made up of
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function viewTopic()
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		/* INIT */
		$messages       	= array();
		$members        	= array();
		$membersdata		= array();
		$tperpage  			= 10;
		$stt		   		= intval($this->request['st']) >=0 ? intval($this->request['st']) : 0;
		$stp		   		= intval($this->request['st']) >=0 ? intval($this->request['st']) : 0;
		$conversationid 	= intval($this->request['id']);
		$viewLast			= intval($this->request['viewLast']) == 1 ? 1 : 0;
		$topic_table		= 'message_topics';
		$map_table			= 'message_topic_user_map';
		$post_table			= 'message_posts';
		$deleted_posts		= 0;
		$dbpre   			= ips_DBRegistry::getPrefix();
		$group_cache 		= $this->caches['group_cache'];
		
		if ( !$conversationid )
		{
			$this->registry->output->global_message = $this->lang->words['no_topics_with_id'];
			$this->overview();
			return;
		}
		
		/* So where are we coming from? */
		$real = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => 'mt_id = '. $conversationid ) );
		
		if ( ! $real['mt_id'] )
		{
			$unreal = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_topics', 'where' => 'mt_id = '. $conversationid ) );
			
			if ( ! $unreal['mt_id'] )
			{
				$this->registry->output->global_message = $this->lang->words['no_topics_with_id'];
				$this->overview();
				return;
			}
			
			/* Check we haven't enabled it so we shouldn't see deleted ones */
			if ( ! $this->settings['pmviewer_show_deleted'] )
			{
				$this->registry->output->global_message = $this->lang->words['no_topics_with_id'];
				$this->overview();
				return;
			}
			
			$topic_table	= 'pmviewer_message_topics';
			$map_table		= 'pmviewer_message_topic_user_map';
			$post_table		= 'pmviewer_message_posts';
		}
		
		if ( $real['pmviewer_hide'] == 1 OR $unreal['pmviewer_hide'] == 1 )
		{
			$this->registry->output->global_message = $this->lang->words['pm_hidden'];
			$this->overview();
			return;
		}
		
		if ( $post_table == 'message_posts' )
		{
			/* Check our permissions */
			if ( ! $this->_conversationPerms( $real, false ) )
			{
				/* Deleted member bug - fixed? I think so... */
				$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
			}
		}
		else
		{
			/* Check our permissions */
			if ( ! $this->_conversationPerms( $unreal, false ) )
			{
				$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
			}
		}
		
		$t = $this->DB->buildAndFetch( array( 'select' => 'COUNT(*) as count', 'from' => $post_table, 'where' => 'msg_topic_id = '.$conversationid ) );
		
		/* If we are looking at an existing topic see if we have any deleted posts if we want to see them */
		if ( $this->settings['pmviewer_show_deleted'] )
		{
			if ( $post_table == 'message_posts' )
			{
				$td = $this->DB->buildAndFetch( array( 'select' => 'COUNT(*) as count', 'from' => 'pmviewer_message_posts', 'where' => 'msg_topic_id = '.$conversationid ) );
				
				if ( $td['count'] > 0 )
				{
					$deleted_posts = 1;
				}
			}
		}
		
		$tcnt = intval( $t['count'] + $td['count'] );
		
		/* Build the pages again */
		$tlinks = $this->registry->output->generatePagination( array('totalItems'        => $tcnt,
																	 'itemsPerPage'      => $tperpage,
																	 'currentStartValue' => $stt,
																	 'baseUrl'           => "{$this->settings['base_url']}app=pmviewer&amp;{$this->form_code}&do=viewTopic&id={$conversationid}",
																				)	   );
																				
		if ( $viewLast )
		{
			/* So which is the last page? */
			$lastPage = intval(ceil($tcnt/$tperpage));
			
			/* So where do we now need to start? - let's override the value of the pagination */
			$stt = intval(( $lastPage * $tperpage ) - $tperpage );
			
			/* Okay so now lets redo the page links */
			$tlinks = $this->registry->output->generatePagination( array('totalItems'    => $tcnt,
																	 'itemsPerPage'      => $tperpage,
																	 'currentStartValue' => $stt,
																	 'baseUrl'           => "{$this->settings['base_url']}app=pmviewer&amp;{$this->form_code}&do=viewTopic&id={$conversationid}",
																				)	   );
		}
																				
		/* So what's the title of this conversation? */
		if ( $real['mt_id'] )
		{
			$row['mt_id'] = $real['mt_id'];
			$row['mt_title'] = $real['mt_title'];
			$row['mt_first_msg_id'] = $real['mt_first_msg_id'];
			$row['mt_hasattach'] = $real['mt_hasattach'];
			$row['mt_is_system'] = $real['mt_is_system'];
			$row['mt_is_draft'] = $real['mt_is_draft'];
			$row['mt_starter_id'] = $real['mt_starter_id'];
			$row['mt_to_member_id'] = $real['mt_to_member_id'];
			$member = $real;
		}
		else
		{
			$row['mt_id'] = $unreal['mt_id'];
			$row['mt_title'] = $unreal['mt_title'];
			$row['mt_first_msg_id'] = $unreal['mt_first_msg_id'];
			$row['mt_hasattach'] = 0;
			$row['mt_is_system'] = $unreal['mt_is_system'];
			$row['mt_is_draft'] = $unreal['mt_is_draft'];
			$row['mt_starter_id'] = $unreal['mt_starter_id'];
			$row['mt_to_member_id'] = $unreal['mt_to_member_id'];
			$member = $unreal;
		}
		
		if ( $post_table == 'message_posts' )
		{
			$row['deleted'] = 0;
		}
		else
		{
			$row['deleted'] = 1;
		}
		
		/* Grab the posts! */
		if ( ! $this->settings['pmviewer_show_deleted'] )
		{
			$this->DB->build( array('select'	=> 'p.msg_id,p.msg_date,p.msg_post',
									'from'	 	=> array($post_table => 'p'),
									'add_join' 	=> array( 
									# MEMBER TABLE JOIN
									array ( 'select'	=> 'm.member_id,m.members_display_name,m.title,m.posts,m.warn_level,m.member_group_id,m.mgroup_others',
											'from'  	=> array('members' => 'm'),
											'where' 	=> 'm.member_id=p.msg_author_id',
											'type'  	=> 'left'),
									# PROFILE PORTAL JOIN
									array ( 'select'	=> 'pp.signature,pp.pp_main_photo,pp.pp_thumb_photo',
											'from'		=> array('profile_portal' => 'pp'),
											'where'		=> 'p.msg_author_id=pp.pp_member_id',
											'type'		=> 'left') ), 
									'where' 	=> 'p.msg_topic_id = '.$conversationid,
									'order'		=> 'p.msg_id ASC',
									'limit'		=> array($stt,$tperpage)
									) );
			$outer = $this->DB->execute();
			
			while( $message = $this->DB->fetch($outer) )
			{
				if ( !$message['members_display_name'] )
				{
					$message['members_display_name'] 	= $this->settings['guest_name_pre'] . $this->lang->words['pm_deleted_member'] . $this->settings['guest_name_suf'];
					$message['member_id'] 			 	= 0;
				}
				else
				{
					$message = IPSMember::buildDisplayData( $message, array( 'signature' => 1, 'warn' => 1, 'customFields' => 0, 'reputation' => 0 ) );
					echo "<pre>";
					//print_r($message);
					echo "</pre>";
				}
				
				$message['member_rank_img'] = str_replace( "{style_image_url}", $this->settings['img_url'], $message['member_rank_img'] );
				
				$message['date'] = $this->registry->getClass( 'class_localization')->getDate( $message['msg_date'], 'LONG', 1 );
				$message['joined'] = $this->registry->getClass( 'class_localization')->getDate( $message['joined'], 'JOINED', 1);
				$message['prefix'] = $group_cache[$message['member_group_id']]['prefix'];
				$message['suffix'] = $group_cache[$message['member_group_id']]['suffix'];
				$message['g_title'] = $group_cache[$message['member_group_id']]['g_title'];
				
				/* Parse the message contents */
				if (  $this->settings['msg_allow_html'] > 0 )
				{
					IPSText::getTextClass( 'bbcode' )->parse_html				= 1;
					IPSText::getTextClass( 'bbcode' )->parse_nl2br				= 1;
				}
				else
				{
					IPSText::getTextClass( 'bbcode' )->parse_html				= 0;
					IPSText::getTextClass( 'bbcode' )->parse_nl2br				= 0;
				}
				


				IPSText::getTextClass( 'bbcode' )->parse_bbcode				= 1;



				IPSText::getTextClass( 'bbcode ')->parse_smilies			= 1;

				IPSText::getTextClass( 'bbcode' )->parsing_section			= 'pms';
				IPSText::getTextClass( 'bbcode' )->parsing_mgroup			= $message['member_group_id'];
				IPSText::getTextClass( 'bbcode' )->parsing_mgroup_others	= $message['mgroup_others'];
				$message['msg_post']	= IPSText::getTextClass( 'bbcode' )->preDisplayParse( $message['msg_post'] );
				
				$messages[$message['msg_id']] = $message;
			}
		}
		else
		{
			$this->DB->allow_sub_select = 1;
			$outer = $this->DB->query( "SELECT p.msg_id,p.msg_date,p.msg_post,pp.signature,m.member_id,m.members_display_name,m.title,m.posts,m.warn_level,m.member_group_id,m.mgroup_others,'current' as source FROM {$dbpre}message_posts p LEFT JOIN {$dbpre}members m ON (m.member_id=p.msg_author_id) LEFT JOIN {$dbpre}profile_portal pp ON (p.msg_author_id=pp.pp_member_id) WHERE p.msg_topic_id = {$conversationid} UNION SELECT p.msg_id,p.msg_date,p.msg_post,pp.signature,m.member_id,m.members_display_name,m.title,m.posts,m.warn_level,m.member_group_id,m.mgroup_others,'deleted' as source FROM {$dbpre}pmviewer_message_posts p LEFT JOIN {$dbpre}members m ON (m.member_id=p.msg_author_id) LEFT JOIN {$dbpre}profile_portal pp ON (p.msg_author_id=pp.pp_member_id) WHERE p.msg_topic_id = {$conversationid} ORDER BY msg_id ASC LIMIT {$stt},{$tperpage}" );
			
			while( $message = $this->DB->fetch($outer) )
			{
				if ( !$message['members_display_name'] )
				{
					$message['members_display_name'] 	= $this->settings['guest_name_pre'] . $this->lang->words['pm_deleted_member'] . $this->settings['guest_name_suf'];
					$message['member_id'] 			 	= 0;
				}
				else
				{
					$message = IPSMember::buildDisplayData( $message, array( 'signature' => 1, 'warn' => 1, 'customFields' => 0, 'reputation' => 0 ) );
				}
				
				$message['date'] = $this->registry->getClass( 'class_localization')->getDate( $message['msg_date'], 'LONG', 1 );
				$message['joined'] = $this->registry->getClass( 'class_localization')->getDate( $message['joined'], 'JOINED', 1);
				$message['prefix'] = $group_cache[$message['member_group_id']]['prefix'];
				$message['suffix'] = $group_cache[$message['member_group_id']]['suffix'];
				$message['g_title'] = $group_cache[$message['member_group_id']]['g_title'];
				
				/* Parse the message contents */
				if (  $this->settings['msg_allow_html'] > 0 )
				{
					IPSText::getTextClass( 'bbcode' )->parse_html				= 1;
					IPSText::getTextClass( 'bbcode' )->parse_nl2br				= 1;
				}
				else
				{
					IPSText::getTextClass( 'bbcode' )->parse_html				= 0;
					IPSText::getTextClass( 'bbcode' )->parse_nl2br				= 0;
				}
				


				IPSText::getTextClass( 'bbcode' )->parse_bbcode				= 1;



				IPSText::getTextClass( 'bbcode ')->parse_smilies			= 1;

				IPSText::getTextClass( 'bbcode' )->parsing_section			= 'pms';
				IPSText::getTextClass( 'bbcode' )->parsing_mgroup			= $message['member_group_id'];
				IPSText::getTextClass( 'bbcode' )->parsing_mgroup_others	= $message['mgroup_others'];
				$message['msg_post']	= IPSText::getTextClass( 'bbcode' )->preDisplayParse( $message['msg_post'] );
				
				$messages[$message['msg_id']] = $message;
			}
			
			$this->DB->allow_sub_select = 0;
		}
		
		if ( $row['mt_hasattach'] > 0 )
		{
			$postHTML = array();

			foreach( $messages as $id => $post )
			{
				$postHTML[ $id ] = $post['msg_post'];
			}
			
			if ( ! is_object( $this->class_attach_pm ) )
			{
				$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'pmviewer' ) . '/sources/attach/class_attach.php', 'class_attach_pm' );
				$this->class_attach_pm = new $classToLoad( $this->registry );
			}
		
			$this->class_attach_pm->type  = 'pmviewer';
			$this->class_attach_pm->init();
		
			$attachHTML = $this->class_attach_pm->renderAttachments( $postHTML );
			
			/* Now parse back in the rendered posts */
			foreach( $attachHTML as $id => $data )
			{
				/* Get rid of any lingering attachment tags */
				if ( stristr( $data['html'], "[attachment=" ) )
				{
					$data['html'] = IPSText::stripAttachTag( $data['html'] );
				}
				
				$messages[ $id ]['msg_post']       = $data['html'];
				$messages[ $id ]['attachmentHtml'] = $data['attachmentHtml'];
			}
		}
		
		/* Right, lets open up our array of who can see this message the 'right' way and plug each value into a new array, but only if there are invited members! */
		$member['invitedMembers'] = unserialize($member['mt_invited_members']);
		if ( is_array( $member['invitedMembers'] ) AND count( $member['invitedMembers'] ) )
		{
			foreach ( $member['invitedMembers'] as $_invitedMid )
			{
				$member['participants'][ $_invitedMid ] = $_invitedMid;
			}
		}
		/* Not forgetting to add the starter and the primary recipient to our new array */
		$member['participants'][ "_start" ] = $member['mt_starter_id'];
		$member['participants'][ "_main" ] = $member['mt_to_member_id'];
		/* Lets see what we can dig up about these members then */
		if ( is_array( $member['participants'] ) AND count( $member['participants'] ) )
		{
			$this->DB->build( array('select'	=> 'm.members_display_name,member_group_id,mgroup_others,member_id,m.members_disable_pm',
									'from'		=> array('members' => 'm'),
									'where'		=> 'm.member_id IN ('. implode( ',', $member['participants'] ) .')',
									'order'		=> 'm.member_id',
									'add_join'  => array( 
									# MEMBER TABLE JOIN
									array ( 'select' => 't.map_user_id,t.map_user_banned,t.map_user_active,t.map_is_starter,t.map_read_time',
											'from'   => array($map_table => 't'),
											'where'  => "t.map_user_id =m.member_id AND t.map_topic_id = ".$conversationid,
											'type'   => 'left') ) ) );
			$this->DB->execute();
			
			while( $memberdata = $this->DB->fetch() )
			{
				$memberdata['map_read_time'] = $this->registry->getClass( 'class_localization')->getDate( $memberdata['map_read_time'], $format='LONG', $relative='true' );
				$memberdata['prefix'] = $group_cache[$memberdata['member_group_id']]['prefix'];
				$memberdata['suffix'] = $group_cache[$memberdata['member_group_id']]['suffix'];
				
				if ( IPSMember::isIgnorable( $memberdata['member_group_id'], $memberdata['mgroup_others'], 'pm' ) !== TRUE )
				{
					$memberdata['blockable'] = 0;
				}
				else
				{
					$memberdata['blockable'] = 1;
				}
				if ( $memberdata['members_disable_pm'] )
				{
					$memberdata['map_user_active'] = 0;
				}
				$membersdata[] = $memberdata;
			}
			
		}
		
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form_code . '&amp;do=viewTopic&amp;id=' . $conversationid, $row['mt_title'] );
		
		/* Build the table */
		$this->registry->output->html .= $this->html->list_topics( $messages, $tlinks, $plinks, $row, $membersdata );
		
		/* Copyright */
		$this->registry->output->html .= $this->html->copyright();
	}
	
	/**
	 * Unblock/Block user
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function blockUser()
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		$tid = intval( $this->request['tid'] );
		$mid = intval( $this->request['mid'] );
		$block = intval( $this->request['block'] );
		
		if ( ! $tid )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_topic_id_block'] );
		}
		if ( ! $mid )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_member_id_block'] );
		}
		
		$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => 'mt_id = '. $tid ) );
		
		if ( ! $topic['mt_id'] )
		{
			$this->registry->output->showError( $this->lang->words['no_topics_with_id'] );
		}
		
		if ( $topic['mt_starter_id'] == $mid )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_block_starter'] );
		}
		
		/* Check our permissions */
		if ( ! $this->_conversationPerms( $topic, true ) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
		}
		
		require_once( IPSLib::getAppDir( 'members' ) . '/sources/classes/messaging/messengerFunctions.php' );
				$messengerFunctions = new messengerFunctions( $this->registry );
				
		$currentParticipants = $messengerFunctions->fetchTopicParticipants( $tid );
		if ( ! isset( $currentParticipants[ $mid ] ) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_member_block'] );
		}
		
		$member = $this->DB->buildAndFetch( array( 'select' => 'member_group_id,mgroup_others', 'from' => 'members', 'where' => 'member_id = '. $mid ) );
		
		if ( IPSMember::isIgnorable( $member['member_group_id'], $member['mgroup_others'], 'pm' ) !== TRUE )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_block_member'] );
		}
		
		if ( $block == 1 )
		{
			$this->DB->update( 'message_topic_user_map', array( 'map_user_active' => 0, 'map_user_banned' => 1 ), 'map_user_id=' . $mid . ' AND map_topic_id=' . $tid . ' AND map_user_active=1' );
		}
		else
		{
			$this->DB->update( 'message_topic_user_map', array( 'map_user_active' => 1, 'map_user_banned' => 0 ), 'map_user_id=' . $mid . ' AND map_topic_id=' . $tid . ' AND map_user_banned=1' );
		}
		
		$this->DB->build( array( 'select' => 'count(*) as count', 'from' => 'message_topic_user_map', 'where' => 'map_user_banned = 0 AND map_is_starter = 0 AND map_user_active = 1 AND map_topic_id = '. $tid ) );
		$this->DB->execute();
		while( $count = $this->DB->fetch() )
		{
			$this->DB->update( 'message_topics', array( 'mt_to_count' => intval($count['count']) ), 'mt_id='. $tid );
		}
				
		$messengerFunctions->resetMembersNewTopicCount( $mid );
		$messengerFunctions->resetMembersTotalTopicCount( $mid );
		$messengerFunctions->resetMembersFolderCounts( $mid );
		
		$this->registry->output->global_message = $this->lang->words['pm_block_complete'];
		
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->form_code . '&do=viewTopic&id=' . $tid );
	}
	
	/**
	 * Hide the conversations
	 *
	 * @access	private
	 * @param	string		[single|selected|all]
	 * @return	void		[Outputs to screen]
	 */
	private function hide_Topic( $type='selected' )
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		if ( $type == 'all' )
		{
			$this->DB->update( 'message_topics', array( 'pmviewer_hide' => '1' ) );
			$this->DB->update( 'pmviewer_message_topics', array( 'pmviewer_hide' => '1' ) );
			
			$this->registry->output->global_message = $this->lang->words['pm_all_hidden'];
		
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url']."&{$this->form_code}" );
		}
		else if ( $type == 'single' )
		{
			$id = intval($this->request['id']);
			
			$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => "mt_id={$id}" ) );
			if ( ! $topic['mt_id'] )
			{
				$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_topics', 'where' => "mt_id={$id}" ) );
			}
			
			if ( ! $topic['mt_id'] )
			{
				$this->registry->output->showError( $this->lang->words['pm_no_topic_id_block'] );
			}
			
			/* Check our permissions */
			if ( ! $this->_conversationPerms( $topic, true ) )
			{
				$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
			}
			
			$this->DB->update( 'message_topics', array( 'pmviewer_hide' => '1' ),  "mt_id = {$topic['mt_id']}" );
			$this->DB->update( 'pmviewer_message_topics', array( 'pmviewer_hide' => '1' ),  "mt_id = {$topic['mt_id']}" );
			
			$this->registry->output->global_message = $this->lang->words['pm_convo_hidden'];
		
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url']."&{$this->form_code}" );
		}
		else
		{
			$ids = array();
			
			foreach ( $this->request as $k => $v )
			{
				if ( preg_match( "/^id_(\d+)$/", $k, $match ) )
				{
					if ($this->request[  $match[0] ] )
					{
						$ids[] = $match[1];
					}
				}
			}
		
			$ids = IPSLib::cleanIntArray( $ids );
						
			if ( ! count($ids) )
			{
				$this->registry->output->showError( $this->lang->words['pm_no_boxes'] );
			}
			
			/* Check our permissions */
			$permedTopics = $this->_conversationArrayPerms( $ids, false );
			if ( $permedTopics === FALSE )
			{
				$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
			}
			
			$this->DB->update( 'message_topics', array( 'pmviewer_hide' => '1' ),  "mt_id IN (" . implode( ',', $permedTopics ) . ")" );
			$this->DB->update( 'pmviewer_message_topics', array( 'pmviewer_hide' => '1' ),  "mt_id IN (" . implode( ',', $permedTopics ) . ")" );
			
			$this->registry->output->global_message = $this->lang->words['pm_select_hidden'];
		
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url']."&{$this->form_code}" );
		}
	}
	
	/**
	 * Delete the conversations
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function delete_Topic()
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		$ids = array();
		$members = array();
			
		foreach ( $this->request as $k => $v )
		{
			if ( preg_match( "/^id_(\d+)$/", $k, $match ) )
			{
				if ($this->request[  $match[0] ] )
				{
					$ids[] = $match[1];
				}
			}
		}
		
		if ( ! count($ids) )
		{
			$ID = intval($this->request['id']);
			$ids[] = $ID;
		}
	
		if ( ! count($ids) OR ! is_array($ids) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_to_delete'] );
		}
		
		/* Check our permissions */
		$permedTopics = $this->_conversationArrayPerms( $ids, false );
		if ( $permedTopics === FALSE )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
		}
		
		$idString = implode( ',', IPSLib::cleanIntArray( $permedTopics ) );
		
		/* Work out who are casulties */
		$this->DB->build( array( 'select' => 'map_user_id',
								 'from'   => 'message_topic_user_map',
								 'where'  => 'map_topic_id IN(' . $idString . ')' ) );
								
		$this->DB->execute();
		
		while( $row = $this->DB->fetch() )
		{	
			$members[ $row['map_user_id'] ] = $row['map_user_id'];
		}
				
		/* Log the copy if we can */
		if ( $this->settings['pmviewer_deleted_log'] )
		{
			/* Work out which of our topics need to be deleted from the logging tables */
			$this->DB->build( array( 'select' => 'mt_id', 'from' => 'pmviewer_message_topics', 'where' => 'mt_id IN ('. $idString . ')' ) );
			$result = $this->DB->execute();
			while( $dead_topics = $this->DB->fetch($result) )
			{
				$deadTopics[] = $dead_topics['mt_id'];
			}
			$this->DB->build( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'mt_id IN ('. $idString . ')' ) );
			$dying = $this->DB->execute();
			while( $dying_topics = $this->DB->fetch($dying) )
			{
				$dyingTopics[] = $dying_topics['mt_id'];
			}
			
			if( is_array( $dyingTopics ) AND is_array( $deadTopics ) and count( $dyingTopics ) AND count( $deadTopics ) )
			{
				$actuallyDead = array_diff($deadTopics,$dyingTopics);
			}
			else
			{
				$actuallyDead = $deadTopics;
			}
			
			if ( is_array( $actuallyDead ) AND count ( $actuallyDead ) )
			{
				$idStringDead = implode( ',', $actuallyDead );
				$deleted = 1;
			}
			
			require_once( IPSLib::getAppDir( 'pmviewer' ) . '/sources/messageLogging.php' );
				$messageLogging = new messageLogging( $this->registry );
			
			$messageLogging->logTopics( 'string', $idString );
		}
 		
		/* Delete Topics */
		$this->DB->delete( 'message_topics', 'mt_id IN ('. $idString . ')' );
		if ( $deleted )
		{
			$this->DB->delete( 'pmviewer_message_topics', 'mt_id IN ('. $idStringDead . ')' );
		}
		
		/* Delete Posts */
		$this->DB->delete( 'message_posts', 'msg_topic_id IN ('. $idString . ')' );
		if ( $deleted )
		{
			$this->DB->delete( 'pmviewer_message_posts', 'msg_topic_id IN ('. $idStringDead . ')' );
		}
		
		/* Delete mappings */
		$this->DB->delete( 'message_topic_user_map', 'map_topic_id IN ('. $idString . ')' );
		if ( $deleted )
		{
			$this->DB->delete( 'pmviewer_message_topic_user_map', 'map_topic_id IN ('. $idStringDead . ')' );
		}
			
		$idsForAttachments	= array();
 			
	 	$this->DB->build( array( 'select' => 'msg_id',
								 'from'   => 'message_posts',
								 'where'  => 'msg_topic_id IN ('. $idString . ')'
						)		);
	 	$this->DB->execute();
	 	
	 	while( $r = $this->DB->fetch() )
	 	{
	 		$idsForAttachments[]	= $r['msg_id'];
	 	}
		
  		/* Delete attachments */

		require_once( IPSLib::getAppDir( 'core' ) . '/sources/classes/attach/class_attach.php' );
		$class_attach                  =  new class_attach( $this->registry );
		$class_attach->type            =  'msg';
		$class_attach->init();
		$class_attach->bulkRemoveAttachment( $idsForAttachments );
		
		/* Flag the people for a reset */
		if ( count( $members ) )
		{
			$this->DB->update( 'members', array( 'msg_count_reset' => 1 ), 'member_id IN (' . implode( ',', array_keys( $members ) ) . ')' );
		}
		
		$this->registry->output->global_message = $this->lang->words['pm_deleted_convos'];
		
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url']."&{$this->form_code}" );
	}
	
	/**
	 * Displays the edit form for a post
	 *
	 *
	 * @access	private
	 * @param	string		Error to display
	 * @return
	 */
	private function editPost_form( $error='', $msgID=0, $stID=0 )
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		if ( intval( $this->request['id'] ) )
		{
			$msgID = intval( $this->request['id'] );
		}
		
		if ( intval ( $this->requst['stID'] ) )
		{
			$stID = ( $this->request['stID'] ) ? intval( $this->request['stID'] ) : 0;
		}
		
		if ( ! $msgID OR $msgID < 1 )
		{
			$this->registry->output->showError( $this->lang->words['not_valid_post_id'] );
		}
		
		//Need to make it so that this can work with deleted topics/posts too...
		$post = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_posts', 'where' => 'msg_id = '. $msgID ) );
				
		if ( ! $post['msg_topic_id'] )
		{
			/* So the post doesn't exist in the real world... has it been deleted? */
			$post = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_posts', 'where' => 'msg_id = '. $msgID ) );
			
			if ( ! $post['msg_topic_id'] )
			{
				$this->registry->output->showError( $this->lang->words['no_topics_with_id'] );
			}
			else
			{
				/* See if our topic it comes from has been deleted too */
				$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => 'mt_id = '. $post['msg_topic_id'] ) );
				
				if ( !$topic['mt_id'] )
				{
					$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_topics', 'where' => 'mt_id = '. $post['msg_topic_id'] ) );
				}
			}
		}
		else
		{
			$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => 'mt_id = '. $post['msg_topic_id'] ) );
		}
		
		if ( ! $topic['mt_id'] )
		{
			$this->registry->output->showError( $this->lang->words['no_topics_with_id'] );
		}
		
		/* Check our permissions */
		if ( ! $this->_messagePerms( $post, $topic, true ) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
		}
		
		$post['msg_post'] = IPSText::raw2form( $post['msg_post'] );
		
		if ( IPSText::getTextClass('editor')->method == 'rte' )
		{
			IPSText::getTextClass('bbcode')->parse_wordwrap	= 0;
			IPSText::getTextClass('bbcode')->parse_html		= 0;

			$value = IPSText::getTextClass('bbcode')->convertForRTE( $post['msg_post'] );
			
			/* Reset post key */
			$this->_postKey = $post['msg_post_key'];
		}
		else
		{
			IPSText::getTextClass('bbcode')->parse_html		= $this->settings['msg_allow_html'];
			IPSText::getTextClass('bbcode')->parse_nl2br	= 1;
			IPSText::getTextClass('bbcode')->parse_smilies	= 1;
			IPSText::getTextClass('bbcode')->parse_bbcode	= $this->settings['msg_allow_code'];
			IPSText::getTextClass('bbcode')->parsing_section = 'pms';

			$value = IPSText::getTextClass('bbcode')->preEditParse( $post['msg_post'] );
		}

		$form_element = IPSText::getTextClass('editor')->showEditor( $value, 'msgContent' );
		
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form_code . '&amp;do=viewTopic&amp;id=' . $topic['mt_id'] . '&amp;st=' . $stID . '#msg' . $msgID, $topic['mt_title'] );
		
		/* Build the table */
		$this->registry->output->html .= $this->html->editPostForm($post,$form_element,$stID,$error);
		
		/* Copyright */
		$this->registry->output->html .= $this->html->copyright();
	}
	
	/**
	 * Saves the edit for the post
	 *
	 *
	 * @access	private
	 * @return
	 */
	private function editPost_save()
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		$msgID 		= intval( $this->request['msgID'] );
		$msgContent = $_POST['msgContent'];
		$stID 		= ( $this->request['stID'] ) ? intval( $this->request['stID'] ) : 0;
		
		if ( !$msgID OR $msgID < 1 )
		{
			$this->registry->output->showError( $this->lang->words['not_valid_post_id'] );
		}
		
		$post = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_posts', 'where' => 'msg_id = '. $msgID ) );
		
		if ( $post['msg_topic_id'] )
		{
			$deleted = 0;
			$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => 'mt_id = '. $post['msg_topic_id'] ) );
		}
		else
		{
			$post = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_posts', 'where' => 'msg_id = '. $msgID ) );
			
			if ( $post['msg_topic_id'] )
			{
				$deleted = 1;
				$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => 'mt_id = '. $post['msg_topic_id'] ) );
				
				if ( ! $topic['mt_id'] )
				{
					$topic = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_topics', 'where' => 'mt_id = '. $post['msg_topic_id'] ) );
					
					if ( ! $topic['mt_id'] )
					{
						$this->registry->output->showError( $this->lang->words['no_topics_with_id'] );
					}
				}
			}
			else
			{
				$this->registry->output->showError( $this->lang->words['not_valid_post_id'] );
			}
		}
		
		/* Check our permissions */
		if ( ! $this->_messagePerms( $post, $topic, true ) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
		}
		
		if ( IPSText::mbstrlen( trim( IPSText::br2nl( $_POST['msgContent'] ) ) ) < 2 )
 		{
 			return $this->editPost_form( $this->lang->words['pm_msg_too_short'], $msgID, $stID );
		}
		
		$msgContent = IPSText::getTextClass( 'editor' )->processRawPost( $msgContent );
		
		IPSText::getTextClass('bbcode')->parse_smilies	 = 1;
 		IPSText::getTextClass('bbcode')->parse_nl2br   	 = 1;
 		IPSText::getTextClass('bbcode')->parse_html    	 = $this->settings['msg_allow_html'];
 		IPSText::getTextClass('bbcode')->parse_bbcode    = $this->settings['msg_allow_code'];
 		IPSText::getTextClass('bbcode')->parsing_section = 'pms';
		
		$msgContent = IPSText::getTextClass( 'bbcode' )->preDbParse( $msgContent );
		
		if ( $deleted == 1 )
		{
			$this->DB->update( 'pmviewer_message_posts', array( 'msg_post' => $msgContent ), 'msg_id=' . $msgID );
		}
		else
		{
			$this->DB->update( 'message_posts', array( 'msg_post' => $msgContent ), 'msg_id=' . $msgID );
		}
		
		if ( !$post['msg_is_first_post'] )
		{																				
			$goto = '&st='.$stID;
		}
		else
		{
			$goto = '';
		}
		
$this->registry->output->global_message = $this->lang->words['pm_msg_edited'];
		
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->form_code . '&do=viewTopic&id=' . $post['msg_topic_id'] . $goto );
	}
	
	/**
	 * Delete the posts
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function delete_Message()
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		$ids = array();
		
		foreach ( $this->request as $k => $v )
		{
			if ( preg_match( "/^id_(\d+)$/", $k, $match ) )
			{
				if ($this->request[  $match[0] ] )
				{
					$ids[] = $match[1];
				}
			}
		}
		
		if ( ! count($ids) )
		{
			$ID = intval($this->request['mid']);
			$ids[] = $ID;
		}
	
		if ( ! count($ids) OR ! is_array($ids) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_to_delete'] );
		}
		
		$idString = implode( ',', IPSLib::cleanIntArray( $ids ) );
		
		$idsForAttachments[] = IPSLib::cleanIntArray( $ids );
		
		/* Check that our posts all come from one topic */
		$this->DB->build( array( 'select' => 'DISTINCT(msg_topic_id)', 'from' => 'message_posts', 'where' => 'msg_id IN ('. $idString .')' ) );
		$this->DB->execute();
		while ( $res = $this->DB->fetch() )
		{
			$topic_ids[] = $res['msg_topic_id'];
		}
		
		if ( count( $topic_ids ) > 1 )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_multiple_topics'] );
		}
		
		$this->DB->build( array( 'select' => 'DISTINCT(msg_topic_id)', 'from' => 'pmviewer_message_posts', 'where' => 'msg_id IN ('. $idString .')' ) );
		$this->DB->execute();
		while ( $resd = $this->DB->fetch() )
		{
			$topic_idsd[] = $resd['msg_topic_id'];
		}
		
		if ( count( $topic_ids ) AND count( $topic_idsd ) )
		{
			$topic_ids = array_merge( $topic_ids, $topic_idsd );
		}
		elseif ( ! count( $topic_ids ) AND count( $topic_idsd) )
		{
			$topic_ids = $topic_idsd;
		}
		
		$topic_ids = array_unique( $topic_ids );
		
		if ( count( $topic_ids ) > 1 )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_multiple_topics'] );
		}
		
		$tid = '';
		
		if ( is_array( $topic_ids ) AND count( $topic_ids ) )
		{
			foreach( $topic_ids as $topic_id )
			{
				$tid .= $topic_id;
			}
		}
		
		if ( !$tid )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_topic_id_found'] );
		}
		
		/* Check that we haven't picked up the first post by mistake */
		$topic_info = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => 'mt_id = '. $tid ) );
		$topic_info['deleted'] = 0;
		if ( ! $topic_info['mt_id'] )
		{
			$topic_info = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_topics', 'where' => 'mt_id = '. $tid ) );
			$topic_info['deleted'] = 1;
		}
		
		if ( in_array( $topic_info['mt_first_msg_id'], $ids ) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_delete_first'] );
		}
		
		$permedMsgs = $this->_messageArrayPerms( $ids, $topic_info, false );
		if ( $permedMsgs === FALSE )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
		}
		
		$idString = implode( ',', IPSLib::cleanIntArray( $permedMsgs ) );
		
		$deleted = 0;
		
		/* Log the copy if we can */
		if ( $this->settings['pmviewer_deleted_log'] )
		{
			/* Work out which of our posts need to be deleted from the logging tables */
			$this->DB->build( array( 'select' => 'msg_id', 'from' => 'pmviewer_message_posts', 'where' => 'msg_id IN ('. $idString . ')' ) );
			$this->DB->execute();
			while( $dead_posts = $this->DB->fetch() )
			{
				$deadPosts[] = $dead_posts['msg_id'];
			}
			if ( is_array( $deadPosts ) AND count ( $deadPosts ) )
			{	
				$idStringDead = implode( ',', $deadPosts );
				$deleted = 1;
			}
			
			require_once( IPSLib::getAppDir( 'pmviewer' ) . '/sources/messageLogging.php' );
				$messageLogging = new messageLogging( $this->registry );
			
			$messageLogging->logMessages( $idString );
		}
 		
		/* Delete Posts */
		$this->DB->delete( 'message_posts', 'msg_id IN ('. $idString . ')' );
		if ( $deleted )
		{
			$this->DB->delete( 'pmviewer_message_posts', 'msg_id IN ('. $idStringDead . ')' );
		}
		
		/* Change our attachment array into a string? */
		$idsForAttachments = implode( ',', $idsForAttachments );
		
		/* Delete attachments */
		require_once( IPSLib::getAppDir( 'core' ) . '/sources/classes/attach/class_attach.php' );
		$class_attach                  =  new class_attach( $this->registry );
		$class_attach->type            =  'msg';
		$class_attach->init();
		$class_attach->bulkRemoveAttachment( $idsForAttachments );
		
		/* Update the topic information */
		if ( $topic_info['deleted'] )
		{
			$replyCount = $this->DB->buildAndFetch( array( 'select' => 'count(*) as count',
														   'from'   => 'pmviewer_message_posts',
														   'where'  => 'msg_topic_id=' . $tid ) );
		
			$replyCount['count'] = ( $replyCount['count'] > 0 ) ? $replyCount['count'] - 1 : 0;
			
			$latestID = $this->DB->buildAndFetch( array(  'select' => 'msg_id, msg_date',
														  'from'   => 'pmviewer_message_posts',
														  'where'  => 'msg_topic_id=' . $tid,
														  'order'  => 'msg_date DESC',
														  'limit'  => array( 0, 1 ) ) );
														  
			$firstID  = $this->DB->buildAndFetch( array(  'select' => 'msg_id, msg_date',
														  'from'   => 'pmviewer_message_posts',
														  'where'  => 'msg_topic_id=' . $tid,
														  'order'  => 'msg_date ASC',
														  'limit'  => array( 0, 1 ) ) );
														  
			$attach	= $this->DB->buildAndFetch( array(
														'select'   => 'COUNT(*) as attachments',
														'from'	   => array( 'attachments' => 'a' ),
														'where'	   => 'm.msg_topic_id=' . $tid . " AND a.attach_rel_module='msg'",
														'add_join' => array(
														array(  'from'	=> array( 'pmviewer_message_posts' => 'm' ),
																'where'	=> 'm.msg_id=a.attach_rel_id' ) ) )	);
												
			$this->DB->update( 'pmviewer_message_posts', array( 'msg_is_first_post' => 1 ), 'msg_id=' . $firstID['msg_id'] );
			
			$this->DB->update( 'pmviewer_message_topics', array( 'mt_last_post_time' => $latestID['msg_date'],
																 'mt_replies'        => intval( $replyCount['count'] ),
																 'mt_last_msg_id'	 => $latestID['msg_id'],
																 'mt_hasattach'		 => intval($attach['attachments']),
																 'mt_first_msg_id'   => $firstID['msg_id'] ), 'mt_id=' . $tid );
		}
		else
		{
			require_once( IPSLib::getAppDir( 'members' ) . '/sources/classes/messaging/messengerFunctions.php' );
			$messengerFunctions = new messengerFunctions( $this->registry );
			
			$messengerFunctions->rebuildTopic( $tid );
		}
		
		$this->registry->output->global_message = $this->lang->words['pm_delete_post_complete'];
		
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->form_code . '&do=viewTopic&id=' . $tid );
	}
	
	/**
	 * Join the conversation
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function join_Topic()
	{
		$groupCheck = $this->_groupCheck();
		if ( $groupCheck != 'pass' )
		{
			$this->registry->output->global_message = $groupCheck;
			$this->editSettings();
			return;
		}
		
		$topicID = intval($this->request['id']);
		
		if ( !$topicID )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_topic_id_block'] );
		}
		
		/* Let's check this message hasn't been deleted and logged and we aren't trying to ressurect the dead */
		$alive = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'message_topics', 'where' => "mt_id={$topicID}" ) );
		
		if ( ! $alive['mt_id'] )
		{
			$deleted = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'pmviewer_message_topics', 'where' => "mt_id={$topicID}" ) );
			
			if ( $deleted['mt_id'] )
			{
				$this->registry->output->showError(  $this->lang->words['pm_no_join_deleted'] );
			}
			elseif ( ! $deleted['mt_id'] )
			{
				$this->registry->output->showError( $this->lang->words['no_topics_with_id'] );
			}
		}
		
		/* Check our permissions */
		if ( ! $this->_conversationPerms( $alive, true ) )
		{
			$this->registry->output->showError( $this->lang->words['pm_no_permission'] );
		}
		
		/* Now lets check we aren't already in the conversation */
		$mapRecord	= $this->DB->buildAndFetch( array( 'select' => 'map_user_id,map_user_active,map_folder_id,map_user_banned', 'from' => 'message_topic_user_map', 'where' => "map_user_id={$this->memberData['member_id']} AND map_topic_id={$topicID}" ) );	
		
		/* If we aren't in there, lets join the party! */
		if ( !$mapRecord['map_user_id'] )
		{
			/* Pretend we are from the report center as its the easiest way to trick the system */
			define( 'FROM_REPORT_CENTER', true );
			
			require_once( IPSLib::getAppDir( 'members' ) . '/sources/classes/messaging/messengerFunctions.php' );
			$messengerFunctions = new messengerFunctions( $this->registry );

			try
			{
				/* We need to change the base url to the one we find on the public side so notifications in 3.1 work properly */
				$base_url_tmp = $this->settings['base_url'];
				$this->settings['base_url'] = $this->settings['board_url'] .'/'.IPS_PUBLIC_SCRIPT.'?';
				$messengerFunctions->addTopicParticipants( $topicID, array( $this->memberData['members_display_name'] ), $this->memberData['member_id'] );
				
				/* Now turn the base url back */
				$this->settings['base_url'] = $base_url_tmp;
			}
			
			/* The check lied! We must already be in there... */
			
			catch( Exception $e )
			{
				
			}
		}
		/* If we are part of the conversation, lets check our status and make it so we are see it now */
		else
		{
			$update	= array();
			
			if( !$mapRecord['map_user_active'] )
			{
				$update['map_user_active']	= 1;
			}
			
			if( $mapRecord['map_folder_id'] == 'finished' )
			{
				$update['map_folder_id']	= 'myconvo';
			}
			
			if( $mapRecord['map_user_banned'] )
			{
				$update['map_user_banned']	= 0;
			}
			
			if( count($update) )
			{
				$this->DB->update( 'message_topic_user_map', $update, "map_user_id={$this->memberData['member_id']} AND map_topic_id={$topicID}" );
			}
		}
		
		/* Let's see if the topic has been 'deleted' */
		$gone = $this->DB->buildAndFetch( array( 'select' => 'mt_id', 'from' => 'message_topics', 'where' => 'mt_is_deleted=1 AND mt_id='.$topicID ) );
		
		if ( $gone['mt_id'] )
		{
			/* Is the starter still active in the conversation? And it was lack of people that closed it? */
			$starter_gone = $this->DB->buildAndFetch( array( 'select' => 'map_topic_id', 'from' => 'message_topic_user_map', 'where' => 'mt_is_starter=1 AND map_user_active = 1 AND mt_id='.$topicID ) );
			if ( $starter_gone['map_topic_id'] )
			{
				/* So it has been 'deleted' but the starter is still there, do we have enough people now to resurrect it? */
				$this->DB->build( array( 'select' => 'count(*) as count', 'from' => 'message_topic_user_map', 'where' => 'map_user_banned=0 AND map_user_active=1 AND map_topic_id='.$topicID ) );
				$this->DB->execute();
				while( $resurrection = $this->DB->fetch() )
				{
					if ( $resurrection['count'] > 1 )
					{
						$this->DB->update( 'message_topics', array( 'mt_is_deleted' => '0' ), 'mt_id='.$topicID );
					}
				}
			}
		}
		
		$this->registry->output->global_message = $this->lang->words['pm_joined'];
		
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->form_code . '&do=viewTopic&id=' . $topicID );
	}

	/**
	* Edit the settings for the pm viewer
	*
	* @access	private
	* @return	void		[Outputs to screen]
	*/
	private function editSettings()
	{
	
		/* Do some fancy stuff and grab the settings  */
		
		$classToLoad	= IPSLib::loadLibrary( IPSLib::getAppDir( 'core' ).'/modules_admin/settings/settings.php', 'admin_core_settings_settings' );

		$settings		= new $classToLoad( $this->registry );


		$settings->makeRegistryShortcuts( $this->registry );
		
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_tools' ), 'core' );
		
		$settings->html			= $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );		
		$settings->form_code	= $settings->html->form_code    = 'module=settings&amp;section=settings';
		$settings->form_code_js	= $settings->html->form_code_js = 'module=settings&section=settings';

		$this->request['conf_title_keyword'] = 'pmviewer';
		$settings->return_after_save         = $this->settings['base_url'] . $this->form_code;
		$settings->_viewSettings();
	
		/* Copyright */
		$this->registry->output->html .= $this->html->copyright();
	}
	
	/**
	 * Show the tools
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function tools()
	{
		/* Just build the table */
		$this->registry->output->html .= $this->html->tools();
		
		/* Copyright */
		$this->registry->output->html .= $this->html->copyright();
	}
	
	/**
	 * Unhides all conversations
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function unhide()
	{
		$this->DB->update( 'message_topics', array( 'pmviewer_hide' => '0' ) );
		$this->DB->update( 'pmviewer_message_topics', array( 'pmviewer_hide' => '0' ) );
		
		$this->registry->output->global_message = $this->lang->words['pm_all_unhidden'];
	
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url']."&{$this->form_code}" );
	}
	
	/**
	 * Empties the log tables
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function delete_logs()
	{
		/* Navigation */
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form_code .'&amp;do=tools', $this->lang->words['pm_tools'] );
		$this->registry->output->extra_nav[] = array( '', $this->lang->words['pm_logs_empty_confirm'] );
		
		/* Have we got permission to do this? */
		if ( isset($this->request['confirm']) && $this->request['confirm'] == 1 )
		{	
			/* Okay hold on tight */
			$this->DB->delete( 'pmviewer_message_topics' );
			$this->DB->delete( 'pmviewer_message_topic_user_map' );
			$this->DB->delete( 'pmviewer_message_posts' );
			
			/* Now lets log and it and get out of here */
			$this->registry->getClass('adminFunctions')->saveAdminLog( $this->lang->words['pm_logs_emptied'] );

			$this->registry->output->global_message = $this->lang->words['pm_logs_emptied'];
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'].$this->html->form_code );
		}
		else
		{
			/* Can we get confirmation? */
			$this->registry->output->html .= $this->html->deleteLogsConfirm();
		}
	}
	
	/**
	 * Empties the log tables
	 *
	 * @access	private
	 * @return	void		[Outputs to screen]
	 */
	private function prune_convos()
	{
		/* Navigation */
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form_code .'&amp;do=tools', $this->lang->words['pm_tools'] );
		$this->registry->output->extra_nav[] = array( '', $this->lang->words['pm_keyword_confirm_head'] );
		
		$time		= intval( $this->request['time'] );
		$interval 	= $this->request['interval'];
		
		if ( !in_array( $interval, array( 'day', 'week', 'month', 'year' ) ) )
		{
			$this->registry->output->showError( $this->lang->words['pm_invalid_int'] );
		}
		
		if ( ! $time OR $time < 1 )
		{
			$this->registry->output->showError( $this->lang->words['pm_invalid_time'] );
		}
		
		/* Have we got permission to do this? */
		if ( isset($this->request['confirm']) AND $this->request['confirm'] == 1 )
		{	
			$init	= intval( $this->request['init'] );
			
			/* First get our groups */
			$groups = array();
			if( $init )
			{
				$groups = unserialize($this->request['groups']);
			}
			else
			{
				$groups = explode( ',', $this->request['groups'] );
			}
			$groups = IPSLib::cleanIntArray( $groups );
			if ( ! is_array( $groups ) AND ! count( $groups ) )
			{
				$this->registry->output->showError( $this->lang->words['pm_invalid_groups'] );
			}
			
			$start 	= intval( $this->request['st'] ) >= 0 ? intval( $this->request['st'] ) : 0;
			$pergo	= intval( $this->request['pergo'] ) > 0 ? intval( $this->request['pergo'] ) : 50;
			$img	= '<img src="' . $this->settings['skin_acp_url'] . '/images/aff_tick.png" alt="-" /> ';
			$next	= 0;
			$done	= 1;
			$remain	= 0;
			$tot_rem= intval( $this->request['rem'] ) ? intval( $this->request['rem'] ) : 0;
			$tot_del= intval( $this->request['del'] ) ? intval( $this->request['del'] ) : 0;
			$removed= 0;
			
			if( ! $init )
			{
				$url = $this->settings['base_url'] . '&' . $this->form_code_js 	. "&do=prune_convos&confirm=1"
																				. "&st=0"
																				. "&pergo=50"
																				. "&init=1"
																				. "&groups=".serialize($groups)
																				. "&time={$time}"
																				. "&interval={$interval}";
																				
				$this->registry->output->multipleRedirectInit( $url );
			}
			
			$this->DB->build( array(	'select' 	=> 'DISTINCT(tum.map_topic_id),map_user_id',
										'from' 		=> array('message_topic_user_map' => 'tum'),
										'where' 	=> 'm.member_group_id IN ('. implode (',', $groups ).') AND tum.map_user_active = 1 AND tum.map_last_topic_reply < UNIX_TIMESTAMP( DATE_SUB( NOW(), INTERVAL '. $time.' '. $interval .'))',
										'add_join' 	=> array(
										array(  'from'	=> array('members' => 'm'),
												'where'	=> 'tum.map_user_id=m.member_id'),
										array(  'from'	=> array('message_topics' => 't'),
												'where' => 'tum.map_topic_id=t.mt_id' ) ),
										'limit'		=> array( 0, $pergo ) ) );
			$this->DB->execute();
			
			/* messengerFunctions.php has some very nice code for all of this bit... why fix what isn't broken? */
			while( $i = $this->DB->fetch() )
			{
				/* Starter? */
				if ( $i['map_is_starter'] )
				{
					$starter[ $i['map_topic_id'] ]   = $i;
					$allTopics[ $i['map_topic_id'] ] = $i;
					$users[]						 = $i['map_user_id'];
					$done							 = 0;
				}
				else if ( $i['map_user_id'] AND $i['mt_is_system'] )
				{
					$system[ $i['mt_id'] ]       = $i;
					$allTopics[ $i['mt_id'] ]    = $i;
					$users[]					 = $i['map_user_id'];
					$done						 = 0;
				}
				else if ( $i['map_user_id'] )
				{
					$wanttoleave[ $i['map_topic_id'] ]  = $i;
					$allTopics[ $i['map_topic_id'] ]    = $i;
					$users[]						 	= $i['map_user_id'];
					$done								= 0;
				}
			}
			
			if( count( $allTopics ) )
			{
				$this->DB->build( array( 'select' => '*',
									 'from'   => 'message_topic_user_map',
									 'where'  => 'map_topic_id IN(' . implode( ',', array_keys( $allTopics ) ) . ')' ) );
								
				$this->DB->execute();
			
				while( $row = $this->DB->fetch() )
				{
					$membahs[ $row['map_user_id'] ] = $row['map_user_id'];
				}
			
			
				/* Flag for recount */
				if( count( $membahs ) )
				{
					$this->DB->update( 'members', array( 'msg_count_reset' => 1 ), 'member_id IN (' . implode( ',', array_keys( $membahs ) ) . ')' );
				}
			}
			
			if ( $done )
			{
				$text = sprintf( $this->lang->words['pm_convos_finished'], intval($tot_rem+$tot_del), $tot_rem, $tot_del );
				
				$this->registry->output->multipleRedirectFinish( $img .' '. $text );
			}
			
			/* Delete system messages without any hesitation and while there shouldn't be any attachments - we should run it (just in case although messengerFunctions doesn't) */
			if ( count($system) )
			{
				$removed = intval( $removed + count($system) );
				$idsForAttachments	= array();
 			
				$this->DB->build( array( 'select' => 'msg_id',
										 'from'   => 'message_posts',
										 'where'  => 'msg_topic_id IN ('. implode( ',', array_keys( $system ) ). ')'
								)		);
				$this->DB->execute();
				
				while( $r = $this->DB->fetch() )
				{
					$idsForAttachments[]	= $r['msg_id'];
				}
				
				$this->DB->delete( 'message_topics', 'mt_id IN ('. implode( ',', array_keys( $system ) ) . ')' );
				$this->DB->delete( 'message_posts', 'msg_topic_id IN ('. implode( ',', array_keys( $system ) ) . ')' );
				$this->DB->delete( 'message_topic_user_map', 'map_topic_id IN ('. implode( ',', array_keys( $system ) ) . ')' );
				
				$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'core' ) . '/sources/classes/attach/class_attach.php', 'class_attach' );
				$class_attach       = new $classToLoad( $this->registry );
				$class_attach->type = 'msg';
				$class_attach->init();
				$class_attach->bulkRemoveAttachment( $idsForAttachments );
			}
			
			/* If we were the starter, just update it for now, and mark the message as deleted (stopping new replies) */
			if ( count($starter) )
			{
				$this->DB->update( 'message_topics', 'mt_to_count=mt_to_count-1,mt_is_deleted=1', 'mt_id IN (' . implode( ',', array_keys( $starter ) ) . ')', FALSE, TRUE );
				$this->DB->update( 'message_topic_user_map', array( 'map_user_active' => 0 ), 'map_is_starter=1 AND map_topic_id IN ('. implode( ',', array_keys( $starter ) ) . ')' );
				$remain = intval( count( $starter ) + $remain );
			}
			
			/* Ones we were just hanging around in... */
			if ( count( $wanttoleave ) )
			{
				$this->DB->update( 'message_topic_user_map', array( 'map_user_active' => 0 ), 'map_user_id IN (' . implode( ',', $users ).') AND map_topic_id IN ('. implode( ',', array_keys( $wanttoleave ) ) . ')' );
				$this->DB->update( 'message_topics', 'mt_to_count=mt_to_count-1', 'mt_id IN (' . implode( ',', array_keys( $wanttoleave ) ) . ')', FALSE, TRUE );
				$remain = intval( count( $wanttoleave ) + $remain );
			}
			
			/* Sort out topics with no one still in */
			if ( count( $allTopics ) )
			{
	 			$this->DB->build( array( 'select'   => 'mt.*',
										 'from'     => array( 'message_topics' => 'mt' ),
										 'where'    => "mt.mt_id IN(" . implode( ',', array_keys( $allTopics ) ) . ")",
										 'add_join' => array(
										 array( 'select' => 'map.*',
										 		'from'   => array( 'message_topic_user_map' => 'map' ),
												'where'  => 'map.map_topic_id=mt.mt_id AND map.map_user_active=1',
												'type'   => 'left' ) ) ) );
		 		$this->DB->execute();
			
				while( $row = $this->DB->fetch() )
				{
					if ( ! $row['map_user_id'] )
					{
						$toHardDelete[ $row['mt_id'] ] = $row;
					}
				}
				
	 			$idsForAttachments	= array();
	 			
		 		$this->DB->build( array( 'select' => 'msg_id',
										 'from'   => 'message_posts',
										 'where'  => 'msg_topic_id IN ('. implode( ',', array_keys( $allTopics ) ) . ')'
								)		);
		 		$this->DB->execute();
		 		
		 		while( $r = $this->DB->fetch() )
		 		{
		 			$idsForAttachments[]	= $r['msg_id'];
		 		}
			}
			
			/* Delete them */	 		
	 		if ( count($toHardDelete) )
	 		{
				$remain = intval ( $remain - count($toHardDelete) );
				$removed = intval ( $removed + count($toHardDelete) );
				$this->DB->delete( 'message_topics', "mt_id IN (".implode( ',', array_keys( $toHardDelete ) ).")" );
				
		 		//-----------------------------------------
		 		// Delete attachments
		 		//-----------------------------------------
	
				$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'core' ) . '/sources/classes/attach/class_attach.php', 'class_attach' );
				$class_attach       = new $classToLoad( $this->registry );
				$class_attach->type = 'msg';
				$class_attach->init();
				$class_attach->bulkRemoveAttachment( array_keys( $idsForAttachments ) );
	
				//-----------------------------------------
				// Delete posts and mapping
				//-----------------------------------------
	
				$this->DB->delete( 'message_posts', 'msg_topic_id IN (' . implode( ',', array_keys( $toHardDelete ) ) . ')' );
				$this->DB->delete( 'message_topic_user_map', 'map_topic_id IN (' . implode( ',', array_keys( $toHardDelete ) ) . ')' );
	 		}
			
			$tot_rem = $tot_rem + $remain;
			$tot_del = $tot_del + $removed;
			
																			  
			$url = $this->settings['base_url'] . '&' . $this->form_code_js 	. "&do=prune_convos&confirm=1"
																				. "&st={$next}"
																				. "&rem={$remain}"
																				. "&del={$removed}"
																				. "&pergo={$pergo}"
																				. "&init=1"
																				. "&rem={$tot_rem}"
																				. "&del={$tot_del}"
																				. "&groups=".serialize($groups)
																				. "&time={$time}"
																				. "&interval={$interval}";
																			  
			$text = sprintf( $this->lang->words['pm_convos_pruned'], intval($removed+$remain), $removed, $remain );

			$this->registry->output->multipleRedirectHit( $url, $img . ' ' . $text );
		}
		else
		{
			$groups 	= array();
			
			if ( is_array( $this->request['groups'] ) AND count( $this->request['groups'] ) )
			{	
				foreach( $this->request['groups'] as $g_id )
				{
					$groups[] = $g_id;
				}
			}
			$groups 	= IPSLib::cleanIntArray( $groups );
			
			if ( ! is_array( $groups ) OR ! count( $groups ) )
			{
				$this->registry->output->showError( $this->lang->words['pm_invalid_groups'] );
			}
													 
			/* Find out how many conversations we would delete */
			$count_gone = $this->DB->buildAndFetch( array(	'select' 	=> 'COUNT(DISTINCT tum.map_topic_id) AS count',
															'from' 		=> array('message_topic_user_map' => 'tum'),
															'where' 	=> 'm.member_group_id IN ('. implode (',', $groups ).') AND tum.map_user_active = 1 AND tum.map_last_topic_reply < UNIX_TIMESTAMP( DATE_SUB( NOW(), INTERVAL '. $time.' '. $interval .'))',
															'add_join' 	=> array(
															array(  'from'	=> array('members' => 'm'),
																	'where'	=> 'tum.map_user_id=m.member_id') ) ) );
			
			// Commented this out as it isn't especially efficient, as it requires building a long list of all the topic id's and then looking for people who arent in the groups and are still active. So as it isn't really essential we can do without it and will just have to add a message explaining that not all will be deleted.
			/*$this->DB->build( array(	'select' 	=> 'DISTINCT tum.map_topic_id AS topicID',
										'from' 		=> array('message_topic_user_map' => 'tum'),
										'where' 	=> 'm.member_group_id IN ('. implode (',', $groups ).') AND tum.map_user_active = 1 AND tum.map_last_topic_reply < UNIX_TIMESTAMP( DATE_SUB( NOW(), INTERVAL '. $time.' '. $interval .'))',
										'add_join' 	=> array(
										0 => array( 'from'	=> array('members' => 'm'),
													'where'	=> 'tum.map_user_id=m.member_id') ) ) );
													
			$o = $this->DB->execute();
			
			while( $topic = $this->DB->fetch($o) )
			{
				$topics[] = $topic['topicID'];
			}
																		
			$not_gone = $this->DB->buildAndFetch( array(	'select' 	=> 'COUNT(DISTINCT tum.map_topic_id) AS count',
															'from' 		=> array('message_topic_user_map' => 'tum'),
															'where' 	=> 'm.member_group_id NOT IN ('. implode (',', $groups ).') AND tum.map_user_active = 1 AND tum.map_topic_id IN ('. implode (',', $topics ).') AND tum.map_last_topic_reply < UNIX_TIMESTAMP( DATE_SUB( NOW(), INTERVAL '. $time.' '. $interval .'))',
															'add_join' 	=> array(
															0 => array( 'from'	=> array('members' => 'm'),
																		'where'	=> 'tum.map_user_id=m.member_id') ) ) );*/
			
			
			$data['groups'] 	= implode( ',', $groups );
			$data['time']		= $time;
			$data['interval']	= $interval;
			$data['count']		= $count_gone['count'];
			$data['num_groups'] = count($groups);
			
			if( $data['count'] < 1 )
			{
				$this->registry->output->showError( $this->lang->words['pm_none_to_prune'] );
			}
			
			//$data['anti_count'] = $not_gone['count'];
			//$data['final']		= intval( $count_gone['count'] - $not_gone['count'] );
			
			/* Can we get confirmation? */
			$this->registry->output->html .= $this->html->pruneConvosConfirm($data);
		}
	}
	
	/**
	* Just a little function to sort the arrays - its needed to sort the conversations and posts into the correct orders when dealing with deleted ones
	*
	* @access	public
	* @param	array		The array being sorted
	* @param	string		The field we are using to sort the array by
	* @param	string		Defines order which the array is sorted
	* @return	array		The sorted array
	*/
	private function sortArray($data, $field, $order)
	{
		if ( $order == 'desc' )
		{
			$code = "return strnatcmp(\$a['$field'], \$b['$field']);";
		}
		else
		{
			$code = "return strnatcmp(\$b['$field'], \$a['$field']);";
		}
		usort($data, create_function('$a,$b', $code));
		return $data;
	}
	
	/**
	 * Determines whether the conversation can be accessed and changed
	 *
	 * @access	private
	 * @param	array 		Topic data
	 * @param	bool		Stop changes if topic is a system or draft message
	 * @return	bool
	 */
	private function _conversationPerms( $topicData, $system=false )
	{				
		if ( $topicData['pmviewer_hide'] )
		{
			return FALSE;
		}
		
		$topic = $this->DB->buildAndFetch( array( 'select' => 'mt_id,mt_is_system,mt_is_draft', 'from' => 'message_topics', 'where' => "mt_id={$topicData['mt_id']}" ) );
		
		if ( ! $topic['mt_id'] )
		{
			$topic = $this->DB->buildAndFetch( array( 'select' => 'mt_id,mt_is_system,mt_is_draft', 'from' => 'pmviewer_message_topics', 'where' => "mt_id={$topicData['mt_id']}" ) );
			
			if ( ! $this->settings['pmviewer_show_deleted'] OR ! $topic['mt_id'] )
			{
				return FALSE;
			}
		}
		
		if ( $system AND ( $topic['mt_is_system'] OR $topic['mt_is_draft'] ) )
		{
			return FALSE;
		}
		
		/* Now we should check that the conversation does not involve any blocked groups - if the member is deleted we have to just ignore that field */
		$showgroups = explode( ',', $this->settings['pmviewer_show'] );
		$hidegroups = explode( ',', $this->settings['pmviewer_hide'] );
		$_ok = 0;
		
		if ( $this->settings['pmviewer_starter'] )
		{
			$starter = $this->DB->buildAndFetch( array( 'select' => 'member_id,member_group_id', 'from' => 'members', 'where' => 'member_id='.$topicData['mt_starter_id'] ) );
			
			if( $starter['member_id'] )
			{
				if ( in_array( $starter['member_group_id'], $showgroups ) )
				{
					$_ok = 1;
				}
				
				if ( in_array( $starter['member_group_id'], $hidegroups ) )
				{
					return FALSE;
				}
			}
			else
			{
				$deleted_star = 1;
			}
		}
		
		if ( $this->settings['pmviewer_recipient'] )
		{
			if ( $this->settings['pmviewer_invited'] )
			{
				$invitedPpl = unserialize( $topicData['mt_invited_members'] );
				$invitedPpl[] = $topicData['mt_to_member_id'];
				$this->DB->build( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id IN ('. implode( ',', $invitedPpl ).')' ) );
				$this->DB->execute();
				$deleted_recip = $this->DB->getTotalRows() < 1 ? 1 : 0;
				while( $ppl = $this->DB->fetch() )
				{
					if( in_array( $ppl['member_group_id'], $showgroups ) )
					{
						$_ok = 1;
					}
					
					if( in_array( $ppl['member_group_id'], $hidegroups ) )
					{
						return FALSE;
					}
				}
			}
			else
			{
				$recipient = $this->DB->buildAndFetch( array( 'select' => 'member_id,member_group_id', 'from' => 'members', 'where' => 'member_id='.$topicData['mt_to_member_id'] ) );
			
				if( $recipient['member_id'] )
				{
					if ( in_array( $recipient['member_group_id'], $showgroups ) )
					{
						$_ok = 1;
					}
					
					if ( in_array( $recipient['member_group_id'], $hidegroups ) )
					{
						return FALSE;
					}
				}
				else
				{
					$deleted_recip = 1;
				}
			}
		}
		
		if ( $deleted_star AND $deleted_recip )
		{
			$_ok = 1;
		}
		
		if ( ! $_ok )
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	/**
	 * Determines whether the conversations can be accessed and changed
	 *
	 * @access	private
	 * @param	array 		Topic ids
	 * @param	bool		Stop changes if topic is a system or draft message
	 * @return	mixed		If all topics are invalid returns false, if at least one is valid an array is returned containing the valid topic ids
	 */
	private function _conversationArrayPerms( $topics, $system=false )
	{				
		$showgroups	 = $this->settings['pmviewer_show'];
		$hidegroups	 = $this->settings['pmviewer_hide'];
		$validTopics = array();
		$topics		 = IPSLib::cleanIntArray( $topics );
		
		if ( $showgroups )
		{
			if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 1 )
			{
				$show_query	= " AND (m.member_group_id IN (". $showgroups .") OR f.member_group_id IN (". $showgroups ."))";
			}
			else if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 0 )
			{
				$show_query = " AND m.member_group_id IN (". $showgroups .")";
			}
			else if ( $this->settings['pmviewer_starter'] == 0 AND $this->settings['pmviewer_recipient'] == 1 )
			{
				$show_query = " AND f.member_group_id IN (". $showgroups .")";
			}
		}
		
		if ( $hidegroups )
		{
			if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 1 )
			{
				$hide_query	= " AND (m.member_group_id NOT IN (". $hidegroups .") AND f.member_group_id NOT IN (". $hidegroups ."))";
			}
			else if ( $this->settings['pmviewer_starter'] == 1 AND $this->settings['pmviewer_recipient'] == 0 )
			{
				$hide_query	= " AND m.member_group_id NOT IN (". $hidegroups .")";
			}
			else if ( $this->settings['pmviewer_starter'] == 0 AND $this->settings['pmviewer_recipient'] == 1 )
			{
				$hide_query = " AND f.member_group_id NOT IN (". $hidegroups .")";
			}
		}
		
		if ( $system )
		{
			$system_query = " AND mt_is_system = 0 AND mt_is_draft = 0";
		}
		
		if ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] )
		{
			$find = 'mt_id,mt_invited_members';
		}
		else
		{
			$find = 'mt_id';
		}
		
		$this->DB->build( array( 'select'	=> $find,
								 'from' 	=> array('message_topics' => 't'),
								 'where'	=> 'pmviewer_hide = 0 AND mt_id IN ('. implode ( ',', $topics ).')'. $show_query . $hide_query . $system_query,
								 'add_join' => array(
								 array( 'from'	 => array('members' => 'm'),
										'where' => 'm.member_id=t.mt_starter_id' ),
								 array( 'from'	 => array('members' => 'f'),
										'where' => 'f.member_id=t.mt_to_member_id' ) ) ) );
		$a = $this->DB->execute();
		while( $topicData = $this->DB->fetch($a) )
		{
			if ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] )
			{
				$invited[$d['id']]	= unserialize($topicData['mt_invited_members']);
				$inviteList 		= array_merge( $inviteList, $invited[$d['id']] );
				$inviteList 		= array_unique( $inviteList );
			}
			
			$validTopics[] 		= $topicData['mt_id'];
			
		}
		
		if ( $this->settings['pmviewer_show_deleted'] == 1 )
		{
			$this->DB->build( array( 'select'	=> $find,
									 'from' 	=> array('pmviewer_message_topics' => 't'),
									 'where'	=> 'pmviewer_hide = 0 AND mt_id IN ('. implode ( ',', $topics ).')'. $show_query . $hide_query . $system_query,
									 'add_join' => array(
									 array( 'from'	 => array('members' => 'm'),
											'where' => 'm.member_id=t.mt_starter_id' ),
									 array( 'from'	 => array('members' => 'f'),
											'where' => 'f.member_id=t.mt_to_member_id' ) ) ) );
			$d = $this->DB->execute();
			while( $topicdData = $this->DB->fetch($d) )
			{	
				if ( $this->settings['pmviewer_recipient'] AND $this->settings['pmviewer_invited'] )
				{
					$invited[$d['id']]	= unserialize($topicData['mt_invited_members']);
					$inviteList 		= array_merge( $inviteList, $invited[$d['id']] );
					$inviteList 		= array_unique( $inviteList );
				}
				
				$validTopics[] 		= $topicdData['mt_id'];
			}
		}
		
		if( $this->settings['pmviewer_hide'] != '' AND count ( $topicData['mt_invited_members'] ) AND $this->settings['pmviewer_invited'] AND $this->settings['pmviewer_recipient'] )
		{
			$this->DB->build( array( 'select' => 'member_id', 'from' => 'members', 'where' => "member_group_id IN ( {$this->settings['pmviewer_hide']} ) AND member_id IN ( ". implode ( ',', $inviteList ) .")" ) );
			$this->DB->execute();
			while( $me = $this->DB->fetch() )
			{
				$remove[] = $me['member_id'];
			}
			
			foreach( $invited as $topic => $list )
			{
				if( array_intersect( $list, $remove ) )
				{
					$discard[] = $topic;
				}
			}
			
			$validTopics = array_diff( $validTopics, $discard );
		}
		
		if ( ! is_array( $validTopics ) OR ! count( $validTopics ) )
		{
			return FALSE;
		}
		else
		{
			return $validTopics;
		}
	}
	
	/**
	 * Determines whether the message can be accessed and changed
	 *
	 * @access	private
	 * @param	array 		Message data
	 * @param	array 		Topic data
	 * @param	bool		Stop changes if topic is a system or draft message
	 * @return	bool
	 */
	private function _messagePerms( $msgData, $topicData, $system=false )
	{				
		if ( $topicData['pmviewer_hide'] )
		{
			return FALSE;
		}
		
		$topic = $this->DB->buildAndFetch( array( 'select' => "mt_id,mt_is_system,mt_is_draft,'current' as source", 'from' => 'message_topics', 'where' => "mt_id={$topicData['mt_id']}" ) );
		
		if ( ! $topic['mt_id'] )
		{
			$topic = $this->DB->buildAndFetch( array( 'select' => "mt_id,mt_is_system,mt_is_draft,'deleted' as source", 'from' => 'pmviewer_message_topics', 'where' => "mt_id={$topicData['mt_id']}" ) );
		}
		
		if ( $topic['source'] == 'deleted' )
		{
			if ( ! $this->settings['pmviewer_show_deleted'] )
			{
				return FALSE;
			}
		}
		
		if ( $system AND ( $topic['mt_is_system'] OR $topic['mt_is_draft'] ) )
		{
			return FALSE;
		}
		
		$msg = $this->DB->buildAndFetch( array( 'select' => "msg_id,'current' as source", 'from' => 'message_posts', 'where' => "msg_id={$msgData['msg_id']}" ) );
		
		if ( ! $msg['msg_id'] )
		{
			$msg = $this->DB->buildAndFetch( array( 'select' => "msg_id,'deleted' as source", 'from' => 'pmviewer_message_posts', 'where' => "msg_id={$msgData['msg_id']}" ) );
		}
		
		if ( $msg['source'] == 'deleted' )
		{
			if ( ! $this->settings['pmviewer_show_deleted'] )
			{
				return FALSE;
			}
		}
		
		/* Now we should check that the conversation does not involve any blocked groups */
		$showgroups = explode( ',', $this->settings['pmviewer_show'] );
		$hidegroups = explode( ',', $this->settings['pmviewer_hide'] );
		$_ok = 0;
		
		if ( $this->settings['pmviewer_starter'] )
		{
			$starter = $this->DB->buildAndFetch( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id='.$topicData['mt_starter_id'] ) );
			
			if ( in_array( $starter['member_group_id'], $showgroups ) )
			{
				$_ok = 1;
			}
			
			if ( in_array( $starter['member_group_id'], $hidegroups ) )
			{
				return FALSE;
			}
		}
		
		if ( $this->settings['pmviewer_recipient'] )
		{
			if ( $this->settings['pmviewer_invited'] )
			{
				$invitedPpl = unserialize( $topicData['mt_invited_members'] );
				$invitedPpl[] = $topicData['mt_to_member_id'];
				$this->DB->build( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id IN ('. implode( ',', $invitedPpl ).')' ) );
				$this->DB->execute();
				while( $ppl = $this->DB->fetch() )
				{
					if( in_array( $ppl['member_group_id'], $showgroups ) )
					{
						$_ok = 1;
					}
					
					if( in_array( $ppl['member_group_id'], $hidegroups ) )
					{
						return FALSE;
					}
				}
			}
			else
			{
				$recipient = $this->DB->buildAndFetch( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id='.$topicData['mt_to_member_id'] ) );
				
				if ( in_array( $recipient['member_group_id'], $showgroups ) )
				{
					$_ok = 1;
				}
				
				if ( in_array( $recipient['member_group_id'], $hidegroups ) )
				{
					return FALSE;
				}
			}
		}
		
		if ( ! $_ok )
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	/**
	 * Determines whether the messages can be accessed and changed
	 *
	 * @access	private
	 * @param	array 		Message ids
	 * @param	array		Topic data
	 * @param	bool		Stop changes if topic is a system or draft message
	 * @return	mixed		If all messages are invalid returns false, if at least one is valid an array is returned containing the valid message ids
	 */
	private function _messageArrayPerms( $msgs, $topicData, $system=false )
	{				
		if ( $topicData['pmviewer_hide'] )
		{
			return FALSE;
		}
		
		$topic = $this->DB->buildAndFetch( array( 'select' => 'mt_id,mt_is_system,mt_is_draft', 'from' => 'message_topics', 'where' => "mt_id={$topicData['mt_id']}" ) );
		
		if ( ! $topic['mt_id'] )
		{
			$topic = $this->DB->buildAndFetch( array( 'select' => 'mt_id,mt_is_system,mt_is_draft', 'from' => 'pmviewer_message_topics', 'where' => "mt_id={$topicData['mt_id']}" ) );
			
			if ( ! $this->settings['pmviewer_show_deleted'] OR ! $topic['mt_id'] )
			{
				return FALSE;
			}
		}
		
		if ( $system AND ( $topic['mt_is_system'] OR $topic['mt_is_draft'] ) )
		{
			return FALSE;
		}
		
		/* Now we should check that the conversation does not involve any blocked groups */
		$showgroups = explode( ',', $this->settings['pmviewer_show'] );
		$hidegroups = explode( ',', $this->settings['pmviewer_hide'] );
		$_ok = 0;
		
		if ( $this->settings['pmviewer_starter'] )
		{
			$starter = $this->DB->buildAndFetch( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id='.$topicData['mt_starter_id'] ) );
			
			if ( in_array( $starter['member_group_id'], $showgroups ) )
			{
				$_ok = 1;
			}
			
			if ( in_array( $starter['member_group_id'], $hidegroups ) )
			{
				return FALSE;
			}
		}
		
		if ( $this->settings['pmviewer_recipient'] )
		{
			if ( $this->settings['pmviewer_invited'] )
			{
				$invitedPpl = unserialize( $topicData['mt_invited_members'] );
				$invitedPpl[] = $topicData['mt_to_member_id'];
				$this->DB->build( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id IN ('. implode( ',', $invitedPpl ).')' ) );
				$this->DB->execute();
				while( $ppl = $this->DB->fetch() )
				{
					if( in_array( $ppl['member_group_id'], $showgroups ) )
					{
						$_ok = 1;
					}
					
					if( in_array( $ppl['member_group_id'], $hidegroups ) )
					{
						return FALSE;
					}
				}
			}
			else
			{
				$recipient = $this->DB->buildAndFetch( array( 'select' => 'member_group_id', 'from' => 'members', 'where' => 'member_id='.$topicData['mt_to_member_id'] ) );
				
				if ( in_array( $recipient['member_group_id'], $showgroups ) )
				{
					$_ok = 1;
				}
				
				if ( in_array( $recipient['member_group_id'], $hidegroups ) )
				{
					return FALSE;
				}
			}
		}
		
		if ( ! $_ok )
		{
			return FALSE;
		}
		
		$validMsgs  = array();
		$msgs		= IPSLib::cleanIntArray( $msgs );
		
		$this->DB->build( array( 'select' => 'msg_id', 'from' => 'message_posts', 'where' => 'msg_id IN ('. implode ( ',', $msgs ).')' ) );
		$a = $this->DB->execute();
		while( $messageData = $this->DB->fetch($a) )
		{
			$validMsgs[] = $messageData['msg_id'];
		}
		
		if ( $this->settings['pmviewer_show_deleted'] == 1 )
		{
			$this->DB->build( array( 'select' => 'msg_id', 'from' => 'pmviewer_message_posts', 'where' => 'msg_id IN ('. implode ( ',', $msgs ).')' ) );
			$d = $this->DB->execute();
			while( $messagedData = $this->DB->fetch($d) )
			{
				$validMsgs[] = $messagedData['msg_id'];
			}
		}
		
		if ( ! is_array( $validMsgs ) OR ! count( $validMsgs ) )
		{
			return FALSE;
		}
		else
		{
			return $validMsgs;
		}
	}
	
	/**
	 * Determines whether the group settings are configured properly
	 *
	 * @access	private
	 * @return	string		If there are no problems then the global message to be added is returned, otherwise 'pass' is returned
	 */
	private function _groupCheck()
	{
		$showgroups = $this->settings['pmviewer_show'];
		$hidegroups = $this->settings['pmviewer_hide'];
		
		if ( $showgroups AND $this->settings['pmviewer_starter'] == 0 AND $this->settings['pmviewer_recipient'] == 0 )
		{
			return $this->lang->words['pm_starter_recipient'];
		}
		
		if ( ! $showgroups )
		{
			return $this->lang->words['pm_no_group'];
		}
		
		if ( $showgroups == $hidegroups )
		{
			return $this->lang->words['pm_no_difference'];
		}
		
		$show_groups = explode( ',', $showgroups );
		$hide_groups = explode( ',', $hidegroups );
		$group_check = array_diff( $show_groups, $hide_groups );
		if ( ! $group_check )
		{
			return $this->lang->words['pm_show_no'];
		}
		
		return 'pass';
	}
}