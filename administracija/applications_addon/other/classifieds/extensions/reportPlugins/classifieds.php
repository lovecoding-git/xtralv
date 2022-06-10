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
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
    exit();
}

class classifieds_plugin {
    /**#@+
	 * Registry objects
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
     * Holds extra data for the plugin
     *
     * @access	private
     * @var		array			Data specific to the plugin
     */
    public $_extra;

    /**
     * Constructor
     *
     * @access	public
     * @param	object		Registry object
     * @return	void
     */
    public function __construct( ipsRegistry $registry ) {
        //-----------------------------------------
        // Make object
        //-----------------------------------------

        $this->registry = $registry;
        $this->DB	    = $this->registry->DB();
        $this->settings =& $this->registry->fetchSettings();
        $this->request  =& $this->registry->fetchRequest();
        $this->member   = $this->registry->member();
        $this->memberData =& $this->registry->member()->fetchMemberData();
        $this->cache	= $this->registry->cache();
        $this->caches   =& $this->registry->cache()->fetchCaches();
        $this->lang		= $this->registry->class_localization;

        $this->registry->class_localization->loadLanguageFile( array( 'public_lang' ), 'classifieds' );

        if ( ! $this->registry->isClassLoaded('classifieds') )
        {
                /* Classifieds Object */
                require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
                $this->registry->setClass( 'classifieds', new classifieds( $this->registry ) );
        }


        $this->items = $this->registry->classifieds->helper('items');

    }

    	public function displayAdminForm( $plugin_data, &$html )
	{
		$return = '';

		return $return;
	}

        	public function processAdminForm( &$save_data_array )
	{
		
		return '';
	}

    /**
     * Update timestamp for report
     *
     * @access	public
     * @param	array 		New reports
     * @param 	array 		New members cache
     * @return	boolean
     */
    public function updateReportsTimestamp( $new_reports, &$new_members_cache ) {
        return true;
    }

    /**
     * Get report permissions
     *
     * @access	public
     * @param	string 		Type of perms to check
     * @param 	array 		Permissions data
     * @param 	array 		group ids
     * @param 	string		Special permissions
     * @return	boolean
     */
    public function getReportPermissions( $check, $com_dat, $group_ids, &$to_return ) {
        if( $this->memberData['g_is_supmod'] ) {
            return true;
        }
        else {

            return false;

        }
    }

    /**
     * Show the report form for this module
     *
     * @access	public
     * @param 	array 		Application data
     * @return	string		HTML form information
     */
    public function reportForm( $com_dat ) {

        $item = $this->items->getItemById($this->request['item_id']);

        $this->registry->output->setTitle( $this->lang->words['cfds_report_title'] );
        $this->registry->output->addNavigation( $this->lang->words['cfds_report_item'], '' );

        $this->lang->words['report_basic_title']		= $this->lang->words['cfds_report_title'];

        $ex_form_data = array(
                'item_id'		=> $item['item_id'],
                'ctyp'			=> 'item',

        );


        return $this->registry->getClass('reportLibrary')->showReportForm($item['name'], $this->registry->output->buildSEOUrl( 'app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=' . $item['item_id'], 'publicNoSession', $seo_title , 'view_item' ), $ex_form_data);
    }

    /**
     * Get section and link
     *
     * @access	public
     * @param 	array 		Report data
     * @return	array 		Section/link
     */
    public function giveSectionLinkTitle( $report_row ) {
        return array(
                'title'	=> $this->lang->words['cfds_classifieds'],
                'url'	=> "/index.php?app=classifieds",
                'seo_title' => $this->lang->words['cfds_classifieds'],
                'seo_template' => "app=classifieds",
        );
    }

    /**
     * Process a report and save the data appropriate
     *
     * @access	public
     * @param 	array 		Report data
     * @return	array 		Data from saving the report
     */
    public function processReport( $com_dat ) {
        $con_type = $this->request['ctyp'];

        if( $con_type == 'item' ) {

            $item = $this->items->getItemById($this->request['item_id']);
            $url		= 'app=classifieds&module=core&do=view_item&item_id=' . $item['item_id'];
        }


        $return_data	= array();
        $a_url			= str_replace("&", "&amp;", $url);
        $uid			= md5(  'classifieds_' . $con_type . '_' . $item['item_id'] . '_' . $comment . '_' . $com_dat['com_id'] );
        $status			= array();

        $this->DB->build( array( 'select' 	=> 'status, is_new, is_complete',
                'from'		=> 'rc_status',
                'where'	=> "is_new=1 OR is_complete=1",
                ) 		);
        $this->DB->execute();

        while( $row = $this->DB->fetch() ) {
            if( $row['is_new'] == 1 ) {
                $status['new'] = $row['status'];
            }
            elseif( $row['is_complete'] == 1 ) {
                $status['complete'] = $row['status'];
            }
        }

        $this->DB->build( array( 'select' => 'id', 'from' => 'rc_reports_index', 'where' => "uid='{$uid}'" ) );
        $this->DB->execute();

        if( $this->DB->getTotalRows() == 0 ) {
            $built_report_main = array(
                    'uid'			=> $uid,
                    'title'			=> $item['name'],
                    'status'		=> $status['new'],
                    'url'			=> '/index.php?' . $a_url,
                    'rc_class'		=> $com_dat['com_id'],
                    'updated_by'	=> $this->memberData['member_id'],
                    'date_updated'	=> time(),
                    'date_created'	=> time(),
                    'img_preview'	=> $this->request['thumb'],


            );

            $this->DB->insert( 'rc_reports_index', $built_report_main );
            $rid = $this->DB->getInsertId();
        }
        else {
            $the_report	= $this->DB->fetch();
            $rid		= $the_report['id'];
            $this->DB->update( 'rc_reports_index', array( 'date_updated' => time(), 'status' => $status['new'] ), "id='{$rid}'" );
        }

        IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
        IPSText::getTextClass('bbcode')->parse_html			= 0;
        IPSText::getTextClass('bbcode')->parse_emoticons	= 1;
        IPSText::getTextClass('bbcode')->parse_nl2br		= 1;
        IPSText::getTextClass('bbcode')->parsing_section	= 'reports';

        $build_report = array(
                'rid'			=> $rid,
                'report'		=> IPSText::getTextClass('bbcode')->preDbParse( $this->request['message'] ),
                'report_by'		=> $this->memberData['member_id'],
                'date_reported'	=> time(),
        );

        $this->DB->insert( 'rc_reports', $build_report );

        $reports = $this->DB->buildAndFetch( array( 'select' => 'COUNT(*) as total', 'from' => 'rc_reports', 'where' => "rid='{$rid}'" ) );

        $this->DB->update( 'rc_reports_index', array( 'num_reports' => $reports['total'] ), "id='{$rid}'" );

        $return_data = array(
                'REDIRECT_URL'	=> $a_url,
                'REPORT_INDEX'	=> $rid,
                'SAVED_URL'		=> '/index.php?' . $url,
                'REPORT'		=> $build_report['report']
        );

        return $return_data;
    }

    /**
     * Where to send user after report is submitted
     *
     * @access	public
     * @param 	array 		Report data
     * @return	void
     */
    public function reportRedirect( $report_data ) {
        $this->registry->output->redirectScreen( $this->lang->words['report_sending'], $this->settings['base_url'] . $report_data['REDIRECT_URL'] );
    }

    /**
     * Retrieve list of users to send notifications to
     *
     * @access	public
     * @param 	string 		Group ids
     * @param 	array 		Report data
     * @return	array 		Array of users to PM/Email
     */
    public function getNotificationList( $group_ids, $report_data ) {
        $notify = array();

        if($group_ids) {
	        $this->DB->build( array(
	                'select'	=> 'noti.*',
	                'from'		=> array( 'rc_modpref' => 'noti' ),
	                'where'		=> 'mem.member_group_id IN(' . $group_ids . ')',
	                'add_join'	=> array(
	                        array(
	                                'select'	=> 'mem.member_id, mem.members_display_name as name, mem.language, mem.members_disable_pm, mem.email, mem.member_group_id',
	                                'from'		=> array( 'members' => 'mem' ),
	                                'where'		=> 'mem.member_id=noti.mem_id',
	                        )
	                )
	                )		);
	        $this->DB->execute();
	
	        if( $this->DB->getTotalRows() > 0 ) {
	            while( $row = $this->DB->fetch() ) {
	                $notify[] = $row;
	            }
	        }
	
	        return $notify;
        } else {
        	return null;
        }
    }
}