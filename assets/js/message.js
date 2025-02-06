(function ($) {
    "use strict";
    $(document).ready(function () {
        var msg = $("#msg").val();
        var exmsg = $("#exmsg").val();
        if(msg){
        setTimeout(function () {
               toastr.options = {
                   closeButton: true,
                   progressBar: true,
                   showMethod: 'slideDown',
                   timeOut: 4000
               };
               toastr.success(msg, 'Success');
        
           }, 1300);
        }
        if(exmsg){
        'use strict';
        setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.error(exmsg, 'Something Wrong');
        
            }, 1300);
        }

    });
}(jQuery));