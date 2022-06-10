<?php
namespace IPS\Theme\Cache;
class class_core_front_online extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function onlineUsersList( $table, $totalCount ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

$return .= \IPS\Theme::i()->getTemplate( "global", \IPS\Request::i()->app )->pageHeader( \IPS\Member::loggedIn()->language()->addToStack('online_users') );
$return .= <<<CONTENT

<br>
<div class='ipsBox'>
	<h2 class='ipsType_sectionTitle ipsType_reset ipsType_medium'>
CONTENT;

$pluralize = array( $totalCount ); $return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_user_count', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'pluralize' => $pluralize ) );
$return .= <<<CONTENT
</h2>
	{$table}
</div>
CONTENT;

		return $return;
}

	function onlineUsersRow( $table, $headers, $rows ) {
		$return = '';
		$return .= <<<CONTENT


CONTENT;

if ( !empty($rows)  ):
$return .= <<<CONTENT

	
CONTENT;

foreach ( $rows as $row ):
$return .= <<<CONTENT

		<li class='ipsGrid_span4 ipsPhotoPanel ipsPhotoPanel_small ipsClearfix cOnlineUser 
CONTENT;

if ( $row['login_type'] == \IPS\Session\Front::LOGIN_TYPE_ANONYMOUS ):
$return .= <<<CONTENT
ipsFaded
CONTENT;

endif;
$return .= <<<CONTENT
'>
			{$row['photo']}
			<div>
				<div class='ipsContained'>
					<h3 class='ipsType_reset ipsType_normal'>
						
CONTENT;

if ( $row['login_type'] == \IPS\Session\Front::LOGIN_TYPE_ANONYMOUS ):
$return .= <<<CONTENT

							<span class="ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_style6" title='
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'signed_in_anoymously', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
' data-ipsTooltip><i class='fa fa-eye'></i></span>
						
CONTENT;

endif;
$return .= <<<CONTENT

						{$row['member_name']}
					</h3>
					<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_break'>{$row['location_lang']}</p>
					<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_light'>
						
CONTENT;
$return .= htmlspecialchars( $row['running_time'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

						
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission( 'can_use_ip_tools' ) ):
$return .= <<<CONTENT

							&nbsp;&middot;&nbsp;
							
CONTENT;

if ( \IPS\Member::loggedIn()->modPermission('can_use_ip_tools') and \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'modcp' ) ) ):
$return .= <<<CONTENT

								<a href="
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=modcp&controller=modcp&tab=ip_tools&ip={$row['ip_address']}", null, "modcp_ip_tools", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
">
CONTENT;
$return .= htmlspecialchars( $row['ip_address'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT
</a>
							
CONTENT;

else:
$return .= <<<CONTENT

								
CONTENT;
$return .= htmlspecialchars( $row['ip_address'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
$return .= <<<CONTENT

							
CONTENT;

endif;
$return .= <<<CONTENT

						
CONTENT;

endif;
$return .= <<<CONTENT

					</p>
				</div>
			</div>
		</li>
	
CONTENT;

endforeach;
$return .= <<<CONTENT


CONTENT;

else:
$return .= <<<CONTENT

	<li>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'online_users_no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</li>

CONTENT;

endif;
$return .= <<<CONTENT

CONTENT;

		return $return;
}

	function onlineUsersTable( $table, $headers, $rows, $quickSearch ) {
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
' data-controller='core.global.core.table
CONTENT;

if ( $table->canModerate() ):
$return .= <<<CONTENT
,core.front.core.moderation
CONTENT;

endif;
$return .= <<<CONTENT
'>
	<div class="ipsButtonBar ipsPad_half ipsClearfix ipsClear">
		
CONTENT;

if ( !empty( $table->filters ) ):
$return .= <<<CONTENT

			<ul class="ipsButtonRow ipsPos_right ipsClearfix">
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
$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'group' => \IPS\Request::i()->group ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );
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
			</ul>
		
CONTENT;

endif;
$return .= <<<CONTENT

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

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

		</div>
	</div>

	<ol class='ipsList_reset ipsPad ipsGrid ipsGrid_collapsePhone ipsClear' data-ipsGrid data-role='tableRows'>
		
CONTENT;

$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );
$return .= <<<CONTENT

	</ol>

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

$return .= \IPS\Theme::i()->getTemplate( "global", "core", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );
$return .= <<<CONTENT

	</div>
</div>
CONTENT;

		return $return;
}}