<?php
/**
 * @file		cp_skin_forum_form_ipseo.php 	IP.SEO forum form skin file
 *~TERABYTE_DOC_READY~
 * $Copyright: © 2001 - 2011 Invision Power Services, Inc.$
 * $License: http://www.invisionpower.com/company/standards.php#license$
 * $Author: ips_terabyte $
 * @since		12th August 2011
 * $LastChangedDate: 2011-09-01 08:16:37 -0400 (Thu, 01 Sep 2011) $
 * @version		v1.5.1
 * $Revision: 9439 $
 */

/**
 *
 * @class		cp_skin_forum_form_ipseo
 * @brief		IP.SEO forum form skin file
 */
 
class cp_skin_forum_form_ipseo
{
	/**
	 * Constructor
	 *
	 * @param	object		$registry		Registry object
	 * @return	@e void
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

/**
 * Main form to edit forum settings
 *
 * @param	array		$member		forum data
 * @param	mixed		$tabId		Tab ID
 * @return	@e string	HTML
 */
public function acp_forum_form_main( $forum, $tabID ) {
$IPBHTML = "";

$dropdown = $this->registry->getClass('output')->formDropdown(
	'ipseo_priority',
	array(
		array( '1', '1' ),
		array( '0.9', '0.9' ),
		array( '0.8', '0.8' ),
		array( '0.7', '0.7' ),
		array( '0.6', '0.6' ),
		array( '0.5', '0.5' ),
		array( '0.4', '0.4' ),
		array( '0.3', '0.3' ),
		array( '0.2', '0.2' ),
		array( '0.1', '0.1' ),
		array( '0', $this->lang->words['sitemap_priority_ignore'] ),
		array( '', $this->lang->words['sitemap_priority_inherit'] ),
		),
	( $forum['ipseo_priority'] === '' ) ? 0 : $forum['ipseo_priority']
	);


$IPBHTML .= <<<HTML
<div id='tab_IPSEO_{$tabID}_content'>
	<table class='ipsTable double_pad'>
		<tr>
			<td class='field_title'><strong class='title'>{$this->lang->words['sitemap_forum_priority']}</strong></td>
			<td class='field_field'>
				{$dropdown}<br />
				<span class='desctext'>{$this->lang->words['sitemap_forum_priority_desc']}</span>
			</td>
		</tr>
	</table>
</div>

HTML;

return $IPBHTML;
}

/**
 * Tabs for the forum form
 *
 * @param	array		$member		forum data
 * @param	mixed		$tabId		Tab ID
 * @return	@e string	HTML
 */
public function acp_forum_form_tabs( $forum, $tabID ) {

$IPBHTML = "";

$IPBHTML .= "<li id='tab_IPSEO_{$tabID}'>{$this->lang->words['sitemap']}</li>";

return $IPBHTML;
}

}