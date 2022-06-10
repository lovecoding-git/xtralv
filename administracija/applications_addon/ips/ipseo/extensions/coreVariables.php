<?php
/**
 * Invision Power Services
 * IP.SEO Core Variables
 * Last Updated: $Date: 2011-08-12 11:44:48 -0400 (Fri, 12 Aug 2011) $
 *
 * @author 		$Author: mark $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @since		29th January 2010
 * @version		$Revision: 9390 $
 */

/* Caches */
$CACHE = array(
	'ipseo_meta' => array(
		'array'				=> 1,
		'allow_unload'		=> 0,
		'default_load'		=> 1,
		'recache_file'		=> IPSLib::getAppDir( 'ipseo' ) . '/sources/caches.php',
		'recache_class'		=> 'ipSeoCaches',
		'recache_function'	=> 'rebuildMetaTagCache' 
		),
	'ipseo_ignore_messages' => array(
		'array'				=> 1,
		'allow_unload'		=> 0,
		'default_load'		=> 0,
		'recache_file'		=> IPSLib::getAppDir( 'ipseo' ) . '/sources/caches.php',
		'recache_class'		=> 'ipSeoCaches',
		'recache_function'	=> 'rebuildMessageCache' 
		),
	'sitemap_success' => array(
		'array'				=> 0,
		'allow_unload'		=> 0,
		'default_load'		=> 0,
		'recache_file'		=> IPSLib::getAppDir( 'ipseo' ) . '/sources/caches.php',
		'recache_class'		=> 'ipSeoCaches',
		'recache_function'	=> 'rebuildSitemapSuccessCache' 
		),
	'sitemap_last_run' => array(
		'array'				=> 0,
		'allow_unload'		=> 0,
		'default_load'		=> 0,
		'recache_file'		=> IPSLib::getAppDir( 'ipseo' ) . '/sources/caches.php',
		'recache_class'		=> 'ipSeoCaches',
		'recache_function'	=> 'rebuildSitemapLastRunCache' 
		),
	'sitemap_log' => array(
		'array'				=> 1,
		'allow_unload'		=> 0,
		'default_load'		=> 0,
		'recache_file'		=> IPSLib::getAppDir( 'ipseo' ) . '/sources/caches.php',
		'recache_class'		=> 'ipSeoCaches',
		'recache_function'	=> 'rebuildSitemapLogCache' 
		),	
	);