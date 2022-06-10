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

                if ( ! $this->registry->isClassLoaded('classifieds') )
		{
			/* Classifieds Object */
			require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
			$this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
		}

    }

   /**
    * Run this task
    *
    * @access    public
    * @return    void
    */
    public function runTask()
	{

        $items = $this->registry->classifieds->helper('items')->getItemsForPrune();

        if (count($items) > 0) {
            $this->registry->classifieds->helper('items')->deleteItems($items);
        }
        
		//-----------------------------------------
		// Log to log table - modify but dont delete
		//-----------------------------------------
		$this->class->appendTaskLog( $this->task, 'Classifieds prune task ran' );

		//-----------------------------------------
		// Unlock Task: DO NOT MODIFY!
		//-----------------------------------------

		$this->class->unlockTask( $this->task );
	}
}