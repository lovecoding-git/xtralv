<?php

define('IPB_THIS_SCRIPT', 'public');
define('IPS_AREA', 'public');
define('IPS_PUBLIC_SCRIPT', 'index.php' );
define('IPS_ENFORCE_ACCESS', true);
define('ALLOW_FURLS', true);
define('IPSEO_CRON', 1);

ini_set('max_execution_time', 3600);

require_once( dirname(__FILE__) . '/../../../../../initdata.php' );/*noLibHook*/ // :(
require_once( IPS_ROOT_PATH . 'sources/base/ipsRegistry.php' );/*noLibHook*/
require_once( IPS_ROOT_PATH . 'sources/base/ipsController.php' );/*noLibHook*/
require_once( IPS_ROOT_PATH . 'applications_addon/ips/ipseo/sources/generator.php' );/*noLibHook*/

$registry = ipsRegistry::instance();
$registry->init();

ipsRegistry::DB()->update( 'task_manager', array( 'task_enabled' => 0 ), "task_key='ipseo_sitemap_generator'" );

$generator = new ipSeo_SitemapGenerator($registry);
$generator->generate();