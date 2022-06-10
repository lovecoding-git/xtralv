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

class version_upgrade
{
	/**
	 * Custom HTML to show
	 *
	 * @var		string
	 */
	private $_output = '';
	
	/**
	 * fetchs output
	 * 
	 * @return	@e string
	 */
	public function fetchOutput()
	{
		return $this->_output;
	}
	
	/**
	 * Execute selected method
	 *
	 * @param	object		Registry object
	 * @return	@e void
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
		/* Make object */
		$this->registry =  $registry;
		$this->DB       =  $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		
		//--------------------------------
		// What are we doing?
		//--------------------------------

		switch( $this->request['workact'] )
		{
			case 'conditionsToField':
				$this->rebuildConditions();
				break;
			case 'rebuildConditions':
				$this->rebuildConditions();
				break;
			case 'finish':
				$this->finish();
				break;
			
			default:
				$this->conditionsToField();
				break;
		}
		
		/* Workact is set in the function, so if it has not been set, then we're done. The last function should unset it. */
		if ( $this->request['workact'] )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/**
	 * Convert individual conditions to single custom field
	 * 
	 * @return	@e void
	 */
	public function conditionsToField()
	{
		
		$conditions = array();
		
		/* Fetch conditions */
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'classifieds_conditions',
								 'order'  => 'sort_order ASC' )  );
								
		$o = $this->DB->execute();
		
		while( $row = $this->DB->fetch( $o ) )
		{
			$conditions[] = $row['name'];				
		}
		
		// Add new field
		$db_arr = array(
						'title' => "Condition",
						'required' => 1,
						'type' => "dropdown",
						'active' => 1,
						'options' => implode("|", $conditions),
		);
		
		$this->DB->insert( 'classifieds_fields', $db_arr );
		
		$fieldID = $this->DB->getInsertId();
		
		IPSSetUp::setSavedData('field_id', $fieldID);
		

		$this->registry->output->addMessage("Conditions converted to custom field....");
		 
		/* Next Page */
		$this->request['workact'] = 'rebuildConditions';
	}
	
	/**
	 * Rebuild conditions
	 * 
	 * @return	@e void
	 */
	public function rebuildConditions()
	{
		$field_id    = IPSSetUp::getSavedData('field_id');
		$id          = intval( $this->request['item_id'] );
		$lastId      = 0;
		$done  		 = intval( $this->request['done'] );
		$cycleDone   = 0;
		

			$total = $this->DB->buildAndFetch( array( 'select' => 'count(*) as count',
											          'from'   => 'classifieds_items',

			) );
			
			/* Fetch batch */
			$this->DB->build( array( 'select' => 'i.item_id, c.name as condition_value',
									 'from' => array('classifieds_items' => 'i'),
						                    'add_join' => array(0 => array(
						                            'from' => array('classifieds_conditions' => 'c'),
						                            'where' => 'i.item_condition=c.condition_id',
						                            'type' => 'left')),
									 'where'  => "i.item_id > " . $id,
									 'limit'  => array( 0, 500 ),
									 'order'  => 'i.item_id ASC' )  );
									
			$o = $this->DB->execute();
			
			while( $row = $this->DB->fetch( $o ) )
			{
				$cycleDone++;
				$lastId = $row['item_id'];
		
				// Add new field entry
				$db_arr = array(
								'field_id' => $field_id,
								'value' => $row['condition_value'],
								'item_id' => $row['item_id'],
				);
				
				$this->DB->insert( 'classifieds_field_entries', $db_arr );
								
			}
			
			/* More? */
			if ( $cycleDone )
			{
				/* Reset */
				$done += $cycleDone;
				
				$this->registry->output->addMessage("Conditions rebuilt: {$done}/{$total['count']}....");
				
				$this->request['imageId'] = $lastId;
				$this->request['done']    = $done;
				
				/* Reset data and go again */
				$this->request['workact'] = 'rebuildConditions';
			}
			else
			{
				$this->registry->output->addMessage("All conditions rebuilt....");
				$this->request['workact'] = 'finish';
				return;
			}

		 
		/* Next Page */
		$this->request['workact'] = 'finish';
	}
	
	/**
	 * Finish up conversion stuff
	 * 
	 * @return	@e void
	 */
	public function finish()
	{
		$this->registry->output->addMessage( "Upgrade completed");
		
		/* Last function, so unset workact */
		$this->request['workact'] = '';
	}
}