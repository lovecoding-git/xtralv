<?php
/**
 * IPS Converters
 * IP.Gallery 3.0 Converters
 * IP.Gallery Merge Tool
 * Last Update: $Date: 2010-03-19 11:03:12 +0100(ven, 19 mar 2010) $
 * Last Updated By: $Author: terabyte $
 *
 * @package		IPS Converters
 * @author 		Mark Wade
 * @copyright	(c) 2009 Invision Power Services, Inc.
 * @link		http://external.ipslink.com/ipboard30/landing/?p=converthelp
 * @version		$Revision: 437 $
 */


	$info = array(
		'key'	=> 'ipgallery',
		'name'	=> 'IP.Gallery 3.0',
		'login'	=> false,
	);

	$parent = array('required' => true, 'choices' => array(
		array('app' => 'board', 'key' => 'ipboard', 'newdb' => false),
		));

	class admin_convert_gallery_ipgallery extends ipsCommand
	{
		/**
	    * Main class entry point
	    *
	    * @access	public
	    * @param	object		ipsRegistry
	    * @return	void
	    */
	    public function doExecute( ipsRegistry $registry )
		{
			$this->registry = $registry;
			//-----------------------------------------
			// What can this thing do?
			//-----------------------------------------

			$this->actions = array(
				'gallery_form_fields'	=> array(),
				'gallery_categories'	=> array('members'),
				'gallery_albums'		=> array('members', 'gallery_categories'),
				'gallery_images'		=> array('members', 'gallery_categories', 'gallery_albums', 'gallery_form_fields'),
				'gallery_comments'		=> array('members', 'gallery_images'),
				'gallery_ecardlog'		=> array('gallery_images', 'members'),
				'gallery_subscriptions' => array('members', 'gallery_categories', 'gallery_albums', 'gallery_images'),
				'gallery_media_types'	=> array(),
				);

			//-----------------------------------------
	        // Load our libraries
	        //-----------------------------------------

			require_once( IPS_ROOT_PATH . 'applications_addon/ips/convert/sources/lib_master.php' );
			require_once( IPS_ROOT_PATH . 'applications_addon/ips/convert/sources/convertGallery.php' );
			$this->lib =  new convertGallery( $registry, $html, $this );

	        $this->html = $this->lib->loadInterface();
			$this->lib->sendHeader( 'IP.Gallery Merge Tool' );

			//-----------------------------------------
			// Are we connected?
			// (in the great circle of life...)
			//-----------------------------------------

			$this->HB = $this->lib->connect();

			//-----------------------------------------
			// What are we doing?
			//-----------------------------------------

			if (array_key_exists($this->request['do'], $this->actions))
			{
				call_user_func(array($this, 'convert_'.$this->request['do']));
			}
			else
			{
				$this->lib->menu();
			}

			//-----------------------------------------
	        // Pass to CP output hander
	        //-----------------------------------------

			$this->sendOutput();

		}

		/**
	    * Output to screen and exit
	    *
	    * @access	private
	    * @return	void
	    */
		private function sendOutput()
		{
			$this->registry->output->html .= $this->html->convertFooter();
			$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
			$this->registry->output->sendOutput();
			exit;
		}

		/**
		 * Count rows
		 *
		 * @access	private
		 * @param 	string		action (e.g. 'members', 'forums', etc.)
		 * @return 	integer 	number of entries
		 **/
		public function countRows($action)
		{
			switch ($action)
			{
				default:
					return $this->lib->countRows($action);
					break;
			}
		}

		/**
		 * Check if section has configuration options
		 *
		 * @access	private
		 * @param 	string		action (e.g. 'members', 'forums', etc.)
		 * @return 	boolean
		 **/
		public function checkConf($action)
		{
			switch ($action)
			{
				case 'gallery_images':
					return true;
					break;

				default:
					return false;
					break;
			}
		}

		/**
		 * Fix post data
		 *
		 * @access	private
		 * @param 	string		raw post data
		 * @return 	string		parsed post data
		 **/
		private function fixPostData($post)
		{
			return $post;
		}

		/**
		 * Convert Categories
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_categories()
		{

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> 'c.*',
							'from' 		=> array('gallery_categories' => 'c'),
							'order'		=> 'c.id ASC',
							'add_join'	=> array(
											array( 	'select' => 'p.*',
													'from'   =>	array( 'permission_index' => 'p' ),
													'where'  => "p.app='gallery' AND p.perm_type='cat' AND p.perm_type_id=c.id",
													'type'   => 'left'
												),
											),
						);

			$loop = $this->lib->load('gallery_categories', $main);

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				//-----------------------------------------
				// Handle permissions
				//-----------------------------------------

				$perms = array();
				$perms['view_thumbnails']	= $row['perm_view'];
				$perms['view_images']		= $row['perm_2'];
				$perms['post_images']		= $row['perm_3'];
				$perms['comment']			= $row['perm_4'];
				$perms['moderate']			= $row['perm_5'];

				//-----------------------------------------
				// And go
				//-----------------------------------------

				$this->lib->convertCategory($row['id'], $row, $perms);
			}

			$this->lib->next();

		}

		/**
		 * Convert Albums
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_albums()
		{

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'gallery_albums',
							'order'		=> 'id ASC',
						);

			$loop = $this->lib->load('gallery_albums', $main);

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$this->lib->convertAlbum($row['id'], $row);
			}

			$this->lib->next();

		}

		/**
		 * Convert Images
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_images()
		{

			//-----------------------------------------
			// Were we given more info?
			//-----------------------------------------

			$this->lib->saveMoreInfo('gallery_images', array('gallery_path'));

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'gallery_images',
							'order'		=> 'id ASC',
						);

			$loop = $this->lib->load('gallery_images', $main, array('gallery_favorites'));

			//-----------------------------------------
			// We need to know the path
			//-----------------------------------------

			$this->lib->getMoreInfo('gallery_images', $loop, array('gallery_path' => array('type' => 'text', 'label' => 'The path to the folder where images are saved (no trailing slash - usually path_to_ipgallery/uploads):')), 'path');

			$get = unserialize($this->settings['conv_extra']);
			$us = $get[$this->lib->app['name']];
			$path = $us['gallery_path'];

			//-----------------------------------------
			// Check all is well
			//-----------------------------------------

			if (!is_writable($this->settings['gallery_images_path']))
			{
				$this->lib->error('Your IP.Gallery upload path is not writeable. '.$this->settings['gallery_images_path']);
			}
			if (!is_readable($path))
			{
				$this->lib->error('Your remote upload path is not readable.');
			}

			//-----------------------------------------
			// Prepare for reports conversion
			//-----------------------------------------

			$this->lib->prepareReports('gallery_images');

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				//-----------------------------------------
				// Do the image
				//-----------------------------------------

				foreach ($row as $key => $value)
				{
					if(preg_match('/field_(.+)/', $key))
					{
						$custom[$key] = $value;
					}
					else
					{
						$info[$key] = $value;
					}
				}

				$this->lib->convertImage($row['id'], $info, $path, $custom);

				//-----------------------------------------
				// Favourites
				//-----------------------------------------

				$favs = array(	'select' 	=> '*',
								'from' 		=> 'gallery_favorites',
								'order'		=> 'id ASC',
								'where'		=> 'img_id='.$row['id']
							);

				ipsRegistry::DB('hb')->build($favs);
				ipsRegistry::DB('hb')->execute();
				while ($fav = ipsRegistry::DB('hb')->fetch())
				{
					$this->lib->convertFav($fav['id'], $fav);
				}

				//-----------------------------------------
				// Ratings
				//-----------------------------------------

				$rates = array(	'select' 	=> '*',
								'from' 		=> 'gallery_ratings',
								'order'		=> 'id ASC',
								'where'		=> 'img_id='.$row['id']
							);

				ipsRegistry::DB('hb')->build($rates);
				ipsRegistry::DB('hb')->execute();
				while ($rate = ipsRegistry::DB('hb')->fetch())
				{
					$this->lib->convertRating($rate['id'], $rate);
				}

				//-----------------------------------------
				// Report Center
				//-----------------------------------------

				$rc = $this->DB->buildAndFetch( array( 'select' => 'com_id', 'from' => 'rc_classes', 'where' => "my_class='gallery'" ) );
				$rs = array(	'select' 	=> '*',
								'from' 		=> 'rc_reports_index',
								'order'		=> 'id ASC',
								'where'		=> 'exdat1='.$row['id']." AND exdat2=0 AND rc_class='{$rc['com_id']}'"
							);

				ipsRegistry::DB('hb')->build($rs);
				ipsRegistry::DB('hb')->execute();
				while ($report = ipsRegistry::DB('hb')->fetch())
				{
					$rs = array(	'select' 	=> '*',
									'from' 		=> 'rc_reports',
									'order'		=> 'id ASC',
									'where'		=> 'rid='.$report['id']
								);

					ipsRegistry::DB('hb')->build($rs);
					ipsRegistry::DB('hb')->execute();
					$reports = array();
					while ($r = ipsRegistry::DB('hb')->fetch())
					{
						$reports[] = $r;
					}
					$this->lib->convertReport('gallery_images', $report, $reports);
				}

			}

			$this->lib->next();

		}

		/**
		 * Convert Comments
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_comments()
		{

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'gallery_comments',
							'order'		=> 'pid ASC',
						);

			$loop = $this->lib->load('gallery_comments', $main);

			//-----------------------------------------
			// Prepare for reports conversion
			//-----------------------------------------

			$this->lib->prepareReports('gallery_comments');

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$row['comment'] = $this->fixPostData($row['comment']);
				$this->lib->convertComment($row['pid'], $row);

				//-----------------------------------------
				// Report Center
				//-----------------------------------------

				$rc = $this->DB->buildAndFetch( array( 'select' => 'com_id', 'from' => 'rc_classes', 'where' => "my_class='gallery'" ) );
				$rs = array(	'select' 	=> '*',
								'from' 		=> 'rc_reports_index',
								'order'		=> 'id ASC',
								'where'		=> 'exdat2='.$row['pid']." AND rc_class='{$rc['com_id']}'"
							);

				ipsRegistry::DB('hb')->build($rs);
				ipsRegistry::DB('hb')->execute();
				while ($report = ipsRegistry::DB('hb')->fetch())
				{
					$rs = array(	'select' 	=> '*',
									'from' 		=> 'rc_reports',
									'order'		=> 'id ASC',
									'where'		=> 'rid='.$report['id']
								);

					ipsRegistry::DB('hb')->build($rs);
					ipsRegistry::DB('hb')->execute();
					$reports = array();
					while ($r = ipsRegistry::DB('hb')->fetch())
					{
						$reports[] = $r;
					}
					$this->lib->convertReport('gallery_comments', $report, $reports);
				}

			}

			$this->lib->next();

		}

		/**
		 * Convert eCard Logs
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_ecardlog()
		{

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'gallery_ecardlog',
							'order'		=> 'id ASC',
						);

			$loop = $this->lib->load('gallery_ecardlog', $main);

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$this->lib->convertECard($row['id'], $row);
			}

			$this->lib->next();

		}

		/**
		 * Convert subscriptions
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_subscriptions()
		{

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'gallery_subscriptions',
							'order'		=> 'sub_id ASC',
						);

			$loop = $this->lib->load('gallery_subscriptions', $main);

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$this->lib->convertSub($row['sub_id'], $row);
			}

			$this->lib->next();

		}

		/**
		 * Convert media types
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_media_types()
		{

			//-----------------------------------------
			// Were we given more info?
			//-----------------------------------------

			$this->lib->saveMoreInfo('gallery_media_types', array('media_opt'));

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'gallery_media_types',
							'order'		=> 'id ASC',
						);

			$loop = $this->lib->load('gallery_media_types', $main);

			//-----------------------------------------
			// We need to know what do do with duplicates
			//-----------------------------------------

			$this->lib->getMoreInfo('gallery_media_types', $loop, array('media_opt'  => array('type' => 'dupes', 'label' => 'How do you want to handle duplicate media types?')));

			$get = unserialize($this->settings['conv_extra']);
			$us = $get[$this->lib->app['name']];

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$this->lib->convertMediaType($row['id'], $row, $us['media_opt']);
			}

			$this->lib->next();

		}

		/**
		 * Convert Form Fields
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_form_fields()
		{

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'gallery_form_fields',
							'order'		=> 'id ASC',
						);

			$loop = $this->lib->load('gallery_form_fields', $main);

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$this->lib->convertFormField($row['id'], $row);
			}

			$this->lib->next();

		}

	}

