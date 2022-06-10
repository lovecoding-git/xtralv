<?php

/*
 * This is a PHP library that handles calling reCAPTCHA.
 *    - Documentation and latest version
 *          http://recaptcha.net/plugins/php/
 *    - Get a reCAPTCHA API Key
 *          https://www.google.com/recaptcha/admin/create
 *    - Discussion group
 *          http://groups.google.com/group/recaptcha
 *
 * Copyright (c) 2007 reCAPTCHA -- http://recaptcha.net
 * AUTHORS:
 *   Mike Crawford
 *   Ben Maurer
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */


/**
 * The reCAPTCHA server URL's
 */
define("RECAPTCHA_API_SERVER", "http://www.google.com/recaptcha/api");
define("RECAPTCHA_API_SECURE_SERVER", "https://www.google.com/recaptcha/api");
define("RECAPTCHA_VERIFY_SERVER", "https://www.google.com/recaptcha/api/siteverify"); // http://www.google.com


/**
 * @file		recaptcha.php 	Plugin for reCAPTCHA
 *~TERABYTE_DOC_READY~
 * $Copyright: (c) 2001 - 2011 Invision Power Services, Inc.$
 * $License: http://www.invisionpower.com/company/standards.php#license$
 * $Author: rashbrook $
 * @since		Friday 19th May 2006 17:33
 * $LastChangedDate: 2013-10-16 19:11:24 -0400 (Wed, 16 Oct 2013) $
 * @version		v3.4.8
 * $Revision: 12381 $
 */

/**
 *
 * @class		captchaPlugin
 * @brief		Plugin for reCAPTCHA
 * @note		This plugin is automatically loaded by classCaptcha class based on the CAPTCHA setting
 *
 */
class captchaPlugin
{
	/**#@+
	 * Registry Object Shortcuts
	 *
	 * @var		object
	 */
	public $registry;
	public $DB;
	public $settings;
	public $member;
	/**#@-*/
	
	/**
	 * String that stores the error code from reCAPTCHA (if any)
	 *
	 * @var		string
	 */
	public $error;
	
	/**
	 * String that stores reCAPTCHA public key
	 *
	 * @var		string
	 */
	public $public_key;
	
	/**
	 * String that stores reCAPTCHA private key
	 *
	 * @var		string
	 */
	public $private_key;
	
	/**
	 * Integer flag that stores whether to use SSL or not for the connection
	 *
	 * @var		bool
	 */
	public $useSSL;
	
	/**
	 * Constructor
	 *
	 * @param	object		$registry		Registry Object
	 * @return	@e void
	 */
	public function __construct( ipsRegistry $registry )
	{
		$this->registry = $registry;
		$this->DB       = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->member   = $this->registry->member();
		
		/* Settings */
		$this->public_key	= trim( $this->settings['recaptcha_public_key'] );
		$this->private_key	= trim( $this->settings['recaptcha_private_key'] );
		$this->useSSL		= ( $this->settings['logins_over_https'] or $this->registry->output->isHTTPS );
	}
	
	/**
	 * Returns the reCAPTCHA template (javascript and non-javascript version).
	 * This is called from the browser, and the resulting reCAPTCHA HTML widget
	 * is embedded within the HTML form it was called from.
	 *
	 * @return	@e string
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * $recaptchaForm = $this->getTemplate();
	 * @endcode
	 */
	public function getTemplate()
	{
		if ( ! $this->public_key )
		{
			return '';
		}
	
		if ($this->useSSL) 
		{
			$server = RECAPTCHA_API_SECURE_SERVER;
		} 
		else 
		{
			$server = RECAPTCHA_API_SERVER;
		}
		
		$html	= '';
/*		$html	.= "<script type='text/javascript'>
						var RecaptchaOptions = { 
												lang : '{$this->settings['recaptcha_language']}',
												theme : '{$this->settings['recaptcha_theme']}',
												tabindex: 49
												};
					</script>";

		$html	.= '<script type="text/javascript" src="'. $server . '/challenge?k=' . $this->public_key . '&hl=' . $this->settings['recaptcha_language'] . '"></script>
					<noscript>
					<iframe src="'. $server . '/noscript?k=' . $this->public_key . '&hl=' . $this->settings['recaptcha_language'] . '" height="300" width="500" frameborder="0"></iframe><br/>
					<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
					<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
					</noscript>';
*/
		$html .= '<script src="https://www.google.com/recaptcha/api.js" async defer></script>
			<form action="?" method="POST">
			<div class="g-recaptcha" data-sitekey="' . $this->public_key . '"></div>
			<br/>
		</form>

';

		//-----------------------------------------
		// Return Template Bit
		//-----------------------------------------
		
		return $this->registry->output->getTemplate('global_other')->captchaRecaptcha( $html );
	}

	/**
	 * Validates the entered captcha code, returning true on success and false on failure
	 *
	 * @return	@e boolean
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * $isValid = $this->validate();
	 * @endcode
	 */
	public function validate()
	{
		if ( !$this->private_key )
		{
			$this->error = 'no_private_key';
			return FALSE;
		}
		
//		$captcha_unique_id	= $_REQUEST['recaptcha_challenge_field'];
//		$captcha_input		= $_REQUEST['recaptcha_response_field'];
		$captcha_input		= $_REQUEST['g-recaptcha-response'];
		
		//-----------------------------------------
		// Path disclosure prevention
		//-----------------------------------------
		if ( is_array( $captcha_input ) )
		{
			return false;
		}
		
/*		if ( $captcha_input == null || strlen($captcha_input) == 0 || $captcha_unique_id == null || strlen($captcha_unique_id) == 0) 
		{
			return false;
		}
*/		
		$classToLoad	= IPSLib::loadLibrary( IPS_KERNEL_PATH . '/classFileManagement.php', 'classFileManagement' );
//		$classToLoad	= IPSLib::loadLibrary( IPS_KERNEL_PATH . '/classCommunication.php', 'classCommunication' );
		$communication	= new $classToLoad();
		
//		$response	= $communication->postFileContents( RECAPTCHA_VERIFY_SERVER . "/recaptcha/api/verify", array(
		$response	= $communication->postFileContents( RECAPTCHA_VERIFY_SERVER , array(
//		$response	= $communication->communicationSendData( RECAPTCHA_VERIFY_SERVER , array(
																											'secret'	=> $this->private_key,
																											'remoteip'		=> $this->member->ip_address,
																									//		'challenge'		=> $captcha_unique_id,
																											'response'		=> $captcha_input
																										)	);

//		$answers	= explode( "\n", $response );
		$answers	= json_decode( $response, true );

		$success = strtolower(trim($answers['success']));
//		if ( trim($answers[0]) == 'true' ) 
		if ( $success == 1 || $success == 'true' ) 
		{
			return TRUE;
		}
		else
		{
			/**
			 * It's an error
			 */
			$dis = "";
			foreach ($answers['error-codes'] as $key => $val) {
				$dis .= "[$key]=";
				if (is_array($val)) {
					$dis .= "(";
					foreach ($val as $k => $v) $dis .= "[$k]=$v;";
					$dis .= ");";
				} else {
					$dis .= "$val;";
				}
			}
			$this->error = $dis;
//			trigger_error( $dis, E_USER_ERROR );
			return FALSE;
		}
	}
}