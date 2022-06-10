<?php

require_once(IPS_ROOT_PATH . 'applications_addon/ips/ipseo/sources/generator.php');/*noLibHook*/


/**
* Sitemap Generation Task
*/
class task_item
{	
	/**
	* Initialize the sitemap generator task.
	*
	* @access    public
	* @param     object        ipsRegistry reference
	* @param     object        Parent task class
	* @param    array         This task data
	* @return    void
	*/
	public function __construct( ipsRegistry $registry, $class, $task )
	{	
		$this->registry  = $registry;
	    $this->class     = $class;
	    $this->task      = $task;
	
		define('IPSEO_CRON', 0);
	}	

  	/**
	* Run the sitemap generator task.
	*
	* @access    public
	* @return    void
	*/
	public function runTask()
	{
		// FURL Stuff does not work in the ACP, so we can't allow the user to run this manually.
		if( IN_ACP && !IN_DEV )
		{
			$this->log('You have run the task manually from the Admin CP, this prevents IP.SEO from working properly. Please unlock the task in the system scheduler if necessary and leave it to run automatically.', true);
			$this->class->unlockTask($this->task);
			return true;
		}
		
		ipsRegistry::member()->sessionClass()->setMember( 0 );
		
		$generator = new ipSeo_SitemapGenerator($this->registry);
		
		if($generator->generate())
		{
			$this->class->appendTaskLog($this->task, 'Sitemap generated successfully.');
			$this->class->unlockTask($this->task);
			return true;
		}
		else
		{
			$this->class->appendTaskLog($this->task, 'Sitemap failed to complete.');
			return false;
		}
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
		
		if(ipSeo_SitemapGenerator::isCronJob())
		{
			print date('H:i:s') . ' - ' . $message . PHP_EOL;
		}
	}
}