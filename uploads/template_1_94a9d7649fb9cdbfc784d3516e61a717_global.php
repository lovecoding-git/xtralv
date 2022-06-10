<?php
namespace IPS\Theme\Cache;
class class_core_front_global extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function acknowledgeWarning( $warnings=array() ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $warnings as $idx => $warning ):
$return .= <<<CONTENT

	
CONTENT;

if ( $idx === 0 ):
$return .= <<<CONTENT

		<div class='ipsMessage ipsMessage_error'>
			<h4 class='ipsMessage_title'>
CONTENT;

$sprintf = array(\IPS\Member::load( $warning->moderator )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'you_have_been_warned', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</h4>
			
CONTENT;

if ( \IPS\Member::loggedIn()->isBanned() ):
$return .= <<<CONTENT

				
CONTENT;

if ( $warning->note_member ):
$return .= <<<CONTENT

					<p class='ipsType_reset ipsType_medium'>{$warning->note_member}</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<p class='ipsType_reset ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'must_acknowledge_msg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				<br>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$warning->member}&w={$warning->id}", null, "warn_view", array( \IPS\Member::loggedIn()->members_seo_name ), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_veryLight' data-ipsDialog data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<br>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function announcementContentTop(  ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $announcements = \IPS\core\Announcements\Announcement::loadAllByLocation('content') ):
$return .= <<<CONTENT

	<div class='cAnnouncementsContent'>
		
CONTENT;

foreach ( $announcements as $announcement ):
$return .= <<<CONTENT

		<div class='cAnnouncementContentTop ipsAnnouncement ipsMessage_
CONTENT;
$return .= htmlspecialchars( $announcement->color, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsType_center'>
            
CONTENT;

if ( $announcement->type == \IPS\core\Announcements\Announcement::TYPE_CONTENT ):
$return .= <<<CONTENT

			<a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
            
CONTENT;

elseif ( $announcement->type == \IPS\core\Announcements\Announcement::TYPE_URL ):
$return .= <<<CONTENT

            <a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel='noopener'>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
            
CONTENT;

else:
$return .= <<<CONTENT

            <span>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
            
CONTENT;

endif;
$return .= <<<CONTENT

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

	function announcementSidebar( $announcements ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox ipsSpacer_bottom' id="cAnnouncementSidebar">
	<span class="cAnnouncementIcon"><i class='fa fa-bullhorn fa-3x fa-fw'></i></span>
	<h3 class='ipsType_minorHeading ipsType_center ipsType_medium ipsType_dark ipsSpacer_bottom'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'announcements', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<ul class='ipsList_reset'>
	
CONTENT;

foreach ( $announcements as $announcement ):
$return .= <<<CONTENT

		<li class="cAnnouncementSidebar ipsAnnouncement ipsMessage_
CONTENT;
$return .= htmlspecialchars( $announcement->color, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
            
CONTENT;

if ( $announcement->type == \IPS\core\Announcements\Announcement::TYPE_CONTENT ):
$return .= <<<CONTENT

            <a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
            
CONTENT;

elseif ( $announcement->type == \IPS\core\Announcements\Announcement::TYPE_URL ):
$return .= <<<CONTENT

            <a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel='noopener'>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
            
CONTENT;

else:
$return .= <<<CONTENT

            <span>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
            
CONTENT;

endif;
$return .= <<<CONTENT

        </li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}

	function announcementTop(  ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $announcements = \IPS\core\Announcements\Announcement::loadAllByLocation('top') ):
$return .= <<<CONTENT

<div class='cAnnouncements' data-controller="core.front.core.announcementBanner" >
	
CONTENT;

foreach ( $announcements as $announcement ):
$return .= <<<CONTENT

	<div class='cAnnouncementPageTop ipsJS_hide ipsAnnouncement ipsMessage_
CONTENT;
$return .= htmlspecialchars( $announcement->color, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-announcementId="
CONTENT;
$return .= htmlspecialchars( $announcement->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
        
CONTENT;

if ( $announcement->type == \IPS\core\Announcements\Announcement::TYPE_CONTENT ):
$return .= <<<CONTENT

        <a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
        
CONTENT;

elseif ( $announcement->type == \IPS\core\Announcements\Announcement::TYPE_URL ):
$return .= <<<CONTENT

        <a href='
CONTENT;
$return .= htmlspecialchars( $announcement->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel='noopener'>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
        
CONTENT;

else:
$return .= <<<CONTENT

        <span>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
        
CONTENT;

endif;
$return .= <<<CONTENT


		<a href='#' data-role="dismissAnnouncement">×</a>
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

	function blankTemplate( $html, $title=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<title>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->getTitle( $title ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] != 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

	</head>
	<body class='ipsApp ipsApp_front ipsClearfix ipsLayout_noBackground 
CONTENT;

if ( isset( \IPS\Request::i()->cookie['hasJS'] ) ):
$return .= <<<CONTENT
ipsJS_has
CONTENT;

else:
$return .= <<<CONTENT
ipsJS_none
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix
CONTENT;

foreach ( \IPS\Output::i()->bodyClasses as $class ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Output::i()->globalControllers ):
$return .= <<<CONTENT
data-controller='
CONTENT;

$return .= htmlspecialchars( implode( ',', \IPS\Output::i()->globalControllers ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( \IPS\Output::i()->inlineMessage ) ):
$return .= <<<CONTENT
data-message="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->inlineMessage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		{$html}
		
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] == 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Output::i()->endBodyCode;
$return .= <<<CONTENT

	</body>
</html>
CONTENT;

		return $return;
}

	function box( $content=NULL, $classes=array() ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsBox 
CONTENT;

if ( \count( $classes) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( implode( ' ', $classes ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function breadcrumb( $position='top', $markRead=TRUE ) {
		$return = '';
		$return .= <<<CONTENT

<nav class='ipsBreadcrumb ipsBreadcrumb_
CONTENT;
$return .= htmlspecialchars( $position, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsFaded_withHover'>
	
CONTENT;

if ( $position == 'bottom' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rssMenu(  );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


	<ul class='ipsList_inline ipsPos_right'>
		
CONTENT;

$defaultStream = \IPS\core\Stream::defaultStream();
$return .= <<<CONTENT

		<li 
CONTENT;

if ( !\IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'discover' ) )  ):
$return .= <<<CONTENT
 class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
>
			<a data-action="defaultStream" class='ipsType_light 
CONTENT;

if ( ! $defaultStream ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'  href='
CONTENT;

if ( $defaultStream ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $defaultStream->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>
CONTENT;

if ( $defaultStream ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $defaultStream->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span></a>
		</li>
		
CONTENT;

if ( $markRead && \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			<li>
				<a data-action="markSiteRead" class='ipsType_light' data-controller="core.front.core.markRead" href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=markread" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "mark_site_as_read", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_site_read', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-check' aria-hidden="true"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_site_read_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>

	<ul data-role="breadcrumbList">
		<li>
			<a title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
'>
				<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( \count( \IPS\Output::i()->breadcrumb ) ):
$return .= <<<CONTENT
 <i class='fa fa-angle-right'></i>
CONTENT;

endif;
$return .= <<<CONTENT
</span>
			</a>
		</li>
		
CONTENT;

$last = end(\IPS\Output::i()->breadcrumb);
$return .= <<<CONTENT

		
CONTENT;

foreach ( \IPS\Output::i()->breadcrumb as $k => $b ):
$return .= <<<CONTENT

			<li>
				
CONTENT;

if ( $b[0] === NULL ):
$return .= <<<CONTENT

					
CONTENT;
$return .= htmlspecialchars( $b[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $b[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
						<span>
CONTENT;
$return .= htmlspecialchars( $b[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $b != $last ):
$return .= <<<CONTENT
<i class='fa fa-angle-right' aria-hidden="true"></i>
CONTENT;

endif;
$return .= <<<CONTENT
</span>
					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</nav>
CONTENT;

		return $return;
}

	function buttons( $buttons ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsToolList ipsToolList_horizontal ipsClearfix'>
	
CONTENT;

foreach ( $buttons as $button ):
$return .= <<<CONTENT

		<li class='
CONTENT;

if ( isset( $button['hidden'] ) and $button['hidden'] ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( isset( $button['id'] ) ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $button['id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
			<a
				
CONTENT;

if ( isset( $button['link'] ) ):
$return .= <<<CONTENT
href='
CONTENT;
$return .= htmlspecialchars( $button['link'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

				title='
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
				class='ipsButton ipsButton_alternate ipsButton_small ipsButton_fullWidth 
CONTENT;

if ( isset( $button['class'] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $button['class'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'
				role="button"
				
CONTENT;

if ( isset( $button['id'] ) ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $button['id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_button"
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['target'] ) ):
$return .= <<<CONTENT
target="
CONTENT;
$return .= htmlspecialchars( $button['target'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

if ( $button['target'] == '_blank' ):
$return .= <<<CONTENT
 rel="noopener"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['data'] ) ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $button['data'] as $k => $v ):
$return .= <<<CONTENT

						data-
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

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['hotkey'] ) ):
$return .= <<<CONTENT

					data-keyAction='
CONTENT;
$return .= htmlspecialchars( $button['hotkey'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
				
CONTENT;

endif;
$return .= <<<CONTENT

			>
				
CONTENT;

if ( $button['icon'] ):
$return .= <<<CONTENT

					<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $button['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i>&nbsp;
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT


				
CONTENT;

if ( isset($button['dropdown']) ):
$return .= <<<CONTENT

					&nbsp;<i class='fa fa-caret-down'></i>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</a>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}

	function cachingLog( $log ) {
		$return = '';
		$return .= <<<CONTENT

<div id="elCachingLog">
	
CONTENT;

foreach ( $log as $i => $log ):
$return .= <<<CONTENT

		
CONTENT;

$i = \str_replace( '.', '_', $i);
$return .= <<<CONTENT

		<div class="cCachingLog" data-ipsDialog data-ipsDialog-content="#elCachingLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
			
CONTENT;

if ( $log[0] === 'get' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_get">get</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

elseif ( $log[0] === 'set' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_set">set</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

elseif ( $log[0] === 'check' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_check">check</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

elseif ( $log[0] === 'delete' ):
$return .= <<<CONTENT

				<span class="cCachingLogMethod cCachingLogMethod_delete">delete</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

else:
$return .= <<<CONTENT

				<span class="cCachingLogMethod">Redis</span>
				<span class="cCachingLogKey">
CONTENT;
$return .= htmlspecialchars( $log[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<div id='elCachingLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsPad ipsHide'>
			
CONTENT;

if ( ! empty( $log[2] ) ):
$return .= <<<CONTENT

				<pre class="prettyprint lang-php">
CONTENT;
$return .= htmlspecialchars( $log[2], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
				<hr class="ipsHr">
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( isset( $log[3] ) ):
$return .= <<<CONTENT
<pre class="prettyprint lang-php">
CONTENT;
$return .= htmlspecialchars( $log[3], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
		<hr class="ipsHr">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function comment( $item, $comment, $editorName, $app, $type, $class='' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT

<div id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' data-controller='core.front.core.comment' data-commentApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentType='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentID="
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-quoteData='
CONTENT;

$return .= htmlspecialchars( json_encode( array('userid' => $comment->author()->member_id, 'username' => $comment->author()->name, 'timestamp' => $comment->mapped('date'), 'contentapp' => $app, 'contenttype' => $type, 'contentclass' => $class, 'contentid' => $item->id, 'contentcommentid' => $comment->$idField) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium'>
	
	
CONTENT;

if ( $comment->author()->hasHighlightedReplies() || ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight ) OR $comment->isFeatured() ):
$return .= <<<CONTENT

		<div class='ipsResponsive_showPhone ipsComment_badges'>
			<ul class='ipsList_reset ipsFlex ipsFlex-fw:wrap ipsGap:2 ipsGap_row:1'>
				
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT

					<li><strong class='ipsBadge ipsBadge_large ipsBadge_highlightedGroup'>
CONTENT;

$return .= \IPS\Member\Group::load( $comment->author()->member_group_id )->name;
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $comment->isFeatured() ):
$return .= <<<CONTENT

					<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_featured_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight )  ):
$return .= <<<CONTENT

					<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsComment_header ipsFlex ipsFlex-ai:start ipsFlex-jc:between'>
		<div class='ipsPhotoPanel ipsPhotoPanel_mini'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', $comment->warningRef() );
$return .= <<<CONTENT

			<div>
				<h3 class='ipsComment_author ipsType_blendLinks'>
					<strong class='ipsType_normal'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $comment->author(), $comment->warningRef(), NULL, $comment->isAnonymous() );
$return .= <<<CONTENT
</strong>
					
CONTENT;

if ( $comment instanceof \IPS\Content\Anonymous and $comment->isAnonymous() and \IPS\Member::loggedIn()->modPermission('can_view_anonymous_posters') ):
$return .= <<<CONTENT

						<a data-ipsHover data-ipsHover-width="370" data-ipsHover-onClick href="
CONTENT;
$return .= htmlspecialchars( $comment->url( 'reveal' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"><span class="cAuthorPane_badge cAuthorPane_badge_small cAuthorPane_badge--anon" data-ipsTooltip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_anonymously_reveal', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"></span></a>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $comment->author() );
$return .= <<<CONTENT

				</h3>
				<p class='ipsComment_meta ipsType_light ipsType_medium'>
					<a href='
CONTENT;
$return .= htmlspecialchars( $comment->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a>
					
CONTENT;

if ( $comment->ip_address and \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

						&middot; <a class='ipsType_blendLinks ipsType_light ipsType_noUnderline' href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip=$comment->ip_address", null, "modcp_ip_tools", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-menuID='
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ip_menu'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-down'></i></a>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

						(
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edited_lc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->hidden() AND $comment->hidden() != -2 ):
$return .= <<<CONTENT

						&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

elseif ( $comment->hidden() == -2 ):
$return .= <<<CONTENT

						&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->deletedBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>

				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') and $comment->warning ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentWarned( $comment );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<div class='ipsType_reset ipsType_light ipsType_blendLinks ipsComment_toolWrap'>
			<div class='ipsResponsive_hidePhone ipsComment_badges'>
				<ul class='ipsList_reset ipsFlex ipsFlex-jc:end ipsFlex-fw:wrap ipsGap:2 ipsGap_row:1'>
					
CONTENT;

if ( $comment->author()->hasHighlightedReplies() || ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight ) OR $comment->isFeatured() ):
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT

							<li><strong class='ipsBadge ipsBadge_large ipsBadge_highlightedGroup'>
CONTENT;

$return .= \IPS\Member\Group::load( $comment->author()->member_group_id )->name;
$return .= <<<CONTENT
</strong></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $comment->isFeatured() ):
$return .= <<<CONTENT

							<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_featured_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight )  ):
$return .= <<<CONTENT

							<li><strong class='ipsBadge ipsBadge_large ipsBadge_popular'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			</div>
			
CONTENT;

if ( $comment->hidden() !== 1 && ( $comment->canReportOrRevoke() === TRUE || \count( $comment->sharelinks() ) || $comment->canEdit() || ( $comment->canPromoteToSocialMedia() || $comment->canDelete() || $comment->canSplit() || ( $comment instanceof \IPS\Content\Hideable AND ( ( !$comment->hidden() and $comment->canHide() ) || ( $comment->hidden() and $comment->canUnhide() ) ) ) || ( $comment->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ) ) || \count( $item->commentMultimodActions() ) ) ):
$return .= <<<CONTENT

				<ul class='ipsList_reset ipsComment_tools'>
					<li>
						<a href='#elControlsComments_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsComment_ellipsis' id='elControlsComments_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'><i class='fa fa-ellipsis-h'></i></a>
						<ul id='elControlsComments_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
							
CONTENT;

if ( $comment->canReportOrRevoke() === TRUE ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('report'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-content='#elShareComment_
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" id='elShareComment_
CONTENT;
$return .= htmlspecialchars( $comment->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

if ( $comment->canReportOrRevoke() === TRUE || \count( $comment->sharelinks() ) ):
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->canEdit() || ( $comment->canPromoteToSocialMedia() || $comment->canDelete() || $comment->canSplit() || ( $comment instanceof \IPS\Content\Hideable AND ( ( !$comment->hidden() and $comment->canHide() ) || ( $comment->hidden() and $comment->canUnhide() ) ) ) || ( $comment->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ) ) ):
$return .= <<<CONTENT

									<li class='ipsMenu_sep'><hr></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->canEdit() ):
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->mapped('first') and $comment->item()->canEdit() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

else:
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('edit'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $comment->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('restore')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('restore')->csrf()->setQueryString( 'restoreAsHidden', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setQueryString( 'immediately', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;

if ( $comment instanceof \IPS\Content\Hideable ):
$return .= <<<CONTENT

									
CONTENT;

if ( !$comment->hidden() and $comment->canHide() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;

if ( $comment::$hideLogKey ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->url('hide'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->url('hide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

elseif ( $comment->hidden() and $comment->canUnhide() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unhide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('split'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-updateOnDelete="#commentCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->isFeatured() AND $item->canUnfeatureComment() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unfeature')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action="unrecommendComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unrecommend_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( !$comment->isFeatured() AND $item->canFeatureComment() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('feature')->setPage('page', \IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recommend_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-size='narrow' data-action="recommendComment">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recommend_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->canPromoteToSocialMedia() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->promoteLink( $comment );
$return .= <<<CONTENT
</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</li>
					
CONTENT;

if ( \count( $item->commentMultimodActions() ) ):
$return .= <<<CONTENT

						<li><span class='ipsCustomInput'>
							<input type="checkbox" name="multimod[
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" data-role="moderation" data-actions="
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT
split merge
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->hidden() === -1 AND $comment->canUnhide() ):
$return .= <<<CONTENT
unhide
CONTENT;

elseif ( $comment->hidden() === 1 AND $comment->canUnhide() ):
$return .= <<<CONTENT
approve
CONTENT;

elseif ( $comment->canHide() ):
$return .= <<<CONTENT
hide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT
delete
CONTENT;

endif;
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $comment->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $comment->tableStates(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
							<span></span>
						</span></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
	<div class="ipsPadding_vertical sm:ipsPadding_vertical:half ipsPadding_horizontal">
		<div data-role='commentContent' class='ipsType_normal ipsType_richText ipsContained' data-controller='core.front.core.lightboxedImages'>
			
CONTENT;

if ( $comment->hidden() === 1 && $comment->author()->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<strong class='ipsType_medium ipsType_warning'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_awaiting_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
			
CONTENT;

endif;
$return .= <<<CONTENT

			{$comment->content()}

			
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

				{$comment->editLine()}
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
	
CONTENT;

if ( ( $comment->hidden() !== 1 && \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and $comment->hasReactionBar() ) || ( $comment->hidden() === 1 && ( $comment->canUnhide() || $comment->canDelete() ) ) || ( $comment->hidden() === 0 and $item->canComment() and $editorName )  ):
$return .= <<<CONTENT

		<div class='ipsItemControls'>
			
CONTENT;

if ( $comment->hidden() !== 1 && \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and $comment->hasReactionBar() ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $comment );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<ul class='ipsComment_controls ipsClearfix ipsItemControls_left' data-role="commentControls">
				
CONTENT;

if ( $comment->hidden() === 1 && ( $comment->canUnhide() || $comment->canDelete() ) ):
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->canUnhide() ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('unhide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_positive' data-action='approveComment'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->canDelete() ):
$return .= <<<CONTENT

						<li><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('delete')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-updateOnDelete="#commentCount" class='ipsButton ipsButton_verySmall ipsButton_negative'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->canEdit() || $comment->canSplit() || $comment->canHide() ):
$return .= <<<CONTENT

						<li>
							<a href='#elControlsCommentsSub_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elControlsCommentsSub_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'moderator_tools', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
							<ul id='elControlsCommentsSub_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
								
CONTENT;

if ( $comment->canEdit() ):
$return .= <<<CONTENT

									
CONTENT;

if ( $comment->mapped('first') and $comment->item()->canEdit() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

else:
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('edit'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $comment->canSplit() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('split'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( $comment instanceof \IPS\Content\Hideable and $comment->canHide() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('hide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</ul>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->hidden() === 0 and $item->canComment() and $editorName ):
$return .= <<<CONTENT

						<li data-ipsQuote-editor='
CONTENT;
$return .= htmlspecialchars( $editorName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsQuote-target='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsJS_show'>
							<button class='ipsButton ipsButton_light ipsButton_verySmall ipsButton_narrow cMultiQuote ipsHide' data-action='multiQuoteComment' data-ipsTooltip data-ipsQuote-multiQuote data-mqId='mq
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'multiquote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-plus'></i></button>
						</li>
						<li data-ipsQuote-editor='
CONTENT;
$return .= htmlspecialchars( $editorName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsQuote-target='#comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsJS_show'>
							<a href='#' data-action="quoteComment" data-ipsQuote-singleQuote>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'quote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsHide' data-role='commentLoading'>
					<span class='ipsLoading ipsLoading_tiny ipsLoading_noAnim'></span>
				</li>
			</ul>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $comment->ip_address and \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

		<div class='ipsHide ipsPadding ipsMenu ipsMenu_veryWide' id='
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_ip_menu'>
			<h5 class='ipsType_normal ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
			<input type='text' autofocus class='ipsField_fullWidth ipsMargin_vertical:half' value='
CONTENT;
$return .= htmlspecialchars( $comment->ip_address, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip=$comment->ip_address", null, "modcp_ip_tools", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_about_ip_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-right'></i></a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharemenu( $comment );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function commentContainer( $item, $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$itemClassSafe = str_replace( '\\', '_', mb_substr( $comment::$itemClass, 4 ) );
$return .= <<<CONTENT


CONTENT;

if ( $comment->isIgnored() ):
$return .= <<<CONTENT

	<div class='ipsComment ipsComment_ignored ipsPad_half ipsType_light' id='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreCommentID='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ignoreUserID='
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <a href='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu data-ipsMenu-menuID='elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsMenu-appendTo='#elIgnoreComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
			<li class='ipsMenu_item' data-ipsMenuValue='showPost'><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_this_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			<li class='ipsMenu_sep'><hr></li>
			<li class='ipsMenu_item' data-ipsMenuValue='stopIgnoring'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=remove&id={$comment->author()->member_id}", null, "ignore", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array($comment->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stop_ignoring_posts_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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

CONTENT;

endif;
$return .= <<<CONTENT


<a id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></a>
<article 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
data-memberGroup="
CONTENT;
$return .= htmlspecialchars( $comment->author()->member_group_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

endif;
$return .= <<<CONTENT
 id='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsBox ipsBox--child ipsComment 
CONTENT;

if ( ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight ) OR $comment->isFeatured() ):
$return .= <<<CONTENT
ipsComment_popular
CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment_parent ipsClearfix ipsClear 
CONTENT;

if ( $comment->isIgnored() ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->author()->hasHighlightedReplies() ):
$return .= <<<CONTENT
ipsComment_highlighted
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $comment->hidden() OR $item->hidden() == -2 ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->comment( $item, $comment, $item::$formLangPrefix . 'comment', $item::$application, $item::$module, $itemClassSafe );
$return .= <<<CONTENT

</article>
CONTENT;

		return $return;
}

	function commentEditHistory( $editHistory, $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h1>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Settings::i()->edit_log_prune > 0 ):
$return .= <<<CONTENT

	<div class='ipsMessage ipsMessage_info
CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
 ipsSpacer_top
CONTENT;

endif;
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( \IPS\Settings::i()->edit_log_prune ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_log_prune_notice', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>

CONTENT;

endif;
$return .= <<<CONTENT

<div class="ipsPad" data-role="commentFeed">
	
CONTENT;

if ( \count($editHistory)  ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $editHistory as $edit ):
$return .= <<<CONTENT

		<article class='ipsBox ipsBox--child ipsComment ipsComment_parent ipsClearfix ipsClear'>
			<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini ipsPhotoPanel_notPhone'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $edit['member'] ), 'mini' );
$return .= <<<CONTENT

				<div>
					<h3 class='ipsComment_author ipsType_sectionHead'>
						
CONTENT;

$return .= \IPS\Member::load( $edit['member'] )->link();
$return .= <<<CONTENT

					</h3>
					<p class='ipsComment_meta ipsType_light'>
						
CONTENT;

$val = ( $edit['time'] instanceof \IPS\DateTime ) ? $edit['time'] : \IPS\DateTime::ts( $edit['time'] );$return .= $val->html();
$return .= <<<CONTENT

						
CONTENT;

if ( $edit['reason'] ):
$return .= <<<CONTENT

						<br>
						
CONTENT;
$return .= htmlspecialchars( $edit['reason'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</p>
				</div>
			</div>
			<div class='ipsAreaBackground_reset ipsPad'>
				<div class='ipsType_richText'>
					{$edit['new']}
				</div>
			</div>
		</article>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		<article class='ipsBox ipsBox--child ipsComment ipsComment_parent ipsClearfix ipsClear'>
			<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini ipsPhotoPanel_notPhone'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini' );
$return .= <<<CONTENT

				<div>
					<h3 class='ipsComment_author ipsType_sectionHead'>
						{$comment->author()->link(  NULL, NULL, $comment->isAnonymous() )}
					</h3>
					<p class='ipsComment_meta ipsType_light'>
						
CONTENT;

$val = ( $comment->mapped('date') instanceof \IPS\DateTime ) ? $comment->mapped('date') : \IPS\DateTime::ts( $comment->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

					</p>
				</div>
			</div>
			<div class='ipsAreaBackground_reset ipsPadding_vertical sm:ipsPadding_vertical:half ipsPadding_horizontal'>
				<div class='ipsType_richText'>
					{$edit['old']}
				</div>
			</div>
		</article>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_large ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_edit_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function commentEditLine( $comment, $supportsReason=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<span class='ipsType_reset ipsType_medium ipsType_light' data-excludequote>
	<strong>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $comment->mapped('edit_time') )->html(FALSE), ( $comment->mapped('edit_member_name') ) ? htmlspecialchars( $comment->mapped('edit_member_name'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) : \IPS\Member::loggedIn()->language()->addToStack('guest')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'date_edited', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong>
	
CONTENT;

if ( $supportsReason && $comment->mapped('edit_reason') ):
$return .= <<<CONTENT

		<br>
CONTENT;
$return .= htmlspecialchars( $comment->mapped('edit_reason'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->edit_log == 2 and ( \IPS\Settings::i()->edit_log_public or \IPS\Member::loggedIn()->modPermission('can_view_editlog') )  ):
$return .= <<<CONTENT

		<a href='
CONTENT;
$return .= htmlspecialchars( $comment->url('editlog'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>(
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)</a>
		
CONTENT;

if ( !$comment->mapped('edit_show') AND \IPS\Member::loggedIn()->modPermission('can_view_editlog') ):
$return .= <<<CONTENT

		<br>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_edit_show_anyways', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</span>
CONTENT;

		return $return;
}

	function commentMultimod( $item, $type='comment' ) {
		$return = '';
		$return .= <<<CONTENT

<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" />

CONTENT;

$method = $type . 'MultimodActions';
$return .= <<<CONTENT


CONTENT;

if ( $actions = $item->$method() and \count( $actions ) ):
$return .= <<<CONTENT

	<div class="ipsClearfix">
		<div class="ipsAreaBackground ipsPad ipsClearfix ipsJS_hide" data-role="pageActionOptions">
			<div class="ipsPos_right">
				<select name="modaction" data-role="moderationAction">
					
CONTENT;

if ( \in_array( 'approve', $actions ) ):
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

if ( \in_array( 'split_merge', $actions ) ):
$return .= <<<CONTENT

						<option value='split' data-icon='expand'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value='merge' data-icon='level-up'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'merge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \in_array( 'hide', $actions ) or \in_array( 'unhide', $actions ) ):
$return .= <<<CONTENT

						<optgroup label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-icon='eye' data-action='hide'>
							
CONTENT;

if ( \in_array( 'hide', $actions ) ):
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

if ( \in_array( 'unhide', $actions ) ):
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

if ( \in_array( 'delete', $actions ) ):
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
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function commentMultimodHeader( $item, $container, $type='comment' ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$method = $type . 'MultimodActions';
$return .= <<<CONTENT


CONTENT;

if ( $actions = $item->$method() and \count( $actions ) ):
$return .= <<<CONTENT

	<div class="ipsCommentMultimod ipsMargin_bottom ipsClearfix">
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			<li>
				<a class="ipsJS_show" href="#elCheck_menu" id="elCheck" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsAutoCheck data-ipsAutoCheck-context="
CONTENT;
$return .= htmlspecialchars( $container, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active">
					<span class="cAutoCheckIcon ipsType_medium"><i class="fa fa-square-o"></i></span> <i class="fa fa-caret-down"></i>
					<span class='ipsNotificationCount' data-role='autoCheckCount'>0</span>
				</a>
				<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsHide" id="elCheck_menu">
					<li class="ipsMenu_title">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'select_rows', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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
					<li class="ipsMenu_sep"><hr></li>
					<li class="ipsMenu_item" data-ipsMenuValue="hidden"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					<li class="ipsMenu_item" data-ipsMenuValue="unhidden"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					<li class="ipsMenu_item" data-ipsMenuValue="unapproved"><a href="#">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unapproved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				</ul>
			</li>
		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function commentRecognized( $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$blurb = $comment->recognizedBlurb();
$return .= <<<CONTENT

<!--Content Recognized -->
<div class="ipsType_reset ipsPad ipsAreaBackground_light ipsClearfix ipsPhotoPanel ipsPhotoPanel_mini">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->recognized->_given_by, 'mini' );
$return .= <<<CONTENT

	<div>
		<strong class='ipsType_normal'>
CONTENT;
$return .= htmlspecialchars( $blurb['main'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
		
CONTENT;

if ( $blurb['message'] ):
$return .= <<<CONTENT
<p>&quot;<em>{$blurb['message']}</em>&quot;</p>
CONTENT;

endif;
$return .= <<<CONTENT

		<p class='ipsType_light'>
			{$blurb['awards']}
		</p>
	</div>
</div>
CONTENT;

		return $return;
}

	function commentTableHeader( $comment, $status ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsFlex ipsFlex-ai:center sm:ipsFlex-ai:start sm:ipsMargin_top:double'>
	<div class='ipsFlex-flex:00 ipsMargin_right sm:ipsMargin_right:half'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $status->author() );
$return .= <<<CONTENT

	</div>
	<div>
		<p class='ipsType_medium ipsType_light ipsType_blendLinks ipsType_reset'>
			
CONTENT;

$htmlsprintf = array($status->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_updated_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

		</p>
		<div class='ipsType_richText ipsType_medium' data-ipsTruncate data-ipsTruncate-size='5 lines' data-ipsTruncate-type='remove'>
			{$status->truncated()}
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function commentWarned( $comment ) {
		$return = '';
		$return .= <<<CONTENT


<!-- Moderator warning -->
<div class="ipsType_reset ipsPad ipsAreaBackground_light ipsClearfix ipsPhotoPanel ipsPhotoPanel_mini">
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $comment->warning->moderator ), 'mini' );
$return .= <<<CONTENT

	<div>
		<strong class='ipsType_warning ipsType_normal'>
CONTENT;

$sprintf = array(\IPS\Member::load( $comment->warning->moderator )->name, \IPS\Member::load( $comment->warning->member )->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'member_given_post_warning', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>
		<br>
		<span class='ipsType_light'>
			<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_reason_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong> 
CONTENT;

$val = "core_warn_reason_{$comment->warning->reason}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &middot; <strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_points_message', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong> 
CONTENT;
$return .= htmlspecialchars( $comment->warning->points, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 &middot; <a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=warnings&do=view&id={$comment->warning->member}&w={$comment->warning->id}", null, "warn_view", array( $comment->author()->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_warning_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</span>
	</div>
</div>
CONTENT;

		return $return;
}

	function commentsAndReviewsTabs( $content, $id ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsResponsive_pull' data-controller='core.front.core.commentsWrapper' data-tabsId='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function confirmDelete( $message, $form, $title ) {
		$return = '';
		$return .= <<<CONTENT


<section class='ipsType_center ipsBox ipsPadding'>
    <br><br>
    <i class='ipsType_huge fa fa-exclamation-triangle'></i>

    <p class='ipsType_veryLarge'>
        
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

    </p>

    <p class='ipsType_large'>
        
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

    </p>
    <hr class='ipsHr'>
    {$form}
</section>
CONTENT;

		return $return;
}

	function contentEditLine( $item ) {
		$return = '';
		$return .= <<<CONTENT


<p class='ipsType_reset ipsType_medium ipsType_light' data-excludequote>
	<strong>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $item->mapped('edit_time') )->html(FALSE), htmlspecialchars( $item->mapped('edit_member_name'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'date_edited', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</strong>
	
CONTENT;

if ( $item->mapped('edit_reason') ):
$return .= <<<CONTENT

	<br>
CONTENT;
$return .= htmlspecialchars( $item->mapped('edit_reason'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->edit_log == 2 and ( \IPS\Settings::i()->edit_log_public or \IPS\Member::loggedIn()->modPermission('can_view_editlog') ) ):
$return .= <<<CONTENT

	<a href='
CONTENT;
$return .= htmlspecialchars( $item->url('editlog'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">(
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_history', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
)</a>
	
CONTENT;

if ( !$item->mapped('edit_show') AND \IPS\Member::loggedIn()->modPermission('can_view_editlog') ):
$return .= <<<CONTENT

	<br>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_edit_show_anyways', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</p>
CONTENT;

		return $return;
}

	function contentItemMessage( $message, $item, $id ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$member = \IPS\Member::load( $message['added_by'] );
$return .= <<<CONTENT


CONTENT;

$class = \get_class( $item );
$return .= <<<CONTENT

<div class='cContentMessage 
CONTENT;

if ( isset( $message['color'] ) && $message['color'] !== 'none' ):
$return .= <<<CONTENT
cContentMessage_color ipsMessage_
CONTENT;
$return .= htmlspecialchars( $message['color'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
 ipsBox
CONTENT;

endif;
$return .= <<<CONTENT
 ipsMargin_vertical'>
	<div class='cContentMessage__header ipsPadding:half'>
		<div class='ipsFlex ipsFlex-ai:center ipsFlex-fw:wrap ipsGap:3'>
			<div class='cContentMessage__header--avatar ipsFlex-flex:00'>
				
CONTENT;

if ( isset( $message['is_public'] ) AND $message['is_public']  ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					<span class='cContentMessage__badge'><i class="fa fa-lock" aria-hidden="true"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_staff_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='cContentMessage__header--text ipsFlex-flex:11 ipsFlex ipsFlex-fw:wrap ipsFlex-ai:center ipsFlex-jc:between'>
				<div class='ipsFlex-flex:11 ipsMargin_right'>
					
CONTENT;

if ( $member->member_id ):
$return .= <<<CONTENT

						<strong class='cContentMessage_author'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_item_message', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>
CONTENT;

if ( isset( $message['date'] )  ):
$return .= <<<CONTENT
<span class='ipsType_light'>, 
CONTENT;

$val = ( $message['date'] instanceof \IPS\DateTime ) ? $message['date'] : \IPS\DateTime::ts( $message['date'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

if ( isset( $message['date'] )  ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

$val = ( $message['date'] instanceof \IPS\DateTime ) ? $message['date'] : \IPS\DateTime::ts( $message['date'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				
CONTENT;

if ( $item->canOnMessage( 'edit' ) || $item->canOnMessage( 'delete' ) ):
$return .= <<<CONTENT

					<ul class='ipsFlex-flex:00 ipsFlex ipsGap:5 ipsGap_row:0'>
						
CONTENT;

if ( $item->canOnMessage( 'edit' ) ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( array( 'do' => 'messageForm', 'meta_id' => $id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $item->canOnMessage( 'delete' ) ):
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;
$return .= htmlspecialchars( $item->url()->csrf()->setQueryString( array( 'do' => 'messageDelete', 'meta_id' => $id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

			</div>
		</div>
	</div>
	<div class='ipsPad'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( $message['message'], array('ipsType_normal', 'ipsClearfix') );
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function contentItemMessages( $messages, $item ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $messages AS $id => $message ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->contentItemMessage( $message, $item, $id );
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function controlStrip( $buttons ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsControlStrip ipsType_noBreak ipsList_reset' data-ipsControlStrip>
	
CONTENT;

foreach ( $buttons as $button ):
$return .= <<<CONTENT

		<li class='ipsControlStrip_button 
CONTENT;

if ( isset( $button['hidden'] ) and $button['hidden'] ):
$return .= <<<CONTENT
ipsJS_hide
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( isset( $button['id'] ) ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $button['id'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
			<a
				
CONTENT;

if ( isset( $button['link'] ) ):
$return .= <<<CONTENT
href='
CONTENT;
$return .= htmlspecialchars( $button['link'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

				title='
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
				data-ipsTooltip
				aria-label="
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
				
				
CONTENT;

if ( isset( $button['class'] ) ):
$return .= <<<CONTENT
class='
CONTENT;
$return .= htmlspecialchars( $button['class'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['data'] ) ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $button['data'] as $k => $v ):
$return .= <<<CONTENT

						data-
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

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['hotkey'] ) ):
$return .= <<<CONTENT

					data-keyAction='
CONTENT;
$return .= htmlspecialchars( $button['hotkey'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( isset( $button['target'] ) ):
$return .= <<<CONTENT

					target="
CONTENT;
$return .= htmlspecialchars( $button['target'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
					
CONTENT;

if ( $button['target'] == '_blank' ):
$return .= <<<CONTENT
 rel="noopener"
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			>
				<i class='ipsControlStrip_icon fa fa-
CONTENT;
$return .= htmlspecialchars( $button['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i>
				<span class='ipsControlStrip_item'>
CONTENT;

$val = "{$button['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
			</a>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>

CONTENT;

		return $return;
}

	function coverPhoto( $url, $coverPhoto ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPageHead_special ipsCoverPhoto' data-controller='core.global.core.coverPhoto' data-url="
CONTENT;
$return .= htmlspecialchars( $url->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-coverOffset='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->offset, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	
CONTENT;

$cfObject = $coverPhoto->object;
$return .= <<<CONTENT

	
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

		<div class='ipsCoverPhoto_container'>
			
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT

				<img src='
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-src='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' data-action="toggleCoverPhoto" alt=''>
			
CONTENT;

else:
$return .= <<<CONTENT

				<img src='
CONTENT;
$return .= htmlspecialchars( $coverPhoto->file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' data-action="toggleCoverPhoto" alt=''>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

elseif ( ! empty( $cfObject::$coverPhotoDefault ) ):
$return .= <<<CONTENT

		<div class='ipsCoverPhoto_container' style="background-color: 
CONTENT;
$return .= htmlspecialchars( $coverPhoto->object->coverPhotoBackgroundColor(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			<img src='
CONTENT;

$return .= \IPS\Theme::i()->resource( "pattern.png", "core", 'global', false );
$return .= <<<CONTENT
' class='ipsCoverPhoto_photo' data-action="toggleCoverPhoto" alt=''>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$id = mt_rand();
$return .= <<<CONTENT

	
CONTENT;

if ( $coverPhoto->editable ):
$return .= <<<CONTENT

		<a href='#elEditPhoto
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-hideOnCoverEdit class='ipsCoverPhoto_button ipsPos_right ipsButton ipsButton_small ipsButton_overlaid' data-ipsMenu id='elEditPhoto
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='coverPhotoOptions'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsColumns ipsColumns_collapsePhone' data-hideOnCoverEdit>
		<div class='ipsColumn ipsColumn_fluid'>
			
CONTENT;

if ( $coverPhoto->editable ):
$return .= <<<CONTENT

				<ul class='ipsMenu ipsMenu_auto ipsHide' id='elEditPhoto
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					
CONTENT;

if ( $coverPhoto->file ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-role='photoEditOption'>
							<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'coverPhotoRemove' ) )->csrf()->addRef( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='removeCoverPhoto'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						<li class='ipsMenu_item ipsHide' data-role='photoEditOption'>
							<a href='#' data-action='positionCoverPhoto'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_reposition', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsMenu_item'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'coverPhotoUpload' ) )->addRef( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cover_photo_add', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

			{$coverPhoto->overlay}
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function customFieldsDisplay( $author ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $author->contentProfileFields() as $group => $fields ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $fields as $field => $value ):
$return .= <<<CONTENT

	<li data-role='custom-field' class='ipsResponsive_hidePhone ipsType_break'>
		{$value}
	</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function designersModeBuilding( $html, $title=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<title>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->getTitle( $title ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

	<style type="text/css">
		/* ======================================================== */
/* PROGRESS BAR */
@keyframes progress-bar-stripes {
	from { background-position: 40px 0; }
	to { background-position: 0 0; }
}

.ipsProgressBar {
	width: 50%;
	margin: auto;
	height: 26px;
	overflow: hidden;
	background: rgb(156,156,156);
	background: linear-gradient(to bottom, rgba(156,156,156,1) 0%,rgba(180,180,180,1) 100%);
	border-radius: var(--radius-1);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}
	
	.ipsProgressBar.ipsProgressBar_fullWidth {
		width: 100%;
	}

	.ipsProgressBar.ipsProgressBar_animated .ipsProgressBar_progress {
		background-color: #5490c0;
		background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		background-size: 40px 40px;
	}

.ipsProgressBar_progress {
	float: left;
	width: 0;
	height: 100%;
	font-size: 12px;
	font-weight: bold;
	color: #ffffff;
	text-align: center;
	text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.25);
	background: #5490c0;
	position: relative;
	white-space: nowrap;
	line-height: 26px;
}
	
	.ipsProgressBar_warning .ipsProgressBar_progress {
		background: #8c3737;
	}

	.ipsProgressBar > span:first-child {
		padding-left: 7px;
	}

	.ipsProgressBar_progress[data-progress]:after {
		position: absolute;
		right: 5px;
		top: 0;
		line-height: 32px;
		color: #fff;
		content: attr(data-progress);
		display: block;
		font-weight: bold;
	}
	
	span[data-role=message] {
		text-align: center;
		display: block;
		margin: 8px;
		font-family: Helvetica;
	}

	</style>
	</head>
	<body class="ipsApp ipsApp_front ipsJS_none ipsClearfix ipsLayout_noBackground">
		{$html}
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
$return .= <<<CONTENT

	</body>
</html>
CONTENT;

		return $return;
}

	function embedComment( $item, $comment, $url, $image=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$useImage = NULL;
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
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "embed", "core" )->embedHeader( $comment, $item->mapped('title'), $comment->mapped('date'), $url );
$return .= <<<CONTENT

	<div class='ipsPadding:double'>
		<div class='ipsRichEmbed_originalItem ipsAreaBackground_reset ipsSpacer_bottom ipsType_blendLinks'>
			<div>
				
CONTENT;

if ( $image ):
$return .= <<<CONTENT

					
CONTENT;

$useImage = $image;
$return .= <<<CONTENT

				
CONTENT;

elseif ( $contentImage = $item->contentImages(1) ):
$return .= <<<CONTENT

					
CONTENT;

$attachType = key( $contentImage[0] );
$return .= <<<CONTENT

					
CONTENT;

$useImage = \IPS\File::get( $attachType, $contentImage[0][ $attachType ] );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

if ( $useImage ):
$return .= <<<CONTENT

					<div class='ipsRichEmbed_masthead ipsRichEmbed_mastheadBg ipsType_center'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $useImage->url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" )'>
							<img src='
CONTENT;
$return .= htmlspecialchars( $useImage->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsHide' alt=''>
						</a>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT


				<div class='ipsPadding sm:ipsPadding:half'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "embed", "core" )->embedOriginalItem( $item );
$return .= <<<CONTENT

				</div>
			</div>
		</div>

		<div class='ipsType_richText ipsType_medium' data-truncate='3'>
			{$comment->truncated(TRUE)}
		</div>

		
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \count( $comment->reactions() ) ):
$return .= <<<CONTENT

			<ul class='ipsList_inline ipsSpacer_top ipsSpacer_half'>
				<li>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionOverview( $comment, TRUE, 'small' );
$return .= <<<CONTENT

				</li>
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function embedExternal( $output, $js ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<script type='text/javascript'>
			var ipsDebug = 
CONTENT;

if ( ( \IPS\IN_DEV and \IPS\DEV_DEBUG_JS ) or \IPS\DEBUG_JS ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
;
		</script>
		
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT


		
CONTENT;

if ( \is_array( $js ) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $js as $jsInclude ):
$return .= <<<CONTENT

				
CONTENT;

$filename = \IPS\Http\Url::external( $jsInclude[0] );
$return .= <<<CONTENT

				<script type='text/javascript' src='
CONTENT;
$return .= htmlspecialchars( $filename, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></script>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</head>
	<body class='unloaded 
CONTENT;

if ( isset( \IPS\Request::i()->cookie['hasJS'] ) ):
$return .= <<<CONTENT
ipsJS_has
CONTENT;

else:
$return .= <<<CONTENT
ipsJS_none
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='externalEmbed'>
		<div id='ipsEmbed'>
			{$output}
		</div>
		<div id='ipsEmbedLoading'>
			<span></span>
		</div>
	</body>
</html>

CONTENT;

		return $return;
}

	function embedInternal( $html, $js ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<title>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT


		<script type='text/javascript'>
			var ipsDebug = 
CONTENT;

if ( ( \IPS\IN_DEV and \IPS\DEV_DEBUG_JS ) or \IPS\DEBUG_JS ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
;
		</script>

		
CONTENT;

if ( \is_array( $js ) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $js as $jsInclude ):
$return .= <<<CONTENT

				
CONTENT;

$filename = \IPS\Http\Url::external( $jsInclude[0] );
$return .= <<<CONTENT

				<script type='text/javascript' src='
CONTENT;
$return .= htmlspecialchars( $filename, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></script>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</head>
	<body class='unloaded ipsApp ipsApp_front ipsClearfix ipsLayout_noBackground 
CONTENT;

if ( isset( \IPS\Request::i()->cookie['hasJS'] ) ):
$return .= <<<CONTENT
ipsJS_has
CONTENT;

else:
$return .= <<<CONTENT
ipsJS_none
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix
CONTENT;

foreach ( \IPS\Output::i()->bodyClasses as $class ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
' data-role='internalEmbed' 
CONTENT;

if ( \IPS\Dispatcher::i()->application ):
$return .= <<<CONTENT
data-pageapp='
CONTENT;

$return .= htmlspecialchars( \IPS\Dispatcher::i()->application->directory, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Dispatcher::i()->module ):
$return .= <<<CONTENT
data-pagemodule='
CONTENT;

$return .= htmlspecialchars( \IPS\Dispatcher::i()->module->key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 data-pagecontroller='
CONTENT;

$return .= htmlspecialchars( \IPS\Dispatcher::i()->controller, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<div id='ipsEmbed'>
			{$html}
		</div>
		<div id='ipsEmbedLoading'>
			<span></span>
		</div>
		
CONTENT;

$return .= \IPS\Output::i()->endBodyCode;
$return .= <<<CONTENT

	</body>
</html>

CONTENT;

		return $return;
}

	function embedItem( $item, $url, $image=NULL ) {
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
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "embed", "core" )->embedHeader( $item, $item->mapped('title'), $item->mapped('date'), $url );
$return .= <<<CONTENT

	
CONTENT;

if ( $image ):
$return .= <<<CONTENT

		
CONTENT;

$useImage = $image;
$return .= <<<CONTENT

	
CONTENT;

elseif ( $contentImage = $item->contentImages(1) ):
$return .= <<<CONTENT

		
CONTENT;

$attachType = key( $contentImage[0] );
$return .= <<<CONTENT

		
CONTENT;

$useImage = \IPS\File::get( $attachType, $contentImage[0][ $attachType ] );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( $useImage ):
$return .= <<<CONTENT

		<div class='ipsRichEmbed_masthead ipsRichEmbed_mastheadBg ipsType_center'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $useImage->url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" )'>
				<img src='
CONTENT;
$return .= htmlspecialchars( $useImage->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsHide' alt=''>
			</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsPadding:double ipsClearfix'>
		
CONTENT;

if ( $desc = $item->truncated(TRUE) ):
$return .= <<<CONTENT

			<div class='ipsType_richText ipsType_medium' data-truncate='3'>
				{$desc}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "embed", "core" )->embedItemStats( $item );
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function embedReview( $item, $review, $url, $image=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

$useImage = NULL;
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
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "embed", "core" )->embedHeader( $review, $item->mapped('title'), $review->mapped('date'), $url );
$return .= <<<CONTENT

	<div class='ipsPadding:double'>
		<div class='ipsRichEmbed_originalItem ipsAreaBackground_reset ipsSpacer_bottom ipsType_blendLinks'>
			<div>
				
CONTENT;

if ( $image ):
$return .= <<<CONTENT

					
CONTENT;

$useImage = $image;
$return .= <<<CONTENT

				
CONTENT;

elseif ( $contentImage = $item->contentImages(1) ):
$return .= <<<CONTENT

					
CONTENT;

$attachType = key( $contentImage[0] );
$return .= <<<CONTENT

					
CONTENT;

$useImage = \IPS\File::get( $attachType, $contentImage[0][ $attachType ] );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

if ( $useImage ):
$return .= <<<CONTENT

					<div class='ipsRichEmbed_masthead ipsRichEmbed_mastheadBg ipsType_center'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' style='background-image: url( "
CONTENT;

$return .= htmlspecialchars( str_replace( array( '(', ')' ), array( '\(', '\)' ), $useImage->url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" )'>
							<img src='
CONTENT;
$return .= htmlspecialchars( $useImage->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsHide' alt=''>
						</a>
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT


				<div class='ipsPadding sm:ipsPadding:half'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "embed", "core" )->embedOriginalItem( $item );
$return .= <<<CONTENT

				</div>
			</div>
		</div>

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->rating( 'veryLarge', $review->mapped('rating') );
$return .= <<<CONTENT
 
		
CONTENT;

if ( $review->mapped('votes_total') ):
$return .= <<<CONTENT

			<p class='ipsType_reset ipsType_medium'>{$review->helpfulLine()}</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<hr class='ipsHr'>
		<div class='ipsType_richText ipsType_medium ipsSpacer_top ipsSpacer_half' data-truncate='3'>
			{$review->truncated(TRUE)}
		</div>

		
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $review, 'IPS\Content\Reactable' ) and \count( $review->reactions() ) ):
$return .= <<<CONTENT

			<ul class='ipsList_inline ipsSpacer_top ipsSpacer_half'>
				<li>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionOverview( $review, TRUE, 'small' );
$return .= <<<CONTENT

				</li>
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function error( $title, $message, $code, $extra, $member, $faultyPluginOrApp=NULL, $httpStatusCode=500 ) {
		$return = '';
		$return .= <<<CONTENT


<section id='elError' class='ipsType_center'>
	<div class='ipsBox ipsPad'>
		
CONTENT;

if ( ! \in_array( (int) $httpStatusCode, [404, 403] ) ):
$return .= <<<CONTENT
 <i class='fa fa-exclamation-circle ipsType_huge'></i>
CONTENT;

endif;
$return .= <<<CONTENT

        <p class='ipsPadding:half ipsType_reset ipsType_light ipsType_large'>
CONTENT;

if ( \in_array( (int) $httpStatusCode, [404, 403] ) ):
$return .= <<<CONTENT

CONTENT;

$val = "something_went_wrong_{$httpStatusCode}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'something_went_wrong', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</p>
		<div id='elErrorMessage' class='ipsPadding:half ipsPos_center'>
			{$message}
		</div>
		
CONTENT;

if ( ( \IPS\IN_DEV or $member->isAdmin() ) and $extra ):
$return .= <<<CONTENT

			
CONTENT;

if ( $faultyPluginOrApp ):
$return .= <<<CONTENT

			<p class="ipsType_reset  ipsType_large ipsPos_center">
				
CONTENT;
$return .= htmlspecialchars( $faultyPluginOrApp, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</p>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<div class="ipsPad ipsType_left">
				<h3 class="ipsType_minorHeading">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
				<textarea rows="13" style="font-family: monospace;">
CONTENT;
$return .= htmlspecialchars( $extra, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</textarea>
				<p class="ipsType_small ipsType_light">
					
CONTENT;

if ( $member->isAdmin() ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

if ( $member->hasAcpRestriction( 'core', 'support', 'system_logs_view' ) ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details_logs', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

elseif ( \IPS\IN_DEV ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_technical_details_dev', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( ( \IPS\Member::loggedIn()->isAdmin() and \IPS\Member::loggedIn()->hasAcpRestriction( 'core', 'support', 'get_support' ) ) || ( \IPS\Member::loggedIn()->canUseContactUs() and !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'contact' ) ) || !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

		<hr class='ipsHr'>

		<ul class='ipsList_inline'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->isAdmin() and \IPS\Member::loggedIn()->hasAcpRestriction( 'core', 'support', 'get_support' ) ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=support&controller=support", "admin", "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_support', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_medium'>
						<i class="fa fa-lock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_support', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			
CONTENT;

elseif ( \IPS\Member::loggedIn()->canUseContactUs() and !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'contact' ) ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=contact&controller=contact", null, "contact", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_admin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_light ipsButton_medium'>
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_admin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</a>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<li>
					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_medium' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

	</div>
    <p class='ipsPadding_top ipsType_light ipsType_reset ipsType_small ipsPos_right'>
        
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'error_page_code', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <strong>
CONTENT;
$return .= htmlspecialchars( $code, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
    </p>
</section>
CONTENT;

		return $return;
}

	function favico(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->icons_favicon ):
$return .= <<<CONTENT

	
CONTENT;

$file = \IPS\File::get( 'core_Icons', \IPS\Settings::i()->icons_favicon );
$return .= <<<CONTENT

	<link rel='shortcut icon' href='
CONTENT;
$return .= htmlspecialchars( $file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' type="
CONTENT;

$return .= htmlspecialchars( \IPS\File::getMimeType( $file->originalFilename ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function featuredComment( $comment, $id, $commentLang='__defart_comment' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( $comment['comment'] ) ):
$return .= <<<CONTENT

	
CONTENT;

$idField = $comment['comment']::$databaseColumnId;
$return .= <<<CONTENT

	<div class='ipsBox ipsBox--child ipsPadding ipsClearfix ipsComment_recommended ipsSpacer_bottom' data-commentID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<span class='ipsComment_recommendedFlag'><i class='fa fa-star'></i><span class='ipsResponsive_hidePhone'> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recommended', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></span>
		<div class='ipsColumns ipsColumns_collapsePhone'>
			<aside class='ipsType_center ipsColumn ipsColumn_narrow ipsResponsive_hidePhone'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment['comment']->author(), 'small', $comment['comment']->warningRef() );
$return .= <<<CONTENT

			</aside>
			<div class='ipsColumn ipsColumn_fluid ipsType_blendLinks'>
				<p class='ipsComment_meta ipsSpacer_bottom ipsSpacer_half ipsType_light'>
					
CONTENT;

$htmlsprintf = array($comment['comment']->author()->link( $comment['comment']->warningRef() ), \IPS\DateTime::ts( $comment['comment']->mapped('date') )->html(FALSE)); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'posted_by_x', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

				</p>
				<div class='ipsType_richText ipsType_normal' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='2 lines'>{$comment['comment']->truncated( TRUE )}</div>
	
				
CONTENT;

if ( $comment['note'] ):
$return .= <<<CONTENT

					<div class='ipsComment_recommendedNote ipsType_medium'>
						<p class='ipsType_reset ipsType_richText'>
CONTENT;
$return .= htmlspecialchars( $comment['note'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</p>
						
CONTENT;

if ( isset( $comment['featured_by'] ) ):
$return .= <<<CONTENT

							<p class='ipsType_reset ipsType_light'>
CONTENT;

$htmlsprintf = array($comment['featured_by']->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recommended_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				
CONTENT;

elseif ( isset( $comment['featured_by'] ) ):
$return .= <<<CONTENT

					
CONTENT;

$htmlsprintf = array($comment['featured_by']->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'recommended_by', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<div class='ipsColumn ipsColumn_medium'>
				
CONTENT;

if ( \IPS\IPS::classUsesTrait( $comment['comment'], 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionOverview( $comment['comment'] );
$return .= <<<CONTENT

					<hr class='ipsHr'>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<a href='
CONTENT;
$return .= htmlspecialchars( $comment['comment']->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="nofollow" data-action='goToComment' class='ipsButton ipsButton_link ipsButton_verySmall ipsButton_fullWidth'>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->get( $commentLang )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_this_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 <i class='fa fa-angle-right'></i></a>
			</div>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function featuredComments( $comments, $url, $titleLang='recommended_replies', $commentLang='__defart_comment' ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller='core.front.core.recommendedComments' data-url='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsRecommendedComments 
CONTENT;

if ( !\count( $comments ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div data-role="recommendedComments">
		<h2 class='ipsType_sectionHead ipsType_large ipsType_bold ipsMargin_bottom'>
CONTENT;

$val = "{$titleLang}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
		
CONTENT;

if ( \count( $comments ) ):
$return .= <<<CONTENT

			
CONTENT;

foreach ( $comments AS $id => $comment ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->featuredComment( $comment, $id, $commentLang );
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}

	function findComment( $header, $item, $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$itemClassSafe = str_replace( '\\', '_', mb_substr( $comment::$itemClass, 4 ) );
$return .= <<<CONTENT


CONTENT;

if ( ! \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<h1 class='ipsType_pageTitle'><a href="
CONTENT;
$return .= htmlspecialchars( $item->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->$idField ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $header, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h1>
	<br />

CONTENT;

endif;
$return .= <<<CONTENT

<article id='elComment_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment 
CONTENT;

if ( \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight ):
$return .= <<<CONTENT
ipsComment_popular
CONTENT;

endif;
$return .= <<<CONTENT
 ipsComment_parent ipsClearfix ipsClear 
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div id='comment-
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' data-controller='core.front.core.comment' data-commentApp='
CONTENT;
$return .= htmlspecialchars( $comment::$application, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentType='
CONTENT;
$return .= htmlspecialchars( $item::$module, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentID="
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-quoteData='
CONTENT;

$return .= htmlspecialchars( json_encode( array('userid' => $comment->author()->member_id, 'username' => $comment->author()->name, 'timestamp' => $comment->mapped('date'), 'contentapp' => $comment::$application, 'contenttype' => $item::$module, 'contentclass' => $itemClassSafe, 'contentid' => $item->id, 'contentcommentid' => $comment->$idField) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium'>
		
CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_highlight and $comment->reactionCount() >= \IPS\Settings::i()->reputation_highlight ):
$return .= <<<CONTENT

			<strong class='ipsComment_popularFlag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'this_is_a_popular_comment', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-heart'></i></strong>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
		<div class='ipsComment_header ipsPhotoPanel ipsPhotoPanel_mini ipsPhotoPanel_notPhone'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $comment->author(), 'mini', $comment->warningRef() );
$return .= <<<CONTENT

			<div>
				<h3 class='ipsComment_author ipsType_blendLinks'>
					<strong class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $comment->author(), $comment->warningRef() );
$return .= <<<CONTENT
</strong>
				</h3>
				<p class='ipsComment_meta ipsType_light ipsType_medium'>
					<a href='
CONTENT;
$return .= htmlspecialchars( $comment->item()->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $comment->id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsType_blendLinks'>{$comment->dateLine()}</a>
					
CONTENT;

if ( $comment->editLine() ):
$return .= <<<CONTENT

						&middot; {$comment->editLine()}
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $comment->hidden() ):
$return .= <<<CONTENT

						&middot; 
CONTENT;
$return .= htmlspecialchars( $comment->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
				
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('mod_see_warn') and $comment->warning ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->commentWarned( $comment );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<div class='ipsAreaBackground_reset ipsPadding_vertical sm:ipsPadding_vertical:half ipsPadding_horizontal'>			
			<div data-role='commentContent' class='ipsType_richText ipsContained' data-controller='core.front.core.lightboxedImages'>
				
CONTENT;

if ( $comment->hidden() === 1 && $comment->author()->member_id == \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<strong class='ipsType_medium ipsType_warning'><i class='fa fa-info-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'comment_awaiting_approval', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
				
CONTENT;

endif;
$return .= <<<CONTENT

				{$comment->content()}
			</div>
			
CONTENT;

if ( $comment->hidden() !== 1 && \IPS\IPS::classUsesTrait( $comment, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

				<br>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $comment );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</article>
CONTENT;

		return $return;
}

	function follow( $app, $area, $id, $count ) {
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
' data-controller='core.front.core.followButton'>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->followButton( $app, $area, $id, $count );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function followButton( $app, $area, $id, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->following( $app, $area, $id ) ):
$return .= <<<CONTENT

		<div class="ipsFollow ipsButton ipsButton_primary ipsButton_verySmall" data-role="followButton" data-following="true">
			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" rel="nofollow" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsType_blendLinks ipsType_noUnderline" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'following_this', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<a class='ipsCommentCount' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=followers&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' rel="nofollow" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'who_follows_this', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $count );
$return .= <<<CONTENT
</a>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT
	
		<div class="ipsFollow ipsButton ipsButton_light ipsButton_verySmall" data-role="followButton" data-following="false">
			<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=follow&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" rel="nofollow" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_this_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class="ipsType_blendLinks ipsType_noUnderline" data-ipsHover data-ipsHover-cache='false' data-ipsHover-onClick>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			
CONTENT;

if ( $count > 0 ):
$return .= <<<CONTENT

				<a class='ipsCommentCount' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=followers&follow_app={$app}&follow_area={$area}&follow_id={$id}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' rel="nofollow" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'who_follows_this', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $count );
$return .= <<<CONTENT
</a>
			
CONTENT;

else:
$return .= <<<CONTENT

				<span class='ipsCommentCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $count );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' rel="nofollow" class="ipsFollow ipsPos_middle ipsButton ipsButton_light ipsButton_verySmall 
CONTENT;

if ( $count == 0 ):
$return .= <<<CONTENT
ipsButton_disabled
CONTENT;

endif;
$return .= <<<CONTENT
" data-role="followButton" data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'follow_sign_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
		<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'followers', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
		<span class='ipsCommentCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumberShort( $count );
$return .= <<<CONTENT
</span>
	</a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function footer(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->site_social_profiles AND $links = json_decode( \IPS\Settings::i()->site_social_profiles, TRUE ) AND \count( $links ) ):
$return .= <<<CONTENT

<ul id='elFooterSocialLinks' class='ipsList_inline ipsType_center ipsSpacer_top'>
	
CONTENT;

if ( \IPS\Theme::i()->settings['social_links'] == 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->siteSocialProfiles(  );
endif;
$return .= <<<CONTENT

</ul>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( ( \IPS\Settings::i()->site_online || \IPS\Member::loggedIn()->group['g_access_offline'] ) and ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canAccess() ) ):
$return .= <<<CONTENT

<ul class='ipsList_inline ipsType_center ipsSpacer_top' id="elFooterLinks">
	
CONTENT;

$languages = \IPS\Lang::getEnabledLanguages();
$return .= <<<CONTENT

	
CONTENT;

if ( \count( $languages ) > 1 ):
$return .= <<<CONTENT

		<li>
			<a href='#elNavLang_menu' id='elNavLang' data-ipsMenu data-ipsMenu-above>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'language', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<ul id='elNavLang_menu' class='ipsMenu ipsMenu_selectable ipsHide'>
			
CONTENT;

foreach ( $languages as $id => $lang  ):
$return .= <<<CONTENT

				<li class='ipsMenu_item
CONTENT;

if ( \IPS\Member::loggedIn()->language()->id == $id || ( $lang->default && \IPS\Member::loggedIn()->language === 0 ) ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<form action="
CONTENT;

$return .= str_replace( array( 'http://', 'https://' ), '//', htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=language" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "language", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE ) );
$return .= <<<CONTENT
" method="post">
					<input type="hidden" name="ref" value="
CONTENT;

$return .= htmlspecialchars( base64_encode( (string) \IPS\Request::i()->url() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					<button type='submit' name='id' value='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link ipsButton_link_secondary'>
CONTENT;

if ( $lang->get__icon() ):
$return .= <<<CONTENT
<i class='
CONTENT;
$return .= htmlspecialchars( $lang->get__icon(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i> 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $lang->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $lang->default ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'default', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
					</form>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$themes = \IPS\Theme::getThemesWithAccessPermission();
$return .= <<<CONTENT

	
CONTENT;

if ( \count( $themes ) > 1  ):
$return .= <<<CONTENT

		<li>
			<a href='#elNavTheme_menu' id='elNavTheme' data-ipsMenu data-ipsMenu-above>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'skin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
			<ul id='elNavTheme_menu' class='ipsMenu ipsMenu_selectable ipsHide'>
			
CONTENT;

foreach ( $themes as $id => $set  ):
$return .= <<<CONTENT

				<li class='ipsMenu_item
CONTENT;

if ( \IPS\Theme::i()->id == $id ):
$return .= <<<CONTENT
 ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
'>
					<form action="
CONTENT;

$return .= str_replace( array( 'http://', 'https://' ), '//', htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=theme" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "theme", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE ) );
$return .= <<<CONTENT
" method="post">
					<input type="hidden" name="ref" value="
CONTENT;

$return .= htmlspecialchars( base64_encode( (string) \IPS\Request::i()->url() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					<button type='submit' name='id' value='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_link ipsButton_link_secondary'>
CONTENT;

$val = "{$set->_title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

if ( $set->is_default ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'default', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</button>
					</form>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->privacy_type != "none" ):
$return .= <<<CONTENT

		<li><a href='
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
</a></li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->canUseContactUs() and !( \IPS\Dispatcher::i()->application->directory == 'core' and \IPS\Dispatcher::i()->module and \IPS\Dispatcher::i()->module->key == 'contact' ) ):
$return .= <<<CONTENT

		<li><a rel="nofollow" href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=contact&controller=contact", null, "contact", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Settings::i()->contact_type != 'contact_redirect'  ):
$return .= <<<CONTENT
data-ipsdialog data-ipsDialog-remoteSubmit data-ipsDialog-flashMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact_sent_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsdialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'contact', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	
CONTENT;

endif;
$return .= <<<CONTENT

</ul>	

CONTENT;

if ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canManageWidgets() ):
$return .= <<<CONTENT

	<button type='button' id='elWidgetControls' data-action='openSidebar' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'manage_blocks', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_narrow'><i class='fa fa-chevron-right'></i></button>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<p id='elCopyright'>
	<span id='elCopyright_userLine'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'copyright_line_value', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

if ( !$licenseData = \IPS\IPS::licenseKey() or !isset($licenseData['products']['copyright']) or !$licenseData['products']['copyright'] ):
$return .= <<<CONTENT
<a rel='nofollow' title='Invision Community' href='https://www.invisioncommunity.com/'>Powered by Invision Community</a>
CONTENT;

endif;
$return .= <<<CONTENT

</p>
CONTENT;

		return $return;
}

	function formattedInlineStyle( $item ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \is_array($item) ):
$return .= <<<CONTENT


CONTENT;

if ( $item['feature_color'] ):
$return .= <<<CONTENT
style="background-color: 
CONTENT;
$return .= htmlspecialchars( $item['feature_color'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
; color: 
CONTENT;
$return .= htmlspecialchars( $item['text_color'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
;"
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT


CONTENT;

$column = $item::$featureColumnName;
$return .= <<<CONTENT


CONTENT;

if ( $item->$column ):
$return .= <<<CONTENT
style="background-color: 
CONTENT;
$return .= htmlspecialchars( $item->$column, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
; color: 
CONTENT;
$return .= htmlspecialchars( $item->_featureTextColor, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
;"
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function formattedTitle( $item ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \is_array($item) ):
$return .= <<<CONTENT

<span class="ipsBadge ipsBadge_pill" 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $item );
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $item['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>

CONTENT;

else:
$return .= <<<CONTENT

<span class="ipsBadge ipsBadge_pill" 
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->formattedInlineStyle( $item );
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $item->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function genericBlock( $content, $title='', $classes=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $title ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->pageHeader( $title );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div class='
CONTENT;

if ( $classes ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	{$content}
</div>
CONTENT;

		return $return;
}

	function globalTemplate( $title,$html,$location=array() ) {
		$return = '';
		$return .= <<<CONTENT

<!DOCTYPE html>
<html lang="
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->bcp47(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" dir="
CONTENT;

if ( \IPS\Member::loggedIn()->language()->isrtl ):
$return .= <<<CONTENT
rtl
CONTENT;

else:
$return .= <<<CONTENT
ltr
CONTENT;

endif;
$return .= <<<CONTENT
">
	<head>
		<meta charset="utf-8">
		<title>
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->getTitle( $title ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
		
CONTENT;

if ( \IPS\Settings::i()->ipbseo_ga_enabled ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Settings::i()->ipseo_ga;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] != 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->favico(  );
$return .= <<<CONTENT

	</head>
	<body class='ipsApp ipsApp_front 
CONTENT;

if ( isset( \IPS\Request::i()->cookie['hasJS'] ) ):
$return .= <<<CONTENT
ipsJS_has
CONTENT;

else:
$return .= <<<CONTENT
ipsJS_none
CONTENT;

endif;
$return .= <<<CONTENT
 ipsClearfix
CONTENT;

foreach ( \IPS\Output::i()->bodyClasses as $class ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Output::i()->globalControllers ):
$return .= <<<CONTENT
data-controller='
CONTENT;

$return .= htmlspecialchars( implode( ',', \IPS\Output::i()->globalControllers ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( \IPS\Output::i()->inlineMessage ) ):
$return .= <<<CONTENT
data-message="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->inlineMessage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-pageApp='
CONTENT;
$return .= htmlspecialchars( $location['app'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-pageLocation='front' data-pageModule='
CONTENT;
$return .= htmlspecialchars( $location['module'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-pageController='
CONTENT;
$return .= htmlspecialchars( $location['controller'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( isset( \IPS\Request::i()->id ) ):
$return .= <<<CONTENT
data-pageID='
CONTENT;

$return .= htmlspecialchars( (int) \IPS\Request::i()->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( \IPS\Dispatcher::i()->dispatcherController ) AND !\IPS\Dispatcher::i()->dispatcherController->isContentPage  ):
$return .= <<<CONTENT
data-nocontent
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Output::i()->pageName ):
$return .= <<<CONTENT
data-pageName="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->pageName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
		<a href='#ipsLayout_mainArea' class='ipsHide' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'jump_to_content_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' accesskey='m'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'jump_to_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		
CONTENT;

if ( !\IPS\Request::i()->isApp() ):
$return .= <<<CONTENT

			<div id='ipsLayout_header' class='ipsClearfix'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->updateWarning(  );
$return .= <<<CONTENT

				<header>
					<div class='ipsLayout_container'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->logo(  );
$return .= <<<CONTENT

						
CONTENT;

if ( !\in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userBar(  );
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigationIcon(  );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</header>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->navBar(  );
$return .= <<<CONTENT

				
CONTENT;

if ( !\in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavBar(  );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<main id='ipsLayout_body' class='ipsLayout_container'>
			<div id='ipsLayout_contentArea'>
				<div id='ipsLayout_contentWrapper'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->breadcrumb( 'top' );
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['sidebar_position'] == 'left' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sidebar( 'left' );
endif;
$return .= <<<CONTENT

					<div id='ipsLayout_mainArea'>
						<a id='elContent'></a>
						
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_global_header' );
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_global_header_2' );
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Member::loggedIn()->members_bitoptions['unacknowledged_warnings'] ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->acknowledgeWarning( \IPS\Member::loggedIn()->warnings( 1, FALSE ) );
endif;
$return .= <<<CONTENT

						
CONTENT;

if ( !\in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) and !\IPS\Member::loggedIn()->members_bitoptions['profile_completion_dismissed'] and $nextStep = \IPS\Member::loggedIn()->nextProfileStep() ):
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->profileNextStep( $nextStep, true );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->widgetContainer( 'header', 'horizontal' );
$return .= <<<CONTENT

						{$html}
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->widgetContainer( 'footer', 'horizontal' );
$return .= <<<CONTENT

					</div>
					
CONTENT;

if ( \IPS\Theme::i()->settings['sidebar_position'] == 'right' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sidebar( 'right' );
endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->breadcrumb( 'bottom' );
$return .= <<<CONTENT

				</div>
			</div>
			
CONTENT;

if ( \IPS\Member::loggedIn()->msg_show_notification and $message = \IPS\core\Messenger\Conversation::latestUnreadMessage() ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->inlineMessage( $message );
endif;
$return .= <<<CONTENT

		</main>
		
CONTENT;

if ( !\IPS\Request::i()->isApp() ):
$return .= <<<CONTENT

			<footer id='ipsLayout_footer' class='ipsClearfix'>
				<div class='ipsLayout_container'>
					
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_global_footer' );
$return .= <<<CONTENT


CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_global_footer_2' );
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_global_footer_3' );
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->footer(  );
$return .= <<<CONTENT

				</div>
			</footer>
			
CONTENT;

if ( \IPS\Theme::i()->settings['responsive'] ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigation(  );
endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id and \IPS\Settings::i()->guest_terms_bar ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->guestTermsBar( base64_encode( \IPS\Settings::i()->base_url ) );
endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Theme::i()->settings['js_include'] == 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Settings::i()->viglink_enabled ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->viglink(  );
endif;
$return .= <<<CONTENT

			
CONTENT;

if ( isset( $_SESSION['live_meta_tags'] ) and $_SESSION['live_meta_tags'] and \IPS\Member::loggedIn()->isAdmin() ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->metaTagEditor(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		<!--ipsQueryLog-->
		<!--ipsCachingLog-->
		
CONTENT;

$return .= \IPS\Output::i()->endBodyCode;
$return .= <<<CONTENT

		
CONTENT;

if ( !\IPS\Request::i()->isApp() ):
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Settings::i()->fb_pixel_enabled and \IPS\Settings::i()->fb_pixel_id and $noscript = \IPS\core\Facebook\Pixel::i()->noscript() ):
$return .= <<<CONTENT

				<noscript>
				{$noscript}
				</noscript>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

      
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'MCABI' );
$return .= <<<CONTENT

	</body>
</html>
CONTENT;

		return $return;
}

	function groupPostedBadges( $groups, $lang = '', $extraClasses = '' ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $groups as $group ):
$return .= <<<CONTENT

	
CONTENT;

$groupNames[] = $group->name;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

$list = \IPS\Member::loggedIn()->language()->formatList( $groupNames );
$return .= <<<CONTENT


<ul class='ipsList_reset ipsFlex-inline ipsFlex-ai:center 
CONTENT;
$return .= htmlspecialchars( $extraClasses, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $lang ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$val = "{$lang}"; $htmlsprintf = array($list); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

foreach ( $groups as $group ):
$return .= <<<CONTENT

		
CONTENT;

if ( $group->g_icon  ):
$return .= <<<CONTENT

			<li><img src='
CONTENT;

$return .= \IPS\File::get( "core_Theme", $group->g_icon )->url;
$return .= <<<CONTENT
' alt='' class='cGroupIndicator'></li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li><span class='ipsBadge ipsBadge_neutral ipsBadge_small'>
CONTENT;
$return .= htmlspecialchars( $group->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</ul>
CONTENT;

		return $return;
}

	function guestCommentTeaser( $item, $isReview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<div>
	<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

if ( \IPS\Login::registrationType() != 'disabled' ):
$return .= <<<CONTENT

		<div class='ipsType_center ipsPad cGuestTeaser'>
			
CONTENT;

if ( $isReview ):
$return .= <<<CONTENT

				<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_review_title_reg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<p class='ipsType_light ipsType_normal ipsType_reset ipsSpacer_top ipsSpacer_half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_review_desc_reg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

else:
$return .= <<<CONTENT

				<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_title_reg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<p class='ipsType_light ipsType_normal ipsType_reset ipsSpacer_top ipsSpacer_half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_desc_reg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

	
			<div class='ipsBox ipsPad ipsSpacer_top'>
				<div class='ipsGrid ipsGrid_collapsePhone'>
					<div class='ipsGrid_span6 cGuestTeaser_left'>
						<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_account', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
						<p class='ipsType_normal ipsType_reset ipsType_light ipsSpacer_bottom'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_account_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
						
CONTENT;

if ( \IPS\Login::registrationType() == 'redirect' ):
$return .= <<<CONTENT

							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_reg_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small' target="_blank" rel="noopener">
						
CONTENT;

else:
$return .= <<<CONTENT

							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small' 
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_account_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</div>
					<div class='ipsGrid_span6 cGuestTeaser_right'>
						<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
						<p class='ipsType_normal ipsType_reset ipsType_light ipsSpacer_bottom'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 )->addRef((string) $item->url() . '#replyForm'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-remoteVerify="false" data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</div>
				</div>
			</div>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsType_center ipsPad'>
			<h2 class='ipsType_pageTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_title_noreg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
			<p class='ipsType_light ipsType_normal ipsType_reset ipsSpacer_top ipsSpacer_half'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_desc_noreg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			<br>
			<br>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 )->addRef((string) $item->url() . '#replyForm'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-remoteVerify="false" data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class='ipsButton ipsButton_alternate ipsButton_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'teaser_signin_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function guestTermsBar( $currentUrl ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$termsLang = \IPS\Member::loggedIn()->language()->addToStack( 'terms_of_use' );
$return .= <<<CONTENT


CONTENT;

$privacyLang = \IPS\Member::loggedIn()->language()->addToStack( 'terms_privacy' );
$return .= <<<CONTENT


CONTENT;

$glLang = \IPS\Member::loggedIn()->language()->addToStack( 'guidelines' );
$return .= <<<CONTENT


CONTENT;

$termsUrl = (string) \IPS\Http\Url::internal( 'app=core&module=system&controller=terms', 'front', 'terms' );
$return .= <<<CONTENT


CONTENT;

$terms = "<a href='$termsUrl'>$termsLang</a>";
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Settings::i()->privacy_type == 'internal' ):
$return .= <<<CONTENT

	
CONTENT;

$privacyUrl = (string) \IPS\Http\Url::internal( 'app=core&module=system&controller=privacy', 'front', 'privacy' );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$privacyUrl = \IPS\Settings::i()->privacy_link;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$privacy = "<a href='$privacyUrl'>$privacyLang</a>";
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Settings::i()->gl_type == 'internal' ):
$return .= <<<CONTENT

	
CONTENT;

$glUrl = (string) \IPS\Http\Url::internal( 'app=core&module=system&controller=guidelines', 'front', 'guidelines' );
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$glUrl = \IPS\Settings::i()->gl_link;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$guidelines = "<a href='$glUrl'>$glLang</a>";
$return .= <<<CONTENT


CONTENT;

$cookiesUrl = (string) \IPS\Http\Url::internal( 'app=core&module=system&controller=cookies', 'front', 'cookies' );
$return .= <<<CONTENT


CONTENT;

$cookies = \IPS\Member::loggedIn()->language()->addToStack( 'cookies_message', NULL, array( 'sprintf' => array( $cookiesUrl, $cookiesUrl ) ) );
$return .= <<<CONTENT


<div id='elGuestTerms' class='ipsPad_half ipsJS_hide' data-role='guestTermsBar' data-controller='core.front.core.guestTerms'>
	<div class='ipsLayout_container'>
		<div class='ipsGrid ipsGrid_collapsePhone'>
			<div class='ipsGrid_span10'>
				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_terms_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<p class='ipsType_reset ipsType_medium cGuestTerms_contents'>
CONTENT;

$htmlsprintf = array($terms, $privacy, $guidelines, $cookies); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_terms_bar_text_value', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</p>
			</div>
			<div class='ipsGrid_span2'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=terms&do=dismiss&ref={$currentUrl}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' rel='nofollow' class='ipsButton ipsButton_veryLight ipsButton_large ipsButton_fullWidth' data-action='dismissTerms'><i class='fa fa-check'></i>&nbsp; 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'guest_terms_close', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function inlineMessage( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elInlineMessage' class='ipsPad' title='
CONTENT;

$sprintf = array($message->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_title', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
	<div class='ipsPhotoPanel ipsPhotoPanel_medium'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $message->author(), 'medium' );
$return .= <<<CONTENT

		<div class='ipsType_normal'>
			<strong>
CONTENT;
$return .= htmlspecialchars( $message->item()->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong><br>
			<span class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = ( $message->date instanceof \IPS\DateTime ) ? $message->date : \IPS\DateTime::ts( $message->date );$return .= $val->html();
$return .= <<<CONTENT
</span>
			<br>
			<div data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="3 lines">
				{$message->post}
			</div>
			<hr class='ipsHr'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $message->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

if ( \IPS\Member::loggedIn()->msg_count_new > 1 ):
$return .= <<<CONTENT
 <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_small'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_inline_view_all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $message->canReportOrRevoke() === TRUE ):
$return .= <<<CONTENT
 &nbsp;&nbsp; <a href='
CONTENT;
$return .= htmlspecialchars( $message->url('report'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><span class='ipsResponsive_showPhone ipsResponsive_inline'><i class='fa fa-flag'></i></span><span class='ipsResponsive_hidePhone ipsResponsive_inline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_reply', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span></a>
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function itemIcon( $iconInfo ) {
		$return = '';
		$return .= <<<CONTENT


<span class='ipsItemStatus 
CONTENT;

if ( $iconInfo['size'] ):
$return .= <<<CONTENT
ipsItemStatus_
CONTENT;
$return .= htmlspecialchars( $iconInfo['size'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'><i class='
CONTENT;

if ( $iconInfo['type'] == 'unread' ):
$return .= <<<CONTENT
fa fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
'></i></span>
CONTENT;

		return $return;
}

	function loginPopup( $login ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elUserSignIn_menu' class='ipsMenu ipsMenu_auto ipsHide'>
	<form accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $login->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<input type="hidden" name="ref" value="
CONTENT;

$return .= htmlspecialchars( base64_encode( \IPS\Request::i()->url() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<div data-role="loginForm">
			
CONTENT;

$usernamePasswordMethods = $login->usernamePasswordMethods();
$return .= <<<CONTENT

			
CONTENT;

$buttonMethods = $login->buttonMethods();
$return .= <<<CONTENT

			
CONTENT;

if ( $usernamePasswordMethods and $buttonMethods ):
$return .= <<<CONTENT

				<div class='ipsColumns ipsColumns_noSpacing'>
					<div class='ipsColumn ipsColumn_wide' id='elUserSignIn_internal'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->loginPopupForm( $login );
$return .= <<<CONTENT

					</div>
					<div class='ipsColumn ipsColumn_wide'>
						<div class='ipsPadding' id='elUserSignIn_external'>
							<div class='ipsAreaBackground_light ipsPadding:half'>
								
CONTENT;

if ( \count( $buttonMethods ) > 1 ):
$return .= <<<CONTENT

									<p class='ipsType_reset ipsType_small ipsType_center'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_with_these', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></p>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

foreach ( $buttonMethods as $method ):
$return .= <<<CONTENT

									<div class='ipsType_center ipsMargin_top:half'>
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

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->loginPopupForm( $login );
$return .= <<<CONTENT

			
CONTENT;

elseif ( $buttonMethods ):
$return .= <<<CONTENT

				<div class="cLogin_popupSingle">
					
CONTENT;

foreach ( $buttonMethods as $method ):
$return .= <<<CONTENT

						<div class='ipsPadding:half ipsType_center'>
							{$method->button()}
						</div>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</form>
</div>
CONTENT;

		return $return;
}

	function loginPopupForm( $login ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad ipsForm ipsForm_vertical">
	<h4 class="ipsType_sectionHead">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'login', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
	<br><br>
	<ul class='ipsList_reset'>
		<li class="ipsFieldRow ipsFieldRow_noLabel ipsFieldRow_fullWidth">
			
CONTENT;

$authType = $login->authType();
$return .= <<<CONTENT

			
CONTENT;

if ( $authType === \IPS\Login::AUTH_TYPE_USERNAME ):
$return .= <<<CONTENT

				<input type="text" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" autocomplete="username">
			
CONTENT;

elseif ( $authType === \IPS\Login::AUTH_TYPE_EMAIL ):
$return .= <<<CONTENT

				<input type="email" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'email_address', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" autocomplete="email">
			
CONTENT;

else:
$return .= <<<CONTENT

				<input type="text" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'username_or_email', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="auth" autocomplete="email">
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		<li class="ipsFieldRow ipsFieldRow_noLabel ipsFieldRow_fullWidth">
			<input type="password" placeholder="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" name="password" autocomplete="current-password">
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
' 
CONTENT;

if ( \IPS\Helpers\Form\Captcha::supportsModal() ):
$return .= <<<CONTENT
data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'forgotten_password', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</p>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
	</ul>
</div>
CONTENT;

		return $return;
}

	function logo(   ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( \IPS\Theme::i()->logo['front']['url'] ) AND \IPS\Theme::i()->logo['front']['url'] !== null  ):
$return .= <<<CONTENT


CONTENT;

$logo = \IPS\File::get( 'core_Theme', \IPS\Theme::i()->logo['front']['url'] )->url;
$return .= <<<CONTENT

<a href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' id='elLogo' accesskey='1'><img src="
CONTENT;
$return .= htmlspecialchars( $logo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" alt='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->board_name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'></a>

CONTENT;

else:
$return .= <<<CONTENT

<a href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' id='elSiteTitle' accesskey='1'>
CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT
</a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function metaTagEditor(  ) {
		$return = '';
		$return .= <<<CONTENT


<div id='elMetaTagEditor' class='ipsToolbox ipsPad ipsScrollbar' data-controller="core.front.system.metaTagEditor" data-defaultPageTitle='
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->defaultPageTitle, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<h3 class='ipsToolbox_title ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'live_meta_tag_editor', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<form accept-charset='utf-8' method='post' action="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=metatags&do=save", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsForm>
		<input type='hidden' name='meta_url' value='
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->metaTagsUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<input type="hidden" name="csrfKey" value="
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

		
CONTENT;

foreach ( \IPS\Output::i()->autoMetaTags as $name => $content ):
$return .= <<<CONTENT

			<input type='hidden' name='defaultMetaTag[
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]' value='
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

endforeach;
$return .= <<<CONTENT


		<h4 class='ipsToolbox_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_page_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
		<input name='meta_tag_title' type='text' value="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->metaTagsTitle, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<br><br>

		<h4 class='ipsToolbox_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tags_custom_header', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>

		<ul class='ipsList_reset ipsSpacer_bottom' id='elMetaTagEditor_customTags'>
			<li class='ipsType_center ipsType_normal ipsType_light 
CONTENT;

if ( \count( \IPS\Output::i()->customMetaTags ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='noCustomMetaTagsMessage'><em>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tags_none_custom', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></li>

			
CONTENT;

if ( \count( \IPS\Output::i()->customMetaTags ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( \IPS\Output::i()->customMetaTags as $name => $content ):
$return .= <<<CONTENT

					
CONTENT;

if ( $content !== NULL ):
$return .= <<<CONTENT

						<li data-role='metaTagRow'>
							<ul class='ipsForm ipsForm_vertical'>
								<li class='ipsFieldRow'>
									<div class='ipsFlex ipsGap:2'>
										<select name='meta_tag_name[]' data-role='metaTagChooser' class="ipsFlex-flex:11">
											<option value='keywords' 
CONTENT;

if ( $name == 'keywords' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_keywords', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
											<option value='description' 
CONTENT;

if ( $name == 'description' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_description', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
											<option value='robots' 
CONTENT;

if ( $name == 'robots' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_robots', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
											<option value='other' 
CONTENT;

if ( !\in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_other', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
										</select>
										<button type="button" class="ipsFlex-flex:00 ipsButton ipsButton_verySmall ipsButton_negative"  data-action='deleteMeta' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-trash'></i></button>
									</div>
								</li>
								<li class='ipsFieldRow ipsFieldRow_fullWidth
CONTENT;

if ( \in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT
 ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='metaTagName'>
									<input name='meta_tag_name_other[]' type='text' value="
CONTENT;

if ( !\in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
								</li>
								<li class='ipsFieldRow ipsFieldRow_fullWidth'>
									<input name='meta_tag_content[]' type='text' value="
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
								</li>
							</ul>
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

		</ul>

		<a href='#' class='ipsJS_show ipsButton ipsButton_normal ipsButton_fullWidth ipsButton_verySmall ipsSpacer_bottom' data-action='addMeta'><i class='fa fa-plus'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_another_meta_tag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>

		<h4 class='ipsToolbox_sectionTitle'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tags_default_header', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
		<ul class='ipsList_reset' id='elMetaTagEditor_defaultTags'>
			
CONTENT;

if ( \count( \IPS\Output::i()->metaTags ) !== \count( \IPS\Output::i()->customMetaTags ) ):
$return .= <<<CONTENT

				<li class='ipsAreaBackground ipsAreaBackground_dark ipsPad'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tags_automatic_notice', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</li>
				
CONTENT;

if ( \count( \IPS\Output::i()->customMetaTags ) ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( \IPS\Output::i()->customMetaTags as $name => $content ):
$return .= <<<CONTENT

						
CONTENT;

if ( $content === NULL ):
$return .= <<<CONTENT

							<li data-role='metaTagRow'>
								<ul class='ipsForm ipsForm_vertical'>
									<li class='ipsFieldRow'>
										<div class='ipsFlex ipsGap:2'>
											<div class='ipsFlex-flex:11 ipsType_light'>
												
CONTENT;

$sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tag_deleted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

											</div>
											<button type="button" class="ipsFlex-flex:00 ipsButton ipsButton_verySmall ipsButton_light"  data-action='restoreMeta' data-tag='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tag_restore', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-undo'></i></button>
										</div>
									</li>
								</ul>
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

foreach ( \IPS\Output::i()->metaTags as $name => $content ):
$return .= <<<CONTENT

					
CONTENT;

if ( !\array_key_exists( $name, \IPS\Output::i()->customMetaTags ) AND $name != 'title' ):
$return .= <<<CONTENT

						<li data-role='metaTagRow'>
							<ul class='ipsForm ipsForm_vertical'>
								<li class='ipsFieldRow'>
									<div class='ipsFlex ipsGap:2'>
										<select name='meta_tag_name[]' data-role='metaTagChooser' class="ipsFlex-flex:11">
											<option value='keywords' 
CONTENT;

if ( $name == 'keywords' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_keywords', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
											<option value='description' 
CONTENT;

if ( $name == 'description' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_description', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
											<option value='robots' 
CONTENT;

if ( $name == 'robots' ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_robots', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
											<option value='other' 
CONTENT;

if ( !\in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_other', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
										</select>
										<button type="button" class="ipsFlex-flex:00 ipsButton ipsButton_verySmall ipsButton_negative" data-action='deleteDefaultMeta' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-trash'></i></button>
									</div>
								</li>
								<li class='ipsFieldRow ipsFieldRow_fullWidth
CONTENT;

if ( \in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT
 ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='metaTagName'>
									<input name='meta_tag_name_other[]' type='text' value="
CONTENT;

if ( !\in_array( $name, array( 'keywords', 'description', 'robots' ) ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
								</li>
								<li class='ipsFieldRow ipsFieldRow_fullWidth'>
									<input name='meta_tag_content[]' type='text' value="
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
								</li>
							</ul>
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

		</ul>

		<div class='ipsFlex ipsFlex-ai:center ipsFlex-jc:center' id='elMetaTagEditor_submit'>
			<div class="ipsFlex ipsFlex-ai:center ipsFlex-jc:center ipsGap:2">
				<button class='ipsButton ipsButton_important' role='button' type='submit'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=metatags&do=end" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'end_metatags', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		</div>
	</form>
	<ul class='ipsHide'>
		<li class='ipsHide' data-role='metaTemplate'>
			<ul class='ipsForm ipsForm_vertical'>
				<li class='ipsFieldRow ipsGrid'>
					<select name='meta_tag_name[]' class="ipsGrid_span10" data-role='metaTagChooser'>
						<option value='keywords'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_keywords', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value='description'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_description', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value='robots'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_robots', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
						<option value='other'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_other', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
					</select>
					<button type="button" class="ipsGrid_span2 ipsPos_right ipsButton ipsButton_verySmall ipsButton_negative" data-action='deleteMeta' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-trash'></i></button>
				</li>
				<li class='ipsFieldRow ipsFieldRow_fullWidth ipsHide' data-role='metaTagName'>
					<input name='meta_tag_name_other[]' type='text' value="" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_name', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				</li>
				<li class='ipsFieldRow ipsFieldRow_fullWidth'>
					<input name='meta_tag_content[]' type='text' value="" placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'metatags_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				</li>
			</ul>
		</li>
		<li class='ipsHide' data-role='metaDefaultDeletedTemplate'>
			<ul class='ipsForm ipsForm_vertical'>
				<li class='ipsFieldRow ipsGrid'>
					<div class='ipsGrid_span10 ipsType_light' data-role='metaDeleteMessage'>
						
					</div>
					<button type="button" class="ipsGrid_span2 ipsPos_right ipsButton ipsButton_verySmall ipsButton_light"  data-action='restoreMeta' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'meta_tag_restore', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-undo'></i></button>
				</li>
			</ul>
		</li>
	</ul>
</div>
CONTENT;

		return $return;
}

	function mobileNavBar(   ) {
		$return = '';
		$return .= <<<CONTENT

<ul id='elMobileNav' class='ipsResponsive_hideDesktop' data-controller='core.front.core.mobileNav'>
	
CONTENT;

if ( \count( \IPS\Output::i()->breadcrumb ) ):
$return .= <<<CONTENT

		
CONTENT;

if ( \count( \IPS\Output::i()->breadcrumb ) == 1 ):
$return .= <<<CONTENT

			<li id='elMobileBreadcrumb'>
				<a href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
'>
					<span>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</a>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

$i = 0;
$return .= <<<CONTENT

			
CONTENT;

foreach ( \IPS\Output::i()->breadcrumb as $k => $b ):
$return .= <<<CONTENT

				
CONTENT;

if ( $i + 2 == \count( \IPS\Output::i()->breadcrumb ) ):
$return .= <<<CONTENT

					<li id='elMobileBreadcrumb'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $b[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
							<span>
CONTENT;
$return .= htmlspecialchars( $b[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
						</a>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$i++;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
	
CONTENT;

$defaultStream = \IPS\core\Stream::defaultStream();
$return .= <<<CONTENT

	<li 
CONTENT;

if ( !\IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'discover' ) )  ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
>
		<a data-action="defaultStream" href='
CONTENT;

if ( $defaultStream ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $defaultStream->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=discover&controller=streams", null, "discover_all", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
	</li>

	
CONTENT;

if ( !\IPS\Member::loggedIn()->restrict_post and \count( \IPS\Member::loggedIn()->createMenu() ) ):
$return .= <<<CONTENT

	<li data-ipsDrawer data-ipsDrawer-drawerElem='#elMobileCreateMenuDrawer'>
		<a href='#'><i class='fa fa-plus'></i></a>
	</li>
	
CONTENT;

endif;
$return .= <<<CONTENT


	
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'search' ) ) ):
$return .= <<<CONTENT

		<li class='ipsJS_show'>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=search&controller=search", null, "search", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'><i class='fa fa-search'></i></a>
		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<li data-ipsDrawer data-ipsDrawer-drawerElem='#elMobileDrawer'>
		<a href='#' title="navigation">
			
CONTENT;

$total = \IPS\Member::loggedIn()->notification_cnt;
$return .= <<<CONTENT

			
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

				
CONTENT;

$total += \IPS\Member::loggedIn()->msg_count_new;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) and \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

				
CONTENT;

$total += \IPS\Member::loggedIn()->reportCount();
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $total ):
$return .= <<<CONTENT

				<span class='ipsNotificationCount' data-notificationType='total'>
CONTENT;
$return .= htmlspecialchars( $total, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<i class='fa fa-navicon'></i>
		</a>
	</li>
</ul>
CONTENT;

		return $return;
}

	function mobileNavigation(   ) {
		$return = '';
		$return .= <<<CONTENT

<div id='elMobileDrawer' class='ipsDrawer ipsHide'>
	<div class='ipsDrawer_menu'>
		<a href='#' class='ipsDrawer_close' data-action='close'><span>&times;</span></a>
		<div class='ipsDrawer_content ipsFlex ipsFlex-fd:column'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

				<div class='elMobileDrawer__user ipsBorder_bottom ipsAreaBackground_reset ipsPadding_horizontal ipsPadding_vertical:half ipsPos_sticky ipsFlex ipsFlex-jc:between ipsFlex-ai:center ipsFlex-fw:wrap'>
					<div class='ipsFlex-flex:11'>
						<ul class='elMobileDrawer__user-panel ipsList_reset ipsType_blendLinks ipsFlex ipsFlex-ai:center'>
							<li class='ipsMargin_right:half'>
								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'mini' );
$return .= <<<CONTENT

							</li>
							<li>
								<div class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'logged_in_as_headline', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
								<div class='ipsType_dark ipsType_large ipsType_bold'>
CONTENT;

if ( isset( $_SESSION['logged_in_as_key'] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($_SESSION['logged_in_from']['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'front_logged_in_as', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT
<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_my_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</div>
							</li>
						</ul>
					</div>
					<ul id='elUserNav_mobile' class='ipsList_inline signed_in ipsClearfix'>
						<li class='cNotifications cUserNav_icon'>
							<a href='#elMobNotifications_menu' id='elMobNotifications' data-ipsMenu data-ipsMenu-menuID='elFullNotifications_menu' data-ipsMenu-closeOnClick='false'>
								<i class='fa fa-bell'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->notification_cnt ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='notify'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->notification_cnt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							</a>
						</li>
						
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

							<li class='cInbox cUserNav_icon'>
								<a href='#elMobInbox_menu' id='elMobInbox' data-ipsMenu data-ipsMenu-menuID='elFullInbox_menu' data-ipsMenu-closeOnClick='false'>
									<i class='fa fa-envelope'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->msg_count_new ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='inbox'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->msg_count_new, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) and \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

							<li class='cReports cUserNav_icon'>
								<a href='#elMobReports_menu' id='elMobReports' data-ipsMenu data-ipsMenu-menuID='elFullReports_menu' data-ipsMenu-closeOnClick='false'>
									<i class='fa fa-warning'></i> 
CONTENT;

if ( \IPS\Member::loggedIn()->reportCount() ):
$return .= <<<CONTENT
<span class='ipsNotificationCount' data-notificationType='reports'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->reportCount(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

								</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsPadding ipsBorder_bottom'>
					<ul class='ipsToolList ipsToolList_vertical'>
						<li>
							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='elSigninButton_mobile' class='ipsButton ipsButton_light ipsButton_small ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

if ( \IPS\Login::registrationType() != 'disabled' ):
$return .= <<<CONTENT

							<li>
								
CONTENT;

if ( \IPS\Login::registrationType() == 'redirect' ):
$return .= <<<CONTENT

									<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_reg_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener" class='ipsButton ipsButton_small ipsButton_fullWidth ipsButton_important'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
								
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
' data-ipsDialog-fixed='true'
CONTENT;

endif;
$return .= <<<CONTENT
 id='elRegisterButton_mobile' class='ipsButton ipsButton_small ipsButton_fullWidth ipsButton_important'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT


			<ul class='ipsDrawer_list ipsFlex-flex:11'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<li class='ipsDrawer_itemParent'>
						<h4 class='ipsDrawer_title'><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_account', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></h4>
						<ul class='ipsDrawer_list'>
							<li data-action="back"><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_back', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT

								<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_my_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) and \IPS\Member::loggedIn()->members_disable_pm AND \IPS\Member::loggedIn()->members_disable_pm != 2 ):
$return .= <<<CONTENT

								<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=enableMessenger" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_messenger', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm data-confirmMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_disabled_msg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_messages', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] != 0 ):
$return .= <<<CONTENT

								<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=attachments", null, "attachments", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

                            
CONTENT;

if ( \IPS\Member::loggedIn()->hasAcpRestriction( 'core', 'promotion', 'promote_manage' ) and \IPS\core\Promote::promoteServices() ):
$return .= <<<CONTENT

                            <li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=promote&controller=promote&do=view", null, "promote_manage", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_manage_link', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                            
CONTENT;

endif;
$return .= <<<CONTENT

                            
CONTENT;

if ( \IPS\Application::appIsEnabled('nexus') and \IPS\Settings::i()->nexus_subs_enabled ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=nexus&module=subscriptions&controller=subscriptions", null, "nexus_subscriptions", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'nexus_manage_subscriptions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

							<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=followed", null, "followed_content", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_followed_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li id='elAccountSettingsLinkMobile'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings", null, "settings", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_account_settings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_settings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

if ( \IPS\Settings::i()->ignore_system_on ):
$return .= <<<CONTENT

			                	<li><a href='
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

							
CONTENT;

if ( ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ) or ( \IPS\Member::loggedIn()->isAdmin() AND \IPS\SHOW_ACP_LINK ) ):
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ):
$return .= <<<CONTENT

									<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp", null, "modcp", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_modcp', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( \IPS\Member::loggedIn()->isAdmin() AND \IPS\SHOW_ACP_LINK  ):
$return .= <<<CONTENT

									<li><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::baseURL() . \IPS\CP_DIRECTORY, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' rel="noopener">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_admincp', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-lock'></i></a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						</ul>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT


				
CONTENT;

$primaryBars = \IPS\core\FrontNavigation::i()->roots();
$return .= <<<CONTENT

				
CONTENT;

$subBars = \IPS\core\FrontNavigation::i()->subBars();
$return .= <<<CONTENT

				
				
CONTENT;

foreach ( $primaryBars as $id => $item ):
$return .= <<<CONTENT

					
CONTENT;

if ( $item->canView() ):
$return .= <<<CONTENT

						
CONTENT;

$children = $item->children();
$return .= <<<CONTENT

						
CONTENT;

if ( ( $subBars && isset( $subBars[ $id ] ) && \count( $subBars[ $id ] ) ) || $children ):
$return .= <<<CONTENT

							<li class='ipsDrawer_itemParent'>
								<h4 class='ipsDrawer_title'><a href='#'>
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
								<ul class='ipsDrawer_list'>
									<li data-action="back"><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_back', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

$showSelfLink = true;
$return .= <<<CONTENT

									
CONTENT;

if ( $subBars && isset( $subBars[ $id ] ) && \count( $subBars[ $id ] ) ):
$return .= <<<CONTENT

										
CONTENT;

// Determine whether we should show the parent link as a clickable sub item by comparing child links.
$return .= <<<CONTENT

										
CONTENT;

// If the *same* link exists as a child item, don't show it twice
$return .= <<<CONTENT

										
CONTENT;

foreach ( $subBars[ $id ] as $child ):
$return .= <<<CONTENT

											
CONTENT;

if ( $child->canView() ):
$return .= <<<CONTENT

												
CONTENT;

if ( $subChildren = $child->children() ):
$return .= <<<CONTENT

													
CONTENT;

foreach ( $subChildren as $subChild ):
$return .= <<<CONTENT

														
CONTENT;

if ( method_exists( $subChild, 'link' ) && $subChild->link() && (string) $subChild->link() == (string) $item->link() ):
$return .= <<<CONTENT

															
CONTENT;

$showSelfLink = false;
$return .= <<<CONTENT

															
CONTENT;

break 2;
$return .= <<<CONTENT

														
CONTENT;

endif;
$return .= <<<CONTENT

													
CONTENT;

endforeach;
$return .= <<<CONTENT

												
CONTENT;

elseif ( method_exists( $child, 'link' ) && $child->link() && (string) $child->link() == (string) $item->link() ):
$return .= <<<CONTENT

													
CONTENT;

$showSelfLink = false;
$return .= <<<CONTENT

													
CONTENT;

break;
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

if ( $showSelfLink && method_exists( $item, 'link' ) and (string) $item->link() !== \IPS\Settings::i()->base_url ):
$return .= <<<CONTENT

										<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $children ):
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigationChildren( $children );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $subBars && isset( $subBars[ $id ] ) && \count( $subBars[ $id ] ) ):
$return .= <<<CONTENT

										
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigationChildren( $subBars[ $id ] );
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT
	
								</ul>
							</li>
						
CONTENT;

else:
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( method_exists( $item, 'target' ) AND $item->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $item->target(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $item->target() == '_blank' ):
$return .= <<<CONTENT
 rel="noopener"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
						
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

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

					<li>
						<a data-action="markSiteRead" data-controller="core.front.core.markRead" href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=markread" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "mark_site_as_read", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mark_site_read_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
					<li>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
							
CONTENT;

if ( isset( $_SESSION['logged_in_as_key'] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($_SESSION['logged_in_from']['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'switch_to_account', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</ul>

			
CONTENT;

if ( \IPS\Member::loggedIn()->canHaveAchievements() and \IPS\core\Achievements\Rank::show() and \IPS\Member::loggedIn()->member_id && \IPS\core\Achievements\Rank::getStore() and $rank = \IPS\Member::loggedIn()->rank() ):
$return .= <<<CONTENT

				<div class='elMobileDrawer__rank ipsAreaBackground_reset ipsPos_sticky ipsPadding_horizontal ipsPadding_vertical:half ipsBorder_top'>
					<div class='elUserNav_achievements ipsFlex ipsGap:4 ipsGap_row:0'>
						<div class='elUserNav_achievements__icon'>{$rank->html('ipsDimension:3')}</div>
						<div class='elUserNav_achievements__content'>
							<div class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_current_rank', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
							<div><strong class='ipsType_large'>
CONTENT;
$return .= htmlspecialchars( $rank->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
							
							
CONTENT;

if ( $nextRank = \IPS\Member::loggedIn()->nextRank() ):
$return .= <<<CONTENT

								<div class='ipsMargin_top:half'>
									<div>
										<div class='ipsAchievementsProgress'>
											<div style='width: calc(
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->achievements_points, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 / 
CONTENT;
$return .= htmlspecialchars( $nextRank->points, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 * 100%)'></div>
										</div>
									</div>
									<div class='ipsType_small ipsType_light'>
CONTENT;

$pluralize = array( $nextRank->points - \IPS\Member::loggedIn()->achievements_points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_next_rank', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>
								</div>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
				</div>
			
CONTENT;

elseif ( \IPS\Member::loggedIn()->canHaveAchievements() and \IPS\Settings::i()->achievements_rebuilding ):
$return .= <<<CONTENT

				<div class='elMobileDrawer__rank ipsAreaBackground_reset ipsPos_sticky ipsPadding_horizontal ipsPadding_vertical:half ipsBorder_top'>
					<div class='elUserNav_achievements ipsFlex ipsGap:4 ipsGap_row:0 ipsType_light'>
						<div class='elUserNav_achievements__icon ipsFlex-flex:00'><i class="fa fa-info-circle fa-fw ipsType_large"></i></div>
						<div class='elUserNav_achievements__content ipsFlex-flex:11'>
							<p class='ipsType_reset ipsType_light'>
								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ranks_are_being_recalculated', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</p>
						</div>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>
</div>

<div id='elMobileCreateMenuDrawer' class='ipsDrawer ipsHide'>
	<div class='ipsDrawer_menu'>
		<a href='#' class='ipsDrawer_close' data-action='close'><span>&times;</span></a>
		<div class='ipsDrawer_content ipsSpacer_bottom ipsPad'>
			<ul class='ipsDrawer_list'>
				<li class="ipsDrawer_listTitle ipsType_reset">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
...</li>
				
CONTENT;

foreach ( \IPS\Member::loggedIn()->createMenu() as $k => $url ):
$return .= <<<CONTENT

					<li>
						<a href="
CONTENT;
$return .= htmlspecialchars( $url['link'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
							
CONTENT;

if ( isset( $url['extraData'] ) ):
$return .= <<<CONTENT

								
CONTENT;

foreach ( $url['extraData'] as $data => $v ):
$return .= <<<CONTENT

									
CONTENT;
$return .= htmlspecialchars( $data, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset($url['title']) AND $url['title'] ):
$return .= <<<CONTENT
 data-ipsDialog-title='
CONTENT;

$val = "{$url['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( isset($url['flashMessage']) ):
$return .= <<<CONTENT
 data-ipsdialog-flashmessage="
CONTENT;

$val = "{$url['flashMessage']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsdialog-fixed="true"
							>
CONTENT;

$val = "{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ul>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function mobileNavigationChildren( $items ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

foreach ( $items as $child ):
$return .= <<<CONTENT

	
CONTENT;

if ( $child->canView() ):
$return .= <<<CONTENT

		
CONTENT;

if ( $children = $child->children() ):
$return .= <<<CONTENT

			
CONTENT;

$id = md5( mt_rand() );
$return .= <<<CONTENT

			<li class='ipsDrawer_itemParent'>
				<h4 class='ipsDrawer_title'><a href='#'>
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></h4>
				<ul class='ipsDrawer_list'>
					<li data-action="back"><a href='#'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'mobile_menu_back', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

if ( $child->link() && $child->link() !== '#' ):
$return .= <<<CONTENT

						<li>
							<a href='
CONTENT;
$return .= htmlspecialchars( $child->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
								
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

							</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->mobileNavigationChildren( $children );
$return .= <<<CONTENT

				</ul>
			</li>
		
CONTENT;

elseif ( $child instanceof \IPS\core\extensions\core\FrontNavigation\MenuHeader ):
$return .= <<<CONTENT

			<li class='ipsDrawer_section'>
				
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</li>
		
CONTENT;

elseif ( $child instanceof \IPS\core\extensions\core\FrontNavigation\MenuSeparator ):
$return .= <<<CONTENT

			
		
CONTENT;

elseif ( $child instanceof \IPS\core\extensions\core\FrontNavigation\MenuButton ):
$return .= <<<CONTENT

			<li class='ipsPad_half'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $child->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_important ipsButton_verySmall ipsButton_fullWidth'>
					
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $child->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( method_exists( $child, 'target' ) AND $child->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $child->target(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $child->target() == '_blank' ):
$return .= <<<CONTENT
 rel="noopener"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $child->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
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

		return $return;
}

	function mobileNavigationIcon(   ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsMobileHamburger ipsList_reset ipsResponsive_hideDesktop'>
	<li data-ipsDrawer data-ipsDrawer-drawerElem='#elMobileDrawer'>
		<a href='#'>
			
CONTENT;

$total = \IPS\Member::loggedIn()->notification_cnt;
$return .= <<<CONTENT

			
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

				
CONTENT;

$total += \IPS\Member::loggedIn()->msg_count_new;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) and \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

				
CONTENT;

$total += \IPS\Member::loggedIn()->reportCount();
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $total ):
$return .= <<<CONTENT

				<span class='ipsNotificationCount' data-notificationType='total'>
CONTENT;
$return .= htmlspecialchars( $total, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<i class='fa fa-navicon'></i>
		</a>
	</li>
</ul>
CONTENT;

		return $return;
}

	function modBadges( $member ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function navBar( $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

	<nav data-controller='core.front.core.navBar' class='
CONTENT;

if ( !\count( \IPS\core\FrontNavigation::i()->subBars( $preview ) ) ):
$return .= <<<CONTENT
ipsNavBar_noSubBars
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !$preview ):
$return .= <<<CONTENT
ipsResponsive_showDesktop
CONTENT;

endif;
$return .= <<<CONTENT
'>
		<div class='ipsNavBar_primary ipsLayout_container 
CONTENT;

if ( !\count( \IPS\core\FrontNavigation::i()->subBars( $preview ) ) ):
$return .= <<<CONTENT
ipsNavBar_noSubBars
CONTENT;

endif;
$return .= <<<CONTENT
'>
			<ul data-role="primaryNavBar" class='ipsClearfix'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarItems( \IPS\core\FrontNavigation::i()->roots( $preview ), \IPS\core\FrontNavigation::i()->subBars( $preview ), 0, $preview );
$return .= <<<CONTENT

				<li class='ipsHide' id='elNavigationMore' data-role='navMore'>
					<a href='#' data-ipsMenu data-ipsMenu-appendTo='#elNavigationMore' id='elNavigationMore_dropdown'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					<ul class='ipsNavBar_secondary ipsHide' data-role='secondaryNavBar'>
						<li class='ipsHide' id='elNavigationMore_more' data-role='navMore'>
							<a href='#' data-ipsMenu data-ipsMenu-appendTo='#elNavigationMore_more' id='elNavigationMore_more_dropdown'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
							<ul class='ipsHide ipsMenu ipsMenu_auto' id='elNavigationMore_more_dropdown_menu' data-role='moreDropdown'></ul>
						</li>
					</ul>
				</li>
			</ul>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->quickSearch( $preview );
$return .= <<<CONTENT

		</div>
	</nav>

CONTENT;

elseif ( \IPS\Member::loggedIn()->group['g_view_board'] and !\in_array('ipsLayout_minimalNoHome', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

	<nav>
		<div class='ipsNavBar_primary ipsLayout_container ipsNavBar_noSubBars'>
			<ul data-role="primaryNavBar" class='ipsResponsive_showDesktop ipsClearfix'>
				<li>
					<a href='
CONTENT;

$return .= \IPS\Settings::i()->base_url;
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_community_home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-left'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'community_home', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</li>
			</ul>
		</div>
	</nav>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function navBarChildren( $items, $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $items as $item ):
$return .= <<<CONTENT

	
CONTENT;

if ( $preview or $item->canView() ):
$return .= <<<CONTENT

		
CONTENT;

if ( $children = $item->children() ):
$return .= <<<CONTENT

			
CONTENT;

$id = md5( mt_rand() );
$return .= <<<CONTENT

			<li id='elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsMenu_item ipsMenu_subItems'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
				<ul id='elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->navBarChildren( $children, $preview );
$return .= <<<CONTENT

				</ul>
			</li>
		
CONTENT;

elseif ( $item instanceof \IPS\core\extensions\core\FrontNavigation\MenuHeader ):
$return .= <<<CONTENT

			<li class='ipsMenu_title'>
				
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</li>
		
CONTENT;

elseif ( $item instanceof \IPS\core\extensions\core\FrontNavigation\MenuSeparator ):
$return .= <<<CONTENT

			<li class='ipsMenu_sep'>
				<hr>
			</li>
		
CONTENT;

elseif ( $item instanceof \IPS\core\extensions\core\FrontNavigation\MenuButton ):
$return .= <<<CONTENT

			<li class='ipsPad_half'>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_primary ipsButton_verySmall ipsButton_fullWidth'>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

else:
$return .= <<<CONTENT

			<li class='ipsMenu_item' {$item->attributes()}>
				<a href='
CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( method_exists( $item, 'target' ) AND $item->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $item->target(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $item->target() == '_blank' ):
$return .= <<<CONTENT
 rel="noopener"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</a>
			</li>
		
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

		return $return;
}

	function navBarItems( $roots, $subBars=NULL, $parent=0, $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$first = TRUE;
$return .= <<<CONTENT


CONTENT;

foreach ( $roots as $id => $item ):
$return .= <<<CONTENT

	
CONTENT;

if ( $preview or $item->canView() ):
$return .= <<<CONTENT

		
CONTENT;

$active = $preview ? $first : $item->activeOrChildActive();
$return .= <<<CONTENT

		
CONTENT;

if ( $active ):
$return .= <<<CONTENT

			
CONTENT;

\IPS\core\FrontNavigation::i()->activePrimaryNavBar = $item->id;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		<li 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
class='ipsNavBar_active' data-active
CONTENT;

endif;
$return .= <<<CONTENT
 id='elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="navBarItem" data-navApp="
CONTENT;

$return .= htmlspecialchars( mb_substr( \get_class( $item ), 4, mb_strpos( \get_class( $item ), '\\', 4 ) - 4 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-navExt="
CONTENT;

$return .= htmlspecialchars( mb_substr( \get_class( $item ), mb_strrpos( \get_class( $item ), '\\' ) + 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
CONTENT;

$children = $item->children();
$return .= <<<CONTENT

			
CONTENT;

if ( $children ):
$return .= <<<CONTENT

				<a href="
CONTENT;

if ( $item->link() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
#
CONTENT;

endif;
$return .= <<<CONTENT
" id="elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-appendTo='#
CONTENT;

if ( $parent ):
$return .= <<<CONTENT
elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $parent, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
elNavSecondary_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenu-activeClass='ipsNavActive_menu' data-navItem-id="
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
data-navDefault
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i><span class='ipsNavBar_active__identifier'></span>
				</a>
				<ul id="elNavigation_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" class="ipsMenu ipsMenu_auto ipsHide">
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarChildren( $children, $preview );
$return .= <<<CONTENT

				</ul>
			
CONTENT;

else:
$return .= <<<CONTENT

				<a href="
CONTENT;

if ( $item->link() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $item->link(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
#
CONTENT;

endif;
$return .= <<<CONTENT
" 
CONTENT;

if ( method_exists( $item, 'target' ) AND $item->target() ):
$return .= <<<CONTENT
target='
CONTENT;
$return .= htmlspecialchars( $item->target(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $item->target() == '_blank' ):
$return .= <<<CONTENT
 rel="noopener"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 data-navItem-id="
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $active ):
$return .= <<<CONTENT
data-navDefault
CONTENT;

endif;
$return .= <<<CONTENT
>
					
CONTENT;
$return .= htmlspecialchars( $item->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
<span class='ipsNavBar_active__identifier'></span>
				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $subBars && isset( $subBars[ $id ] ) && \count( $subBars[ $id ] ) ):
$return .= <<<CONTENT

				<ul class='ipsNavBar_secondary 
CONTENT;

if ( !$active ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='secondaryNavBar'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->navBarItems( $subBars[ $id ], NULL, $item->id, $preview );
$return .= <<<CONTENT

					<li class='ipsHide' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='navMore'>
						<a href='#' data-ipsMenu data-ipsMenu-appendTo='#elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_dropdown'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
						<ul class='ipsHide ipsMenu ipsMenu_auto' id='elNavigationMore_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_dropdown_menu' data-role='moreDropdown'></ul>
					</li>
				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

$first = FALSE;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function pageHeader( $title, $blurb='', $rawBlurb=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPageHeader sm:ipsPadding:half ipsClearfix ipsMargin_bottom sm:ipsMargin_bottom:half'>
	<h1 class='ipsType_pageTitle'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
	
CONTENT;

if ( $blurb ):
$return .= <<<CONTENT

		<div class='ipsPageHeader_info ipsType_light'>
			
CONTENT;

if ( !$rawBlurb ):
$return .= <<<CONTENT

				
CONTENT;
$return .= htmlspecialchars( $blurb, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				{$blurb}
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function pixel( $events, $addScriptTags=true ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->fb_pixel_id and \IPS\Settings::i()->fb_pixel_enabled ):
$return .= <<<CONTENT


CONTENT;

if ( $addScriptTags ):
$return .= <<<CONTENT
<script>
CONTENT;

endif;
$return .= <<<CONTENT

setTimeout( function() {
	
CONTENT;

foreach ( $events as $name => $params ):
$return .= <<<CONTENT

		
CONTENT;

$inlineParams = '';
$return .= <<<CONTENT

		
CONTENT;

if ( \count( $params ) ):
$return .= <<<CONTENT

			
CONTENT;

$inlineParams = json_encode( $params );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $inlineParams ):
$return .= <<<CONTENT

		fbq('track', '
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
', {$inlineParams});
		
CONTENT;

else:
$return .= <<<CONTENT

		fbq('track', '
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
');
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

}, 
CONTENT;

$return .= htmlspecialchars( \intval( \IPS\Settings::i()->fb_pixel_delay * 1000 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 );

CONTENT;

if ( $addScriptTags ):
$return .= <<<CONTENT
</script>
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function prefix( $encoded, $text ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $text ):
$return .= <<<CONTENT

	<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=search&controller=search&tags={$encoded}", null, "tags", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($text); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_tagged_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class='ipsTag_prefix' rel="tag"><span>
CONTENT;
$return .= htmlspecialchars( $text, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function profileNextStep( $nextStep, $canDismiss=false, $hideOnCompletion=true ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$completion = \intval( (string) \IPS\Member::loggedIn()->profileCompletionPercentage() );
$return .= <<<CONTENT


CONTENT;

if ( ! ( $completion == 100 and $hideOnCompletion ) ):
$return .= <<<CONTENT

<div class='ipsBox ipsPad ipsSpacer_bottom' data-role='profileWidget' data-controller="core.front.core.profileCompletion">
	<div>
		
CONTENT;

if ( $completion < 100 ):
$return .= <<<CONTENT

		<ul class="ipsButton_split ipsPos_right ipsSpacer_bottom">
			<li>
				<a class="ipsButton ipsButton_important ipsButton_veryVerySmall" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=completion&_new=1", null, "settings", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'complete_my_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			
CONTENT;

if ( $canDismiss ):
$return .= <<<CONTENT

			<li>
				<a class="ipsButton ipsButton_link ipsButton_linkNeutral ipsButton_veryVerySmall" href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=dismissProfile" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-role='dismissProfile'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dismiss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		<h4 class="ipsType_reset ipsType_normal"><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_step_next', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 
CONTENT;

$val = "profile_step_title_{$nextStep->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong></h4>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class="ipsProgressBar ipsProgressBar_fullWidth">
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

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function promote( $object ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $object->canPromoteToSocialMedia() and ( $object instanceof \IPS\Content or $object instanceof \IPS\Node\Model ) ):
$return .= <<<CONTENT

	
CONTENT;

$column = $object::$databaseColumnId;
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->promoteLink( $object, \IPS\core\Promote::loadByClassAndId( \get_class( $object ), $object->$column, TRUE ), TRUE );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

		return $return;
}

	function promoteLink( $object, $promote=NULL, $withIcons=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$class = \get_class($object);
$return .= <<<CONTENT


CONTENT;

$column = $class::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$id = $object->$column;
$return .= <<<CONTENT


CONTENT;

if ( $promote and $promote->id ):
$return .= <<<CONTENT

	<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=promote&controller=promote&class={$class}&id={$id}&promote_id={$promote->id}&repromote=1", null, "promote", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_flash_msg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-fixed data-ipsDialog-size='large' data-ipsDialog-flashMessageTimeout="5" data-ipsDialog-flashMessageEscape="false" data-ipsDialog data-ipsDialog-remoteSubmit="true" data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_social_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsType_blendLinks ipsType_noUnderline">

CONTENT;

else:
$return .= <<<CONTENT

	<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=promote&controller=promote&class={$class}&id={$id}", null, "promote", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_flash_msg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-flashMessageTimeout="5" data-ipsDialog-flashMessageEscape="false" data-ipsDialog-fixed data-ipsDialog-size='large' data-ipsDialog data-ipsDialog-remoteSubmit="true" data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_social_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" class="ipsType_blendLinks ipsType_noUnderline">

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $withIcons ):
$return .= <<<CONTENT

	<div class="ipsPromote ipsButton ipsButton_verySmall ipsButton_light">
		<span class='ipsMargin_right:half'>
			
CONTENT;

foreach ( \IPS\core\Promote::promoteServices() as $service ):
$return .= <<<CONTENT

				<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $service::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></i>
			
CONTENT;

endforeach;
$return .= <<<CONTENT
		
		</span>
		
CONTENT;

if ( $promote and $promote->id ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_social_button_repromote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_social_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( $promote and $promote->id ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_social_button_repromote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_social_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

	</a>

CONTENT;

		return $return;
}

	function queryLog( $log ) {
		$return = '';
		$return .= <<<CONTENT

<div id="elQueryLog">
	<h3 class='ipsType_center'>
CONTENT;

$return .= htmlspecialchars( \count( $log ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
	
CONTENT;

foreach ( $log as $i => $query ):
$return .= <<<CONTENT

		<div>
			<pre class="prettyprint lang-sql" data-ipsDialog data-ipsDialog-content="#elQueryLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
CONTENT;

if ( $query['server'] ):
$return .= <<<CONTENT
(
CONTENT;
$return .= htmlspecialchars( $query['server'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
): 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $query['query'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
			
CONTENT;

if ( $query['extra'] ):
$return .= <<<CONTENT

				<div class="ipsType_center">
					<strong class="ipsType_warning"><i class="fa fa-exclamation-circle"></i> 
CONTENT;
$return .= htmlspecialchars( $query['extra'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>
				</div>
				<br>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<div id='elQueryLog
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsPad ipsHide'>
				<br>
				<pre>
CONTENT;
$return .= htmlspecialchars( $query['query'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
				<hr class="ipsHr">
				<pre class="prettyprint lang-php">
CONTENT;
$return .= htmlspecialchars( $query['backtrace'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
				<br>
			</div>
		</div>
		<hr class="ipsHr">
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function quickSearch( $preview=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !$preview and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'search' ) ) AND !\in_array('ipsLayout_minimal', \IPS\Output::i()->bodyClasses ) ):
$return .= <<<CONTENT

	<div id="elSearchWrapper">
		<div id='elSearch' class='' data-controller='core.front.core.quickSearch'>
			<form accept-charset='utf-8' action='
CONTENT;

$return .= str_replace( array( 'http://', 'https://' ), '//', htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=search&controller=search&do=quicksearch", null, "search", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE ) );
$return .= <<<CONTENT
' method='post'>
				<input type='search' id='elSearchField' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_placeholder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' name='q' autocomplete='off' aria-label='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
				<button class='cSearchSubmit' type="submit" aria-label='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class="fa fa-search"></i></button>
				<div id="elSearchExpanded">
					<div class="ipsMenu_title">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'class', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</div>
					<ul class="ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-role="searchContexts">
						<li>
							<span class='ipsSideMenu_item ipsSideMenu_itemActive' data-ipsMenuValue='all'>
								<input type="radio" name="type" value="all" checked id="elQuickSearchRadio_type_all">
								<label for='elQuickSearchRadio_type_all' id='elQuickSearchRadio_type_all_label'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'everywhere', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							</span>
						</li>
						
CONTENT;

$option = \IPS\Output::i()->defaultSearchOption;
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Output::i()->defaultSearchOption[0] != 'all' ):
$return .= <<<CONTENT

							<li>
								<span class='ipsSideMenu_item' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $option[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
									<input type="radio" name="type" value="
CONTENT;
$return .= htmlspecialchars( $option[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id="elQuickSearchRadio_type_
CONTENT;
$return .= htmlspecialchars( $option[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
									<label for='elQuickSearchRadio_type_
CONTENT;
$return .= htmlspecialchars( $option[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elQuickSearchRadio_type_
CONTENT;
$return .= htmlspecialchars( $option[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>
CONTENT;

$val = "{$option[1]}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
								</span>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( \count( \IPS\Output::i()->contextualSearchOptions ) ):
$return .= <<<CONTENT

							
CONTENT;

foreach ( array_reverse( \IPS\Output::i()->contextualSearchOptions ) as $name => $data ):
$return .= <<<CONTENT

								<li>
									<span class='ipsSideMenu_item' data-ipsMenuValue='contextual_
CONTENT;

$return .= htmlspecialchars( json_encode( $data ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
										<input type="radio" name="type" value='contextual_
CONTENT;

$return .= htmlspecialchars( json_encode( $data ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elQuickSearchRadio_type_contextual_
CONTENT;

$return .= htmlspecialchars( md5( json_encode( $data ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
										<label for='elQuickSearchRadio_type_contextual_
CONTENT;

$return .= htmlspecialchars( md5( json_encode( $data ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elQuickSearchRadio_type_contextual_
CONTENT;

$return .= htmlspecialchars( md5( json_encode( $data ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</label>
									</span>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

						<li data-role="showMoreSearchContexts">
							<span class='ipsSideMenu_item' data-action="showMoreSearchContexts" data-exclude="
CONTENT;
$return .= htmlspecialchars( $option[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
								
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

							</span>
						</li>
					</ul>
					<div class="ipsMenu_title">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'andOr', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</div>
					<ul class='ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal' role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='andOr'>
						
CONTENT;

foreach ( \IPS\Settings::i()->search_default_operator == 'and' ? array( 'and', 'or' ) : array( 'or', 'and' ) as $k ):
$return .= <<<CONTENT

							<li>
								<span class='ipsSideMenu_item 
CONTENT;

if ( \IPS\Settings::i()->search_default_operator == $k ):
$return .= <<<CONTENT
ipsSideMenu_itemActive
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
									<input type="radio" name="search_and_or" value="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( \IPS\Settings::i()->search_default_operator == $k ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elRadio_andOr_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
									<label for='elRadio_andOr_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_andOr_label_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "search_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
								</span>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
					<div class="ipsMenu_title">
						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'searchIn', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</div>
					<ul class='ipsSideMenu_list ipsSideMenu_withRadios ipsSideMenu_small ipsType_normal' role="radiogroup" data-ipsSideMenu data-ipsSideMenu-type="radio" data-ipsSideMenu-responsive="false" data-filterType='searchIn'>
						<li>
							<span class='ipsSideMenu_item ipsSideMenu_itemActive' data-ipsMenuValue='all'>
								<input type="radio" name="search_in" value="all" checked id="elRadio_searchIn_and">
								<label for='elRadio_searchIn_and' id='elField_searchIn_label_all'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'titles_and_body', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							</span>
						</li>
						<li>
							<span class='ipsSideMenu_item' data-ipsMenuValue='titles'>
								<input type="radio" name="search_in" value="titles" id="elRadio_searchIn_titles">
								<label for='elRadio_searchIn_titles' id='elField_searchIn_label_titles'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'titles_only', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							</span>
						</li>
					</ul>
				</div>
			</form>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function rating( $size, $value, $max=5, $memberRating=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div 
CONTENT;

if ( $memberRating ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;

$sprintf = array($memberRating, $max, $value); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'you_rated_x_stars', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsClearfix ipsRating 
CONTENT;

if ( $memberRating ):
$return .= <<<CONTENT
ipsRating_rated
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $size ):
$return .= <<<CONTENT
ipsRating_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $memberRating ):
$return .= <<<CONTENT

		<ul class='ipsRating_mine'>
			
CONTENT;

foreach ( range( 1, $max ) as $i ):
$return .= <<<CONTENT

				
CONTENT;

if ( $i <= $memberRating ):
$return .= <<<CONTENT

					<li class='ipsRating_on'>
						<i class='fa fa-star'></i>
					</li>
				
CONTENT;

else:
$return .= <<<CONTENT

					<li class='ipsRating_off'>
						<i class='fa fa-star'></i>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class='ipsRating_collective'>
		
CONTENT;

foreach ( range( 1, $max ) as $i ):
$return .= <<<CONTENT

			
CONTENT;

if ( $i <= $value ):
$return .= <<<CONTENT

				<li class='ipsRating_on'>
					<i class='fa fa-star'></i>
				</li>
			
CONTENT;

elseif ( ( $i - 0.5 ) <= $value ):
$return .= <<<CONTENT

				<li class='ipsRating_half'>
					<i class='fa fa-star-half'></i><i class='fa fa-star-half fa-flip-horizontal'></i>
				</li>
			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsRating_off'>
					<i class='fa fa-star'></i>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}

	function reactionBlurb( $content ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

	
CONTENT;

$reactions = \IPS\Content\Reaction::roots();
$return .= <<<CONTENT

	<ul class='ipsReact_reactions'>
		
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

			<li class="ipsReact_overview ipsType_blendLinks">
				
CONTENT;
$return .= htmlspecialchars( $content->whoReacted(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

foreach ( $content->reactBlurb() AS $key => $count ):
$return .= <<<CONTENT

			
CONTENT;

if ( isset( $reactions[ $key ] ) ):
$return .= <<<CONTENT

				
CONTENT;

$reaction = $reactions[ $key ];
$return .= <<<CONTENT

				<li class='ipsReact_reactCount'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions')->setQueryString( 'reaction', $reaction->id ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsTooltip-label="<strong>
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip-ajax="
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions')->setQueryString( array( 'reaction' => $reaction->id, 'tooltip' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTooltip-safe title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( 'reaction_title_' . $reaction->id )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted_x', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'escape' => TRUE ) );
$return .= <<<CONTENT
">
					
CONTENT;

else:
$return .= <<<CONTENT

						<span data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
">
					
CONTENT;

endif;
$return .= <<<CONTENT

							<span>
								<img src='
CONTENT;
$return .= htmlspecialchars( $reaction->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" loading="lazy">
							</span>
							<span>
								
CONTENT;
$return .= htmlspecialchars( $count, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

							</span>
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						</a>
					
CONTENT;

else:
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

	</ul>

CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

	<span class='ipsType_blendLinks'>
		
CONTENT;
$return .= htmlspecialchars( $content->whoReacted(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_remove_reactions') ):
$return .= <<<CONTENT

			<a href='
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='medium' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>&nbsp;<i class="fa fa-pencil"></i></a>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</span>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reactionLog( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class='ipsGrid_span6 ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $row['member_id'] ), 'mini' );
$return .= <<<CONTENT

		<div>
			<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( \IPS\Member::load( $row['member_id'] ) );
$return .= <<<CONTENT
</h3>
			<span class='ipsType_light'>
				
CONTENT;

if ( !isset( \IPS\Request::i()->reaction ) || \IPS\Request::i()->reaction == 'all' ):
$return .= <<<CONTENT

					
CONTENT;

$reaction = \IPS\Content\Reaction::load( $row['reaction'] );
$return .= <<<CONTENT

					<img src='
CONTENT;
$return .= htmlspecialchars( $reaction->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' height='20' width='20' loading="lazy">
				
CONTENT;

endif;
$return .= <<<CONTENT
 <span class='ipsType_medium'>{$row['rep_date']}</span>
			</span>
			
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_remove_reactions') and \count( $row['_buttons'] ) ):
$return .= <<<CONTENT

				<a href="
CONTENT;
$return .= htmlspecialchars( $row['_buttons']['delete']['link'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( isset( $row['_buttons']['delete']['data'] ) ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $row['_buttons']['delete']['data'] as $k => $v ):
$return .= <<<CONTENT

						data-
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

endif;
$return .= <<<CONTENT
><i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $row['_buttons']['delete']['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></i></a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reactionLogTable( $table, $headers, $rows, $quickSearch ) {
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
' data-controller='core.global.core.table' 
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
>

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

	
CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsGrid ipsGrid_collapsePhone ipsPad ipsClear 
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
' data-role="tableRows" itemscope itemtype="http://schema.org/ItemList">
			
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

	function reactionOverview( $content, $showCount=TRUE, $size=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsReactOverview 
CONTENT;

if ( \IPS\Settings::i()->reaction_count_display == 'count' ):
$return .= <<<CONTENT
ipsReactOverview--points
CONTENT;

else:
$return .= <<<CONTENT
ipsReactOverview--reactions
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $size ):
$return .= <<<CONTENT
ipsReactOverview_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( \IPS\Settings::i()->reaction_count_display == 'count' ):
$return .= <<<CONTENT

		<div class='ipsType_center'>
			<span class='ipsReact_reactCountOnly ipsType_center 
CONTENT;

if ( $content->reactionCount() >= 1 ):
$return .= <<<CONTENT
ipsAreaBackground_positive
CONTENT;

elseif ( $content->reactionCount() < 0 ):
$return .= <<<CONTENT
ipsAreaBackground_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsAreaBackground_light
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_blendLinks'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
">
				
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;
$return .= htmlspecialchars( $content->reactionCount(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</span>
		</div>
		<p class='ipsType_reset ipsType_center'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'repuation_points', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( \count( $content->reactBlurb() ) ):
$return .= <<<CONTENT

			
CONTENT;

$isItem = ( $content instanceof \IPS\Content\Item ) ? 1 : 0;
$return .= <<<CONTENT

			<ul>
				
CONTENT;

foreach ( array_reverse( $content->reactBlurb(), TRUE ) AS $key => $count ):
$return .= <<<CONTENT

					
CONTENT;

$reaction = \IPS\Content\Reaction::load( $key );
$return .= <<<CONTENT

					<li>
						
CONTENT;

if (\IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

							<a href='
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions')->setQueryString( array( 'reaction' => $reaction->id, 'item' => $isItem ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( 'reaction_title_' . $reaction->id )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted_x', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'escape' => TRUE ) );
$return .= <<<CONTENT
">
						
CONTENT;

else:
$return .= <<<CONTENT

							<span data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
						
CONTENT;

endif;
$return .= <<<CONTENT

								<img src='
CONTENT;
$return .= htmlspecialchars( $reaction->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" loading="lazy">
						
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

							</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							</span>
						
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

if ( $showCount && $size == 'small' && \count( $content->reactions() ) ):
$return .= <<<CONTENT

			<span class='ipsType_medium'>
CONTENT;

$return .= htmlspecialchars( \count( $content->reactions() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
		
CONTENT;

elseif ( $showCount ):
$return .= <<<CONTENT

			<p class='ipsType_reset ipsType_center'>
				
CONTENT;

$pluralize = array( \count( $content->reactions() ) ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'react_total', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function reactionTabs( $tabs, $activeId, $defaultContent, $url, $tabParam='tab', $parseNames=TRUE, $contained=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsTabs ipsClearfix cReactionTabs' id='elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
data-ipsTabBar-updateURL='false'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<a href='#elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \count( $tabs ) > 1 ):
$return .= <<<CONTENT
data-action='expandTabs'><i class='fa fa-caret-down'></i>
CONTENT;

else:
$return .= <<<CONTENT
>
CONTENT;

endif;
$return .= <<<CONTENT
</a>
	<ul role='tablist'>
		
CONTENT;

foreach ( $tabs as $i => $tab ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( $tabParam, $i ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( isset( $tab['count'] ) && $tab['count'] == 0 ):
$return .= <<<CONTENT
ipsTabs_itemDisabled
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $i == $activeId ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" title='
CONTENT;

if ( $parseNames ):
$return .= <<<CONTENT

CONTENT;

$return .= strip_tags( \IPS\Member::loggedIn()->language()->get( $tab['title'] ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= strip_tags( $tab['title'] );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' role="tab" aria-selected="
CONTENT;

if ( $i == $activeId ):
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

if ( isset( $tab['icon'] ) ):
$return .= <<<CONTENT

						<img src='
CONTENT;

$return .= \IPS\File::get( "core_Reaction", $tab['icon'] )->url;
$return .= <<<CONTENT
' width='20' height='20' alt="
CONTENT;

$val = "reaction_title_{$i}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$i}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" loading="lazy">
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $parseNames ):
$return .= <<<CONTENT

CONTENT;

$val = "{$tab['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
{$tab['title']}
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( isset( $tab['count'] ) ):
$return .= <<<CONTENT

						<span class='ipsType_light'>(
CONTENT;
$return .= htmlspecialchars( $tab['count'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>

<section id='ipsTabs_content_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_panels 
CONTENT;

if ( $contained ):
$return .= <<<CONTENT
ipsTabs_contained
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

foreach ( $tabs as $i => $tab ):
$return .= <<<CONTENT

		
CONTENT;

if ( $i == $activeId ):
$return .= <<<CONTENT

			<div id='ipsTabs_elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel" aria-labelledby="
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
				{$defaultContent}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</section>

CONTENT;

		return $return;
}

	function reactionTooltip( $reaction, $names, $others ) {
		$return = '';
		$return .= <<<CONTENT

<strong>
CONTENT;
$return .= htmlspecialchars( $reaction->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>

CONTENT;

foreach ( $names as $name ):
$return .= <<<CONTENT

	<br>
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( $others ):
$return .= <<<CONTENT

	<br>
CONTENT;

$pluralize = array( $others ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'react_blurb_others_secondary', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reputation( $content, $extraClass='', $forceType=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\IPS::classUsesTrait( $content, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and $enabledReactions = \IPS\Content\Reaction::enabledReactions() ):
$return .= <<<CONTENT

	<div data-controller='core.front.core.reaction' class='ipsItemControls_right ipsClearfix 
CONTENT;

if ( $extraClass ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $extraClass, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>	
		<div class='ipsReact ipsPos_right'>
			
CONTENT;

if ( \IPS\Settings::i()->reaction_count_display == 'count' ):
$return .= <<<CONTENT

				
CONTENT;

$reactionCount = $content->reactionCount();
$return .= <<<CONTENT

				<div class='ipsReact_reactCountOnly 
CONTENT;

if ( $reactionCount >= 1 ):
$return .= <<<CONTENT
ipsAreaBackground_positive
CONTENT;

elseif ( $reactionCount < 0 ):
$return .= <<<CONTENT
ipsAreaBackground_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsAreaBackground_light
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_blendLinks 
CONTENT;

if ( !\count( $content->reactions() ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='reactCount'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
'>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<span data-role='reactCountText'>
CONTENT;
$return .= htmlspecialchars( $reactionCount, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
					
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

						</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$reactBlurb = $content->reactBlurb();
$return .= <<<CONTENT

				<div class='ipsReact_blurb 
CONTENT;

if ( !$reactBlurb ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='reactionBlurb'>
					
CONTENT;

if ( $reactBlurb ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionBlurb( $content );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
			
CONTENT;

if ( $content->canReact() ):
$return .= <<<CONTENT

				
CONTENT;

$defaultReaction = reset( $enabledReactions );
$return .= <<<CONTENT

				
CONTENT;

$reactButton = ( $reacted = $content->reacted() and isset( $enabledReactions[ $reacted->id ] ) ) ? $enabledReactions[ $reacted->id ] : $defaultReaction;
$return .= <<<CONTENT


				<div class='ipsReact_types' data-role='reactionInteraction' data-unreact="
CONTENT;
$return .= htmlspecialchars( $content->url( 'unreact' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					
CONTENT;

if ( !\IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

						<ul class='ipsList_inline' data-role='reactTypes'>
							
CONTENT;

foreach ( $enabledReactions as $reaction ):
$return .= <<<CONTENT

								
CONTENT;

if ( $reaction->id == $reactButton->id ):
$return .= <<<CONTENT

									
CONTENT;

continue;
$return .= <<<CONTENT

								
CONTENT;

endif;
$return .= <<<CONTENT


								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'react' )->setQueryString( 'reaction', $reaction->id )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsReact_reaction' data-role="reaction" 
CONTENT;

if ( $reaction->id == $defaultReaction->id ):
$return .= <<<CONTENT
data-defaultReaction
CONTENT;

endif;
$return .= <<<CONTENT
>
										<img src='
CONTENT;
$return .= htmlspecialchars( $reaction->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" loading="lazy">
										<span class='ipsReact_name'>
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
									</a>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT


					<span class='ipsReact_button 
CONTENT;

if ( $reacted !== FALSE ):
$return .= <<<CONTENT
ipsReact_reacted
CONTENT;

endif;
$return .= <<<CONTENT
' data-action='reactLaunch'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'react' )->setQueryString( 'reaction', $reactButton->id )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsReact_reaction' data-role="reaction" 
CONTENT;

if ( $reactButton->id == $defaultReaction->id ):
$return .= <<<CONTENT
data-defaultReaction
CONTENT;

endif;
$return .= <<<CONTENT
>
							<img src='
CONTENT;
$return .= htmlspecialchars( $reactButton->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt="
CONTENT;

$val = "reaction_title_{$reactButton->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$reactButton->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" loading="lazy">
							<span class='ipsReact_name'>
CONTENT;

$val = "reaction_title_{$reactButton->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						</a>
					</span>

					<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'unreact' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsReact_unreact 
CONTENT;

if ( $reacted == FALSE ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-action='unreact' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reaction_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>&times;</a>
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

		return $return;
}

	function reputationBadge( $author ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->reputation_enabled and \IPS\Settings::i()->reputation_show_profile and $author->member_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$author->member_id}&do=reputation", null, "profile_reputation", array( $author->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $author->pp_reputation_points > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $author->pp_reputation_points < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

else:
$return .= <<<CONTENT

		<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $author->pp_reputation_points > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $author->pp_reputation_points < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

endif;
$return .= <<<CONTENT

			<i class='fa 
CONTENT;

if ( $author->pp_reputation_points > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $author->pp_reputation_points < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( abs( $author->pp_reputation_points ) );
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

		</a>
	
CONTENT;

else:
$return .= <<<CONTENT

		</span>
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reputationLog( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

	<li class='ipsGrid_span6 ipsPhotoPanel ipsPhotoPanel_mini ipsClearfix'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $row['member_id'] ), 'mini' );
$return .= <<<CONTENT

		<div>
			<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( \IPS\Member::load( $row['member_id'] ) );
$return .= <<<CONTENT
</h3>
			<span class='ipsType_light'>
				
CONTENT;

if ( $row['rep_rating'] === '1' && \IPS\Settings::i()->reputation_point_types != 'like' ):
$return .= <<<CONTENT
<i class='ipsType_large ipsType_positive fa fa-arrow-circle-up'></i>
CONTENT;

elseif ( \IPS\Settings::i()->reputation_point_types != 'like' ):
$return .= <<<CONTENT
<i class='ipsType_large ipsType_negative fa fa-arrow-circle-down'></i>
CONTENT;

endif;
$return .= <<<CONTENT
 <span class='ipsType_medium'>
CONTENT;

$val = ( $row['rep_date'] instanceof \IPS\DateTime ) ? $row['rep_date'] : \IPS\DateTime::ts( $row['rep_date'] );$return .= $val->html();
$return .= <<<CONTENT
</span>
			</span>
		</div>
	</li>

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reputationLogTable( $table, $headers, $rows, $quickSearch ) {
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
' data-controller='core.global.core.table' 
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
>

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


	
CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

		<ol class='ipsGrid ipsGrid_collapsePhone ipsPad ipsClear 
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

	function reputationMini( $content, $allowRep=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$allowRep = TRUE;
$return .= <<<CONTENT

<div data-controller='core.front.core.reaction' class='ipsReact ipsReact_mini 
CONTENT;

if ( !$allowRep ):
$return .= <<<CONTENT
ipsReact_miniNoInteraction
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
	
CONTENT;

if ( $content ):
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Settings::i()->reaction_count_display == 'count' ):
$return .= <<<CONTENT

			<div class='ipsReact_reactCountOnly ipsReact_reactCountOnly_mini 
CONTENT;

if ( $content->reactionCount() >= 1 ):
$return .= <<<CONTENT
ipsAreaBackground_positive
CONTENT;

elseif ( $content->reactionCount() < 0 ):
$return .= <<<CONTENT
ipsAreaBackground_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsAreaBackground_light
CONTENT;

endif;
$return .= <<<CONTENT
 ipsType_blendLinks 
CONTENT;

if ( !\count( $content->reactions() ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='reactCount'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
'>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<span data-role='reactCountText'>
CONTENT;
$return .= htmlspecialchars( $content->reactionCount(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

else:
$return .= <<<CONTENT

			<div class='ipsReact_blurb 
CONTENT;

if ( !$content->reactBlurb() ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='reactionBlurb'>
				
CONTENT;

if ( $content->reactBlurb() ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionBlurb( $content );
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
		
CONTENT;

if ( $content->canReact() ):
$return .= <<<CONTENT

			
CONTENT;

$reactButton = NULL;
$return .= <<<CONTENT

			
CONTENT;

$defaultReaction = NULL;
$return .= <<<CONTENT

	
			
CONTENT;

foreach ( \IPS\Content\Reaction::roots() AS $id => $reaction ):
$return .= <<<CONTENT

				
CONTENT;

if ( !$defaultReaction ):
$return .= <<<CONTENT

					
CONTENT;

$defaultReaction = $reaction;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( ( $content->reacted() !== FALSE && $reaction->id == $content->reacted()->id ) || ( $content->reacted() === FALSE ) ):
$return .= <<<CONTENT

					
CONTENT;

$reactButton = $reaction;
$return .= <<<CONTENT

					
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

if ( $allowRep ):
$return .= <<<CONTENT

				<span class='ipsReact_count ipsHide' data-role="reactCount">
					<a href='
CONTENT;
$return .= htmlspecialchars( $content->url('showReactions'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
						
CONTENT;

$return .= htmlspecialchars( \count( $content->reactions() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					</a>
				</span>
				<div class='ipsReact_types' data-role='reactionInteraction' data-unreact="
CONTENT;
$return .= htmlspecialchars( $content->url( 'unreact' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					
CONTENT;

if ( !\IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

						<ul class='ipsList_inline' data-role='reactTypes'>
							
CONTENT;

foreach ( \IPS\Content\Reaction::roots() AS $id => $reaction ):
$return .= <<<CONTENT

							
CONTENT;

if ( $reaction->id == $reactButton->id OR $reaction->_enabled === FALSE ):
$return .= <<<CONTENT

							
CONTENT;

continue;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

	
								<li>
									<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'react' )->setQueryString( 'reaction', $reaction->id )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsReact_reaction' data-role="reaction" 
CONTENT;

if ( $reaction->id == $defaultReaction->id ):
$return .= <<<CONTENT
data-defaultReaction
CONTENT;

endif;
$return .= <<<CONTENT
>
										<img src='
CONTENT;
$return .= htmlspecialchars( $reaction->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
">
										<span class='ipsReact_name'>
CONTENT;

$val = "reaction_title_{$reaction->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
									</a>
								</li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

							<li>
								<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'unreact' )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsReact_unreact 
CONTENT;

if ( $content->reacted() == FALSE ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-action='unreact' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reaction_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>&times;</a>
							</li>
						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

	
					<span class='ipsReact_button 
CONTENT;

if ( $content->reacted() !== FALSE ):
$return .= <<<CONTENT
ipsReact_reacted
CONTENT;

endif;
$return .= <<<CONTENT
' data-action='reactLaunch'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $content->url( 'react' )->setQueryString( 'reaction', $reactButton->id )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsReact_reaction' data-role="reaction" 
CONTENT;

if ( $reactButton->id == $defaultReaction->id ):
$return .= <<<CONTENT
data-defaultReaction
CONTENT;

endif;
$return .= <<<CONTENT
>
							<img src='
CONTENT;
$return .= htmlspecialchars( $reactButton->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt="
CONTENT;

$val = "reaction_title_{$reactButton->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$val = "reaction_title_{$reactButton->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
">
							<span class='ipsReact_name'>
CONTENT;

$val = "reaction_title_{$reactButton->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
						</a>
					</span>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function reputationOthers( $contentURL, $lang, $names ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Content\Reaction::isLikeMode() ):
$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $contentURL, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-destructOnClose data-ipsDialog-size='medium' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'like_log_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_liked', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsTooltip-label='
CONTENT;
$return .= htmlspecialchars( $names, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsTooltip-json data-ipsTooltip-safe>
CONTENT;
$return .= htmlspecialchars( $lang, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>

CONTENT;

else:
$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $contentURL, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-destructOnClose data-ipsDialog-size='medium' data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_who_reacted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsTooltip-label='
CONTENT;
$return .= htmlspecialchars( $names, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsTooltip-json data-ipsTooltip-safe>
CONTENT;
$return .= htmlspecialchars( $lang, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function review( $item, $review, $editorName, $app, $type ) {
		$return = '';
		$return .= <<<CONTENT

<div id='review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap' data-controller='core.front.core.comment' data-commentApp='
CONTENT;
$return .= htmlspecialchars( $app, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-commentType='
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
-review' data-commentID="
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-quoteData='
CONTENT;

$return .= htmlspecialchars( json_encode( array('userid' => $review->author()->member_id, 'username' => $review->author()->name, 'timestamp' => $review->mapped('date'), 'contentapp' => $app, 'contenttype' => $type, 'contentid' => $item->id, 'contentcommentid' => $review->id) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsComment_content ipsType_medium'>
	<div class='ipsComment_header ipsFlex ipsFlex-ai:start ipsFlex-jc:between'>
		<div class='ipsPhotoPanel ipsPhotoPanel_small'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $review->author(), 'small', $review->warningRef(), 'ipsPos_left' );
$return .= <<<CONTENT

			<div>
				<h3 class="ipsComment_author ipsType_blendLinks">
					<strong class='ipsType_normal'>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $review->author(), $review->warningRef() );
$return .= <<<CONTENT
</strong>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputationBadge( $review->author() );
$return .= <<<CONTENT

				</h3>
				<p class="ipsComment_meta ipsType_medium ipsType_light">
					
CONTENT;

if ( $review->mapped('date') ):
$return .= <<<CONTENT

						
CONTENT;

$val = ( $review->mapped('date') instanceof \IPS\DateTime ) ? $review->mapped('date') : \IPS\DateTime::ts( $review->mapped('date') );$return .= $val->html();
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unknown_date', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT


					
CONTENT;

if ( $review->editLine() ):
$return .= <<<CONTENT

						&middot; {$review->editLine()}
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $review->hidden() AND $review->hidden() != -2 ):
$return .= <<<CONTENT

						&middot; 
CONTENT;
$return .= htmlspecialchars( $review->hiddenBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

elseif ( $review->hidden() == -2 ):
$return .= <<<CONTENT

						&middot; 
CONTENT;
$return .= htmlspecialchars( $review->deletedBlurb(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</p>
				<ul class='ipsList_inline ipsClearfix ipsRating ipsRating_large'>
					
CONTENT;

foreach ( range( 1, \intval( \IPS\Settings::i()->reviews_rating_out_of ) ) as $i ):
$return .= <<<CONTENT

						<li class='
CONTENT;

if ( $review->mapped('rating') >= $i ):
$return .= <<<CONTENT
ipsRating_on
CONTENT;

else:
$return .= <<<CONTENT
ipsRating_off
CONTENT;

endif;
$return .= <<<CONTENT
'>
							<i class='fa fa-star'></i>
						</li>
					
CONTENT;

endforeach;
$return .= <<<CONTENT

				</ul>&nbsp;&nbsp; 
CONTENT;

if ( $review->mapped('votes_total') ):
$return .= <<<CONTENT
<strong class='ipsType_medium'>{$review->helpfulLine()}</strong><br>
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
		<div class='ipsType_reset ipsType_light ipsType_blendLinks ipsComment_toolWrap'>
			<ul class='ipsList_reset ipsComment_tools'>
				<li>
					<a href='#elControlsReviews_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsComment_ellipsis' id='elControlsReviews_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'><i class='fa fa-ellipsis-h'></i></a>
					<ul id='elControlsReviews_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
						
CONTENT;

if ( $review->canReportOrRevoke() === TRUE ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'>
								<a href='
CONTENT;
$return .= htmlspecialchars( $review->url('report'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-action='reportComment' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<li class='ipsMenu_item'>
							<a class='ipsType_blendLinks' href='
CONTENT;
$return .= htmlspecialchars( $review->item()->url()->setQueryString( array( 'do' => 'findReview', 'review' => $review->id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_review', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size='narrow' data-ipsDialog-content='#elShareReview_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_review', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"  id='elShareReview_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='shareComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_this_review', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>

						
CONTENT;

if ( $review->canEdit() || ( $review->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ) || ( $review instanceof \IPS\Content\Hideable && ( ( !$review->hidden() and $review->canHide() ) || ( $review->hidden() and $review->canUnhide() ) ) ) || $review->canDelete() ):
$return .= <<<CONTENT

							<li class='ipsMenu_sep'><hr></li>
						
CONTENT;

endif;
$return .= <<<CONTENT


						
CONTENT;

if ( $review->canEdit() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('edit'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
						
CONTENT;

if ( $review->hidden() == -2 AND \IPS\Member::loggedIn()->modPermission('can_manage_deleted_content') ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('restore')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_visible', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('restore')->csrf()->setQueryString( 'restoreAsHidden', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'restore_as_hidden', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('delete')->csrf()->setQueryString( 'immediately', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm data-confirmSubMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete_immediately', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

if ( $review instanceof \IPS\Content\Hideable ):
$return .= <<<CONTENT

								
CONTENT;

if ( !$review->hidden() and $review->canHide() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;

if ( $review::$hideLogKey ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $review->url('hide'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $review->url('hide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

elseif ( $review->hidden() and $review->canUnhide() ):
$return .= <<<CONTENT

									<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('unhide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'unhide', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

							
CONTENT;

if ( $review->canDelete() ):
$return .= <<<CONTENT

								<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('delete')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-updateOnDelete="#reviewCount">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				</li>
				
CONTENT;

if ( \count( $item->reviewMultimodActions() ) ):
$return .= <<<CONTENT

					<li>
						<span class='ipsCustomInput'>
							<input type="checkbox" name="multimod[
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" data-role="moderation" data-actions="
CONTENT;

if ( $review->hidden() === -1 AND $review->canUnhide() ):
$return .= <<<CONTENT
unhide
CONTENT;

elseif ( $review->hidden() === 1 AND $review->canUnhide() ):
$return .= <<<CONTENT
approve
CONTENT;

elseif ( $review->canHide() ):
$return .= <<<CONTENT
hide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $review->canDelete() ):
$return .= <<<CONTENT
delete
CONTENT;

endif;
$return .= <<<CONTENT
" data-state='
CONTENT;

if ( $review->tableStates() ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $review->tableStates(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
	</div>
	<div class='ipsPadding_vertical sm:ipsPadding_vertical:half ipsPadding_horizontal'>
		<div id="review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="commentContent" class="ipsType_richText ipsType_normal ipsContained" data-controller='core.front.core.lightboxedImages'>
			{$review->content()}
		</div>

		
CONTENT;

if ( $review->hasAuthorResponse() ):
$return .= <<<CONTENT

			<div class='ipsReviewResponse ipsPad ipsSpacer_bottom ipsAreaBackground_light ipsClearfix'>
				<div class='ipsFlex ipsFlex-ai:center ipsFlex-jc:between ipsMargin_bottom:half'>
					<h4 class='ipsType_sectionHead ipsType_medium ipsType_bold'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'review_response_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
					
CONTENT;

if ( $review->canEditResponse() OR $review->canDeleteResponse() ):
$return .= <<<CONTENT

					<a href='#elControlsReviews_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_response_menu' class='ipsComment_ellipsis ipsType_light' id='elControlsReviews_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_response' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'more_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'><i class='fa fa-ellipsis-h'></i></a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				<div data-role="reviewResponse" class="ipsType_richText ipsType_normal ipsContained" data-controller='core.front.core.lightboxedImages'>
					{$review->mapped('author_response')}
				</div>

				
CONTENT;

if ( $review->canEditResponse() OR $review->canDeleteResponse() ):
$return .= <<<CONTENT

					<ul class='ipsMenu ipsMenu_narrow ipsHide' id='elControlsReviews_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_response_menu'>
						
CONTENT;

if ( $review->canEditResponse() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('editResponse'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'review_author_respond', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canDeleteResponse() ):
$return .= <<<CONTENT

							<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('deleteResponse')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-confirm>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		
CONTENT;

if ( $review->hidden() !== 1 ):
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\Member::loggedIn()->member_id and ( !$review->mapped('votes_data') or !array_key_exists( \IPS\Member::loggedIn()->member_id, json_decode( $review->mapped('votes_data'), TRUE ) ) ) and $review->author()->member_id != \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

				<div class='ipsType_medium ipsMargin_top'><strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'did_you_find_this_helpful', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong> &nbsp;&nbsp;&nbsp;<a href='
CONTENT;
$return .= htmlspecialchars( $review->url('rate')->setQueryString( 'helpful', TRUE )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-action="rateReview"><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'yes', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a> <a href='
CONTENT;
$return .= htmlspecialchars( $review->url('rate')->setQueryString( 'helpful', FALSE )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-action="rateReview"><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( ( \IPS\Member::loggedIn()->member_id and ( !$review->mapped('votes_data') or !array_key_exists( \IPS\Member::loggedIn()->member_id, json_decode( $review->mapped('votes_data'), TRUE ) ) ) ) || $review->canEdit() || $review->canDelete() || $review->canHide() || $review->canUnhide() || ( $review->hidden() !== 1 && \IPS\IPS::classUsesTrait( $review, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and $review->hasReactionBar() ) ):
$return .= <<<CONTENT

		<div class='ipsItemControls'>
			
CONTENT;

if ( $review->hidden() !== 1 && \IPS\IPS::classUsesTrait( $review, 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled ):
$return .= <<<CONTENT

				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reputation( $review );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $review->canEdit() || $review->canDelete() || $review->canHide() || $review->canUnhide() || ( $review->hidden() !== 1 && $review->canRespond() )  ):
$return .= <<<CONTENT

				<ul class='ipsComment_controls ipsClearfix ipsItemControls_left' data-role="commentControls">
					
CONTENT;

if ( $review->hidden() === 1 && ( $review->canUnhide() || $review->canDelete() ) ):
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canUnhide() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('unhide')->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_positive' data-action='approveComment'><i class='fa fa-check'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'approve', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canDelete() ):
$return .= <<<CONTENT

							<li><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('delete')->csrf()->setPage('page',\IPS\Request::i()->page), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='deleteComment' data-updateOnDelete="#commentCount" class='ipsButton ipsButton_verySmall ipsButton_negative'><i class='fa fa-times'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $review->canEdit() || $review->canSplit() ):
$return .= <<<CONTENT

							<li>
								<a href='#elControlsReviewsSub_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' id='elControlsReviewsSub_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-appendTo='#review-
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_wrap'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
								<ul id='elControlsReviewsSub_
CONTENT;
$return .= htmlspecialchars( $review->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_narrow ipsHide'>
									
CONTENT;

if ( $review->canEdit() ):
$return .= <<<CONTENT

										
CONTENT;

if ( $review->mapped('first') and $review->item()->canEdit() ):
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->item()->url()->setQueryString( 'do', 'edit' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

else:
$return .= <<<CONTENT

											<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('edit'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='editComment'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
										
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

endif;
$return .= <<<CONTENT

									
CONTENT;

if ( $review->canSplit() ):
$return .= <<<CONTENT

										<li class='ipsMenu_item'><a href='
CONTENT;
$return .= htmlspecialchars( $review->url('split'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-action='splitComment' data-ipsDialog data-ipsDialog-title="
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->language()->addToStack( $item::$title )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split_to_new', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'split', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</ul>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

elseif ( $review->hidden() !== 1 && $review->canRespond() ):
$return .= <<<CONTENT

                        <li>
                            <a href='
CONTENT;
$return .= htmlspecialchars( $review->url('respond'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_verySmall ipsButton_light' data-role='respond' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'review_author_respond', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'review_author_respond', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
                        </li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsHide' data-role='commentLoading'>
						<span class='ipsLoading ipsLoading_tiny ipsLoading_noAnim'></span>
					</li>
				</ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharemenu( $review );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function reviewContainer( $item, $review ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $review::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

if ( $review->isIgnored() ):
$return .= <<<CONTENT

	<div class='ipsComment ipsComment_ignored ipsPad_half ipsType_light'>
		
CONTENT;

$sprintf = array($review->author()->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ignoring_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<a id='review-
CONTENT;
$return .= htmlspecialchars( $review->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></a>
	<article id="elReview_
CONTENT;
$return .= htmlspecialchars( $review->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsBox ipsBox--child ipsComment ipsComment_parent ipsClearfix ipsClear 
CONTENT;

if ( $review->hidden() OR $item->hidden() == -2 ):
$return .= <<<CONTENT
ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->review( $item, $review, $item::$formLangPrefix . 'review', $item::$application, $item::$module );
$return .= <<<CONTENT

	</article>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function reviewHelpful( $helpful, $total ) {
		$return = '';
		$return .= <<<CONTENT


<span class='ipsResponsive_hidePhone ipsResponsive_inline'>
	
CONTENT;

$sprintf = array($helpful, \IPS\Member::loggedIn()->language()->pluralize( \IPS\Member::loggedIn()->language()->get( 'x_members' ), array( $total ) )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_members_found_helpful', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

</span>
<span class='ipsResponsive_showPhone ipsResponsive_inline'>
	<i class='fa fa-smile-o'></i> 
CONTENT;
$return .= htmlspecialchars( $helpful, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 / 
CONTENT;

$pluralize = array( $total ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'x_members_found_helpful_phone', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

</span>
CONTENT;

		return $return;
}

	function rssMenu(  ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \count( \IPS\Output::i()->rssFeeds ) ):
$return .= <<<CONTENT

	<a href='#' id='elRSS' class='ipsPos_right ipsType_large' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'available_rss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip data-ipsMenu data-ipsMenu-above><i class='fa fa-rss-square'></i></a>
	<ul id='elRSS_menu' class='ipsMenu ipsMenu_auto ipsHide'>
		
CONTENT;

foreach ( \IPS\Output::i()->rssFeeds as $title => $url ):
$return .= <<<CONTENT

			<li class='ipsMenu_item'><a title="
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

		return $return;
}

	function sharelinks( $item ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $item->sharelinks() )  ):
$return .= <<<CONTENT

	<ul class='ipsList_inline ipsList_noSpacing ipsClearfix' data-controller="core.front.core.sharelink">
		
CONTENT;

foreach ( $item->sharelinks() as $sharelink  ):
$return .= <<<CONTENT

			<li>{$sharelink}</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( $shareData = $item->webShareData() ):
$return .= <<<CONTENT

	<hr class='ipsHr'>
	<button class='ipsHide ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth ipsMargin_top:half' data-controller='core.front.core.webshare' data-role='webShare' data-webShareTitle='
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

CONTENT;

		return $return;
}

	function sharemenu( $comment ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$idField = $comment::$databaseColumnId;
$return .= <<<CONTENT


CONTENT;

$type = ( $comment instanceof \IPS\Content\Review ) ? 'review' : 'comment';
$return .= <<<CONTENT


<div class='ipsPadding ipsHide cPostShareMenu' id='elShare
CONTENT;

$return .= htmlspecialchars( \ucfirst( $type ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $comment->$idField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
	<h5 class='ipsType_normal ipsType_reset'>
CONTENT;

$val = "link_to_$type"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
	
CONTENT;

if ( $comment->isFirst()  ):
$return .= <<<CONTENT

		
CONTENT;

$url = $comment->item()->url();
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$url = $comment->item()->url()->setQueryString( array( 'do' => 'find' . \ucfirst( $type ), $type => $comment->$idField ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Settings::i()->ref_on ):
$return .= <<<CONTENT

	
CONTENT;

$url = $url->setQueryString( array( '_rid' => \IPS\Member::loggedIn()->member_id  ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	<input type='text' value='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsField_fullWidth'>

	
CONTENT;

if ( (!$comment->item()->containerWrapper() OR !$comment->item()->container()->disable_sharelinks ) and \count( $comment->sharelinks() ) ):
$return .= <<<CONTENT

	<h5 class='ipsType_normal ipsType_reset ipsSpacer_top'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'share_externally', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h5>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->sharelinks( $comment );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function sidebar( $position='left' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$adsForceSidebar = ( \IPS\Settings::i()->ads_force_sidebar AND \IPS\core\Advertisement::loadByLocation( 'ad_sidebar' ) );
$return .= <<<CONTENT


CONTENT;

if ( (isset( \IPS\Output::i()->sidebar['enabled'] ) and \IPS\Output::i()->sidebar['enabled'] ) && ( ( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ) || ( isset( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) && \count( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) ) || ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canManageWidgets() ) || $adsForceSidebar ) ):
$return .= <<<CONTENT

	<div id='ipsLayout_sidebar' class='ipsLayout_sidebar
CONTENT;
$return .= htmlspecialchars( $position, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( !( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ) && ( !isset( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) || !\count( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) ) && \IPS\Dispatcher::i()->application->canManageWidgets() && !$adsForceSidebar ):
$return .= <<<CONTENT
ipsLayout_sidebarUnused
CONTENT;

endif;
$return .= <<<CONTENT
' data-controller='core.front.widgets.sidebar'>
		
CONTENT;

if ( $announcements = \IPS\core\Announcements\Announcement::loadAllByLocation( 'sidebar' ) AND ( ( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ) OR ( isset( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) && \count( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) ) ) ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->announcementSidebar( $announcements );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ):
$return .= <<<CONTENT

			<aside id="elContextualTools" class='ipsClearfix' 
CONTENT;

if ( isset( \IPS\Output::i()->sidebar['sticky'] ) ):
$return .= <<<CONTENT
data-ipsSticky
CONTENT;

endif;
$return .= <<<CONTENT
>
				
CONTENT;

$return .= \IPS\Output::i()->sidebar['contextual'];
$return .= <<<CONTENT

			</aside>
			<hr class='ipsHr ipsSpacer_both ipsSpacer_double'>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $adsForceSidebar OR ( \IPS\core\Advertisement::loadByLocation( 'ad_sidebar' ) AND ( ( isset( \IPS\Output::i()->sidebar['contextual'] ) && trim( \IPS\Output::i()->sidebar['contextual'] ) !== '' ) OR ( isset( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) && \count( \IPS\Output::i()->sidebar['widgets']['sidebar'] ) ) ) ) ):
$return .= <<<CONTENT

			<div data-role='sidebarAd'>
				
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_sidebar' );
$return .= <<<CONTENT

             	
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_sidebar_2' );
$return .= <<<CONTENT

			 	
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_sidebar_3' );
$return .= <<<CONTENT

			 	
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_sidebar_4' );
$return .= <<<CONTENT

			 	
CONTENT;

$return .= \IPS\core\Advertisement::loadByLocation( 'ad_sidebar_5' );
$return .= <<<CONTENT

			</div>
			<br><br>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->widgetContainer( 'sidebar', 'vertical' );
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function signature( $member ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $member->canEditSignature() AND !\IPS\Member::loggedIn()->isIgnoring( $member, 'signatures' ) AND \IPS\Member::loggedIn()->members_bitoptions['view_sigs'] ):
$return .= <<<CONTENT

	<div data-role="memberSignature" class='
CONTENT;

if ( !\IPS\Settings::i()->signatures_mobile ):
$return .= <<<CONTENT
ipsResponsive_hidePhone
CONTENT;

endif;
$return .= <<<CONTENT
 ipsBorder_top ipsPadding_vertical'>
		
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

			
CONTENT;

$uniqid = mt_rand();
$return .= <<<CONTENT

			<div class='ipsPos_right'>
				<a href='#elSigIgnore
CONTENT;
$return .= htmlspecialchars( $uniqid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' data-memberID="
CONTENT;
$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" id='elSigIgnore
CONTENT;
$return .= htmlspecialchars( $uniqid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='signatureOptions' data-ipsMenu class='ipsFaded ipsFaded_more ipsFaded_withHover ipsType_light' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_signature_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					<i class='fa fa-times'></i> <i class='fa fa-caret-down'></i>
				</a>

				<ul class='ipsMenu ipsMenu_medium ipsHide' id='elSigIgnore
CONTENT;
$return .= htmlspecialchars( $uniqid, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
					
CONTENT;

if ( \IPS\Member::loggedIn()->member_id != $member->member_id AND $member->canBeIgnored() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-ipsMenuValue='oneSignature'>
							<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ignore&do=ignoreType&type=signatures&member_id={$member->member_id}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "ignore", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_members_signature', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-ipsMenuValue='allSignatures'>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=toggleSigs" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'hide_all_signatures', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</li>
				</ul>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT


		<div class='ipsType_light ipsType_richText' data-ipsLazyLoad>
			{$member->signature}
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function siteSocialProfiles(   ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->site_social_profiles AND $links = json_decode( \IPS\Settings::i()->site_social_profiles, TRUE ) AND \count( $links ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $links as $profile ):
$return .= <<<CONTENT

		<li class='cUserNav_icon'>
			<a href='
CONTENT;
$return .= htmlspecialchars( $profile['key'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target='_blank' class='cShareLink cShareLink_
CONTENT;
$return .= htmlspecialchars( $profile['value'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel='noopener noreferrer'><i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $profile['value'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i></a>
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

	function solvedBadge( $author, $count ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$author->member_id}&do=solutions", null, "profile_solutions", array( $author->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solved_badge_tooltip', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsType_blendLinks'>
	<i class='fa fa-check-circle'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $count );
$return .= <<<CONTENT

</a>

CONTENT;

		return $return;
}

	function tabs( $tabNames, $activeId, $defaultContent, $url, $tabParam='tab', $parseNames=TRUE, $contained=FALSE, $extraClasses='' ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsTabs ipsClearfix
CONTENT;

if ( $extraClasses ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $extraClasses, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' id='elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTabBar data-ipsTabBar-contentArea='#ipsTabs_content_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT
data-ipsTabBar-updateURL='false'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<a href='#elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \count( $tabNames ) > 1 ):
$return .= <<<CONTENT
data-action='expandTabs'><i class='fa fa-caret-down'></i>
CONTENT;

else:
$return .= <<<CONTENT
>
CONTENT;

endif;
$return .= <<<CONTENT
</a>
	<ul role='tablist'>
		
CONTENT;

foreach ( $tabNames as $i => $name ):
$return .= <<<CONTENT

			<li>
				<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( $tabParam, $i ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsTabs_item 
CONTENT;

if ( $i == $activeId ):
$return .= <<<CONTENT
ipsTabs_activeItem
CONTENT;

endif;
$return .= <<<CONTENT
" title='
CONTENT;

if ( $parseNames ):
$return .= <<<CONTENT

CONTENT;

$return .= strip_tags( \IPS\Member::loggedIn()->language()->get( $name ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= strip_tags( $name );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' role="tab" aria-selected="
CONTENT;

if ( $i == $activeId ):
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

if ( $parseNames ):
$return .= <<<CONTENT

CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
{$name}
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
<section id='ipsTabs_content_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_panels 
CONTENT;

if ( $contained ):
$return .= <<<CONTENT
ipsTabs_contained
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

foreach ( $tabNames as $i => $name ):
$return .= <<<CONTENT

		
CONTENT;

if ( $i == $activeId ):
$return .= <<<CONTENT

			<div id='ipsTabs_elTabs_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_panel' class="ipsTabs_panel" aria-labelledby="
CONTENT;

$return .= htmlspecialchars( md5( $url ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" aria-hidden="false">
				{$defaultContent}
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT

</section>

CONTENT;

		return $return;
}

	function tag( $tag, $tagEditUrl=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<li 
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT
class='ipsTags_deletable'
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

$urlSafeTag = \IPS\Settings::i()->use_friendly_urls ? ( \IPS\Settings::i()->htaccess_mod_rewrite ? \IPS\Http\Url::internal( "app=core&module=search&controller=search&tags=" . rawurlencode( $tag ), "front", "tags" ) : \IPS\Http\Url::internal( "app=core&module=search&controller=search", "front", "search" )->setQueryString( 'tags', $tag ) ) : \IPS\Http\Url::internal( "app=core&module=search&controller=search", "front", "tags" )->setQueryString( 'tags', $tag );
$return .= <<<CONTENT

	<a href="
CONTENT;
$return .= htmlspecialchars( $urlSafeTag, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsTag' title="
CONTENT;

$sprintf = array($tag); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'find_tagged_content', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" rel="tag"><span>
CONTENT;
$return .= htmlspecialchars( $tag, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></a>
	
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT

		<a href='
CONTENT;
$return .= htmlspecialchars( $tagEditUrl->setQueryString( 'do', 'editTags' )->setQueryString( 'removeTag', $tag )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTag_remove' data-action='removeTag' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'remove_tag', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>&times;</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

</li>
CONTENT;

		return $return;
}

	function tags( $tags, $showCondensed=FALSE, $hideResponsive=FALSE, $tagEditUrl=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$id = mt_rand();
$return .= <<<CONTENT


CONTENT;

if ( \count( $tags ) OR $tagEditUrl ):
$return .= <<<CONTENT

	
CONTENT;

if ( $showCondensed ):
$return .= <<<CONTENT

		<ul class='ipsTags ipsTags_inline ipsList_inline 
CONTENT;

if ( $hideResponsive ):
$return .= <<<CONTENT
ipsResponsive_hidePhone
CONTENT;

endif;
$return .= <<<CONTENT
 ipsGap:1 ipsGap_row:0'>
			
CONTENT;

if ( \count( $tags ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $tags as $idx => $tag ):
$return .= <<<CONTENT

					
CONTENT;

if ( $idx < 2 ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tag( $tag, $tagEditUrl );
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

if ( \count( $tags ) > 2 ):
$return .= <<<CONTENT

				<li class='ipsType_small'>
					<span class='ipsType_light ipsCursor_pointer' data-ipsMenu id='elTags_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( \count( $tags ) - 2 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_more', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down ipsJS_show'></i></span>
					<div class='ipsHide ipsMenu ipsMenu_normal ipsPad_half cTagPopup' id='elTags_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu'>
						<p class='ipsType_medium ipsType_reset ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'tagged_with', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
						<ul class='ipsTags ipsList_inline ipsGap:1'>
							
CONTENT;

foreach ( $tags as $tag ):
$return .= <<<CONTENT

								
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tag( $tag, NULL );
$return .= <<<CONTENT

							
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
	
CONTENT;

else:
$return .= <<<CONTENT

		<ul class='ipsTags ipsList_inline 
CONTENT;

if ( $hideResponsive ):
$return .= <<<CONTENT
ipsResponsive_hidePhone
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT
data-controller='core.front.core.tagEditor' data-tagEditID='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Settings::i()->tags_min ):
$return .= <<<CONTENT
data-minTags='
CONTENT;

$return .= \IPS\Settings::i()->tags_min;
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( \IPS\Settings::i()->tags_max ):
$return .= <<<CONTENT
data-maxTags='
CONTENT;

$return .= \IPS\Settings::i()->tags_max;
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

if ( \count( $tags ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $tags as $tag ):
$return .= <<<CONTENT

					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tag( $tag, $tagEditUrl );
$return .= <<<CONTENT

				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $tagEditUrl ):
$return .= <<<CONTENT

				<li class='ipsTags_edit'>
					<a href="
CONTENT;
$return .= htmlspecialchars( $tagEditUrl->setQueryString( 'do', 'editTags' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_tags', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsMenu data-ipsMenu-closeOnClick='false' id='elTagEditor_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_veryVerySmall ipsButton_light'><i class='fa fa-plus'></i>
CONTENT;

if ( !\count( $tags ) ):
$return .= <<<CONTENT
 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'add_tags', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

if ( $tagEditUrl ):
$return .= <<<CONTENT

			<div id='elTagEditor_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu' class='ipsMenu ipsMenu_wide ipsHide'>
				<div data-controller='core.front.core.tagEditorForm'>
					<div class='ipsPad'>
						<span><i class='icon-spinner2 ipsLoading_tinyIcon'></i>  &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'loading', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					</div>
				</div>
			</div>
		
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

		return $return;
}

	function thumbImage( $image, $name, $size='medium', $classes='', $lang='view_this', $url='', $extension='core_Attachment', $dataParam='', $lazyLoad=false ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $image ):
$return .= <<<CONTENT

	
CONTENT;

$image = ( $image instanceof \IPS\File ) ? (string) $image->url : $image;
$return .= <<<CONTENT

	
CONTENT;

if ( $url ):
$return .= <<<CONTENT
<a 
CONTENT;

if ( $dataParam ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $dataParam, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT
href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$val = "{$lang}"; $sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'
CONTENT;

else:
$return .= <<<CONTENT
<span
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !$lazyLoad || !\IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
style='background-image: url( "
CONTENT;

$return .= \IPS\File::get( $extension, $image )->url;
$return .= <<<CONTENT
" )'
CONTENT;

else:
$return .= <<<CONTENT
data-background-src='
CONTENT;

$return .= \IPS\File::get( $extension, $image )->url;
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 class='
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsThumb ipsThumb_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsThumb_bg'>
		<img 
CONTENT;

if ( $lazyLoad && \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
src='
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-
CONTENT;

endif;
$return .= <<<CONTENT
src='
CONTENT;

$return .= \IPS\File::get( $extension, $image )->url;
$return .= <<<CONTENT
' alt=''>
	
CONTENT;

if ( $url ):
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

if ( $url ):
$return .= <<<CONTENT
<a 
CONTENT;

if ( $dataParam ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $dataParam, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT
href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$val = "{$lang}"; $sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'
CONTENT;

else:
$return .= <<<CONTENT
<span
CONTENT;

endif;
$return .= <<<CONTENT
 class='
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsNoThumb ipsThumb ipsThumb_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

if ( $url ):
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

		return $return;
}

	function updateWarning(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->announcementTop(  );
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Member::loggedIn()->isAdmin() ):
$return .= <<<CONTENT

<div data-controller="core.global.core.notificationList" class="cNotificationList">
	
CONTENT;

foreach ( \IPS\core\AdminNotification::notifications( NULL, array( \IPS\core\AdminNotification::SEVERITY_CRITICAL ) ) as $notification ):
$return .= <<<CONTENT

		
CONTENT;

$style = $notification->style();
$return .= <<<CONTENT

		<div class="ipsAreaBackground_light ipsPhotoPanel ipsPhotoPanel_small ipsPhotoPanel_notPhone cAcpNotificationBanner cAcpNotificationBanner_
CONTENT;
$return .= htmlspecialchars( $style, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsClearfix">
			<div class="ipsPos_right">
				<span class="ipsType_small">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'acp_notification_frontend_explain', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				
CONTENT;

$dismissible = $notification->dismissible();
$return .= <<<CONTENT

				
CONTENT;

if ( $dismissible !== $notification::DISMISSIBLE_NO ):
$return .= <<<CONTENT

					&nbsp;
					<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=dismissAcpNotification&id={$notification->id}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="cAcpNotificationBanner_close" title="
CONTENT;

$val = "acp_notification_dismiss_{$dismissible}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip data-action="dismiss">
						<i class="fa fa-times"></i>
					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
			<i class='fa fa-
CONTENT;

if ( $style == $notification::STYLE_INFORMATION OR $style == $notification::STYLE_EXPIRE ):
$return .= <<<CONTENT
info-circle
CONTENT;

else:
$return .= <<<CONTENT
warning
CONTENT;

endif;
$return .= <<<CONTENT
 cAcpNotificationBanner_mainIcon ipsPos_left ipsResponsive_hidePhone'></i>
			<div>
				<h2 class='ipsType_sectionHead'>{$notification->title()}</h2>
				<div class='ipsType_richText ipsType_normal'>{$notification->body()}</div>
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

	function userBar(   ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Member::loggedIn()->member_id  ):
$return .= <<<CONTENT

	<ul id='elUserNav' class='ipsList_inline cSignedIn ipsResponsive_showDesktop' data-controller='core.front.core.userbar
CONTENT;

if ( \IPS\Member::loggedIn()->member_id && \IPS\Settings::i()->auto_polling_enabled ):
$return .= <<<CONTENT
,core.front.core.instantNotifications
CONTENT;

endif;
$return .= <<<CONTENT
'>
		
CONTENT;

if ( \IPS\Theme::i()->settings['social_links'] == 'header' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->siteSocialProfiles(  );
endif;
$return .= <<<CONTENT

		
CONTENT;

if ( !\IPS\Member::loggedIn()->restrict_post and \count( \IPS\Member::loggedIn()->createMenu() ) ):
$return .= <<<CONTENT

			<li id='cCreate'>
				<a href='#elCreateNew_menu' id='elCreateNew' data-ipsTooltip data-ipsMenu title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'create_menu_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
					<i class='fa fa-plus'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'create_menu', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i>
				</a>
				<div id='elCreateNew_menu' class='ipsMenu ipsMenu_auto ipsHide'>
					<ul>
						
CONTENT;

foreach ( \IPS\Member::loggedIn()->createMenu() as $k => $url ):
$return .= <<<CONTENT

							<li class="ipsMenu_item">
								<a href="
CONTENT;
$return .= htmlspecialchars( $url['link'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
								
CONTENT;

if ( isset( $url['extraData'] ) ):
$return .= <<<CONTENT

									
CONTENT;

foreach ( $url['extraData'] as $data => $v ):
$return .= <<<CONTENT

										
CONTENT;
$return .= htmlspecialchars( $data, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( isset($url['title']) AND $url['title'] ):
$return .= <<<CONTENT
 data-ipsDialog-title='
CONTENT;

$val = "{$url['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT

								
CONTENT;

if ( isset($url['flashMessage']) ):
$return .= <<<CONTENT
 data-ipsdialog-flashmessage="
CONTENT;

$val = "{$url['flashMessage']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

								>
CONTENT;

$val = "{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				</div>
			</li>
			<li class='elUserNav_sep'></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<li class='cNotifications cUserNav_icon'>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications", null, "notifications", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='elFullNotifications' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'userbar_notifications', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false'>
				<i class='fa fa-bell'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->notification_cnt ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='notify' data-currentCount='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->notification_cnt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->notification_cnt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
			</a>
			<div id='elFullNotifications_menu' class='ipsMenu ipsMenu_wide ipsHide'>
				<div class='ipsMenu_headerBar'>
					<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications&do=options", null, "notifications_options", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class="ipsButton ipsButton_verySmall ipsButton_link"><i class="fa fa-cog"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notification_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				</div>
				<div class='ipsMenu_innerContent'>
					<div id="elNotificationsBrowser" data-controller='core.front.core.notifications'></div>
					<ol class='ipsDataList ipsDataList_readStatus' data-role='notifyList' data-ipsKeyNav data-ipsKeyNav-observe='return' id='elNotifyContent'></ol>
				</div>
				<div class='ipsMenu_footerBar ipsType_center'>
					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=notifications", null, "notifications", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'><i class='fa fa-bars'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_all_notifications', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				</div>
			</div>
		</li>
		
CONTENT;

if ( !\IPS\Member::loggedIn()->members_disable_pm and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) ):
$return .= <<<CONTENT

			<li class='cInbox cUserNav_icon'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='elFullInbox' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'userbar_messages', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false'>
					<i class='fa fa-envelope'></i> <span class='ipsNotificationCount 
CONTENT;

if ( !\IPS\Member::loggedIn()->msg_count_new ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' data-notificationType='inbox' data-currentCount='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->msg_count_new, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->msg_count_new, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
				</a>
				<div id='elFullInbox_menu' class='ipsMenu ipsMenu_wide ipsHide' data-controller='core.front.core.messengerMenu'>
					<div class='ipsMenu_headerBar'>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=compose", null, "messenger_compose", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsDialog-remoteSubmit data-ipsDialog-destructOnClose data-ipsDialog-flashMessage="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'message_sent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" id='elMessengerPopup_compose' class='ipsButton ipsButton_primary ipsButton_verySmall'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'compose_new', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'userbar_messages', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
					</div>
					<div class='ipsMenu_innerContent'><ol class='ipsDataList' data-role='inboxList' data-ipsKeyNav data-ipsKeyNav-observe='return' id='elInboxContent'></ol></div>
					<div class='ipsMenu_footerBar ipsType_center'>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'><i class='fa fa-bars'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_inbox', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</div>
				</div>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) and \IPS\Member::loggedIn()->modPermission('can_view_reports') ):
$return .= <<<CONTENT

			<li class='cReports cUserNav_icon'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=reports", null, "modcp_reports", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='elFullReports' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'userbar_reports', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
' data-ipsMenu data-ipsMenu-closeOnClick='false'>
					<i class='fa fa-warning'></i> 
CONTENT;

if ( \IPS\Member::loggedIn()->reportCount() ):
$return .= <<<CONTENT
<span class='ipsNotificationCount' data-notificationType='reports'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->reportCount(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

				</a>
				<div id='elFullReports_menu' class='ipsMenu ipsMenu_wide ipsHide'>
					<div class='ipsMenu_headerBar'><h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_center_header', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4></div>
					<div class='ipsMenu_innerContent' data-role="reportsList"></div>
					<div class='ipsMenu_footerBar ipsType_center'>
						<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=reports", null, "modcp_reports", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'><i class='fa fa-bars'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'report_center_link', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					</div>
				</div>
			</li>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<li class='elUserNav_sep'></li>
		<li id='cUserLink'>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::loggedIn(), 'tiny' );
$return .= <<<CONTENT

			<a href='#elUserLink_menu' id='elUserLink' data-ipsMenu>
				
CONTENT;

if ( isset( $_SESSION['logged_in_as_key'] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($_SESSION['logged_in_from']['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'front_logged_in_as', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i>
			</a>
			<ul id='elUserLink_menu' class='ipsMenu ipsMenu_normal ipsHide'>
				
CONTENT;

if ( \IPS\Member::loggedIn()->canHaveAchievements() and \IPS\core\Achievements\Rank::show() and \IPS\core\Achievements\Rank::getStore() and $rank = \IPS\Member::loggedIn()->rank() ):
$return .= <<<CONTENT

					<li class='ipsPadding'>
						<div class='elUserNav_achievements ipsFlex ipsGap:4 ipsGap_row:0'>
							<div class='elUserNav_achievements__icon ipsFlex-flex:00'>{$rank->html('ipsDimension:5')}</div>
							<div class='elUserNav_achievements__content ipsFlex-flex:11'>
								<div class='ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_current_rank', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
								<div><strong class='ipsType_large'>
CONTENT;
$return .= htmlspecialchars( $rank->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong> (
CONTENT;
$return .= htmlspecialchars( $rank->rankPosition()['pos'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
/
CONTENT;
$return .= htmlspecialchars( $rank->rankPosition()['max'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)</div>
								
CONTENT;

if ( $nextRank = \IPS\Member::loggedIn()->nextRank() ):
$return .= <<<CONTENT

									<div class='ipsMargin_top:half'>
										<div>
											<div class='ipsAchievementsProgress'>
												<div style='width: calc(
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->achievements_points, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 / 
CONTENT;
$return .= htmlspecialchars( $nextRank->points, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 * 100%)'></div>
											</div>
										</div>
										<div class='ipsType_small ipsType_light'>
CONTENT;

$pluralize = array( $nextRank->points - \IPS\Member::loggedIn()->achievements_points ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'achievements_next_rank', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</div>
									</div>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</div>
						</div>
					</li>
				
CONTENT;

elseif ( \IPS\Member::loggedIn()->canHaveAchievements() and \IPS\Settings::i()->achievements_rebuilding ):
$return .= <<<CONTENT

					<li class='ipsPadding'>
						<div class='elUserNav_achievements ipsFlex ipsGap:4 ipsGap_row:0 ipsType_light'>
							<div class='elUserNav_achievements__icon ipsFlex-flex:00'><i class="fa fa-info-circle fa-fw ipsType_large"></i></div>
							<div class='elUserNav_achievements__content ipsFlex-flex:11'>
								<p class='ipsType_reset ipsType_light'>
									
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ranks_are_being_recalculated', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

								</p>
							</div>
						</div>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) ) ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-menuItem='profile'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_my_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) and \IPS\Member::loggedIn()->members_disable_pm AND \IPS\Member::loggedIn()->members_disable_pm != 2 ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-menuItem='messages'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger&do=enableMessenger" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "messaging", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_messenger', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-confirm data-confirmMessage='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_disabled_msg', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_messages', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Member::loggedIn()->group['g_attach_max'] != 0 ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-menuItem='attachments'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=attachments", null, "attachments", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'my_attachments', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_settings_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
				
CONTENT;

if ( \IPS\core\Promote::promoteServices() ):
$return .= <<<CONTENT

					<li class='ipsMenu_item' data-menuItem='promote'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=promote&controller=promote&do=view", null, "promote_manage", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_manage_link', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( \IPS\Application::appIsEnabled('nexus') and \IPS\Settings::i()->nexus_subs_enabled ):
$return .= <<<CONTENT

            		<li class='ipsMenu_item' data-menuItem='subscriptions'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=nexus&module=subscriptions&controller=subscriptions", null, "nexus_subscriptions", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'nexus_manage_subscriptions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
            	
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_item' data-menuItem='manageFollowed'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=followed", null, "followed_content", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_followed_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li class='ipsMenu_item' id='elAccountSettingsLink' data-menuItem='settings'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings", null, "settings", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'edit_account_settings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_settings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

if ( \IPS\Settings::i()->ignore_system_on ):
$return .= <<<CONTENT

            	    <li class='ipsMenu_item' data-menuItem='ignoredUsers'><a href='
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

				<li class='ipsMenu_sep'><hr></li>
				
CONTENT;

if ( ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ) or \IPS\Member::loggedIn()->isAdmin() ):
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) AND \IPS\Member::loggedIn()->modPermission() ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-menuItem='modcp'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp", null, "modcp", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_modcp', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Member::loggedIn()->isAdmin() AND \IPS\SHOW_ACP_LINK  ):
$return .= <<<CONTENT

						<li class='ipsMenu_item' data-menuItem='admincp'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "", "admin", "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' target='_blank' rel="noopener"><i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'menu_admincp', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					<li class='ipsMenu_sep'><hr></li>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsMenu_item' data-menuItem='signout'>
					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login&do=logout" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "logout", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
						
CONTENT;

if ( isset( $_SESSION['logged_in_as_key'] ) ):
$return .= <<<CONTENT

CONTENT;

$sprintf = array($_SESSION['logged_in_from']['name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'switch_to_account', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
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
				</li>
			</ul>
		</li>
	</ul>

CONTENT;

else:
$return .= <<<CONTENT

	<ul id='elUserNav' class='ipsList_inline cSignedOut ipsResponsive_showDesktop'>
		
CONTENT;

if ( \IPS\Theme::i()->settings['social_links'] != 'footer' ):
$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'front' )->siteSocialProfiles(  );
endif;
$return .= <<<CONTENT

		<li id='elSignInLink'>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsMenu-closeOnClick="false" data-ipsMenu id='elUserSignIn'>
				
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i>
			</a>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->loginPopup( new \IPS\Login( \IPS\Http\Url::internal( 'app=core&module=system&controller=login', 'front', 'login' ) ) );
$return .= <<<CONTENT

		</li>
		
CONTENT;

if ( \IPS\Login::registrationType() != 'disabled' ):
$return .= <<<CONTENT

			<li>
				
CONTENT;

if ( \IPS\Login::registrationType() == 'redirect' ):
$return .= <<<CONTENT

					<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->allow_reg_target, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' target="_blank" rel="noopener" class='ipsButton ipsButton_normal ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
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
 id='elRegisterButton' class='ipsButton ipsButton_normal ipsButton_primary'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
				
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

		return $return;
}

	function userLink( $member, $warningRef=NULL, $groupFormatting=NULL, $anonymous=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $anonymous ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_anonymously_placename', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT


CONTENT;

$groupFormatting = ( $groupFormatting === NULL ) ? ( ( \IPS\Settings::i()->group_formatting == 'global' ) ? TRUE : FALSE ) : $groupFormatting;
$return .= <<<CONTENT


CONTENT;

if ( $member->member_id AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) )  ):
$return .= <<<CONTENT
<a href='
CONTENT;

if ( $warningRef ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( 'wr', $warningRef ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' rel="nofollow" data-ipsHover data-ipsHover-width='370' data-ipsHover-target='
CONTENT;
$return .= htmlspecialchars( $member->url()->setQueryString( array( 'do' => 'hovercard', 'wr' => $warningRef, 'referrer' => urlencode( \IPS\Request::i()->url() ) ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class="ipsType_break">
CONTENT;

if ( $groupFormatting && $member->group['prefix'] ):
$return .= <<<CONTENT
{$member->group['prefix']}
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $groupFormatting && $member->group['suffix'] ):
$return .= <<<CONTENT
{$member->group['suffix']}
CONTENT;

endif;
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $groupFormatting && $member->group['prefix'] ):
$return .= <<<CONTENT
{$member->group['prefix']}
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $groupFormatting && $member->group['suffix'] ):
$return .= <<<CONTENT
{$member->group['suffix']}
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

		return $return;
}

	function userLinkFromData( $id, $name, $seoName, $groupIdForFormatting=NULL, $groupFormatting=NULL, $anonymous=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $anonymous ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_anonymously_placename', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $id AND \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members', 'front' ) )  ):
$return .= <<<CONTENT
<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' rel="nofollow" data-ipsHover data-ipsHover-width="370" data-ipsHover-target='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}&do=hovercard", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title="
CONTENT;

$sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
" class="ipsType_break">
CONTENT;

if ( $groupIdForFormatting AND ( $groupFormatting === TRUE OR ( $groupFormatting === NULL AND \IPS\Settings::i()->group_formatting == 'global' ) ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member\Group::load( $groupIdForFormatting )->formatName( $name );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</a>
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $groupIdForFormatting AND ( $groupFormatting === TRUE OR ( $groupFormatting === NULL AND \IPS\Settings::i()->group_formatting == 'global' ) ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member\Group::load( $groupIdForFormatting )->formatName( $name );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

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

		return $return;
}

	function userNameFromData( $name, $groupIdForFormatting=NULL, $groupFormatting=NULL, $anonymous=FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $anonymous ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'post_anonymously_placename', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $groupIdForFormatting AND ( $groupFormatting === TRUE OR ( $groupFormatting === NULL AND \IPS\Settings::i()->group_formatting == 'global' ) ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member\Group::load( $groupIdForFormatting )->formatName( $name );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userPhoto( $member, $size='small', $warningRef=NULL, $classes='', $hovercard=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $member->member_id and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT


CONTENT;

$memberURL = ( $warningRef ) ? $member->url()->setQueryString( 'wr', $warningRef ) : $member->url();
$return .= <<<CONTENT

	<a href="
CONTENT;
$return .= htmlspecialchars( $memberURL, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="nofollow" 
CONTENT;

if ( $hovercard ):
$return .= <<<CONTENT
data-ipsHover data-ipsHover-width="370" data-ipsHover-target="
CONTENT;
$return .= htmlspecialchars( $memberURL->setQueryString( 'do', 'hovercard' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 class="ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $classes ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($member->name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
		<img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' loading="lazy">
	</a>

CONTENT;

else:
$return .= <<<CONTENT

	<span class='ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $classes ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
		<img src='
CONTENT;
$return .= htmlspecialchars( $member->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' loading="lazy">
	</span>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function userPhotoFromData( $id, $name, $seoName, $photoUrl, $size='small', $classes='', $hovercard=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $id and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT

	<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" rel="nofollow" 
CONTENT;

if ( $hovercard ):
$return .= <<<CONTENT
data-ipsHover data-ipsHover-target="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$id}&do=hovercard", null, "profile", array( $seoName ?: \IPS\Http\Url::seoTitle( $name ) ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 class="ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( $classes ):
$return .= <<<CONTENT
 
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" title="
CONTENT;

$sprintf = array($name); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
">
		<img src='
CONTENT;
$return .= htmlspecialchars( $photoUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' loading="lazy">
	</a>

CONTENT;

else:
$return .= <<<CONTENT

	<span class='ipsUserPhoto ipsUserPhoto_
CONTENT;
$return .= htmlspecialchars( $size, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( $classes ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
		<img src='
CONTENT;
$return .= htmlspecialchars( $photoUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' loading="lazy">
	</span>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function viglink(  ) {
		$return = '';
		$return .= <<<CONTENT

<!--VIGLINK-->

CONTENT;

if ( \IPS\Settings::i()->viglink_groups =='all' or \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Settings::i()->viglink_groups ) ) ):
$return .= <<<CONTENT

	<script type="text/javascript">
	  var vglnk = { key: '
CONTENT;

$return .= \IPS\Settings::i()->viglink_api_key;
$return .= <<<CONTENT
'
CONTENT;

if ( \IPS\Settings::i()->viglink_subid ):
$return .= <<<CONTENT
,
	                sub_id: '
CONTENT;

$return .= \IPS\Settings::i()->viglink_subid;
$return .= <<<CONTENT
'
	                
CONTENT;

endif;
$return .= <<<CONTENT

	              };
	
	  (function(d, t) {
	    var s = d.createElement(t); s.type = 'text/javascript'; s.async = true;
	    s.src = '//cdn.viglink.com/api/vglnk.js';
	    var r = d.getElementsByTagName(t)[0]; r.parentNode.insertBefore(s, r);
	  }(document, 'script'));
	</script>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function widgetContainer( $id, $orientation='horizontal' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $id == 'header' ):
$return .= <<<CONTENT

	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->announcementContentTop(  );
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( ( isset( \IPS\Output::i()->sidebar['widgets'][ $id ] ) && \count( \IPS\Output::i()->sidebar['widgets'][ $id ] ) ) || ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canManageWidgets() ) ):
$return .= <<<CONTENT

	<div class='cWidgetContainer 
CONTENT;

if ( !isset( \IPS\Output::i()->sidebar['widgets'][ $id ] ) or !\count( \IPS\Output::i()->sidebar['widgets'][ $id ] ) ):
$return .= <<<CONTENT
ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Dispatcher::i()->application->canManageWidgets() ):
$return .= <<<CONTENT
data-controller='core.front.widgets.area'
CONTENT;

endif;
$return .= <<<CONTENT
 data-role='widgetReceiver' data-orientation='
CONTENT;
$return .= htmlspecialchars( $orientation, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-widgetArea='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<ul class='ipsList_reset'>
			
CONTENT;

if ( isset( \IPS\Output::i()->sidebar['widgets'][ $id ] ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( \IPS\Output::i()->sidebar['widgets'][ $id ] as $widget ):
$return .= <<<CONTENT

					
CONTENT;

$widgetHtml = (string) $widget;
$return .= <<<CONTENT

					<li class='ipsWidget ipsWidget_
CONTENT;
$return .= htmlspecialchars( $orientation, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( !\in_array( 'IPS\Widget\Builder', class_implements( $widget ) ) ):
$return .= <<<CONTENT
ipsBox
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( trim( $widgetHtml ) === '' ):
$return .= <<<CONTENT
 ipsWidgetHide ipsHide
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset($widget->configuration['devices_to_show']) ):
$return .= <<<CONTENT
ipsResponsive_block
CONTENT;

foreach ( array_diff( array( 'Phone', 'Tablet', 'Desktop' ), $widget->configuration['devices_to_show'] ) as $device  ):
$return .= <<<CONTENT
 ipsResponsive_hide
CONTENT;
$return .= htmlspecialchars( $device, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endforeach;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-blockID='
CONTENT;

if ( isset($widget->app) AND !empty($widget->app) ):
$return .= <<<CONTENT
app_
CONTENT;
$return .= htmlspecialchars( $widget->app, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

else:
$return .= <<<CONTENT
plugin_
CONTENT;
$return .= htmlspecialchars( $widget->plugin, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $widget->key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $widget->uniqueKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $widget->hasConfiguration() ):
$return .= <<<CONTENT
 data-blockConfig="true"
CONTENT;

endif;
$return .= <<<CONTENT
 data-blockTitle="
CONTENT;

$val = "block_{$widget->key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-blockErrorMessage="
CONTENT;

$val = "{$widget->errorMessage}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" 
CONTENT;

if ( \in_array( 'IPS\Widget\Builder', class_implements( $widget ) ) ):
$return .= <<<CONTENT
data-blockBuilder="true"
CONTENT;

endif;
$return .= <<<CONTENT
 data-controller='core.front.widgets.block'>{$widgetHtml}</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}}