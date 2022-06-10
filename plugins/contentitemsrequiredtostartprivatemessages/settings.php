//<?php

$form->add( new \IPS\Helpers\Form\YesNo( 'contentsendpmShowNumberofItems', \IPS\Settings::i()->contentsendpmShowNumberofItems ) );
$form->add( new \IPS\Helpers\Form\Number( 'contentsendpmNumberofItems', \IPS\Settings::i()->contentsendpmNumberofItems ) );
$form->add( new \IPS\Helpers\Form\CheckboxSet( 'contentsendpmGroups', ( \IPS\Settings::i()->contentsendpmGroups == '*' ? '*' : explode( ',', \IPS\Settings::i()->contentsendpmGroups ) ), FALSE, array( 'options' => \IPS\Member\Group::groups( TRUE, FALSE ), 'parse' => 'normal' ) ) );

if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;