<?php
namespace IPS\Theme\Cache;
class class_core_front_popular extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function memberRow( $member, $rep=NULL, $trophy=0, $contentLabel='members_member_posts', $contentCount='member_posts' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$rep = $rep ?: $member->pp_reputation_points;
$return .= <<<CONTENT


CONTENT;

$contentCount = $contentCount ? $member->$contentCount : $member->member_posts;
$return .= <<<CONTENT

<li class="ipsGrid_span3 ipsStreamItem ipsStreamItem_contentBlock ipsStreamItem_member cTopMembers_member ipsBox ipsBox--child ipsPadding ipsType_center">
	
CONTENT;

if ( $trophy ):
$return .= <<<CONTENT

	<span class="ipsLeaderboard_trophy ipsLeaderboard_trophy_
CONTENT;
$return .= htmlspecialchars( $trophy, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<i class="fa fa-trophy"></i>
	</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'medium' );
$return .= <<<CONTENT

	<div class='ipsStreamItem_container'>
		<div class='ipsStreamItem_header ipsSpacer_top ipsSpacer_half'>
			<h2 class='ipsType_reset ipsStreamItem_title ipsTruncate ipsTruncate_line' data-searchable>
				
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $member );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</h2>
			<p class='ipsType_reset ipsType_medium'>{$member->groupName}</p>
		</div>

		<hr class='ipsHr ipsHr_small'>

		<ul class='ipsList_reset ipsGrid'>
			<li class='ipsGrid_span6 ipsList_reset ipsType_center'>
				<h3 class='ipsType_minorHeading ipsType_unbold'>
					
CONTENT;

if ( \IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rep_system_like', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rep_level_points', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</h3>
				<p class='ipsType_reset ipsTruncate ipsTruncate_line'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge ipsType_medium 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge ipsType_medium 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
			</li>
			<li class='ipsGrid_span6 ipsList_reset ipsType_center'>
				<h3 class='ipsType_minorHeading ipsType_unbold'>
CONTENT;

$val = "{$contentLabel}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $contentCount );
$return .= <<<CONTENT
</p>
			</li>
		</ul>

		<hr class='ipsHr ipsHr_small'>
		
CONTENT;

$showFollowButton = ( \IPS\Member::loggedIn()->member_id != $member->member_id and ( !$member->members_bitoptions['pp_setting_moderate_followers'] or \IPS\Member::loggedIn()->following( 'core', 'member', $member->member_id ) ) );
$return .= <<<CONTENT

		<ul class='ipsList_reset 
CONTENT;

if ( ! $showFollowButton ):
$return .= <<<CONTENT
cTopMembers_NoFollowButton
CONTENT;

endif;
$return .= <<<CONTENT
'>
			<li class='
CONTENT;

if ( $showFollowButton ):
$return .= <<<CONTENT
ipsSpacer_bottom ipsSpacer_half
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&do=content&id={$member->member_id}", "front", "profile_content", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_fullWidth ipsButton_light ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			
CONTENT;

if ( $showFollowButton ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "profile", "core" )->memberFollow( 'core', 'member', $member->member_id, $member->followersCount(), TRUE );
$return .= <<<CONTENT

				</li>
			
CONTENT;

else:
$return .= <<<CONTENT

				<li></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>
</li>
CONTENT;

		return $return;
}

	function popularItem( $indexData, $articles, $authorData, $itemData, $unread, $objectUrl, $itemUrl, $containerUrl, $containerTitle, $repCount, $showRepUrl, $snippet, $iPostedIn, $view, $canIgnoreComments=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsStreamItem ipsStreamItem_expanded ipsStreamItem_contentBlock ipsBox ipsBox--child'>
	<div class='cPopularItem ipsFlex ipsFlex-ai:center ipsFlex-fw:wrap ipsGap_row:5'>
		<div class='cPopularItem_content ipsFlex-flex:11'>
			<div class='ipsContained_container'>
				<div class="ipsStreamItem_header ipsPhotoPanel ipsPhotoPanel_mini">
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $indexData['index_author'] ), 'mini' );
$return .= <<<CONTENT

					<div>
						<h2 class="ipsType_reset ipsStreamItem_title ipsContained ipsType_break">
							
CONTENT;

if ( !\IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

								
CONTENT;

if ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$itemClass = $indexData['index_class']::$itemClass;
$return .= <<<CONTENT

									<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['title'] ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $indexData['index_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$itemClass = $indexData['index_class']::$itemClass;
$return .= <<<CONTENT

									<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['title'] ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

else:
$return .= <<<CONTENT

									<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $indexData['index_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</h2>
						
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT
			
						<p class="ipsType_reset ipsStreamItem_status ipsType_light ipsType_blendLinks">
							
CONTENT;

$membersLiked = \IPS\Member::load( $indexData['rep_data']['member_id'] )->link();
$return .= <<<CONTENT

							
CONTENT;

if ( $indexData['rep_data']['total_rep'] == 2 ):
$return .= <<<CONTENT

								
CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$membersLiked = \IPS\Member::loggedIn()->language()->addToStack('replog_member_and_one_other', NULL, array( 'htmlsprintf' => array( $membersLiked, $objectUrl->setQueryString( array( 'do' => 'showReactionsReview', 'review' => $indexData['index_object_id'] ) ) ) ) );
$return .= <<<CONTENT

								
CONTENT;

elseif ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$membersLiked = \IPS\Member::loggedIn()->language()->addToStack('replog_member_and_one_other', NULL, array( 'htmlsprintf' => array( $membersLiked, $objectUrl->setQueryString( array( 'do' => 'showReactionsComment', 'comment' => $indexData['index_object_id'] ) ) ) ) );
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$membersLiked = \IPS\Member::loggedIn()->language()->addToStack('replog_member_and_one_other', NULL, array( 'htmlsprintf' => array( $membersLiked, $objectUrl->setQueryString('do', 'showReactions') ) ) );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

elseif ( $indexData['rep_data']['total_rep'] > 2 ):
$return .= <<<CONTENT

								
CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$membersLiked = \IPS\Member::loggedIn()->language()->addToStack('replog_member_and_x_other', NULL, array( 'htmlsprintf' => array( \IPS\Member::load( $indexData['rep_data']['member_id'] )->link(), $objectUrl->setQueryString( array( 'do' => 'showReactionsReview', 'review' => $indexData['index_object_id'] ) ), $indexData['rep_data']['total_rep']-1 ) ) );
$return .= <<<CONTENT

								
CONTENT;

elseif ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$membersLiked = \IPS\Member::loggedIn()->language()->addToStack('replog_member_and_x_other', NULL, array( 'htmlsprintf' => array( \IPS\Member::load( $indexData['rep_data']['member_id'] )->link(), $objectUrl->setQueryString( array( 'do' => 'showReactionsComment', 'comment' => $indexData['index_object_id'] ) ), $indexData['rep_data']['total_rep']-1 ) ) );
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

$membersLiked = \IPS\Member::loggedIn()->language()->addToStack('replog_member_and_x_other', NULL, array( 'htmlsprintf' => array( $membersLiked, $objectUrl->setQueryString('do', 'showReactions'), $indexData['rep_data']['total_rep']-1 ) ) );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( !\IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

								
CONTENT;

if ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$itemClass = $indexData['index_class']::$itemClass;
$return .= <<<CONTENT

									
CONTENT;

if ( $indexData['rep_data']['member_received'] ):
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, \IPS\Member::load( $indexData['rep_data']['member_received'] )->link(), $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 
									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave_no_recipient_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

if ( $indexData['rep_data']['member_received'] ):
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, \IPS\Member::load( $indexData['rep_data']['member_received'] )->link(), $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_rate_item_gave_no_recipient_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
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

								
CONTENT;

if ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$itemClass = $indexData['index_class']::$itemClass;
$return .= <<<CONTENT

									
CONTENT;

if ( $indexData['rep_data']['member_received'] ):
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, $objectUrl, $articles['indefinite'], \IPS\Member::load( $indexData['rep_data']['member_received'] )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_comment_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 
									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, $objectUrl, $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_comment_no_recipient_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									
CONTENT;

if ( $indexData['rep_data']['member_received'] ):
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, $articles['indefinite'], \IPS\Member::load( $indexData['rep_data']['member_received'] )->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_item_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

									
CONTENT;

else:
$return .= <<<CONTENT

										
CONTENT;

$htmlsprintf = array($membersLiked, $articles['indefinite']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replog_like_item_no_recipient_no_in', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</p>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</div>
				
CONTENT;

if ( $snippet ):
$return .= <<<CONTENT

					<div class="ipsStreamItem_snippet ipsType_break">
						<div class="ipsType_richText ipsContained ipsType_medium">
							{$snippet}
						</div>			
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<ul class="ipsList_inline ipsStreamItem_meta">
					<li class="ipsType_light ipsType_medium">
						<a href="
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsType_blendLinks"><i class="fa fa-clock-o"></i> 
CONTENT;

$val = ( $indexData['index_date_updated'] instanceof \IPS\DateTime ) ? $indexData['index_date_updated'] : \IPS\DateTime::ts( $indexData['index_date_updated'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
					</li>					
				</ul>
			</div>
		</div>
		<div class='cPopularItem_stats ipsFlex-flex:00 ipsType_center'>
			
CONTENT;

if ( \IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

					
CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'showReactionsReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-destructOnClose data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like_log_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_liked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsToolTip><i class='fa fa-heart'></i> 
CONTENT;
$return .= htmlspecialchars( $indexData['rep_data']['total_rep'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

elseif ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'showReactionsComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-destructOnClose data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like_log_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_liked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsToolTip><i class='fa fa-heart'></i> 
CONTENT;
$return .= htmlspecialchars( $indexData['rep_data']['total_rep'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'showReactions' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-destructOnClose data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like_log_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_liked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsToolTip><i class='fa fa-heart'></i> 
CONTENT;
$return .= htmlspecialchars( $indexData['rep_data']['total_rep'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					<i class='fa fa-heart'></i> 
CONTENT;
$return .= htmlspecialchars( $indexData['rep_data']['total_rep'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				<span>
CONTENT;

$pluralize = array( $indexData['rep_data']['total_rep'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like_blurb_pluralized', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $indexData['rep_data']['rep_rating'] === 1 ):
$return .= <<<CONTENT

					<i class='fa fa-arrow-up'></i>
				
CONTENT;

else:
$return .= <<<CONTENT

					<i class='fa fa-down-up'></i>
				
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $indexData['rep_data']['total_rep'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				<span>
CONTENT;

$pluralize = array( $indexData['rep_data']['total_rep'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rep_level_points_pluralized', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</li>

CONTENT;

		return $return;
}

	function popularItems( $results ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$currentSeparator = NULL;
$return .= <<<CONTENT


CONTENT;

if ( \count( $results ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $results as $result ):
$return .= <<<CONTENT

		
CONTENT;

if ( $result !== NULL ):
$return .= <<<CONTENT

			{$result->html( 'expanded', FALSE, TRUE, array( \IPS\Theme::i()->getTemplate( 'popular', 'core', 'front' ), 'popularItem' ) )}
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<li class='ipsType_center ipsPad' data-role="streamNoResultsMessage">
		<p class='ipsType_reset ipsType_light ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function popularRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty( $rows ) ):
$return .= <<<CONTENT

	<li class='ipsAreaBackground_light ipsPad_double ipsType_light ipsType_center'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</li>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$currentDate = null;
$return .= <<<CONTENT

	
CONTENT;

$rowCounts = array();
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $r ):
$return .= <<<CONTENT

		
CONTENT;

$nextDate = md5( $r['leader_date']->dayAndMonth() . $r['leader_date']->format('Y') );
$return .= <<<CONTENT

		
		
CONTENT;

if ( $currentDate !== $nextDate ):
$return .= <<<CONTENT

			<li class='cPastLeaders_row'>
				<h2 class='cPastLeaders_title ipsType_withHr ipsType_sectionHead'>
					<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=discover&controller=popular&tab=leaderboard&custom_date_start={$r['leader_date']->getTimeStamp()}&custom_date_end={$r['leader_date']->getTimeStamp()}", null, "leaderboard_leaderboard", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $r['leader_date']->dayAndMonth(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $r['leader_date']->format('Y'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</h2>
				<div class='cPastLeaders_grid ipsFlex ipsFlex-fw:wrap ipsGap'>
		
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( ! $r['leader_member_id']->member_id or ! $r['leader_rep_total'] ):
$return .= <<<CONTENT

					<div class='ipsFlex-flex:11'>
						<div class='cPastLeaders_cell cPastLeaders_cellEmpty'></div>
					</div>
			
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsFlex-flex:11'>
						<div class='cPastLeaders_cell' data-position='
CONTENT;

$val = "leader_position_{$r['leader_position']}_short"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
							<span class="ipsLeaderboard_trophy ipsLeaderboard_trophy_
CONTENT;
$return .= htmlspecialchars( $r['leader_position'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$val = "leader_position_{$r['leader_position']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
								<i class="fa fa-trophy"></i>
							</span>
							<div class='ipsPhotoPanel ipsPhotoPanel_mini'>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $r['leader_member_id'], 'mini' );
$return .= <<<CONTENT

								<div>
									<p class='ipsType_reset cPastLeaders_user ipsType_blendLinks ipsTruncate ipsTruncate_line ipsType_bold ipsType_large'>{$r['leader_member_id']->link()}</p>
									<p class='ipsType_reset cPastLeaders_rep'>
										
CONTENT;

if ( \IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

											
CONTENT;

$pluralize = array( $r['leader_rep_total'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'received_x_likes', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											
CONTENT;

$pluralize = array( $r['leader_rep_total'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'received_x_points', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</p>
								</div>								
							</div>
						</div>
					</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !isset( $rowCounts[ $nextDate ] ) ):
$return .= <<<CONTENT

			
CONTENT;

$rowCounts[ $nextDate ] = 1;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

$rowCounts[ $nextDate ]++;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$currentDate = $nextDate;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

				</div>
			</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function popularTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div data-baseurl="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-tableID='pastLeaders' data-controller="core.global.core.genericTable">
	<div class="ipsClear ipsClearfix">
		<div data-role="tablePagination" class='
CONTENT;

if ( $table->pages <= 1 ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 ipsSpacer_bottom'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

		</div>
		<ol class='ipsList_reset ipsPad cPastLeaders' data-role="tableRows">
			
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

		</ol>
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

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function popularWrapper( $results, $areas, $topContributors, $dates, $description, $form, $tzOffsetDifference ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Content\Search\Query::isRebuildRunning() ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_info">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_rebuild_is_running', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$now = \IPS\DateTime::ts( time() );
$return .= <<<CONTENT


CONTENT;

$thisUrl = \IPS\Request::i()->url();
$return .= <<<CONTENT


<div>
    <div class="ipsReputationFilters ipsPad_half ipsClearfix ipsClear">
        
CONTENT;

if ( \count( $dates ) ):
$return .= <<<CONTENT

        <ul class="ipsButtonRow ipsPos_right ipsClearfix">
            <li>
                <a href='#elLeaderboard_app_menu' id="elLeaderboard_app" data-ipsMenu>
CONTENT;

if ( isset( \IPS\Request::i()->in ) and isset( $areas[ \IPS\Request::i()->in ] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($areas[ \IPS\Request::i()->in ][1]); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leaderboard_in_app', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leaderboard_in_all_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
                <ul id="elLeaderboard_app_menu" class="ipsMenu ipsMenu_selectable ipsMenu_normal ipsHide">
                    <li class="ipsMenu_item 
CONTENT;

if ( ! isset( \IPS\Request::i()->in ) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
"><a href="
CONTENT;
$return .= htmlspecialchars( $thisUrl->stripQueryString( 'in' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leaderboard_all_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                    
CONTENT;

foreach ( $areas as $key => $data ):
$return .= <<<CONTENT

                    <li class="ipsMenu_item 
CONTENT;

if ( isset( \IPS\Request::i()->in ) and \IPS\Request::i()->in == $key ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
"><a href="
CONTENT;
$return .= htmlspecialchars( $thisUrl->setQueryString( array( 'in' => $key ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow">
CONTENT;
$return .= htmlspecialchars( $data[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
                    
CONTENT;

endforeach;
$return .= <<<CONTENT

                </ul>
            </li>
            <li>
                <a href='#elLeaderboard_time_menu' id="elLeaderboard_time" data-ipsMenu>
                    
CONTENT;

if ( isset( \IPS\Request::i()->custom_date_start ) or isset( \IPS\Request::i()->custom_date_end ) ):
$return .= <<<CONTENT

                    
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

                    
CONTENT;

elseif ( isset( \IPS\Request::i()->time ) and isset( $dates[ \IPS\Request::i()->time ] ) and $setTime = \IPS\Request::i()->time ):
$return .= <<<CONTENT

                    
CONTENT;

$val = "leaderboard_time_$setTime"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

                    
CONTENT;

else:
$return .= <<<CONTENT

                    
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leaderboard_time_oldest', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

                    
CONTENT;

endif;
$return .= <<<CONTENT

                    <i class="fa fa-caret-down"></i>
                </a>
                <ul id="elLeaderboard_time_menu" class="ipsMenu ipsMenu_selectable ipsMenu_normal ipsHide">
                    
CONTENT;

foreach ( $dates as $human => $timeObject ):
$return .= <<<CONTENT

                    <li class="ipsMenu_item 
CONTENT;

if ( ( ! isset( \IPS\Request::i()->time ) and ( ! isset( \IPS\Request::i()->custom_date_start ) and ! isset( \IPS\Request::i()->custom_date_end ) ) and $human == 'oldest' ) or ( ! isset( \IPS\Request::i()->custom_date_start ) and ( isset( \IPS\Request::i()->time ) and \IPS\Request::i()->time == $human ) ) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
">
                        <a href="
CONTENT;
$return .= htmlspecialchars( $thisUrl->stripQueryString( array('custom_date_start', 'custom_date_end') )->setQueryString( array( 'time' => $human ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow">
                            
CONTENT;

$val = "leaderboard_time_$human"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

                            <p class="ipsTruncate ipsTruncate_line ipsType_reset ipsType_light">
                                
CONTENT;
$return .= htmlspecialchars( $timeObject->dayAndMonth(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $timeObject->format('Y'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $now->localeDate() != $timeObject->localeDate() ):
$return .= <<<CONTENT
 - 
CONTENT;
$return .= htmlspecialchars( $now->dayAndMonth(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $now->format('Y'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

                            </p>
                        </a>
                    </li>
                    
CONTENT;

endforeach;
$return .= <<<CONTENT

                    <li class="ipsMenu_item 
CONTENT;

if ( isset( \IPS\Request::i()->custom_date_start ) or isset( \IPS\Request::i()->custom_date_end ) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
">
                        <a href="#" rel="nofollow" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-content='#elDateForm' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

                        
CONTENT;

if ( isset( \IPS\Request::i()->custom_date_start ) or isset( \IPS\Request::i()->custom_date_end ) ):
$return .= <<<CONTENT

                        <p class="ipsType_reset ipsType_light">
                            
CONTENT;

if ( isset( \IPS\Request::i()->custom_date_start ) ):
$return .= <<<CONTENT

                            
CONTENT;

$val = ( \IPS\Request::i()->custom_date_start instanceof \IPS\DateTime ) ? \IPS\Request::i()->custom_date_start : \IPS\DateTime::ts( \IPS\Request::i()->custom_date_start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT

                            
CONTENT;

if ( isset( \IPS\Request::i()->custom_date_end ) ):
$return .= <<<CONTENT
 - 
CONTENT;

endif;
$return .= <<<CONTENT

                            
CONTENT;

endif;
$return .= <<<CONTENT

                            
CONTENT;

if ( isset( \IPS\Request::i()->custom_date_end ) ):
$return .= <<<CONTENT

                            
CONTENT;

$val = ( \IPS\Request::i()->custom_date_end instanceof \IPS\DateTime ) ? \IPS\Request::i()->custom_date_end : \IPS\DateTime::ts( \IPS\Request::i()->custom_date_end );$return .= (string) $val->localeDate();
$return .= <<<CONTENT

                            
CONTENT;

endif;
$return .= <<<CONTENT

                        </p>
                        
CONTENT;

endif;
$return .= <<<CONTENT

                        </a>
                    </li>
                </ul>
                <div class="ipsHide" id="elDateForm">
                    {$form}
                </div>
            </li>
        </ul>
        
CONTENT;

endif;
$return .= <<<CONTENT

    </div>
	
CONTENT;

if ( \count( $topContributors) ):
$return .= <<<CONTENT

        
CONTENT;

$count = 0;
$return .= <<<CONTENT

        <ol class="ipsPadding sm:ipsPadding:none ipsStream ipsList_reset cStream_members ipsGrid ipsGrid_collapsePhone" data-ipsGrid data-ipsGrid-minItemSize='230' data-ipsGrid-maxItemSize='500' data-ipsGrid-equalHeights='row'>
            
CONTENT;

foreach ( $topContributors as $memberId => $rep ):
$return .= <<<CONTENT

                
CONTENT;

$count++;
$return .= <<<CONTENT

                
CONTENT;

$member = \IPS\Member::load( $memberId );
$return .= <<<CONTENT

                
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "popular", "core" )->memberRow( $member, $rep, $count );
$return .= <<<CONTENT

            
CONTENT;

endforeach;
$return .= <<<CONTENT

        </ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsAreaBackground_light ipsType_center ipsPad ipsType_reset ipsType_light ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_no_member_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
<section class='ipsPadding sm:ipsPadding:none sm:ipsMargin_top' data-controller='core.front.core.ignoredComments'>
    <h2 class='ipsType_pageTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_results_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
    <p class="ipsType_reset ipsType_medium">
CONTENT;
$return .= htmlspecialchars( $description, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>            
    <div data-role='popularResults' class='ipsMargin_top'>
        <ol class='ipsStream ipsList_reset' data-role='popularContent'>
            
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "popular", "core" )->popularItems( $results );
$return .= <<<CONTENT

        </ol>
    </div>
</section>

CONTENT;

if ( $tzOffsetDifference !== NULL ):
$return .= <<<CONTENT

	<div class='ipsPad ipsType_center ipsType_light ipsType_small'>
		
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack('timezone__' . \IPS\Settings::i()->reputation_timezone), $tzOffsetDifference); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_timezone', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function tabs( $tabs, $activeTab, $content ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leaderboard_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>


CONTENT;

$icons = array('leaderboard' => 'trophy', 'history' => 'clock-o', 'members' => 'star');
$return .= <<<CONTENT

<div class='ipsTabs ipsTabs_contained ipsTabs_withIcons ipsTabs_large ipsTabs_stretch ipsClearfix ipsResponsive_pull' id='elTabBar' data-ipsTabBar data-ipsTabbar-defaultTab="elTab
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTabBar-contentArea='#elLeaderboardContent'>
	<a href='#elTabBar' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
	<ul role='tablist'>
		
CONTENT;

foreach ( $tabs as $key ):
$return .= <<<CONTENT

		<li role='presentation'>
			
CONTENT;

$seoTemplate = 'leaderboard_' . $key;
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=discover&controller=popular&tab={$key}", null, "$seoTemplate", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' role='tab' id='elTab
CONTENT;
$return .= htmlspecialchars( $key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_center ipsTabs_item 
CONTENT;

if ( $key == $activeTab ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $key == $activeTab ):
$return .= <<<CONTENT
aria-selected="true"
CONTENT;

endif;
$return .= <<<CONTENT
>
				<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $icons[$key], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i>
				
CONTENT;

$val = "leaderboard_tabs_{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</a>
		</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
<section id='elLeaderboardContent' class="ipsTabs_panels ipsTabs_contained ipsResponsive_pull">
	<div id='ipsTabs_elTabBar_elTab
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' aria-labelledby='elTab
CONTENT;
$return .= htmlspecialchars( $activeTab, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' aria-hidden='false' class='ipsTabs_panel ipsPadding'>
		{$content}
	</div>
</section>
CONTENT;

		return $return;
}

	function topMembers( $url, $filters, $activeFilter, $output ) {
		$return = '';
		$return .= <<<CONTENT

<div data-baseurl='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='topMembers' data-tableID='topMembers' data-controller='core.global.core.table'>
	<div class="ipsPad_half ipsClearfix ipsClear">
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			<li>
				<a href="#elFilterByMenu_menu" id="elFilterByMenu" data-role='tableFilterMenu' data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio"><span data-role="extraHtml">
CONTENT;
$return .= htmlspecialchars( $filters[ $activeFilter ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> <i class="fa fa-caret-down"></i></a>
				<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' data-role="tableFilterMenu" id='elFilterByMenu_menu'>
					
CONTENT;

foreach ( $filters as $k => $v ):
$return .= <<<CONTENT

						<li data-action="tableFilter" data-ipsMenuValue='
CONTENT;

$return .= htmlspecialchars( str_replace( array( 'IPS\\', '\\' ), array( '', '_' ), $k ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item 
CONTENT;

if ( $k === $activeFilter ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'filter' => str_replace( array( 'IPS\\', '\\' ), array( '', '_' ), $k ) ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="nofollow">
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</li>
		</ul>
	</div>
	<section data-role="tableRows">
		{$output}
	</section>
	<div class="ipsHide" data-role="tablePagination"></div>
</div>

CONTENT;

		return $return;
}

	function topMembersOverview( $filters ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $filters as $k => $lang ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "popular", \IPS\Request::i()->app )->topMembersResults( $k, $lang, \IPS\Member::topMembers( $k, \IPS\Settings::i()->reputation_overview_max_members ) );
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function topMembersResults( $filter, $title, $results ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPadding sm:ipsPadding:none ipsSpacer_bottom">
	
CONTENT;

if ( $title ):
$return .= <<<CONTENT

		<h2 class="ipsType_pageTitle ipsMargin_bottom">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \count( $results ) ):
$return .= <<<CONTENT

		<ol class="ipsStream ipsList_reset cStream_members ipsGrid ipsGrid_collapsePhone" data-ipsGrid data-ipsGrid-minItemSize='230' data-ipsGrid-maxItemSize='500' data-ipsGrid-equalHeights='row'>
			
CONTENT;

foreach ( $results as $member ):
$return .= <<<CONTENT

				
CONTENT;

if ( \in_array( $filter, array( 'pp_reputation_points', 'member_posts' ) ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "popular", "core" )->memberRow( $member );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "popular", "core" )->memberRow( $member, NULL, 0, $filter::$title . '_pl_lc', '_customCount' );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_light'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}}