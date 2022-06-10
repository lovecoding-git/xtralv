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

class classifieds_fields {
    /**
     * Constructor.
     *
     * @param   object  $registry       The IPS Registry object
     */
    public function __construct( $registry ) {
        $this->registry   = $registry;
        $this->DB         = $this->registry->DB();
		$this->lang		= $this->registry->class_localization;
    }

    public function getGlobals() {
    	
    	$globalfields = array();

        $this->DB->build( array(
                'select' => '*',
                'from'   => 'classifieds_fields',
        		'where'	=> 'group_id = 0 AND set_id = 0',
        		'order' => 'sort_order ASC',
               
        ));

        $this->DB->execute();

        $fields = array();

        while ( $row = $this->DB->fetch() ) {
               $globalfields[] = $row;
        }

        return $globalfields;


    }      
    
    public function getSets() {
    	
    	$sets = array();

        $this->DB->build( array(
                'select' => '*',
                'from'   => 'classifieds_field_sets',
               
        ));

        $this->DB->execute();

        $fields = array();

        while ( $row = $this->DB->fetch() ) {
               $sets[] = $row;
        }

        return $sets;


    }  
    
    public function getSetJumpList() {
    	
    	$sets = array();
        $sets[] = array(0, $this->lang->words['cfds_select_fieldset'] );
        
        $this->DB->build( array(
                'select' => '*',
                'from'   => 'classifieds_field_sets',
               
        ));

        $this->DB->execute();


		
        while ( $row = $this->DB->fetch() ) {
               $sets[] = array($row['set_id'], $row['name']);
        }

        return $sets;


    }      

    public function getSetById( $set_id ) {

        // Grab set
        $set = $this->DB->buildAndFetch( array(	'select' => '*',
                'from' => 'classifieds_field_sets',
                'where' => 'set_id = ' . intval($set_id)
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_no_fieldset'], '10CFDL3001', false );
        }

        return $set;


    }   

    
    public function deleteSet ( $set_id ) {

        // Delete Field
        $this->DB->delete( 'classifieds_field_sets', 'set_id = ' . intval($set_id));

    }    
    
    public function getFields( $set ) {
    	
        $this->DB->build( array(
                'select' => '*',
                'from'   => 'classifieds_field_groups',
        		'where'	 => 'set_id = ' . intval($set),
                'order'  => 'sort_order',
        ));

        $this->DB->execute();

        $fields = array();

        while ( $row = $this->DB->fetch() ) {
            $key = $row['group_id'];
            $fields[$key] = $row;
        }

        /* Get the fields */
        $this->DB->build( array(
                'select'   => 'f.*',
                'from'     => array( 'classifieds_fields' => 'f' ),
        		'where'	 => 'f.set_id = ' . intval($set),
                'order'    => 'f.sort_order',
                'add_join' => array(
                        array(
                                'select' => 'g.*',
                                'from'   => array( 'classifieds_field_groups' => 'g' ),
                                'where'  => 'f.group_id=g.group_id',
                                'type'   => 'left'
                        )
                )
                )	);

        $this->DB->execute();

        // Sort fields into array by group key
        if ( $this->DB->getTotalRows() ) {
            while ( $row = $this->DB->fetch() ) {

                $key = $row['group_id'];
                $fields[$key][fields][$row['field_id']] = $row;

            }
        }

        return $fields;


    }

    public function getFieldById( $field_id ) {

        // Grab field
        $field = $this->DB->buildAndFetch( array(	'select' => '*',
                'from' => 'classifieds_fields',
                'where' => 'field_id = ' . intval($field_id)
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_no_field'], '10CFDL3002', false );
        }

        return $field;


    }

    public function getGroupById( $group_id ) {

        // Grab field group
        $group = $this->DB->buildAndFetch( array(	'select' => '*',
                'from' => 'classifieds_field_groups',
                'where' => 'group_id = ' . intval($group_id)
                )		);

        if ( $this->DB->getTotalRows() == 0 ) {
            $this->registry->getClass('output')->showError( $this->lang->words['cfds_no_fieldgroup'], '10CFDL3003', false );
        }

        return $group;


    }

    public function getFieldsByItemId( $item_id, $includeEmpty = true, $category ) {


    	// @todo we need to first check to make sure this cat has a set and if not traverse the path and find first ancestor
    	
    	if ($category['fieldset_id']) {
    		$set = $category['fieldset_id'];
    	} else {
    		
    		// let's do the check 
    		$ancestors = $this->registry->classifieds->helper('categories')->getPath($category);
    		
    		if ($ancestors) {
    			
    			$ancestors = array_reverse($ancestors);
    			
    			foreach($ancestors as $ancestor) {

    				if ($ancestor['fieldset_id']) {
    					$set = $ancestor['fieldset_id'];
    					break;
    				}
    				
    			}
    			
    		}
    		
    	}
    	
    	
        $groups = $this->getGroups($set);

        $fields = array();

        if ($groups) {
            foreach ( $groups as $row ) {
                $key = $row['group_id'];
                $fields[$key] = $row;
            }
        }

        /* Get the fields */
        $this->DB->build( array(
                'select'   => 'f.*',
                'from'     => array( 'classifieds_fields' => 'f' ),
                'order'    => 'f.sort_order',
                'add_join' => array(

                        0 => array(
                                'select' => 'e.field_entry_id, e.value',
                                'from'   => array( 'classifieds_field_entries' => 'e' ),
                                'where'  => 'e.field_id=f.field_id AND e.item_id = ' . intval($item_id),
                                'type'   => 'left'
                        ),
                ),
                'where' => 'f.active = 1 AND (f.set_id = 0 OR f.set_id = ' . intval($set) . ')',

                )	);

        $this->DB->execute();

        // Sort fields into array by group key
        if ( $this->DB->getTotalRows() ) {
            while ( $row = $this->DB->fetch() ) {
                //$fields[] = $row;
                $key = $row['group_id'] ? $row['group_id'] : '0';

                if ($row['options'] != "") {
                    $row['options'] = explode("|", $row['options']);
                }

                
                    if ($row['value'] != "" || $includeEmpty == true || $row['type'] == "checkbox") {

                        $fields[$key][fields][$row['field_id']] = $row;

                    }

                


            }
        }

        return array_reverse($fields);


    }

    public function getGroups($set = 0) {
    	
    	$where = array();
    	
    	if ($set) {
    		$where[] = 'set_id = ' . intval($set);
    	} else {
    		return null;
    	}

        $this->DB->build( array(
                'select' => '*',
                'from'   => 'classifieds_field_groups',
        		'where'	 => ( count($where) ? implode( ' AND ', $where ) : '' ), 
                'order'  => 'sort_order',
        ));

        $this->DB->execute();

        while ( $row = $this->DB->fetch() ) {

            $groups[] = $row;

        }

        return $groups;
    }

    public function getFlatFields ($category) {
    	
        if ($category['fieldset_id']) {
    		$set = $category['fieldset_id'];
    	} else {
    		
    		// let's do the check 
    		$ancestors = $this->registry->classifieds->helper('categories')->getPath($category);
    		
    		if ($ancestors) {
    			
    			$ancestors = array_reverse($ancestors);
    			
    			foreach($ancestors as $ancestor) {

    				if ($ancestor['fieldset_id']) {
    					$set = $ancestor['fieldset_id'];
    					break;
    				}
    				
    			}
    			
    		}
    		
    	}    	

        $this->DB->build( array(
                'select' => '*',
                'from'   => 'classifieds_fields',
                //'where'  => 'active = 1 AND set_id = ' . intval($set),
        		'where' => 'active = 1 AND (set_id = 0 OR set_id = ' . intval($set) . ')',
        
        ));

        $this->DB->execute();

        while ( $row = $this->DB->fetch() ) {

            $fields[] = $row;

        }

        return $fields;


    }

    public function deleteField ( $field_id ) {

        // Delete Field
        $this->DB->delete( 'classifieds_fields', 'field_id = ' . intval($field_id));

        // Delete field entries
        $this->DB->delete( 'classifieds_field_entries', 'field_id = ' . intval($field_id));

    }


}