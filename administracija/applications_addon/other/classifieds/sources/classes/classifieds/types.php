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

class classifieds_types {
    public function __construct( $registry ) {
        $this->registry   = $registry;
        $this->DB         = $this->registry->DB();
        $this->settings   = $this->registry->settings();
        $this->request    = $this->registry->request();
        $this->lang       = $this->registry->getClass('class_localization');
    }
  
    /**
     * Grab type
     *
     * @access	public
     * @param   int     Type ID
     * @return	array
     */
    public function getTypeById($type_id) {

        // Grab type
        $type = $this->DB->buildAndFetch( array(	'select' => '*',
                'from' => array('classifieds_types' => 't'),
                'where' => 't.type_id = ' . intval($type_id)
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_type_noid'], '10CFDL2001', false );
        }

        return $type;
    }

    /**
     * Grab types
     *
     * @access	public
     * @return	array
     */
    public function getTypes($ids = array()) {

    	if (!empty($ids)) {
          $this->DB->build( array(    'select' => '*',
                'from' => array( 'classifieds_types' => 't' ),
          		'where' => "t.type_id IN (" . implode(',', $ids)  . ")",
                'order' => 'sort_order ASC',
                )		);  		
    		
    	} else {
        // Grab types
        $this->DB->build( array(    'select' => '*',
                'from' => array( 'classifieds_types' => 't' ),
                'order' => 'sort_order ASC',
                )		);
    	}

        $this->DB->execute();

        while( $row = $this->DB->fetch() ) {

            $types[] = $row;

        }

        return $types;
    }
    
    public function getTypeJumpList() {
    	
    	$types = array();
         
        $this->DB->build( array(
                'select' => '*',
                'from'   => 'classifieds_types',
               
        ));

        $this->DB->execute();


		
        while ( $row = $this->DB->fetch() ) {
               $types[] = array($row['type_id'], $row['name']);
        }

        return $types;


    }      

}
?>