function getroomtype() {
    "use strict";
    var base = $('#base_url').val();
    var id = $("#room_name").val();
    var status = $("#status").val();
    var csrf = $('#csrf_token').val();
    if (status) {
        var myurl = base + "house_keeping/house_keeping/getroomwithstatus" + '/' + id + '/' + status;
    } else {
        var myurl = base + "house_keeping/house_keeping/getroomwithstatus" + '/' + id;
    }
    var dataString = "id=" + id;
    $('#statusandroom').show();
    $.ajax({
        type: "POST",
        url: myurl,
        data: {
            csrf_test_name: csrf,
            dataString
        },
        success: function(data) {
            $('#statusandroom').html(data);
            $('[data-toggle="tooltip"]').tooltip();
            $('#allstatusandroom').hide();
            $('#statuswithroom').hide();
        }
    });
}

function getroomstatus() {
    "use strict";
    var base = $('#base_url').val();
    var id = $("#status").val();
    var roomname = $("#room_name").val();
    var csrf = $('#csrf_token').val();
    if (roomname) {
        var myurl = base + "house_keeping/house_keeping/getroomfromstatus" + '/' + id + '/' + roomname;
    } else {
        var myurl = base + "house_keeping/house_keeping/getroomfromstatus" + '/' + id;
    }
    var dataString = "id=" + id;
    $('#statuswithroom').show();
    $.ajax({
        type: "POST",
        url: myurl,
        data: {
            csrf_test_name: csrf,
            dataString
        },
        success: function(data) {
            $('#statuswithroom').html(data);
            $('[data-toggle="tooltip"]').tooltip();
            $('#allstatusandroom').hide();
            $('#statusandroom').hide();
        }
    });
}
"use strict";
$("#sbmit").prop("disabled", true);
var i = 0;
$("input[type='checkbox']").on("change", function() {
    if (this.checked) {
        i++;
    } else {
        i--;
    }
    if (i > 0) {
        $("#sbmit").prop('disabled', false);
    } else {
        $("#sbmit").prop("disabled", true);
    }
});
$("#sbmit").on("click", function(){
    var emp = $("#employee_id").find(":selected").val();
    if(emp == 0 | emp == ""){
        swal({
            title: "Failed",
            text: "House Keeper field is required",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
});