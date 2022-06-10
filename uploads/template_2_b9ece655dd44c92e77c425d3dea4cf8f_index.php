<?php
namespace IPS\Theme\Cache;
class class_forums_front_index extends \IPS\Theme\Template
{
	public $cache_key = 'f0647fb673eb56bc8c9810b263bd290e';
	function forumGridItem( $forum ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $forum->can('view') ):
$return .= <<<CONTENT


CONTENT;

$lastPost = $forum->lastPost();
$return .= <<<CONTENT


CONTENT;

$club = $forum->club();
$return .= <<<CONTENT

	<div class="ipsDataItem ipsGrid_span4 ipsAreaBackground_reset cForumGrid 
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
cForumGrid_unread ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix" data-forumID="
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

		<div class='ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix ipsPad cForumGrid_forumInfo'>
			<span class='ipsPos_left'>
				
CONTENT;

if ( !$forum->redirect_on AND \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'markRead' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action='markAsRead'>
				
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $club ):
$return .= <<<CONTENT

						<img src="
CONTENT;

if ( $club->profile_photo ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( "core_Clubs", $club->profile_photo )->url;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->resource( "default_club.png", "core", 'global', false );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" alt='' class='ipsItemStatus ipsItemStatus_large 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

elseif ( $forum->icon ):
$return .= <<<CONTENT

						<img src="
CONTENT;

$return .= \IPS\File::get( "forums_Icons", $forum->icon )->url;
$return .= <<<CONTENT
" alt='' class='ipsItemStatus ipsItemStatus_custom 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( $forum->redirect_on ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_redirect 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
								<i class='fa fa-arrow-right'></i>
							</span>
						
CONTENT;

elseif ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_answers 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
								<i class='fa fa-question'></i>
							</span>
						
CONTENT;

elseif ( $forum->password ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_password 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
								
CONTENT;

if ( $forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

									<i class='fa fa-unlock'></i>
								
CONTENT;

else:
$return .= <<<CONTENT

									<i class='fa fa-lock'></i>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</span>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_large cForumIcon_normal 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
								<i class="fa fa-comments"></i>
							</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( !$forum->redirect_on AND \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</span>
			<div>
				<h3 class='ipsType_reset ipsType_sectionHead ipsTruncate ipsTruncate_line cForumGrid_title'>
					
CONTENT;

if ( $forum->password && !$forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'passForm', '1' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$sprintf = array($forum->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forum_requires_password', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

if ( $club ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($club->name, $forum->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_node', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</h3>
				
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

					
CONTENT;

$count = \IPS\forums\Topic::contentCount( $forum, TRUE );
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_light'>
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'posts_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\forums\Topic::modPermission( 'unhide', NULL, $forum ) AND ( $forum->queued_topics OR $forum->queued_posts ) ):
$return .= <<<CONTENT

					<strong class='ipsType_warning ipsType_medium'>
						<i class='fa fa-warning'></i>
						
CONTENT;

if ( $forum->queued_topics ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_topics' ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $forum->queued_topics ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_topics_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $forum->queued_topics, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						/
						
CONTENT;

if ( $forum->queued_posts ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_posts' ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $forum->queued_posts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_posts_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $forum->queued_posts, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</strong>					
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		
		<div class='ipsPad'>
			
CONTENT;

if ( $forum->description ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( $forum->description, array('ipsType_medium') );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT


			
CONTENT;

if ( $forum->hasChildren() ):
$return .= <<<CONTENT

				<h4 class='ipsType_minorHeading ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subforums', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<ul class="ipsList_inline">
					
CONTENT;

foreach ( $forum->children() as $subforum ):
$return .= <<<CONTENT

					<li class="
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $subforum ) ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
						<a href="
CONTENT;
$return .= htmlspecialchars( $subforum->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $subforum ) ):
$return .= <<<CONTENT

								<span class='ipsItemStatus ipsItemStatus_tiny 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $subforum ) && !$subforum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
									<i class="fa fa-circle"></i>
								</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $subforum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						</a>
					</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>

		<div class='cForumGrid_info'>
			<hr class='ipsHr'>

			
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

				
CONTENT;

if ( $lastPost ):
$return .= <<<CONTENT

					<div class='ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $lastPost['author'], 'tiny' );
$return .= <<<CONTENT

						<div>
							<ul class='ipsList_reset'>
								<li><a href="
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsType_break' title='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $lastPost['topic_title'] ), '0', "30" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $lastPost['topic_title'] ) ) > "30" ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a></li>
								<li class='ipsType_light ipsTruncate ipsTruncate_line'>
CONTENT;

$htmlsprintf = array($lastPost['author']->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
, <a href='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getLastComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
</a></li>
							</ul>
						</div>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<p class='ipsType_light ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

if ( $forum->password ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_light ipsType_reset ipsTruncate ipsTruncate_line'>
					
CONTENT;

$pluralize = array( $forum->redirect_hits ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirect_hits', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

				</p>
			
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

	function forumRow( $forum, $isSubForum=FALSE, $table=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $forum->can('view') ):
$return .= <<<CONTENT


CONTENT;

$lastPost = $forum->lastPost();
$return .= <<<CONTENT


CONTENT;

$club = $forum->club();
$return .= <<<CONTENT

	<li class="cForumRow ipsDataItem ipsDataItem_responsivePhoto 
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix" data-forumID="
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<div class="ipsDataItem_icon ipsDataItem_category">
			
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
<a href="
CONTENT;

if ( $isSubForum ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'do' => 'markRead', 'return' => $forum->parent_id ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'markRead' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" data-action='markAsRead' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $club ):
$return .= <<<CONTENT

					<img src="
CONTENT;

if ( $club->profile_photo ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( "core_Clubs", $club->profile_photo )->url;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->resource( "default_club.png", "core", 'global', false );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" alt='' class='ipsItemStatus ipsItemStatus_large 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
				
CONTENT;

elseif ( $forum->icon ):
$return .= <<<CONTENT

					<img src="
CONTENT;

$return .= \IPS\File::get( "forums_Icons", $forum->icon )->url;
$return .= <<<CONTENT
" alt='' class='ipsItemStatus ipsItemStatus_custom 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'>
				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $forum->redirect_on ):
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_redirect 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
							<i class='fa fa-arrow-right'></i>
						</span>
					
CONTENT;

elseif ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_answers 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
							<i class='fa fa-question'></i>
						</span>
					
CONTENT;

elseif ( $forum->password ):
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_password 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
							
CONTENT;

if ( $forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

								<i class='fa fa-unlock'></i>
							
CONTENT;

else:
$return .= <<<CONTENT

								<i class='fa fa-lock'></i>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</span>
					
CONTENT;

else:
$return .= <<<CONTENT

						<span class='ipsItemStatus ipsItemStatus_large cForumIcon_normal 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $forum ) && !$forum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $forum );
$return .= <<<CONTENT
>
							<i class="fa fa-comments"></i>
						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !$forum->redirect_on and \IPS\forums\Topic::containerUnread( $forum ) AND \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class="ipsDataItem_main">
			<h4 class="ipsDataItem_title ipsType_large ipsType_break">
				
CONTENT;

if ( $forum->password && !$forum->loggedInMemberHasPasswordAccess() ):
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'passForm', '1' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$sprintf = array($forum->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forum_requires_password', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				
CONTENT;

else:
$return .= <<<CONTENT

					<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

if ( $club ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($club->name, $forum->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_node', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $forum->redirect_on ):
$return .= <<<CONTENT

					&nbsp;&nbsp;<span class='ipsType_light ipsType_medium'>(
CONTENT;

$pluralize = array( $forum->redirect_hits ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirect_hits', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
)</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</h4>
			
CONTENT;

if ( $forum->hasChildren() ):
$return .= <<<CONTENT

				<ul class="ipsDataItem_subList ipsList_inline">
					
CONTENT;

foreach ( $forum->children() as $subforum ):
$return .= <<<CONTENT

						<li class="
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $subforum ) ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
							<a href="
CONTENT;
$return .= htmlspecialchars( $subforum->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

if ( \IPS\forums\Topic::containerUnread( $subforum ) ):
$return .= <<<CONTENT
<span class='ipsItemStatus ipsItemStatus_tiny 
CONTENT;

if ( !\IPS\forums\Topic::containerUnread( $subforum ) && !$subforum->redirect_on ):
$return .= <<<CONTENT
ipsItemStatus_read
CONTENT;

endif;
$return .= <<<CONTENT
'></span>&nbsp;
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $subforum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $forum->description ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( $forum->description, array('ipsDataItem_meta', 'ipsContained') );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		
CONTENT;

if ( !$forum->redirect_on ):
$return .= <<<CONTENT

			<div class="ipsDataItem_stats ipsDataItem_statsLarge">
				
CONTENT;

if ( $lastPost ):
$return .= <<<CONTENT

					<dl>
						
CONTENT;

$count = \IPS\forums\Topic::contentCount( $forum, TRUE );
$return .= <<<CONTENT

						<dt class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $count );
$return .= <<<CONTENT
</dt>
						<dd class="ipsDataItem_stats_type ipsType_light">
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'posts_no_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</dd>
					</dl>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\forums\Topic::modPermission( 'unhide', NULL, $forum ) AND $unapprovedContent = $forum->unapprovedContentRecursive() and ( $unapprovedContent['topics'] OR $unapprovedContent['posts'] ) ):
$return .= <<<CONTENT

					<strong class='ipsType_warning ipsType_medium'>
						<i class='fa fa-warning'></i>
						
CONTENT;

if ( $unapprovedContent['topics'] ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_topics' ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $unapprovedContent['topics'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_topics_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $unapprovedContent['topics'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						/
						
CONTENT;

if ( $unapprovedContent['posts'] ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'advanced_search_submitted' => 1, 'topic_type' => 'queued_posts' ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$pluralize = array( $unapprovedContent['posts'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_posts_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;
$return .= htmlspecialchars( $unapprovedContent['posts'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class='ipsType_light'>0</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</strong>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<ul class="ipsDataItem_lastPoster ipsDataItem_withPhoto">
				
CONTENT;

if ( $lastPost ):
$return .= <<<CONTENT

					<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $lastPost['author'], 'tiny' );
$return .= <<<CONTENT
</li>
					
CONTENT;

if ( $lastPost['topic_title'] ):
$return .= <<<CONTENT
<li><a href="
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $lastPost['topic_title'] ), '0', "26" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $lastPost['topic_title'] ) ) > "26" ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a></li>
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsType_blendLinks'>
CONTENT;

$htmlsprintf = array($lastPost['author']->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</li>
					
CONTENT;

if ( $lastPost['topic_title'] ):
$return .= <<<CONTENT

						<li class="ipsType_light"><a href='
CONTENT;
$return .= htmlspecialchars( $lastPost['topic_url']->setQueryString( 'do', 'getLastComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
</a></li>
					
CONTENT;

else:
$return .= <<<CONTENT

						<li class="ipsType_light">
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsType_light ipsResponsive_showDesktop'>
CONTENT;

if ( $forum->password ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_forum_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>	
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $table and $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $forum ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function forumTableRow( $table, $headers, $forums ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $forums as $forum ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $forum, FALSE, $table );
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function index(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom cForumHeader ipsHeaderButtons'>
	
CONTENT;

if ( \IPS\forums\Forum::canOnAny( 'add' )  ):
$return .= <<<CONTENT

		<ul class='ipsToolList ipsToolList_horizontal ipsClearfix ipsPos_right'>
			<li class='ipsToolList_primaryAction ipsResponsive_hidePhone'>
				<a class="ipsButton ipsButton_medium ipsButton_important" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=forums&module=forums&controller=forums&do=add", null, "topic_non_forum_add_button", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "forums" )->viewChange(  );
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<h1 class='ipsType_pageTitle'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forums', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h1>
</div>

CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	<ul class="ipsToolList ipsToolList_horizontal ipsResponsive_hideDesktop ipsResponsive_hideTablet ipsResponsive_block ipsClearfix">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->indexButtons( FALSE );
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT


<section>
	<ol class='ipsList_reset cForumList' data-controller='core.global.core.table, forums.front.forum.forumList' data-baseURL=''>
		
CONTENT;

foreach ( \IPS\forums\Forum::roots() as $category ):
$return .= <<<CONTENT

			
CONTENT;

if ( $category->can('view') && $category->hasChildren() ):
$return .= <<<CONTENT

			<li data-categoryID='
CONTENT;
$return .= htmlspecialchars( $category->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cForumRow ipsBox ipsSpacer_bottom'>
				<h2 class="ipsType_sectionTitle ipsType_reset cForumTitle">
					<a href='#' class='ipsPos_right ipsJS_show ipsType_noUnderline cForumToggle' data-action='toggleCategory' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_this_category', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></a>
					<a href='
CONTENT;
$return .= htmlspecialchars( $category->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-folder-open-o" aria-hidden="true"></i> 
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</h2>
				
CONTENT;

if ( \IPS\forums\Forum::getMemberView() === 'grid' ):
$return .= <<<CONTENT

					<div class='ipsAreaBackground ipsPad' data-role="forums">
						<div class='ipsGrid ipsGrid_collapsePhone' data-ipsGrid data-ipsGrid-minItemSize='250' data-ipsGrid-maxItemSize='500' data-ipsGrid-equalHeights='row'>
							
CONTENT;

foreach ( $category->children() as $forum ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumGridItem( $forum );
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<ol class="ipsDataList ipsDataList_large ipsDataList_zebra ipsAreaBackground_reset" data-role="forums">
						
CONTENT;

foreach ( $category->children() as $forum ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $forum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
				
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

		
CONTENT;

if ( \IPS\Settings::i()->club_nodes_in_apps and $clubForums = \IPS\forums\Forum::clubNodes() ):
$return .= <<<CONTENT

			<li data-categoryID='clubs' class='cForumRow ipsBox ipsSpacer_bottom'>
				<h2 class="ipsType_sectionTitle ipsType_reset cForumTitle">
					<a href='#' class='ipsPos_right ipsJS_show ipsType_noUnderline cForumToggle' data-action='toggleCategory' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'toggle_this_category', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></a>
					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=forums&module=forums&controller=forums&do=clubs", null, "forums_clubs", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_node_forums', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</h2>
				
CONTENT;

if ( \IPS\forums\Forum::getMemberView() === 'grid' ):
$return .= <<<CONTENT

					<div class='ipsAreaBackground ipsPad' data-role="forums">
						<div class='ipsGrid ipsGrid_collapsePhone' data-ipsGrid data-ipsGrid-minItemSize='250' data-ipsGrid-maxItemSize='500' data-ipsGrid-equalHeights='row'>
							
CONTENT;

foreach ( $clubForums as $forum ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumGridItem( $forum );
$return .= <<<CONTENT

							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</div>
					</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<ol class="ipsDataList ipsDataList_large ipsDataList_zebra ipsAreaBackground_reset" data-role="forums">
						
CONTENT;

foreach ( $clubForums as $forum ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $forum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ol>
</section>
CONTENT;

		return $return;
}

	function indexButtons( $showViewButtons=TRUE, $showFilterButton=FALSE ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $showFilterButton ):
$return .= <<<CONTENT

	<li class='ipsToolList_primaryAction ipsResponsive_hideDesktop ipsResponsive_block'>
		<a class="ipsButton ipsButton_medium ipsButton_link ipsButton_fullWidth" href="#" data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forums_simple_dialog_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-content='#elFluidFormFilters'>
			<span data-role='fluidForumMobileDesc'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forums_simple_filter_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span> <i class='fa fa-angle-down'></i></a>
	</li>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\forums\Forum::canOnAny('add') ):
$return .= <<<CONTENT

<li class='ipsToolList_primaryAction ipsResponsive_hideTablet'>
	<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=forums&module=forums&controller=forums&do=add", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</li>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $showViewButtons ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "forums" )->viewChange(  );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function simplifiedForumTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox cForumFluidTable' data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-tableID='topics' data-dummyLoading data-controller='core.global.core.table
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT
,core.front.core.moderation
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $table->title ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsHide 
CONTENT;

if ( !$table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT
ipsType_medium
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_reset ipsClear'>
CONTENT;
$return .= htmlspecialchars( $table->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $table->count > 0 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<ul class="ipsButtonRow ipsPos_right ipsClearfix">
				<li>
					<a class="ipsJS_show" href="#elCheck_menu" id="elCheck_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$val = "{$table->langPrefix}select_rows_tooltip"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="#elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
						<span class="cAutoCheckIcon ipsType_medium"><i class="fa fa-square-o"></i></span> <i class="fa fa-caret-down"></i>
						<span class='ipsNotificationCount' data-role='autoCheckCount'>0</span>
					</a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide" id="elCheck_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
						<li class="ipsMenu_title">
CONTENT;

$val = "{$table->langPrefix}select_rows"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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
						
CONTENT;

if ( \count($table->getFilters()) ):
$return .= <<<CONTENT

							<li class="ipsMenu_sep"><hr></li>
							
CONTENT;

foreach ( $table->getFilters() as $filter ):
$return .= <<<CONTENT

								<li class="ipsMenu_item" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $filter, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><a href="#">
CONTENT;

$val = "{$filter}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endforeach;
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

		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( isset( $table->sortOptions ) and !empty( $table->sortOptions )  ):
$return .= <<<CONTENT

				<li>
					<a href="#elSortByMenu_menu" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='sortButton' data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
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

if ( $col === $table->getSortByColumn() ):
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
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_menu" id="elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='tableFilterMenu' data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' data-role="tableFilterMenu" id='elFilterByMenu_
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

		
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

		<form action="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-role='moderationTools' data-ipsPageAction>
	
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

			<ol class='ipsDataList ipsDataList_zebra ipsClear cForumTopicTable 
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_topics_in_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class="ipsAreaBackground ipsPad ipsClearfix ipsJS_hide" data-role="pageActionOptions">
				<div class="ipsPos_right">
					<select name="modaction" data-role="moderationAction">
						
CONTENT;

if ( $table->canModerate('unhide') ):
$return .= <<<CONTENT

							<option value='approve' data-icon='check-circle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('feature') or $table->canModerate('unfeature') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='star' data-action='feature'>
								
CONTENT;

if ( $table->canModerate('feature') ):
$return .= <<<CONTENT

									<option value='feature'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'feature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unhide') ):
$return .= <<<CONTENT

									<option value='unfeature'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfeature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('pin') or $table->canModerate('unpin') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='thumb-tack' data-action='pin'>
								
CONTENT;

if ( $table->canModerate('pin') ):
$return .= <<<CONTENT

									<option value='pin'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unpin') ):
$return .= <<<CONTENT

									<option value='unpin'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unpin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('hide') or $table->canModerate('unhide') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='eye' data-action='hide'>
								
CONTENT;

if ( $table->canModerate('hide') ):
$return .= <<<CONTENT

									<option value='hide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unhide') ):
$return .= <<<CONTENT

									<option value='unhide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('lock') or $table->canModerate('unlock') ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='lock' data-action='lock'>
								
CONTENT;

if ( $table->canModerate('lock') ):
$return .= <<<CONTENT

									<option value='lock'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lock', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $table->canModerate('unlock') ):
$return .= <<<CONTENT

									<option value='unlock'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unlock', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('move') ):
$return .= <<<CONTENT

							<option value='move' data-icon='arrow-right'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'move', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('split_merge') ):
$return .= <<<CONTENT

							<option value='merge' data-icon='level-up'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->canModerate('delete') ):
$return .= <<<CONTENT

							<option value='delete' data-icon='trash'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->savedActions ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'saved_actions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='tasks' data-action='saved_actions'>
								
CONTENT;

foreach ( $table->savedActions as $k => $v ):
$return .= <<<CONTENT

									<option value='savedAction-
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
								
CONTENT;

endforeach;
$return .= <<<CONTENT

							</optgroup>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</select>
					<button type="submit" class="ipsButton ipsButton_alternate ipsButton_verySmall">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				</div>
			</div>
		</form>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			<div data-role="tablePagination">
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function simplifiedTopicRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$rowIds = array();
$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

	
CONTENT;

$rowIds[] = $row->$idField;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

$rowCount=0; $adShown=0;
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		
CONTENT;

if ( $rowCount == 1 AND $advertisement = \IPS\core\Advertisement::loadByLocation( 'ad_forum_listing' ) ):
$return .= <<<CONTENT

			<li class="ipsDataItem">
				{$advertisement}
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$rowCount++;
$return .= <<<CONTENT

		
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

		
CONTENT;

if ( $row->mapped('moved_to') ):
$return .= <<<CONTENT

			
CONTENT;

if ( $movedTo = $row->movedTo() AND $movedTo->container()->can('view') ):
$return .= <<<CONTENT

				<li class="ipsDataItem">
					<div class='ipsDataItem_icon ipsType_center ipsType_noBreak'>
						<i class="fa fa-arrow-left ipsType_large"></i>
					</div>
					<div class='ipsDataItem_main'>
						<h4 class='ipsDataItem_title ipsContained_container'>
							<span class='ipsType_break ipsContained'>
								<em><a href='
CONTENT;
$return .= htmlspecialchars( $movedTo->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_new_location', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></em>
							</span>
						</h4>
						<div class='ipsDataItem_meta'>
							
CONTENT;

if ( isset( $row::$databaseColumnMap['status'] ) ):
$return .= <<<CONTENT

								
CONTENT;

$statusField = $row::$databaseColumnMap['status'];
$return .= <<<CONTENT

								
CONTENT;

if ( $row->$statusField == 'merged' ):
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->url(), $movedTo->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_merged_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

else:
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moved_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moved_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
					
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

						<div class='ipsDataItem_modCheck'>
							<span class='ipsCustomInput'>
								<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT
unfeature
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT
unpin
CONTENT;

endif;
$return .= <<<CONTENT
 delete" data-state='
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT
pinned
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT
featured
CONTENT;

endif;
$return .= <<<CONTENT
'>
								<span></span>
							</span>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<li class="ipsDataItem ipsDataItem_responsivePhoto 
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( method_exists( $row, 'tableClass' ) && $row->tableClass() ):
$return .= <<<CONTENT
ipsDataItem_
CONTENT;
$return .= htmlspecialchars( $row->tableClass(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
" data-rowID='
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<div class='ipsDataItem_icon ipsType_blendLinks'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title ipsContained_container'>
						
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

							
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT

								<span>
									<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
										<span class='ipsItemStatus'><i class="fa 
CONTENT;

if ( \in_array( $row->$idField, $table->contentPostedIn ) ):
$return .= <<<CONTENT
fa-star
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
									</a>
								</span>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( \in_array( $row->$idField, $table->contentPostedIn ) ):
$return .= <<<CONTENT

									<span>
										<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
									</span>
								
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

if ( $row->locked() ):
$return .= <<<CONTENT

							<span>
								<i class='ipsType_medium fa fa-lock' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i>
							</span>	
							
CONTENT;

if ( $row->topic_open_time && $row->topic_open_time > time() ):
$return .= <<<CONTENT

								<span><strong class='ipsType_small ipsType_noBreak' data-ipsTooltip title='
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $row->topic_open_time )->relative(), \IPS\DateTime::ts( $row->topic_open_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_unlocks_at', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array(\IPS\DateTime::ts($row->topic_open_time)->relative(1)); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_unlocks_at_short', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>&nbsp;&nbsp;</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

elseif ( !$row->locked() && $row->topic_close_time && $row->topic_close_time > time() ):
$return .= <<<CONTENT

							<span><strong class='ipsType_small ipsType_noBreak' data-ipsTooltip title='
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $row->topic_close_time )->relative(), \IPS\DateTime::ts( $row->topic_close_time )->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locks_at', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'><i class='fa fa-clock-o'></i> 
CONTENT;

$sprintf = array(\IPS\DateTime::ts($row->topic_close_time)->relative(1)); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locks_at_short', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>&nbsp;&nbsp;</span>
						
CONTENT;

endif;
$return .= <<<CONTENT


						
CONTENT;

if ( $row->mapped('poll') ):
$return .= <<<CONTENT

							<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_neutral" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_has_poll', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-question'></i></span></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
						
CONTENT;

if ( $row->mapped('pinned') || $row->mapped('featured') || $row->hidden() === -1 || $row->hidden() === 1 ):
$return .= <<<CONTENT

							
CONTENT;

if ( $row->hidden() === -1 ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $row->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
							
CONTENT;

elseif ( $row->hidden() === 1 ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span></span>
							
CONTENT;

endif;
$return .= <<<CONTENT
							
							
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
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

if ( $row->prefix() ):
$return .= <<<CONTENT

							<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $row->prefix( TRUE ), $row->prefix() );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT
						
						
						<span class='ipsType_break ipsContained'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='' title='
CONTENT;

if ( $row->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $row->tableHoverUrl and $row->canView() ):
$return .= <<<CONTENT
 data-ipsHover data-ipsHover-target='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString('preview', 1), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsHover-timeout='1.5'
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $row->canEdit() ):
$return .= <<<CONTENT
 data-role="editableTitle"
CONTENT;

endif;
$return .= <<<CONTENT
>
								<span>
									
CONTENT;

if ( $row->mapped('title') or $row->mapped('title') == 0 ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<em class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_deleted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em>
CONTENT;

endif;
$return .= <<<CONTENT

								</span>
							</a>

							
CONTENT;

if ( $row->commentPageCount() > 1 ):
$return .= <<<CONTENT

								{$row->commentPagination( array(), 'miniPagination' )}
							
CONTENT;

endif;
$return .= <<<CONTENT

						</span>
					</h4>
					<div class='ipsDataItem_meta ipsType_reset ipsType_light ipsType_blendLinks'>
						<span>
							
CONTENT;

$htmlsprintf = array($row->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_itemprop', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

						</span>
CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html(FALSE);
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href="
CONTENT;
$return .= htmlspecialchars( $row->container()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

if ( $club = $row->container()->club() ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($club->name, $row->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_node', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
{$row->container()->_formattedTitle}
CONTENT;

endif;
$return .= <<<CONTENT
</a>
						
						
CONTENT;

if ( \count( $row->tags() ) ):
$return .= <<<CONTENT

							&nbsp;&nbsp;
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $row->tags(), true );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</div>
				<ul class='ipsDataItem_stats'>
					
CONTENT;

foreach ( $row->stats(FALSE) as $k => $v ):
$return .= <<<CONTENT

						<li 
CONTENT;

if ( $k == 'num_views' ):
$return .= <<<CONTENT
class='ipsType_light'
CONTENT;

elseif ( \in_array( $k, $row->hotStats ) ):
$return .= <<<CONTENT
class="ipsDataItem_stats_hot" data-text='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hot_item', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hot_item_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
							<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
							<span class='ipsDataItem_stats_type'>
CONTENT;

$val = "{$k}"; $pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
							
CONTENT;

if ( ( $k == 'forums_comments' OR $k == 'answers_no_number' ) && \IPS\forums\Topic::modPermission( 'unhide', NULL, $row->container() ) AND $unapprovedComments = $row->mapped('unapproved_comments') ):
$return .= <<<CONTENT

								&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString( 'queued_posts', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_warning ipsType_small ipsPos_right ipsResponsive_noFloat' data-ipsTooltip title='
CONTENT;

$pluralize = array( $row->topic_queuedposts ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'queued_posts_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i> <strong>
CONTENT;
$return .= htmlspecialchars( $unapprovedComments, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

					<li class="ipsType_light ipsResponsive_hideDesktop">
						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'getLastComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'updated', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( $row->mapped('last_comment') ):
$return .= <<<CONTENT

CONTENT;

$val = ( $row->mapped('last_comment') instanceof \IPS\DateTime ) ? $row->mapped('last_comment') : \IPS\DateTime::ts( $row->mapped('last_comment') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

						</a>
					</li>
				</ul>
				<ul class='ipsDataItem_lastPoster ipsDataItem_noPhoto ipsType_blendLinks ipsResponsive_hidePhone ipsResponsive_hideTablet'>
					<li>
						
CONTENT;

if ( $row->mapped('num_comments') ):
$return .= <<<CONTENT

							{$row->lastCommenter()->link()}
						
CONTENT;

else:
$return .= <<<CONTENT

							{$row->author()->link()}
						
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
					<li class="ipsType_light">
						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'getLastComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
							
CONTENT;

if ( $row->mapped('last_comment') ):
$return .= <<<CONTENT

CONTENT;

$val = ( $row->mapped('last_comment') instanceof \IPS\DateTime ) ? $row->mapped('last_comment') : \IPS\DateTime::ts( $row->mapped('last_comment') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

						</a>
					</li>
				</ul>
				
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

					<div class='ipsDataItem_modCheck'>
						<span class='ipsCustomInput'>
							<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $row->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->tableStates(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
							<span></span>
						</span>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $advertisement = \IPS\core\Advertisement::loadByLocation( 'ad_fluid_index_view' ) and ( $rowCount + 1 > $advertisement->_additional_settings['ad_fluid_index_view_number'] and ( ( $rowCount + 1 ) % $advertisement->_additional_settings['ad_fluid_index_view_number'] === 1 ) ) ):
$return .= <<<CONTENT

			
CONTENT;

if ( $advertisement->_additional_settings['ad_fluid_index_view_repeat'] == -1 or ( $advertisement->_additional_settings['ad_fluid_index_view_repeat'] > $adShown ) ):
$return .= <<<CONTENT

				<li>{$advertisement}</li>
				
CONTENT;

$adShown++;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
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

	function simplifiedView( $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPageHeader ipsClearfix ipsSpacer_bottom cForumHeader ipsHeaderButtons">
	
CONTENT;

if ( \IPS\forums\Forum::canOnAny( 'add' ) ):
$return .= <<<CONTENT

		<ul class='ipsToolList ipsToolList_horizontal ipsClearfix ipsPos_right'>
			<li class='ipsToolList_primaryAction ipsResponsive_hidePhone'>
				<a class="ipsButton ipsButton_medium ipsButton_important" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=forums&module=forums&controller=forums&do=add", null, "topic_non_forum_add_button", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "forums" )->viewChange(  );
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<h1 class="ipsType_pageTitle">
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topics', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h1>
</div>

<ul class="ipsToolList ipsToolList_horizontal ipsResponsive_hideDesktop ipsResponsive_block ipsClearfix">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->indexButtons( FALSE, TRUE );
$return .= <<<CONTENT

</ul>

{$table}
CONTENT;

		return $return;
}

	function simplifiedViewSidebar( $forumIds, $map ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller="forums.front.forum.flow" class='ipsBox cForumMiniList_wrapper' id='elFluidFormFilters'>
	<div class='ipsSideMenu'>
		
CONTENT;

if ( \count( \IPS\forums\Forum::roots() ) === 1 ):
$return .= <<<CONTENT

			<ul class='ipsSideMenu_list cForumMiniList cForumMiniList_singleRoot'>
				
CONTENT;

foreach ( \IPS\forums\Forum::roots() as $category ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums", 'front' )->simplifiedViewSidebar_children( $forumIds, $category, 0 );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		
CONTENT;

else:
$return .= <<<CONTENT

			<ul class='ipsSideMenu_list cForumMiniList cForumMiniList_multiRoot'>
				
CONTENT;

foreach ( \IPS\forums\Forum::roots() as $category ):
$return .= <<<CONTENT

					
CONTENT;

if ( $category->hasChildren() ):
$return .= <<<CONTENT

						<li class="" data-category>
							<a href="
CONTENT;
$return .= htmlspecialchars( $category->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-parent-id="
CONTENT;
$return .= htmlspecialchars( $category->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-node-id="
CONTENT;
$return .= htmlspecialchars( $category->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsSideMenu_item ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $category->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

if ( $category->hasChildren() ):
$return .= <<<CONTENT

								<ul class='ipsSideMenu_list cForumMiniList'>
									
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums", 'front' )->simplifiedViewSidebar_children( $forumIds, $category, 0 );
$return .= <<<CONTENT

								</ul>
							
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

				
CONTENT;

if ( \IPS\Settings::i()->club_nodes_in_apps and $clubForums = \IPS\forums\Forum::clubNodes() ):
$return .= <<<CONTENT

					<li class="
CONTENT;

if ( \in_array( 'clubs', $map ) ):
$return .= <<<CONTENT
cForumMiniList_categorySelected
CONTENT;

endif;
$return .= <<<CONTENT
">
						<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=forums&module=forums&controller=index&forumId=clubs", null, "forums", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-parent-id="clubs" data-node-id="clubs" class='
CONTENT;

if ( \in_array( 'clubs', $map ) ):
$return .= <<<CONTENT
cForumMiniList_selected
CONTENT;

endif;
$return .= <<<CONTENT
 ipsSideMenu_item ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_node_forums', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						<ul class='ipsSideMenu_list cForumMiniList'>
							
CONTENT;

foreach ( $clubForums as $idx => $forum ):
$return .= <<<CONTENT

								
CONTENT;

$lastPost = $forum->lastPost();
$return .= <<<CONTENT

								
CONTENT;

$unread = \IPS\forums\Topic::containerUnread( $forum );
$return .= <<<CONTENT

								
CONTENT;

$children = $forum->children();
$return .= <<<CONTENT

								
CONTENT;

if ( ! $forum->redirect_on and $forum->can('read')  ):
$return .= <<<CONTENT

									<li class="
CONTENT;

if ( $children ):
$return .= <<<CONTENT
cForumMiniList_category
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $map[ $forum->parent_id ] ) AND \in_array( $forum->_id, $map[ $forum->parent_id ] ) ):
$return .= <<<CONTENT
cForumMiniList_categorySelected
CONTENT;

endif;
$return .= <<<CONTENT
">
										<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-parent-id="clubs" data-node-id="
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-has-children="
CONTENT;

if ( $children ):
$return .= <<<CONTENT
1
CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
" class='
CONTENT;

if ( \in_array( $forum->_id, $forumIds ) ):
$return .= <<<CONTENT
cForumMiniList_selected
CONTENT;

endif;
$return .= <<<CONTENT
 ipsSideMenu_item 
CONTENT;

if ( !$unread ):
$return .= <<<CONTENT
cForumMiniList_unread
CONTENT;

endif;
$return .= <<<CONTENT
'>
											<span class='cForumMiniList_blob' 
CONTENT;

if ( $forum->feature_color ):
$return .= <<<CONTENT
style="background-color: 
CONTENT;
$return .= htmlspecialchars( $forum->feature_color, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
; color: 
CONTENT;
$return .= htmlspecialchars( $forum->_featureTextColor, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
;"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $lastPost['date'] ):
$return .= <<<CONTENT
title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forum_simple_view_last_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
" data-ipsTooltip data-ipsTooltip-safe
CONTENT;

endif;
$return .= <<<CONTENT
>
												<span></span>
												<i class='fa fa-check'></i>
											</span>
											<span class='cForumMiniList_title ipsTruncate ipsTruncate_line'>
												
CONTENT;

if ( $unread ):
$return .= <<<CONTENT
<strong>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$sprintf = array($forum->club()->name, $forum->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_node', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

if ( $unread ):
$return .= <<<CONTENT
</strong>
CONTENT;

endif;
$return .= <<<CONTENT

											</span>
											<span class='ipsType_small ipsType_light cForumMiniList_count'>
CONTENT;

$return .= htmlspecialchars( \IPS\forums\Topic::contentCount( $forum ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
										</a>
									</li>
								
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

			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class='ipsResponsive_hideDesktop ipsResponsive_block'>
		<hr class='ipsHr'>
		<a href='#' class='ipsButton ipsButton_fullWidth ipsButton_primary ipsButton_medium' data-action='dialogClose'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'done_forum_filtering', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</div>
CONTENT;

		return $return;
}

	function simplifiedViewSidebar_children( $forumIds, $parent, $depth ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $parent->hasChildren()and $depth < 5 ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $parent->children() as $idx => $forum ):
$return .= <<<CONTENT

		
CONTENT;

$lastPost = $forum->lastPost();
$return .= <<<CONTENT

		
CONTENT;

$unread = \IPS\forums\Topic::containerUnread( $forum );
$return .= <<<CONTENT

		
CONTENT;

$children = $forum->children();
$return .= <<<CONTENT

		
CONTENT;

if ( ! $forum->redirect_on and ( $forum->can('read') or !$forum->sub_can_post )  ):
$return .= <<<CONTENT

			<li class="
CONTENT;

if ( $children ):
$return .= <<<CONTENT
cForumMiniList_category
CONTENT;

endif;
$return .= <<<CONTENT
">
				<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-parent-id="
CONTENT;
$return .= htmlspecialchars( $parent->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-node-id="
CONTENT;
$return .= htmlspecialchars( $forum->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-has-children="
CONTENT;

if ( $children ):
$return .= <<<CONTENT
1
CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
" class='ipsSideMenu_item 
CONTENT;

if ( !$unread ):
$return .= <<<CONTENT
cForumMiniList_unread
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<span class='cForumMiniList_blob' 
CONTENT;

if ( $forum->feature_color ):
$return .= <<<CONTENT
style="background-color: 
CONTENT;
$return .= htmlspecialchars( $forum->feature_color, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
; color: 
CONTENT;
$return .= htmlspecialchars( $forum->_featureTextColor, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
;"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $lastPost['date'] ):
$return .= <<<CONTENT
title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forum_simple_view_last_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $lastPost['date'] instanceof \IPS\DateTime ) ? $lastPost['date'] : \IPS\DateTime::ts( $lastPost['date'] );$return .= $val->html();
$return .= <<<CONTENT
" data-ipsTooltip data-ipsTooltip-safe
CONTENT;

endif;
$return .= <<<CONTENT
>
						<span></span>
						<i class='fa fa-check'></i>
					</span>
					<span class='cForumMiniList_title ipsTruncate ipsTruncate_line'>
						
CONTENT;

if ( $unread ):
$return .= <<<CONTENT
<strong>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $unread ):
$return .= <<<CONTENT
</strong>
CONTENT;

endif;
$return .= <<<CONTENT

					</span>
					<span class='ipsType_small ipsType_light cForumMiniList_count'>
CONTENT;

$return .= htmlspecialchars( \IPS\forums\Topic::contentCount( $forum ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				</a>
				
CONTENT;

if ( $children ):
$return .= <<<CONTENT

					<ul class='ipsSideMenu_list cForumMiniList'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums", 'front' )->simplifiedViewSidebar_children( $forumIds, $forum, $depth+1 );
$return .= <<<CONTENT

					</ul>
				
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


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}