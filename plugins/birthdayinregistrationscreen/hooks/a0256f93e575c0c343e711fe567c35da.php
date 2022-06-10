//<?php

class hook59 extends _HOOK_CLASS_
{
	static public function buildRegistrationForm($postBeforeRegister = NULL)
	{
		try
		{
	
					$form 		= parent::buildRegistrationForm($postBeforeRegister);
					$required 	= \IPS\Settings::i()->brc_required ? TRUE : FALSE;
					$group 		= ( \IPS\Settings::i()->brc_required and \IPS\Settings::i()->brc_validationcomplete ) ? 'plugins' : 'members';
		
					$form->add( new \IPS\Helpers\Form\Custom( 'bday', array( 'year' => '', 'month' => '', 'day' => '' ), $required, array( 'getHtml' => function( $element ) use ( $group )
			  		{
						return \str_replace( array( 'DD', 'MM', 'YY', 'YYYY' ), array(
							\IPS\Theme::i()->getTemplate( 'members', 'core', 'global' )->bdayForm_day( $element->name, $element->value, $element->error ),
							\IPS\Theme::i()->getTemplate( 'members', 'core', 'global' )->bdayForm_month( $element->name, $element->value, $element->error ),
							\IPS\Theme::i()->getTemplate( $group, 'core', 'global' )->bdayForm_year( $element->name, $element->value, $element->error ),
							\IPS\Theme::i()->getTemplate( $group, 'core', 'global' )->bdayForm_year( $element->name, $element->value, $element->error ),
						), \IPS\Member::loggedIn()->language()->preferredDateFormat() );
					} ), function( $val )
						 {
							 if ( \IPS\Settings::i()->brc_required )
							 {
								 if ( \IPS\Settings::i()->brc_validationcomplete )
								 {
								 	if ( !\intval( $val['month'] ) OR !\intval( $val['day'] ) OR !\intval( $val['year'] ) )
								 	{
								 		throw new \DomainException('form_required');
								 	}
				                 }
								 else
								 {
								 	if ( !\intval( $val['month'] ) OR !\intval( $val['day'] ) )
								 	{
								 		throw new \DomainException('form_required');
								 	}
								 }
							 }
						 } ), 'password_confirm' );
					
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

    public static function _createMember( $values, $profileFields, $postBeforeRegister = NULL, &$form )
	{
		try
		{
	
			        $member = parent::_createMember( $values, $profileFields, $postBeforeRegister, $form );
			        $member->bday_day = $values['bday']['day'];
			        $member->bday_month = $values['bday']['month'];
			        $member->bday_year = $values['bday']['year'];
			        /* Save and return */
			        $member->save();
			        return $member;
	
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