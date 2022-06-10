<?php
/**
 * <pre>
 * Invision Power Services
 * IP.SEO ACP Skin - Sitemap
 * Last Updated: $Date: 2011-09-20 08:33:47 -0400 (Tue, 20 Sep 2011) $
 * </pre>
 *
 * @author 		$Author: mark $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 9515 $
 */
 
class cp_skin_sitemap
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
// Log
//===========================================================================
function log( $log, $last ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['sitemaplog_title']}</h2>
</div>

<div class='information-box'>
	{$last}
</div>
<br />

<div class='acp-box'>
	<h3>{$this->lang->words['sitemaplog_log']}</h3>
	<table class='ipsTable'>
		<tr>
			<th>{$this->lang->words['sitemaplog_time']}</th>
			<th>{$this->lang->words['sitemaplog_action']}</th>
		</tr>
HTML;

	foreach ( $log as $l )
	{
		preg_match( '/(.+?) - (.+?)$/', $l, $matches );
	
		$IPBHTML .= <<<HTML
		<tr>
			<td>{$matches[1]}</td>
			<td>{$matches[2]}</td>
		</tr>
HTML;
	}

$IPBHTML .= <<<HTML
	</table>
</div>

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Cron Instructions
//===========================================================================
function cronInstructions() {

$this->lang->words['sitemap_cron_2'] = str_replace( '{path}', ( ( array_key_exists( '_', $_SERVER ) ? $_SERVER['_'] : '/usr/bin/php' ) . ' ' . IPS_ROOT_PATH . 'applications_addon/ips/ipseo/sources/cron.php' ), $this->lang->words['sitemap_cron_2'] );

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['sitemap_cron_title']}</h2>
</div>

<strong>{$this->lang->words['sitemap_cron_header1']}</strong>
<br />
{$this->lang->words['sitemap_cron_1']}<br />
<br />

<strong>{$this->lang->words['sitemap_cron_header2']}</strong>
<br />
{$this->lang->words['sitemap_cron_2']}<br />
<br />

{$this->lang->words['sitemap_cron_3']}

HTML;

//--endhtml--//
return $IPBHTML;
}


}