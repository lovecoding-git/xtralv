<?php

require_once(IPS_ROOT_PATH . 'applications_addon/ips/ipseo/sources/iSitemapGeneratorPlugin.php');/*noLibHook*/
require_once(IPS_ROOT_PATH . 'applications_addon/ips/ipseo/sources/sitemap.php');/*noLibHook*/
require_once(IPS_ROOT_PATH . 'applications_addon/ips/ipseo/sources/furl.php');/*noLibHook*/

class ipSeo_SitemapGenerator
{
	public static function isCronJob()
	{
		if(!defined('IPSEO_CRON'))
		{
			return false;
		}
		
		if(defined('IPSEO_CRON') && IPSEO_CRON != 1)
		{
			return false;
		}
		
		return true;
	}
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
	protected $sitemapIndex = null;
	protected $hadErrors    = false;
	
	/**
	* Constructor - Initialises the sitemap plugin class with core IP.Board classes and the sitemap class.
	*/
	public function __construct(ipsRegistry $registry)
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
		
		// Sitemap generator:
		$this->sitemapIndex = array();
		
		// Where to put individual sitemap files:
		define('SITEMAP_FILES_PATH', DOC_IPS_ROOT_PATH . 'cache/');
		
		// Where to put the sitemap index file:
		if(substr($this->settings['sitemap_path'], 0, 1) == '/')
		{
			define('SITEMAP_INDEX_PATH', $this->settings['sitemap_path']);
		}
		else
		{
			define('SITEMAP_INDEX_PATH', DOC_IPS_ROOT_PATH . $this->settings['sitemap_path']);
		}
		
		// The link to the sitemap file:
		if($this->settings['sitemap_url'] != '')
		{
			define('SITEMAP_URL', $this->settings['sitemap_url']);
		}
		else
		{
			define('SITEMAP_URL', $this->settings['board_url'] . '/');
		}
	}
	
	public function generate()
	{
		ips_CacheRegistry::instance()->setCache('sitemap_success', 0);
		
		// Generate sitemap:
		$this->log('Sitemap generation started.', true);
		$this->runPlugins();
		$this->log('Sitemap generation finished.');
				
		// Write sitemap index file to root directory:
		if(!$this->writeSitemapIndex())
		{
			$this->log('Could not write sitemap index file to: ' . SITEMAP_INDEX_PATH);
			return false;
		}
		
		// Ping search engines with sitemap index file:
		if($this->settings['sitemap_ping'])
		{	
			$this->pingSitemap();
		}
					
		ips_CacheRegistry::instance()->setCache('sitemap_success', ($this->hadErrors ? 0 : 1));	
		return true;
	}
	
	protected function writeSitemapIndex()
	{
		$file = SITEMAP_INDEX_PATH . 'sitemap.xml';
		
		// Check we can write our sitemap index file:
		if((file_exists($file) && !is_writable($file)) || (!file_exists($file) && !is_writable(SITEMAP_INDEX_PATH)))
		{
			return false;
		}
		
		$sitemapIndex = $this->generateSitemapIndex();
		
		@file_put_contents(SITEMAP_INDEX_PATH . 'sitemap.xml', $sitemapIndex);
		@chmod(SITEMAP_INDEX_PATH . 'sitemap.xml', IPS_FILE_PERMISSION);
		$this->log('Wrote sitemap file to: ' . SITEMAP_INDEX_PATH . 'sitemap.xml');
		
		return true;
	}
	
	protected function generateSitemapIndex()
	{
		$sitemapIndex  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
		$sitemapIndex .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
		
		foreach($this->sitemapIndex as $sitemap)
		{
			// Skip empty sitemaps:
			if($sitemap['count'] == 0)
			{
				continue;
			}
			
			// Write sitemap entry:
			$url = ipsRegistry::$settings['board_url'] . '/index.php?app=ipseo&module=sitemap&sitemap=' . $sitemap['file'];
			
			$sitemapIndex .= '<sitemap>' . PHP_EOL;
			$sitemapIndex .= '<loc>' . htmlspecialchars($url) . '</loc>' . PHP_EOL;
			$sitemapIndex .= '<lastmod>' . date('c', $sitemap['modified']) . '</lastmod>' . PHP_EOL;
			$sitemapIndex .= '</sitemap>' . PHP_EOL;
		}
		
		$sitemapIndex .= '</sitemapindex>';
		
		return $sitemapIndex;
	}
	
	protected function pingSitemap()
	{
		$this->log('Pinging search engines with updated sitemap.');
		
		$rtn = true;
		$sitemapUrl    = urlencode(SITEMAP_URL . 'sitemap.xml');
		
		$classToLoad   = IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classFileManagement.php', 'classFileManagement' );
		$http          = new $classToLoad();
		$http->timeout = 5;
		// Ping Google:
		@$http->getFileContents('http://www.google.com/webmasters/tools/ping?sitemap='.$sitemapUrl);
		if($http->http_status_code != 200)
		{
			$rtn = false;
			$this->log('Failed to ping Google.');
		}
		else
		{
			$this->log('Successfully pinged Google.');
		}
		
		// Ping Bing:
		@$http->getFileContents('http://www.bing.com/webmaster/ping.aspx?siteMap='.$sitemapUrl);	
		if($http->http_status_code != 200)
		{
			$rtn = false;
			$this->log('Failed to ping Bing.');
		}
		else
		{
			$this->log('Successfully pinged Bing.');
		}
				
		// Ping Ask:
		@$http->getFileContents('http://submissions.ask.com/ping?sitemap='.$sitemapUrl);
		if($http->http_status_code != 200)
		{
			$rtn = false;
			$this->log('Failed to ping Ask.');
		}
		else
		{
			$this->log('Successfully pinged Ask.');
		}
		
		// Ping Moreover:
		@$http->getFileContents('http://api.moreover.com/ping?u='.$sitemapUrl);
		if($http->http_status_code != 200)
		{
			$rtn = false;
			$this->log('Failed to ping Moreover.');
		}
		else
		{
			$this->log('Successfully pinged Moreover.');
		}
		
		return $rtn;
	}
	
	protected function runPlugins()
	{		
		$this->log('Running plugins for IPS applications.');
		$this->checkApplicationsDirectory(IPS_ROOT_PATH . 'applications_addon/ips/');
		
		$this->log('Running plugins for third party applications.');
		$this->checkApplicationsDirectory(IPS_ROOT_PATH . 'applications_addon/other/');		
	}
	
	protected function checkApplicationsDirectory($applicationsPath)
	{
		$applicationsDirectory = opendir($applicationsPath);
		
		while($app = readdir($applicationsDirectory))
		{
			if(substr($app, 0, 1) == '.' || !is_dir($applicationsPath . $app)) continue;
			
			$appPluginsPath = $applicationsPath.$app.'/extensions/sitemapPlugins/';
			
			if(is_dir($appPluginsPath) and IPSLib::appIsInstalled( $app ) )
			{
				$this->log('Running plugins for: ' . $app);
				$this->runApplicationPlugins($app, $appPluginsPath);
			}
			else
			{
				$this->log('No plugins to run for: ' . $app);
			}
		}
		closedir($applicationsDirectory);
	}
	
	protected function runApplicationPlugins($app, $appPluginsPath)
	{
		$appPluginsDirectory = opendir($appPluginsPath);
		
		while($pluginFile = readdir($appPluginsDirectory))
		{
			if(substr($pluginFile, 0, 1) == '.') 
			{
				continue;
			}
			elseif(!is_dir($appPluginsPath . $pluginFile) && substr($pluginFile, -4) == '.php')
			{		
				$pluginName = str_replace('.php', '', $pluginFile);
				$class      = 'sitemap_' . $app . '_' . $pluginName;
								
				require_once($appPluginsPath . $pluginFile);/*noLibHook*/
				
				if(class_exists($class))
				{					
					$sitemap = new Sitemap($app, $pluginName);					
					$plugin  = new $class($this->registry, $sitemap);
					
					if(isset($plugin) && is_object($plugin) && $plugin instanceof iSitemapGeneratorPlugin)
					{
						$this->log('- - Running plugin: ' . $pluginName);
						
						try
						{
							$plugin->generate();
							$sitemaps = $sitemap->save();
						}
						catch(ipSeo_Sitemap_File_Exception $ex)
						{
							$this->hadErrors = true;
							$this->log('- - - ' . $ex->getMessage());
							continue;
						}
						
						$i = 0;
						
						$this->log('- - - Generated ' . count($sitemaps) . ' sitemaps.');
						
						foreach($sitemaps as $details)
						{
							$this->sitemapIndex[] = $details;

							if($details['changed'])
							{
								$this->log('- - - - File ' . (++$i) . ', added ' . $details['count'] . ' URLs.');
							}
						}
					}
					else
					{
						$this->log('- - Class is not a valid plugin: ' . $class);
					}
				}
				else
				{
					$this->log('- - Class does not exist: ' . $class);
				}
			}
		}
		
		closedir($appPluginsDirectory);
	}
	
	public function log($message, $clear = false)
	{
		$currentLog = array();
		
		if(!$clear)
		{
			$cached = ips_CacheRegistry::instance()->getCache('sitemap_log');
			
			$currentLog = is_string($cached) ? unserialize($cached) : $cached;
			
			if(!is_array($currentLog))
			{
				$currentLog = array();
			}
		}
		
		$currentLog[] = date('H:i:s') . ' - ' . $message;
		
		ips_CacheRegistry::instance()->setCache('sitemap_log', serialize($currentLog));
		ips_CacheRegistry::instance()->setCache('sitemap_last_run', time());
		
		if(self::isCronJob())
		{
			print date('H:i:s') . ' - ' . $message . PHP_EOL;
		}
	}
}