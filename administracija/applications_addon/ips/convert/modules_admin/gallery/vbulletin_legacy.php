<?php
/**
 * IPS Converters
 * IP.Gallery 3.0 Converters
 * vBulletin
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
		'key'	=> 'vbulletin_legacy',
		'name'	=> 'vBulletin 3.8',
		'login'	=> false,
	);

	$parent = array('required' => true, 'choices' => array(
		array('app' => 'board', 'key' => 'vbulletin_legacy', 'newdb' => false),
		));

	class admin_convert_gallery_vbulletin_legacy extends ipsCommand
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
				'gallery_albums'		=> array('members'),
				'gallery_images'		=> array('members', 'gallery_albums'),
				'gallery_comments'		=> array('members', 'gallery_images'),
				);

			//-----------------------------------------
	        // Load our libraries
	        //-----------------------------------------

			require_once( IPS_ROOT_PATH . 'applications_addon/ips/convert/sources/lib_master.php' );
			require_once( IPS_ROOT_PATH . 'applications_addon/ips/convert/sources/convertGallery.php' );
			$this->lib =  new convertGallery( $registry, $html, $this );

	        $this->html = $this->lib->loadInterface();
			$this->lib->sendHeader( 'vBulletin Gallery &rarr; IP.Gallery Converter' );

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
				case 'gallery_albums':
					return $this->lib->countRows('album');
					break;

				case 'gallery_images':
					return $this->lib->countRows('picture');
					break;

				case 'gallery_comments':
					return $this->lib->countRows('picturecomment');
					break;

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
				case 'gallery_albums':
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
			// Sort out newlines
			$post = nl2br($post);

			// And quote tags
			$post = preg_replace("#\[quote=(.+);\d\]#i", "[quote name='$1']", $post);
			$post = preg_replace("#\[quote=(.+)\](.+)\[/quote\]#i", "[quote name='$1']$2[/quote]", $post);

			return $post;
		}

		/**
		 * Convert Albums
		 *
		 * @access	private
		 * @return void
		 **/
		private function convert_gallery_albums()
		{

			//-----------------------------------------
			// Were we given more info?
			//-----------------------------------------

			$this->lib->saveMoreInfo('members', array('category'));

			//---------------------------
			// Set up
			//---------------------------

			$main = array(	'select' 	=> '*',
							'from' 		=> 'album',
							'order'		=> 'albumid ASC',
						);

			$loop = $this->lib->load('gallery_albums', $main);

			//-----------------------------------------
			// Tell me what you know!
			//-----------------------------------------

			$get = unserialize($this->settings['conv_extra']);
			$us = $get[$this->lib->app['name']];
			$ask = array();

			$options = array();
			$this->DB->build(array('select' => '*', 'from' => 'gallery_categories'));
			$this->DB->execute();
			while ($row = $this->DB->fetch())
			{
				$options[$row['id']] = $row['name'];
			}

			$ask['category'] = array('type' => 'dropdown', 'label' => 'The category that albums should go into.', 'options' => $options);

			$this->lib->getMoreInfo('gallery_albums', $loop, $ask);

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$save = array(
					'member_id'		=> $row['userid'],
					'last_pic_date'	=> $row['lastpicturedate'],
					'mod_images'	=> $row['moderation'],
					'mod_comments'	=> $row['moderation'],
					'name'			=> $row['title'],
					'description'	=> $row['description'],
					'public_album'	=> ($row['state'] == 'public') ? 1 : 0,
					'category_id'	=> $us['category'],
					);
				$this->lib->convertAlbum($row['albumid'], $save, true);
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

			$main = array(	'select' 	=> 'p.*',
							'from' 		=> array('picture' => 'p'),
							'add_join'	=> array(
											array( 	'select' => 'l.*',
													'from'   =>	array( 'albumpicture' => 'l' ),
													'where'  => "p.pictureid=l.pictureid",
													'type'   => 'left'
												),
											),
							'order'		=> 'p.pictureid ASC',
						);

			$loop = $this->lib->load('gallery_images', $main);

			//-----------------------------------------
			// Check all is well
			//-----------------------------------------

			if (!is_writable($this->settings['gallery_images_path']))
			{
				$this->lib->error('Your IP.Gallery upload path is not writeable. '.$this->settings['gallery_images_path']);
			}

			//-----------------------------------------
			// We need to know the path
			//-----------------------------------------

			$this->lib->getMoreInfo('gallery_images', $loop, array('gallery_path' => array('type' => 'text', 'label' => 'The path to the folder where gallery images are saved (no trailing slash - if using database storage, enter "."):')), 'path');

			$get = unserialize($this->settings['conv_extra']);
			$us = $get[$this->lib->app['name']];
			$path = $us['gallery_path'];

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				// What's the mimetype?
				$type = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'attachments_type', 'where' => "atype_extension='{$row['extension']}'" ) );

				$save = array(
					'member_id'		=> $row['userid'],
					'album_id'		=> $row['albumid'],
					'caption'		=> $row['caption'],
					'file_name'		=> $row['pictureid'].'.'.$row['extension'],
					'file_size'		=> $row['filesize'],
					'file_type'		=> $type['atype_mimetype'],
					'approved'		=> ($row['state'] == 'visible') ? 1 : 0,
					'idate'			=> $row['dateline'],
					'directory'		=> floor($row['pictureid'] / 1000), # Really, vB does a lot of odd things...
					);

				//-----------------------------------------
				// Database
				//-----------------------------------------

				if ($row['filedata'])
				{
					$save['data'] = $row['filedata'];

					$this->lib->convertImage($row['pictureid'], $save, '', array(), true);
				}

				//-----------------------------------------
				// File storage
				//-----------------------------------------

				else
				{
					if ($path == '.')
					{
						$this->lib->error('You entered "." for the path but you have some attachments in the file system');
					}

					$save['masked_file_name'] = $row['pictureid'].'.picture';

					$this->lib->convertImage($row['pictureid'], $save, $us['gallery_path'], array(), false);
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
							'from' 		=> 'picturecomment',
							'order'		=> 'commentid ASC',
						);

			$loop = $this->lib->load('gallery_comments', $main);

			//---------------------------
			// Loop
			//---------------------------

			while ( $row = ipsRegistry::DB('hb')->fetch($this->lib->queryRes) )
			{
				$save = array(
					'img_id'		=> $row['pictureid'],
					'author_id'		=> $row['postuserid'],
					'author_name'	=> $row['postusername'],
					'post_date'		=> $row['dateline'],
					'approved'		=> ($row['state'] == 'visible') ? 1 : 0,
					'comment'		=> $this->fixPostData($row['pagetext']),
					'ip_address'	=> $row['ipaddress'],
					'use_emo'		=> $row['allow_smilie'],
					);

				$this->lib->convertComment($row['commentid'], $save);
			}

			$this->lib->next();

		}

	}

