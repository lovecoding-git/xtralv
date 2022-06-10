<?php
namespace IPS\Theme\Cache;
class class_core_front_myAttachments extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function rows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $attachment ):
$return .= <<<CONTENT

	<div class='ipsDataItem ipsAttach ipsAttach_done md:ipsFlex md:ipsFlex-ai:center sm:ipsFlex-fw:wrap'>
		<div class='ipsDataItem_generic ipsDataItem_size3 ipsType_center'>
			<a href="
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
applications/core/interface/file/attachment.php?id=
CONTENT;
$return .= htmlspecialchars( $attachment['attach_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $attachment['attach_security_key'] ):
$return .= <<<CONTENT
&key=
CONTENT;
$return .= htmlspecialchars( $attachment['attach_security_key'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
				
CONTENT;

if ( $attachment['attach_is_image'] ):
$return .= <<<CONTENT

					<img src="
CONTENT;

$return .= \IPS\File::get( "core_Attachment", $attachment['attach_location'] )->url;
$return .= <<<CONTENT
" alt='' class='ipsImage ipsThumb_small' data-ipsLightbox data-ipsLightbox-group="myAttachments">
				
CONTENT;

else:
$return .= <<<CONTENT

					<i class='fa fa-
CONTENT;

$return .= htmlspecialchars( \IPS\File::getIconFromName( $attachment['attach_file'] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_large'></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</div>
		<div class='ipsDataItem_main'>
			<h2 class='ipsDataItem_title ipsType_reset ipsType_medium ipsAttach_title ipsContained_container ipsType_blendLinks'><span class='ipsType_break ipsContained'><a href="
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
applications/core/interface/file/attachment.php?id=
CONTENT;
$return .= htmlspecialchars( $attachment['attach_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $attachment['attach_security_key'] ):
$return .= <<<CONTENT
&key=
CONTENT;
$return .= htmlspecialchars( $attachment['attach_security_key'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $attachment['attach_file'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></span></h2>
			<p class='ipsDataItem_meta ipsType_light'>
				
CONTENT;

if ( !$attachment['attach_is_image'] ):
$return .= <<<CONTENT

CONTENT;

$pluralize = array( $attachment['attach_hits'] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'attach_hits_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
 &middot; 
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $attachment['attach_filesize'] );
$return .= <<<CONTENT
 &middot; 
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $attachment['attach_date'] )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachment_uploaded', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

			</p>
		</div>
		<div class='ipsDataItem_generic ipsDataItem_size9 ipsType_light'>
			{$attachment['attach_content']}
		</div>
		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

		<div class='ipsDataItem_modCheck'>
			<span class='ipsCustomInput'>
				<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $attachment['attach_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"  data-state=''>
				<span></span>
			</span>
		</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function template( $table, $used, $count ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader'>
	<h1 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>

CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] > 0 ):
$return .= <<<CONTENT

	
CONTENT;

$percentage = round( ( $used / ( \IPS\Member::loggedIn()->group['g_attach_max'] * 1024 ) ) * 100 );
$return .= <<<CONTENT

	<div class='ipsBox ipsPadding ipsMargin_top'>
		<h2 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachment_quota', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class='ipsProgressBar ipsProgressBar_fullWidth ipsClear 
CONTENT;

if ( $percentage >= 90 ):
$return .= <<<CONTENT
ipsProgressBar_warning
CONTENT;

endif;
$return .= <<<CONTENT
' >
			<div class='ipsProgressBar_progress' style="width: 
CONTENT;
$return .= htmlspecialchars( $percentage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
%">
				<span data-role="percentage">
CONTENT;
$return .= htmlspecialchars( $percentage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>%
			</div>
		</div>
		<p class='ipsType_reset ipsType_center ipsMargin_top'>
			
CONTENT;

$sprintf = array(\IPS\Output\Plugin\Filesize::humanReadableFilesize( $used ), \IPS\Output\Plugin\Filesize::humanReadableFilesize( \IPS\Member::loggedIn()->group['g_attach_max'] * 1024 )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

		</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsBox ipsMargin_top'>
	<h2 class='ipsType_sectionTitle ipsType_medium ipsType_reset'>
CONTENT;

$pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
	{$table}
</div>
CONTENT;

		return $return;
}}