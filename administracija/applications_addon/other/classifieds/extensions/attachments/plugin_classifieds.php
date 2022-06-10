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

if ( ! defined( 'IN_IPB' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit();
}

class plugin_classifieds extends class_attach {
    /**
     * Module type
     *
     * @access	public
     * @var		string
     */
    public $module = 'classifieds';

    /**
     * Returns an array of settings:
     * 'siu_thumb' = Allow thumbnail creation?
     * 'siu_height' = Height of the generated thumbnail in pixels
     * 'siu_width' = Width of the generated thumbnail in pixels
     * 'upload_dir' = Base upload directory (must be a full path)
     *
     * You can omit any of these settings and IPB will use the default
     * settings (which are the ones entered into the ACP for post thumbnails)
     *
     * @access	public
     * @return	boolean
     */
    public function getSettings() {
        $this->mysettings = array( 'siu_thumb'	=> 0,
                'siu_width'	=> $this->settings['classifieds_thumbnail_width'],
                'siu_height'	=> $this->settings['classifieds_thumbnail_height'],

        );

        return true;
    }

    /**
     * Checks the attachment and checks for download / show perms
     *
     * @access	public
     * @param	integer		Attachment id
     * @return	array 		Attachment data
     */
    public function getAttachmentData( $attach_id ) {
        //-----------------------------------------
        // INIT
        //-----------------------------------------

        $_ok = 0;

        //-----------------------------------------
        // Grab 'em
        //-----------------------------------------

        $this->DB->build( array( 'select'   => 'a.*',
                'from'     => array( 'attachments' => 'a' ),
                'where'    => "a.attach_rel_module='" . $this->module . "' AND a.attach_id=" . $attach_id,
                'add_join' => array( 0 => array( 'select' => 'classifieds.item_id',
                                'from'   => array( 'classifieds_items' => 'classifieds' ),
                                'where'  => "classifieds.item_id=a.attach_rel_id",
                                'type'   => 'left' )),

                )      );

        $attach_sql = $this->DB->execute();

        $attach     = $this->DB->fetch( $attach_sql );

        //-----------------------------------------
        // Check..
        //-----------------------------------------

        if ( ! isset( $attach['item_id'] ) || ! $attach['item_id']  ) {
            return FALSE;
        }


        return $attach;
    }

    /**
     * Check the attachment and make sure its OK to display
     *
     * @access	public
     * @param	array		Array of ids
     * @param	array 		Array of relationship ids
     * @return	array 		Attachment data
     */
    public function renderAttachment( $attach_ids, $rel_ids=array() ) {
        //-----------------------------------------
        // INIT
        //-----------------------------------------

        $rows  = array();
        $query = '';

        //-----------------------------------------
        // Check
        //-----------------------------------------

        if ( ! is_array( $attach_ids ) OR ! count( $attach_ids ) ) {
            $attach_ids = array( -2 );
        }

        if ( is_array( $rel_ids ) and count( $rel_ids ) ) {
            $query = " OR attach_rel_id IN (-1," . implode( ",", $rel_ids ) . ")";
        }

        //-----------------------------------------
        // Grab 'em
        //-----------------------------------------

        $this->DB->build( array( 'select'   => '*',
                'from'     => 'attachments',
                'where'    => "attach_rel_module='" . $this->module . "' AND ( attach_id IN(-1," . implode( ",", $attach_ids ) . ") " . $query . " )",
                )      );

        $attach_sql = $this->DB->execute();

        //-----------------------------------------
        // Loop through and filter off naughty ids
        //-----------------------------------------

        while( $db_row = $this->DB->fetch( $attach_sql ) ) {
            $_ok = 1;

            //-----------------------------------------
            // Ok?
            //-----------------------------------------

            if ( $_ok ) {
                $rows[ $db_row['attach_id'] ] = $db_row;
            }
        }

        //-----------------------------------------
        // Return
        //-----------------------------------------

        return $rows;
    }

    /**
     * Recounts number of attachments for the articles row
     *
     * @access	public
     * @param	string		Post key
     * @param	integer		Related ID
     * @param	array 		Arguments for query
     * @return	array 		Returns count of items found
     */
    public function postUploadProcess( $post_key, $rel_id, $args=array() ) {
        //-----------------------------------------
        // INIT
        //-----------------------------------------

        $cnt = array( 'cnt' => 0 );

        //-----------------------------------------
        // Check..
        //-----------------------------------------

        if ( ! $post_key ) {
            return 0;
        }


        $this->DB->build( array( "select" => 'COUNT(*) as cnt',
                'from'   => 'attachments',
                'where'  => "attach_rel_module='".$this->module."' AND attach_post_key='{$post_key}'") );
        $this->DB->execute();

        $cnt = $this->DB->fetch();

        if ( $cnt['cnt'] ) {
            $this->DB->buildAndFetch( array( 'update' => 'classifieds_items',
                    'set'    => "attachments = attachments + " . $cnt['cnt'],
                    'where'  => "item_id=" . intval( $rel_id ) ) );
        }
        
        // Build the thumbnail and medium image
        
        if ( ! $this->registry->isClassLoaded('classifieds') )
        {
                /* Classifieds Object */
                require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
                $this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
        }

    	$this->DB->build(array('select' => 'a.*',
            'from' => array('attachments' => 'a'),
            'where' => "a.attach_rel_module = '".$this->module."' AND a.attach_is_image = 1 AND attach_post_key='{$post_key}'",
            'order' => 'a.attach_date ASC',
                ));

        $this->DB->execute();

        while ($row = $this->DB->fetch()) {
            $attachments[] = $row;
        }
        
        if ($attachments) {
            foreach ($attachments as $attachment) {
				$this->registry->classifieds->helper('images')->buildSizedCopies($attachment);
            }
        }
        
        return array( 'count' => $cnt['cnt'] );
    }

    /**
     * Recounts number of attachments for the articles row
     *
     * @access	public
     * @param	array 		Attachment data
     * @return	boolean
     */
    public function attachmentRemovalCleanup( $attachment ) {
        //-----------------------------------------
        // Check
        //-----------------------------------------

        if ( ! $attachment['attach_id'] ) {
            return FALSE;
        }


        if ( isset( $item['item_id'] ) ) {
            $this->DB->build( array( "select" => 'count(*) as cnt',
                    'from'   => 'attachments',
                    'where'  => "attach_rel_module='".$this->module."' AND attach_rel_id = ".$attachment['attach_rel_id'] ) );
            $this->DB->execute();

            $cnt = $this->DB->fetch();

            $count = intval( $cnt['cnt'] );

            $this->DB->buildAndFetch( array( 'update' => 'classifieds_items', 'set' => "attachments = ". $count , 'where' => "item_id=".$attachment['attach_rel_id'] ) );
        }
        
        
        $image = $this->DB->buildAndFetch( array( 'select'   => 'a.*',
                'from'     => array( 'classifieds_images' => 'a' ),
                'where'    => 'a.attach_id='. intval( $attachment['attach_id'] )
                ) 		);
        
    			if ( $image['thumb_location'] )
				{
					@unlink( $this->settings['upload_dir']."/".$image['thumb_location'] );
				}
				if ( $image['med_location'] )
				{
					@unlink( $this->settings['upload_dir']."/".$image['med_location'] );
				}
				
		  $this->DB->delete("classifieds_images", "attach_id=".$attachment['attach_id']);

        return TRUE;
    }

    /**
     * Determines if you have permission for bulk attachment removal
     * Returns TRUE or FALSE
     * IT really does
     *
     * @access	public
     * @param	array 		Ids to check against
     * @return	boolean
     */
    public function canBulkRemove( $attach_rel_ids=array() ) {
        return $this->memberData['g_is_supmod'] ? true : false;
    }

    /**
     * Determines if you can remove this attachment
     * Returns TRUE or FALSE
     * IT really does
     *
     * @access	public
     * @param	array 		Attachment data
     * @return	boolean
     */
    public function canRemove( $attachment ) {
        //-----------------------------------------
        // INIT
        //-----------------------------------------

        $ok_to_remove = FALSE;

        //-----------------------------------------
        // Check
        //-----------------------------------------

        if ( ! $attachment['attach_id'] ) {
            return FALSE;
        }

        //-----------------------------------------
        // Allowed to remove?
        //-----------------------------------------

        if ( $this->memberData['member_id'] == $attachment['attach_member_id'] ) {

            $ok_to_remove = TRUE;

        }
        else if ( $this->memberData['g_is_supmod'] ) {
            $ok_to_remove = TRUE;
        }
        else if ( $this->memberData['g_classifieds_can_moderate'] ) {
            $ok_to_remove = TRUE;
        }

        return $ok_to_remove;
    }

    /**
     * Returns an array of the allowed upload sizes in bytes.
     * Return 'space_allowed' as -1 to not allow uploads.
     * Return 'space_allowed' as 0 to allow unlimited uploads
     * Return 'max_single_upload' as 0 to not set a limit
     *
     * @access	public
     * @param	string		MD5 post key
     * @param	id			Member ID
     * @return	array 		[ 'space_used', 'space_left', 'space_allowed', 'max_single_upload' ]
     */
    public function getSpaceAllowance( $post_key='', $member_id='' ) {
        $max_php_size      = intval( IPSLib::getMaxPostSize() );
        $member_id         = intval( $member_id ? $member_id : $this->memberData['member_id'] );
        $space_left        = 0;
        $space_used        = 0;
        $space_allowed     = 0;
        $max_single_upload = 0;
        $space_calculated  = 0;

        if ( $post_key ) {
            //-----------------------------------------
            // Check to make sure we're not attempting
            // to upload to another's item...
            //-----------------------------------------

            if ( ! $this->memberData['g_is_supmod'] ) {
                $item = $this->DB->buildAndFetch( array( 'select' => '*',
                        'from'   => 'classifieds_items',
                        'where'  => "post_key='".$post_key."'" ) );

                if ( $item['post_key'] AND ( $item['member_id'] != $member_id ) ) {
                    $space_allowed    = -1;
                    $space_calculated = 1;
                }
            }
        }

        //-----------------------------------------
        // Generate total space allowed
        //-----------------------------------------

        $total_space_allowed = ( $this->memberData['g_classifieds_attach_per_item'] ? $this->memberData['g_classifieds_attach_per_item'] : $this->memberData['g_classifieds_attach_max'] ) * 1024;

        //-----------------------------------------
        // Allowed to attach?
        //-----------------------------------------

        if ( ! $member_id ) {
            $space_allowed = -1;
        }

        if ( ! $space_calculated ) {

            //-----------------------------------------
            // Generate space allowed figure
            //-----------------------------------------

            if ( $this->memberData['g_classifieds_attach_per_item'] > 0 ) {
                //-----------------------------------------
                // Per post limit...
                //-----------------------------------------

                $_space_used = $this->DB->buildAndFetch(
                        array(
                        'select' => 'SUM(attach_filesize) as figure',
                        'from'   => 'attachments',
                        'where'  => "attach_post_key='".$post_key."'"
                        )
                );

                $space_used    = intval( $_space_used['figure'] );
            }
            else {
                //-----------------------------------------
                // Global limit...
                //-----------------------------------------

                $_space_used = $this->DB->buildAndFetch(
                        array(
                        'select' => 'SUM(attach_filesize) as figure',
                        'from'   => 'attachments',
                        'where'  => "attach_member_id={$member_id} AND attach_rel_module IN( 'classifieds' )"
                        )
                );

                $space_used    = intval( $_space_used['figure'] );
            }

            if ( $this->memberData['g_classifieds_attach_max'] > 0 ) {
                if ( $this->memberData['g_classifieds_attach_per_item'] ) {
                    $space_allowed = intval( ( $this->memberData['g_classifieds_attach_per_item'] * 1024 ) - $space_used );
                    $space_allowed = $space_allowed < 0 ? 0 : $space_allowed;
                }
                else {
                    $space_allowed = intval( ( $this->memberData['g_classifieds_attach_max'] * 1024 ) - $space_used );
                    $space_allowed = $space_allowed < 0 ? 0 : $space_allowed;
                }
            }
            else {
                if ( $this->memberData['g_classifieds_attach_per_item'] > 0 ) {
                    $space_allowed = intval( ( $this->memberData['g_classifieds_attach_per_item'] * 1024 ) - $space_used );
                    $space_allowed = $space_allowed < 0 ? 0 : $space_allowed;
                }
                else {
                    # Unlimited
                    $space_allowed = 0;
                }
            }
            
            //-----------------------------------------
            // Generate space left figure
            //-----------------------------------------

            $space_left = $space_allowed ? $space_allowed : 0;
            $space_left = ($space_left < 0) ? 0 : $space_left;

            //-----------------------------------------
            // Generate max upload size
            //-----------------------------------------

            if ( ! $max_single_upload ) {
                if ( $space_left > 0 AND $space_left < $max_php_size ) {
                    $max_single_upload = $space_left;
                }
                else if ( $max_php_size ) {
                    $max_single_upload = $max_php_size;
                }
            }
        }

        $return = array( 'space_used' => $space_used, 'space_left' => $space_left, 'space_allowed' => $space_allowed, 'max_single_upload' => $max_single_upload, 'total_space_allowed' => $total_space_allowed );

        return $return;
    }

}
