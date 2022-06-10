//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook22 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'pageHeader' => 
  array (
    0 => 
    array (
      'selector' => 'div.ipsPageHeader.ipsClearfix.ipsSpacer_bottom',
      'type' => 'add_after',
      'content' => '{{if \IPS\Request::i()->module == \'system\' AND \IPS\Request::i()->controller == \'followed\'}}
{{$url = \IPS\Http\Url::internal( \'app=core&module=online&controller=online\', \'front\', \'online\' )->setQueryString( array( \'do\' => \'removeFromAllContent\', \'id\' => \IPS\Member::loggedIn()->member_id, \'csrfKey\' => \IPS\Session::i()->csrfKey ) );}}
	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_both">
		<li class=\'ipsResponsive_hidePhone\'>
			<a href=\'{$url}\' class=\'ipsButton ipsButton_negative ipsButton_medium ipsButton_fullWidth\' title=\'{lang="manageFollowers_unsubscribe_all"}\' data-confirm title="{lang="delete_blog"}" data-confirmSubMessage="{lang="manageFollowers_unsubscribe_conf"}">{lang="manageFollowers_unsubscribe_all"}</a>
		</li>
	</ul>
{{endif}}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
