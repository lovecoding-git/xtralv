<?php

if(!IN_IPB)
{
	die('This file is not designed to be accessed directly.');
}

require_once( IPSLib::getAppDir('ipseo') . '/sources/iSitemapGeneratorPlugin.php');/*noLibHook*/

abstract class ipseoSitemapPlugin implements iSitemapGeneratorPlugin
{
	//----
	// Define variables for the class:
	//----
	protected $registry		= null;
	protected $DB			= null;
	protected $settings		= null;
	protected $request		= null;
	protected $lang			= null;
	protected $member		= null;
	protected $memberData	= null;
	protected $cache		= null;
	protected $caches		= null;
	protected $sitemap		= null;
	
	/**
	* Constructor - Initialises the sitemap plugin class with core IP.Board classes and the sitemap class.
	*/
	public function __construct(ipsRegistry $registry, Sitemap $sitemap)
	{
		// Standard IP.Board classes:
		$this->registry = ipsRegistry::instance();
		$this->DB         =  $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->lang       =  $this->registry->getClass('class_localization');
		$this->member     =  $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->cache      =  $this->registry->cache();
		$this->caches     =& $this->registry->cache()->fetchCaches();
		
		// Sitemap stuff:
		$this->sitemap = $sitemap;
	}
	
	/**
	* Generate your sitemap and pass the data to the sitemap class to generate the file.
	*/
	public function generate() {}
}