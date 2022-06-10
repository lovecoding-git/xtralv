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

class actions_classifieds
{


    /**
	 * CONSTRUCTOR
	 *
	 * @return	void
	 */
	public function __construct()
	{
		/* Make registry objects */
		$this->registry   =  ipsRegistry::instance();
		$this->DB         =  $this->registry->DB();

		if ( ! $this->registry->isClassLoaded('classifieds') )
		{
			/* Classifieds Object */
			require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
			$this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
		}
	}

	/**
	 * Do when paid
	 *
	 * @param	array	Member Info
	 * @param	array	Item
	 */
	public function onPaid( $member, $nexus_item )
	{

                // Grab the item
                $item = $this->registry->classifieds->helper('items')->getItemById($nexus_item['itemID']);

                // Set expiry date
                $expires = IPSTime::getTimestamp() + ($item['package_info']['duration'] * 86400);


                if ($nexus_item['type'] == 'new_classified') {

                    $category = $this->registry->classifieds->helper('categories')->getNode($item['category_id']);

                    // Activate the advert
                    $this->DB->update('classifieds_items', array('active' => 1, 'date_expiry' => $expires, 'expired' => 0), 'item_id = ' . intval($item['item_id']));

                    // Send notifications
                    $this->registry->classifieds->sendNotifications($item['item_id'], $item['name'], $item['seo_title'], $category['category_id'], $category['name']);

                }

                if ($nexus_item['type'] == 'renew_classified') {

                    // Activate the advert
                    $this->DB->update('classifieds_items', array('active' => 1, 'date_expiry' => $expires, 'expired' => 0), 'item_id = ' . intval($item['item_id']));


                }
	}



}

?>
