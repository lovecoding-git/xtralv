/************************************************/
/* IPB3 Javascript								*/
/* -------------------------------------------- */
/* ips.gallery.js - Gallery javascript			*/
/* (c) IPS, Inc 2008							*/
/* -------------------------------------------- */
/* Author: Rikki Tissier & Brandon Farber		*/
/************************************************/

/* Hack to get lastDescendant
	Thanks: http://proto-scripty.wikidot.com/prototype:tip-getting-last-descendant-of-an-element
*/
Element.addMethods({
    lastDescendant: function(element) {
        element = $(element).lastChild;
        while (element && element.nodeType != 1) 
            element = element.previousSibling;
        return $(element);
    }
});

/**
* Returns the value of the selected radio button in the radio group, null if
* none are selected, and false if the button group doesn't exist
* @link  http://xavisys.com/using-prototype-javascript-to-get-the-value-of-a-radio-group/
*
* @param {radio Object} or {radio id} el
* OR
* @param {form Object} or {form id} el
* @param {radio group name} radioGroup
*/
function $RF(el, radioGroup) {
    if($(el).type && $(el).type.toLowerCase() == 'radio') {
        var radioGroup = $(el).name;
        var el = $(el).form;
    } else if ($(el).tagName.toLowerCase() != 'form') {
        return false;
    }

    var checked = $(el).getInputs('radio', radioGroup).find(
        function(re) {return re.checked;}
    );
    return (checked) ? $F(checked) : null;
}


var _gallery = window.IPBoard;

_gallery.prototype.gallery = {
	
	totalChecked:	0,
	inSection: '',
	maps: [],
	latLon: null,
	popups: [],
	popup: null,
	sAp: null,
	nAp: undefined,
	sApLn: 0,
	uhc: null,
	templates: {},
	contextMenu: false,
	isMedia: 0,
	mediaUpload: null,
	/*timer: [],
	blockSizes: [],*/
	
	/*------------------------------*/
	/* Constructor 					*/
	init: function()
	{
		Debug.write("Initializing ips.gallery.js");
		
		document.observe("dom:loaded", function(){
			/* Gallery meta popup */
			if ( $('meta-link') )
			{
				$('meta-link').observe('click', ipb.gallery.showMeta );
			}
			
			/* Add my map */
			if ( $('add_my_map') )
			{
				$('add_my_map').observe('click', ipb.gallery.addMap );
			}
			
			if ( $('map') )
			{
				ipb.gallery.initMaps();
			}
			
			/* Bog off mappy */
			if ( $('remove_my_map') )
			{
				$('remove_my_map').observe('click', ipb.gallery.removeMap );
			}
			
			/* Delete album */
			ipb.delegate.register('._albumDelete', ipb.gallery.albumDeleteDialogue );
			
			/* New label */
			$$('.hello_i_am_new').each( function (elem) { ipb.gallery.addNewSticker(elem); } );
			
			if ( ipb.gallery.inSection == 'image' )
			{
				if ( ! ipb.gallery.isMedia )
				{
					ipb.delegate.register('a[rel~=newwindow]', ipb.global.openNewWindow, { 'force': 1 } );
					ipb.delegate.register('a[rel~=popup]', ipb.gallery.openPopUp );
					
					if( $('show_filters') )
					{
						$('show_filters').observe('click', ipb.gallery.toggleFilters );
						$('filter_form').hide();
					}
					
					if( $('rotate_left') && $('rotate_right') )
					{
						$('rotate_left').observe('click', ipb.gallery.rotateImage.bindAsEventListener( this, 'left') );
						$('rotate_right').observe('click', ipb.gallery.rotateImage.bindAsEventListener( this, 'right') );
					}
					
					try
					{
						$('theImage').down('img').writeAttribute( 'alt', '' );
						$('theImage').down('img').writeAttribute( 'title', '' );
					}catch(e){}
					
					$('theImage').down('img').observe( 'contextmenu', ipb.gallery.imageContextMenu );
					$('theImage').down('img').observe( 'click', ipb.gallery.click );
				}
				
				if ( $('menu_image_edit') )
				{
					$('menu_image_edit').observe( 'click', ipb.gallery.editDialogue );
				}
				
				if ( $('menu_image_delete') )
				{
					$('menu_image_delete').observe( 'click', ipb.gallery.deleteDialogue );
				}
			}		
			
			/* Are we home sailor? */
			if ( $('home_side_recents') )
			{
				$$('.gallery_tiny_box').each( function(e)
				{
					if ( ! $(e).hasClassName('_image_pop') )
					{
						id = $(e).readAttribute( '-data-id' );
						
						if ( id )
						{
							var a = $(e).down('a');
							a.addClassName( '_hovertrigger' );
							a.writeAttribute("hovercard-ref", 'tinypicpop');
							a.writeAttribute("hovercard-id", id);							
						}
					}
				} );
				
				/* Set up cards */
				var ajaxUrl     = ipb.vars['base_url'] + '&app=gallery&module=ajax&secure_key=' + ipb.vars['secure_hash'] + '&section=image&do=imageDetail';
				ipb.hoverCardRegister.initialize( 'tinypicpop', { 'w': '320px', 'delay': 750, 'position': 'auto', 'ajaxUrl': ajaxUrl, 'black': true, 'getId': true, 'setIdParam': 'imageid' } );
			}
			
			/* Reset height */
			if ( $('gallery_main_parent') && $('content') )
			{
				/* Other stuff can manipulate document height such as comment entry */
				setTimeout( ipb.gallery.setHeight, 500 );
			}
		});
	},
	
	/**
	 * Launch album delete dialogue
	 */
	albumDeleteDialogue: function(e, elem)
	{
		Event.stop(e);

		albumId = elem.readAttribute('album-id');
		
		ipb.menus.closeAll(e);
		
		if ( ! Object.isUndefined( ipb.gallery.popups['deleteAlbum'] ) )
		{
			ipb.gallery.popups['deleteAlbum'].kill();
		}
		
		var _url  = ipb.vars['base_url'] + 'app=gallery&module=ajax&section=album&do=deleteDialogue&secure_key=' + ipb.vars['secure_hash'] + '&albumId=' + albumId;
		Debug.write( _url );
		
		/* easy one this... */
		ipb.gallery.popups['deleteAlbum'] = new ipb.Popup( 'deleteAlbum', { type: 'modal',
																            ajaxURL: _url,
																            stem: false,
																            hideAtStart: false,
																            warning: true,
																            w: '500px' } );						
		
	},
	
	/**
	 * Reset height
	 */
	setHeight: function()
	{
		var height = parseInt( $('gallery_main_parent').getStyle('height') );
		
		if ( height < 100 )
		{
			$('gallery_main_parent').setStyle( { height: $('content').getStyle('height') } );
		}
	},
	
	/**
	 * Adds the 'new' sticker
	 */
	addNewSticker: function( elem, e )
	{
		try
		{
			if ( elem.getStyle('textAlign') == 'center' )
			{
				return;
			}
			
			if ( elem.className.match( /cover_img_/ ) )
			{
				return;
			}
			
			_div = new Element('div', { className: 'image_is_new_box' } ).update('new');
			elem.insert( { before: _div } );			
			
			/* is the image padded? */
			padLeft  = parseInt( elem.getStyle('paddingLeft') );
			padTop   = parseInt( elem.getStyle('paddingTop') );
			marLeft  = parseInt( elem.getStyle('marginLeft') );
			marTop   = parseInt( elem.getStyle('marginTop') );
			bckTop   = parseInt( elem.getStyle('backgroundPositionX') );
			bckLeft  = parseInt( elem.getStyle('backgroundPositionY') );
							
			if ( padLeft || marLeft || bckLeft )
			{
				_div.setStyle( { marginLeft: ( (padLeft + marLeft + bckLeft) - 3 ) + 'px !important' } );
			}
			
			if ( padTop || marTop || bckTop )
			{
				_div.setStyle( { marginTop: ( (padTop + marTop + bckTop) - 3 ) + 'px !important' } );
			}
			
			elem.up('a').setStyle( { 'textDecoration': 'none' } );
		}
		catch(e){}
	},
	
	/**
	 * Init flash player
	 * 
	 */
	flashPlayerInit: function( file, flowplayerUrl )
	{
		$f("player", flowplayerUrl, { clip: { autoPlay: false, url: file, scaling: 'fit' } } );
	},
	
	/**
	 * Launch delete dialogue
	 */
	deleteDialogue: function(e)
	{
		Event.stop(e);
		
		ipb.menus.closeAll(e);
		
		if ( ! Object.isUndefined( ipb.gallery.popups['delete'] ) )
		{
			ipb.gallery.popups['delete'].show();
		}
		else
		{			
			/* easy one this... */
			ipb.gallery.popups['delete'] = new ipb.Popup( 'menuEdit', { type: 'modal',
															            initial: $('template_delete').innerHTML,
															            stem: false,
															            warning: true,
															            hideAtStart: false,
															            w: '300px' } );						
		}
	},
	
	/**
	 * Launch edit dialogue
	 */
	editDialogue: function(e)
	{
		Event.stop(e);
		
		ipb.menus.closeAll(e);
		
		if ( ! Object.isUndefined( ipb.gallery.popups['edit'] ) )
		{
			ipb.gallery.popups['edit'].show();
		}
		else
		{
			var _url  = ipb.vars['base_url'] + 'app=gallery&module=ajax&section=image&do=editDialogue&secure_key=' + ipb.vars['secure_hash'] + '&imageid=' + ipb.gallery.imageID;
			Debug.write( _url );
			
			/* easy one this... */
			ipb.gallery.popups['edit'] = new ipb.Popup( 'menuEdit', { type: 'pane',
															          ajaxURL: _url,
															          stem: true,
															          hideAtStart: false,
															          w: '500px' });
			
			ipb.delegate.register('._edsubmit', ipb.gallery.editSave );
		}
	},
	
	/**
	 * Save edit
	 */
	editSave: function(e)
	{
		var _url  = ipb.vars['base_url'] + '&app=gallery&module=ajax&section=image&do=editSave&secure_key=' + ipb.vars['secure_hash'] + '&imageid=' + ipb.gallery.imageID;
		Debug.write( _url );
		
		ipb.editors['description'].update_for_form_submit();
		
		var description = $F('description_textarea');
		var caption     = $F('form_caption');
	
		new Ajax.Request( _url,
							{
								method: 'post',
								evalJSON: 'force',
								parameters: { 'caption'     : caption,
										      'description' : description.encodeParam() },
								onSuccess: function(t)
								{										    	
									/* No Permission */
									if ( t.responseText == 'nopermission' )
									{
										alert( ipb.lang['no_permission'] );
									}
									else if ( t.responseJSON )
									{
										ipb.gallery.popups['edit'].hide();
										
										$('gallery_caption').update( t.responseJSON['caption'] );
										$('gallery_description').update( t.responseJSON['description'] );
									}
								}
							}						
						);	
	},
	
	/**
	 * Launch the lightbox
	 */
	click: function(e)
	{
		if ( $('ips_lightbox') )
		{
			if ( $('ips_lightbox').readAttribute('available') == 'true' )
			{
				/* Load JS which kick starts the revolution! */
				ipb.gallery_lightbox.launch();
			}
		}
	},
	
	/**
	 * Image Context Menu click
	 */
	imageContextMenu: function(e)
	{		
		if ( ! Event.isLeftClick(e) )
		{
			Event.stop(e);
			
			if ( ipb.gallery.contextMenu !== false )
			{
				ipb.gallery.contextMenu.kill();
			}
			
			ipb.gallery.contextMenu = new ipb.Popup( 'imcontextmenu', {  type: 'balloon',
																	     initial: $('template_sizes').innerHTML,
																	     stem: false,
																	     hideClose: true,
																	     hideAtStart: false,
																	     attach: { target: $('theImage'), position: 'auto' },
																	     w: '350px' });
			
			/* reposition */
			x = Event.pointerX(e);
			y = Event.pointerY(e);
			
			if ( x && y )
			{
				$('imcontextmenu_popup').setStyle( { 'position': 'absolute', 'left': x + 'px', 'top': y + 'px'} );
			}
			
		}
	},
	
	/**
	 * Init map
	 */
	initMaps: function()
	{
		if ( $('map_0') && $('map_1') && ipb.gallery.latLon )
		{
			$('map').appear();
			
			ipb.gallery.maps[0] = $('map_0').src;
			ipb.gallery.maps[1] = $('map_1').src;
			
			$('map_0').observe( 'mouseover', function(e) { $('map_0').src = ipb.gallery.maps[1]; } );
			$('map_0').observe( 'mouseout' , function(e) { $('map_0').src = ipb.gallery.maps[0]; } );
		}
	},
	
	/**
	 * Remove map from image
	 *
	 */
	removeMap: function(e)
	{
		Event.stop(e);
		
		var _url  = ipb.vars['base_url']+'app=gallery&module=ajax&section=image&do=removeMap&secure_key=' + ipb.vars['secure_hash'] + '&imageid=' + ipb.gallery.imageID;
		Debug.write( _url );
		
		new Ajax.Request( 
				_url,
				{
					method: 'get',
					evalJSON: 'force',
					onSuccess: function(t)
					{
						/* No Permission */
						if( Object.isUndefined( t.responseJSON ) )
						{
							alert( ipb.lang['action_failed'] );
							return;
						}
						else if ( t.responseJSON['error'] )
						{
							alert( ipb.lang['no_permission'] );
						}
						else
						{
							if ( t.responseJSON['done'] )
							{
								/* Remove stuff */
								$$('.__mapon').each( function(elem)
								{
									elem.fade();
									
								} );
							
							}
						}
					}
				}						
			);				
	},
	
	/**
	 * Add map to image
	 *
	 */
	addMap: function(e)
	{
		Event.stop(e);
		
		var _url  = ipb.vars['base_url']+'app=gallery&module=ajax&section=image&do=addMap&secure_key=' + ipb.vars['secure_hash'] + '&imageid=' + ipb.gallery.imageID;
		Debug.write( _url );
		
		new Ajax.Request( 
				_url,
				{
					method: 'get',
					evalJSON: 'force',
					onSuccess: function(t)
					{
						/* No Permission */
						if( Object.isUndefined( t.responseJSON ) )
						{
							alert( ipb.lang['action_failed'] );
							return;
						}
						else if ( t.responseJSON['error'] )
						{
							alert( ipb.lang['no_permission'] );
						}
						else
						{
							if ( t.responseJSON['latLon'] )
							{
								/* Set latlon */
								$$('.__mapoff').invoke('hide');
								ipb.gallery.latLon = t.responseJSON['latLon'];
								ipb.gallery.initMaps();								
							}
						}
					}
				}						
			);				
	},
	
	/**
	 * Sets up the semi-transparent description thingy
	 * @param id
	 * @returns
	 */
	registerDescription: function( id )
	{
		if( !$('image_wdesc_' + id) ){ return; }
		
		var img      = $('image_wdesc_' + id).down('img');
		var ahref    = $('image_wdesc_' + id).down('a');
		var desc     = $('image_wdesc_' + id + '_description' );
		var ofs      = img.cumulativeOffset();
		var dims     = img.getDimensions();
		
		/* Create new div with image as background */		
		var div = new Element( 'div', { 'id': '_newDiv_' + id, 'style': 'margin: 0 auto; height: ' + dims.height + 'px; width:' + dims.width + 'px; position: relative; background-image: url("' + img.src + '")' } );
		ahref.setStyle( { 'text-decoration': 'none' } );
		ahref.writeAttribute( 'title', '' );
		ahref.insert( div );
		
		$('_newDiv_' + id).insert( desc );
		
		var descDims = desc.getDimensions();
		
		/* Take off the padding */
		desc.setStyle( { 'width': descDims.width - 20 + 'px' } );
		
		/* Hide original image */
		img.hide();
		
		desc.hide();
		new Effect.Appear( desc, { duration: 1.5 } );
	},
	
	/**
	 * Generic new album select dialogue
	 *
	 */
	newAlbumDialogue: function(e, elem)
	{
		Event.stop(e);
		
		if ( ! Object.isUndefined( ipb.gallery.nAp ) )
		{
			ipb.gallery.nAp.kill();
		}
		
		/* Deletegate */
		ipb.delegate.register('._aSubmit', ipb.gallery.newAlbumSubmit );
		
		var popid = 'newAlbumDialogue';
		var _url  = ipb.vars['base_url']+'app=gallery&module=ajax&section=album&do=newAlbumDialogue&secure_key=' + ipb.vars['secure_hash'];
		Debug.write( _url );
		
		/* easy one this... */
		ipb.gallery.nAp = new ipb.Popup( popid, {  type: 'pane',
												   ajaxURL: _url,
												   stem: true,
												   hideAtStart: false,
												   w: '500px' });			
	},

	/**
	 * Generic new album select dialogue
	 *
	 */
	newAlbumSubmit: function(e, elem)
	{
		Event.stop(e);
		var post = {};
		
		/* Populate */
		post['album_name']        = $F('album_name');
		post['album_description'] = $F('album_description');
		post['album_parent_id']	  = $F('album_parent_id');
		post['album_is_public']   = $RF('album_is_public');		
		/* Close the pop-up */
		ipb.gallery.nAp.hide();
		
		var _url  = ipb.vars['base_url']+'app=gallery&module=ajax&section=album&do=newAlbumSubmit&secure_key=' + ipb.vars['secure_hash'];
		Debug.write( _url );
		
		new Ajax.Request( 
				_url,
				{
					method: 'post',
					parameters: post,
					evalJSON: 'force',
					onSuccess: function(t)
					{
						/* No Permission */
						if( Object.isUndefined( t.responseJSON ) )
						{
							alert( ipb.lang['action_failed'] );
							return;
						}
						else if ( t.responseJSON['error'] )
						{
							alert( t.responseJSON['error'] );
						}
						else
						{
							if ( t.responseJSON['album'] )
							{
								/* Set id */
								ipb.uploader.setCurrentAlbumId( t.responseJSON['album']['album_id'] );
								ipb.uploader.buildAlbumBox( t.responseJSON['album']['album_id'], albumTemplate, 'albumWrap' );								
							}
						}
					}
				}						
			);				
	},
	
	/**
	 * Generic album select pop-up
	 *
	 */
	selectAlbumDialogue: function( rootNodeId, method )
	{
		rootNodeId = ( rootNodeId ) ? rootNodeId : 0;
		url        = ipb.vars['base_url']+'app=gallery&module=ajax&section=album&do=albumSelector&secure_key=' + ipb.vars['secure_hash'] + '&rootNodeId=' + rootNodeId + '&method=' + method;
		Debug.write( url );
		if ( ipb.gallery.sAp && ( ipb.gallery.sApLn == rootNodeId ) )
		{
			ipb.gallery.sAp.show();
		}
		else
		{
			var content = '';
			
			/* Fetch JASON */
			new Ajax.Request( url,
			{
				method: 'post',
				evalJSON: 'force',
				onSuccess: function(t)
				{
					if( Object.isUndefined( t.responseJSON ) ){ alert( ipb.lang['action_failed'] ); return; }
					
					mine   = '';
					global = '';
					
					if ( t.responseJSON['mine'] )
					{
						$H( t.responseJSON['mine'] ).each( function( node ) {
							var _i    = node.key;
							var _node = node.value;
							 
							mine += ipb.gallery.templates['albumSelector-entry'].evaluate( { 'id': _node['album_id'], 'entry': _node['album_name'], 'thumb': _node['thumb'], 'comments': _node['album_count_comments'], 'imgs': _node['album_count_imgs'] } );
						} );
					}
					
					if ( t.responseJSON['global'] )
					{
						$H( t.responseJSON['global'] ).each( function( node ) {
							var _i    = node.key;
							var _node = node.value;
							
							global += ipb.gallery.templates['albumSelector-entry'].evaluate( { 'id': _node['album_id'], 'entry': _node['album_name'], 'thumb': _node['thumb'], 'comments': _node['album_count_comments'], 'imgs': _node['album_count_imgs'] } );
						} );
					}

					content = ipb.gallery.templates['albumSelector-wrap'].evaluate( { 'leftCol': mine, 'rightCol': global } );
					
					ipb.gallery.sAp = new ipb.Popup( 'showAlbums', { type: 'pane', modal: false, w: '600px', h: '500px', initial: content, hideAtStart: false, close: 'a[rel="close"]' } );
					
					/* Set up actually clicking */
					ipb.delegate.register('.gas_entry', ipb.gallery._selectAlbumClick );
				}
			});
		}
	},
	
	/**
	 * OMG u clicked it
	 */
	_selectAlbumClick: function(e)
	{
		var elem = Event.element(e);
		var cn   = elem.className;
		
		if ( ! cn.match( /gas_entry/ ) )
		{
			cn = elem.up('.gas_entry').className;
		}
		var _id = cn.match( /_rx(.+?)(\s|$)/ );
		
		if ( _id[1] )
		{
			/* Set id */
			ipb.uploader.setCurrentAlbumId( _id[1] );
			ipb.uploader.buildAlbumBox( _id[1], albumTemplate, 'albumWrap' );
			ipb.gallery.sAp.hide();
		}
	},
	
	/**
	 * Set up review page
	 */
	setUpReviewPage: function()
	{
		ipb.gallery.inUse = new Array();
		
		/* Set up rotate links */
		ipb.delegate.register('.rotate', ipb.gallery._rotate );
		
		/* Media add thumb */
		ipb.delegate.register( '.media_thumb_pop', ipb.gallery.mediaThumbPop );
		
		/* Set up text editors and other stuff */
		$$('._imgIds').each( function( id ) {
			_id = id.className.match( /_x(.+?)(\s|$)/ );
			
			if ( _id[1] )
			{
				Debug.write( "Set up editor for: " + _id[1] );
				
				editorMinimize('fast-reply-' + _id[1]);	
				
				try
				{
					if ( $('image_thumb_wrap_' + _id[1] ).down('.media_thumb_pop') )
					{
						if ( $('image_thumb_wrap_' + _id[1] ).down('.media_thumb_pop').readAttribute('media-has-thumb') == 'true' )
						{
							$('image_thumb_wrap_' + _id[1] ).down('.media_thumb_pop').value = "Remove Img";
						}
					}
				}
				catch(e){}
			}
		} );
	},
	
	mediaThumbPop: function(e)
	{
		var elem = Event.element(e);
		elem.identify();
		
		var mediaId  = elem.readAttribute('media-id');
		var hasThumb = elem.readAttribute('media-has-thumb');
		
		/* do we have a thumb? then if we clicked we want to remove */
		if ( hasThumb == 'true' )
		{ Debug.write( ipb.vars['base_url']+'app=gallery&module=post&section=image&do=removeUpload&type=mediaThumb&secure_key=' + ipb.vars['secure_hash'] + '&id=' + mediaId );
		
			new Ajax.Request( 
					ipb.vars['base_url']+'app=gallery&module=post&section=image&do=removeUpload&type=mediaThumb&secure_key=' + ipb.vars['secure_hash'] + '&id=' + mediaId,
					{
						method: 'post',
						onSuccess: function(t)
						{
							/* No Permission */
							if( Object.isUndefined( t.responseJSON ) )
							{
								alert( ipb.lang['action_failed'] );
								return;
							}
							else if ( t.responseJSON['error'] )
							{
								alert( t.responseJSON['error'] );
							}
							else
							{
								ipb.gallery._changeMediaThumb( t.responseJSON );
								$('image_thumb_wrap_' + t.responseJSON['id'] ).down('.media_thumb_pop').writeAttribute('media-has-thumb', 'false');
								$('image_thumb_wrap_' + t.responseJSON['id'] ).down('.media_thumb_pop').value = "Add Thumb";
							}
						}
					}						
				);	
		}
		else
		{
			if ( ! Object.isUndefined( ipb.gallery.popups['mediaPop-' + mediaId ] ) )
			{
				ipb.gallery.popups['mediaPop-' + mediaId ].kill();
			}
			
			ipb.gallery.popups['mediaPop-' + mediaId ] = new ipb.Popup( 'mediathumb', { type: 'pane',
																						modal: false,
																						w: '420px',
																						h: '300px',
																						initial: $('templates-mediaupload').innerHTML.replace( /\#\{id\}/g, mediaId ),
																						hideAtStart: false,
																						close: 'a[rel="close"]' } );
			
			ipb.gallery.mediaUpload = new ipb.mediaThumbUploader( mediaId, 'mediaUploader' );
		}
	},
	
	mediaThumbClose: function( json )
	{
		if ( ! Object.isUndefined( ipb.gallery.popups['mediaPop-' + json['id'] ] ) )
		{
			ipb.gallery.popups['mediaPop-' + json['id'] ].hide();
		}		
		
		if ( json && json['ok'] == 'done' && json['tag'] )
		{
			ipb.gallery._changeMediaThumb( json );
			$('image_thumb_wrap_' + json['id'] ).down('.media_thumb_pop').writeAttribute('media-has-thumb', 'true');
			$('image_thumb_wrap_' + json['id'] ).down('.media_thumb_pop').value = "Remove Img";
		}
	},
	
	_changeMediaThumb: function( json )
	{
		/* this is fugly as fug */
		if ( $('_tmp_xx_x') )
		{
			$('_tmp_xx_x').remove();
		}
		
		/* Cover your eyes now */
		div = new Element( 'div', { id: '_tmp_xx_x', style: 'display:none' } );
		$('postingform').insert( div );
		
		$('_tmp_xx_x').update( json['tag'] ).hide();
		
		$('image_thumb_wrap_' + json['id'] ).down('img').writeAttribute( 'src', $('_tmp_xx_x').down('img').readAttribute('src') );
		/* You can look again now */
	},
	
	toggleFilters: function(e)
	{
		if( $('filter_form') )
		{
			Effect.toggle( $('filter_form'), 'blind', {duration: 0.2} );
			Effect.toggle( $('show_filters'), 'blind', {duration: 0.2} );
		}
	},
	
	/**
	 * Pre rotate from delegate
	 */
	_rotate: function(e)
	{
		var elem = Event.element(e);
		var cn   = elem.className;
		
		if ( ! cn.match( /rotate/ ) )
		{
			cn = elem.up('.rotate').className;
		}
		var _id = cn.match( /_r(.+?)(\s|$)/ );
		
		if ( _id[1] )
		{
			ipb.gallery.imageID = _id[1];
			ipb.gallery.rotateImage(e, 'right' );
		}
	},
	
	rotateImage: function( e, dir )
	{
		//Debug.write( curnotes.size() );
		
		// If we have notes, just refresh
		//if( !Object.isUndefined( curnotes ) && curnotes.size() )
		//{
		//	return;
		//}
		
		Event.stop(e);
		if( ( dir != 'left' && dir != 'right' ) || !$('image_view_' + ipb.gallery.imageID) ){ return; }
		
		new Ajax.Request( 
							ipb.vars['base_url']+'app=gallery&module=ajax&section=image&do=rotate-' + dir + '&secure_key=' + ipb.vars['secure_hash'] + '&img=' + ipb.gallery.imageID,
							{
								method: 'post',
								onSuccess: function(t)
								{
									/* No Permission */
									if( t.responseText == 'nopermission' )
									{
										alert( ipb.lang['no_permission'] );
									}
									else if( t.responseText == 'rotate_failed' )
									{
										alert( ipb.lang['gallery_rotate_failed'] );
									}
									else
									{
										var rand = Math.round( Math.random() * 100000000 );
										var img = $('image_view_' + ipb.gallery.imageID);
										var tmpSrc = img.src;
										
										tmpSrc = tmpSrc.replace(/t=[0-9]+/, '');
										 
										$( img ).src = tmpSrc + "?t=" + rand;
									}
								}
							}						
						);	
		return false;
		
	},
	
	openPopUp: function(e, link)
	{		
		window.open(link.href, "image", "status=0,toolbar=0,location=0,menubar=0,directories=0,resizable=1,scrollbars=1");
		Event.stop(e);
		return false;
	},
	
	/**
	 * Show the meta information popup
	 */
	showMeta: function(e)
	{
		Event.stop(e);
		
		if( ipb.gallery.popup )
		{
			ipb.gallery.popup.show();
		}
		else
		{
			ipb.gallery.popup = new ipb.Popup( 'showmeta', { type: 'pane', modal: false, w: '600px', h: '500px', initial: $('metacontent').innerHTML, hideAtStart: false, close: 'a[rel="close"]' } );
		}
		
		return false;
	},

	
	/**
	 * Confirm they want to delete stuff
	 * 
	 * @var 	{event}		e	The event
	*/
	confirmSingleDelete: function(e, elem)
	{
		if( !confirm( ipb.lang['delete_post_confirm'] ) )
		{
			Event.stop(e);
		}
	},
	
	/**
	 * Check the files we've selected
	 */
	preCheckImages: function()
	{
		var topics = [];
		
		if( $('selectedimgids' ) ){
			topics = $F('selectedimgids').split(',');
		} 
		
		var checkboxesOnPage	= 0;
		var checkedOnPage		= 0;

		if( topics )
		{
			topics.each( function(check){
				if( check != '' )
				{
					if( $('img_' + check ) )
					{
						checkedOnPage++;
						$('img_' + check ).checked = true;
					}
					
					ipb.gallery.totalChecked++;
				}
			});
		}

		$$('.image_mod').each( function(check){
			checkboxesOnPage++;
		} );
		
		if( $('imgs_all') )
		{
			if( checkedOnPage == checkboxesOnPage )
			{
				$('imgs_all').checked = true;
			}
		}
		
		ipb.gallery.updateModButton();
	},
	
	/**
	 * Update the moderation button
	 */	
	updateModButton: function( )
	{
		if( $('mod_submit') )
		{
			if( ipb.gallery.totalChecked == 0 ){
				$('mod_submit').disabled = true;
			} else {
				$('mod_submit').disabled = false;
			}
		
			$('mod_submit').value = ipb.lang['with_selected'].replace('{num}', ipb.gallery.totalChecked);
		}
	},
	
	/**
	 * Check all the files in this form
	 */			
	checkAllInForm: function(e)
	{
		selectedTopics	= $F('selectedimgids').split(',').compact();
		remove			= new Array();
		
		check	= Event.findElement(e, 'input');
		toCheck	= $F(check);
		form	= check.up('form');
		
		form.select('.image_mod').each( function(check){
			if( toCheck != null )
			{
				selectedTopics.push( check.id.replace('img_', '') );
				check.checked = true;
			}
			else
			{
				remove.push( check.id.replace('img_', '') );
				check.checked = false;
			}
		});
		
		selectedTopics = selectedTopics.uniq().without( remove ).join(',');		
		ipb.Cookie.set('modimgids', selectedTopics, 0);
	}
};

ipb.gallery.init();

var _mtuploader = window.IPBoard;

_mtuploader.prototype.mediaThumbUploader = Class.create({
	options: [],
	boxes: [],
	json: {},
	
	initialize: function( id )
	{
		this.id = id;
		this.wrapper = 'mt_attachments_' + this.id;
		
		/* Build iframe */
		this.iframe = new Element('iframe', { 	id: 'media_thumb_iframe_' + this.id,
		 										name: 'media_thumb_iframe_' + this.id,
												scrolling: 'no',
												frameBorder: 'no',
												border: '0',
												className: '',
												allowTransparency: true,
												src: ipb.vars['base_url'] + 'app=gallery&module=post&section=image&do=upload&type=mediathumb&id=' + this.id,
												tabindex: '1'
											}).setStyle({
												width: '400px',
												height: '50px',
												overflow: 'hidden',
												backgroundColor: 'transparent'
											});
											
		$( this.wrapper ).insert( this.iframe ).addClassName('traditional');
		
		$('mt_add_files_' + this.id ).observe('click', this.processUpload.bindAsEventListener( this ) );
	},

	
	/**
	* Processes upload
	*/
	processUpload: function( e )
	{
		var iFrameBox  = window.frames[ 'media_thumb_iframe_' + this.id ].document.getElementById('mtiframeUploadBox');
		var iFrameForm = window.frames[ 'media_thumb_iframe_' + this.id ].document.getElementById('mtiframeUploadForm');
		
		iFrameForm.action = ipb.vars['base_url'] + 'app=gallery&module=post&section=image&do=uploadSave&type=mediathumb&id=' + this.id;
		
		iFrameForm.submit();
	},
	
	
	_setJSON: function( id, json )
	{
		Debug.dir( json );
		Debug.write( "ipb.uploader.js: Got JSON from the iFrame" );
		
		if ( json['error'] )
		{
			$('mtErrorBox_' + id).update( ipb.lang[ json['error'] ] );
			new Effect.Appear( $('mtErrorBox_' + id) );
		}
		else if ( json['ok'] && json['ok'] == 'done' )
		{
			ipb.gallery.mediaThumbClose( json );
		}
	}
});