<?php
/**
 * (SN) PM Viewer
 * Attachment Class
 * Last Updated: July 2nd 2011
 *
 * @author 		signet51
 * @copyright	(c) 2011 signet51 Modding
 * @version		1.6.4a (1641)
 *
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class class_attach_pm
{
	/**
	 * Global html class
	 *
	 * @var		object
	 */
	public $html;
	
	/**
	 * Type of attachment
	 *
	 * @var		string
	 */
	public $type    = '';
	
	/**
	 * Plugin Class
	 *
	 * @var		object
	 */
	public $plugin  = '';
	
	/**
	 * Post key
	 *
	 * @var		string
	 */
	public $attach_post_key = '';
	
	/**
	 * Relationship ID
	 *
	 * @var		integer
	 */
	public $attach_rel_id   = 0;
	
	/**
	* Relationship parent ID
	 *
	 * @var		int
	 */
	public $attach_parent_id	= 0;
	
	/**
	 * Return variables
	 *
	 * @var		array 	[ 'allow_uploads', 'space_allowed', 'space_allowed_human', 'space_used', 'space_used_human', 'space_left', 'space_left_human' ]
	 */
	public $attach_stats = array();
	
	/**
	 * Lang array
	 * Internal language array
	 *
	 * @var		array
	 */
	public $language    = array( 'unlimited'   => 'Unlimited',
	 						  'not_allowed' => 'Uploading is not allowed' );
	
	/**
	 * Error array
	 *
	 * @var		string
	 */
	public $error = "";
	
	/**
	 * Full upload path
	 *
	 * @var		string
	 */
	public $upload_path = '';
	
	/**
	 * Upload part part (from /uploads)
	 *
	 * @var		string
	 */
	public $upload_dir  = '';
	
	/**
	 * Extra upload form url
	 *
	 * @var		string
	 */
	public $extra_upload_form_url = '';
	
	/**
	 * Custom settings
	 *
	 * @var		array
	 */
	public $attach_settings = array( 
									'siu_thumb'                 => 0,
									'siu_height'                => 0,
									'siu_width'                 => 0,
									'allow_monthly_upload_dirs' => 0,
									'upload_dir'                => '' 
								);

	/**#@+
	 * Registry Object Shortcuts
	 *
	 * @var		object
	 */
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	protected $member;
	protected $memberData;
	/**#@-*/

	/**
	 * CONSTRUCTOR
	 *
	 * @param	object		ipsRegistry reference
	 * @return	@e void
	 */
	public function __construct( ipsRegistry $registry )
	{
		/* Make object */
		$this->registry   = $registry;
		$this->DB         = $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->lang       = $this->registry->getClass('class_localization');
		$this->member     = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
	}

	/**
	 * Initiates class
	 *
	 * @return	@e void
	 */
	public function init()
	{
		//-----------------------------------------
		// Start the settings
		//-----------------------------------------
		
		$this->attach_settings['siu_thumb'] 				= $this->settings['siu_thumb'];
		$this->attach_settings['siu_height'] 				= $this->settings['siu_height'];
		$this->attach_settings['siu_width'] 				= $this->settings['siu_width'];
		$this->attach_settings['allow_monthly_upload_dirs'] = @ini_get("safe_mode") ? 0 : ( $this->settings['safe_mode_skins'] ? 0 : 1 );
		$this->attach_settings['upload_dir'] 				= $this->settings['upload_dir'];
		
		//-----------------------------------------
		// Load plug in
		//-----------------------------------------
		
		if ( $this->type )
		{
			$this->loadAttachmentPlugin();
		}
		
		//-----------------------------------------
		// Finalize the settings
		//-----------------------------------------
		
		foreach( $this->attach_settings as $item => $value )
		{
			$this->attach_settings[ $item ] = ( isset( $this->plugin->mysettings[ $item ] ) ) ? $this->plugin->mysettings[ $item ] : $value;
		}

		//-----------------------------------------
		// Fix up URL tokens
		//-----------------------------------------
		
		foreach( $_GET as $k => $v )
		{
			if ( preg_match( "#^--ff--#", $k ) )
			{
			 	$this->request[ str_replace( '--ff--', '', $k ) ] = $v;
			}
		}
		
		//-----------------------------------------
		// Sort out upload dir
		//-----------------------------------------
		
		$this->upload_path  = $this->attach_settings['upload_dir'];

		$this->_upload_path = $this->upload_path;
	}
	
	/**
	 * Show the attachment (or force download)
	 *
	 * @param	int		Attachment ID (The main attach id)
	 * @return	@e void
	 */
	public function showAttachment( $attach_id )
	{
		/* INIT */
		$sql_data = array();
		
		/* Get attach data... */
		$attachment = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'attachments', 'where' => 'attach_id='.intval( $attach_id ) ) );
															
		if( ! $attachment['attach_id'] )
		{
			$this->registry->getClass('output')->showError( 'attach_no_attachment' );
		}
	
		/* Load correct plug in... */
		$this->type = 'pmviewer';
		$this->loadAttachmentPlugin();
		
		/* Get SQL data from plugin */
		$attach = $this->plugin->getAttachmentData( $attach_id );
		
		/* Got a reply? */
		if( $attach === FALSE OR ! is_array( $attach ) )
		{
			$this->registry->getClass('output')->showError( 'no_permission_to_download' );
		}
		
		/* Got a rel id? */
		if( ! $attach['attach_rel_id'] )
		{
			$this->registry->getClass('output')->showError( 'err_attach_not_attached' );
		}
		
		//-----------------------------------------
		// Reset timeout for large attachments
		//-----------------------------------------
		
		if ( @function_exists("set_time_limit") == 1 and SAFE_MODE_ON == 0 )
		{
			@set_time_limit( 0 );
		}
		
		if( is_array( $attach ) AND count( $attach ) )
		{
			/* Got attachment types? */
			if ( ! is_array( $this->registry->cache()->getCache('attachtypes') ) )
			{
				$attachtypes = array();

				$this->DB->build( array( 'select' => 'atype_extension,atype_mimetype', 'from' => 'attachments_type' ) );
				$this->DB->execute();

				while( $r = $this->DB->fetch() )
				{
					$attachtypes[ $r['atype_extension'] ] = $r;
				}
				
				$this->registry->cache()->updateCacheWithoutSaving( 'attachtypes', $attachtypes );
			}

			/* Show attachment */
			$attach_cache       = $this->registry->cache()->getCache('attachtypes');
			$this->_upload_path = ( isset( $this->plugin->mysettings[ 'upload_dir' ] ) ) ? $this->plugin->mysettings[ 'upload_dir' ] : $this->attach_settings[ 'upload_dir' ];

	        $file = $this->_upload_path . "/" . $attach['attach_location'];

			if( is_file( $file ) and ( $attach_cache[ $attach['attach_ext'] ]['atype_mimetype'] != "" ) )
			{
				/* Update the "hits".. - Suppressed for the PM Viewer so no one knows we were here */
				//$this->DB->buildAndFetch( array( 'update' => 'attachments', 'set' => "attach_hits=attach_hits+1", 'where' => "attach_id={$attach_id}" ) );
				
				/* Open and display the file.. */
				header( "Content-Type: {$attach_cache[ $attach['attach_ext'] ]['atype_mimetype']}" );
				
				$disposition	= $attach['attach_is_image'] ? "inline" : "attachment";
				
				if( in_array( $this->memberData['userAgentKey'], array( 'firefox', 'opera' ) ) )
				{
					@header( 'Content-Disposition: ' . $disposition . "; filename*={$this->settings['gb_char_set']}''" . rawurlencode($attach['attach_file']) );
				}
				else if( in_array( $this->memberData['userAgentKey'], array( 'explorer' ) ) )
				{
					@header( 'Content-Disposition: ' . $disposition . '; filename="' . rawurlencode($attach['attach_file']) . '"' );
				}
				else
				{
					@header( 'Content-Disposition: ' . $disposition . '; filename="' . $attach['attach_file'] . '"' );
				}
				
				if( !ini_get('zlib.output_compression') OR ini_get('zlib.output_compression') == 'off' )
				{
					header( 'Content-Length: ' . (string) ( filesize( $file ) ) );
				}

				/**
				 * @link	http://community.invisionpower.com/tracker/issue-22011-wrong-way-to-handle-attachments-transfer/
				 */
				if ( function_exists('ob_end_clean') )
				{
					@ob_end_clean();
				}
				
				if( function_exists('readfile') )
				{
					readfile( $file );
				}
				else
				{
					if( $fh = fopen( $file, 'rb' ) )
					{
						while( ! feof( $fh ) )
						{
							echo fread( $fh, 4096 );

							if ( function_exists('ob_get_length') AND function_exists('ob_flush') AND @ob_get_length() )
							{
								@ob_flush();
							}
							else
							{
								@flush();
							}
						}

						@fclose( $fh );
					}
				}

				exit();
			}
			else
			{
				/* File does not exist.. */
				$this->registry->getClass('output')->showError( 'attach_file_missing' );
			}
		}
		else
		{
			/*  No permission? */
			$this->registry->getClass('output')->showError( 'no_permission_to_download' );
		}
	}	
	
	/**
	 * Retrieve attachment types from cache
	 *
	 * @return	@e array
	 */
	protected function getAttachTypes()
	{
		//-----------------------------------------
		// Got attachment types?
		//-----------------------------------------

		if ( ! is_array( $this->registry->cache()->getCache('attachtypes') ) )
		{
			$attachtypes = array();
			
			$this->DB->build( array( 'select' => 'atype_extension,atype_mimetype,atype_img', 'from' => 'attachments_type' ) );
			$outer = $this->DB->execute();

			while ( $r = $this->DB->fetch( $outer ) )
			{
				$attachtypes[ $r['atype_extension'] ] = $r;
			}
			
			$this->registry->cache()->updateCacheWithoutSaving( 'attachtypes', $attachtypes );
		}
		else
		{
			$attachtypes	= $this->registry->cache()->getCache('attachtypes');
		}
		
		return $attachtypes;
	}
	
	/**
	 * Swaps the HTML for the nice attachments.
	 *
	 * @param	array 	Array of HTML blocks to convert: [ rel_id => $html ]
	 * @param	array 	Relationship ids
	 * @param	string	Skin group to use
	 * @return	array 	Array of converted HTML blocks and attach code: [ id => $html ]
	 */
	public function renderAttachments( $htmlArray, $rel_ids=array(), $skin_name='topic' )
	{
		//-----------------------------------------
		// INIT
		//-----------------------------------------
		
		$attach_ids              = array();
		$map_attach_id_to_rel_id = array();
		$final_out               = array();
		$final_blocks            = array();
		$returnArray			 = array();
		$_seen                   = 0;
		
		//-----------------------------------------
		// Check..
		//-----------------------------------------
		
		if ( ! is_array( $htmlArray ) )
		{
			$htmlArray = array( 0 => $htmlArray );
		}
		
		//-----------------------------------------
		// Rel ids
		//-----------------------------------------
		
		if ( ! is_array( $rel_ids ) OR ! count( $rel_ids ) )
		{
			$rel_ids = array_keys( $htmlArray );
		}
		
		//-----------------------------------------
		// Parse HTML blocks for attach ids
		// [attachment=32:attachFail.gif]
		//-----------------------------------------
		
		foreach( $htmlArray as $id => $html )
		{
			$returnArray[ $id ] = array( 'html' => $html, 'attachmentHtml' => '' );
			
			preg_match_all( '#\[attachment=(\d+?)\:(?:[^\]]+?)\]#is', $html, $match );
			
			if ( is_array( $match[0] ) and count( $match[0] ) )
			{
				for ( $i = 0 ; $i < count( $match[0] ) ; $i++ )
				{
					if ( intval($match[1][$i]) == $match[1][$i] )
					{
						$attach_ids[ $match[1][$i] ]                = $match[1][$i];
						$map_attach_id_to_rel_id[ $match[1][$i] ][] = $id;
					}
				}
			}
		}
		
		//-----------------------------------------
		// Get data from the plug in
		//-----------------------------------------
		
		$rows = $this->plugin->renderAttachment( $attach_ids, $rel_ids, $this->attach_post_key );
				
		//-----------------------------------------
		// Got anything?
		//-----------------------------------------
		
		if ( is_array( $rows ) AND count( $rows ) )
		{
			$attachtypes	= $this->getAttachTypes();
		
			foreach( $rows as $_attach_id => $row )
			{
				//-----------------------------------------
				// INIT
				//-----------------------------------------
				
				$row = $rows[ $_attach_id ];
				
				$this->attach_rel_id = $row['attach_rel_id'];
				
				if ( ! isset( $final_blocks[ $row['attach_rel_id'] ] ) )
				{
					$final_blocks[ $row['attach_rel_id'] ] = array( 'attach' => '', 'thumb' => '', 'image' => '' );
				}
				
				//-----------------------------------------
				// Is it an image, and are we viewing the image in the post?
				//-----------------------------------------
				
				if ( $this->settings['show_img_upload'] and $row['attach_is_image'] )
				{
					if ( $this->attach_settings['siu_thumb'] AND $row['attach_thumb_location'] AND $row['attach_thumb_width'] )
					{
						//-----------------------------------------
						// Make sure we've not seen this ID
						//-----------------------------------------
						
						$row['_attach_id'] = $row['attach_id'] . '-' . str_replace( array( '.', ' ' ), "-", microtime() );
											
						$tmp_url = $this->settings['base_url'] . 'module=attach&amp;section=attach&amp;attach_rel_module=pmviewer&amp;attach_id='.$row['attach_id'];
						$row['file_size'] = IPSLib::sizeFormat( $row['attach_filesize'] );
						
						$tmp = "<a class='resized_img' rel='lightbox[{$row['attach_rel_id']}]' id='ipb-attach-url-{$row['_attach_id']}' href='{$tmp_url}' title='{$row['attach_file']} - {$this->lang->words['pm_attched_size']}: {$row['file_size']}, {$this->lang->words['pm_downloads']}: {$row['attach_hits']}'><img src='{$this->settings['upload_url']}/{$row['attach_thumb_location']}' id='ipb-attach-img-{$row['_attach_id']}' style='width:{$row['attach_thumb_width']};height:{$row['attach_thumb_height']}' class='attach' width='{$row['attach_thumb_width']}' height='{$row['attach_thumb_height']}' alt='{$this->lang->words['pm_attched_img']}: {$row['attach_file']}' /></a>";

						//-----------------------------------------
						// Convert HTML
						//-----------------------------------------
						
						if ( isset($map_attach_id_to_rel_id[ $_attach_id ]) AND is_array( $map_attach_id_to_rel_id[ $_attach_id ] ) AND count( $map_attach_id_to_rel_id[ $_attach_id ] ) )
						{
							foreach( $map_attach_id_to_rel_id[ $_attach_id ] as $idx => $_rel_id )
							{
								$_count = substr_count( $htmlArray[ $_rel_id ], '[attachment='.$row['attach_id'].':' );
						
								if ( $_count > 1 )
								{
									# More than 1 of the same thumbnail to show?
									$this->_current = array( 'type'      => $this->type,
															 'row'       => $row,
															 'skin_name' => $skin_name );
							
									$returnArray[ $_rel_id ]['html'] = preg_replace_callback( '#\[attachment='.$row['attach_id'].'\:(?:[^\]]+?)[\n|\]]#is', array( &$this, '_parseThumbnailInline' ), $returnArray[ $_rel_id ]['html'] );
								}
								else if ( $_count )
								{
									# Just the one, then?
									$returnArray[ $_rel_id ]['html'] = preg_replace( '#\[attachment='.$row['attach_id'].'\:(?:[^\]]+?)[\n|\]]#is', $tmp, $returnArray[ $_rel_id ]['html'] );
								}
								else
								{
									$final_blocks[ $_rel_id ]['thumb'][] = $tmp;
								}
							}
						}
						else
						{
							$final_blocks[ $row['attach_rel_id'] ]['thumb'][] = $tmp;
						}
					}
					else
					{
						//-----------------------------------------
						// Standard size..
						//-----------------------------------------
						
						$tmp = "<img src='{$this->settings['upload_url']}/{$row['attach_location']}' class='bbc_img linked-image' alt='{$this->lang->words['pm_attched_img']}: {$file_name}' />";
						
						if ( is_array( $map_attach_id_to_rel_id[ $_attach_id ] ) AND count( $map_attach_id_to_rel_id[ $_attach_id ] ) )
						{
							foreach( $map_attach_id_to_rel_id[ $_attach_id ] as $idx => $_rel_id )
							{
								if ( strstr( $htmlArray[ $_rel_id ], '[attachment='.$row['attach_id'].':' ) )
								{
									$returnArray[ $_rel_id ]['html'] = preg_replace( '#\[attachment='.$row['attach_id'].'\:(?:[^\]]+?)[\n|\]]#is', $tmp, $returnArray[ $_rel_id ]['html'] );
								}
								else
								{
									$final_blocks[ $_rel_id ]['image'][] = $tmp;
								}
							}
						}
						else
						{
							$final_blocks[ $row['attach_rel_id'] ]['image'][] = $tmp;
						}
					}
				}
				else
				{
					//-----------------------------------------
					// Full attachment thingy
					//-----------------------------------------
				
					$attach_cache = $this->registry->cache()->getCache('attachtypes');
					
					$tmp_url = $this->settings['base_url'] . 'module=attach&amp;section=attach&amp;attach_rel_module=pmviewer&amp;attach_id='.$row['attach_id'];
					$row['mime_image'] = $attach_cache[ $row['attach_ext'] ]['atype_img'];
					$row['file_size'] = IPSLib::sizeFormat( $row['attach_filesize'] );
					
					$tmp = "<a href='{$tmp_url}' title='{$this->lang->words['pm_attched_downloads']}'><img src='{$this->settings['public_dir']}{$row['mime_image']}' alt='{$this->lang->words['pm_attched_file']}' /></a>
&nbsp;<a href='{$tmp_url}' title='{$this->lang->words['pm_attched_downloads']}'>{$row['attach_file']}</a> <span class='desc'><strong>({$row['file_size']})</strong></span>
<br /><span class='desc info'>{$this->lang->words['pm_attched_num_downloads']}: {$row['attach_hits']}</span>";
					
					if ( is_array( $map_attach_id_to_rel_id[ $_attach_id ] ) AND count( $map_attach_id_to_rel_id[ $_attach_id ] ) )
					{
						foreach( $map_attach_id_to_rel_id[ $_attach_id ] as $idx => $_rel_id )
						{
							if ( strstr( $htmlArray[ $_rel_id ], '[attachment='.$row['attach_id'].':' ) )
							{
								$returnArray[ $_rel_id ]['html'] = preg_replace( '#\[attachment='.$row['attach_id'].'\:(?:[^\]]+?)[\n|\]]#is', $tmp, $returnArray[ $_rel_id ]['html'] );
							}
							else
							{
								$final_blocks[ $_rel_id ]['attach'][] = $tmp;
							}
						}
					}
					else
					{
						$final_blocks[ $row['attach_rel_id'] ]['attach'][] = $tmp;
					}
				}
				
				$_seen_rows++;
			}
			
			//-----------------------------------------
			// Anthing to add?
			//-----------------------------------------
			
			if ( count( $final_blocks ) )
			{
				foreach( $final_blocks as $rel_id => $type )
				{
					$temp_out = "";

					if ( $final_blocks[ $rel_id ]['thumb'] )
					{
						$temp_out .= "<div id='attach_wrap' class='rounded clearfix'>
	<h4>{$this->lang->words['pm_attched_thumbs']}</h4>
	<ul>";
	
						foreach ($final_blocks[ $rel_id ]['thumb'] as $file)
						{
							$temp_out.= "<li>
				{$file}
			</li>";
						}
						$temp_out .= "</ul>
</div>";
					}

					if ( $final_blocks[ $rel_id ]['image'] )
					{
						$temp_out .= "<div id='attach_wrap' class='rounded clearfix'>
	<h4>{$this->lang->words['pm_attched_imgs']}</h4>
	<ul>";
						foreach ($final_blocks[ $rel_id ]['image'] as $file)
						{
							$temp_out .= "<li>
				{$file}
			</li>";
						}
						$temp_out .= "</ul>
</div>";
					}

					if ( $final_blocks[ $rel_id ]['attach'] )
					{
						$temp_out .= "<div id='attach_wrap' class='rounded clearfix'>
	<h4>{$this->lang->words['pm_attched_files']}</h4>
	<ul>";
						foreach ($final_blocks[ $rel_id ]['attach'] as $file)
						{
							$temp_out .= "<li class='clear'>
				{$file}
			</li>";
						}
						$temp_out .= "</ul>
</div>";
					}
		
					if ( $temp_out )
					{
						$returnArray[ $rel_id ]['attachmentHtml'] = $temp_out;
					}
				}
			}
		}

		return $returnArray;
	}
	
	/**
	 * Loads child extends class.
	 *
	 * @return	void
	 */
	public function loadAttachmentPlugin()
	{
		/* INIT */
		$this->type = IPSText::alphanumericalClean( $this->type );
		
		/* Load... */
		if( file_exists( IPSLib::getAppDir( 'pmviewer' ) . '/extensions/attachments/plugin_' . $this->type . '.php' ) )
		{
			$file = IPSLib::getAppDir( 'pmviewer' ) . '/extensions/attachments/plugin_' . $this->type . '.php';
		}
		$class = 'plugin_'.$this->type;

		if( ! is_object( $this->plugin ) )
		{
			if ( file_exists( $file ) )
			{
				require_once( $file );
				$this->plugin = new $class( $this->registry );				
				$this->plugin->getSettings();
			}
			else
			{	
				print "Could not locate plugin {$file}";
				exit();
			}
		}
	}
	
	/**
	 * Swaps the HTML for the nice attachments.
	 *
	 * @param	array	Array of matches from preg_replace_callback
	 * @return	string	HTML
	 */
	private function _parseThumbnailInline( $matches )
	{
		//-----------------------------------------
		// INIT
		//-----------------------------------------
		
		$row       = $this->_current['row'];
		$skin_name = $this->_current['skin_name'];
		
		//-----------------------------------------
		// Generate random ID
		//-----------------------------------------
		
		$row['_attach_id'] = $row['attach_id'] . '-' . str_replace( array( '.', ' ' ), "-", microtime() );
		
		//-----------------------------------------
		// Build HTML
		//-----------------------------------------
		
		$tmp_url = $this->settings['base_url'] . 'module=attach&amp;section=attach&amp;attach_rel_module=pmviewer&amp;attach_id='.$row['attach_id'];
		$row['file_size'] = IPSLib::sizeFormat( $row['attach_filesize'] );
						
		$tmp = "<a class='resized_img' rel='lightbox[{$row['attach_rel_id']}]' id='ipb-attach-url-{$row['_attach_id']}' href='{$tmp_url}' title='{$row['attach_file']} - {$this->lang->words['pm_attched_size']}: {$row['file_size']}, {$this->lang->words['pm_downloads']}: {$row['attach_hits']}'><img src='{$this->settings['upload_url']}/{$row['attach_thumb_location']}' id='ipb-attach-img-{$row['_attach_id']}' style='width:{$row['attach_thumb_width']};height:{$row['attach_thumb_height']}' class='attach' width='{$row['attach_thumb_width']}' height='{$row['attach_thumb_height']}' alt='{$this->lang->words['pm_attched_img']}: {$row['attach_file']}' /></a>";
		
		/*$tmp = $this->registry->getClass('output')->getTemplate( $skin_name )->Show_attachments_img_thumb( array( 't_location'  => $row['attach_thumb_location'],
																							  		 't_width'     => $row['attach_thumb_width'],
																							  		 't_height'    => $row['attach_thumb_height'],
																							         'o_width'     => $row['attach_img_width'],
																							  		 'o_height'    => $row['attach_img_height'],
																							  	     'attach_id'   => $row['attach_id'],
																									 '_attach_id'  => $row['_attach_id'],
																							    	 'file_size'   => IPSLib::sizeFormat( $row['attach_filesize'] ),
																							  		 'attach_hits' => $row['attach_hits'],
																							  		 'location'    => $row['attach_file'],
																									 'type'        => $this->_current['type'],
																						)	);*/
		
		return $tmp;
	}
}