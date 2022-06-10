<?php
namespace IPS\Theme\Cache;
class class_core_global_plugins extends \IPS\Theme\Template
{
	public $cache_key = '7dd2a1d4747b83f09f0212d4c160f90e';
	function bdayForm_year( $name, $value, $error='' ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


<select name="bday[year]">
	<option value='0'></option>
	
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

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_bdayForm_year" );
		}
		return $return;
}

	function sodPhpWidget( $title, $content, $desc, $orientation='vertical' ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( $title != null ):
$return .= <<<CONTENT

	<h3 class='ipsType_reset ipsWidget_title'>$title</h3>

CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsWidget_inner 
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $desc != null ):
$return .= <<<CONTENT

		<span class='ipsType_light ipsType_unbold ipsType_medium'>$desc</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $content != null ):
$return .= <<<CONTENT

		<p class='ipsType_reset ipsType_medium ipsType_light'>{$content}</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_sodPhpWidget" );
		}
		return $return;
}

	function sodTxtWidget( $title, $content, $desc, $orientation='vertical' ) {
		$return = '';
		try
		{
			$return .= <<<CONTENT


CONTENT;

if ( $title != null ):
$return .= <<<CONTENT

	<h3 class='ipsType_reset ipsWidget_title'>$title</h3>

CONTENT;

endif;
$return .= <<<CONTENT

<div class='ipsWidget_inner 
CONTENT;

if ( $orientation == 'vertical' ):
$return .= <<<CONTENT
ipsPad
CONTENT;

endif;
$return .= <<<CONTENT
'>
	
CONTENT;

if ( $desc != null ):
$return .= <<<CONTENT

		<span class='ipsType_light ipsType_unbold ipsType_medium'>$desc</span>
	
CONTENT;

endif;
$return .= <<<CONTENT

	
CONTENT;

if ( $content != null ):
$return .= <<<CONTENT

		<p class='ipsType_reset ipsType_medium ipsType_light'>{$content}</p>
	
CONTENT;

endif;
$return .= <<<CONTENT

</div>
CONTENT;

		}
		catch ( \Exception $exception )
		{
			\IPS\Log::log( $exception, "template_sodTxtWidget" );
		}
		return $return;
}}