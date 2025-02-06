function starcheck(){
    'use strict';
    var star = $('#number_of_star').val();
   if(star > 5){
    swal({
        title: "Failed",
        text: "You Can not input More Than five Star",
        type: "error",
        confirmButtonColor: "#28a745",
        confirmButtonText: "Ok",
        closeOnConfirm: true
    });
    document.getElementById('number_of_star').value = '';
       }
   }