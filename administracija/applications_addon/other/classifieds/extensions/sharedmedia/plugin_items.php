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
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

/**
 *
 * @class		plugin_classifieds_items
 * @brief		Provide ability to share classified items via editor
 */
class plugin_classifieds_items
{
	/**
	 * Registry Object Shortcuts
	 *
	 * @var		$registry
	 * @var		$DB
	 * @var		$settings
	 * @var		$request
	 * @var		$lang
	 * @var		$member
	 * @var		$memberData
	 * @var		$cache
	 * @var		$caches
	 */
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	protected $member;
	protected $memberData;
	protected $cache;
	protected $caches;

	/**
	 * Constructor
	 *
	 * @param	object		$registry		Registry object
	 * @return	@e void
	 */
	public function __construct( ipsRegistry $registry ) 
	{
		//-----------------------------------------
		// Make shortcuts
		//-----------------------------------------

		$this->registry		= $registry;
		$this->DB			= $this->registry->DB();
		$this->settings		=& $this->registry->fetchSettings();
		$this->request		=& $this->registry->fetchRequest();
		$this->member		= $this->registry->member();
		$this->memberData	=& $this->registry->member()->fetchMemberData();
		$this->cache		= $this->registry->cache();
		$this->caches		=& $this->registry->cache()->fetchCaches();
		$this->lang			= $this->registry->class_localization;
		
		$this->lang->loadLanguageFile( array( 'public_lang' ), 'classifieds' );
		
		/* Classifieds Object */
		require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
		$this->registry->setClass( 'classifieds', new classifieds( $registry ) );
		
	}
	
	/**
	 * Return the tab title
	 *
	 * @return	@e string
	 */
	public function getTab()
	{
		if( $this->memberData['member_id'] )
		{
			return $this->lang->words['cfds_sharedmedia'];
		}
	}
	
	/**
	 * Return the HTML to display the tab
	 *
	 * @return	@e string
	 */
	public function showTab( $string )
	{
		//-----------------------------------------
		// Are we a member?
		//-----------------------------------------

		if( !$this->memberData['member_id'] )
		{
			return '';
		}

		//-----------------------------------------
		// How many approved items do we have?
		//-----------------------------------------
		
		$st		= intval($this->request['st']);
		$each	= 30;
		
		//-----------------------------------------
        // Filters
        //-----------------------------------------  

        $filters = array();

        $filters[] = 'i.active = 1';
		$filters[] = 'i.open = 1';
		$filters[] = "i.member_id={$this->memberData['member_id']}";
        $filters[] = "(i.date_expiry > " . (time() - ($this->settings['classifieds_display_after_expiry'] * 86400)) .")";
        
		if( $string )
		{
			$filters[]	= "i.name LIKE '%{$string}%'";
		}
		
		$items = $this->registry->classifieds->helper('items')->getItems('', '', TRUE, $order, $filters);
		
		
		$count	= count($items);
		$rows	= array();
		
		$pages	= $this->registry->output->generatePagination( array(	'totalItems'		=> $count,
																		'itemsPerPage'		=> $each,
																		'currentStartValue'	=> $st,
																		'seoTitle'			=> '',
																		'method'			=> 'nextPrevious',
																		'noDropdown'		=> true,
																		'ajaxLoad'			=> 'mymedia_content',
																		'baseUrl'			=> "app=core&amp;module=ajax&amp;section=media&amp;do=loadtab&amp;tabapp=classifieds&amp;tabplugin=items&amp;search=" . urlencode($string) )	);
		if ( !empty($items) ) {
			foreach( $items as $r )
			{
							
				$item = array(
								'width'		=> 0,
								'height'	=> 0,
								'title'		=> IPSText::truncate( $r['name'], 25 ),
								'desc'		=> IPSText::truncate( strip_tags( IPSText::stripAttachTag( IPSText::getTextClass('bbcode')->stripAllTags( $r['description'] ) ), '<br>' ), 100 ),
								'insert'	=> "classifieds:items:" . $r['item_id'],
								);
				
				
				if( $r['thumb_location'] ){
					$item['image'] = $this->settings['upload_url'] . '/' . $r['thumb_location'];
				} else {
					$item['image'] = $this->settings['img_url']. "/classifieds/noimage.png";
				}
				
				$rows[] = $item;
				
			}
		}

		return $this->registry->output->getTemplate('editors')->mediaGenericWrapper( $rows, $pages, 'classifieds', 'items' );
	}

	/**
	 * Return the HTML output to display
	 *
	 * @param	int		$imageId		Image ID to show
	 * @return	@e string
	 * @todo 	Need to finish output
	 */
	public function getOutput( $itemId=0 )
	{
		$itemId	= intval($itemId);
		
		if( !$itemId )
		{
			return '';
		}

		$item = $this->registry->classifieds->helper('items')->getItemById($itemId);

		return $this->registry->output->getTemplate('classifieds')->bbCodeItem( $item );
	}
	
	/**
	 * Verify current user has permission to post this
	 *
	 * @param	int		$imageId	Image ID to show
	 * @return	@e bool
	 */
	public function checkPostPermission( $itemId )
	{
		$itemId	= intval($itemId);
		
		if( !$itemId )
		{
			return '';
		}
		
		if( $this->memberData['g_is_supmod'] OR $this->memberData['is_mod'] )
		{
			return '';
		}
		
		$item = $this->registry->classifieds->helper('items')->getItemById($itemId);
		
		if( $this->memberData['member_id'] AND $item['member_id'] == $this->memberData['member_id'] )
		{
			return '';
		}
		
		return 'no_permission_shared';
	}
}