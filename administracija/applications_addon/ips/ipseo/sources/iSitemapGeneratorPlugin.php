<?php
/**
* Version 2 of the Sitemap Generator plugin interface:
*/
interface iSitemapGeneratorPlugin
{
	public function __construct(ipsRegistry $registry, Sitemap $sitemap);
	public function generate();
}