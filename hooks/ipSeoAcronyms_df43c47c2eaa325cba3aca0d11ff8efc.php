<?php

class ipSeoAcronyms extends admin_core_posts_badwords
{
	public function badwordsRebuildCache()
	{
		parent::badwordsRebuildCache();
	
		$cache = $this->cache->getCache( 'badwords' );
		
		$this->DB->build( array( 'select' => '*', 'from' => 'seo_acronyms', 'order' => 'a_short' ) );
		$this->DB->execute();
		while( $row = $this->DB->fetch() )
		{
			$cache[] = array(
				'type'		=> $row['a_short'],
				'swop'		=> ( $row['a_semantic'] ) ? "<acronym title='{$row['a_long']}'>{$row['a_short']}</acronym>" : $row['a_long'],
				'm_exact'	=> 1,
				'ignore_bypass'	=> 1,
				);
		}
		
		$this->cache->setCache( 'badwords', $cache, array( 'array' => 1 ) );
	}
}