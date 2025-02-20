$(document).ready(function() {
    $('#printdatadiv').hide();
    $('#printdatadivfromlist').hide();
});

$('.poolprint-btn').on('click', function() { // select print button with class "print," then on click run callback function
$.print(".print-content"); // inside callback function the section with class "content" will be printed
});