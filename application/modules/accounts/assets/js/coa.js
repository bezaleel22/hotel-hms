$(document).ready(function(){
    'use strict';
    var baseurl = $('#base_url').val();
    var csrf = $('#csrf_token').val();
    $('#btnSerach').on('click',function(){
        var vouchar=$("#sales_date").val();
        $.ajax({
            url:  baseurl+'accounts/accounts/voucher_report_serach',
            type: 'POST',
            data: {
                csrf_test_name: csrf,
                vouchar: vouchar
            },
            success: function (data) {
                $("#show_vouchar").html(data);
            }
        });

    });
});
$(function(){
    'use strict';
    $(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });
   
});