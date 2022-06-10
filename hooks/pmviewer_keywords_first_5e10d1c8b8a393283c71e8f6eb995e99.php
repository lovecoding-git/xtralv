<?php

/**
 * (SN) PM Viewer
 * PM Viewer Keyword Search Hook - First Post
 * Last Updated: February 21st 2011
 *
 * @author 		signet51
 * @copyright	(c) 2011 signet51 Modding
 * @version		1.6.0 (1600)
 *
 */

class pmviewer_keywords_first
{
	public function handleData( $message )
	{
		$this->registry		= ipsRegistry::instance();
		$this->DB			= ipsRegistry::instance()->DB();
		$this->settings		= ipsRegistry::instance()->settings();
		$this->request		= ipsRegistry::instance()->request();
		$this->lang			= ipsRegistry::instance()->getClass('class_localization');
		$this->member		= ipsRegistry::instance()->member();
		$this->memberData	=& ipsRegistry::instance()->member()->fetchMemberData();
		$this->cache		= ipsRegistry::instance()->cache();
		$this->caches		=& ipsRegistry::instance()->cache()->fetchCaches();
		
		ipsRegistry::instance()->class_localization->loadLanguageFile( array( 'public_notifications' ), 'pmviewer' );
		
		if ( !$this->settings['pmviewer_keyword_search_on'] OR trim( $this->settings['pmviewer_keyword_search_keywords'] ) == '' OR !$this->settings['pmviewer_keyword_search_keywords'] )
		{
			return $message;
		}
		
		/* Check the group setting bits are valid - else we are just wasting our time */
		$showgroups = $this->settings['pmviewer_show'];
		$hidegroups = $this->settings['pmviewer_hide'];
		
		if ( $showgroups AND $this->settings['pmviewer_starter'] == 0 AND $this->settings['pmviewer_recipient'] == 0 )
		{
			return $message;
		}
		
		if ( ! $showgroups )
		{
			return $message;
		}
		
		if ( $showgroups == $hidegroups )
		{
			return $message;
		}
		
		$show_groups = explode( ',', $showgroups );
		$hide_groups = explode( ',', $hidegroups );
		$group_check = array_diff( $show_groups, $hide_groups );
		if ( ! $group_check )
		{
			return $message;
		}
		
		/* Now check the message to see if we have permission to process it */
		$topic = $this->DB->buildAndFetch( array( 'select' => "*", 'from' => 'message_topics', 'where' => "mt_id={$message['msg_topic_id']} AND pmviewer_hide = 0" ) );

		if ( ! $topic['mt_id'] )
		{
			/* No need to check deleted messages here - as how can it be deleted already? */
			return $message;
		}
		
		if ( $topic['mt_is_system'] AND $this->settings['pmviewer_system_hide'] )
		{
			return $message;
		}
		
		/* Now we should check that the conversation does not involve any blocked groups */
		$showgroups = explode( ',', $this->settings['pmviewer_show'] );
		$hidegroups = explode( ',', $this->settings['pmviewer_hide'] );
		$_ok = 0;
		
		if ( $this->settings['pmviewer_starter'] )
		{
			$starter = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'members', 'where' => 'member_id='.$topic['mt_starter_id'] ) );
		}
		
		if ( $this->settings['pmviewer_recipient'] )
		{
			$recipient = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'members', 'where' => 'member_id='.$topic['mt_to_member_id'] ) );
		}
		
		if ( in_array( $starter['member_group_id'], $showgroups ) OR in_array( $recipient['member_group_id'], $showgroups ) )
		{
			$_ok = 1;
		}
		
		if ( in_array( $starter['member_group_id'], $hidegroups ) OR in_array( $recipient['member_group_id'], $hidegroups ) )
		{
			$_ok = 0;
		}
		
		if ( $_ok == 0 )
		{
			return $message;
		}
		
		/* Search the message for the main keywords first - we do not send a notification just based on their presence */
		$main_keywords = $this->settings['pmviewer_keywords'];
		
		if ( $main_keywords AND trim( $main_keywords ) != '' )
		{
			/* Split up the keywords into an array, splitting by spaces and commas, but leaving them alone if they are in quotes */
			$main_words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $main_keywords, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			//$main_words = preg_split( "/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|[\s,]+/", $main_keywords, 0, PREG_SPLIT_DELIM_CAPTURE );
		
			if ( is_array($main_words) )
			{
				$match_main = 0;
				foreach( $main_words as $main_word )
				{
					if ( stripos( $message['msg_post'], $main_word ) !== FALSE )
					{
						/* Only need to find one to pass */
						$match_main = 1;
						break;
					}
				}
				
				if ( $match_main != 1 )
				{
					return $message;
				}
			}
		}
		
		/* So we have passed the checks - now it's time to look for the keywords which we will send out notifications for */
		$keywords = $this->settings['pmviewer_keyword_search_keywords'];
		
		/* Split them up into an array */
		$words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $keywords, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		
		if ( is_array($words) )
		{	
			$match = 0;
			foreach( $words as $word )
			{
				if ( stripos( $message['msg_post'], $word ) !== FALSE )
				{
					$match = 1;
					break;
				}
			}
			
			if ( $match != 1 )
			{
				return $message;
			}
		}
		else
		{
			return $message;
		}
		
		/* If we are here we should have a result so send out the notifications */
		$classToLoad	= IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
		$notifyLibrary	= new $classToLoad( ipsRegistry::instance() );
		
		/* Get the admin groups - borrowed this bit from the list admins function in the security tools */
		$members = array();
		
		$this->DB->build( array( 'select' => 'g_id',
								 'from'   => 'groups',
								 'where'  => 'g_access_cp > 0 AND g_access_cp IS NOT NULL' ) );
		
		$o = $this->DB->execute();
		
		while( $row = $this->DB->fetch( $o ) )
		{
			$_gid = intval( $row['g_id'] );
			
			$this->DB->build( array( 'select' => '*',
									 'from'   => 'members',
									 'where'  => "member_group_id=" . $_gid ." OR mgroup_others LIKE '%,". $_gid .",%' OR mgroup_others='".$_gid."' OR mgroup_others LIKE '".$_gid.",%' OR mgroup_others LIKE '%,".$_gid."'",
									 'order'  => 'joined ASC' ) );

			$b = $this->DB->execute();
			
			while( $member = $this->DB->fetch( $b ) )
			{
				if ( ! $member['member_group_id'] )
				{
					continue;
				}
				
				/* Don't bother sending a notification to self */
				if( $member['member_id'] == $this->memberData['member_id'] )
				{
					continue;
				}
			
				$member['language'] = !$member['language'] ? IPSLib::getDefaultLanguage() : $member['language'];
				
				IPSText::getTextClass( 'email' )->getTemplate( 'pmviewer_keyword_notification', $member['language'], 'public_notifications', 'pmviewer' );
				
				IPSText::getTextClass( 'email' )->buildMessage( array(
																		'NAME'		=> $member['members_display_name'],
																		'AUTHOR'	=> $this->memberData['members_display_name'],
																		'TEXT'		=> $this->settings['pmviewer_keyword_search_link'] ? $this->lang->words['pm_keyword_link_text'].' '.$this->settings['_admin_link'].'?&amp;app=pmviewer&amp;module=main&amp;section=overview&amp;do=viewTopic&amp;id='.$message['msg_topic_id'].'#id1' : $this->lang->words['pm_keyword_nolink_text'].' '.$message['msg_topic_id'],
																		'URL'		=> $this->settings['base_url'] . 'app=core&amp;module=usercp&amp;tab=core&amp;area=notifications',
																		)
																);

				IPSText::getTextClass('email')->subject	= sprintf( 
																	IPSText::getTextClass('email')->subject, 
																	$this->registry->output->buildSEOUrl( 'showuser=' . $this->memberData['member_id'], 'public', $this->memberData['members_seo_name'], 'showuser' ),
																	$this->memberData['members_display_name'],
																	( $this->settings['pmviewer_keyword_search_link'] ? '<a href="'.$this->settings['_admin_link'].'?&amp;app=pmviewer&amp;module=main&amp;section=overview&amp;do=viewTopic&amp;id='.$message['msg_topic_id'].'#id1" target="_blank" title="'.$topic['mt_title'].'">'.$this->lang->words['pm_keyword_nolink_msg'].'</a>' : $this->lang->words['pm_keyword_nolink_msg'] )
																);
																
				$url = ( $this->settings['pmviewer_keyword_search_link'] == 1 ) ? $this->settings['_admin_link'].'?&amp;app=pmviewer&amp;module=main&amp;section=overview&amp;do=viewTopic&amp;id='.$message['msg_topic_id'].'#id1' : '' ;
				
				$notifyLibrary->setMember( $member );
				$notifyLibrary->setFrom( $this->memberData );
				$notifyLibrary->setNotificationKey( 'pmviewer_keyword_monitor' );
				$notifyLibrary->setNotificationUrl( $url );
				$notifyLibrary->setNotificationText( IPSText::getTextClass('email')->message );
				$notifyLibrary->setNotificationTitle( IPSText::getTextClass('email')->subject );
				
				try
				{
					$notifyLibrary->sendNotification();
				}
				catch( Exception $e ){}
				
			}
		}
		
		return $message;
	}
}
?>