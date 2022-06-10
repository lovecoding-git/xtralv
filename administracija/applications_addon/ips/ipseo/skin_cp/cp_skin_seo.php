<?php
/**
 * <pre>
 * Invision Power Services
 * IP.SEO ACP Skin - SEO
 * Last Updated: $Date: 2011-08-16 09:41:42 -0400 (Tue, 16 Aug 2011) $
 * </pre>
 *
 * @author 		$Author: mark $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 9394 $
 */
 
class cp_skin_seo
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
// Show Dashboard
//===========================================================================
function dashboard( $messages, $ignores ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['attention_title']}</h2>
HTML;
	if ( !empty( $ignores ) )
	{
		$IPBHTML .= <<<HTML
	<div class='ipsActionBar clearfix'>
		<ul>
			<li class='ipsActionButton'><a href='{$this->settings['base_url']}app=ipseo&module=seo&section=dashboard&do=clear_warnings'><img src='{$this->settings['skin_acp_url']}/images/icons/arrow_refresh.png' /> {$this->lang->words['attention_clear_warnings']}</a></li>
		</ul>
	</div>
HTML;
	}
	$IPBHTML .= <<<HTML
</div>

<div class='acp-box'>
	<h3>{$this->lang->words['attention_title']}</h3>
	<table class='ipsTable'>
HTML;
		if ( !empty( $messages ) )
		{
			foreach ( $messages as $message )
			{
				$IPBHTML .= <<<HTML
			<tr class='ipsControlRow'>
				<td><img src='{$this->settings['skin_app_url']}images/{$message['level']}.png' /></td>
				<td><span class='larger_text'>{$this->lang->words[ 'atn_' . $message['key'] . '_title' ]}</span><br /><span class='desctext'>{$this->lang->words[ 'atn_' . $message['key'] . '_desc' ]}</span></td>
				<td class='col_buttons'>
					<ul class='ipsControlStrip'>
						<li class='i_cog'><a href='{$this->settings['base_url']}{$message['fix']}' title='{$this->lang->words['attention_fix']}'>{$this->lang->words['attention_fix']}</a></li>
						<li class='i_delete'><a href='{$this->settings['base_url']}app=ipseo&module=seo&section=dashboard&do=ignore&key={$message['key']}' title='{$this->lang->words['attention_ignore']}'>{$this->lang->words['attention_ignore']}</a></li>
					</ul>
				</td>
			</tr>
HTML;
			}
		}
		else
		{
			$IPBHTML .= <<<HTML
		<tr>
			<td class='no_messages'>{$this->lang->words['attention_none']}</td>
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
// Meta Tags
//===========================================================================
function metaTags( $metaTags ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['meta_title']}</h2>
	<div class='ipsActionBar clearfix'>
		<ul>
			<li class='ipsActionButton'><a href='{$this->settings['base_url']}app=ipseo&module=seo&section=meta&do=add'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' /> {$this->lang->words['meta_add']}</a></li>
			<li class='ipsActionButton'><a href='{$this->settings['public_url']}app=ipseo&module=meta&section=meta&do=init' target='_blank'><img src='{$this->settings['skin_app_url']}/images/wand.png' /> {$this->lang->words['meta_magic']}</a></li>
		</ul>
	</div>
</div>

<div class='acp-box'>
	<h3>{$this->lang->words['meta_title']}</h3>
	<table class='ipsTable'>
HTML;
HTML;
		if ( !empty( $metaTags ) )
		{
			foreach ( $metaTags as $page => $tags )
			{
				$encodedPage = urlencode( $page );
				
				$IPBHTML .= <<<HTML
		<tr class='ipsControlRow'>
			<th class='subhead' colspan='2'>{$page}</th>
			<th class='subhead col_buttons'>
				<ul class='ipsControlStrip'>
					<li class='i_edit'><a href='{$this->settings['base_url']}app=ipseo&module=seo&section=meta&do=edit&page={$encodedPage}'>&nbsp;</a></li>
					<li class='i_delete'><a href='{$this->settings['base_url']}app=ipseo&module=seo&section=meta&do=delete&page={$encodedPage}'>&nbsp;</a></li>
				</ul>
			</th>
		</tr>
HTML;

				foreach ( $tags as $title => $content )
				{
					$IPBHTML .= <<<HTML
		<tr>
			<td>{$title}</td>
			<td>{$content}</td>
			<td class='col_buttons'>&nbsp;</th>
		</tr>
HTML;
				}

			}
		}
		else
		{
			$IPBHTML .= <<<HTML
		<tr>
			<td class='no_messages'>{$this->lang->words['meta_none']} <a href='{$this->settings['base_url']}app=ipseo&module=seo&section=meta&do=add' class='mini_button'>{$this->lang->words['meta_none_add']}</a></td>
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
// Meta Tag Form
//===========================================================================
function metaTagForm( $page, $tags ) {

$form['page'] = $this->registry->output->formInput( 'page', $page );

$startID = 0;

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<form id='tags-form' action='{$this->settings['base_url']}&amp;module=seo&amp;section=meta&amp;do=save' method='post'>
	<input type='hidden' name='old-page' value='{$page}' />

	<div class='section_title'>
		<h2>{$this->lang->words['meta_add']}</h2>
		<div class='ipsActionBar clearfix'>
			<ul>
				<li class='ipsActionButton'><a href='#' onclick="$('tags-form').submit();"><img src='{$this->settings['skin_acp_url']}/images/icons/tick.png' alt='' /> {$this->lang->words['meta_save']}</a></li>
			</ul>
		</div>
	</div>
	
	<div class='acp-box'>
		<h3>{$this->lang->words['meta_page']}</h3>
		<table class='ipsTable double_pad'>
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['meta_page']}</strong></td>
				<td class='field_field'>
					{$form['page']}<br />
					<span class='desctext'>{$this->lang->words['meta_page_desc']}</td>
				</td>
			</tr>
		</table>
	</div>
	<br />
	
	<div class='acp-box'>
		<h3>{$this->lang->words['meta_tags']}</h3>
		<table class='ipsTable double_pad' id='tags'>
			<tr>
				<th style='width='2%'>&nbsp;</th>
				<th>{$this->lang->words['meta_tag_title']}<br /><span class='desctext'>{$this->lang->words['meta_tag_title_desc']}</span></th>
				<th>{$this->lang->words['meta_tag_content']}</th>
				<th class='col_buttons'>&nbsp;</th>
			</tr>
HTML;

	foreach ( $tags as $title => $content )
	{
		$IPBHTML .= <<<HTML
			<tr class='ipsControlRow' id='tag_{$startID}'>
				<td>&nbsp;</td>
				<td id='display-title-{$startID}'><input name='title-{$startID}' id='title-{$startID}' value='{$title}' /></td>
				<td id='display-content-{$startID}'><textarea name='content-{$startID}' id='content-{$startID}'  rows='10' cols='40'>{$content}</textarea></td>
				<td>
					<ul class='ipsControlStrip'>
						<li class='i_delete'><a href='#' onclick='removeTag({$startID})'>&nbsp;</a></li>
					</ul>
				</td>
			</tr>
HTML;
		$startID++;
	}

$IPBHTML .= <<<HTML
		</table>
		<div class='acp-actionbar'>
			<a href='#' class='button' onclick='addTag()'>{$this->lang->words['meta_tag_add']}</a>
		</div>
	</div>
	
</form>

<script type='text/javascript'>

	var next = {$startID};
	
	function addTag()
	{		
		var row = $('tags').insertRow( $('tags').rows.length );
		row.id = 'tag_' + next;
		row.className = 'ipsControlRow';
		row.style.display = 'none';
								
		var cell_blank = row.insertCell(0);
		
		var cell_title = row.insertCell(1);
		cell_title.id = 'display-title-' + _popup;
		cell_title.innerHTML = "<input name='title-"+next+"' id='title-"+next+"' />";
		
		var cell_content = row.insertCell(2);
		cell_content.id = 'display-content-' + _popup;
		cell_content.innerHTML = "<textarea name='content-"+next+"' id='content-"+next+"' rows='10' cols='40'></textarea>";
		
		var cell_delete = row.insertCell(3);
		cell_delete.innerHTML = "<ul class='ipsControlStrip'><li class='i_delete'><a onclick='removeTag("+next+")' style='cursor:pointer'>&nbsp;</a></li></ul>";
		
		new Effect.Appear( row, {duration:0.5} );
		
		next++;
	}
	
	function removeTag( id )
	{
		$( 'title-' + id ).value = '';
		$( 'content-' + id ).value = '';
		
		new Effect.Fade( $('tag_'+id), {duration:0.5} );
	}

</script>

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Add Meta Tag
//===========================================================================
function addTag( $popup, $title='', $content='' ) {
$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='acp-box'>
	<h3>
HTML;
	if ( $title )
	{
		$IPBHTML .= <<<HTML
		{$this->lang->words['meta_tag_edit']}
HTML;
	}
	else
	{
		$IPBHTML .= <<<HTML
		{$this->lang->words['meta_tag_add']}
HTML;
	}
	$IPBHTML .= <<<HTML
	</h3>
	<table class="ipsTable double_pad" style='width:100%'>
		<tr>
			<td class='field_title'><strong class='title'>{$this->lang->words['meta_tag_title']}</strong></td>
			<td class='field_field'>
				<input id='input-title-{$popup}' value='{$title}' /><br />-{$popup}-
				<span class='desctext'>{$this->lang->words['meta_tag_title_desc']}</span>
			</td>
		</tr>
		<tr>
			<td class='field_title'><strong class='title'>{$this->lang->words['meta_tag_content']}</strong></td>
			<td class='field_field'><textarea id='input-content-{$popup}' rows='10' cols='40'>{$content}</textarea></td>
		</tr>
	</table>
	<div class='acp-actionbar'>
HTML;
	if ( $title )
	{
		$IPBHTML .= <<<HTML
		<input type='button' id='popup-save' onclick='doEditTag()' value='{$this->lang->words['meta_save']}' class='realbutton' />
HTML;
	}
	else
	{
		$IPBHTML .= <<<HTML
		<input type='button' id='popup-save' onclick='saveTag()' value='{$this->lang->words['meta_save']}' class='realbutton' />
HTML;
	}
	$IPBHTML .= <<<HTML
	</div>
</div>

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Acronyms
//===========================================================================
function acronyms( $acronyms ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$this->lang->words['acronyms']}</h2>
	<div class='ipsActionBar clearfix'>
		<ul>
			<li class='ipsActionButton'><a href='{$this->settings['base_url']}app=ipseo&module=seo&section=acronyms&do=add'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' /> {$this->lang->words['acronyms_add']}</a></li>
		</ul>
	</div>
</div>

<div class='acp-box'>
	<h3>{$this->lang->words['acronyms']}</h3>
	<table class='ipsTable'>
		<tr>
			<th width='2%'>&nbsp;</th>
			<th>{$this->lang->words['acronyms_short']}</th>
			<th>{$this->lang->words['acronyms_long']}</th>
			<th>{$this->lang->words['acronyms_semantic']}</th>
			<th class='col_buttons'>&nbsp;</th>
		</tr>
HTML;
		if ( !empty( $acronyms ) )
		{
			foreach ( $acronyms as $id => $data )
			{
				$semantic = $data['a_semantic'] ? 'tick' : 'cross';
			
				$IPBHTML .= <<<HTML
		<tr class='ipsControlRow'>
			<td>&nbsp;</td>
			<td>{$data['a_short']}</td>
			<td>{$data['a_long']}</td>
			<td><img src='{$this->settings['skin_acp_url']}/images/icons/{$semantic}.png' /></td>
			<td>
				<ul class='ipsControlStrip'>
					<li class='i_edit'>
						<a href='{$this->settings['base_url']}app=ipseo&module=seo&section=acronyms&do=edit&amp;id={$data['a_id']}'>{$this->registry->getClass('class_localization')->words['edit']}</a>
					</li>
					<li class='i_delete' id='menu{$data['queue_id']}'>
						<a onclick="if ( !confirm('{$this->registry->getClass('class_localization')->words['acronym_delete_confirm']}' ) ) { return false; }" href='{$this->settings['base_url']}app=ipseo&module=seo&section=acronyms&do=delete&amp;id={$data['a_id']}'>{$this->registry->getClass('class_localization')->words['delete']}…</a>
					</li>
				</ul>
			</td>
		</tr>
HTML;
			}
		}
		else
		{
			$IPBHTML .= <<<HTML
		<tr>
			<td colspan='5' class='no_messages'>{$this->lang->words['acronyms_none']} <a href='{$this->settings['base_url']}app=ipseo&module=seo&section=acronyms&do=add' class='mini_button'>{$this->lang->words['acronyms_none_add']}</a></td>
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
// Acronym Form
//===========================================================================
function acronymForm( $current ) {

if ( empty( $current ) )
{
	$title = $this->lang->words['acronyms_add'];
	$id = 0;
}
else
{
	$title = $this->lang->words['acronyms_edit'];
	$id = $current['a_id'];
}

$form['short'] = $this->registry->output->formInput( 'short', ( empty( $current ) ? '' : $current['a_short'] ), '', '30', 'text', '', '', '255' );
$form['long'] = $this->registry->output->formInput( 'long', ( empty( $current ) ? '' : $current['a_long'] ), '', '30', 'text', '', '', '255' );
$form['semantic'] = $this->registry->output->formYesNo( 'semantic', ( empty( $current ) ? 1 : $current['a_semantic'] ) );

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$title}</h2>
</div>

<form id='tags-form' action='{$this->settings['base_url']}&amp;module=seo&amp;section=acronyms&amp;do=save' method='post'>
	<input type='hidden' name='id' value='{$id}' />
	
	<div class='acp-box'>
		<h3>{$title}</h3>
		<table class='ipsTable double_pad'>
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['acronyms_short']}</strong></td>
				<td class='field_field'>
					{$form['short']}<br />
					<span class='desctext'>{$this->lang->words['acronyms_short_desc']}</td>
				</td>
			</tr>
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['acronyms_long']}</strong></td>
				<td class='field_field'>
					{$form['long']}
				</td>
			</tr>
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['acronyms_semantic']}</strong></td>
				<td class='field_field'>
					{$form['semantic']}<br />
					<span class='desctext'>{$this->lang->words['acronyms_semantic_desc']}</td>
				</td>
			</tr>
		</table>
		<div class='acp-actionbar'>
			<input type='submit' class='button' value='{$title}' />
		</div>
	</div>

</form>

HTML;

//--endhtml--//
return $IPBHTML;
}


}