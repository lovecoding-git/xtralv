/**
 * Product Title:		(SOS31) Similar Topics on Post Screen
 * Product Version:		1.0.0
 * Author:				Adriano Faria
 * Website:				SOS Invision
 * Website URL:			http://forum.sosinvision.com.br/
 * Email:				administracao@sosinvision.com.br
 */

var _similarTopics = window.IPBoard;

_similarTopics.prototype.similarTopics = {

	init: function()
	{
		Debug.write("Initializing ips.similarTopics.js");
		
		document.observe( "dom:loaded", function()
		{
			ipb.similarTopics.initEvents();
		});
	},

	initEvents: function()
	{
		if( $( 'topic_title' ) )
		{
			$( 'topic_title' ).observe( 'blur', ipb.similarTopics.checkSimilarTopics );
			
			$( 'topic_title' ).observe( 'focus', function(e)
			{
				if ( $( 'topicos_similares' ).visible() )
				{
					new Effect.BlindUp( 'topicos_similares', { duration: 0.2 } );
				}
				Event.stop( e );
			});
		}
	},

	checkSimilarTopics: function(e)
	{
		if( $F('topic_title').length >= 5 )
		{
			new Ajax.Request( ipb.vars['base_url'] + "app=forums&module=ajax&section=topics&do=similar&secure_key=" + ipb.vars['secure_hash'] + "&f="+ $F( document.getElementsByName( 'f' )[0] ) +"&title=" + $F( 'topic_title' ),
			{
				method: 'post',
				onSuccess: function(t)
				{
					if ( t.responseText != 'no_similares' )
					{
						$( 'topicos_similares' ).update( t.responseText );
						new Effect.BlindDown( 'topicos_similares', { duration: 0.5 } );
					}
				}
			});
		}
		
		Event.stop(e);
	}
}

ipb.similarTopics.init();
