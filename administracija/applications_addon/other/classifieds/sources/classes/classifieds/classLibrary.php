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

if( ! defined( 'IN_IPB' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit;
}

class classifieds_library {

    public function __construct( $registry ) {
        $this->registry   = $registry;
        $this->DB         = $this->registry->DB();
        $this->settings   = $this->registry->settings();
        $this->request    = $this->registry->request();
        $this->lang       = $this->registry->getClass('class_localization');


    }



}

?>
