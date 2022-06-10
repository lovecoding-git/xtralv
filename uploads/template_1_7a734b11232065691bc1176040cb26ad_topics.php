<?php
namespace IPS\Theme\Cache;
class class_forums_front_topics extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function activity( $topic, $location ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$lastPoster = \IPS\Member::load( $topic->last_poster_id);
$return .= <<<CONTENT


CONTENT;

$members = $topic->topPosters(4);
$return .= <<<CONTENT


CONTENT;

$busy = $topic->showSummaryFeature('popularDays') ? $topic->popularDays(4) : FALSE;
$return .= <<<CONTENT


CONTENT;

$reacted = $topic->showSummaryFeature('topPost') ? $topic->topReactedPosts(3) : FALSE;
$return .= <<<CONTENT


CONTENT;

$images = $topic->showSummaryFeature('uploads') ? $topic->imageAttachments(4) : FALSE;
$return .= <<<CONTENT


CONTENT;

$isQA = $topic->container()->forums_bitoptions['bw_enable_answers'];
$return .= <<<CONTENT


CONTENT;

if ( $location == 'sidebar' ):
$return .= <<<CONTENT

<div class="ipsBox ipsResponsive_hideTablet ipsResponsive_hidePhone cTopicOverview cTopicOverview--sidebar ipsFlex ipsFlex-fd:column md:ipsFlex-fd:row sm:ipsFlex-fd:column" data-controller='forums.front.topic.activity'>

CONTENT;

else:
$return .= <<<CONTENT

<div class="ipsBox cTopicOverview cTopicOverview--inline ipsFlex ipsFlex-fd:row md:ipsFlex-fd:row sm:ipsFlex-fd:column ipsMargin_bottom sm:ipsMargin_bottom:half sm:ipsMargin_top:half ipsResponsive_pull 
CONTENT;

if ( $topic->showSummaryOnDesktop() != 'post' ):
$return .= <<<CONTENT
ipsResponsive_hideDesktop ipsResponsive_block
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( ! $topic->showSummaryOnMobile() ):
$return .= <<<CONTENT
ipsResponsive_hidePhone ipsResponsive_block
CONTENT;

endif;
$return .= <<<CONTENT
" data-controller='forums.front.topic.activity'>

CONTENT;

endif;
$return .= <<<CONTENT

	<div class='cTopicOverview__header ipsAreaBackground_light ipsFlex sm:ipsFlex-fw:wrap sm:ipsFlex-jc:center'>
		<ul class='cTopicOverview__stats ipsPadding ipsMargin:none sm:ipsPadding_horizontal:half ipsFlex ipsFlex-flex:10 ipsFlex-jc:around ipsFlex-ai:center'>
			<li class='cTopicOverview__statItem ipsType_center'>
				<span class='cTopicOverview__statTitle ipsType_light ipsTruncate ipsTruncate_line'>
CONTENT;

if ( $isQA ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forum_preview_posts_answers', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
				<span class='cTopicOverview__statValue'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $topic->posts-1 );
$return .= <<<CONTENT
</span>
			</li>
			<li class='cTopicOverview__statItem ipsType_center'>
				<span class='cTopicOverview__statTitle ipsType_light ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_created', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				<span class='cTopicOverview__statValue'>
CONTENT;

$val = ( $topic->start_date instanceof \IPS\DateTime ) ? $topic->start_date : \IPS\DateTime::ts( $topic->start_date );$return .= $val->html(TRUE, TRUE);
$return .= <<<CONTENT
</span>
			</li>
			<li class='cTopicOverview__statItem ipsType_center'>
				<span class='cTopicOverview__statTitle ipsType_light ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'last_reply', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				<span class='cTopicOverview__statValue'>
CONTENT;

$val = ( $topic->last_post instanceof \IPS\DateTime ) ? $topic->last_post : \IPS\DateTime::ts( $topic->last_post );$return .= $val->html(TRUE, TRUE);
$return .= <<<CONTENT
</span>
			</li>
		</ul>
		<a href='#' data-action='toggleOverview' class='cTopicOverview__toggle cTopicOverview__toggle--inline ipsType_large ipsType_light ipsPad ipsFlex ipsFlex-ai:center ipsFlex-jc:center'><i class='fa fa-chevron-down'></i></a>
	</div>
	
CONTENT;

if ( $location !== 'sidebar' ):
$return .= <<<CONTENT

		<div class='cTopicOverview__preview ipsFlex-flex:10' data-role="preview">
			<div class='cTopicOverview__previewInner ipsPadding_vertical ipsPadding_horizontal ipsResponsive_hidePhone ipsFlex ipsFlex-fd:row'>
				
CONTENT;

if ( $members ):
$return .= <<<CONTENT

					<div class='cTopicOverview__section--users ipsFlex-flex:00'>
						<h4 class='ipsType_reset cTopicOverview__sectionTitle ipsType_dark ipsType_uppercase ipsType_noBreak'>
CONTENT;

if ( $isQA ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_topposters_qa', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_topposters', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h4>
						<ul class='cTopicOverview__dataList ipsMargin:none ipsPadding:none ipsList_style:none ipsFlex ipsFlex-jc:between ipsFlex-ai:center'>
							
CONTENT;

foreach ( $members as $data ):
$return .= <<<CONTENT

								<li class="cTopicOverview__dataItem ipsMargin_right ipsFlex ipsFlex-jc:start ipsFlex-ai:center">
									
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $data['member'], 'tiny' );
$return .= <<<CONTENT

									<p class='ipsMargin:none ipsPadding_left:half ipsPadding_right ipsType_right'>
CONTENT;
$return .= htmlspecialchars( $data['count'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</ul>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $busy ):
$return .= <<<CONTENT

					<div class='cTopicOverview__section--popularDays ipsFlex-flex:00 ipsPadding_left ipsPadding_left:double'>
						<h4 class='ipsType_reset cTopicOverview__sectionTitle ipsType_dark ipsType_uppercase ipsType_noBreak'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_populardays', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
						<ul class='cTopicOverview__dataList ipsMargin:none ipsPadding:none ipsList_style:none ipsFlex ipsFlex-jc:between ipsFlex-ai:center'>
							
CONTENT;

foreach ( $busy as $row ):
$return .= <<<CONTENT

								<li class='ipsFlex-flex:10'>
									<a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $row['commentId'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class='cTopicOverview__dataItem ipsMargin_right ipsType_blendLinks ipsFlex ipsFlex-jc:between ipsFlex-ai:center'>
										<p class='ipsMargin:none'>
CONTENT;
$return .= htmlspecialchars( $row['date']->dayAndShortMonth(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
										<p class='ipsMargin:none ipsMargin_horizontal ipsType_light'>
CONTENT;
$return .= htmlspecialchars( $row['count'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
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

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='cTopicOverview__body ipsPadding 
CONTENT;

if ( $location !== 'sidebar' ):
$return .= <<<CONTENT
ipsHide ipsFlex ipsFlex-flex:11 ipsFlex-fd:column
CONTENT;

endif;
$return .= <<<CONTENT
' data-role="overview">
		
CONTENT;

if ( $members ):
$return .= <<<CONTENT

			<div class='cTopicOverview__section--users ipsMargin_bottom'>
				<h4 class='ipsType_reset cTopicOverview__sectionTitle ipsType_withHr ipsType_dark ipsType_uppercase ipsMargin_bottom'>
CONTENT;

if ( $isQA ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_topposters_qa', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_topposters', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h4>
				<ul class='cTopicOverview__dataList ipsList_reset ipsFlex 
CONTENT;

if ( $location == 'sidebar' ):
$return .= <<<CONTENT
ipsFlex-jc:between
CONTENT;

else:
$return .= <<<CONTENT
ipsFlex-jc:start
CONTENT;

endif;
$return .= <<<CONTENT
 ipsFlex-ai:center ipsFlex-fw:wrap ipsGap:8 ipsGap_row:5'>
					
CONTENT;

foreach ( $members as $data ):
$return .= <<<CONTENT

						<li class="cTopicOverview__dataItem cTopicOverview__dataItem--split ipsFlex ipsFlex-jc:start ipsFlex-ai:center ipsFlex-flex:11">
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $data['member'], 'tiny' );
$return .= <<<CONTENT

							<p class='ipsMargin:none ipsMargin_left:half cTopicOverview__dataItemInner ipsType_left'>
								<strong class='ipsTruncate ipsTruncate_line'><a href='
CONTENT;
$return .= htmlspecialchars( $data['member']->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $data['member']->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></strong>
								<span class='ipsType_light'>
CONTENT;

$pluralize = array( $data['count'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_number_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
							</p>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $busy ):
$return .= <<<CONTENT

			<div class='cTopicOverview__section--popularDays ipsMargin_bottom'>
				<h4 class='ipsType_reset cTopicOverview__sectionTitle ipsType_withHr ipsType_dark ipsType_uppercase ipsMargin_top:half ipsMargin_bottom'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_populardays', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<ul class='cTopicOverview__dataList ipsList_reset ipsFlex 
CONTENT;

if ( $location == 'sidebar' ):
$return .= <<<CONTENT
ipsFlex-jc:between
CONTENT;

else:
$return .= <<<CONTENT
ipsFlex-jc:start
CONTENT;

endif;
$return .= <<<CONTENT
 ipsFlex-ai:center ipsFlex-fw:wrap ipsGap:8 ipsGap_row:5'>
					
CONTENT;

foreach ( $busy as $row ):
$return .= <<<CONTENT

						<li class='ipsFlex-flex:10'>
							<a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $row['commentId'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class='cTopicOverview__dataItem ipsType_blendLinks'>
								<p class='ipsMargin:none ipsType_bold'>
CONTENT;
$return .= htmlspecialchars( $row['date']->dayAndShortMonth(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $row['date']->format('Y'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
								<p class='ipsMargin:none ipsType_light'>
CONTENT;

$pluralize = array( $row['count'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_number_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
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

		
CONTENT;

if ( $reacted ):
$return .= <<<CONTENT

			<div class='cTopicOverview__section--topPost ipsMargin_bottom'>
				<h4 class='ipsType_reset cTopicOverview__sectionTitle ipsType_withHr ipsType_dark ipsType_uppercase ipsMargin_top:half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_popularposts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				
CONTENT;

foreach ( $reacted as $data ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $data['comment']->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class="ipsType_noLinkStyling ipsBlock">
						<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix ipsMargin_top'>
							<span class='ipsUserPhoto ipsUserPhoto_tiny'>
								<img src='
CONTENT;
$return .= htmlspecialchars( $data['comment']->author()->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $data['comment']->author()->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							</span>
							<div>
								<h5 class='ipsType_reset ipsType_bold ipsType_normal ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $data['comment']->author()->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h5>
								<p class='ipsMargin:none ipsType_light ipsType_resetLh'>
CONTENT;

$val = ( $data['comment']->mapped('date') instanceof \IPS\DateTime ) ? $data['comment']->mapped('date') : \IPS\DateTime::ts( $data['comment']->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT
</p>
							</div>
						</div>
						<p class='ipsMargin:none ipsMargin_top:half ipsType_medium ipsType_richText' data-ipsTruncate data-ipsTruncate-size='3 lines' data-ipsTruncate-type='remove'>
							
CONTENT;
$return .= htmlspecialchars( $data['comment']->truncated(true, 200), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						</p>
					</a>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $images ):
$return .= <<<CONTENT

			<div class='cTopicOverview__section--images'>
				<h4 class='ipsType_reset cTopicOverview__sectionTitle ipsType_withHr ipsType_dark ipsType_uppercase ipsMargin_top:half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topicactivity_images', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<div class="ipsMargin_top:half" data-controller='core.front.core.lightboxedImages'>
					<ul class='cTopicOverview__imageGrid ipsMargin:none ipsPadding:none ipsList_style:none ipsFlex ipsFlex-fw:wrap'>
						
CONTENT;

foreach ( $images as $row ):
$return .= <<<CONTENT

							
CONTENT;

$image = \IPS\File::get( 'core_Attachment', ( $row['attach_thumb_location'] ) ? $row['attach_thumb_location'] : $row['attach_location'] )->url;
$return .= <<<CONTENT

							<li class='cTopicOverview__image'>
								<a href="
CONTENT;
$return .= htmlspecialchars( $row['commentUrl'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class='ipsThumb ipsThumb_bg' data-background-src="
CONTENT;
$return .= htmlspecialchars( $image, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
									<img src="
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-src="
CONTENT;
$return .= htmlspecialchars( $image, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsImage">
								</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $location !== 'sidebar' ):
$return .= <<<CONTENT

		<a href='#' data-action='toggleOverview' class='cTopicOverview__toggle cTopicOverview__toggle--afterStats ipsType_large ipsType_light ipsPad ipsFlex ipsFlex-ai:center ipsFlex-jc:center'><i class='fa fa-chevron-down'></i></a>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $location == 'sidebar' ):
$return .= <<<CONTENT

</div>

CONTENT;

else:
$return .= <<<CONTENT

</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

		return $return;
}

	function post( $item, $comment, $editorName, $app, $type, $class='' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT

<div id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' data-controller='core.front.core.comment' data-commentApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentType='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentID="
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-quoteData='
CONTENT;

$return .= htmlspecialchars( json_encode( array('userid' => $comment->author()->member_id, 'username' => $comment->author()->name, 'timestamp' => $comment->mapped('date'), 'contentapp' => $comment::$application, 'contenttype' => $type, 'contentid' => $item->tid, 'contentclass' => $class, 'contentcommentid' => $comment->$idField) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium'>

	<div class='ipsComment_meta ipsType_light ipsFlex ipsFlex-ai:center ipsFlex-jc:between ipsFlex-fd:row-reverse'>
		<div class='ipsType_light ipsType_reset ipsType_blendLinks ipsComment_toolWrap'>
			<div class='ipsResponsive_hidePhone ipsComment_badges'>
				<ul class='ipsList_reset ipsFlex ipsFlex-jc:end ipsFlex-fw:wrap ipsGap:2 ipsGap_row:1'>
					
CONTENT;

if ( ! $comment->isFirst() and $comment->author()->member_id AND $comment->author()->member_id == $item->author()->member_id ):
$return .= <<<CONTENT

						<li><strong class="ipsBadge ipsBadge_large ipsComment_authorBadge">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'author', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT

						<li><strong class='ipsBadge ipsBadge_large ipsBadge_highlightedGroup'>
CONTENT;

$return .= \IPS\Member\Group::load( $comment->author()->member_group_id )->name;
$return .= <<<CONTENT
</strong></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( ( $comment->item()->isSolved() and $comment->item()->mapped('solved_comment_id') == $comment->pid ) ):
$return .= <<<CONTENT

						<li><strong class='ipsBadge ipsBadge_large ipsBadge_positive ipsBadge_reverse'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_solved_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->isFeatured() ):
$return .= <<<CONTENT

						<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_featured_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight )  ):
$return .= <<<CONTENT

						<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</div>
			<ul class='ipsList_reset ipsComment_tools'>
				<li>
					<a href='#elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsComment_ellipsis' id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'><i class='fa fa-ellipsis-h'></i></a>
					<ul id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
						
CONTENT;

if ( $comment->canReportOrRevoke() === TRUE ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('report'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Member::loggedIn()->member_id or \IPS\Helpers\Form\Captcha::supportsModal() ):
$return .= <<<CONTENT
data-ipsDialog data-ipsDialog-remoteSubmit data-ipsDialog-size='medium' data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_submit_success', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->mapped('first')  ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-content='#elShareComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" id='elSharePost_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

else:
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="nofollow" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-content='#elShareComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" id='elSharePost_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

                        
CONTENT;

if ( $comment->canRecognize() === TRUE ):
$return .= <<<CONTENT

                        <li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->author()->url()->setQueryString( array( 'do' => 'recognize', 'content_class' => \get_class( $comment ), 'content_id' => $comment->$idField ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recognize_submit_success', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-title="
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recognize_author', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recognize_author', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
                        
CONTENT;

elseif ( $comment->canRemoveRecognize() ):
$return .= <<<CONTENT

                        <li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->author()->url()->setQueryString( array( 'do' => 'unrecognize', 'content_class' => \get_class( $comment ), 'content_id' => $comment->$idField ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recognize_author_remove_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recognize_author_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                        
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->canEdit() || ( !$comment->mapped('first') and ( $comment->canPromoteToSocialMedia() || $comment->item()->canSolve() || $comment->canDelete() || $comment->canHide() || $comment->canUnhide() || $comment->canSplit() || $item->canFeatureComment() || $item->canUnfeatureComment() || ( $comment->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ) ) ) ):
$return .= <<<CONTENT

							<li class='ipsMenu_sep'><hr></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->canEdit() ):
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->mapped('first') and $comment->item()->canEdit() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

else:
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('edit'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('restore')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('restore')->csrf()->setQueryString( 'restoreAsHidden', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setQueryString( 'immediately', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( $comment instanceof \IPS\Content\Hideable ):
$return .= <<<CONTENT

								
CONTENT;

if ( !$comment->hidden() and $comment->canHide() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('hide'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

elseif ( $comment->hidden() and $comment->canUnhide() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unhide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('split'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-updateOnDelete="#commentCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->isFeatured() AND $item->canUnfeatureComment() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unfeature')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="unrecommendComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unrecommend_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( !$comment->isFeatured() AND $item->canFeatureComment() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('feature')->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recommend_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-size='medium' data-action="recommendComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recommend_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( ( ! $comment->mapped('first') and $comment->canPromoteToSocialMedia() ) ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->promoteLink( $comment );
$return .= <<<CONTENT
</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</li>
				
CONTENT;

if ( \count( $item->commentMultimodActions() ) and !$comment->mapped('first') ):
$return .= <<<CONTENT

				<li><span class='ipsCustomInput'>
					<input type="checkbox" name="multimod[
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" data-role="moderation" data-actions="
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT
split merge
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->hidden() === -1 AND $comment->canUnhide() ):
$return .= <<<CONTENT
unhide
CONTENT;

elseif ( $comment->hidden() === 1 AND $comment->canUnhide() ):
$return .= <<<CONTENT
approve
CONTENT;

elseif ( $comment->canHide() ):
$return .= <<<CONTENT
hide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT
delete
CONTENT;

endif;
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $comment->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->tableStates(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
					<span></span>
				</span></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>

		<div class='ipsType_reset ipsResponsive_hidePhone'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="nofollow" class='ipsType_blendLinks'>{$comment->dateLine()}</a>
			
CONTENT;

if ( $comment->ip_address and \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

				&middot; <a class='ipsType_blendLinks ipsType_light ipsType_noUnderline ipsType_noBreak' href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip=$comment->ip_address", null, "modcp_ip_tools", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-menuID='
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ip_menu'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-down'></i></a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<span class='ipsResponsive_hidePhone'>
				
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

					(
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edited_lc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->hidden() AND $comment->hidden() != -2 ):
$return .= <<<CONTENT

					&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

elseif ( $comment->hidden() == -2 ):
$return .= <<<CONTENT

					&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->deletedBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</span>
		</div>
	</div>

	
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') and $comment->warning ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentWarned( $comment );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


    
CONTENT;

if ( $comment->showRecognized() ):
$return .= <<<CONTENT

        
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentRecognized( $comment );
$return .= <<<CONTENT

    
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='cPost_contentWrap'>
		
CONTENT;

if ( $comment->hidden() !== 0 ):
$return .= <<<CONTENT

			<div class='ipsResponsive_showPhone ipsResponsive_block ipsSpacer_bottom'>
				
CONTENT;

if ( $comment->hidden() AND $comment->hidden() != -2 ):
$return .= <<<CONTENT

					
CONTENT;
$return .= htmlspecialchars( $comment->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

elseif ( $comment->hidden() == -2 ):
$return .= <<<CONTENT

					
CONTENT;
$return .= htmlspecialchars( $comment->deletedBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div data-role='commentContent' class='ipsType_normal ipsType_richText ipsPadding_bottom ipsContained' data-controller='core.front.core.lightboxedImages'>
			{$comment->content()}

			
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

				{$comment->editLine()}
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>

		
CONTENT;

if ( ( \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and $comment->hasReactionBar() ) || ( $comment->hidden() === 1 && ( $comment->canUnhide() || $comment->canDelete() ) ) || ( $comment->hidden() === 0 and $item->canComment() and $editorName ) || $comment->item()->canSolve()  ):
$return .= <<<CONTENT

			<div class='ipsItemControls'>
				
CONTENT;

if ( !( $comment->hidden() === 1 && ( $comment->canUnhide() || $comment->canDelete() ) ) ):
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $comment );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				<ul class='ipsComment_controls ipsClearfix ipsItemControls_left' data-role="commentControls">
					
CONTENT;

if ( $comment->hidden() === 1 && ( $comment->canUnhide() || $comment->canDelete() ) ):
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->canUnhide() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unhide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_positive' data-action='approveComment'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-updateOnDelete="#commentCount" class='ipsButton ipsButton_verySmall ipsButton_negative'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->canEdit() || $comment->canSplit() || $comment->canHide() ):
$return .= <<<CONTENT

							<li>
								<a href='#elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_moderator_menu' id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_moderator' data-ipsMenu data-ipsMenu-appendTo='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderator_tools', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
								<ul id='elControls_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_moderator_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
									
CONTENT;

if ( $comment->canEdit() ):
$return .= <<<CONTENT

										
CONTENT;

if ( $comment->mapped('first') and $comment->item()->canEdit() ):
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

else:
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('edit'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('split'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $comment instanceof \IPS\Content\Hideable and $comment->canHide() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('hide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</ul>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->hidden() === 0 and $item->canComment() and $editorName ):
$return .= <<<CONTENT

							<li data-ipsQuote-editor='
CONTENT;
$return .= htmlspecialchars( $editorName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsQuote-target='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsJS_show'>
								<button class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_narrow cMultiQuote ipsHide' data-action='multiQuoteComment' data-ipsTooltip data-ipsQuote-multiQuote data-mqId='mq
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'multiquote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-plus'></i></button>
							</li>
							<li data-ipsQuote-editor='
CONTENT;
$return .= htmlspecialchars( $editorName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsQuote-target='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsJS_show'>
								<a href='#' data-action='quoteComment' data-ipsQuote-singleQuote>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'quote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( ( $comment->item()->isSolved() and $comment->item()->mapped('solved_comment_id') == $comment->pid ) AND $comment->item()->canSolve() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->csrf()->setQueryString( array( 'do' => 'unsolve', 'answer' => $comment->pid ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="unsolveComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unsolve_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->item()->canSolve() AND ! $comment->item()->isSolved() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->csrf()->setQueryString( array( 'do' => 'solve', 'answer' => $comment->pid ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="solveComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solve_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsHide' data-role='commentLoading'>
						<span class='ipsLoading ipsLoading_tiny ipsLoading_noAnim'></span>
					</li>
				</ul>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

if ( trim( $comment->author()->signature ) ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->signature( $comment->author() );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

	
CONTENT;

if ( $comment->ip_address and \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

		<div class='ipsHide ipsPadding ipsMenu ipsMenu_veryWide' id='
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ip_menu'>
			<h5 class='ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
			<input type='text' autofocus class='ipsField_fullWidth ipsMargin_vertical:half' value='
CONTENT;
$return .= htmlspecialchars( $comment->ip_address, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip=$comment->ip_address", null, "modcp_ip_tools", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_about_ip_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-right'></i></a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharemenu( $comment );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function postContainer( $item, $comment, $votes=array(), $otherClasses='' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$itemClassSafe = str_replace( '\\', '_', mb_substr( $comment::$itemClass, 4 ) );
$return .= <<<CONTENT


CONTENT;

if ( $comment->isIgnored() ):
$return .= <<<CONTENT

	<div class='ipsComment ipsComment_ignored ipsType_light' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreCommentID='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreUserID='
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu data-ipsMenu-menuID='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu-appendTo='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="ignoreOptions" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_post_ignore_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
		<ul class='ipsMenu ipsHide' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
			<li class='ipsMenu_item ipsJS_show' data-ipsMenuValue='showPost'><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_this_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_sep ipsJS_show'><hr></li>
			<li class='ipsMenu_item' data-ipsMenuValue='stopIgnoring'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$comment->author()->member_id}", null, "ignore", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_posts_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_item'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_ignore_preferences', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<a id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></a>
<article 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
data-memberGroup="
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_group_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

endif;
$return .= <<<CONTENT
 id='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cPost ipsBox ipsResponsive_pull 
CONTENT;

if ( $otherClasses ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $otherClasses, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment 
CONTENT;

if ( ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight ) OR $comment->isFeatured() ):
$return .= <<<CONTENT
ipsComment_popular
CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment_parent ipsClearfix ipsClear ipsColumns ipsColumns_noSpacing ipsColumns_collapsePhone 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
ipsComment_highlighted
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->isIgnored() ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->hidden() OR $item->hidden() === -2 ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( ( $comment->item()->isSolved() and $comment->item()->mapped('solved_comment_id') == $comment->pid ) ):
$return .= <<<CONTENT
ipsComment_solved
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $item->isQuestion() and !$comment->new_topic ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->postRating( $item, $comment, $votes );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $comment->author()->hasHighlightedReplies() || ( $comment->item()->isSolved() and $comment->item()->mapped('solved_comment_id') == $comment->pid ) || $comment->isFeatured() || ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight )  ):
$return .= <<<CONTENT

		<div class='ipsResponsive_showPhone ipsComment_badges'>
			<ul class='ipsList_reset ipsFlex ipsFlex-fw:wrap ipsGap:2 ipsGap_row:1'>
				
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT

					<li><strong class='ipsBadge ipsBadge_large ipsBadge_highlightedGroup'>
CONTENT;

$return .= \IPS\Member\Group::load( $comment->author()->member_group_id )->name;
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( ( $comment->item()->isSolved() and $comment->item()->mapped('solved_comment_id') == $comment->pid ) ):
$return .= <<<CONTENT

					<li><strong class='ipsBadge ipsBadge_large ipsBadge_positive ipsBadge_reverse'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_solved_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->isFeatured() ):
$return .= <<<CONTENT

					<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_featured_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight )  ):
$return .= <<<CONTENT

					<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	<div class='cAuthorPane_mobile ipsResponsive_showPhone'>
		<div class='cAuthorPane_photo'>
			<div class='cAuthorPane_photoWrap'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'large', $comment->warningRef() );
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->author()->modShowBadge() ):
$return .= <<<CONTENT

				<span class="cAuthorPane_badge cAuthorPane_badge--moderator" data-ipsTooltip title="
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_is_moderator', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"></span>
				
CONTENT;

elseif ( $comment->author()->joinedRecently() ):
$return .= <<<CONTENT

				<span class="cAuthorPane_badge cAuthorPane_badge--new" data-ipsTooltip title="
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_is_new_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( !$comment->isAnonymous() and $comment->author()->canHaveAchievements() and \IPS\core\Achievements\Rank::show() and $rank = $comment->author()->rank() ):
$return .= <<<CONTENT

					<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$comment->author()->member_id}&do=badges", null, "profile_badges", array( $comment->author()->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" rel="nofollow">
						{$rank->html( 'cAuthorPane_badge cAuthorPane_badge--rank ipsOutline ipsOutline:2px' )}
					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<div class='cAuthorPane_content'>
			<h3 class='ipsType_sectionHead cAuthorPane_author ipsType_break ipsType_blendLinks ipsFlex ipsFlex-ai:center'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $comment->author(), $comment->warningRef(), TRUE, $comment->isAnonymous() );
$return .= <<<CONTENT

			</h3>
			<div class='ipsType_light ipsType_reset'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="nofollow" class='ipsType_blendLinks'>{$comment->dateLine()}</a>
				
CONTENT;

if ( $comment->ip_address and \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

					&middot; <a class='ipsType_blendLinks ipsType_light ipsType_noUnderline ipsType_noBreak' href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip=$comment->ip_address", null, "modcp_ip_tools", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-menuID='
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ip_menu'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-down'></i></a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	</div>
	<aside class='ipsComment_author cAuthorPane ipsColumn ipsColumn_medium ipsResponsive_hidePhone'>
		<h3 class='ipsType_sectionHead cAuthorPane_author ipsType_blendLinks ipsType_break'><strong>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $comment->author(), $comment->warningRef(), FALSE, $comment->isAnonymous() );
$return .= <<<CONTENT
</strong>
			
CONTENT;

if ( $comment->isAnonymous() and \IPS\Member::loggedIn()->modPermission('can_view_anonymous_posters') ):
$return .= <<<CONTENT

				<a data-ipsHover data-ipsHover-width="370" data-ipsHover-onClick href="
CONTENT;

if ( $comment->isFirst() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->item()->url( 'reveal' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->url( 'reveal' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" rel="nofollow"><span class="cAuthorPane_badge cAuthorPane_badge--anon" data-ipsTooltip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_anonymously_reveal', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"></span></a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</h3>
		<ul class='cAuthorPane_info ipsList_reset'>
			<li data-role='photo' class='cAuthorPane_photo'>
				<div class='cAuthorPane_photoWrap'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'large', $comment->warningRef() );
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->author()->modShowBadge() ):
$return .= <<<CONTENT

						<span class="cAuthorPane_badge cAuthorPane_badge--moderator" data-ipsTooltip title="
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_is_moderator', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"></span>
					
CONTENT;

elseif ( $comment->author()->joinedRecently() ):
$return .= <<<CONTENT

						<span class="cAuthorPane_badge cAuthorPane_badge--new" data-ipsTooltip title="
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_is_new_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( !$comment->isAnonymous() and $comment->author()->canHaveAchievements() and \IPS\core\Achievements\Rank::show() and $rank = $comment->author()->rank() ):
$return .= <<<CONTENT

						{$rank->html( 'cAuthorPane_badge cAuthorPane_badge--rank ipsOutline ipsOutline:2px' )}
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</li>
			
CONTENT;

if ( !$comment->isAnonymous() ):
$return .= <<<CONTENT

				<li data-role='group'>
CONTENT;

$return .= \IPS\Member\Group::load( $comment->author()->member_group_id )->formattedName;
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( \IPS\Member\Group::load( $comment->author()->member_group_id )->g_icon  ):
$return .= <<<CONTENT

					<li data-role='group-icon'><img src='
CONTENT;

$return .= \IPS\File::get( "core_Theme", $comment->author()->group['g_icon'] )->url;
$return .= <<<CONTENT
' alt='' class='cAuthorGroupIcon'></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $comment->author()->member_id ):
$return .= <<<CONTENT

				<li data-role='stats' class='ipsMargin_top'>
					<ul class="ipsList_reset ipsType_light ipsFlex ipsFlex-ai:center ipsFlex-jc:center ipsGap_row:2 cAuthorPane_stats">
						<li>
							
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) )  ):
$return .= <<<CONTENT

								<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$comment->author()->member_id}&do=content", null, "profile_content", array( $comment->author()->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" rel="nofollow" title="
CONTENT;

$pluralize = array( $comment->author()->member_posts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_post_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsType_blendLinks">
							
CONTENT;

endif;
$return .= <<<CONTENT

								<i class="fa fa-comment"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $comment->author()->member_posts );
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) )  ):
$return .= <<<CONTENT

								</a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</li>
						
CONTENT;

if ( isset( $comment->author_solved_count ) ):
$return .= <<<CONTENT

							<li>
								
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) )  ):
$return .= <<<CONTENT

									<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$comment->author()->member_id}&do=solutions", null, "profile_solutions", array( $comment->author()->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' rel="nofollow" title="
CONTENT;

$pluralize = array( $comment->author_solved_count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solved_badge_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsType_blendLinks'>
								
CONTENT;

endif;
$return .= <<<CONTENT
		
									   <i class='fa fa-check-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $comment->author_solved_count );
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) )  ):
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
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $comment->author()->member_id ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->customFieldsDisplay( $comment->author() );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</aside>
	<div class='ipsColumn ipsColumn_fluid ipsMargin:none'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->post( $item, $comment, $item::$formLangPrefix . 'comment', $item::$application, $item::$module, $itemClassSafe );
$return .= <<<CONTENT

	</div>
</article>
CONTENT;

		return $return;
}

	function postRating( $item, $comment, $votes=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT

<div class='cRatingColumn ipsClearfix 
CONTENT;

if ( $comment->post_bwoptions['best_answer'] ):
$return .= <<<CONTENT
cRatingColumn_on
CONTENT;

else:
$return .= <<<CONTENT
ipsAreaBackground_light
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
cRatingColumn_up
CONTENT;

elseif ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
cRatingColumn_down
CONTENT;

endif;
$return .= <<<CONTENT
 ipsColumn ipsColumn_narrow ipsType_center' data-controller='forums.front.topic.answers'>
	
	<ul class='ipsList_reset cPostRating_controls'>
	
CONTENT;

if ( !$item->isArchived()  ):
$return .= <<<CONTENT

		
CONTENT;

if ( $comment->post_bwoptions['best_answer'] or $item->canSetBestAnswer() ):
$return .= <<<CONTENT

			<li class='cPostRating_bestAnswer'>
				
CONTENT;

if ( $item->canSetBestAnswer() and !$comment->post_bwoptions['best_answer'] ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->csrf()->setQueryString( array( 'do' => 'bestAnswer', 'answer' => $comment->pid ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'set_as_best_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator cBestAnswerIndicator_off' data-ipsTooltip><i class='fa fa-check'></i></a>
				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $item->canSetBestAnswer() ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->csrf()->setQueryString( array( 'do' => 'unsetBestAnswer', 'answer' => $comment->pid ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unset_as_best_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator' data-ipsTooltip><i class='fa fa-check'></i></a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<strong class='cBestAnswerIndicator' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'best_answer_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
		
CONTENT;

if ( $comment->canVote() ):
$return .= <<<CONTENT

			<li class='cPostRating_up'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( array( 'do' => 'rateAnswer', 'answer' => $comment->pid, 'rating' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cAnswerRate cAnswerRate_up 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_your_vote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_answer_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-angle-up'></i></a>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li class='cPostRating_up'>
				<span class='cAnswerRate cAnswerRate_up cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-angle-up'></i></span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT


			<li class='cPostRating_count'>
				<span title="
CONTENT;

$pluralize = array( $comment->post_field_int ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
" data-role="voteCount" data-voteCount="
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='cAnswerRating 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

elseif ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</li>

		
CONTENT;

if ( $comment->canVote() && \IPS\Settings::i()->forums_answers_downvote ):
$return .= <<<CONTENT

			<li  class='cPostRating_down'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( array( 'do' => 'rateAnswer', 'answer' => $comment->pid, 'rating' => -1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cAnswerRate cAnswerRate_down 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_your_vote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_answer_down', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-angle-down'></i></a>
			</li>
		
CONTENT;

elseif ( \IPS\Settings::i()->forums_answers_downvote ):
$return .= <<<CONTENT

			<li  class='cPostRating_down'>
				<span class='cAnswerRate cAnswerRate_down cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-angle-down'></i></span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( isset($comment->post_field_int)  ):
$return .= <<<CONTENT

			<li class='cPostRating_count'>
				<span title="
CONTENT;

$pluralize = array( $comment->post_field_int ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
" data-role="voteCount" data-voteCount="
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='cAnswerRating 
CONTENT;

if ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

elseif ( isset( $votes[ $comment->$idField ] ) && $votes[ $comment->$idField ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $comment->post_field_int, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

</div>
CONTENT;

		return $return;
}

	function topic( $topic, $comments, $question=NULL, $votes=array(), $nextUnread=NULL, $pagination=NULL, $topicVotes=array() ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $club = $topic->container()->club() ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->clubs and \IPS\Settings::i()->clubs_header == 'full' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "clubs", "core" )->header( $club, $topic->container() );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<div id='elClubContainer'>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsPageHeader ipsResponsive_pull ipsBox ipsPadding sm:ipsPadding:half ipsMargin_bottom'>
	
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

		<div class='ipsFlex ipsFlex-ai:stretch ipsFlex-jc:center'>
			<ul class='ipsList_reset cRatingColumn cRatingColumn_question ipsType_center ipsMargin_right ipsFlex-flex:00 ipsBorder_right'>
				
CONTENT;

if ( $topic->canVote() ):
$return .= <<<CONTENT

					<li>
						<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'rateQuestion', 'rating' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cAnswerRate cAnswerRate_up 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_your_vote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_question_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-angle-up'></i></a>
					</li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li>
						<span class='cAnswerRate cAnswerRate_up cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-angle-up'></i></span>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT


					<li><span data-role="voteCount" data-voteCount="
CONTENT;

$return .= htmlspecialchars( \intval( $topic->question_rating ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='cAnswerRating 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === 1 ):
$return .= <<<CONTENT
ipsType_positive
CONTENT;

elseif ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \intval( $topic->question_rating ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></li>

				
CONTENT;

if ( $topic->canVote() && \IPS\Settings::i()->forums_questions_downvote ):
$return .= <<<CONTENT

					<li>
						<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'rateQuestion', 'rating' => -1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cAnswerRate cAnswerRate_down 
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === -1 ):
$return .= <<<CONTENT
ipsType_negative
CONTENT;

endif;
$return .= <<<CONTENT
' title='
CONTENT;

if ( isset( $topicVotes[ \IPS\Member::loggedIn()->member_id ] ) && $topicVotes[ \IPS\Member::loggedIn()->member_id ] === -1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_your_vote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'vote_question_down', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-angle-down'></i></a>
					</li>
				
CONTENT;

elseif ( \IPS\Settings::i()->forums_questions_downvote ):
$return .= <<<CONTENT

					<li>
						<span class='cAnswerRate cAnswerRate_down cAnswerRate_noPermission' 
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_rate_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
><i class='fa fa-angle-down'></i></span>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
			<div class='ipsFlex-flex:11'>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsFlex ipsFlex-ai:center ipsFlex-fw:wrap ipsGap:4'>
		<div class='ipsFlex-flex:11'>
			<h1 class='ipsType_pageTitle ipsContained_container'>
				
CONTENT;

if ( $topic->mapped('pinned') || $topic->mapped('featured') || $topic->hidden() === -1 || $topic->hidden() === 1 || $topic->hidden() === -2 || $topic->isSolved() || ( $topic->canToggleItemModeration() and $topic->itemModerationEnabled() ) ):
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->hidden() === -1 ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $topic->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
					
CONTENT;

elseif ( $topic->hidden() === -2 ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $topic->deletedBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-trash'></i></span></span>
					
CONTENT;

elseif ( $topic->hidden() === 1 ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span></span>
					
CONTENT;

elseif ( $topic->canToggleItemModeration() and $topic->itemModerationEnabled() ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moderation_enabled', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-user-times'></i></span></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->mapped('pinned') ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->mapped('featured') ):
$return .= <<<CONTENT

						<span><span class="ipsBadge ipsBadge_icon ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span></span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

if ( $topic->prefix() OR ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) AND $topic::canPrefix( NULL, $topic->container() ) ) ):
$return .= <<<CONTENT

					<span 
CONTENT;

if ( !$topic->prefix() ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) AND $topic::canPrefix( NULL, $topic->container() ) ) ):
$return .= <<<CONTENT
data-editablePrefix
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $topic->prefix( TRUE ), $topic->prefix() );
$return .= <<<CONTENT

					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->canEdit() ):
$return .= <<<CONTENT

					<span class='ipsType_break ipsContained' data-controller="core.front.core.moderation">
						<span data-role="editableTitle" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $topic->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					</span>
				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='ipsType_break ipsContained'>
						<span>
CONTENT;
$return .= htmlspecialchars( $topic->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</h1>
			
CONTENT;

if ( $topic->locked() && $topic->topic_open_time && $topic->topic_open_time > time() ):
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_medium'><strong><i class='fa fa-clock-o'></i> 
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $topic->topic_open_time )->html(), \IPS\DateTime::ts( $topic->topic_open_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_unlocks_at', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong></p>
			
CONTENT;

elseif ( !$topic->locked() && $topic->topic_close_time && $topic->topic_close_time > time() ):
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_medium'><strong><i class='fa fa-clock-o'></i> 
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $topic->topic_close_time )->html(), \IPS\DateTime::ts( $topic->topic_close_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locks_at', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong></p>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \count( $topic->tags() ) OR ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) ) ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $topic->tags(), FALSE, FALSE, ( $topic->canEdit() AND $topic::canTag( NULL, $topic->container() ) ) ? $topic->url() : NULL );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		
CONTENT;

if ( $topic->container()->forum_allow_rating ):
$return .= <<<CONTENT

			<div class='ipsFlex-flex:00 ipsType_light'>
				
CONTENT;

if ( $topic->canRate() ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_small'>
						
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rate_this_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rate_this_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				{$topic->rating()}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<hr class='ipsHr'>
	<div class='ipsPageHeader__meta ipsFlex ipsFlex-jc:between ipsFlex-ai:center ipsFlex-fw:wrap ipsGap:3'>
		<div class='ipsFlex-flex:11'>
			<div class='ipsPhotoPanel ipsPhotoPanel_mini ipsPhotoPanel_notPhone ipsClearfix'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $topic->author(), 'mini', $topic->warningRef() );
$return .= <<<CONTENT

				<div>
					<p class='ipsType_reset ipsType_blendLinks'>
						<span class='ipsType_normal'>
						
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

							<strong>
CONTENT;

$htmlsprintf = array($topic->author()->link( $topic->warningRef(), NULL, $topic->isAnonymous() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline_no_date', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
,</strong><br />
							<span class='ipsType_light'>
CONTENT;

$val = ( $topic->start_date instanceof \IPS\DateTime ) ? $topic->start_date : \IPS\DateTime::ts( $topic->start_date );$return .= $val->html();
$return .= <<<CONTENT
</span>
						
CONTENT;

else:
$return .= <<<CONTENT

							<strong>
CONTENT;

$htmlsprintf = array($topic->author()->link( $topic->warningRef(), NULL, $topic->isAnonymous() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_itemprop', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong><br />
							<span class='ipsType_light'>
CONTENT;

$val = ( $topic->start_date instanceof \IPS\DateTime ) ? $topic->start_date : \IPS\DateTime::ts( $topic->start_date );$return .= $val->html();
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">{$topic->container()->_formattedTitle}</a></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						</span>
					</p>
				</div>
			</div>
		</div>
		
CONTENT;

if ( !$topic->isArchived() and !$topic->container()->password ):
$return .= <<<CONTENT

			<div class='ipsFlex-flex:01 ipsResponsive_hidePhone'>
				<div class='ipsFlex ipsFlex-ai:center ipsFlex-jc:center ipsGap:3 ipsGap_row:0'>
					
CONTENT;

if ( !$topic->container()->disable_sharelinks ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "sharelinks", "core" )->shareButton( $topic );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->promote( $topic );
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums', 'topic', $topic->tid, $topic->followersCount() );
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT
			
	</div>
	
CONTENT;

if ( $topic->isSolved() ):
$return .= <<<CONTENT

		
CONTENT;

if ( $solvedComment = $topic->getSolution() AND ( $solvedComment->hidden() == 0 OR ( \in_array( $solvedComment->hidden(), array( 1, -1 ) ) AND $solvedComment->canUnhide() ) ) ):
$return .= <<<CONTENT

			<div class='ipsBox ipsBox--child ipsComment ipsComment_solved ipsMargin:none ipsMargin_top ipsPadding:half'>
				<div class='ipsFlex ipsFlex-ai:center sm:ipsFlex-fd:column ipsGap:3'>
					<a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $topic->topic_answered_pid )), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class='ipsButton ipsButton_verySmall ipsButton_positive sm:ipsFlex-as:stretch'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solved_and_go', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					<span class='ipsFlex-flex:10 ipsType_positive ipsType_normal'>
						
CONTENT;

$htmlsprintf = array($solvedComment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solved_byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
, 
CONTENT;

$val = ( $solvedComment->mapped('date') instanceof \IPS\DateTime ) ? $solvedComment->mapped('date') : \IPS\DateTime::ts( $solvedComment->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

					</span>
				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->contentItemMessages( $topic->getMessages(), $topic );
$return .= <<<CONTENT



CONTENT;

if ( $topic->hidden() === 1 and $topic->canUnhide() ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_warning ipsSpacer_top">
		<p class="ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_pending_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<ul class='ipsList_inline ipsSpacer_top'>
			<li><a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_positive ipsButton_verySmall" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve_title_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

if ( $topic->canDelete() ):
$return .= <<<CONTENT

				<li><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_delete_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_negative ipsButton_verySmall'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsClearfix'>
	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_both 
CONTENT;

if ( !$topic->canComment() and !( $topic->canPin() or $topic->canUnpin() or $topic->canFeature() or $topic->canUnfeature() or $topic->canHide() or $topic->canUnhide() or $topic->canMove() or $topic->canLock() or $topic->canUnlock() or $topic->canDelete() or $topic->availableSavedActions() ) ):
$return .= <<<CONTENT
ipsResponsive_hidePhone
CONTENT;

endif;
$return .= <<<CONTENT
">
		
CONTENT;

if ( $topic->canComment() ):
$return .= <<<CONTENT

			<li class='ipsToolList_primaryAction'>
				<span data-controller='forums.front.topic.reply'>
					
CONTENT;

if ( $topic->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

						<a href='#replyForm' rel="nofollow" class='ipsButton 
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
ipsButton_link ipsButton_link--negative
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_important
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton_medium ipsButton_fullWidth' data-action='replyToTopic'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answer_this_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
 (
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'locked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
CONTENT;

endif;
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href='#replyForm' rel="nofollow" class='ipsButton 
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
ipsButton_link ipsButton_link--negative
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_important
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton_medium ipsButton_fullWidth' data-action='replyToTopic'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reply_to_this_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT
 (
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'locked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
CONTENT;

endif;
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</span>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $topic->container()->can('add') ):
$return .= <<<CONTENT

			<li class='ipsResponsive_hidePhone'>
				
CONTENT;

if ( $topic->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( ( $topic->canPin() or $topic->canUnpin() or $topic->canFeature() or $topic->canUnfeature() or $topic->canHide() or $topic->canUnhide() or $topic->canMove() or $topic->canLock() or $topic->canUnlock() or $topic->canDelete() or $topic->availableSavedActions() or $topic->canMerge() or $topic->canUnarchive() or $topic->canRemoveArchiveExcludeFlag() or \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') or $topic->canToggleItemModeration() ) or ( $topic->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ) ):
$return .= <<<CONTENT

			<li>
				<a href='#elTopicActions_menu' id='elTopicActions' class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderator_actions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<ul id='elTopicActions_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') AND $topic->hidden() == -2 ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'restore' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'restoreAsHidden' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete', 'immediate' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canFeature() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canUnfeature() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canPin() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'pin' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canUnpin() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unpin' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canHide() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canUnhide() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

if ( $topic->hidden() === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canLock() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'lock' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canUnlock() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unlock' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canMove() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canMerge() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'merge' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canUnarchive() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'unarchive' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;
$return .= htmlspecialchars( $topic->unarchiveBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unarchive', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

                        
CONTENT;

if ( $topic->canRemoveArchiveExcludeFlag() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'removeArchiveExclude' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_archive_exlude', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canDelete() ):
$return .= <<<CONTENT
				
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canOnMessage( 'add' ) ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'messageForm' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $topic->canToggleItemModeration() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'toggleItemModeration' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmMessage='
CONTENT;

if ( $topic->itemModerationEnabled() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disable_topic_moderation_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable_topic_moderation_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $topic->itemModerationEnabled() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disable_topic_moderation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable_topic_moderation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( !$topic->isArchived() and $topic->availableSavedActions() ):
$return .= <<<CONTENT

							<li class='ipsMenu_sep'><hr></li>
							
CONTENT;

foreach ( $topic->availableSavedActions() as $action ):
$return .= <<<CONTENT

								<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'savedAction', 'action' => $action->_id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm>
CONTENT;
$return .= htmlspecialchars( $action->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') ):
$return .= <<<CONTENT

						<li class='ipsMenu_sep'><hr></li>
						<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'modLog' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>
</div>

CONTENT;

if ( $poll = $topic->getPoll() ):
$return .= <<<CONTENT

<div class='ipsBox ipsResponsive_pull'>
{$poll}
</div>
<br>

CONTENT;

endif;
$return .= <<<CONTENT

<div id='comments' data-controller='core.front.core.commentFeed,forums.front.topic.view, core.front.core.ignoredComments' 
CONTENT;

if ( \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
data-autoPoll
CONTENT;

endif;
$return .= <<<CONTENT
 data-baseURL='
CONTENT;
$return .= htmlspecialchars( $topic->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $topic->isLastPage() ):
$return .= <<<CONTENT
data-lastPage
CONTENT;

endif;
$return .= <<<CONTENT
 data-feedID='topic-
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cTopic ipsClear ipsSpacer_top'>
	
CONTENT;

if ( $topic->isQuestion() && $question ):
$return .= <<<CONTENT

		<div class='ipsBox ipsResponsive_pull'>
			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->postContainer( $topic, $question, $votes, 'cPostQuestion ipsBox--child sm:ipsPadding_horizontal:half' );
$return .= <<<CONTENT

		</div>
		
		
CONTENT;

if ( ( $topic->showSummaryOnDesktop() === 'post' OR $topic->showSummaryOnMobile() ) ):
$return .= <<<CONTENT

			<div class="ipsSpacer_top">
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->activity( $topic, 'post' );
$return .= <<<CONTENT
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

					
		<div class='ipsSpacer_both'>
			<div class="ipsBox ipsResponsive_pull ipsMargin_bottom">
				<h2 class='ipsType_sectionTitle ipsType_reset ipsHide'>
CONTENT;

$pluralize = array( ( $topic->posts ) ? $topic->posts - 1 : 0 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answer_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
				<div class="ipsPadding:half ipsClearfix">
					<ul class="ipsPos_right ipsButtonRow ipsClearfix sm:ipsMargin_bottom:half">
						
CONTENT;

if ( ( \count( $topic->commentMultimodActions() ) && ( $topic->posts > 1 OR $topic->mapped('unapproved_comments') > 0 OR $topic->mapped('hidden_comments') > 0 ) ) || $pagination ):
$return .= <<<CONTENT

						<li>
							<a class="ipsJS_show" href="#elCheck_menu" id="elCheck" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="#elPostFeed" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
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
								<li class="ipsMenu_sep"><hr></li>
								<li class="ipsMenu_item" data-ipsMenuValue="hidden"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								<li class="ipsMenu_item" data-ipsMenuValue="unhidden"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								<li class="ipsMenu_item" data-ipsMenuValue="unapproved"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unapproved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							</ul>
						</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<li>
							<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id="elSortBy_answers" 
CONTENT;

if ( !isset( \IPS\Request::i()->sortby ) ):
$return .= <<<CONTENT
class='ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by_answers', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						<li>
							<a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( 'sortby', 'date' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id="elSortBy_date" 
CONTENT;

if ( isset( \IPS\Request::i()->sortby ) and \IPS\Request::i()->sortby == 'date' ):
$return .= <<<CONTENT
class='ipsButtonRow_active'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by_date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					</ul>
					
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

						{$pagination}
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

if ( ( \count( $topic->commentMultimodActions() ) && ( $topic->posts > 1 OR $topic->mapped('unapproved_comments') > 0 OR $topic->mapped('hidden_comments') > 0 ) ) || $pagination ):
$return .= <<<CONTENT


				<div class="ipsBox ipsResponsive_pull ipsPadding:half ipsClearfix ipsClear ipsMargin_bottom">
					
CONTENT;

if ( \count( $topic->commentMultimodActions() ) ):
$return .= <<<CONTENT

						<ul class="ipsButtonRow ipsPos_right ipsClearfix sm:ipsMargin_bottom:half">
							<li>
								<a class="ipsJS_show" href="#elCheck_menu" id="elCheck" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="#elPostFeed" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
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
									<li class="ipsMenu_sep"><hr></li>
									<li class="ipsMenu_item" data-ipsMenuValue="hidden"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									<li class="ipsMenu_item" data-ipsMenuValue="unhidden"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									<li class="ipsMenu_item" data-ipsMenuValue="unapproved"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unapproved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								</ul>
							</li>
						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

						{$pagination}
					
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

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->featuredComments( $topic->featuredComments(), $topic->url()->setQueryString( 'recommended', 'comments' ), 'recommended_posts', 'post_lc' );
$return .= <<<CONTENT

	
	<div id="elPostFeed" data-role='commentFeed' data-controller='core.front.core.moderation' 
CONTENT;

if ( $topic->isQuestion() AND $topic->topic_answered_pid ):
$return .= <<<CONTENT
 data-topicAnswerID="
CONTENT;
$return .= htmlspecialchars( $topic->topic_answered_pid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		<form action="
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( 'do', 'multimodComment' )->setPage('page', \IPS\Request::i()->page ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-ipsPageAction data-role='moderationTools'>
			
CONTENT;

$postCount=0; $timeLastRead = $topic->timeLastRead(); $lined = FALSE;
$return .= <<<CONTENT

			
CONTENT;

if ( \count( $comments ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $topic->generateCommentMetaData( $comments, \IPS\Settings::i()->forums_mod_actions_anon ) as $comment ):
$return .= <<<CONTENT


					
CONTENT;

if ( (!$topic->isQuestion() and !$lined and $timeLastRead and $timeLastRead->getTimestamp() < $comment->mapped('date')) ):
$return .= <<<CONTENT

						
CONTENT;

if ( $lined = TRUE and $postCount ):
$return .= <<<CONTENT

							<div class='ipsUnreadBar'>
								<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_meta_unread', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

$postCount++;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->postContainer( $topic, $comment, $votes, ( $topic->isQuestion() ) ? 'cPostQuestion' : '' );
$return .= <<<CONTENT

					
CONTENT;

if ( !$topic->isQuestion() and ( isset( $comment->metaData['comment']['moderation'] ) OR isset( $comment->metaData['comment']['timeGap'] ) ) ):
$return .= <<<CONTENT

						<ul class='ipsTopicMeta'>
							
CONTENT;

if ( isset( $comment->metaData['comment']['moderation'] ) ):
$return .= <<<CONTENT

								
CONTENT;

foreach ( $comment->metaData['comment']['moderation'] as $modAction ):
$return .= <<<CONTENT

									<li class="ipsTopicMeta__item ipsTopicMeta__item--moderation">
										<span class='ipsTopicMeta__time ipsType_light'>
CONTENT;

$val = ( $modAction['row']['ctime'] instanceof \IPS\DateTime ) ? $modAction['row']['ctime'] : \IPS\DateTime::ts( $modAction['row']['ctime'] );$return .= $val->html(TRUE, TRUE);
$return .= <<<CONTENT
</span>
										<span class='ipsTopicMeta__action'>
CONTENT;
$return .= htmlspecialchars( $modAction['blurb'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
									</li>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $comment->metaData['comment']['timeGap'] ) ):
$return .= <<<CONTENT

								<li class="ipsTopicMeta__item ipsTopicMeta__item--time">
									
CONTENT;
$return .= htmlspecialchars( $comment->metaData['comment']['timeGap']['blurb'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
...
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $postCount == 1 AND $advertisement = \IPS\core\Advertisement::loadByLocation( 'ad_topic_view' ) ):
$return .= <<<CONTENT

						{$advertisement}
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( ( ( ! $topic->isQuestion() and $postCount == 1 ) and ( $topic->showSummaryOnDesktop() === 'post' OR $topic->showSummaryOnMobile() ) ) ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "topics", "forums" )->activity( $topic, 'post' );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

					<p class='ipsType_center ipsType_light ipsType_large ipsPad' data-role="noComments">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_answers', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentMultimod( $topic );
$return .= <<<CONTENT

		</form>
	</div>

	
CONTENT;

if ( $pagination ):
$return .= <<<CONTENT

		<div class='ipsBox ipsPadding:half ipsMargin_top ipsClearfix ipsClear'>
			{$pagination}
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	
CONTENT;

if ( $topic->isArchived() ):
$return .= <<<CONTENT

		<div class='ipsMessage ipsMessage_general ipsSpacer_top'>
			<h4 class='ipsMessage_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_is_archived', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
			<p class='ipsType_reset'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_archived_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</p>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	
CONTENT;

if ( $topic->commentForm() || $topic->locked() || \IPS\Member::loggedIn()->restrict_post || \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] || !\IPS\Member::loggedIn()->checkPostsPerDay() ):
$return .= <<<CONTENT

		<a id='replyForm'></a>
		<div data-role='replyArea' class='cTopicPostArea ipsBox ipsResponsive_pull ipsPadding 
CONTENT;

if ( !$topic->canComment() ):
$return .= <<<CONTENT
cTopicPostArea_noSize
CONTENT;

endif;
$return .= <<<CONTENT
 ipsSpacer_top'>
			
CONTENT;

if ( $topic->commentForm() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_warning ipsComposeArea_warning ipsSpacer_bottom ipsSpacer_half'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked_can_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

elseif ( ( $topic->getPoll() and $topic->getPoll()->poll_only ) ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_warning ipsComposeArea_warning ipsSpacer_bottom ipsSpacer_half'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_poll_can_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				{$topic->commentForm()}
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

if ( $topic->locked() ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'topic_locked_cannot_comment' );
$return .= <<<CONTENT

				
CONTENT;

elseif ( \IPS\Member::loggedIn()->restrict_post ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'restricted_cannot_comment', \IPS\Member::loggedIn()->warnings(5,NULL,'rpa'), \IPS\Member::loggedIn()->restrict_post );
$return .= <<<CONTENT

				
CONTENT;

elseif ( \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'unacknowledged_warning_cannot_post', \IPS\Member::loggedIn()->warnings( 1, FALSE ) );
$return .= <<<CONTENT

				
CONTENT;

elseif ( !\IPS\Member::loggedIn()->checkPostsPerDay() ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'front' )->commentUnavailable( 'member_exceeded_posts_per_day' );
$return .= <<<CONTENT

				
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

if ( !$topic->isArchived() and !$topic->container()->password ):
$return .= <<<CONTENT

		<div class='ipsBox ipsPadding ipsResponsive_pull ipsResponsive_showPhone ipsMargin_top'>
			
CONTENT;

if ( !$topic->container()->disable_sharelinks ):
$return .= <<<CONTENT

				<div class='ipsResponsive_noFloat ipsResponsive_block ipsMargin_bottom:half'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "sharelinks", "core" )->shareButton( $topic, 'verySmall', 'light' );
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsResponsive_noFloat ipsResponsive_block'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums', 'topic', $topic->tid, $topic->followersCount() );
$return .= <<<CONTENT

			</div>
			
CONTENT;

if ( $topic->canPromoteToSocialMedia() and ( $topic instanceof \IPS\Content or $topic instanceof \IPS\Node\Model ) ):
$return .= <<<CONTENT

				<div class='ipsResponsive_noFloat ipsResponsive_block ipsMargin_top:half'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->promote( $topic );
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

if ( ( $topic->canPin() or $topic->canUnpin() or $topic->canFeature() or $topic->canUnfeature() or $topic->canHide() or $topic->canUnhide() or $topic->canMove() or $topic->canLock() or $topic->canUnlock() or $topic->canDelete() or $topic->availableSavedActions() or $topic->canMerge() or $topic->canUnarchive() or $topic->canRemoveArchiveExcludeFlag() or \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') or $topic->canToggleItemModeration() ) or ( $topic->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ) ):
$return .= <<<CONTENT

	<ul class="ipsToolList ipsToolList_horizontal ipsClearfix ipsSpacer_top ipsResponsive_hidePhone">
		<li>
			<a href='#elTopicActionsBottom_menu' id='elTopicActionsBottom' class='ipsButton ipsButton_link ipsButton_link--light ipsButton_medium ipsButton_fullWidth' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderator_actions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<ul id='elTopicActionsBottom_menu' class='ipsMenu ipsMenu_auto ipsHide'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') AND $topic->hidden() == -2 ):
$return .= <<<CONTENT

					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'restore' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'restoreAsHidden' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete', 'immediate' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canFeature() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'feature' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnfeature() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unfeature' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canPin() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'pin' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnpin() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unpin' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canHide() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'hide' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnhide() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unhide' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

if ( $topic->hidden() === 1 ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canLock() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'lock' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnlock() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'unlock' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canMove() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'move' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canMerge() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'merge' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canUnarchive() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'unarchive' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage="
CONTENT;
$return .= htmlspecialchars( $topic->unarchiveBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unarchive', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canRemoveArchiveExcludeFlag() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'removeArchiveExclude' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_archive_exlude', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canDelete() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'moderate', 'action' => 'delete' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  >
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canOnMessage( 'add' ) ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'messageForm' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $topic->canToggleItemModeration() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'toggleItemModeration' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmMessage='
CONTENT;

if ( $topic->itemModerationEnabled() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disable_topic_moderation_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable_topic_moderation_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $topic->itemModerationEnabled() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disable_topic_moderation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable_topic_moderation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( !$topic->isArchived() and $topic->availableSavedActions() ):
$return .= <<<CONTENT

						<li class='ipsMenu_sep'><hr></li>
						
CONTENT;

foreach ( $topic->availableSavedActions() as $action ):
$return .= <<<CONTENT

							<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->csrf()->setQueryString( array( 'do' => 'savedAction', 'action' => $action->_id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm>
CONTENT;
$return .= htmlspecialchars( $action->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_view_moderation_log') ):
$return .= <<<CONTENT

						<li class='ipsMenu_sep'><hr></li>
						<li class="ipsMenu_item"><a href='
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'modLog' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderation_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</li>
	</ul>

CONTENT;

endif;
$return .= <<<CONTENT


<div class='ipsPager ipsSpacer_top'>
	<div class="ipsPager_prev">
		
CONTENT;

if ( \IPS\forums\Forum::isSimpleView( $topic->container() ) ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=forums&module=forums&controller=index", null, "forums", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

if ( $topic->isQuestion()  ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_qa_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" rel="parent">
				<span class="ipsPager_type">
CONTENT;

if ( $topic->isQuestion()  ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_qa_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
			</a>
		
CONTENT;

else:
$return .= <<<CONTENT

			<a href="
CONTENT;
$return .= htmlspecialchars( $topic->container()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($topic->container()->metaTitle()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" rel="parent">
				<span class="ipsPager_type">
CONTENT;

if ( $topic->isQuestion()  ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_qa_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_back_to_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
			</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $nextUnread !== NULL ):
$return .= <<<CONTENT

		<div class='ipsPager_next'>
			<a href="
CONTENT;
$return .= htmlspecialchars( $topic->url()->setQueryString( array( 'do' => 'nextUnread' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread_question_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
				<span class="ipsPager_type">
CONTENT;

if ( $topic->isQuestion() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_next_unread', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
			</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>


CONTENT;

if ( $topic->container()->club() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}