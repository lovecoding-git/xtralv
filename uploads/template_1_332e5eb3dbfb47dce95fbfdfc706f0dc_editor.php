<?php
namespace IPS\Theme\Cache;
class class_core_global_editor extends \IPS\Theme\Template
{
	public $cache_key = '91ad289b393b6e67d26358f4f9555a20';
	function attachedAudio( $realUrl, $linkUrl, $title, $mimeType, $id ) {
		$return = '';
		$return .= <<<CONTENT

<audio controls src="<fileStore.core_Attachment>/
CONTENT;
$return .= htmlspecialchars( $realUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" type="
CONTENT;
$return .= htmlspecialchars( $mimeType, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-fileid="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-controller="core.global.core.embeddedaudio">
    <a class="ipsAttachLink" href="
CONTENT;
$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
</audio>
CONTENT;

		return $return;
}

	function attachedFile( $url, $title, $pTag=TRUE, $ext='', $fileId='', $fileKey='' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $pTag ):
$return .= <<<CONTENT
<p>
CONTENT;

endif;
$return .= <<<CONTENT
<a class="ipsAttachLink" href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-fileExt='
CONTENT;
$return .= htmlspecialchars( $ext, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $fileId ):
$return .= <<<CONTENT
data-fileid='
CONTENT;
$return .= htmlspecialchars( $fileId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $fileKey ):
$return .= <<<CONTENT
data-filekey='
CONTENT;
$return .= htmlspecialchars( $fileKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
CONTENT;

if ( $pTag ):
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function attachedImage( $url, $thumbnail, $title, $id, $width, $ratio=1 ) {
		$return = '';
		$return .= <<<CONTENT

<p><a href="<fileStore.core_Attachment>/
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsAttachLink ipsAttachLink_image"><img data-fileid="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
src="
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-src="<fileStore.core_Attachment>/
CONTENT;
$return .= htmlspecialchars( $thumbnail, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

else:
$return .= <<<CONTENT
src="<fileStore.core_Attachment>/
CONTENT;
$return .= htmlspecialchars( $thumbnail, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-ratio="
CONTENT;
$return .= htmlspecialchars( $ratio, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" width="
CONTENT;
$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsImage ipsImage_thumbnailed" alt="
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></a></p>
CONTENT;

		return $return;
}

	function attachedVideo( $realUrl, $linkUrl, $title, $mimeType, $id ) {
		$return = '';
		$return .= <<<CONTENT

<video controls class="ipsEmbeddedVideo" data-fileid="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
data-video-embed
CONTENT;

else:
$return .= <<<CONTENT
data-controller="core.global.core.embeddedvideo"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<source 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
data-video-
CONTENT;

endif;
$return .= <<<CONTENT
src="<fileStore.core_Attachment>/
CONTENT;
$return .= htmlspecialchars( $realUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" type="
CONTENT;
$return .= htmlspecialchars( $mimeType, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<a class="ipsAttachLink" href="
CONTENT;
$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
</video>
CONTENT;

		return $return;
}

	function code( $val, $editorId, $randomString, $language='html' ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad ipsForm ipsForm_vertical" data-controller='core.global.editor.code' data-editorid='
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-randomstring='
CONTENT;
$return .= htmlspecialchars( $randomString, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<form method='get' action='#'>
		<div class="ipsPad ipsAreaBackground_light">
			<div class="ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary ipsLoading" data-role="codeContainer">
				<textarea id='elCodeInput
CONTENT;
$return .= htmlspecialchars( $randomString, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $val, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>
			</div>
			<div class='ipsFieldRow'>
				<button type='submit' class="ipsButton ipsButton_primary cEditorURLButton cEditorURLButtonInsert" data-action="linkButton">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_insert', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				<div class="ipsPos_right">
					<select id='elCodeMode
CONTENT;
$return .= htmlspecialchars( $randomString, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="codeModeSelect" data-codeLanguage="
CONTENT;
$return .= htmlspecialchars( $language, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
						<option value="null">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_null', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value="htmlmixed" 
CONTENT;

if ( $language == 'html' OR $language == 'htmlmixed' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_htmlmixed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value="css" 
CONTENT;

if ( $language == 'css' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_css', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value="javascript" 
CONTENT;

if ( $language == 'javascript' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_javascript', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value="php" 
CONTENT;

if ( $language == 'php' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_php', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value="sql" 
CONTENT;

if ( $language == 'sql' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_sql', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value="xml" 
CONTENT;

if ( $language == 'xml' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_xml', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
					</select>
				</div>
			</div>
		</div>
	</form>
</div>
CONTENT;

		return $return;
}

	function fakeFormTemplate( $id, $action, $tabs, $hiddenValues, $actionButtons, $uploadField ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
>
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

	
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT

		<input type="hidden" name="MAX_FILE_SIZE" value="
CONTENT;
$return .= htmlspecialchars( $uploadField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<input type="hidden" name="plupload" value="
CONTENT;

$return .= htmlspecialchars( md5( mt_rand() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

foreach ( $tabs as $elements ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $elements as $element ):
$return .= <<<CONTENT

			{$element->html()}
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</form>

CONTENT;

		return $return;
}

	function image( $editorId, $width, $height, $maximumWidth, $maximumHeight, $float, $link, $ratioWidth, $ratioHeight, $imageAlt, $editorUniqueId ) {
		$return = '';
		$return .= <<<CONTENT

<div class=" ipsForm ipsForm_vertical" data-controller="core.global.editor.image" data-imageWidthRatio='
CONTENT;
$return .= htmlspecialchars( $ratioWidth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-imageHeightRatio='
CONTENT;
$return .= htmlspecialchars( $ratioHeight, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-editorid='
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-editorUniqueId='
CONTENT;
$return .= htmlspecialchars( $editorUniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<form method='get' action='#'>
		<div class='ipsPad'>
			<div class="ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary">
				<label class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_link', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
				<input type="text" class="" value="
CONTENT;
$return .= htmlspecialchars( $link, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="imageLink">
			</div>

			<div class="ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary">
				<label class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_alt', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
				<input type="text" class="" value="
CONTENT;
$return .= htmlspecialchars( $imageAlt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="imageAlt">
				<span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_alt_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</div>

			<div class="ipsFieldRow ipsFieldRow_primary">
				<label class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_size', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
				<div class='ipsComposeArea_imageDims'>
					<input type="number" class="ipsField_short" value="
CONTENT;
$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" max="
CONTENT;
$return .= htmlspecialchars( $maximumWidth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="imageWidth">
					<span class='ipsType_small ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_width_help', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div> &times; 
				<div class='ipsComposeArea_imageDims'>
					<input type="number" class="ipsField_short" value="
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" max="
CONTENT;
$return .= htmlspecialchars( $maximumHeight, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="imageHeight">
					<span class='ipsType_small ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_height_help', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'px', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				<p class='ipsType_reset ipsSpacer_top ipsSpacer_half'>
					<span class='ipsCustomInput'>
						<input type='checkbox' name='image_aspect_ratio' id='elEditorImageRatio' 
CONTENT;

if ( round( \IPS\Request::i()->actualWidth / \IPS\Request::i()->actualHeight, 2 ) == round( $width / $height, 2 ) ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
						<span></span>
					</span> <label for='elEditorImageRatio'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_aspect', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
				</p>
				<br>
				<span class="ipsType_warning" data-role="imageSizeWarning"></span>
			</div>
			<div class="ipsFieldRow ipsFieldRow_primary">
				<label class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_align', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
				<ul class='ipsButton_split ipsComposeArea_imageAlign'>
					<li>
						<input type='radio' name='image_align' value='left' id='image_align_left' data-role="imageAlign" 
CONTENT;

if ( $float == 'left' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 class=''>
						<label for='image_align_left' class='ipsButton ipsButton_fullWidth 
CONTENT;

if ( $float == 'left' ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_light
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton_small'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_align_left', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</label>
					</li>
					<li>
						<input type='radio' name='image_align' value='' id='image_align_none' data-role="imageAlign" 
CONTENT;

if ( $float != 'left' and $float != 'right' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 class=''>
						<label for='image_align_none' class='ipsButton ipsButton_fullWidth 
CONTENT;

if ( $float !== 'left' && $float !=='right' ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_light
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton_small'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</label>
					</li>
					<li>
						<input type='radio' name='image_align' value='right' id='image_align_right' data-role="imageAlign" 
CONTENT;

if ( $float == 'right' ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 class=''>
						<label for='image_align_right' class='ipsButton ipsButton_fullWidth 
CONTENT;

if ( $float == 'right' ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_light
CONTENT;

endif;
$return .= <<<CONTENT
 ipsButton_small'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_align_right', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</label>
					</li>
				</ul>
			</div>
		</div>
		<div class='ipsPad ipsAreaBackground ipsFieldRow'>
			<button type='submit' class="ipsButton ipsButton_primary ipsButton_large ipsButton_fullWidth" autofocus>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'update', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
		</div>
	</form>
</div>
CONTENT;

		return $return;
}

	function link( $val, $editorId ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad ipsForm ipsForm_vertical" data-controller='core.global.editor.link' data-editorid='
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Request::i()->image ):
$return .= <<<CONTENT
data-image="1"
CONTENT;

else:
$return .= <<<CONTENT
data-image="0"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<form method='get' action='#'>
		<div class="ipsPad ipsAreaBackground_light">
			<div class="ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary">
				<label for='elLinkURL
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'url', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
				<input type="text" id='elLinkURL
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsField_fullWidth ipsField_primary cEditorURL" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_url_label', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-role="linkURL" value="
CONTENT;
$return .= htmlspecialchars( $val, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" autofocus>
			</div>
			
CONTENT;

if ( !\IPS\Request::i()->image and !\IPS\Request::i()->block ):
$return .= <<<CONTENT

				<div class="ipsFieldRow ipsFieldRow_fullWidth" data-role="linkTextRow">
					<label for='elLinkText
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
					<input type="text" id='elLinkText
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsField_fullWidth cEditorURL" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_text_label', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-role="linkText" 
CONTENT;

if ( \IPS\Request::i()->title ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

else:
$return .= <<<CONTENT
value=""
CONTENT;

endif;
$return .= <<<CONTENT
>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsFieldRow'>
				<button type='submit' class="ipsButton ipsButton_primary cEditorURLButton cEditorURLButtonInsert" data-action="linkButton">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_insert', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				
CONTENT;

if ( $val ):
$return .= <<<CONTENT

					&nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;
					<button type="button" class="ipsButton ipsButton_light ipsButton_small" data-action="linkRemoveButton">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	</form>
</div>
CONTENT;

		return $return;
}

	function linkedImage( $imageUrl, $imageName ) {
		$return = '';
		$return .= <<<CONTENT

<p><img 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
src="
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-
CONTENT;

endif;
$return .= <<<CONTENT
src="
CONTENT;
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsImage ipsImage_thumbnailed" alt="
CONTENT;
$return .= htmlspecialchars( $imageName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></p>
CONTENT;

		return $return;
}

	function mentionRow( $member ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsMenu_item ipsCursor_pointer' data-mentionhref='
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-mentionid='
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-mentionhover='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString('do', 'hovercard'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<a>
		<img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='' class='ipsUserPhoto ipsUserPhoto_tiny' loading='lazy'>
		<span class="ipsPad_half" data-role='mentionname'>
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
	</a>
</li>
CONTENT;

		return $return;
}

	function myMedia( $editorId, $mediaSources, $currentMediaSource, $url, $results ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$safeEditorId = preg_replace( "/[^a-zA-Z0-9\-_]/", '_', $editorId );
$return .= <<<CONTENT

<div class="cMyMedia" data-controller='core.global.editor.mymedia, core.global.editor.insertable' data-editorid='
CONTENT;
$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div id="elEditor
CONTENT;
$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
Attach">
		
CONTENT;

if ( \count( $mediaSources ) > 1 ):
$return .= <<<CONTENT

			<div class="ipsColumns ipsColumns_collapsePhone"  data-ipsTabBar data-ipsTabBar-contentArea='#elEditor
CONTENT;
$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
AttachTabContent' data-ipsTabBar-itemSelector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsTabBar-updateURL="false">
				<div class="ipsColumn ipsColumn_medium">
					<div class="ipsSideMenu ipsPad" id='elAttachmentsMenu_
CONTENT;
$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsSideMenu>
						<h3 class='ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium'>
							<a href='#elAttachmentsMenu_
CONTENT;
$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsPad_double' data-action='openSideMenu'><i class='fa fa-bars'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_attachment_location', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class='fa fa-caret-down'></i></a>
						</h3>
						<ul class="ipsSideMenu_list">
							
CONTENT;

foreach ( $mediaSources as $k ):
$return .= <<<CONTENT

								<li>
									<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=editor&do=myMedia&tab={$k}&existing=1", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" id="elEditor
CONTENT;
$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
AttachTabMedia
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentMediaSource == $k ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$val = "editorMedia_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</ul>
					</div>
				</div>
				<div class="ipsColumn ipsColumn_fluid">
		
CONTENT;

endif;
$return .= <<<CONTENT

			<div id="elEditor
CONTENT;
$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
AttachTabContent" data-role="myMediaContent" class='ipsPad'>
				
CONTENT;

if ( \count( $mediaSources )  ):
$return .= <<<CONTENT

					{$results}
				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_no_media', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

if ( \count( $mediaSources ) > 1 ):
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class='ipsPad ipsAreaBackground cMyMedia_controls'>
		<ul class='ipsList_inline ipsType_right'>
			<li><a href='#' data-action="clearAll" class='ipsButton ipsButton_verySmall ipsButton_veryLight ipsButton_disabled'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_clear_selection', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li><a href='#' data-action="insertSelected" class='ipsButton ipsButton_verySmall ipsButton_normal ipsButton_disabled'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_image_upload_insert_selected', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
	</div>
</div>
CONTENT;

		return $return;
}

	function myMediaContent( $files, $pagination, $url, $extension ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.global.editor.mymediasection' data-url="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&search=1">
	<div class='ipsAreaBackground ipsPad_half'>
		<input type="search" class="ipsField_fullWidth" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-role="myMediaSearch">
	</div>
	<div data-role="myMediaResults" data-extension="
CONTENT;
$return .= htmlspecialchars( $extension, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "editor", "core", 'global' )->myMediaResults( $files, $pagination, $url, $extension );
$return .= <<<CONTENT

	</div>	
</div>
CONTENT;

		return $return;
}

	function myMediaResults( $files, $pagination, $url ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty($files) ):
$return .= <<<CONTENT

	<div class='ipsPad ipsAreaBackground_light'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<div class="ipsGrid ipsAttachment_fileList">
		
CONTENT;

foreach ( $files as $url => $file ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", \IPS\Request::i()->app, 'global' )->uploadFile( preg_replace( '/' . preg_quote( \IPS\Settings::i()->base_url . 'applications/core/interface/file/attachment.php?id=', '/' ) . '(\d+)(&key=[a-z0-9]+)?/i', '$1', $url ), $file, NULL, TRUE, TRUE, $url );
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
	<br>
	{$pagination}

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function preview( $editorID ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.global.editor.preview' data-editorID='
CONTENT;
$return .= htmlspecialchars( $editorID, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsPad ipsAreaBackground_reset ipsType_richText ipsType_break ipsType_contained ipsType_normal' data-role='previewContainer'>

	</div>
</div>
CONTENT;

		return $return;
}}