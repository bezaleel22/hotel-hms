"use strict";
function starcheck(){
    var star = $("#number_of_star").val();
    var editstar = $("#nos").val();
    if(star > 5){
        swal({
            title: "Failed",
            text: "You Can not input More Than five Star",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
    $("#number_of_star").val('');
}
    if(editstar > 5){
        swal({
            title: "Failed",
            text: "You Can not input More Than five Star",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
    $("#nos").val('');
    }
}