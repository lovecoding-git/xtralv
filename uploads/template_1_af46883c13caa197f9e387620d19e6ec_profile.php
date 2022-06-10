<?php
namespace IPS\Theme\Cache;
class class_core_front_profile extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function allFollowers( $member, $followers, $followersCount ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<h3 class='ipsType_sectionHead'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_followers', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h3>
	<br>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $followersCount > 50 ):
$return .= <<<CONTENT

	
CONTENT;

$url = \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=followers&id={$member->member_id}", 'front', 'profile_followers', $member->members_seo_name );
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<div data-role="tablePagination">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $url, ceil( $followersCount / 50 ), \IPS\Request::i()->page ?: 1, 50 );
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<br>
<ul class='ipsDataList'>
	
CONTENT;

if ( $followers !== NULL and \count( $followers ) ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $followers AS $follower ):
$return .= <<<CONTENT

			<li class='ipsDataItem ipsClearfix 
CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<div class='ipsDataItem_icon ipsPos_top'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load($follower['follow_member_id']), 'tiny', NULL, '', FALSE );
$return .= <<<CONTENT
<br>
				</div>
				<div class='ipsDataItem_main'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $follower['follow_member_id'] and ( !\IPS\Member::load($follower['follow_member_id'])->members_bitoptions['pp_setting_moderate_followers'] or \IPS\Member::loggedIn()->following( 'core', 'member', $follower['follow_member_id'] ) ) ):
$return .= <<<CONTENT

						<div class='ipsPos_right'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $follower['follow_member_id'], \IPS\Member::load( $follower['follow_member_id'] )->followersCount(), TRUE );
$return .= <<<CONTENT
</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<strong class='ipsDataItem_title'>
CONTENT;

$return .= \IPS\Member::load($follower['follow_member_id'])->link( NULL, FALSE );
$return .= <<<CONTENT
</strong> 
CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'anon_follower', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
<br>
					
CONTENT;

$return .= \IPS\Member\Group::load( \IPS\Member::load($follower['follow_member_id'])->member_group_id )->formattedName;
$return .= <<<CONTENT

				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</ul>

CONTENT;

if ( $followersCount > 50 ):
$return .= <<<CONTENT

	<br>
	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<div data-role="tablePagination">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $url, ceil( $followersCount / 50 ), \IPS\Request::i()->page ?: 1, 50 );
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function fieldTab( $field, $value ) {
		$return = '';
		$return .= <<<CONTENT

<h2 class='ipsType_pageTitle ipsSpacer_top'>
CONTENT;

$val = "{$field}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<div class='ipsType_richText ipsType_normal ipsSpacer_top' data-controller='core.front.core.lightboxedImages'>
	{$value}
</div>

CONTENT;

		return $return;
}

	function followers( $member, $followers ) {
		$return = '';
		$return .= <<<CONTENT


<h2 class='ipsWidget_title ipsType_reset'>
	
CONTENT;

if ( \IPS\Member::loggedIn()->member_id === $member->member_id ):
$return .= <<<CONTENT

		<a href='#elFollowPref_menu' data-role='followOption' data-ipsMenu data-ipsMenu-selectable='radio' data-ipsMenu-appendTo='#elFollowers' id='elFollowPref' class='ipsType_blendLinks ipsType_small ipsPos_right'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
		<ul id='elFollowPref_menu' class='ipsMenu ipsMenu_selectable ipsMenu_normal ipsHide'>
			<li data-ipsMenuValue='enable' class='ipsMenu_item 
CONTENT;

if ( !$member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=changeFollow&enabled=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'allow_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li data-ipsMenuValue='disable' class='ipsMenu_item 
CONTENT;

if ( $member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=changeFollow&enabled=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disallow_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			<li class='ipsMenu_sep'><hr></li>
			<li class='ipsPad_half ipsType_center ipsType_light ipsType_medium'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_setting_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</li>
		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$pluralize = array( ($followers !== NULL) ? $member->followersCount() : 0 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_followers', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

</h2>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( $followers !== NULL and \count( $followers ) ):
$return .= <<<CONTENT

		<ul class='ipsGrid ipsSpacer_top'>
			
CONTENT;

foreach ( $followers as $idx => $follower ):
$return .= <<<CONTENT

				
CONTENT;

if ( $idx <= 11 ):
$return .= <<<CONTENT

					<li class='ipsGrid_span3 ipsType_center 
CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $follower['follow_member_id'] )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $follower['follow_is_anon'] ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'anon_follower', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load($follower['follow_member_id']), 'mini', NULL, '', FALSE );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_center ipsPad_half ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_followers_yet', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

if ( $followers !== NULL and $member->followersCount() > 12 ):
$return .= <<<CONTENT

	<p class='ipsType_right ipsType_reset ipsPad_half ipsType_small ipsType_light ipsAreaBackground_light'>
		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=followers&id={$member->member_id}", null, "profile_followers", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_followers', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-right'></i></a>
	</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function hovercard( $member, $addWarningUrl ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$rnd = mt_rand();
$return .= <<<CONTENT


CONTENT;

$referrer = \IPS\Request::i()->referrer;
$return .= <<<CONTENT


CONTENT;

$coverPhoto = $member->coverPhoto();
$return .= <<<CONTENT

<!-- When altering this template be sure to also check for similar in main profile view -->
<div class="cUserHovercard" id="elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class='ipsPageHead_special cUserHovercard__header' id='elProfileHeader_
CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.global.core.coverPhoto' data-url="
CONTENT;
$return .= htmlspecialchars( $member->url()->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-coverOffset='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->offset, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

			<div class='ipsCoverPhoto_container'>
				<img src='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' alt=''>
			</div>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsCoverPhoto_container' style="background-color: 
CONTENT;
$return .= htmlspecialchars( $member->coverPhotoBackgroundColor(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				<img src='
CONTENT;

$return .= \IPS\Theme::i()->resource( "pattern.png", "core", 'global', false );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' data-action="toggleCoverPhoto" alt=''>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<a href='
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsUserPhoto ipsUserPhoto_large ipsUserPhoto_outlined ipsUserPhoto_outlined:medium cUserHovercard__photo"></a>
	</div>
	
	<div class='ipsPadding ipsFlex ipsFlex-fd:column ipsFlex-ai:center'>
		<h2 class='ipsType_reset ipsType_center ipsPos_relative cUserHovercard__title'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->member_id === $member->member_id AND $member->isOnlineAnonymously() ):
$return .= <<<CONTENT

				<span class='cProfileHeader_history ipsType_large' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_is_currently_anon', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
					<i class='fa fa-eye-slash'></i>
				</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</h2>
		<p class='ipsType_reset ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member\Group::load( $member->member_group_id )->formattedName;
$return .= <<<CONTENT

		</p>
		<p class='ipsType_reset ipsType_medium ipsType_light'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $member->joined instanceof \IPS\DateTime ) ? $member->joined : \IPS\DateTime::ts( $member->joined );$return .= $val->html();
$return .= <<<CONTENT

		</p>
		
CONTENT;

if ( $member->last_activity && ( ( !$member->isOnlineAnonymously() ) OR ( $member->isOnlineAnonymously() AND \IPS\Member::loggedIn()->isAdmin() ) ) ):
$return .= <<<CONTENT

			<p class='ipsType_reset ipsType_medium ipsType_light'>
				
CONTENT;

if ( $member->isOnline() AND ( !$member->isOnlineAnonymously() OR ( $member->isOnlineAnonymously() AND \IPS\Member::loggedIn()->isAdmin() ) ) ):
$return .= <<<CONTENT

					<i class="fa fa-circle ipsType_medium ipsOnlineStatus_online" data-ipsTooltip title='
CONTENT;

if ( $member->isOnlineAnonymously() ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now_anon', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

elseif ( $member->isOnline() ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $member->isOnline() AND ( !$member->isOnlineAnonymously() OR ( $member->isOnlineAnonymously() AND \IPS\Member::loggedIn()->isAdmin() ) ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_online_now', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

elseif ( $member->last_activity ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $member->last_activity instanceof \IPS\DateTime ) ? $member->last_activity : \IPS\DateTime::ts( $member->last_activity );$return .= $val->html();
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT


		<dl class='ipsMargin:none ipsMargin_top ipsAreaBackground_light ipsRadius ipsFlex ipsFlex-ai:center ipsFlex-jc:around ipsFlex-as:stretch ipsPadding:half'>
			<div class='ipsPadding_horizontal:half ipsFlex ipsFlex-fd:column-reverse ipsFlex-ai:center'>
				<dt class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</dt>
				<dd class='ipsType_semiBold ipsType_large ipsType_dark ipsMargin:none'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $member->member_posts );
$return .= <<<CONTENT
</dd>
			</div>
			
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_show_profile ):
$return .= <<<CONTENT

				<div class='ipsPadding_horizontal:half ipsFlex ipsFlex-fd:column-reverse ipsFlex-ai:center'>
					<dt class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</dt>
					<dd class='ipsType_semiBold ipsType_large ipsType_dark ipsMargin:none'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $member->pp_reputation_points );
$return .= <<<CONTENT
</dd>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $member->canHaveAchievements() and \IPS\core\Achievements\Badge::show() AND \IPS\core\Achievements\Badge::getStore() ):
$return .= <<<CONTENT

				<div class='ipsPadding_horizontal:half ipsFlex ipsFlex-fd:column-reverse ipsFlex-ai:center'>
					<dt class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'badges', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</dt>
					<dd class='ipsType_semiBold ipsType_large ipsType_dark ipsMargin:none'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $member->badgeCount() );
$return .= <<<CONTENT
</dd>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</dl>

		
CONTENT;

if ( $member->canHaveAchievements() and \IPS\core\Achievements\Rank::show() AND ( \count( \IPS\core\Achievements\Rank::getStore() ) && $member->rank() ) || ( \count( \IPS\core\Achievements\Badge::getStore() ) && \count( $member->recentBadges( 5 ) ) ) ):
$return .= <<<CONTENT

			<div class='ipsFlex ipsFlex-ai:center ipsFlex-jc:between ipsMargin_top ipsFlex-as:stretch'>
				
CONTENT;

if ( \IPS\core\Achievements\Rank::getStore() && $rank = $member->rank() ):
$return .= <<<CONTENT

					<div class='ipsFlex ipsFlex-ai:center'>
						{$rank->html( 'ipsDimension:4' )}
						<div class='ipsMargin_left:half ipsType_medium'>
							<p class='ipsType_reset ipsType_semiBold'>
CONTENT;
$return .= htmlspecialchars( $rank->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
							
CONTENT;

if ( $rankEarned = $member->rankEarned() ):
$return .= <<<CONTENT

								<p class='ipsType_reset ipsType_light'>
CONTENT;

$val = ( $rankEarned instanceof \IPS\DateTime ) ? $rankEarned : \IPS\DateTime::ts( $rankEarned );$return .= $val->html();
$return .= <<<CONTENT
</p>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\core\Achievements\Badge::show() AND \IPS\core\Achievements\Badge::getStore() ):
$return .= <<<CONTENT

					
CONTENT;

$recentBadges = $member->recentBadges( 5 );
$return .= <<<CONTENT

					
CONTENT;

if ( \count( $recentBadges ) ):
$return .= <<<CONTENT

						<ul class="ipsCaterpillar ipsMargin_left">
							
CONTENT;

foreach ( $member->recentBadges( 5 ) as $badge ):
$return .= <<<CONTENT

								<li class='ipsCaterpillar__item'>
									{$badge->html( 'ipsDimension:4', TRUE, TRUE )}
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_see_emails') || \IPS\Settings::i()->warn_on and !$member->inGroup( explode( ',', \IPS\Settings::i()->warn_protected ) ) and ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') or ( \IPS\Settings::i()->warn_show_own and \IPS\Member::loggedIn()->member_id == $member->member_id ) ) ):
$return .= <<<CONTENT

			<div class='ipsBorder_top ipsMargin_top ipsFlex ipsFlex-ai:center ipsFlex-jc:between ipsFlex-as:stretch ipsPadding_top'>
				<div class='ipsType_medium ipsMargin_right'>
					
CONTENT;

if ( \IPS\Settings::i()->warn_on and !$member->inGroup( explode( ',', \IPS\Settings::i()->warn_protected ) ) and ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') or ( \IPS\Settings::i()->warn_show_own and \IPS\Member::loggedIn()->member_id == $member->member_id ) ) ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsType_semiBold'>
							<i class='fa fa-info-circle fa-fw ipsType_light'></i> 
CONTENT;

$pluralize = array( $member->warn_level ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_warn_level', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

						</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_see_emails') ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsType_semiBold ipsTruncate ipsTruncate_line'>
							<i class='fa fa-envelope fa-fw ipsType_light'></i>
                            <a href='mailto:
CONTENT;
$return .= htmlspecialchars( $member->email, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_this_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $member->email, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>

				
CONTENT;

if ( ( \IPS\Member::loggedIn()->canWarn( $member ) || ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and !$member->modPermission() and !$member->isAdmin() ) ) and $member->member_id != \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

					<a href="#elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_more_menu" id="elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_more" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderator_tools', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
...' data-ipsTooltip data-ipsMenu data-ipsMenu-appendTo="#elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_light ipsButton_verySmall'>
						<i class="fa fa-ellipsis-h"></i>
					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT
				
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class='ipsBorder_top ipsPadding'>
		<div class='ipsList_reset ipsFlex ipsFlex-ai:center ipsGap:3 ipsGap_row:0'>
			
CONTENT;

if ( ( \IPS\Member::loggedIn()->member_id and \IPS\Member::loggedIn()->member_id !== $member->member_id ) && !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$member->member_id}", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-forceReload class='ipsFlex-flex:11 ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class='ipsFlex-flex:11 ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && $member->canBeIgnored() and \IPS\Member::loggedIn()->member_id !== $member->member_id  ):
$return .= <<<CONTENT

				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&id={$member->member_id}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "ignore", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class='ipsFlex-flex:11 ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_ignore', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>


	
CONTENT;

if ( ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') AND $member->member_id != \IPS\Member::loggedIn()->member_id ) || \IPS\Member::loggedIn()->canWarn( $member ) ):
$return .= <<<CONTENT

		<ul class="ipsMenu ipsMenu_narrow ipsHide" id="elUserHovercard_
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rnd, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_more_menu">
			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and $member->member_id != \IPS\Member::loggedIn()->member_id and !$member->modPermission() and !$member->isAdmin() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $member->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

					<li class="ipsMenu_item"><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=0&referrer={$referrer}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"><i class="fa fa-flag fa-fw"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li class="ipsMenu_item"><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=1&referrer={$referrer}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-confirm><i class="fa fa-flag fa-fw"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->canWarn( $member ) ):
$return .= <<<CONTENT

				<li class="ipsMenu_item"><a href="
CONTENT;
$return .= htmlspecialchars( $addWarningUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-destructOnClose><i class="fa fa-exclamation-triangle fa-fw"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	</div>
</div>
CONTENT;

		return $return;
}

	function memberFollow( $app, $area, $id, $count, $search=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<div data-followApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followArea='
CONTENT;
$return .= htmlspecialchars( $area, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $search ):
$return .= <<<CONTENT
data-buttonType='search'
CONTENT;

endif;
$return .= <<<CONTENT
 data-controller='core.front.core.followButton'>
	
CONTENT;

if ( $search ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberSearchFollowButton( $app, $area, $id, $count );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollowButton( $app, $area, $id, $count );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function memberFollowButton( $app, $area, $id, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	<div class="ipsResponsive_hidePhone ipsResponsive_block">
		
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_positive" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-check'></i><i class='fa fa-user'></i> <span class='ipsResponsive_showDesktop ipsResponsive_inline'> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span> <i class='fa fa-caret-down'></i></a>
		
CONTENT;

else:
$return .= <<<CONTENT
	
			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_primary" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-plus'></i><i class='fa fa-user'></i> <span class='ipsResponsive_showDesktop ipsResponsive_inline'> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class="ipsResponsive_showPhone ipsResponsive_block">
		
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_positive ipsButton_fullWidth ipsButton_small" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-check'></i><i class='fa fa-user'></i> <i class='fa fa-caret-down'></i></a>
		
CONTENT;

else:
$return .= <<<CONTENT
	
			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsButton ipsButton_fullWidth ipsButton_small ipsButton_alternate" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-plus'></i><i class='fa fa-user'></i></a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function memberSearchFollowButton( $app, $area, $id, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

		<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}&from_search=1", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_small ipsButton_positive ipsButton_fullWidth" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
	
CONTENT;

else:
$return .= <<<CONTENT
	
		<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}&from_search=1", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsButton ipsButton_small ipsButton_primary ipsButton_fullWidth" data-role="followButton" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function profile( $member, $mainContent, $visitors, $sidebarFields, $followers, $addWarningUrl, $solutions ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<!-- When altering this template be sure to also check for similar in the hovercard -->
<div data-controller='core.front.profile.main'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, false );
$return .= <<<CONTENT

	<div data-role="profileContent" class='ipsSpacer_top'>

CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsColumns ipsColumns_collapseTablet' data-controller="core.front.profile.body">
			<div class='ipsColumn ipsColumn_fixed ipsColumn_veryWide' id='elProfileInfoColumn'>
				<div class='ipsPadding ipsBox ipsResponsive_pull'>
					
CONTENT;

if ( \IPS\Application::appIsEnabled('nexus') and \IPS\Settings::i()->nexus_subs_enabled and \IPS\Settings::i()->nexus_subs_show_public ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "subscription", "nexus", 'front' )->profileSubscription( $member );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_show_profile ):
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Settings::i()->reputation_leaderboard_on and \IPS\Settings::i()->reputation_show_days_won_trophy and $member->getReputationDaysWonCount() and $lastDayWon = $member->getReputationLastDayWon() ):
$return .= <<<CONTENT

							
CONTENT;

$formattedDate = $lastDayWon['date']->dayAndMonth() . (  $lastDayWon['date']->format('Y') == \IPS\DateTime::ts( time() )->format('Y' ) ? '' : " " . $lastDayWon['date']->format('Y') );
$return .= <<<CONTENT

							<div class='ipsLeaderboard_trophy_1 cProfileSidebarBlock ipsMargin_bottom ipsPadding ipsRadius'>
								<p class='ipsType_reset ipsType_medium'>
									<strong>
										<a class='ipsType_blendLinks' href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=discover&controller=popular&tab=leaderboard&custom_date_start={$lastDayWon['date']->getTimeStamp()}&custom_date_end={$lastDayWon['date']->getTimeStamp()}", null, "leaderboard_leaderboard", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
											
CONTENT;

if ( $member->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

												
CONTENT;

$sprintf = array($formattedDate); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_you_won', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

											
CONTENT;

else:
$return .= <<<CONTENT

												
CONTENT;

$sprintf = array($member->name, $formattedDate); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_member_won', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT

										</a>
									</strong>
								</p>
								<p class='ipsType_reset ipsType_small'>
CONTENT;

if ( $member->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_you_congrats', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_member_congrats', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>
							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT


						
CONTENT;

if ( ! $member->canHaveAchievements() OR ! \IPS\core\Achievements\Badge::show() OR (!\count( \IPS\core\Achievements\Rank::getStore() ) && !\count( \IPS\core\Achievements\Badge::getStore() ) ) ):
$return .= <<<CONTENT

							<div class='cProfileSidebarBlock ipsMargin_bottom'>
								
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

									<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-action="repLog" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_reputation', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
								
CONTENT;

endif;
$return .= <<<CONTENT

									<div class='cProfileRepScore ipsPad_half 
CONTENT;

if ( $member->pp_reputation_points > 1 ):
$return .= <<<CONTENT
cProfileRepScore_positive
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
cProfileRepScore_negative
CONTENT;

else:
$return .= <<<CONTENT
cProfileRepScore_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'>
										<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_reputation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
										<span class='cProfileRepScore_points'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->pp_reputation_points );
$return .= <<<CONTENT
</span>
										
CONTENT;

if ( $member->reputation() ):
$return .= <<<CONTENT

											<span class='cProfileRepScore_title'>
CONTENT;
$return .= htmlspecialchars( $member->reputation(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
										
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

if ( $member->reputationImage() ):
$return .= <<<CONTENT

											<div class='ipsAreaBackground_reset ipsRadius ipsPad_half ipsType_center'>
												<img src='
CONTENT;

$return .= \IPS\File::get( "core_Theme", $member->reputationImage() )->url;
$return .= <<<CONTENT
' alt=''>
											</div>
										
CONTENT;

endif;
$return .= <<<CONTENT

									</div>
								
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

									<p class='ipsType_reset ipsPadding_top:half ipsType_right ipsType_light ipsType_small'>
										
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_show_activity', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-right'></i>
									</p>
								</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

if ( $solutions && ( ! $member->canHaveAchievements() OR !\IPS\core\Achievements\Badge::show() OR ( !\count( \IPS\core\Achievements\Rank::getStore() ) && !\count( \IPS\core\Achievements\Badge::getStore() ) ) ) ):
$return .= <<<CONTENT

						<div class='cProfileSidebarBlock ipsMargin_bottom'>
							<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=solutions", null, "profile_solutions", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-action="solutionLog" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_solutions', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
								<div class='cProfileRepScore ipsPad_half cProfileSolutions'>
									<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_solutions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
									<span class='cProfileRepScore_points'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $solutions );
$return .= <<<CONTENT
</span>
								</div>
								<p class='ipsType_reset ipsPadding_top:half ipsType_right ipsType_light ipsType_small'>
									
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solutionlog_show_activity', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-right'></i>
								</p>
							</a>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
CONTENT;

if ( \IPS\Settings::i()->warn_on and !$member->inGroup( explode( ',', \IPS\Settings::i()->warn_protected ) ) and ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') or ( \IPS\Settings::i()->warn_show_own and \IPS\Member::loggedIn()->member_id == $member->member_id ) ) ):
$return .= <<<CONTENT

						<div class='cProfileSidebarBlock ipsBox ipsBox--child ipsSpacer_bottom'>
							<div id='elWarningInfo' class='ipsRadius:tl ipsRadius:tr ipsPadding 
CONTENT;

if ( $member->mod_posts || $member->restrict_post || $member->temp_ban ):
$return .= <<<CONTENT
ipsAreaBackground_negative
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix'>
								<i class='ipsPos_left 
CONTENT;

if ( $member->warn_level > 0 || $member->mod_posts || $member->restrict_post || $member->temp_ban ):
$return .= <<<CONTENT
fa fa-exclamation-triangle
CONTENT;

else:
$return .= <<<CONTENT
fa fa-circle-o ipsType_light
CONTENT;

endif;
$return .= <<<CONTENT
'></i>
								<div>
									<h2 class='ipsType_sectionHead'>
CONTENT;

$pluralize = array( $member->warn_level ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_warn_level', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
									<br>
									
CONTENT;

if ( !$member->mod_posts && !$member->restrict_post && !$member->temp_ban ):
$return .= <<<CONTENT

										<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_restrictions_applied', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
										<br>
									
CONTENT;

else:
$return .= <<<CONTENT

										<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restrictions_applied', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
										<ul class='ipsList_bullets ipsSpacer_top ipsSpacer_half'>
											
CONTENT;

if ( $member->mod_posts ):
$return .= <<<CONTENT

												<li data-ipsTooltip title="
CONTENT;

if ( $member->mod_posts == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq_perm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $member->mod_posts )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq_temp', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
													
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_modq', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

												</li>
											
CONTENT;

endif;
$return .= <<<CONTENT

											
CONTENT;

if ( $member->restrict_post ):
$return .= <<<CONTENT

												<li data-ipsTooltip title="
CONTENT;

if ( $member->restrict_post == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost_perm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $member->restrict_post )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost_temp', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
													
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_nopost', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

												</li>
											
CONTENT;

endif;
$return .= <<<CONTENT

											
CONTENT;

if ( $member->temp_ban ):
$return .= <<<CONTENT

												<li data-ipsTooltip title="
CONTENT;

if ( $member->temp_ban == -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned_perm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $member->temp_ban )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned_temp', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
													
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_banned', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

												</li>
											
CONTENT;

endif;
$return .= <<<CONTENT

										</ul>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</div>
							</div>
							
CONTENT;

if ( ( \IPS\Member::loggedIn()->canWarn( $member ) || ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and !$member->modPermission() and !$member->isAdmin() ) ) and $member->member_id != \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

								<div class='ipsPadding_vertical:half ipsType_center'>
									<ul class='ipsFlex ipsFlex-fw:wrap ipsFlex-jc:center ipsGap:1'>
										
CONTENT;

if ( \IPS\Member::loggedIn()->canWarn( $member ) ):
$return .= <<<CONTENT

											<li>
												<a href='
CONTENT;
$return .= htmlspecialchars( $addWarningUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elWarnUserButton' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_light ipsButton_verySmall' title='
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
											</li>
										
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and $member->member_id != \IPS\Member::loggedIn()->member_id and !$member->modPermission() and !$member->isAdmin() ):
$return .= <<<CONTENT

											<li>
												
CONTENT;

if ( $member->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

													<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
												
CONTENT;

else:
$return .= <<<CONTENT

													<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
												
CONTENT;

endif;
$return .= <<<CONTENT

											</li>
										
CONTENT;

endif;
$return .= <<<CONTENT

									</ul>
								</div>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( \count( $member->warnings( 1 ) ) ):
$return .= <<<CONTENT

								<div data-role="recentWarnings" class=''>
									<ol class='ipsDataList'>
										
CONTENT;

foreach ( $member->warnings( 2 ) as $warning ):
$return .= <<<CONTENT

											<li class="ipsDataItem" id='elWarningOverview_
CONTENT;
$return .= htmlspecialchars( $warning->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
												<div class='ipsDataItem_icon ipsType_center'>
													<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$member->member_id}&w={$warning->id}", null, "warn_view", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class="ipsType_blendLinks" data-ipsTooltip title='
CONTENT;

$pluralize = array( $warning->points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'wan_action_points', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
														<span class="ipsPoints 
CONTENT;

if ( $warning->expire_date == 0 ):
$return .= <<<CONTENT
ipsPoints_removed
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $warning->points, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
													</a>
												</div>
												<div class='ipsDataItem_main'>
													
CONTENT;

if ( $warning->canDelete() ):
$return .= <<<CONTENT

														<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url('delete')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-action="revoke" class='ipsPos_right ipsButton ipsButton_small ipsButton_light ipsButton_narrow' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='medium'><i class="fa fa-undo"></i></a>
													
CONTENT;

endif;
$return .= <<<CONTENT

													<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$member->member_id}&w={$warning->id}", null, "warn_view", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-showFrom='#elWarningOverview_
CONTENT;
$return .= htmlspecialchars( $warning->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog-size='narrow' class="ipsType_blendLinks" title=''>
														<h4 class="ipsType_reset ipsType_medium ipsType_unbold">
															
CONTENT;

if ( \IPS\Settings::i()->warnings_acknowledge ):
$return .= <<<CONTENT

																
CONTENT;

if ( $warning->acknowledged ):
$return .= <<<CONTENT

																	<strong class='ipsType_success' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_acknowledged', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-check-circle'></i></strong>
																
CONTENT;

else:
$return .= <<<CONTENT

																	<strong class='ipsType_light' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_not_acknowledged', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-circle-o'></i></strong>
																
CONTENT;

endif;
$return .= <<<CONTENT

															
CONTENT;

endif;
$return .= <<<CONTENT

															
CONTENT;

$val = "core_warn_reason_{$warning->reason}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

														</h4>
														<p class='ipsDataItem_meta ipsType_light'>
															
CONTENT;

$sprintf = array(\IPS\Member::load( $warning->moderator )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $warning->date instanceof \IPS\DateTime ) ? $warning->date : \IPS\DateTime::ts( $warning->date );$return .= $val->html();
$return .= <<<CONTENT

														</p>
														
CONTENT;

if ( $warning->expire_date == 0 ):
$return .= <<<CONTENT

															<p class='ipsDataItem_meta ipsType_light'>
                                                                
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_no_longer_active', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $warning->removed_on ):
$return .= <<<CONTENT
 
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $warning->removed_on )->relative()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_expired_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

															</p>
														
CONTENT;

endif;
$return .= <<<CONTENT

													</a>
												</div>
											</li>
										
CONTENT;

endforeach;
$return .= <<<CONTENT

									</ol>
									<p class='ipsType_reset ipsType_center ipsType_small ipsPad_half'>
										<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&id={$member->member_id}", null, "warn_list", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_warnings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteVerify='false' data-ipsDialog-remoteSubmit='false' data-ipsDialog-title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_warnings', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_c', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
									</p>
								</div>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					
CONTENT;

else:
$return .= <<<CONTENT

                        
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and !$member->inGroup( explode( ',', \IPS\Settings::i()->warn_protected ) ) and \IPS\Member::loggedIn()->member_id != $member->member_id ):
$return .= <<<CONTENT

                            
CONTENT;

if ( $member->members_bitoptions['bw_is_spammer'] ):
$return .= <<<CONTENT

                                <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_unflag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
                            
CONTENT;

else:
$return .= <<<CONTENT

                                <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=moderation&do=flagAsSpammer&id={$member->member_id}&s=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "flag_as_spammer", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'spam_flag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
                            
CONTENT;

endif;
$return .= <<<CONTENT

                        
CONTENT;

endif;
$return .= <<<CONTENT

                    
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( ( $followers !== NULL and \count( $followers ) ) || \IPS\Member::loggedIn()->member_id === $member->member_id ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsBox--child ipsSpacer_bottom' id='elFollowers' data-feedID='member-
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.front.profile.followers'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->followers( $member, $followers );
$return .= <<<CONTENT

						</div>
	 				
CONTENT;

endif;
$return .= <<<CONTENT

	 				
CONTENT;

if ( $member->group['g_icon'] || ( $member->isOnline() AND ( !$member->isOnlineAnonymously() OR ( $member->isOnlineAnonymously() AND \IPS\Member::loggedIn()->isAdmin() ) ) AND $member->location ) || ( $member->birthday AND ( \IPS\Settings::i()->profile_birthday_type == 'public' or ( \IPS\Settings::i()->profile_birthday_type == 'private' and ( \IPS\Member::loggedIn()->member_id == $member->member_id OR \IPS\Member::loggedIn()->isAdmin() ) ) ) ) ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsBox--child ipsSpacer_bottom' data-location='defaultFields'>
							<h2 class='ipsWidget_title ipsType_reset'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_about', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h2>
							<div class='ipsWidget_inner ipsPad'>
								
CONTENT;

if ( $member->group['g_icon']  ):
$return .= <<<CONTENT

									<div class='ipsType_center ipsPad_half'><img src='
CONTENT;

$return .= \IPS\File::get( "core_Theme", $member->group['g_icon'] )->url;
$return .= <<<CONTENT
' alt=''></div>
								
CONTENT;

endif;
$return .= <<<CONTENT

								<ul class='ipsDataList ipsDataList_reducedSpacing cProfileFields'>
									
CONTENT;

if ( $member->isOnline() AND ( !$member->isOnlineAnonymously() OR ( $member->isOnlineAnonymously() AND \IPS\Member::loggedIn()->isAdmin() ) ) AND $member->location ):
$return .= <<<CONTENT

										<li class="ipsDataItem">
											<span class="ipsDataItem_generic ipsDataItem_size3 ipsType_break"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_users_location_lang', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
											<span class="ipsDataItem_main ipsType_break">{$member->location()}</span>
										</li>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $member->birthday AND \IPS\Settings::i()->profile_birthday_type == 'public' or ( \IPS\Settings::i()->profile_birthday_type == 'private' and ( \IPS\Member::loggedIn()->member_id == $member->member_id OR \IPS\Member::loggedIn()->isAdmin() ) ) ):
$return .= <<<CONTENT

										<li class='ipsDataItem'>
											<span class='ipsDataItem_generic ipsDataItem_size3 ipsType_break'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'bday', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
											<span class='ipsDataItem_generic'>
CONTENT;
$return .= htmlspecialchars( $member->birthday, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
										</li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</ul>
							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

foreach ( $sidebarFields as $group => $fields ):
$return .= <<<CONTENT

						
CONTENT;

if ( \count( $fields ) AND \count( array_filter( $fields, function( $fieldValue ){ return $fieldValue['value']; } ) ) ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsBox--child ipsSpacer_bottom' data-location='customFields'>
							
CONTENT;

if ( $group != 'core_pfieldgroups_0' ):
$return .= <<<CONTENT

                                <h2 class='ipsWidget_title ipsType_reset'>
CONTENT;

$val = "{$group}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
                            
CONTENT;

endif;
$return .= <<<CONTENT

                            <div class='ipsWidget_inner ipsPad'>
								<ul class='ipsDataList ipsDataList_reducedSpacing cProfileFields'>
									
CONTENT;

foreach ( $fields as $field => $value ):
$return .= <<<CONTENT

									
CONTENT;

if ( $value['value'] !== "" ):
$return .= <<<CONTENT

										<li class='ipsDataItem ipsType_break'>
											
CONTENT;

if ( $value['custom'] ):
$return .= <<<CONTENT

												{$value['value']}
											
CONTENT;

else:
$return .= <<<CONTENT

												<span class='ipsDataItem_generic ipsDataItem_size3 ipsType_break'><strong>
CONTENT;

$val = "{$field}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
												<div class='ipsDataItem_generic'><div class='ipsType_break ipsContained'>{$value['value']}</div></div>
											
CONTENT;

endif;
$return .= <<<CONTENT

										</li>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							</div>
						</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_see_emails') ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsBox--child ipsSpacer_bottom'>
							<h2 class='ipsWidget_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_contact', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
							<div class='ipsWidget_inner ipsPad'>
								<ul class='ipsDataList ipsDataList_reducedSpacing'>
									<li class='ipsDataItem'>
										<span class='ipsDataItem_generic ipsDataItem_size3'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></span>
										<span class='ipsDataItem_generic'>
											<div class='ipsType_break ipsContained'><a href='mailto:
CONTENT;
$return .= htmlspecialchars( $member->email, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_this_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $member->email, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
											<span class='ipsType_light ipsType_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_email_addresses', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
										</span>
									</li>
								</ul>
							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( !empty( $visitors ) || \IPS\Member::loggedIn()->member_id == $member->member_id ):
$return .= <<<CONTENT

						<div class='ipsWidget ipsWidget_vertical cProfileSidebarBlock ipsBox ipsBox--child ipsSpacer_bottom' data-controller='core.front.profile.toggleBlock'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", \IPS\Request::i()->app )->recentVisitorsBlock( $member, $visitors );
$return .= <<<CONTENT

						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>

			</div>
			<section class='ipsColumn ipsColumn_fluid'>
				
CONTENT;

if ( $member->canHaveAchievements() and ( \IPS\core\Achievements\Rank::show() and \count( \IPS\core\Achievements\Rank::getStore() ) ) || ( \IPS\core\Achievements\Badge::show() and \count( \IPS\core\Achievements\Badge::getStore() ) ) ):
$return .= <<<CONTENT

					<div class='ipsWidget ipsBox ipsMargin_bottom'>
						<h2 class='ipsWidget_title ipsType_reset ipsFlex ipsFlex-ai:center ipsFlex-jc:between'>
							<span>
								
CONTENT;

if ( $member->member_id === \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

									
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_achievements_overview_self', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_achievements_overview', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							</span>
						</h2>
						<div class='ipsWidget_inner ipsPadding_horizontal ipsPadding_vertical:half ipsType_center cProfileAchievements'>
							
CONTENT;

if ( \IPS\core\Achievements\Rank::show() and \count( \IPS\core\Achievements\Rank::getStore() ) && $rank = $member->rank() ):
$return .= <<<CONTENT

								<div class='ipsFlex ipsFlex-fd:column ipsFlex-ai:center ipsPadding_vertical:half'>
									{$rank->html( 'ipsDimension:4' )}
									<h3 class='ipsType_reset ipsType_unbold ipsType_medium ipsType_light ipsMargin_top:half'>
                                        
CONTENT;
$return .= htmlspecialchars( $rank->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 (
CONTENT;
$return .= htmlspecialchars( $rank->rankPosition()['pos'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
/
CONTENT;
$return .= htmlspecialchars( $rank->rankPosition()['max'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)
									</h3>
								</div>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\core\Achievements\Badge::show() and \count( \IPS\core\Achievements\Badge::getStore() ) ):
$return .= <<<CONTENT

								
CONTENT;

$recentBadges = $member->recentBadges( 5 );
$return .= <<<CONTENT
	
								
CONTENT;

if ( \count( $recentBadges ) ):
$return .= <<<CONTENT

									<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=badges", null, "profile_badges", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-action="badgeLog" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_badges', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsPadding_vertical:half ipsRadius'>
										<ul class="ipsCaterpillar ipsFlex-jc:center">
											
CONTENT;

foreach ( $member->recentBadges( 5 ) as $badge ):
$return .= <<<CONTENT

												<li class='ipsCaterpillar__item'>
													{$badge->html( 'ipsDimension:4', TRUE, TRUE )}
												</li>
											
CONTENT;

endforeach;
$return .= <<<CONTENT

										</ul>
										<h3 class='ipsType_reset ipsType_unbold ipsType_medium ipsType_light ipsMargin_top:half'>
											
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_recent_badges', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

										</h3>
									</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_show_profile ):
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

									<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-action="repLog" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_reputation', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsPadding_vertical:half ipsRadius'>
								
CONTENT;

else:
$return .= <<<CONTENT

									<div class='ipsPadding_vertical:half'>
								
CONTENT;

endif;
$return .= <<<CONTENT

										<p class='ipsType_reset cProfileRepScore 
CONTENT;

if ( $member->pp_reputation_points > 1 ):
$return .= <<<CONTENT
cProfileRepScore_positive
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
cProfileRepScore_negative
CONTENT;

else:
$return .= <<<CONTENT
cProfileRepScore_neutral
CONTENT;

endif;
$return .= <<<CONTENT
 ipsRadius:full ipsDimension_height:4 ipsDimension_minWidth:4 ipsPadding_horizontal:half ipsType_large ipsFlex-inline ipsFlex-ai:center ipsFlex-jc:center' 
CONTENT;

if ( $member->reputation() ):
$return .= <<<CONTENT
data-ipsTooltip title="
CONTENT;
$return .= htmlspecialchars( $member->reputation(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $member->pp_reputation_points );
$return .= <<<CONTENT
</p>
										<h3 class='ipsType_reset ipsType_unbold ipsType_medium ipsType_light ipsMargin_top:half'>
											
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_reputation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

										</h3>
								
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

									</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									</div>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $solutions ):
$return .= <<<CONTENT

								<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=solutions", null, "profile_solutions", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-action="solutionLog" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_solutions', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsPadding_vertical:half ipsRadius'>
									<p class='ipsType_reset cProfileSolutions ipsRadius:full ipsDimension_height:4 ipsDimension_minWidth:4 ipsPadding_horizontal:half ipsType_large ipsFlex-inline ipsFlex-ai:center ipsFlex-jc:center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $solutions );
$return .= <<<CONTENT
</p>
									<h3 class='ipsType_reset ipsType_unbold ipsType_medium ipsType_light ipsMargin_top:half'>
										
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_solutions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

									</h3>
								</a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT


				<div class='ipsBox ipsResponsive_pull'>
					{$mainContent}
				</div>
			</section>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function profileActivity( $member, $latestActivity, $statusForm=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller="core.front.statuses.statusFeed">
	
CONTENT;

if ( $statusForm ):
$return .= <<<CONTENT

		<div class='ipsAreaBackground ipsPad ipsSpacer_bottom'>
			<div class='ipsComposeArea ipsComposeArea_withPhoto ipsClearfix ipsContained' data-role='newStatus'>
				<div class='ipsPos_left ipsResponsive_hidePhone ipsResponsive_block'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'small' );
$return .= <<<CONTENT
</div>
				<div class='ipsComposeArea_editor'>
					{$statusForm}
				</div>
			</div>
		</div>
	
CONTENT;

elseif ( !\count( $latestActivity ) ):
$return .= <<<CONTENT

		<div class='ipsPad ipsType_center ipsType_large ipsType_light'>
			
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_recent_activity', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $statusForm or \count( $latestActivity ) ):
$return .= <<<CONTENT

		<ol class='ipsStream ipsList_reset' data-role='activityStream' id='elProfileActivityOverview'>
			
CONTENT;

foreach ( $latestActivity as $activity ):
$return .= <<<CONTENT

				{$activity->html()}
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function profileClubs( $member, $clubs, $pagination ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \count( $clubs ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

		{$pagination}
	
CONTENT;

endif;
$return .= <<<CONTENT


	<ul class='ipsGrid ipsGrid_collapsePhone' data-ipsGrid data-ipsGrid-minItemSize='400' data-ipsGrid-maxItemSize='600' data-ipsGrid-equalHeights='row'>
		
CONTENT;

foreach ( $clubs as $club ):
$return .= <<<CONTENT

			<li class='ipsGrid_span6 ipsBox'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "clubs", "core" )->clubCard( $club );
$return .= <<<CONTENT
</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>

	
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

		{$pagination}
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<p class='ipsType_light ipsType_large ipsType_center'>
		
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_no_clubs', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function profileHeader( $member, $small=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$coverPhoto = $member->coverPhoto();
$return .= <<<CONTENT

<header data-role="profileHeader">
	<div class='ipsPageHead_special 
CONTENT;

if ( $small === true ):
$return .= <<<CONTENT
cProfileHeaderMinimal
CONTENT;

endif;
$return .= <<<CONTENT
' id='elProfileHeader' data-controller='core.global.core.coverPhoto' data-url="
CONTENT;
$return .= htmlspecialchars( $member->url()->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-coverOffset='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->offset, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

			<div class='ipsCoverPhoto_container'>
				
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT

					<img src='
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-src='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' data-action="toggleCoverPhoto" alt=''>
				
CONTENT;

else:
$return .= <<<CONTENT

					<img src='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' data-action="toggleCoverPhoto" alt=''>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsCoverPhoto_container' style="background-color: 
CONTENT;
$return .= htmlspecialchars( $member->coverPhotoBackgroundColor(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				<img src='
CONTENT;

$return .= \IPS\Theme::i()->resource( "pattern.png", "core", 'global', false );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' data-action="toggleCoverPhoto" alt=''>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_modify_profiles') or ( \IPS\Member::loggedIn()->member_id == $member->member_id and $member->group['g_edit_profile'] ) ):
$return .= <<<CONTENT

			<ul class='ipsButton_split' id='elEditProfile' data-hideOnCoverEdit>
				<li>
					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=edit&id={$member->member_id}", "front", "edit_profile", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_small ipsButton_overlaid' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
						<i class='fa fa-pencil'></i>&nbsp;<span class='ipsResponsive_hidePhone ipsResponsive_inline'>&nbsp;&nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					</a>
				</li>
				
CONTENT;

if ( $coverPhoto->editable ):
$return .= <<<CONTENT

					<li>
					<a href='#elEditPhoto_menu' data-hideOnCoverEdit class='ipsButton ipsButton_small ipsButton_overlaid' data-ipsMenu id='elEditPhoto' data-role='coverPhotoOptions'>
						<i class='fa fa-picture-o'></i>&nbsp;<span class='ipsResponsive_hidePhone ipsResponsive_inline'>&nbsp;&nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit_cover_photo_tab', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></span>
					</a>
					<ul class='ipsMenu ipsMenu_auto ipsHide' id='elEditPhoto_menu'>
						
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-role="photoEditOption">
							<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'do', 'coverPhotoRemove' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='removeCoverPhoto'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						<li class='ipsMenu_item ipsHide' data-role="photoEditOption">
							<a href='#' data-action='positionCoverPhoto'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_reposition', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<li class='ipsMenu_item'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'do', 'coverPhotoUpload' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					</ul>
				</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
			
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsColumns ipsColumns_collapsePhone' data-hideOnCoverEdit>
			<div class='ipsColumn ipsColumn_fixed ipsColumn_narrow ipsPos_center' id='elProfilePhoto'>
				
CONTENT;

if ( $member->pp_main_photo and ( mb_substr( $member->pp_photo_type, 0, 5 ) === 'sync-' or $member->pp_photo_type === 'custom' ) ):
$return .= <<<CONTENT

					<a href="
CONTENT;

$return .= \IPS\File::get( "core_Profile", $member->pp_main_photo )->url;
$return .= <<<CONTENT
" data-ipsLightbox class='ipsUserPhoto ipsUserPhoto_xlarge'>					
						<img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt=''>
					</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsUserPhoto ipsUserPhoto_xlarge'>					
						<img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt=''>
					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( ( \IPS\Member::loggedIn()->modPermission('can_modify_profiles') or ( \IPS\Member::loggedIn()->member_id == $member->member_id and $member->group['g_edit_profile'] ) ) AND explode( ':', $member->group['g_photo_max_vars'] )[0] ):
$return .= <<<CONTENT

					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=editPhoto&id={$member->member_id}", "front", "edit_profile_photo", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light ipsButton_narrow' data-action='editPhoto' data-ipsDialog data-ipsDialog-forceReload='true' data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit_photo_tab', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit_photo_tab', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-photo'></i></a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsColumn ipsColumn_fluid'>
				<div class='ipsPos_left ipsPad cProfileHeader_name ipsType_normal'>
					<h1 class='ipsType_reset ipsPageHead_barText'>
						
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT


						
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_view_displaynamehistory'] AND $member->hasNameChanges() ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'do', 'namehistory' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cProfileHeader_history ipsType_large ipsPos_right' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'membername_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'membername_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
								<i class='fa fa-history'></i>
							</a>
						
CONTENT;

endif;
$return .= <<<CONTENT

                        
CONTENT;

if ( \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->member_id === $member->member_id AND $member->isOnlineAnonymously() ):
$return .= <<<CONTENT

                            <span class='cProfileHeader_history ipsType_large ipsPos_right' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_is_currently_anon', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
                                <i class='fa fa-eye-slash'></i>
                            </span>
                        
CONTENT;

endif;
$return .= <<<CONTENT

					</h1>
					<span>
						<span class='ipsPageHead_barText'>
CONTENT;

$return .= \IPS\Member\Group::load( $member->member_group_id )->formattedName;
$return .= <<<CONTENT
</span>
					</span>
				</div>
				
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id ):
$return .= <<<CONTENT

					<ul class='ipsList_inline ipsPad ipsResponsive_hidePhone ipsResponsive_block ipsPos_left'>
						
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id and ( !$member->members_bitoptions['pp_setting_moderate_followers'] or \IPS\Member::loggedIn()->following( 'core', 'member', $member->member_id ) ) ):
$return .= <<<CONTENT

							<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $member->member_id, $member->followersCount() );
$return .= <<<CONTENT
</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$member->member_id}", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary'><i class='fa fa-envelope'></i> <span class='ipsResponsive_showDesktop ipsResponsive_inline'>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_send', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	</div>

	<div class='ipsGrid ipsAreaBackground ipsPad ipsResponsive_showPhone ipsResponsive_block'>
		
CONTENT;

$span = 1;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && \IPS\Member::loggedIn()->member_id != $member->member_id and !$member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT

			
CONTENT;

$span++;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id && \IPS\Member::loggedIn()->member_id && !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm ):
$return .= <<<CONTENT

			
CONTENT;

$span++;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && \IPS\Member::loggedIn()->member_id != $member->member_id and !$member->members_bitoptions['pp_setting_moderate_followers'] ):
$return .= <<<CONTENT

			<div class='ipsGrid_span
CONTENT;

if ( $span == 1 ):
$return .= <<<CONTENT
12
CONTENT;

elseif ( $span == 2 ):
$return .= <<<CONTENT
6
CONTENT;

else:
$return .= <<<CONTENT
4
CONTENT;

endif;
$return .= <<<CONTENT
'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $member->member_id, $member->followersCount() );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id && \IPS\Member::loggedIn()->member_id && !$member->members_disable_pm and !\IPS\Member::loggedIn()->members_disable_pm AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose&to={$member->member_id}", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-forceReload class='ipsGrid_span
CONTENT;

if ( $span == 1 ):
$return .= <<<CONTENT
12
CONTENT;

elseif ( $span == 2 ):
$return .= <<<CONTENT
6
CONTENT;

else:
$return .= <<<CONTENT
4
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton ipsButton_alternate ipsButton_small'><i class='
			fa fa-envelope'></i> <i class='fa fa-caret-right'></i></a>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div data-role='switchView' class='ipsGrid_span
CONTENT;

if ( $span == 1 ):
$return .= <<<CONTENT
12
CONTENT;

elseif ( $span == 2 ):
$return .= <<<CONTENT
6
CONTENT;

else:
$return .= <<<CONTENT
4
CONTENT;

endif;
$return .= <<<CONTENT
'>
			<div data-action="goToProfile" data-type='phone' class='
CONTENT;

if ( $small != true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_veryLight ipsButton_small ipsButton_fullWidth' title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class='fa fa-user'></i></a>
			</div>
			<div data-action="browseContent" data-type='phone' class='
CONTENT;

if ( $small == true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" rel="nofollow" class='ipsButton ipsButton_veryLight ipsButton_small ipsButton_fullWidth'  title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class='fa fa-newspaper-o'></i></a>
			</div>
		</div>
	</div>

	<div id='elProfileStats' class='ipsClearfix sm:ipsPadding ipsResponsive_pull'>
		<div data-role='switchView' class='ipsResponsive_hidePhone ipsPos_right'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_veryLight ipsButton_small ipsPos_right 
CONTENT;

if ( $small != true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-action="goToProfile" data-type='full' title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class='fa fa-user'></i> <span class='ipsResponsive_showDesktop ipsResponsive_inline'>&nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_view_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" rel="nofollow" class='ipsButton ipsButton_veryLight ipsButton_small ipsPos_right 
CONTENT;

if ( $small == true ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-action="browseContent" data-type='full' title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"><i class='fa fa-newspaper-o'></i> <span class='ipsResponsive_showDesktop ipsResponsive_inline'>&nbsp;
CONTENT;

if ( \IPS\Member::loggedIn()->member_id === $member->member_id ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_browse_my_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_browse_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span></a>
		</div>
		<ul class='ipsList_reset ipsFlex ipsFlex-ai:center ipsFlex-fw:wrap ipsPos_left ipsResponsive_noFloat'>
			<li>
				<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->member_posts );
$return .= <<<CONTENT

			</li>
			<li>
				<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				
CONTENT;

$val = ( $member->joined instanceof \IPS\DateTime ) ? $member->joined : \IPS\DateTime::ts( $member->joined );$return .= $val->html();
$return .= <<<CONTENT

			</li>
            
CONTENT;

if ( ( !$member->isOnlineAnonymously() ) OR ( $member->isOnlineAnonymously() AND \IPS\Member::loggedIn()->isAdmin() ) ):
$return .= <<<CONTENT

			<li>
				<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<span>
					
CONTENT;

if ( $member->isOnline() AND ( !$member->isOnlineAnonymously() OR ( $member->isOnlineAnonymously() AND \IPS\Member::loggedIn()->isAdmin() ) ) ):
$return .= <<<CONTENT

                    	<i class="fa fa-circle ipsOnlineStatus_online" data-ipsTooltip title='
CONTENT;

if ( $member->isOnlineAnonymously() ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now_anon', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

elseif ( $member->isOnline() ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'></i>
                    
CONTENT;

endif;
$return .= <<<CONTENT

                    
CONTENT;

if ( $member->last_activity ):
$return .= <<<CONTENT

CONTENT;

$val = ( $member->last_activity instanceof \IPS\DateTime ) ? $member->last_activity : \IPS\DateTime::ts( $member->last_activity );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'never', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				</span>
			</li>
            
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Settings::i()->reputation_leaderboard_on and \IPS\Settings::i()->reputation_show_days_won_trophy and $member->getReputationDaysWonCount() ):
$return .= <<<CONTENT

			<li>
				<h4 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_days_won_count', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<span data-ipsTooltip title='
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_days_won_count_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->getReputationDaysWonCount() );
$return .= <<<CONTENT
</span>
			</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>
</header>
CONTENT;

		return $return;
}

	function profileTabs( $member, $tabs, $activeTab, $activeTabContents ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $tabs ) > 1 ):
$return .= <<<CONTENT

	<div class='ipsTabs ipsTabs_stretch ipsClearfix' id='elProfileTabs' data-ipsTabBar data-ipsTabBar-contentArea='#elProfileTabs_content'>
		<a href='#elProfileTabs' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
		<ul role="tablist">
			
CONTENT;

foreach ( $tabs as $tab => $title ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'tab', $tab ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elProfileTab_
CONTENT;
$return .= htmlspecialchars( $tab, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_item ipsType_center 
CONTENT;

if ( $activeTab == $tab ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' role="tab" aria-selected="
CONTENT;

if ( $activeTab == $tab ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<div id='elProfileTabs_content' class='ipsTabs_panels ipsPadding ipsAreaBackground_reset'>
	
CONTENT;

foreach ( $tabs as $tab => $title ):
$return .= <<<CONTENT

		
CONTENT;

if ( $activeTab == $tab ):
$return .= <<<CONTENT

			<div id="ipsTabs_elProfileTabs_elProfileTab_
CONTENT;
$return .= htmlspecialchars( $tab, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" class='ipsTabs_panel ipsAreaBackground_reset'>
				{$activeTabContents}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function recentVisitorsBlock( $member, $visitors ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $member->members_bitoptions['pp_setting_count_visitors'] ):
$return .= <<<CONTENT

	
	<h2 class='ipsWidget_title ipsType_reset'>
		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_modify_profiles') or ( \IPS\Member::loggedIn()->member_id == $member->member_id and $member->group['g_edit_profile'] ) ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=visitors&id=$member->member_id" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsType_light ipsType_normal ipsPos_right ipsFaded ipsFaded_more ipsFaded_withHover' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_recent_visitors', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='disable'><i class='fa fa-times'></i></a>
		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_recent_visitors', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h2>
	<div class='ipsWidget_inner ipsPad'>
		<span class='ipsType_light'>
			
CONTENT;

$pluralize = array( $member->members_profile_views ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_views', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

		</span>
		
CONTENT;

if ( \is_array( $visitors ) AND \count( $visitors )  ):
$return .= <<<CONTENT

			<ul class='ipsDataList ipsDataList_reducedSpacing ipsSpacer_top'>
			
CONTENT;

foreach ( $visitors as $visitor ):
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsType_center ipsDataItem_icon'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $visitor['member'], 'tiny' );
$return .= <<<CONTENT

					</div>
					<div class='ipsDataItem_main'>
						<h3 class='ipsDataItem_title'>{$visitor['member']->link()}</h3>
						<p class='ipsDataItem_meta ipsType_light'>
CONTENT;

$val = ( $visitor['visit_time'] instanceof \IPS\DateTime ) ? $visitor['visit_time'] : \IPS\DateTime::ts( $visitor['visit_time'] );$return .= $val->html();
$return .= <<<CONTENT
</p>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsType_center ipsType_medium'>
				<p class='ipsType_light'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_recent_visitors', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</p>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<h2 class='ipsWidget_title ipsType_reset'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_recent_visitors', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h2>
	<div class='ipsWidget_inner ipsPad'>
		<div class='ipsType_center ipsType_medium'>
			<p class='ipsType_light'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disabled_recent_visitors', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</p>
            
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_modify_profiles') or ( \IPS\Member::loggedIn()->member_id == $member->member_id and $member->group['g_edit_profile'] ) ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=visitors&id={$member->member_id}&state=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "profile", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='' data-action='enable'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
            
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

		return $return;
}

	function singleStatus( $member, $status ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPad' id='elSingleStatusUpdate'>
	<h2 class='ipsType_pageTitle 
CONTENT;

if ( !isset( \IPS\Request::i()->status ) ):
$return .= <<<CONTENT
ipsSpacer_top
CONTENT;

endif;
$return .= <<<CONTENT
'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'viewing_single_status', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h2>
	<p class='ipsType_reset ipsType_normal ipsSpacer_bottom'>
		<a href='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( array( 'do' => 'content', 'type' => 'core_statuses_status', 'change_section' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-caret-left'></i> 
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_statuses_by_x', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>
	</p>
	<div data-controller='core.front.profile.statusFeed' class='cStatusUpdates ipsSpacer_top'>
		<ol class='ipsType_normal ipsList_reset' data-role='commentFeed'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "statuses", "core" )->statusContainer( $status );
$return .= <<<CONTENT

		</ol>
	</div>
</div>
CONTENT;

		return $return;
}

	function tableRow( $table, $headers, $members ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $members as $member ):
$return .= <<<CONTENT

	
CONTENT;

$loadedMember = \IPS\Member::load( $member->member_id );
$return .= <<<CONTENT

	<li class='ipsDataItem'>
		<div class='ipsDataItem_icon'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $loadedMember, 'medium' );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h3 class='ipsType_sectionHead'>{$loadedMember->link()}</h3> 
CONTENT;

if ( $loadedMember->isOnline() ):
$return .= <<<CONTENT
<i class="fa fa-circle ipsOnlineStatus_online" data-ipsTooltip title='
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'></i>
CONTENT;

endif;
$return .= <<<CONTENT
<br>
			<span class='ipsType_normal'>
CONTENT;

$return .= \IPS\Member\Group::load( $member->member_group_id )->formattedName;
$return .= <<<CONTENT
</span>
			<ul class='ipsList_inline ipsType_light'>
				<li><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;
$return .= htmlspecialchars( $loadedMember->member_posts, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></li>
				<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $loadedMember->joined instanceof \IPS\DateTime ) ? $loadedMember->joined : \IPS\DateTime::ts( $loadedMember->joined );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( $loadedMember->last_activity ):
$return .= <<<CONTENT

					<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $loadedMember->last_activity instanceof \IPS\DateTime ) ? $loadedMember->last_activity : \IPS\DateTime::ts( $loadedMember->last_activity );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $member ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state=''>
					<span></span>
				</span>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userBadgeOverview( $member, $percentage ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$baseUrl = \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=content", 'front', 'profile_content', $member->members_seo_name );
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<div data-controller='core.front.profile.main' id='elProfileUserContent'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, true );
$return .= <<<CONTENT

	<div data-role="profileContent" class='ipsSpacer_top'>

CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsColumns ipsColumns_collapseTablet'>
			<div class='ipsColumn ipsColumn_veryWide'>
				<div class='ipsBox ipsSpacer_bottom'>
					<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_profile_rank_progress', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					<div class='ipsPadding'>
						
CONTENT;

if ( $member->rank() ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsMargin_bottom'>
                            
CONTENT;

if ( $percentage ):
$return .= <<<CONTENT

                                
CONTENT;

$sprintf = array($member->name, $member->rank()->rankPosition()['pos'], $member->rank()->rankPosition()['max'], $percentage); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_rank_progress_blurb_percentage', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

                            <span class="ipsType_light ipsType_small" data-ipsToolTip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_rank_progress_blurb_percentage_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"><i class="fa fa-info-circle"></i></span>
                            
CONTENT;

else:
$return .= <<<CONTENT

                                
CONTENT;

$sprintf = array($member->name, $member->rank()->rankPosition()['pos'], $member->rank()->rankPosition()['max']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_rank_progress_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

                            
CONTENT;

endif;
$return .= <<<CONTENT

                        </p>
						<hr class='ipsHr ipsMargin_bottom:double'>
                        
CONTENT;

endif;
$return .= <<<CONTENT


						<ul class='ipsList_reset cRankHistory ipsPos_relative'>
                            
CONTENT;

if ( $member->rankHistory()['earned'] ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( $member->rankHistory()['earned'] as $entry ):
$return .= <<<CONTENT

								<li class='ipsFlex ipsMargin_vertical cRankHistory__item'>
									{$entry['rank']->html( 'ipsFlex-flex:00 ipsDimension:4 ipsOutline cRankHistory__itemBadge' )}
									<div class='ipsMargin_left:half'>
										<h3 class='ipsType_reset ipsType_semiBold ipsType_darkText ipsType_large'>
CONTENT;
$return .= htmlspecialchars( $entry['rank']->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
                                        
CONTENT;

if ( ! $entry['time'] or ( $entry['time']->getTimestamp() < \IPS\Settings::i()->achievements_last_rebuilt) ):
$return .= <<<CONTENT

                                            
CONTENT;

if ( \IPS\Settings::i()->achievements_last_rebuilt ):
$return .= <<<CONTENT
<p class='ipsType_reset ipsType_light'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( \IPS\Settings::i()->achievements_last_rebuilt )->shortMonthAndFullYear()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'badge_earned_date_while_rebuilding', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

                                        
CONTENT;

elseif ( $entry['time'] ):
$return .= <<<CONTENT

										<p class='ipsType_reset ipsType_light'>
CONTENT;

$htmlsprintf = array($entry['time']->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'badge_earned_date', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
                                        
CONTENT;

endif;
$return .= <<<CONTENT

									</div>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

                            
CONTENT;

endif;
$return .= <<<CONTENT

                            
CONTENT;

if ( $member->rankHistory()['not_earned'] ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( $member->rankHistory()['not_earned'] as $entry ):
$return .= <<<CONTENT

								<li class='ipsFlex ipsMargin_vertical cRankHistory__item'>
									{$entry['rank']->html( 'ipsFlex-flex:00 ipsDimension:4 ipsOutline cRankHistory__itemBadge cRankHistory__itemBadge--unearned' )}
									<div class='ipsMargin_left:half ipsFaded'>
										<h3 class='ipsType_reset ipsType_semiBold ipsType_large'>
CONTENT;
$return .= htmlspecialchars( $entry['rank']->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
										<p class='ipsType_reset'><em>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'badge_earned_but_not_really', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></p>
									</div>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

                            
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</div>
				</div>
			</div>	
			<div class='ipsColumn ipsColumn_fluid'>
				<div class='ipsBox ipsSpacer_bottom'>
					<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$pluralize = array( $member->badgeCount() ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_profile_title', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
					
CONTENT;

if ( $member->badgeCount() ):
$return .= <<<CONTENT

						<div class='ipsPadding cProfileBadgeGrid'>
							
CONTENT;

foreach ( $member->recentBadges( NULL ) as $badge ):
$return .= <<<CONTENT

								<div class='ipsFlex ipsFlex-ai:center'>
									{$badge->html('ipsFlex-flex:00 ipsDimension:4', FALSE, TRUE)}
									<div class='ipsMargin_left:half'>
										
CONTENT;

if ( ! empty( $badge->recognize ) AND $badge->recognize->contentWrapper()  ):
$return .= <<<CONTENT

										<h4 class='ipsType_reset ipsType_semiBold ipsType_medium'>
											
CONTENT;

$sprintf = array($badge->_title, $badge->recognize->content()->url(), $badge->recognize->content()->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'badge_from_recognize', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

										</h4>
										
CONTENT;

else:
$return .= <<<CONTENT

										<h4 class='ipsType_reset ipsType_semiBold ipsType_medium'>
CONTENT;
$return .= htmlspecialchars( $badge->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h4>
										
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

if ( ! empty( $badge->awardDescription ) ):
$return .= <<<CONTENT

											<p class='ipsType_reset ipsType_small ipsType_light'>
CONTENT;
$return .= htmlspecialchars( $badge->awardDescription, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
										
CONTENT;

endif;
$return .= <<<CONTENT

                                        
CONTENT;

if ( $badge->datetime < \IPS\Settings::i()->achievements_last_rebuilt ):
$return .= <<<CONTENT

                                            
CONTENT;

if ( \IPS\Settings::i()->achievements_last_rebuilt ):
$return .= <<<CONTENT
<p class='ipsType_reset ipsType_small ipsType_light'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( \IPS\Settings::i()->achievements_last_rebuilt )->shortMonthAndFullYear()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'badge_earned_date_while_rebuilding', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

                                        
CONTENT;

else:
$return .= <<<CONTENT

                                        <p class='ipsType_reset ipsType_small ipsType_light'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $badge->datetime )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'badge_earned_date', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
                                        
CONTENT;

endif;
$return .= <<<CONTENT

									</div>
								</div>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</div>
					
CONTENT;

else:
$return .= <<<CONTENT

						<div class='ipsPadding ipsType_center ipsType_light'>
							
CONTENT;

if ( $member->member_id === \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

								
CONTENT;

$sprintf = array(); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_self_none', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_member_none', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userContent( $member, $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$baseUrl = \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=content", 'front', 'profile_content', $member->members_seo_name );
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<div data-controller='core.front.profile.main' id='elProfileUserContent'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, true );
$return .= <<<CONTENT

	<div data-role="profileContent" class='ipsSpacer_top'>

CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone">
			<div class="ipsColumn ipsColumn_wide">
				<div class='ipsPadding:half ipsBox'>
					<div class="ipsSideMenu" data-ipsTabBar data-ipsTabBar-contentArea='#elUserContent' data-ipsTabBar-itemselector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsSideMenu>
						<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
							<a href="#user_content" class="ipsPad_double" data-action="openSideMenu"><i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_content_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i></a>
						</h3>
						<div>
							<ul class="ipsSideMenu_list">
								<li><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'change_section' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( !$currentType ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all_activity', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							</ul>
							
CONTENT;

foreach ( $types as $app => $_types ):
$return .= <<<CONTENT

								<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$val = "module__{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
								<ul class="ipsSideMenu_list">
									
CONTENT;

foreach ( $_types as $key => $class ):
$return .= <<<CONTENT

										<li><a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( array( 'type' => $key, 'change_section' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$val = "{$class::$title}_pl"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</div>			
					</div>
				</div>
			</div>
			<div class="ipsColumn ipsColumn_fluid" id='elUserContent'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->userContentSection( $member, $types, $currentAppModule, $currentType, $table );
$return .= <<<CONTENT

			</div>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userContentSection( $member, $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox'>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( !$currentAppModule ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all_content_by_user', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $types[ $currentAppModule ][ $currentType ]::$title . '_pl' ), $member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_by_user', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
	{$table}
</div>
CONTENT;

		return $return;
}

	function userContentStream( $member, $results, $pagination ) {
		$return = '';
		$return .= <<<CONTENT


<div data-baseurl="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}&all_activity=1&page=1", null, "profile_content", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-resort="listResort" data-tableid="topics" data-controller="core.global.core.table">
	<div data-role="tableRows">
		
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

			<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear" data-role="tablePagination">
				{$pagination}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<ol class='ipsDataList ipsDataList_large cSearchActivity ipsStream ipsPad'>
			
CONTENT;

foreach ( $results as $activity ):
$return .= <<<CONTENT

				{$activity->html()}
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
		
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

			<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
				{$pagination}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function userReputation( $member, $types, $currentAppModule, $currentType, $table, $reactions ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<div data-controller='core.front.profile.main'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, true );
$return .= <<<CONTENT

	<div data-role="profileContent" class="ipsSpacer_top">

CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone ipsSpacer_top">
			<aside class="ipsColumn ipsColumn_wide">
				<div class="cProfileRepScore ipsMargin_bottom ipsPadding:half 
CONTENT;

if ( $member->pp_reputation_points > 1 ):
$return .= <<<CONTENT
cProfileRepScore_positive
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
cProfileRepScore_negative
CONTENT;

else:
$return .= <<<CONTENT
cProfileRepScore_neutral
CONTENT;

endif;
$return .= <<<CONTENT
">
					<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_reputation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					<span class='cProfileRepScore_points'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->pp_reputation_points );
$return .= <<<CONTENT
</span>
					
CONTENT;

if ( $member->reputation() ):
$return .= <<<CONTENT

						<span class='cProfileRepScore_title'>
CONTENT;
$return .= htmlspecialchars( $member->reputation(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $member->reputationImage() ):
$return .= <<<CONTENT

						<div class='ipsAreaBackground_reset ipsRadius ipsPad_half ipsType_center'>
							<img src='
CONTENT;

$return .= \IPS\File::get( "core_Theme", $member->reputationImage() )->url;
$return .= <<<CONTENT
' alt=''>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT
		
				</div>
				
CONTENT;

if ( \count( $reactions['given'] ) OR \count( $reactions['received'] ) ):
$return .= <<<CONTENT

					<div class="ipsMargin_bottom ipsPadding:half ipsBox">
						
CONTENT;

if ( \count( $reactions['given'] ) ):
$return .= <<<CONTENT

							<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_reactions_given', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
							<div class='ipsPad_half ipsGrid'>
								
CONTENT;

foreach ( $reactions['given'] as $reaction ):
$return .= <<<CONTENT

									<div class='ipsGrid_span6'>
										<img src='
CONTENT;

$return .= \IPS\File::get( "core_Reaction", $reaction['reaction']->_icon )->url;
$return .= <<<CONTENT
' width="20" height="20" alt='
CONTENT;
$return .= htmlspecialchars( $reaction['reaction']->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip> 
										<span class='ipsCommentCount'>
CONTENT;
$return .= htmlspecialchars( $reaction['count'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									</div>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT


						
CONTENT;

if ( \count( $reactions['received'] ) ):
$return .= <<<CONTENT

							<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_reactions_received', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
							<div class='ipsPad_half ipsGrid'>
								
CONTENT;

foreach ( $reactions['received'] as $reaction ):
$return .= <<<CONTENT

									<div class='ipsGrid_span6'>
										<img src='
CONTENT;

$return .= \IPS\File::get( "core_Reaction", $reaction['reaction']->_icon )->url;
$return .= <<<CONTENT
' width="20" height="20" alt='
CONTENT;
$return .= htmlspecialchars( $reaction['reaction']->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip> 
										<span class='ipsCommentCount'>
CONTENT;
$return .= htmlspecialchars( $reaction['count'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									</div>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsPadding:half ipsBox'>
					<div class="ipsSideMenu" data-ipsTabBar data-ipsTabBar-contentArea='#elUserReputation' data-ipsTabBar-itemselector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsSideMenu>
						<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
							<a href="#user_reputation" class="ipsPad_double" data-action="openSideMenu"><i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_content_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i></a>
						</h3>
						<div>
							
CONTENT;

foreach ( $types as $app => $_types ):
$return .= <<<CONTENT

								<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$val = "module__{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
								<ul class="ipsSideMenu_list">
									
CONTENT;

foreach ( $_types as $key => $class ):
$return .= <<<CONTENT

										<li><a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation&type={$key}&change_section=1", null, "profile_reputation", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$val = "{$class::$title}_pl"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</div>			
					</div>
				</div>
			</aside>
			<section class='ipsColumn ipsColumn_fluid'>
				<div class='ipsBox'>
					<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					<div id='elUserReputation'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->userReputationSection( $table );
$return .= <<<CONTENT

					</div>
				</div>
			</section>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT
	
CONTENT;

		return $return;
}

	function userReputationRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		
CONTENT;

$reaction = \IPS\Content\Reaction::load( $row->rep_reaction );
$return .= <<<CONTENT

		<li class='ipsDataItem'>		
			
CONTENT;

if ( !\IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

				<div class='ipsDataItem_generic ipsDataItem_size1'>
					<img src='
CONTENT;

$return .= \IPS\File::get( "core_Reaction", $reaction->_icon )->url;
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $reaction->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' width='20' height='20' data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $reaction->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center ipsResponsive_hidePhone'>
				
CONTENT;

if ( $row->rep_member == \IPS\Request::i()->id ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( \IPS\Request::i()->id ), 'mini' );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $row->rep_member ), 'mini' );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<span class=''>
					
CONTENT;

if ( !\IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

						
CONTENT;

if ( $row instanceof \IPS\Content\Comment or $row instanceof \IPS\Content\Review ):
$return .= <<<CONTENT

							
CONTENT;

$item = $row->item();
$return .= <<<CONTENT

							
CONTENT;

if ( $row->rep_member != \IPS\Request::i()->id ):
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member_received )->link(), \IPS\Member::load( $row->rep_member )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_comment_received', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), \IPS\Member::load( $row->rep_member_received )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_comment_gave', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_comment_gave_no_recipient', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( $row->rep_member != \IPS\Request::i()->id ):
$return .= <<<CONTENT

								
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member_received )->link(), \IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_received', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), \IPS\Member::load( $row->rep_member_received )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave_no_recipient', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						<strong>
							
CONTENT;

if ( $row instanceof \IPS\Content\Comment or $row instanceof \IPS\Content\Review ):
$return .= <<<CONTENT

								
CONTENT;

$item = $row->item();
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->url(), $row->indefiniteArticle(), \IPS\Member::load( $row->rep_member_received )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->url(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_comment_no_recipient', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $item->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $row->rep_member_received ):
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle(), \IPS\Member::load( $row->rep_member_received )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_item', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$htmlsprintf = array(\IPS\Member::load( $row->rep_member )->link(), $row->indefiniteArticle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_item_no_recipient', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</span>
				<span class='ipsType_light ipsType_medium'>&nbsp;&nbsp;
CONTENT;

$val = ( $row->rep_date instanceof \IPS\DateTime ) ? $row->rep_date : \IPS\DateTime::ts( $row->rep_date );$return .= $val->html();
$return .= <<<CONTENT
</span>
				<br>
				
CONTENT;

if ( $result = $row->truncated() ):
$return .= <<<CONTENT

					<div class='ipsType_medium ipsType_richText ipsContained cProfileRepLog_text' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='2 lines'>
						{$result}
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function userReputationSection( $table ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsDataList ipsDataList_large'>
	{$table}
</section>
CONTENT;

		return $return;
}

	function userReputationTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.global.core.table
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT
,core.front.core.moderation
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $table->getPaginationKey() != 'page' ):
$return .= <<<CONTENT
data-pageParam='
CONTENT;
$return .= htmlspecialchars( $table->getPaginationKey(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

if ( $table->title ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset ipsClear'>
CONTENT;

$val = "{$table->title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $table->showAdvancedSearch AND ( (isset( $table->sortOptions ) and !empty( $table->sortOptions )) OR $table->advancedSearch ) OR !empty( $table->filters ) OR $table->pages > 1 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( $table->showAdvancedSearch AND ( ( isset( $table->sortOptions ) and \count( $table->sortOptions ) > 1 ) OR $table->advancedSearch ) ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

if ( isset($table->sortOptions)  ):
$return .= <<<CONTENT

					<a href="#elSortByMenu_menu" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="sortButton" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
							
CONTENT;

$custom = TRUE;
$return .= <<<CONTENT

							
CONTENT;

foreach ( $table->sortOptions as $k => $col ):
$return .= <<<CONTENT

								<li class="ipsMenu_item 
CONTENT;

if ( $col === $table->sortBy ):
$return .= <<<CONTENT

CONTENT;

$custom = FALSE;
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $col, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-sortDirection='
CONTENT;
$return .= htmlspecialchars( $table->getSortDirection( $col ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => $table->getSortDirection( $col ) ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$table->langPrefix}sort_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->advancedSearch ):
$return .= <<<CONTENT

							<li class="ipsMenu_item 
CONTENT;

if ( $custom ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-noSelect="true">
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
					
CONTENT;

elseif ( $table->advancedSearch ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" data-role="tableFilterMenu" id="elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<li data-action="tableFilter" data-ipsMenuValue='' class='ipsMenu_item 
CONTENT;

if ( !$table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => '', 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}all"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

foreach ( $table->filters as $k => $q ):
$return .= <<<CONTENT

							<li data-action="tableFilter" data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item 
CONTENT;

if ( $k === $table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
		<div data-role="tablePagination" 
CONTENT;

if ( $table->pages <= 1 ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

		</div>
	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsClear 
CONTENT;

foreach ( $table->classes as $class ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endforeach;
$return .= <<<CONTENT
' id='elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="tableRows">
			
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

		</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsType_center ipsPad'>
			<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

				
	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear 
CONTENT;

if ( $table->pages <= 1 ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
" data-role="tablePagination">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function userSolutions( $member, $types, $currentType, $table, $solutions ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<div data-controller='core.front.profile.main'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core", 'front' )->profileHeader( $member, true );
$return .= <<<CONTENT

	<div data-role="profileContent" class="ipsSpacer_top">

CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone ipsSpacer_top">
			<aside class="ipsColumn ipsColumn_wide">
				<div class='cProfileSidebarBlock ipsMargin_bottom'>
					<div class='cProfileRepScore ipsPad_half cProfileSolutions'>
						<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_solutions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
						<span class='cProfileRepScore_points'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $solutions );
$return .= <<<CONTENT
</span>
					</div>
				</div>
				
CONTENT;

if ( \count( $types ) > 1 ):
$return .= <<<CONTENT

					<div class='ipsPadding:half ipsBox'>
						<div class="ipsSideMenu" data-ipsTabBar data-ipsTabBar-contentArea='#elUserSolutions' data-ipsTabBar-itemselector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsSideMenu>
							<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
								<a href="#user_solutions" class="ipsPad_double" data-action="openSideMenu"><i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_content_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i></a>
							</h3>
							<div>
								<ul class="ipsSideMenu_list">
								
CONTENT;

foreach ( $types as $key => $type ):
$return .= <<<CONTENT

									<li><a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=solutions&type={$key}&change_section=1", null, "profile_solutions", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$val = "{$type::$title}_pl"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							</div>
						</div>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</aside>
			<section class="ipsColumn ipsColumn_fluid">
				<div class='ipsBox'>
					<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_solutions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					<div id='elUserSolutions'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->userSolutionsSection( $table );
$return .= <<<CONTENT

					</div>
				</div>
			</section>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT
	
CONTENT;

		return $return;
}

	function userSolutionsRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		<li class='ipsDataItem'>		
			<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center ipsResponsive_hidePhone'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( \IPS\Request::i()->id ), 'mini' );
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<span class=''>
					
CONTENT;

$sprintf = array(\IPS\Member::load( \IPS\Request::i()->id )->name, $row->url(), \IPS\Member::loggedIn()->language()->addToStack( $row::$title . '_lc' ), $row->item()->url(), $row->item()->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solution_headline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

				</span>
				<span class='ipsType_light ipsType_medium'>&nbsp;&nbsp;
CONTENT;

$val = ( $row->solved_date instanceof \IPS\DateTime ) ? $row->solved_date : \IPS\DateTime::ts( $row->solved_date );$return .= $val->html();
$return .= <<<CONTENT
</span>
				<br>
				
CONTENT;

if ( $result = $row->truncated() ):
$return .= <<<CONTENT

					<div class='ipsType_medium ipsType_richText ipsContained cProfileRepLog_text' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='2 lines'>
						{$result}
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function userSolutionsSection( $table ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsDataList ipsDataList_large'>
	{$table}
</section>
CONTENT;

		return $return;
}

	function userSolutionsTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.global.core.table
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT
,core.front.core.moderation
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $table->getPaginationKey() != 'page' ):
$return .= <<<CONTENT
data-pageParam='
CONTENT;
$return .= htmlspecialchars( $table->getPaginationKey(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

if ( $table->title ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset ipsClear'>
CONTENT;

$val = "{$table->title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $table->showAdvancedSearch AND ( (isset( $table->sortOptions ) and !empty( $table->sortOptions )) OR $table->advancedSearch ) OR !empty( $table->filters ) OR $table->pages > 1 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( $table->showAdvancedSearch AND ( ( isset( $table->sortOptions ) and \count( $table->sortOptions ) > 1 ) OR $table->advancedSearch ) ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

if ( isset($table->sortOptions)  ):
$return .= <<<CONTENT

					<a href="#elSortByMenu_menu" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="sortButton" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
							
CONTENT;

$custom = TRUE;
$return .= <<<CONTENT

							
CONTENT;

foreach ( $table->sortOptions as $k => $col ):
$return .= <<<CONTENT

								<li class="ipsMenu_item 
CONTENT;

if ( $col === $table->sortBy ):
$return .= <<<CONTENT

CONTENT;

$custom = FALSE;
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $col, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-sortDirection='
CONTENT;
$return .= htmlspecialchars( $table->getSortDirection( $col ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => $table->getSortDirection( $col ) ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$table->langPrefix}sort_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->advancedSearch ):
$return .= <<<CONTENT

							<li class="ipsMenu_item 
CONTENT;

if ( $custom ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-noSelect="true">
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
					
CONTENT;

elseif ( $table->advancedSearch ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" data-role="tableFilterMenu" id="elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<li data-action="tableFilter" data-ipsMenuValue='' class='ipsMenu_item 
CONTENT;

if ( !$table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => '', 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}all"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

foreach ( $table->filters as $k => $q ):
$return .= <<<CONTENT

							<li data-action="tableFilter" data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item 
CONTENT;

if ( $k === $table->filter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
		<div data-role="tablePagination" 
CONTENT;

if ( $table->pages <= 1 ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

		</div>
	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsClear 
CONTENT;

foreach ( $table->classes as $class ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endforeach;
$return .= <<<CONTENT
' id='elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="tableRows">
			
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

		</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsType_center ipsPad'>
			<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

				
	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear 
CONTENT;

if ( $table->pages <= 1 ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
" data-role="tablePagination">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}}