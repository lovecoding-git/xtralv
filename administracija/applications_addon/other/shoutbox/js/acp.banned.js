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
		Debug.write("Initializing acp.banned.js");
		
		document.observe("dom:loaded", function(){
			if( $('banMemberName') )
			{
				ACPShoutbox.autoComplete = new ipb.Autocomplete( $('banMemberName'), { multibox: false, url: acp.autocompleteUrl, templates: { wrap: acp.autocompleteWrap, item: acp.autocompleteItem } } );
			}
		});
	}
};

ACPShoutbox.init();