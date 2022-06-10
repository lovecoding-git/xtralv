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

class publicSessions__classifieds {
    /**#@+
	 * Registry shortcuts
	 *
	 * @access	private
	 * @var		object
     */
    private $registry;
    private $request;
    private $settings;
    private $DB;
    private $lang;
    /**#@-*/

    /**
     * Return session variables for this application
     *
     * current_appcomponent, current_module and current_section are automatically
     * stored. This function allows you to add specific variables in.
     *
     * @access	public
     * @return	array
     */

    public function getSessionVariables() {

        $return_array = array();

        if ( $this->request['module'] == 'core' && $this->request['section'] == 'view_item' ) {

            $return_array['location_1_type'] = 'item';
            $return_array['location_1_id']   = intval( $this->request['item_id'] );

        } else if ( $this->request['module'] == 'core' && $this->request['section'] == 'view_category') {

            $return_array['location_2_type'] = 'category';
            $return_array['location_2_id']   = intval( $this->request['category_id'] );

        }

        return $return_array;
    }

    /**
     * Parse/format the online list data for the records
     *
     * @access	public
     * @param	array 			Online list rows to check against
     * @return	array 			Online list rows parsed
     */
    public function parseOnlineEntries( $rows ) {
        if( !is_array($rows) OR !count($rows) ) {
            return $rows;
        }

        $final = array();

        //-----------------------------------------
        // Extract the data
        //-----------------------------------------

        foreach( $rows as $row ) {
            if( $row['current_appcomponent'] == 'classifieds' ) {
                $row['where_line']		= $this->lang->words['cfds_viewing'];
                $row['where_link']		= 'app=classifieds';
            }

            $final[ $row['id'] ] = $row;
        }

        return $final;
    }

}

class itemMarking__classifieds {
    /**
     * Field Convert Data Remap Array
     *
     * This is where you can map your app_key_# numbers to application savvy fields
     *
     * @access	private
     * @var		array
     */
    private $_convertData = array( 'categoryID' => 'item_app_key_1' );

    /**#@+
	* Registry Object Shortcuts
	*
	* @access	protected
	* @var		object
     */
    protected $registry;
    protected $DB;
    protected $settings;
    protected $request;
    protected $lang;
    protected $member;
    protected $cache;
    /**#@-*/

    /**
     * I'm a constructor, twisted constructor
     *
     * @access	public
     * @param	object	ipsRegistry reference
     * @return	void
     */
    public function __construct( ipsRegistry $registry ) {
        /* Make objects */
        $this->registry = $registry;
        $this->DB	    = $this->registry->DB();
        $this->settings =& $this->registry->fetchSettings();
        $this->request  =& $this->registry->fetchRequest();
        $this->lang	    = $this->registry->getClass('class_localization');
        $this->member   = $this->registry->member();
        $this->memberData =& $this->registry->member()->fetchMemberData();
        $this->cache	= $this->registry->cache();
        $this->caches   =& $this->registry->cache()->fetchCaches();
    }

    /**
     * Convert Data
     * Takes an array of app specific data and remaps it to the DB table fields
     *
     * @access	public
     * @param	array
     * @return	array
     */
    public function convertData( $data ) {
        $_data = array();

        foreach( $data as $k => $v ) {
            if ( isset($this->_convertData[$k]) ) {
                # Make sure we use intval here as all 'forum' app fields
                # are integers.
                $_data[ $this->_convertData[ $k ] ] = intval( $v );
            }
            else {
                $_data[ $k ] = $v;
            }
        }

        return $_data;
    }

    /**
     * Fetch unread count
     *
     * Grab the number of items truly unread
     * This is called upon by 'markRead' when the number of items
     * left hits zero (or less).
     *
     *
     * @access	public
     * @param	array 	Array of data
     * @param	array 	Array of read itemIDs
     * @param	int 	Last global reset
     * @return	integer	Last unread count
     */
    public function fetchUnreadCount( $data, $readItems, $lastReset ) {
        $count     = 0;
        $lastItem  = 0;
        $readItems = is_array( $readItems ) ? $readItems : array( 0 );

        if ( $data['categoryID'] ) {

            
            $this->categories = $this->registry->classifieds->helper('categories');


            //-----------------------------------------
            // Grab category
            //-----------------------------------------
            
            $category = $this->categories->getNode($data['categoryID']);


            $count = $this->DB->buildAndFetch( array( 'select' => 'count(i.item_id) AS item_count, MIN(i.date_added) as last_item',
                    'from' => array( 'classifieds_items' => 'i' ),
                    'add_join' => array( 0 => array(
                                    'from'   => array( 'classifieds_categories' => 'c' ),
                                    'where'  => 'i.category_id=c.category_id',
                                    'type'   => 'inner' ) ),
                    'where' => 'c.lft BETWEEN ' . $category['lft'] . ' AND ' . $category['rgt'] . " AND i.active = 1 AND i.open = 1  AND i.item_id NOT IN(".implode(",",array_keys($readItems)).") AND i.date_added > ".intval($lastReset),

                    )		);

            $count = intval($count['item_count']);
            $lastItem = intval( $count['last_item'] );





        }

        return array( 'count'    => $count,
                'lastItem' => $lastItem );
    }
}
