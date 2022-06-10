<?php

/**
 *
 * Classifieds 1.1.2
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

class classifieds_conditions {
    public function __construct( $registry ) {
        $this->registry   = $registry;
        $this->DB         = $this->registry->DB();
        $this->settings   = $this->registry->settings();
        $this->request    = $this->registry->request();
        $this->lang       = $this->registry->getClass('class_localization');
    }
  
    /**
     * Grab condition
     *
     * @access	public
     * @param   int     Condition ID
     * @return	array
     */
    public function getConditionById($condition_id) {

        // Grab condition
        $condition = $this->DB->buildAndFetch( array(	'select' => '*',
                'from' => array('classifieds_conditions' => 'c'),
                'where' => 'condition_id = ' . intval($condition_id)
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_condition_noid'], '10CFDL2001', false );
        }

        return $condition;
    }

    /**
     * Grab conditions
     *
     * @access	public
     * @return	array
     */
    public function getConditions() {

        // Grab conditions

        $this->DB->build( array(    'select' => '*',
                'from' => array( 'classifieds_conditions' => 'c' ),
                'order' => 'sort_order ASC',
                )		);

        $this->DB->execute();

        while( $row = $this->DB->fetch() ) {

            $conditions[] = $row;

        }

        return $conditions;
    }

}
?>