$(document).ready(function(){
    "use strict";
    $("body").on('click', '#disablemode', function () {
        var productmode = $("#productmode").val();
        if (productmode == 'demo') {
            toastrWarningMsg("This is only for demo you can't Book Now!");
            return false;
        }
    });
    
});

"use strict";
function toastrWarningMsg(r) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    }
    toastr.warning(r);
}