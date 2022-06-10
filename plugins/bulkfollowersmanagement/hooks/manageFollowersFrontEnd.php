//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook24 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'followers' => 
  array (
    0 => 
    array (
      'selector' => 'div[data-ipsinfscroll-scrollscope=\'#elFollowerList\'][data-ipsinfscroll-container=\'#elFollowerListContainer\'][data-ipsinfscroll-pageparam=\'followerPage\'] > ul.ipsPad.ipsToolList.ipsToolList_horizontal.ipsList_reset.ipsClearfix.ipsAreaBackground',
      'type' => 'add_class',
      'css_classes' => 
      array (
        0 => 'ipsResponsive_hideDesktop',
        1 => 'ipsResponsive_hidePhone',
      ),
    ),
    1 => 
    array (
      'selector' => 'div[data-ipsinfscroll-scrollscope=\'#elFollowerList\'][data-ipsinfscroll-container=\'#elFollowerListContainer\'][data-ipsinfscroll-pageparam=\'followerPage\'] > ul.ipsPad.ipsToolList.ipsToolList_horizontal.ipsList_reset.ipsClearfix.ipsAreaBackground',
      'type' => 'add_after',
      'content' => '{{$query_str = parse_url($url, PHP_URL_QUERY);}}
{{parse_str($query_str, $query_params);}}
{{$add = \IPS\Http\Url::internal( \'app=core&module=online&controller=online\', \'front\', \'online\' )->setQueryString( array( \'do\' => \'followersAdd\', \'fromApp\' => $query_params[\'follow_app\'], \'area\' => $query_params[\'follow_area\'], \'id\' => $query_params[\'follow_id\'] ) );}}
{{$remove = \IPS\Http\Url::internal( \'app=core&module=online&controller=online\', \'front\', \'online\' )->setQueryString( array( \'do\' => \'followersRemove\', \'fromApp\' => $query_params[\'follow_app\'], \'area\' => $query_params[\'follow_area\'], \'id\' => $query_params[\'follow_id\'] ) );}}
{{if \IPS\Member::loggedIn()->modPermission(\'can_remove_followers\')}}
    <ul class="ipsPad ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsAreaBackground">
      	<li>
			<a href=\'{$remove}\' data-ipsDialog data-ipsDialog-size=\'medium\' data-ipsDialog-title=\'{lang="remove_followers"}\' class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_negative">{lang="remove_followers"}</a>
		</li>
		<li>
			<a href=\'{$add}\' data-ipsDialog data-ipsDialog-size=\'medium\' data-ipsDialog-title=\'{lang="manageFollowers_add"}\' class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_positive">{lang="manageFollowers_add"}</a>
		</li>
    </ul>
{{endif}} ',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
