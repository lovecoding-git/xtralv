<?php
/**
 * Invision Power Services
 * IP.SEO - Search Activity Dashboard
 * Last Updated: $Date: 2011-09-06 06:56:14 -0400 (Tue, 06 Sep 2011) $
 *
 * @author 		$Author: mark $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 9456 $
 */

if ( ! defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

class admin_ipseo_activity_activity extends ipsCommand
{
	public $html;
	protected $engine = null;
	
	/**
	 * Main class entry point
	 *
	 * @access	public
	 * @param	object		ipsRegistry reference
	 * @return	void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry )
	{
		//-----------------------------------------
		// Init
		//-----------------------------------------
		
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_activity' );
		
		if( $this->request['engine'] )
		{
			$this->engine = $this->DB->addSlashes( strtolower( $this->request['engine'] ) );
			$this->engine = $this->engine == 'msnbot' ? 'bing' : $this->engine;
		}
		
		$app = $this->DB->buildAndFetch( array( 'select' => 'app_added', 'from' => 'core_applications', 'where' => "app_directory = 'ipseo'" ) );
		
		$days = 7;
		
		if($app['app_added'] > time() - (86400*7))
		{
			$days = 2;
		}
		
		if($app['app_added'] > time() - (86400*2))
		{
			$days = 1;
		}
		
		$this->days = $this->request['days'] ? intval( $this->request['days'] ) : $days;
				
		if ( $this->days == 1 )
		{
			$this->mysqlGroup 	= '%H';
			$this->phpGroup		= 'H';
		}
		else if ( $this->days == 28 )
		{
			$this->mysqlGroup = '%e';
			$this->phpGroup = 'j';
		}
		else
		{
			$this->mysqlGroup	= '%w';
			$this->phpGroup		= 'w';
		}
		
		//-----------------------------------------
		// What are we doing?
		//-----------------------------------------
		
		switch($this->request['do'])
		{
			case 'keywords':
				$this->_showKeywords();
			break;
			
			case 'visitors':
				$this->_showVisitors();
			break;
			
			case 'search_chart':
				$this->renderSearchChart();
			break;
			
			case 'spider_chart':
				$this->renderSpiderChart();
			break;
			
			default:
				$this->showDashboard();
			break;
		}
		
		//-----------------------------------------
		// Display
		//-----------------------------------------
		
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}
	
	/**
	 * Page: Keywords
	 */	
	protected function _showKeywords()
	{
		$st = $this->request['st'] ? $this->request['st'] : 0;
		
		/* Pagination */
		$max = $this->DB->buildAndFetch( array( 'select' => "COUNT(*) as total",
												'from'   => "search_keywords" ) );
		
		$pagination	= $this->registry->output->generatePagination( array( 	'totalItems'		=> intval($max['total']),
																	  		'itemsPerPage'	    => 20,
																	  		'currentStartValue' => $st,
																	  		'baseUrl'			=> $this->settings['base_url'].'&module=activity&do=keywords' ) );
		
		/* Get results */
		$keywords = array();
		$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'search_keywords',
			'limit'		=> array( $st, 20 ),
			'order'		=> 'count DESC'
			) );
		$this->DB->execute();
		while ( $row = $this->DB->fetch() )
		{
			$row['keyword'] = strtolower( $row['keyword'] );
			$keywords[] = $row;
		}
		
		/* Display */
		$this->registry->output->html  = $this->html->keywords( $pagination, $keywords );
	}
	
	/**
	 * Page: Visitors
	 */	
	protected function _showVisitors()
	{
		$st = $this->request['st'] ? $this->request['st'] : 0;
		
		/* Looking for a specific search engine? */
		$where = array();
		if(!is_null($this->engine))
		{
			$where[] = 'engine = \''.$this->engine.'\'';
		}
		
		/* Looking for a specific keyword? */
		if(!is_null($this->request['keyword']))
		{
			$where[] = 'keywords = \''.$this->request['keyword'].'\'';
		}
		$where = implode(' AND ', $where);
		
		/* Pagination */
		$max = $this->DB->buildAndFetch( array( 'select' => "COUNT(*) as total",
												'from'   => "search_visitors",
												'where' => $where ) );

		$base = $this->settings['base_url'].'module=activity&do=visitors&';
		$base .= !is_null($this->engine) ? 'engine=' . $this->engine . '&' : '';
		$base .= !is_null($this->request['keyword']) ? 'keyword=' . $this->request['keyword'] . '&' : '';
		
		$pagination	= $this->registry->output->generatePagination( array( 	'totalItems'		=> intval($max['total']),
																	  		'itemsPerPage'	    => 20,
																	  		'currentStartValue' => $st,
																	  		'baseUrl'			=> $base ) );
		
		
		/* Get results */
		$visitors = array();
		$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'search_visitors',
			'where'		=> $where,
			'limit'		=> array( $st, 20 ),
			'order'		=> 'date DESC'
			) );
		$e = $this->DB->execute();
		while ( $row = $this->DB->fetch( $e ) )
		{
			$row['member']		= IPSMember::load( $row['member'] );
			$row['date']		= $this->lang->getDate( $row['date'], 'SHORT' );
			$row['keywords']	= urldecode( strtolower( $row['keywords'] ) );
			$row['page']		= $this->makeLinkText( $row['url'] );
			
			$visitors[] = $row;
		}
		
		/* Display */
		$this->registry->output->html  = $this->html->visitors( $pagination, $visitors );
	}
	
	/**
	 * Page: Dashboard
	 */	
	protected function showDashboard()
	{
		//-----------------------------------------
		// Get Keywords
		//-----------------------------------------
		
		$keywords = array();
		$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'search_keywords',
			'limit'		=> array( 0, 5 ),
			'order'		=> 'count DESC'
			) );
		$this->DB->execute();
		while ( $row = $this->DB->fetch() )
		{
			$row['keyword'] = strtolower( $row['keyword'] );
			$keywords[] = $row;
		}
		
		//-----------------------------------------
		// Get Spider Hits
		//-----------------------------------------
		
		$spiders = array();
		
		$query = array(
			'select'	=> '*',
			'from'		=> 'spider_logs',
			'order'		=> 'sid DESC',
			'limit'		=> array(0, 5)
			);
		
		if(!is_null($this->engine))
		{
			$query['where'] = 'bot = \''.($this->engine == 'bing' ? 'msnbot\' OR \'bing' : $this->engine).'\'';
		}
		
		$this->DB->build( $query );
		$this->DB->execute();
		while($row = ipsRegistry::DB()->fetch($result))
		{
			$row['entry_date']	= $this->lang->getDate( $row['entry_date'], 'SHORT' );
			$row['page']		= $this->makeLinkText( $row['query_string'] ? $row['query_string'] : $row['request_addr'] );
			$spiders[] = $row;
		}
		
		//-----------------------------------------
		// Get Visitors
		//-----------------------------------------
		
		$visitors = array();
		$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'search_visitors',
			'limit'		=> array( 0, 5 ),
			'order'		=> 'date DESC'
			) );
		$e = $this->DB->execute();
		while ( $row = $this->DB->fetch( $e ) )
		{
			$row['member']		= IPSMember::load( $row['member'] );
			$row['date']		= $this->lang->getDate( $row['date'], 'SHORT' );
			$row['keywords']	= urldecode( strtolower( $row['keywords'] ) );
			$row['page']		= $this->makeLinkText( $row['url'] );
			
			$visitors[] = $row;
		}
	
		//-----------------------------------------
		// Display
		//-----------------------------------------
		
		$this->registry->output->html  = $this->html->dashboard( $keywords, $spiders, $visitors );
	}
	
	/**
	 * Work out page title
	 */
	protected function makeLinkText($qs)
	{
		$matches = array();
		
		if($qs == '')
		{
			return 'Board index';
		}
		elseif(preg_match('/showtopic\=([0-9]+)/', $qs, $matches))
		{
			return 'Topic: ' . $this->getContentTitle('title', 'topics', 'tid = ' . $matches[1]);
		}
		elseif(preg_match('/showforum\=([0-9]+)/', $qs, $matches))
		{
			return 'Forum: ' . $this->getContentTitle('name', 'forums', 'id = ' . $matches[1]);
		}
		elseif(preg_match('/showuser\=([0-9]+)/', $qs, $matches))
		{
			return 'User: ' . $this->getContentTitle('members_display_name', 'members', 'member_id = ' . $matches[1]);
		}
		elseif(preg_match('/entry\=([0-9]+)/', $qs, $matches))
		{
			return 'Blog Entry: ' . $this->getContentTitle('entry_name', 'blog_entries', 'entry_id = ' . $matches[1]);
		}
		elseif(preg_match('/blogid\=([0-9]+)/', $qs, $matches))
		{
			return 'Blog: ' . $this->getContentTitle('blog_name', 'blog_blogs', 'blog_id = ' . $matches[1]);
		}
		elseif(preg_match('/showfile\=([0-9]+)/', $qs, $matches))
		{
			return 'Download: ' . $this->getContentTitle('file_name', 'downloads_files', 'file_id = ' . $matches[1]);
		}
		elseif(preg_match('/app=downloads(.*)showcat\=([0-9]+)/', $qs, $matches))
		{
			return 'Download: ' . $this->getContentTitle('cname', 'downloads_categories', 'cid = ' . $matches[2]);
		}
		elseif(preg_match('/app=sitemap(.*)sitemap\=(.*)$/', $qs, $matches))
		{
			return 'Sitemap: ' . $matches[2];
		}
		elseif(preg_match('/app=seo(.*)sitemap\=(.*)$/', $qs, $matches))
		{
			return 'Sitemap: ' . $matches[2];
		}
		elseif(preg_match('/app=ipseo(.*)sitemap\=(.*)$/', $qs, $matches))
		{
			return 'Sitemap: ' . $matches[2];
		}
		elseif(preg_match('/app\=blog/', $qs, $matches))
		{
			return 'IP.Blog';
		}
		elseif(preg_match('/app\=downloads/', $qs, $matches))
		{
			return 'IP.Downloads';
		}
		elseif(preg_match('/app\=calendar/', $qs, $matches))
		{
			return 'Calendar';
		}
		elseif(preg_match('/app\=ccs/', $qs, $matches))
		{
			return 'IP.Content';
		}
		elseif(preg_match('/app\=gallery/', $qs, $matches))
		{
			return 'IP.Gallery';
		}
		elseif(preg_match('/app\=nexus/', $qs, $matches))
		{
			return 'IP.Nexus';
		}
		else
		{
			return 'Unknown';
		}
	}
	
	protected function getContentTitle($select, $table, $where)
	{
		$this->DB->build(array('select' => $select . ' AS content_title', 'from' => $table, 'where' => $where));
		
		if($this->DB->execute())
		{
			$row = $this->DB->fetch();
			return $row['content_title'];
		}
		else
		{
			return ' ( could not load title)';
		}
	}
	
	/**
	 * Action: Render Latest Visitors Chart
	 */	
	public function renderSearchChart()
	{
		//-----------------------------------------
		// Init
		//-----------------------------------------
		
		$week  = $this->getDateFrom();
		$engine= is_null($this->engine) ? '' : ' AND engine = \''.$this->engine.'\'';
		
		$graph = $this->_buildChart( $week );
		
		$series = array();
		if ( $this->days == 1 )
		{
			for ( IPSTime::setTimestamp( $week ); IPSTime::getTimestamp()<(time()+3600); IPSTime::add_minutes( 60 ) )
			{
				$series[ intval( date( $this->phpGroup, IPSTime::getTimestamp() ) ) ] = 0;
			}
		}
		else
		{
			for ( IPSTime::setTimestamp( $week ); IPSTime::getTimestamp()<time(); IPSTime::add_days( 1 ) )
			{
				$series[ intval( date( $this->phpGroup, IPSTime::getTimestamp() ) ) ] = 0;
			}
		}
						
		//-----------------------------------------
		// Get Results
		//-----------------------------------------
		
		$this->DB->build(array(
								'select'	=> $this->DB->buildFromUnixtime('date', $this->mysqlGroup ) . ' AS chart_day, COUNT(*) AS chart_count',
								'from'		=> 'search_visitors',
								'where'		=> 'date >= ' . $week . $engine,
								'group'		=> $this->DB->buildFromUnixtime('date', $this->mysqlGroup ),
								'order'		=> 'id ASC'
								));
				
		$result = $this->DB->execute();

		if($result)
		{		
			$i = 0;
			$rows = ipsRegistry::DB()->getTotalRows();
			while($row = ipsRegistry::DB()->fetch($result))
			{
				$i++;
				
				$title = false;
				switch($this->days)
				{
					case 1:
						if($i == 1 || $i % 2)
						{
							$title = true;
						}
					break;
					
					case 2:
						if($i == 1 || $i == $rows || $i == round($rows/2))
						{
							$title = true;
						}
					break;
					
					default:
						$title = true;
					break;
				}
				
				if ( isset( $series[ intval( $row['chart_day'] ) ] ) )
				{
					$series[ intval( $row['chart_day'] ) ] = $row['chart_count'];
				}
			}
		}
								
		$plotSeries = array();
		foreach ( $series as $v )
		{
			$plotSeries[] = $v;
		}
				
		//-----------------------------------------
		// Render
		//-----------------------------------------
		
		$graph->addSeries( '', $plotSeries );
		
		@$graph->display( $this->getDateFrom() );
		
		exit;
	}
	
	/**
	 * Action: Render Latest Spider Hits
	 */
	public function renderSpiderChart()
	{
		//-----------------------------------------
		// Init
		//-----------------------------------------
		
		$week  = $this->getDateFrom();
		$engine= is_null($this->engine) ? '' : ' AND engine = \''.$this->engine.'\'';
		
		$graph = $this->_buildChart( $week );
		
		$series = array();
		if ( $this->days == 1 )
		{
			for ( IPSTime::setTimestamp( $week ); IPSTime::getTimestamp()<(time()+3600); IPSTime::add_minutes( 60 ) )
			{
				$series[ intval( date( $this->phpGroup, IPSTime::getTimestamp() ) ) ] = 0;
			}
		}
		else
		{
			for ( IPSTime::setTimestamp( $week ); IPSTime::getTimestamp()<time(); IPSTime::add_days( 1 ) )
			{
				$series[ intval( date( $this->phpGroup, IPSTime::getTimestamp() ) ) ] = 0;
			}
		}
		
		//-----------------------------------------
		// Get Results
		//-----------------------------------------
				
		$this->DB->build(array(
								'select'	=> $this->DB->buildFromUnixtime('entry_date', $this->mysqlGroup ) . ' AS chart_day, COUNT(*) AS chart_count',
								'from'		=> 'spider_logs',
								'where'		=> 'entry_date >= ' . $week . $engine,
								'group'		=> $this->DB->buildFromUnixtime('entry_date', $this->mysqlGroup ),
								'order'		=> 'entry_date ASC'
								));
		
		$result = $this->DB->execute();

		if($result)
		{
			$i = 0;
			$rows = ipsRegistry::DB()->getTotalRows();
			while($row = ipsRegistry::DB()->fetch($result))
			{
				$i++;
				
				$title = false;
				switch($this->days)
				{
					case 1:
						if($i == 1 || $i % 2)
						{
							$title = true;
						}
					break;
					
					case 2:
						if($i == 1 || $i == $rows || $i == round($rows/2))
						{
							$title = true;
						}
					break;
					
					default:
						$title = true;
					break;
				}
				
				if ( isset( $series[ intval( $row['chart_day'] ) ] ) )
				{
					$series[ intval( $row['chart_day'] ) ] = $row['chart_count'];
				}
			}
		}
		
		$plotSeries = array();
		foreach ( $series as $v )
		{
			$plotSeries[] = $v;
		}
		
		//-----------------------------------------
		// Render
		//-----------------------------------------
		
		$graph->addSeries( '', $plotSeries );
		
		@$graph->display( $this->getDateFrom() );
		
		exit;		
	}
	
	/**
	 * Work out start date
	 */	
	protected function getDateFrom()
	{
		$now    = time();
		
		if ( $this->days == 1 )
		{
			return $now - 86400 + 3600;
		}
		else
		{
			$minus = $now - (86400 * ($this->days-1));
			$from   = strtotime('00:00:01', $minus);
		}
		
		return $from;
	}
	
	/**
	 * Build A Chart
	 */
	private function _buildChart( $startTime )
	{
		//-----------------------------------------
		// Silly Timezones
		//-----------------------------------------
		
		$this->DB->setTimeZone( $this->memberData['time_offset'] );
				
		//-----------------------------------------
		// Init Graph
		//-----------------------------------------
		
		require_once( IPS_KERNEL_PATH . 'classGraph.php' );/*noLibHook*/
		$graph = new classGraph();
		$graph->options['font']		= DOC_IPS_ROOT_PATH . '/public/style_captcha/captcha_fonts/Sathu.ttf';
		$graph->options['width']		= 800;
		$graph->options['height']	= 300;
		$graph->options['style3D']	= 0;
		$graph->options['charttype'] = 'Area';
		$graph->options['showgridlinesx'] = 0;
		$graph->options['showdatalabels'] = 0;
		$graph->options['title'] = '';
		$graph->options['showlegend'] = 0;
		
		//-----------------------------------------
		// Add Labels
		//-----------------------------------------
		
		$labels = array();
		if ( $this->days == 1 )
		{
			for ( IPSTime::setTimestamp( $startTime ); IPSTime::getTimestamp()<(time()+3600); IPSTime::add_minutes( 60 ) )
			{
				$labels[] = date( 'ga', IPSTime::getTimestamp() );
			}
		}
		else
		{
			for ( IPSTime::setTimestamp( $startTime ); IPSTime::getTimestamp()<time(); IPSTime::add_days( 1 ) )
			{
				$labels[] = date( 'M j', IPSTime::getTimestamp() );
			}
		}
						
		$graph->addLabels( $labels );
						
		//-----------------------------------------
		// Return
		//-----------------------------------------
		
		return $graph;
	}
}