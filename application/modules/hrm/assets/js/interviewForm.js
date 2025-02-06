$(document).ready(function(){ 
    'use strict';
    $('.txt').on('keyup', function(){
        var sum = 0;
        $(".txt").each(function() {
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
        });
        $("#total_marks").val(sum.toFixed());
    });

});



function SelectToLoad(id){
    'use strict';
    var base = $('#base_url').val();
    //Ajax Load data from ajax
    $.ajax({
        url : base+'hrm/Candidate_select/select_interviewlist/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
              $('[name="job_adv_id"]').val(data.job_adv_id);
              $('[name="interview_date"]').val(data.interview_date);
              $('[name="position_name"]').val(data.position_name);
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal({
                title: "Failed",
                text: "Error get data from ajax",
                type: "error",
                confirmButtonColor: "#28a745",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            });
        }
    });
}
    $(function(){
        'use strict';
        $("#end_date").datepicker({ dateFormat:'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate());
            $("#end_date").datepicker( "option", "minDate", minValue );
        })
    });
