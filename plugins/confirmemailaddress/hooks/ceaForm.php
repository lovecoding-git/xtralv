//<?php

class hook58 extends _HOOK_CLASS_
{
	static public function buildRegistrationForm($postBeforeRegister = NULL)
	{
		try
		{
	
	            $form = parent::buildRegistrationForm($postBeforeRegister);
				$form->add( new \IPS\Helpers\Form\Email( 'email_address_confirm', NULL, TRUE, array( 'maxLength' => 150 ), function( $val )
				{
					if ( $val != \IPS\Request::i()->email_address )
					{
						throw new \DomainException( 'email_address_confirm_wrong' );
					}
				}, NULL, NULL, NULL ), 'email_address' );
		
				return $form;
		
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return \call_user_func_array( 'parent::' . __FUNCTION__, \func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
}