<?php
/**
 * (SN) PM Viewer
 * ACP skin file
 * Last Updated: July 2nd 2011
 *
 * @author 		signet51
 * @copyright	(c) 2011 signet51 Modding
 * @version		1.6.4a (1641)
 *
 */
 
class cp_skin_pmviewer extends output
{

/**
 * Prevent our main destructor being called by this class
 *
 * @access	public
 * @return	void
 */
public function __destruct()
{
}

/**
 * Copyright line
 *
 * @access	public
 * @param	string 		Version number
 * @param	string		Copyright year
 * @return	string		HTML
 */
public function copyright() {

$pmviewer_details 	= $this->caches['app_cache']['pmviewer'];
$year				= date( "Y" );

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<br />
<div style='color:#777; font-size:12px' class='right'><a href="{$pmviewer_details['app_website']}" style='color:#777'>{$this->lang->words['mod_title']}</a> v{$pmviewer_details['app_version']}, by <a href="http://community.invisionpower.com/user/146193-signet51/" style='color:#777'>signet51</a>, &copy; {$year}</div>
HTML;

//--endhtml--//
return $IPBHTML;
}

/**
 * List all the different conversations that are going on
 *
 * @access	public
 * @param	array 		All the conversations that there are
 * @param	array			The pagination links
 * @return	string		HTML
 */
public function list_conversations( $conversations, $clinks ) {

$form_array = array(
					  0 => array( 'subject'   , $this->lang->words['topic'] ),
					  1 => array( 'name_from' , $this->lang->words['starter'] ),
					  2 => array( 'name_to'   , $this->lang->words['to'] ),
					  3 => array( 'message'   , $this->lang->words['pm_content_search'] ),
					  4 => array( 'topic_id'  , $this->lang->words['topic_id'] ),
				   );
				   
$type_array = array(
					  0 => array( 'exact'      , $this->lang->words['pm_search_exact'] ),
					  1 => array( 'loose'      , $this->lang->words['pm_search_like']   ),
				   );
$form				= array();

$form['type']		= $this->registry->output->formDropdown( "type" , $form_array, $this->request['type'] ? $this->request['type'] : ( $this->settings['pmviewer_keyword_search_on'] ? 'topic_id' : 'subject' ) );
$form['match']		= $this->registry->output->formDropdown( "match", $type_array, $this->request['match'] );
$form['string']		= $this->registry->output->formInput( "string", $this->request['string'] ? $this->request['string'] : $this->request['id'] );

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<script type='text/javascript' src='{$this->settings['js_main_url']}acp.forms.js'></script>
<style>.deleted{background-color:#f2e4e7 !important;}
</style>
<div class='section_title'>
	<h2>{$this->lang->words['mod_title']} <span style='font-size:12px'>- <a style='text-decoration:none' href='{$this->settings['base_url']}{$this->form_code}&amp;do=editSettings&amp;pc_key=pmviewer'>{$this->lang->words['pm_settings']}</a></span></h2>
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='pmviewerForm'  id='pmviewerForm'>
	<input type='hidden' name='do' value='list' />
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
	<div class="acp-box">
		<h3 style='overflow:hidden; font-size:17px; font-weight:normal; padding:8px; margin:0px; -moz-border-radius:5px 5px 0px 0px;-webkit-border-radius:5px 5px 0px 0px;'>{$this->lang->words['pm_search_main']}</h3>
		<table class='ipsTable double_pad'>
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['pm_search_where']}</strong></td>
				<td class='field_field'>{$form['type']} {$form['match']} {$form['string']}</td>
			</tr>
		</table>
		
		<div class="acp-actionbar">
			<input value="{$this->lang->words['pm_search']}" class="button primary" accesskey="s" type="submit" />
		</div>
	</div>
</form>



<br /><br />
{$clinks}<br /><br />
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='pmviewerForm'  id='pmviewerForm'>
<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
<div class='acp-box'>
	<h3 style='overflow:hidden; font-size:17px; font-weight:normal; padding:8px; margin:0px; -moz-border-radius:5px 5px 0px 0px;-webkit-border-radius:5px 5px 0px 0px;'>{$this->lang->words['overview_title']}</h3>
		<table class='ipsTable' width='100%'>
		<tr>
			<th style="width: 15%;">{$this->lang->words['starter']}</th>
			<th style="width: 40%;">{$this->lang->words['topic']}</th>
			<th style="width: 15%;">{$this->lang->words['to']}</th>
			<th style="width: 7%;">{$this->lang->words['replies']}</th>
			<th style="width: 20%;">{$this->lang->words['last_message']}</th>
			<th style="width: 3%;"><input type='checkbox' title="{$this->lang->words['my_checkall']}" id='checkAll' /></th>
		</tr>
HTML;
		if ( count( $conversations ) )
		{
			foreach ( $conversations as $conversation )
			{
		$IPBHTML .= <<<HTML
		<tr>
HTML;
		if ( $conversation['author'] != '')
		{
		$IPBHTML .= <<<HTML
			<td class='{$conversation['source']}'><a style='text-decoration:none' href='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do=list&amp;type=fromid&amp;id={$conversation['mt_starter_id']}' title='{$this->lang->words['pm_find_sent']}'><img src='{$this->settings['skin_acp_url']}/images/icons/view.png' border='0' alt='{$this->lang->words['pm_find_sent']}'></a><a style='text-decoration:none' href='{$this->settings['_base_url']}&app=members&&module=members&section=members&do=viewmember&member_id={$conversation['mt_starter_id']}' title='{$this->lang->words['pm_edit_member']}'>{$conversation['a_prefix']}{$conversation['author']}{$conversation['a_suffix']}</a></td>
HTML;
		}
		else
		{
		$IPBHTML .= <<<HTML
			<td class='{$conversation['source']}'>{$this->settings['guest_name_pre']} {$this->lang->words['pm_deleted_member']} {$this->settings['guest_name_suf']}</td>
HTML;
		}
		$IPBHTML .= <<<HTML
			<td class='{$conversation['source']} larger_text'><a style='text-decoration:underline; font-weight:bold' href='{$this->settings['base_url']}{$this->form_code}&do=viewTopic&id={$conversation['id']}{$highlight}' title='{$this->lang->words['pm_read_pm']}'>{$conversation['mt_title']}</a>
HTML;
		if ( $conversation['mt_is_draft'] )
		{
			$IPBHTML .= <<<HTML
			<span style='color:#990000;'>({$this->lang->words['pm_draft']})</span>
HTML;
		}
		$IPBHTML .= <<<HTML
			</td>
HTML;
		if ( $conversation['recipient'] != '')
		{
		$IPBHTML .= <<<HTML
			<td class='{$conversation['source']}'><a style='text-decoration:none' href='{$this->settings['base_url']}&amp;{$this->form_code}&amp;do=list&amp;type=toid&amp;id={$conversation['mt_to_member_id']}' title='{$this->lang->words['pm_find_to']}'><img src='{$this->settings['skin_acp_url']}/images/icons/view.png' border='0' alt='{$this->lang->words['pm_find_to']}'></a><a style='text-decoration:none' href='{$this->settings['_base_url']}&app=members&&module=members&section=members&do=viewmember&member_id={$conversation['mt_to_member_id']}' title='{$this->lang->words['pm_edit_member']}'>{$conversation['r_prefix']}{$conversation['recipient']}{$conversation['r_suffix']}</a>
HTML;
		}
		else
		{
		$IPBHTML .= <<<HTML
			<td class='{$conversation['source']}'>{$this->lang->words['pm_deleted_member']}
HTML;
		}
		
		if ( $conversation['count'] == 1 )
		{
			$IPBHTML .= <<<HTML
			<br /><span title="{$conversation['invitedMemberNames']}">({$this->lang->words['and']} 1 {$this->lang->words['other']})</span>
HTML;
		}
		else if ( $conversation['count'] > 1 )
		{
			$IPBHTML .= <<<HTML
			<br /><span title="{$conversation['invitedMemberNames']}">({$this->lang->words['and']} {$conversation['count']} {$this->lang->words['others']})</span>
HTML;
		}
			$IPBHTML .= <<<HTML
			</td>
			<td class='{$conversation['source']}'>{$conversation['mt_replies']}</td>
			<td class='{$conversation['source']}'><a style='text-decoration:none;' href='{$this->settings['base_url']}{$this->form_code}&do=viewTopic&id={$conversation['id']}{$highlight}&viewLast=1#msg{$conversation['mt_last_msg_id']}' title='{$this->lang->words['view_last']}'><img src="{$this->settings['skin_acp_url']}/images/last_post.png" alt="{$this->lang->words['view_last']}"></a> <a style='text-decoration:none' href='{$this->settings['base_url']}{$this->form_code}&do=viewTopic&id={$conversation['id']}{$highlight}&viewLast=1#msg{$conversation['mt_last_msg_id']}' title='{$this->lang->words['view_last']}'>{$conversation['lastupdated']}</a></td>
			<td class='{$conversation['source']}'><input type='checkbox' name='id_{$conversation['id']}' value='1' class='checkAll' /></td>
		</tr>
HTML;

			}
		}
		else
		{
			$IPBHTML .= <<<HTML
			<tr>
				<td colspan='6' class='no_messages'>{$this->lang->words['no_convos']}</td>
			</tr>
HTML;
		}
		
		$IPBHTML .= <<<HTML
	
 	</table>
	<div class="acp-actionbar">
		<div class="left">{$clinks}</div>
		<div class="right">
			<select id='pm_options' name='do' class='input_select'>
				<optgroup label="{$this->lang->words['pm_with_select']}">
					<option value="hideTopics">{$this->lang->words['pm_hide_selected']}</option>
					<option value="deleteTopic">{$this->lang->words['pm_delete_selected']}</option>
				</optgroup>
				<optgroup label="{$this->lang->words['pm_all_conversations']}">
					<option value="hideTopics_all">{$this->lang->words['pm_hide_all_pages']}</option>
				</optgroup>
			</select>
			<input type="submit" class='button primary' id='convsation_moderation' value="{$this->lang->words['pm_go']}" />
		</div>
		<br class='clear' />
	</div>
				
	</div>
</div>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}

/**
 * List each message within the conversation
 *
 * @access	public
 * @param	array 		The data about the actual messages
 * @param	array 		The pagination again
 * @param	array 		The conversation title
 * @param	array 		Who is participating in this conversation
 * @return	string		HTML
 */
public function list_topics( $messages, $tlinks, $plinks, $row, $membersdata ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<script type='text/javascript' src='{$this->settings['js_main_url']}acp.forms.js'></script><link rel="stylesheet" type="text/css" media='screen' href="{$this->settings['skin_acp_url']}/pmviewerbbcode.css" />
<script type='text/javascript' src='{$this->settings['public_dir']}js/3rd_party/lightbox.js'></script>
<script type='text/javascript'>
//<![CDATA[
	// Lightbox Configuration
	LightboxOptions = Object.extend({
	    fileLoadingImage:        '{$this->settings['img_url']}/lightbox/loading.gif',     
	    fileBottomNavCloseImage: '{$this->settings['img_url']}/lightbox/closelabel.gif',
	    overlayOpacity: 0.8,   // controls transparency of shadow overlay
	    animate: true,         // toggles resizing animations
	    resizeSpeed: 7,        // controls the speed of the image resizing animations (1=slowest and 10=fastest)
	    borderSize: 10,         //if you adjust the padding in the CSS, you will need to update this variable
		// When grouping images this is used to write: Image # of #.
		// Change it for non-english localization
		labelImage: "{$this->lang->words['lightbox_label']}",
		labelOf: "{$this->lang->words['lightbox_of']}"
	}, window.LightboxOptions || {});
/* Watch for a lightbox image and set up our downloadbutton watcher */
document.observe('click', (function(event){
    var target = event.findElement('a[rel^=lightbox]') || event.findElement('area[rel^=lightbox]');
    if (target) {
        event.stop();
        gbl_addDownloadButton();
    }
}).bind(this));
var _to    = '';
var _last  = '';
function gbl_addDownloadButton()
{
	if ( typeof( ipsLightbox.lightboxImage ) != 'undefined' && ipsLightbox.lightboxImage.src )
	{
		if ( _last != ipsLightbox.lightboxImage.src )
		{
			if ( ! $('gbl_d') )
			{
				$('bottomNav').insert( { top: "<div id='gbl_d' style='text-align:right;padding-bottom:4px;'></div>" } );
			}
			
			$('gbl_d').update( "<a href='"+ ipsLightbox.lightboxImage.src + "' target='_blank'><img src='{$this->settings['img_url']}/lightbox/download-icon.png' /></a>" );
			
			_last = ipsLightbox.lightboxImage.src;
		}
	}
	
	/* Check for init and then keep checking for new image */
	_to = setTimeout( "gbl_addDownloadButton()", 1000 );
}
//]]>
</script>

<style>a.name:link{color:#225985;}
a.name:visited{color:#225985;}
a.name:active{color:#225985;}
a.name:hover{color:#528f6c;}
.message_controls li a {opacity: 0.2; -webkit-transition: all 0.2s ease-in-out; -moz-transition: all 0.5s ease-in-out;}
div.message_controls a {height:22px; line-height:22px; padding: 0 8px; color: #1D3652; text-decoration: none; margin-left: 4px; display: block;}
div.message_controls a:hover{color:#3D70A3;}
.post_block:hover .message_controls li a {opacity: 1;}
#prevLink:hover, #prevLink:visited:hover { background: url({$this->settings['img_url']}/lightbox/prevlabel.gif) left 15% no-repeat; }
#nextLink:hover, #nextLink:visited:hover { background: url({$this->settings['img_url']}/lightbox/nextlabel.gif) right 15% no-repeat; }
</style>

<div class='section_title'>
	<h2>{$this->lang->words['mod_title']}</h2>	
</div>
<div class='acp-box'>
	<h3>{$this->lang->words['members_in']}</h3>
	<table class='ipsTable'>
		<tr>
			<th style='width:50%'>{$this->lang->words['member_name']}:</th>
			<th style='width:25%'>{$this->lang->words['status']}:</th>
			<th style='width:25%'>{$this->lang->words['last_read']}:</th>
		</tr>
	</table>
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='pmviewerForm'  id='pmviewerForm'>
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
	<div class='acp-box' style='max-height:150px; overflow:auto;'>		
		<table class='ipsTable' style='font-size:14px'>
HTML;
if ( count ($membersdata ) )
{
	foreach ( $membersdata as $memberdata )
	{
		$IPBHTML .= <<<HTML
			<tr>
				<td style='width:50%'><span class='larger_text'>{$memberdata['prefix']}{$memberdata['members_display_name']}{$memberdata['suffix']}</span>
HTML;
				if ( ! $memberdata['map_is_starter'] AND $memberdata['map_user_active'] AND ! $memberdata['map_user_banned'] AND $memberdata['blockable'] AND ! $row['mt_is_system'] AND ! $row['mt_is_draft'] )
				{
					$IPBHTML .= <<<HTML
					<a href='{$this->settings['base_url']}{$this->form_code}&do=blockUser&tid={$row['mt_id']}&mid={$memberdata['member_id']}&block=1' style='color:#990000;font-size:0.8em;text-decoration:none'>({$this->lang->words['pm_block']})</a>
HTML;
				}
				elseif ( ! $memberdata['map_is_starter'] AND ! $memberdata['map_user_active'] AND $memberdata['map_user_banned'] AND $memberdata['blockable'] AND ! $row['deleted'] AND ! $row['mt_is_system'] AND ! $row['mt_is_draft'] )
				{
					$IPBHTML .= <<<HTML
					<a href='{$this->settings['base_url']}{$this->form_code}&do=blockUser&tid={$row['mt_id']}&mid={$memberdata['member_id']}&block=0' style='color:#990000;font-size:0.8em;text-decoration:none'>({$this->lang->words['pm_unblock']})</a>
HTML;
				}
				$IPBHTML .= <<<HTML
				</td>
				<td style='width:25%'>
HTML;
				if ( $memberdata['map_user_banned'] > 0 )
				{
					$IPBHTML .= <<<HTML
					{$this->lang->words['blocked']}
HTML;
				}
				elseif ( $memberdata['map_user_active'] < 1 )
				{
					$IPBHTML .= <<<HTML
					{$this->lang->words['left_convo']}
HTML;
				}
				if ( $memberdata['map_is_starter'] > 0 OR $memberdata['map_user_id'] == $row['mt_starter_id'] )
				{
					if ( $memberdata['map_user_active'] < 1 )
					{
					$IPBHTML .= <<<HTML
					{$this->lang->words['was_starter']}
HTML;
					}
					else
					{
					$IPBHTML .= <<<HTML
					{$this->lang->words['starter']}
HTML;
					}
				}
			$IPBHTML .= <<<HTML
				</td>
				<td style='width:25%'>{$memberdata['map_read_time']}</td>
			</tr>
HTML;
	}
}
$IPBHTML .= <<<HTML
		</table>
	</div>
	<br /><br /><br />
	<div class='ipsActionBar clearfix'>
		<ul>
			<li class='non_button'>
				{$tlinks}
			</li>
			<li class='ipsActionButton closed right' style='float:right'>
				<a href="#" title='{$this->lang->words['pm_delete_convo']}' onclick="return acp.confirmDelete( '{$this->settings['base_url']}{$this->form_code}&do=deleteTopic&id={$row['mt_id']}')">
				<img src='{$this->settings['skin_acp_url']}/images/icons/delete.png' alt='{$this->lang->words['pm_delete']}' />
				{$this->lang->words['pm_delete_convo']}
				</a>
			</li>
			<li class='ipsActionButton closed right' style='float:right'>
				<a href="#" title='{$this->lang->words['pm_hide_convo']}' onclick="return acp.confirmDelete( '{$this->settings['base_url']}{$this->form_code}&do=hideTopic&id={$row['mt_id']}', '{$this->lang->words['ok_to_hide']}')">
				<img src='{$this->settings['skin_acp_url']}/images/icons/magnifier_zoom_out.png' alt='{$this->lang->words['pm_hide_selected']}' />
				{$this->lang->words['pm_hide_convo']}
				</a>
			</li>
HTML;
if ( $row['deleted'] == 1 OR $row['mt_is_system'] OR $row['mt_is_draft'] )
{
	$IPBHTML .= <<<HTML
			<li class='ipsActionButton disabled right' style='float:right'>
HTML;
	if ( $row['deleted'] )
	{
		$IPBHTML .= <<<HTML
				<span title='{$this->lang->words['pm_deleted_convo']}'>
HTML;
	}
	elseif ( $row['mt_is_system'] )
	{
		$IPBHTML .= <<<HTML
				<span title='{$this->lang->words['pm_no_join_system']}'>
HTML;
	}
	elseif ( $row['mt_is_draft'] )
	{
		$IPBHTML .= <<<HTML
				<span title='{$this->lang->words['pm_no_join_draft']}'>
HTML;
	}
	$IPBHTML .= <<<HTML
					<img src='{$this->settings['skin_acp_url']}/images/icons/page_add.png' alt='{$this->lang->words['pm_join']}' />
					{$this->lang->words['pm_no_join']}
				</span>
			</li>
HTML;
}
else
{
	$IPBHTML .= <<<HTML
			<li class='ipsActionButton right' style='float:right'>
				<a href='{$this->settings['base_url']}{$this->form_code}&do=joinTopic&id={$row['mt_id']}' title='{$this->lang->words['pm_join']}'>
					<img src='{$this->settings['skin_acp_url']}/images/icons/page_add.png' alt='{$this->lang->words['pm_join']}' />
					{$this->lang->words['pm_join_convo']}
				</a>
			</li>
HTML;
}
	$IPBHTML .= <<<HTML
		</ul>
	</div>
	<div class='acp-box'>
		<h3>{$this->lang->words['convo_topic']}: {$row['mt_title']}
HTML;
if ( $row['deleted'] AND $row['mt_is_draft'] )
{
	$IPBHTML .= <<<HTML
			<span style='color:#990000;'>({$this->lang->words['pm_deleted']} {$this->lang->words['pm_draft']})</span>
HTML;
}
if ( $row['mt_is_system'] )
{
	$IPBHTML .= <<<HTML
			<span style='color:#DCE6F3;'>({$this->lang->words['pm_system']})</span>
HTML;
}
else if ( $row['deleted'] )
{
	$IPBHTML .= <<<HTML
			<span style='color:#990000;'>({$this->lang->words['pm_deleted']})</span>
HTML;
}
else if ( $row['mt_is_draft'] )
{
	$IPBHTML .= <<<HTML
			<span style='color:#DCE6F3;'>({$this->lang->words['pm_draft']})</span>
HTML;
}
	$IPBHTML .= <<<HTML
			<input type='checkbox' title="{$this->lang->words['my_checkall']}" id='checkAll' style='float:right;margin-top:10px' />
		</h3>
		<div style='padding:9px; background:#EBF0F3'>
			<div style='background: white;'>
				<table class='ipsTable'>
HTML;
		if ( count( $messages ) )
		{
			$message_num = 0;
			foreach ( $messages as $message )
			{
				$message_num = $message_num + 1;
				if ( $message['member_id'] > 0)
				{
				$IPBHTML .= <<<HTML
					<tr>
						<div class='post_block'>
							<div style='font-weight:normal; font-size:16px; padding:0px 10px; height:36px; line-height:36px; background: #D8DDE8;'>
								<a class='name' style='text-decoration:none;' name='msg{$message['msg_id']}' href='{$this->settings['_base_url']}&app=members&&module=members&section=members&do=viewmember&member_id={$message['member_id']}'>{$message['members_display_name']}</a><a name='id{$message_num}'>&nbsp;</a>
							</div>
HTML;
					if ( $message['source'] == 'deleted' )
					{
						$IPBHTML .= <<<HTML
							<div style='background-color:#f2e4e7; float:left;'>
HTML;
					}
					else
					{
						$IPBHTML .= <<<HTML
							<div style='float:left; background-color:white'>
HTML;
					}
					$IPBHTML .= <<<HTML
								<div valign='top' style='width:155px; padding: 15px 10px; font-size:12px; text-align:center; background-color:white'>
									<ul>
										<li style='overflow:hidden; width:155px;color:#777;margin-bottom:5px;'>{$message['title']}</li>
										<li><img style='width:90px;height:90px;border: 1px solid #D5D5D5;padding:1px;background:white;-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1); box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1)' src='{$message['pp_thumb_photo']}' class='ipsUserPhoto ipsUserPhoto_large' /></li>
										<li style='font-weight:bold;color:#5A5A5A;margin-top:5px;'>{$message['_group_formatted']}</li>
HTML;
					if ($message['member_rank_img'])
					{
						if ($message['member_rank_img_i'] == 'img')
						{
							$IPBHTML .= <<<HTML
										<li style='margin-bottom:3px;'>
											<img src='{$message['member_rank_img']}' alt='' />
										</li>
HTML;
						}
						else
						{
							$IPBHTML .= <<<HTML
										<li style='margin-bottom:3px;'>
											{$message['member_rank_img']}
										</li>
HTML;
						}
					}
					$IPBHTML .= <<<HTML
										<li style='color:#A4A4A4'>{$message['posts']} {$this->lang->words['m_posts']}</li>
									</ul>
									<ul style='color:#818181;margin-top:8px'><!--Add something in here for custom fields--></ul>
HTML;
					if ( $this->settings['warn_on'] )
					{
						if ( $message['warn_percent'] !== NULL)
						{
							$IPBHTML .= <<<HTML
									<ul>
										<li>
											<br />
											<div style='text-align:center;margin:8px 0;border-radius:6px;-moz-border-radius:6px;-webkit-border-radius:6px;clear:both;'>
												<strong>
													<a style='text-decoration:none' class='name' href='#' onclick="return acp.openWindow('{$this->settings['board_url']}/index.php?app=core&amp;module=modcp&amp;section=editmember&amp;mid={$message['member_id']}&amp;do=view&amp;popup=1','980','600'); return false"; id='warn_link_{$contentid}_{$message['member_id']}' title='{$this->lang->words['sm_viewnotes']}'>{$this->lang->words['warn_status']}</a>
												</strong>
						
HTML;
							if ($message['warn_percent'] >= 80)
							{
								$IPBHTML .= <<<HTML
												<p style='margin: 0 auto; width: 80%; border:1px solid #D5DDE5;' title='{$this->lang->words['warn_level']} {$message['warn_percent']}%'>
													<span style='width: {$message['warn_percent']}%; min-width:0%; max-width:100%; background: #B82929 url({$this->settings['img_url']}/progressbar_warning.png) repeat-x center; color: #fff; font-size: 0em; font-weight: bold; text-align: center; text-indent: -2000em; /* Safari fix */ height: 6px; display: block; overflow: hidden;'><span style='display: none'>{$this->lang->words['warn_level']} {$message['warn_percent']}%</span></span>
HTML;
							}
							else
							{
								$IPBHTML .= <<<HTML
												<p style='margin: 0 auto; width: 80%; border:1px solid #D5DDE5; background-color:white' title='{$this->lang->words['warn_level']} {$message['warn_percent']}%'>
													<span style='width: {$message['warn_percent']}%; min-width:0%; max-width:100%; background: #243f5c url({$this->settings['img_url']}/gradient_bg.png) repeat-x left 50%; color: #fff; font-size: 0em; font-weight: bold; text-align: center; text-indent: -2000em; /* Safari fix */ height: 6px; display: block; overflow: hidden;'><span style='display: none'>{$this->lang->words['warn_level']} {$message['warn_percent']}%</span></span>
HTML;
							}
								$IPBHTML .= <<<HTML
												</p>
											</div>
										</li>
									</ul>
HTML;
						}
						$IPBHTML .= <<<HTML
								</div>
HTML;
					}
				}
				else
				{
					$IPBHTML .= <<<HTML
								<tr>
									<th colspan='2' style='font-weight:normal; font-size:16px; padding:0px 10px; height:36px; line-height:36px; background: #D8DDE8;'>
										<a class='name' style='text-decoration:none' name='msg{$message['msg_id']}'>{$message['members_display_name']}</a>
									</th>
								</tr>
								<tr>
									<td valign='top' style='width:155px; padding: 15px 10px; font-size:12px; text-align:center'>
										<ul>
											<li style='font-weight:bold;color:#5A5A5A;margin-top:5px;'>{$message['prefix']}{$this->lang->words['global_guestname']}{$message['suffix']}</li>
HTML;
					if ($message['member_rank_img'])
					{
						if ($message['member_rank_img_i'] == 'img')
						{
						$IPBHTML .= <<<HTML
											<li style='margin-bottom:3px;'>
												<img src='{$message['member_rank_img']}' alt='' />
											</li>
HTML;
						}
						else
						{
							$IPBHTML .= <<<HTML
											<li style='margin-bottom:3px;'>
												{$message['member_rank_img']}
											</li>
HTML;
						}
					}
					$IPBHTML .= <<<HTML
										</ul>
									</td>
								</tr>
HTML;
				}
				$IPBHTML .= <<<HTML
							</div>
							<div valign='top' style='background-color:white;margin:0 10px 0 185px;padding-top:15px'>
								<p style='padding:0 0 10px 0;font-size:12px;color:#777'>{$this->lang->words['pc_sent']} {$message['date']}<input type='checkbox' name='id_{$message['msg_id']}' value='1' class='checkAll' style='float:right'/></p>
								<div style='line-height: 1.6; font-size:14px; color:#282828;'>{$message['msg_post']}{$message['attachmentHtml']}</div>
HTML;
				if ($message['signature'] AND $this->memberData['view_sigs'])
				{
					$IPBHTML .= <<<HTML
								<div style='color: #A4A4A4; clear:right; font-size: 0.9em; border-top: 1px solid #D5D5D5; padding: 10px 0; margin: 6px 0 4px; position:relative;'>{$message['signature']}</div>
HTML;
				}
				$IPBHTML .= <<<HTML
								<br />
							</div>
							<div colspan='2' style='background-color:white' class='message_controls'>
								<div class='clearfix clear'>
									<ul class='right' style='padding:6px;margin:0 0 10px 0;display:inline-block;clear:both;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;'>
HTML;
				if ( ! $row['mt_is_system'] )
				{
					$IPBHTML .= <<<HTML
										<li class='right'>
											<a href="{$this->settings['base_url']}{$this->form_code}&do=editMessage&stID={$this->request['st']}&id={$message['msg_id']}">
												<span class='ipsBadge badge_green'>{$this->lang->words['pm_edit_message']}</span>
											</a>
										</li>
HTML;
				}
				if ( $row['mt_first_msg_id'] != $message['msg_id'] )
				{
					$IPBHTML .= <<<HTML
										<li class='right'>
											<a href="#" onclick="return acp.confirmDelete( '{$this->settings['base_url']}{$this->form_code}&do=deletePost&mid={$message['msg_id']}')">
												<span class='ipsBadge badge_red'>{$this->lang->words['pm_delete_selected']}</span>
											</a>
										</li>
HTML;
				}
				$IPBHTML .= <<<HTML
									</ul>
								</div>
							</div>
						</div>
					</tr>
HTML;
			}
		}
		
		$IPBHTML .= <<<HTML
				</table>
			</div>
		</div>
	</div>

HTML;

	$IPBHTML .= <<<HTML
<br />
	<span style='float:right'>
		<select id='pm_options' name='do' class='input_select'>
			<optgroup label="{$this->lang->words['pm_with_select']}">
				<option value="deletePost">{$this->lang->words['pm_delete_selected']}</option>
			</optgroup>
		</select>
		<input type="submit" class='button primary' id='convsation_moderation' value="{$this->lang->words['pm_go']}" />
	</span>
</form>
{$tlinks}
<br />
<br />
HTML;

//--endhtml--//
return $IPBHTML;
}

/**
 * Show the tools
 *
 * @access	public
 * @return	string		HTML
 */
public function tools() {

$interval_array = array(
						0 => array( 'day'	, $this->lang->words['pm_days'] ),
						1 => array( 'week'	, $this->lang->words['pm_weeks'] ),
						2 => array( 'month'	, $this->lang->words['pm_months'] ),
						3 => array( 'year'	, $this->lang->words['pm_years'] ),
						);
				   
$form				= array();

$form['time']		= $this->registry->output->formSimpleInput( "time", $this->request['time'], 1 );
$form['interval']	= $this->registry->output->formDropdown( "interval", $interval_array, $this->request['interval'] ? $this->request['interval'] : 'year' );
$form['groups']		= $this->registry->output->generateGroupDropdown( "groups[]", $this->request['groups'], TRUE );

$text = sprintf( $this->lang->words['pm_pruneConvo_option'], $form['time'], $form['interval'], $form['groups'] );

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<script type='text/javascript' src='{$this->settings['js_main_url']}acp.forms.js'></script><link rel="stylesheet" type="text/css" media='screen' href="{$this->settings['skin_acp_url']}/pmviewerbbcode.css" />
<style>A:hover{color:#528f6c; text-decoration:underline;}
</style>
<div class='section_title'>
	<h2>{$this->lang->words['mod_title']}</h2>	
</div>
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm'  id='theAdminForm'>
	<input type='hidden' name='do' value='oldmessages' />
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
	<div class="acp-box">
		<h3>{$this->lang->words['pm_pruneConvo_title']}</h3>
		<table class="ipsTable double_pad">
		<tr>
			<td>
				<span class='larger_text'>{$this->lang->words['pm_pruneConvo_msg']}</span>
			</td>
		</tr>
		<tr>
			<td>
				{$text}
			</td>
		</tr>
		</table>
		<div class="acp-actionbar">
			<input value="{$this->lang->words['pm_pruneConvo_title']}" class="button primary" type="submit" />
		</div>
	</div>
</form>
<br /><br />
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm'  id='theAdminForm'>
	<input type='hidden' name='do' value='unhide' />
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
	<div class="acp-box">
		<h3>{$this->lang->words['pm_unhide_all']}</h3>
		<table class="ipsTable">
		<tr class='ipsControlRow'>
			<td>
				<span class='larger_text'>{$this->lang->words['pm_unhide_desc']}.</span>
			</td>
		</tr>
		</table>
		<div class="acp-actionbar">
			<input value="{$this->lang->words['pm_unhide_all']}" class="button primary" type="submit" />
		</div>
	</div>
</form>
<br /><br />
<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm'  id='theAdminForm'>
	<input type='hidden' name='do' value='deleteLogs' />
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />
	<div class="acp-box">
		<h3>{$this->lang->words['pm_logs_empty']}</h3>
		<table class="ipsTable">
		<tr class='ipsControlRow'>
			<td>
				<span class='larger_text'>{$this->lang->words['pm_logs_empty_desc']}.</span>
			</td>
		</tr>
		</table>
		<div class="acp-actionbar">
			<input value="{$this->lang->words['pm_logs_empty']}" class="button primary" type="submit" />
		</div>
	</div>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}

/**
 * Show the confirmation screen about deleting all logs as it is a fairly major thing
 *
 * @access	public
 * @return	string		HTML
 */
public function deleteLogsConfirm() {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>{$this->lang->words['mod_title']}</h2>	
</div>

<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm'  id='theAdminForm'>
	<input type='hidden' name='do' value='deleteLogs' />
	<input type='hidden' name='confirm' value='1' />
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />

	<div class="acp-box">
		<h3>{$this->lang->words['pm_logs_empty']}?</h3>
		
		<table class='ipsTable'>
			<tr>
				<td>
					<span class='larger_text'>{$this->lang->words['pm_logs_empty_desc']}.<br /><br /><strong style="color:red">{$this->lang->words['pm_logs_empty_warn']}.</strong></span>
				</td>
			</tr>
		</table>
		
		<div class="acp-actionbar">
			<input value="{$this->lang->words['pm_go']}" class="button primary" type="submit" />
		</div>
	</div>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}

/**
 * Show the confirmation screen about pruning conversations as it is a fairly major thing
 *
 * @access	public
 * @return	string		HTML
 */
public function pruneConvosConfirm($data) {

$text = sprintf( $this->lang->words['pm_pruneConvo_confirm'], $data['time'], $data['interval'], $data['num_groups'], $data['count'] );

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>{$this->lang->words['mod_title']}</h2>	
</div>

<form action='{$this->settings['base_url']}{$this->form_code}' method='post' name='theAdminForm'  id='theAdminForm'>
	<input type='hidden' name='do' value='oldmessages' />
	<input type='hidden' name='confirm' value='1' />
	<input type='hidden' name='groups' value='{$data['groups']}' />
	<input type='hidden' name='time' value='{$data['time']}' />
	<input type='hidden' name='interval' value='{$data['interval']}' />
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->generated_acp_hash}' />

	<div class="acp-box">
		<h3>{$this->lang->words['pm_pruneConvo_title']}?</h3>
		
		<table class='ipsTable'>
			<tr>
				<td>
					<span class='larger_text'>{$text}.<br /><br /><strong style="color:red">{$this->lang->words['pm_logs_empty_warn']}.</strong></span>
				</td>
			</tr>
		</table>
		
		<div class="acp-actionbar">
			<input value="{$this->lang->words['pm_go']}" class="button primary" type="submit" />
		</div>
	</div>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}

/**
 * The form for editing posts
 *
 * @access	public
 * @return	string		HTML
 */
public function editPostForm($post,$form_element,$stID,$error) {

$IPBHTML = "";
//--starthtml--//

if ( $error )
{
	$IPBHTML .= <<<HTML
<div class='information-box'>
	<h4>{$this->lang->words['ipb_message']}</h4>
	{$error}
</div>
<br />
HTML;
}
$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>{$this->lang->words['mod_title']}</h2>	
</div>

<div class='acp-box'>
<h3>{$this->lang->words['pm_editing_message']}</h3>
<form action='{$this->settings['base_url']}{$this->form_code}&amp;do=editMessage_do' method='post' name='editForm' id='editForm'>
<input type='hidden' name='msgID' value='{$post['msg_id']}' />
<input type='hidden' name='stID' value='{$stID}' />
<table class='ipsTable double_pad'>
	<tr>
		<td>
			{$form_element}
		</td>
	</tr>
</table>
<div class='acp-actionbar'>
	<input type='submit' value='{$this->lang->words['pm_save']}' class='button'>
</div>
</form>	
</div>
HTML;

//--endhtml--//
return $IPBHTML;
}

}