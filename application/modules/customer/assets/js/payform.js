"use strict";
$("#paymenttype").on("change", function() {
    var type = $("#paymenttype").find(":selected").val();
    if (type == "refund") {
        $("#paidamountdiv").attr("hidden", true);
        $("#invoice").val('');
        $("#msg").text('');
        $("#invoicediv").attr("hidden", false);
        $("#confirmdiv").attr("hidden", true);
    } else if (type == "receieve") {
        $("#invoice").val('');
        $("#msg").text('');
        $("#invoicediv").attr("hidden", false);
        $("#confirmdiv").attr("hidden", true);
        $("#chargediv").attr("hidden", true);
    } else {
        $("#invoicediv").attr("hidden", true);
        $("#paidamountdiv").attr("hidden", true);
        $("#amountdiv").attr("hidden", true);
        $("#msg").attr("hidden", true)
        $("#confirmdiv").attr("hidden", false);
    }
});
"use strict";
$("#invoice").on("change", function() {
    var base = $('#base_url').val();
    var csrf = $('#csrf_token').val()
    var invoice = $("#invoice").val();
    var id = $("#id").text();
    var type = $("#paymenttype").find(":selected").val();
    $.ajax({
        type: "POST",
        url: base + "customer/customer_info/check_invoice",
        data: {
            csrf_test_name: csrf,
            invoice: invoice,
            id: id,
            type: type,
        },

        success: function(data) {
            var obj = JSON.parse(data);
            if (obj.amount <= 0) {
                $("#msg").attr("hidden", false);
                $("#chargediv").attr("hidden", true);
                $("#msg").text("There is no amount remain");
                $("#msg").removeClass("text-danger");
                $("#msg").addClass("text-success");
            } else if (obj.status == 5) {
                $("#amountdiv").attr("hidden", false);
                $("#amount").val(obj.amount);
                $("#days").val(obj.days);
                $("#bookedid").val(obj.bookedid);
                $("#bsource").val(obj.bsource);
                $("#comission").val(obj.commissionamount);
                $("#msg").attr("hidden", true);
                $("#chargediv").attr("hidden", false);
                $("#confirmdiv").attr("hidden", false);
            } else {
                if (obj.status == 404) {
                    $("#msg").attr("hidden", false);
                    $("#chargediv").attr("hidden", true);
                    $("#msg").text("Booking number not found");
                    $("#msg").removeClass("text-success");
                    $("#msg").addClass("text-danger");
                    $("#amountdiv").attr("hidden", true);
                    $("#paidamountdiv").attr("hidden", true);
                    $("#confirmdiv").attr("hidden", true);
                } else if (obj.status == 403) {
                    $("#msg").attr("hidden", false);
                    $("#msg").text("Booking already checkout, you dont have any due amount");
                    $("#msg").removeClass("text-danger");
                    $("#msg").addClass("text-success");
                    $("#paidamountdiv").attr("hidden", true);
                    $("#confirmdiv").attr("hidden", true);
                } else if (obj.status == 200) {
                    $("#msg").attr("hidden", true);
                    $("#paidamountdiv").attr("hidden", false);
                    $("#bookedid").val(obj.bookedid);
                    $("#paid_amount").val(obj.amount);
                    $("#max_amount").val(obj.amount);
                    $("#bookingstatus").val(obj.bookingstatus);
                    $("#confirmdiv").attr("hidden", false);
                    if(obj.days){
                        $("#amountdiv").attr("hidden", false);
                        $("#paidamountdiv").attr("hidden", true);
                        $("#amount").val(obj.amount);
                        $("#chargediv").attr("hidden", false);
                    }
                } else if (obj.status == 201) {
                    $("#msg").attr("hidden", false);
                    $("#chargediv").attr("hidden", true);
                    $("#msg").text("Refund payment already completed");
                    $("#msg").removeClass("text-danger");
                    $("#msg").addClass("text-success");
                    $("#amountdiv").attr("hidden", true);
                } else if (obj.status == 401) {
                    $("#msg").attr("hidden", false);
                    $("#chargediv").attr("hidden", true);
                    $("#msg").text(obj.msg);
                    $("#msg").removeClass("text-danger");
                    $("#msg").addClass("text-success");
                    $("#amountdiv").attr("hidden", true);
                } else {
                    $("#msg").attr("hidden", false);
                    $("#chargediv").attr("hidden", true);
                    $("#msg").text("Customer has to checkout for refund money");
                    $("#msg").removeClass("text-success");
                    $("#msg").addClass("text-danger");
                    $("#amountdiv").attr("hidden", true);
                }
            }
            if(obj.hallroom){
                $("#hallroom").val(obj.hallroom);
            }else{
                $("#hallroom").val("");
            }
        }
    })
});
var temp = 0;
"use strict";
$("#charge").on("input", function() {
    var amount = parseFloat($("#amount").val());
    var charge = parseFloat($("#charge").val());
    if (isNaN(charge)) {
        charge = 0;
    }
    if (charge > (amount + temp)) {
        $("#msg").attr('hidden', false);
        $("#msg").text("Charge can not larger than total amount");
        $("#msg").removeClass("text-success");
        $("#msg").addClass("text-danger");
        $("#charge").val('');
        $("#amount").val(amount + temp);
        temp = 0;
        return false;
    } else {
        $("#msg").attr('hidden', true);
        amount += temp;
        $("#amount").val(amount - charge);
        temp = charge;
    }
});