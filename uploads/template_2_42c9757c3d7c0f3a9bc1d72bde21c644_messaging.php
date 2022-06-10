<?php
namespace IPS\Theme\Cache;
class class_core_front_messaging extends \IPS\Theme\Template
{
	public $cache_key = '1f3c0f841797bc5288baf3b18572146c';
	function conversation( $conversation, $folders ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox'>
	<div class='ipsPadding ipsPadding_bottom:half ipsAreaBackground_light ipsBorder_bottom'>
		<ul id='elConvoActions_menu' class='ipsMenu ipsMenu_auto ipsHide'>
			
CONTENT;

if ( \count( $folders ) > 1 ):
$return .= <<<CONTENT

				<li class='ipsMenu_item ipsMenu_subItems'>
					<a href='#' id='elConvoMove'><i class='fa fa-folder'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move_message_to', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>

					<ul id='elConvoMove_menu' class='ipsMenu ipsMenu_auto ipsHide'>
						
CONTENT;

foreach ( $folders as $id => $name ):
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $conversation->map['map_folder_id'] ) AND (string) $id !== $conversation->map['map_folder_id'] ):
$return .= <<<CONTENT

								<li class='ipsMenu_item' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href='
CONTENT;
$return .= htmlspecialchars( $conversation->url('move')->csrf()->setQueryString( 'to', $id ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( isset( $conversation->map['map_ignore_notification'] ) ):
$return .= <<<CONTENT

				<li class='ipsMenu_item'>
					
CONTENT;

if ( $conversation->map['map_ignore_notification'] ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $conversation->url('notifications')->csrf()->setQueryString( 'status', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="stopNotifications">
							<i class='fa fa-bell'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_notifications_on', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $conversation->url('notifications')->csrf()->setQueryString( 'status', 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="stopNotifications">
							<i class='fa fa-bell-slash-o'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_notifications_off', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class='ipsMenu_item'>
				<a href="
CONTENT;
$return .= htmlspecialchars( $conversation->url('leaveConversation')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="deleteConversation">
					<i class='fa fa-trash'></i> 
CONTENT;

if ( $conversation->canDelete() AND isset( \IPS\Request::i()->_report ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_leave_moderator', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_leave', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				</a>
			</li>
			
CONTENT;

if ( $conversation->canDelete() AND isset( \IPS\Request::i()->_report ) ):
$return .= <<<CONTENT

				<li class='ipsMenu_item'>
					<a href="
CONTENT;
$return .= htmlspecialchars( $conversation->url('moderate')->setQueryString( array( 'action' => 'delete', '_report' => \IPS\Request::i()->_report ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-confirm>
						<i class='fa fa-trash'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_leave', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>

		<div class='ipsPageHeader'>
			<div class='ipsBox_alt ipsClearfix ipsPos_right'>
				<p class='ipsResponsive_hideDesktop ipsResponsive_block ipsPos_left ipsType_reset'>
					<a href='#' data-action='filterBarSwitch' data-switchTo='filterBar' class='ipsButton ipsButton_verySmall ipsButton_veryLight'><i class='fa fa-caret-left'></i> <i class='fa fa-navicon'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_list', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</p>
				<a href='#' id='elConvoActions' data-ipsMenu class='ipsPos_right ipsButton ipsButton_verySmall ipsButton_veryLight'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			</div>
			<h1 class='ipsType_pageTitle ipsType_break'>
CONTENT;
$return .= htmlspecialchars( $conversation->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 </h1>
		</div>

		<div class='cMessage_members' id='elConvoMembers_
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<span><i class='fa fa-user'></i> &nbsp;
CONTENT;

$pluralize = array( $conversation->to_count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_in_convo', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			<ol class='ipsList_inline ipsClearfix ipsMargin_top'>
				
CONTENT;

$members = 0;
$return .= <<<CONTENT

				
CONTENT;

foreach ( $conversation->maps() as $map ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "messaging", \IPS\Request::i()->app )->participant( $map, $conversation );
$return .= <<<CONTENT

				
CONTENT;

$members++;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_max_mass_pm'] == -1 OR $members < \IPS\Member::loggedIn()->group['g_max_mass_pm']  ):
$return .= <<<CONTENT

				<li data-role='addUserItem'>
					<a href='#elInviteMember
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elInviteMember
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='inviteUsers' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'invite_a_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo="#elConvoMembers_
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu-closeOnClick='false' data-ipsTooltip class='ipsButton ipsButton_veryLight ipsButton_narrow ipsButton_large'><i class='fa fa-plus'></i> <i class='fa fa-user'></i></a>
					<div class='ipsMenu ipsMenu_wide ipsPad ipsHide' id='elInviteMember
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<form accept-charset='utf-8' action="
CONTENT;
$return .= htmlspecialchars( $conversation->url('addParticipant'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-role='addUser' data-conversation="
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							<input type='text' class='ipsField_fullWidth' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_invite_placeholder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' name="member_names" data-ipsAutocomplete data-ipsAutocomplete-unique data-ipsAutocomplete-dataSource="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=findMember", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsAutocomplete-commaTrigger='false' data-ipsAutocomplete-queryParam='input' data-ipsAutocomplete-resultItemTemplate="core.autocomplete.memberItem"><br>
							<button class='ipsButton ipsButton_primary ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'invite', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
						</form>
					</div>
				</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ol>
		</div>
	</div>
	<div class='ipsPadding sm:ipsPadding:none'>
		<h2 class='ipsType_sectionTitle ipsType_reset ipsHide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'personal_conversation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div data-controller='core.front.core.commentFeed, core.front.core.ignoredComments' 
CONTENT;

if ( \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
data-autoPoll
CONTENT;

endif;
$return .= <<<CONTENT
 data-baseURL='
CONTENT;
$return .= htmlspecialchars( $conversation->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $conversation->isLastPage() ):
$return .= <<<CONTENT
data-lastPage
CONTENT;

endif;
$return .= <<<CONTENT
 data-feedID='messages-
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<div class=''>
				
CONTENT;

if ( $conversation->commentPageCount() > 1 ):
$return .= <<<CONTENT

					<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
						<div data-role="tablePagination">
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app, 'global' )->pagination( $conversation->url(), $conversation->commentPageCount(), \IPS\Request::i()->page ? \intval( \IPS\Request::i()->page ) : 1, \IPS\core\Messenger\Conversation::getCommentsPerPage(), TRUE );
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div data-role='commentFeed'>
					
CONTENT;

foreach ( $conversation->comments() as $comment ):
$return .= <<<CONTENT

						{$comment->html()}
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</div>
				
CONTENT;

if ( $conversation->commentPageCount() > 1 ):
$return .= <<<CONTENT

					<hr class='ipsHr'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app, 'global' )->pagination( $conversation->url(), $conversation->commentPageCount(), \IPS\Request::i()->page ? \intval( \IPS\Request::i()->page ) : 1, \IPS\core\Messenger\Conversation::getCommentsPerPage(), TRUE );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				<div data-role='replyArea' class='ipsAreaBackground ipsPad ipsSpacer_top'>
					{$conversation->commentForm()}
				</div>
			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function folderForm( $action, $formHtml ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller="core.front.messages.folderDialog" data-action='
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	{$formHtml}
</div>
CONTENT;

		return $return;
}

	function messageList( $baseUrl, $langPrefix, $headers, $mainColumn, $rootButtons, $rows, $sortBy, $sortDirection, $filters, $currentFilter, $pages, $currentPage, $noSort, $quickSearch, $advancedSearch, $classes, $widths ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elMessageSidebar' data-controller='core.front.messages.list, core.genericTable' data-baseurl="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "{$baseUrl}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
	<div class='ipsButtonBar ipsPad_half ipsClearfix'>
		<!--<span class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_messages', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>-->
		<ul class='ipsButtonRow ipsClearfix ipsPos_right'>
			<li class='ipsPos_left'>
				<a class="ipsJS_show" href="#elCheck_menu" id="elCheck" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="#elMessageList" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
					<span class="cAutoCheckIcon ipsType_medium"><i class="fa fa-square-o"></i></span> <i class="fa fa-caret-down"></i>
					<span class='ipsNotificationCount' data-role='autoCheckCount'>0</span>
				</a>
				<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide" id="elCheck_menu">
					<li class="ipsMenu_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
					<li class="ipsMenu_item" data-ipsMenuValue="all"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					<li class="ipsMenu_item" data-ipsMenuValue="none"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				</ul>
			</li>
			<li>
				<a href='#elSortByMenu_menu' id='elSortByMenu' data-ipsMenu data-ipsMenu-activeClass='ipsButtonRow_active' data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elSortByMenu_menu'>
					
CONTENT;

foreach ( $headers as $k => $header ):
$return .= <<<CONTENT

						
CONTENT;

if ( \in_array( $k, array( 'mt_last_post_time', 'mt_start_time', 'mt_replies' ) ) ):
$return .= <<<CONTENT

							<li class='ipsMenu_item 
CONTENT;

if ( $k == $sortBy ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='recent'><a href='#'>
CONTENT;

$val = "{$langPrefix}{$header}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</li>
			<li>
				<a href='#elFilterMenu_menu' id='elFilterMenu' data-ipsMenu data-ipsMenu-activeClass='ipsButtonRow_active' data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elFilterMenu_menu'>
					<li class='ipsMenu_item 
CONTENT;

if ( !array_key_exists( $currentFilter, $filters ) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='all'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "{$baseUrl}&sortby={$sortBy}&sortdirection={$sortDirection}&page=1", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_filter_all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

foreach ( $filters as $k => $q ):
$return .= <<<CONTENT

						<li class='ipsMenu_item 
CONTENT;

if ( $k === $currentFilter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='others'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "{$baseUrl}&filter={$k}&sortby={$sortBy}&sortdirection={$sortDirection}&page=1", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT
					
				</ul>
			</li>
		</ul>
	</div>
	<div id='elMessageList' class='ipsClear ipsAreaBackground_light'>
		<div>
			<ol class='ipsDataList' data-role='messageList'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "messaging", "core" )->messageListRows( $rows, $mainColumn, $rootButtons, $headers, $langPrefix );
$return .= <<<CONTENT

			</ol>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function messageListRow( $row, $overview, $folders ) {
		$return = '';
		$return .= <<<CONTENT

		<li class='ipsDataItem ipsClearfix 
CONTENT;

if ( $row['map_has_unread'] ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 cMessage 
CONTENT;

if ( !\IPS\Request::i()->overview ):
$return .= <<<CONTENT
ipsCursor_pointer
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row['mt_id'] == \IPS\Request::i()->id ):
$return .= <<<CONTENT
cMessage_active ipsDataItem_selected
CONTENT;

endif;
$return .= <<<CONTENT
' data-messageid='
CONTENT;
$return .= htmlspecialchars( $row['map_topic_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-keyNavBlock data-keyAction='return'>
			<div class='ipsDataItem_icon ipsType_center ipsPos_top sm:ipsPadding:none'>
				<div class='ipsSpacer_bottom ipsSpacer_half'>
					
CONTENT;

if ( $row['last_message'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row['last_message']->author(), 'tiny' );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				
CONTENT;

if ( $overview ):
$return .= <<<CONTENT

				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row['map_topic_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions='delete 
CONTENT;

if ( \is_array($folders) and \count($folders) > 1 ):
$return .= <<<CONTENT
move
CONTENT;

endif;
$return .= <<<CONTENT
' data-state>
					<span></span>
				</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main sm:ipsPadding_left:half'>
				<h4 class='ipsDataItem_title ipsType_normal ipsType_break'>
					
CONTENT;

if ( $overview ):
$return .= <<<CONTENT

						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&id={$row['mt_id']}", null, "messenger_convo", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='cMessageTitle 
CONTENT;

if ( $row['map_has_unread'] ):
$return .= <<<CONTENT
cMessageTitle_unread
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="messageURL">
CONTENT;

if ( $row['map_has_unread'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->itemIcon( array('type' => 'unread', 'size' => 'tiny') );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $row['mt_title'] ), '0', "45" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $row['mt_title'] ) ) > "45" ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&id={$row['mt_id']}&latest=1", null, "messenger_convo", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='cMessageTitle 
CONTENT;

if ( $row['map_has_unread'] ):
$return .= <<<CONTENT
cMessageTitle_unread
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="messageURL">
CONTENT;

if ( $row['map_has_unread'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->itemIcon( array('type' => 'unread', 'size' => 'tiny') );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $row['mt_title'] ), '0', "45" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $row['mt_title'] ) ) > "45" ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</h4>
				<div class='ipsDataItem_meta ipsContained_container ipsMessageRow' data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="1 lines">
					
CONTENT;

if ( $row['last_message'] ):
$return .= <<<CONTENT
<span class='ipsType_break ipsContained'>{$row['last_message']->truncated( TRUE )}</span>
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<span class='ipsType_light ipsType_medium ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $row['participants'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</div>
			<div class='ipsDataItem_generic ipsDataItem_size2 ipsPos_top ipsType_right'>
				<div class='ipsCommentCount ipsSpacer_top ipsSpacer_half' title="
CONTENT;

$pluralize = array( $row['mt_replies'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_message_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
" data-ipsTooltip>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $row['mt_replies'] );
$return .= <<<CONTENT
</div>
				<p class='ipsType_reset ipsType_medium ipsType_light ipsType_right'>
					<span data-ipsTooltip title="
CONTENT;

$sprintf = array(\IPS\Member::load( $row['mt_starter_id'] )->name, \IPS\DateTime::ts( $row['mt_start_time'] )->relative()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_started_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

if ( $row['mt_start_time'] !== $row['mt_last_post_time'] AND $row['last_message'] ):
$return .= <<<CONTENT
 &middot; 
CONTENT;

$sprintf = array($row['last_message']->author()->name, \IPS\DateTime::ts( $row['mt_last_post_time'] )->relative()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_last_reply', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
						
CONTENT;

$val = ( $row['mt_last_post_time'] instanceof \IPS\DateTime ) ? $row['mt_last_post_time'] : \IPS\DateTime::ts( $row['mt_last_post_time'] );$return .= $val->html(TRUE, TRUE);
$return .= <<<CONTENT

					</span>
				</p>
			</div>
		</li>
CONTENT;

		return $return;
}

	function messageListRows( $conversations, $pagination=NULL, $overview=FALSE, $folders ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty( $conversations ) ):
$return .= <<<CONTENT

	<li class='ipsDataItem'>
		<div class='ipsPad ipsType_light ipsType_center ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results_messages', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	</li>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

foreach ( $conversations as $row ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "messaging", \IPS\Request::i()->app )->messageListRow( $row, $overview, $folders );
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function nomessage(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsBox_alt ipsType_center ipsType_large ipsEmpty">
	<i class="fa fa-envelope"></i>
	<br>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_message_selected', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function participant( $map, $conversation ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsPhotoPanel ipsPhotoPanel_tiny 
CONTENT;

if ( !$map['map_user_active'] or $map['map_user_banned'] or \IPS\Member::load( $map['map_user_id'] )->members_disable_pm ):
$return .= <<<CONTENT
cMessage_leftConvo
CONTENT;

endif;
$return .= <<<CONTENT
' data-participant="
CONTENT;
$return .= htmlspecialchars( $map['map_user_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $map['map_user_id'] ), 'tiny' );
$return .= <<<CONTENT
	
	<div>
		
CONTENT;

if ( $map['map_user_id'] == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			<strong>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $map['map_user_id'] )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong><br>
		
CONTENT;

elseif ( !\IPS\Member::load( $map['map_user_id'] )->member_id ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_deleted_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
<br>
		
CONTENT;

else:
$return .= <<<CONTENT

			<a href='#' id='elMessage
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_user
CONTENT;
$return .= htmlspecialchars( $map['map_user_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="cMessage_name" data-role='userActions' data-username='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $map['map_user_id'] )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu><strong>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $map['map_user_id'] )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></strong></a><br>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<span class='ipsType_light ipsType_small' data-role='userReadInfo'>
			
CONTENT;

if ( $map['map_user_banned'] ):
$return .= <<<CONTENT

				<span class="ipsType_warning"><i class="fa fa-ban"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_removed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			
CONTENT;

elseif ( !$map['map_user_active'] ):
$return .= <<<CONTENT

				
CONTENT;

if ( $map['map_left_time'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_left', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $map['map_left_time'] instanceof \IPS\DateTime ) ? $map['map_left_time'] : \IPS\DateTime::ts( $map['map_left_time'] );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_left_notime', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

elseif ( \IPS\Member::load( $map['map_user_id'] )->members_disable_pm ):
$return .= <<<CONTENT

				<span title='
CONTENT;

$sprintf = array(\IPS\Member::load( $map['map_user_id'] )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_disabled_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' data-ipsTooltip>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_disabled', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $map['map_read_time'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $map['map_read_time'] instanceof \IPS\DateTime ) ? $map['map_read_time'] : \IPS\DateTime::ts( $map['map_read_time'] );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_not_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</span>
	</div>
	
CONTENT;

if ( $map['map_user_id'] != \IPS\Member::loggedIn()->member_id and \IPS\Member::load( $map['map_user_id'] )->member_id ):
$return .= <<<CONTENT

		<ul id='elMessage
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_user
CONTENT;
$return .= htmlspecialchars( $map['map_user_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_auto ipsHide'>
			
CONTENT;

if ( $conversation->starter_id == \IPS\Member::loggedIn()->member_id and ( $map['map_user_active'] or $map['map_user_banned'] ) ):
$return .= <<<CONTENT

				
CONTENT;

if ( $map['map_user_banned'] ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='unblock'><a href='
CONTENT;
$return .= htmlspecialchars( $conversation->url('addParticipant')->csrf()->setQueryString( 'member', $map['map_user_id'] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_unremove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='block'><a href='
CONTENT;
$return .= htmlspecialchars( $conversation->url('blockParticipant')->csrf()->setQueryString( 'member', $map['map_user_id'] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_sep'><hr></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class='ipsMenu_item' data-ipsMenuValue='msg'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$map['map_user_id']}", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_map_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

</li>
CONTENT;

		return $return;
}

	function submitForm( $title, $form ) {
		$return = '';
		$return .= <<<CONTENT


<div class="ipsPageHeader ipsClearfix ipsSpacer_bottom">
	<h1 class="ipsType_pageTitle">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
</div>
<div class='ipsBox'>{$form}</div>
CONTENT;

		return $return;
}

	function template( $folder, $folders, $counts, $conversations, $pagination, $conversation, $baseUrl, $baseUrlTemplate, $sortBy, $filter ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller='core.front.messages.main, core.front.messages.responsive'>
	<div class='ipsPageHeader ipsBox ipsPadding ipsResponsive_pull ipsClearfix ipsSpacer_bottom' id='elMessageHeader'>
		<div class='ipsGrid ipsGrid_collapsePhone'>
			<h1 class='ipsType_pageTitle ipsGrid_span6'>
				<a href='#elMessageFolders_menu' id='elMessageFolders' data-ipsMenu data-ipsMenu-appendTo="#elMessageHeader" class='ipsType_blendLinks'><span data-role='currentFolder'>
CONTENT;
$return .= htmlspecialchars( $folders[ $folder ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> &nbsp;<i class='fa fa-caret-down'></i></a>
				&nbsp;&nbsp;<a href='#elFolderSettings_menu' id='elFolderSettings' data-ipsMenu data-ipsMenu-appendTo="#elMessageHeader" class='ipsType_blendLinks'><i class='fa fa-cog'></i></a>
				&nbsp;&nbsp;<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-url='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_important ipsResponsive_hidePhone'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-action="composeNew" data-ipsDialog data-ipsDialog-url='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_verySmall ipsButton_narrow ipsPos_right ipsResponsive_showPhone ipsResponsive_block'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				&nbsp;&nbsp;<span data-role="loadingFolderAction" class='ipsType_light ipsType_normal' style='display: none'><i class='icon-spinner2 ipsLoading_tinyIcon'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</h1>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "members", "core", 'global' )->messengerQuota( \IPS\Member::loggedIn(), array_sum( $counts ) );
$return .= <<<CONTENT

		</div>
		
		<ul class='ipsMenu ipsMenu_auto ipsHide' id='elMessageFolders_menu'>
			
CONTENT;

foreach ( $folders as $id => $name ):
$return .= <<<CONTENT

				
CONTENT;

if ( $id === 'myconvo' ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'><span class='ipsMenu_itemCount'>
CONTENT;

if ( isset( $counts[ $id ] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $counts[ $id ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
</span> <span data-role='folderName'>
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></a></li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&folder={$id}", null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'><span class='ipsMenu_itemCount'>
CONTENT;

if ( isset( $counts[ $id ] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $counts[ $id ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
</span> <span data-role='folderName'>
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

			<li class='ipsPad_half'><a class='ipsButton ipsButton_fullWidth ipsButton_light ipsButton_small' href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=addFolder" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-action="addFolder" id='elAddFolder'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_add_folder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
		<ul class='ipsMenu ipsMenu_auto ipsHide' id='elFolderSettings_menu'>
			<li class='ipsMenu_title'>
CONTENT;

$sprintf = array($folders[ $folder ]); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_action_with', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</li>
			<li class='ipsMenu_item' data-ipsMenuValue='markRead'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=readFolder&folder={$folder}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_action_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_item 
CONTENT;

if ( $folder == 'myconvo' ):
$return .= <<<CONTENT
ipsMenu_itemDisabled ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='rename' id='elFolderRename'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=renameFolder&folder={$folder}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_action_rename', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_item' data-ipsMenuValue='empty'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=emptyFolder&folder={$folder}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_action_empty', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_item 
CONTENT;

if ( $folder == 'myconvo' ):
$return .= <<<CONTENT
ipsMenu_itemDisabled ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='delete'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=deleteFolder&folder={$folder}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_action_delete_folder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
	</div>

	<div class='ipsColumns ipsColumns_collapseTablet' data-ipsFilterBar data-ipsFilterBar-on='phone,tablet' data-ipsFilterBar-viewDefault='
CONTENT;

if ( \IPS\Request::i()->id && !isset( \IPS\Request::i()->_list) ):
$return .= <<<CONTENT
filterContent
CONTENT;

else:
$return .= <<<CONTENT
filterBar
CONTENT;

endif;
$return .= <<<CONTENT
'>
		<div class='ipsColumn ipsColumn_veryWide' data-role='filterBar'>
			<div id='elMessageSidebar' class='ipsBox ipsResponsive_pull lg:ipsPos_sticky' data-controller='core.front.messages.list' data-folderID='
CONTENT;
$return .= htmlspecialchars( $folder, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
				data-ipsInfScroll
				data-ipsInfScroll-scrollScope='#elMessageList'
				data-ipsInfScroll-container='#elMessageList [data-role="messageList"]'
				data-ipsInfScroll-url='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortBy' => $sortBy, 'filter' => $filter ) )->stripQueryString( 'id' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
				data-ipsInfScroll-pageParam='listPage'
			>
				<!--<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_messages', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>-->
				
CONTENT;

if ( \IPS\Request::i()->q ):
$return .= <<<CONTENT

					<p class='ipsMessage ipsMessage_info ipsType_reset'>
CONTENT;

$sprintf = array(\IPS\Request::i()->q); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_filtering', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsButtonBar ipsPad_half ipsClearfix' data-role="messageListFilters">
					<ul class='ipsButtonRow ipsClearfix'>
						<li>
							<a class="ipsJS_show" href="#elCheck_menu" id="elCheck" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="#elMessageList" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
								<span class="cAutoCheckIcon ipsType_medium"><i class="fa fa-square-o"></i></span> <i class="fa fa-caret-down"></i>
								<span class='ipsNotificationCount' data-role='autoCheckCount'>0</span>
							</a>
							<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide" id="elCheck_menu">
								<li class="ipsMenu_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
								<li class="ipsMenu_item" data-ipsMenuValue="all"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								<li class="ipsMenu_item" data-ipsMenuValue="none"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							</ul>
						</li>
					</ul>
					<ul class='ipsButtonRow ipsPos_right ipsClearfix'>
						<li>
							<a href='#elSortByMenu_menu' id='elSortByMenu' data-ipsMenu data-ipsMenu-activeClass='ipsButtonRow_active' data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
							<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elSortByMenu_menu'>
								
CONTENT;

foreach ( array( 'mt_last_post_time', 'mt_start_time', 'mt_replies' ) as $k ):
$return .= <<<CONTENT

									<li class='ipsMenu_item 
CONTENT;

if ( $k == \IPS\Request::i()->sortBy or ( !\IPS\Request::i()->sortBy and $k === 'mt_last_post_time') ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortBy' => $k, 'filter' => $filter ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						</li>
						<li>
							<a href='#elFilterMenu_menu' id='elFilterMenu' data-ipsMenu data-ipsMenu-activeClass='ipsButtonRow_active' data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
							<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elFilterMenu_menu'>
								<li class='ipsMenu_item 
CONTENT;

if ( !\IPS\Request::i()->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='all'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortBy' => $sortBy ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_filter_all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

foreach ( array( 'mine', 'not_mine', 'read', 'not_read' ) as $k ):
$return .= <<<CONTENT

									<li class='ipsMenu_item 
CONTENT;

if ( $k === \IPS\Request::i()->filter or ( !\IPS\Request::i()->filter and $k === 'all' ) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'sortBy' => $sortBy, 'filter' => $k ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "messenger_filter_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</ul>
						</li>
					</ul>
				</div>
				<div id='elMessageList' class='ipsClear ipsScrollbar'>
					<form action="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" method="post" data-role='moderationTools' data-ipsPageAction>
						<ol class='ipsDataList' data-role='messageList' data-ipsKeyNav data-ipsKeyNav-observe='return'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "messaging", "core" )->messageListRows( $conversations, NULL, TRUE, $folders );
$return .= <<<CONTENT

						</ol>
						<noscript><div class="ipsPad">{$pagination}</div></noscript>
						<div class="ipsAreaBackground ipsPad ipsClearfix ipsJS_hide" data-role="pageActionOptions">
							<div class="ipsPos_right">
								<select name="modaction" data-role="moderationAction">
									<option value='delete' data-icon='trash'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_leave', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
									<option value='move' data-icon='arrow-right'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_move', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								</select>
								<button type="submit" class="ipsButton ipsButton_alternate ipsButton_verySmall">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
							</div>
						</div>
					</form>
				</div>
				<div class='ipsResponsive_showPhone ipsResponsive_block ipsAreaBackground_light ipsPad' data-role='messageListPagination'>
					{$pagination}
				</div>
				<div class='ipsAreaBackground_light ipsBorder_top ipsPadding' id='elMessageSearch'>
					<form accept-charset='utf-8' method='post' action="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-role='messageSearch' id='elMessageSearchForm'>
						<a href='#' data-action='messageSearchCancel' class='ipsHide'><i class='fa fa-times'></i></a>
						<a href='#elSearchTypes_menu' id='elSearchTypes' data-ipsMenu data-ipsMenu-selectable='checkbox' data-ipsMenu-appendTo='#elMessageSearchForm' data-ipsMenu-closeOnClick='false' class="ipsButton ipsButton_small ipsButton_light ipsPos_right">
							<i class='fa fa-cog'></i>
						</a>
						<input type='text' data-role='messageSearchText' class='ipsField_fullWidth' name='q' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->q, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
						<ul class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' id='elSearchTypes_menu'>
							<li class='ipsMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_search_menu_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
							<li class='ipsMenu_item ipsMenu_itemChecked' data-ipsMenuValue='post'><a href='#'><input type="checkbox" name="search[post]" checked value="1" id="search_post"> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_search_in_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item ipsMenu_itemChecked' data-ipsMenuValue='topic'><a href='#'><input type="checkbox" name="search[topic]" checked value="1" id="search_topic"> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_search_in_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item 
CONTENT;

if ( ! empty(\IPS\Request::i()->search['recipient']) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='recipient'><a href='#'><input type="checkbox" name="search[recipient]" 
CONTENT;

if ( ! empty(\IPS\Request::i()->search['recipient']) ):
$return .= <<<CONTENT
checked="checked"
CONTENT;

endif;
$return .= <<<CONTENT
 recipientvalue="1" id="search_recipient"> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_recipient_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item 
CONTENT;

if ( ! empty(\IPS\Request::i()->search['sender']) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='sender'><a href='#'><input type="checkbox" name="search[sender]" 
CONTENT;

if ( ! empty(\IPS\Request::i()->search['sender']) ):
$return .= <<<CONTENT
checked="checked"
CONTENT;

endif;
$return .= <<<CONTENT
 value="1" id="search_sender"> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_sender_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						</ul>
					</form>
				</div>
			</div>

			<p class='ipsBox_alt ipsType_right ipsType_medium ipsType_light ipsType_blendLinks'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=disableMessenger" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disable_messenger', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</p>
		</div>
		<div class='ipsColumn ipsColumn_fluid' data-role='filterContent'>
			<div id='elMessageViewer' class='ipsResponsive_pull' data-controller='core.front.messages.view' 
CONTENT;

if ( $conversation !== NULL ):
$return .= <<<CONTENT
data-current-id="
CONTENT;
$return .= htmlspecialchars( $conversation->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
				
CONTENT;

if ( $conversation === NULL ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "messaging", \IPS\Request::i()->app )->nomessage(  );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "messaging", \IPS\Request::i()->app )->conversation( $conversation, $folders );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	</div>

	
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_max_messages'] > 0 ):
$return .= <<<CONTENT

		<div class='ipsResponsive_showPhone ipsResponsive_block'>
			<div class='ipsType_center' data-role="quotaTooltip">
				<span class="ipsAttachment_progress"><span data-role='quotaWidth' style='width: 
CONTENT;

$return .= htmlspecialchars( min( 100, 100 / \IPS\Member::loggedIn()->group['g_max_messages'] * array_sum( $counts ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
%'></span></span><br>
				<span class='ipsType_light ipsResponsive_showPhone ipsResponsive_inline'>
CONTENT;

$sprintf = array(100 / \IPS\Member::loggedIn()->group['g_max_messages'] * array_sum( $counts )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_quota_short', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div id='elFolderRename_content' style='display: none' data-controller="core.front.messages.folderDialog" data-type='rename'>
		<form action='#' method='get'>
			<div class='ipsPad'>
				<input type='text' class='ipsField_primary ipsField_fullWidth' data-role="folderName">
			</div>
			<div class='ipsBorder_top ipsPadding ipsType_right'>
				<button type='submit' class='ipsButton ipsButton_primary' data-action='saveFolderName'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			</div>
		</form>
	</div>

	<div id='elAddFolder_content' style='display: none' data-controller="core.front.messages.folderDialog" data-type='add'>
		<form action='#' method='get'>
			<div class='ipsPad'>
				<input type='text' class='ipsField_primary ipsField_fullWidth' data-role="folderName" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_add_folder_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
			</div>
			<div class='ipsBorder_top ipsPadding ipsType_right'>
				<button type='submit' class='ipsButton ipsButton_primary' data-action='saveFolderName'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_add_folder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			</div>
		</form>
	</div>
</div>

CONTENT;

		return $return;
}}