<?php
namespace IPS\Theme\Cache;
class class_core_global_global extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function advertisementImage( $advertisement, $acpLink=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $advertisement->_images ) ):
$return .= <<<CONTENT

<div class='ips
CONTENT;

$return .= htmlspecialchars( mb_ucfirst(\IPS\SUITE_UNIQUE_KEY), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 ipsSpacer_both ipsSpacer_half'>
	<ul class='ipsList_inline ipsType_center ipsList_reset ipsList_noSpacing'>
		
CONTENT;

$hmacKey = hash_hmac( "sha256", $advertisement->link, \IPS\Settings::i()->site_secret_key . 'a' );
$return .= <<<CONTENT

		<li class='ips
CONTENT;

$return .= htmlspecialchars( mb_ucfirst(\IPS\SUITE_UNIQUE_KEY), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_large ipsResponsive_showDesktop ipsResponsive_inlineBlock ipsAreaBackground_light'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				<a href='
CONTENT;

if ( $acpLink ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $acpLink, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=redirect&do=advertisement&ad={$advertisement->id}&key={$hmacKey}", "front", "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $advertisement->new_window ):
$return .= <<<CONTENT
target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
 rel='nofollow noopener'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<img src='
CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['large'] )->url;
$return .= <<<CONTENT
' alt="
CONTENT;

if ( $advertisement->image_alt ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $advertisement->image_alt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advertisement_alt', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" class='ipsImage ipsContained'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>
		
CONTENT;

if ( !$acpLink  ):
$return .= <<<CONTENT

		<li class='ips
CONTENT;

$return .= htmlspecialchars( mb_ucfirst(\IPS\SUITE_UNIQUE_KEY), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_medium ipsResponsive_showTablet ipsResponsive_inlineBlock ipsAreaBackground_light'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				<a href='
CONTENT;

if ( $acpLink ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $acpLink, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=redirect&do=advertisement&ad={$advertisement->id}&key={$hmacKey}", "front", "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $advertisement->new_window ):
$return .= <<<CONTENT
target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
 rel='nofollow noopener'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<img src='
CONTENT;

if ( !empty( $advertisement->_images['medium'] ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['medium'] )->url;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['large'] )->url;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' alt="
CONTENT;

if ( $advertisement->image_alt ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $advertisement->image_alt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advertisement_alt', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" class='ipsImage ipsContained'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				</a>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</li>

		<li class='ips
CONTENT;

$return .= htmlspecialchars( mb_ucfirst(\IPS\SUITE_UNIQUE_KEY), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_small ipsResponsive_showPhone ipsResponsive_inlineBlock ipsAreaBackground_light'>
			
CONTENT;

if ( $advertisement->link ):
$return .= <<<CONTENT

				<a href='
CONTENT;

if ( $acpLink ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $acpLink, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=redirect&do=advertisement&ad={$advertisement->id}&key={$hmacKey}", "front", "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $advertisement->new_window ):
$return .= <<<CONTENT
target='_blank'
CONTENT;

endif;
$return .= <<<CONTENT
 rel='nofollow noopener'>
			
CONTENT;

endif;
$return .= <<<CONTENT

				<img src='
CONTENT;

if ( !empty( $advertisement->_images['small'] ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['small'] )->url;
$return .= <<<CONTENT

CONTENT;

elseif ( !empty( $advertisement->_images['medium'] ) ):
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['medium'] )->url;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\File::get( $advertisement->storageExtension(), $advertisement->_images['large'] )->url;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' alt="
CONTENT;

if ( $advertisement->image_alt ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $advertisement->image_alt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'advertisement_alt', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" class='ipsImage ipsContained'>
			
CONTENT;

if ( $advertisement->link ):
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

if ( $acpLink ):
$return .= <<<CONTENT

		<div class="ipsType_center ipsType_small"><a href="
CONTENT;
$return .= htmlspecialchars( $acpLink, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" rel="noreferrer">
CONTENT;
$return .= htmlspecialchars( $acpLink, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></div>
	
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

	function applePieChart( $segments, $sorted=TRUE, $classes='' ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \count( $segments ) ):
$return .= <<<CONTENT

    <div class='ipsPieBar 
CONTENT;
$return .= htmlspecialchars( $classes, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
        <div class='ipsPieBar__bar'>
            
CONTENT;

foreach ( $segments as $segment ):
$return .= <<<CONTENT

                <div class='ipsPieBar__barSegment' style='width: 
CONTENT;

$return .= htmlspecialchars( number_format( $segment['percentage'], 2, '.', '' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
%' 
                    
CONTENT;

if ( !empty( $segment['title'] ) || !empty( $segment['tooltip'] ) ):
$return .= <<<CONTENT

                        
CONTENT;

if ( !empty( $segment['title'] ) ):
$return .= <<<CONTENT
title="
CONTENT;
$return .= htmlspecialchars( $segment['title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 
CONTENT;

if ( !empty( $segment['tooltip'] ) ):
$return .= <<<CONTENT
data-ipsTooltip data-ipsTooltip-label="
CONTENT;
$return .= htmlspecialchars( $segment['tooltip'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( !empty( $segment['tooltipSafe'] ) ):
$return .= <<<CONTENT
data-ipsTooltip-safe
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

                    
CONTENT;

else:
$return .= <<<CONTENT

                        title="
CONTENT;
$return .= htmlspecialchars( $segment['value'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 (
CONTENT;
$return .= htmlspecialchars( $segment['percentage'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
%)"
                        data-ipsTooltip
                    
CONTENT;

endif;
$return .= <<<CONTENT

                ></div>
            
CONTENT;

endforeach;
$return .= <<<CONTENT

        </div>
        <ul class='ipsList_inline ipsPieBar__legend'>
            
CONTENT;

foreach ( $segments as $segment ):
$return .= <<<CONTENT

                <li class='ipsPieBar__legendItem'>
                    <span class='ipsPieBar__legendItemKey'></span>
                    
CONTENT;

if ( isset( $segment['nameRaw'] ) ):
$return .= <<<CONTENT
{$segment['nameRaw']}
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $segment['name'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

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

else:
$return .= <<<CONTENT

    <p class='ipsType_light ipsType_center'>
        
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_data', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

    </p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function badge( $badge, $cssClass = NULL, $tooltip = TRUE, $showRare = FALSE ) {
		$return = '';
		$return .= <<<CONTENT


<span class='ipsPos_relative'>
    <img src='
CONTENT;

$return .= \IPS\File::get( "core_Badges", $badge->image )->url;
$return .= <<<CONTENT
' loading="lazy" alt="
CONTENT;
$return .= htmlspecialchars( $badge->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class='ipsOutline 
CONTENT;
$return .= htmlspecialchars( $cssClass, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $tooltip ):
$return .= <<<CONTENT
data-ipsTooltip title='
CONTENT;
$return .= htmlspecialchars( $badge->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
    
CONTENT;

if ( $showRare && $badge->isRare() ):
$return .= <<<CONTENT

        <span class='ipsBadge ipsBadge_small ipsBadge_rare'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'rare_badge', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
    
CONTENT;

endif;
$return .= <<<CONTENT

</span>
CONTENT;

		return $return;
}

	function basicHover( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad">

CONTENT;
$return .= htmlspecialchars( $message, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function basicUrl( $url, $newWindow=TRUE, $title=NULL, $wordbreak=TRUE, $nofollow=FALSE, $noreferrer=FALSE, $titleRaw = FALSE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $wordbreak ):
$return .= <<<CONTENT
<div class='ipsType_break ipsContained'>
CONTENT;

endif;
$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $newWindow === TRUE ):
$return .= <<<CONTENT
 target='_blank' 
CONTENT;

if ( $nofollow === FALSE ):
$return .= <<<CONTENT
rel="
CONTENT;

if ( $noreferrer ):
$return .= <<<CONTENT
noreferrer
CONTENT;

else:
$return .= <<<CONTENT
noopener
CONTENT;

endif;
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

if ( $nofollow === TRUE ):
$return .= <<<CONTENT
 rel="nofollow
CONTENT;

if ( $newWindow === TRUE ):
$return .= <<<CONTENT
 
CONTENT;

if ( $noreferrer ):
$return .= <<<CONTENT
noreferrer
CONTENT;

else:
$return .= <<<CONTENT
noopener
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

if ( $title ):
$return .= <<<CONTENT

		
CONTENT;

if ( $titleRaw ):
$return .= <<<CONTENT

			 {$title}
		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

	
CONTENT;

endif;
$return .= <<<CONTENT

</a>

CONTENT;

if ( $wordbreak ):
$return .= <<<CONTENT
</div>
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function chart( $chart, $type, $options, $format=NULL ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( isset( $chart->errors ) AND \count( $chart->errors ) ):
$return .= <<<CONTENT

	<div class='ipsMessage ipsMessage_error'>
		
CONTENT;

foreach ( $chart->errors as $error ):
$return .= <<<CONTENT

			
CONTENT;

if ( isset($error['sprintf']) ):
$return .= <<<CONTENT

				
CONTENT;

$val = "{$error['string']}"; $sprintf = array($error['sprintf']); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				
CONTENT;

$val = "{$error['string']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

<table class="ipsTable" data-ipsChart data-ipsChart-type="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsChart-extraOptions='{$options}' 
CONTENT;

if ( $format ):
$return .= <<<CONTENT
data-ipsChart-format='
CONTENT;
$return .= htmlspecialchars( $format, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
	<thead>
		<tr>
			
CONTENT;

foreach ( $chart->headers as $data ):
$return .= <<<CONTENT

				<th data-colType="
CONTENT;
$return .= htmlspecialchars( $data['type'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $data['label'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</th>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</tr>
	</thead>
	<tbody>
		
CONTENT;

foreach ( $chart->rows as $row ):
$return .= <<<CONTENT

			<tr>
				
CONTENT;

foreach ( $row as $value ):
$return .= <<<CONTENT

					<td 
CONTENT;

if ( \is_array( $value ) ):
$return .= <<<CONTENT
data-key="
CONTENT;
$return .= htmlspecialchars( $value['key'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

if ( \is_array( $value ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value['value'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
</td>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</tr>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</tbody>
</table>
<div></div>
CONTENT;

		return $return;
}

	function chartTimezoneInfo( $mysqlTimezone ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsPad">
	
CONTENT;

$sprintf = array($mysqlTimezone); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dynamic_chart_timezone_explain', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

</div>
CONTENT;

		return $return;
}

	function dynamicChart( $chart, $html ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsChart' data-controller='core.admin.core.dynamicChart' data-chart-url='
CONTENT;
$return .= htmlspecialchars( $chart->baseURL, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-chart-identifier='
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-chart-type="
CONTENT;
$return .= htmlspecialchars( $chart->type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-chart-timescale="
CONTENT;
$return .= htmlspecialchars( $chart->timescale, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-chart-customfilter-submitted='
CONTENT;

if ( isset( \IPS\Request::i()->filter_form_submitted ) ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div class='ipsPad ipsAreaBackground_light ipsClearfix ipsChart_filters'>
		
CONTENT;

if ( ( \IPS\Request::i()->chartId AND \IPS\Request::i()->chartId != '_default' ) OR $chart->title ):
$return .= <<<CONTENT

			<div class='ipsClearfix ipsSpacer_bottom ipsSpacer_half'>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $chart->form AND \IPS\Request::i()->chartId AND \IPS\Request::i()->chartId != '_default' ):
$return .= <<<CONTENT

			<a data-confirm href='
CONTENT;
$return .= htmlspecialchars( $chart->baseURL->setQueryString( array( 'deleteChart' => \IPS\Request::i()->chartId ) )->csrf() , ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class='ipsPos_right ipsButton_veryVerySmall ipsButton ipsButton_negative'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
			<button data-role="renameChart" class='ipsPos_right ipsButton_veryVerySmall ipsButton ipsButton_neutral' data-ipsMenu data-ipsMenu-closeOnClick='false' id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
FilterRename'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stream_rename', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
			<ul id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
FilterRename_menu' class='ipsMenu ipsMenu_auto ipsHide' data-role="filterRenameMenu">
				<li class='ipsMenu_item'>{$chart->form->customTemplate( array( \IPS\Theme::i()->getTemplate( 'forms', 'core', 'front' ), 'popupTemplate' ) )}</li>
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( $chart->title ):
$return .= <<<CONTENT

			<h2 class='ipsType_sectionHead'>
CONTENT;
$return .= htmlspecialchars( $chart->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h2>
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( ( \IPS\Request::i()->chartId AND \IPS\Request::i()->chartId != '_default' ) OR $chart->title ):
$return .= <<<CONTENT

			</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<ul class='ipsList_inline'>
			
CONTENT;

if ( $chart->showIntervals ):
$return .= <<<CONTENT

				<li data-role="groupingButtons">
					<span class="ipsButton_split ipsClearfix">
						
CONTENT;

if ( $chart->enableHourly ):
$return .= <<<CONTENT

							<a class='ipsButton ipsButton_verySmall 
CONTENT;

if ( $chart->type == 'Table' ):
$return .= <<<CONTENT
ipsButton_disabled ipsButton_veryLight
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $chart->timescale == 'hourly' ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_veryLight
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' href="
CONTENT;
$return .= htmlspecialchars( $chart->url->setQueryString( array( 'timescale' => array( $chart->identifier => 'hourly' ), 'noheader' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-timescale="hourly" 
CONTENT;

if ( $chart->timescale == 'hourly' ):
$return .= <<<CONTENT
data-selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_date_group_hourly', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

foreach ( array( 'daily', 'weekly', 'monthly' ) as $k ):
$return .= <<<CONTENT

							<a class='ipsButton ipsButton_verySmall 
CONTENT;

if ( $chart->type == 'Table' ):
$return .= <<<CONTENT
ipsButton_disabled ipsButton_veryLight
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

if ( $chart->timescale == $k ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_veryLight
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' href="
CONTENT;
$return .= htmlspecialchars( $chart->url->setQueryString( array( 'timescale' => array( $chart->identifier => $k ), 'noheader' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-timescale="
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( $chart->timescale == $k ):
$return .= <<<CONTENT
data-selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$val = "stats_date_group_$k"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

					</span>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class="ipsClearfix">
				<a data-action='chartDate' data-ipsMenu data-ipsMenu-closeOnBlur='false' data-ipsMenu-closeOnClick='false' id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
Date' href="#" class="ipsButton ipsButton_verySmall ipsButton_veryLight"><i class='fa fa-calendar'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_date_range', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <span data-role='dateSummary' class='ipsType_light'>
CONTENT;

if ( $chart->start AND $chart->end ):
$return .= <<<CONTENT
(
CONTENT;

$sprintf = array($chart->start->localeDate(), $chart->end->localeDate()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_betweenXandX', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
)
CONTENT;

elseif ( $chart->start ):
$return .= <<<CONTENT
(
CONTENT;

$sprintf = array($chart->start->localeDate()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_afterX', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
)
CONTENT;

elseif ( $chart->end ):
$return .= <<<CONTENT
(
CONTENT;

$sprintf = array($chart->end->localeDate()); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_beforeX', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
)
CONTENT;

endif;
$return .= <<<CONTENT
</span> <i class='fa fa-caret-down'></i></a>
				<div id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
Date_menu' class='ipsMenu ipsMenu_normal ipsHide ipsPad'>
					<form accept-charset='utf-8' action="
CONTENT;
$return .= htmlspecialchars( $chart->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-role="dateForm" data-ipsForm>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->date( 'start', $chart->start ?: NULL, FALSE, NULL, NULL, FALSE, FALSE, NULL, NULL, NULL, array(), TRUE, 'ipsField_fullWidth', \IPS\Member::loggedIn()->language()->addToStack('stats_start_date') );
$return .= <<<CONTENT

						<br><br>
						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->date( 'end', $chart->end ?: NULL, FALSE, NULL, NULL, FALSE, FALSE, NULL, NULL, NULL, array(), TRUE, 'ipsField_fullWidth', \IPS\Member::loggedIn()->language()->addToStack('stats_end_date') );
$return .= <<<CONTENT

						<br><br>
						<button type="submit" class="ipsButton ipsButton_primary ipsButton_fullWidth" data-role="updateDate">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
					</form>
				</div>
			</li>
			
CONTENT;

if ( ! $chart->customFiltersForm and \count( $chart->availableFilters ) > 0 ):
$return .= <<<CONTENT

				<li>
					<a data-action="chartFilter" data-ipsMenu data-ipsMenu-selectable data-ipsMenu-closeOnClick='false' id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
Filter' href="#" class="ipsButton ipsButton_verySmall ipsButton_veryLight"><i class='fa fa-filter'></i> &nbsp;
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_chart_filters', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class='fa fa-caret-down'></i></a>
					<ul id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
Filter_menu' class='ipsMenu ipsMenu_selectable ipsMenu_auto ipsHide' data-role='filterMenu'>
						<li class='ipsMenu_item ipsMenu_itemNonSelect ipsType_center' data-noselect>
							<span>
								<a href='#' data-role='selectAll' class='ipsMenu_itemInline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
								<a href='#' data-role='unselectAll' class='ipsMenu_itemInline'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</span>
						</li>
						
CONTENT;

foreach ( $chart->availableFilters as $f => $name ):
$return .= <<<CONTENT

							<li class='ipsMenu_item 
CONTENT;

if ( \in_array( $f, $chart->currentFilters ) ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
' data-ipsMenuValue='
CONTENT;
$return .= htmlspecialchars( $f, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $chart->flipUrlFilter( $f ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

if ( \is_array( $name ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $name['value'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
</a></li>
						
CONTENT;

endforeach;
$return .= <<<CONTENT

						<li class='ipsMenu_item ipsMenu_itemNonSelect' data-noselect>
							<span>
								<button disabled class='ipsMenu_itemInline ipsButton ipsButton_small ipsButton_primary ipsButton_fullWidth' data-role="applyFilters">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'apply_filters', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
							</span>
						</li>
					</ul>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $chart->customFiltersForm ):
$return .= <<<CONTENT

                
CONTENT;

$customFilterFormTitle = $chart->customFiltersForm['title'] ?? 'chart_customfilters_title';
$return .= <<<CONTENT

				<li>
					<a href="#elCustomFiltersForm" class="ipsButton ipsButton_verySmall ipsButton_veryLight" data-ipsDialog data-ipsDialog-size="narrow" data-ipsDialog-title="
CONTENT;

$val = "{$customFilterFormTitle}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsDialog-content="#el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
CustomFiltersForm"><i class='fa fa-bar-chart'></i> &nbsp;
CONTENT;

$val = "{$customFilterFormTitle}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					<div id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
CustomFiltersForm' class='ipsAreaBackground_light ipsPad ipsJS_hide'>
						{$chart->getCustomFiltersForm()->customTemplate( array( \IPS\Theme::i()->getTemplate( 'forms', 'core', 'front' ), 'popupTemplate' ) )}
					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( isset( $chart->options['limitSearch'] ) ):
$return .= <<<CONTENT

				<li class="ipsClearfix">
					<a data-action='chartSearch' data-ipsMenu data-ipsMenu-closeOnBlur='false' data-ipsMenu-closeOnClick='false' id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
Search' href="#" class="ipsButton ipsButton_verySmall ipsButton_veryLight">
CONTENT;

$val = "{$chart->options['limitSearch']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <span data-role='searchSummary' class='ipsType_light'></span> <i class='fa fa-caret-down'></i></a>
					<div id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
Search_menu' class='ipsMenu ipsMenu_normal ipsHide ipsPad'>
						<form accept-charset='utf-8' action="
CONTENT;
$return .= htmlspecialchars( $chart->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" method="post" data-role="searchForm" data-ipsForm>
							
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->text( 'search', 'text', NULL, FALSE );
$return .= <<<CONTENT

							<br><br>
							<button type="submit" class="ipsButton ipsButton_primary ipsButton_fullWidth" data-role="updateSearch">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'submit', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
							<button type="submit" value='reset' class="ipsButton ipsButton_light ipsButton_fullWidth ipsSpacer_top ipsSpacer_half" data-role="clearSearchTerm">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'stats_search_reset', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
						</form>
					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $chart->customFiltersForm or \count( $chart->availableFilters ) > 0 ):
$return .= <<<CONTENT

				<li>
					<button class='ipsButton ipsButton_verySmall ipsButton_important ipsHide' data-role='saveReport' 
CONTENT;

if ( !\IPS\Request::i()->chartId OR \IPS\Request::i()->chartId == '_default' ):
$return .= <<<CONTENT
data-ipsMenu data-ipsMenu-closeOnClick='false'
CONTENT;

else:
$return .= <<<CONTENT
data-chartId='
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->chartId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
FilterSave'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
					
CONTENT;

if ( !\IPS\Request::i()->chartId OR \IPS\Request::i()->chartId == '_default' ):
$return .= <<<CONTENT

						<ul id='el
CONTENT;
$return .= htmlspecialchars( $chart->identifier, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
FilterSave_menu' class='ipsMenu ipsMenu_auto ipsHide' data-role='filterSaveMenu'>
							<li class='ipsMenu_item'>{$chart->form->customTemplate( array( \IPS\Theme::i()->getTemplate( 'forms', 'core', 'front' ), 'popupTemplate' ) )}</li>
						</ul>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \count( $chart->availableTypes ) > 1 || $chart instanceof \IPS\Helpers\Chart\Dynamic ):
$return .= <<<CONTENT

				<li class='ipsPos_right ipsType_noBreak'>
					
CONTENT;

if ( $chart instanceof \IPS\Helpers\Chart\Dynamic ):
$return .= <<<CONTENT

						&nbsp;&nbsp;<a class='ipsButton ipsButton_veryLight ipsButton_verySmall' href='
CONTENT;
$return .= htmlspecialchars( $chart->url->setQueryString(array( "download" => 1 ))->csrf() , ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'download_as_csv', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-role='downloadChart'><i class="fa fa-download"></i> &nbsp;CSV</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( \count( $chart->availableTypes ) > 1 ):
$return .= <<<CONTENT

						<span class="ipsButton_split ipsClearfix">
							
CONTENT;

foreach ( $chart->availableTypes as $t ):
$return .= <<<CONTENT

								<a class='ipsButton ipsButton_verySmall 
CONTENT;

if ( $chart->type == $t ):
$return .= <<<CONTENT
ipsButton_primary
CONTENT;

else:
$return .= <<<CONTENT
ipsButton_veryLight
CONTENT;

endif;
$return .= <<<CONTENT
' href="
CONTENT;
$return .= htmlspecialchars( $chart->url->setQueryString( array( 'type' => array( $chart->identifier => $t ), 'noheader' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTooltip title='
CONTENT;

$val = "chart_{$t}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-type='
CONTENT;
$return .= htmlspecialchars( $t, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $chart->type == $t ):
$return .= <<<CONTENT
data-selected
CONTENT;

endif;
$return .= <<<CONTENT
>
									
CONTENT;

if ( $t === 'Table' ):
$return .= <<<CONTENT

										<i class="fa fa-table"></i>
									
CONTENT;

elseif ( $t === 'LineChart' ):
$return .= <<<CONTENT

										<i class="fa fa-line-chart"></i>
									
CONTENT;

elseif ( $t == 'AreaChart' ):
$return .= <<<CONTENT

										<i class='fa fa-area-chart'></i>
									
CONTENT;

elseif ( $t === 'ColumnChart' ):
$return .= <<<CONTENT

										<i class="fa fa-bar-chart"></i>
									
CONTENT;

elseif ( $t === 'BarChart' ):
$return .= <<<CONTENT

										<i class="fa fa-bar-chart fa-rotate-90"></i>
									
CONTENT;

elseif ( $t === 'PieChart' ):
$return .= <<<CONTENT

										<i class="fa fa-pie-chart"></i>
									
CONTENT;

elseif ( $t === 'GeoChart' ):
$return .= <<<CONTENT

										<i class="fa fa-globe"></i>
									
CONTENT;

endif;
$return .= <<<CONTENT

								</a>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						</span>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		</ul>
		
	</div>
	<div class='ipsChart_chart ipsPad' data-role="chart">
		{$html}
	</div>
</div>

CONTENT;

if ( $chart->timezoneError and \IPS\Member::loggedIn()->isAdmin() ):
$return .= <<<CONTENT

	<p class="ipsType_small ipsType_light ipsPad ipsPad_half"><i class="fa fa-info-circle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dynamic_chart_timezone_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( $chart->hideTimezoneLink === FALSE ):
$return .= <<<CONTENT
 <a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=ajax&do=chartTimezones", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
" data-ipsDialog data-ipsDialog-title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'dynamic_chart_timezone_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'learn_more', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT
</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function includeCSS(  ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( ( \IPS\Theme::i()->settings['headline_font'] && \IPS\Theme::i()->settings['headline_font'] !== 'default' ) || ( \IPS\Theme::i()->settings['body_font'] && \IPS\Theme::i()->settings['body_font'] !== 'default' )  ):
$return .= <<<CONTENT

	
CONTENT;

if ( \IPS\Theme::i()->settings['headline_font'] == \IPS\Theme::i()->settings['body_font'] ):
$return .= <<<CONTENT

		<link href="https://fonts.googleapis.com/css?family=
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::encodeComponent( \IPS\Http\Url::COMPONENT_FRAGMENT, \IPS\Theme::i()->settings['body_font'] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
:300,300i,400,400i,500,700,700i" rel="stylesheet" referrerpolicy="origin">
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( ( \IPS\Theme::i()->settings['headline_font'] && \IPS\Theme::i()->settings['headline_font'] !== 'default' ) ):
$return .= <<<CONTENT

			<link href="https://fonts.googleapis.com/css?family=
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::encodeComponent( \IPS\Http\Url::COMPONENT_FRAGMENT, \IPS\Theme::i()->settings['headline_font'] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
:300,300i,400,500,400i,700,700i" rel="stylesheet" referrerpolicy="origin">
		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( ( \IPS\Theme::i()->settings['body_font'] && \IPS\Theme::i()->settings['body_font'] !== 'default' ) ):
$return .= <<<CONTENT

			<link href="https://fonts.googleapis.com/css?family=
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::encodeComponent( \IPS\Http\Url::COMPONENT_FRAGMENT, \IPS\Theme::i()->settings['body_font'] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
:300,300i,400,400i,500,700,700i" rel="stylesheet" referrerpolicy="origin">
		
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

foreach ( array_unique( \IPS\Output::i()->cssFiles, SORT_STRING ) as $file ):
$return .= <<<CONTENT

	<link rel='stylesheet' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::external( $file )->setQueryString( 'v', \IPS\Theme::i()->cssCacheBustKey() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' media='all'>

CONTENT;

endforeach;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'front' ):
$return .= <<<CONTENT


CONTENT;

$customCss = \IPS\Theme::i()->css( 'custom.css', 'core', 'front' );
$return .= <<<CONTENT


CONTENT;

foreach ( $customCss as $css ):
$return .= <<<CONTENT

<link rel='stylesheet' href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::external( $css )->setQueryString( 'v', \IPS\Theme::i()->cssCacheBustKey() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' media='all'>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \IPS\Output::i()->headCss ):
$return .= <<<CONTENT

<style type='text/css'>
	
CONTENT;

$return .= \IPS\Output::i()->headCss;
$return .= <<<CONTENT

</style>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function includeJS(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	
CONTENT;

$maxImageDims = \IPS\Settings::i()->attachment_image_size ? explode( 'x', \IPS\Settings::i()->attachment_image_size ) : array( 1000, 750 );
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
	
CONTENT;

if ( \IPS\IN_DEV ):
$return .= <<<CONTENT

		var CKEDITOR_BASEPATH = '
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "applications/core/dev/ckeditor", "none", "", array(), \IPS\Http\Url::PROTOCOL_RELATIVE ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
/';
	
CONTENT;

else:
$return .= <<<CONTENT

		var CKEDITOR_BASEPATH = '
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "applications/core/interface/ckeditor/ckeditor", "none", "", array(), \IPS\Http\Url::PROTOCOL_RELATIVE ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
/';
	
CONTENT;

endif;
$return .= <<<CONTENT

		var ipsSettings = {
			
CONTENT;

if ( \IPS\Dispatcher::hasInstance() and \IPS\Dispatcher::i()->controllerLocation == 'admin' ):
$return .= <<<CONTENT

			isAcp: true,
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( \IPS\COOKIE_DOMAIN !== NULL ):
$return .= <<<CONTENT

			cookie_domain: "
CONTENT;

$return .= htmlspecialchars( \IPS\COOKIE_DOMAIN, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			
CONTENT;

endif;
$return .= <<<CONTENT

			cookie_path: "
CONTENT;

$return .= htmlspecialchars( \IPS\Request::getCookiePath(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			
CONTENT;

if ( \IPS\COOKIE_PREFIX !== NULL ):
$return .= <<<CONTENT

			cookie_prefix: "
CONTENT;

$return .= htmlspecialchars( \IPS\COOKIE_PREFIX, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( mb_substr( \IPS\Settings::i()->base_url, 0, 5 ) == 'https' AND \IPS\COOKIE_BYPASS_SSLONLY !== TRUE ):
$return .= <<<CONTENT

			cookie_ssl: true,
			
CONTENT;

else:
$return .= <<<CONTENT

			cookie_ssl: false,
			
CONTENT;

endif;
$return .= <<<CONTENT

			upload_imgURL: "
CONTENT;

$return .= \IPS\Theme::i()->resource( "notifyIcons/upload.png", "", 'front', false );
$return .= <<<CONTENT
",
			message_imgURL: "
CONTENT;

$return .= \IPS\Theme::i()->resource( "notifyIcons/message.png", "", 'front', false );
$return .= <<<CONTENT
",
			notification_imgURL: "
CONTENT;

$return .= \IPS\Theme::i()->resource( "notifyIcons/notification.png", "", 'front', false );
$return .= <<<CONTENT
",
			baseURL: "
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::baseUrl( \IPS\Http\Url::PROTOCOL_RELATIVE ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			jsURL: "
CONTENT;

$return .= htmlspecialchars( rtrim( \IPS\Http\Url::baseUrl( \IPS\Http\Url::PROTOCOL_RELATIVE ), '/' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
/applications/core/interface/js/js.php",
			csrfKey: "
CONTENT;

$return .= htmlspecialchars( \IPS\Session::i()->csrfKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			antiCache: "
CONTENT;

$return .= htmlspecialchars( \IPS\Theme::i()->cssCacheBustKey(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			jsAntiCache: "
CONTENT;

$return .= htmlspecialchars( \IPS\Output\Javascript::javascriptCacheBustKey(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			disableNotificationSounds: true,
			useCompiledFiles: 
CONTENT;

if ( \IPS\IN_DEV ):
$return .= <<<CONTENT
false
CONTENT;

else:
$return .= <<<CONTENT
true
CONTENT;

endif;
$return .= <<<CONTENT
,
			links_external: 
CONTENT;

if ( \IPS\Settings::i()->links_external  ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
,
			memberID: 
CONTENT;

$return .= htmlspecialchars( ( \IPS\Member::loggedIn()->member_id ) ? \IPS\Member::loggedIn()->member_id : 0, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
,
			lazyLoadEnabled: 
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
,
			blankImg: "
CONTENT;

$return .= htmlspecialchars( \IPS\Text\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
",
			googleAnalyticsEnabled: 
CONTENT;

if ( \IPS\Settings::i()->ga_enabled  ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
,
			matomoEnabled: 
CONTENT;

if ( \IPS\Settings::i()->matomo_enabled  ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
,
			viewProfiles: 
CONTENT;

if ( \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ) ) ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
,
			mapProvider: 
CONTENT;

if ( \IPS\Settings::i()->googlemaps and \IPS\Settings::i()->google_maps_api_key ):
$return .= <<<CONTENT
'google'
CONTENT;

elseif ( \IPS\Settings::i()->mapbox and \IPS\Settings::i()->mapbox_api_key ):
$return .= <<<CONTENT
'mapbox'
CONTENT;

else:
$return .= <<<CONTENT
'none'
CONTENT;

endif;
$return .= <<<CONTENT
,
			mapApiKey: 
CONTENT;

if ( \IPS\Settings::i()->googlemaps and \IPS\Settings::i()->google_maps_api_key ):
$return .= <<<CONTENT
"
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->google_maps_api_key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

elseif ( \IPS\Settings::i()->mapbox and \IPS\Settings::i()->mapbox_api_key ):
$return .= <<<CONTENT
"
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->mapbox_api_key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

else:
$return .= <<<CONTENT
''
CONTENT;

endif;
$return .= <<<CONTENT
,
			pushPublicKey: 
CONTENT;

if ( \IPS\Notification::webPushEnabled() ):
$return .= <<<CONTENT
"
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->vapid_public_key, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

else:
$return .= <<<CONTENT
null
CONTENT;

endif;
$return .= <<<CONTENT
,
			relativeDates: 
CONTENT;

if ( \IPS\Settings::i()->relative_dates_enable ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT

		};
		
		
CONTENT;

if ( \IPS\Settings::i()->custom_page_view_js && \IPS\Dispatcher::hasInstance() && \IPS\Dispatcher::i()->controllerLocation == 'front' ):
$return .= <<<CONTENT

			ipsSettings['paginateCode'] = 
CONTENT;

$return .= \IPS\Settings::i()->custom_page_view_js;
$return .= <<<CONTENT
;
		
CONTENT;

endif;
$return .= <<<CONTENT

		
		
CONTENT;

if ( !empty( $maxImageDims[0] ) AND !empty( $maxImageDims[1] ) AND ( \intval( $maxImageDims[0] ) !== 0 || \intval( $maxImageDims[1] ) !== 0 )  ):
$return .= <<<CONTENT

			ipsSettings['maxImageDimensions'] = {
				width: 
CONTENT;
$return .= htmlspecialchars( $maxImageDims[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
,
				height: 
CONTENT;
$return .= htmlspecialchars( $maxImageDims[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

			};
		
CONTENT;

endif;
$return .= <<<CONTENT

		
	</script>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() and \IPS\Dispatcher::hasInstance() and \IPS\Dispatcher::i()->controllerLocation == 'front' and \IPS\Settings::i()->fb_pixel_enabled and \IPS\Settings::i()->fb_pixel_id ):
$return .= <<<CONTENT


CONTENT;

$pixelId = \IPS\Settings::i()->fb_pixel_id;
$return .= <<<CONTENT

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
setTimeout( function() {
	fbq('init', '
CONTENT;
$return .= htmlspecialchars( $pixelId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
');
	
CONTENT;

if ( $pixels = \IPS\core\Facebook\Pixel::i()->output() ):
$return .= <<<CONTENT

	{$pixels}
	
CONTENT;

endif;
$return .= <<<CONTENT

}, 
CONTENT;

$return .= htmlspecialchars( \intval( \IPS\Settings::i()->fb_pixel_delay * 1000 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 );
</script>
<!-- End Facebook Pixel Code -->

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

foreach ( array_unique( array_filter( \IPS\Output::i()->jsFiles ), SORT_STRING ) as $js ):
$return .= <<<CONTENT


CONTENT;

$js = \IPS\Http\Url::external( $js );
$return .= <<<CONTENT

<script type='text/javascript' src='
CONTENT;

if ( $js->data['host'] == parse_url( \IPS\Settings::i()->base_url, PHP_URL_HOST ) ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( $js->setQueryString( 'v', \IPS\Output\Javascript::javascriptCacheBustKey() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( $js, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' data-ips></script>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

foreach ( array_unique( \IPS\Output::i()->jsFilesAsync, SORT_STRING ) as $js ):
$return .= <<<CONTENT

<script type="text/javascript" src="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::external( $js )->setQueryString( 'v', \IPS\Output\Javascript::javascriptCacheBustKey() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" async></script>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() and ( \count( \IPS\Output::i()->jsVars ) || \IPS\Output::i()->headJs) ):
$return .= <<<CONTENT

	<script type='text/javascript'>
		
CONTENT;

foreach ( \IPS\Output::i()->jsVars as $k => $v ):
$return .= <<<CONTENT

			ips.setSetting( '
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
', 
CONTENT;

if ( ! \is_array( $v ) ):
$return .= <<<CONTENT
jQuery.parseJSON('
CONTENT;

$return .= json_encode( $v, JSON_HEX_APOS );
$return .= <<<CONTENT
')
CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= json_encode( $v, JSON_HEX_APOS );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
 );
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Output::i()->headJs;
$return .= <<<CONTENT

	</script>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \count( \IPS\Output::i()->jsonLd ) ):
$return .= <<<CONTENT


CONTENT;

foreach ( \IPS\Output::i()->jsonLd as $object ):
$return .= <<<CONTENT

<script type='application/ld+json'>

CONTENT;

$return .= json_encode( $object, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS );
$return .= <<<CONTENT
	
</script>

CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function includeMeta(  ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \IPS\Theme::i()->settings['responsive'] ):
$return .= <<<CONTENT

	<meta name="viewport" content="width=device-width, initial-scale=1">

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( !isset( \IPS\Output::i()->metaTags['og:image'] ) ):
$return .= <<<CONTENT

	
CONTENT;

$shareLogos = \IPS\Settings::i()->icons_sharer_logo ? json_decode( \IPS\Settings::i()->icons_sharer_logo, true ) : array();
$return .= <<<CONTENT

	
CONTENT;

foreach ( $shareLogos as $logo ):
$return .= <<<CONTENT

		<meta property="og:image" content="
CONTENT;

$return .= \IPS\File::get( "core_Icons", $logo )->url->setScheme("https");
$return .= <<<CONTENT
">
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( !isset( \IPS\Output::i()->metaTags['og:image'] ) and !\count( $shareLogos )  ):
$return .= <<<CONTENT

	<meta name="twitter:card" content="summary" />

CONTENT;

else:
$return .= <<<CONTENT

	<meta name="twitter:card" content="summary_large_image" />

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->site_twitter_id ):
$return .= <<<CONTENT

	
CONTENT;

if ( mb_substr( \IPS\Settings::i()->site_twitter_id, 0, 1 ) === '@' ):
$return .= <<<CONTENT

		<meta name="twitter:site" content="
CONTENT;

$return .= \IPS\Settings::i()->site_twitter_id;
$return .= <<<CONTENT
" />
	
CONTENT;

else:
$return .= <<<CONTENT

		<meta name="twitter:site" content="@
CONTENT;

$return .= \IPS\Settings::i()->site_twitter_id;
$return .= <<<CONTENT
" />
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

foreach ( \IPS\Output::i()->metaTags as $name => $content ):
$return .= <<<CONTENT

	
CONTENT;

if ( $name == 'canonical' ):
$return .= <<<CONTENT

		<link rel="canonical" href="
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	
CONTENT;

else:
$return .= <<<CONTENT

		
CONTENT;

if ( $name != 'title' ):
$return .= <<<CONTENT

			
CONTENT;

if ( \is_array( $content )  ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $content as $_value  ):
$return .= <<<CONTENT

					<meta 
CONTENT;

if ( mb_substr( $name, 0, 3 ) === 'og:' or mb_substr( $name, 0, 3 ) === 'fb:' ):
$return .= <<<CONTENT
property
CONTENT;

else:
$return .= <<<CONTENT
name
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" content="
CONTENT;
$return .= htmlspecialchars( $_value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<meta 
CONTENT;

if ( mb_substr( $name, 0, 3 ) === 'og:' or mb_substr( $name, 0, 3 ) === 'fb:' ):
$return .= <<<CONTENT
property
CONTENT;

else:
$return .= <<<CONTENT
name
CONTENT;

endif;
$return .= <<<CONTENT
="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" content="
CONTENT;
$return .= htmlspecialchars( $content, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
			
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

endforeach;
$return .= <<<CONTENT


CONTENT;

foreach ( \IPS\Output::i()->linkTags as $type => $value ):
$return .= <<<CONTENT

	
CONTENT;

if ( \is_array( $value ) ):
$return .= <<<CONTENT

		<link 
CONTENT;

foreach ( $value as $k => $v ):
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
/>
	
CONTENT;

elseif ( $type != 'canonical' OR !isset( \IPS\Output::i()->metaTags['canonical'] ) ):
$return .= <<<CONTENT

		<link rel="
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" href="
CONTENT;

$return .= htmlspecialchars( $value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" />
	
CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

foreach ( \IPS\Output::i()->rssFeeds as $title => $url ):
$return .= <<<CONTENT
<link rel="alternate" type="application/rss+xml" title="
CONTENT;

$val = "{$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" href="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" />
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Output::i()->base ):
$return .= <<<CONTENT

	<base target="
CONTENT;

$return .= htmlspecialchars( \IPS\Output::i()->base, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$manifest = json_decode( \IPS\Settings::i()->manifest_details, TRUE );
$return .= <<<CONTENT

<link rel="manifest" href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=metatags&do=manifest", null, "manifest", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
<meta name="msapplication-config" content="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=metatags&do=iebrowserconfig", null, "iebrowserconfig", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
<meta name="msapplication-starturl" content="
CONTENT;

if ( isset( $manifest['start_url'] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $manifest['start_url'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
/
CONTENT;

endif;
$return .= <<<CONTENT
">
<meta name="application-name" content="
CONTENT;

if ( isset( $manifest['name'] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $manifest['name'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">

CONTENT;

if ( \IPS\Settings::i()->mobile_app_id and \IPS\Settings::i()->mobile_app_prompt ):
$return .= <<<CONTENT

	<meta name="apple-itunes-app" content="app-id=
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->mobile_app_itunes_id ?: \IPS\APP_MULTICOMMUNITY_ITUNES_ID, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

if ( \IPS\Settings::i()->itunes_affiliate_string ):
$return .= <<<CONTENT
, affiliate-data=
CONTENT;

$return .= \IPS\Settings::i()->itunes_affiliate_string;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
, app-argument=
CONTENT;

$return .= htmlspecialchars( \IPS\Request::i()->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT

<meta name="apple-mobile-web-app-title" content="
CONTENT;

if ( isset( $manifest['name'] ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $manifest['name'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;

$return .= \IPS\Settings::i()->board_name;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
">

CONTENT;

if ( isset( $manifest['theme_color'] ) ):
$return .= <<<CONTENT

	<meta name="theme-color" content="
CONTENT;
$return .= htmlspecialchars( $manifest['theme_color'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

else:
$return .= <<<CONTENT

	<meta name="theme-color" content="
CONTENT;

$return .= \IPS\Theme::i()->settings['header'];
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( isset( $manifest['background_color'] ) ):
$return .= <<<CONTENT

	<meta name="msapplication-TileColor" content="
CONTENT;
$return .= htmlspecialchars( $manifest['background_color'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

if ( \IPS\Settings::i()->icons_mask_icon AND \IPS\Settings::i()->icons_mask_color ):
$return .= <<<CONTENT

	<link rel="mask-icon" href="
CONTENT;

$return .= \IPS\File::get( "core_Icons", \IPS\Settings::i()->icons_mask_icon )->url;
$return .= <<<CONTENT
" color="
CONTENT;

$return .= \IPS\Settings::i()->icons_mask_color;
$return .= <<<CONTENT
">

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

$homeScreen = json_decode( \IPS\Settings::i()->icons_homescreen, TRUE ) ?? array();
$return .= <<<CONTENT


CONTENT;

foreach ( $homeScreen as $name => $image ):
$return .= <<<CONTENT

	
CONTENT;

if ( $name != 'original' ):
$return .= <<<CONTENT

		
CONTENT;

if ( mb_strpos( $name, 'apple-touch-icon' ) !== FALSE ):
$return .= <<<CONTENT

			
CONTENT;

if ( $name === 'apple-touch-icon-57x57' ):
$return .= <<<CONTENT

				<link rel="apple-touch-icon" href="
CONTENT;

$return .= \IPS\File::get( "core_Icons", $image['url'] )->url;
$return .= <<<CONTENT
">
			
CONTENT;

else:
$return .= <<<CONTENT

				<link rel="apple-touch-icon" sizes="
CONTENT;
$return .= htmlspecialchars( $image['width'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
x
CONTENT;
$return .= htmlspecialchars( $image['height'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" href="
CONTENT;

$return .= \IPS\File::get( "core_Icons", $image['url'] )->url;
$return .= <<<CONTENT
">
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

elseif ( mb_strpos( $name, 'msapplication' ) !== FALSE ):
$return .= <<<CONTENT

			<meta name="
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" content="
CONTENT;

$return .= \IPS\File::get( "core_Icons", $image['url'] )->url;
$return .= <<<CONTENT
"/>
		
CONTENT;

else:
$return .= <<<CONTENT

			<link rel="icon" sizes="
CONTENT;
$return .= htmlspecialchars( $image['width'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
x
CONTENT;
$return .= htmlspecialchars( $image['height'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" href="
CONTENT;

$return .= \IPS\File::get( "core_Icons", $image['url'] )->url;
$return .= <<<CONTENT
">
		
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

$apple = json_decode( \IPS\Settings::i()->icons_apple_startup, TRUE ) ?? array();
$return .= <<<CONTENT


CONTENT;

if ( \count( $apple ) ):
$return .= <<<CONTENT

	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">

	
CONTENT;

foreach ( $apple as $name => $image ):
$return .= <<<CONTENT

		
CONTENT;

if ( $name !== 'original' ):
$return .= <<<CONTENT

			<link rel="apple-touch-startup-image" media="screen and (device-width: 
CONTENT;

$return .= htmlspecialchars( $image['width'] / $image['density'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
px) and (device-height: 
CONTENT;

$return .= htmlspecialchars( $image['height'] / $image['density'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
px) and (-webkit-device-pixel-ratio: 
CONTENT;
$return .= htmlspecialchars( $image['density'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
) and (orientation: 
CONTENT;
$return .= htmlspecialchars( $image['orientation'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)" href="
CONTENT;

$return .= \IPS\File::get( "core_Icons", $image['url'] )->url;
$return .= <<<CONTENT
">
		
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

endif;
$return .= <<<CONTENT


<link rel="preload" href="
CONTENT;

$return .= str_replace( array( 'http://', 'https://' ), '//', htmlspecialchars( \IPS\Http\Url::internal( "applications/core/interface/font/fontawesome-webfont.woff2?v=4.7.0", "none", "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE ) );
$return .= <<<CONTENT
" as="font" crossorigin="anonymous">
CONTENT;

		return $return;
}

	function message( $message, $type, $debug=NULL, $parse=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $debug !== NULL ):
$return .= <<<CONTENT

	<div class="ipsMessage ipsMessage_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

if ( $parse ):
$return .= <<<CONTENT

			
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			{$message}
		
CONTENT;

endif;
$return .= <<<CONTENT

		<br><br>
		<pre>
CONTENT;
$return .= htmlspecialchars( $debug, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
	</div>

CONTENT;

else:
$return .= <<<CONTENT

	<p class="ipsMessage ipsMessage_
CONTENT;
$return .= htmlspecialchars( $type, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		
CONTENT;

if ( $parse ):
$return .= <<<CONTENT

			
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			{$message}
		
CONTENT;

endif;
$return .= <<<CONTENT

	</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function miniPagination( $baseUrl, $pages, $activePage=1, $perPage=25, $ajax=FALSE, $pageParam='page' ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $pages > 1 ):
$return .= <<<CONTENT

	<span class='ipsPagination ipsPagination_mini' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
CONTENT;

foreach ( range( 1, ( 4 > $pages ) ? $pages : 4 ) as $i ):
$return .= <<<CONTENT

			<span class='ipsPagination_page'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $i ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$sprintf = array($i); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go_to_page_x', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></span>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

		
CONTENT;

if ( $pages > 4 ):
$return .= <<<CONTENT

			<span class='ipsPagination_last'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $pages ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'last_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 <i class='fa fa-caret-right'></i></a></span>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</span>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function multipleRedirect( $url, $mr=NULL, $height=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsRedirect_manualButton">
	<a href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'mr' => '0', '_mrReset' => 1 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' class="ipsButton ipsButton_primary">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'start', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
</div>
<div data-controller="core.global.core.multipleRedirect" data-url="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
	<div class="ipsRedirect ipsHide ipsPad">
		<div class="ipsLoading ipsRedirect_loading" data-role="loadingIcon" data-loading-text="" 
CONTENT;

if ( $height ):
$return .= <<<CONTENT
style="height: 
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
px;"
CONTENT;

endif;
$return .= <<<CONTENT
>
		</div>
		<div class="ipsHide" data-role="progressBarContainer">
			<div class="ipsRedirect_progress" data-loading-text="">
				<div class="ipsProgressBar ipsProgressBar_animated">
					<div class="ipsProgressBar_progress" data-role="progressBar"></div>
				</div>
			</div>
		</div>
	</div>
</div>
CONTENT;

		return $return;
}

	function offline(  ) {
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'you_are_offline', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 - 
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->board_name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			:root {
				/* Master scales & styles */
				--sp-1: 4px;
				--sp-2: 8px;
				--sp-3: 12px;
				--sp-4: 16px;
				--sp-5: 20px;
				--sp-6: 24px;
				--sp-7: 32px;
				--sp-8: 40px;
				--sp-9: 48px;
				--sp-10: 64px;

				/* Border vars */
				--radius-1: 4px;
				--radius-2: 8px;
				--border-1px: 1px solid rgba( var(--theme-text_light), 0.15 );

				/* Variables used for specific contexts */
				--box--boxShadow: 0px 2px 4px -1px rgba( var(--theme-area_background_dark), 0.1 );
				--box--backgroundColor: rgb( var(--theme-area_background_reset) );
				--box--radius: var(--radius-1);
				--solved--borderColor: 44, 140, 105;
				

				/* Nav sizes */
				--header--height: 
CONTENT;

$return .= \IPS\Theme::i()->settings['header_height'];
$return .= <<<CONTENT
px;
				--responsive-header--height: 
CONTENT;

$return .= \IPS\Theme::i()->settings['header_height_mobile'];
$return .= <<<CONTENT
px;
				--logo--height: 
CONTENT;

$return .= 100;
$return .= <<<CONTENT
%;
				--responsive-logo--height: var(--logo--height);
				--primary-navigation--height: 52px;
				--secondary-navigation--height: 50px;

				/* Button styles */
				--button--radius: var(--radius-1);

				/* Page widths */
				--container--width: 1340px;
				--minimal_container--width: 1000px;
				
				/* Theme settings */
				/* Format is --theme-[setting-key] */
			
CONTENT;

$return .= htmlspecialchars( \IPS\Theme::i()->css_vars, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT


			}

			@-webkit-viewport { width: device-width; }
			@-moz-viewport { width: device-width; }
			@-ms-viewport { width: device-width; }
			@-o-viewport { width: device-width; }
			@viewport { width: device-width; }

			*{
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			}

			html {
				min-height: 100%;
				position: relative;
			}

			body {
				font-family: 
CONTENT;

if ( \IPS\Theme::i()->settings['body_font'] != 'default' ):
$return .= <<<CONTENT
"
CONTENT;

$return .= \IPS\Theme::i()->settings['body_font'];
$return .= <<<CONTENT
",
CONTENT;

endif;
$return .= <<<CONTENT
 -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
				font-size: 16px;
				line-height: 1.5;
				color: rgb( var(--theme-text_color) );
				height: 100%;
				background-color: rgb( var(--theme-page_background) );
				margin: 0;
			}

			.ipsLayout_container {
				
CONTENT;

if ( \IPS\Theme::i()->settings['enable_fluid_width'] ):
$return .= <<<CONTENT

					
CONTENT;

if ( \IPS\Theme::i()->settings['fluid_width_size'] ):
$return .= <<<CONTENT

						max-width: 
CONTENT;

$return .= \IPS\Theme::i()->settings['fluid_width_size'];
$return .= <<<CONTENT
%;
					
CONTENT;

else:
$return .= <<<CONTENT

						max-width: 100%;
					
CONTENT;

endif;
$return .= <<<CONTENT

				
CONTENT;

else:
$return .= <<<CONTENT

					max-width: var(--container--width);
				
CONTENT;

endif;
$return .= <<<CONTENT

				padding: 0 15px;
				margin: 0 auto;
				position: relative;
			}

			/* ======================================================== */
			/* TYPOGRAPHY */
			.ipsType_reset {
				margin: 0;
			}

			.ipsType_pageTitle,
			.ipsType_sectionHead {
				
CONTENT;

if ( \IPS\Theme::i()->settings['headline_font'] != 'default' ):
$return .= <<<CONTENT

					font-family: "
CONTENT;

$return .= \IPS\Theme::i()->settings['headline_font'];
$return .= <<<CONTENT
", "Helvetica Neue", Helvetica, Arial, sans-serif;
				
CONTENT;

endif;
$return .= <<<CONTENT

			}

			/* ======================================================== */
			/* Page title: the large text shown at the top of pages */
			.ipsType_pageTitle {
				font-size: 
CONTENT;

$return .= "24.0px";
$return .= <<<CONTENT
;
				font-weight: bold;
				line-height: 1.2;
				letter-spacing: -.02em;
				margin: 0;
				color: rgb( var(--theme-text_dark) );
			}

			/* ======================================================== */
			/* Section heading: a text-based heading for smaller sections */
			.ipsType_sectionHead {
				font-size: 
CONTENT;

$return .= "18.0px";
$return .= <<<CONTENT
;
				color: rgb( var(--theme-text_dark) );
				line-height: 
CONTENT;

$return .= "24.0px";
$return .= <<<CONTENT
;
				font-weight: bold;
				display: inline-block;
				margin: 0;
			}

			/* ======================================================== */
			/* BOX STYLES */
			.ipsBox {
				box-shadow: var(--box--boxShadow);
				border-radius: var(--box--radius);
				background-color: var(--box--backgroundColor);
			}

			/* ======================================================== */
			/* BASE BUTTONS */
			.ipsApp .ipsButton {
				font-size: 
CONTENT;

$return .= "14.0px";
$return .= <<<CONTENT
;
				font-weight: 400;
				text-align: center;
				text-decoration: none;
				text-shadow: none;
				white-space: nowrap;
				display: inline-block;
				vertical-align: middle;
				padding: 10px 20px;
				border-radius: var(--button--radius);
				border: 1px solid transparent;
				transition: 0.1s all linear;
				cursor: pointer;
				
CONTENT;

$return .= "-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	-o-user-select: none;
	user-select: none;";
$return .= <<<CONTENT

				max-width: 100%;
				overflow: hidden;
				text-overflow: ellipsis;
			}

				.ipsApp .ipsButton:hover:not(:active) {
					background-image: linear-gradient(to bottom, rgba(255,255,255,0.08) 0%,rgba(255,255,255,0.08) 100%);
				}

				.ipsApp .ipsButton:active {
					border-color: rgba(0,0,0,0.1);
					background-image: linear-gradient(to bottom, rgba( var(--theme-text_dark), 0.1 ) 0%, rgba( var(--theme-text_dark), 0.1 ) 100%);
				}
				
				.ipsApp .ipsButton_important {
					font-weight: 500;
					background: rgb( var(--theme-important_button) );
					color: rgb( var(--theme-important_button_font) );
				}

				.ipsApp .ipsButton_medium {
					font-size: 
CONTENT;

$return .= "14.0px";
$return .= <<<CONTENT
;
					line-height: 3;
					padding: 0 20px;
				}

				.ipsApp .ipsButton_fullWidth {
					display: block;
					width: 100%;
					text-overflow: ellipsis;
					overflow: hidden;
				}

			/* ======================================================== */
			/* HORIZONTAL RULE */
			hr.ipsHr {
				margin: 15px 0;
				height: 0;
				padding: 0;
				border: 1px solid rgba( var(--theme-text_color), 0.08 );
				border-width: 1px 0 0 0;
			}

			/* ======================================================== */
			/* OFFLINE SPECIFIC */
			.cOfflineBox {
				margin: var(--sp-8) auto 0;
				max-width: 475px;
				padding: var(--sp-5);
			}
		</style>
		<link rel='shortcut icon' href='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMCAzMCIgZmlsbD0iIzMzMzMzMyI+PHBhdGggZD0iTSAxNSAzIEMgMTQuMTY4NDMyIDMgMTMuNDU2MDYzIDMuNTA2NzIzOCAxMy4xNTQyOTcgNC4yMjg1MTU2IEwgMi4zMDA3ODEyIDIyLjk0NzI2NiBMIDIuMzAwNzgxMiAyMi45NDkyMTkgQSAyIDIgMCAwIDAgMiAyNCBBIDIgMiAwIDAgMCA0IDI2IEEgMiAyIDAgMCAwIDQuMTQwNjI1IDI1Ljk5NDE0MSBMIDQuMTQ0NTMxMiAyNiBMIDE1IDI2IEwgMjUuODU1NDY5IDI2IEwgMjUuODU5Mzc1IDI1Ljk5MjE4OCBBIDIgMiAwIDAgMCAyNiAyNiBBIDIgMiAwIDAgMCAyOCAyNCBBIDIgMiAwIDAgMCAyNy42OTkyMTkgMjIuOTQ3MjY2IEwgMjcuNjgzNTk0IDIyLjkxOTkyMiBBIDIgMiAwIDAgMCAyNy42ODE2NDEgMjIuOTE3OTY5IEwgMTYuODQ1NzAzIDQuMjI4NTE1NiBDIDE2LjU0MzkzNyAzLjUwNjcyMzggMTUuODMxNTY4IDMgMTUgMyB6IE0gMTMuNzg3MTA5IDExLjM1OTM3NSBMIDE2LjIxMjg5MSAxMS4zNTkzNzUgTCAxNi4wMTE3MTkgMTcuODMyMDMxIEwgMTMuOTg4MjgxIDE3LjgzMjAzMSBMIDEzLjc4NzEwOSAxMS4zNTkzNzUgeiBNIDE1LjAwMzkwNiAxOS44MTA1NDcgQyAxNS44MjU5MDYgMTkuODEwNTQ3IDE2LjMxODM1OSAyMC4yNTI4MTMgMTYuMzE4MzU5IDIxLjAwNzgxMiBDIDE2LjMxODM1OSAyMS43NDg4MTIgMTUuODI1OTA2IDIyLjE4OTQ1MyAxNS4wMDM5MDYgMjIuMTg5NDUzIEMgMTQuMTc1OTA2IDIyLjE4OTQ1MyAxMy42Nzk2ODggMjEuNzQ4ODEzIDEzLjY3OTY4OCAyMS4wMDc4MTIgQyAxMy42Nzk2ODggMjAuMjUyODEzIDE0LjE3NDkwNiAxOS44MTA1NDcgMTUuMDAzOTA2IDE5LjgxMDU0NyB6IiBmaWxsPSIjMzMzMzMzIi8+PC9zdmc+Cg==' type="image/svg+xml">
	</head>
	<body class='ipsApp ipsApp_front ipsClearfix ipsLayout_noBackground ipsClearfix'>
		<div class='ipsLayout_container'>

			<div class='cOfflineBox ipsBox'>
				<h1 class='ipsType_pageTitle'>
CONTENT;

$return .= htmlspecialchars( \IPS\Settings::i()->board_name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h1>
				
				<hr class='ipsHr'>

				<h2 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_offline_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
				<p>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_offline_1', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</p>
				<p>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'user_offline_2', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</p>

				<hr class='ipsHr'>

				<button onclick="javascript: window.location.reload()" class='ipsButton ipsButton_important ipsButton_medium ipsButton_fullWidth'>
					
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'offline_try_again', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

				</button>
			</div>
		</div>
	</body>
</html>
CONTENT;

		return $return;
}

	function pagination( $baseUrl, $pages, $activePage=1, $perPage=25, $ajax=TRUE, $pageParam='page', $simple=false ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$firstPage = $baseUrl->setPage( $pageParam );
$return .= <<<CONTENT


CONTENT;

if ( $activePage > 1 || $pages > 1 ):
$return .= <<<CONTENT

	
CONTENT;

$uniqId = mt_rand();
$return .= <<<CONTENT

	<ul class='ipsPagination' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $uniqId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsPagination-seoPagination='
CONTENT;

if ( $firstPage->seoPagination ):
$return .= <<<CONTENT
true
CONTENT;

else:
$return .= <<<CONTENT
false
CONTENT;

endif;
$return .= <<<CONTENT
' data-pages='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $ajax and ( \IPS\Theme::i()->settings['ajax_pagination'] or \IPS\Request::i()->isAjax()) ):
$return .= <<<CONTENT
data-ipsPagination 
CONTENT;

if ( $pageParam != 'page' ):
$return .= <<<CONTENT
data-ipsPagination-pageParam='
CONTENT;
$return .= htmlspecialchars( $pageParam, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
 data-ipsPagination-pages="
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsPagination-perPage='
CONTENT;
$return .= htmlspecialchars( $perPage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
		
CONTENT;

if ( $simple ):
$return .= <<<CONTENT

			
CONTENT;

if ( $activePage > 1 ):
$return .= <<<CONTENT

				<li class='ipsPagination_prev'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $activePage - 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="prev" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage - 1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $activePage < $pages ):
$return .= <<<CONTENT

				<li class='ipsPagination_next'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $activePage + 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="next" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage + 1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

else:
$return .= <<<CONTENT

			
CONTENT;

if ( $activePage != 1 ):
$return .= <<<CONTENT

				<li class='ipsPagination_first'><a href='
CONTENT;
$return .= htmlspecialchars( $firstPage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="first" data-page='1' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-left'></i></a></li>
				<li class='ipsPagination_prev'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $activePage - 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="prev" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage - 1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

foreach ( range( ( ( $activePage - 5 ) > 0 ) ? ( $activePage - 5 ) : 1, $activePage - 1 ) as $idx => $i ):
$return .= <<<CONTENT

					<li class='ipsPagination_page'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $i ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-page='
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsPagination_first ipsPagination_inactive'><a href='
CONTENT;
$return .= htmlspecialchars( $firstPage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="first" data-page='1' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'first_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-left'></i></a></li>
				<li class='ipsPagination_prev ipsPagination_inactive'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $activePage - 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="prev" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage - 1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'prev', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			<li class='ipsPagination_page ipsPagination_active'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $activePage ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-page='
CONTENT;
$return .= htmlspecialchars( $activePage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $activePage, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

if ( $activePage != $pages ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( range( $activePage + 1, ( ( $activePage + 5 ) > $pages ) ? $pages : ( $activePage + 5 ) ) as $idx => $i ):
$return .= <<<CONTENT

					<li class='ipsPagination_page'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $i ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-page='
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a></li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

				<li class='ipsPagination_next'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $activePage + 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="next" data-page='
CONTENT;

$return .= htmlspecialchars( $activePage + 1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li class='ipsPagination_last'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $pages ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="last" data-page='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'last_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-right'></i></a></li>
			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsPagination_next ipsPagination_inactive'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, ( $activePage + 1 > $pages ) ? $pages : $activePage + 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="next" data-page='
CONTENT;

$return .= htmlspecialchars( ( $activePage + 1 > $pages ) ? $pages : $activePage + 1, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'next', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
				<li class='ipsPagination_last ipsPagination_inactive'><a href='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( $pageParam, $pages ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' rel="last" data-page='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsTooltip title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'last_page', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'><i class='fa fa-angle-double-right'></i></a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( $pages > 1 ):
$return .= <<<CONTENT

				<li class='ipsPagination_pageJump'>
					<a href='#' data-ipsMenu data-ipsMenu-closeOnClick='false' data-ipsMenu-appendTo='#elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $uniqId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $uniqId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_jump'>
CONTENT;

$sprintf = array($activePage, $pages); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pagination', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
 &nbsp;<i class='fa fa-caret-down'></i></a>
					<div class='ipsMenu ipsMenu_narrow ipsPadding ipsHide' id='elPagination_
CONTENT;

$return .= htmlspecialchars( md5($baseUrl), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $uniqId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_jump_menu'>
						<form accept-charset='utf-8' method='post' action='
CONTENT;
$return .= htmlspecialchars( $baseUrl->setPage( 'page', NULL ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role="pageJump" data-baseUrl='#'>
							<ul class='ipsForm ipsForm_horizontal'>
								<li class='ipsFieldRow'>
									<input type='number' min='1' max='
CONTENT;
$return .= htmlspecialchars( $pages, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' placeholder='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'page_number', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsField_fullWidth' name='
CONTENT;
$return .= htmlspecialchars( $pageParam, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
								</li>
								<li class='ipsFieldRow ipsFieldRow_fullWidth'>
									<input type='submit' class='ipsButton_fullWidth ipsButton ipsButton_verySmall ipsButton_primary' value='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'go', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
								</li>
							</ul>
						</form>
					</div>
				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
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

	function poll( $poll, $url ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !isset( \IPS\Request::i()->fetchPoll ) ):
$return .= <<<CONTENT

<section data-controller='core.front.core.poll'>

CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $poll->canVote() and \IPS\Request::i()->_poll != 'results' and ( !$poll->getVote() or \IPS\Request::i()->_poll == 'form') and $pollForm = $poll->buildForm() ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset'>
			<span class='ipsType_break ipsContained'>
				
CONTENT;
$return .= htmlspecialchars( $poll->poll_question, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&nbsp;&nbsp;
				
CONTENT;

if ( $poll->votes ):
$return .= <<<CONTENT
<p class='ipsType_reset ipsPos_right ipsResponsive_hidePhone ipsType_light ipsType_unbold ipsType_medium'><i class='fa fa-check-square-o'></i> 
CONTENT;

$pluralize = array( $poll->votes ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_num_votes', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

			</span>
		</h2>
		<div class='ipsPadding ipsClearfix' data-role='pollContents'>
			{$pollForm->customTemplate( array( \IPS\Theme::i()->getTemplate( 'global', 'core', 'global' ), 'pollForm' ), $url, $poll )}
		</div>
	
CONTENT;

elseif ( ( $poll->canViewResults() and !$poll->canVote() ) or $poll->getVote() or ( \IPS\Request::i()->_poll == 'results' and $poll->canViewResults() ) ):
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset'>
			<span class='ipsType_break ipsContained'>
				
CONTENT;
$return .= htmlspecialchars( $poll->poll_question, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&nbsp;&nbsp;
				
CONTENT;

if ( $poll->votes ):
$return .= <<<CONTENT
<p class='ipsType_reset ipsPos_right ipsResponsive_hidePhone ipsType_light ipsType_unbold ipsType_medium'><i class='fa fa-check-square-o'></i> 
CONTENT;

$pluralize = array( $poll->votes ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_num_votes', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

			</span>
		</h2>
		<div class='ipsPadding ipsClearfix' data-role='pollContents'>
			<ol class='ipsList_reset cPollList'>
				
CONTENT;

$i = 0;
$return .= <<<CONTENT

				
CONTENT;

foreach ( $poll->choices as $questionId => $question ):
$return .= <<<CONTENT

					
CONTENT;

$i++;
$return .= <<<CONTENT

					<li>
						<h3 class='ipsType_sectionHead'><span class='ipsType_break ipsContained'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
. 
CONTENT;
$return .= htmlspecialchars( $question['question'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></h3>
						<ul class='ipsList_reset cPollList_choices'>
							
CONTENT;

foreach ( $question['choice'] as $k => $choice ):
$return .= <<<CONTENT

								<li class='ipsGrid ipsGrid_collapsePhone'>
									<div class='ipsGrid_span4 ipsType_richText ipsType_break'>
										{$choice}
									</div>
									<div class='ipsGrid_span7'>
										<span class='cPollVoteBar'>
											<span style='width: 
CONTENT;

if ( array_sum( $question['votes'] ) > 0  ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( \intval( ( $question['votes'][ $k ] / array_sum( $question['votes'] ) ) * 100 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
%' data-votes='
CONTENT;

if ( array_sum( $question['votes'] ) > 0 ):
$return .= <<<CONTENT

CONTENT;

$return .= htmlspecialchars( round( ( $question['votes'][ $k ] / array_sum( $question['votes'] ) ) * 100, 2 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT
0
CONTENT;

endif;
$return .= <<<CONTENT
%' 
CONTENT;

if ( array_sum( $question['votes'] ) && \intval( ( $question['votes'][ $k ] / array_sum( $question['votes'] ) ) * 100 ) > 30 ):
$return .= <<<CONTENT
class='cPollVoteBar_inside'
CONTENT;

endif;
$return .= <<<CONTENT
></span>
										</span>
									</div>
									<div class='ipsGrid_span1 ipsType_small'>
										
CONTENT;

if ( $poll->canSeeVoters() && $question['votes'][ $k ] > 0 ):
$return .= <<<CONTENT

											<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=poll&do=voters&id={$poll->pid}&question={$questionId}&option={$k}", null, "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'view_voters', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsType_blendLinks' data-ipsTooltip data-ipsDialog data-ipsDialog-size="narrow" data-ipsDialog-title="
CONTENT;
$return .= htmlspecialchars( $choice, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
										
CONTENT;

else:
$return .= <<<CONTENT

											<span class='ipsFaded'>
										
CONTENT;

endif;
$return .= <<<CONTENT

											<i class='fa fa-user'></i> 
CONTENT;
$return .= htmlspecialchars( $question['votes'][ $k ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

										
CONTENT;

if ( $poll->canSeeVoters() && $question['votes'][ $k ] > 0 ):
$return .= <<<CONTENT

											</a>
										
CONTENT;

else:
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
					</li>
				
CONTENT;

endforeach;
$return .= <<<CONTENT

			</ol>
			
CONTENT;

if ( $poll->canVote() || !\IPS\Member::loggedIn()->member_id || $poll->canClose() || ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and !$poll->poll_closed ) || ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and $poll->poll_closed ) ):
$return .= <<<CONTENT

				<hr class='ipsHr'>
				
CONTENT;

if ( $poll->poll_closed ):
$return .= <<<CONTENT

					<p class="ipsType_reset ipsType_medium ipsType_unbold ipsMargin_vertical:half">
						<i class='fa fa-lock'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_closed_for_votes', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

					</p>
				
CONTENT;

endif;
$return .= <<<CONTENT

				<ul class='ipsToolList ipsToolList_horizontal ipsClearfix cPollButtons'>
					
CONTENT;

if ( $poll->canVote() ):
$return .= <<<CONTENT

						<li class='ipsPos_left ipsResponsive_noFloat ipsToolList_primaryAction'>
							<a href="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( '_poll', 'form' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_vote_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' class='ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth' data-action='viewResults'><i class='fa fa-caret-left'></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_vote_options', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT

						<li class='ipsPos_left ipsResponsive_noFloat'>
							
CONTENT;

$sprintf = array(\IPS\Http\Url::internal( 'app=core&module=system&controller=login', 'front', 'login' ), \IPS\Http\Url::internal( 'app=core&module=system&controller=register', 'front', 'register' )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_guest', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

						</li>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $poll->canClose() ):
$return .= <<<CONTENT

						
CONTENT;

if ( ! $poll->poll_closed ):
$return .= <<<CONTENT

							<li class='ipsPos_right ipsResponsive_noFloat'><a class='ipsButton ipsButton_link ipsButton_small ipsButton_fullWidth' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 0 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-lock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_close', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

else:
$return .= <<<CONTENT

							<li class='ipsPos_right ipsResponsive_noFloat'><a class='ipsButton ipsButton_link ipsButton_small ipsButton_fullWidth' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-unlock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_open', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and !$poll->poll_closed ):
$return .= <<<CONTENT

						<li class='ipsPos_right cPollCloseDate ipsResponsive_noFloat'><span class='ipsType_light ipsType_medium'>
CONTENT;

$sprintf = array($poll->poll_close_date->localeDate(), $poll->poll_close_date->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_auto_closes_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span></li>
					
CONTENT;

elseif ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and $poll->poll_closed ):
$return .= <<<CONTENT

						<li class='ipsPos_right cPollCloseDate ipsResponsive_noFloat'><span class='ipsType_light ipsType_medium'>
CONTENT;

$sprintf = array($poll->poll_close_date->localeDate(), $poll->poll_close_date->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_auto_closed_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span></li>
					
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endif;
$return .= <<<CONTENT

		</div>
	
CONTENT;

else:
$return .= <<<CONTENT

		<h2 class='ipsType_sectionTitle ipsType_reset'>
			<span class='ipsType_break ipsContained'>
				
CONTENT;
$return .= htmlspecialchars( $poll->poll_question, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
&nbsp;&nbsp;
				
CONTENT;

if ( $poll->votes ):
$return .= <<<CONTENT
<p class='ipsType_reset ipsPos_right ipsResponsive_hidePhone ipsType_light'><i class='fa fa-check-square-o'></i> 
CONTENT;

$pluralize = array( $poll->votes ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_num_votes', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</p>
CONTENT;

endif;
$return .= <<<CONTENT

			</span>			
		</h2>
		<div class='ipsPadding ipsClearfix' data-role='pollContents'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_permission_poll', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

if ( !\IPS\Member::loggedIn()->member_id ):
$return .= <<<CONTENT
 
CONTENT;

$sprintf = array(\IPS\Http\Url::internal( 'app=core&module=system&controller=login', 'front', 'login' ), \IPS\Http\Url::internal( 'app=core&module=system&controller=register', 'front', 'register' )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_guest', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT


            
CONTENT;

if ( $poll->canClose() || ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and !$poll->poll_closed ) || ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and $poll->poll_closed ) ):
$return .= <<<CONTENT

            <hr class='ipsHr'>
            <ul class='ipsToolList ipsToolList_horizontal ipsClearfix cPollButtons'>
                
CONTENT;

if ( !$poll->poll_closed ):
$return .= <<<CONTENT

                    <li class='ipsPos_right ipsResponsive_noFloat'><a class='ipsButton ipsButton_link ipsButton_small ipsButton_fullWidth' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 0 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-lock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_close', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                
CONTENT;

else:
$return .= <<<CONTENT

                    <li class='ipsPos_right ipsResponsive_noFloat'><a class='ipsButton ipsButton_link ipsButton_small ipsButton_fullWidth' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-unlock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_open', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
                
CONTENT;

endif;
$return .= <<<CONTENT


                
CONTENT;

if ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and !$poll->poll_closed ):
$return .= <<<CONTENT

                    <li class='ipsPos_right ipsResponsive_noFloat cPollCloseDate'><span class='ipsType_light ipsType_medium'>
CONTENT;

$sprintf = array($poll->poll_close_date->localeDate(), $poll->poll_close_date->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_auto_closes_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span></li>
                
CONTENT;

elseif ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and $poll->poll_closed ):
$return .= <<<CONTENT

                    <li class='ipsPos_right ipsResponsive_noFloat cPollCloseDate'><span class='ipsType_light ipsType_medium'>
CONTENT;

$sprintf = array($poll->poll_close_date->localeDate(), $poll->poll_close_date->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_auto_closed_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span></li>
                
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

if ( !isset( \IPS\Request::i()->fetchPoll ) ):
$return .= <<<CONTENT

</section>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function pollForm( $url, $poll, $id, $action, $elements, $hiddenValues, $actionButtons, $uploadField, $class='', $attributes=array(), $sidebar=NULL, $form=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<form accept-charset='utf-8' class="ipsForm 
CONTENT;
$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" action="
CONTENT;
$return .= htmlspecialchars( $url->stripQueryString( array( 'fetchPoll', 'viewResults' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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

foreach ( $elements as $collection ):
$return .= <<<CONTENT

		<ol class='ipsList_reset cPollList cPollList_questions'>
			
CONTENT;

$i = 0;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $collection as $idx => $input ):
$return .= <<<CONTENT

				
CONTENT;

$i++;
$return .= <<<CONTENT

				<li class='ipsFieldRow ipsFieldRow_noLabel'>
					<h3 class='ipsType_sectionHead'><span class='ipsType_break ipsContained'>
CONTENT;
$return .= htmlspecialchars( $i, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
. 
CONTENT;
$return .= htmlspecialchars( $input->label, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span></h3>
					<div class='ipsType_break ipsContained'>
					
CONTENT;

if ( !$input->options['multiple'] ):
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->radio( $input->name, $input->value, $input->required, $input->options['options'], $input->options['disabled'], '', $input->options['disabled'] );
$return .= <<<CONTENT

					
CONTENT;

else:
$return .= <<<CONTENT

						
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->checkboxset( $input->name, $input->value, $input->required, $input->options['options'], $input->options['disabled'], $input->options['toggles'], isset( $input->options['descriptions'] ) ? $input->options['descriptions'] : NULL, $input->options['userSuppliedInput'] );
$return .= <<<CONTENT

					
CONTENT;

endif;
$return .= <<<CONTENT

					</div>
					
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

endforeach;
$return .= <<<CONTENT

		</ol>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

	<hr class='ipsHr'>
	
CONTENT;

if ( $poll->poll_view_voters ):
$return .= <<<CONTENT

		<p class="ipsType_reset ipsType_medium ipsType_unbold ipsMargin_vertical:half">
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_is_public', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<ul class="ipsToolList ipsToolList_horizontal ipsList_reset ipsClearfix cPollButtons ipsMargin_top ipsMargin_bottom:none">
		<li class='ipsPos_left ipsResponsive_noFloat ipsToolList_primaryAction'>
			<button type="submit" class="ipsButton ipsButton_small ipsButton_light ipsButton_fullWidth" tabindex="2" accesskey="s" role="button">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'save_vote', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</button>
		</li>
		<li class='ipsPos_left ipsResponsive_noFloat'><a class='ipsButton ipsButton_link ipsButton_small ipsButton_fullWidth' title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_results_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' href="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( '_poll' => 'results', 'nullVote' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( !\IPS\Settings::i()->allow_result_view ):
$return .= <<<CONTENT
data-viewResults-confirm="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'warn_allow_result_view', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
 data-action='viewResults'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'show_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
        
CONTENT;

if ( $poll->canClose() ):
$return .= <<<CONTENT

			
CONTENT;

if ( ! $poll->poll_closed ):
$return .= <<<CONTENT

				<li class='ipsPos_right ipsResponsive_noFloat'><a class='ipsButton ipsButton_link ipsButton_small ipsButton_fullWidth' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 0 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-lock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_close', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

else:
$return .= <<<CONTENT

				<li class='ipsPos_right ipsResponsive_noFloat'><a class='ipsButton ipsButton_link ipsButton_small ipsButton_fullWidth' href='
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( array( 'do' => 'pollStatus', 'value' => 1 ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><i class="fa fa-unlock"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_open', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

if ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and !$poll->poll_closed ):
$return .= <<<CONTENT

			<li class='ipsPos_right ipsResponsive_noFloat cPollCloseDate'><span class='ipsType_light ipsType_medium'>
CONTENT;

$sprintf = array($poll->poll_close_date->localeDate(), $poll->poll_close_date->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_auto_closes_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span></li>
		
CONTENT;

elseif ( ( $poll->poll_close_date instanceof \IPS\DateTime ) and $poll->poll_closed ):
$return .= <<<CONTENT

			<li class='ipsPos_right ipsResponsive_noFloat cPollCloseDate'><span class='ipsType_light ipsType_medium'>
CONTENT;

$sprintf = array($poll->poll_close_date->localeDate(), $poll->poll_close_date->localeTime( FALSE )); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'poll_auto_closed_on', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span></li>
		
CONTENT;

endif;
$return .= <<<CONTENT

	</ul>
</form>
CONTENT;

		return $return;
}

	function pollVoters( $votes ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	<div class='ipsBox_alt'>

CONTENT;

endif;
$return .= <<<CONTENT

		<ul class="ipsGrid ipsGrid_collapsePhone ipsPad">
			
CONTENT;

foreach ( $votes as $vote ):
$return .= <<<CONTENT

				<li class='ipsGrid_span6 ipsPhotoPanel ipsPhotoPanel_mini'>
					
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $vote->member_id ), 'mini' );
$return .= <<<CONTENT

					<div class='ipsType_break'>
						<h3 class='ipsType_normal ipsType_reset ipsTruncate ipsTruncate_line'>
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $vote->member_id )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</h3>
						<span class="ipsType_light ipsType_medium">
CONTENT;

$val = ( $vote->vote_date instanceof \IPS\DateTime ) ? $vote->vote_date : \IPS\DateTime::ts( $vote->vote_date );$return .= $val->html();
$return .= <<<CONTENT
</span>
					</div>
				</li>
			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>

CONTENT;

if ( !\IPS\Request::i()->isAjax() ):
$return .= <<<CONTENT

	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function prettyprint( $code ) {
		$return = '';
		$return .= <<<CONTENT

<pre class='prettyprint'>
CONTENT;
$return .= htmlspecialchars( $code, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</pre>
CONTENT;

		return $return;
}

	function rank( $rank, $cssClass=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<img src='
CONTENT;

if ( $rank->icon ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rank->_icon->url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $rank->_icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' loading="lazy" alt="
CONTENT;
$return .= htmlspecialchars( $rank->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="
CONTENT;
$return .= htmlspecialchars( $cssClass, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-ipsTooltip title="
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'profile_rank', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
: 
CONTENT;
$return .= htmlspecialchars( $rank->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 (
CONTENT;
$return .= htmlspecialchars( $rank->rankPosition()['pos'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
/
CONTENT;
$return .= htmlspecialchars( $rank->rankPosition()['max'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
)">
CONTENT;

		return $return;
}

	function redirect( $url, $message ) {
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

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirecting', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</title>
		<meta http-equiv="refresh" content="2; url=
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
		<meta name="robots" content="noindex,nofollow">
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeMeta(  );
$return .= <<<CONTENT

		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeCSS(  );
$return .= <<<CONTENT

	</head>
	<body>
		<p class="ipsMessage ipsMessage_info ipsRedirectMessage">
			<strong>
CONTENT;

$val = "{$message}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</strong><br>
			<br>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'redirecting_wait', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</p>
		
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->includeJS(  );
$return .= <<<CONTENT

	</body>
</html>
CONTENT;

		return $return;
}

	function referralBanner( $url ) {
		$return = '';
		$return .= <<<CONTENT

<img src="
CONTENT;

$return .= \IPS\File::get( "core_ReferralBanners", $url )->url;
$return .= <<<CONTENT
" class="ipsImage">
CONTENT;

		return $return;
}

	function richText( $value, $extraClasses=array(), $extraControllers=array(), $extraAttributes=array() ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( \IPS\Dispatcher::hasInstance() and \IPS\Dispatcher::i()->controllerLocation == 'front' ):
$return .= <<<CONTENT


CONTENT;

$controllers = array_merge( array('core.front.core.lightboxedImages'), $extraControllers );
$return .= <<<CONTENT

<div class='ipsType_richText 
CONTENT;

$return .= htmlspecialchars( implode(' ', $extraClasses), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-controller='
CONTENT;

$return .= htmlspecialchars( implode(',', $controllers), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

foreach ( $extraAttributes as $attribute ):
$return .= <<<CONTENT
 {$attribute}
CONTENT;

endforeach;
$return .= <<<CONTENT
>
{$value}
</div>

CONTENT;

else:
$return .= <<<CONTENT


CONTENT;

$controllers = $extraControllers;
$return .= <<<CONTENT

<div class='ipsType_richText 
CONTENT;

$return .= htmlspecialchars( implode(' ', $extraClasses), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsLazyLoad 
CONTENT;

if ( \is_array( $controllers ) AND \count( $controllers ) ):
$return .= <<<CONTENT
data-controller='
CONTENT;

$return .= htmlspecialchars( implode(',', $controllers), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

foreach ( $extraAttributes as $attribute ):
$return .= <<<CONTENT
 {$attribute}
CONTENT;

endforeach;
$return .= <<<CONTENT
>
{$value}
</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function staticMap( $linkUrl, $imageUrl, $lat=NULL, $long=NULL, $width=NULL, $height=NULL ) {
		$return = '';
		$return .= <<<CONTENT

<div
CONTENT;

if ( \IPS\Settings::i()->lazy_load_enabled ):
$return .= <<<CONTENT
 data-ipsLazyLoad
CONTENT;

endif;
$return .= <<<CONTENT
>

CONTENT;

if ( $lat and $long ):
$return .= <<<CONTENT

	<span itemscope itemtype='http://schema.org/GeoCoordinates'>
		<meta itemprop='latitude' content='
CONTENT;
$return .= htmlspecialchars( $lat, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		<meta itemprop='longitude' content='
CONTENT;
$return .= htmlspecialchars( $long, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
		
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
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='' class='ipsImage'
CONTENT;

if ( $width AND $height ):
$return .= <<<CONTENT
 width='
CONTENT;
$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' height='
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

if ( $linkUrl ):
$return .= <<<CONTENT
</a>
CONTENT;

endif;
$return .= <<<CONTENT

	</span>

CONTENT;

else:
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
$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' alt='' class='ipsImage'
CONTENT;

if ( $width AND $height ):
$return .= <<<CONTENT
 width='
CONTENT;
$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' height='
CONTENT;
$return .= htmlspecialchars( $height, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

if ( $linkUrl ):
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

		return $return;
}

	function textBlock( $message ) {
		$return = '';
		$return .= <<<CONTENT

<div class='ipsType_normal'>
	{$message}
</div>
<br>


CONTENT;

		return $return;
}

	function titleWithLink( $title, $link=NULL, $text='more_info', $hovertitle=NULL, $parsed=FALSE ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $link===NULL ):
$return .= <<<CONTENT

    <strong>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</strong>

CONTENT;

else:
$return .= <<<CONTENT

    <a data-ipstooltip  
CONTENT;

if (  $hovertitle !== NULL ):
$return .= <<<CONTENT
 _title='
CONTENT;

if ( !$parsed ):
$return .= <<<CONTENT

CONTENT;

$val = "{$hovertitle}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $hovertitle, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

endif;
$return .= <<<CONTENT
 href='
CONTENT;
$return .= htmlspecialchars( $link, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
        <span class='ipsType ipsType_bold'>
CONTENT;
$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span> <i class="fa fa-external-link ipsType ipsType_light ipsType_small"></i>
    </a>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function truncatedUrl( $url, $newWindow=TRUE, $length=50 ) {
		$return = '';
		$return .= <<<CONTENT

<a href='
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'
CONTENT;

if ( $newWindow === TRUE ):
$return .= <<<CONTENT
 target='_blank' rel="noopener"
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $url ), '0', $length ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $url ) ) > $length ) ? '&hellip;' : '' );
$return .= <<<CONTENT
</a>
CONTENT;

		return $return;
}

	function vineEmbed( $url ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsEmbeddedVideo" contenteditable="false"><div><iframe class="vine-embed" src="
CONTENT;
$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
/embed/simple" width="600" height="600"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script></div></div>
CONTENT;

		return $return;
}

	function wizard( $stepNames, $activeStep, $output, $baseUrl, $showSteps ) {
		$return = '';
		$return .= <<<CONTENT

<div data-ipsWizard class='ipsWizard'>
	
CONTENT;

if ( $showSteps ):
$return .= <<<CONTENT

		<ul class="ipsStepBar ipsClearFix" data-role="wizardStepbar">
			
CONTENT;

$doneSteps = TRUE;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $stepNames as $step => $name ):
$return .= <<<CONTENT

				
CONTENT;

if ( $activeStep == $name ):
$return .= <<<CONTENT

CONTENT;

$doneSteps = FALSE;
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

				<li class='ipsStep 
CONTENT;

if ( $activeStep == $name ):
$return .= <<<CONTENT
ipsStep_active
CONTENT;

endif;
$return .= <<<CONTENT
'>
					
CONTENT;

if ( $doneSteps ):
$return .= <<<CONTENT

						<a href="
CONTENT;
$return .= htmlspecialchars( $baseUrl->setQueryString( '_step', $name ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-action="wizardLink">
					
CONTENT;

else:
$return .= <<<CONTENT

						<span>
					
CONTENT;

endif;
$return .= <<<CONTENT

						<strong class='ipsStep_title'>
CONTENT;

$sprintf = array($step + 1); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'step_number', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</strong>
						<span class='ipsStep_desc'>
CONTENT;

$val = "{$name}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</span>
					
CONTENT;

if ( $doneSteps ):
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

	<div data-role="wizardContent">
		{$output}
	</div>
</div>
CONTENT;

		return $return;
}}