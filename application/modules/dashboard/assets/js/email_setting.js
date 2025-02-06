"use strict";
$(".list").on("click", function() {
    var status = 0;
    var label = this.id;
    console.log(label);
    if(this.checked){
        status = 1;
    }
    // var status = $(label).val();
    var csrf = $('#csrf_token').val();
    $.ajax({
        url: baseurl + "dashboard/setting/emailSetting",
        type: "POST",
        data: {
            csrf_test_name: csrf,
            label: label,
            status: status,
        },
        success: function(data) {
            if (data.substr(4, 1) === "S") {
                toastrSuccessMsg(data);
            } else
                toastrErrorMsg(data);
            setTimeout(function() {}, 1000);
        }
    });
});