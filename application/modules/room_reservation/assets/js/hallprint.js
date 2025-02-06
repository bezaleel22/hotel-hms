"use strict";
$(document).ready(function() {
    $('#printdatadiv').hide();
    $('#halldetails').hide();
});

 // select print button with class "print," then on click run callback function
$.print(".print-hallroom"); // inside callback function the section with class "content" will be printed