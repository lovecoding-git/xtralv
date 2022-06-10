/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

ACPShoutbox = {
	// Constructor
	init: function()
	{
		Debug.write("Initializing acp.moderators.js");
		
		document.observe("dom:loaded", function(){
			if( $('m_mg_id') )
			{
				ACPShoutbox.autoComplete = new ipb.Autocomplete( $('m_mg_id'), { multibox: false, url: acp.autocompleteUrl, templates: { wrap: acp.autocompleteWrap, item: acp.autocompleteItem } } );
			}
		});
	}
};

ACPShoutbox.init();