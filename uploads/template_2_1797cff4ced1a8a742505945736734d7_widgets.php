<?php
namespace IPS\Theme\Cache;
class class_core_front_widgets extends \IPS\Theme\Template
{
	public $cache_key = '1f3c0f841797bc5288baf3b18572146c';
	function activeUsers( $members, $memberCount, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;

if ( \IPS\Dispatcher::i()->application->directory !== 'core' ):
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_activeUsers', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_activeUsers_noApp', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT

		&nbsp;&nbsp;<span class='ipsType_light ipsType_unbold ipsType_medium'>
CONTENT;

$pluralize = array( $memberCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_user_online_info', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

</h3>
<div class='ipsWidget_inner ipsPad'>
	
CONTENT;

if ( $memberCount ):
$return .= <<<CONTENT

		<ul class='ipsList_inline ipsList_csv ipsList_noSpacing ipsType_normal'>
			
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) )  ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $members as $row ):
$return .= <<<CONTENT

					<li>
						<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$row['member_id']}", null, "profile", array( $row['seo_name'] ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsHover data-ipsHover-target='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$row['member_id']}&do=hovercard", null, "profile", array( $row['seo_name'] ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $row['in_editor'] ):
$return .= <<<CONTENT
data-ipsTooltip data-ipsTooltip-label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_user_in_editor', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

else:
$return .= <<<CONTENT
title="
CONTENT;

$sprintf = array($row['member_name']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_user_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $row['in_editor'] ):
$return .= <<<CONTENT
class='cActiveUserEditor'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member\Group::load( $row['member_group'] )->formatName( $row['member_name'] );
$return .= <<<CONTENT
</a>
CONTENT;

if ( \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->member_id === $row['member_id'] AND \IPS\Member::loggedIn()->isOnlineAnonymously() ):
$return .= <<<CONTENT

							<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signed_in_anoymously', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
								<i class='fa fa-eye-slash'></i>
							</span>
CONTENT;

endif;
$return .= <<<CONTENT
</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

foreach ( $members as $row ):
$return .= <<<CONTENT

					<li>
						
CONTENT;

if ( $row['in_editor'] ):
$return .= <<<CONTENT
<i class="fa fa-circle-o-notch fa-spin" data-ipsTooltip data-ipsTooltip-label="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_user_in_editor', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"></i>
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Member\Group::load( $row['member_group'] )->formatName( $row['member_name'] );
$return .= <<<CONTENT


						
CONTENT;

if ( \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->member_id === $row['member_id'] AND \IPS\Member::loggedIn()->isOnlineAnonymously() ):
$return .= <<<CONTENT

							<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signed_in_anoymously', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
								<i class='fa fa-eye-slash'></i>
							</span>
						
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

		</ul>
		
CONTENT;

if ( $memberCount > 60 && $orientation == 'vertical' ):
$return .= <<<CONTENT

			<p class='ipsType_medium ipsType_reset'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=online&controller=online", null, "online", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( $memberCount - 60 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_others', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_reset ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'active_users_empty', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function announcements( $announcements, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_announcements', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( !empty( $announcements )  ):
$return .= <<<CONTENT

		<ul class='ipsList_reset ipsPad'>
			
CONTENT;

foreach ( $announcements as $announcement ):
$return .= <<<CONTENT

				<li class='ipsPhotoPanel ipsPhotoPanel_tiny cAnnouncement ipsClearfix'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $announcement->member_id ), 'tiny' );
$return .= <<<CONTENT

					<div>
						
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

							<h4 class='ipsType_large ipsType_reset'>
								<span class='ipsType_break ipsContained'>
									<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=announcement&id={$announcement->id}", null, "announcement", array( $announcement->seo_title ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
								</span>
							</h4>
							
CONTENT;

if ( $announcement->start ):
$return .= <<<CONTENT
<span class='ipsType_light'>
CONTENT;

$val = ( $announcement->start instanceof \IPS\DateTime ) ? $announcement->start : \IPS\DateTime::ts( $announcement->start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

							<br><br>
						
CONTENT;

else:
$return .= <<<CONTENT

							<h4 class='ipsType_large ipsType_reset'>
								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=announcement&id={$announcement->id}", null, "announcement", array( $announcement->seo_title ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $announcement->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
CONTENT;

if ( $announcement->start ):
$return .= <<<CONTENT
 &nbsp;&nbsp;<span class='ipsType_light ipsType_medium ipsType_unbold'>
CONTENT;

$val = ( $announcement->start instanceof \IPS\DateTime ) ? $announcement->start : \IPS\DateTime::ts( $announcement->start );$return .= (string) $val->localeDate();
$return .= <<<CONTENT
</span>
CONTENT;

endif;
$return .= <<<CONTENT

							</h4>							
						
CONTENT;

endif;
$return .= <<<CONTENT
						
						<div class='ipsType_medium ipsType_textBlock ipsType_richText ipsContained' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
6 lines
CONTENT;

else:
$return .= <<<CONTENT
2 lines
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsTruncate-watch='false'>
							{$announcement->truncated( TRUE, NULL )}
						</div>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsPad'>
			<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_announcements', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function blankWidget( $widget ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsWidgetBlank">
	
CONTENT;

$val = "{$widget->errorMessage}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function blockList( $availableBlocks ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( $availableBlocks['plugin'] ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $availableBlocks['plugin'] as $pluginId => $blocks ):
$return .= <<<CONTENT

	<h3 class='ipsToolbox_sectionTitle ipsCursor_pointer'>
CONTENT;

$return .= htmlspecialchars( \IPS\Plugin::load( $pluginId )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
	<ul class='ipsList_reset'>
		
CONTENT;

foreach ( $blocks as $block ):
$return .= <<<CONTENT

			<li data-blockTitle="
CONTENT;
$return .= htmlspecialchars( $block->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-blockID='plugin_
CONTENT;
$return .= htmlspecialchars( $block->plugin, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $block->key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $block->hasConfiguration() ):
$return .= <<<CONTENT
data-blockConfig='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $block->menuStyle) ):
$return .= <<<CONTENT
data-menuStyle='
CONTENT;
$return .= htmlspecialchars( $block->menuStyle, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty( $block->allowReuse) ):
$return .= <<<CONTENT
data-allowReuse='true'
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsCursor_drag cSidebarManager_block'>
				<h4 class='ipsType_reset'>
CONTENT;

$val = "block_{$block->key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<p class='ipsType_reset ipsType_light ipsType_small'>
CONTENT;

$val = "block_{$block->key}_desc"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( isset( $availableBlocks['apps'] ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $availableBlocks['apps'] as $app => $blocks ):
$return .= <<<CONTENT

	<h3 class='ipsToolbox_sectionTitle ipsCursor_pointer'>
CONTENT;

$val = "__app_{$app}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<ul class='ipsList_reset'>
		
CONTENT;

foreach ( $blocks as $block ):
$return .= <<<CONTENT

			<li data-blockTitle="
CONTENT;
$return .= htmlspecialchars( $block->title(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-blockErrorMessage="
CONTENT;

$val = "{$block->errorMessage}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'escape' => TRUE ) );
$return .= <<<CONTENT
" data-blockID='app_
CONTENT;
$return .= htmlspecialchars( $block->app, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $block->key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $block->hasConfiguration() ):
$return .= <<<CONTENT
data-blockConfig='true'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( isset( $block->menuStyle) ):
$return .= <<<CONTENT
data-menuStyle='
CONTENT;
$return .= htmlspecialchars( $block->menuStyle, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty( $block->allowReuse) ):
$return .= <<<CONTENT
data-allowReuse='true'
CONTENT;

endif;
$return .= <<<CONTENT
 class='ipsCursor_drag cSidebarManager_block'>
				<h4 class='ipsType_reset'>
CONTENT;

$val = "block_{$block->key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
				<p class='ipsType_reset ipsType_light ipsType_small'>
CONTENT;

$val = "block_{$block->key}_desc"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	<p class='ipsType_light ipsType_center ipsPad_half ipsHide'><em>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_app_widgets', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</em></p>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

		return $return;
}

	function builderWrapper( $output, $config ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( \IPS\Request::i()->do ) and \IPS\Request::i()->do == 'getBlock' ):
$return .= <<<CONTENT

<style type="text/css">
	
CONTENT;

if ( isset($config['custom']) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $config['custom'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( ! $config['border'] ):
$return .= <<<CONTENT

	
CONTENT;

$block = \IPS\Request::i()->blockID;
$return .= <<<CONTENT

	.ipsBox[data-blockid="
CONTENT;
$return .= htmlspecialchars( $block, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"] {
		border: none;
		box-shadow: none;
	}
	.ipsWidget[data-blockid="
CONTENT;
$return .= htmlspecialchars( $block, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"] {
		background: transparent !important;
	}
	
CONTENT;

endif;
$return .= <<<CONTENT

</style>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( ! empty( $config['background_custom_image_overlay'] ) ):
$return .= <<<CONTENT

	
CONTENT;

$padding = isset( $config['style']['padding'] ) ? $config['style']['padding'] : '';
$return .= <<<CONTENT

	
CONTENT;

unset( $config['style']['padding'] );
$return .= <<<CONTENT

	
CONTENT;

$style = implode( " ", $config['style']);
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	
CONTENT;

$style = implode( " ", $config['style']);
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

<div class='
CONTENT;
$return .= htmlspecialchars( $config['class'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 
CONTENT;

if ( ! empty($config['border']) ):
$return .= <<<CONTENT
ipsBox
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if (  empty( $config['background_custom_image_overlay'] ) ):
$return .= <<<CONTENT

CONTENT;

if ( ! empty($config['padding']) and $config['padding'] == 'half' ):
$return .= <<<CONTENT
ipsPad_half
CONTENT;

elseif ( ! empty($config['padding']) and $config['padding'] == 'full' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( ! empty($config['fontsize']) and $config['fontsize'] != 'custom' and $config['fontsize'] != 'inherit' ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $config['fontsize'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'
	 style='
CONTENT;

if ( ! empty($config['style']) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $style, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( ! empty( $config['background_custom_image_overlay'] ) ):
$return .= <<<CONTENT

	<div class='
CONTENT;
$return .= htmlspecialchars( $config['class'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_overlay' style="background-color: 
CONTENT;
$return .= htmlspecialchars( $config['background_custom_image_overlay'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
; 
CONTENT;
$return .= htmlspecialchars( $padding, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
		 class="
CONTENT;

if ( ! empty($config['padding']) and $config['padding'] == 'half' ):
$return .= <<<CONTENT
ipsPad_half
CONTENT;

elseif ( ! empty($config['padding']) and $config['padding'] == 'full' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

endif;
$return .= <<<CONTENT
">
	
CONTENT;

endif;
$return .= <<<CONTENT

	{$output}
	
CONTENT;

if ( ! empty( $config['background_custom_image_overlay'] ) ):
$return .= <<<CONTENT

	</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

		return $return;
}

	function clubs( $clubs, $title=NULL, $orientation=NULL ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $title ):
$return .= <<<CONTENT

	<h3 class="ipsType_reset ipsWidget_title">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>

CONTENT;

endif;
$return .= <<<CONTENT

<section class="ipsWidget_inner ipsPad_half">
	<ul class='ipsDataList ipsDataList_reducedSpacing'>
		
CONTENT;

foreach ( $clubs as $club ):
$return .= <<<CONTENT

			<li class='ipsDataItem ipsClearfix'>
				<div class='ipsDataItem_icon'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "clubs", "core" )->clubIcon( $club, 'tiny', 'ipsPos_left' );
$return .= <<<CONTENT

				</div>
				<div class='ipsDataItem_main'>
					<h3 class='ipsType_sectionHead ipsType_large ipsContained_container'>
						<span class='ipsContained ipsType_break'><a href='
CONTENT;
$return .= htmlspecialchars( $club->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $club->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></span>
					</h3>
					<p class='ipsType_reset ipsType_medium ipsType_light'>
						
CONTENT;

$val = "club_{$club->type}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

						
CONTENT;

if ( $club->type !== $club::TYPE_PUBLIC ):
$return .= <<<CONTENT

						&nbsp;&middot;&nbsp;
						
CONTENT;

$pluralize = array( $club->members ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'club_members_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</p>
				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</section>
CONTENT;

		return $return;
}

	function formTemplate( $widget, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
$return .= <<<CONTENT


CONTENT;

$visibilityFields = array( 'show_on_all_devices', 'devices_to_show', 'clubs_visibility');
$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm ipsForm_vertical" action="
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

	<div class='ipsMenu_headerBar'>
		<h4 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editBlockSettings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h4>
	</div>

	
CONTENT;

$hasSettings = FALSE;
$return .= <<<CONTENT

	
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

			
CONTENT;

if ( \mb_substr( $input->name, 0, 12 ) != 'widget_adv__' and ! \in_array( $input->name, $visibilityFields ) ):
$return .= <<<CONTENT

				
CONTENT;

$hasSettings = TRUE; break 2;
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

if ( $hasSettings ):
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
_tab_settings_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_settings' class="ipsTabs_item" role="tab" aria-selected="true">
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'settings', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
			
CONTENT;

endif;
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
_tab_visibility_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_visibility' class="ipsTabs_item" role="tab" aria-selected="true">
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'visibility', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
			
CONTENT;

if ( ( \in_array( 'IPS\Widget\Builder', class_implements( $widget ) ) ) ):
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
_tab_advanced_panel' id='
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_advanced' class="ipsTabs_item" role="tab" aria-selected="false">
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_tab_advanced', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</a>
			</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
	</div>
	<div id='ipsTabs_content_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsTabs_panels'>
		<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_settings_panel' class="
CONTENT;

if ( $widget->menuStyle !== 'modal' ):
$return .= <<<CONTENT
ipsMenu_innerContent
CONTENT;

endif;
$return .= <<<CONTENT
 ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_settings" aria-hidden="false">
			<ul class='ipsList_reset'>
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( \mb_substr( $input->name, 0, 12 ) != 'widget_adv__' and ! \in_array( $input->name, $visibilityFields ) ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input ) ):
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
		<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_visibility_panel' class="
CONTENT;

if ( $widget->menuStyle !== 'modal' ):
$return .= <<<CONTENT
ipsMenu_innerContent
CONTENT;

endif;
$return .= <<<CONTENT
 ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_visibility" aria-hidden="false">
			<ul class='ipsList_reset'>
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( \is_object( $input ) and \in_array( $input->name, $visibilityFields ) ):
$return .= <<<CONTENT

							{$input->rowHtml($form)}
						
CONTENT;

elseif ( \in_array( $input->name, $visibilityFields ) ):
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

		
CONTENT;

if ( ( \in_array( 'IPS\Widget\Builder', class_implements( $widget ) ) ) ):
$return .= <<<CONTENT

		<div id='ipsTabs_tabs_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_advanced_panel' class="
CONTENT;

if ( $widget->menuStyle !== 'modal' ):
$return .= <<<CONTENT
ipsMenu_innerContent
CONTENT;

endif;
$return .= <<<CONTENT
ipsTabs_panel ipsPad" aria-labelledby="
CONTENT;
$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_tab_advanced" aria-hidden="false">
			<ul class='ipsList_reset'>
				
CONTENT;

foreach ( $elements as $collection ):
$return .= <<<CONTENT

					
CONTENT;

foreach ( $collection as $input ):
$return .= <<<CONTENT

						
CONTENT;

if ( \mb_substr( $input->name, 0, 12 ) == 'widget_adv__' and ! \in_array( $input->name, $visibilityFields ) ):
$return .= <<<CONTENT

							
CONTENT;

if ( \is_object( $input ) ):
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
		
CONTENT;

endif;
$return .= <<<CONTENT

	</div>
	<div class='ipsMenu_footerBar ipsType_center'>
		
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

	function guestSignUp( $login, $text, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$buttonMethods = $login->buttonMethods();
$return .= <<<CONTENT


CONTENT;

$usernamePasswordMethods = $login->usernamePasswordMethods();
$return .= <<<CONTENT


CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

	<div class='ipsWidget_inner ipsPos_center ipsPad'>
		<div class="ipsAreaBackground_light ipsPad">
		    <h2 class="ipsType_sectionHead ipsSpacer_bottom ipsSpacer_half">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		    <p class="ipsType_richText ipsType_contained">
		        {$text}
		    </p>
		    
		    
CONTENT;

if ( $usernamePasswordMethods ):
$return .= <<<CONTENT

			    <ul class="ipsList_inline">
			        <li>
			            <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class="ipsButton ipsButton_primary ipsButton_verySmall ipsPos_right">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			        </li>
			        <li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			        <li>
			            <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class="ipsButton ipsButton_primary ipsButton_verySmall ipsPos_right">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			        </li>
			    </ul>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
		    
CONTENT;

if ( $buttonMethods ):
$return .= <<<CONTENT

			    <div class=''>
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
						<input type="hidden" name="ref" value="
CONTENT;

$return .= htmlspecialchars( base64_encode( \IPS\Request::i()->url() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				        
CONTENT;

foreach ( $buttonMethods as $method ):
$return .= <<<CONTENT

					        <div class='ipsType_center ipsPos_center ipsSpacer_top'>
					            {$method->button()}
					        </div>
				        
CONTENT;

endforeach;
$return .= <<<CONTENT

				    </form>
			    </div>
		    
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsWidget_inner ipsPos_center ipsPad_half'>
		<div class="ipsAreaBackground_light ipsPad">
		    <div class="ipsGrid ipsGrid_collapsePhone">
		        <div class='ipsGrid_span
CONTENT;

if ( $buttonMethods ):
$return .= <<<CONTENT
8
CONTENT;

endif;
$return .= <<<CONTENT
'>
		            <h2 class="ipsType_sectionHead ipsSpacer_bottom ipsSpacer_half">
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		            <div class="ipsType_richText ipsType_contained">
						{$text}
		            </div>
		            
		            
CONTENT;

if ( $usernamePasswordMethods ):
$return .= <<<CONTENT

			            <ul class="ipsList_inline">
			                <li>
			                    <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=login", null, "login", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class="ipsButton ipsButton_primary ipsButton_verySmall ipsPos_right">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_in_short', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			                </li>
			                <li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>
			                <li>
			                    <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class="ipsButton ipsButton_primary ipsButton_verySmall ipsPos_right">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sign_up', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			                </li>
			            </ul>
			        
CONTENT;

endif;
$return .= <<<CONTENT

		        </div>
		        
CONTENT;

if ( $buttonMethods ):
$return .= <<<CONTENT

			        <div class='ipsGrid_span4 cSignInTeaser_right'>
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
							<input type="hidden" name="ref" value="
CONTENT;

$return .= htmlspecialchars( base64_encode( \IPS\Request::i()->url() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				            
CONTENT;

foreach ( $buttonMethods as $method ):
$return .= <<<CONTENT

					            <div class='ipsPad_half ipsType_center ipsPos_center'>
					                {$method->button()}
					            </div>
				            
CONTENT;

endforeach;
$return .= <<<CONTENT

				        </form>
			        </div>
		        
CONTENT;

endif;
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

	function invite( $subject, $url ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_invite', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</h3>
<div class='ipsWidget_inner ipsPadding:half ipsType_center'>
	<div class="ipsPadding_bottom ipsPadding_top:half">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('block_invite_text', FALSE, array( 'sprintf' => array( \IPS\Settings::i()->board_name ) ) ), array('ipsType_reset','ipsType_medium') );
$return .= <<<CONTENT

	</div>
	<ul class="ipsList_reset ipsFlex ipsFlex-ai:center ipsFlex-jc:stretch ipsFlex-fw:wrap ipsGap:1">
		<li class='ipsFlex-flex:11'><a class="ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth " href='mailto:?subject=
CONTENT;
$return .= htmlspecialchars( $subject, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&body=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-envelope"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_invite_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
		<li class='ipsFlex-flex:11'><a class="ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth " href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=invite", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-size="narrow"><i class="fa fa-share-alt"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_invite_share', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
	</ul>
</div>
CONTENT;

		return $return;
}

	function members( $members, $title, $display='csv', $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

</h3>

CONTENT;

if ( $display === 'csv' ):
$return .= <<<CONTENT

<div class='ipsWidget_inner ipsPad'>
	
CONTENT;

if ( \count( $members ) ):
$return .= <<<CONTENT

		<ul class='ipsList_inline ipsList_csv ipsList_noSpacing'>
			
CONTENT;

foreach ( $members as $row ):
$return .= <<<CONTENT

				<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $row->member_id, $row->name, $row->members_seo_name, $row->member_group_id );
$return .= <<<CONTENT
</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_reset ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_members_no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>

CONTENT;

else:
$return .= <<<CONTENT

<div class='ipsWidget_inner 
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

else:
$return .= <<<CONTENT
ipsPad_half
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( \count( $members )  ):
$return .= <<<CONTENT

		<ul class='ipsList_reset'>
			
CONTENT;

foreach ( $members as $member ):
$return .= <<<CONTENT

				<li class='ipsPhotoPanel ipsPhotoPanel_tiny cAnnouncement'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

					<div>
						<h4 class='ipsType_large ipsType_reset'>{$member->link()} <a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'  class='ipsPos_right ipsRepBadge 
CONTENT;

if ( $member->pp_reputation_points > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $member->pp_reputation_points > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $member->pp_reputation_points < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $member->pp_reputation_points );
$return .= <<<CONTENT
</a></h4>
						{$member->groupName}
						<br>
						<span class='ipsType_light ipsType_small'>
CONTENT;

$htmlsprintf = array($member->joined->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_member_joined_date', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
						
CONTENT;

if ( $member->last_activity ):
$return .= <<<CONTENT

							<br><span class='ipsType_light ipsType_small'>
CONTENT;

$htmlsprintf = array(\IPS\DateTime::ts( $member->last_activity )->html()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_member_last_active_date', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'widget_members_no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

	function mostContributions( $contributions, $area, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner 
CONTENT;

if ( $orientation !== 'vertical' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

else:
$return .= <<<CONTENT
ipsPad_half
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

			<ol class='ipsDataList ipsDataList_reducedSpacing'>
				
CONTENT;

foreach ( $contributions['members'] as $member ):
$return .= <<<CONTENT

					<li class='ipsDataItem'>
						<div class='ipsDataItem_main ipsPhotoPanel ipsPhotoPanel_tiny ipsClearfix'>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

							<div>
								{$member->link()}
								<br><span class='ipsType_light'>
CONTENT;

if ( $area ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $contributions['counts'][$member->member_id], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $member->member_posts, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</span>
							</div>
						</div>
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

			<ol class='ipsList_inline ipsList_noSpacing'>
				
CONTENT;

foreach ( $contributions['members'] as $idx => $member ):
$return .= <<<CONTENT

					<li>
						{$member->link()} <span class='ipsType_light'>
CONTENT;

if ( $area ):
$return .= <<<CONTENT
 (
CONTENT;
$return .= htmlspecialchars( $contributions['counts'][$member->member_id], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)
CONTENT;

else:
$return .= <<<CONTENT
 (
CONTENT;
$return .= htmlspecialchars( $member->member_posts, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)
CONTENT;

endif;
$return .= <<<CONTENT
</span>
CONTENT;

if ( $idx != \count( $contributions['members'] ) - 1 ):
$return .= <<<CONTENT
,
CONTENT;

endif;
$return .= <<<CONTENT

					</li>
				
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

	function mostSolved( $topSolvedThisWeek, $limit, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_mostSolved', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsTabs ipsTabs_small ipsTabs_stretch ipsClearfix' id='elMostSolved' data-ipsTabBar data-ipsTabBar-updateURL='false' data-ipsTabBar-contentArea='#elMostSolved_content'>
	<a href='#elMostSolved' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
	<ul role="tablist" class='ipsList_reset'>
		<li>
			<a href='#ipsTabs_elMostSolved_el_MostSolvedWeek_panel' id='el_MostSolvedWeek' class='ipsTabs_item ipsTabs_activeItem' role="tab" aria-selected='true'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'week', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
		<li>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=mostSolved&time=month&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='el_MostSolvedMonth' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'month', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>		
		<li>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=mostSolved&time=year&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='el_MostSolvedYear' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'year', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
		<li>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=mostSolved&time=all&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='el_MostSolvedAll' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'alltime', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
	</ul>
</div>

<section id='elMostSolved_content' class='ipsWidget_inner ipsPad_half'>
	<div id="ipsTabs_elMostSolved_el_MostSolvedWeek_panel" class='ipsTabs_panel'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "core" )->mostSolvedRows( $topSolvedThisWeek, 'week', $orientation );
$return .= <<<CONTENT

	</div>
</section>
CONTENT;

		return $return;
}

	function mostSolvedRows( $results, $timeframe, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $results ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsDataList_reducedSpacing cTopContributors'>
			
CONTENT;

$idx = 1;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $results as $memberId => $solvedCount ):
$return .= <<<CONTENT

				
CONTENT;

$member = \IPS\Member::load( $memberId );
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsDataItem_icon ipsPos_middle ipsType_center ipsType_large ipsType_light'><strong>
CONTENT;

$return .= htmlspecialchars( $idx++, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
					<div class='ipsDataItem_main ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

						<div>
							{$member->link()}
							<br>
							<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solved_badge_tooltip_time', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge ipsRepBadge_positive'><i class='fa fa-check-circle'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $solvedCount ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
						</div>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class="ipsGrid ipsGrid_collapsePhone">
			
CONTENT;

$count = 0;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $results as $memberId => $solvedCount ):
$return .= <<<CONTENT

				
CONTENT;

if ( $count == 4 ):
$return .= <<<CONTENT

					
CONTENT;

break;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$count++;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$member = \IPS\Member::load( $memberId );
$return .= <<<CONTENT

				<div class='ipsGrid_span3'>
					<div class='ipsPad_half ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

						<div>
							<p class='ipsType_reset ipsTruncate ipsTruncate_line'>
								{$member->link()}
							</p>
							<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'solved_badge_tooltip_time', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge ipsRepBadge_positive'><i class='fa fa-check-circle'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $solvedCount ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
						</div>
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

else:
$return .= <<<CONTENT

	<div class='ipsPad'>
		<p class='ipsType_reset'>
CONTENT;

$val = "top_solved_empty__{$timeframe}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function newsletter( $ref ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_newsletter_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

</h3>
<div class='ipsWidget_inner ipsPad'>
	<span class="ipsType ipsType_veryLarge ipsPos_right ipsPad"><i class="fa fa-envelope"></i></span>
	
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->richText( \IPS\Member::loggedIn()->language()->addToStack('block_newsletter_signup'), array('ipsType_reset','ipsType_medium') );
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

		<a class="ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=newsletterSubscribe&ref={$ref}" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "settings", array(), 0 )->addRef($ref), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_newsletter_signup_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

else:
$return .= <<<CONTENT

		<a class="ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth" href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=register&newsletter=1", null, "register", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_newsletter_signup_button', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function pagebuilderoembed( $video ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsPos_center'>{$video}</div>
CONTENT;

		return $return;
}

	function pagebuildertext( $text ) {
		$return = '';
		$return .= <<<CONTENT

<div>{$text}</div>
CONTENT;

		return $return;
}

	function pagebuilderupload( $images ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( ! \is_array( $images ) ):
$return .= <<<CONTENT

<div><img src="
CONTENT;
$return .= htmlspecialchars( $images, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsPageBuilderUpload"></div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function profile( $nextStep, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsSpacer_bottom ipsPad_half' data-role='profileWidget' data-controller="core.front.core.profileCompletion">
	
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT

		<span class='ipsPos_right'><a class='ipsButton ipsButton_primary' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&_new=1&do=completion", null, "settings", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'complete_my_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a class='ipsButton ipsButton_link' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=dismissProfile" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-role='dismissProfile'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dismiss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></span>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsType_richText'>
CONTENT;

$val = "profile_step_text_{$nextStep->id}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	<span class="ipsAttachment_progress"><span style='width: 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->profileCompletionPercentage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
%'></span></span><br>
	<span class='ipsType_light'>
CONTENT;

$sprintf = array(\IPS\Member::loggedIn()->profileCompletionPercentage() . '%'); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_completion_percent', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<br>
		<a class='ipsButton ipsButton_primary' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=completion&_new=1", null, "settings", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'complete_my_profile', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a class='ipsButton ipsButton_link' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=settings&do=dismissProfile" . "&csrfKey=" . \IPS\Session::i()->csrfKey, null, "", array(), 0 )->addRef((string) \IPS\Request::i()->url()), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' data-role='dismissProfile'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dismiss', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function promoted( $promoted, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_promoted', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='
CONTENT;

if ( $orientation !== 'vertical' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

else:
$return .= <<<CONTENT
ipsPad_half
CONTENT;

endif;
$return .= <<<CONTENT
 ipsWidget_inner'>
	
CONTENT;

if ( $orientation !== 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsCarousel ipsClearfix cPromotedWidget_horizontal' data-ipsCarousel>
			<div class='ipsCarousel_inner'>
	
CONTENT;

endif;
$return .= <<<CONTENT

		<ul class='ipsList_reset 
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
cPromotedWidget_vertical ipsDataList
CONTENT;

endif;
$return .= <<<CONTENT
' data-role='carouselItems'>
		
CONTENT;

foreach ( $promoted as $item ):
$return .= <<<CONTENT

			
CONTENT;

$photoCount = ( $imageObjects = $item->imageObjects() ) ? \count( $imageObjects ) : 0;
$return .= <<<CONTENT

			
CONTENT;

$staff = \IPS\Member::load( $item->added_by );
$return .= <<<CONTENT

			<li class='cPromoted cPromotedWidgetItem 
CONTENT;

if ( $orientation !== 'vertical' ):
$return .= <<<CONTENT
ipsBox ipsBox--child ipsCarousel_item
CONTENT;

else:
$return .= <<<CONTENT
ipsDataItem
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsLazyLoad>
				
CONTENT;

if ( $photoCount ):
$return .= <<<CONTENT

					
CONTENT;

$firstPhoto = $item->imageObjects()[0];
$return .= <<<CONTENT

					<a href='
CONTENT;
$return .= htmlspecialchars( $item->object()->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsAreaBackground_dark cPromotedHeader' 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
data-background-src='
CONTENT;

$return .= str_replace( array( '(', ')' ), array( '\(', '\)' ), $firstPhoto->url );;
$return .= <<<CONTENT
'
CONTENT;

else:
$return .= <<<CONTENT
style='background-image: url(
CONTENT;
$return .= htmlspecialchars( $firstPhoto->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)'
CONTENT;

endif;
$return .= <<<CONTENT
>
						<img 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
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
$return .= htmlspecialchars( $firstPhoto->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsHide' alt="
CONTENT;
$return .= htmlspecialchars( $item->objectTitle, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

if ( $photoCount > 1 ):
$return .= <<<CONTENT

					<ul class='ipsGrid cPromotedImages ipsClearfix ipsAreaBackground_light' data-ipsGrid data-ipsGrid-minItemSize='40' data-ipsGrid-maxItemSize='60'>
						
CONTENT;

foreach ( $item->imageObjects() as $file ):
$return .= <<<CONTENT

							<li class='ipsGrid_span4'>
								<a href='
CONTENT;
$return .= htmlspecialchars( $file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
data-background-src='
CONTENT;

$return .= str_replace( array( '(', ')' ), array( '\(', '\)' ), $file->url );;
$return .= <<<CONTENT
'
CONTENT;

else:
$return .= <<<CONTENT
style='background-image: url(
CONTENT;

$return .= str_replace( array( '(', ')' ), array( '\(', '\)' ), $file->url );;
$return .= <<<CONTENT
)'
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsLightbox data-ipsLightbox-group='g
CONTENT;
$return .= htmlspecialchars( $item->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
									<img 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
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
$return .= htmlspecialchars( $file->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='' class='ipsHide'>
								</a>
							</li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</ul>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<div class='ipsPad cPromotedWidgetItem_content'>
					<h2 class='ipsType_reset ipsType_large ipsType_blendLinks ipsType_break cPromotedTitle'>
						<a href="
CONTENT;
$return .= htmlspecialchars( $item->object()->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $item->ourPicksTitle, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
					</h2>
					<p class='ipsType_reset ipsType_light ipsType_medium ipsType_blendLinks'>
						{$item->objectMetaDescription}
					</p>
					<div class='cPromotedWidgetItem_contentInner'>
						
CONTENT;

if ( $text = $item->getText('internal', true) ):
$return .= <<<CONTENT

							<div class="ipsType_richText ipsType_medium ipsSpacer_both ipsSpacer_half" data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='4 lines'>{$text}</div>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

$reactionClass = $item->objectReactionClass;
$return .= <<<CONTENT

						
CONTENT;

if ( $reactionClass || $item->objectDataCount ):
$return .= <<<CONTENT

							<ul class='ipsList_inline ipsType_light ipsSpacer_bottom'>
								
CONTENT;

if ( $reactionClass ):
$return .= <<<CONTENT

								<li>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->reactionOverview( $reactionClass, FALSE );
$return .= <<<CONTENT
</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

								
								
CONTENT;

if ( $counts = $item->objectDataCount ):
$return .= <<<CONTENT

									<li><i class='fa fa-comment'></i> 
CONTENT;
$return .= htmlspecialchars( $counts['words'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</li>
								
CONTENT;

endif;
$return .= <<<CONTENT

							</ul>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>

					<div class='ipsPhotoPanel ipsPhotoPanel_tiny ipsType_blendLinks ipsType_light'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $staff, 'tiny' );
$return .= <<<CONTENT

						<div>
							
CONTENT;

if ( $item->sent AND $item->share_to AND \count( $item->share_to ) > 1 ):
$return .= <<<CONTENT

								<ul class='ipsList_inline cPromotedNetworks'>
									
CONTENT;

foreach ( $item->share_to as $service ):
$return .= <<<CONTENT

										
CONTENT;

if ( $service == 'internal' ):
$return .= <<<CONTENT

											
CONTENT;

continue;
$return .= <<<CONTENT

										
CONTENT;

endif;
$return .= <<<CONTENT

										
CONTENT;

if ( $url = $item->getPublishedUrl( $service ) ):
$return .= <<<CONTENT

											
CONTENT;

$sharer = $item->getPromoter( $service );
$return .= <<<CONTENT

											<li class='ipsPos_right'>
												<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='cShareLink cShareLink_
CONTENT;
$return .= htmlspecialchars( $service, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$sprintf = array($sharer->key); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promote_shared_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
													<i class='fa fa-
CONTENT;
$return .= htmlspecialchars( $sharer::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'></i>
												</a>
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

							<h3 class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'promoted_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLink( $staff );
$return .= <<<CONTENT
, 
CONTENT;

$val = ( $item->sent instanceof \IPS\DateTime ) ? $item->sent : \IPS\DateTime::ts( $item->sent );$return .= $val->html();
$return .= <<<CONTENT

						</div>
					</div>
				</div>
			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	
CONTENT;

if ( $orientation !== 'vertical' ):
$return .= <<<CONTENT

			</div>
			<span class='ipsCarousel_shadow ipsCarousel_shadowLeft'></span>
			<span class='ipsCarousel_shadow ipsCarousel_shadowRight'></span>
			<a href='#' class='ipsCarousel_nav ipsHide' data-action='prev'><i class='fa fa-chevron-left'></i></a>
			<a href='#' class='ipsCarousel_nav ipsHide' data-action='next'><i class='fa fa-chevron-right'></i></a>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
<div class='ipsPad_half ipsWidget_inner ipsWidget_bottomBar'>
	<div class='ipsType_center ipsAreaBackground_light ipsPad_half'>
		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=promote&controller=ourpicks", null, "promote_show", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_all_picks', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</div>
</div>
CONTENT;

		return $return;
}

	function recentStatusUpdates( $statuses, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_recentStatusUpdates', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner cStatusUpdateWidget' data-controller="core.front.core.statusFeedWidget">
	
CONTENT;

if ( \IPS\core\Statuses\Status::canCreateFromCreateMenu() ):
$return .= <<<CONTENT

		<div class="ipsAreaBackground ipsPad_half" data-role='statusFormArea'>
			<div class='ipsComposeArea_editor' data-role='statusDummy'>
				<div class='ipsComposeArea_dummy ipsType_light' tabindex='-1'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_content', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</div>
			</div>
			<div data-role='statusEditor' class='ipsHide'></div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class='ipsDataList' data-role="statusFeed">
		
CONTENT;

foreach ( $statuses as $status ):
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "core" )->recentStatusUpdatesStatus( $status );
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
	
CONTENT;

if ( \count( $statuses ) == 0 ):
$return .= <<<CONTENT

		<div class='ipsType_center ipsType_light ipsPad_half' data-role="statusFeedEmpty">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_recent_statuses', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function recentStatusUpdatesStatus( $status ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsDataItem 
CONTENT;

if ( $status->hidden() ):
$return .= <<<CONTENT
 ipsModerated
CONTENT;

endif;
$return .= <<<CONTENT
' data-statusID='
CONTENT;
$return .= htmlspecialchars( $status->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
	<div class='ipsDataItem_icon ipsPos_top'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $status->author(), 'tiny' );
$return .= <<<CONTENT

	</div>
	<div class='ipsDataItem_main ipsType_medium ipsType_break'>
		<p class='ipsType_medium ipsType_reset'>
			
CONTENT;

if ( $status->member_id != $status->author()->member_id ):
$return .= <<<CONTENT

				<strong class='ipsType_light'>{$status->author()->link()}</strong> &nbsp;&raquo;&nbsp; <strong>
CONTENT;

$return .= \IPS\Member::load( $status->member_id )->link();
$return .= <<<CONTENT
</strong>
			
CONTENT;

else:
$return .= <<<CONTENT

				<strong>{$status->author()->link()}</strong>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</p> 
		<div class='ipsType_richText ipsContained' data-ipsTruncate data-ipsTruncate-type='remove' data-ipsTruncate-size='3 lines' data-ipsTruncate-watch='false'>
			{$status->truncated()}
		</div>
		<span class='ipsType_light ipsType_small ipsType_blendLinks'><a href='
CONTENT;
$return .= htmlspecialchars( $status->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = ( $status->date instanceof \IPS\DateTime ) ? $status->date : \IPS\DateTime::ts( $status->date );$return .= $val->html();
$return .= <<<CONTENT
</a>
CONTENT;

if ( $status->replies or $status->canComment() ):
$return .= <<<CONTENT
 &middot; <a href="
CONTENT;
$return .= htmlspecialchars( $status->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$pluralize = array( $status->replies ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'status_num_replies', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT
</span>
	</div>
</li>

CONTENT;

		return $return;
}

	function relatedContent( $similar ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_relatedContent', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsPad_half ipsWidget_inner'>
	<ul class='ipsDataList ipsDataList_reducedSpacing'>
	
CONTENT;

foreach ( $similar as $item ):
$return .= <<<CONTENT

		<li class='ipsDataItem'>
			<div class='ipsDataItem_icon'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $item->author(), 'tiny' );
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<div class='ipsType_break ipsContained'><a href="
CONTENT;
$return .= htmlspecialchars( $item->url( "getPrefComment" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$sprintf = array($item->mapped('title')); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_this', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
' class='ipsTruncate ipsTruncate_line'>
CONTENT;
$return .= htmlspecialchars( $item->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
				<span class='ipsType_light ipsType_medium'>
CONTENT;

$htmlsprintf = array($item->author()->link()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );
$return .= <<<CONTENT
</span><br>
				
CONTENT;

if ( $content = $item->truncated() ):
$return .= <<<CONTENT

					<div class='ipsType_richText ipsType_normal' data-ipsTruncate data-ipsTruncate-type="remove" data-ipsTruncate-size="2 lines">
						{$content}
					</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>
</div>
CONTENT;

		return $return;
}

	function stats( $stats, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_stats', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsWidget_inner'>
	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<div class='ipsPad_half'>
			<ul class="ipsDataList">
				<li class="ipsDataItem">
					<div class="ipsDataItem_main ipsPos_middle">
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_total_members', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['member_count'] );
$return .= <<<CONTENT
</span>
					</div>
				</li>
				<li class="ipsDataItem">
					<div class="ipsDataItem_main ipsPos_middle">
						<strong>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_most_online', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong>
					</div>
					<div class="ipsDataItem_stats ipsDataItem_statsLarge">
						<span class="ipsDataItem_stats_number">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['most_online']['count'] );
$return .= <<<CONTENT
</span><br>
						<span class="ipsType_light ipsType_small"><time>
CONTENT;
$return .= htmlspecialchars( $stats['most_online']['time'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time></span>
					</div>
				</li>
			</ul>
			<hr class='ipsHr'>
			
CONTENT;

if ( $stats['last_registered'] ):
$return .= <<<CONTENT

				<div class='ipsClearfix ipsPadding_bottom'>
					<div class='ipsPos_left ipsType_center cNewestMember'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $stats['last_registered'], 'small' );
$return .= <<<CONTENT

					</div>
					<div class='ipsWidget_latestItem'>
						<strong class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_newest_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
						<span class='ipsType_normal'>{$stats['last_registered']->link()}</span><br>
						<span class='ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <time>
CONTENT;
$return .= htmlspecialchars( $stats['last_registered']->joined->getTimestamp(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time></span>
					</div>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<div class='ipsFlex ipsFlex-ai:center ipsFlex-jc:between sm:ipsFlex-fd:column sm:ipsFlex-ai:stretch ipsPadding ipsWidget_stats'>
			<div class='ipsFlex-flex:11 ipsFlex ipsFlex-ai:center ipsFlex-jc:around'>
				<div class='ipsType_center'>
					<span class='ipsType_large ipsWidget_statsCount'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['member_count'] );
$return .= <<<CONTENT
</span><br>
					<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_total_members', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>
				<div class='ipsType_center'>
					<span class='ipsType_large ipsWidget_statsCount' data-ipsTooltip title='<time data-norelative="true">
CONTENT;
$return .= htmlspecialchars( $stats['most_online']['time'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time>'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->formatNumber( $stats['most_online']['count'] );
$return .= <<<CONTENT
</span><br>
					<span class='ipsType_light ipsType_medium'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_most_online', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
				</div>
			</div>
			
CONTENT;

if ( $stats['last_registered'] instanceof \IPS\Member ):
$return .= <<<CONTENT

			<div class='ipsFlex-flex:01 ipsBorder_left ipsPadding_left ipsMargin_right:double sm:ipsMargin_right:none sm:ipsMargin_top sm:ipsBorder:none sm:ipsBorder_top sm:ipsPadding_top sm:ipsPadding_left:none sm:ipsFlex sm:ipsFlex-jc:center'>
				<div class='ipsPhotoPanel ipsPhotoPanel_mini cNewestMember'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $stats['last_registered'], 'mini' );
$return .= <<<CONTENT

					<div>
						<span class='ipsType_minorHeading'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_newest_member', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span><br>
						<span class='ipsType_normal'>{$stats['last_registered']->link()}</span><br>
						<span class='ipsType_small ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'members_joined', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <time>
CONTENT;
$return .= htmlspecialchars( $stats['last_registered']->joined->getTimestamp(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</time></span>
					</div>
				</div>
			</div>
			
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

	function stream( $stream, $results, $title, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsWidget_title'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
<div class='
CONTENT;

if ( $orientation == "vertical" ):
$return .= <<<CONTENT
ipsPadding_horizontal:half ipsPadding_bottom:half 
CONTENT;

else:
$return .= <<<CONTENT
 ipsPadding_horizontal ipsPadding_bottom 
CONTENT;

endif;
$return .= <<<CONTENT
 ipsWidget_inner'>
<ol class="cWidgetStreamList ipsList_reset">

CONTENT;

foreach ( $results AS $result ):
$return .= <<<CONTENT

	{$result->html($orientation, $stream->include_comments ? 'last_comment' : 'date', TRUE, $result->asArray()['indexData']['index_class']::searchResultBlock() )}

CONTENT;

endforeach;
$return .= <<<CONTENT

</ol>
</div>
CONTENT;

		return $return;
}

	function streamItem( $indexData, $articles, $authorData, $itemData, $unread, $objectUrl, $itemUrl, $containerUrl, $containerTitle, $repCount, $showRepUrl, $snippet, $iPostedIn, $view, $canIgnoreComments=FALSE, $reactions=array() ) {
		$return = '';
		$return .= <<<CONTENT

<li class='cWidgetStream ipsFlex 
CONTENT;

if ( $view == 'horizontal' ):
$return .= <<<CONTENT
ipsGap:5
CONTENT;

else:
$return .= <<<CONTENT
ipsGap:3
CONTENT;

endif;
$return .= <<<CONTENT
' data-orientation="
CONTENT;
$return .= htmlspecialchars( $view, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

if ( \in_array( 'IPS\Content\Comment', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

		
CONTENT;

$itemClass = $indexData['index_class']::$itemClass;
$return .= <<<CONTENT

		<div class="cWidgetStream__icon ipsFlex-flex:00">
			
CONTENT;

if ( $view == 'horizontal' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view == 'horizontal' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

				<span class='cWidgetStreamIcon' data-ipsTooltip title='
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
				
				<span class='cWidgetStreamIcon' data-ipsTooltip title='
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
		
		</div>
		<div class='cWidgetStream__main ipsFlex-flex:11'>
			
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ) ):
$return .= <<<CONTENT
	
				
CONTENT;

$commentCount = $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ];
$return .= <<<CONTENT

				
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

					<div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

$pluralize = array( $commentCount - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $commentCount - 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

$pluralize = array( $commentCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $commentCount ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class="ipsType_break">
				<h4 class='ipsDataItem_title 
CONTENT;

if ( $view == 'horizontal' ):
$return .= <<<CONTENT
ipsType_large ipsType_break
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
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

					<span class='ipsType_break'>
						<a href='
CONTENT;
$return .= htmlspecialchars( $objectUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="link" data-searchable>
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

				</h4>
				<div class='ipsType_reset ipsType_blendLinks ipsType_medium'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "system", "core", 'front' )->searchResultSnippet( $indexData );
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\IPS::classUsesTrait( $indexData['index_class'], 'IPS\Content\Reactable' ) and \IPS\Settings::i()->reputation_enabled and \count( $reactions ) ):
$return .= <<<CONTENT

						
CONTENT;

if ( \in_array( 'IPS\Content\Review', class_parents( $indexData['index_class'] ) ) ):
$return .= <<<CONTENT

							<span class="cWidgetStreamReaction">
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", "core" )->searchReaction( $reactions, $itemUrl->setQueryString('do', 'showReactionsReview')->setQueryString('review', $indexData['index_object_id']), $repCount );
$return .= <<<CONTENT
</span>
						
CONTENT;

else:
$return .= <<<CONTENT

							<span class="cWidgetStreamReaction">
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "search", "core" )->searchReaction( $reactions, $itemUrl->setQueryString('do', 'showReactionsComment')->setQueryString('comment', $indexData['index_object_id']), $repCount );
$return .= <<<CONTENT
</span>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			
				<div class='cWidgetStreamTime ipsType_blendLinks ipsType_light ipsType_medium'>
					
CONTENT;

if ( $view == 'horizontal' ):
$return .= <<<CONTENT

						<i class='fa fa-clock-o'></i> <a href='
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
'>
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a> - 
CONTENT;

$return .= htmlspecialchars( $itemClass::searchResultSummaryLanguage( $authorData, $articles, $indexData, $itemData ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>
					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view == 'horizontal' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT
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
'>
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>	
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
				
CONTENT;

if ( isset( $indexData['index_tags'] ) ):
$return .= <<<CONTENT

					<div>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT
</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

$itemClass = $indexData['index_class'];
$return .= <<<CONTENT

		<div class="cWidgetStream__icon ipsFlex-flex:00">
			
CONTENT;

if ( $view == 'horizontal' ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view == 'horizontal' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $indexData['index_title'] ):
$return .= <<<CONTENT

				<span class='cWidgetStreamIcon' data-ipsTooltip title='
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
				
				<span class='cWidgetStreamIcon' data-ipsTooltip title='
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

		</div>
		<div class='cWidgetStream__main ipsFlex-flex:11'>
			
CONTENT;

if ( isset( $itemClass::$databaseColumnMap['num_comments'] ) and isset( $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ] ) ):
$return .= <<<CONTENT

				
CONTENT;

$commentCount = $itemData[ $itemClass::$databasePrefix . $itemClass::$databaseColumnMap['num_comments'] ];
$return .= <<<CONTENT

				
CONTENT;

if ( $itemClass::$firstCommentRequired ):
$return .= <<<CONTENT

					<div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

$pluralize = array( $commentCount - 1 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $commentCount - 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
				
CONTENT;

else:
$return .= <<<CONTENT

					<div class="ipsCommentCount ipsPos_right" data-ipsTooltip title='
CONTENT;

$pluralize = array( $commentCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replies_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $commentCount ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</div>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

			<div class='ipsType_break'>
				<h4 class='ipsDataItem_title 
CONTENT;

if ( $view == 'horizontal' ):
$return .= <<<CONTENT
ipsType_large ipsType_break
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
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

					<span class='ipsType_break'><a href='
CONTENT;
$return .= htmlspecialchars( $itemUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-linkType="link" data-searchable>
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
				</h4>
				
CONTENT;

if ( $containerTitle ):
$return .= <<<CONTENT

					<div class='ipsType_reset ipsType_blendLinks ipsType_light ipsType_medium'>
						{$snippet}
					</div>
					<div class='cWidgetStreamTime ipsType_blendLinks ipsType_light ipsType_medium'>
						
CONTENT;

if ( $view == 'horizontal' ):
$return .= <<<CONTENT

							<i class='fa fa-clock-o'></i> <a href='
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
'>
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a> - 
CONTENT;

$return .= htmlspecialchars( $itemClass::searchResultSummaryLanguage( $authorData, $articles, $indexData, $itemData ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>
						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhotoFromData( $authorData['member_id'], $authorData['name'], $authorData['members_seo_name'], \IPS\Member::photoUrl( $authorData ), ( $view == 'horizontal' ) ? 'mini' : 'tiny' );
$return .= <<<CONTENT
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
'>
CONTENT;

$val = ( $indexData['index_date_created'] instanceof \IPS\DateTime ) ? $indexData['index_date_created'] : \IPS\DateTime::ts( $indexData['index_date_created'] );$return .= $val->html();
$return .= <<<CONTENT
</a> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'in', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <a href='
CONTENT;
$return .= htmlspecialchars( $containerUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>{$containerTitle}</a>	
						
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
					
CONTENT;

if ( isset( $indexData['index_tags'] ) ):
$return .= <<<CONTENT

						<div>
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->tags( explode( ',', $indexData['index_tags'] ), true, true );
$return .= <<<CONTENT
</div>
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

			</div>
		</div>
	
CONTENT;

endif;
$return .= <<<CONTENT

</li>
CONTENT;

		return $return;
}

	function topContributorRows( $results, $timeframe, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $results ) ):
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT

		<ol class='ipsDataList ipsDataList_reducedSpacing cTopContributors'>
			
CONTENT;

$idx = 1;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $results as $memberId => $rep ):
$return .= <<<CONTENT

				
CONTENT;

$member = \IPS\Member::load( $memberId );
$return .= <<<CONTENT

				<li class='ipsDataItem'>
					<div class='ipsDataItem_icon ipsPos_middle ipsType_center ipsType_large ipsType_light'><strong>
CONTENT;

$return .= htmlspecialchars( $idx++, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong></div>
					<div class='ipsDataItem_main ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

						<div>
							{$member->link()}
							<br>
							
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ol>
		
CONTENT;

if ( \IPS\Settings::i()->reputation_leaderboard_on and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'discover' ) ) ):
$return .= <<<CONTENT

			<div class="ipsMargin_top:half">
				
CONTENT;

$_timeframe = $timeframe == 'all' ? 'time=oldest' : ( $timeframe == 'year' ? ( 'custom_date_start=' . ( time() - 31536000 ) ) : ( 'time=' . $timeframe ) );
$return .= <<<CONTENT

				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=discover&controller=popular&tab=leaderboard&{$_timeframe}", null, "leaderboard_leaderboard", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leaderboard_show_more', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<div class="ipsGrid ipsGrid_collapsePhone">
			
CONTENT;

$count = 0;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $results as $memberId => $rep ):
$return .= <<<CONTENT

				
CONTENT;

if ( $count == 4 ):
$return .= <<<CONTENT

					
CONTENT;

break;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					
CONTENT;

$count++;
$return .= <<<CONTENT

				
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

$member = \IPS\Member::load( $memberId );
$return .= <<<CONTENT

				<div class='ipsGrid_span3'>
					<div class='ipsPad_half ipsPhotoPanel ipsPhotoPanel_tiny'>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( $member, 'tiny' );
$return .= <<<CONTENT

						<div>
							<p class='ipsType_reset ipsTruncate ipsTruncate_line'>
								{$member->link()}
							</p>
							
CONTENT;

if ( \IPS\Member::loggedIn()->group['gbw_view_reps'] ):
$return .= <<<CONTENT

								<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=members&controller=profile&id={$member->member_id}&do=reputation", null, "profile_reputation", array( $member->members_seo_name ), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								<span title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'reputation_badge_tooltip_period', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip class='ipsRepBadge 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
ipsRepBadge_positive
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
ipsRepBadge_negative
CONTENT;

else:
$return .= <<<CONTENT
ipsRepBadge_neutral
CONTENT;

endif;
$return .= <<<CONTENT
'><i class='fa 
CONTENT;

if ( $rep > 0 ):
$return .= <<<CONTENT
fa-plus-circle
CONTENT;

elseif ( $rep < 0 ):
$return .= <<<CONTENT
fa-minus-circle
CONTENT;

else:
$return .= <<<CONTENT
fa-circle-o
CONTENT;

endif;
$return .= <<<CONTENT
'></i> 
CONTENT;

$return .= htmlspecialchars( \IPS\Member::loggedIn()->language()->formatNumber( $rep ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span>
							
CONTENT;

endif;
$return .= <<<CONTENT

						</div>
					</div>
				</div>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</div>
		
CONTENT;

if ( \IPS\Settings::i()->reputation_leaderboard_on and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'discover' ) ) ):
$return .= <<<CONTENT

			<div>
				
CONTENT;

$_timeframe = $timeframe == 'all' ? 'time=oldest' : ( $timeframe == 'year' ? ( 'custom_date_start=' . ( time() - 31536000 ) ) : ( 'time=' . $timeframe ) );
$return .= <<<CONTENT

				<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=discover&controller=popular&tab=leaderboard&{$_timeframe}", null, "leaderboard_leaderboard", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" class='ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'leaderboard_show_more', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<div class='ipsPad'>
		<p class='ipsType_reset'>
CONTENT;

$val = "top_contributors_empty__{$timeframe}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function topContributors( $topContributorsThisWeek, $limit, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_topContributors', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
<div class='ipsTabs ipsTabs_small ipsTabs_stretch ipsClearfix' id='elTopContributors' data-ipsTabBar data-ipsTabBar-updateURL='false' data-ipsTabBar-contentArea='#elTopContributors_content'>
	<a href='#elTopContributors' data-action='expandTabs'><i class='fa fa-caret-down'></i></a>
	<ul role="tablist" class='ipsList_reset'>
		<li>
			<a href='#ipsTabs_elTopContributors_el_topContributorsWeek_panel' id='el_topContributorsWeek' class='ipsTabs_item ipsTabs_activeItem' role="tab" aria-selected='true'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'week', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
		<li>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=topContributors&time=month&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='el_topContributorsMonth' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'month', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>		
		<li>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=topContributors&time=year&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='el_topContributorsYear' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'year', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
		<li>
			<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=topContributors&time=all&limit={$limit}&orientation={$orientation}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' id='el_topContributorsAll' class='ipsTabs_item' role="tab" aria-selected='false'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'alltime', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
		</li>
	</ul>
</div>

<section id='elTopContributors_content' class='ipsWidget_inner ipsPad_half'>
	<div id="ipsTabs_elTopContributors_el_topContributorsWeek_panel" class='ipsTabs_panel'>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "widgets", "core" )->topContributorRows( $topContributorsThisWeek, 'week', $orientation );
$return .= <<<CONTENT

	</div>
</section>
CONTENT;

		return $return;
}

	function twitter( $username, $locale, $style=NULL, $color=NULL ) {
		$return = '';
		$return .= <<<CONTENT


<div class='ipsPad_half'>
	<a class="twitter-timeline" data-lang="
CONTENT;
$return .= htmlspecialchars( $locale, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-height="500" 
CONTENT;

if ( $style ):
$return .= <<<CONTENT
data-theme="
CONTENT;
$return .= htmlspecialchars( $style, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( $color ):
$return .= <<<CONTENT
data-link-color="
CONTENT;
$return .= htmlspecialchars( $color, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 href="https://twitter.com/
CONTENT;
$return .= htmlspecialchars( $username, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
?ref_src=twsrc%5Etfw">Tweets by 
CONTENT;
$return .= htmlspecialchars( $username, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a> 		<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>
CONTENT;

		return $return;
}

	function whosOnline( $members, $memberCount, $guests, $anonymous, $orientation='vertical' ) {
		$return = '';
		$return .= <<<CONTENT

<h3 class='ipsType_reset ipsWidget_title'>
	
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whosOnline', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

	
CONTENT;

if ( $orientation == 'horizontal' ):
$return .= <<<CONTENT

		&nbsp;&nbsp;<span class='ipsType_light ipsType_unbold ipsType_medium'>
CONTENT;

$pluralize = array( $memberCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_members', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
, 
CONTENT;

$pluralize = array( $anonymous ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_anonymous', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
, 
CONTENT;

$pluralize = array( $guests ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'block_whos_online_info_guests', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<span class='ipsType_medium ipsType_light ipsType_unbold ipsType_blendLinks'><a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=online&controller=online", null, "online", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'see_full_list', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></span>
</h3>
<div class='ipsWidget_inner ipsPadding'>
	
CONTENT;

if ( $memberCount ):
$return .= <<<CONTENT

		<ul class='ipsList_inline ipsList_csv ipsList_noSpacing ipsType_normal'>
			
CONTENT;

foreach ( $members as $row ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userLinkFromData( $row['member_id'], $row['member_name'], $row['seo_name'], $row['member_group'], TRUE );
$return .= <<<CONTENT

CONTENT;

if ( \IPS\Member::loggedIn()->member_id AND \IPS\Member::loggedIn()->member_id === $row['member_id'] AND \IPS\Member::loggedIn()->isOnlineAnonymously() ):
$return .= <<<CONTENT

						<span title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signed_in_anoymously', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip>
							<i class='fa fa-eye-slash'></i>
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

if ( $orientation == 'vertical' and $memberCount > 60 ):
$return .= <<<CONTENT

			<p class='ipsType_medium ipsType_reset'>
				<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=online&controller=online", null, "online", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
'>
CONTENT;

$pluralize = array( $memberCount - 60 ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'and_x_others', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</a>
			</p>
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		<p class='ipsType_reset ipsType_medium ipsType_light'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'whos_online_users_empty', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}}