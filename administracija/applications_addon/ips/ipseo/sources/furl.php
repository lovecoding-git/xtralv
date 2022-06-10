<?php

class ipSeo_FURL
{
	protected static $_seoTemplates = null;
	
	protected static function init()
	{
		if ( is_file( DOC_IPS_ROOT_PATH . 'cache/furlCache.php' ) )
		{
			$templates = array();
			require( DOC_IPS_ROOT_PATH . 'cache/furlCache.php' );/*noLibHook*/
			self::$_seoTemplates = $templates;
		}
		else
		{
			/* Attempt to write it */
			self::$_seoTemplates = IPSLib::buildFurlTemplates();
			
			try
			{
				IPSLib::cacheFurlTemplates();
			}
			catch( Exception $e )
			{
			}
		}
	}
	
	public static function build($url, $urlType = 'public', $seoTitle = '', $seoTemplate = '')
	{
		if(is_null(self::$_seoTemplates))
		{
			self::init();
		}
		
		return self::format(self::prepare($url, $urlType), $seoTitle, $seoTemplate);
	}
	
	protected static function format($url, $seoTitle = '', $seoTemplate = '')
	{
		if(!ipsRegistry::$settings['use_friendly_urls'])
 		{
 			return $url;
 		}
 		
		$_template = false;
	
		if ( ipsRegistry::$settings['use_friendly_urls'] AND $seoTitle )
		{
			/* SEO Tweak - if default app is forums then don't bother with act=idx nonsense */
			if ( IPS_DEFAULT_APP == 'forums' )
			{
				if ( stristr( $url, 'act=idx' ) )
				{
					$url = str_ireplace( array( 'index.php?act=idx', '?act=idx', 'act=idx' ), '', $url );
				}
			}
			
			if ( $seoTemplate AND isset(self::$_seoTemplates[ $seoTemplate ]) )
			{
				$_template = $seoTemplate;
			}

			/* Need to search for one - fast? */
			if ( $_template === FALSE )
			{
				/* Search for one, then. Possibly a bit slower than we'd like! */
				foreach( self::$_seoTemplates as $key => $data )
				{
					if ( stristr( str_replace( ipsRegistry::$settings['board_url'], '', $url ), $key ) )
					{ 
						$_template = $key;
						break;
					}
				}
			}

			/* Got one to work with? */
			if ( $_template !== FALSE )
			{
				if ( substr( $seoTitle, 0, 2 ) == '%%' AND substr( $seoTitle, -2 ) == '%%' )
				{
					$seoTitle = IPSText::makeSeoTitle( substr( $seoTitle, 2, -2 ) );
				}
				
				/* Do we need to encode? */
				if ( IPS_DOC_CHAR_SET != 'UTF-8' )
				{
					$seoTitle = urlencode( $seoTitle );
				}
				
				$replace    = str_replace( '#{__title__}', $seoTitle, self::$_seoTemplates[ $_template ]['out'][1] );
				
				$url     = preg_replace( self::$_seoTemplates[ $_template ]['out'][0], $replace, $url );
				$_anchor = '';
				$__url   = $url;

				/* Protect html entities */
				$url = preg_replace( '/&#(\d)/', "~|~\\1", $url );

				if ( strstr( $url, '&' ) )
				{
					$restUrl = substr( $url, strpos( $url, '&' ) );

					$url     = substr( $url, 0, strpos( $url, '&' ) );
				}
				else
				{
					$restUrl = '';
				}

				/* Anchor */
				if ( strstr( $restUrl, '#' ) )
				{
					$_anchor = substr( $restUrl, strpos( $restUrl, '#' ) );
					$restUrl = substr( $restUrl, 0, strpos( $restUrl, '#' ) );
				}

				switch ( ipsRegistry::$settings['url_type'] )
				{
					case 'path_info':
						if ( ipsRegistry::$settings['htaccess_mod_rewrite'] )
						{
							$url = str_replace( IPS_PUBLIC_SCRIPT . '?', '', $url );
						}
						else
						{
							$url = str_replace( IPS_PUBLIC_SCRIPT . '?', IPS_PUBLIC_SCRIPT . '/', $url );
						}
					break;
					default:
					case 'query_string':
						$url = str_replace( IPS_PUBLIC_SCRIPT . '?', IPS_PUBLIC_SCRIPT . '?/', $url );
					break;
				}

				/* Ensure that if the seoTitle is missing there is no double slash */
				# http://localhost/invisionboard3/user/1//
				# http://localhost/invisionboard3/user/1/mattm/
				if ( substr( $url, -2 ) == '//' )
				{
					$url = substr( $url, 0, -1 );
				}

				/* Others... */
				if ( $restUrl )
				{
					$_url  = str_replace( '&amp;', '&', str_replace( '?', '', $restUrl ) );
					$_data = explode( "&", $_url );
					$_add  = array();
				
					foreach( $_data as $k )
					{
						if ( strstr( $k, '=' ) )
						{
							list( $kk, $vv ) = explode( '=', $k );
						
							if ( $kk and $vv )
							{
								$_add[] = $kk . self::$_seoTemplates['__data__']['varSep'] . $vv;
							}
						}
					} 
						
					/* Got anything to add?... */
					if ( count( $_add ) )
					{
						if ( strrpos( $url, self::$_seoTemplates['__data__']['end'] ) + strlen( self::$_seoTemplates['__data__']['end'] ) == strlen( $url ) )
						{
							$url = substr( $url, 0, -1 );
						}

						$url .= self::$_seoTemplates['__data__']['varBlock'] . implode( self::$_seoTemplates['__data__']['varSep'], $_add );
					}
				}

				/* anchor? */
				if ( $_anchor )
				{
					$url .= $_anchor;
				}

				/* Protect html entities */
				$url = str_replace( '~|~', '&#', $url );

				return $url;
			} # / template
		}
			
		return $url;
	}
	
	protected static function prepare($url, $urlBase)
	{
		$base = '';

		if($urlBase)
		{
			switch($urlBase)
			{
				default:
				case 'none':
					$base = '';
				break;
				case 'public':
					if ( IN_ACP )
					{
						$base = ipsRegistry::$settings['public_url'];
					}
					else
					{
						$base = ipsRegistry::$settings['base_url'];
					}
				break;
				case 'publicWithApp':
					$base = ipsRegistry::$settings['base_url_with_app'];
				break;
				case 'publicNoSession':
					$base = ipsRegistry::$settings['_original_base_url'].'/index.'.ipsRegistry::$settings['php_ext'] . '?';
				break;
				case 'admin':
					$base = ipsRegistry::$settings['base_url'];
				break;
				case 'https':
					$base = str_replace( 'http://', 'https://', ipsRegistry::$settings['base_url'] );
				break;
			}
		}
		
		return $base . $url;
	}
}