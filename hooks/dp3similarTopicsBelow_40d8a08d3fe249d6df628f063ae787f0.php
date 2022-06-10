<?php
      
//-----------------------------------------------
// (DP32) Similar Topics
//-----------------------------------------------
//-----------------------------------------------
// Template Hook
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl/
// Written on: 10 / 01 / 2010
//-----------------------------------------------
// Copyright (C) 2010 DawPi
// All Rights Reserved
//-----------------------------------------------     

class dp3similarTopicsBelow
{
	public $registry;	
	public $DB;
	public $memberData;	
			
	
	public function __construct()
	{
		$this->registry   = ipsRegistry::instance();
		$this->DB	    = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->lang		=  $this->registry->getClass('class_localization');
		$this->cache	= $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();			       		
	}
	

	public function getOutput()
	{		
		/* Load main class */
		
		require_once( IPSLib::getAppDir( 'forums' ) . '/sources/classes/dp3similarTopicsLib.php' );
		
		$this->lib = new dp3similarTopicsLib( $this->registry );
		
		return $this->lib->showSimilarTopics( 'bfr' );
	}
} // End of class