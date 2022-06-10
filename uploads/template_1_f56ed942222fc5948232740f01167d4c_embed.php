<?php
namespace IPS\Theme\Cache;
class class_core_front_embed extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function embedHeader( $content, $lang, $date, $url ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsRichEmbed_header ipsAreaBackground_light ipsClearfix'>
	<a href='
CONTENT;

if ( $url ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $content->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsRichEmbed_openItem'><i class='fa fa-external-link-square'></i></a>
	<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsType_blendLinks'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $content->author(), 'tiny', $content->warningRef() );
$return .= <<<CONTENT

		<div>
			<p class='ipsRichEmbed_title ipsType_reset ipsTruncate ipsTruncate_line'>
				<a href='
CONTENT;

if ( $url ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $content->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $lang, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
			</p>
			<p class='ipsRichEmbed_author ipsType_reset ipsType_light ipsTruncate ipsTruncate_line'>
				<a href='
CONTENT;

if ( $url ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $content->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$val = ( $date instanceof \IPS\DateTime ) ? $date : \IPS\DateTime::ts( $date );$return .= $val->html();
$return .= <<<CONTENT
</a>
			</p>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function embedItemStats( $content, $commentsEnabled=TRUE ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$reactionItem = $content;
$return .= <<<CONTENT


CONTENT;

if ( $content::$firstCommentRequired ):
$return .= <<<CONTENT

	
CONTENT;

$reactionItem = $content->firstComment();
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( ( $content instanceof \IPS\Content\Ratings and $content->averageRating() ) || ( isset( $content::$reviewClass ) AND $content->averageReviewRating() ) || $content::$commentClass || ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $reactionItem, 'IPS\Content\Reactable' ) and \count( $reactionItem->reactions() ) ) ):
$return .= <<<CONTENT

	<ul class='ipsList_inline ipsRichEmbed_stats ipsType_normal ipsType_blendLinks ipsSpacer_top ipsSpacer_half'>
		
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $reactionItem, 'IPS\Content\Reactable' ) and \count( $reactionItem->reactions() ) ):
$return .= <<<CONTENT

			<li>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionOverview( $reactionItem, TRUE, 'small' );
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $content instanceof \IPS\Content\Ratings and $rating = $content->averageRating() ):
$return .= <<<CONTENT

			<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'large', $rating, 5 );
$return .= <<<CONTENT
</li>
		
CONTENT;

elseif ( isset( $content::$reviewClass ) AND $rating = $content->averageReviewRating() ):
$return .= <<<CONTENT

			<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'large', $rating, \IPS\Settings::i()->reviews_rating_out_of );
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

if ( $content->mapped('num_reviews') ):
$return .= <<<CONTENT
(
CONTENT;

$pluralize = array( $content->mapped('num_reviews') ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'from_num_reviews', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
)
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_reviews_yet', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $content::$commentClass AND $commentsEnabled ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( "getPrefComment" )->setQueryString('tab', 'comments'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					<i class='fa fa-comment'></i> 
					
CONTENT;

if ( $content::$firstCommentRequired ):
$return .= <<<CONTENT

						
CONTENT;

$pluralize = array( $content->mapped('num_comments') - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_replies', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$pluralize = array( $content->mapped('num_comments') ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function embedOriginalItem( $item, $showContent=FALSE, $otherInfo=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<h3 class='ipsRichEmbed_itemTitle ipsTruncate ipsTruncate_line ipsType_blendLinks'>
	<a href='
CONTENT;
$return .= htmlspecialchars( $item->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title="
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
</h3>

CONTENT;

if ( $showContent ):
$return .= <<<CONTENT

	<div class='ipsType_richText ipsType_medium' data-truncate='1'>
		{$item->truncated(TRUE)}
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $otherInfo ):
$return .= <<<CONTENT

	{$otherInfo}

CONTENT;

endif;
$return .= <<<CONTENT

<ul class='ipsList_inline ipsType_medium ipsType_light ipsSpacer_top ipsSpacer_half'>
	<li class='ipsRichEmbed_commentPhoto'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $item->author(), 'tinier' );
$return .= <<<CONTENT

	</li>
	<li>
		<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( 'do', 'getFirstComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			
CONTENT;

$sprintf = array($item->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $item->mapped('date') instanceof \IPS\DateTime ) ? $item->mapped('date') : \IPS\DateTime::ts( $item->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

		</a>
	</li>
	
CONTENT;

if ( $item::$commentClass ):
$return .= <<<CONTENT

		<li>
			<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( 'do', 'getLastComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				
CONTENT;

if ( $item::$firstCommentRequired ):
$return .= <<<CONTENT

					<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $item->mapped('num_comments') - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_replies', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $item->mapped('num_comments') ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}}