<?php

class ipSeoCaches
{
	public function __construct() {}
	
	public function rebuildMetaTagCache()
	{
		$meta = array();
		$db   = ipsRegistry::DB();
		
		$db->build(array('select' => '*', 'from' => 'seo_meta'));
		$db->execute();
		
		while($row = $db->fetch())
		{
			$meta[$row['url']][$row['name']] = $row['content'];
		}
		
		ipsRegistry::instance()->cache()->setCache( 'ipseo_meta', $meta,  array( 'array' => 1, 'donow' => 1 ) );
	}
	
	public function rebuildMessageCache()
	{
		$current = ipsRegistry::instance()->cache()->getCache('ipseo_ignore_messages');
		
		if(!is_array($current))
		{
			$current = array();
		}
		
		ipsRegistry::instance()->cache()->setCache( 'ipseo_ignore_messages', $current,  array( 'array' => 1, 'donow' => 1 ) );
	}
	
	public function rebuildSitemapSuccessCache()
	{
		$current = ipsRegistry::instance()->cache()->getCache('sitemap_success');
		
		if(is_null($current) || $current === false)
		{
			$current = 0;
		}
		
		ipsRegistry::instance()->cache()->setCache( 'sitemap_success', $current,  array( 'array' => 0, 'donow' => 1 ) );
	}
	
	public function rebuildSitemapLastRunCache()
	{
		$current = ipsRegistry::instance()->cache()->getCache('sitemap_last_run');
		
		if(is_null($current) || $current === false)
		{
			$current = null;
		}
		
		ipsRegistry::instance()->cache()->setCache( 'sitemap_last_run', $current,  array( 'array' => 0, 'donow' => 1 ) );
	}
	
	public function rebuildSitemapLogCache()
	{
		$current = ipsRegistry::instance()->cache()->getCache('sitemap_log');
		
		if(!is_array($current))
		{
			$current = array();
		}
		
		ipsRegistry::instance()->cache()->setCache( 'sitemap_log', $current,  array( 'array' => 1, 'donow' => 1 ) );
	}
}