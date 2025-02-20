$("#filter").on("click", function(){
    if($('#filter-form:visible').length){
        $("#filter-form").prop("hidden",true);
    }else{
        $("#filter-form").prop("hidden",false);
    }
});
function searchrecords(){
    'use strict';
    $('#hide_report').hide();
    $('#report_show').show();
    var csrf = $('#csrf_token').val();
    var geturl=$("#recordurl").val();
    var employee_id=$("#employee_id").val();
    var start_date=$("#start_date").val();
    var to_date=$("#to_date").val();
        $.ajax({
        type: "POST",
        url: geturl,
        data: {csrf_test_name:csrf, employee_id: employee_id, start_date: start_date, to_date: to_date},
        success: function(data) {
            $('#recordlist').html(data);
        } 
   });
   
   }
$('.print-btn').on('click', function() {
    $.print(".print-content");
});