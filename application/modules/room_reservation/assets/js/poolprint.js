$(document).ready(function() {
    "use strict";
    $('#printdatadiv').hide();
    $('#smpooldetails').hide();
});

 // select print button with class "print," then on click run callback function
$.print(".print-pool"); // inside callback function the section with class "content" will be printed