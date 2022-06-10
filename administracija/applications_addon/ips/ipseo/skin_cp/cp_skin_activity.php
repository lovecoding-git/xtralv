<?php
/**
 * <pre>
 * Invision Power Services
 * IP.SEO ACP Skin - Activity
 * Last Updated: $Date: 2011-07-26 09:45:56 -0400 (Tue, 26 Jul 2011) $
 * </pre>
 *
 * @author 		$Author: mark $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 9322 $
 */
 
class cp_skin_activity
{

	/**
	 * Constructor
	 *
	 * @param	object		Registry object
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry )
	{
		$this->registry 	= $registry;
		$this->DB	    	= $this->registry->DB();
		$this->settings		=& $this->registry->fetchSettings();
		$this->request		=& $this->registry->fetchRequest();
		$this->member   	= $this->registry->member();
		$this->memberData	=& $this->registry->member()->fetchMemberData();
		$this->cache		= $this->registry->cache();
		$this->caches		=& $this->registry->cache()->fetchCaches();
		$this->lang 		= $this->registry->class_localization;
	}

//===========================================================================
// Show Keywords
//===========================================================================
function keywords( $pagination, $keywords ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['keywords_title']}</h2>
</div>

<div class='information-box'>
	{$this->lang->words['keywords_blurb']}
</div>
<br />

<div class='acp-box'>
	<h3>{$this->lang->words['keywords_title']}</h3>
	<table class='ipsTable'>
		<tr>
			<th>{$this->lang->words['keywords_keyword']}</th>
			<th>{$this->lang->words['keywords_count']}</th>
		</tr>
HTML;

		if ( !empty( $keywords ) )
		{
		
			foreach ( $keywords as $keyword )
			{
				$IPBHTML .= <<<HTML
		<tr>
			<td><a href="{$this->settings['base_url']}module=activity&do=visitors&keyword={$keyword['keyword']}">{$keyword['keyword']}</a></td>
			<td>{$keyword['count']}</td>
		</tr>		
HTML;
			}
			
		}
		else
		{
				$IPBHTML .= <<<HTML
		<tr>
			<td colspan='2' class='no_messages'>{$this->lang->words['keywords_none']}</td>
		</tr>		
HTML;
		}
		
$IPBHTML .= <<<HTML
	</table>
</div>
<br />
{$pagination}

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Show Keywords
//===========================================================================
function visitors( $pagination, $visitors ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['visitors_title']}</h2>
</div>

<div class='information-box'>
	{$this->lang->words['visitors_blurb']}
</div>
<br />

<div class='acp-box'>
	<h3>{$this->lang->words['visitors_title']}</h3>
	<table class='ipsTable'>
		<tr>
			<th>{$this->lang->words['visitors_member']}</th>
			<th>{$this->lang->words['visitors_date']}</th>
			<th>{$this->lang->words['visitors_keywords']}</th>
			<th>{$this->lang->words['visitors_engine']}</th>
			<th>{$this->lang->words['visitors_page']}</th>
		</tr>
HTML;

		if ( !empty( $visitors ) )
		{
		
			foreach ( $visitors as $visitor )
			{
				$IPBHTML .= <<<HTML
		<tr>
			<td>
HTML;
			if ( $visitor['member']['member_id'] )
			{
				$IPBHTML .= <<<HTML
				<a href="{$this->settings['base_url']}app=members&module=members&section=members&do=viewmember&member_id={$visitor['member']['member_id']}">{$visitor['member']['members_display_name']}</a>
HTML;
			}
			else
			{
				$IPBHTML .= <<<HTML
				{$visitor['member']['members_display_name']}
				
HTML;
			}
			
			
			$IPBHTML .= <<<HTML
			</td>
			<td>{$visitor['date']}</td>
			<td><a href="{$this->settings['base_url']}module=activity&do=visitors&keyword={$visitor['keywords']}">{$visitor['keywords']}</a></td>
			<td><a href="{$this->settings['base_url']}module=activity&do=visitors&engine={$visitor['engine']}">{$visitor['engine']}</a></td>
			<td><a target="_blank" href="{$this->settings['public_url']}{$visitor['url']}">{$visitor['page']}</a></td>
		</tr>		
HTML;
			}
			
		}
		else
		{
				$IPBHTML .= <<<HTML
		<tr>
			<td colspan='2' class='no_messages'>{$this->lang->words['visitors_none']}</td>
		</tr>		
HTML;
		}
		
$IPBHTML .= <<<HTML
	</table>
</div>
<br />
{$pagination}

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Dashboard
//===========================================================================
function dashboard( $keywords, $spiders, $visitors ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['dashboard_title']}</h2>
	<div class='ipsActionBar clearfix'>
		<ul>
			<li class='ipsActionButton'><a href='#' class='ipbmenu' id='date'><img src='{$this->settings['skin_app_url']}images/calendar.png' /> {$this->lang->words['dashboard_graphs_date']}<img src='{$this->settings['skin_acp_url']}/images/dropdown.png' /></a></li>
		</ul>
	</div>
</div>

<ul class='ipbmenu_content' id='date_menucontent' style='display: none'>
	<li><img src='{$this->settings['skin_app_url']}images/calendar-d.png' /> <a href='{$this->settings['base_url']}module=activity&do=dashboard&days=1' style='text-decoration: none' >{$this->lang->words['dashboard_graphs_day']}</a></li>
	<li><img src='{$this->settings['skin_app_url']}images/calendar-w.png' /> <a href='{$this->settings['base_url']}module=activity&do=dashboard&days=7' style='text-decoration: none' >{$this->lang->words['dashboard_graphs_week']}</a></li>
	<li><img src='{$this->settings['skin_app_url']}images/calendar-m.png' /> <a href='{$this->settings['base_url']}module=activity&do=dashboard&days=28' style='text-decoration: none' >{$this->lang->words['dashboard_graphs_month']}</a></li>
</ul>

<div class='acp-box'>
	<h3>{$this->lang->words['dashboard_visitors']}</h3>
	<div style='padding: 5px; text-align: center'>
		<img src="{$this->settings['base_url']}module=activity&section=activity&do=search_chart&days={$this->request['days']}" />
	</div>
</div>
<br />

<div class='acp-box'>
	<h3>{$this->lang->words['dashboard_spiders']}</h3>
	<div style='padding: 5px; text-align: center'>
		<img src="{$this->settings['base_url']}module=activity&section=activity&do=spider_chart&days={$this->request['days']}" />
	</div>
</div>
<br />

<div style='width: 49%; float: left'>
	
	<div class='acp-box'>
		<h3>{$this->lang->words['dashboard_keywords']}</h3>
		<table class='ipsTable'>
			<tr>
				<th>{$this->lang->words['keywords_keyword']}</th>
				<th>{$this->lang->words['keywords_count']}</th>
			</tr>
HTML;
	
			if ( !empty( $keywords ) )
			{
			
				foreach ( $keywords as $keyword )
				{
					$IPBHTML .= <<<HTML
			<tr>
				<td><a href="{$this->settings['base_url']}module=activity&do=visitors&keyword={$keyword['keyword']}">{$keyword['keyword']}</a></td>
				<td>{$keyword['count']}</td>
			</tr>		
HTML;
				}
				
			}
			else
			{
					$IPBHTML .= <<<HTML
			<tr>
				<td colspan='2' class='no_messages'>{$this->lang->words['keywords_none']}</td>
			</tr>		
HTML;
			}
			
	$IPBHTML .= <<<HTML
		</table>
HTML;
		if ( !empty( $keywords ) )
		{
			$IPBHTML .= <<<HTML
			<div class='acp-actionbar'>
				<a href='{$this->settings['base_url']}module=activity&do=keywords' class='button'>{$this->lang->words['dashboard_all']}</a>
			</div>
HTML;
		}
		$IPBHTML .= <<<HTML
	</div>
	<br />
	
</div>

<div style='width: 49%; float: right'>
	
	<div class='acp-box'>
		<h3>{$this->lang->words['dashboard_spiders']}</h3>
		<table class='ipsTable'>
			<tr>
				<th>{$this->lang->words['spiders_spider']}</th>
				<th>{$this->lang->words['spiders_date']}</th>
				<th>{$this->lang->words['spiders_page']}</th>
			</tr>
HTML;
	
			if ( !empty( $spiders ) )
			{
			
				foreach ( $spiders as $spider )
				{
					$IPBHTML .= <<<HTML
			<tr>
				<td><a href="{$this->settings['base_url']}module=activity&engine={$spider['bot']}">{$spider['bot']}</a></td>
				<td>{$spider['entry_date']}</td>
				<td><a target="_blank" href="{$this->settings['public_url']}{$spider['url']}">{$spider['page']}</a></td>
			</tr>		
HTML;
				}
				
			}
			else
			{
					$IPBHTML .= <<<HTML
			<tr>
				<td colspan='3' class='no_messages'>{$this->lang->words['spiders_none']}</td>
			</tr>		
HTML;
			}
			
	$IPBHTML .= <<<HTML
		</table>
HTML;
		if ( !empty( $spiders ) )
		{
			$IPBHTML .= <<<HTML
			<div class='acp-actionbar'>
				<a href='{$this->settings['base_url']}app=core&module=logs&section=spiderlogs' class='button'>{$this->lang->words['dashboard_all']}</a>
			</div>
HTML;
		}
		$IPBHTML .= <<<HTML
	</div>
	<br />

</div>

<br style='clear: both' />

<div class='acp-box'>
	<h3>{$this->lang->words['dashboard_visitors']}</h3>
	<table class='ipsTable'>
		<tr>
			<th>{$this->lang->words['visitors_member']}</th>
			<th>{$this->lang->words['visitors_date']}</th>
			<th>{$this->lang->words['visitors_keywords']}</th>
			<th>{$this->lang->words['visitors_engine']}</th>
			<th>{$this->lang->words['visitors_page']}</th>
		</tr>
HTML;

		if ( !empty( $visitors ) )
		{
		
			foreach ( $visitors as $visitor )
			{
				$IPBHTML .= <<<HTML
		<tr>
			<td>
HTML;
			if ( $visitor['member']['member_id'] )
			{
				$IPBHTML .= <<<HTML
				<a href="{$this->settings['base_url']}app=members&module=members&section=members&do=viewmember&member_id={$visitor['member']['member_id']}">{$visitor['member']['members_display_name']}</a>
HTML;
			}
			else
			{
				$IPBHTML .= <<<HTML
				{$visitor['member']['members_display_name']}
				
HTML;
			}
			
			
			$IPBHTML .= <<<HTML
			</td>
			<td>{$visitor['date']}</td>
			<td><a href="{$this->settings['base_url']}module=activity&do=visitors&keyword={$visitor['keywords']}">{$visitor['keywords']}</a></td>
			<td><a href="{$this->settings['base_url']}module=activity&do=visitors&engine={$visitor['engine']}">{$visitor['engine']}</a></td>
			<td><a target="_blank" href="{$this->settings['public_url']}{$visitor['url']}">{$visitor['page']}</a></td>
		</tr>		
HTML;
			}
			
		}
		else
		{
				$IPBHTML .= <<<HTML
		<tr>
			<td colspan='5' class='no_messages'>{$this->lang->words['visitors_none']}</td>
		</tr>		
HTML;
		}
		
$IPBHTML .= <<<HTML
	</table>
HTML;
	if ( !empty( $keywords ) )
	{
		$IPBHTML .= <<<HTML
	<div class='acp-actionbar'>
		<a href='{$this->settings['base_url']}module=activity&do=visitors' class='button'>{$this->lang->words['dashboard_all']}</a>
	</div>
HTML;
	}
	$IPBHTML .= <<<HTML
</div>

HTML;

//--endhtml--//
return $IPBHTML;
}

}