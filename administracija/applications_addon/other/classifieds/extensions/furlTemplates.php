<?php

/**
 *
 * Classifieds 1.2.1
 *
 * @author		$Author: Andrew Millne $
 * @copyright   2011 Andrew Millne. All Rights Reserved.
 * @license		http://dev.millne.com/license.html
 * @package		Classifieds
 * @link		http://dev.millne.com
 *
 */

if ( ! defined( 'IN_IPB' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit();
}

$_SEOTEMPLATES = array(
        'app=classifieds'		=> array(
                'app'			=> 'classifieds',
                'allowRedirect' => 1,
                'out'			=> array( '#app=classifieds$#i', 'classifieds/' ),
                'in'			=> array(
                        'regex'		=> "#/classifieds/?$#i",
                        'matches'	=> array( array( 'app', 'classifieds' ) )
                )
        ),

        'view_category' => array(
                'app'			=> 'classifieds',
                'allowRedirect' => 1,
                'out'			=> array( '/app=classifieds(?:(?:&|&amp;))module=core(?:(?:&|&amp;))do=view_category(?:(?:&|&amp;))category_id=(.+?)(&|$)/i', 'classifieds/category/$1-#{__title__}/$2' ),
                'in'			=> array(
                        'regex'		=> "#/classifieds/category/(\d+?)-#i",
                        'matches'	=> array(
                                array( 'app'		, 'classifieds' ),
                                array( 'module'		, 'core' ),
                                array( 'do'	, 'view_category' ),
                                array( 'category_id'		, '$1' )
                        )
                )
        ),
        'view_item' => array(
                'app'			=> 'classifieds',
                'allowRedirect' => 1,
                'out'			=> array( '/app=classifieds(?:(?:&|&amp;))module=core(?:(?:&|&amp;))do=view_item(?:(?:&|&amp;))item_id=(.+?)(&|$)/i', 'classifieds/item/$1-#{__title__}/$2' ),
                'in'			=> array(
                        'regex'		=> "#/classifieds/item/(\d+?)-#i",
                        'matches'	=> array(
                                array( 'app'		, 'classifieds' ),
                                array( 'module'		, 'core' ),
                                array( 'do'	, 'view_item' ),
                                array( 'item_id'		, '$1' )
                        )
                )
        ),
);
