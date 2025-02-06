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
              $('[name="pos_id"]').val(data.job_adv_id);
              $('[name="pos_name"]').val(data.position_name);
        
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