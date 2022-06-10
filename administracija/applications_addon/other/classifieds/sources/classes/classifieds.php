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

class classifieds
{

	/**
	 * Classes array
	 * @access	protected
	 * @param	array
	 */
	protected $_classes = array();
	
	
	/**#@+
	 * Registry Object Shortcuts
	 *
	 * @access	protected
	 * @var		object
	 */
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	protected $member;
	protected $cache;
	/**#@-*/	
	
	/**
	 * Setup registry classes
	 *
	 * @access	public
	 * @param	ipsRegistry	$registry
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry )
	{
		/* Make registry objects */
		$this->registry   =  $registry;
		$this->DB         =  $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->lang       =  $this->registry->getClass('class_localization');
		$this->member     =  $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		
	}


	/**
	 * Auto load classes
	 *
	 * @access	public
	 * @param	string		Class Name
	 * @param	mixed		Any arguments
	 */
	public function helper( $name )
	{
            
		if ( isset( $this->_classes[ $name ] ) && is_object( $this->_classes[ $name ] ) )
		{
			return $this->_classes[ $name ];
                        
		}
		else
		{
			$_fn = IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds/' . $name . '.php';
			$_cn = 'classifieds_' . $name;
			
			if ( is_file( $_fn ) )
			{
				require_once( $_fn );
				$this->_classes[ $name ] = new $_cn( $this->registry );
				
				return $this->_classes[ $name ];
			}
			else
			{
				trigger_error( 'Cannot locate a class in /sources/classes/classifieds/' . $name . '.php' );
			}
		}
	}
	
	/**
	 * Check global access
	 *
	 * @return	@e mixed	Boolean true, or outputs an error
	 */
	public function checkGlobalAccess()
	{
		
			if(!$this->memberData['g_classifieds_can_access']) {
	            $this->registry->output->showError( $this->lang->words['cfds_cant_access'], '10CFD001', null, null, 403 );
	        }			     
		
		return true;
	}  	
   
    function timeUntil($timestamp)  {
    	 
        $difference = $timestamp - IPSTime::getTimestamp();
        $format="%d {$this->lang->words['cfds_days']}, %h {$this->lang->words['cfds_hours']}, %m {$this->lang->words['cfds_minutes']}";
        
        if($difference < 0) {
            return $this->lang->words['cfds_expired'];
        }
        else {
       
            $min_only = intval(floor($difference / 60));
            $hour_only = intval(floor($difference / 3600));
           
            $days = intval(floor($difference / 86400));
            $difference = $difference % 86400;
            $hours = intval(floor($difference / 3600));
            $difference = $difference % 3600;
            $minutes = intval(floor($difference / 60));
            if($minutes == 60){
                $hours = $hours+1;
                $minutes = 0;
            }
           
            if($days == 0){
                $format = str_replace($this->lang->words['cfds_days'], '?', $format);
                $format = str_replace('%d', '', $format);
            }
            if($hours == 0){
                $format = str_replace($this->lang->words['cfds_hours'], '?', $format);
                $format = str_replace('%h', '', $format);
            }
            if($minutes == 0 || $hour_only > 24 ){
                $format = str_replace($this->lang->words['cfds_minutes'], '?', $format);
                $format = str_replace('%m', '', $format);
            }
            
             
            $format = str_replace('?,', '', $format);
            $format = str_replace(",  ?", '', $format);
            $format = str_replace('?', '', $format);

            $timeLeft = str_replace('%d', number_format($days), $format);       
            $timeLeft = str_replace('%h', number_format($hours), $timeLeft);
            $timeLeft = str_replace('%m', number_format($minutes), $timeLeft);
               
            if($days == 1){
                $timeLeft = str_replace($this->lang->words['cfds_days'], $this->lang->words['cfds_days'], $timeLeft);
            }
            if($hours == 1 || $hour_only == 1){
                $timeLeft = str_replace($this->lang->words['cfds_hours'], $this->lang->words['cfds_hour'], $timeLeft);
            }
            if($minutes == 1 || $min_only == 1){
                $timeLeft = str_replace($this->lang->words['cfds_minutes'], $this->lang->words['cfds_minute'], $timeLeft);   
            }
               
          return $timeLeft;
        }
    } 

    /**
     * Convert user input (locale aware) to float if formatted awkwardly
     *
     * @param string $price
     * @return float
     *
     */
    public function price_to_float($price) {
        
        $number = preg_replace("/[^0-9".preg_quote($this->lang->local_data['mon_thousands_sep'] . $this->lang->local_data['mon_decimal_point'])."]++/", "", $price);
        $number = strtr($number, array($this->lang->local_data['mon_thousands_sep'] => '', $this->lang->local_data['mon_decimal_point'] => '.'));
                
        return ($number) ? $number : $price;
	}

    public function sendNotifications($item_id, $name, $seo_title, $category, $category_title ) {

        $_url	= $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item_id, 'public', $seo_title, 'view_item' );

        $classToLoad		= IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
        $notifyLibrary		= new $classToLoad( $this->registry );

        // Find members watching this category
        $notify_member = array();
        $check = $this->DB->build( array( 'select' => 'sub_mid', 'from' => 'classifieds_subscriptions', 'where' => "sub_type='cat' AND sub_toid = " . $category ) );

        $this->DB->execute();

        // Loop through subscribed members and send notifications

        while( $member = $this->DB->fetch() ) {

            $notify_member[] = $member['sub_mid'];

        }

        foreach($notify_member as $r) {

            $member = IPSMember::load( $r, '', 'id' );

            IPSText::getTextClass('email')->getTemplate( 'cfds_noti_new_item', $member['language'] );

            IPSText::getTextClass('email')->buildMessage( array(
                    'NAME'  		=> $member['members_display_name'],
                    'ADVERTISER'	=> $this->memberData['members_display_name'],
                    'TITLE' 		=> $name,
                    'CATEGORY'          => $category_title,
                    'URL'		=> $_url,
                    )
            );

            $this->lang->words['cfds_noti_sub_new_item']	= sprintf(
                    $this->lang->words['cfds_noti_sub_new_item'],
                    $this->memberData['members_display_name'],
                    $_url,
                    $category_title
            );

            //-----------------------------------------
            // Send notification...
            //-----------------------------------------

            $notifyLibrary->setMember( intval($r) );
            $notifyLibrary->setFrom( intval($r) );
            $notifyLibrary->setNotificationKey( 'new_classified' );
            $notifyLibrary->setNotificationUrl( $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item_id, 'publicNoSession', $seo_title , 'view_item' ) );
            $notifyLibrary->setNotificationText( IPSText::getTextClass('email')->message );
            $notifyLibrary->setNotificationTitle( $this->lang->words['cfds_noti_sub_new_item'] );

            try {
                $notifyLibrary->sendNotification();
            }
            catch( Exception $e ) {

            }
        }


    }
    	
}