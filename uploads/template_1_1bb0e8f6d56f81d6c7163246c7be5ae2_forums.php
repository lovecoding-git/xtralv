<?php
namespace IPS\Theme\Cache;
class class_forums_front_forums extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function clubForums(  ) {
		$return = '';
		$return .= <<<CONTENT


<div class="ipsPageHeader ipsClearfix">
	<header class='ipsSpacer_bottom'>
		<h1 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_node_forums', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	</header>
</div>

<div class='ipsList_reset cForumList ipsBox ipsSpacer_bottom' data-controller='forums.front.forum.forumList' data-baseURL=''>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subforums_header_category', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	
CONTENT;

if ( \IPS\forums\Forum::getMemberView() === 'grid' ):
$return .= <<<CONTENT

		<div class='ipsAreaBackground ipsPad' data-role="forums">
			<div class='ipsGrid ipsGrid_collapsePhone' data-ipsGrid data-ipsGrid-minItemSize='300' data-ipsGrid-maxItemSize='400' data-ipsGrid-equalHeights='row'>
				
CONTENT;

foreach ( \IPS\forums\Forum::clubNodes() as $childforum ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumGridItem( $childforum );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<ol class="ipsDataList ipsDataList_zebra ipsDataList_large ipsAreaBackground_reset">
			
CONTENT;

foreach ( \IPS\forums\Forum::clubNodes() as $childforum ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $childforum, TRUE );
$return .= <<<CONTENT

			
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

	function forumButtons( $forum ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $forum->can('add') ):
$return .= <<<CONTENT

	<li class='ipsToolList_primaryAction'>
		
CONTENT;

if ( $forum->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

			<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' rel='nofollow noindex'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_a_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

else:
$return .= <<<CONTENT

			<a class="ipsButton ipsButton_medium ipsButton_important ipsButton_fullWidth" href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start_new_topic_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' rel='nofollow noindex'>
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

if ( $forum->sub_can_post ):
$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "forums" )->viewChangeList( $forum );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function forumDisplay( $forum, $table ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $club = $forum->club() ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->clubs and \IPS\Settings::i()->clubs_header == 'full' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "clubs", "core" )->header( $club, $forum );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<div id='elClubContainer'>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( !\IPS\Request::i()->advancedSearchForm ):
$return .= <<<CONTENT

	
CONTENT;

$followerCount = \IPS\forums\Topic::containerFollowerCount( $forum );
$return .= <<<CONTENT

	<div class="ipsPageHeader 
CONTENT;

if ( $forum->feature_color ):
$return .= <<<CONTENT
ipsPageHeader--hasFeatureColor
CONTENT;

endif;
$return .= <<<CONTENT
 ipsBox ipsResponsive_pull ipsPadding ipsClearfix" 
CONTENT;

if ( $forum->feature_color ):
$return .= <<<CONTENT
style="border-color: 
CONTENT;
$return .= htmlspecialchars( $forum->feature_color, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		<header>
			<h1 class="ipsType_pageTitle">
CONTENT;
$return .= htmlspecialchars( $forum->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
			
CONTENT;

if ( $forum->description ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( $forum->description, array('ipsType_normal') );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $forum->show_rules == 1 ):
$return .= <<<CONTENT

				<hr class='ipsHr'>
				<a href="#elForumRules" class='ipsJS_show ipsType_normal' data-ipsDialog data-ipsDialog-title="
CONTENT;

$val = "forums_forum_{$forum->id}_rulestitle"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-content="#elForumRules">
CONTENT;

$val = "forums_forum_{$forum->id}_rulestitle"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				<div id='elForumRules' class='ipsAreaBackground_light ipsPad ipsJS_hide'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('forums_forum_' . $forum->id . '_rules'), array('ipsType_medium') );
$return .= <<<CONTENT

				</div>
			
CONTENT;

elseif ( $forum->show_rules == 2 ):
$return .= <<<CONTENT

				<hr class='ipsHr'>
				<strong class='ipsType_normal'>
CONTENT;

$val = "forums_forum_{$forum->id}_rulestitle"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('forums_forum_' . $forum->id . '_rules'), array('ipsType_normal', 'ipsSpacer_top') );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $forum->sub_can_post and !$forum->password ):
$return .= <<<CONTENT

				<hr class='ipsHr ipsResponsive_hidePhone' />
				<div class='ipsClearfix ipsResponsive_hidePhone'>
					<div class='ipsPos_right'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums','forum', $forum->_id, $followerCount );
$return .= <<<CONTENT
</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</header>
	</div>
	
	
CONTENT;

if ( $forum->children() ):
$return .= <<<CONTENT

		<div class='ipsList_reset cForumList ipsBox ipsSpacer_bottom ipsResponsive_pull' data-controller='core.global.core.table, forums.front.forum.forumList' data-baseURL=''>
			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( $forum->sub_can_post ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subforums_header', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'subforums_header_category', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
			
CONTENT;

if ( \IPS\forums\Forum::getMemberView() === 'grid' ):
$return .= <<<CONTENT

				<div class='ipsPadding' data-role="forums">
					<div class='ipsForumGrid'>
						
CONTENT;

foreach ( $forum->children( 'view' ) as $childforum ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumGridItem( $childforum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<ol class="ipsDataList ipsDataList_zebra ipsDataList_large ipsAreaBackground_reset">
					
CONTENT;

foreach ( $forum->children( 'view' ) as $childforum ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "index", "forums" )->forumRow( $childforum, TRUE );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
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

<div data-controller='forums.front.forum.forumPage'>
	<ul class="ipsToolList ipsToolList_horizontal ipsToolList_horizontal--flex ipsClearfix ipsSpacer_both">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->forumButtons( $forum );
$return .= <<<CONTENT

	</ul>
	{$table}
</div>

CONTENT;

if ( \IPS\Member::loggedIn()->member_id || !\IPS\Request::i()->advancedSearchForm && $forum->sub_can_post and !$forum->password ):
$return .= <<<CONTENT

	<div class='ipsBox ipsPadding ipsResponsive_pull ipsResponsive_showPhone ipsMargin_vertical'>
		<div class='ipsGap_row:3'>
            
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			<div>
				<a href="
CONTENT;
$return .= htmlspecialchars( $forum->url()->setQueryString( array( 'do' => 'markRead', 'fromForum' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_link ipsButton_fullWidth'><i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
            
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !\IPS\Request::i()->advancedSearchForm && $forum->sub_can_post and !$forum->password ):
$return .= <<<CONTENT

				<div>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->follow( 'forums','forum', $forum->_id, $followerCount );
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( $forum->club() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function forumHome( $forum, $featuredTopic, $popularQuestions, $newQuestions ) {
		$return = '';
		$return .= <<<CONTENT

<br>

CONTENT;

if ( $featuredTopic ):
$return .= <<<CONTENT

	<div class="ipsPad">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<br><br>
		<div class="ipsPhotoPanel ipsPhotoPanel_small ipsClearfix">
			<img src='
CONTENT;

$return .= htmlspecialchars( $featuredTopic->author()->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsUserPhoto ipsUserPhoto_small ipsPos_left">
			<div>
				<h3 class="ipsType_reset ipsType_large">
					<a href="
CONTENT;
$return .= htmlspecialchars( $featuredTopic->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $featuredTopic->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</h3>
				<p class="ipsType_reset ipsType_normal ipsType_light">
CONTENT;

$htmlsprintf = array($featuredTopic->author()->link( NULL, NULL, $featuredTopic->isAnonymous() ), \IPS\DateTime::ts( $featuredTopic->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
				<br>
				<div class="ipsType_normal" data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="5 lines">
					
CONTENT;
$return .= htmlspecialchars( $featuredTopic->truncated(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</div>
			</div>
		</div>
	</div>
	<hr class="ipsHr">

CONTENT;

endif;
$return .= <<<CONTENT

<div class="ipsGrid ipsGrid_collapsePhone">
	<div class="ipsGrid_span6 ipsPad">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'most_popular_questions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class="ipsType_reset ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'from_the_past_30_days', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<ol class="ipsDataList ipsDataList_reducedSpacing" id="elTopicList">
			
CONTENT;

foreach ( $popularQuestions as $question ):
$return .= <<<CONTENT

				<li class="ipsDataItem 
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
					<div class='ipsDataItem_generic ipsDataItem_size1'>
						<img src="
CONTENT;
$return .= htmlspecialchars( $question->author()->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsUserPhoto ipsUserPhoto_mini'>
					</div>
					<div class="ipsDataItem_main">
						<h4 class="ipsDataItem_title">
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
 <i class="fa fa-circle cTopicIcon"></i> 
CONTENT;

endif;
$return .= <<<CONTENT
<a href="
CONTENT;
$return .= htmlspecialchars( $question->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $question->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
						<ul class="ipsDataItem_meta ipsList_inline ipsType_light">
							
CONTENT;

if ( $question->bestAnswer() ):
$return .= <<<CONTENT

								<li>
									
CONTENT;

$htmlsprintf = array($question->bestAnswer()->author()->link( NULL, NULL, $question->bestAnswer()->isAnonymous() ), \IPS\DateTime::ts( $question->bestAnswer()->post_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'best_answer_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	</div>
	<div class="ipsGrid_span6 ipsPad">
		<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class="ipsType_reset ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'awaiting_an_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<ol class="ipsDataList ipsDataList_reducedSpacing" id="elTopicList">
			
CONTENT;

foreach ( $newQuestions as $question ):
$return .= <<<CONTENT

				<li class="ipsDataItem 
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
">
					<div class='ipsDataItem_generic ipsDataItem_size1'>
						<img src="
CONTENT;
$return .= htmlspecialchars( $question->author()->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsUserPhoto ipsUserPhoto_mini'>
					</div>
					<div class="ipsDataItem_main">
						<h4 class="ipsDataItem_title">
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
 <i class="fa fa-circle cTopicIcon"></i> 
CONTENT;

endif;
$return .= <<<CONTENT
<a href="
CONTENT;
$return .= htmlspecialchars( $question->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $question->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
						<ul class="ipsDataItem_meta ipsList_inline ipsType_light">
							<li>
								
CONTENT;

$htmlsprintf = array($question->author()->link( NULL, NULL, $question->isAnonymous() ), \IPS\DateTime::ts( $question->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							</li>
						</ul>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	</div>
</div>
CONTENT;

		return $return;
}

	function forumPasswordPopup( $forum, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" method='post' action='
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsValidation novalidate>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT


	<div class='ipsPad'>
		<p class='ipsType_normal ipsType_reset'>
			
CONTENT;

$sprintf = array($forum->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enter_forum_password_1', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

		</p>

		<br>
		<ul class='ipsList_reset'>
			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Text ):
$return .= <<<CONTENT

						<li class="ipsFieldRow ipsFieldRow_primary ipsFieldRow_noLabel ipsFieldRow_fullWidth 
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT
ipsFieldRow_error
CONTENT;

endif;
$return .= <<<CONTENT
">
							<input type="
CONTENT;
$return .= htmlspecialchars( $input->formType, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" required placeholder="
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name='
CONTENT;
$return .= htmlspecialchars( $input->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT

								<br>
								<span class="ipsType_warning">
CONTENT;

$val = "{$input->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
							
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

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
	<div class='ipsPad ipsAreaBackground ipsType_right'>
		<button type="submit" class="ipsButton ipsButton_primary ipsButton_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enter_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
	</div>
</form>
CONTENT;

		return $return;
}

	function forumSelector( $form ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPad'>
	{$form}
</div>
CONTENT;

		return $return;
}

	function forumTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox ipsResponsive_pull' data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-tableID='topics' 
CONTENT;

if ( $table->dummyLoading ):
$return .= <<<CONTENT
data-dummyLoading
CONTENT;

endif;
$return .= <<<CONTENT
 data-controller='core.global.core.table
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => $table->getSortDirection( $col ) ) )->setPage('page', 1), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
' rel="nofollow" data-ipsDialog data-ipsDialog-title='
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => '', 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage('page', 1), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage('page', 1), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			<ul class="ipsButtonRow ipsPos_right ipsClearfix ipsResponsive_hidePhone">
				<li>
					<a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'do' => 'markRead', 'fromForum' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='markForumRead'><i class="fa fa-check"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_forum_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT



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

			<ol class='
CONTENT;

if ( \IPS\forums\Forum::getMemberListView() == 'snippet' ):
$return .= <<<CONTENT
ipsSnippetList
CONTENT;

else:
$return .= <<<CONTENT
ipsClear
CONTENT;

endif;
$return .= <<<CONTENT
 ipsDataList cForumTopicTable 
CONTENT;

if ( $table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT
cForumQuestions
CONTENT;

endif;
$return .= <<<CONTENT
 
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

			<div class='ipsType_center ipsPadding'>
				<p class='ipsType_reset ipsType_large ipsMargin_bottom'>
CONTENT;

if ( $table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_questions_in_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_topics_in_forum', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>

				
CONTENT;

if ( $table->container()->can('add') ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $table->container()->url()->setQueryString( 'do', 'add' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="nofollow" class='ipsButton ipsButton_primary ipsButton_medium'>
						
CONTENT;

if ( $table->container()->forums_bitoptions['bw_enable_answers'] ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_question', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit_first_topic', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				
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

	function popularQuestionRow( $question, $forum ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$iposted = $forum->contentPostedIn( null, array( $question->tid ) );
$return .= <<<CONTENT


CONTENT;

if ( !$question->mapped('moved_to') ):
$return .= <<<CONTENT

	<li class="ipsDataItem cForumQuestion 
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $question->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">
		<div class='ipsDataItem_icon'>
			
CONTENT;

if ( $question->topic_answered_pid ):
$return .= <<<CONTENT

				<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answered', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator' data-ipsTooltip>
					<i class='fa fa-check'></i>
				</span>
			
CONTENT;

else:
$return .= <<<CONTENT

				<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'awaiting_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator cBestAnswerIndicator_off' data-ipsTooltip>
					<i class='fa fa-question'></i>
				</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title ipsType_break ipsContained_container'>
				<span class='ipsType_break ipsContained'>
					
CONTENT;

if ( $question->locked() ):
$return .= <<<CONTENT

						<i class='fa fa-lock' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $question->unread() ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $question->url( 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
							<span class='ipsItemStatus'><i class="fa 
CONTENT;

if ( \in_array( $question->tid, $iposted ) ):
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
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( \in_array( $question->tid, $iposted ) ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $question->mapped('pinned') || $question->mapped('featured') || $question->hidden() === -1 || $question->hidden() === 1 ):
$return .= <<<CONTENT

					<span>
						
CONTENT;

if ( $question->hidden() === -1 ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $question->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span>
						
CONTENT;

elseif ( $question->hidden() === 1 ):
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

if ( $question->mapped('pinned') ):
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

if ( $question->mapped('featured') ):
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

if ( $question->prefix() ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( $question->prefix( TRUE ), $question->prefix() );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $question->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

if ( $question->mapped('title') ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $question->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
			<div class='ipsDataItem_meta'>
				<p class='ipsType_reset ipsType_normal ipsType_light'>
					
CONTENT;

$htmlsprintf = array($question->author()->link( NULL, NULL, $question->isAnonymous() ), \IPS\DateTime::ts( $question->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

				</p>
			</div>
			
CONTENT;

if ( \count( $question->tags() ) ):
$return .= <<<CONTENT

				<p>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $question->tags() );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
			<span>
CONTENT;

if ( $question->question_rating ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $question->question_rating, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
</span>
			<span class='ipsType_light'>
CONTENT;

$pluralize = array( $question->question_rating ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
		</div>
		<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
			
CONTENT;

foreach ( $question->stats(FALSE) AS $k => $v ):
$return .= <<<CONTENT

				
CONTENT;

if ( $k == 'forums_comments' OR $k == 'answers_no_number' ):
$return .= <<<CONTENT

					<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
					<span class='ipsType_light'>
CONTENT;

$pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answers_no_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
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

	function qaForum( $table, $popularQuestions, $newQuestions, $featuredTopic, $forum ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $popularQuestions && $newQuestions ):
$return .= <<<CONTENT

	<div class='ipsBox ipsSpacer_bottom ipsSpacer_double'>
		<h2 class='ipsType_sectionTitle ipsType_reset ipsHide'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'explore_questions_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class="ipsTabs ipsClearfix" id="elQuestionsTabs" data-ipsTabBar data-ipsTabBar-contentarea="#elQuestionsTabsContent">
			<a href="#elQuestionsTabs" data-action="expandTabs"><i class="fa fa-caret-down"></i></a>
			<ul role="tablist" class="ipsList_reset">
				<li>
					<a href="#elPopularQuestions" role="tab" id="elPopularQuestions" class="ipsTabs_item 
CONTENT;

if ( \count( $popularQuestions ) || !\count( $popularQuestions ) && !\count( $newQuestions ) ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( \count( $popularQuestions ) || !\count( $popularQuestions ) && !\count( $newQuestions ) ):
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_questions_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>				
				<li>
					<a href="#elNewQuestions" id="elNewQuestions" role="tab" class="ipsTabs_item 
CONTENT;

if ( !\count( $popularQuestions ) && \count( $newQuestions ) ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( !\count( $popularQuestions ) && \count( $newQuestions ) ):
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

if ( \IPS\Settings::i()->forums_new_questions ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_best', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				</li>
			</ul>
		</div>
		<section id='elQuestionsTabsContent'>
			<div id="ipsTabs_elQuestionsTabs_elPopularQuestions_panel" class="ipsTabs_panel" aria-labelledby="elPopularQuestions">
				
CONTENT;

if ( \count( $popularQuestions ) ):
$return .= <<<CONTENT

					<ol class='ipsDataList ipsDataList_zebra ipsClear cForumTopicTable cForumQuestions cTopicList' id='elTable_popularQuestions' data-role="tableRows">
						
CONTENT;

foreach ( $popularQuestions as $question ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsType_center ipsType_light ipsPad'>
						<p class='ipsType_reset ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_popular_questions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div id="ipsTabs_elQuestionsTabs_elNewQuestions_panel" class="ipsTabs_panel" aria-labelledby="elNewQuestions">
				
CONTENT;

if ( \count( $newQuestions ) ):
$return .= <<<CONTENT

					<ol class='ipsDataList ipsDataList_zebra ipsClear cForumTopicTable cForumQuestions cTopicList' id='elTable_newQuestions' data-role="tableRows">
						
CONTENT;

foreach ( $newQuestions as $question ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ol>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class='ipsType_center ipsType_light ipsPad'>
						<p class='ipsType_reset ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_questions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</section>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( $popularQuestions ):
$return .= <<<CONTENT

		<section class='ipsBox ipsSpacer_bottom ipsSpacer_double'>
			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'popular_questions_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			
CONTENT;

if ( \count( $popularQuestions ) ):
$return .= <<<CONTENT

				<ol class='ipsDataList ipsDataList_readStatus ipsClear cForumTopicTable' id='elTable_' data-role="tableRows">
					
CONTENT;

foreach ( $popularQuestions as $question ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsType_center ipsType_light ipsPad'>
					<p class='ipsType_reset ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_popular_questions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</section>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $newQuestions ):
$return .= <<<CONTENT

		<section class='ipsBox ipsSpacer_bottom ipsSpacer_double'>
			<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( \IPS\Settings::i()->forums_new_questions ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'new_questions_title_no_best', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
			
CONTENT;

if ( \count( $newQuestions ) ):
$return .= <<<CONTENT

			<ol class='ipsDataList ipsDataList_readStatus ipsClear cForumTopicTable' id='elTable_' data-role="tableRows">
				
CONTENT;

foreach ( $newQuestions as $question ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forums", \IPS\Request::i()->app )->popularQuestionRow( $question, $forum );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ol>
			
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsType_center ipsType_light ipsPad'>
				<p class='ipsType_reset ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_new_questions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</section>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

{$table}
CONTENT;

		return $return;
}

	function questionRow( $table, $headers, $rows ) {
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

$rowCount=0;
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

if ( $movedTo = $row->movedTo() ):
$return .= <<<CONTENT

				<li class="ipsDataItem 
CONTENT;

if ( \IPS\forums\Forum::getMemberListView() == 'snippet' ):
$return .= <<<CONTENT
ipsTopicSnippet ipsQuestionSnippet
CONTENT;

endif;
$return .= <<<CONTENT
">
					<div class='ipsDataItem_icon ipsType_center ipsType_noBreak'>
						<i class="fa fa-arrow-left ipsType_large"></i>
					</div>
					<div class='ipsDataItem_main'>
						<h4 class='ipsDataItem_title ipsType_break'>
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

$sprintf = array($movedTo->url(), $movedTo->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_merged_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
								
CONTENT;

else:
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
CONTENT;

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_moved_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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

$sprintf = array($movedTo->container()->url(), $movedTo->container()->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'question_moved_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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

			<li class="ipsDataItem 
CONTENT;

if ( \IPS\forums\Forum::getMemberListView() == 'snippet' ):
$return .= <<<CONTENT
ipsTopicSnippet ipsQuestionSnippet
CONTENT;

endif;
$return .= <<<CONTENT
 
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
 cForumQuestion" data-rowID='
CONTENT;
$return .= htmlspecialchars( $row->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<div class='ipsDataItem_icon'>
					
CONTENT;

if ( $row->topic_answered_pid ):
$return .= <<<CONTENT

						<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answered', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator' data-ipsTooltip>
							<i class='fa fa-check'></i>
						</span>
					
CONTENT;

else:
$return .= <<<CONTENT

						<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'awaiting_answer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='cBestAnswerIndicator cBestAnswerIndicator_off' data-ipsTooltip>
							<i class='fa fa-question'></i>
						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main'>
					<h4 class='ipsDataItem_title ipsContained_container'>
						<span class='ipsType_break ipsContained'>
							
CONTENT;

if ( $row->locked() ):
$return .= <<<CONTENT

								<span><i class='fa fa-lock' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_locked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'></i></span>
							
CONTENT;

endif;
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

									<span><span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span></span>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
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

							
							<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
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

								</span>
							</a>
						</span>
					</h4>
					
CONTENT;

if ( \IPS\forums\Forum::getMemberListView() == 'snippet' ):
$return .= <<<CONTENT

						<div class='ipsTopicSnippet__snippet ipsType_normal ipsType_blendLinks ipsType_break'>
							<p>
CONTENT;
$return .= htmlspecialchars( $row->firstComment->snippet(680), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>		
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div class='ipsDataItem_meta'>
						<p class='ipsDataItem_meta ipsType_reset ipsType_light ipsType_blendLinks'>
							<span>
								
CONTENT;

$htmlsprintf = array($row->author()->link( NULL, NULL, $row->isAnonymous() ), \IPS\DateTime::ts( $row->start_date )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ask_byline_itemprop', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

							</span>
							
CONTENT;

if ( \IPS\Request::i()->controller != 'forums' ):
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

						</p>
						
CONTENT;

if ( \count( $row->tags() ) ):
$return .= <<<CONTENT

							<div>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $row->tags() );
$return .= <<<CONTENT
</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</div>
				<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
					<span>
CONTENT;

if ( $row->question_rating ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $row->question_rating, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
</span>
					<span class='ipsType_light'>
CONTENT;

$pluralize = array( $row->question_rating ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'votes_no_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
				</div>
				<div class='ipsDataItem_generic ipsDataItem_size2 ipsType_center cForumQuestion_stat'>
					
CONTENT;

foreach ( $row->stats(FALSE) AS $k => $v ):
$return .= <<<CONTENT

						
CONTENT;

if ( $k == 'forums_comments' OR $k == 'answers_no_number' ):
$return .= <<<CONTENT

							<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $v );
$return .= <<<CONTENT
</span>
							<span class='ipsType_light'>
								
CONTENT;

$pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'answers_no_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\forums\Topic::modPermission( 'unhide', NULL, $row->container() ) AND $unapprovedComments = $row->mapped('unapproved_comments') ):
$return .= <<<CONTENT

									&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString( 'queued_posts', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_warning ipsType_small ipsResponsive_noFloat' data-ipsTooltip title='
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

							</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
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

	function topicHover( $topic, $overviews ) {
		$return = '';
		$return .= <<<CONTENT


<div class='cTopicHovercard' data-controller='forums.front.forum.hovercard' data-topicID='
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	
CONTENT;

if ( \count( $overviews ) > 1 ):
$return .= <<<CONTENT

		<div class="ipsTabs ipsTabs_small ipsTabs_container ipsClearfix" id="elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTabBar data-ipsTabBar-contentarea="#elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_content">
			<a href="#elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="expandTabs"><i class="fa fa-caret-down"></i></a>
			<ul role="tablist">
				
CONTENT;

foreach ( $overviews as $tabID => $tabData ):
$return .= <<<CONTENT

					<li>
						<a href="#ipsTabs_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $tabID, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" id="elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $tabID, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsTabs_item ipsType_center" role="tab" aria-selected="
CONTENT;

if ( $tabID == 'firstPost' ):
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

$val = "{$tabData[0]}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div id='elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_content' class='ipsTabs_panels ipsTabs_contained cTopicHovercard_container ipsScrollbar'>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsPad cTopicHovercard_container ipsScrollbar'>
	
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

foreach ( $overviews as $tabID => $tabData ):
$return .= <<<CONTENT

			
CONTENT;

if ( \count( $overviews ) > 1 ):
$return .= <<<CONTENT

				<div id='ipsTabs_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_elTopic_
CONTENT;
$return .= htmlspecialchars( $topic->tid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $tabID, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class='ipsTabs_panel'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $tabData[1]->author(), 'tiny' );
$return .= <<<CONTENT

					<div class='ipsType_small'>
						<strong>
CONTENT;
$return .= htmlspecialchars( $tabData[1]->author()->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
						<p class='ipsType_reset ipsType_light ipsType_blendLinks'>
							
CONTENT;

$val = ( $tabData[1]->mapped('date') instanceof \IPS\DateTime ) ? $tabData[1]->mapped('date') : \IPS\DateTime::ts( $tabData[1]->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

							
CONTENT;

if ( $tabData[1]->item()->unread()  ):
$return .= <<<CONTENT

								&middot; <a href='
CONTENT;
$return .= htmlspecialchars( $tabData[1]->item()->url('markRead')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_topic_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='markTopicRead'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_topic_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $tabData[1]->canReportOrRevoke() === TRUE ):
$return .= <<<CONTENT

								&middot; <a href='
CONTENT;
$return .= htmlspecialchars( $tabData[1]->url('report'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><span class='ipsResponsive_showPhone ipsResponsive_inline'><i class='fa fa-flag'></i></span><span class='ipsResponsive_hidePhone ipsResponsive_inline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</p>
					</div>
				</div>
				<hr class='ipsHr'>

				<div class='ipsType_richText ipsType_small' data-controller='core.front.core.lightboxedImages'>
					{$tabData[1]->content()}
				</div>
			
CONTENT;

if ( \count( $overviews ) > 1 ):
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function topicRow( $table, $headers, $rows ) {
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

$rowCount=0;
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

$sprintf = array($movedTo->url( 'getPrefComment' ), $movedTo->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_merged_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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

if ( $row->groupsPosted ):
$return .= <<<CONTENT
ipsDataItem_highlighted
CONTENT;

endif;
$return .= <<<CONTENT
 
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
				
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

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
						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( \in_array( $row->$idField, $table->contentPostedIn ) ):
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
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsDataItem_main'>
					
CONTENT;

if ( $row->groupsPosted ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->groupPostedBadges( $row->groupsPosted, 'topic_posted_in_groups', 'ipsResponsive_hidePhone ipsMargin_left ipsPos_right' );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					<h4 class='ipsDataItem_title ipsContained_container'>
						
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

if ( $row->isSolved() ):
$return .= <<<CONTENT

							<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_solved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></span></span>
						
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

elseif ( $row->canToggleItemModeration() and $row->itemModerationEnabled() ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moderation_enabled', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-user-times'></i></span></span>
							
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
$return .= htmlspecialchars( $row->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
						</span>
						
CONTENT;

if ( $row->commentPageCount() > 1 ):
$return .= <<<CONTENT

							{$row->commentPagination( array(), 'miniPagination' )}
						
CONTENT;

endif;
$return .= <<<CONTENT

					</h4>
					<div class='ipsDataItem_meta ipsType_reset ipsType_light ipsType_blendLinks'>
						<span>
							
CONTENT;

$htmlsprintf = array($row->author()->link( NULL, NULL, $row->isAnonymous() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_itemprop', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

						</span>
CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html(FALSE);
$return .= <<<CONTENT

						
CONTENT;

if ( !\in_array( \IPS\Dispatcher::i()->controller, array( 'forums', 'index' ) ) ):
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

if ( $row->groupsPosted ):
$return .= <<<CONTENT

						<li class='ipsResponsive_showPhone ipsMargin:none'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->groupPostedBadges( $row->groupsPosted, 'topic_posted_in_groups' );
$return .= <<<CONTENT

						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
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

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $v );
$return .= <<<CONTENT
</span>
							<span class='ipsDataItem_stats_type'>
CONTENT;

$val = "{$k}"; $pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize, 'format' => 'short' ) );
$return .= <<<CONTENT
</span>
							
CONTENT;

if ( ( $k == 'forums_comments' OR $k == 'answers_no_number' ) && \IPS\forums\Topic::modPermission( 'unhide', NULL, $row->container() ) AND $unapprovedComments = $row->mapped('unapproved_comments') ):
$return .= <<<CONTENT

								&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $row->url()->setQueryString( 'queued_posts', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_warning ipsType_small' data-ipsTooltip title='
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

							
CONTENT;

if ( $row->mapped('last_comment_anon') ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $row->author(), NULL, NULL, TRUE );
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								{$row->lastCommenter()->link()}
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							{$row->author()->link( NULL, NULL, $row->isAnonymous() )}
						
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

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function topicRowSnippet( $table, $headers, $rows ) {
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

$rowCount=0;
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


				<li class="ipsDataItem ipsTopicSnippet">

					<div class='ipsFlex ipsFlex-ai:center'>

						<div class='ipsTopicSnippet__avatar ipsFlex-flex:00'>
							<i class="fa fa-arrow-left ipsType_large"></i>
						</div>

						<div class='ipsFlex-flex:11'>
							<h4 class='ipsDataItem_title'>
								<span>
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

$sprintf = array($movedTo->url( 'getPrefComment' ), $movedTo->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_merged_to', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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

							<div class='ipsFlex-as:center'>
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


					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			<li class="ipsDataItem ipsTopicSnippet 
CONTENT;

if ( $row->groupsPosted ):
$return .= <<<CONTENT
ipsDataItem_highlighted
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

else:
$return .= <<<CONTENT
ipsDataItem_read
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

				<div class='ipsTopicSnippet__top ipsFlex ipsFlex-ai:start'>
					<!-- Topic starter avatar -->
					<div class='ipsTopicSnippet__avatar ipsFlex-flex:00'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->author(), 'small' );
$return .= <<<CONTENT

					</div>
					<div class='ipsTopicSnippet__top-align ipsFlex-flex:11 ipsFlex ipsFlex-ai:start ipsFlex-jc:between'>
						<div class='ipsTopicSnippet__top-main ipsFlex-flex:11 ipsFlex ipsFlex-ai:start ipsFlex-jc:between sm:ipsFlex-fd:column'>
							<div class='ipsTopicSnippet__title ipsFlex-flex:11'>
								<h4 class='ipsDataItem_title'>

									
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

endif;
$return .= <<<CONTENT
	
									
CONTENT;

if ( $row->isSolved() ):
$return .= <<<CONTENT

										<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_solved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></span></span>
									
CONTENT;

endif;
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

elseif ( $row->canToggleItemModeration() and $row->itemModerationEnabled() ):
$return .= <<<CONTENT

										<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_moderation_enabled', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-user-times'></i></span></span>
									
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

									
									<!-- Prefix -->				
									
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
					

									<!-- Topic title -->
									<span class='ipsType_break'>

										<!-- Unread/participated icon -->
										
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

											<span>
												
CONTENT;

if ( $row->unread() ):
$return .= <<<CONTENT

													<a href="
CONTENT;
$return .= htmlspecialchars( $row->url( 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
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
												
CONTENT;

else:
$return .= <<<CONTENT

													
CONTENT;

if ( \in_array( $row->$idField, $table->contentPostedIn ) ):
$return .= <<<CONTENT

														<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
													
CONTENT;

endif;
$return .= <<<CONTENT

												
CONTENT;

endif;
$return .= <<<CONTENT

											</span>
										
CONTENT;

endif;
$return .= <<<CONTENT


										<a href='
CONTENT;
$return .= htmlspecialchars( $row->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
									</span>
									
CONTENT;

if ( $row->commentPageCount() > 1 ):
$return .= <<<CONTENT

										{$row->commentPagination( array(), 'miniPagination' )}
									
CONTENT;

endif;
$return .= <<<CONTENT

								</h4>

								<!-- Author -->
								<div class='ipsTopicSnippet__date ipsType_light ipsType_blendLinks'>
CONTENT;

$val = ( $row->mapped('date') instanceof \IPS\DateTime ) ? $row->mapped('date') : \IPS\DateTime::ts( $row->mapped('date') );$return .= $val->html(FALSE);
$return .= <<<CONTENT
 
CONTENT;

$htmlsprintf = array($row->author()->link( NULL, NULL, $row->isAnonymous() )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
 	
CONTENT;

if ( !\in_array( \IPS\Dispatcher::i()->controller, array( 'forums', 'index' ) ) ):
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

							<div class='ipsTopicSnippet__stats-align ipsFlex-flex:00 ipsFlex ipsFlex-ai:center'>
								
								<ul class='ipsTopicSnippet__stats ipsFlex ipsFlex-ai:center ipsFlex-fw:wrap ipsList_reset'>
									
CONTENT;

if ( $row->groupsPosted ):
$return .= <<<CONTENT

										<li>
											
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->groupPostedBadges( $row->groupsPosted, 'topic_posted_in_groups' );
$return .= <<<CONTENT

										</li>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $row->followerCount ):
$return .= <<<CONTENT

									<li class='ipsType_light'>
										<span class='ipsDataItem_stats_type'>
											<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=followers&follow_app=forums&follow_area=topic&follow_id={$row->tid}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' rel="nofollow" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks ipsType_noUnderline' data-ipsTooltip data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'who_follows_this', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( $row->followerCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_follower_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
										</span>
									</li>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
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

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $v );
$return .= <<<CONTENT
</span>
											<span class='ipsDataItem_stats_type'>
CONTENT;

$val = "{$k}"; $pluralize = array( $v ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize, 'format' => 'short' ) );
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

								</ul>

							</div>

						</div>

						
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

							<div class='ipsTopicSnippet__mod'>
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


					</div>

				</div>

				<!-- Topic snippet -->
				
CONTENT;

if ( isset($row->firstComment) ):
$return .= <<<CONTENT

				<div class='ipsTopicSnippet__snippet ipsType_normal ipsType_blendLinks ipsType_break'>
					<p>
CONTENT;
$return .= htmlspecialchars( $row->firstComment->snippet(680), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
				</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<!-- Bottom -->
				<div class='ipsTopicSnippet__bottom ipsFlex ipsFlex-jc:between ipsFlex-ai:start '>

					<!-- Last reply author -->
					<div class='ipsTopicSnippet__last ipsFlex ipsFlex-ai:center'>
						<!-- Avatar -->
						<span class='ipsTopicSnippet__last-avatar'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $row->lastCommenter(), 'tiny' );
$return .= <<<CONTENT
</span>
						<!-- Username and date -->
						<div class='ipsTopicSnippet__last-text ipsType_light ipsType_blendLinks'>
							
CONTENT;

$htmlsprintf = array($row->lastCommenter()->link(), $row->url( 'getLastComment' ), \IPS\DateTime::ts( $row->mapped('last_comment') )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'topic_snippet_last_reply', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

						</div>
					</div>

					<div class='ipsTopicSnippet__meta ipsFlex ipsFlex-ai:center ipsFlex-fw:wrap'>

						
CONTENT;

if ( $row->locked() ):
$return .= <<<CONTENT

							
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

if ( \count( $row->tags() ) ):
$return .= <<<CONTENT

							<div class='ipsTopicSnippet-meta__tags'>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( $row->tags(), true );
$return .= <<<CONTENT

							</div>
						
CONTENT;

endif;
$return .= <<<CONTENT


						<!-- Reactions -->
						<div class='ipsTopicSnippet__reactions'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionOverview( $row, NULL, NULL );
$return .= <<<CONTENT

						</div>

					</div>
				</div>
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