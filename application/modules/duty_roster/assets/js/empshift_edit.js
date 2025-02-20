function checkdshift(id) {
    "use strict";

    var base = $('#base_url').val();
    var csrf = $('#csrf_token').val();

    var chksh_id = $('input[name="shiftchk"]:checked').val();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: base + "duty_roster/Shift_management/load_checkedshift",
        data: {
            csrf_test_name: csrf,
            chksh_id: chksh_id,
        },
        success: function(data) {
            $('#emp_startroster_time').val(data.shift_start).trigger('change');
            $('#emp_endroster_time').val(data.shift_end).trigger('change');

        }
    });

}
$('#emp_startroster_time').change(function(){

    "use strict";
    
    var base = $('#base_url').val();
    var csrf = $('#csrf_token').val();

    var cng_date = $('#emp_startroster_date').val();
    var chksh_id = $('input[name="shiftchk"]:checked').val();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: base + "duty_roster/Shift_management/load_checkedroster",
        data: {
            csrf_test_name: csrf,
            chksh_id: chksh_id,
            cng_date: cng_date,
        },
        success: function(data) {
            
              $('#roster_id').val(data.roster_id);

        }
    });

});