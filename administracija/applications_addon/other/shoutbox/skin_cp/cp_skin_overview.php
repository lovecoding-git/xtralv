<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

class cp_skin_overview extends output
{
	public function __destruct()
	{
	}

	public function shoutboxOverviewIndex( $stats, $upgrades )
	{
		$IPBHTML = "";
		//--starthtml--//

		$IPBHTML .= <<<HTML
<div class="section_title">
	<h2>{$this->lang->words['ov_title']}</h2>
</div>
<table class="form_table">
	<tr>
		<td style="width: 50%;" valign="top">
			<div class="acp-box">
				<h3>{$this->lang->words['ov_stats']}</h3>
				<table class="ipsTable">
					<tr>
						<td style="width: 40%;"><strong>{$this->lang->words['total_shouts']}</strong></td>
						<td style="width: 60%;">{$stats['total']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['unique_shouters']}</strong></td>
						<td>{$stats['unique']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['top_shouter']}</strong></td>
						<td>{$stats['topMember']} ({$stats['topShouts']})</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['latest_shout_by']}</strong></td>
						<td>{$stats['lastName']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['latest_shout_date']}</strong></td>
						<td>{$stats['lastDate']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['moderators']}</strong></td>
						<td>{$stats['moderators']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['banned_members']}</strong></td>
						<td>{$stats['banned']}</td>
					</tr>
				</table>
			</div>
			<br class="clear" />
			<div class="acp-box">
				<h3>{$this->lang->words['ov_upgrade_history']}</h3>
				<table class="ipsTable">
					<tr>
						<th style="width: 60%">{$this->lang->words['ov_version']}</th>
						<th style="width: 40%">{$this->lang->words['upgrade_date']}</th>
					</tr>

HTML;
						
						if ( count( $upgrades ) )
						{
							foreach ( $upgrades as $upgrade )
							{
								$IPBHTML .= <<<HTML
					<tr>
						<td>{$upgrade['upgrade_version_human']} ({$upgrade['upgrade_version_id']})</td>
						<td>{$upgrade['_date']}</td>
					</tr>

HTML;
							}
						}
						
						$IPBHTML .= <<<HTML
				</table>
			</div>
		</td>
		<td style="width: 50%;" valign="top">
			<div class="acp-box">
				<h3>{$this->lang->words['ov_general_info']}</h3>
				<table class="ipsTable">
					<tr>
						<td style="width: 40%;"><strong>{$this->lang->words['shoutbox_online']}</strong></td>
						<td style="width: 60%; text-align: center;"><img src='{$this->settings['skin_acp_url']}/images/icons/{$stats['online']}.png' alt="" /></td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['shoutbox_version']}</strong></td>
						<td align='center'>{$this->caches['app_cache']['shoutbox']['app_version']}</td>
					</tr>
				</table>
			</div>
			<br class="clear" />
			<div class="acp-box">
				<h3>{$this->lang->words['group_permissions']}</h3>
				<table class="ipsTable">

HTML;
				
				foreach ( $this->caches['group_cache'] as $group )
				{
					$name = IPSMember::makeNameFormatted( $group['g_title'], $group['g_id'] );
					
					$IPBHTML .= <<<HTML
					<tr>
						<td style="width: 80%;">{$name}</td>
						<td style="width: 80%; text-align: center;">
							<a href="{$this->settings['_base_url']}app=members&amp;module=groups&amp;section=groups&amp;do=edit&amp;id={$group['g_id']}&amp;_initTab=shoutbox" title="{$this->lang->words['edit_group']}">{$this->lang->words['edit_group']}</a>
						</td>
					</tr>

HTML;
				}
				
				$IPBHTML .= <<<HTML
				</table>
			</div>
		</td>
	</tr>
</table>
HTML;

		//--endhtml--//
		return $IPBHTML;
	}
}