function year() {
    "use strict";
    var start = $("#start_date").val();
    var end = $("#end_date").val();
    var start_year = start.split("-");
    var end_year = end.split("-");
    if (start_year[0] <= end_year[0]) {
        $("#title").val(start_year[0] + "-" + end_year[0]);
    } else {
        swal({
            title: "Failed",
            text: "End year can not greater than start year",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        $("#start_date").val(end);
        $("#start_date,#end_date").trigger("change");
    }
}
$("#start_date,#end_date").trigger("change");
function editfinyear(id){
    "use strict";
    var title = $('#title_'+id).text();
    var start = $('#start_'+id).text();
    var end = $('#end_'+id).text();
    var status = $('#status_'+id).text();
    if(status=="Active"){
        $("input[name=status][value='2']").prop("checked",true);
        $("input[name=status][value='0']").prop("checked",false);
    }else{
        $("input[name=status][value='2']").prop("checked",false);
        $("input[name=status][value='0']").prop("checked",true);
    }
    $("#finid").val(id);
    $("#title").val(title);
    $("#start_date").val(start);
    $("#end_date").val(end);
    $("#start_date,#end_date").trigger("change");
    $("#finsubmit").attr('hidden', false);
    $("#submit").attr("hidden", true);
    $("#finsubmit").attr("onclick", "updatefinyear()");
}
function updatefinyear(){
    "use strict";
    var base = $('#base_url').val();
    var csrf = $('#csrf_token').val();
    var id = $("#finid").val();
    var title = $("#title").val();
    var start = $("#start_date").val();
    var end = $("#end_date").val();
    var status = $("input[name=status]:checked").val();
    $.ajax({
        type: "POST",
        url: base + "accounts/accounts/finyear_update",
        data: {
            csrf_test_name: csrf,
            id: id,
            title: title,
            start: start,
            end: end,
            status: status,
        },

        success: function(data) {
            location.reload();
        }
    });
}