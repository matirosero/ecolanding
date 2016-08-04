jQuery(document).ready(function($) {
    console.log( "first word!" );

    var ticky = $('#edd_free_download_optin');
    var button = $('.edd-free-download-submit');
    var msg = $('.free-download-terms');

    ticky.change(function() {
 		if($(this).is(':checked')){
        	console.log("CCCCheckeddddddd");
        	button.prop("disabled",false);
        	msg.removeClass('alert');

       	} else {
           	console.log("UNCheckeddddddd");
           	button.prop("disabled",true);
           	msg.addClass('alert');
		}    
    });
});