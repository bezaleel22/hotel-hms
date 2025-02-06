"use strict";
$("#paymentmode").on("change", function() {
    var pmode = $("#paymentmode").find(":selected").val();
    if (pmode && pmode != "Cash Payment" && pmode != "Bank Payment") {
        $('#bankname').selectpicker('hide');
        $('#recdate').prop("hidden", false);
        $('#modedetails').prop("hidden", false);
        $("#banklabel").text("Date");
        $("#cardlabel").text("Card Number");
        $("#cardno").attr({
            placeholder: "Card No"
        });
        $("#recdate").attr({
            placeholder: "Date"
        });
        $("#recdate").addClass("datefilter2");
        $('.datefilter2').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "timePicker": true,
            locale: {
                format: 'YYYY-MM-DD HH:mm'
            }
        });
    } else if (pmode == "Bank Payment") {
        $('#bankname').selectpicker('show');
        $('#modedetails').prop("hidden", false);
        $('#recdate').prop("hidden", true);
        $("#cardno").attr({
            placeholder: "Account No"
        });
        $("#banklabel").text("Bank Name");
        $("#cardlabel").text("Account No");
        $("#recdate").attr({
            placeholder: "Bank Name"
        });
        $("#recdate").val('');
        $("#recdate").removeClass("datefilter2");
    } else {
        $('#modedetails').prop('hidden', true);
    }
});
$("#previous").on("click", function() {
    $("#openregister").modal('hide');
    $('.modal').modal('hide');
});