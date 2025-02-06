function IsEmail(email) {
    'use strict';
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function subscribeemail(){
    'use strict';
    var email=$("#youremail").val();
    if(email==''){
        swal({
            title: "Failed",
            text: "Please Enter Your email",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    if(!IsEmail(email)){
        swal({
            title: "Failed",
            text: "Please enter a valid Email",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    var baseurl = $('#base_url').val();
    var csrf = $('#csrf_token').val();
    var geturl=baseurl+'hotel/subscribe';
    if(IsEmail(email)){
        $("#youremail").val('');
    }
    $.ajax({
            type: "POST",
            url: geturl,
            data: {csrf_test_name: csrf, email: email},
            success: function(data) {
                if(data!=false){
                        swal({
                        title: "Success",
                        text: "Thanks for Subscription",
                        type: "success",
                        confirmButtonColor: "#28a745",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    });
                }else{
                    swal({
                        title: "Duplicate",
                        text: "You Already Subscribed",
                        type: "warning",
                        confirmButtonColor: "#28a745",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    });
                }
            } 
    });
    }
    "use strict";
function checkEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}
$("#emial").on("input", validateMSG);
"use strict";
function validateMSG(){
    var email = $("#emial").val();
    if(checkEmail(email)){
        $("#emial").removeClass("is-invalid");
        $("#emial").addClass("is-valid");
    }else{
        $("#emial").removeClass("is-valid");
        $("#emial").addClass("is-invalid");
    }
}	