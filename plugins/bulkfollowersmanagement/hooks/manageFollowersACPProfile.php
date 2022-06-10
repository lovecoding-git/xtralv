//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook17 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'basicInformation' => 
  array (
    0 => 
    array (
      'selector' => 'div.acpMemberView_info.ipsBox.ipsSpacer_bottom.ipsSpacer_double[data-controller=\'core.global.core.coverPhoto\'] > div.ipsPad > ul.ipsList_reset',
      'type' => 'add_inside_end',
      'content' => '<li class="ipsSpacer_bottom ipsSpacer_half">
	<a href=\'{$member->acpUrl()->setQueryString( \'do\', \'removeFollowedContent\' )}\' data-confirm class=\'ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth\'>
		{lang="remove_followed_content"}
	</a>
</li>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
