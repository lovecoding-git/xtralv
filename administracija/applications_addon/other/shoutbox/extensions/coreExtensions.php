<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

/**
* Main loader class
*/
class publicSessions__shoutbox
{
	public function getSessionVariables()
	{
		/* INIT */
		$array = array( 'location_1_type'   => '',
						'location_1_id'     => 0,
						'location_2_type'   => '',
						'location_2_id'     => 0
						);

		return $array;
	}

public function parseOnlineEntries( $rows )
	{
		if( !is_array($rows) || !count($rows) )
		{
			return $rows;
		}
		
		/* Load language file */
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'public_shoutbox' ), 'shoutbox' );
		
		$final = array();
		
		foreach( $rows as $row )
		{
			if( $row['current_appcomponent'] == 'shoutbox' )
			{
				$row['where_line'] = ipsRegistry::getClass('class_localization')->words['WHERE_shoutbox_'.$row['current_module']];
			}

			$final[ $row['id'] ] = $row;
		}
		
		return $final;
	}
}