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

if (! defined ( 'IN_IPB' )) {
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit ();
}

class classifieds_images {
	
	public function __construct($registry) {
		$this->registry = $registry;
		$this->DB = $this->registry->DB ();
		$this->settings = $this->registry->settings ();
		$this->request = $this->registry->request ();
		$this->lang = $this->registry->getClass ( 'class_localization' );
	
	}
	
	/**
	 * Builds an image sized copies based on the settings
	 * 
	 * @param	array		$image		Image data
	 * @param	array		$opts		Build options (album_id|destination|watermark)
	 * @return	@e bool
	 */
	public function buildSizedCopies($image = array(), $opts = array()) {
		
		/* Init */
		
		$_return = array ();
		$imData = array ();
		$_save = array ();
		
		/* Settings setup */
		$settings = array ('image_path' => $this->settings ['upload_dir'] . '/', 'image_file' => $image ['attach_location'], 'im_path' => $this->settings ['gallery_im_path'], 'temp_path' => DOC_IPS_ROOT_PATH . '/cache/tmp', 'jpg_quality' => 90, 'png_quality' => 6 );
		
		$_default = $settings ['image_path'] . $image ['attach_location'];
		
		/* Images setup */
		$_thumbName = preg_replace ( '#^(.*)\.(\w+?)$#', "\\1_thumb.\\2", $image ['attach_location'] );
		$thumb = $settings ['image_path'] . $_thumbName;
		
		$_medName = preg_replace ( '#^(.*)\.(\w+?)$#', "\\1_med.\\2", $image ['attach_location'] );
		$med = $settings ['image_path'] . $_medName;
		
		/* Basic checks */
		if (! count ( $image )) {
			return false;
		}
		
		/* Ensure we have a file on disk */
		if (! file_exists ( $_default )) {
			return false;
		} else {
			@chmod ( $_default, IPS_FILE_PERMISSION );
		}
		
		/* Get kernel image library */
		require_once (IPS_KERNEL_PATH . 'classImage.php'); /*noLibHook*/
		
		$img = ips_kernel_image::bootstrap ( 'gd' );
		
		/* Prep Thumbnail */
		if ($img->init ( $settings )) {
			
			$return = $img->croppedResize ( 100, 100 );
			
			if ($img->writeImage ( $thumb )) {
				@chmod ( $thumb, IPS_FILE_PERMISSION );
			
			}
		}
		
		unset ( $img );
		
		$img = ips_kernel_image::bootstrap ( 'gd' );
		
		/* Prep Medium */
		if ($img->init ( $settings )) {
			
			$return = $img->croppedResize ( 300, 300 );
			
			if ($img->writeImage ( $med )) {
				@chmod ( $med, IPS_FILE_PERMISSION );
			
			}
		}
		
		unset ( $img );
		
		// Update the db
		
		$_save = array(
						'item_id' => $image['attach_rel_id'],
						'attach_id' => $image['attach_id'],
						'thumb_location' => $_thumbName,
						'med_location' => $_medName,
						'full_location' => $image ['attach_location'],
		
		);
		
		$this->DB->replace( "classifieds_images", $_save, "attach_id={$image['attach_id']}" );
		
		return $_return;
	}

}

?>