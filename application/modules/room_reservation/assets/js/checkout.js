"use strict";
$("#chroomno").on("click",function(){
    var chform = $("#chroomno").val();
    if(chform){
        $("#go").attr("disabled",false);
    }else{
        $("#go").attr("disabled",true);
    }
});
function checkoutinfo(){
    "use strict";
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#checkoutdetail").attr("hidden",false);
    var chroomno = $("#chroomno").val();
    if(chroomno == null){
        $("#cmsg").attr("hidden",false);
        $("#cmsg").text("Checkout Room No is required");
        return false;
    }else{
        $("#cmsg").attr("hidden",true);
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/checkoutall/"+chroomno;
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#checkoutdetail").html(data);
        }
    });
}