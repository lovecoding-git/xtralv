<?php

class cfdsRandomAd
{

    public $registry;
	protected $settings;
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
                $this->settings   =& $this->registry->fetchSettings();
                

		if ( ! $this->registry->isClassLoaded('classifieds') )
		{
			/* Classifieds Object */
			require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
			$this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
		}

                require_once( IPSLib::getAppDir( 'classifieds' ) . '/sources/classes/classifieds/items.php' );
                $this->items = new classifieds_items( $this->registry );
                

	}
        
	public function getOutput()
	{
		                             
        $item =  $this->items->getRandom();
        
        if($item) {
			return $this->registry->output->getTemplate( 'classifieds_hooks' )->randomAd( $item );
		}
              
	}	
}