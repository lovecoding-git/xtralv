<?php

class public_ipseo_sitemap_sitemap extends ipsCommand
{
	public function doExecute( ipsRegistry $registry )
	{
		// Requesting a sitemap?
		if(!array_key_exists('sitemap', $this->request))
		{
			$this->registry->output->showError( 'error_generic', 10850, null, null, 404 );
			return false;
		}
		
		// Got a valid name?
		if(!preg_match('/sitemap\_([a-zA-Z0-9\_]+)\.xml(\.gz)?/', $this->request['sitemap']))
		{
			$this->registry->output->showError( 'error_generic', 10850, null, null, 404 );
			return false;
		}
		
		// Got a valid file?
		if(!file_exists(DOC_IPS_ROOT_PATH . 'cache/' . $this->request['sitemap']))
		{
			$this->registry->output->showError( 'error_generic', 10850, null, null, 404 );
			return false;
		}
		
		header('Content-Type: ' . (strpos($this->request['sitemap'], '.gz') ? 'application/x-gzip' : 'application/xml'));
		header('Content-Disposition: attachment; filename=' . $this->request['sitemap']);
		
		print file_get_contents(DOC_IPS_ROOT_PATH . 'cache/' . $this->request['sitemap']);
	}
}