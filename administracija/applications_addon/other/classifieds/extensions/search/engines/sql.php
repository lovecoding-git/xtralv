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

class search_engine_classifieds extends search_engine {
    /**
     * Constructor
     */
    public function __construct( ipsRegistry $registry ) {
        parent::__construct( $registry );

        $this->lang->loadLanguageFile( array( 'public_lang' ), 'classifieds' );
    }

    /**
     * Perform a search.
     * Returns an array of a total count (total number of matches)
     * and an array of IDs ( 0 => 1203, 1 => 928, 2 => 2938 ).. matching the required number based on pagination. The ids returned would be based on the filters and type of search
     *
     * So if we had 1000 replies, and we are on page 2 of 25 per page, we'd return 25 items offset by 25
     *
     * @access public
     * @return array
     */
    public function search() {
        /* INIT */
        $count       		= 0;
        $results     		= array();
        $sort_by     		= IPSSearchRegistry::get('in.search_sort_by');
        $sort_order         = IPSSearchRegistry::get('in.search_sort_order');
        $search_term        = IPSSearchRegistry::get('in.clean_search_term');
        $content_title_only = IPSSearchRegistry::get('opt.searchTitleOnly');
        $post_search_only   = IPSSearchRegistry::get('opt.onlySearchPosts');
        $order_dir 			= ( $sort_order == 'asc' ) ? 'asc' : 'desc';
        $sortKey			= '';
        $sortType			= '';
        $group_by = 'i.item_id';
        $rows               = array();


        /* Sorting */
        switch( $sort_by ) {
            default:
            case 'date':
                $sortKey  = 'i.date_updated';
                $sortType = 'numerical';
                break;

        }

        /* Query the count */
        $count = $this->DB->buildAndFetch( array(
                'select'   => 'COUNT(*) as total_results',
                'from'	   => array( 'classifieds_items' => 'i' ),
                'where'	   => $this->_buildWhereStatement( $search_term, $content_title_only ),
                'group'    => $group_by,

                )		);


        $this->DB->build( array(
                'select'   => "i.*",
                'from'	   => array( 'classifieds_items' => 'i' ),
                'where'	   => $this->_buildWhereStatement( $search_term, $content_title_only ),
                'group'    => $group_by,
                'order'    => $sortKey . ' ' . $sort_order,
                'limit'    => array( IPSSearchRegistry::get('in.start'), IPSSearchRegistry::get('opt.search_per_page') ),
                'add_join' => array(
                        0 => array(
                                'select' => 'm.members_display_name, m.member_group_id, m.mgroup_others, m.members_seo_name',
                                'from'   => array( 'members' => 'm' ),
                                'where'  => "m.member_id=i.member_id",
                                'type'   => 'left',
                        ),
                        1 => array( 'select' => 'a.attach_id, a.thumb_location',
                                'from'   => array( 'classifieds_images' => 'a' ),
                                'where'  => 'a.item_id = i.item_id',
                                'type'   => 'left' ),

                )
                )	);

        $this->DB->execute();

        /* Build result array */
        $rows = array();

        while( $r = $this->DB->fetch() ) {

            $r['is_read'] = 0;
            // Check if this item has been read and add status to array

            // Has the item been updated? If yes use date_updated otherwise use date_added
            //$last_updated = ($row['date_updated']) ? $row['date_updated'] : $row['date_added'];
            $last_updated = $r['date_added'];

            $r['is_read'] = $this->registry->classItemMarking->isRead( array( 'categoryID' => $r['category_id'], 'itemID' => $r['item_id'], 'itemLastUpdate' => $last_updated ), 'classifieds' );

            // Parse description for display

            IPSText::getTextClass('bbcode')->parse_html 		= 0;
            IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
            IPSText::getTextClass('bbcode')->parse_smilies		= 0;
            IPSText::getTextClass('bbcode')->parsing_section	= 'classifieds_description';
            IPSText::getTextClass( 'bbcode' )->parsing_mgroup	= $r['member_group_id'];
            IPSText::getTextClass( 'bbcode' )->parsing_mgroup_others = $r['mgroup_others'];

            $r['description'] = IPSText::getTextClass('bbcode')->preDisplayParse( $r['description'] );

            $rows[] = $r;
        }





        /* Return it */
        return array( 'count' => $count['total_results'], 'resultSet' => $rows );
    }



    /**
     * Perform the viewNewContent search
     *
     * @access	public
     * @return
     */
    public function viewNewContent() {

        $start		= IPSSearchRegistry::get('in.start');
        $perPage	= IPSSearchRegistry::get('opt.search_per_page');
        $group_by = 'i.item_id';

        IPSSearchRegistry::set('in.search_sort_by'   , 'date' );
        IPSSearchRegistry::set('in.search_sort_order', 'desc' );
        IPSSearchRegistry::set('opt.searchTitleOnly' , true );
        IPSSearchRegistry::set('display.onlyTitles'  , true );
        IPSSearchRegistry::set('opt.noPostPreview'   , true );

        if ( IPSSearchRegistry::get('in.period_in_seconds') !== false ) {
        	$oldStamp = intval( IPS_UNIX_TIME_NOW - IPSSearchRegistry::get('in.period_in_seconds') );
  		}
 		elseif ( ! $oldStamp OR $oldStamp == IPS_UNIX_TIME_NOW ) {
    
 			$oldStamp = intval( $this->memberData['last_visit'] );

     	}
     	
        /* Start Where */
        $where		= array();
        $where[]	= $this->_buildWhereStatement( '' );

        /* Based on oldest timestamp */
        $where[] = "i.date_updated > " . $oldStamp;

        $where = implode( " AND ", $where );


        /* Query the count */
        $count = $this->DB->buildAndFetch( array(
                'select'   => 'COUNT(*) as total_results',
                'from'	   => array( 'classifieds_items' => 'i' ),
                'where'	   => $where,
                'group'    => $group_by,

                )		);

        /* Fetch the data */
        $items = array();

        if( $count['total_results'] ) {
            $this->DB->build( array(
                    'select'   => "i.*",
                    'from'	   => array( 'classifieds_items' => 'i' ),
                    'where'	   => $where,
                    'group'    => $group_by,
                    'order'    => 'i.date_updated DESC',
                    'limit'    => array( $start, $perPage ),
                    'add_join' => array(
                            0 => array(
                                    'select' => 'm.members_display_name, m.member_group_id, m.mgroup_others, m.members_seo_name',
                                    'from'   => array( 'members' => 'm' ),
                                    'where'  => "m.member_id=i.member_id",
                                    'type'   => 'left',
                            ),
                            1 => array( 'select' => 'a.attach_id, a.thumb_location',
                                    'from'   => array( 'classifieds_images' => 'a' ),
                                    'where'  => 'a.item_id = i.item_id',
                                    'type'   => 'left',
                                ),

                    )
                    )	);

            $this->DB->execute();

            while( $r = $this->DB->fetch() ) {

                $r['is_read'] = 0;
                // Check if this item has been read and add status to array

                // Has the item been updated? If yes use date_updated otherwise use date_added
                //$last_updated = ($row['date_updated']) ? $row['date_updated'] : $row['date_added'];
                $last_updated = $r['date_added'];

                $r['is_read'] = $this->registry->classItemMarking->isRead( array( 'categoryID' => $r['category_id'], 'itemID' => $r['item_id'], 'itemLastUpdate' => $last_updated ), 'classifieds' );


                $items[] = $r;
            }
        }

        
        /* Set up some vars */
        IPSSearchRegistry::set('set.resultCutToDate', $oldStamp );

        /* Return it */
        return array( 'count' => $count['total_results'], 'resultSet' => $items );


    }



    /**
     * Perform the active content search
     *
     * @access	public
     * @return
     */
    public function viewActiveContent() {
    	
    	$group_by = 'i.item_id';
    	
        $seconds = IPSSearchRegistry::get('in.period_in_seconds');

        /* Loop through the forums and build a list of forums we're allowed access to */
        $where		= array();
        $start		= IPSSearchRegistry::get('in.start');
        $perPage    = IPSSearchRegistry::get('opt.search_per_page');

        /* Start Where */
        $where		= array();
        //  $where[]	= $this->_buildWhereStatement( '' );

        /* Generate last post times */
        $where[] = "i.date_updated > " . intval( time() - $seconds );

        $where = implode( " AND ", $where );


        /* Fetch the count */
        $count = $this->DB->buildAndFetch( array(
                'select'   => 'COUNT(*) as total_results',
                'from'	   => array( 'classifieds_items' => 'i' ),
                'where'	   => $where,
                'group'    => $group_by,

                )		);

        /* Fetch count */
        $items = array();

        if( $count['total_results'] ) {
            $this->DB->build( array(
                    'select'   => "i.*",
                    'from'	   => array( 'classifieds_items' => 'i' ),
                    'where'	   => $where,
                    'group'    => $group_by,
                    'order'    => 'i.date_updated DESC',
                    'limit'    => array( IPSSearchRegistry::get('in.start'), IPSSearchRegistry::get('opt.search_per_page') ),
                    'add_join' => array(
                            0 => array(
                                    'select' => 'm.members_display_name, m.member_group_id, m.mgroup_others, m.members_seo_name',
                                    'from'   => array( 'members' => 'm' ),
                                    'where'  => "m.member_id=i.member_id",
                                    'type'   => 'left',
                            ),
                            1 => array( 'select' => 'a.attach_id, a.thumb_location',
                                    'from'   => array( 'classifieds_images' => 'a' ),
                                    'where'  => 'a.item_id = i.item_id',
                                    'type'   => 'left' ),

                    )
                    )	);
            $this->DB->execute();

            while( $r = $this->DB->fetch() ) {

                $r['is_read'] = 0;
                // Check if this item has been read and add status to array

                // Has the item been updated? If yes use date_updated otherwise use date_added
                //$last_updated = ($row['date_updated']) ? $row['date_updated'] : $row['date_added'];
                $last_updated = $r['date_added'];

                $r['is_read'] = $this->registry->classItemMarking->isRead( array( 'categoryID' => $r['category_id'], 'itemID' => $r['item_id'], 'itemLastUpdate' => $last_updated ), 'classifieds' );


                $items[] = $r;
            }
        }

        /* Return it */
        return array( 'count' => $count['total_results'], 'resultSet' => $items );
    }




    /**
     * Perform the viewUserContent search
     *
     * @access	public
     */

    public function viewUserContent( $member ) {
    	
        /* Init */
        $start		= IPSSearchRegistry::get('in.start');
        $perPage	= IPSSearchRegistry::get('opt.search_per_page');
        IPSSearchRegistry::set( 'in.search_sort_by'   , 'date' );
        IPSSearchRegistry::set( 'in.search_sort_order', 'desc' );
        $group_by = 'i.item_id';

        /* Ensure we limit by date */
        $this->settings['search_ucontent_days'] = ( $this->settings['search_ucontent_days'] ) ? $this->settings['search_ucontent_days'] : 365;

        /* Start Where */
        $where	= array();
        $where[]	= $this->_buildWhereStatement( '' );

        /* Search by author */
        $where[] = "i.member_id=" . intval( $member['member_id'] );

        if ( $this->settings['search_ucontent_days'] ) {
            $where[] = "i.date_updated > " . ( time() - ( 86400 * intval( $this->settings['search_ucontent_days'] ) ) );
        }

        $where = implode( " AND ", $where );

        /* Fetch the count */

        $count = $this->DB->buildAndFetch( array(
                'select'   => 'COUNT(*) as total_results',
                'from'	   => array( 'classifieds_items' => 'i' ),
                'where'	   => $where,


                )		);

        /* Fetch the data */
        $items = array();

        if( $count['total_results'] ) {
            $this->DB->build( array(
                    'select'   => "i.*",
                    'from'	   => array( 'classifieds_items' => 'i' ),
                    'where'	   => $where,
                    'group'    => $group_by,
                    'order'    => 'i.date_updated DESC',
                    'limit'    => array( IPSSearchRegistry::get('in.start'), IPSSearchRegistry::get('opt.search_per_page') ),
                    'add_join' => array(
                            0 => array(
                                    'select' => 'm.members_display_name, m.member_group_id, m.mgroup_others, m.members_seo_name',
                                    'from'   => array( 'members' => 'm' ),
                                    'where'  => "m.member_id=i.member_id",
                                    'type'   => 'left',
                            ),
                            1 => array( 'select' => 'a.attach_id, a.thumb_location',
                                    'from'   => array( 'classifieds_images' => 'a' ),
                                    'where'  => 'a.item_id = i.item_id',
                                    'type'   => 'left' ),

                    )
                    )	);

            $this->DB->execute();

            while( $r = $this->DB->fetch() ) {

                $r['is_read'] = 0;
                // Check if this item has been read and add status to array

                // Has the item been updated? If yes use date_updated otherwise use date_added
                //$last_updated = ($row['date_updated']) ? $row['date_updated'] : $row['date_added'];
                $last_updated = $r['date_added'];

                $r['is_read'] = $this->registry->classItemMarking->isRead( array( 'categoryID' => $r['category_id'], 'itemID' => $r['item_id'], 'itemLastUpdate' => $last_updated ), 'classifieds' );


                $items[] = $r;
            }
        }

        /* Return it */
        return array( 'count' => $count['total_results'], 'resultSet' => $items );
    }






    /**
     * Builds the where portion of a search string
     *
     * @access	private
     * @param	string	$search_term		The string to use in the search
     * @param	bool	$content_title_only	Search only title records
     * @return	string
     **/
    private function _buildWhereStatement( $search_term, $content_title_only=false ) {
        /* INI */
        $where_clause = array();
        $where_clause[] = "i.date_expiry > " . time();
        $where_clause[] = "i.open = 1";
        $where_clause[] = "i.active = 1";

        if( $search_term ) {
            if( $content_title_only ) {
                $where_clause[] = "i.name LIKE '%{$search_term}%'";
            }
            else {
                $where_clause[] = "(i.name LIKE '%{$search_term}%' OR i.description LIKE '%{$search_term}%')";
            }
        }


        /* Date Restrict */
        if( $this->search_begin_timestamp && $this->search_end_timestamp ) {
            $where_clause[] = $this->DB->buildBetween( "i.date_updated", $this->search_begin_timestamp, $this->search_end_timestamp );
        }
        else {
            if( $this->search_begin_timestamp ) {
                $where_clause[] = "i.date_updated > {$this->search_begin_timestamp}";
            }

            if( $this->search_end_timestamp ) {
                $where_clause[] = "i.date_updated < {$this->search_end_timestamp}";
            }
        }

        /* Add in AND where conditions */
        if( isset( $this->whereConditions['AND'] ) && count( $this->whereConditions['AND'] ) ) {
            $where_clause = array_merge( $where_clause, $this->whereConditions['AND'] );
        }

        /* ADD in OR where conditions */
        if( isset( $this->whereConditions['OR'] ) && count( $this->whereConditions['OR'] ) ) {
            $where_clause[] = '( ' . implode( ' OR ', $this->whereConditions['OR'] ) . ' )';
        }


        /* Build and return the string */
        return implode( " AND ", $where_clause );
    }


    /**
     * Returns an array used in the searchplugin's setCondition method
     *
     * @access	public
     * @param	array 	$data	Array of forums to view
     * @return	array 	Array with column, operator, and value keys, for use in the setCondition call
     **/
    public function buildFilterSQL( $data ) {
        /* INIT */
        $return = array();

        /* Set up some defaults */
        IPSSearchRegistry::set( 'opt.noPostPreview'  , false );
        IPSSearchRegistry::set( 'opt.onlySearchPosts', false );

        return array();
    }

    /**
     * Remap standard columns (Apps can override )
     *
     * @access	public
     * @param	string	$column		sql table column for this condition
     * @return	string				column
     * @return	void
     */
    public function remapColumn( $column ) {
        $column = $column == 'member_id' ? 'i.member_id' : $column;

        return $column;
    }


    /**
     * Can handle boolean searching
     *
     * @access	public
     * @return	boolean
     */
    public function isBoolean() {
        return false;
    }
}