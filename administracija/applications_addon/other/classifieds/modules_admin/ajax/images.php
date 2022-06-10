<?php


if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class admin_classifieds_ajax_images extends ipsAjaxCommand 
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
			case 'rebuildImages':
				$this->_rebuildImages();
				break;
    	}
	}

	
	
	/**
	 * Rebuilds Image Sizes
	 *
	 * @return	@e void
	 */
	public function _rebuildImages()
	{
		$advertId = ( $this->request['advertId'] == 'all' ) ? '' : intval( $this->request['advertId'] );
		$json    = array();
		$pergo   = 10;
		$where   = ( $advertId ) ? 'attach_rel_module = "classifieds" AND attach_rel_id=' . $advertId : 'attach_rel_module = "classifieds"';
		
		if ( $this->request['pb_act'] == 'getOptions' )
		{
			$count = $this->DB->buildAndFetch( array( 'select' => 'count(*) attach_count',
													  'from'   => 'attachments',
													  'where'  => $where ) );
			
			$json['total'] = intval( $count['attach_count'] );
			$json['pergo'] = $pergo;
		}
		else
		{
			$lastId  = intval( $this->request['pb_lastId'] );
			$pb_done = intval( $this->request['pb_done'] );
			$seen    = 0;
			$_where  = ( $advertId ) ?  $where : 'attach_rel_module = "classifieds" AND attach_rel_id > ' . $lastId;
			$limit   = ( $advertId ) ? array( $pb_done, $pergo ) : array( 0, $pergo );
			
			$this->DB->build( array( 'select' => '*',
									 'from'   => 'attachments',
									 'where'  => $_where,
									 'limit'  => $limit ) );
			
			$o = $this->DB->execute();
			
			while( $attach = $this->DB->fetch($o) )
			{
				$seen++;
				$lastId = $attach['attach_id'];
				
				/* Now rebuild the image */
				$this->registry->classifieds->helper('images')->buildSizedCopies($attach);
			}
			
			/* Done? */
			if ( $seen )
			{
				$json = array( 'status' => 'processing',
							   'lastId' => $lastId );
			}
			else
			{
				$json = array( 'status' => 'done',
							   'lastId' => $lastId );
			}
			
		}
		
		$this->returnJsonArray( $json );
	}	

}