<?php

//-----------------------------------------------
// (DP32) Similar Topics
//-----------------------------------------------
//-----------------------------------------------
// Custom Class
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 10 / 01 / 2010
// Updated on: 12 / 01 / 2010
//-----------------------------------------------
// Copyright (C) 2010 DawPi
// All Rights Reserved
//-----------------------------------------------     

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly.";
	exit();
}


class dp3similarTopicsLib
{

	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	protected $member;
	protected $cache;	
	/**#@-*/

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object		Registry reference
	 * @param	object		Reference to topics lib
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry )
	{
		/* Make objects */
		$this->registry = $registry;
		$this->DB	    = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->lang	    = $this->registry->getClass('class_localization');
		$this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->cache	= $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();
		
        /* Load forums lib */

		require_once( IPSLib::getAppDir( 'forums' ) . "/sources/classes/forums/class_forums.php" );

		$this->forumsLib = new class_forums( $this->registry );	
		
		/* Load lang */
		
		$this->registry->getClass( 'class_localization' )->loadLanguageFile( array( 'public_forums', 'public_boards' ) );		
	}
	
	public function showSimilarTopics( $position = 'afr' )
	{		
		/* Check position */

		$_position		= $this->settings['dp3_st_location'];
		
		if( $position !== $_position )
		{
			return false;
		}

		/* INIT */
			
		$fid 			= intval( $this->request['f'] );
		
		$tid			= intval( $this->request['t'] );
		
		$topics_data	= array();
		
		$tids			= array();
		
		$parse_dots 	= 1;

		/* Check ID's */
		
		if( ! $fid || ! $tid )
		{
			return false;
		}
		
		/* Mod is enabled? */
		
		if( ! $this->settings['dp3_st_enable'] )
		{
			return false;
		}
		
		/* Allowed group? */
		
		if( ! in_array( $this->memberData['member_group_id'], explode(',', $this->settings['dp3_st_groups'] ) ) )
		{
			return false;
		}
		
		/* Allowed forum */
		
		if( ! in_array( $fid, explode(',', $this->settings['dp3_st_forums'] ) ) )
		{
			return false;
		}
	    
		/* Get topic informations */
		
		$topic = $this->DB->buildAndFetch( array(
												'select'	=> 'tid, title, description',
												'from'		=> 'topics',
												'where'		=> 'tid = ' . $tid
												
		)	);
		
		/* Do we have topic data? */
		
		if( ! $topic['tid'] )
		{
			return false;
		}

		/* Build keywords */
		
		$whereCondition = self::_buildKeywordsCond( $topic['title'], $topic['description'], $fid, $tid );
		
		/* Set limit */
		
		$_lim	= $this->settings['dp3_st_items'];
		
		$lim 	= ( $_lim && is_numeric( $_lim ) && $_lim < 200 ) ? $_lim : 5;	#More than 200? Wohoo, set 5. :P
		
		/* Member Formatting? */
		
		$form	= ( $this->settings['dp3_st_format'] ) ? 1 : 0;
		
		/* Set sort type */
		
        switch( $this->settings['dp3_st_stype'] )
        {
        	case 'rand':
        			$sortBy = 'rand()';	
        		break;
        		
        	case 'lpost':
        			$sortBy = 't.last_post';	
        		break;
         	
			 case 'sdate':
        			$sortBy = 't.start_date';	
        		break; 
				      		
        	default:
        			$sortBy = 't.start_date';	
        		break;
        }
		
		/* Set sort order */
        
		switch( $this->settings['dp3_st_sorder'] )
        {
        	case 'asc':
        			$sortOrder = 'ASC';	
        		break;
        		
        	case 'desc':
        			$sortOrder = 'DESC';	
        		break;
				      		
        	default:
        			$sortOrder = 'ASC';	
        		break;
        }
		
		/* RAND? Remove order then */
		
		if( $this->settings['dp3_st_stype'] == 'rand' )
		{
			$sortOrder = '';	
		}		
	
		/* Get topics */

		$this->DB->build( array( 
								'select'   => 't.*',
								'from'     => array( 'topics' => 't' ),
								'where'		=> $whereCondition,
								'limit'		=> array(0, $lim ),
								'order'		=> $sortBy . ' ' . $sortOrder,
								'add_join' => array(
													array(
														'select' => 'f.name as forum_name, f.forum_allow_rating, f.name_seo',
														'from'   => array( 'forums' => 'f' ),
														'where'  => "f.id=t.forum_id",
														'type'   => 'left',
														 ),
													array(
														'select' => 'ms.member_group_id as starter_group_id',
														'from'   => array( 'members' => 'ms' ),
														'where'  => "ms.member_id=t.starter_id",
														'type'   => 'left',
														 ),
													array(
														'select' => 'mss.member_group_id as last_poster_group_id',
														'from'   => array( 'members' => 'mss' ),
														'where'  => "mss.member_id=t.last_poster_id",
														'type'   => 'left',
														 ),
													array(
														'select' => 'pp.*',
														'from'   => array( 'profile_portal' => 'pp' ),
														'where'  => "pp.pp_member_id=mss.member_id",
														'type'   => 'left',
														 ),															 
													$this->registry->tags->getCacheJoin( array( 'meta_id_field' => 't.tid' ) )	 															 														 
												   )
						)	);		
		
		$this->DB->execute();
		
		/* Do we have any results? */
		
		if( $this->DB->getTotalRows() )
		{
			while( $row = $this->DB->fetch() )
			{				
				/* Read icon */
				
				$show_dots 			= '';
				
				if ( $this->memberData['member_id'] == $row['starter_id'] )
				{
					$show_dots 		= 1;
				}
		
				if( $row['poll_state'] AND ( $row['last_vote'] > $row['last_post'] ) )
				{
					$is_read		= $this->registry->classItemMarking->isRead( array( 'forumID' => $row['forum_id'], 'itemID' => $row['tid'], 'itemLastUpdate' => $row['last_vote'] ), 'forums' );
					
					$gotonewpost	= $this->registry->classItemMarking->isRead( array( 'forumID' => $row['forum_id'], 'itemID' => $row['tid'], 'itemLastUpdate' => $row['last_post'] ), 'forums' );
				}
				else
				{
					$is_read		= $this->registry->classItemMarking->isRead( array( 'forumID' => $row['forum_id'], 'itemID' => $row['tid'], 'itemLastUpdate' => $row['last_post'] ), 'forums' );
					
					$gotonewpost	= $is_read;
				}							
								
				$row['folder_img'] 	= $this->registry->getClass('class_forums')->fetchTopicFolderIcon( $row, $show_dots, $is_read );				
				
				/* Jump to latest post / last time stuff... */
				
				if ( ! $gotonewpost )
				{
					$row['go_new_post']  = true;
				}
				else
				{
					$row['go_new_post']  = false;
				}
				
				/* Title seo */
				
				$row['title_seo'] 	= ( $row['title_seo'] ) ? $row['title_seo'] : IPSText::makeSeoTitle( $row['title'] );
				
				/* Start date */
				
				$row['start_date'] 	= $this->registry->getClass( 'class_localization')->getDate( $row['start_date'], 'LONG' );												

				/* Pages 'n' posts */
				
				$pages = 1;
				
				$row['PAGES'] = "";
								
				if ( $row['posts'] )
				{
					$mode = IPSCookie::get( 'topicmode' );
					
					if( $mode == 'threaded' )
					{
						$this->settings['display_max_posts'] =  $this->settings['threaded_per_page'] ;
					}
					
					if ( ( ( $row['posts'] + 1 ) % $this->settings['display_max_posts'] ) == 0 )
					{
						$pages = ( $row['posts'] + 1 ) / $this->settings['display_max_posts'];
					}
					else
					{
						$number = ( ( $row['posts'] + 1 ) / $this->settings['display_max_posts'] );
						
						$pages = ceil( $number );
					}
				}
				
				if ( $pages > 1 )
				{
					for ( $i = 0 ; $i < $pages ; ++$i )
					{
						$real_no = $i * $this->settings['display_max_posts'];
						
						$page_no = $i + 1;
						
						if ( $page_no == 4 and $pages > 4 )
						{
							$row['pages'][] = array(   'last'   => 1,
							 					       'st'     => ( $pages - 1 ) * $this->settings['display_max_posts'],
							  						   'page'   => $pages );
							break;
						}
						else
						{
							$row['pages'][] = array(   'last' => 0,
													   'st'   => $real_no,
													   'page' => $page_no );
						}
					}
				}
				
				/* Format some numbers - posts and views */
				
				$row['posts']  = $this->registry->getClass('class_localization')->formatNumber( intval( $row['posts'] ) );
				
				$row['views']  = $this->registry->getClass('class_localization')->formatNumber( intval( $row['views'] ) );						

				/* Format names */
				
				if( $form )
				{
					$row['starter_name'] 		= IPSMember::makeNameFormatted( $row['starter_name'], $row['starter_group_id'] );
					$row['last_poster_name'] 	= IPSMember::makeNameFormatted( $row['last_poster_name'], $row['last_poster_group_id'] );
				}	
				
				/* Yawn */

				$row['last_poster'] = $row['last_poster_id'] ? IPSMember::makeProfileLink( $row['last_poster_name'], $row['last_poster_id'], $row['seo_last_name'] ) : $this->settings['guest_name_pre'] . $row['last_poster_name'] . $this->settings['guest_name_suf'];
		
				$row['starter']     = $row['starter_id']     ? IPSMember::makeProfileLink( $row['starter_name'], $row['starter_id'], $row['seo_first_name'] ) : $this->settings['guest_name_pre'] . $row['starter_name'] . $this->settings['guest_name_suf'];	
						 
				$row['prefix']  = $row['poll_state'] ? $this->registry->getClass('output')->getTemplate('forum')->topicPrefixWrap( $this->settings['pre_polls'] ) : '';
				
				/* Last post */
				
				$row['last_post'] = $this->registry->getClass('class_localization')->getDate( $row['last_post'], 'LONG' );
				
				/* Topic rating */
				
			    $row['_rate_img']   = '';
			    
			    if ( isset( $row['forum_allow_rating'] ) AND $row['forum_allow_rating'] )
				{
					if ( $row['topic_rating_total'] )
					{
						$row['_rate_int'] = round( $row['topic_rating_total'] / $row['topic_rating_hits'] );
					}
					
					/* Show image? */
					
					if ( ( $row['topic_rating_hits'] >= $this->settings['topic_rating_needed'] ) AND ( $row['_rate_int'] ) )
					{
						$row['_rate_img']  = $this->registry->getClass('output')->getTemplate('forum')->topic_rating_image( $row['_rate_int'] );
					}
				}
				
				/* Forum SEO */
				
				if ( ! $row['name_seo'] )
				{
					/* SEO name */
					
					$row['name_seo'] = IPSText::makeSeoTitle( $row['forum_name'] );
				}
				
				/* Members */
				
				$row = IPSMember::buildDisplayData( $row );								
			
				/* Tags */
				if ( ! empty( $row['tag_cache_key'] ) )
				{
					$row['tags'] = $this->registry->tags->formatCacheJoinData( $row );
				}
				
				if( $row['pinned'] == 1 )
				{
					$row['prefix'] = $this->registry->getClass('output')->getTemplate('forum')->topicPrefixWrap( $this->lang->words['pre_pinned'] );
				}
				
				/* Topic ID'S */
				
				$tids[]	= $row['tid'];  
				
				/* ADD */
				
				$topics_data[ $row['tid'] ] = $row;					
			}
		}
		else
		{
			/* No topics - out? */
			
			if( ! $this->settings['dp3_st_showno'] )
			{
				return false;
			}
		}
		
		/* Expand / Collapse mod ~ by Michael McCune */

		$toggle = ( IPSCookie::get( "dp3similartopics" ) ) ? 'collapsed' : 'expanded';
						
		/* Return data */
	
		return $this->registry->output->getTemplate('topic')->hookdp3similarTopics( $topics_data, $toggle );		
	}
	
	
	
	private function _buildKeywordsCond( $title = '', $desc = '', $fid = 0, $tid = 0 )
	{
		/* INIT */
		
		$skipFid		= array();
		
		$keywords 		= array();
		
		$gKeywords		= array();
		
		$excluded		= array();
		
		$where			= array( 't.tid <> ' . $tid . ( ! $this->memberData['g_access_cp'] ? ' AND t.approved = 1' : '' ) );
				
		/* Get allowed forums */
		
		if( ! $this->settings['dp3_st_sameforum'] )
		{
			$skipFid	= array( $fid );
		}
				
		$fids 			= $this->forumsLib->fetchSearchableForumIds( $this->memberData['member_id'], $skipFid );
		
		$where[]		= 't.forum_id IN (' . implode(',', $fids ).  ')';
			
		/* Build parser */
		
		$search 		= array( '#', '$', '^', '&', '-', '_', '`', '~', '{', '}', '/', '.', ',', '!', ':', ';', "'", '@', '%', '*', '(', ')' );
		
		$replace		= '';
		
		$cexcl			= 0;
		
		/* Excluded keywords */
		
		if( $this->settings['dp3_st_excl_enable'] )
		{		
			/* Get list */
			
			$excluded		= explode(',', $this->settings['dp3_st_excluded'] );
			
			/* Clean and parse excluded keywords */
			
			foreach( $excluded as $k => $v )
			{
				$excluded[ $k ] =  strtolower( trim( $v ) );
			}
			
			/* How many excl keywords we have */
			
			$cexcl			= count( $excluded );
		}
		
		/* Grab data */

		$title  		= strtolower( str_replace( $search, $replace, $title ) );
		
		$description	= strtolower( str_replace( $search, $replace, $desc ) );
		
		/* Tmp */
		
		$tmp_key		= $title;
				
		/* Get keys from title */
		
		$keywords		= explode(' ', $title );
		
		/* Get keys from description */
		
		if( $this->settings['dp3_st_desc_also'] )
		{	
			/* Add desc */
			
			if( IPSText::mbstrlen( $description ) )
			{
				$keywords	= array_merge( $keywords, explode(' ',  $description ) ); 
				
				$tmp_key 	= $tmp_key . ' ' . $description;
			}	
		}

		/* More than one? */
		
		if ( strpos( $tmp_key, ' ' ) === false )
		{
			/* Excluded keywords? */

			if( ( $cexcl && ! in_array( $tmp_key, $excluded ) ) || ! $cexcl )
			{
				$gKeywords[] = "LOWER(t.title) LIKE '%{$tmp_key}%'";
			}				
		}
		else
		{
			/* Parse all keywords */
			
			foreach( $keywords as $key )
			{
				/* Min. required lenght */
				
				if( IPSText::mbstrlen( $key ) < $this->settings['dp3_st_min'] )
				{
					continue;
				}
				
				/* Clean code */
				
				$key = preg_replace("/&#([0-9]+);/", "", $key);
				
				$key = preg_replace("/\s+(and|or)$/" , "" , $key);
								
				$key = preg_replace("/[\|\[\]\{\}\(\)\,:\\\\\/\"']|&quot;/", "", $key);
				
				$key = preg_replace("/^(?:img|quote|code|html|javascript|a href|color|span|div|border|style)$/", "", $key);	
				
				/* Still required lenght */
				
				if( ( $this->settings['dp3_st_min'] <= IPSText::mbstrlen( $key ) ) && $key )
				{
					/* Excluded keywords? */

					if( in_array( $key, $excluded ) && $cexcl )
					{
						continue;
					}
					
					/* Store it! */
					
					$gKeywords[] = "LOWER(t.title) LIKE '%{$key}%'";
					
					/* Desc also? */
					
					if( $this->settings['dp3_st_desc_also'] )
					{
						$gKeywords[] = "LOWER(t.description) LIKE '%{$key}%'";
					}
				} 			
			}
		}
		
		/* Build keywords where condition */
		
		if( count( $gKeywords ) )
		{
			$where[]		= '(' . implode( ' OR ', $gKeywords ) . ')';
		}
		else
		{
			/* Store */
			
			$where[] 		= "LOWER(t.title) LIKE '%{$gKeywords}%'";
			
			/* Desc also? */
					
			if( $this->settings['dp3_st_desc_also'] )
			{			
				$where[] 	= "LOWER(t.description) LIKE '%{$gKeywords}%'";
			}			
		}
		
		/* Build keys for return */	
			
		$returnCondition	= implode( ' AND ', $where );
		
		/* Return */
		
		return $returnCondition;
	}	
} //End of class