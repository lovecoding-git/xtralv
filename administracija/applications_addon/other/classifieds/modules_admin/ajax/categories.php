<?php


if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class admin_classifieds_ajax_categories extends ipsAjaxCommand 
{
	/**
	 * Main function executed automatically by the controller
	 *
	 * @param	object		$registry		Registry object
	 * @return	@e void
	 */
	public function doExecute( ipsRegistry $registry )
	{
		/* Load skin */
		$this->html = ipsRegistry::getClass('output')->loadTemplate('cp_skin_classifieds');
		
	
    	switch( $this->request['do'] )
    	{
			case 'rebuildNodes':
				$this->_rebuildNodes();
				break;
    	}
	}

	
	/**
	 * Rebuilds category nodes
	 *
	 * @return	@e void
	 */
	public function _rebuildNodes()
	{
		$categoryId = ( $this->request['categoryId'] == 'all' ) ? 0 : intval( $this->request['categoryId'] );
		$json    = array();
		
		if ( $this->request['pb_act'] == 'getOptions' )
		{
			$json['total'] = 1;
			$json['pergo'] = 1;
		}
		else
		{		
			/* Simple */
			$this->registry->classifieds->helper('categories')->rebuildTree();
		
			$json = array( 'status' => 'done',
						   'lastId' => $categoryId );
			
		}
		
		$this->returnJsonArray( $json );
	}

}