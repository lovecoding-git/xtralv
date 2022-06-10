<?php

if(!IN_IPB)
{
	die('This file is not designed to be accessed directly.');
}

require_once( IPSLib::getAppDir('ipseo') . '/sources/sitemapplugin.php');/*noLibHook*/

class sitemap_ipseo_core extends ipseoSitemapPlugin
{
	public function generate()
	{
		if($this->settings['sitemap_priority_index'] > 0)
		{
			$this->sitemap->addURL($this->settings['board_url'] . '/', time(), $this->settings['sitemap_priority_index']);
		}
	}
}