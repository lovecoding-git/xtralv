ACPClassifieds = {
	
	/*------------------------------*/
	/* Constructor 					*/
	init: function()
	{
		Debug.write("Initializing acp.classifieds.js");
		
		document.observe("dom:loaded", function()
				{
					if ( ACPClassifieds.section == 'overview')
					{		
						ipb.delegate.register( 'a[progress~="rebuildimages"]', ACPClassifieds.launchRebuildImages );
						ipb.delegate.register( 'a[progress~="rebuildnodes"]', ACPClassifieds.launchRebuildNodes );						
					} else if (ACPClassifieds.section == 'managecats') {						
						ipb.delegate.register( 'a[progress~="rebuildnodes"]', ACPClassifieds.launchRebuildNodes );
					}
					
				});		
		
	},
	
	
	confirmEmpty: function( catid )
	{
		if( catid < 1 )
		{
			alert( "Category id missing" );
		}
		else
		{
			acp.confirmDelete( ipb.vars['app_url'].replace(/&amp;/g, '&' ) + 'module=manage&section=categories&do=doemptycat&cat=' + catid, "Are you sure you wish to empty this category? There will be no other confirmation screens, and you cannot undo this action!" );
		}
	},
	
	launchRebuildNodes: function( e, elem )
	{
		categoryId = elem.readAttribute( 'category-id' );
		url     = ipb.vars['base_url'].replace(/&amp;/g, '&') + 'app=classifieds&module=ajax&section=categories&do=rebuildNodes&secure_key=' + ipb.vars['md5_hash'] + '&categoryId=' + categoryId;
		
		/* Load our wrapper and I don't mean Eminem */
		cb = new IPBProgressBar( { title: 'Rebuilding Classified Categories',
								   total: null,
								   pergo: null,
								   ajaxUrl: url } );
		cb.show();
	},	
	launchRebuildImages: function( e, elem )
	{
		advertId = elem.readAttribute( 'advert-id' );
		url     = ipb.vars['base_url'].replace(/&amp;/g, '&') + 'app=classifieds&module=ajax&section=images&do=rebuildImages&secure_key=' + ipb.vars['md5_hash'] + '&advertId=' + advertId;
		
		/* Load our wrapper and I don't mean Eminem */
		cb = new IPBProgressBar( { title: 'Rebuilding Classified Images',
								   total: null,
								   pergo: null,
								   ajaxUrl: url } );
		cb.show();
	},		

};

ACPClassifieds.init();