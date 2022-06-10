<?php

class similarTopicsPostScreen_function extends topicMod_ajaxTopics
{
    public function doExecute( ipsRegistry $registry )
    {
        switch( $this->request['do'] )
        {
			case 'similar':
				$this->topicosSimilares();
			break;
        }

        parent::doExecute( $registry );
    }

	public function topicosSimilares()
	{
		if( ! in_array( $this->memberData['member_group_id'], explode(',', $this->settings['sos31_similartopics_groups'] ) ) )
		{
			return $this->returnString( 'no_similares' );
		}
		
		if( ! in_array( $this->request['f'], explode(',', $this->settings['sos31_similartopics_forums'] ) ) )
		{
			return $this->returnString( 'no_similares' );
		}
		
		if ( $this->settings['sos31_similartopics_posts'] > 0 AND $this->memberData['posts'] >= $this->settings['sos31_similartopics_posts'] )
		{
			return $this->returnString( 'no_similares' );
		}

		$topics_data = $topic_array = $topic_ids = $member_ids = array();
		
		
		if ( ! $title = $this->request['title'] )
		{
			return $this->returnString( 'no_title' );
		}
		
		/* Load tagging stuff */
		if ( ! $this->registry->isClassLoaded('tags') )
		{
			require_once( IPS_ROOT_PATH . 'sources/classes/tags/bootstrap.php' );/*noLibHook*/
			$this->registry->setClass( 'tags', classes_tags_bootstrap::run( 'forums', 'topics' )  );
		}

		
		$this->registry->getClass( 'class_localization' )->loadLanguageFile( array( 'public_forums', 'public_boards', 'public_post' ) );
		
		$whereCondition = $this->_buildKeywordsCond( $title );

		$this->DB->build( array(
								'select'   => 't.*',
								'from'     => array( 'topics' => 't' ),
								'where'	   => $whereCondition,
								'limit'	   => array(0, $this->settings['sos31_similartopics_items'] ),
								'order'	   => $this->settings['sos31_similartopics_stype'] . ' ' . $this->settings['sos31_similartopics_sorder'],
								'add_join' => array( $this->registry->tags->getCacheJoin( array( 'meta_id_field' => 't.tid' ) ) )
		)	);

		$this->DB->execute();

		if( $this->DB->getTotalRows() )
		{
			while( $r = $this->DB->fetch() )
			{
				$topic_array[ $r['tid'] ] = $r;
				$topic_ids[ $r['tid'] ]   = $r['tid'];
				$member_ids[ $r['starter_id'] ] = $r['starter_id'];
				
				if( $r['last_poster_id'] )
				{
					$member_ids[ $r['last_poster_id'] ]	= $r['last_poster_id'];
				}
			}
		}
		else
		{
			return $this->returnString( 'no_similares' );
		}
		
		$_members	= IPSMember::load( $member_ids );

		/* R we dotty? */
		$topic_array = $this->checkUserPosted( $topic_ids, 1, $topic_array );

		
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'forums', 'forums' ) . '/forums.php' , 'public_forums_forums_forums' );
		$forumsClass = new $classToLoad;
		$forumsClass->makeRegistryShortcuts( $this->registry );

		foreach ( $topic_array as $r )
		{
			/* Topic title colored? */
			$r['style'] = "";
			
			if( isset( $r['ttc_fontcolor'] ) OR isset( $r['ttc_backgroundcolor'] ) OR isset( $r['ttc_bold'] ) OR isset( $r['ttc_italic'] ) )
			{
				$r['style'] .= " style='";
				$r['style'] .= "-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;padding-left:5px;padding-right:5px;padding-top:2px;padding-bottom:2px;";
				$r['style'] .= ( $r['ttc_fontcolor'] ) ? "color: {$r['ttc_fontcolor']}; " : '';
				$r['style'] .= ( $r['ttc_backgroundcolor'] ) ? "background-color: {$r['ttc_backgroundcolor']}; " : '';
				$r['style'] .= ( $r['ttc_italic'] ) ? "font-style: italic; " : '';
				$r['style'] .= ( $r['ttc_bold'] ) ? "font-weight: bold; " : '';
				$r['style'] .= "'";
			}
			
			/* Add member */
			if( $r['last_poster_id'] )
			{
				$r	= array_merge( IPSMember::buildDisplayData( $_members[ $r['last_poster_id'] ] ), $r );
			}
			else
			{
				$r	= array_merge( IPSMember::buildProfilePhoto( array() ), $r );
			}
			
			
			$r = $forumsClass->renderEntry( $r );
			
			/* Format names */
			if ( $r['starter_id'] AND $this->settings['sos31_similartopics_format'] )
			{
				$starter = $_members[ $r['starter_id'] ];
				$r['starter'] = IPSMember::makeProfileLink(IPSMember::makeNameFormatted( $starter['members_display_name'], $starter['member_group_id'] ), $r['starter_id'] );
			}
			
			if ( $r['last_poster_id'] AND $this->settings['sos31_similartopics_format'] )
			{
				$r['last_poster'] = IPSMember::makeProfileLink(IPSMember::makeNameFormatted( $r['members_display_name'], $r['member_group_id'] ), $r['last_poster_id'] );
			}
			
			/* Add pretty breadcrumbs */
			$r['forumBreadcrumb'] = $this->registry->getClass('class_forums')->forumsBreadcrumbNav( $r['forum_id'] );
		
			
			$topics_data[ $r['tid'] ] = array( 	'topic_data' 	=> $r, 
												'forum_data' 	=> $this->registry->class_forums->forum_by_id[ $r['forum_id'] ]
										);				
		}

		if ( $this->settings['sos31_similartopics_theme'] == 'default' )
		{
			return $this->returnHtml( $this->registry->output->getTemplate( 'post' )->similarTopicsAjax( $topics_data ) );
		}
		else
		{
			return $this->returnHtml( $this->registry->output->getTemplate( 'post' )->similarTopicsAjax_resumed( $topics_data ) );
		}
		
	}

	private function _buildKeywordsCond( $title = '', $desc = '' )
	{
		/* Script by Dawpi => (DP30) Similar Topics v1.0.1 */

		$skipFid		= array();
		$keywords 		= array();
		$gKeywords		= array();
		$searchTags		= array();
		$excluded		= array();
		$where[]		= 't.approved = 1';

		if( $this->settings['sos31_similartopics_sameforum'] == 'cur' )
		{
			$fids	= array( $this->request['f'] );
		}
		else
		{		
			$forumIDs = $this->registry->class_forums->forum_by_id;
	
			foreach( $forumIDs as $id => $data )
			{
				if ( $this->registry->permissions->check( 'read', $data ) === TRUE )
				{
					$forums[] = $data['id'];
				}
			}
	
			if ( count( $forums ) )
			{
				$fids = $forums;
			}
		}

		$where[]		= 't.forum_id IN (' . implode(',', $fids ).  ')';
		
		$search 		= array( '#', '$', '^', '&', '-', '_', '`', '~', '{', '}', '/', '.', ',', '!', ':', ';', "'", '@', '%', '*', '(', ')' );
		$replace		= '';
		$cexcl			= 0;
	
		$title  		= strtolower( str_replace( $search, $replace, $title ) );
		
		$keywords		= explode(' ', $title );

		foreach( $keywords as $key )
		{
			if( IPSText::mbstrlen( $key ) < $this->settings['sos31_similartopics_min'] )
			{
				continue;
			}
			
			/* Clean key */
			$key = preg_replace("/&#([0-9]+);/", "", $key);
			$key = preg_replace("/\s+(and|or)$/" , "" , $key);
			$key = preg_replace("/[\|\[\]\{\}\(\)\,:\\\\\/\"']|&quot;/", "", $key);
			$key = preg_replace("/^(?:img|quote|code|html|javascript|a href|color|span|div|border|style)$/", "", $key);	
			
			if( ( $this->settings['sos31_similartopics_min'] <= IPSText::mbstrlen( $key ) ) && $key )
			{
				if( in_array( $key, $excluded ) && $cexcl )
				{
					continue;
				}
				
				$gKeywords[] = "LOWER(t.title) LIKE '%{$key}%'";

				
				/* Use cleaned key to search for similar tags */
				$searchTags[] = $key;
			}		
		}
		
		if( count( $gKeywords ) )
		{
			$where[]		= '(' . implode( ' OR ', $gKeywords ) . ')';
		}
		else
		{
			$where[] 		= "LOWER(t.title) LIKE '%{$gKeywords}%'";			
		}
		
		$returnCondition	= implode( ' AND ', $where );

		/* Tag search */
		if ( $this->settings['tags_enabled'] )
		{
			$tags = $this->registry->tags->search( $searchTags, array( 		'meta_parent_id' => $fids,
																			'meta_app'		 => 'forums',
																			'meta_area'		 => 'topics',
																			//'sortKey'		 => $this->settings['sos31_similartopics_stype'],
																			'sortOrder'		 => $this->settings['sos31_similartopics_sorder'],
																			/*'joins' 		 => array( 'select' => 't.tid',
																									   'from'	=> array( 'topics' => 't' ),
																									   'where'  => 't.tid=tg.tag_meta_id',
																									   'type'   => 'left' )*/
			) );
	
			if ( is_array( $tags) && count( $tags ) )
			{
				$_tagIds = array();
				$_rows   = array();
				
				foreach( $tags as $id => $data )
				{
					$_tagIds[] = $data['tag_meta_id'];
				}
				
				$returnCondition = "({$returnCondition}) OR t.tid IN(" . implode( ',', $_tagIds ) . ")";
			}
		}
		
		return $returnCondition;
	}

    function checkUserPosted( $topic_ids=array(), $parse_dots=1, $topic_array=array() )
    {
       	if ( ( $this->memberData['member_id'] ) and ( count( $topic_ids ) ) and ( $parse_dots ) )
       	{
           		$this->DB->build(
               		array(
	               	    'select' => 'author_id, pid, topic_id',
	       	            'from'   => 'posts',
       	        	    'where'  => "author_id=".$this->memberData['member_id']." AND topic_id IN(".implode( ",", $topic_ids ).")",
               		)
           		);
            
			$this->DB->execute();

	        while ( $p = $this->DB->fetch() )
			{
        		if ( is_array( $topic_array[ $p['topic_id'] ] ) )
                {
	            	$topic_array[ $p['topic_id'] ]['author_id'] = 1;
        	    }
            }
        }

        return $topic_array;
    }
}