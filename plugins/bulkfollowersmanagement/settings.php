//<?php

$options = array();
$lang = 'follow_type_immediate';
$options['immediate'] = $lang;
$options['daily']	= \IPS\Member::loggedIn()->language()->addToStack('follow_type_daily');
$options['weekly']	= \IPS\Member::loggedIn()->language()->addToStack('follow_type_weekly');
$options['none']	= \IPS\Member::loggedIn()->language()->addToStack('follow_type_no_notification');

$form->add( new \IPS\Helpers\Form\Radio( 'manageFollowers_followtype', \IPS\Settings::i()->manageFollowers_followtype, FALSE, array( 'options' => $options ) ) );
$form->add( new \IPS\Helpers\Form\YesNo( 'manageFollowers_anon', \IPS\Settings::i()->manageFollowers_anon ? 1 : 0 ) );

if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;