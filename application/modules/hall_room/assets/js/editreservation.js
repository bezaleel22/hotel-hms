function getbsource() {
    'use strict';
    var booking_type = $("#booking_type").find(":selected").text();
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "hall_room/hallroom/bookingSource";
    if ($('#booking_source')[0].options.length > 1)
        $('#booking_source').find('option').not(':first').remove();
    $("#commissionrate").val('');
    $("#commissionamount").val('');
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            booking_type: booking_type
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $.each(obj, function(key, value) {
                for (var i = 0; i < value.length; i++) {
                    $('#booking_source').append('<option value="' + value[i].btypeinfoid +
                        '">' +
                        value[i].booking_sourse + '</option>');
                }
            });
            $('.selectpicker').selectpicker('refresh');
        }
    });
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

"use strict";
$("#existmobile").on("keyup", function() {
    var search = $(this).val();
    $("#addoldcustomer").attr("disabled", true);
    $("#existcustid").val("");
    $("#existname").val("");
    $("#existmobile").removeClass("is-valid");
    if (search != "") {
        var csrf = $('#csrf_token').val();
        var myurl = baseurl + "hall_room/hallroom/existcustomer";
        $.ajax({
            url: myurl,
            type: 'post',
            data: {
                csrf_test_name: csrf,
                search: search,
                type: 1
            },
            dataType: 'json',
            success: function(response) {
                var len = response.user.length;
                if (response.user != "Not found") {
                    $("#searchResult").empty();
                    for (var i = 0; i < len; i++) {
                        var mobile = response.user[i].cust_phone;;
                        var name = response.user[i].firstname;
                        $("#searchResult").append("<li value=" + mobile + ">" + mobile + '-' +
                            name + "</li>");
                    }
                    // binding click event to li
                    $("#searchResult li").bind("click", function() {
                        existuser(this);
                    });
                }
            }
        });
    } else {
        $("#searchResult").empty();
        $("#existcustid").val("");
        $("#existmobile").val("");
        $("#existname").val("");
        $("#existmobile").removeClass("is-valid");
    }
});

function existuser(value) {
    $("#existmobile").removeClass("is-valid").removeClass("is-invalid");
    var num = $(value).text();
    var existmobile = num.split("-")[0];
    $("#existmobile").val(existmobile);
    $("#searchResult").empty();
    if (existmobile == "") {
        $("#existmobile").addClass("is-invalid");
        return false;
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "hall_room/hallroom/existcustomer";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            existmobile: existmobile,
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#existname").val(obj.user);
            if (obj.existuser == 1) {
                $("#existmobile").addClass("is-valid")
                $("#existmobile").val(existmobile);
                $("#existcustid").val(obj.userid);
                $("#addoldcustomer").attr("disabled", false);
            } else {
                $("#existmobile").addClass("is-invalid")
                $("#existcustid").val("");
                $("#existmobile").val("");
                $("#addoldcustomer").attr("disabled", true);
            }
        }
    });
}
$("#mobileNo").on('keyup', mobilenocheck);
$("#mobileNo").on('change', mobilenocheck);

function mobilenocheck() {
    "use strict";
    var mobileno = $("#mobileNo").val();
    if (mobileno) {
        var csrf = $('#csrf_token').val();
        var myurl = baseurl + "hall_room/hallroom/mobilenocheck";
        $.ajax({
            url: myurl,
            type: "POST",
            data: {
                csrf_test_name: csrf,
                mobileno: mobileno,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.existuser == 1) {
                    $("#mobileNo").addClass("is-invalid");
                    $("#addcustomer").attr("hidden", true);
                } else {
                    $("#mobileNo").removeClass("is-invalid");
                    $("#addcustomer").attr("hidden", false);
                }
            }
        });
    } else {
        $("#mobileNo").removeClass("is-invalid");
        $("#addcustomer").attr("hidden", false);
    }
}
var pmode = $("#paymentmode").find(":selected").val();
if (pmode != "Bank Payment") {
    $("#advanceamount").attr("disabled", false);
}

function newBooking() {
    'use strict';
    var finyear = $("#finyear").val();
    if (finyear <= 0) {
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
    $("#msg").text("");
    $("#msg1").text("");
    var datefilter1 = $("#datefilter1").val();
    if (datefilter1 == "") {
        $("#datefilter1").addClass("is-invalid");
        return false;
    }
    var datefilter2 = $("#datefilter2").val();
    if (datefilter2 == "") {
        $("#datefilter2").addClass("is-invalid");
        return false;
    }
    if (datefilter2 <= datefilter1) {
        $("#msg").text("End field can not equal or smaller than Start field");
        $("#datefilter1").addClass("is-invalid");
        $("#datefilter2").addClass("is-invalid");
        return false;
    }
    //Event name & type
    var event_name = $("#event_name").val();
    if (event_name == "") {
        $("#event_name").addClass("is-invalid");
        return false;
    }else{
        $("#event_name").removeClass("is-invalid");
    }
    var event_type = $("#event_type").val();
    if (event_type == "") {
        $("#event_type").addClass("is-invalid");
        return false;
    }else{
        $("#event_type").removeClass("is-invalid");
    }
    //roomdetails
    var all = $("table.room-list > tbody").length;
    var room_type = $('#room_type').find(":selected").val();
    if (room_type == null) {
        room_type = $('#room_type-1').find(":selected").val();
    }
    for (var s = 0; s < all - 1; s++) {
        room_type += ",".concat($("#room_type" + s).val());
    }
    if (room_type == "") {
        $("#room_type").addClass("is-invalid");
        return false;
    }
    var roomno = $('#roomno').find(":selected").val();
    if (roomno == null) {
        roomno = $('#roomno-1').find(":selected").val();
    }
    for (var s = 0; s < all - 1; s++) {
        roomno += ",".concat($("#roomno" + s).val());
    }
    if (roomno == "") {
        $("#roomno").addClass("is-invalid");
        return false;
    }
    var adults = $("#adults").val();
    if (adults == null) {
        adults = $("#adults-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        adults += ",".concat($("#adults" + s).val());
    }
    if (adults == "") {
        $("#adults").addClass("is-invalid");
        return false;
    }
    var diff = Math.ceil((Date.parse(datefilter2) - Date.parse(datefilter1)) / 86400000);
    var rentval = parseFloat($("#rent").val());
    var rent = rentval / parseFloat(diff);
    if (rent == null | isNaN(rent)) {
        var rentval = parseFloat($("#rent-1").val());
        var rent = rentval / parseFloat(diff);
    }
    for (var s = 0; s < all - 1; s++) {
        var rentval = parseFloat($("#rent" + s).val());
        var rentdiv = rentval / parseFloat(diff);
        rent += ",".concat(rentdiv);
    }
    var seatplan = $("#seatplan").val();
    if (seatplan == null) {
        seatplan = $("#seatplan-1").val();
    }
    for (var s = 0; s < all - 1; s++) {
        seatplan += ",".concat($("#seatplan" + s).val());
    }
    var offer_price = $("#offer_price").text();
    if (offer_price == null) {
        offer_price = $("#offer_price-1").text();
    }
    if (offer_price == '') {
        offer_price = 0;
    }
    for (var s = 0; s < all - 1; s++) {
        offer_price += ",".concat(($("#offer_price" + s).text() ? $("#offer_price" + s).text() : 0));
    }
    //end
    var name = $("#alluser").val();
    var userid = $("#alluserid").val();
    if (name == "") {
        var tc = $("table.customerdetail-1 tbody tr").length;
        var newname = $("#username0").text();
        var newuserid = $("#userid0").text();
        for (var s = 1; s < tc; s++) {
            newname += ",".concat($("#username" + s).text());
            newuserid += ",".concat($("#userid" + s).text());
        }
        if (name.length < newname.length) {
            name = $.trim(newname.replace(/\s+/g, " "));
            userid = $.trim(newuserid.replace(/\s+/g, " "));
        }
    }
    //reservation details
    var event_name = $("#event_name").val();
    var event_type = $("#event_type").val();
    var booking_remarks = $("#booking_remarks").val();
    var checkinbookedid = $("#checkinbookedid").val();
    //user details
    var email = $("#allemail").val();
    var mobile = $("#allmobile").val();
    var lastname = $("#alllastname").val();
    var gender = $("#allgender").val();
    var father = $("#allfather").val();
    var occupation = $("#alloccupation").val();
    var dob = $("#alldob").val();
    var anniversary = $("#allanniversary").val();
    var pitype = $("#allpitype").val();
    var pid = $("#allpid").val();
    var imgfront = $("#allimgfront").val();
    var imgback = $("#allimgback").val();
    var imgguest = $("#allimgguest").val();
    var contacttype = $("#allcontacttype").val();
    var state = $("#allstate").val();
    var city = $("#allcity").val();
    var zipcode = $("#allzipcode").val();
    var address = $("#alladdress").val();
    var country = $("#allcountry").val();
    //payment details
    var discountreason = $("#discountreason").val();
    var discountamount = $("#discountamount").val();
    var commissionrate = $("#commissionrate").val();
    var commissionamount = $("#commissionamount").val();
    var paymentmode = $("#paymentmode").find(":selected").val();
    $("#paymentmode").parent().removeClass("is-invalid");
    if (paymentmode == "Bank Payment") {
        if ($("#cardno").val() == "") {
            $("#cardno").addClass("is-invalid");
            return false;
        } else if ($("#bankname").find(":selected").val() == "") {
            $("#cardno").removeClass("is-invalid");
            $("#bankname").parent().addClass("is-invalid");
            return false;
        } else {
            $("#cardno").removeClass("is-invalid");
            $("#bankname").parent().removeClass("is-invalid");
        }
    }else{
        if($("#advanceamount").val()>0 & paymentmode==""){
            $("#paymentmode").removeClass("is-invalid");
            return false;
        }
    }
    var bankname = $("#bankname").find(":selected").val();
    var cardno = $("#cardno").val();
    var advanceamount = $("#advanceamount").val();
    var advanceremarks = $("#advanceremarks").val();
    var bookingid = $("#bookingid").val();
    
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "hall_room/hallroom/newBooking";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            event_name: event_name,
            event_type: event_type,
            booking_remarks: booking_remarks,
            datefilter1: datefilter1,
            datefilter2: datefilter2,
            room_type: room_type,
            roomno: roomno,
            adults: adults,
            rent: rent,
            discount_price: offer_price,
            seatplan: seatplan,
            checkinbookedid: checkinbookedid,
            userid: userid,
            name: name,
            mobile: mobile,
            email: email,
            lastname: lastname,
            gender: gender,
            father: father,
            occupation: occupation,
            dob: dob,
            anniversary: anniversary,
            pitype: pitype,
            pid: pid,
            imgfront: imgfront,
            imgback: imgback,
            imgguest: imgguest,
            contacttype: contacttype,
            state: state,
            city: city,
            zipcode: zipcode,
            address: address,
            country: country,
            discountreason: discountreason,
            discountamount: discountamount,
            commissionrate: commissionrate,
            commissionamount: commissionamount,
            paymentmode: paymentmode,
            bankname: bankname,
            cardno: cardno,
            advanceamount: advanceamount,
            advanceremarks: advanceremarks,
            bookingid: bookingid
        },
        success: function(data) {
            if (data.substr(4, 1) === "S") {
                $("#booking_list").show();
                $("#checkin_list").show();
                $("#reservation").hide();
                toastrSuccessMsg(data);
                $("#bookingdetails").DataTable().ajax.reload();
                $("#checkindetails").DataTable().ajax.reload();
                $(".sidebar-mini").removeClass('sidebar-collapse');
            } else
                toastrErrorMsg(data);
            setTimeout(function() {}, 1000);
        }
    });
}
"use strict";
$("#view_checin,#previous").on("click", function() {
    $("#booking_list").show();
    $("#checkin_list").show();
    $("#reservation").hide();
    $("#openregister").modal('hide');
    $(".sidebar-mini").removeClass('sidebar-collapse');
});