//<?php

$form->add( new \IPS\Helpers\Form\YesNo( 'brc_required', \IPS\Settings::i()->brc_required, FALSE, array( 'togglesOn' => array( 'brc_validationcomplete' ) ) ) );

$form->add( new \IPS\Helpers\Form\YesNo( 'brc_validationcomplete', \IPS\Settings::i()->brc_validationcomplete, FALSE, array(), NULL, NULL, NULL, 'brc_validationcomplete' ) );

if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;