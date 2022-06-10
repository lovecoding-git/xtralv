<?php
namespace IPS\Theme\Cache;
class class_core_global_embed extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function brightcove( $url ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsEmbeddedBrightcove">
  <div class="ipsEmbeddedBrightcove_inner">
    <iframe src="{$url}"
      allowfullscreen
      webkitallowfullscreen
      mozallowfullscreen
	  class="ipsEmbeddedBrightcove_frame">
    </iframe>
  </div>
</div>

CONTENT;

		return $return;
}

	function embedNoPermission(  ) {
		$return = '';
		$return .= <<<CONTENT


<div data-embedInfo-maxSize='
CONTENT;

if ( \IPS\Settings::i()->max_internalembed_width ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->max_internalembed_width;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
100%
CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsRichEmbed'>
	<div class='ipsType_center ipsType_light ipsPadding'>
		<i class='fa fa-frown-o ipsType_veryLarge ipsType_light'></i>
		<p class='ipsType_reset ipsType_normal ipsPad'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_no_perm_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_no_perm_desc_log_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</p>
	</div>
</div>
CONTENT;

		return $return;
}

	function embedUnavailable(  ) {
		$return = '';
		$return .= <<<CONTENT


<div data-embedInfo-maxSize='
CONTENT;

if ( \IPS\Settings::i()->max_internalembed_width ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->max_internalembed_width;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
100%
CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsRichEmbed'>
	<div class='ipsType_center ipsType_light ipsPadding'>
		<i class='fa fa-frown-o ipsType_veryLarge ipsType_light'></i>
		<p class='ipsType_reset ipsType_normal ipsPad'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'embed_unavailable_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	</div>
</div>
CONTENT;

		return $return;
}

	function googleMaps( $q, $mapType, $zoom = NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbeddedOther' contenteditable="false">
	<iframe height="450"
	
CONTENT;

if ( $mapType == 'place' ):
$return .= <<<CONTENT

		src="https://www.google.com/maps/embed/v1/place?key=
CONTENT;

$return .= \IPS\Settings::i()->google_maps_api_key;
$return .= <<<CONTENT
&q=
CONTENT;
$return .= htmlspecialchars( $q, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

elseif ( $mapType == 'dir' ):
$return .= <<<CONTENT

		
CONTENT;

if ( isset( $q['waypoints'] ) ):
$return .= <<<CONTENT

			src="https://www.google.com/maps/embed/v1/directions?key=
CONTENT;

$return .= \IPS\Settings::i()->google_maps_api_key;
$return .= <<<CONTENT
&origin=
CONTENT;
$return .= htmlspecialchars( $q['origin'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&waypoints=
CONTENT;
$return .= htmlspecialchars( $q['waypoints'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&destination=
CONTENT;
$return .= htmlspecialchars( $q['destination'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		
CONTENT;

else:
$return .= <<<CONTENT

			src="https://www.google.com/maps/embed/v1/directions?key=
CONTENT;

$return .= \IPS\Settings::i()->google_maps_api_key;
$return .= <<<CONTENT
&origin=
CONTENT;
$return .= htmlspecialchars( $q['origin'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&destination=
CONTENT;
$return .= htmlspecialchars( $q['destination'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

elseif ( $mapType == 'search' ):
$return .= <<<CONTENT

		src="https://www.google.com/maps/embed/v1/search?key=
CONTENT;

$return .= \IPS\Settings::i()->google_maps_api_key;
$return .= <<<CONTENT
&q=
CONTENT;
$return .= htmlspecialchars( $q, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

elseif ( $mapType =='coordinates' ):
$return .= <<<CONTENT

		src="https://www.google.com/maps/embed/v1/view?key=
CONTENT;

$return .= \IPS\Settings::i()->google_maps_api_key;
$return .= <<<CONTENT
&center=
CONTENT;
$return .= htmlspecialchars( $q, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&zoom=
CONTENT;
$return .= htmlspecialchars( $zoom, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
	
CONTENT;

endif;
$return .= <<<CONTENT
>
	</iframe>
</div>

CONTENT;

		return $return;
}

	function iframe( $url, $width=NULL, $height=NULL, $embedId=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbeddedOther' contenteditable="false">
	<iframe src="{$url}" data-controller="core.front.core.autosizeiframe" 
CONTENT;

if ( $embedId ):
$return .= <<<CONTENT
data-embedId='
CONTENT;
$return .= htmlspecialchars( $embedId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 allowfullscreen=''></iframe>
</div>
CONTENT;

		return $return;
}

	function link( $url, $title ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' rel='noopener'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
CONTENT;

		return $return;
}

	function photo( $imageUrl, $linkUrl=NULL, $title=NULL, $width=NULL, $height=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $linkUrl ):
$return .= <<<CONTENT
<a href='
CONTENT;
$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' rel='noopener'>
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT

		<img src='
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-src='
CONTENT;
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsImage' 
CONTENT;

if ( $width ):
$return .= <<<CONTENT
width="
CONTENT;
$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $height ):
$return .= <<<CONTENT
height="
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

else:
$return .= <<<CONTENT

		<img src='
CONTENT;
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsImage' 
CONTENT;

if ( $width ):
$return .= <<<CONTENT
width="
CONTENT;
$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $height ):
$return .= <<<CONTENT
height="
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
    
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $linkUrl ):
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function video( $html ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsEmbeddedVideo' contenteditable="false"><div>{$html}</div></div>
CONTENT;

		return $return;
}}