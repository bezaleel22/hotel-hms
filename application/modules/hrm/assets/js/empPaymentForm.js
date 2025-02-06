// emp_payment_form
$(function() {
    'use strict';
    $('input[name="working_period"]').daterangepicker();
});
'use strict';
$("#start_date").datepicker({ dateFormat:'Y-m-d' });
$("#end_date").datepicker({ dateFormat:'yy-mm-dd' });