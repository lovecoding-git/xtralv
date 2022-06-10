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

class task_item
{

    /**
    * Constructor
    *
    * @access    public
    * @param     object        ipsRegistry reference
    * @param     object        Parent task class
    * @param     array         This task data
    * @return    void
    */
    public function __construct( ipsRegistry $registry, $class, $task )
    {
	$this->registry		= $registry;
        $this->settings         =& $this->registry->fetchSettings();
        $this->class            = $class;
        $this->task             = $task;
        $this->DB               = $this->registry->DB();

    }

   /**
    * Run this task
    *
    * @access    public
    * @return    void
    */
    public function runTask()
	{

        $this->DB->update( 'classifieds_items', array( 'expired' => '1'), 'date_expiry < ' . ( time() - ($this->settings['classifieds_display_after_expiry'] * 86400) ) );
        
		//-----------------------------------------
		// Log to log table - modify but dont delete
		//-----------------------------------------
		$this->class->appendTaskLog( $this->task, 'Classifieds expiration task ran' );

		//-----------------------------------------
		// Unlock Task: DO NOT MODIFY!
		//-----------------------------------------

		$this->class->unlockTask( $this->task );
	}
}