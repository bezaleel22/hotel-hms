function yearending(){
    "use strict";
    var finyear = $("#finyear").val();
    if(finyear<=0){
        swal({
            title: "Failed",
            text: "Please Create Financial Year First",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    swal({
        title: "Year Ending",
        text: "Are You Sure ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
    },
    function(isConfirm) {
        if (isConfirm) {
            var base = $('#base_url').val();
            var csrf = $('#csrf_token').val();
            var status = 1;
            $.ajax({
                type: "POST",
                url: base + "accounts/accounts/finyear_end",
                data: {
                    csrf_test_name: csrf,
                    status: status,
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    });
}