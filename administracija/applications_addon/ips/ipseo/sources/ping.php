<?php

class PingServices
{
	public static function ping($url, $title)
	{
		// Get services setting:
		$services = ipsRegistry::$settings['ipseo_ping_services'];
		
		if(empty($services))
		{
			return;
		}
		
		// Split down to individual URLs:
		$services = explode(PHP_EOL, ipsRegistry::$settings['ipseo_ping_services']);
		
		if(!is_array($services) || !count($services) || (count($services) == 1 && empty($services[0])))
		{
			return;
		}
		
		// Ping each service in turn:
		foreach($services as $service)
		{
			$service = trim($service);
			
			if(!empty($service))
			{
				self::sendPing($service, $url, $title);
			}
		}
	}
	
	protected static function sendPing($pingUrl, $url, $title)
	{
		$context = array();
		$context['http']['method']		= 'POST';
		$context['http']['header']		= 'Content-Type: text/xml';
		$context['http']['user_agent']	= 'Mozilla/5.0 (compatible; IP.SEO Bot)';
		$context['http']['timeout']		= 1;
		$context['http']['content']		= <<<EOF
<?xml version="1.0"?>
<methodCall>
	<methodName>weblogUpdates.ping</methodName>
	<params>
		<param>
			<value>{$title}</value>
		</param>
		<param>
			<value>{$url}</value>
		</param>
	</params>
</methodCall>	
EOF;

		$context  = stream_context_create($context);
		$response = @file_get_contents($pingUrl, false, $context);
				
		return (!$response ? false : true);
	}
}