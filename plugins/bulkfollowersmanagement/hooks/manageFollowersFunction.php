//<?php

class hook19 extends _HOOK_CLASS_
{
	/**
	 * Remove All Followers
	 *
	 * @return	array
	 */
	public function followersRemoveall()
	{
		try
		{
			try
			{
				if ( !\IPS\Request::i()->id OR !intval( \IPS\Request::i()->id ) )
				{
					\IPS\Output::i()->error( 'node_error', '2T252/D', 403, '' );
				}
		
				$id 		= \IPS\Request::i()->id;
				$app		= \IPS\Dispatcher::i()->application->directory;
				$module		= \IPS\Dispatcher::i()->module->key;
				$controller	= \IPS\Dispatcher::i()->controller;
				$permission	= static::getNodeClass();
				$area		= $permission::$permType;
		
				$form = new \IPS\Helpers\Form( 'remove', 'followers_remove_short' );
				$form->add( new \IPS\Helpers\Form\Radio( 'manageFollowers_type', NULL, TRUE, array(
		            'options' => array(
			            'member'	=> 'followers_member',
			            'all'		=> 'followers_all'
		            ),
		            'toggles' => array(
			            'member'  	=> array( 'followers_member' )
		            )
		        ) ) );
		
				$form->add( new \IPS\Helpers\Form\Member( 'followers_member', NULL, FALSE, array(), function( $member ) use ( $form )
				{
					$id 		= \IPS\Request::i()->id;
					$app		= \IPS\Dispatcher::i()->application->directory;
					$module		= \IPS\Dispatcher::i()->module->key;
					$controller	= \IPS\Dispatcher::i()->controller;
					$permission	= static::getNodeClass();
					$area		= $permission::$permType;
					
					$count = \IPS\Db::i()->select( 'COUNT(*)', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', $app, $area, $id, $member->member_id ) )->first();
					if ( $count == 0 )
					{
						throw new \InvalidArgumentException( 'follower_not_following' );
					}
				}, NULL, NULL, 'followers_member' ) );
		
				if ( $values = $form->values() )
				{
					if( $values['manageFollowers_type'] == 'member' )
					{
						\IPS\Db::i()->delete( 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', $app, $area, $id, $values['followers_member']->member_id ) );
						$msg = 'follower_removed';
					}
					else
					{
						\IPS\Db::i()->delete( 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=?', $app, $area, $id ) );
						$msg = 'followers_removed';
					}
		
					\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app='.$app.'&module='.$module.'&controller='.$controller ), $msg );
				}
			
				\IPS\Output::i()->output = $form;
			}
			catch ( \RuntimeException $e )
			{
				if ( method_exists( get_parent_class(), __FUNCTION__ ) )
				{
					return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
				}
				else
				{
					throw $e;
				}
			}
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}

	/**
	 * Add Followers
	 *
	 * @return	array
	 */
	public function followersAdd()
	{
		try
		{
			try
			{
				if ( !\IPS\Request::i()->id OR !intval( \IPS\Request::i()->id ) )
				{
					\IPS\Output::i()->error( 'node_error', '2T252/D', 403, '' );
				}
		
				$id 		= \IPS\Request::i()->id;
				$db 		= isset( \IPS\Request::i()->database_id ) ? \IPS\Request::i()->database_id : '';
				$app		= \IPS\Dispatcher::i()->application->directory;
				$module		= \IPS\Dispatcher::i()->module->key;
				$controller	= \IPS\Dispatcher::i()->controller;
				$permission	= static::getNodeClass();
				$area		= $permission::$permType.$db;
				$where		= array();
		
				$form = new \IPS\Helpers\Form( 'add', 'manageFollowers_add' );
				$form->hiddenValues['id'] 			= $id;
				$form->hiddenValues['db'] 			= isset( \IPS\Request::i()->database_id ) ? \IPS\Request::i()->database_id : '';
				$form->hiddenValues['app'] 			= \IPS\Dispatcher::i()->application->directory;
				$form->hiddenValues['module'] 		= \IPS\Dispatcher::i()->module->key;
				$form->hiddenValues['controller'] 	= \IPS\Dispatcher::i()->controller;
		
				$form->add( new \IPS\Helpers\Form\Radio( 'manageFollowers_type', NULL, TRUE, array(
		            'options' => array(
			            'member'	=> 'followers_member',
			            'group'		=> 'followers_group'
		            ),
		            'toggles' => array(
			            'member'  	=> array( 'followers_member' ),
			            'group'  	=> array( 'followers_group' )
		            )
		        ) ) );
		
				$form->add( new \IPS\Helpers\Form\Select( 'followers_group', NULL, FALSE, array( 'options' => \IPS\Member\Group::groups( TRUE, FALSE ), 'parse' => 'normal' ), NULL, NULL, NULL, 'followers_group' ) );
		
				$form->add( new \IPS\Helpers\Form\Member( 'followers_member', NULL, FALSE, array(), NULL, NULL, NULL, 'followers_member' ) );
		
				if ( $values = $form->values() )
				{
					\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'manageFollowers_adding' );
		
					switch ( $values['manageFollowers_type'] )
					{
						case 'group':
							$thing = $values['followers_group'];
						break;
						case 'member':
							$thing = $values['followers_member']->member_id;
						break;
					}
		
					if( $values['manageFollowers_type'] == 'member' )
					{
						$save = array(
							'follow_id'				=> md5( $app . ';' . $area . ';' . $id . ';' .  $thing ),
							'follow_app'			=> $app,
							'follow_area'			=> $area,
							'follow_rel_id'			=> $id,
							'follow_member_id'		=> $thing,
							'follow_is_anon'		=> 0,
							'follow_added'			=> time(),
							'follow_notify_do'		=> 1,
							'follow_notify_meta'	=> '',
							'follow_notify_freq'	=> \IPS\Settings::i()->manageFollowers_followtype,
							'follow_notify_sent'	=> 0,
							'follow_visible'		=> \IPS\Settings::i()->manageFollowers_anon
						);
						
						try
						{
							\IPS\Db::i()->insert( 'core_follow', $save );
						}
						catch( \IPS\Db\Exception $e ){}
		
						if( $app == 'cms' )
						{
							\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app='.$values['app'].'&module='.$values['module'].'&controller='.$values['controller'].'&do=manage&database_id='.$db ), 'followers_member_added' );	
						}
						else
						{
							\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app='.$values['app'].'&module='.$values['module'].'&controller='.$values['controller'] ), 'followers_member_added' );
						}
					}
					else
					{
						$where[] = array( 'member_group_id=?', $thing );
						$_SESSION['add_follower_group'] = $where;
						\IPS\Output::i()->redirect( \IPS\Http\Url::internal( "app={$values['app']}&module={$values['module']}&controller={$values['controller']}&do=followersAddBulk&id={$id}&app={$app}&module={$module}&controller={$controller}&area={$area}&db={$db}&cycle=35" ) );
					}
				}
		
				\IPS\Output::i()->output = $form;
			}
			catch ( \RuntimeException $e )
			{
				if ( method_exists( get_parent_class(), __FUNCTION__ ) )
				{
					return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
				}
				else
				{
					throw $e;
				}
			}
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}

	public function followersAddBulk()
	{
		try
		{
			try
			{
				$id 		= \IPS\Request::i()->id;
				$db			= \IPS\Request::i()->db;
				$app		= \IPS\Request::i()->app;
				$module		= \IPS\Request::i()->module;
				$controller	= \IPS\Request::i()->controller;
				$area		= \IPS\Request::i()->area;
				$cycle 		= \IPS\Request::i()->cycle;
		
				\IPS\Output::i()->output = new \IPS\Helpers\MultipleRedirect( \IPS\Http\Url::internal( "app={$app}&module={$module}&controller={$controller}&do=followersAddBulk&id=".$id.'&app='.$app.'&module='.$module.'&controller='.$controller.'&area='.$area.'&db='.$db.'&cycle=35' ),
				function( $data ) use ( $cycle )
				{
					$select	= \IPS\Db::i()->select( '*', 'core_members', $_SESSION['add_follower_group'], 'member_id ASC', array( is_array( $data ) ? $data['done'] : 0, $cycle ), NULL, NULL, \IPS\Db::SELECT_SQL_CALC_FOUND_ROWS );
		
					$id 		= \IPS\Request::i()->id;
					$db			= \IPS\Request::i()->db;
					$app		= \IPS\Request::i()->app;
					$module		= \IPS\Request::i()->module;
					$controller	= \IPS\Request::i()->controller;
					$area		= \IPS\Request::i()->area;
					$cycle 		= \IPS\Request::i()->cycle;
					$total		= $select->count( TRUE );
		
					if ( !$select->count() )
					{
						return NULL;
					}
		
					if( !is_array( $data ) )
					{
						$data = array( 'total' => $total, 'done' => 0 );
					}
		
					foreach( $select AS $row )
					{
						$save = array(
							'follow_id'				=> md5( $app . ';' . $area . ';' . $id . ';' .  $row['member_id'] ),
							'follow_app'			=> $app,
							'follow_area'			=> $area,
							'follow_rel_id'			=> $id,
							'follow_member_id'		=> $row['member_id'],
							'follow_is_anon'		=> 0,
							'follow_added'			=> time(),
							'follow_notify_do'		=> 1,
							'follow_notify_meta'	=> '',
							'follow_notify_freq'	=> \IPS\Settings::i()->manageFollowers_followtype,
							'follow_notify_sent'	=> 0,
							'follow_visible'		=> \IPS\Settings::i()->manageFollowers_anon
						);
		
						try
						{
							\IPS\Db::i()->insert( 'core_follow', $save );
						}
						catch( \IPS\Db\Exception $e ){}
					}
		
					$data['done'] += $cycle;
			
					return array( $data, \IPS\Member::loggedIn()->language()->addToStack( 'manageFollowers_adding' ),( $data['done'] / $data['total'] ) * 100 );
				}, function()
				{
					/* Finished */
					$_SESSION['add_follower_group'] = NULL;
					$app		= \IPS\Request::i()->app;
					$db			= \IPS\Request::i()->db;
					$module		= \IPS\Request::i()->module;
					$controller	= \IPS\Request::i()->controller;
		
					if( $app == 'cms' )
					{
						$url = \IPS\Http\Url::internal( "app={$app}&module={$module}&controller={$controller}&do=manage&database_id={$db}" );
					}
					else
					{
						$url = \IPS\Http\Url::internal( 'app='.$app.'&module='.$module.'&controller='.$controller );
					}
		
					\IPS\Output::i()->redirect( $url, 'completed' );
				} );
			}
			catch ( \RuntimeException $e )
			{
				if ( method_exists( get_parent_class(), __FUNCTION__ ) )
				{
					return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
				}
				else
				{
					throw $e;
				}
			}
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
}