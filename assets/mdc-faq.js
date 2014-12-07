$ = new jQuery.noConflict();
$(document).ready(function(){
	$( "#accordion" ).accordion(
		// header: "h3",
		// collapsible: true,
		heightStyle: "content"
		// navigation: true 
	);
});