<?php

class ipSeo_Tracker
{
	protected $registry = null;
	protected $engines  = array();
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
		$this->DB       = ipsRegistry::DB();
		
		$this->engines[] = array('name' => 'Google', 'match' => '/http\:\/\/www\.google/', 'parser' => 'parseGoogleUrl');
		$this->engines[] = array('name' => 'Bing', 'match' => '/http\:\/\/www\.bing/', 'parser' => 'parseBingUrl');
		$this->engines[] = array('name' => 'Yahoo', 'match' => '/http\:\/\/(([a-zA-Z0-9\.]+)\.)search\.yahoo\.com/', 'parser' => 'parseYahooUrl');
		$this->engines[] = array('name' => 'Facebook', 'match' => '/http\:\/\/www\.facebook/', 'parser' => 'parseFacebookUrl');
	}
	
	public function trackVisit()
	{
		$referrer = $_SERVER['HTTP_REFERER'];
		
		if(empty($referrer))
		{
			return '<!-- No referrer, nothing to track. -->';
		}
		
		$engine = $this->getEngine($referrer);
		if(!$engine)
		{
			return '<!-- Not a known search engine, not tracking. -->';
		}
		
		$keywords = trim($this->{$engine['parser']}($referrer));
		if(!$keywords || empty($keywords))
		{
			return '<!-- No keywords found. -->';
		}

		$member = ipsRegistry::instance()->member()->fetchMemberData();
		$member = $member['member_id'] == 0 ? null : $member['member_id'];

		$this->writeVisitToDb($engine['name'], $member, $keywords, ipsRegistry::$settings['query_string_real']);
	}
	
	protected function writeVisitToDb($engine, $member, $keywords, $url)
	{
		ips_DBRegistry::loadQueryFile( 'public', 'ipseo' );
		$this->DB->buildFromCache( 'ipseo_increment_keyword_count', $keywords, 'public_ipseo_sql_queries' );
		$this->DB->allow_sub_select = true;
		$this->DB->execute();
		
		$this->DB->insert('search_visitors', array('date' => time(), 'member' => $member, 'engine' => $engine, 'keywords' => $keywords, 'url' => $url));
	}
	
	protected function getEngine($ref)
	{
		if(!is_array($this->engines))
		{
			$this->engines = array();
		}
		
		foreach($this->engines as $engine)
		{
			if(preg_match($engine['match'], $ref))
			{
				return $engine;
			}
		}
	}
	
	protected function parseGoogleUrl($url)
	{
		$matches = array();
		if(preg_match('/imgres/', $url) && preg_match('/prev\=([^\&]+)/', $url, $matches))
		{
			$url = urldecode($matches[1]);
		}
		
		$matches = array();
		if(preg_match('/q\=([^\&]+)/', $url, $matches))
		{
			if(isset($matches[1]))
			{
				$keywords = $matches[1];
				$keywords = urldecode($keywords);
				$keywords = str_replace('+', ' ', $keywords);
				$keywords = str_replace('%20', ' ', $keywords);
				return $keywords;
			}
		}
		
		return null;
	}
	
	protected function parseBingUrl($url)
	{
		$matches = array();
		if(preg_match('/q\=([^\&]+)/', $url, $matches))
		{
			if(isset($matches[1]))
			{
				$keywords = $matches[1];
				$keywords = urldecode($keywords);
				$keywords = str_replace('+', ' ', $keywords);
				$keywords = str_replace('%20', ' ', $keywords);
				return $keywords;
			}
		}
		
		return null;
	}
	
	protected function parseYahooUrl($url)
	{
		$matches = array();
		if(preg_match('/p\=([^\&]+)/', $url, $matches))
		{
			if(isset($matches[1]))
			{
				$keywords = $matches[1];
				$keywords = urldecode($keywords);
				$keywords = str_replace('+', ' ', $keywords);
				$keywords = str_replace('%20', ' ', $keywords);
				return $keywords;
			}
		}
		
		return null;
	}
	
	protected function parseFacebookUrl($url)
	{
		$matches = array();
		if(preg_match('/l\.php\?u\=([^\&]+)/', $url, $matches))
		{
			if(isset($matches[1]))
			{
				$keywords = $matches[1];
				$keywords = urldecode($keywords);
				$keywords = str_replace('http://', '', $keywords);
				$keywords = str_replace('https://', '', $keywords);
				$keywords = str_replace('+', ' ', $keywords);
				$keywords = str_replace('%20', ' ', $keywords);
				return $keywords;
			}
		}
		elseif(preg_match('/end\.php/', $url))
		{
			return 'Sponsored Ad';
		}
		
		return null;
	}
}