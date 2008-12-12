jQuery.noConflict();

jQuery(document).ready(function() { 
    
    jQuery(".tablesorter").tablesorter({widgets: ['zebra'], widgetZebra: {css: ["row1","row2"]} });
    //.tablesorterPager({container: jQuery("#pager")}); 

	jQuery("#toggle_disabled_user").click(function() {
		jQuery(".user_disabled").toggle();
		jQuery(".tablesorter").trigger("update"); 
		return false;
	});


}); 
