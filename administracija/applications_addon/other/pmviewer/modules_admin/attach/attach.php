<?php
/**
 * (SN) PM Viewer
 * Attachment Viewer
 * Last Updated: June 25th 2010
 *
 * @author 		signet51
 * @copyright	(c) 2011 signet51 Modding
 * @version		1.6.0 (1600)
 *
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class admin_pmviewer_attach_attach extends ipsCommand
{
	/**
	 * Attachment Library
	 *
	 * @access	public
	 * @var		object	class_attach
	 */
	public $class_attach;
	
	/**
	 * Skin object
	 *
	 * @access	private
	 * @var		object			Skin templates
	 */
	private $html;
	
	/**
	 * Shortcut for url
	 *
	 * @access	private
	 * @var		string			URL shortcut
	 */
	private $form_code;
	
	/**
	 * Shortcut for url (javascript)
	 *
	 * @access	private
	 * @var		string			JS URL shortcut
	 */
	private $form_code_js;
	
	/**
	 * Class entry point
	 *
	 * @access	public
	 * @param	object		Registry reference
	 * @return	void		[Outputs to screen/redirects]
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
		/* Attachment Class */
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'pmviewer' ) . '/sources/attach/class_attach.php', 'class_attach_pm' );
		$this->class_attach_pm = new $classToLoad( $registry );
				
		/* What to do... */
		switch( $this->request['do'] )
		{	
			default:
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'pmviewer_download_attach' );
				$this->showPostAttachment();
			break;
		}
	}
	
	/**
	 * View Post Attachment
	 *
	 * @access	public
	 * @return	void
	 */
	public function showPostAttachment()
	{
		/* INIT */
		$attach_id = intval( $this->request['attach_id'] );
		
		/* INIT module */
		$this->class_attach_pm->init();
		
		/* Display */
		$this->class_attach_pm->showAttachment( $attach_id );
	}
}