<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v1.5.1
 * Last Updated: $LastChangedDate: 2011-03-31 06:17:44 -0400 (Thu, 31 Mar 2011) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Blog
 * @link		http://www.invisionpower.com
 * @since		27th January 2004
 * @version		$Rev: 8229 $
 *
 */



class public_ipseo_sql_queries extends db_driver_mysql
{
     protected $db  = "";
     protected $tbl = "";

    /* Construct */
    public function __construct( &$obj )
    {
    	$this->DB     = ipsRegistry::DB();
    	$this->prefix = ips_DBRegistry::getPrefix();
    }

    /*========================================================================*/

    public function ipseo_increment_keyword_count( $keyword )
    {
		$keyword = $this->DB->addSlashes($keyword);
		
    	$query   = "INSERT INTO {$this->prefix}search_keywords (keyword, count) VALUES ('{$keyword}', 1) ON DUPLICATE KEY UPDATE count = count + 1";
		
    	return $query;
	}
}
?>