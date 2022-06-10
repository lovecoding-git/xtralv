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
 
class public_classifieds_ajax_listing extends ipsAjaxCommand
{
	
	/**
	 * Main class entry point
	 *
	 * @access	public
	 * @param	object		ipsRegistry reference
	 * @return	@e void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
		
	// Which section are we looking for?
		switch(ipsRegistry::$request['do']) {
			
			case 'ratecard' :
				$this->rateCard();
				break;
							
			case 'updateprice' :
				$this->updatePrice( );
				break;
						
			default :
				$this->updatePrice();
				break;
		}

	}
	
	/**
	 * Update the listing price
	 */	
	protected function updatePrice()
	{
					
		/* Get Package */
		$package = $this->registry->classifieds->helper( 'packages' )->getPackageByID( intval($this->request['packageid']) );
			
		if ( !$package['package_id'] )
		{
			$this->returnJsonError( 'NO_PACKAGE' );
		}

				switch($package['pricing_format']) {
				
				case 'flat' :
					$price = $package['price'];
					break;
			
				case 'value' :
					$price = $this->registry->classifieds->helper( 'packages' )->calculatePrice(floatval($this->request['value']), $package['rates'], 'base');
					break;
			
				default :
					$price = $package['price'];
					break;
				
			}
		
		/* Return */
    	$this->returnHtml( $this->registry->output->getTemplate('classifieds')->listingPrice($price) );
			
	}	
	
	/**
	 * Update the listing price
	 */	
	protected function rateCard()
	{
					
		/* Get Package */
		$package = $this->registry->classifieds->helper( 'packages' )->getPackageByID( intval($this->request['packageid']) );
			
		if ( !$package['package_id'] )
		{
			$this->returnJsonError( 'NO_PACKAGE' );
		}
		
		/* Return */
    	$this->returnHtml( $this->registry->output->getTemplate('classifieds')->rateCard($package) );
			
	}		
	
}