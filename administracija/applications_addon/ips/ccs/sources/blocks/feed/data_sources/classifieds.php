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

class feed_classifieds implements feedBlockInterface
{
	/**#@+
	 * Registry Object Shortcuts
	 *
	 * @access	protected
	 * @var		object
	 */
	protected $DB;
	protected $settings;
	protected $lang;
	protected $member;
	protected $memberData;
	protected $cache;
	protected $registry;
	protected $caches;
	protected $request;
	/**#@-*/
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object		Registry reference
	 * @return	@e void
	 */
	public function __construct( ipsRegistry $registry )
	{
		//-----------------------------------------
		// Make shortcuts
		//-----------------------------------------
		
		$this->registry		= $registry;
		$this->DB			= $registry->DB();
		$this->settings		= $registry->fetchSettings();
		$this->member		= $registry->member();
		$this->memberData	=& $this->registry->member()->fetchMemberData();
		$this->cache		= $registry->cache();
		$this->caches		=& $registry->cache()->fetchCaches();
		$this->request		= $registry->fetchRequest();
		$this->lang 		= $registry->class_localization;
		
		// Load Classifieds Lang
		$this->registry->class_localization->loadLanguageFile( array( 'public_lang' ), 'classifieds' );
	}
	
	/**
	 * Return the tag help for this block type
	 *
	 * @access	public
	 * @param	string		Additional info (database id;type)
	 * @return	array
	 */
	public function getTags( $info='' )
	{
		$_return			= array();
		$_noinfoColumns		= array();

		//-----------------------------------------
		// Switch on type
		//-----------------------------------------
		
		switch( $info )
		{
			case 'items':
				$_finalColumns		= array();
				
				foreach( $this->DB->getFieldNames( 'classifieds_items' ) as $_column )
				{
					if( $this->lang->words['col__cfds_items_' . $_column ] )
					{
						$_finalColumns[ $_column ]	= array( "&#36;r['" . $_column . "']", $this->lang->words['col__cfds_items_' . $_column ] );
					}
					else
					{
						$_noinfoColumns[ $_column ]	= array( "&#36;r['" . $_column . "']", $this->lang->words['notaghelpinfoavailable'], true );
					}
				}
				
				$_return	= array(
							$this->lang->words['block_feed__generic']	=> array( 
																				array( '&#36;title', $this->lang->words['block_feed__title'] ) ,
																				),	
								
							$this->lang->words['block_feed_cfds_items']	=> array(
																				array( '&#36;records', $this->lang->words['block_feed__cfdsitems'], IPSLib::mergeArrays( $_finalColumns, $_noinfoColumns ) ),
																				),
							);
			break;
			
		
		}

		return $_return;
	}
	

	/**
	 * Return the plugin meta data
	 *
	 * @access	public
	 * @return	array 			Plugin data (key (folder name), associated app, name, description, hasFilters, templateBit)
	 */
	public function returnFeedInfo()
	{
		if( !IPSLib::appIsInstalled('classifieds') )
		{
			return array();
		}
		
		
		
		$config = array(
					'key'			=> 'classifieds',
					'app'			=> 'classifieds',
					'name'			=> $this->lang->words['feed_name__classifieds'],
					'description'	=> $this->lang->words['feed_description__classifieds'],
					'hasFilters'	=> true,
					'templateBit'	=> 'feed__classifieds',
					'inactiveSteps'	=> array( ),
					);
		
		// Do we have the core template?
				
		$template	= $this->DB->buildAndFetch( array( 
															'select'	=> '*', 
															'from'		=> 'ccs_template_blocks', 
															'where'		=> "tpb_name='{$config['templateBit']}'" 
													)		);
													
		if( !$template['tpb_content'] ) {
			
					$params = '$title="", $records=array()';
					$content = "";

					$content .= <<<EOF
<div class='ipsSideBlock clearfix'>
<h3>{\$this->lang->words['cfds_latest']}</h3>
		<ul class='ipsList_withminiphoto'>
				{parse striping="latest_classifieds" classes="row1,row2 altrow"}
				<foreach loop="\$records as \$r">
			<li class='hentry {parse striping="latest_classifieds"}'>
			<if test="\$r['member']['member_id']">
				<a href='{parse url="showuser={\$r['member']['member_id']}" seotitle="{\$r['member']['members_seo_name']}" template="showuser" base="public"}' title='{\$this->lang->words['view_profile']}' class='ipsUserPhotoLink'>
			</if>
			<img src='{\$r['member']['pp_thumb_photo']}' alt="{parse expression="sprintf(\$this->lang->words['users_photo'],\$r['member']['members_display_name'])"}" class='ipsUserPhoto ipsUserPhoto_mini left' />
			<if test="\$r['member']['member_id']">
				</a>
			</if>
			<div class='list_content'>
				<if test="\$r['advert_type'] == 'wanted'"><span>{\$this->lang->words['cfds_wanted']} </span></if><a href='{parse url="app=classifieds&amp;module=core&amp;do=view_item&amp;item_id={\$r['item_id']}" template="view_item" seotitle="{\$r['seo_title']}" base="public"}' rel='bookmark' title='{\$this->lang->words['cfds_view_classified']}' class='ipsType_small'>{\$r['name']}</a>
				<br />
				<span class='date'>{\$this->lang->words['cfds_expires']} - {parse time_until="\$r['date_expiry']"}</span>
			</div>
			</li>
				</foreach>

		</ul>
</div>
EOF;

			// Add core template to DB
			
				$this->DB->insert( 'ccs_template_blocks', 
					array( 
						'tpb_name'		=> "{$config['templateBit']}",
						'tpb_content'	=> $content ,
						'tpb_params'	=> $params,
						)
				);
					
		}								
							
		return $config;																
	}
	
	/**
	 * Get the feed's available content types.  Returns form elements and data
	 *
	 * @access	public
	 * @param	array 			Session data
	 * @return	array 			Form data
	 */
	public function returnContentTypes( $session )
	{
		$options	= array(
							array( 'items', $this->lang->words['ct_cfds_items'] ),
							);
		return array(
					array(
						'label'			=> $this->lang->words['generic__select_contenttype'],
						'description'	=> $this->lang->words['generic__desc_contenttype'],
						'field'			=> $this->registry->output->formDropdown( 'content_type', $options, $session['config_data']['content_type'] ),
						)
					);
	}
	
	/**
	 * Check the feed content type selection
	 *
	 * @access	public
	 * @param	array 			Submitted data to check (usually $this->request)
	 * @return	array 			Array( (bool) Ok or not, (array) Content type data to use )
	 */
	public function checkFeedContentTypes( $data )
	{
		if( !in_array( $data['content_type'], array( 'items' ) ) )
		{
			$data['content_type']	= 'items';
		}

		return array( true, $data['content_type'] );
	}
	
	/**
	 * Get the feed's available filter options.  Returns form elements and data
	 *
	 * @access	public
	 * @param	array 			Session data
	 * @return	array 			Form data
	 */
	public function returnFilters( $session )
	{
		$filters	= array();
		
		//-----------------------------------------
		// For all the content types, we allow to filter by forums
		//-----------------------------------------
		
		ipsRegistry::getAppClass( 'classifieds' );
		
		$filters[]	= array(
							'label'			=> $this->lang->words['feed_cfds__cats'],
							'description'	=> $this->lang->words['feed_cfds__cats_desc'],
							'field'			=> $this->registry->output->formMultiDropdown( 'filter_cats[]', $this->registry->classifieds->helper('categories')->buildJumpList(FALSE), explode( ',', $session['config_data']['filters']['filter_cats'] ), 10 ),
							);

		switch( $session['config_data']['content_type'] )
		{
			case 'items':
			default:
				$session['config_data']['filters']['filter_visibility']	= $session['config_data']['filters']['filter_visibility'] ? $session['config_data']['filters']['filter_visibility'] : 'open';
				$session['config_data']['filters']['filter_featured']	= $session['config_data']['filters']['filter_featured'] ? $session['config_data']['filters']['filter_featured'] : 'either';
				//$session['config_data']['filters']['filter_type']		= $session['config_data']['filters']['filter_type'] ? $session['config_data']['filters']['filter_type'] : 'sale';
				
				$visibility	= array( array( 'open', $this->lang->words['cfds_status__open'] ), array( 'closed', $this->lang->words['cfds_status__closed'] ), array( 'either', $this->lang->words['cfds_status__either'] ) );
				$filters[]	= array(
									'label'			=> $this->lang->words['feed_cfds__visibility'],
									'description'	=> $this->lang->words['feed_cfds__visibility_desc'],
									'field'			=> $this->registry->output->formDropdown( 'filter_visibility', $visibility, $session['config_data']['filters']['filter_visibility'] ),
									);
									
				$featured	= array( array( '1', $this->lang->words['cfds_status__featured'] ), array( '0', $this->lang->words['cfds_status__notfeatured'] ), array( 'either', $this->lang->words['cfds_status__either'] ) );
				$filters[]	= array(
									'label'			=> $this->lang->words['feed_cfds__featured'],
									'description'	=> $this->lang->words['feed_cfds__featured_desc'],
									'field'			=> $this->registry->output->formDropdown( 'filter_featured', $featured, $session['config_data']['filters']['filter_featured'] ),
									);
									
				// Advert Types
																

				$filters[]	= array(
									'label'			=> $this->lang->words['feed_cfds__type'],
									'description'	=> $this->lang->words['feed_cfds__type_desc'],
									'field'			=> $this->registry->output->formMultiDropdown( 'filter_type[]', $this->registry->classifieds->helper('types')->getTypeJumpList(), explode( ',', $session['config_data']['filters']['filter_type'] ), 4 ),
									);


			break;
			
			
		}
			
		return $filters;
	}
	
	/**
	 * Check the feed filters selection
	 *
	 * @access	public
	 * @param	array 			Session data
	 * @param	array 			Submitted data to check (usually $this->request)
	 * @return	array 			Array( (bool) Ok or not, (array) Content type data to use )
	 */
	public function checkFeedFilters( $session, $data )
	{
		$filters	= array();
		
		$filters['filter_cats']	= is_array($data['filter_cats']) ? implode( ',', $data['filter_cats'] ) : '';

		switch( $session['config_data']['content_type'] )
		{
			case 'items':
			default:
				$filters['filter_visibility']	= $data['filter_visibility'] ? $data['filter_visibility'] : 'open';
				$filters['filter_featured']		= $data['filter_featured'] ? $data['filter_featured'] : 0;
				$filters['filter_type']	= is_array($data['filter_type']) ? implode( ',', $data['filter_type'] ) : '';
			break;
			
		}
		
		return array( true, $filters );
	}
	
	/**
	 * Get the feed's available ordering options.  Returns form elements and data
	 *
	 * @access	public
	 * @param	array 			Session data
	 * @return	array 			Form data
	 */
	public function returnOrdering( $session )
	{
		$session['config_data']['sortorder']	= $session['config_data']['sortorder'] ? $session['config_data']['sortorder'] : 'desc';
		$session['config_data']['offset_start']	= $session['config_data']['offset_start'] ? $session['config_data']['offset_start'] : 0;
		$session['config_data']['offset_end']	= $session['config_data']['offset_end'] ? $session['config_data']['offset_end'] : 10;

		$filters	= array();

		switch( $session['config_data']['content_type'] )
		{
			case 'files':
			default:
				$session['config_data']['sortby']					= $session['config_data']['sortby'] ? $session['config_data']['sortby'] : 'submitted';
				$session['config_data']['filters']['sortby_featured']	= $session['config_data']['filters']['sortby_featured'] ? $session['config_data']['filters']['sortby_featured'] : 1;

				$sortby	= array( 
								array( 'date_added', $this->lang->words['sort_cfds__submitted'] ),
								array( 'price', $this->lang->words['sort_cfds__price'] ),
								array( 'name', $this->lang->words['sort_cfds__title'] ), 
								array( 'views', $this->lang->words['sort_cfds__views'] ), 
								array( 'date_expiry', $this->lang->words['sort_cfds__expiry'] ),
								array( 'rand', $this->lang->words['sort_generic__rand'] )
								);

				$filters[]	= array(
									'label'			=> $this->lang->words['feed_sort_by'],
									'description'	=> $this->lang->words['feed_sort_by_desc'],
									'field'			=> $this->registry->output->formDropdown( 'sortby', $sortby, $session['config_data']['sortby'] ),
									);

				$filters[]	= array(
									'label'			=> $this->lang->words['feed_cfds__sort_featured'],
									'description'	=> $this->lang->words['feed_cfds__sort_featured_desc'],
									'field'			=> $this->registry->output->formYesNo( 'sortby_featured', $session['config_data']['filters']['sortby_featured'] ),
									);
			break;
			
			
		}
		
		$filters[]	= array(
							'label'			=> $this->lang->words['feed_order_direction'],
							'description'	=> $this->lang->words['feed_order_direction_desc'],
							'field'			=> $this->registry->output->formDropdown( 'sortorder', array( array( 'desc', 'DESC' ), array( 'asc', 'ASC' ) ), $session['config_data']['sortorder'] ),
							);

		$filters[]	= array(
							'label'			=> $this->lang->words['feed_limit_offset_start'],
							'description'	=> $this->lang->words['feed_limit_offset_start_desc'],
							'field'			=> $this->registry->output->formInput( 'offset_start', $session['config_data']['offset_start'] ),
							);

		$filters[]	= array(
							'label'			=> $this->lang->words['feed_limit_offset_end'],
							'description'	=> $this->lang->words['feed_limit_offset_end_desc'],
							'field'			=> $this->registry->output->formInput( 'offset_end', $session['config_data']['offset_end'] ),
							);
		
		return $filters;
	}
	
	/**
	 * Check the feed ordering options
	 *
	 * @access	public
	 * @param	array 			Submitted data to check (usually $this->request)
	 * @return	array 			Array( (bool) Ok or not, (array) Ordering data to use )
	 */
	public function checkFeedOrdering( $data, $session )
	{
		$limits		= array();
		
		$limits['sortorder']		= in_array( $data['sortorder'], array( 'desc', 'asc' ) ) ? $data['sortorder'] : 'desc';
		$limits['offset_start']		= intval($data['offset_start']);
		$limits['offset_end']		= intval($data['offset_end']);

		switch( $session['config_data']['content_type'] )
		{
			case 'items':
			default:
				$sortby	= array( 'name', 'views', 'date_added', 'price', 'date_expiry', 'rand' );
				$limits['sortby']			= in_array( $data['sortby'], $sortby ) ? $data['sortby'] : 'date_added';
				
				$limits['filters']['sortby_featured']	= $data['sortby_featured'] ? $data['sortby_featured'] : 1;
			break;
			
			
		}

		return array( true, $limits );
	}
	
	/**
	 * Execute the feed and return the HTML to show on the page.  
	 * Can be called from ACP or front end, so the plugin needs to setup any appropriate lang files, skin files, etc.
	 *
	 * @access	public
	 * @param	array 				Block data
	 * @return	string				Block HTML to display or cache
	 */
	public function executeFeed( $block )
	{
		$config	= unserialize( $block['block_config'] );

		//-----------------------------------------
        // Filters
        //-----------------------------------------  

        $filters = array();
        
        // Only retrieve active
        $filters[] = 'i.active = 1';
        
		if( $config['filters']['filter_cats'] )
		{
				$filters[]	= "i.category_id IN(" . $config['filters']['filter_cats'] . ")";
		}
		
		if( $config['filters']['filter_visibility'] != 'either' )
		{
				$filters[]	= "i.open=" . ( $config['filters']['filter_visibility'] == 'open' ? 1 : 0 );
		}

		// Don't show if expired or if outside of time to display after expiry
		
        $filters[] = "(i.date_expiry > " . (time() - ($this->settings['classifieds_display_after_expiry'] * 86400)) .")";
        
		if( $config['filters']['filter_type'] )
		{
				
				$types_arr = explode(",", $config['filters']['filter_type']);
				
				foreach($types_arr as $type) {
					$types[] = "'" . $type . "'";
				}
				$types = implode(",", $types);
				
				$filters[]	= "i.advert_type IN(" . $types . ")";
		}    

		if( $config['filters']['filter_featured'] != 'either' )
		{
				$filters[]	= "i.featured=" . $config['filters']['filter_visibility'];
		}		
            
        //-----------------------------------------
        // Order
        //-----------------------------------------

		$order	= '';

		switch( $config['content'] )
		{
			case 'items':
				switch( $config['sortby'] )
				{
					case 'name':
						$order	.=	"i.name ";
					break;
		
					case 'views':
						$order	.=	"i.views ";
					break;
					
					default:
					case 'date_added':
						$order	.=	"i.date_added ";
					break;
		
					case 'date_expiry':
						$order		.=	"i.date_expiry ";
					break;

					case 'price':
						$order	.=	"i.price ";
					break;


					case 'rand':
						$order	.=	$this->DB->buildRandomOrder() . ' ';
					break;
				}
				
				if( $config['filters']['sortby_featured'] )
				{
					$order	= "i.featured DESC, " . $order;
				}
			break;

		}

		$order	.= $config['sortorder'];


		//-----------------------------------------
        // Get items from DB
        //-----------------------------------------
        
		ipsRegistry::getAppClass( 'classifieds' );
		
        $content = $this->registry->classifieds->helper('items')->getItems('', array($config['offset_a'], $config['offset_b']), TRUE, $order, $filters);
		
		//-----------------------------------------
		// Return formatted content
		//-----------------------------------------
		
		$feedConfig		= $this->returnFeedInfo();
		$templateBit	= $feedConfig['templateBit'] . '_' . $block['block_id'];
		
		if( $config['hide_empty'] AND !count($content) )
		{
			return '';
		}
		
		ob_start();
		$_return	= $this->registry->output->getTemplate('ccs')->$templateBit( $block['block_name'], $content );
		ob_end_clean();
		
		return $_return;
	}
	

	public function modifyTemplate( $session, $template )
	{

			if(!$template) {
			
			$template = "";

		$template .= <<<EOF
		<div class='classifieds_box'>
			<h3>{\$title}</h3>
			<ul class='hfeed'>
				<if test="is_array( \$records ) && count( \$records )">
				{parse striping="feed_striping" classes="row1,row2 altrow"}
				<foreach loop="\$records as \$r">
				<li class='hentry {parse striping="feed_striping"}'><a href='{\$r['url']}' rel='bookmark' title='{\$r['title']}'>{\$r['name']}</a>
					<br /><span class='date'><abbr class="published" title="{parse expression="date( 'c', \$r['date'] )"}">{parse date="\$r['date']" format="short"}</abbr></span>
					<span class='desctext'>{IPSText::truncate( strip_tags(\$r['content']), 32 )}</span>
				</li>
				</foreach>
				</if>
			</ul>
		</div>
		<br />
EOF;
		}

		return $template;
		
	}
		
}