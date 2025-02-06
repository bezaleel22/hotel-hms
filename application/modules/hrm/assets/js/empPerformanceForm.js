$(function(){
    'use strict';
    $("#date").datepicker({ dateFormat:'yy-mm-dd' });
    $("#end_date").datepicker({ dateFormat:'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate());
        $("#end_date").datepicker( "option", "minDate", minValue );
    })
});

'use strict';
function starcheck(){
var star = $('#number_of_star').val();
if(star > 5){
    swal({
        title: "Failed",
        text: "You Can not input More Than five Star",
        type: "error",
        confirmButtonColor: "#28a745",
        confirmButtonText: "Ok",
        closeOnConfirm: true
    });
document.getElementById('number_of_star').value = '';
}
}