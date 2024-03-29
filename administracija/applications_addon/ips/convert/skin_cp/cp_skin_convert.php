<?php
/**
 * IPS Converters
 * IP.Blog 2.0 Converters
 * Admin CP Skin
 * Last Update: $Date: 2009-10-31 12:52:02 +0100(sab, 31 ott 2009) $
 * Last Updated By: $Author: mark $
 *
 * @package		IPS Converters
 * @author 		Mark Wade
 * @copyright	(c) 2009 Invision Power Services, Inc.
 * @link		http://external.ipslink.com/ipboard30/landing/?p=converthelp
 * @version		$Revision: 377 $
 */


class cp_skin_convert extends output
{

/**
* Prevent our main destructor being called by this class
*/
function __destruct()
{
}

//===========================================================================
// Header
//===========================================================================
function convertHeader($text) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='section_title'>
	<h2>{$text}</h2>
</div>

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Footer
//===========================================================================
function convertFooter() {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<br /><br />
<div class='section_title'>
	<h2>Need Assistance?</h2>
</div>
If you need assistance with the converting, we have a conversion service available. To find out more, see <a href='http://external.ipslink.com/ipboard30/landing/?p=converthelp' target='_blank'>this</a> page.

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// App List
//===========================================================================
function convertShowSoftware($extra) {


$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='information-box'>
<h3>Select which application you would like to convert to:</h3>
<ul><br />
	<li><img src="{$this->settings['skin_acp_url']}/_newimages/applications/core.png" /> <a href='{$this->settings['base_url']}module=setup&amp;section=setup&amp;do=save&amp;sw=board'>IP.Board</a></li><br />
	{$extra}
</ul>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// App List
//===========================================================================
function convertApp($key, $name) {

$image = '';
if (file_exists(IPS_ROOT_PATH.'skin_cp/_newimages/applications/'.$key.'.png'))
{
	$image = '<img src="'.$this->settings['skin_acp_url'].'/_newimages/applications/'.$key.'.png" />';
}

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<li>{$image} <a href='{$this->settings['base_url']}module=setup&amp;section=setup&amp;do=save&amp;sw={$key}'>{$name}</a></li><br />
HTML;

//--endhtml--//
return $IPBHTML;
}


//===========================================================================
// Convertor Options - PART ONE
//===========================================================================
function convertShowOptions1($options) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Convert</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=setup' method='post'>
		<input type='hidden' name='do' value='info'>
		<input type='hidden' name='sw' value='{$this->request['sw']}'>
		<input type='hidden' name='parent' value='0'>
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr><th colspan='2'>We need some more information...</th></tr>
			<tr>
				<td><strong>Current software</strong></td>
				<td>
					<select name='choice'>
						{$options}
					</select>
				</td>
			</tr>
			<tr>
				<td><strong>ID</strong><br /><div class='desctext'>Any name that will identify the application.<br />For example: <em>old_forums</em></div></td>
				<td><input name='app_name' /></td>
			</tr>
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />

<div class='warning'>
	<h4><img src='{$this->settings['skin_acp_url']}/_newimages/icons/warning.png' alt='' />&nbsp; Warning</h4>
	It is important to note before continuing that converting is not an exact science. Many factors can affect the final outcome and small oddities are to be expected following the conversion. Our technicians will be happy to assist you resolve these issues, but you should be aware that you may need to allow for extra downtime following the conversion while these issues are addressed.
</div>
<br /><br />

<div class='information-box'>
	<h4><img src='{$this->settings['skin_acp_url']}/_newimages/icons/help.png' alt='' />&nbsp; Information</h4>
	If the software you want is listed, but you are running an older version than what is available, you should first upgrade to the version listed here before running the converters.
</div>
<br /><br />


HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Options - PART TWO
//===========================================================================
function convertShowOptions2() {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Convert</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=setup' method='post'>
		<input type='hidden' name='do' value='convert' />
		<input type='hidden' name='sw' value='{$this->request['sw']}' />
		<input type='hidden' name='parent' value='{$this->request['parent']}' />
		<input type='hidden' name='choice' value='{$this->request['choice']}' />
		<input type='hidden' name='app_name' value='{$this->request['app_name']}' />
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr><th colspan='2'>We need some more information...</th></tr>
			<tr>
				<td width='40%'><strong>Database Driver</strong></td>
				<td width='60%'><select name='hb_sql_driver' /><option value='mysql'>MySQL</option><option value='mssql'>MSSQL</option></select></td>
			</tr>
			<tr>
				<td><strong>Database Host</strong></td>
				<td><input name='hb_sql_host' value='{$this->settings['sql_host']}' /></td>
			</tr>
			<tr>
				<td><strong>Database Username</strong></td>
				<td><input name='hb_sql_user' value='{$this->settings['sql_user']}' /></td>
			</tr>
			<tr>
				<td><strong>Database Password</strong></td>
				<td><input name='hb_sql_pass' value='{$this->settings['sql_pass']}' /></td>
			</tr>
			<tr>
				<td><strong>Database Name</strong></td>
				<td><input name='hb_sql_database' /></td>
			</tr>
			<tr>
				<td><strong>Database Table Prefix</strong></td>
				<td><input name='hb_sql_tbl_prefix' /></td>
			</tr>
			<tr>
				<td><strong>Database Charset</strong><br /><div class='desctext'><em>In almost all cases, this should be left blank.</em><br />If you experience problems where non-latin characters show as a question mark after the conversion, try setting this to "UTF8".</div></td>
				<td><input name='hb_sql_charset' /></td>
			</tr>
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Options - Custom
//===========================================================================
function convertShowOptionsCustom($fields) {

$rows = '';
foreach($fields as $k => $v)
{
	$rows .= "<tr>
				<td width='40%'><strong>{$v}</strong></td>
				<td width='60%'><input name='{$k}' /></td>
			</tr>";
}

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Convert</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=setup' method='post'>
		<input type='hidden' name='do' value='convert' />
		<input type='hidden' name='sw' value='{$this->request['sw']}' />
		<input type='hidden' name='parent' value='{$this->request['parent']}' />
		<input type='hidden' name='choice' value='{$this->request['choice']}' />
		<input type='hidden' name='app_name' value='{$this->request['app_name']}' />
		<input type='hidden' name='custom' value='1' />
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr><th colspan='2'>We need some more information...</th></tr>
			{$rows}
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}



//===========================================================================
// Who's your daddy?
//===========================================================================
function convertAskForParent($options, $hidden) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Convert</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=setup' method='post'>
		<input type='hidden' name='do' value='info'>
		<input type='hidden' name='sw' value='{$this->request['sw']}'>
		<input type='hidden' name='app_name' value='{$this->request['app_name']}'>
		<input type='hidden' name='hb_sql_driver' value='{$this->request['hb_sql_driver']}'>
		<input type='hidden' name='hb_sql_host' value='{$this->request['hb_sql_host']}'>
		<input type='hidden' name='hb_sql_user' value='{$this->request['hb_sql_user']}'>
		<input type='hidden' name='hb_sql_pass' value='{$this->request['hb_sql_pass']}'>
		<input type='hidden' name='hb_sql_database' value='{$this->request['hb_sql_database']}'>
		<input type='hidden' name='hb_sql_tbl_prefix' value='{$this->request['hb_sql_tbl_prefix']}'>
		<input type='hidden' name='hb_sql_charset' value='{$this->request['hb_sql_charset']}'>
		{$hidden}
		<input type='hidden' name='choice' value='{$this->request['choice']}'>
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr><th>We need some more information...</th></tr>
			<tr><td>Your choice requires a 'parent' application. Select the parent application:
					<select name='parent'>
						{$options}
					</select>
				</td>
			</tr>
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Continue a conversion that has already been started
//===========================================================================
function convertContinue($options) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Convert</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=continue' method='post'>
		<input type='hidden' name='do' value='save'>
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr><th>Select the conversion you would like to continue...</th></tr>
			<tr>
				<td>
					<select name='choice'>
						{$options}
					</select>
				</td>
			</tr>
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}


//===========================================================================
// Convertor Options - Row
//===========================================================================
function convertAddOption($info) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<option value='{$info['key']}'>{$info['name']}</option>

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Options - Error
//===========================================================================
function convertError($error) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='information-box'>
	<h4><img src='{$this->settings['skin_acp_url']}/_newimages/icons/warning.png' alt='' />&nbsp; Error</h4>
	{$error}
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Menu - Wrapper
//===========================================================================
function convertMenu($rows, $appinfo) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<script type='text/javascript'>
	function calculate( key, total )
	{
		url = '{$this->settings['base_url']}&app=convert&app=convert&module=setup&section=extra&do=count&newcycles='+$( 'input-' + key ).getValue()+'&total='+total;

		if ( ! isNumber( $( 'input-' + key ).getValue() ) )
		{
			$( 'cycles-' + key ).update( "<span style='color:red;'>??</span>" );
			return;
		}

		new Ajax.Request(
			url,
			{
				method: 'get',
				onSuccess: function(s)
				{
					if ( s.responseText != 'error' )
					{
						$( 'cycles-' + key ).update( s.responseText );
					}
				}
			}
		);
	}

	function isNumber( number )
	{
		return number.match( /^[\d]+?$/ );
	}


</script>

<div class='acp-box'>
	<h3>Convert</h3>
	<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
		<tr>
			<th>Type</th>
			<th>Local Rows</th>
			<th>Source Rows</th>
			<th>Status</th>
			<th>Per Cycle</th>
			<th>Empty local data?</th>
			<th>Go</th>
		</tr>
		{$rows}
	</table>
</div>
<br /><br />

HTML;

if ($appinfo)
{

$IPBHTML .= <<<HTML

	<div class='information-box'>
		<h4><img src='{$this->settings['skin_acp_url']}/_newimages/icons/help.png' alt='' />&nbsp; When you're finished...</h4>
		{$appinfo}
	</div>
	<br /><br />

HTML;

}

$IPBHTML .= <<<HTML

<div class='warning'>
	<h4><img src='{$this->settings['skin_acp_url']}/_newimages/icons/warning.png' alt='' />&nbsp; Lock</h4>
	<strong>Make sure that when you have finished, you <a href='{$this->settings['base_url']}module=setup&amp;section=lock'>lock the system</a>.</strong>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Menu - Rows
//===========================================================================
function convertMenuRow($info, $rows, $status, $button, $actualrows=false) {

$cycles = round($rows / $info['cycle']);
$cycles = ($cycles == 0) ? 1 : $cycles;

if ($actualrows === false)
{
	$actualrows = $rows;
}

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<form action='{$this->settings['base_url']}module={$info['app']}&amp;section={$info['section']}' method='post'>
	<input type='hidden' name='do' value='{$info['key']}'>
	<input type='hidden' name='total' value='{$rows}'>
	<tr>
		<td><img src='{$this->settings['skin_app_url']}/images/{$info['key']}.png' /> {$info['name']}</td>
		<td>{$info['rows']}</td>
		<td>{$actualrows}</td>
		<td>{$status}</td>
		<td><input name='cycle' value='{$info['cycle']}' size='5' onKeyUp="calculate( '{$info['key']}', '{$rows}' );" id='input-{$info['key']}' /> <span id='cycles-{$info['key']}'>{$cycles}</span> cycles</td>
		<td><input type='checkbox' name='empty' /></td>
		<td>{$button}</td>
	</tr>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Menu - Button - Enabled
//===========================================================================
function convertMenuRowButtonOn() {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<input type='submit' value='Convert' class='realbutton'>
<input type='hidden' name='info' value='1' />
HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Menu - Button - Enabled - Convert again
//===========================================================================
function convertMenuRowButtonAgain($conf=false) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<input type='submit' value='Convert Again' class='realbutton'>
HTML;

if ($conf)
{
$IPBHTML .= <<<HTML
<input type='checkbox' name='info' checked='checked' /> Reconfigure
HTML;
}


//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Convertor Menu - Button - Disabled
//===========================================================================
function convertMenuRowButtonOff($pres) {

$spres = implode(', ', $pres);

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<input type='button' class='realbutton redbutton' value='Cannot Convert Yet' onclick='alert("You must first convert {$spres}")'>
HTML;

//--endhtml--//
return $IPBHTML;
}


//===========================================================================
// Completed Section Screen
//===========================================================================
function convertComplete($message, $extrarows=array()) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='acp-box'>
	<h3>{$message}</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=switch' method='post'>
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
HTML;
foreach($extrarows as $content)
{
$IPBHTML .= <<<HTML
			<tr><td>{$content}</td></tr>
HTML;
}
$IPBHTML .= <<<HTML
			<tr><td class='acp-actionbar'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />
HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Ask for more info - wrapper
//===========================================================================
function convertMoreInfo($rows, $text_header, $input_header) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='acp-box'>
	<h3>We need some more information...</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module={$this->request['module']}&amp;section={$this->request['section']}&amp;do={$this->request['do']}' method='post'>
		<input type='hidden' name='info' value='1' />
		<input type='hidden' name='cycle' value='{$this->request['cycle']}' />
		<input type='hidden' name='total' value='{$this->request['total']}'>
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr>
				<th>{$text_header}</th>
				<th>{$input_header}</th>
			</tr>
			{$rows}
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />
HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Ask for more info - row
//===========================================================================
function convertMoreInfoRow($text, $input) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<tr>
	<td>{$text}</td>
	<td>{$input}</td>
</tr>
HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Hint Box
//===========================================================================
function convertHint($hint) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='information-box'>
	<h4><img src='{$this->settings['skin_acp_url']}/_newimages/icons/help.png' alt='' />&nbsp; Information</h4>
	{$hint}
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Manage Apps - Table
//===========================================================================
function convertAppTable($rows) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Conversions</h3>
	<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
		<tr>
			<th>ID</th>
			<th>Application</th>
			<th>Actions</th>
		</tr>
		{$rows}
	</table>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Manage Apps - Row
//===========================================================================
function convertAppTableRow($info) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<tr>
	<td>{$info['name']}</td>
	<td>{$info['app_key']}</td>
	<td><a href='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=manage&amp;do=edit&amp;id={$info['app_id']}'><span class='realbutton'><img src='{$this->settings['skin_acp_url']}/_newimages/icons/pencil.png' /> Edit &nbsp;</span></a>
HTML;

$IPBHTML .= <<<HTML
 &nbsp; <a href='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=manage&amp;do=delete&amp;id={$info['app_id']}'><span class='realbutton'><img src='{$this->settings['skin_acp_url']}/_newimages/icons/delete.png' /> Delete
HTML;

$IPBHTML .= <<<HTML
 &nbsp;</span></a></td>
</tr>
HTML;

//--endhtml--//
return $IPBHTML;
}

//===========================================================================
// Edit App
//===========================================================================
function convertEditApp($info) {

$mysql = ($info['db_driver'] == 'mysql') ? "<option value='mysql' selected='selected'>MySQL</option>" : "<option value='mysql'>MySQL</option>";
$mssql = ($info['db_driver'] == 'mssql') ? "<option value='mssql' selected='selected'>MSSQL</option>" : "<option value='mssql'>MSSQL</option>";

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Convert</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=manage' method='post'>
		<input type='hidden' name='do' value='edit_save' />
		<input type='hidden' name='id' value='{$this->request['id']}' />
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr><th colspan='2'>We need some more information...</th></tr>
			<tr>
				<td><strong>Database Driver</strong></td>
				<td><select name='hb_sql_driver' />{$mysql}{$mssql}</select></td>
			</tr>
			<tr>
				<td><strong>Database Host</strong></td>
				<td><input name='hb_sql_host' value='{$info['db_host']}' /></td>
			</tr>
			<tr>
				<td><strong>Database Username</strong></td>
				<td><input name='hb_sql_user' value='{$info['db_user']}' /></td>
			</tr>
			<tr>
				<td><strong>Database Password</strong></td>
				<td><input name='hb_sql_pass' value='{$info['db_pass']}' /></td>
			</tr>
			<tr>
				<td><strong>Database Name</strong></td>
				<td><input name='hb_sql_database' value='{$info['db_db']}' /></td>
			</tr>
			<tr>
				<td><strong>Database Table Prefix</td>
				<td><input name='hb_sql_tbl_prefix' value='{$info['db_prefix']}' /></td>
			</tr>
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}

function convertEditAppCustom($custom) {

$rows = '';
foreach($custom as $k => $v)
{
	$rows .= "<tr>
				<td width='40%'><strong>{$v}</strong></td>
				<td width='60%'><input name='{$k}' /></td>
			</tr>";
}

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML

<div class='acp-box'>
	<h3>Convert</h3>
	<form action='{$this->settings['base_url']}&amp;app=convert&amp;module=setup&amp;section=manage' method='post'>
		<input type='hidden' name='do' value='edit_save' />
		<input type='hidden' name='id' value='{$this->request['id']}' />
		<input type='hidden' name='custom' value='1' />
		<table width='100%' cellpadding='0' cellspacing='0' class='alternate_rows'>
			<tr><th colspan='2'>We need some more information...</th></tr>
			{$rows}
			<tr><td class='acp-actionbar' colspan='2'><input type='submit' value='Continue' class='realbutton'></td></tr>
		</table>
	</form>
</div>
<br /><br />

HTML;

//--endhtml--//
return $IPBHTML;
}


}

?>