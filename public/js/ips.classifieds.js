var _idx = window.IPBoard;

_idx.prototype.classifieds = {
		totalChecked:		0,

	/*------------------------------*/
	/* Constructor 					*/
	init: function()
	{
		Debug.write("Initializing ips.classifieds.js");
		
		document.observe("dom:loaded", function(){
			
			ipb.classifieds.initEvents();
		});
	},
	
	/**
	 * Init events for cat listing
	 */
	initEvents: function()
	{
	
		ipb.classifieds.preCheckItems();
		ipb.delegate.register(".topic_mod", ipb.classifieds.checkItem );
		//ipb.delegate.register(".check_all", ipb.classifieds.checkAllInForm );
		//ipb.delegate.register(".delete_link", ipb.classifieds.checkConfirm );
		ipb.delegate.register(".topic_moderation", ipb.classifieds.checkModitem );

	},
	
	/**
	 * Confirmation for all delete links
	 */
	checkConfirm: function(e)
	{
		if( !confirm( ipb.lang['delete_confirm'] ) )
		{
			Event.stop(e);
		}
	},
	
	/**
	 * Moderator submitting the mod form
	 */
	submitModForm: function(e)
	{
		var action = $( Event.findElement(e, 'form') ).down('select');
		
		// Check for delete action
		if( $F(action) == 'del' ){
			if( !confirm( ipb.lang['delete_confirm'] ) ){
				Event.stop(e);
			}
		}
	},
	

	
	/**
	 * Toggling the filters
	
	toggleFilters: function(e)
	{
		if( $('filter_form') )
		{
			Effect.toggle( $('filter_form'), 'blind', {duration: 0.2} );
			Effect.toggle( $('show_filters'), 'blind', {duration: 0.2} );
		}
	}, */
	
	/**
	 * Check the items we've selected
	 */
	preCheckItems: function()
	{
		
		topics = $F('selecteditemids').split(',');
		
		var checkboxesOnPage	= 0;
		var checkedOnPage		= 0;

		if( topics )
		{
			topics.each( function(check){
				if( check != '' )
				{
					if( $('item_' + check ) )
					{
						checkedOnPage++;
						$('item_' + check ).checked = true;
					}
					
					ipb.classifieds.totalChecked++;
				}
			});
		}

		$$('.topic_mod').each( function(check){
			checkboxesOnPage++;
		} );
		
		if( checkedOnPage == checkboxesOnPage && checkboxesOnPage > 0 )
		{
			$('items_all').checked = true;
		}
		
		ipb.classifieds.updateItemModButton();
	},	
	
	/**
	 * Check all the items in this form
	 */			
	checkAllInForm: function(e, elem)
	{
		checked	= 0;
		check	= elem; /*Event.findElement(e, 'input');*/
		toCheck	= $F(check);
		form	= check.up('form');
		selectedTopics	= new Array;
		
		form.select('.selecteditemids').each( function(field){
			selectedTopics	= field.value.split(',').compact();
		});
		
		toRemove		= new Array();

		form.select('.topic_moderation').each( function(check){
			if( toCheck != null )
			{
				check.checked = true;
				selectedTopics.push( check.id.replace('item_', '') );
				checked++;
			}
			else
			{
				check.checked = false;
				toRemove.push( check.id.replace('item_', '') );
			}
		});
		
		selectedTopics = selectedTopics.uniq().without( toRemove ).join(',');

		form.select('.submit_button').each( function(button)
		{
			if( checked == 0 ){
				button.disabled = true;
			} else {
				button.disabled = false;
			}
		
			button.value = ipb.lang['with_selected'].replace('{num}', checked);
		});
		
		form.select('.selecteditemids').each( function(hidden)
		{
			hidden.value = selectedTopics;
		});
	},
	
	/**
	 * Check a item on the moderation form
	 */			
	checkModitem: function(e, elem)
	{
		check			= elem; /*Event.findElement(e, 'input');*/
		toCheck			= $(check);
		form			= check.up('form');
		selectedTopics	= new Array;
		
		var checkboxesOnPage	= 0;
		var checkedOnPage		= 0;
		
		form.select('.selecteditemids').each( function(field){
			selectedTopics	= field.value.split(',').compact();
		});
		remove			= new Array();

		form.select('.topic_moderation').each( function(check){
			checkboxesOnPage++;
			
			if( check.checked == true )
			{
				checkedOnPage++;
				selectedTopics.push( check.id.replace('item_', '') );
			}
			else
			{
				remove.push( check.id.replace('item_', '') );
				form.select('.check_all')[0].checked = false;
			}
		} );
		
		if( checkedOnPage == checkboxesOnPage )
		{
			form.select('.check_all')[0].checked = true;
		}

		selectedTopics = selectedTopics.uniq().without( remove ).join(',');

		form.select('.submit_button').each( function(button)
		{
			if( checkedOnPage == 0 ){
				button.disabled = true;
			} else {
				button.disabled = false;
			}
		
			button.value = ipb.lang['with_selected'].replace('{num}', checkedOnPage);
		});
		
		form.select('.selecteditemids').each( function(hidden)
		{
			hidden.value = selectedTopics;
		});
	},
	
	/**
	 * Check all the items
	 */			
	checkAllItems: function(e)
	{
		check = Event.findElement(e, 'input');
		toCheck = $F(check);
		ipb.classifieds.totalChecked = 0;
		toRemove = new Array();
		selectedTopics = $F('selecteditemids').split(',').compact();

		$$('.topic_mod').each( function(check){
			if( toCheck != null )
			{
				check.checked = true;
				selectedTopics.push( check.id.replace('item_', '') );
				ipb.classifieds.totalChecked++;
			}
			else
			{
				toRemove.push( check.id.replace('item_', '') );
				check.checked = false;
			}
		});

		selectedTopics = selectedTopics.uniq().without( toRemove ).join(',');
		ipb.Cookie.set('moditemids', selectedTopics, 0);

		$('selecteditemids').value = selectedTopics;
		
		ipb.classifieds.updateItemModButton();
	},
	
	/**
	 * Check a single item
	 */	
	checkItem: function(e, elem)
	{
		remove = new Array();
		check = elem; /*Event.findElement( e, 'input' );*/
		selectedTopics = $F('selecteditemids').split(',').compact();
		
		var checkboxesOnPage	= 0;
		var checkedOnPage		= 0;
		
		if( check.checked == true )
		{
			selectedTopics.push( check.id.replace('item_', '') );
			ipb.classifieds.totalChecked++;
		}
		else
		{
			remove.push( check.id.replace('item_', '') );
			ipb.classifieds.totalChecked--;
		}
		
		$$('.topic_mod').each( function(check){
			checkboxesOnPage++;
			
			if( $(check).checked == true )
			{
				checkedOnPage++;
			}
		} );
		
		if( $('items_all' ) )
		{
			if( checkedOnPage == checkboxesOnPage )
			{
				$('items_all' ).checked = true;
			}
			else
			{
				$('items_all' ).checked = false;
			}
		}
		
		selectedTopics = selectedTopics.uniq().without( remove ).join(',');		
		ipb.Cookie.set('moditemids', selectedTopics, 0);
		
		$('selecteditemids').value = selectedTopics;

		ipb.classifieds.updateItemModButton();		
	},
	
	/**
	 * Update the moderation button
	 */	
	updateItemModButton: function( )
	{
		if( $('mod_submit') )
		{
			if( ipb.classifieds.totalChecked == 0 ){
				$('mod_submit').disabled = true;
			} else {
				$('mod_submit').disabled = false;
			}
		
			$('mod_submit').value = ipb.lang['with_selected'].replace('{num}', ipb.classifieds.totalChecked);
		}
	}
};

ipb.classifieds.init();