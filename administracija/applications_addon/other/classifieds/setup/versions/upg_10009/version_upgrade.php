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

		
		/* Set time out */
		@set_time_limit( 3600 );
		
		/* Gallery Object */
		require_once( IPSLib::getAppDir('classifieds') . '/sources/classes/classifieds.php' );/*noLibHook*/
		$this->classifieds = new classifieds( $registry );
		
		$this->images  = $this->classifieds->helper('images');

		//--------------------------------
		// What are we doing?
		//--------------------------------

		switch( $this->request['workact'] )
		{
			case 'rebuildImages':
				$this->rebuildImages();
				break;
			case 'finish':
				$this->finish();
				break;
			
			default:
				$this->rebuildImages();
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
	 * Rebuild images
	 * 
	 * @return	@e void
	 */
	public function rebuildImages()
	{
		$options    = IPSSetUp::getSavedData('custom_options');
		$id         = intval( $this->request['imageId'] );
		$lastId     = 0;
		$done  		= intval( $this->request['done'] );
		$cycleDone  = 0;
		

			$total = $this->DB->buildAndFetch( array( 'select' => 'count(*) as count',
											          'from'   => 'attachments',
													  'where'	=> "attach_rel_module = 'classifieds'",

			) );
			
			/* Fetch batch */
			$this->DB->build( array( 'select' => '*',
									 'from'   => 'attachments',
									 'where'  => "attach_rel_module = 'classifieds' AND attach_id > " . $id,
									 'limit'  => array( 0, 50 ),
									 'order'  => 'attach_id ASC' )  );
									
			$o = $this->DB->execute();
			
			while( $row = $this->DB->fetch( $o ) )
			{
				$cycleDone++;
				$lastId = $row['attach_id'];
				
				$this->images->buildSizedCopies( $row );
			}
			
			/* More? */
			if ( $cycleDone )
			{
				/* Reset */
				$done += $cycleDone;
				
				$this->registry->output->addMessage("Images rebuilt: {$done}/{$total['count']}....");
				
				$this->request['imageId'] = $lastId;
				$this->request['done']    = $done;
				
				/* Reset data and go again */
				$this->request['workact'] = 'rebuildImages';
			}
			else
			{
				$this->registry->output->addMessage("All images rebuilt....");
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