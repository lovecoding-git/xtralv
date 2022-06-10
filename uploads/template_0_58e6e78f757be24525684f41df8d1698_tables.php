<?php
namespace IPS\Theme\Cache;
class class_core_front_tables extends \IPS\Theme\Template
{
	public $cache_key = '91ad289b393b6e67d26358f4f9555a20';
	function commentRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

	<li class='ipsMargin ipsDataItem ipsDataItem_autoWidth' data-rowID='
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<article id='elComment_
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment ipsBox ipsBox--child 
CONTENT;

if ( \IPS\IPS::classUsesTrait( $row, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $row->reactionCount() >= \IPS\Settings::i()->reputation_highlight ):
$return .= <<<CONTENT
ipsComment_popular
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix ipsClear 
CONTENT;

if ( $row->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>

			
CONTENT;

if ( \IPS\IPS::classUsesTrait( $row, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $row->reactionCount() >= \IPS\Settings::i()->reputation_highlight ):
$return .= <<<CONTENT

				<div class='ipsResponsive_showPhone ipsComment_badges'>
					<ul class='ipsList_reset ipsFlex ipsFlex-fw:wrap ipsGap:2 ipsGap_row:1'>
						<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
					</ul>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<div id='comment-
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' class='ipsComment_content ipsType_normal ipsClearfix'>	
				<div class='ipsComment_header ipsPadding_top ipsFlex ipsFlex-fd:row-reverse ipsFlex-ai:start ipsFlex-jc:between sm:ipsFlex-fd:column'>
					<div class='ipsComment_toolWrap ipsFlex-flex:00'>
						
CONTENT;

if ( \IPS\IPS::classUsesTrait( $row, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $row->reactionCount() >= \IPS\Settings::i()->reputation_highlight ):
$return .= <<<CONTENT

							<div class='ipsResponsive_hidePhone ipsComment_badges'>
								<ul class='ipsList_reset ipsFlex ipsFlex-jc:end ipsFlex-fw:wrap ipsGap:2 ipsGap_row:1'>
									<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
								</ul>
							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<ul class='ipsList_reset ipsComment_tools'>
							
CONTENT;

if ( $row->canReportOrRevoke() === TRUE ):
$return .= <<<CONTENT

								<li><a href='
CONTENT;
$return .= htmlspecialchars( $row->url('report'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_reply', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $table->canModerate() and ( $row->canSplit() or ( $row->hidden() === -1 AND $row->canUnhide() ) or ( $row->hidden() === 1 AND $row->canUnhide() ) or $row->canDelete() ) ):
$return .= <<<CONTENT

								<li>
									<span class='ipsCustomInput'>
										<input type="checkbox" name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" data-role="moderation" data-actions="
CONTENT;

if ( $row->canSplit() ):
$return .= <<<CONTENT
split
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->hidden() === -1 AND $row->canUnhide() ):
$return .= <<<CONTENT
unhide
CONTENT;

elseif ( $row->hidden() === 1 AND $row->canUnhide() ):
$return .= <<<CONTENT
approve
CONTENT;

elseif ( $row->canHide() ):
$return .= <<<CONTENT
hide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->canDelete() ):
$return .= <<<CONTENT
delete
CONTENT;

endif;
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
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</div>
					{$row->contentTableHeader()}
				</div>
				
				<div class=''>
					<div class='ipsPadding_horizontal ipsPadding_bottom ipsPadding_top:half'>
						
CONTENT;

if ( \IPS\Request::i()->controller == 'activity' ):
$return .= <<<CONTENT

							<div class='ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix'>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'mini' );
$return .= <<<CONTENT

								<div>
									<h3 class='ipsType_reset ipsType_normal'>{$row->author()->link( NULL, NULL, $row->isAnonymous() )}</h3>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<p class='ipsComment_meta ipsType_light ipsType_medium ipsType_blendLinks'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'find' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$row->dateLine()}</a>
							
CONTENT;

if ( $row->editLine() ):
$return .= <<<CONTENT

								&middot; {$row->editLine()}
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $row->hidden() ):
$return .= <<<CONTENT

								&middot; 
CONTENT;
$return .= htmlspecialchars( $row->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT
							
						</p>
						
CONTENT;

if ( \IPS\Request::i()->controller == 'activity' ):
$return .= <<<CONTENT

								</div>
							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT


						<div data-role='commentContent' class='ipsType_break ipsType_richText ipsContained ipsMargin_top' data-controller='core.front.core.lightboxedImages'>
							
CONTENT;

if ( $row->hidden() === 1 && $row->author()->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

								<strong class='ipsType_medium ipsType_warning'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_awaiting_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							
CONTENT;

endif;
$return .= <<<CONTENT

							{$row->content()}
						</div>
					</div>
					
CONTENT;

if ( $row->hidden() !== 1 && \IPS\IPS::classUsesTrait( $row, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

						<div class='ipsItemControls'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $row );
$return .= <<<CONTENT

						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>		
			</div>
		</article>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function container( $table, $header=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

if ( $header ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $header, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h1>
</div>

<div class='ipsBox'>
	{$table}
</div>
CONTENT;

		return $return;
}

	function icon( $class, $container=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $class::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 

CONTENT;

if ( $container === NULL ):
$return .= <<<CONTENT

	
CONTENT;

$val = "{$class::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<a href="
CONTENT;
$return .= htmlspecialchars( $container->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $class::$title ), $container->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'icon_blurb_in_containers', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function manageFollowNodeRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$contentItemClass = $row::$contentItemClass;
$return .= <<<CONTENT

	<li class="ipsDataItem 
CONTENT;

if ( $contentItemClass::containerUnread( $row ) ):
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
" data-controller='core.front.system.manageFollowed' data-followID='
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_area'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
-
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_rel_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<div class='ipsDataItem_main'>
			<h4 class='ipsType_sectionHead'>
				
CONTENT;

if ( $row->_locked ):
$return .= <<<CONTENT

					<i class="fa fa-lock"></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
				<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;
$return .= htmlspecialchars( $row->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</h4>
			<div class='ipsDataItem_meta ipsType_light' data-ipsTruncate data-ipsTruncate-size='2 lines' data-ipsTruncate-type='remove'>
				
CONTENT;
$return .= htmlspecialchars( $row->_description, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</div>
			<ul class='ipsList_inline ipsType_light'>
				
CONTENT;

if ( $row->_items ):
$return .= <<<CONTENT

					<li>
CONTENT;

$pluralize = array( $row->_items ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'node_content_items', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $row->_comments ):
$return .= <<<CONTENT

					<li>
CONTENT;

$pluralize = array( $row->_comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'node_content_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $row->_reviews ):
$return .= <<<CONTENT

					<li>
CONTENT;

$pluralize = array( $row->_reviews ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'node_content_reviews', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
		
		<div class='ipsDataItem_generic ipsDataItem_size1 ipsType_center ipsType_large'>
			<span class='ipsBadge ipsBadge_icon ipsBadge_new 
CONTENT;

if ( !$row->_followData['follow_is_anon'] ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='followAnonymous' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_is_anon', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
		</div>

		<div class='ipsDataItem_generic ipsDataItem_size6'>
			<ul class='ipsList_reset'>
				<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_when', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followDate'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $row->_followData['follow_added'] instanceof \IPS\DateTime ) ? $row->_followData['follow_added'] : \IPS\DateTime::ts( $row->_followData['follow_added'] );$return .= $val->html();
$return .= <<<CONTENT
</li>
				<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_how', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followFrequency'>
					
CONTENT;

if ( $row->_followData['follow_notify_freq'] == 'none' ):
$return .= <<<CONTENT

						<i class='fa fa-bell-slash-o'></i>
					
CONTENT;

else:
$return .= <<<CONTENT

						<i class='fa fa-bell'></i>
					
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

$val = "follow_freq_{$row->_followData['follow_notify_freq']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</li>
			</ul>
		</div>

		<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_center'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->manageFollow( $row->_followData['follow_app'], $row->_followData['follow_area'], $row->_followData['follow_rel_id'] );
$return .= <<<CONTENT

		</div>

		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

	function manageFollowRow( $table, $headers, $rows, $includeFirstCommentInCommentCount=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
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
" data-controller='core.front.system.manageFollowed' data-followID='
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_area'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
-
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_rel_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<div class='ipsDataItem_main'>
				<h4 class='ipsDataItem_title ipsContained_container'>
					
CONTENT;

if ( $row->mapped('locked') ):
$return .= <<<CONTENT

						<span><i class="fa fa-lock"></i></span>
					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

if ( $row->mapped('pinned') || $row->mapped('featured') || $row->hidden() === -1 || $row->hidden() === 1 ):
$return .= <<<CONTENT

						<span>
							
CONTENT;

if ( $row->hidden() === -1 ):
$return .= <<<CONTENT

								<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $row->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
							
CONTENT;

elseif ( $row->hidden() === 1 ):
$return .= <<<CONTENT

								<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
							
CONTENT;

endif;
$return .= <<<CONTENT
							
							
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT

								<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT

								<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</span>
					
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
'>
							
CONTENT;

if ( $row->mapped('title') ):
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

						</a>
					</span>
				</h4>
				<div class='ipsDataItem_meta ipsType_light ipsType_blendLinks' data-ipsTruncate data-ipsTruncate-size='2 lines' data-ipsTruncate-type='remove'>
					
CONTENT;

if ( method_exists( $row, 'tableDescription' ) ):
$return .= <<<CONTENT

						{$row->tableDescription()}
					
CONTENT;

else:
$return .= <<<CONTENT

                        
CONTENT;

$htmlsprintf = array($row->author()->link( $row->warningRef() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= $val->html();
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
$return .= htmlspecialchars( $row->container()->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>				
			</div>

			<div class='ipsDataItem_generic ipsDataItem_size1 ipsType_center ipsType_large cFollowedContent_anon'>
				<span class='ipsBadge ipsBadge_icon ipsBadge_new 
CONTENT;

if ( !$row->_followData['follow_is_anon'] ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='followAnonymous' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_is_anon', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
			</div>

			<div class='ipsDataItem_generic ipsDataItem_size6 cFollowedContent_info'>
				<ul class='ipsList_reset'>
					<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_when', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followDate'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $row->_followData['follow_added'] instanceof \IPS\DateTime ) ? $row->_followData['follow_added'] : \IPS\DateTime::ts( $row->_followData['follow_added'] );$return .= $val->html();
$return .= <<<CONTENT
</li>
					<li title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_how', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='followFrequency'>
						
CONTENT;

if ( $row->_followData['follow_notify_freq'] == 'none' ):
$return .= <<<CONTENT

							<i class='fa fa-bell-slash-o'></i>
						
CONTENT;

else:
$return .= <<<CONTENT

							<i class='fa fa-bell'></i>
						
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

$val = "follow_freq_{$row->_followData['follow_notify_freq']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</li>
				</ul>
			</div>

			<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_center cFollowedContent_manage'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->manageFollow( $row->_followData['follow_app'], $row->_followData['follow_area'], $row->_followData['follow_rel_id'] );
$return .= <<<CONTENT

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

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function noRows(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsType_center ipsPad'>
	<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'nothing_to_show', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
</div>
CONTENT;

		return $return;
}

	function nodeRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$contentItemClass = $row::$contentItemClass;
$return .= <<<CONTENT

	<li class="ipsDataItem 
CONTENT;

if ( $contentItemClass::containerUnread( $row ) ):
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
">
		
CONTENT;

if ( method_exists( $row, 'tableIcon' ) ):
$return .= <<<CONTENT

			<div class='ipsDataItem_icon ipsType_center ipsType_noBreak'>
				{$row->tableIcon()}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title'>
				
CONTENT;

if ( $contentItemClass::containerUnread( $row ) ):
$return .= <<<CONTENT

					<span class='ipsBadge ipsBadge_new'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

if ( $row->_locked ):
$return .= <<<CONTENT

					<i class="fa fa-lock"></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
				<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;
$return .= htmlspecialchars( $row->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</h4>
			<div class='ipsDataItem_meta ipsType_light' data-ipsTruncate data-ipsTruncate-size='2 lines' data-ipsTruncate-type='remove'>
				
CONTENT;
$return .= htmlspecialchars( $row->_description, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</div>
		</div>
		<ul class='ipsDataItem_stats'>
			<li>
				<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $row->_items );
$return .= <<<CONTENT
</span>
				<span class='ipsDataItem_stats_type'>
CONTENT;

$pluralize = array( $row->_items ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'node_content_items', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			</li>
			<li>
				<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $row->_comments );
$return .= <<<CONTENT
</span>
				<span class='ipsDataItem_stats_type'>
CONTENT;

$pluralize = array( $row->_comments ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'node_content_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			</li>
			<li>
				<span class='ipsDataItem_stats_number'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $row->_reviews );
$return .= <<<CONTENT
</span>
				<span class='ipsDataItem_stats_type'>
CONTENT;

$pluralize = array( $row->_reviews ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'node_content_reviews', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
			</li>
		</ul>
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

	function rows( $table, $headers, $rows ) {
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

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $row::$databaseColumnId;
$return .= <<<CONTENT

		
CONTENT;

if ( $row->mapped('moved_to') ):
$return .= <<<CONTENT

			
CONTENT;

if ( $movedTo = $row->movedTo() ):
$return .= <<<CONTENT

				<li class="ipsDataItem">
					<div class='ipsDataItem_icon ipsType_center ipsType_noBreak'>
						<i class="fa fa-arrow-left ipsType_large"></i>
					</div>
					<div class='ipsDataItem_main'>
						<h4 class='ipsDataItem_title'>
							<span class='ipsType_break ipsContained_container'><em><a href='
CONTENT;
$return .= htmlspecialchars( $movedTo->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_new_location', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $row->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></em></span>
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

$sprintf = array($movedTo->url(), $movedTo->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merged_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

else:
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moved_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moved_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
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
">
				<div class='ipsDataItem_icon ipsPos_top'>
					
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
							
CONTENT;

if ( $row->containerWrapper() AND \in_array( $row->$idField, $row->containerWrapper()->contentPostedIn( null, $rowIds ) ) ):
$return .= <<<CONTENT

								<span class='ipsItemStatus'><i class="fa fa-star"></i></span>
							
CONTENT;

else:
$return .= <<<CONTENT

								<span class='ipsItemStatus'><i class="fa fa-circle"></i></span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( $row->containerWrapper() AND \in_array( $row->$idField, $row->containerWrapper()->contentPostedIn( null, $rowIds ) ) ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
						
CONTENT;

else:
$return .= <<<CONTENT

							&nbsp;
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title ipsContained_container'>						
						
CONTENT;

if ( $row->mapped('locked') ):
$return .= <<<CONTENT

							<span><i class="fa fa-lock"></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT


						
CONTENT;

if ( $row->mapped('pinned') || $row->mapped('featured') || $row->hidden() === -1 || $row->hidden() === 1 ):
$return .= <<<CONTENT

							<span>
								
CONTENT;

if ( $row->hidden() === -1 ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $row->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
								
CONTENT;

elseif ( $row->hidden() === 1 ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pending_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-warning'></i></span>
								
CONTENT;

endif;
$return .= <<<CONTENT
							
								
CONTENT;

if ( $row->mapped('pinned') ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-thumb-tack'></i></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $row->mapped('featured') ):
$return .= <<<CONTENT

									<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-star'></i></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</span>
						
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
' 
CONTENT;

if ( $row->tableHoverUrl and $row->canView() ):
$return .= <<<CONTENT
data-ipsHover data-ipsHover-target='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString('preview', 1), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'data-ipsHover
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->canEdit() AND $row->editableTitle === TRUE ):
$return .= <<<CONTENT
data-role="editableTitle" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'click_hold_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
								
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

							</a>
						</span>
						
CONTENT;

if ( $row->commentPageCount() > 1 ):
$return .= <<<CONTENT

	                        {$row->commentPagination( array(), 'miniPagination' )}
	                    
CONTENT;

endif;
$return .= <<<CONTENT

					</h4>

					<div class='ipsDataItem_meta ipsType_light ipsType_blendLinks' data-ipsTruncate data-ipsTruncate-size='2 lines' data-ipsTruncate-type='remove'>
						
CONTENT;

if ( method_exists( $row, 'tableDescription' ) ):
$return .= <<<CONTENT

							{$row->tableDescription()}
						
CONTENT;

else:
$return .= <<<CONTENT

                            
CONTENT;

$htmlsprintf = array($row->author()->link( $row->warningRef(), NULL, $row->isAnonymous() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= $val->html();
$return .= <<<CONTENT

							
CONTENT;

if ( \in_array( \IPS\Request::i()->controller, array( 'search' ) ) ):
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
$return .= htmlspecialchars( $row->container()->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
					
CONTENT;

if ( $row->tags() AND \count( $row->tags() ) ):
$return .= <<<CONTENT

						&nbsp;&nbsp;
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $row->tags(), true, true );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<ul class='ipsDataItem_stats'>
					
CONTENT;

foreach ( $row->stats(TRUE) as $k => $v ):
$return .= <<<CONTENT

						<li 
CONTENT;

if ( \in_array( $k, $row->hotStats ) ):
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
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>
				<ul class='ipsDataItem_lastPoster ipsDataItem_withPhoto ipsType_blendLinks'>
					<li>
						
CONTENT;

if ( $row->mapped('num_comments') ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->lastCommenter(), 'tiny' );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'tiny' );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
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
						
CONTENT;

if ( $row->mapped('last_comment') ):
$return .= <<<CONTENT

							<a href="
CONTENT;
$return .= htmlspecialchars( $row->url('getLastComment'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = ( $row->mapped('last_comment') instanceof \IPS\DateTime ) ? $row->mapped('last_comment') : \IPS\DateTime::ts( $row->mapped('last_comment') );$return .= $val->html();
$return .= <<<CONTENT
</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

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

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function subRow( $subResult ) {
		$return = '';
		$return .= <<<CONTENT


<li class='cSearchSubResult ipsPhotoPanel ipsPhotoPanel_tiny'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $subResult->author(), 'tiny' );
$return .= <<<CONTENT

	<div>
		<p class='ipsType_reset'>
			
CONTENT;

if ( $subResult instanceof \IPS\Content\Review ):
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $subResult->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_this_review', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					<strong>
CONTENT;

$sprintf = array($subResult->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_user_reviewed', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 &nbsp;<span class='ipsType_light ipsType_unbold'>
CONTENT;

$val = ( $subResult->mapped('date') instanceof \IPS\DateTime ) ? $subResult->mapped('date') : \IPS\DateTime::ts( $subResult->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT
</span></strong>
				</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $subResult->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_this_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					<strong>
CONTENT;

$sprintf = array($subResult->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_user_commented', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 &nbsp;<span class='ipsType_light ipsType_unbold'>
CONTENT;

$val = ( $subResult->mapped('date') instanceof \IPS\DateTime ) ? $subResult->mapped('date') : \IPS\DateTime::ts( $subResult->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT
</span></strong>
				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</p>
		
CONTENT;

if ( $subResult instanceof \IPS\Content\Review ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'tiny', $subResult->mapped('rating'), \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsType_richText ipsType_medium ipsType_break' data-ipsTruncate data-ipsTruncate-size='2 lines' data-ipsTruncate-type='remove'>
			{$subResult->truncated()}
		</div>
	</div>
</li>
CONTENT;

		return $return;
}

	function table( $table, $headers, $rows, $quickSearch ) {
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

if ( $table->dummyLoading ):
$return .= <<<CONTENT
data-dummyLoading
CONTENT;

endif;
$return .= <<<CONTENT
 
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
 data-tableID='
CONTENT;

$return .= htmlspecialchars( md5($table->baseUrl->stripQueryString($table->getPaginationKey())), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	
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

if ( ( $table->canModerate() AND $table->showFilters ) OR ( $table->showAdvancedSearch AND ( ( isset( $table->sortOptions ) and \count( $table->sortOptions ) > 1 ) OR $table->advancedSearch ) ) OR ( !empty( $table->filters ) ) OR ( $table->pages > 1 ) ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		
CONTENT;

if ( $table->canModerate() AND $table->showFilters ):
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

								
CONTENT;

if ( $filter ):
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

else:
$return .= <<<CONTENT

									<li class="ipsMenu_sep"><hr></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
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
$return .= htmlspecialchars( $table->getSortDirection( $k ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => $table->getSortDirection( $k ) ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow">
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
' rel="nofollow">
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
' rel="nofollow">
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
' rel="nofollow">
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
' rel="nofollow">
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
				<p class='ipsType_large ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				
CONTENT;

if ( method_exists( $table, 'container' ) AND $table->container() !== NULL ):
$return .= <<<CONTENT

					
CONTENT;

if ( $table->container()->can('add') ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $table->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_medium'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_row', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					
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

if ( method_exists( $table, 'customActions' ) ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( $table->customActions() as $action ):
$return .= <<<CONTENT

								
CONTENT;

if ( \is_array( $action['action'] )  ):
$return .= <<<CONTENT

									<optgroup label="
CONTENT;

$val = "{$action['grouplabel']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='
CONTENT;
$return .= htmlspecialchars( $action['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='
CONTENT;
$return .= htmlspecialchars( $action['groupaction'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
										
CONTENT;

foreach ( $action['action'] as $_action ):
$return .= <<<CONTENT

											<option value='
CONTENT;
$return .= htmlspecialchars( $_action['action'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$_action['label']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
										
CONTENT;

endforeach;
$return .= <<<CONTENT

									</optgroup>
								
CONTENT;

else:
$return .= <<<CONTENT

									<option value='
CONTENT;
$return .= htmlspecialchars( $action['action'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-icon='
CONTENT;
$return .= htmlspecialchars( $action['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$action['label']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								
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

						
CONTENT;

if ( $table instanceof \IPS\core\Followed\Table ):
$return .= <<<CONTENT

							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'adjust_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='bell' data-action='adjust_follow'>
								<option value='follow_immediate'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_immediate_prefixed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_daily'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_daily_prefixed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_weekly'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_weekly_prefixed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_none'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_type_none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							</optgroup>
							<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'adjust_follow_privacy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='ban' data-action='adjust_follow_privacy'>
								<option value='follow_public'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_public', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
								<option value='follow_anonymous'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_anonymous', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
							</optgroup>
							<option value='unfollow' data-icon='times'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unfollow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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