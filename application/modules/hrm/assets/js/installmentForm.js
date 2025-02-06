'use strict';
var base =$('#base_url').val();
var csrf = $('#csrf_token').val();
function SelectToLoad(id){
    'use strict';
    //Ajax Load data from ajax
    $.ajax({
        url : base+'hrm/Loan/select_to_load/',
        method:'post',
       dataType:'json',
      data:{
            csrf_test_name: csrf,
            'employee_id':id,
         },
        success: function(data){
        document.getElementById("loan_id").innerHTML =data;
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
function SelectToname(id){
    'use strict';
    //Ajax Load data from ajax
    $.ajax({
        url : base+'hrm/Loan/select_to_install/' + id,
        type: "GET",
        dataType: "JSON",
        data:{csrf_test_name: csrf},
        success: function(data){
         $('[name="installment_amount"]').val(data.installment);
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

function SelectAuto(id){
    'use strict';
    //Ajax Load data from ajax
    $.ajax({
        url : base+'hrm/Loan/select_to_autoincrement/' + id,
        type: "GET",
        dataType: "JSON",
        data:{csrf_test_name: csrf},
        success: function(data){ 
            var installment=parseInt(data) +1;
            $('[name="installment_no"]').val(installment);
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
    $("#dayClose").trigger("click");
    $("#previous").on("click", function() {
        window.location.href=baseurl+"dashboard/home";
    });
    $("#date").datepicker({ dateFormat:'yy-mm-dd' });
    $("#end_date").datepicker({ dateFormat:'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate());
        $("#end_date").datepicker( "option", "minDate", minValue );
    })
});

    