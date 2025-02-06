function getmonthyear(){
    'use strict';
    var base = $('#base_url').val();
    var id=$("#room_name").val();
    var csrf = $('#csrf_token').val();
    if(id==""){
        swal({
            title: "Failed",
            text: "Please Select Room!!!",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
         $('#offermonth').val('');
        return false;
        }
    var yearmonth=$("#offermonth").val();
    var myurl = base+"room_setting/room_details/checkroomoffer";
    $.ajax({
    type: "POST",
    url: myurl,
    data: { csrf_test_name: csrf, id: id, yearmonth: yearmonth},
    success: function(data) {
        $('#floorandroom').html(data);
        $('[data-toggle="tooltip"]').tooltip();   
    } 
 });
}