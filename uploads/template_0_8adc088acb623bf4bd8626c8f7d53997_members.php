<?php
namespace IPS\Theme\Cache;
class class_core_global_members extends \IPS\Theme\Template
{
	public $cache_key = 'a46acbc97dfc3709a1019068a9d8f814';
	function attachmentLocations( $locations, $truncateLinks=TRUE ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $locations ) ):
$return .= <<<CONTENT

	<ul class="ipsList_reset">
		
CONTENT;

foreach ( $locations as $location ):
$return .= <<<CONTENT

			<li>
				
CONTENT;

if ( $location instanceof \IPS\Content or $location instanceof \IPS\Node\Model ):
$return .= <<<CONTENT

					<a href="
CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'admin' ):
$return .= <<<CONTENT

CONTENT;

if ( method_exists( $location, 'acpUrl' ) ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location->acpUrl(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" target="_blank" rel="noreferrer" class="ipsType_blendLinks">
						
CONTENT;

if ( isset( $location::$icon ) ):
$return .= <<<CONTENT
<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $location::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( isset( $location::$title ) ):
$return .= <<<CONTENT
title="
CONTENT;

$val = "{$location::$title}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
" data-ipsTooltip
CONTENT;

endif;
$return .= <<<CONTENT
></i> 
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

if ( $location instanceof \IPS\Content\Item ):
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

elseif ( $location instanceof \IPS\Node\Model ):
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location->item()->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				
CONTENT;

elseif ( $location instanceof \IPS\Http\Url ):
$return .= <<<CONTENT

					<a href="
CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation == 'admin' ):
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

else:
$return .= <<<CONTENT

CONTENT;
$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

CONTENT;

endif;
$return .= <<<CONTENT
" class="ipsType_blendLinks" target="_blank" rel="noreferrer"
CONTENT;

if ( $truncateLinks ):
$return .= <<<CONTENT
 title="
CONTENT;
$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
						
CONTENT;

if ( $truncateLinks ):
$return .= <<<CONTENT

							
CONTENT;

$return .= htmlspecialchars( mb_substr( html_entity_decode( $location ), '0', "60" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $location ) ) > "60" ) ? '&hellip;' : '' );
$return .= <<<CONTENT

						
CONTENT;

else:
$return .= <<<CONTENT

							
CONTENT;
$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</a>
				
CONTENT;

endif;
$return .= <<<CONTENT

			</li>
		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</ul>

CONTENT;

else:
$return .= <<<CONTENT

	<p class="">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'attach_locations_empty', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function bdayForm_day( $name, $value, $error='' ) {
		$return = '';
		$return .= <<<CONTENT


<select name="bday[day]">
	<option value='0' 
CONTENT;

if ( $value['day'] == 0  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
></option>
	
CONTENT;

foreach ( range( 1, 31 ) as $day ):
$return .= <<<CONTENT

		<option value='
CONTENT;
$return .= htmlspecialchars( $day, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $value['day'] == $day  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $day, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</select>

CONTENT;

		return $return;
}

	function bdayForm_month( $name, $value, $error='' ) {
		$return = '';
		$return .= <<<CONTENT


<select name="bday[month]">
	<option value='0' 
CONTENT;

if ( $value['month'] == 0  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
></option>
	
CONTENT;

foreach ( range( 1, 12 ) as $month ):
$return .= <<<CONTENT

		<option value='
CONTENT;
$return .= htmlspecialchars( $month, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $value['month'] == $month  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;

$return .= htmlspecialchars( \IPS\DateTime::create()->setDate( 2000, $month, 15 )->strFormat('%B'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</select>


CONTENT;

		return $return;
}

	function bdayForm_year( $name, $value, $error='', $required=FALSE ) {
		$return = '';
		$return .= <<<CONTENT

<select name="bday[year]">
    
CONTENT;

if ( !$required  ):
$return .= <<<CONTENT

	<option value='0'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'not_telling', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</option>
    
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

foreach ( array_reverse( range( date('Y') - 150, date('Y') ) ) as $year ):
$return .= <<<CONTENT

		<option value='
CONTENT;
$return .= htmlspecialchars( $year, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' 
CONTENT;

if ( $value['year'] == $year  ):
$return .= <<<CONTENT
selected
CONTENT;

endif;
$return .= <<<CONTENT
>
CONTENT;
$return .= htmlspecialchars( $year, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</option>
	
CONTENT;

endforeach;
$return .= <<<CONTENT

</select>

CONTENT;

		return $return;
}

	function dateFilters( $dateRange, $element ) {
		$return = '';
		$return .= <<<CONTENT

<ul class='ipsField_fieldList'>
	<li>
		<span class='ipsCustomInput'>
			<input name="
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[2]" value='none' type='radio' id='
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[3]_radio'
CONTENT;

if ( empty($element->value[0]) AND empty($element->value[1]) AND empty($element->value[3]) ):
$return .= <<<CONTENT
 checked
CONTENT;

endif;
$return .= <<<CONTENT
> 
			<span></span>
		</span>
		<div class='ipsField_fieldList_content'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'any_time', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</div>
	</li>
	<li>
		<span class='ipsCustomInput ipsSpacer_top ipsSpacer_half'>
			<input name="
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[2]" value='range' type='radio' id='
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[3]_radio' data-control="toggle" data-toggles=""
CONTENT;

if ( $element->value[0] ):
$return .= <<<CONTENT
 checked
CONTENT;

endif;
$return .= <<<CONTENT
> 
			<span></span>
		</span>
		<div class='ipsField_fieldList_content'>
			{$dateRange->html()}
		</div>
	</li>
	<li>
		<span class='ipsCustomInput ipsSpacer_top ipsSpacer_half'>
			<input name="
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[2]" value='days' type='radio' id='
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[3]_radio'
CONTENT;

if ( $element->value[1] ):
$return .= <<<CONTENT
 checked
CONTENT;

endif;
$return .= <<<CONTENT
> 
			<span></span>
		</span>
		<div class='ipsField_fieldList_content'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or_more_than', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->number( $element->name . '[1]', $element->value[1], $element->required, NULL, FALSE, 0, NULL, 1, 0, NULL, FALSE, \IPS\Member::loggedIn()->language()->addToStack( 'days_ago' ), array(), TRUE, array(), $element->name . '_number' );
$return .= <<<CONTENT

		</div>
	</li>
	<li>
		<span class='ipsCustomInput ipsSpacer_top ipsSpacer_half'>
			<input name="
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[2]" value='days_lt' type='radio' id='
CONTENT;
$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[3]_radio'
CONTENT;

if ( ! empty( $element->value[3]) ):
$return .= <<<CONTENT
 checked
CONTENT;

endif;
$return .= <<<CONTENT
> 
			<span></span>
		</span>
		<div class='ipsField_fieldList_content'>
			
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or_less_than', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "forms", "core", 'global' )->number( $element->name . '[3]', isset( $element->value[3] ) ? $element->value[3] : NULL, $element->required, NULL, FALSE, 0, NULL, 1, 0, NULL, FALSE, \IPS\Member::loggedIn()->language()->addToStack( 'days_ago' ), array(), TRUE, array(), $element->name . '_number_lt' );
$return .= <<<CONTENT

		</div>
	</li>
</ul>
CONTENT;

		return $return;
}

	function ipLookup( $url, $geolocation, $map, $hostName, $counts ) {
		$return = '';
		$return .= <<<CONTENT


<h2 class='ipsType_sectionTitle ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_address_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h2>
<div class='ipsPad ipsAreaBackground_light cIPInfo'>
	
CONTENT;

if ( $geolocation or $hostName ):
$return .= <<<CONTENT

		<div class='ipsColumns ipsColumns_noSpacing ipsColumns_collapsePhone'>
			<div class='ipsColumn ipsColumn_wide ipsAreaBackground_light'>
				<div class='ipsPad cIPInfo_map'>
					
CONTENT;

if ( $hostName ):
$return .= <<<CONTENT

						<p>
CONTENT;

$sprintf = array($hostName); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_geolocation_hostname', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

					
CONTENT;

if ( $geolocation ):
$return .= <<<CONTENT

						
CONTENT;

if ( $map ):
$return .= <<<CONTENT

							{$map}
							<br>
						
CONTENT;

endif;
$return .= <<<CONTENT

						<p>{$geolocation}</p>
						<p class="ipsType_light ipsType_small"><i class="fa fa-info-circle"></i> 
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_geolocation_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</div>
			</div>
			<div class='ipsColumn ipsColumn_fluid'>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class="ipsGrid ipsGrid_collapsePhone ipsAreaBackground_reset">
		
CONTENT;

foreach ( $counts as $key => $value ):
$return .= <<<CONTENT

			
CONTENT;

if ( $value ):
$return .= <<<CONTENT

				<div class='ipsGrid_span4 ipsPad ipsType_center'>
					<a href="
CONTENT;
$return .= htmlspecialchars( $url->setQueryString( 'area', $key ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" class="ipsType_blendLinks">
						<span class='ipsType_veryLarge cIPInfo_value'>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span><br>
						<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_minorHeading'>
CONTENT;

$val = "ipAddresses__{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
					</a>
				</div>
			
CONTENT;

else:
$return .= <<<CONTENT

				<div class='ipsGrid_span4 ipsPad ipsType_center ipsType_light ipsFaded'>
					<span class='ipsType_veryLarge cIPInfo_value'>
CONTENT;
$return .= htmlspecialchars( $value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</span><br>
					<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_minorHeading'>
CONTENT;

$val = "ipAddresses__{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
				</div>
			
CONTENT;

endif;
$return .= <<<CONTENT

		
CONTENT;

endforeach;
$return .= <<<CONTENT

	</div>
	
CONTENT;

if ( $geolocation ):
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

	function messengerQuota( $member, $count ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $member->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging', 'front' ) ) AND $member->group['g_max_messages'] > 0 ):
$return .= <<<CONTENT

	<div class='ipsGrid_span6 ipsResponsive_hidePhone'>
		<div class='ipsPos_right ipsType_right' data-role="quotaTooltip" data-ipsTooltip data-ipsTooltip-label="
CONTENT;

$sprintf = array($member->group['g_max_messages']); $pluralize = array( $count ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_quota', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
">
			
CONTENT;

$percent = floor( 100 / $member->group['g_max_messages'] * $count );
$return .= <<<CONTENT

			<span class="ipsAttachment_progress"><span data-role='quotaWidth' style='width: 
CONTENT;

$return .= htmlspecialchars( $percent > 100 ? 100 : $percent, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
%'></span></span><br>
			<span class='ipsType_light ipsResponsive_hidePhone'>
CONTENT;

$sprintf = array($percent); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_quota_short', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );
$return .= <<<CONTENT
</span>
		</div>
	</div>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function nameHistoryRows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		<li class='ipsDataItem'>
			<div class="ipsDataItem_main ipsType_center">
		   		<h4 class='ipsType_minorHeading'>
CONTENT;

$val = ( $row['log_date'] instanceof \IPS\DateTime ) ? $row['log_date'] : \IPS\DateTime::ts( $row['log_date'] );$return .= $val->html();
$return .= <<<CONTENT
</h4>
		   		<p class='ipsType_reset ipsType_large'>
		      		
CONTENT;
$return .= htmlspecialchars( $row['log_data']['old'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
 &nbsp;&nbsp;<i class='fa fa-angle-right'></i>&nbsp;&nbsp; 
CONTENT;
$return .= htmlspecialchars( $row['log_data']['new'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

		      	</p>
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

	function nameHistoryTable( $table, $headers, $rows, $quickSearch ) {
		$return = '';
		$return .= <<<CONTENT



CONTENT;

if ( $table->pages > 1 ):
$return .= <<<CONTENT

<div data-role="tablePagination">
    
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

</div>

CONTENT;

endif;
$return .= <<<CONTENT



CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

<ol class='ipsDataList ipsClear 
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
    <p class='ipsType_large'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

CONTENT;

		return $return;
}

	function notificationLabel( $key, $data ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( $data['icon'] ):
$return .= <<<CONTENT

	<i class="fa fa-
CONTENT;
$return .= htmlspecialchars( $data['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"></i>

CONTENT;

endif;
$return .= <<<CONTENT


CONTENT;

$val = "{$key}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function notificationsSettingsRow( $field, $details ) {
		$return = '';
		$return .= <<<CONTENT

<li class='ipsFieldRow ipsClearfix 
CONTENT;

if ( $field->error ):
$return .= <<<CONTENT
ipsFieldRow_error
CONTENT;

endif;
$return .= <<<CONTENT
' 
CONTENT;

if ( $field->htmlId ):
$return .= <<<CONTENT
id="
CONTENT;
$return .= htmlspecialchars( $field->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
"
CONTENT;

endif;
$return .= <<<CONTENT
>
	
CONTENT;

if ( \IPS\Dispatcher::i()->controllerLocation === 'admin' or $details['showTitle'] ):
$return .= <<<CONTENT

		<label class='ipsFieldRow_label ipsSpacer_bottom'>
			
CONTENT;

$val = "{$details['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT

		</label>
	
CONTENT;

endif;
$return .= <<<CONTENT

	<div class='ipsFieldRow_content'>
		
CONTENT;

if ( $details['description'] ):
$return .= <<<CONTENT

			<div class='ipsType_normal ipsSpacer_bottom ipsSpacer_half'>
CONTENT;

$val = "{$details['description']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</div>
		
CONTENT;

endif;
$return .= <<<CONTENT

		<ul class="ipsField_fieldList">
			
CONTENT;

if ( isset( $details['extra'] ) ):
$return .= <<<CONTENT

				
CONTENT;

foreach ( $details['extra'] as $k => $option ):
$return .= <<<CONTENT

					<li class="ipsSpacer_bottom">
						<span class='ipsCustomInput'>
							<input type="checkbox" name="
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" 
CONTENT;

if ( $option['value'] ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
							<span></span>
						</span>
						<div class='ipsField_fieldList_content'>
							<label for='elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>
CONTENT;

$val = "{$option['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
							
CONTENT;

if ( isset( $option['description'] ) ):
$return .= <<<CONTENT

								<br>
								<span class='ipsFieldRow_desc'>
CONTENT;

$val = "{$option['description']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
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

			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

foreach ( $details['options'] as $k => $option ):
$return .= <<<CONTENT

				
CONTENT;

if ( $k === 'inline' and isset( $details['options']['push'] ) ):
$return .= <<<CONTENT

					<li class="ipsSpacer_bottom">
						<ul class="ipsField_fieldList " role="radiogroup">
							<li>
								<span class='ipsCustomInput'>
									<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="push" 
CONTENT;

if ( $details['options']['push']['value'] ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_push" 
CONTENT;

if ( !$option['editable'] ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
>
									<span></span>
								</span>
								<div class='ipsField_fieldList_content ipsType_break'>
									<label for="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_push">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_list_and_app', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
								</div>
							</li>
							<li>
								<span class='ipsCustomInput'>
									<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="inline" 
CONTENT;

if ( $details['options']['inline']['value'] and !$details['options']['push']['value'] ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_inline" 
CONTENT;

if ( !$option['editable'] ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
>
									<span></span>
								</span>
								<div class='ipsField_fieldList_content ipsType_break'>
									<label for="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_inline">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_list_only', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
								</div>
							</li>
							<li>
								<span class='ipsCustomInput'>
									<input type="radio" name="
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="" 
CONTENT;

if ( !$details['options']['inline']['value'] and !$details['options']['push']['value'] ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_off" 
CONTENT;

if ( !$option['editable'] ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
>
									<span></span>
								</span>
								<div class='ipsField_fieldList_content ipsType_break'>
									<label for="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_off">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_no_list', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
								</div>
							</li>
						</ul>
					</li>
				
CONTENT;

elseif ( $k !== 'push' or !isset( $details['options']['inline'] ) ):
$return .= <<<CONTENT

					<li class="ipsSpacer_bottom">
						<span class='ipsCustomInput'>
							<input type="checkbox" name="
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
]" value="1" 
CONTENT;

if ( $option['value'] ):
$return .= <<<CONTENT
checked
CONTENT;

endif;
$return .= <<<CONTENT
 id="elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" 
CONTENT;

if ( !$option['editable'] ):
$return .= <<<CONTENT
disabled
CONTENT;

endif;
$return .= <<<CONTENT
>
							<span></span>
						</span>
						<div class='ipsField_fieldList_content'>
							<label for='elCheckbox_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_
CONTENT;
$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' id='elField_
CONTENT;
$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_label'>
CONTENT;

$val = "{$option['title']}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</label>
						</div>
					</li>
				
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

endforeach;
$return .= <<<CONTENT

		</ul>
	</div>
</li>
CONTENT;

		return $return;
}

	function photoCrop( $name, $value, $photo ) {
		$return = '';
		$return .= <<<CONTENT


<div data-controller='core.global.core.cropper' id='elPhotoCropper' class='ipsAreaBackground_light ipsType_center ipsPad'>
	<h3 class='ipsType_sectionHead'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'photo_crop_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</h3>
	<p class='ipsType_light ipsType_reset'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'photo_crop_instructions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</p>
	<br>

	<div class='ipsForm_cropper'>
		<div data-role='cropper'>
			<img src="
CONTENT;
$return .= htmlspecialchars( $photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role='profilePhoto'>
		</div>
	</div>

	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[0]' value='
CONTENT;
$return .= htmlspecialchars( $value[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='topLeftX'>
	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[1]' value='
CONTENT;
$return .= htmlspecialchars( $value[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='topLeftY'>
	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[2]' value='
CONTENT;
$return .= htmlspecialchars( $value[2], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='bottomRightX'>
	<input type='hidden' name='
CONTENT;
$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
[3]' value='
CONTENT;
$return .= htmlspecialchars( $value[3], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-role='bottomRightY'>
</div>
CONTENT;

		return $return;
}}