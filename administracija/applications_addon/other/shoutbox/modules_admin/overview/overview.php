<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

if ( !defined('IN_ACP') )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class admin_shoutbox_overview_overview extends ipsCommand 
{
	public $html;
	
	public function doExecute( ipsRegistry $registry )
	{
		/* Load Skin and Lang */
		$this->html               = $this->registry->output->loadTemplate( 'cp_skin_overview' );
		$this->html->form_code    = '&amp;module=overview&amp;section=overview';
		$this->html->form_code_js = '&module=overview&section=overview';
		
		/* Check permissions */
		$this->registry->class_permissions->checkPermissionAutoMsg( 'shoutbox_view_overview' );
		
		/* Setup some variables */
		$temp  = array();
		$stats = array( 'total'      => $this->lang->formatNumber( $this->caches['shoutbox_shouts']['total'] ),
						'unique'     => 0,
						'topMember'  => '--',
						'topShouts'  => 0,
						'lastName'   => '--',
						'lastDate'   => 0,
						'moderators' => count($this->caches['shoutbox_mods']['groups']) + count($this->caches['shoutbox_mods']['members']),
						'banned'     => 0
						);
		
		/* Get banned members count */
		$temp = $this->DB->buildAndFetch( array( 'select' => 'COUNT(member_id) as count', 'from' => 'members', 'where' => "members_cache LIKE '%shoutbox_banned\";i:1%'" ) );
		
		$stats['banned'] = $temp['count'];
		
		/* We have some shouts? */
		if ( $this->caches['shoutbox_shouts']['total'] > 0 )
		{
			$temp = $this->DB->buildAndFetch( array( 'select' => 'COUNT(s_mid) AS shouts, s_mid',
													 'from'   => 'shoutbox_shouts',
													 'where'  => 's_mid > 0',
													 'group'  => 's_mid',
													 'order'  => 'shouts DESC',
													 'limit'  => array( 0, 1 ),
											 )		);
			
			/* Save data in our main array */
			$stats['topMember'] = intval($temp['s_mid']);
			$stats['topShouts'] = intval($temp['shouts']);
			
			/* Get latest shout */
			$temp = array();
			$temp = array_shift($this->caches['shoutbox_shouts']['shouts']);
			
			$stats['lastDate'] = $this->lang->getDate( $temp['s_date'], 'LONG');
			
			// Get top shouter and last shout member info
			$this->DB->build( array( 'select' => 'member_id, members_display_name, member_group_id',
									 'from'   => 'members',
									 'where'  => 'member_id IN ('.$stats['topMember'].','.intval($temp['s_mid']).')'
							 )		);
			$this->DB->execute();
			
			while( $mem = $this->DB->fetch() )
			{
				if ( $mem['member_id'] == $stats['topMember'] )
				{
					$stats['topMember'] = IPSMember::makeProfileLink( IPSMember::makeNameFormatted( $mem['members_display_name'], $mem['member_group_id']), $mem['member_id']);
				}
				
				if ( $mem['member_id'] == $temp['s_mid'] )
				{
					$stats['lastName'] = IPSMember::makeProfileLink( IPSMember::makeNameFormatted( $mem['members_display_name'], $mem['member_group_id']), $mem['member_id']);
				}
			}
		}
		
		/* Setup general informations */
		$stats['online'] = $this->settings['shoutbox_online'] ? 'tick' : 'cross';
		
		/* Get upgrade history */
		$upgradeRows = array();
		
		$this->DB->build( array( 'select' => 'upgrade_version_id, upgrade_version_human, upgrade_date',
								 'from'   => 'upgrade_history',
								 'where'  => "upgrade_app='shoutbox'",
								 'order'  => 'upgrade_version_id DESC',
								 'limit'  => array( 0, 5 )
						 )		);
		$this->DB->execute();
		
		while( $row = $this->DB->fetch() )
		{
			$row['_date'] = $this->lang->getDate( $row['upgrade_date'], 'SHORT' );
			
			$upgradeRows[] = $row;
		}
		
		/* Add to Output */
		$this->registry->output->html .= $this->html->shoutboxOverviewIndex( $stats, $upgradeRows );
		
		/* Output */
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}
}