<?php

class cfdsManageLink
{

    public $registry;
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
		
		/* Load the language File */
		$this->registry->class_localization->loadLanguageFile( array( 'public_lang' ), 'classifieds' );
        
	}
        
	public function getOutput()
	{
		                
      		$url = ipsRegistry::getClass('output')->formatUrl( ipsRegistry::getClass('output')->buildUrl( 'app=classifieds&amp;module=manage' ) );	
      		return $this->registry->output->getTemplate( 'classifieds_hooks' )->manage_link( $url );  
	}	
}