<?php
namespace IPS\Theme\Cache;
class class_core_front_moderationLog extends \IPS\Theme\Template
{
	public $cache_key = '08a15517b4be3c883c026c3326d0b0f7';
	function rows( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( \count( $rows ) ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		<li class="ipsDataItem">
			<div class='ipsDataItem_icon'>
				
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core" )->userPhoto( \IPS\Member::load( $row['member_id'] ), 'tiny' );
$return .= <<<CONTENT

			</div>
			<div class='ipsDataItem_main'>
				<h4 class='ipsDataItem_title ipsType_break'>						
					
CONTENT;
$return .= htmlspecialchars( $row['action'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

				</h4>
				<p class='ipsDataItem_meta ipsType_light'>
					
CONTENT;

$return .= htmlspecialchars( \IPS\Member::load( $row['member_id'] )->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
, 
CONTENT;

$val = ( $row['ctime'] instanceof \IPS\DateTime ) ? $row['ctime'] : \IPS\DateTime::ts( $row['ctime'] );$return .= $val->html();
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

	function table( $table, $headers, $rows ) {
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
	
CONTENT;

if ( ( $table->showAdvancedSearch AND ( (isset( $table->sortOptions ) and !empty( $table->sortOptions )) OR $table->advancedSearch ) ) OR !empty( $table->filters ) OR $table->pages > 1 ):
$return .= <<<CONTENT

	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
				
		<ul class="ipsButtonRow ipsPos_right ipsClearfix">
			
CONTENT;

if ( $table->showAdvancedSearch AND ( ( isset( $table->sortOptions ) and \count( $table->sortOptions ) > 1 ) OR $table->advancedSearch ) ):
$return .= <<<CONTENT

				<li>
					
CONTENT;

if ( isset($table->sortOptions)  ):
$return .= <<<CONTENT

					<a href="#elSortByMenu_menu" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-role="sortButton" data-ipsMenu data-ipsMenu-activeClass="ipsButtonRow_active" data-ipsMenu-selectable="radio">
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
 <i class="fa fa-caret-down"></i></a>
					<ul class="ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide" id="elSortByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu">
							
CONTENT;

$custom = TRUE;
$return .= <<<CONTENT

							
CONTENT;

foreach ( $table->sortOptions as $k => $col ):
$return .= <<<CONTENT

								<li class="ipsMenu_item 
CONTENT;

if ( $col === $table->sortBy ):
$return .= <<<CONTENT

CONTENT;

$custom = FALSE;
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-ipsMenuValue="
CONTENT;
$return .= htmlspecialchars( $col, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
" data-sortDirection='
CONTENT;
$return .= htmlspecialchars( $table->getSortDirection( $col ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'><a href="
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $col, 'sortdirection' => $table->getSortDirection( $col ) ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
">
CONTENT;

$val = "{$table->langPrefix}sort_{$k}"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a></li>
							
CONTENT;

endforeach;
$return .= <<<CONTENT

						
CONTENT;

if ( $table->advancedSearch ):
$return .= <<<CONTENT

							<li class="ipsMenu_item 
CONTENT;

if ( $custom ):
$return .= <<<CONTENT
ipsMenu_itemChecked
CONTENT;

endif;
$return .= <<<CONTENT
" data-noSelect="true">
								<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
							</li>
						
CONTENT;

endif;
$return .= <<<CONTENT

					</ul>
					
CONTENT;

elseif ( $table->advancedSearch ):
$return .= <<<CONTENT

						<a href='
CONTENT;
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
' data-ipsDialog data-ipsDialog-title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom_sort', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'custom', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
					
CONTENT;

endif;
$return .= <<<CONTENT

				</li>
			
CONTENT;

endif;
$return .= <<<CONTENT

			
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

				<li>
					<a href="#elFilterByMenu_
CONTENT;
$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
_menu" data-role="tableFilterMenu" id="elFilterByMenu_
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
						<li data-action="tableFilter" data-ipsMenuValue='' class='ipsMenu_item 
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => '', 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
'>
CONTENT;

$val = "{$table->langPrefix}all"; $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
						</li>
						
CONTENT;

foreach ( $table->filters as $k => $q ):
$return .= <<<CONTENT

							<li data-action="tableFilter" data-ipsMenuValue='
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
		
		<div data-role="tablePagination" 
CONTENT;

if ( $table->pages <= 1 ):
$return .= <<<CONTENT
class='ipsHide'
CONTENT;

endif;
$return .= <<<CONTENT
>
			
CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );
$return .= <<<CONTENT

		</div>
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

$return .= \IPS\Theme::i()->getTemplate( "moderationLog", "core" )->rows( $table, $headers, $rows );
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
}}