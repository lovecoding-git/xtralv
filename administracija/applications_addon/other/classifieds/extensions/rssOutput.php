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

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class rss_output_classifieds
{
	/**
	 * Expiration date
	 *
	 * @access	protected
	 * @var		integer			Expiration timestamp
	 */
	protected $expires			= 0;
	
	/**
	 * RSS object
	 *
	 * @access	public
	 * @var		object
	 */
	public $class_rss;

	/**
	 * Grab the RSS links
	 *
	 * @access	public
	 * @return	string		RSS document
	 */
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
        $this->settings   =& $this->registry->fetchSettings();
                

		if ( ! $this->registry->isClassLoaded('classifieds') )
		{
			/* Classifieds Object */
			require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
			$this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
		}

        require_once( IPSLib::getAppDir( 'classifieds' ) . '/sources/classes/classifieds/items.php' );
        $this->items = new classifieds_items( $this->registry );
                

	}
		
	public function getRssLinks()
	{		
		$return	= array();

		if( ipsRegistry::$settings['cfds_rss_enabled'] )
		{
			/* Lang */
			ipsRegistry::getClass( 'class_localization' )->loadLanguageFile( array( 'public_lang' ), 'classifieds' );

	        $return[] = array( 'title' => ipsRegistry::getClass('class_localization')->words['cfds_rss_title'], 'url' => ipsRegistry::getClass('output')->formatUrl( ipsRegistry::$settings['board_url'] . "/index.php?app=core&amp;module=global&amp;section=rss&amp;type=classifieds", true, 'section=rss' ) );
	    }

	    return $return;
	}
	
	/**
	 * Grab the RSS document content and return it
	 *
	 * @access	public
	 * @return	string		RSS document
	 */
	public function returnRSSDocument()
	{
		
		
		/* Lang */
		ipsRegistry::getClass( 'class_localization' )->loadLanguageFile( array( 'public_lang' ), 'classifieds' );

		//--------------------------------------------
		// Require classes
		//--------------------------------------------
		
		$classToLoad				= IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classRss.php', 'classRss' );
		$this->class_rss			= new $classToLoad();
		$this->class_rss->doc_type	= ipsRegistry::$settings['gb_char_set'];
		
		//-----------------------------------------
		// Enabled?
		//-----------------------------------------
		
		if( !ipsRegistry::$settings['cfds_rss_enabled'] )
		{
			return $this->_returnError( ipsRegistry::getClass('class_localization')->words['cfds_rss_disabled'] );
		}
		
		//-----------------------------------------
        // Load and config the post parser
        //-----------------------------------------
        
        IPSText::getTextClass( 'bbcode' )->bypass_badwords	= 0;
        
		$channel_id = $this->class_rss->createNewChannel( array( 'title'		=> ipsRegistry::getClass('class_localization')->words['cfds_rss_title'],
																 'link'			=> ipsRegistry::getClass('output')->formatUrl( ipsRegistry::$settings['board_url'] . '/index.php?app=classifieds' ),
																 'pubDate'		=> $this->class_rss->formatDate( time() ),
																 'ttl'			=> 30 * 60,
																 'description'	=> ipsRegistry::getClass('class_localization')->words['cfds_rss_desc']
													)      );

		$_cache	= ipsRegistry::cache()->getCache('group_cache');
		
		//-----------------------------------------
        // Set up item filters
        //-----------------------------------------
		
		$filters = array();

        $filters[] = 'i.active = 1';
        $filters[] = 'i.open = 1';
        $filters[] = "(i.date_expiry > " . (time() - ($this->settings['classifieds_display_after_expiry'] * 86400)) .")";
		
		$items = $this->items->getItems('', '', TRUE, '', $filters);
		
	    if ($items) {
            foreach ($items as $_item) {

            	$description = $_item['advert_type'] . "<br /><br />";
            	$description .= $_item['description'];
            	
				if($_item['price'] != '0.00' || !$_item['zero_text']) {
					$description .= "<br /><br />" . ipsRegistry::getClass('class_localization')->formatMoney( $_item['price'], false );
				} else {
					$description .= "<br /><br />" . $_item['zero_text'];                        
	            }
	                        
            	
					
            	$this->class_rss->addItemToChannel( $channel_id, array( 'title'			=> $_item['name'],
																	'link'			=> ipsRegistry::getClass('output')->formatUrl( ipsRegistry::$settings['board_url'] . '/index.php?app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $_item['item_id'], $_item['seo_title'], 'view_item' ),
																	'description'	=> $description,
																	'pubDate'		=> $this->class_rss->formatDate( $_item['date_added'] ),
																	'guid'			=> $_item['item_id']
									  )                    );

            }
        }
		
		
		$this->class_rss->createRssDocument();
		
		$this->class_rss->rss_document = ipsRegistry::getClass('output')->replaceMacros( $this->class_rss->rss_document );

		return $this->class_rss->rss_document;
	}
	
	/**
	 * Grab the RSS document expiration timestamp
	 *
	 * @access	public
	 * @return	integer		Expiration timestamp
	 */
	public function grabExpiryDate()
	{
		// Generated on the fly, so just return expiry of one hour
		return time() + 3600;
	}
	
	/**
	 * Return an error document
	 *
	 * @access	protected
	 * @param	string			Error message
	 * @return	string			XML error document for RSS request
	 */
	protected function _returnError( $error='' )
	{
		$channel_id = $this->class_rss->createNewChannel( array( 
															'title'			=> ipsRegistry::getClass('class_localization')->words['rss_disabled'],
															'link'			=> ipsRegistry::getClass('output')->formatUrl( ipsRegistry::$settings['board_url'] . "/index.php?app=classifieds", 'false', 'app=classifieds' ),
				 											'description'	=> ipsRegistry::getClass('class_localization')->words['rss_disabled'],
				 											'pubDate'		=> $this->class_rss->formatDate( time() ),
				 											'webMaster'		=> ipsRegistry::$settings['email_in'] . " (" . ipsRegistry::$settings['board_name'] . ")",
				 											'generator'		=> 'IP.Classifieds'
				 										)		);

		$this->class_rss->addItemToChannel( $channel_id, array( 
														'title'			=> ipsRegistry::getClass('class_localization')->words['rss_error_message'],
			 										    'link'			=> ipsRegistry::getClass('output')->formatUrl( ipsRegistry::$settings['board_url'] . "/index.php?app=classifieds", 'false', 'app=classifieds' ),
			 										    'description'	=> $error,
			 										    'pubDate'		=> $this->class_rss->formatDate( time() ),
			 										    'guid'			=> ipsRegistry::getClass('output')->formatUrl( ipsRegistry::$settings['board_url'] . "/index.php?app=classifieds&error=1", 'false', 'app=classifieds' ) ) );

		//-----------------------------------------
		// Do the output
		//-----------------------------------------

		$this->class_rss->createRssDocument();

		return $this->class_rss->rss_document;
	}
}