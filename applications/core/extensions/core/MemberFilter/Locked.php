<?php
/**
 * @brief		Member Filter Extension
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community

 * @since		22 Sep 2021
 */

namespace IPS\core\extensions\core\MemberFilter;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Member Filter Extension
 */
class _Locked
{
	/**
	 * Determine if the filter is available in a given area
	 *
	 * @param	string	$area	Area to check
	 * @return	bool
	 */
	public function availableIn( $area )
	{
		return \in_array( $area, array( 'bulkmail' ) );
	}

	/** 
	 * Get Setting Field
	 *
	 * @param	mixed	$criteria	Value returned from the save() method
	 * @return	array 	Array of form elements
	 */
	public function getSettingField( $criteria )
	{
		$options = array( 'any' => 'any', 'locked' => 'mf_locked_locked', 'notlocked' => 'mf_locked_not_locked' );

		return array(
			new \IPS\Helpers\Form\Radio( 'mf_locked', isset( $criteria['locked'] ) ? $criteria['locked'] : 'any', FALSE, array( 'options' => $options ) ),
		);
	}
	
	/**
	 * Save the filter data
	 *
	 * @param	array	$post	Form values
	 * @return	mixed			False, or an array of data to use later when filtering the members
	 * @throws \LogicException
	 */
	public function save( $post )
	{
		return ( isset( $post['mf_locked'] ) and \in_array( $post['mf_locked'], array( 'locked', 'notlocked' ) ) ) ? array( 'locked' => $post['mf_locked'] ) : FALSE;
	}
	
	/**
	 * Get where clause to add to the member retrieval database query
	 *
	 * @param	mixed				$data	The array returned from the save() method
	 * @return	array|NULL			Where clause - must be a single array( "clause" )
	 */
	public function getQueryWhereClause( $data )
	{
		if ( isset( $data['locked'] ) )
		{
			switch ( $data['locked'] )
			{
				case 'locked':
					return array( '( failed_login_count>=' . (int) \IPS\Settings::i()->ipb_bruteforce_attempts . ' OR failed_mfa_attempts>=' . (int) \IPS\Settings::i()->security_questions_tries . ')' );
					break;
				case 'notlocked':
					return array( "( (failed_login_count IS NULL OR failed_login_count=0) and (failed_mfa_attempts IS NULL OR failed_mfa_attempts=0) )" );
					break;
			}
		}

		return NULL;
	}
}