<?php

class Sitemap
{
	protected $app      = null;
	protected $plugin   = null;
	protected $fileName = null;
	protected $count    = 0;
	protected $total    = 0;
	protected $sitemap  = null;
	protected $sitemaps = array();
	
	public function __construct($app, $plugin)
	{
		$this->app      = $app;
		$this->plugin   = $plugin;
		$this->count    = 0;
		$this->sitemaps = array();
		$this->sitemap  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
		$this->sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
	}
	
	public function save()
	{
		$this->storeCurrentSitemap();
		
		return $this->sitemaps;	
	}
	
	public function addURL($url, $lastModified = null, $priority = null, $changeFrequency = null)
	{
		if($this->count >= 10000)
		{
			$this->storeCurrentSitemap();
		}
		
		// Prepare last modified string:
		if(!is_null($lastModified) && $lastModified != 0)
		{
			$lastModified = date('Y-m-d', $lastModified);
			$lastModified = "\t\t<lastmod>{$lastModified}</lastmod>\r\n";
		}
		else
		{
			$lastModified = '';
		}
		
		// Prepare priority string:
		if(!is_null($priority))
		{
			$priority = str_replace(',', '.', (string)$priority);
			$priority = "\t\t<priority>{$priority}</priority>\r\n";
		}
		else
		{
			$priority = '';
		}
		
		// Prepare change frequency string:
		if(!is_null($changeFrequency))
		{
			$changeFrequency = "\t\t<changefreq>{$changeFrequency}</changefreq>\r\n";
		}
		else
		{
			$changeFrequency = '';
		}
		
		// Prepare URL:
		$url = htmlspecialchars($url);
		
		
		$url = "\t<url>\r\n\t\t<loc>{$url}</loc>\r\n{$lastModified}{$priority}{$changeFrequency}\t</url>\r\n";
		
		$this->sitemap .= $url;
		
		$this->count++;
		$this->total++;
		return $this->total;
	}
	
	protected function storeCurrentSitemap()
	{
		$this->sitemap .= '</urlset>';

		if(count($this->sitemaps))
		{
			$_num = '_' . (count($this->sitemaps) + 1);
		}
		else
		{
			$_num = '';
		}

		if($this->app == 'ipseo')
		{
			$file = 'sitemap_' . $this->plugin . $_num . '.xml';
		}
		else
		{
			$file = 'sitemap_' . $this->app . '_' . $this->plugin . $_num . '.xml';
		}

		// GZip sitemap:
		if(function_exists('gzencode'))
		{
			$file          .= '.gz';
			$this->sitemap  = gzencode($this->sitemap);
		}

		// Remove sitemap if no URLs were added:
		if($this->count == 0)
		{
			@unlink(SITEMAP_FILES_PATH . $file);
		}
		else
		{
			$this->sitemaps[] = array('file' => $file, 'modified' => time(), 'count' => $this->count, 'changed' => true);
			
			if(!@file_put_contents(SITEMAP_FILES_PATH . $file, $this->sitemap))
			{
				throw new ipSeo_Sitemap_File_Exception('Could not write to: ' . $file);
			}
			
			@chmod(SITEMAP_FILES_PATH . $file, IPS_FILE_PERMISSION);
		}
		
		$this->count    = 0;
		$this->sitemap  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
		$this->sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
	}
}

class ipSeo_Sitemap_File_Exception extends Exception
{
}