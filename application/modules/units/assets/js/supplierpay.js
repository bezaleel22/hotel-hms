"use strict";
$("#invoice").on("change", function() {
    var base = $('#base_url').val();
    var csrf = $('#csrf_token').val()
    var invoice = $("#invoice").val();
    var id = $("#id").text();
    $.ajax({
        type: "POST",
        url: base + "units/Supplierlist/check_invoice",
        data: {
            csrf_test_name: csrf,
            invoice: invoice,
            id: id,
        },

        success: function(data) {
            var obj = JSON.parse(data);
            if (obj.status == 0) {
                $("#amountdiv").attr("hidden", false);
                $("#amount").val(obj.amount);
                $("#msg").attr("hidden", true);
                $("#update").attr("hidden", false);
            } else if (obj.status == "1") {
                $("#msg").attr("hidden", false);
                $("#msg").text("Invoice Bill Already Paid");
                $("#msg").removeClass("text-danger");
                $("#msg").addClass("text-success");
                $("#update").attr("hidden", true);
            } else {
                $("#msg").attr("hidden", false);
                $("#msg").text("Invoice not found for supplier");
                $("#msg").removeClass("text-success");
                $("#msg").addClass("text-danger");
                $("#amountdiv").attr("hidden", true);
                $("#update").attr("hidden", true);
            }
        }
    })
});