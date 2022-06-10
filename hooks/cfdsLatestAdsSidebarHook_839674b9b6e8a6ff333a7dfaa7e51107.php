<?php

class cfdsLatestAdsSidebarHook
{

    public $registry;
	protected $settings;
	protected $member;
	protected $memberData;	
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
        $this->settings   =& $this->registry->fetchSettings();
        $this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
                
		$this->registry->class_localization->loadLanguageFile( array( 'public_lang' ), 'classifieds' );

		if ( ! $this->registry->isClassLoaded('classifieds') )
		{
			/* Classifieds Object */
			require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
			$this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
		}

                require_once( IPSLib::getAppDir( 'classifieds' ) . '/sources/classes/classifieds/items.php' );
                $this->items = new classifieds_items( $this->registry );
                
                require_once( IPSLib::getAppDir( 'classifieds' ) . '/sources/classes/classifieds/categories.php' );
                $this->categories = new classifieds_categories( $this->registry );

	}
        
	public function getOutput()
	{

		if ( $this->settings['cfds_latest_ads_groups'] == '' || IPSMember::isInGroup( $this->memberData, explode( ',', $this->settings['cfds_latest_ads_groups'] ) ) )  {              
                       
	        $category = $this->categories->getNode(1);
	                
	        $filters = array();
	
	        $filters[] = 'i.active = 1';
	        $filters[] = 'i.open = 1';
	        $filters[] = "(i.date_expiry > " . (time() - ($this->settings['classifieds_display_after_expiry'] * 86400)) .")";
	       
	                
	        $items = $this->items->getItems($category, array(0, $this->settings['classifieds_latest_ads_limit']), FALSE, "", $filters);
			return $this->registry->output->getTemplate( 'classifieds_hooks' )->sidebar_hook_latest( $items );
		} else {
			return null;
		}
              
	}	
}