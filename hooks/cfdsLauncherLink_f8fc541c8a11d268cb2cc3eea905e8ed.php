<?php

class cfdsLauncherLink
{

    public $registry;
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
        
	}
        
	public function getOutput()
	{
		 return $this->registry->output->getTemplate( 'classifieds' )->launcher_link();  
	}	
}