
$(document).ready(function() {

    var changedate = $('#changedate').val();
    var todaydate = $('#todaydate').val();
    var currentshift = $('#currentshift').val();
    if (changedate == todaydate) {
        $('.nav-link').removeClass("active");
        $('#pills-'+currentshift+'-tab').addClass("active");
        
    }
})