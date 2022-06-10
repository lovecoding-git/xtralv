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

if (!defined('IN_IPB')) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit;
}

class classifieds_items {

    public function __construct($registry) {
        $this->registry = $registry;
        $this->DB = $this->registry->DB();
        $this->settings = $this->registry->settings();
        $this->request = $this->registry->request();
        $this->lang = $this->registry->getClass('class_localization');
    }

    /**
     * Retrieve Items in Category
     *
     * @param array    Category array
     * @param bool   Return an attachment with each item?
     * return array
     *
     */
    public function getItems($category = array(), $limit = array(), $attachment = 'FALSE', $order = '', $filters = array()) {

        
    	if(empty($category)) {
    		$category = $this->registry->classifieds->helper('categories')->getNode(1);
    	}
    	
    	$joins = array();
        $where = array();
    	    
        
        //-----------------------------------------
        // Build Joins
        //-----------------------------------------
        
        
        // Category       
        $joins[] = array('select' => 'c.lft, c.rgt, c.name AS catname, c.seo_title AS catseo, c.category_id',
                        'from' => array('classifieds_categories' => 'c'),
                        'where' => 'i.category_id=c.category_id',
                        'type' => 'left');
        // Category       
        $joins[] = array('select' => 't.type_id, t.name AS advert_type, t.show_badge, t.badge_color, t.zero_text',
                        'from' => array('classifieds_types' => 't'),
                        'where' => 'i.advert_type=t.type_id',
                        'type' => 'left');        
        
     
        // Attachments        
        if ($attachment) {
        	
        	$joins[] = array('select' => 'a.attach_id, a.thumb_location',
                        'from' => array('classifieds_images' => 'a'),
                        'where' => 'a.item_id = i.item_id',
                        'type' => 'left');
        	
        }

        //-----------------------------------------
        // Build Where
        //-----------------------------------------
        

        $where[] = 'c.lft BETWEEN ' . intval($category['lft']) . ' AND ' . intval($category['rgt']);
        
    	if( is_array($filters) AND count($filters) )
		{
			$where	= array_merge( $where, $filters );
		}
		
        //-----------------------------------------
        // Order
        //-----------------------------------------
		
		$order	= $order ? $order : 'i.date_added desc';
		
        //-----------------------------------------
        // Limit
        //-----------------------------------------
        
        if (!$limit) {
            $limit = array(ipsRegistry::$request['st'], (intval($this->settings['classifieds_items_per_page']) < 1) ? 10 : intval($this->settings['classifieds_items_per_page']));
        }
        
        //-----------------------------------------
        // And Run...
        //-----------------------------------------
                      

            $this->DB->build(array('select' => 'i.*',
                'from' => array('classifieds_items' => 'i'),
                'add_join' => $joins,
                'where' => ( count($where) ? implode( ' AND ', $where ) : '' ),
                'limit' => $limit,
                'order' => $order,
                'group' => 'i.item_id',
                    ));
        
		
        $res = $this->DB->execute();

		//-----------------------------------------
        // Loop and add additional output
        //-----------------------------------------

        while ($row = $this->DB->fetch($res)) {
            
        	$row['is_read'] = 0;
            
        	// Check if this item has been read and add status to array
            $last_updated = $row['date_added'];

            $row['is_read'] = $this->registry->classItemMarking->isRead(array('categoryID' => intval($row['category_id']), 'itemID' => intval($row['item_id']), 'itemLastUpdate' => intval($last_updated)), 'classifieds');

            // unserialize that array
            $row['package_info'] = unserialize($row['package_info']);
            
            // Add item info to array
            $_items[] = $row;
        }
        
        if ($_items) {
            foreach ($_items as $item) {

                // Parse description for display
                $item['description'] = $this->parseDescriptionForDisplay($item['description']);

                // Has it expired?
                $item['expired'] = ($item['date_expiry'] < IPSTime::getTimestamp()) ? 1 : 0;
                
                // merge in member info
                $item['member'] = IPSMember::load($item['member_id'], 'all', 'id');
                $item['member'] = IPSMember::buildProfilePhoto($item['member']);

                $items[] = $item;
            }
        }

        return $items;
    }

    /**
     * Count Items 
     *
     * @param int    Category primary key
     * return int
     *
     */
    public function countItems($category = 1, $filters = array()) {
    	
        if(empty($category)) {
    		$category = $this->registry->classifieds->helper('categories')->getNode(1);
    	}
    	
    	$where = array();
    	
        $where[] = 'c.lft BETWEEN ' . intval($category['lft']) . ' AND ' . intval($category['rgt']);
        
        if( is_array($filters) AND count($filters) )
		{
			$where	= array_merge( $where, $filters );
		}

        $count = $this->DB->buildAndFetch(array('select' => 'count(i.item_id) AS item_count',
                    'from' => array('classifieds_items' => 'i'),
                    'add_join' => array(0 => array(
                            'from' => array('classifieds_categories' => 'c'),
                            'where' => 'i.category_id=c.category_id',
                            'type' => 'inner')),
                    'where' => ( count($where) ? implode( ' AND ', $where ) : '' ),
                        ));

        $count = $count['item_count'];
        return $count;
    }
    
    /**
     * Distinct Types 
     *
     * @param int    Category primary key
     * return array
     *
     */
    public function distinctTypes($category = 1, $filters = array()) {
    	
        if(empty($category)) {
    		$category = $this->registry->classifieds->helper('categories')->getNode(1);
    	}
    	
    	$where = array();
    	
        $where[] = 'c.lft BETWEEN ' . intval($category['lft']) . ' AND ' . intval($category['rgt']);
        
        if( is_array($filters) AND count($filters) )
		{
			$where	= array_merge( $where, $filters );
		}

        $count = $this->DB->build(array('select' => 'DISTINCT i.advert_type AS type',
                    'from' => array('classifieds_items' => 'i'),
                    'add_join' => array(0 => array(
                            'from' => array('classifieds_categories' => 'c'),
                            'where' => 'i.category_id=c.category_id',
                            'type' => 'inner')),
                    'where' => ( count($where) ? implode( ' AND ', $where ) : '' ),
                        ));
                        
        $this->DB->execute();

        while( $row = $this->DB->fetch() ) {

            $types[] = $row['type'];

        }

        return $types;                        

    }    

    /**
     * Retrieve item by primary key
     *
     * @param int    Item primary key
     * return array
     *
     */
    public function getItemById($item_id) {

        // Grab item
        $item = $this->DB->buildAndFetch(array('select' => 'i.item_id, i.category_id, i.member_id, i.name, i.description, i.price, i.date_added, i.date_updated, i.views, i.date_expiry, i.active, i.open, i.attachments, i.date_added, i.seo_title, i.advert_type, i.post_key, i.renewals, i.package_info',
                    'from' => array('classifieds_items' => 'i'),
                    'add_join' => array(0 => array('select' => 'a.attach_id, a.thumb_location',
                        'from' => array('classifieds_images' => 'a'),
                        'where' => 'a.item_id = i.item_id',
                        'type' => 'left'),
 						1 =>	array('select' => 't.type_id, t.name AS advert_type, t.show_badge, t.badge_color, t.zero_text',
                        'from' => array('classifieds_types' => 't'),
                        'where' => 'i.advert_type=t.type_id',
                        'type' => 'left'),                            
                    ),
                    'where' => 'i.item_id = ' . intval($item_id)
                        ));

        if ($this->DB->getTotalRows() == 0) {
            $this->registry->getClass('output')->showError($this->lang->words['cfds_no_item'], '10CFDL4001', null, null, 410);
        }

        // Has it expired?
        $item['expired'] = ($item['date_expiry'] < IPSTime::getTimestamp()) ? 1 : 0;

        // Unserialize package info
        $item['package_info'] = unserialize($item['package_info']);
 

        return $item;
    }

    /**
     * Retrieve a random item
     *
     * return int
     *
     */
    public function getRandom() {

        // Grab item
        $record = $this->DB->buildAndFetch(array('select' => 'item_id',
                    'from' => 'classifieds_items',
                    'where' => 'active = 1 AND open = 1 AND date_expiry > ' . IPSTime::getTimestamp(),
                    'order' => 'RAND()',
                    'limit' => '1',
                        ));

        if ($this->DB->getTotalRows() == 0) {
            return NULL;
        }

        $item = $this->getItemById($record['item_id']);
        $item['seller'] = IPSMember::load($item['member_id'], 'profile_portal', 'id');

        return $item;
    }



     /**
     * Retrieve items for prune
     *
     * return array
     *
     */
    public function getItemsForPrune() {

        // Grab items

        $this->DB->build(array('select' => 'i.item_id',
            'from' => array('classifieds_items' => 'i'),
            'where' => 'i.expired = 1 AND date_expiry < ' . ( IPSTime::getTimestamp() - ($this->settings['classifieds_prune_listings'] * 86400) ),
            'limit' => "0, 10",
            'order' => 'date_added ASC',
                ));

        $this->DB->execute();

        while ($row = $this->DB->fetch()) {
            $items[] = $row['item_id'];
        }

        return $items;
    }



    /**
     * Delete the item and associated content
     *
     * @param array    Items
     * return int
     *
     */
    public function deleteItems($items = array()) {

        //-----------------------------------------
        // Remove Items from DB
        //-----------------------------------------

        $this->DB->delete('classifieds_items', 'item_id IN (' . implode(',', $items) . ')');

        //-----------------------------------------
        // Delete Attachments
        //-----------------------------------------


        if (!is_object($this->class_attach)) {
            require_once( IPSLib::getAppDir('core') . '/sources/classes/attach/class_attach.php' );
            $this->class_attach = new class_attach($this->registry);
        }

        $this->class_attach->type = 'classifieds';
        $this->class_attach->init();

        $this->class_attach->bulkRemoveAttachment($items);
        
        // Don't forget classifieds specific attachment data

		$this->DB->delete('classifieds_images', 'item_id IN (' . implode(',', $items) . ')');
		
        //-----------------------------------------
        // Delete Custom Fields
        //-----------------------------------------

        $this->DB->delete('classifieds_field_entries', 'item_id IN (' . implode(',', $items) . ')');

        //-----------------------------------------
        // Delete Questions
        //-----------------------------------------

        $this->DB->delete('classifieds_questions', 'item_id IN (' . implode(',', $items) . ')');
        
        return count($items);
        
    }
    
     /**
     * Move items
     *
     * return array
     *
     */
    public function moveItems($items = array(), $newcat) {

        //-----------------------------------------
        // Move Items
        //-----------------------------------------

        $this->DB->update('classifieds_items', array('category_id' => intval($newcat)), 'item_id IN (' . implode(',', $items) . ')');

        return count($items);
    }    

    public function subscribe($item, $member) {

        // check not already subscribed
        $current_sub = $this->DB->buildAndFetch(
                        array('select' => 'sub_toid',
                            'from' => 'classifieds_subscriptions',
                            'where' => "sub_type  ='item' AND sub_toid = " . $item . " AND sub_mid = " . $member
                        )
        );


        if ($this->DB->getTotalRows() != 0) {
            $this->registry->getClass('output')->showError($this->lang->words['cfds_item_already_subscribed'], 10900, false);
        } else {

            // Add the subscription

            $this->DB->insert('classifieds_subscriptions', array('sub_mid' => $member,
                'sub_type' => 'item',
                'sub_toid' => $item,
                'sub_added' => time()
                    ));
        }
    }

    public function unsubscribe($item, $member) {

        $this->DB->delete('classifieds_subscriptions', "sub_type='item' AND sub_toid = " . $item . " AND sub_mid = " . $member);
    }

    public function isSubscribed($item, $member) {

        $check = $this->DB->buildAndFetch(array('select' => 'count(sub_id) as count', 'from' => 'classifieds_subscriptions', 'where' => "sub_type = 'item' AND sub_toid = " . $item . " AND sub_mid = " . $member));

        return $check['count'] > 0;
    }
    
    /**
     * Retrieve Attachment Data
     *
     * @param int    Item primary key

     * return array
     *
     */
    public function getAttachmentData($item) {
    	
    	// Need to add a join for medium image data here

    	$this->DB->build(array('select' => '*',
            'from' => 'classifieds_images',
            'where' => "item_id = {$item}",
    		'order' => "attach_id ASC"
                ));

        $this->DB->execute();

        while ($row = $this->DB->fetch()) {
            $attachments[] = $row;
        }

        return $attachments;
  
    }

    public function parseDescriptionForDisplay($description) {

        IPSText::getTextClass('bbcode')->parse_html = 0;
        IPSText::getTextClass('bbcode')->parse_bbcode = 1;
        IPSText::getTextClass('bbcode')->parse_smilies = 0;
        IPSText::getTextClass('bbcode')->parsing_section = 'classifieds_description';

        $description = IPSText::getTextClass('bbcode')->preDisplayParse($description);

        return $description;
    }
    
     /**
     * Feature items
     *
     * return array
     *
     */
    public function featureItems($items = array()) {

        //-----------------------------------------
        // Move Items
        //-----------------------------------------

        $this->DB->update('classifieds_items', array('featured' => 1), 'item_id IN (' . implode(',', $items) . ')');

        return count($items);
    }       
    
     /**
     * Unfeature items
     *
     * return array
     *
     */
    public function unfeatureItems($items = array()) {

        //-----------------------------------------
        // Move Items
        //-----------------------------------------

        $this->DB->update('classifieds_items', array('featured' => 0), 'item_id IN (' . implode(',', $items) . ')');

        return count($items);
    }           

}

?>