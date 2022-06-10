<?php
namespace IPS\Theme\Cache;
class class_core_global_notifications extends \IPS\Theme\Template
{
	public $cache_key = '91ad289b393b6e67d26358f4f9555a20';
	function newVersion( $details ) {
		$return = '';
		$return .= <<<CONTENT

<div class="ipsType_richText ipsType_normal" data-ipsTruncate data-ipsTruncate-size="3 lines">
	{$details['releasenotes']}
</div>
<ul class='ipsList_inline ipsSpacer_top'>
	<li>
		<a href='
CONTENT;

$return .= htmlspecialchars( \IPS\Http\Url::internal( "app=core&module=system&controller=upgrade&_new=1", "admin", "", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );
$return .= <<<CONTENT
' class='ipsButton ipsButton_small ipsButton_veryLight'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upgrade_now', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
	</li>
    <li>
        <a href='
CONTENT;

$return .= \IPS\Http\Url::ips( "docs/release_notes" );
$return .= <<<CONTENT
' target='_blank' rel='nofollow noopener' class='ipsButton ipsButton_small ipsButton_overlaid'>
CONTENT;

$return .= \IPS\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'upgrade_more_information', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );
$return .= <<<CONTENT
</a>
    </li>
</ul>
CONTENT;

		return $return;
}}