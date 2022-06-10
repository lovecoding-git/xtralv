<?php
namespace IPS\Theme\Cache;
class class_core_front_system extends \IPS\Theme\Template
{
	public $cache_key = '1f3c0f841797bc5288baf3b18572146c';
	function announcement( $announcement ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<div>
	<div class='ipsPadding ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $announcement->author(), 'tiny' );
$return .= <<<CONTENT

		<div>
			<p class='ipsType_reset ipsType_large ipsType_blendLinks'>
				
CONTENT;

$htmlsprintf = array($announcement->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

	            
CONTENT;

if ( $announcement->start ):
$return .= <<<CONTENT

	                <br>
	                <span class='ipsType_light ipsType_medium'>
CONTENT;

$val = ( $announcement->start instanceof \IPS\DateTime ) ? $announcement->start : \IPS\DateTime::ts( $announcement->start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
	            
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
		</div>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<div class="ipsPadding">
		<div class='ipsType_pageHeader'>
			<h1 class='ipsType_pageTitle ipsType_largeTitle ipsContained_container'><span class='ipsType_break ipsContained'>
CONTENT;
$return .= htmlspecialchars( $announcement->mapped( 'title' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></h1>
			
CONTENT;

if ( !$announcement->active ):
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announcement_not_active', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $announcement->author(), 'tiny' );
$return .= <<<CONTENT

			<div>
				<p class='ipsType_reset ipsType_large ipsType_blendLinks'>
					
CONTENT;

$htmlsprintf = array($announcement->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

					
CONTENT;

if ( $announcement->start ):
$return .= <<<CONTENT

						<br>
						<span class='ipsType_light ipsType_medium'>
CONTENT;

$val = ( $announcement->start instanceof \IPS\DateTime ) ? $announcement->start : \IPS\DateTime::ts( $announcement->start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
			</div>
		</div>
	</div>
	<br>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<article class='ipsBox ipsPad'>
		<section class='ipsType_richText ipsType_normal' data-controller='core.front.core.lightboxedImages'>
			{$announcement->mapped( 'content' )}
			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_manage_announcements') and ( $announcement->canEdit() or $announcement->canDelete() ) ):
$return .= <<<CONTENT

				<hr class='ipsHr'>
				<a href='#elAnnouncementActions
CONTENT;
$return .= htmlspecialchars( $announcement->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elAnnouncementActions
CONTENT;
$return .= htmlspecialchars( $announcement->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' data-ipsMenu>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_actions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
				<ul id='elAnnouncementActions
CONTENT;
$return .= htmlspecialchars( $announcement->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					
CONTENT;

if ( $announcement->canEdit() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url( 'create' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-destructOnClose='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_announcement', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action='ipsMenu_ping'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $announcement->canDelete() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url( 'delete' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm  title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url( 'status' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

if ( $announcement->active ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_inactive', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_active', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

if ( $announcement->active ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_inactive', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announce_mark_active', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>
				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</section>
	</article>

	
CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function banned( $message, $warnings, $banEnd ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsPad ipsBox'>
	<br>
	<i class='ipsType_huge fa fa-lock'></i>
	<h1 class='ipsType_veryLarge'>
CONTENT;

if ( $banEnd instanceof \IPS\DateTime ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'suspended', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'banned', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h1>
	<p class='ipsType_large'>
		
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</p>
</section>


CONTENT;

if ( $warnings ):
$return .= <<<CONTENT

	<h2 class='ipsType_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warnings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	{$warnings}

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function completeProfile( $form ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsPadding'>
	<br>
	<h1 class='ipsType_veryLarge ipsType_center ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'need_more_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'need_more_info_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	<br>
	<div class='ipsBox ipsPadding'>
		{$form}
	</div>
</section>

CONTENT;

		return $return;
}

	function completeValidation( $member, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT


<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsType_center' data-ipsForm data-ipsFormSubmit>
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


	<div class='ipsType_center ipsBox ipsPad'>
		<h1 class='ipsType_veryLarge ipsType_reset'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'registration_validate_heading', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h1>
		<p class='ipsType_normal ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'registration_validate_explain', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<button type='submit' class='ipsButton ipsButton_veryLarge ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'validate_my_account', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
	</div>
</form>
CONTENT;

		return $return;
}

	function completeWizardTemplate( $stepNames, $activeStep, $output, $baseUrl, $showSteps ) {
		$return = '';
		$return .= <<<CONTENT


<div data-ipsWizard class='ipsWizard'>
	<div data-role="wizardStepbar">
		
CONTENT;

$completion = \intval( (string) \IPS\Member::loggedIn()->profileCompletionPercentage() );
$return .= <<<CONTENT

		<div class="ipsProgressBar ipsProgressBar_fullWidth ipsSpacer_bottom">
			<div class='ipsProgressBar_progress' style='width: 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->profileCompletionPercentage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
%'>
				
CONTENT;

$sprintf = array($completion . '%'); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_completion_percent', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

			</div>
		</div>
	</div>
	<div data-role="wizardContent" class="ipsBox">
		{$output}
	</div>
</div>
CONTENT;

		return $return;
}

	function contact( $form ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('contact') );
$return .= <<<CONTENT

	<div class='ipsBox_alt'>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsPad'>

CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsType_normal'>
			{$form}
		</div>
	</div>

CONTENT;

		return $return;
}

	function contactDone(  ) {
		$return = '';
		$return .= <<<CONTENT


<br><br>
<div class='ipsBox_alt'>
	<p class='ipsType_reset ipsType_center ipsType_huge'>
		<i class='fa fa-envelope'></i>
	</p>

	<h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_sent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

	<div class='ipsType_large ipsType_center ipsType_richText'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_sent_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>
	<br>
	<p class='ipsType_center'>
		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "/", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_normal ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_community_home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</p>
</div>
CONTENT;

		return $return;
}

	function cookies(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$prefix = \IPS\COOKIE_PREFIX;
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('cookies_about') );
endif;
$return .= <<<CONTENT

<div class='ipsBox_alt'>
	<div class='ipsType_normal ipsType_richText ipsPad'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookies_about_header', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</div>
	<h3 class="ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookies_standard', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<div class='ipsType_normal ipsType_richText ipsPad'>
		<strong class="ipsType_medium">
CONTENT;
$return .= htmlspecialchars( $prefix, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
IPSSessionFront</strong>
		<div>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookie_session_front', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		<br>
		<strong class="ipsType_medium">
CONTENT;
$return .= htmlspecialchars( $prefix, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
member_id</strong>
		<div>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookie_member_id', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		<br>
        <strong class="ipsType_medium">
CONTENT;
$return .= htmlspecialchars( $prefix, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
loggedIn</strong>
        <div>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookie_loggedIn', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
        <br>
		<strong class="ipsType_medium">
CONTENT;
$return .= htmlspecialchars( $prefix, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
login_key</strong>
		<div>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookie_login_key', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
        <br>
        <strong class="ipsType_medium">
CONTENT;
$return .= htmlspecialchars( $prefix, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
device_key</strong>
        <div>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookie_device_key', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	</div>
	<h3 class="ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookies_third_party', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<div class='ipsType_normal ipsType_richText ipsPad'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookies_third_party_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
	
	</div>

	<h3 class="ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookies_change_header', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<div class='ipsType_normal ipsType_richText ipsPad'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cookies_change_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
	
	</div>
</div>
CONTENT;

		return $return;
}

	function coppa( $form, $postBeforeRegister ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsPad'>
	<br>
	
CONTENT;

if ( $postBeforeRegister ):
$return .= <<<CONTENT

		<h1 class='ipsType_veryLarge ipsType_center ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_before_register_headline', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		<p class='ipsType_reset ipsType_large ipsType_center ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_before_register_subtext', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></p>
	
CONTENT;

else:
$return .= <<<CONTENT

		<h1 class='ipsType_veryLarge ipsType_center ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		<p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'existing_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<br>

	<div data-role='registerForm' class='ipsBox ipsPad'>
		<section class='ipsType_center'>
			<p class='ipsType_large ipsType_reset'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_verify', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></p>
			<p class='ipsType_normal ipsType_light ipsType_reset'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_verification_only', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Settings::i()->privacy_type != "none" ):
$return .= <<<CONTENT
 <a href='
CONTENT;

if ( \IPS\Settings::i()->privacy_type == "internal" ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=privacy", null, "privacy", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>.
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			<br><br>

			{$form->customTemplate( array( \IPS\Theme::i()->getTemplate( 'system', 'core', 'front' ), 'coppaForm' ) )}
		</section>
	</div>
</section>
CONTENT;

		return $return;
}

	function coppaConsent(  ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPrint">
	<h1>
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
</h1>
	<h2>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>

	
CONTENT;

$sprintf = array(\IPS\Settings::i()->board_name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_intro', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	
	<table>
		<tr>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_child_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_child_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
	</table>
	
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_disclaimer', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
	<div></div>
	<div></div>

	<table>
		<tr>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_relation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
		<tr>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
			<th>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_phone', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
			<td class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
		<tr>
			<th colspan="2">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_sig', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td colspan="2" class="ipsPrint_tripleHeight">&nbsp;</td>
		</tr>
		<tr>
			<th colspan="2">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 </th>
		</tr>
		<tr>
			<td colspan="2" class="ipsPrint_doubleHeight">&nbsp;</td>
		</tr>
	</table>

	<div></div>

	
CONTENT;

if ( \IPS\Settings::i()->privacy_type != "none" ):
$return .= <<<CONTENT

		<p>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_privacy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Settings::i()->privacy_type == "internal" ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=privacy", null, "privacy", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>
		<div></div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->coppa_address ):
$return .= <<<CONTENT

		<p>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_mail', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\GeoLocation::parseForOutput( \IPS\Settings::i()->coppa_address );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->coppa_fax ):
$return .= <<<CONTENT

		<p>
CONTENT;

if ( \IPS\Settings::i()->coppa_address and \IPS\Settings::i()->coppa_fax ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_form_fax', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Settings::i()->coppa_fax;
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function coppaForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT


<form accept-charset='utf-8' method="post" action="
CONTENT;
$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elCoppaForm' class='ipsType_center' data-ipsForm>
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

			
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Date ):
$return .= <<<CONTENT

				<input type="date" class='ipsField_short ipsField_primary' required placeholder="
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

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

	&nbsp;&nbsp;<button type='submit' class='ipsButton ipsButton_large ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'continue', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
</form>
CONTENT;

		return $return;
}

	function finishRegistration( $harryPotter ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsPadding'>
	<h1 class='ipsType_veryLarge ipsType_center ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'complete_your_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<br>
	{$harryPotter}
</section>
CONTENT;

		return $return;
}

	function followForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form 
CONTENT;

if ( \IPS\Request::i()->isAjax()  ):
$return .= <<<CONTENT
data-controller='core.front.core.followForm'
CONTENT;

endif;
$return .= <<<CONTENT
 accept-charset='utf-8' class="ipsForm 
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
 data-ipsForm >
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

	<div>
		<h2 class='ipsType_sectionTitle'>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		<ul class='ipsPadding ipsList_reset'>
			
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

					
CONTENT;

if ( \is_string( $input ) ):
$return .= <<<CONTENT

						{$input}
						<hr class='ipsHr'>
					
CONTENT;

elseif ( $input instanceof \IPS\Helpers\Form\Radio ):
$return .= <<<CONTENT

						<li class="ipsFieldRow">
							<strong class='ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_send_me', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							{$input->html($form)}
							<hr class='ipsHr'>
						</li>
					
CONTENT;

elseif ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT

						{$input->html($form)}
					
CONTENT;

else:
$return .= <<<CONTENT

						{$input->rowHtml($form)}
					
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
	<div class="ipsToolList ipsToolList_horizontal ipsBorder_top ipsPadding">
		{$actionButtons[0]} 
CONTENT;

if ( isset( $actionButtons[1] ) ):
$return .= <<<CONTENT
{$actionButtons[1]}
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</form>
CONTENT;

		return $return;
}

	function followedContent( $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('menu_followed_content') );
$return .= <<<CONTENT

<div class='ipsBox_alt'>
	<div data-role="profileContent">

CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsColumns ipsColumns_collapsePhone">
			<div class="ipsColumn ipsColumn_wide">
				<div class="ipsSideMenu ipsBox ipsPad" data-ipsTabBar data-ipsTabBar-contentArea='#elFollowedContent' data-ipsTabBar-itemselector=".ipsSideMenu_item" data-ipsTabBar-activeClass="ipsSideMenu_itemActive" data-ipsSideMenu>
					<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
						<a href="#user_content" class="ipsPad_double" data-action="openSideMenu"><i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_content_type', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i></a>
					</h3>
					<div>
						
CONTENT;

foreach ( $types as $app => $_types ):
$return .= <<<CONTENT

							
CONTENT;

if ( $app != "core" ):
$return .= <<<CONTENT

								<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$val = "module__{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
								<ul class="ipsSideMenu_list">
									
CONTENT;

foreach ( $_types as $key => $class ):
$return .= <<<CONTENT

										<li><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'type' => $key, 'change_section' => 1 ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == $key ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

if ( is_subclass_of( $class, 'IPS\Content\Item' ) ):
$return .= <<<CONTENT

CONTENT;

$val = "{$class::$title}_pl"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$val = "{$class::$nodeTitle}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a></li>	
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

						<h4 class='ipsSideMenu_subTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'other', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
						<ul class='ipsSideMenu_list'>
							<li><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'type' => 'core_member', 'change_section' => 1 ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsSideMenu_item 
CONTENT;

if ( $currentType == 'core_member' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						</ul>
					</div>			
				</div>
			</div>
			<div class="ipsColumn ipsColumn_fluid" id='elFollowedContent'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->followedContentSection( $types, $currentAppModule, $currentType, (string) $table );
$return .= <<<CONTENT

			</div>
		</div>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function followedContentMemberRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	
CONTENT;

$loadedMember = \IPS\Member::load( $row->member_id );
$return .= <<<CONTENT

	<li class='ipsDataItem' data-controller='core.front.system.manageFollowed' data-followID='
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_area'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
-
CONTENT;
$return .= htmlspecialchars( $row->_followData['follow_rel_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<div class='ipsDataItem_icon'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $loadedMember, 'small' );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<h3 class='ipsType_reset ipsType_large ipsType_unbold'>{$loadedMember->link( NULL, FALSE )}</h3> 
CONTENT;

if ( $loadedMember->isOnline() ):
$return .= <<<CONTENT
<i class="fa fa-circle ipsOnlineStatus_online" data-ipsTooltip title='
CONTENT;

$sprintf = array($row->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_now', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'></i>
CONTENT;

endif;
$return .= <<<CONTENT

			<span class='ipsType_normal'>
CONTENT;

$return .= \IPS\Member\Group::load( $row->member_group_id )->formattedName;
$return .= <<<CONTENT
</span>
			<ul class='ipsList_inline ipsType_light'>
				<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_member_posts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;
$return .= htmlspecialchars( $loadedMember->member_posts, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</li>
				<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;

$val = ( $loadedMember->joined instanceof \IPS\DateTime ) ? $loadedMember->joined : \IPS\DateTime::ts( $loadedMember->joined );$return .= $val->html();
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( $loadedMember->last_activity ):
$return .= <<<CONTENT

					<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_last_visit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;

$val = ( $loadedMember->last_activity instanceof \IPS\DateTime ) ? $loadedMember->last_activity : \IPS\DateTime::ts( $loadedMember->last_activity );$return .= $val->html();
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
$return .= htmlspecialchars( $row->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

	function followedContentSection( $types, $currentAppModule, $currentType, $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsBox cFollowedContent'>
	<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

if ( is_subclass_of( $types[ $currentAppModule ][ $currentType ], 'IPS\Content\Item' ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $types[ $currentAppModule ][ $currentType ]::$title . '_pl' )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stuff_i_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

elseif ( $types[ $currentAppModule ][ $currentType ] == "\IPS\Member" ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_i_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $types[ $currentAppModule ][ $currentType ]::$nodeTitle )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stuff_i_follow', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</h2>
	{$table}
</div>
CONTENT;

		return $return;
}

	function followers( $url, $pagination, $followers, $anonymous, $removeAllUrl ) {
		$return = '';
		$return .= <<<CONTENT

<div data-ipsInfScroll data-ipsInfScroll-scrollScope="#elFollowerList" data-ipsInfScroll-container="#elFollowerListContainer" data-ipsInfScroll-url="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsInfScroll-pageParam="followerPage" data-ipsInfScroll-pageBreakTpl="">
	<div class="ipsJS_hide">{$pagination}</div>
	<div class='ipsFollowerList ipsPad ipsBox_alt ipsScrollbar' id="elFollowerList">
		<ul class="ipsDataList ipsList_reset" id='elFollowerListContainer'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->followersRows( $followers );
$return .= <<<CONTENT

		</ul>
		
CONTENT;

if ( $anonymous ):
$return .= <<<CONTENT

			
CONTENT;

if ( $followers !== NULL and \count( $followers ) ):
$return .= <<<CONTENT

				<div class="ipsPad_half ipsType_center ipsType_light">
CONTENT;

$pluralize = array( $anonymous ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_others', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class="ipsPad_half ipsType_center ipsType_light">
CONTENT;

$pluralize = array( $anonymous ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_anonymous_members', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_remove_followers') ):
$return .= <<<CONTENT

		<ul class="ipsPad ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsAreaBackground">
			<li>
				<a href="
CONTENT;
$return .= htmlspecialchars( $removeAllUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-confirm data-confirmmessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_followers_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class="ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_negative">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_followers', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function followersRows( $followers ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $followers as $follower ):
$return .= <<<CONTENT

	<li class='ipsDataItem ipsClearfix'>
		<div class='ipsDataItem_icon ipsPos_top'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $follower['follow_member_id'] ), 'tiny' );
$return .= <<<CONTENT

		</div>
		<div class='ipsDataItem_main'>
			<strong class='ipsDataItem_title'>
CONTENT;

$link = \IPS\Member::load( $follower['follow_member_id'] )->link();
$return .= <<<CONTENT
{$link}</strong><br>
			<span class='ipsType_light'>
CONTENT;

$val = ( $follower['follow_added'] instanceof \IPS\DateTime ) ? $follower['follow_added'] : \IPS\DateTime::ts( $follower['follow_added'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function guidelines( $guidelines ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<div class='ipsPageHeader sm:ipsPadding:half ipsClearfix ipsMargin_bottom sm:ipsMargin_bottom:half ipsType_center'>
		<h1 class='ipsType_veryLarge'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guidelines', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsType_normal ipsType_richText ipsPadding ipsBox ipsResponsive_pull'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('guidelines_value'), array('ipsType_normal') );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function ignore( $form, $table, $id=0 ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('ignored_users'), \IPS\Member::loggedIn()->language()->addToStack('ignored_users_blurb') );
$return .= <<<CONTENT

<div data-controller='core.front.ignore.new' data-id="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class='ipsBox ipsPadding ipsResponsive_pull ipsMargin_bottom'>
		<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignored_users_add', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignored_users_add_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		<br>
		{$form}
	</div>
	
	<div class='ipsResponsive_pull'>
		{$table}
	</div>
</div>
CONTENT;

		return $return;
}

	function ignoreEditForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT


<form accept-charset='utf-8' id="elIgnoreForm" class="ipsForm 
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
 data-ipsForm data-controller='core.front.ignore.edit'>
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

	<ul class="ipsForm ipsForm_vertical ipsPad">
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			<li class='ipsFieldRow ipsFieldRow_fullWidth'>
				<ul class='ipsFieldRow_content ipsList_reset'>
					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT

							<li class='ipsFieldRow_inlineCheckbox'>
								{$input->html()}
								<label for='check_
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
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

endforeach;
$return .= <<<CONTENT

	</ul>
	<div class='ipsBorder_top ipsPadding ipsType_right'>
		
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

			{$button}
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
</form>
CONTENT;

		return $return;
}

	function ignoreForm( $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' id="elIgnoreForm" class="ipsForm 
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

	<ul class="ipsForm ipsForm_vertical">
		
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

				
CONTENT;

if ( !( $input instanceof \IPS\Helpers\Form\Checkbox ) ):
$return .= <<<CONTENT

					<li class='ipsFieldRow ipsFieldRow_noLabel ipsFieldRow_fullWidth'>
						<div class='ipsFieldRow_content'>
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

						</div>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

			<li class='ipsFieldRow ipsFieldRow_fullWidth' id='elIgnoreTypes'>
				<strong class='ipsFieldRow_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignored_users_ignore', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				<ul class='ipsFieldRow_content ipsList_reset'>
					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( $input instanceof \IPS\Helpers\Form\Checkbox ):
$return .= <<<CONTENT

							<li class='ipsFieldRow_inlineCheckbox'>
								{$input->html()}
								<label for='check_
CONTENT;
$return .= htmlspecialchars( $input->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$input->name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
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

endforeach;
$return .= <<<CONTENT

		<li class='ipsFieldRow' id='elIgnoreSubmitRow'>
			<div class='ipsFieldRow_content'>
				
CONTENT;

foreach ( $actionButtons as $button ):
$return .= <<<CONTENT

					{$button}
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</div>
		</li>
	</ul>
	<div id='elIgnoreLoading'></div>
</form>
CONTENT;

		return $return;
}

	function ignoreTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox' data-baseurl='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-resort='
CONTENT;
$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.global.core.table' id='elTable_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_menu" data-role="tableFilterMenu" id="elFilterByMenu_
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
						<li data-ipsMenuValue='' class='ipsMenu_item 
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'filter' => '', 'group' => \IPS\Request::i()->group ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='
CONTENT;

if ( !array_key_exists( $table->filter, $table->filters ) ):
$return .= <<<CONTENT
ipsButtonRow_active
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

foreach ( $table->filters as $k => $q ):
$return .= <<<CONTENT

							<li data-ipsMenuValue='
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'group' => \IPS\Request::i()->group ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cIgnoreType_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>

	<ol class='ipsDataList ipsGrid ipsGrid_collapsePhone ipsClear' id='elIgnoreUsers' data-role='tableRows'>
		
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

	</ol>

	
CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

		<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function ignoreTableRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty($rows) ):
$return .= <<<CONTENT

	<li class='ipsDataItem'>
		<div class='ipsPad ipsType_light ipsType_center'><br><br>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	</li>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $r ):
$return .= <<<CONTENT

		<li class='ipsDataItem ipsGrid_span6 ipsFaded_withHover' id='elIgnoreRow
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="ignoreRow" data-ignoreUserID='
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='core.front.ignore.existing'>
			<p class='ipsType_reset ipsDataItem_icon'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $r['ignore_ignore_id'] ), 'tiny' );
$return .= <<<CONTENT

			</p>
			<div class='ipsDataItem_main'>
				<h4 class='ipsDataItem_title'><strong data-role="ignoreRowName">
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $r['ignore_ignore_id'] )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></h4>
				<ul class='ipsList_inline'>
					
CONTENT;

foreach ( \IPS\core\Ignore::types() as $t ):
$return .= <<<CONTENT

						
CONTENT;

if ( $r["ignore_{$t}"] ):
$return .= <<<CONTENT

							<li class='ipsType_light'><i class='fa fa-check'></i> 
CONTENT;

$val = "ignore_$t"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endforeach;
$return .= <<<CONTENT

					<li class='ipsFaded'>
						<a href='#elUserIgnore
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elUserIgnore
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_large ipsPos_middle ipsType_blendLinks' data-ipsMenu data-ipsMenu-appendTo='#elIgnoreRow
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='ignoreMenu'>
							<i class='fa fa-cog'></i> <i class='fa fa-caret-down'></i>
						</a>
					</li>
				</ul>

				<ul class='ipsMenu ipsJS_hide' id='elUserIgnore
CONTENT;
$return .= htmlspecialchars( $r['ignore_ignore_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					<li class='ipsMenu_item' data-ipsMenuValue='edit'>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=edit&id={$r['ignore_ignore_id']}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-remoteSubmit data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$sprintf = array(\IPS\Member::load( $r['ignore_ignore_id'] )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_ignore_for', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_ignored_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
					<li class='ipsMenu_item' data-ipsMenuValue='remove'>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$r['ignore_ignore_id']}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
			</div>
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

	function invite( $links, $url ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPad'>
	<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_invite', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
	<hr class='ipsHr'>
	<h5 class='ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_to_site', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>

	<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>

	<h5 class='ipsType_normal ipsType_reset ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_externally', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
	
CONTENT;

if ( \count( $links )  ):
$return .= <<<CONTENT

	<ul class='ipsList_inline ipsList_noSpacing ipsClearfix'>
		
CONTENT;

foreach ( $links as $link  ):
$return .= <<<CONTENT

		<li>{$link}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function login( $login, $ref, $error ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $login->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller="core.global.core.login" class='ipsBox_alt'>
	<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

if ( $ref ):
$return .= <<<CONTENT

		<input type="hidden" name="ref" value="
CONTENT;
$return .= htmlspecialchars( $ref, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$usernamePasswordMethods = $login->usernamePasswordMethods();
$return .= <<<CONTENT

	
CONTENT;

$buttonMethods = $login->buttonMethods();
$return .= <<<CONTENT

	
CONTENT;

if ( $usernamePasswordMethods and $buttonMethods ):
$return .= <<<CONTENT

		
CONTENT;

if ( $error ):
$return .= <<<CONTENT

			<div class="ipsMessage ipsMessage_error">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class='ipsColumns ipsColumns_collapsePhone'>
			<div class='ipsColumn ipsColumn_fluid'>
				<div class='
CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
ipsBox ipsResponsive_pull
CONTENT;

endif;
$return .= <<<CONTENT
 ipsPadding'>
					
CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

						<h1 class='ipsType_reset ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
						
CONTENT;

if ( \IPS\Login::registrationType() != 'disabled' ):
$return .= <<<CONTENT

							<p class='ipsType_reset ipsType_large ipsType_light'>
								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dont_have_an_account', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\Login::registrationType() == 'redirect' ):
$return .= <<<CONTENT

									<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_reg_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener">
								
CONTENT;

else:
$return .= <<<CONTENT

									<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Login::registrationType() == 'normal' ):
$return .= <<<CONTENT
data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</p>
							<hr class='ipsHr ipsMargin_vertical'>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->loginForm( $login );
$return .= <<<CONTENT

				</div>
			</div>
			<div class='ipsColumn ipsColumn_veryWide'>
				<div class='
CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
ipsBox ipsResponsive_pull
CONTENT;

endif;
$return .= <<<CONTENT
 ipsPadding'>
					<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_faster', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
					
CONTENT;

if ( \count( $buttonMethods ) > 1 ):
$return .= <<<CONTENT

						<p class='ipsType_normal ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_with_these', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<div class='ipsGap:2 ipsMargin_top:half'>
						
CONTENT;

foreach ( $buttonMethods as $method ):
$return .= <<<CONTENT

							<div class='cLogin_social ipsType_center'>
								{$method->button()}
							</div>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</div>
				</div>
			</div>
		</div>
	
CONTENT;

elseif ( $usernamePasswordMethods ):
$return .= <<<CONTENT

		<div class='cLogin_single ipsPos_center'>
		
CONTENT;

if ( $error ):
$return .= <<<CONTENT

			<p class="ipsMessage ipsMessage_error">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

			<div class="
CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
ipsBox ipsResponsive_pull
CONTENT;

endif;
$return .= <<<CONTENT
 ipsPadding">
				
CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

					<h1 class='ipsType_reset ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
					
CONTENT;

if ( \IPS\Login::registrationType() != 'disabled' ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsType_large ipsType_light'>
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dont_have_an_account', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Login::registrationType() == 'redirect' ):
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_reg_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener">
							
CONTENT;

else:
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Login::registrationType() == 'normal' ):
$return .= <<<CONTENT
data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</p>
						<hr class='ipsHr ipsMargin_vertical'>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->loginForm( $login );
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

elseif ( $buttonMethods ):
$return .= <<<CONTENT

		<div class="cLogin_single ipsPos_center">
			
CONTENT;

if ( $error ):
$return .= <<<CONTENT

				<p class="ipsMessage ipsMessage_error">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

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
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</form>

CONTENT;

		return $return;
}

	function loginForm( $login ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsForm'>
	<li class="ipsFieldRow ipsFieldRow_fullWidth ipsClearfix">
		
CONTENT;

$authType = $login->authType();
$return .= <<<CONTENT

		<label class="ipsFieldRow_label" for="auth">
			
CONTENT;

if ( $authType === \IPS\Login::AUTH_TYPE_USERNAME ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

elseif ( $authType === \IPS\Login::AUTH_TYPE_EMAIL ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username_or_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<span class="ipsFieldRow_required">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</label>
		<div class="ipsFieldRow_content">
			
CONTENT;

if ( $authType === \IPS\Login::AUTH_TYPE_USERNAME ):
$return .= <<<CONTENT

				<input type="text" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" id="auth" 
CONTENT;

if ( isset( \IPS\Request::i()->auth ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->auth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 autocomplete="username">
			
CONTENT;

elseif ( $authType === \IPS\Login::AUTH_TYPE_EMAIL ):
$return .= <<<CONTENT

				<input type="email" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" id="auth" 
CONTENT;

if ( isset( \IPS\Request::i()->auth ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->auth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 autocomplete="email">
			
CONTENT;

else:
$return .= <<<CONTENT

				<input type="text" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username_or_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" id="auth" 
CONTENT;

if ( isset( \IPS\Request::i()->auth ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->auth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 autocomplete="email">
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</li>
	<li class="ipsFieldRow ipsFieldRow_fullWidth ipsClearfix">
		<label class="ipsFieldRow_label" for="password">
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			<span class="ipsFieldRow_required">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</label>
		<div class="ipsFieldRow_content">
			<input type="password" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="password" id="password" 
CONTENT;

if ( isset( \IPS\Request::i()->password ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->password, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 autocomplete="current-password">
		</div>
	</li>
	<li class="ipsFieldRow ipsFieldRow_checkbox ipsClearfix">
		<span class="ipsCustomInput">
			<input type="checkbox" name="remember_me" id="remember_me_checkbox" value="1" checked aria-checked="true">
			<span></span>
		</span>
		<div class="ipsFieldRow_content">
			<label class="ipsFieldRow_label" for="remember_me_checkbox">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remember_me', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
			<span class="ipsFieldRow_desc">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remember_me_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		</div>
	</li>
	<li class="ipsFieldRow ipsFieldRow_fullWidth">
		<button type="submit" name="_processLogin" value="usernamepassword" class="ipsButton ipsButton_primary ipsButton_small" id="elSignIn_submit">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
		
CONTENT;

if ( \IPS\Settings::i()->allow_forgot_password != 'disabled' ):
$return .= <<<CONTENT

			<p class="ipsType_right ipsType_small">
				
CONTENT;

if ( \IPS\Settings::i()->allow_forgot_password == 'redirect' ):
$return .= <<<CONTENT

					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_forgot_password_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener">
				
CONTENT;

else:
$return .= <<<CONTENT

					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=lostpass", null, "lostpassword", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</li>
</ul>
CONTENT;

		return $return;
}

	function lostPass( $form ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('lost_password') );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsBox ipsPadding'>
	{$form}
</div>

CONTENT;

		return $return;
}

	function lostPassConfirm( $message ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('lost_password') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection ipsBox ipsPadding'>
	
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function manageFollow( $app, $area, $id ) {
		$return = '';
		$return .= <<<CONTENT


<div data-followApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followArea='
CONTENT;
$return .= htmlspecialchars( $area, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-followID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-buttonType='manage' data-controller='core.front.core.followButton'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core" )->manageFollowButton( $app, $area, $id );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function manageFollowButton( $app, $area, $id ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

		<div class="ipsFollow" data-role="followButton">
			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_light ipsButton_fullWidth ipsButton_verySmall' data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_change_preference', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function mergeSocialAccount( $handler, $existingAccount, $login, $error ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsSpacer_both">
	<h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_your_accounts', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<p class='ipsType_large ipsType_center ipsType_light'>
CONTENT;

$sprintf = array($handler->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'link_your_accounts_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
</div>
<div class='ipsBox ipsPadding'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->reauthenticate( $login, $error );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function mfaAccountRecovery( $message ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('mfa_account_recovery') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection'>
	
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function mfaKnownDeviceInfo( $url ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elTwoFactorAuthentication' class='ipsModal' data-controller='core.global.core.2fa'>
	<div>
		<h1 class='ipsType_center ipsType_pageTitle ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_account_recovery', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
		<p class='ipsType_medium ipsType_richText ipsType_center c2FA_info'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_recovery_known_device_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
		<div class="ipsPad">
			<ul class="ipsList_reset">
				<li class="ipsSpacer_bottom ipsSpacer_half">
					<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_primary ipsButton_fullWidth ipsButton_medium">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
				<li>
					<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( '_mfa' => 'alt', '_mfaMethod' => '' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link ipsButton_medium ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_try_another_method', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-right'></i></a>
				</li>
			</ul>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function myAttachments( $files, $used ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPageHeader ipsClearfix">
	<h1 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
</div>

CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] > 0 ):
$return .= <<<CONTENT

	<div class='ipsAreaBackground_light ipsPad'>
		<p>
CONTENT;

$sprintf = array(\IPS\Output\Plugin\Filesize::humanReadableFilesize( $used ), \IPS\Output\Plugin\Filesize::humanReadableFilesize( \IPS\Member::loggedIn()->group['g_attach_max'] * 1024 )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( empty($files) ):
$return .= <<<CONTENT

	<div class='ipsPad ipsAreaBackground_light'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_empty', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

$id = mb_substr( $url, mb_strrpos( $url, '=' ) + 1 );
$return .= <<<CONTENT

			<div class='ipsDataItem ipsAttach ipsAttach_done'>
				<div class='ipsDataItem_generic ipsDataItem_size1 ipsResponsive_hidePhone ipsResponsive_block ipsType_center'>
					
CONTENT;

if ( \in_array( mb_strtolower( mb_substr( $file->filename, mb_strrpos( $file->filename, '.' ) + 1 ) ), \IPS\Image::$imageExtensions ) ):
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $file, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><img src="
CONTENT;
$return .= htmlspecialchars( $file, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt='' class='ipsImage' data-ipsLightbox data-ipsLightbox-group="myAttachments"></a>
					
CONTENT;

else:
$return .= <<<CONTENT

						<i class='fa fa-file ipsType_large'></i>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main' data-action='selectFile'>
					<h2 class='ipsDataItem_title ipsType_reset ipsType_medium ipsAttach_title ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $file->originalFilename, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
					<p class='ipsDataItem_meta ipsType_light'>
						
CONTENT;

$return .= \IPS\Output\Plugin\Filesize::humanReadableFilesize( $file->filesize() );
$return .= <<<CONTENT

					</p>
				</div>
				<div class='ipsDataItem_generic ipsDataItem_size6 ipsType_right'>
					<ul class='ipsButton_split'>
						<li>
							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=attachments&do=view&id={$id}", null, "attachments", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments_view', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-search'></i></a>
						</li>
					</ul>
				</div>		
			</div>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function notAdminValidated(  ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsPadding ipsBox'>
	<br>
	<i class='ipsType_huge fa fa-lock'></i>
	<h1 class='ipsType_veryLarge'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_admin_validation', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

	<p class='ipsType_large'>
		
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->email); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_admin_validation_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</p>
	
CONTENT;

$guest = new \IPS\Member;
$return .= <<<CONTENT

	<p class='ipsType_normal'>
		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary'>
CONTENT;

if ( $guest->group['g_view_board'] ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_continue_as_guest', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
	</p>
	<hr class='ipsHr'>
	<ul class='ipsToolList ipsToolList_horizontal ipsPos_center'>
		<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=cancel" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' data-confirm data-confirmMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	</ul>
</section>
CONTENT;

		return $return;
}

	function notCoppaValidated(  ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsPadding ipsBox'>
	<h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_consent_required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<br>

	<div data-role='registerForm'>
		<p class='ipsType_large'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_consent_required_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
		<br><br>

		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=coppaForm", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'coppa_print_form', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</section>
CONTENT;

		return $return;
}

	function notValidated( $validating=array() ) {
		$return = '';
		$return .= <<<CONTENT

<section class='ipsType_center ipsBox ipsPadding'>
	<br><br>
	<i class='ipsType_huge fa fa-envelope'></i>
	<h1 class='ipsType_veryLarge'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_confirm_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

	<p class='ipsType_large'>
		
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->email); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_confirm_email_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</p>
	<p class='ipsType_large'>
		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_confirm_email_must', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</p>
	<hr class='ipsHr'>
	<p class='ipsType_normal'>
		<ul class='ipsToolList ipsToolList_horizontal ipsPos_center'>
			<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=resend" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_resend_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=changeEmail", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_change_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-modal='true' class='ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_change_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

if ( $validating['new_reg'] ):
$return .= <<<CONTENT

				<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register&do=cancel" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_verySmall' data-confirm data-confirmMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_cancel', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</p>
</section>
CONTENT;

		return $return;
}

	function notificationSettingsIndex( $categories ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('notification_options') );
$return .= <<<CONTENT

<div class="ipsBox ipsSpacer_both">
	<h2 class="ipsType_sectionTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'what_notifications_you_receive', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	<ul class="ipsDataList ipsDataList_clickableRows" >
		
CONTENT;

foreach ( $categories as $k => $enabled ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->notificationSettingsIndexRow( $k, $enabled );
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
<div class="ipsBox ipsSpacer_both ipsSpacer_double">
	<h2 class="ipsType_sectionTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'where_you_receive_notifications', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	<div class="ipsGrid ipsGrid_collapsePhone">
		<div class="ipsGrid_span
CONTENT;

if ( \IPS\Settings::i()->mobile_app_id and \IPS\Member::loggedIn()->members_bitoptions['mobile_notifications'] ):
$return .= <<<CONTENT
4
CONTENT;

else:
$return .= <<<CONTENT
6
CONTENT;

endif;
$return .= <<<CONTENT
 ipsPad">
			<div class="cNotificationMethodIcon">
				<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "notification_settings/notification_bell.svg", "", '', false );
$return .= <<<CONTENT
">
			</div>
			<div class="cNotificationMethodDetails">
				<p class="ipsType_reset ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_inline', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<p class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_inline_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<ul class="ipsField_fieldList ipsJS_show">
					<li>
						<span class="ipsCustomInput">
							<input type="checkbox" id="elNotificationSounds" 
CONTENT;

if ( !\IPS\Member::loggedIn()->members_bitoptions['disable_notification_sounds'] ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 data-callback="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=sounds" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
							<span></span>
						</span>
						<div class="ipsField_fieldList_content">
							<label for="elNotificationSounds" id="elNotificationSounds_label">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_prefs_sound', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
						</div>
					</li>
					<li class="ipsHide" data-role="browserNotifyInfo">
						<span class="ipsCustomInput">
							<input type="checkbox" id="elBrowserNotifications">
							<span></span>
						</span>
						<div class="ipsField_fieldList_content">
							<label for="elBrowserNotifications" id="elBrowserNotifications_label">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_browser', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							<div class='ipsFieldRow_desc ipsHide' data-role="browserNotifyDisabled">
								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_browser_disabled', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		
CONTENT;

if ( \IPS\Settings::i()->mobile_app_id and \IPS\Member::loggedIn()->members_bitoptions['mobile_notifications'] ):
$return .= <<<CONTENT

			<div class="ipsGrid_span4 ipsPad">
				<div class="cNotificationMethodIcon">
					<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "notification_settings/push.svg", "", '', false );
$return .= <<<CONTENT
">
				</div>
				<div class="cNotificationMethodDetails">
					<p class="ipsType_reset ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_push', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					<p class="ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_push_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=disable&type=push" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_push_stop', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsGrid_span
CONTENT;

if ( \IPS\Settings::i()->mobile_app_id and \IPS\Member::loggedIn()->members_bitoptions['mobile_notifications'] ):
$return .= <<<CONTENT
4
CONTENT;

else:
$return .= <<<CONTENT
6
CONTENT;

endif;
$return .= <<<CONTENT
 ipsPad">
			<div class="cNotificationMethodIcon">
				<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "notification_settings/email.svg", "", '', false );
$return .= <<<CONTENT
">
			</div>
			<div class="cNotificationMethodDetails">
				<p class="ipsType_reset ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<p class="ipsType_light">
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->email); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_email_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=disable&type=email" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_notifications_email_stop', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function notificationSettingsIndexRow( $k, $enabled ) {
		$return = '';
		$return .= <<<CONTENT

<li class="ipsDataItem ipsLoading_tiny md:ipsPadding:none">
	<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options&type={$k}", null, "notifications_options", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsType_blendLinks md:ipsPadding" data-action="showNotificationSettings">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->notificationSettingsIndexRowDetails( $k, $enabled );
$return .= <<<CONTENT

	</a>
	<div data-role="notificationSettingsWindow" class="ipsHide ipsDataItem_main">
		
	</div>
</li>
CONTENT;

		return $return;
}

	function notificationSettingsIndexRowDetails( $k, $enabled ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPos_right cNotificationSettings_expand ipsType_center">
	&nbsp;
	<i class="fa fa-caret-down"></i>
</div>
<div class="ipsDataItem_main">
	<h3 class="ipsDataItem_title ipsType_reset">
		
CONTENT;

$val = "notifications__$k"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	</h3>
</div>
<div class="ipsDataItem_generic ipsDataItem_size6 ipsType_light">
	
CONTENT;

foreach ( $enabled as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( $v['icon'] !== 'envelope-o' and $v['icon'] !== 'bell-o' and $v['icon'] !== 'mobile' ):
$return .= <<<CONTENT

			<div 
CONTENT;

if ( isset( $v['description'] ) ):
$return .= <<<CONTENT
title="
CONTENT;

$val = "{$v['description']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip
CONTENT;

endif;
$return .= <<<CONTENT
>
				<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $v['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></i> 
CONTENT;
$return .= htmlspecialchars( $v['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
<div class="ipsDataItem_generic ipsDataItem_size6 ipsType_light">
	
CONTENT;

foreach ( $enabled as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( $v['icon'] === 'bell-o' or $v['icon'] === 'mobile' ):
$return .= <<<CONTENT

			<div>
				<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $v['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></i> 
CONTENT;
$return .= htmlspecialchars( $v['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
<div class="ipsDataItem_generic ipsDataItem_size3 ipsType_light">
	
CONTENT;

foreach ( $enabled as $k => $v ):
$return .= <<<CONTENT

		
CONTENT;

if ( $v['icon'] === 'envelope-o' ):
$return .= <<<CONTENT

			<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $v['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></i> 
CONTENT;
$return .= htmlspecialchars( $v['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function notificationSettingsType( $title, $form, $ajax=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $ajax ):
$return .= <<<CONTENT

	<div class='md:ipsPadding'>
		<div class="ipsClearfix">
			<a href="#" class="ipsDialog_close" data-action="closeNotificationSettings">×</a>
			<h3 class="ipsDataItem_title ipsType_reset">
				
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</h3>
		</div>
		<div class="ipsSpacer_top">
			{$form}
		</div>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( $title );
$return .= <<<CONTENT

	<div class="ipsBox ipsPad">
		{$form}
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function notifications( $table ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<div class="ipsPos_right">
		<a class="ipsButton ipsButton_link" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
"><i class="fa fa-cog"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		<a class="ipsButton ipsButton_link" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&format=rss", null, "notifications_rss", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
"><i class="fa fa-rss"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</div>
<div class='ipsBox'>
	{$table}
</div>
CONTENT;

		return $return;
}

	function notificationsAjax( $notifications ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( empty( $notifications ) ):
$return .= <<<CONTENT

	<li class='ipsDataItem ipsDataItem_unread'>
		<div class='ipsPad ipsType_light ipsType_center ipsType_normal'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results_notifications', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	</li>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

foreach ( $notifications as $notification ):
$return .= <<<CONTENT

		<li class='ipsDataItem 
CONTENT;

if ( !$notification['notification']->read_time ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
'>
			<div class='ipsDataItem_icon'>
				
CONTENT;

if ( isset( $notification['data']['author'] ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $notification['data']['author'], 'mini' );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<a href="
CONTENT;
$return .= htmlspecialchars( $notification['data']['url'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					<span class='ipsDataItem_title ipsType_break'>
CONTENT;
$return .= htmlspecialchars( $notification['data']['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					<br>
					<span class="ipsType_light">
CONTENT;

$val = ( $notification['notification']->updated_time instanceof \IPS\DateTime ) ? $notification['notification']->updated_time : \IPS\DateTime::ts( $notification['notification']->updated_time );$return .= $val->html();
$return .= <<<CONTENT
</span>
				</a>
			</div>
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

	function notificationsRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT
 
	
CONTENT;

foreach ( $rows as $notification ):
$return .= <<<CONTENT

		
CONTENT;

if ( isset( $notification['data']['title'] ) ):
$return .= <<<CONTENT

			<li class='ipsDataItem 
CONTENT;

if ( $notification['data']['unread'] ):
$return .= <<<CONTENT
ipsDataItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix'>
				<div class='ipsDataItem_icon'>
					
CONTENT;

if ( isset( $notification['data']['author'] ) ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $notification['data']['author'], 'tiny' );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main'>
					
CONTENT;

if ( !$notification['data']['unread'] ):
$return .= <<<CONTENT

						<span class="ipsItemStatus ipsItemStatus_small ipsItemStatus_read">
							<i class="fa fa-circle"></i>
						</span>
						<strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

							<a href="
CONTENT;
$return .= htmlspecialchars( $notification['data']['url'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsDataItem_title'>
CONTENT;
$return .= htmlspecialchars( $notification['data']['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					
CONTENT;

if ( !$notification['data']['unread'] ):
$return .= <<<CONTENT

						</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<br>
					<span class="ipsType_light">
CONTENT;

$val = ( $notification['notification']->updated_time instanceof \IPS\DateTime ) ? $notification['notification']->updated_time : \IPS\DateTime::ts( $notification['notification']->updated_time );$return .= $val->html();
$return .= <<<CONTENT
</span>
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
}

	function notificationsTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>
	<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
	<div class="ipsPos_right">
		<a class="ipsButton ipsButton_light ipsButton_verySmall" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
"><i class="fa fa-cog"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</div>

<div class='ipsBox'>
	
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


	
CONTENT;

if ( \is_array( $rows ) AND \count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsClear cForumTopicTable 
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

		<div class='ipsType_center ipsPadding:half'>
			<p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		</div>
	
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

	function offline( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div id='ipsLayout_mainArea'>
	<div class='ipsBox_alt'>
		<br>
		<h1 class='ipsType_pageTitle'>
CONTENT;

$sprintf = array(\IPS\Settings::i()->board_name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'offline_unavailable', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h1>
		<br>
		<div class='ipsRichText ipsType_normal'>
			{$message}
		</div>
		<br>
		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_medium ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

else:
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_medium ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function pixabay( $uploader ) {
		$return = '';
		$return .= <<<CONTENT

<div data-controller='core.global.stockart.pixabay' data-uploader="
CONTENT;
$return .= htmlspecialchars( $uploader, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class='ipsPixabay_content' data-role='pixabayResults'>
		<div data-role='pixabayLoading'>
			
		</div>
		<div class='ipsPixabay_moar' data-role='pixabayMore' data-offset='0'>
			<div data-role='pixabayMoreLoading' class='ipsType_light ipsHide ipsSpacer_bottom'><i class='fa fa-circle-o-notch fa-spin fa-fw'></i>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		</div>
	</div>
	<div class='ipsMenu_footerBar'>
		<input type='text' data-role='pixabaySearch' class='ipsField_fullWidth' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
		<a href="https://pixabay.com/" target='_blank' rel="noopener external nofollow" class="ipsPixabay_attribution"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 123.87"><g><path d="M523.513 40.165c-3.478-2.46-6.005-4.955-6.005-8.033H498.17c0 5.539-2.527 8.033-5.645 8.033h-5.164v56.236h100.42V40.165h-64.63zm-6.006 16.067h-18.096V48.2h20.084v6.464zm33.991 31.276c-11.457 0-20.779-9.201-20.779-20.513s9.322-20.04 20.78-20.04c11.456 0 20.777 8.729 20.777 20.04s-9.32 20.513-20.778 20.513zm11.17-20.513c0 6.08-5.01 11.028-11.169 11.028-6.159 0-11.17-4.947-11.17-11.028 0-6.08 5.011-11.027 11.17-11.027 6.158 0 11.17 4.947 11.17 11.027zm77.334-34.48l-25 63.735-19.185-7.693V77.695l13.323 5.452 17.592-44.844-65.92-25.205-6.11 19.034h-11L554.95-.003l85.053 32.52z"/><g><path d="M33.952 28.507c16.562-.38 32.107 13.09 33.856 29.606C69.9 72.627 61.362 87.7 47.98 93.592 39.874 97.616 30.72 96.38 22 96.585h-8.518v27.29H-.011c.03-21.057-.054-42.116.042-63.174.441-15.684 13.287-29.735 28.795-31.823a34.551 34.551 0 015.126-.372zm0 54.582c9.733.244 18.861-7.35 20.314-16.992 1.94-9.706-4.252-20.135-13.717-23.046-9.141-3.244-20.14 1.027-24.604 9.66-3.464 5.897-2.233 12.87-2.463 19.369v11.01h20.47zM74.334 28.177h13.34v68.08h-13.34v-68.08zM127.764 71.16h.486l18.963 25.284h16.531l-25.77-35.008 22.853-33.063h-16.532L128.25 51.71h-.486l-16.046-23.338H95.187l22.852 33.063-25.77 35.008h16.532z"/><path d="M193.953 28.177c13.511-.267 26.471 8.585 31.472 21.082 2.61 5.804 2.574 12.234 2.49 18.465v28.532c-12.04-.041-24.085.083-36.124-.065-13.842-.675-26.5-10.768-30.462-24.013-3.633-11.515-.614-24.886 7.936-33.485 6.388-6.608 15.465-10.604 24.687-10.516zm20.47 54.586c-.058-7.57.121-15.147-.1-22.711-.798-10.142-10.192-18.639-20.37-18.378-9.678-.234-18.8 7.274-20.315 16.854-1.773 9.194 3.505 19.212 12.279 22.643 5.404 2.357 11.373 1.385 17.085 1.592h11.42zM268.523 28.507c15.98-.394 30.91 12.179 33.455 27.916 2.887 14.915-5.539 31.029-19.427 37.169-13.573 6.406-31.026 2.278-40.36-9.46-5.784-6.815-8.277-15.875-7.784-24.709V1.216H247.9v27.29c6.874.001 13.75-.001 20.623.002zm0 54.582c10.248.274 19.616-8.33 20.367-18.525 1.285-10.133-6.226-20.324-16.256-22.166-5.546-.759-11.18-.248-16.766-.398H247.9c.087 7.691-.184 15.397.155 23.078 1.072 10.161 10.261 18.21 20.468 18.011zM341.648 28.177c13.513-.267 26.472 8.586 31.473 21.082 2.61 5.804 2.574 12.234 2.49 18.465v28.532c-12.04-.041-24.085.083-36.124-.065-13.841-.675-26.499-10.768-30.462-24.013-3.632-11.515-.614-24.886 7.936-33.485 6.388-6.608 15.465-10.604 24.687-10.516zm20.47 54.586c-.057-7.57.122-15.147-.099-22.711-.798-10.142-10.192-18.639-20.371-18.378-9.677-.234-18.8 7.274-20.314 16.854-1.773 9.194 3.505 19.212 12.279 22.643 5.404 2.357 11.373 1.385 17.085 1.592h11.42zM449.87 28.342c-.028 21.007.055 42.017-.041 63.022-.49 16.533-14.697 31.392-31.284 32.256-3.151.166-6.308.065-9.463.093V110.22c5.758-.029 11.918.556 17.017-2.705 6.37-3.573 10.418-10.779 10.274-18.066-11.96 9.644-30.502 9.143-42.133-.811-8.474-6.841-13.105-17.846-12.45-28.675v-31.62h13.492c.062 12.019-.127 24.046.1 36.059.732 9.893 9.554 18.266 19.468 18.502 10.047.772 19.717-7.03 21.216-16.969.605-5.946.176-11.952.305-17.924V28.343h13.497z"/></g></g></svg></a>
	</div>
</div>

CONTENT;

		return $return;
}

	function privacy( $subprocessors ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('privacy') );
endif;
$return .= <<<CONTENT

<div class='ipsBox_alt ipsType_normal ipsType_richText ipsPad'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('privacy_text_value'), array('ipsType_normal') );
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->site_address and \IPS\Settings::i()->site_address != "null" ):
$return .= <<<CONTENT

		<p>
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
, 
CONTENT;

$return .= \IPS\GeoLocation::parseForOutput( \IPS\Settings::i()->site_address );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $subprocessors and \count($subprocessors) ):
$return .= <<<CONTENT

	<div>
		<h3 class="ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pp_third_parties', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
		
CONTENT;

foreach ( $subprocessors as $processor ):
$return .= <<<CONTENT

			<div class="ipsPadding_bottom">
				<strong>
CONTENT;
$return .= htmlspecialchars( $processor['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
				<div>
CONTENT;
$return .= htmlspecialchars( $processor['description'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
				<div><a href="
CONTENT;
$return .= htmlspecialchars( $processor['privacyUrl'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pp_privacy_policy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></div>
			</div>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function profileCompleteSocial( $step, $socialButton, $action ) {
		$return = '';
		$return .= <<<CONTENT

	{$socialButton}

	
CONTENT;

if ( !$step->required OR $step->completed() ):
$return .= <<<CONTENT

		<ul class="ipsPad ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix ipsAreaBackground">
			<li><a href="
CONTENT;
$return .= htmlspecialchars( $action->setQueryString('_moveToStep', $step->getNextStep()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="wizardLink" class="ipsButton ipsButton_link ipsJS_none">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_complete_skip_step', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reauthenticate( $login, $error, $blurb=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $login->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller="core.global.core.login">
	<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

$usernamePasswordMethods = $login->usernamePasswordMethods();
$return .= <<<CONTENT

	
CONTENT;

$buttonMethods = $login->buttonMethods();
$return .= <<<CONTENT

	
CONTENT;

$usernamePasswordMethods = $login->usernamePasswordMethods();
$return .= <<<CONTENT

	
CONTENT;

$buttonMethods = $login->buttonMethods();
$return .= <<<CONTENT

	
CONTENT;

if ( $blurb ):
$return .= <<<CONTENT

		<p class='ipsType_normal ipsType_reset ipsSpacer_bottom'>
			
CONTENT;

$val = "{$blurb}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $error ):
$return .= <<<CONTENT

		<div class="ipsMessage ipsMessage_error">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $usernamePasswordMethods and $buttonMethods ):
$return .= <<<CONTENT

		<div class='ipsColumns ipsColumns_collapsePhone'>
			<div class='ipsColumn ipsColumn_fluid'>
				<p class='ipsType_normal ipsType_reset ipsSpacer_bottom'>
					
CONTENT;

if ( $blurb ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate_password_blurb2', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate_password_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
				<ul class='ipsForm'>
					<li class="ipsFieldRow ipsFieldRow_fullWidth ipsClearfix">
						<div class="ipsFieldRow_content">
							<input type="password" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="password" id="password" 
CONTENT;

if ( isset( \IPS\Request::i()->password ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->password, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 autocomplete="current-password">
						</div>
					</li>
					<li class="ipsFieldRow ipsFieldRow_fullWidth">
						<button type="submit" name="_processLogin" value="usernamepassword" class="ipsButton ipsButton_primary ipsButton_small" id="elSignIn_submit">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
					</li>
				</ul>
				
CONTENT;

if ( \IPS\Settings::i()->allow_forgot_password != 'disabled' ):
$return .= <<<CONTENT

					<p class="ipsType_right ipsType_small">
						
CONTENT;

if ( \IPS\Settings::i()->allow_forgot_password == 'redirect' ):
$return .= <<<CONTENT

							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_forgot_password_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener">
						
CONTENT;

else:
$return .= <<<CONTENT

							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=lostpass", null, "lostpassword", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsColumn ipsColumn_veryWide'>
				<p class='ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate_alt_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
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
			</div>
		</div>
	
CONTENT;

elseif ( $usernamePasswordMethods ):
$return .= <<<CONTENT

		<p class='ipsType_normal ipsType_reset ipsSpacer_bottom'>
			
CONTENT;

if ( $blurb ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate_password_blurb2', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate_password_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</p>
		<ul class='ipsForm'>
			<li class="ipsFieldRow ipsClearfix">
				<div class="ipsFieldRow_content">
					<input type="password" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="password" id="password" 
CONTENT;

if ( isset( \IPS\Request::i()->password ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->password, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
				</div>
			</li>
			<li class="ipsFieldRow">
				<button type="submit" name="_processLogin" value="usernamepassword" class="ipsButton ipsButton_primary ipsButton_small" id="elSignIn_submit">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				
CONTENT;

if ( \IPS\Settings::i()->allow_forgot_password != 'disabled' ):
$return .= <<<CONTENT

					&nbsp;&nbsp;&nbsp;
					
CONTENT;

if ( \IPS\Settings::i()->allow_forgot_password == 'redirect' ):
$return .= <<<CONTENT

						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_forgot_password_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener" class="ipsType_small">
					
CONTENT;

else:
$return .= <<<CONTENT

						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=lostpass", null, "lostpassword", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class="ipsType_small">
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		</ul>
	
CONTENT;

elseif ( $buttonMethods ):
$return .= <<<CONTENT

		
CONTENT;

if ( !$blurb ):
$return .= <<<CONTENT

			<p class='ipsType_normal ipsType_reset ipsSpacer_bottom'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reauthenticate_button_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

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
	
CONTENT;

endif;
$return .= <<<CONTENT

	
</form>

CONTENT;

		return $return;
}

	function reconfirmTerms( $terms, $privacy, $form, $subprocessors ) {
		$return = '';
		$return .= <<<CONTENT


<div class="ipsBox">
	<div class="ipsPadding">

		
CONTENT;

if ( \IPS\Member::loggedIn()->joined->getTimestamp() < ( time() - 60 ) ):
$return .= <<<CONTENT

			<div class="ipsType_large ipsSpacer_bottom">
				
CONTENT;

if ( $terms and $privacy ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reconfirm_terms_and_policy_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

elseif ( $terms ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reconfirm_terms_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reconfirm_privacy_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

if ( $terms ):
$return .= <<<CONTENT

			<div class="ipsSpacer_bottom">
				<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_terms', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<div class='ipsType_normal ipsType_richText ipsPadding'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reg_rules_value', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
		
CONTENT;

if ( $privacy ):
$return .= <<<CONTENT

			<div class="ipsSpacer_bottom">
				<h2 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'privacy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<div class='ipsType_normal ipsType_richText ipsPadding'>
					
CONTENT;

if ( \IPS\Settings::i()->privacy_type == 'external' ):
$return .= <<<CONTENT

						<a href='
CONTENT;

$return .= \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT
' rel='external'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_privacy_policy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('privacy_text_value'), array('ipsType_normal') );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Settings::i()->site_address and \IPS\Settings::i()->site_address != "null" ):
$return .= <<<CONTENT

						<p>
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
, 
CONTENT;

$return .= \IPS\GeoLocation::parseForOutput( \IPS\Settings::i()->site_address );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $subprocessors and \count($subprocessors) ):
$return .= <<<CONTENT

					<div>
						<h3 class="ipsType_large">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pp_third_parties', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
						
CONTENT;

foreach ( $subprocessors as $processor ):
$return .= <<<CONTENT

							<div class="ipsPadding_bottom">
								<strong>
CONTENT;
$return .= htmlspecialchars( $processor['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
								<div>
CONTENT;
$return .= htmlspecialchars( $processor['description'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
								<div><a href="
CONTENT;
$return .= htmlspecialchars( $processor['privacyUrl'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pp_privacy_policy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></div>
							</div>
						
CONTENT;

endforeach;
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

	</div>
	<div class="ipsAreaBackground ipsPadding ipsType_center">
		{$form}
	</div>
</div>
CONTENT;

		return $return;
}

	function referralTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT

<div class='cReferal_members' data-baseurl='
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

if ( \count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsList_inline ipsClearfix ipsSpacer_top ipsSpacer_half' id='elTable_
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

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'referral_no_referrals', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function referralsRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT
 
	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		
CONTENT;

$member = \IPS\Member::load( $row['member_id'] );
$return .= <<<CONTENT

		<li class='ipsPhotoPanel ipsPhotoPanel_tiny'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT
	
			<div>
				<strong>
					<a href="
CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $row['member_id'] )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
				</strong>
				<br>
				<span class='ipsType_light ipsType_small'>
CONTENT;

$val = ( $row['joined'] instanceof \IPS\DateTime ) ? $row['joined'] : \IPS\DateTime::ts( $row['joined'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
			</div>
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

	function register( $form, $login, $postBeforeRegister ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsBox_alt ipsPad'>
	<div data-role='registerForm'>
		<div class='ipsColumns ipsColumns_collapseTablet'>
			
CONTENT;

$buttonMethods = $login->buttonMethods();
$return .= <<<CONTENT

			
CONTENT;

if ( $buttonMethods ):
$return .= <<<CONTENT

				<div class='ipsColumn ipsColumn_fluid'>
			
CONTENT;

endif;
$return .= <<<CONTENT

					<div class='ipsBox 
CONTENT;

if ( !$buttonMethods ):
$return .= <<<CONTENT
cRegister_noSocial ipsPos_center
CONTENT;

endif;
$return .= <<<CONTENT
'>
						<div class='ipsPadding ipsBorder_bottom'>
							
CONTENT;

if ( $postBeforeRegister ):
$return .= <<<CONTENT

								<h1 class='ipsType_pageTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_before_register_headline', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
								
CONTENT;

if ( !\IPS\Request::i()->hidereminder ):
$return .= <<<CONTENT
<p class='ipsType_reset ipsType_large ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_before_register_subtext', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								<h1 class='ipsType_pageTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>
								<p class='ipsType_reset ipsType_large ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'existing_user', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $login->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></p>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
						{$form}
					</div>
			
CONTENT;

if ( $buttonMethods ):
$return .= <<<CONTENT

				</div>
				<div class='ipsColumn ipsColumn_wide' id='elRegisterSocial'>
					<div class='ipsBox ipsPad'>
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
						<br>
						<form accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $login->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller="core.global.core.login">
							<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							<div class='ipsGap:2'>
								
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
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</section>
CONTENT;

		return $return;
}

	function registerSetPassword( $form,$member ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('set_password_title', NULL, array( 'sprintf' => array( $member->name ) ) ) );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection ipsBox ipsPad'>
	{$form}
</div>
CONTENT;

		return $return;
}

	function registerWrapper( $content ) {
		$return = '';
		$return .= <<<CONTENT


<div id='elRegisterForm' class='ipsPos_center ipsPad' data-controller='core.front.system.register'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function reportedAlready( $index, $report, $content ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad ipsType_center">
	<div class="ipsType_large">
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $report['date_reported'] )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'automoderation_already_reported', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</div>
	<div class="ipsPad">
		<a data-confirm href="
CONTENT;
$return .= htmlspecialchars( $content->url()->setQueryString( array( 'do' => 'deleteReport', 'cid' => $report['id'] ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'automoderation_already_reported_delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</div>
CONTENT;

		return $return;
}

	function resetPass( $form ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('lost_password') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection ipsBox ipsPad'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reset_pass_instructions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	<br>
	<br>
	{$form}
</div>
CONTENT;

		return $return;
}

	function searchResult( $indexData, $articles, $authorData, $itemData, $unread, $objectUrl, $itemUrl, $containerUrl, $containerTitle, $repCount, $showRepUrl, $snippet, $iPostedIn, $view, $canIgnoreComments=FALSE, $reactions=array() ) {
		$return = '';
		$return .= <<<CONTENT


<li class='ipsStreamItem ipsStreamItem_contentBlock ipsStreamItem_
CONTENT;
$return .= htmlspecialchars( $view, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsAreaBackground_reset ipsPad 
CONTENT;

if ( isset( $indexData['index_class']::$searchResultClassName ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $indexData['index_class']::$searchResultClassName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $indexData['index_hidden'] ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='activityItem' data-timestamp='
CONTENT;
$return .= htmlspecialchars( $indexData['index_date_created'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsStreamItem_container ipsClearfix'>
		
CONTENT;

if ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

			
CONTENT;

$itemClass = $indexData['index_class']::$itemClass;
$return .= <<<CONTENT

			<div class='ipsStreamItem_header ipsPhotoPanel ipsPhotoPanel_mini'>
				
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

					<span class='ipsStreamItem_contentType' data-ipsTooltip title='
CONTENT;

$val = "{$itemClass::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $itemClass::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i></span>
				
CONTENT;

else:
$return .= <<<CONTENT
				
					<span class='ipsStreamItem_contentType' data-ipsTooltip title='
CONTENT;

$val = "{$indexData['index_class']::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $indexData['index_class']::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i></span>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view !== 'condensed' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT

				<div class='
CONTENT;

if ( $unread ):
$return .= <<<CONTENT
ipsStreamItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

						<div class='ipsPhotoPanel ipsPhotoPanel_small'>
							{$snippet}
							<div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<h2 class='ipsType_reset ipsStreamItem_title ipsContained_container 
CONTENT;

if ( !$indexData['index_title'] or $view == 'condensed' ):
$return .= <<<CONTENT
ipsStreamItem_titleSmall
CONTENT;

endif;
$return .= <<<CONTENT
'>
						
CONTENT;

if ( $unread ):
$return .= <<<CONTENT

							<span>
								<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl->stripQueryString( array( 'comment' => 'comment', 'review' => 'review' ) )->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="star" 
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
data-iPostedIn
CONTENT;

endif;
$return .= <<<CONTENT
 title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
									<span class='ipsItemStatus 
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
ipsItemStatus_posted
CONTENT;

endif;
$return .= <<<CONTENT
'><i class="fa fa-
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
star
CONTENT;

else:
$return .= <<<CONTENT
circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
								</a>
							</span>
						
CONTENT;

elseif ( $iPostedIn ):
$return .= <<<CONTENT

							<span><span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( isset( $indexData['index_prefix'] ) ):
$return .= <<<CONTENT

								<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( rawurlencode($indexData['index_prefix']), $indexData['index_prefix'] );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<span class='ipsType_break ipsContained'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="link" data-searchable>
CONTENT;

if ( ! empty( $itemData['extra']['solved'] )  ):
$return .= <<<CONTENT
<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_solved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></span>
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['title'] ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
						</span>
						
CONTENT;

if ( $indexData['index_hidden'] ):
$return .= <<<CONTENT

								
CONTENT;

if ( $indexData['index_hidden'] === -1 ):
$return .= <<<CONTENT

								<span><span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
								
CONTENT;

elseif ( $indexData['index_hidden'] === 1 ):
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

endif;
$return .= <<<CONTENT

					</h2>
					
CONTENT;

if ( $view != 'condensed' ):
$return .= <<<CONTENT

						<p class='ipsType_reset ipsStreamItem_status ipsType_blendLinks'>
							
CONTENT;

$return .= htmlspecialchars( $itemClass::searchResultSummaryLanguage( $authorData, $articles, $indexData, $itemData ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>
						</p>
					
CONTENT;

else:
$return .= <<<CONTENT

						<ul class='ipsList_inline ipsStreamItem_stats ipsType_light ipsType_blendLinks'>
							<li>
								<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
							</li>
							
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ) and $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] > ( $itemClass::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
										
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ]-1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_reviews'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_reviews'] ] ) and $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_reviews'] ] ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
#reviews' class='ipsType_blendLinks'><i class='fa fa-star-half-o'></i> 
CONTENT;
$return .= htmlspecialchars( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_reviews'] ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>

						<p class='ipsStreamItem_status ipsType_reset ipsType_blendLinks'>
							
CONTENT;

$return .= htmlspecialchars( $itemClass::searchResultSummaryLanguage( $authorData, $articles, $indexData, $itemData ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>
						</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_tags'] ) and $view == 'condensed' ):
$return .= <<<CONTENT

						<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT
</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

						
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
			
CONTENT;

if ( $view !== 'condensed' ):
$return .= <<<CONTENT

				<div class='ipsStreamItem_snippet ipsType_break'>
					
CONTENT;

if ( $canIgnoreComments and isset( $itemData['author'] ) and \IPS\Member::loggedIn()->member_id and isset( $authorData['member_id'] ) and isset ( $authorData['member_group_id'] ) and \IPS\Member::loggedIn()->isIgnoring( $authorData, 'topics' ) ):
$return .= <<<CONTENT

					<div class='ipsComment_ignored ipsType_light' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreCommentID='elComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreUserID='
CONTENT;
$return .= htmlspecialchars( $authorData['member_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						
CONTENT;

$sprintf = array($authorData['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu data-ipsMenu-menuID='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu-appendTo='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$authorData['member_id']}", null, "ignore", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array($authorData['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_posts_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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
					<div id='elComment_
CONTENT;
$return .= htmlspecialchars( $indexData['index_object_id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsHide">
						{$snippet}
					</div>
					
CONTENT;

else:
$return .= <<<CONTENT

					 	{$snippet}
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<ul class='ipsList_inline ipsStreamItem_meta ipsGap:1'>
					<li class='ipsType_light ipsType_medium'>
						<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
					</li>
					
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ) and $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] > ( $itemClass::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
							<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
								
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_replies', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\IPS::classUsesTrait( $indexData['index_class'], 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and \count( $reactions ) ):
$return .= <<<CONTENT

						
CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

							<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", "core" )->searchReaction( $reactions, $itemUrl->setQueryString('do', 'showReactionsReview')->setQueryString('review', $indexData['index_object_id']), $repCount );
$return .= <<<CONTENT
</li>
						
CONTENT;

else:
$return .= <<<CONTENT

							<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", "core" )->searchReaction( $reactions, $itemUrl->setQueryString('do', 'showReactionsComment')->setQueryString('comment', $indexData['index_object_id']), $repCount );
$return .= <<<CONTENT
</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_tags'] ) ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true );
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

else:
$return .= <<<CONTENT

			
CONTENT;

$itemClass = $indexData['index_class'];
$return .= <<<CONTENT


			<div class='ipsStreamItem_header 
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['author'] ) ):
$return .= <<<CONTENT
ipsPhotoPanel ipsPhotoPanel_mini
CONTENT;

endif;
$return .= <<<CONTENT
'>
				<span class='ipsStreamItem_contentType 
CONTENT;

if ( !isset( $itemClass::$databaseColumnMap['author'] ) ):
$return .= <<<CONTENT
ipsResponsive_hidePhone
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$val = "{$indexData['index_class']::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'ucfirst' => TRUE ) );
$return .= <<<CONTENT
'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $indexData['index_class']::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i></span>
				
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['author'] ) ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view !== 'condensed' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='
CONTENT;

if ( $unread ):
$return .= <<<CONTENT
ipsStreamItem_unread
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

						<div class='ipsPhotoPanel ipsPhotoPanel_small'>
							{$snippet}
							<div>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<h2 class='ipsType_reset ipsContained_container ipsStreamItem_title ipsType_break 
CONTENT;

if ( $view == 'condensed' ):
$return .= <<<CONTENT
ipsStreamItem_titleSmall
CONTENT;

endif;
$return .= <<<CONTENT
'>
						
CONTENT;

if ( $unread ):
$return .= <<<CONTENT

							<span><a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( 'do', 'getNewComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_unread_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-linkType="star" 
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
data-iPostedIn
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsTooltip>
								<span class='ipsItemStatus 
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
ipsItemStatus_posted
CONTENT;

endif;
$return .= <<<CONTENT
'><i class="fa fa-
CONTENT;

if ( $iPostedIn ):
$return .= <<<CONTENT
star
CONTENT;

else:
$return .= <<<CONTENT
circle
CONTENT;

endif;
$return .= <<<CONTENT
"></i></span>
							</a></span>
						
CONTENT;

elseif ( $iPostedIn ):
$return .= <<<CONTENT

							<span class='ipsItemStatus ipsItemStatus_read ipsItemStatus_posted'><i class="fa fa-star"></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( isset( $indexData['index_prefix'] ) ):
$return .= <<<CONTENT

							<span>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->prefix( rawurlencode($indexData['index_prefix']), $indexData['index_prefix'] );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<span class='ipsContained ipsType_break'><a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="link" data-searchable>
CONTENT;

if ( ! empty( $itemData['extra']['solved'] )  ):
$return .= <<<CONTENT
<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_solved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-check'></i></span>
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $indexData['index_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
                        
CONTENT;

if ( $indexData['index_hidden'] ):
$return .= <<<CONTENT

							<span><span class="ipsBadge ipsBadge_icon ipsBadge_warning ipsBadge_medium " data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-eye-slash'></i></span></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

                        </span>

						
CONTENT;

if ( isset( $indexData['index_tags'] ) and $view == 'condensed' ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</h2>
					
CONTENT;

if ( $view != 'condensed' ):
$return .= <<<CONTENT

						
CONTENT;

if ( $containerTitle ):
$return .= <<<CONTENT

							<p class='ipsType_reset ipsStreamItem_status ipsType_blendLinks'>
								
CONTENT;

$return .= htmlspecialchars( $itemClass::searchResultSummaryLanguage( $authorData, $articles, $indexData, $itemData ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>
							</p>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						<ul class='ipsList_inline ipsStreamItem_stats ipsType_light ipsType_blendLinks'>
							<li>
								<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
							</li>
							
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] > ( $indexData['index_class']::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
										
CONTENT;

if ( $indexData['index_class']::$firstCommentRequired ):
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] - 1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

else:
$return .= <<<CONTENT

											<i class='fa fa-comment'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

									</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_reviews'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
#reviews' class='ipsType_blendLinks'><i class='fa fa-star-half-o'></i> 
CONTENT;

$return .= htmlspecialchars( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
						
CONTENT;

if ( $containerTitle ):
$return .= <<<CONTENT

							<p class='ipsStreamItem_status ipsType_reset ipsType_blendLinks'>
								
CONTENT;

$return .= htmlspecialchars( $itemClass::searchResultSummaryLanguage( $authorData, $articles, $indexData, $itemData ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>
							</p>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
					
CONTENT;

if ( $view == 'condensed' && $snippet ):
$return .= <<<CONTENT

							</div>
						</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
			
CONTENT;

if ( $view !== 'condensed' ):
$return .= <<<CONTENT

				<div class='ipsStreamItem_snippet ipsType_break'>
					{$snippet}
				</div>
				<ul class='ipsList_inline ipsStreamItem_meta ipsGap:1'>
					
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['date'] ) ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'><i class='fa fa-clock-o'></i> 
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] > ( $indexData['index_class']::$firstCommentRequired ? 1 : 0 ) ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
							<a href='
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findReview', 'review' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $objectUrl->setQueryString( array( 'do' => 'findComment', 'comment' => $indexData['index_object_id'] ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' class='ipsType_blendLinks'>
								
CONTENT;

if ( $indexData['index_class']::$firstCommentRequired ):
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_replies', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

else:
$return .= <<<CONTENT

									<i class='fa fa-comment'></i> 
CONTENT;

$pluralize = array( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_comments'] ] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_comments', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_class']::$databaseColumnMap['num_reviews'] ) and isset( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ) and $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ):
$return .= <<<CONTENT

						<li class='ipsType_light ipsType_medium'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
#reviews' class='ipsType_blendLinks'><i class='fa fa-star-half-o'></i> 
CONTENT;

$pluralize = array( $itemData[ $indexData['index_class']::$databasePrefix . $indexData['index_class']::$databaseColumnMap['num_reviews'] ] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'num_reviews', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\IPS::classUsesTrait( $indexData['index_class'], 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and \count( $reactions ) ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", "core" )->searchReaction( $reactions, $itemUrl->setQueryString('do', 'showReactions'), $repCount );
$return .= <<<CONTENT
</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $indexData['index_tags'] ) ):
$return .= <<<CONTENT

						<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true );
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

endif;
$return .= <<<CONTENT

	</div>
</li>
CONTENT;

		return $return;
}

	function searchResultSnippet( $indexData ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( trim( $indexData['index_content'] ) !== '' ):
$return .= <<<CONTENT

	<div class='ipsType_richText ipsContained ipsType_medium'>
		<div 
CONTENT;

if ( !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'search' ) ):
$return .= <<<CONTENT
data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='3 lines' data-ipsTruncate-watch='false'
CONTENT;

else:
$return .= <<<CONTENT
data-searchable data-findTerm
CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

$return .= \IPS\Content\Search\Result::preDisplay( $indexData['index_content'] );
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function settings( $tab, $output, $canChangeEmail, $canChangePassword, $canChangeUsername, $canChangeSignature, $loginMethods,  $canConfigureMfa=FALSE, $showApps=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('settings'), \IPS\Member::loggedIn()->language()->addToStack('settings_blurb') );
$return .= <<<CONTENT

<div id='elSettingsTabs' data-ipsTabBar data-ipsTabBar-contentArea='#elProfileTabContent' data-ipsTabBar-itemSelector='[data-ipsSideMenu] .ipsSideMenu_item' data-ipsTabBar-activeClass='ipsSideMenu_itemActive'>
	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_wide'>
			<div class='ipsBox ipsPadding sm:ipsPadding:half ipsResponsive_pull sm:ipsMargin_bottom'>
				<div class='ipsSideMenu' data-ipsSideMenu>
					<h3 class="ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium">
						<a href="#modcp_menu" class="ipsPad_double" data-action="openSideMenu">
							<i class="fa fa-bars"></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'settings_area', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;<i class="fa fa-caret-down"></i>
						</a>
					</h3>
					<ul class="ipsSideMenu_list">
						<li>
							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings", null, "settings", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_overview' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'overview' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'overview', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'overview' ):
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
								<i class='fa fa-tachometer'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'overview', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</a>
						</li>
						
CONTENT;

if ( $canChangeEmail ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=email", null, "settings_email", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_email' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'email' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'email' ):
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
									<i class='fa fa-envelope-o'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $canChangePassword ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=password", null, "settings_password", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_password' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'password' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'password' ):
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
									<i class='fa fa-key'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $canConfigureMfa ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa", null, "settings_mfa", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_mfa' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'mfa' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ucp_mfa', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'mfa' ):
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
									<i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ucp_mfa', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Settings::i()->device_management ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=devices", null, "settings_devices", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_devices' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'devices' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ucp_devices', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'devices' ):
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
									<i class='fa fa-laptop'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ucp_devices', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $canChangeUsername ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=username", null, "settings_username", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_username' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'username' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'username' ):
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
									<i class='fa fa-user'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<li>
							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=links", null, "settings_links", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_links' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'links' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_settings_cvb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'links' ):
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
							<i class='fa fa-link'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_settings_cvb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</a>
						</li>
						
CONTENT;

if ( $canChangeSignature ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=signature", null, "settings_signature", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_signature' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'signature' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'signature' ):
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
									<i class='fa fa-pencil'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signature', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Settings::i()->ref_on ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=referrals", null, "settings_referrals", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_referrals' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === 'referrals' ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'referrals', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === 'referrals' ):
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
								<i class='fa fa-users'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'referrals', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

foreach ( $loginMethods as $method ):
$return .= <<<CONTENT

							
CONTENT;

if ( $method->showInUcp( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

								<li>
									<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=login&service={$method->id}", null, "settings_login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_login_
CONTENT;
$return .= htmlspecialchars( $method->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === "login_{$method->id}" ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;
$return .= htmlspecialchars( $method->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === "login_{$method->id}" ):
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

$icon = $method->logoForUcp();
$return .= <<<CONTENT

										
CONTENT;

if ( \is_string( $icon ) ):
$return .= <<<CONTENT

											<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i>
										
CONTENT;

else:
$return .= <<<CONTENT

											<div class="cLoginServiceIcon">
												
CONTENT;

if ( $icon ):
$return .= <<<CONTENT
<img src="
CONTENT;
$return .= htmlspecialchars( $icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

endif;
$return .= <<<CONTENT

											</div>
										
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

$val = "{$method->_title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

									</a>
								</li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

if ( $showApps ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=apps", null, "settings_apps", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='setting_apps' class='ipsType_normal ipsSideMenu_item 
CONTENT;

if ( $tab === "apps" ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" role="tab" aria-selected="
CONTENT;

if ( $tab === "apps" ):
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
									<i class='fa fa-cubes'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</div>
			</div>
		</div>
		<div class='ipsColumn ipsColumn_fluid'>
			<section id='elProfileTabContent' class='ipsBox ipsResponsive_pull'>
				<div id="ipsTabs_elSettingsTabs_setting_
CONTENT;
$return .= htmlspecialchars( $tab, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel" class="ipsTabs_panel" aria-labelledby="setting_overview" aria-hidden="false">
					{$output}
				</div>
			</section>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function settingsApps( $apps ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
	<h2 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>

<div class='ipsPadding'>
	<p class="ipsType_normal ipsSpacer_bottom ipsSpacer_double">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_apps_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

if ( \count( $apps ) ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $apps as $app ):
$return .= <<<CONTENT

			<div class="ipsBox ipsSpacer_bottom ipsClearfix">
				<div class="ipsAreaBackground_light ipsClearfix ipsPad">
					<div class="ipsPos_right">
						<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "core&module=system&controller=settings&area=apps&do=revokeApp&client_id={$app['client']->client_id}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_apps", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_negative ipsButton_small" data-confirm data-confirmSubMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_app_revoke_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_app_revoke', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						</a>
					</div>
					<div class="ipsPad_half">
						<h2 class="ipsType_sectionHead">
							
CONTENT;
$return .= htmlspecialchars( $app['client']->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						</h2>
					</div>
				</div>
				<div class="ipsPad">
					<ul class="ipsDataList">
						<li class="ipsDataItem">
							<span class="ipsDataItem_generic ipsDataItem_size6">
								<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_app_issued', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							</span>
							<span class="ipsDataItem_generic">
								
CONTENT;

$val = ( $app['issued'] instanceof \IPS\DateTime ) ? $app['issued'] : \IPS\DateTime::ts( $app['issued'] );$return .= $val->html();
$return .= <<<CONTENT

							</span>
						</li>
						
CONTENT;

if ( $app['scopes'] ):
$return .= <<<CONTENT

							<li class="ipsDataItem">
								<span class="ipsDataItem_generic ipsDataItem_size6">
									<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_app_scopes', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
								</span>
								<div class="ipsDataItem_generic">
									<ul class="ipsList_reset">
										
CONTENT;

foreach ( $app['scopes'] as $key => $scope ):
$return .= <<<CONTENT

											<li>
												<i class="fa fa-check"></i> 
CONTENT;
$return .= htmlspecialchars( $scope, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

											</li>
										
CONTENT;

endforeach;
$return .= <<<CONTENT

									</ul>
								</div>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</div>
			</div>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<div class="ipsPad ipsType_center ipsType_light">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_apps_empty', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsDevices( $devices, $ipAddresses ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
	<h2 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ucp_devices', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>
<div class='ipsPadding'>
	<p class="ipsType_normal ipsSpacer_bottom ipsSpacer_double">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_management_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp; <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=secureAccount", null, "settings_secure", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_list_secure_account', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></p>
	
CONTENT;

if ( \count( $devices ) ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $devices as $device ):
$return .= <<<CONTENT

			<div class="ipsBox ipsBox--child ipsSpacer_bottom ipsClearfix">
				<div class="ipsBorder_bottom ipsClearfix ipsPad_half ipsFlex ipsFlex-ai:center ipsFlex-jc:between sm:ipsFlex-fd:column sm:ipsFlex-ai:stretch">
					<div class='ipsFlex-flex:10'>
						<div class="ipsPos_left ipsMargin_right:half">
							
CONTENT;

if ( $device->userAgent()->platform === 'Macintosh' ):
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/mac.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
							
CONTENT;

elseif ( $device->userAgent()->platform === 'Android' or $device->userAgent()->platform === 'Windows Phone' ):
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/android.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
							
CONTENT;

elseif ( $device->userAgent()->platform === 'iPad' ):
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/ipad.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
							
CONTENT;

elseif ( $device->userAgent()->platform === 'iPhone' ):
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/iphone.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
							
CONTENT;

else:
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/pc.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
						<h2 class="ipsType_sectionHead ipsMargin_top:half">
							
CONTENT;
$return .= htmlspecialchars( $device->userAgent()->platform, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						</h2>
						<br>
						
CONTENT;

if ( isset( \IPS\Request::i()->cookie['device_key'] ) and \IPS\Request::i()->cookie['device_key'] === $device->device_key ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'current_device', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $device->last_seen )->relative()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_last_loggedin', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
					
CONTENT;

if ( $device->login_key or isset( $apps[ $device->device_key ] ) ):
$return .= <<<CONTENT

						<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "=core&module=system&controller=settings&area=devices&do=disableAutomaticLogin&device={$device->device_key}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_devices", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_link ipsButton_link--negative ipsButton_small">
							
CONTENT;

if ( isset( \IPS\Request::i()->cookie['device_key'] ) and \IPS\Request::i()->cookie['device_key'] === $device->device_key ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'disable_automatic_login', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</a>
					
CONTENT;

endif;
$return .= <<<CONTENT
					
				</div>
				<div class="ipsPadding_horizontal:half">
					<ul class="ipsDataList">
						<li class="ipsDataItem">
							<span class="ipsDataItem_generic ipsDataItem_size6">
								<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_table_user_agent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
							</span>
							<span class="ipsDataItem_generic">
								
CONTENT;

if ( \in_array( $device->userAgent()->browser, array( 'Android Browser', 'AppleWebKit', 'Camino', 'Chrome', 'Edge', 'Firefox', 'IEMobile', 'Midori', 'MSIE', 'Opera', 'Puffin', 'Safari', 'SamsungBrowser', 'Silk', 'UCBrowser', 'Vivaldi' ) ) ):
$return .= <<<CONTENT

									
CONTENT;

$browser = str_replace( ' ', '', $device->userAgent()->browser );
$return .= <<<CONTENT

									<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/browsers/{$browser}.png", "", 'interface', false );
$return .= <<<CONTENT
" width="24"> &nbsp; 
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;
$return .= htmlspecialchars( $device->userAgent()->browser, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $device->userAgent()->browserVersion, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

							</span>
						</li>
						
CONTENT;

if ( $loginMethod = $device->loginMethod() and $logo = $loginMethod->logoForDeviceInformation() ):
$return .= <<<CONTENT

							<li class="ipsDataItem">
								<span class="ipsDataItem_generic ipsDataItem_size6">
									<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_table_login_handler', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
								</span>
								<span class="ipsDataItem_generic">
									<img src="
CONTENT;
$return .= htmlspecialchars( $logo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" width="24"> &nbsp; 
									
CONTENT;
$return .= htmlspecialchars( $loginMethod->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

								</span>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( isset( $apps[ $device->device_key ] ) ):
$return .= <<<CONTENT

							<li class="ipsDataItem">
								<div class="ipsDataItem_generic ipsDataItem_size6">
									<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
								</div>
								<div class="ipsDataItem_generic">
									<ul class="ipsDataList">
										
CONTENT;

foreach ( $apps[ $device->device_key ] as $clientId => $app ):
$return .= <<<CONTENT

											<li class="ipsDataItem">
												<span class="ipsDataItem_generic">
													
CONTENT;
$return .= htmlspecialchars( $oauthClients[ $clientId ]->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

												</span>
											</li>
										
CONTENT;

endforeach;
$return .= <<<CONTENT

									</ul>
								</div>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<li class="ipsDataItem">
							<div class="ipsDataItem_generic ipsDataItem_size6 ipsPos_top">
								<strong>
CONTENT;

if ( \IPS\Settings::i()->ipsgeoip ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_last_locations', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
*
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_last_logins', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</strong>
							</div>
							<div class="ipsDataItem_generic">
								<ul class="ipsList_reset">
									
CONTENT;

foreach ( $ipAddresses[ $device->device_key ] as $ipAddress => $details ):
$return .= <<<CONTENT

										<li>
											
CONTENT;

if ( \IPS\Settings::i()->ipsgeoip ):
$return .= <<<CONTENT

												
CONTENT;
$return .= htmlspecialchars( $details['location'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

											
CONTENT;

else:
$return .= <<<CONTENT

												
CONTENT;
$return .= htmlspecialchars( $ipAddress, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

											
CONTENT;

endif;
$return .= <<<CONTENT

											&nbsp; <span class="ipsType_light">
CONTENT;

$val = ( $details['date'] instanceof \IPS\DateTime ) ? $details['date'] : \IPS\DateTime::ts( $details['date'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
										</li>
									
CONTENT;

endforeach;
$return .= <<<CONTENT

								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Settings::i()->ipsgeoip ):
$return .= <<<CONTENT

			<p class="ipsType_light ipsType_small">* 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_geolocation_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$userAgent = \IPS\Http\UserAgent::parse();
$return .= <<<CONTENT

		<div class="ipsBox ipsSpacer_bottom ipsClearfix">
			<div class="ipsAreaBackground_light ipsClearfix ipsPad_half">
				<div class="ipsPos_left">
					
CONTENT;

if ( $userAgent->platform === 'Macintosh' ):
$return .= <<<CONTENT

						<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/mac.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
					
CONTENT;

elseif ( $userAgent->platform === 'Android' or $userAgent->platform === 'Windows Phone' ):
$return .= <<<CONTENT

						<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/android.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
					
CONTENT;

elseif ( $userAgent->platform === 'iPad' ):
$return .= <<<CONTENT

						<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/ipad.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
					
CONTENT;

elseif ( $userAgent->platform === 'iPhone' ):
$return .= <<<CONTENT

						<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/iphone.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
					
CONTENT;

else:
$return .= <<<CONTENT

						<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/devices/pc.png", "", 'interface', false );
$return .= <<<CONTENT
" width="64">
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div class="ipsPad_half">
					<h2 class="ipsType_sectionHead">
						
CONTENT;
$return .= htmlspecialchars( $userAgent->platform, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					</h2>
					<br>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'current_device', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</div>
			</div>
			<div class="ipsPad">
				<ul class="ipsDataList">
					<li class="ipsDataItem">
						<span class="ipsDataItem_generic ipsDataItem_size6">
							<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'device_table_user_agent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
						</span>
						<span class="ipsDataItem_generic">
							
CONTENT;

if ( \in_array( $userAgent->browser, array( 'Android Browser', 'AppleWebKit', 'Camino', 'Chrome', 'Edge', 'Firefox', 'IEMobile', 'Midori', 'MSIE', 'Opera', 'Puffin', 'Safari', 'SamsungBrowser', 'Silk', 'UCBrowser', 'Vivaldi' ) ) ):
$return .= <<<CONTENT

								
CONTENT;

$browser = str_replace( ' ', '', $userAgent->browser );
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "logos/browsers/{$browser}.png", "", 'interface', false );
$return .= <<<CONTENT
" width="24">
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $userAgent->browser, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $userAgent->browserVersion, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						</span>
					</li>
				</ul>
			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsEmail( $form=NULL, $login=NULL, $error=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
	<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>
<div class='ipsPadding'>
	
CONTENT;

if ( $form ):
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Settings::i()->reg_auth_type == 'user' or \IPS\Settings::i()->reg_auth_type == 'admin_user' ):
$return .= <<<CONTENT

			<div class='ipsType_textBlock ipsType_normal'>
				<ul class='ipsList_bullets'>
					<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_explain_1', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
					<li>
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_explain_2', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</li>
				</ul>
			</div>
			<hr class='ipsHr'>
		
CONTENT;

endif;
$return .= <<<CONTENT

		{$form}
	
CONTENT;

elseif ( $login ):
$return .= <<<CONTENT

		<br><hr class='ipsHr'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->reauthenticate( $login, $error );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_1', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</div>

		<ol class='ipsList_bullets ipsList_numbers ipsSpacer_top ipsType_normal'>
			<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_2', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			<li>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_3', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</li>
			<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_4', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_email_admin_5', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
		</ol>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsLinks( $form ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
    <h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_settings_cvb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>
<div class='ipsPadding'>
    {$form}
</div>

CONTENT;

		return $return;
}

	function settingsLoginConnect( $method, $login, $error ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $error ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_error">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>

CONTENT;

endif;
$return .= <<<CONTENT

<form accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $login->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller="core.global.core.login">
	<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

if ( $method->type() === \IPS\Login::TYPE_USERNAME_PASSWORD ):
$return .= <<<CONTENT

		<ul class='ipsForm'>
			<li class="ipsFieldRow ipsFieldRow_fullWidth ipsClearfix">
				
CONTENT;

$authType = $method->authType();
$return .= <<<CONTENT

				<label class="ipsFieldRow_label" for="auth">
					
CONTENT;

if ( $authType === \IPS\Login::AUTH_TYPE_USERNAME ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

elseif ( $authType === \IPS\Login::AUTH_TYPE_EMAIL ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username_or_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					<span class="ipsFieldRow_required">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</label>
				<div class="ipsFieldRow_content">
					
CONTENT;

if ( $authType === \IPS\Login::AUTH_TYPE_USERNAME ):
$return .= <<<CONTENT

						<input type="text" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" id="auth" 
CONTENT;

if ( isset( \IPS\Request::i()->auth ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->auth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

elseif ( $authType === \IPS\Login::AUTH_TYPE_EMAIL ):
$return .= <<<CONTENT

						<input type="email" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" id="auth" 
CONTENT;

if ( isset( \IPS\Request::i()->auth ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->auth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

else:
$return .= <<<CONTENT

						<input type="text" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username_or_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" id="auth" 
CONTENT;

if ( isset( \IPS\Request::i()->auth ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->auth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</li>
			<li class="ipsFieldRow ipsFieldRow_fullWidth ipsClearfix">
				<label class="ipsFieldRow_label" for="password">
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					<span class="ipsFieldRow_required">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</label>
				<div class="ipsFieldRow_content">
					<input type="password" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="password" id="password" 
CONTENT;

if ( isset( \IPS\Request::i()->password ) ):
$return .= <<<CONTENT
value="
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->password, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
				</div>
			</li>
			<li class="ipsFieldRow ipsFieldRow_fullWidth">
				<button type="submit" name="_processLogin" value="usernamepassword" class="ipsButton ipsButton_primary ipsButton_small" id="elSignIn_submit">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				
CONTENT;

if ( $forgotPasswordUrl = $method->forgotPasswordUrl() ):
$return .= <<<CONTENT

					<p class="ipsType_right ipsType_small">
						<a href='
CONTENT;
$return .= htmlspecialchars( $forgotPasswordUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		</ul>	
	
CONTENT;

else:
$return .= <<<CONTENT

		{$method->button()}
	
CONTENT;

endif;
$return .= <<<CONTENT

</form>
CONTENT;

		return $return;
}

	function settingsLoginMethodOff( $method, $login, $error, $blurb, $canDisassociate=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
	
CONTENT;

if ( $canDisassociate ):
$return .= <<<CONTENT

		<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=login&service={$method->id}&disassociate=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_link ipsButton_link--negative ipsButton_small ipsPos_right" data-confirm data-confirmSubMessage="
CONTENT;

$sprintf = array($method->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_sign_out_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<h2 class='ipsType_pageTitle'>
CONTENT;
$return .= htmlspecialchars( $method->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
</div>

<div class='ipsPadding'>
	<p class="ipsType_normal ipsSpacer_bottom ipsSpacer_double">
CONTENT;

$val = "{$blurb}"; $sprintf = array($method->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->settingsLoginConnect( $method, $login, $error, $blurb );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsLoginMethodOn( $method, $form, $canDisassociate, $photoUrl, $profileName, $extraPermissions, $login, $forceSync ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPadding'>
	<div class='ipsClearfix'>
		
CONTENT;

if ( $canDisassociate ):
$return .= <<<CONTENT

			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=login&service={$method->id}&disassociate=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_negative ipsButton_small ipsPos_right" data-confirm data-confirmSubMessage="
CONTENT;

$sprintf = array($method->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_sign_out_confirm', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_out', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<div class="ipsPhotoPanel 
CONTENT;

if ( $photoUrl ):
$return .= <<<CONTENT
ipsPhotoPanel_mini
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix">
			
CONTENT;

if ( $photoUrl ):
$return .= <<<CONTENT

				<img src="
CONTENT;
$return .= htmlspecialchars( $photoUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt="" class="ipsUserPhoto ipsUserPhoto_mini">
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div>
        		<h2 class='ipsType_sectionHead'>
CONTENT;
$return .= htmlspecialchars( $method->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>                        
				<div>
					
CONTENT;

if ( $profileName ):
$return .= <<<CONTENT

						
CONTENT;

$sprintf = array($profileName); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_headline', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_signed_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
		
CONTENT;

if ( $login ):
$return .= <<<CONTENT

			<br>
			<div>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->settingsLoginConnect( $method, $login, \IPS\Member::loggedIn()->language()->addToStack('profilesync_extra_permissions_required', true, array( 'sprintf' => array( $extraPermissions ) ) ) );
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $forceSync ):
$return .= <<<CONTENT

		<hr class="ipsHr">
		<ul class="ipsList_reset">
			
CONTENT;

foreach ( $forceSync as $details ):
$return .= <<<CONTENT

				<li class="ipsSpacer_bottom">
					<p class="ipsType_normal ipsType_reset">
CONTENT;
$return .= htmlspecialchars( $details['label'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
					
CONTENT;

if ( $details['error'] ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->settingsLoginMethodSynError( $details['error'] );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $form or $forceSync ):
$return .= <<<CONTENT

		<hr class="ipsHr">
		{$form}
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsLoginMethodSynError( $error ) {
		$return = '';
		$return .= <<<CONTENT

<span class="ipsType_warning">
CONTENT;

$val = "{$error}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
CONTENT;

		return $return;
}

	function settingsMfa( $handlers ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \count( $handlers ) ):
$return .= <<<CONTENT

	<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
		<h2 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_settings_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	</div>
	<div class='ipsPadding'>
		<p class='ipsType_normal ipsSpacer_bottom ipsSpacer_double'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_ucp_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>

		
CONTENT;

foreach ( $handlers as $key => $handler ):
$return .= <<<CONTENT

			<div class="ipsSpacer_bottom ipsPad ipsAreaBackground_light ipsClearfix">
				<h2 class="ipsType_sectionHead ipsType_large">
CONTENT;
$return .= htmlspecialchars( $handler->ucpTitle(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $handler->memberHasConfiguredHandler( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT
&nbsp;&nbsp;<span class='ipsType_positive ipsType_medium'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enabled', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
</h2>
				<p class='ipsType_medium'>
CONTENT;
$return .= htmlspecialchars( $handler->ucpDesc(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
				<ul class="ipsList_inline">
				
CONTENT;

if ( $handler->memberHasConfiguredHandler( \IPS\Member::loggedIn() ) ):
$return .= <<<CONTENT

					<li><a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa&act=enable&type={$key}&_new=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_mfa", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall ipsButton_primary">
CONTENT;

$val = "mfa_{$key}_reauth"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
					<li><a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa&act=disable&type={$key}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_mfa", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsType_negative" data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_disable', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li><a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa&act=enable&type={$key}&_new=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings_mfa", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall ipsButton_primary">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'enable', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
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



CONTENT;

if ( !\IPS\Member::loggedIn()->group['g_hide_online_list'] ):
$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom 
CONTENT;

if ( \count( $handlers ) ):
$return .= <<<CONTENT
ipsBorder_top
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'settings_privacy_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>
<div class='ipsPadding'>
	<div class='ipsClearfix'>
		<h2 class='ipsType_sectionHead ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_visibility', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
&nbsp;&nbsp;
CONTENT;

if ( \IPS\Member::loggedIn()->members_bitoptions['is_anon'] ):
$return .= <<<CONTENT
<span class='ipsType_negative ipsType_medium'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_status_hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
CONTENT;

else:
$return .= <<<CONTENT
<span class='ipsType_positive ipsType_medium'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_status_visible', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT
</h2>
		<p class='ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_visibility_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		
CONTENT;

if ( \IPS\Member::loggedIn()->members_bitoptions['is_anon'] ):
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=updateAnon&value=0" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_online_status', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

else:
$return .= <<<CONTENT

			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=updateAnon&value=1" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_online_status', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
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

	function settingsMfaPassword( $login, $error ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
    <h2 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ucp_mfa', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>
<div class='ipsPadding'>
    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->reauthenticate( $login, $error, 'mfa_ucp_blurb_password' );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsMfaSetup( $configurationScreen, $url ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elTwoFactorAuthentication' class='ipsModal' data-controller='core.global.core.2fa'>
	<div>
		<form action="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" accept-charset='utf-8' data-ipsForm class="ipsForm ipsForm_fullWidth">
			<input type="hidden" name="mfa_setup" value="1">
			<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			{$configurationScreen}
		</form>
	</div>
</div>
CONTENT;

		return $return;
}

	function settingsOverview( $loginMethods, $canChangePassword ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPadding sm:ipsPadding:half'>
	<div class='ipsColumns ipsColumns_collapsePhone'>
		<div class='ipsColumn ipsColumn_fluid'>
			<ul class='ipsDataList'>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_main'>
						
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dname_changes'] ):
$return .= <<<CONTENT

							<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=username", null, "settings_username", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_link ipsPos_right">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<h4 class='ipsDataItem_title'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
						
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					</div>
				</li>
				<li class='ipsDataItem'>
					<div class='ipsDataItem_main'>
						
CONTENT;

if ( \IPS\Settings::i()->allow_email_changes != 'disabled' ):
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Settings::i()->allow_email_changes == 'redirect' ):
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_email_changes_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener" class="ipsButton ipsButton_link ipsPos_right">
							
CONTENT;

else:
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=email", null, "settings_email", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class="ipsButton ipsButton_link ipsPos_right">
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<h4 class='ipsDataItem_title'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
						
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->email, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					</div>
				</li>
				
CONTENT;

if ( $canChangePassword ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_main'>
							<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=password", null, "settings_password", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_link ipsPos_right">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							<h4 class='ipsDataItem_title'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
							********
						</div>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsDataItem_main'>
						<h4 class='ipsDataItem_title'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_completion_status', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4><br>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->profileNextStep( \IPS\Member::loggedIn()->nextProfileStep(), false, false );
$return .= <<<CONTENT

					</div>
				</li>
				
CONTENT;

foreach ( $loginMethods as $id => $details ):
$return .= <<<CONTENT

					<li class='ipsDataItem ipsClearfix'>
						<div class="ipsDataItem_icon">
							
CONTENT;

if ( isset( $details['icon'] ) ):
$return .= <<<CONTENT

								<img src="
CONTENT;
$return .= htmlspecialchars( $details['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsUserPhoto ipsUserPhoto_mini">
							
CONTENT;

else:
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "default_photo.png", "core", 'global', false );
$return .= <<<CONTENT
" class="ipsUserPhoto ipsUserPhoto_mini">
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main'>
							<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=login&service={$id}", null, "settings_login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_link ipsPos_right">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_configure', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							<h4 class='ipsDataItem_title'><strong>
CONTENT;
$return .= htmlspecialchars( $details['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></h4><br>
							
CONTENT;
$return .= htmlspecialchars( $details['blurb'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
		<div class='ipsColumn ipsColumn_wide'>
			<div class='ipsBox ipsBox--child'>
				
CONTENT;

$thisMemberID = \IPS\Member::loggedIn()->member_id;
$return .= <<<CONTENT

				<h3 class='ipsType_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'other_settings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<ul class='ipsSideMenu_list ipsPadding:half'>
					<li class='ipsSideMenu_item'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) AND \IPS\Member::loggedIn()->group['g_edit_profile'] ):
$return .= <<<CONTENT

						<li class='ipsSideMenu_item'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-modal='true' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Settings::i()->ignore_system_on ):
$return .= <<<CONTENT

						<li class='ipsSideMenu_item'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore", null, "ignore", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_manage_ignore', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function settingsPassword( $form=null ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
	<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>

<div class='ipsPadding'>
	
CONTENT;

if ( \IPS\Member::loggedIn()->passwordResetForced() ):
$return .= <<<CONTENT

		<p class='ipsMessage ipsMessage_warning'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password_reset_required', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $form ):
$return .= <<<CONTENT

		{$form}
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsType_normal'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_1', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</div>

		<ol class='ipsList_bullets ipsList_numbers ipsSpacer_top ipsType_normal'>
			<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_2', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			<li>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_3', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</li>
			<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_4', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password_admin_5', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
		</ol>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsProfileSyncLogin( $method, $login, $error ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPadding">
	<div class="ipsType_normal ipsSpacer_bottom">
CONTENT;

$sprintf = array($method->_title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</div>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", \IPS\Request::i()->app )->settingsLoginConnect( $method, $login, $error );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsReferrals( $table, $url, $rules ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
	<h2 class="ipsType_pageTitle">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'referrals', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>

<div class='ipsPadding'>
	<div class='ipsBox ipsBox--child ipsSpacer_bottom cReferralLinks' data-controller='core.front.system.referrals'>
		<div class='ipsPad cReferrals_directLink'>
			<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'referral_directlink', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
			<span class='cReferrals_directLink_link'>
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			<input class='cReferrals_directLink_input ipsHide' type="text" value="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			<button class="cReferrer_copy cReferrer_copy_link ipsButton ipsButton_alternate ipsButton_veryVerySmall" data-clipboard-text="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'copy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
		</div>
		
CONTENT;

if ( \count( \IPS\core\ReferralBanner::roots() ) ):
$return .= <<<CONTENT

		<div class='cReferrals_grid ipsPad_half'>
		
CONTENT;

$count = 0;
$return .= <<<CONTENT

		<div class='cReferrals_grid_row ipsSpacer_top'>
			
CONTENT;

foreach ( \IPS\core\ReferralBanner::roots() as $banner ):
$return .= <<<CONTENT

				<div class='cReferrals_grid_item ipsClear ipsClearfix ipsBox'>
					<div class='cReferrals_grid_item__image' style='background-image: url("
CONTENT;

$return .= \IPS\File::get( "core_ReferralBanners", $banner->url )->url;
$return .= <<<CONTENT
")'>
						{$banner->_title}
					</div>
					<div class='cReferrals_grid_item__body ipsPad'>
						<div>
							<div class='ipsSpacer_bottom'>
								<h3 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'referral_html_banner', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
								<input type='text' class='ipsField_fullWidth' id="bannerValue_
CONTENT;
$return .= htmlspecialchars( $banner->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" value="&lt;a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'&gt;&lt;img src='
CONTENT;

$return .= \IPS\File::get( "core_ReferralBanners", $banner->url )->url;
$return .= <<<CONTENT
' alt='
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
'&gt;&lt;/a&gt;">
								<button class="cReferrer_copy ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth ipsSpacer_top ipsSpacer_half" data-clipboard-target="#bannerValue_
CONTENT;
$return .= htmlspecialchars( $banner->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'copy', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
							</div>
						</div>
					</div>
				</div>
				
CONTENT;

$count++;
$return .= <<<CONTENT

				
CONTENT;

if ( $count % 3 == 0 and $count !== \count( \IPS\core\ReferralBanner::roots() ) ):
$return .= <<<CONTENT

					</div>
					<div class='cBlog_grid_row ipsSpacer_top'>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	</div>

	<div class="ipsBox ipsBox--child ipsSpacer_bottom ipsClearfix">
		<div class="ipsAreaBackground_light ipsClearfix ipsPad">
			<strong><i class="fa fa-users"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'referrals_yours', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
		</div>
		<div class="ipsPad">
			{$table}
		</div>
	</div>

	
CONTENT;

if ( $rules ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "nexus", 'front' )->referralRulesCommission( $rules );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function settingsSecureAccount( $canChangePassword, $canConfigureMfa, $hasConfiguredMfa, $loginMethods, $oauthApps=0 ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('secure_account'), \IPS\Member::loggedIn()->language()->addToStack('secure_account_blurb') );
$return .= <<<CONTENT


CONTENT;

if ( $canChangePassword ):
$return .= <<<CONTENT

	<div class="ipsBox ipsBox--child ipsSpacer_bottom">
		<h2 class="ipsType_sectionTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class="ipsPad ipsType_normal">
			<p class="ipsType_reset">
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'secure_account_change_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</p>
			<div class="ipsSpacer_top">
				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=password", null, "settings_password", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" target="_blank" rel="noopener" class="ipsButton ipsButton_primary ipsButton_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $canConfigureMfa ):
$return .= <<<CONTENT

	<div class="ipsBox ipsBox--child ipsSpacer_bottom">
		<h2 class="ipsType_sectionTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_settings_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class="ipsPad ipsType_normal">
			<p class="ipsType_reset">
				
CONTENT;

if ( $hasConfiguredMfa ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'secure_account_mfa_revise', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'secure_account_mfa_setup', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</p>
			<div class="ipsSpacer_top">
				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=mfa", null, "settings_mfa", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" target="_blank" rel="noopener" class="ipsButton ipsButton_primary ipsButton_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mfa_settings_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \count( $loginMethods ) ):
$return .= <<<CONTENT

	<div class="ipsBox ipsBox--child ipsSpacer_bottom">
		<h2 class="ipsType_sectionTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'secure_account_login_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class="ipsPad ipsType_normal">
			<p class="ipsType_reset ipsSpacer_bottom">
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'secure_account_login_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			</p>
			<ul class="ipsDataList">
				
CONTENT;

foreach ( $loginMethods as $id => $details ):
$return .= <<<CONTENT

					<li class='ipsDataItem ipsClearfix'>
						<div class="ipsDataItem_icon ipsPos_top">
							
CONTENT;

if ( isset( $details['icon'] ) ):
$return .= <<<CONTENT

								<img src="
CONTENT;
$return .= htmlspecialchars( $details['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsUserPhoto ipsUserPhoto_mini">
							
CONTENT;

else:
$return .= <<<CONTENT

								<img src="
CONTENT;

$return .= \IPS\Theme::i()->resource( "default_photo.png", "core", 'global', false );
$return .= <<<CONTENT
" class="ipsUserPhoto ipsUserPhoto_mini">
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
						<div class='ipsDataItem_main'>
							<h4 class='ipsDataItem_title'><strong>
CONTENT;
$return .= htmlspecialchars( $details['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></h4><br>
							
CONTENT;
$return .= htmlspecialchars( $details['blurb'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
<br>
							<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=login&service={$id}", null, "settings_login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_primary ipsButton_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profilesync_configure', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</div>							
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


CONTENT;

if ( $oauthApps ):
$return .= <<<CONTENT

	<div class="ipsBox ipsBox--child ipsSpacer_bottom">
		<h2 class="ipsType_sectionTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'oauth_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<div class="ipsPad ipsType_normal">
			<p class="ipsType_reset">
				
CONTENT;

$pluralize = array( $oauthApps ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'secure_account_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

			</p>
			<div class="ipsSpacer_top">
				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&area=apps", null, "settings_apps", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" target="_blank" rel="noopener" class="ipsButton ipsButton_primary ipsButton_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'review_oauth_apps', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function settingsSignature( $form, $sigLimits ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPadding'>

CONTENT;

if ( $sigLimits[1] != "" or $sigLimits[2] or $sigLimits[3] or $sigLimits[4] or $sigLimits[5] ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signature_restrictions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		<p class='ipsType_medium ipsType_reset'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ensure_signature_restrictions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
:
		</p>

		<div class='ipsType_textBlock ipsType_normal'>
			<br>
			<ul class='ipsList_inline'>
				
CONTENT;

if ( $sigLimits[1] != "" ):
$return .= <<<CONTENT

					<li>
CONTENT;

if ( $sigLimits[1] ):
$return .= <<<CONTENT
<i class='fa fa-check'></i> 
CONTENT;

$pluralize = array( $sigLimits[1] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_imagesr', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
<i class='fa fa-close'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_imagesr_none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $sigLimits[2] or $sigLimits[3] ):
$return .= <<<CONTENT

					<li><i class='fa fa-check'></i> 
CONTENT;

$sprintf = array($sigLimits[2], $sigLimits[3]); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_imgsize', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $sigLimits[4] ):
$return .= <<<CONTENT

					<li><i class='fa fa-check'></i> 
CONTENT;

$pluralize = array( $sigLimits[4] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_urls', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $sigLimits[5] ):
$return .= <<<CONTENT

					<li><i class='fa fa-check'></i> 
CONTENT;

$pluralize = array( $sigLimits[5] ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sig_max_lines', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
		<hr class='ipsHr'><br>

CONTENT;

endif;
$return .= <<<CONTENT

		{$form}
	</div>
CONTENT;

		return $return;
}

	function settingsUsername( $form, $made, $allowed, $since, $days ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
	<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>
<div class='ipsPadding'>
	
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_dname_changes'] != -1 ):
$return .= <<<CONTENT

		<div class='ipsType_textBlock ipsType_normal'>
			<ul class='ipsList_bullets'>
				<li>
CONTENT;

$sprintf = array($made, $allowed, $since->localeDate(), $days); $pluralize = array( $allowed ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_username_explain', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</li>
			</ul>
		</div>
		<br>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
	{$form}
</div>
CONTENT;

		return $return;
}

	function settingsUsernameLimitReached( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsAreaBackground_light ipsPadding ipsBorder_bottom'>
    <h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'change_username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
</div>
<div class='ipsPadding'>
    {$message}
</div>

CONTENT;

		return $return;
}

	function terms(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('reg_terms') );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsBox_alt ipsType_normal ipsType_richText ipsPad'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('reg_rules_value'), array('ipsType_normal') );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function unfollowFromEmail( $title, $member, $form, $choice ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $choice ):
$return .= <<<CONTENT

<div class='ipsBox_alt'>
	<p class='ipsType_reset ipsType_center ipsType_huge'>
		<i class='fa fa-envelope'></i>
	</p>

	<h1 class='ipsType_veryLarge ipsType_center'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_guest_unfollow_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

	<div class='ipsType_large ipsType_center ipsType_richText'>
		
CONTENT;

if ( $choice == 'single' ):
$return .= <<<CONTENT

			
CONTENT;

$sprintf = array($title); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_guest_unfollowed_thing', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

		
CONTENT;

elseif ( $choice == 'all' ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_guest_unfollowed_all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<br>
	<p class='ipsType_center'>
		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "/", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_normal ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_community_home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</p>
</div>

CONTENT;

else:
$return .= <<<CONTENT

<div class='ipsPadding'>
	<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_guest_unfollow_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
	<p class='ipsType_light'>
CONTENT;

$sprintf = array($member->name, $member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_guest_followed_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
	{$form}
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function unsubscribed(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('unsubscribed') );
$return .= <<<CONTENT

<div class='ipsLayout_contentSection ipsBox ipsPadding'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unsubscribed_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function warningRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class="ipsDataItem 
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
		<div class='ipsDataItem_icon ipsPos_top'>
			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$row->member}&w={$row->id}", null, "warn_view", array( \IPS\Member::load( $row->member )->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-size='narrow' class="ipsType_blendLinks" data-ipsTooltip title='
CONTENT;

$pluralize = array( $row->points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'wan_action_points', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
				<span class="ipsPoints">
CONTENT;
$return .= htmlspecialchars( $row->points, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</a>
		</div>
		<div class='ipsDataItem_main'>
			<h4 class='ipsDataItem_title'>				
				<a href='
CONTENT;
$return .= htmlspecialchars( $row->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_announcement', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' 
CONTENT;

if ( $row->tableHoverUrl ):
$return .= <<<CONTENT
data-ipsHover
CONTENT;

endif;
$return .= <<<CONTENT
>
					
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
			</h4>
            
CONTENT;

if ( $row->note_member ):
$return .= <<<CONTENT

                <div class='ipsDataItem_meta ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
                    
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_member_note', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->note_member}
                </div>
            
CONTENT;

endif;
$return .= <<<CONTENT

            
CONTENT;

if ( $row->note_mods and \IPS\Member::loggedIn()->modPermission('mod_see_warn') ):
$return .= <<<CONTENT

                <div class='ipsDataItem_meta ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='1 lines' data-ipsTruncate-type='remove'>
                    
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_mod_note', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: {$row->note_mods}
                </div>
            
CONTENT;

endif;
$return .= <<<CONTENT

            <ul class='ipsList_inline ipsSpacer_top ipsSpacer_half'>
            
CONTENT;

if ( \IPS\Settings::i()->warnings_acknowledge ):
$return .= <<<CONTENT

            	<li>
					
CONTENT;

if ( $row->acknowledged ):
$return .= <<<CONTENT

						<strong class='ipsType_success'><i class='fa fa-check-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_acknowledged', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					
CONTENT;

else:
$return .= <<<CONTENT

						<strong class='ipsType_light'><i class='fa fa-circle-o'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_not_acknowledged', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class='ipsType_light'>
CONTENT;

$sprintf = array(\IPS\Member::load( $row->moderator )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warned_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

$val = ( $row->__get( $row::$databaseColumnMap['date'] ) instanceof \IPS\DateTime ) ? $row->__get( $row::$databaseColumnMap['date'] ) : \IPS\DateTime::ts( $row->__get( $row::$databaseColumnMap['date'] ) );$return .= $val->html();
$return .= <<<CONTENT
 
CONTENT;

if ( $row->expire_date > 0 ):
$return .= <<<CONTENT
<em><strong>(
CONTENT;

$sprintf = array(\IPS\DateTime::ts( $row->expire_date )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warning_expires', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
)</em></strong>
CONTENT;

endif;
$return .= <<<CONTENT
</li>
		</div>
		
CONTENT;

if ( $row->canDelete() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_generic ipsDataItem_size3'>
				<a href="
CONTENT;
$return .= htmlspecialchars( $row->url('delete')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-action="revoke" class='ipsPos_right ipsButton ipsButton_verySmall ipsButton_light' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-size='medium'><i class="fa fa-undo"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'revoke_this_warning', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT

			<div class='ipsDataItem_modCheck ipsType_noBreak ipsPos_center'>
				<span class='ipsCustomInput'>
					<input type='checkbox' data-role='moderation' name="moderate[
CONTENT;
$return .= htmlspecialchars( $row->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" data-actions="
CONTENT;

$return .= htmlspecialchars( implode( ' ', $table->multimodActions( $row ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( !$row->active ):
$return .= <<<CONTENT
hidden
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

		return $return;
}}