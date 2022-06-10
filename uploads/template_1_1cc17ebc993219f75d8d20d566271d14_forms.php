<?php
namespace IPS\Theme\Cache;
class class_core_front_forms extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function colorSelection( $name, $value ) {
		$return = '';
		$return .= <<<CONTENT


<ul class='ipsList_inline cColorChoices'>
	
CONTENT;

foreach ( array('none', 'information', 'general', 'warning', 'error', 'success' ) as $type ):
$return .= <<<CONTENT

		<li data-ipsTooltip title='
CONTENT;

$val = "message_type_{$type}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
			<input type='radio' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' value='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $value === $type ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
>
			<span class='cColorChoice_chooser ipsMessage ipsMessage_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></span>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}

	function commentTemplate( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$minimized = false;
$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
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

	<div class='ipsComposeArea ipsComposeArea_withPhoto ipsClearfix ipsContained'>
		<div class='ipsPos_left ipsResponsive_hidePhone ipsResponsive_block'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'small' );
$return .= <<<CONTENT
</div>
		<div class='ipsComposeArea_editor'>
			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					
CONTENT;

if ( $input->name == 'guest_name' or $input->name == 'guest_email' ):
$return .= <<<CONTENT

						<ul class='ipsForm ipsForm_horizontal ipsMargin_bottom:half' data-ipsEditor-toolList>
							<li class='ipsFieldRow ipsFieldRow_fullWidth'>
								{$input->html()}
								
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT

									<div class="ipsType_warning ipsSpacer_top" data-role="commentFormError">
CONTENT;

$val = "{$input->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</li>
						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Editor ):
$return .= <<<CONTENT

						
CONTENT;

if ( $input->options['minimize'] !== NULL ):
$return .= <<<CONTENT

							
CONTENT;

$minimized = true;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						{$input->html( TRUE )}
						
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT

							<div class="ipsType_warning ipsSpacer_top" data-role="commentFormError">
CONTENT;

$val = "{$input->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
						
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

endforeach;
$return .= <<<CONTENT

			<ul class='ipsToolList ipsToolList_horizontal ipsClear ipsClearfix 
CONTENT;

if ( $minimized ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsEditor-toolList>
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( !($input instanceof \IPS\Helpers\Form\Editor) && $input->name != 'guest_name' && $input->name != 'guest_email' ):
$return .= <<<CONTENT

							<li class='ipsPos_left ipsResponsive_noFloat 
CONTENT;

if ( !($input instanceof \IPS\Helpers\Form\Captcha) ):
$return .= <<<CONTENT
ipsComposeArea_formControl
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_medium ipsType_light'>
								{$input->html()}
								
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT

									<div class="ipsType_warning ipsSpacer_top" data-role="commentFormError">
CONTENT;

$val = "{$input->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
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

endforeach;
$return .= <<<CONTENT

				
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

					<li>{$button}</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	</div>
</form>
CONTENT;

		return $return;
}

	function commentUnavailable( $lang, $warnings=array(), $ends=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsComposeArea ipsComposeArea_withPhoto ipsComposeArea_unavailable ipsClearfix'>
	<div class='ipsPos_left ipsResponsive_hidePhone ipsResponsive_block'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'small' );
$return .= <<<CONTENT
</div>
	<div class='ipsComposeArea_editor'>
		<div class="ipsComposeArea_dummy">
			<span class='ipsType_warning'><i class="fa fa-warning"></i> 
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( $ends !== NULL AND $ends > 0 ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $ends )->relative()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restriction_ends', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
		
			
CONTENT;

if ( \count( $warnings)  ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $warnings as $idx => $warning ):
$return .= <<<CONTENT

					
CONTENT;

if ( $idx === 0 ):
$return .= <<<CONTENT

						<br><br>
						<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class='ipsButton ipsButton_verySmall ipsButton_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function createItemUnavailable( $lang, $warnings ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 


CONTENT;

if ( \count( $warnings)  ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $warnings as $idx => $warning ):
$return .= <<<CONTENT

		
CONTENT;

if ( $idx === 0 ):
$return .= <<<CONTENT

			<br><br>
			<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class='ipsButton ipsButton_verySmall ipsButton_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
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

	function editContentForm( $title, $form, $container=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $container and \IPS\IPS::classUsesTrait( $container, 'IPS\Content\ClubContainer' ) and $club = $container->club() ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->clubs and \IPS\Settings::i()->clubs_header == 'full' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "clubs", "core" )->header( $club, $container );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


<div class="ipsPageHeader ipsClearfix ipsSpacer_bottom">
	<h1 class="ipsType_pageTitle">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
</div>
<div class='ipsBox'>{$form}</div>
CONTENT;

		return $return;
}

	function editTagsForm( $form ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad">
	{$form}
</div>
CONTENT;

		return $return;
}

	function emptyRow( $contents, $id=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsFieldRow ipsPad_half ipsClearfix' 
CONTENT;

if ( $id ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	{$contents}
</li>
CONTENT;

		return $return;
}

	function header( $lang, $id=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<li 
CONTENT;

if ( $id !== NULL ):
$return .= <<<CONTENT
 id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<h2 class='ipsFieldRow_section'>
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</li>
<br>
CONTENT;

		return $return;
}

	function popupRegisterTemplate( $login, $postBeforeRegister, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Request::i()->isAjax() AND $buttonMethods = $login->buttonMethods() ):
$return .= <<<CONTENT

	<div id='elRegisterSocial'>
		<div class='ipsPadding'>
			<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_start_faster', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			<p class='ipsType_normal ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_connect', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<form data-bypassValidation='true' accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $login->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
				<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				<div class='ipsGap:2 ipsMargin_top:half'>
					
CONTENT;

foreach ( $buttonMethods as $method ):
$return .= <<<CONTENT

						<div class='ipsType_center'>
							{$method->button()}
						</div>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</div>
			</form>
		</div>
	</div>
	<hr class='ipsHr'>

CONTENT;

endif;
$return .= <<<CONTENT


<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
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
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( \is_array($v) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $v as $_k => $_v ):
$return .= <<<CONTENT

				<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $_k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;
$return .= htmlspecialchars( $_v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

else:
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

endif;
$return .= <<<CONTENT

	
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

if ( \count( $form->elements ) < 2 ):
$return .= <<<CONTENT

		<div class="ipsPadding">
			
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

				<div class='ipsGrid ipsGrid_collapsePhone'>
					<div class='ipsGrid_span8'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<ul class='ipsList_reset'>
					
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

						
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input )  ):
$return .= <<<CONTENT

								{$input->rowHtml($form)}
							
CONTENT;

else:
$return .= <<<CONTENT

								{$input}
							
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
			
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

					</div>
					<div class='ipsGrid_span4'>
						
CONTENT;

$return .= array_pop( $sidebar );
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsTabs ipsClearfix ipsJS_show' id='tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<a href='#tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
			<ul role='tablist'>
				
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

					<li>
						<a href='#ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( $name == \IPS\Request::i()->tab ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab">
							
CONTENT;

foreach ( $content as $element ):
$return .= <<<CONTENT

CONTENT;

if ( !\is_string( $element ) and $element->error ):
$return .= <<<CONTENT
<i class="fa fa-exclamation-circle"></i> 
CONTENT;

break;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
 
CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div id='ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class=''>
			
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

				<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
					<ul class='ipsList_reset'>
						
CONTENT;

foreach ( $content as $input ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input )  ):
$return .= <<<CONTENT

								{$input->rowHtml($form)}
							
CONTENT;

else:
$return .= <<<CONTENT

								{$input}
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</div>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class="ipsPadding ipsList_reset ipsClearfix ipsBorder_top">
		<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->button( 'register_button', 'submit', null, 'ipsButton ipsButton_primary ipsButton_large ipsButton_fullWidth', array( 'tabindex' => '2', 'accesskey' => 's' ) );
$return .= <<<CONTENT
</li>
		
CONTENT;

if ( $postBeforeRegister ):
$return .= <<<CONTENT

		<li class='ipsPadding_top:half'><a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=cancelPostBeforeRegister&id={$postBeforeRegister['id']}&pbr={$postBeforeRegister['secret']}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_veryLight ipsButton_large ipsButton_fullWidth' data-ipsPbrCancel="true">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_before_register_delete_submission', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>
</form>
CONTENT;

		return $return;
}

	function popupTemplate( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
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
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( \is_array($v) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $v as $_k => $_v ):
$return .= <<<CONTENT

				<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $_k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;
$return .= htmlspecialchars( $_v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

else:
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

endif;
$return .= <<<CONTENT

	
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

if ( $form->error ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_error">
			
CONTENT;
$return .= htmlspecialchars( $form->error, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \count( $form->elements ) < 2 ):
$return .= <<<CONTENT

		<div class="ipsPadding">
			
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

				<div class='ipsGrid ipsGrid_collapsePhone'>
					<div class='ipsGrid_span8'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<ul class='ipsList_reset'>
					
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

						
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input )  ):
$return .= <<<CONTENT

								{$input->rowHtml($form)}
							
CONTENT;

else:
$return .= <<<CONTENT

								{$input}
							
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
			
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

					</div>
					<div class='ipsGrid_span4'>
						
CONTENT;

$return .= array_pop( $sidebar );
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsTabs ipsClearfix ipsJS_show' id='tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<a href='#tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
			<ul role='tablist'>
				
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

					<li>
						<a href='#ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( $name == \IPS\Request::i()->tab ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab">
							
CONTENT;

foreach ( $content as $element ):
$return .= <<<CONTENT

CONTENT;

if ( !\is_string( $element ) and $element->error ):
$return .= <<<CONTENT
<i class="fa fa-exclamation-circle"></i> 
CONTENT;

break;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
 
CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div id='ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class=''>
			
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

				<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
					<ul class='ipsList_reset'>
						
CONTENT;

foreach ( $content as $input ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input )  ):
$return .= <<<CONTENT

								{$input->rowHtml($form)}
							
CONTENT;

else:
$return .= <<<CONTENT

								{$input}
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</div>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class="ipsPadding ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsBorder_top">
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			<li>{$button}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</form>
CONTENT;

		return $return;
}

	function postingInformation( $guestPostBeforeRegister, $modQueued, $standalone=false ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( !$standalone ):
$return .= <<<CONTENT

		<div class='ipsPadding_bottom ipsBorder_bottom ipsMargin_bottom cGuestTeaser'>
			<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_post_header', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			<p class='ipsType_normal ipsType_reset'>
	
CONTENT;

else:
$return .= <<<CONTENT

			<p class='ipsType_reset ipsType_normal sm:ipsPadding_horizontal:half ipsMargin_bottom'>
	
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $guestPostBeforeRegister ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_post_pbr_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_post_normal_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_post_sign_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

if ( $modQueued ):
$return .= <<<CONTENT

					<br><span class='ipsType_warning'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_post_mod_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
	
CONTENT;

if ( !$standalone ):
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

elseif ( $modQueued ):
$return .= <<<CONTENT

	<div class="ipsType_reset ipsPadding ipsAreaBackground_light ipsSpacer_bottom 
CONTENT;

if ( $standalone ):
$return .= <<<CONTENT
ipsBox
CONTENT;

endif;
$return .= <<<CONTENT
">
		
CONTENT;

$warnings = \IPS\Member::loggedIn()->warnings( 1, NULL, 'mq' );
$return .= <<<CONTENT

		
CONTENT;

foreach ( $warnings as $idx => $warning ):
$return .= <<<CONTENT

			<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_verySmall ipsButton_veryLight ipsPos_right' data-ipsDialog data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		<strong class="ipsType_warning ipsType_normal">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mod_queue_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
		
CONTENT;

if ( \count( $warnings ) and \IPS\Member::loggedIn()->mod_posts > time() ):
$return .= <<<CONTENT

			<p class="ipsType_light ipsType_reset ipsType_normal">
				
CONTENT;

if ( \count( $warnings ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_will_be_moderated', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$sprintf = array(\IPS\DateTime::ts( \IPS\Member::loggedIn()->mod_posts )->relative()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restriction_ends', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

			</p>
		
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

	function profileCompleteTemplate( $step, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
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
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( \is_array($v) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $v as $_k => $_v ):
$return .= <<<CONTENT

				<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $_k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;
$return .= htmlspecialchars( $_v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

else:
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

endif;
$return .= <<<CONTENT

	
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

if ( \count( $form->elements ) < 2 ):
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( 'profile_step_text_' . $step->id ) and \IPS\Member::loggedIn()->language()->words[ 'profile_step_text_' . $step->id ] ):
$return .= <<<CONTENT

			<div class='ipsPadding'>
				<div class="ipsMessage ipsMessage_info">
					
CONTENT;

$val = "profile_step_text_{$step->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsPad">
			
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

				<div class='ipsGrid ipsGrid_collapsePhone'>
					<div class='ipsGrid_span8'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<ul class='ipsList_reset'>
					
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

						
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input )  ):
$return .= <<<CONTENT

								{$input->rowHtml($form)}
							
CONTENT;

else:
$return .= <<<CONTENT

								{$input}
							
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
			
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

					</div>
					<div class='ipsGrid_span4'>
						
CONTENT;

$return .= array_pop( $sidebar );
$return .= <<<CONTENT

					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->language()->checkKeyExists( 'profile_step_text_' . $step->id ) and \IPS\Member::loggedIn()->language()->words[ 'profile_step_text_' . $step->id ] ):
$return .= <<<CONTENT

		<div class='ipsPadding'>
			<div class="ipsMessage ipsMessage_info">
				
CONTENT;

$val = "profile_step_text_{$step->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsTabs ipsClearfix ipsJS_show' id='tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<a href='#tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
			<ul role='tablist'>
				
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

					<li>
						<a href='#ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( $name == \IPS\Request::i()->tab ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab">
							
CONTENT;

foreach ( $content as $element ):
$return .= <<<CONTENT

CONTENT;

if ( !\is_string( $element ) and $element->error ):
$return .= <<<CONTENT
<i class="fa fa-exclamation-circle"></i> 
CONTENT;

break;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
 
CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div id='ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class=''>
			
CONTENT;

foreach ( $elements as $name => $content ):
$return .= <<<CONTENT

				<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
					<ul class='ipsList_reset'>
						
CONTENT;

foreach ( $content as $input ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input )  ):
$return .= <<<CONTENT

								{$input->rowHtml($form)}
							
CONTENT;

else:
$return .= <<<CONTENT

								{$input}
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</div>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class="ipsPad ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsAreaBackground">
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			<li>{$button}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

if ( !$step->required OR $step->completed() ):
$return .= <<<CONTENT

			<li><a href="
CONTENT;
$return .= htmlspecialchars( $action->setQueryString('_moveToStep', $step->getNextStep()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="wizardLink" class="ipsButton ipsButton_link ipsJS_none">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_complete_skip_step', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li><a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings", null, "settings", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_link">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_wizard_cancel', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>
</form>
CONTENT;

		return $return;
}

	function ratingTemplate( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
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
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm data-controller="core.front.core.rating">
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

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

			{$input->html()}
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<noscript><button type="submit">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button></noscript>
</form>
CONTENT;

		return $return;
}

	function recommendCommentTemplate( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
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
 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 data-ipsForm>
	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_submitted" value="1">
	
CONTENT;

foreach ( $hiddenValues as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( \is_array($v) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $v as $_k => $_v ):
$return .= <<<CONTENT

				<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $_k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;
$return .= htmlspecialchars( $_v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

else:
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

endif;
$return .= <<<CONTENT

	
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

	<div class="ipsPad">
		<ul class='ipsList_reset'>
			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					
CONTENT;

if ( \is_object( $input )  ):
$return .= <<<CONTENT

						{$input->rowHtml($form)}
					
CONTENT;

else:
$return .= <<<CONTENT

						{$input}
					
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
	<ul class="ipsPad ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsAreaBackground">
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			<li>{$button}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</form>
CONTENT;

		return $return;
}

	function reviewTemplate( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='' ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPhotoPanel ipsPhotoPanel_medium ipsPhotoPanel_notPhone ipsClearfix' 
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
data-controller='core.front.core.reviewForm'
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'medium' );
$return .= <<<CONTENT

	<div>
		<form accept-charset='utf-8' class="ipsForm" action="
CONTENT;
$return .= htmlspecialchars( $action->setQueryString( '_review', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

if ( !isset( \IPS\Request::i()->_review ) and \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<div data-role='reviewIntro' class="">
					<h3 class='ipsType_reset'>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'review_intro_1', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <span class='ipsType_unbold'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'review_intro_2', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></h3>
					<br>
					<a href='#' class='ipsButton ipsButton_primary ipsButton_small ipsJS_show' data-action='writeReview'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'write_a_review', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<ul class='ipsForm ipsForm_vertical 
CONTENT;

if ( !isset( \IPS\Request::i()->_review ) and \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='reviewForm'>
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						{$input}
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

				<li class='ipsFieldRow ipsClearfix'>
					<div class='ipsFieldRow_content'>
						<button type='submit' class='ipsButton ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_review', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
					</div>
				</li>
			</ul>
		</form>
	</div>
</div>
CONTENT;

		return $return;
}

	function reviewUnavailable( $lang, $warnings=array(), $ends=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPhotoPanel ipsPhotoPanel_medium ipsPhotoPanel_notPhone ipsClearfix'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'medium' );
$return .= <<<CONTENT

	<div>
		<strong class='ipsType_warning'><i class="fa fa-warning"></i> 
CONTENT;

$val = "{$lang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( $ends !== NULL AND $ends > 0 ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\DateTime::ts( $ends )->relative()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restriction_ends', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</strong>
		
CONTENT;

if ( \count( $warnings)  ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $warnings as $idx => $warning ):
$return .= <<<CONTENT

				
CONTENT;

if ( $idx === 0 ):
$return .= <<<CONTENT

					<br><br>
					<a href="
CONTENT;
$return .= htmlspecialchars( $warning->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class='ipsButton ipsButton_verySmall ipsButton_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
<hr class='ipsHr'>
CONTENT;

		return $return;
}

	function row( $label, $element, $desc, $warning, $required=FALSE, $error=NULL, $prefix=NULL, $suffix=NULL, $id=NULL, $object=NULL, $form=NULL, $rowClasses=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsFieldRow
CONTENT;

if ( $object === NULL ):
$return .= <<<CONTENT
 ipsFieldRow_textValue
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $object instanceof \IPS\Helpers\Form\Checkbox and !( $object instanceof \IPS\Helpers\Form\YesNo ) ):
$return .= <<<CONTENT
 ipsFieldRow_checkbox
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix 
CONTENT;

if ( $error ):
$return .= <<<CONTENT
ipsFieldRow_error
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $rowClasses ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode(' ', $rowClasses), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $id ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

if ( $object instanceof \IPS\Helpers\Form\Checkbox and !( $object instanceof \IPS\Helpers\Form\YesNo ) ):
$return .= <<<CONTENT

		{$prefix}
		{$element}
		{$suffix}
		<div class='ipsFieldRow_content'>
			<label class='ipsFieldRow_label' for='check_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><span>{$label}</span> 
CONTENT;

if ( $required ):
$return .= <<<CONTENT
<span class='ipsFieldRow_required'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
</label>
			{$desc}
			{$warning}
			
CONTENT;

if ( $error ):
$return .= <<<CONTENT

				<br>
				<span class="ipsType_warning">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( $label ):
$return .= <<<CONTENT

			<label class='ipsFieldRow_label' 
CONTENT;

if ( $object !== NULL AND $object->getLabelForAttribute() !== NULL ):
$return .= <<<CONTENT
for='
CONTENT;
$return .= htmlspecialchars( $object->getLabelForAttribute(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
				<span>{$label}</span> 
CONTENT;

if ( $required ):
$return .= <<<CONTENT
<span class='ipsFieldRow_required'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

			</label>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsFieldRow_content' 
CONTENT;

if ( $object instanceof \IPS\Helpers\Form\Text && !$required && $object->options['autocomplete'] !== NULL && !$object->value ):
$return .= <<<CONTENT
data-controller='core.global.core.optionalAutocomplete'
CONTENT;

endif;
$return .= <<<CONTENT
>
			{$prefix}
			{$element}
			{$suffix}
			{$desc}
			{$warning}
			
CONTENT;

if ( $error ):
$return .= <<<CONTENT

				<br>
				<span class="ipsType_warning">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</li>
CONTENT;

		return $return;
}

	function select( $name, $value, $required, $options, $multiple=FALSE, $class='', $disabled=FALSE, $toggles=array(), $id=NULL, $unlimited=NULL, $unlimitedLang='all', $unlimitedToggles=array(), $toggleOn=TRUE, $userSuppliedInput='', $sort=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $multiple ):
$return .= <<<CONTENT

	<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="__EMPTY">

CONTENT;

endif;
$return .= <<<CONTENT

<select name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $multiple ):
$return .= <<<CONTENT
multiple
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $required === TRUE ):
$return .= <<<CONTENT
required aria-required='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled === TRUE ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $id !== NULL ):
$return .= <<<CONTENT
id="elSelect_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $sort ):
$return .= <<<CONTENT
data-sort
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

foreach ( $options as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( \is_array( $v ) ):
$return .= <<<CONTENT

			<optgroup label="
CONTENT;

$val = "{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
				
CONTENT;

foreach ( $v as $_k => $_v ):
$return .= <<<CONTENT

					<option value='
CONTENT;
$return .= htmlspecialchars( $_k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( ( ( $value === 0 and $_k === 0 ) or ( $value !== 0 and $value === $_k ) ) or ( \is_array( $value ) and \in_array( $_k, $value ) ) ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $toggles[ $_k ] ) ):
$return .= <<<CONTENT
data-control="toggle" data-toggles="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles[ $_k ] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-controls="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles[ $_k ] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>{$_v}</option>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</optgroup>
		
CONTENT;

else:
$return .= <<<CONTENT

			<option value='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'  
CONTENT;

if ( ( ( $value === 0 and $k === 0 ) or ( $value !== 0 and $value === $k ) or ( $value !== 0 and \is_numeric( $value ) and \is_numeric( $k ) and $value == $k ) ) or ( \is_array( $value ) and \in_array( $k, $value ) ) or ( !empty( $userSuppliedInput ) and !\in_array( $value, array_keys( $options ) ) and $k == $userSuppliedInput ) ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( \is_array( $disabled ) and \in_array( $k, $disabled ) ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $toggles[ $k ] ) ):
$return .= <<<CONTENT
data-control="toggle" data-toggles="
CONTENT;

$return .= htmlspecialchars( implode( ',', $toggles[ $k ] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>{$v}</option>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</select>

CONTENT;

if ( $unlimited !== NULL ):
$return .= <<<CONTENT

	<br><br>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	&nbsp;
	<span class='ipsCustomInput'>
		<input type="checkbox" data-control="unlimited
CONTENT;

if ( \count($unlimitedToggles) ):
$return .= <<<CONTENT
 toggle
CONTENT;

endif;
$return .= <<<CONTENT
" name="
CONTENT;

$return .= htmlspecialchars( trim( $name, '[]' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_unlimited" id='
CONTENT;

$return .= htmlspecialchars( trim( $id ?: $name, '[]' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_unlimited' value="
CONTENT;
$return .= htmlspecialchars( $unlimited, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $unlimited === $value ):
$return .= <<<CONTENT
checked aria-checked='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $disabled === TRUE ):
$return .= <<<CONTENT
disabled aria-disabled='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( \count( $unlimitedToggles ) ):
$return .= <<<CONTENT

CONTENT;

if ( $toggleOn === FALSE ):
$return .= <<<CONTENT
data-togglesOff
CONTENT;

else:
$return .= <<<CONTENT
data-togglesOn
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;

$return .= htmlspecialchars( implode( ',', $unlimitedToggles ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-controls="
CONTENT;

$return .= htmlspecialchars( implode( ',', $unlimitedToggles ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 aria-labelledby='
CONTENT;

$return .= htmlspecialchars( trim( $id ?: $name, '[]' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_unlimited_label'>
		<span></span>
	</span> <label for='
CONTENT;

$return .= htmlspecialchars( trim( $id ?: $name, '[]' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_unlimited' id='
CONTENT;

$return .= htmlspecialchars( trim( $id ?: $name, '[]' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_unlimited_label' class='ipsField_unlimited'>
CONTENT;

$val = "{$unlimitedLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function seperator(   ) {
		$return = '';
		$return .= <<<CONTENT

<li>
	<hr class='ipsHr'>
</li>
CONTENT;

		return $return;
}

	function statusPopupTemplate( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='' ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elStatusSubmit' 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
>
	<div class="ipsPadding">
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

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

				
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Editor ):
$return .= <<<CONTENT

					{$input->html()}
					
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

				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
	<ul class="ipsPadding ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsBorder_top">
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			<li>{$button}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</form>	

CONTENT;

		return $return;
}

	function statusTemplate( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='' ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elStatusSubmit' 
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

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

			
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Editor ):
$return .= <<<CONTENT

				{$input->html( TRUE )}
				
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

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

<ul class='ipsToolList ipsToolList_horizontal ipsClear ipsClearfix' data-ipsEditor-toolList>
	<li><button class='ipsButton ipsButton_primary ipsButton_fullWidth' data-action="submitComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button></li>
	
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

			
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT

				<li class='ipsPos_left ipsResponsive_noFloat ipsComposeArea_formControl ipsType_medium ipsType_light'>
					{$input->html()}
					<label for="check_
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
						
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</label>
					
CONTENT;

if ( $input->error ):
$return .= <<<CONTENT

						<div class="ipsType_warning ipsSpacer_top" data-role="commentFormError">
CONTENT;

$val = "{$input->error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
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

endforeach;
$return .= <<<CONTENT

</ul>
</form>	
CONTENT;

		return $return;
}

	function statusWidgetForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='' ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elStatusSubmit' 
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

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

			
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Editor ):
$return .= <<<CONTENT

				{$input->html()}
				
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

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<div class='ipsSpacer_top ipsSpacer_half'>
		<button type='submit' class='ipsButton ipsButton_primary ipsButton_medium ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
	</div>
</form>	

CONTENT;

		return $return;
}

	function template( $id, $action, $tabs, $activeTab, $error, $errorTabs, $hiddenValues, $actionButtons, $uploadField, $sidebar, $tabClasses=array(), $formClass='', $attributes=array(), $tabArray=array(), $usingIcons=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<form action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" accept-charset='utf-8' 
CONTENT;

if ( $uploadField ):
$return .= <<<CONTENT
enctype="multipart/form-data"
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsForm class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $formClass, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

foreach ( $attributes as $k => $v ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endforeach;
$return .= <<<CONTENT
 
CONTENT;

if ( \count($tabArray) > 1 ):
$return .= <<<CONTENT
novalidate="true"
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

		
CONTENT;

if ( \is_array($v) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $v as $_k => $_v ):
$return .= <<<CONTENT

				<input type="hidden" name="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $_k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="
CONTENT;
$return .= htmlspecialchars( $_v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

else:
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

endif;
$return .= <<<CONTENT

	
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

if ( $error ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_error">
			
CONTENT;
$return .= htmlspecialchars( $error, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \count( $tabs ) < 2 ):
$return .= <<<CONTENT

		
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

			<div class='ipsColumns ipsColumns_collapsePhone'>
				<div class='ipsColumn ipsColumn_fluid'>
		
CONTENT;

endif;
$return .= <<<CONTENT

					<ul class='ipsForm'>
						
CONTENT;

$return .= array_pop( $tabs );
$return .= <<<CONTENT

						<li class='ipsFieldRow'>
							<div class='ipsFieldRow_content'>
								
CONTENT;

$return .= implode( '', $actionButtons);
$return .= <<<CONTENT

							</div>
						</li>
					</ul>
		
CONTENT;

if ( !empty( $sidebar ) ):
$return .= <<<CONTENT

				</div>
				<div class='ipsColumn ipsColumn_wide'>
					
CONTENT;

$return .= array_pop( $sidebar );
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( !empty( $errorTabs ) ):
$return .= <<<CONTENT

			<p class="ipsMessage ipsMessage_error ipsJS_show">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tab_error', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsTabs ipsClearfix ipsJS_show
CONTENT;

if ( $usingIcons ):
$return .= <<<CONTENT
 ipsTabs_withIcons
CONTENT;

endif;
$return .= <<<CONTENT
' id='tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<a href='#tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
			<ul role='tablist'>
				
CONTENT;

foreach ( $tabs as $name => $content ):
$return .= <<<CONTENT

					<li>
						<a href='#ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( $name == $activeTab ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( \in_array( $name, $errorTabs ) ):
$return .= <<<CONTENT
ipsTabs_error
CONTENT;

endif;
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $activeTab == $name ):
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

if ( \in_array( $name, $errorTabs ) ):
$return .= <<<CONTENT
<i class="fa fa-exclamation-circle"></i> 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( isset($tabArray[$name]['icon']) ):
$return .= <<<CONTENT
<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $tabArray[$name]['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div id='ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class=''>
			
CONTENT;

foreach ( $tabs as $name => $contents ):
$return .= <<<CONTENT

				<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
					
CONTENT;

if ( isset( $sidebar[ $name ] ) ):
$return .= <<<CONTENT

						<div class='ipsColumns ipsColumns_collapsePhone'>
							<div class='ipsColumn ipsColumn_fluid'>
					
CONTENT;

endif;
$return .= <<<CONTENT

								<ul class='ipsForm 
CONTENT;
$return .= htmlspecialchars( $formClass, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $tabClasses[ $name ] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $tabClasses[ $name ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
									<li class='ipsJS_hide'>
CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
									{$contents}
								</ul>
					
CONTENT;

if ( isset( $sidebar[ $name ] ) ):
$return .= <<<CONTENT

							</div>
							<div class='ipsColumn ipsColumn_wide'>
								{$sidebar[ $name ]}
							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
		<div class="ipsAreaBackground_light ipsClearfix ipsPad ipsType_center">
			
CONTENT;

$return .= implode( '', $actionButtons);
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</form>
CONTENT;

		return $return;
}

	function uploadNoScript( $name, $value, $required, $multiple ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

		return $return;
}}