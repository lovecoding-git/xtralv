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

if( ! defined( 'IN_IPB' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit;
}

class classifieds_packages {
    public function __construct( $registry ) {
        $this->registry   = $registry;
        $this->DB         = $this->registry->DB();
        $this->settings   = $this->registry->settings();
        $this->request    = $this->registry->request();
        $this->lang       = $this->registry->getClass('class_localization');
    }
  
    /**
     * Grab package
     *
     * @access	public
     * @param   int     Package ID
     * @return	array
     */
    public function getPackageById($package_id) {

        // Grab package
        $package = $this->DB->buildAndFetch( array(	'select' => '*',
                'from' => array('classifieds_packages' => 'c'),
                'where' => 'package_id = ' . intval($package_id)
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_package_noid'], '10CFDL5001', false );
        }
        
        $package['enhancements'] = unserialize($package['enhancements']);
        
        if ($package['rates']) {
	        $package['rates'] = unserialize($package['rates']);
	        
	        	// Arrange rates highest to lowest	
	    		foreach ($package['rates'] as $key => $row)
	    		{
	    		$value[$key] = $package['value'];
	    		}
	    	
	    		array_multisort($value, SORT_NUMERIC, SORT_ASC, $package['rates']);
        }

        return $package;
    }

    /**
     * Grab packages
     *
     * @access	public
     * @return	array
     */
    public function getPackages($active_only = false, $check_group = false) {

         $where_clause = array();

         if( $active_only ) {
                $where_clause[] = "p.active = 1";
         }

         if( !IPSLib::appIsInstalled('nexus') ) {
                $where_clause[] = "p.price = '0.00'";
         }


        /* Build and return the string */
        $where = implode( " AND ", $where_clause );

        // Grab packages

        $this->DB->build( array(    'select' => '*',
                'from' => array( 'classifieds_packages' => 'p' ),
                'order' => 'p.sort_order ASC',
                'where' => $where,
                )		);

        $this->DB->execute();



        while( $row = $this->DB->fetch() ) {
        	
        	$row['enhancements'] = unserialize($row['enhancements']);
        	$row['rates'] = unserialize($row['rates']);
        	
       	
        	// are we checking for valid groups or returning all?       	
        	if ($check_group) {
        		
        		if ( $row['member_groups'] == '*' || IPSMember::isInGroup( IPSRegistry::member()->fetchMemberData(), explode( ',', $row['member_groups'] ) ) )
				{
					$packages[] = $row;
				}
        		
        		
        	} else {
	            $packages[] = $row;
        	}

        }

        return $packages;
    }

    /**
     * Calculate Listing Price
     *
     * @access	public
     * @param   float     Item value
     * @param   array     Package Rates Array
     * @return	array
     */
    public function calculatePrice($price, $rates, $type='base') {
   	
    	$final_price = 0;
    	
    	// Arrange rates highest to lowest	
    	foreach ($rates as $key => $row)
    	{
    		$value[$key] = $row['value'];
    	}
    	
    	array_multisort($value, SORT_NUMERIC, SORT_ASC, $rates);

    			foreach ( $rates as $rate )
				{
					if ( $price >= floatval($rate['value']) )
					{
						$final_price = $rate[$type];
					}
				}    	

        return $final_price;
    }    



}
?>