<?php

/**
 *
 * Classifieds 1.2.0
 *
 * @author		$Author: Andrew Millne $
 * @copyright   2011 Andrew Millne. All Rights Reserved.
 * @license		http://dev.millne.com/license.html
 * @package		Classifieds
 * @link		http://dev.millne.com
 *
 */

/**
* Main loader class
*/
class tp_time_until extends output implements interfaceTemplatePlugins
{
	/**
	 * Prevent our main destructor being called by this class
	 *
	 * @access	public
	 * @return	void
	 */
	public function __destruct()
	{
	}
	
	/**
	 * Run the plug-in
	 *
	 * @access	public
	 * @author	Andrew Millne
	 * @param	string	The initial data from the tag
	 * @param	array	Array of options [N/A]
	 * @return	string	Processed HTML
	 */
	public function runPlugin( $data, $options )
	{
		//-----------------------------------------
		// Process the tag and return the data
		//-----------------------------------------

		if( !$data )
		{
			return;
		}

                $return	= '" . $this->registry->classifieds->timeUntil( ' . $data . ' )  . "';

		//-----------------------------------------
		// Process the tag and return the data
		//-----------------------------------------

		return $return;
	}
	
	/**
	 * Return information about this modifier
	 *
	 * It MUST contain an array  of available options in 'options'. If there are no allowed options, then use an empty array.
	 * Failure to keep this up to date will most likely break your template tag.
	 *
	 * @access	public
	 * @author	Matt Mecham
	 * @return   array
	 */
	public function getPluginInfo()
	{
		//-----------------------------------------
		// Return the data, it's that simple...
		//-----------------------------------------
		
		return array( 'name'    => 'time_until',
					  'author'  => 'Andrew Millne',
					  'usage'   => '{parse time_until="5657567343"}',
					  'options' => array() );
	}
}