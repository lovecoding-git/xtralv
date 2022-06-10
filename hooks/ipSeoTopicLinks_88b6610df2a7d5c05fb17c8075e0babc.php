
		class ipSeoTopicLinks extends skin_topic(~id~)
		{
			function topicViewTemplate($forum, $topic, $post_data, $displayData)
			{
				$out = parent::topicViewTemplate($forum, $topic, $post_data, $displayData);
				
				$prev = $this->getPrevTopicLink($topic);
				$next = $this->getNextTopicLink($topic);
				
				if($prev)
				{
					$out = preg_replace("/\<li class\=\'previous\'\>(.*)\<\/li\>/", "<li class='previous'>{$prev}</li>", $out);
				}
				
				if($next)
				{
					$out = preg_replace("/\<li class\=\'next\'\>(.*) {$this->lang->words['_rarr']}\<\/a\>\<\/li\>/", "<li class='next'>{$next}</li>", $out);
				}
								
				return $out;
			}
			
			protected function getPrevTopicLink($topic)
			{				
				$this->DB->build( array( 
												'select' => 'tid, title, title_seo',
												'from'   => 'topics',
												'where'  => "forum_id={$topic['forum_id']} 
																AND approved=1 
																AND state <> 'link' 
																AND last_post < {$topic['last_post']}",
												'order'  => 'last_post DESC',
												'limit'  => array( 0,1 )
									)	);
									
				$this->DB->execute();
					
				if ( $this->DB->getTotalRows() )
				{
					$data = $this->DB->fetch();
					$link = ipsRegistry::getClass('output')->buildSEOUrl('showtopic=' . $data['tid'], 'public', $data['title_seo'], 'showtopic');
					$rtn  = $this->lang->words['_larr'].' <a class="prev" rel="prev" href="'.$link.'">'.$data['title'].'</a>';
				}
				else
				{
					$rtn = '';
				}
				
				return $rtn;
			}
			
			protected function getNextTopicLink($topic)
			{
				$this->DB->build( array( 
												'select' => 'tid, title, title_seo',
												'from'   => 'topics',
												'where'  => "forum_id={$topic['forum_id']} 
																AND approved=1 
																AND state <> 'link' 
																AND last_post > {$topic['last_post']}",
												'order'  => 'last_post',
												'limit'  => array( 0,1 )
									)	);
									
				$this->DB->execute();
					
				if ( $this->DB->getTotalRows() )
				{
					$data = $this->DB->fetch();
					$link = ipsRegistry::getClass('output')->buildSEOUrl('showtopic=' . $data['tid'], 'public', $data['title_seo'], 'showtopic');
					$rtn  = '<a class="next" rel="next" href="'.$link.'">'.$data['title'].'</a> '.$this->lang->words['_rarr'];
				}
				else
				{
					$rtn = '';
				}
				
				return $rtn;
			}
		} 