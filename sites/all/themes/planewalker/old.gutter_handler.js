if (! $.browser.msie) {
// Just don't do any of this if IE is involved. For the sanity of all.
$(document).ready(function()
{
  var target_boxes = "fwdc-collapse";           // Everything with this class
  var target_logos = "fwdc-collapse-logo";      // Everything with this class

    // Click listener for boxes
    $(".fwdc-block-close").click(function() {
        var logo = $(this).parent().parent().parent().parent().parent().parent().attr('id');
        logo = logo + '-logo';   // Get the logo ID
        $(this).parent().parent().parent().parent().parent().parent().slideToggle(300); // Hide the box
        $("#"+logo).slideToggle(50);                // Expose the logo
        $.cookie($(this).parent().parent().parent().parent().parent().parent().attr('id'), 'collapsed'); // Remember this

        var isAllHidden = 0;
        $("#sidebar-right-inner .block").each(function(index) {
            var thisDisplay = $(this).css('display');
            if( thisDisplay != 'none'){
                // Should only trigger once, for the one being closed on return.
                isAllHidden = isAllHidden + 1;
            }
        });
        if( isAllHidden == 1 ){
            $(".two-sidebars #content-inner").css('padding-right', '102px');  // Expand content
        } // Else do nothing    
        return false;                               // Exit
    });


    // Click listener for logos
    $("."+target_logos).click(function() {
        var cutoff = $(this).attr('id').length;     // Get the cutoff point
        cutoff = cutoff - 5;                        // Get the cutoff point
        var box = $(this).attr('id').substring(0, cutoff);  // Trim -logo off to get the actual block ID
        $(this).slideToggle(50);                    // Hide the logo
        $(".two-sidebars #content-inner").css('padding-right', '302px');  // Shrink content
        $("#"+box).slideToggle(300);                // Expose the box
        //$("#"+box).show();                          // Expose the box
        $.cookie(box, '');                          // Remember this
        return false;                               // Exit
    });

    // Check initial cookie settings on ready
    $("."+target_boxes).each(function(index) {   // Loop through all target boxes
        var showTop = $.cookie($(this).attr('id'));   // Get Cookie Value for this Box
        if (showTop == 'collapsed') {              // If supposed to be hidden then act
            var logo = $(this).attr('id');
            logo = logo + '-logo';                   // Get the logo ID    
            $(this).hide();                          // Hide the box
            $("#"+logo).show();                      // Expose the logo
        }                                          // Else, do nothing
    });
  
    var initAllHidden = 0;
    $("#sidebar-right-inner .block").each(function(index) {
        var thisDisplay = $(this).css('display');
        if( thisDisplay != 'none'){
            // Should only trigger once, for the one being closed on return.
            initAllHidden = initAllHidden + 1;
        }
    });
    if( initAllHidden == 0 ){
        $(".two-sidebars #content-inner").css('padding-right', '102px');  // Expand content
    } // Else do nothing    

});

}