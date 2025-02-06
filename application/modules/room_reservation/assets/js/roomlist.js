"use strict";
function Detail(id, value) {
    var dateTime = $("#date_time").val();
    if (id != "") {
        $("#list1").attr("hidden", false);
        $("#list3").attr("hidden", false);
        $("#list2").attr("hidden", true);
        $("#number").text(value);
        var roomno = value;
        var csrf = $('#csrf_token').val();
        var myurl = baseurl + "room_reservation/room_reservation/roomlistDetail";
        $.ajax({
            url: myurl,
            type: "POST",
            data: {
                csrf_test_name: csrf,
                datetime: dateTime,
                bookedid: id,
                roomno: roomno,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $("#checkin").text(obj.checkindate);
                $("#checkout").text(obj.checkoutdate);
                $("#customer").text(obj.firstname);
                $("#phone").text(obj.cust_phone);
                $("#address").text(obj.address);
                $("#room_type").text(obj.roomtype);
                $("#paid_amount").text(obj.paid_amount);
                $("#due_amount").text(obj.due_amount);
                $("#pstatus").text(obj.p_status);
                $("#bookedid").val(obj.bookedid);
                $("#roomno").val(roomno);
                $("#status").text($("#b_"+id).text());
                noteList(obj);
            }
        });
    } else {
        $("#number").text(value);
        $("#list2").attr("hidden", false);
        $("#list1").attr("hidden", true);
        $("#list3").attr("hidden", true);
        var csrf = $('#csrf_token').val();
        var myurl = baseurl + "room_reservation/room_reservation/roomNoDetail";
        $.ajax({
            url: myurl,
            type: "POST",
            data: {
                csrf_test_name: csrf,
                roomno: value,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $("#roomType").text(obj.roomtype);
                $("#rpd").text(obj.rate);
                $("#adults").text(obj.capacity);
                $("#extra").text(obj.exbedcapability == 1 ? "Yes" : "No");
                $("#rating").text(obj.number_of_star + " Star");
            }
        });
    }
}
$("#bookNow").on("click", function() {
    window.location.replace(baseurl + "room_reservation/checkin-list");
});

function showResult(search, str, str1, str2) {
    if ((search == null | search == "") & str == "" & str1 == "null" & str2 == "null") {
        document.getElementById("allRooms").innerHTML = "";
        return;
    }
    if(str1!="null" & str==""){
        swal({
            title: "Failed",
            text: "Search Date is required for Status",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("allRooms").innerHTML = this.responseText;
        }
    }
    if(str == ""){
        str=null;
    }
    xmlhttp.open("GET", baseurl + "room_reservation/room_reservation/searchResult/" + search + "/" + str + "/" + str1 + "/" + str2, true);
    xmlhttp.send();
}
"use strict";

function toastrErrorMsg(r) {
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 1500,
        };
        toastr.error(r);
    }, 1000);
}
// //            ========= its for toastr error message =============
"use strict";

function toastrSuccessMsg(r) {
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 1500,
        };
        toastr.success(r);
    }, 1000);
}
var note;
$("#save_note").on("click", function() {
    note = $("#problem_note").val();
    if (note == "") {
        swal({
            title: "Failed",
            text: "Note is required",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    var bookedid = $("#bookedid").val();
    var roomno = $("#roomno").val();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/saveNote";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            note: note,
            bookedid: bookedid,
            roomno: roomno,
        },
        success: function(data) {
            var obj = JSON.parse(data);
            var msg = obj.msg;
            if (msg.substr(4, 1) === "S") {
                $("#problem_note").val("");
                toastrSuccessMsg(msg);
                noteList(obj);
            } else
                toastrErrorMsg(msg);
            setTimeout(function() {}, 1000);
        }
    });
});
$("#solved").on("click", function() {
    var pl = document.getElementsByClassName("flat")
    var sl = "";
    for (var i = 0; i < pl.length; i++) {
        if ($('input.pnote_' + pl[i].value).is(':checked')) {
            var li = pl[i].value + ",";
            sl += "".concat(li.toString());
        }
    }
    if (sl == "") {
        swal({
            title: "Failed",
            text: "Check a problem first",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
    var bookedid = $("#bookedid").val();
    var roomno = $("#roomno").val();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/solveNote";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            id: sl,
            bookedid: bookedid,
            roomno: roomno,
        },
        success: function(data) {
            var obj = JSON.parse(data);
            var msg = obj.msg;
            if (msg.substr(4, 1) === "S") {
                $("#problem_note").val("");
                toastrSuccessMsg(msg);
                noteList(obj);
            } else
                toastrErrorMsg(msg);
            setTimeout(function() {}, 1000);
        }
    });
});
function noteList(obj){
    var allNote = obj.note;
    $("#problem_list").empty();
    $("#solved_list").empty()
    if (obj.note == "" | obj.note == null) {
        return false;
    }
    var plist = "";
    var slist = "";
    for (var i = 0; i < allNote.length; i++) {
        if (allNote[i].status == 0) {
            plist +=
                '<div class="i-check m-0 d-flex justify-content-around align-items-center">' +
                '<label class="mb-0" for="flat-checkbox-1">' + allNote[i].note +
                '</label>' +
                '<input tabindex="13" class="flat pnote_' + allNote[i].note_id +
                '" value="' + allNote[i].note_id +
                '" type="checkbox" id="flat-checkbox-1">' +
                '</div>';
        }
        if (allNote[i].status == 1) {
            slist += '<li>' + allNote[i].note + '</li>';
        }
    }
    $("#problem_list").append(plist);
    $("#solved_list").append(slist);
}
$(".scroll-bar").on("touchstart touchend", function() {
    $(this).toggleClass("scroll");
});