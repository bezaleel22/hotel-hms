"use strict";

$('input[type="checkbox"]').click(function(){
        
    var csrf = $('#csrf_token').val();
    var clickedemp =$(this).val();
    
    var roster_id = $('#uproster_id').val();
    var rstr_start_date = $('#rstr_start_date').val();
    var rstr_end_date = $('#rstr_end_date').val();
    var rstr_start_time = $('#rstr_start_time').val();
    var rstr_end_time = $('#rstr_end_time').val();
    
    if($(this).is(":checked")){
        
        var ischeck=1;
        var up_url = base+"duty_roster/Shift_management/update_addsingleemproster";
        var dataString = 'roster_id='+roster_id+'&emp_id='+clickedemp+'&rstr_start_date='+rstr_start_date+
        '&rstr_end_date='+rstr_end_date+'&rstr_start_time='+rstr_start_time+'&rstr_end_time='+rstr_end_time+'&csrf_test_name='+csrf;
    }
    else if($(this).is(":not(:checked)")){
        
        var ischeck=0;
        var up_url = base+"duty_roster/Shift_management/update_romovesingleemproster";
        var dataString = 'roster_id='+roster_id+'&emp_id='+clickedemp+
        '&rstr_start_date='+rstr_start_date+'&rstr_end_date='+rstr_end_date+'&csrf_test_name='+csrf;
    }
    $.ajax({
    type: "POST",
    url: up_url,
    data: dataString,
    success: function(data){
        if(ischeck==1){
            swal("Updated", "Employee is Added In This Roster", "success");
            }
            else{
            swal("Removed", "Employee is Removed From This Roster.", "warning");
            }
        }
    });
});