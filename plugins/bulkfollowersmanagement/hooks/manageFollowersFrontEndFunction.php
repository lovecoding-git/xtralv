//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook23 extends _HOOK_CLASS_
{
	/**
	 * Add Followers
	 *
	 * @return	array
	 */
	protected function followersAdd()
	{
		try
		{
			if ( !\IPS\Member::loggedIn()->modPermission( 'can_remove_followers' ) )
			{
				\IPS\Output::i()->error( 'no_permission_manage_followers', 'BFM/1', 403, '' );
			}
	
			$id 		= \IPS\Request::i()->id;
			$app		= \IPS\Request::i()->fromApp;
			$area		= \IPS\Request::i()->area;
			$where		= array();
	
			$form = new \IPS\Helpers\Form( 'add', 'manageFollowers_add' );
			$form->class = 'ipsForm_horizontal ipsPad';
			$form->hiddenValues['id'] 		= $id;
			$form->hiddenValues['fromApp'] 	= $app;
			$form->hiddenValues['area'] 	= $area;
	
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
			$form->add( new \IPS\Helpers\Form\Member( 'followers_member', NULL, TRUE, array(), function( $member ) use ( $form )
			{
				$id 		= \IPS\Request::i()->id;
				$app		= \IPS\Request::i()->fromApp;
				$area		= \IPS\Request::i()->area;
	
				$count = \IPS\Db::i()->select( 'COUNT(*)', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', $app, $area, $id, $member->member_id ) )->first();
				if ( $count == 1 )
				{
					throw new \InvalidArgumentException( 'follower_already_following' );
				}
			}, NULL, NULL, 'followers_member' ) );
	
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
	
					\IPS\Db::i()->insert( 'core_follow', $save );
		
					$class = '\\IPS\\' . $app . '\\' . ucfirst( $area );
					$link = $class::load( $id )->url();		
					\IPS\Output::i()->redirect( $link, 'followers_member_added' );
				}
				else
				{
					$where[] = array( 'member_group_id=?', $thing );
					$_SESSION['add_follower_group'] = $where;
					\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=core&module=online&controller=online', 'front', 'online' )->setQueryString( array( 'do' => 'followersAddBulk', 'fromApp' => $app, 'area' => $area, 'id' => $id, 'cycle' => 35 ) ) );
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

	public function followersAddBulk()
	{
		try
		{
			$id 	= \IPS\Request::i()->id;
			$app	= \IPS\Request::i()->fromApp;
			$area	= \IPS\Request::i()->area;
			$cycle	= \IPS\Request::i()->cycle;
	
			\IPS\Output::i()->title  = \IPS\Member::loggedIn()->language()->addToStack( 'manageFollowers_adding' );
			\IPS\Output::i()->output = new \IPS\Helpers\MultipleRedirect( \IPS\Http\Url::internal( 'app=core&module=online&controller=online', 'front', 'online' )->setQueryString( array( 'do' => 'followersAddBulk', 'fromApp' => $app, 'area' => $area, 'id' => $id, 'cycle' => $cycle ) ),
			function( $data ) use ( $cycle )
			{
				$select	= \IPS\Db::i()->select( '*', 'core_members', $_SESSION['add_follower_group'], 'member_id ASC', array( is_array( $data ) ? $data['done'] : 0, $cycle ), NULL, NULL, \IPS\Db::SELECT_SQL_CALC_FOUND_ROWS );
	
				$id 		= \IPS\Request::i()->id;
				$app		= \IPS\Request::i()->fromApp;
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
					$count = \IPS\Db::i()->select( 'COUNT(*)', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', $app, $area, $id, $row['member_id'] ) )->first();
	
					if ( $count == 0 )
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
				
						\IPS\Db::i()->insert( 'core_follow', $save );
					}
				}
	
				$data['done'] += $cycle;
	
				return array( $data, \IPS\Member::loggedIn()->language()->addToStack( 'manageFollowers_adding' ),( $data['done'] / $data['total'] ) * 100 );
			}, function()
			{
				/* Finished */
				$_SESSION['add_follower_group'] = NULL;
				$id 		= \IPS\Request::i()->id;
				$app		= \IPS\Request::i()->fromApp;
				$area		= \IPS\Request::i()->area;
	
				$class = '\\IPS\\' . $app . '\\' . ucfirst( $area );
				$link = $class::load( $id )->url();	
	
				\IPS\Output::i()->redirect( $link, 'completed' );
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

	/**
	 * Remove All Followers
	 *
	 * @return	array
	 */
	public function followersRemove()
	{
		try
		{
			if ( !\IPS\Member::loggedIn()->modPermission( 'can_remove_followers' ) )
			{
				\IPS\Output::i()->error( 'no_permission_manage_followers', 'BFM/2', 403, '' );
			}
	
			if ( !\IPS\Request::i()->id OR !intval( \IPS\Request::i()->id ) )
			{
				\IPS\Output::i()->error( 'node_error', '2T252/D', 403, '' );
			}
	
			$id 		= \IPS\Request::i()->id;
			$app		= \IPS\Request::i()->fromApp;
			$area		= \IPS\Request::i()->area;
	
			$form = new \IPS\Helpers\Form( 'remove', 'followers_remove_short' );
			$form->class = 'ipsForm_horizontal ipsPad';
			$form->add( new \IPS\Helpers\Form\Radio( 'manageFollowers_type', NULL, TRUE, array(
	            'options' => array(
		            'member'	=> 'followers_member',
		            'all'		=> 'followers_all'
	            ),
	            'toggles' => array(
	            'member'  	=> array( 'followers_member' )
	            )
	        ) ) );
	
			$form->add( new \IPS\Helpers\Form\Member( 'followers_member', NULL, TRUE, array(), function( $member ) use ( $form )
			{
				$id 		= \IPS\Request::i()->id;
				$app		= \IPS\Request::i()->fromApp;
				$area		= \IPS\Request::i()->area;
				
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
	
				$class = '\\IPS\\' . $app . '\\' . ucfirst( $area );
				$link = $class::load( $id )->url();		
				\IPS\Output::i()->redirect( $link, $msg );
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

	/**
	 * Remove from All Followed Content
	 *
	 * @return	array
	 */
	protected function removeFromAllContent()
	{
		try
		{
			\IPS\Session::i()->csrfCheck();
	
			if( !\IPS\Request::i()->id )
			{
				\IPS\Output::i()->error( 'no_module_permission', 'BFM/3', 403, '' );
			}
	
			\IPS\Db::i()->delete( 'core_follow', array( 'follow_member_id=?', \IPS\Request::i()->id ) );
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=core&module=system&controller=followed', 'front', 'followed_content' ), 'manageFollowers_unsubscribe_done' );
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