(function ( $ ) {
	"use strict";

	$(function () {
	    // Datepicker
        $('.lead_shell input[name="fromDate"]').datepicker();
        $('.lead_shell input[name="toDate"]').datepicker();
	
	
        $('#tblBuilders tbody tr').click(function() {
            window.location = document.URL+'&single='+$(this).attr('name'); 
        });
		// Place your administration-specific JavaScript here

	});

}(jQuery));