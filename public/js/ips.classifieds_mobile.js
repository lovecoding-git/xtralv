document.observe("dom:loaded", function() 
{
	Event.observe($('cat-dropdown'), "click", toggleCatMenu);	
}
);


function toggleCatMenu()
{
	$('category_menu').setStyle( { 'width': '200px', 'display': 'inline' } );
}