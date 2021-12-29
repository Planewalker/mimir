if (! $.browser.msie) {
// Just don't do any of this if IE is involved. For the sanity of all.

$(document).ready(function()
{
    var target_boxes 	= "fwdc-collapse";           // Everything with this class
    var target_rail 	= "sidebar-right";           // Everything with this class
    var collapse_rail 	= "sidebar-right-collapse";  // Everything with this class
    var expand_rail 	= "sidebar-right-expand";    // Everything with this class

    // Click listener for boxes
    $(".fwdc-block-close").click(function() {
        var block_id = $(this).parent().parent().parent().parent().parent().parent().attr('id');
        $("#"+block_id+" div.content").toggle(300); // Hide or show the content box
        $.cookie(block_id, 'collapsed'); 			// Remember this setting
        return false;                               // Exit
    });

    // Click listener for right rail collapse
    $("."+collapse_rail).click(function() {
        $("#"+target_rail).hide(300); 				// Hide the rail 
        $.cookie(target_rail, 'collapsed');			// Remember this setting
        return false;                               // Exit
    });
	
    // Click listener for right rail expand
    $("."+expand_rail).click(function() {
        $("#"+target_rail).show(300); 				// Show the rail 
        $.cookie(target_rail, '');					// Remember this setting
        return false;                               // Exit
    });
	
    // Check initial block cookie settings on ready
    $("."+target_boxes).each(function(index) {   	// Loop through all target boxes
        var showBox = $.cookie($(this).attr('id')); // Get cookie value for this box
        if (showBox == 'collapsed') {              	// If supposed to be hidden then act
            $("#"+showBox+" div.content").hide();   // Hide the box
        }                                           // Else, do nothing
    });
	
    // Check initial rail cookie settings on ready
    var showRail = $.cookie(target_rail); 			// Get cookie value for this rail
    if (showRail == 'collapsed') {              		// If supposed to be hidden then act
        $("#"+target_rail).hide();  				// Hide the rail
    }                                           	// Else, do nothing
	
});
	
// End protection from IE insanity
}