<?php
namespace IPS\Theme\Cache;
class class_core_front_sharelinks extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function email( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href="mailto:?subject=
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&body=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel='nofollow' class='cShareLink cShareLink_email' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
	<i class="fa fa-envelope"></i>
</a>
CONTENT;

		return $return;
}

	function facebook( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="https://www.facebook.com/sharer/sharer.php?u=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_facebook" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'facebook_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener nofollow'>
	<i class="fa fa-facebook"></i>
</a>
CONTENT;

		return $return;
}

	function linkedin( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&amp;title=
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class="cShareLink cShareLink_linkedin" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'lin_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener'>
	<i class="fa fa-linkedin"></i>
</a>
CONTENT;

		return $return;
}

	function pinterest( $url ) {
		$return = '';
		$return .= <<<CONTENT

<a href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_pinterest" rel="nofollow" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinterest_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener'>
	<i class="fa fa-pinterest"></i>
</a>
CONTENT;

		return $return;
}

	function reddit( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href="http://www.reddit.com/submit?url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&amp;title=
CONTENT;

$return .= htmlspecialchars( urlencode( $title ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" class="cShareLink cShareLink_reddit" target="_blank" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reddit_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='noopener'>
	<i class="fa fa-reddit"></i>
</a>
CONTENT;

		return $return;
}

	function shareButton( $item, $size = 'verySmall', $type = 'link' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$id = mt_rand();
$return .= <<<CONTENT


CONTENT;

if ( \count( $item->sharelinks() )  ):
$return .= <<<CONTENT

    <a href='#elShareItem_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elShareItem_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu class='ipsShareButton ipsButton ipsButton_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsButton_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $type == 'link' ):
$return .= <<<CONTENT
ipsButton_link--light
CONTENT;

endif;
$return .= <<<CONTENT
'>
        <span><i class='fa fa-share-alt'></i></span> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

    </a>

    <div class='ipsPadding ipsMenu ipsMenu_auto ipsHide' id='elShareItem_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-controller="core.front.core.sharelink">
        <ul class='ipsList_inline'>
            
CONTENT;

foreach ( $item->sharelinks() as $sharelink  ):
$return .= <<<CONTENT

                <li>{$sharelink}</li>
            
CONTENT;

endforeach;
$return .= <<<CONTENT

        </ul>
        
CONTENT;

if ( $shareData = $item->webShareData() ):
$return .= <<<CONTENT

            <hr class='ipsHr'>
            <button class='ipsHide ipsButton ipsButton_verySmall ipsButton_light ipsButton_fullWidth ipsMargin_top:half' data-controller='core.front.core.webshare' data-role='webShare' data-webShareTitle='
CONTENT;
$return .= htmlspecialchars( $shareData['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-webShareText='
CONTENT;
$return .= htmlspecialchars( $shareData['text'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-webShareUrl='
CONTENT;
$return .= htmlspecialchars( $shareData['url'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_share_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
        
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

	function twitter( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href="http://twitter.com/share?url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="cShareLink cShareLink_twitter" target="_blank" data-role="shareLink" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'twitter_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip rel='nofollow noopener'>
	<i class="fa fa-twitter"></i>
</a>
CONTENT;

		return $return;
}}