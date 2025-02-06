
$('#url_status').on('change',function(){
    'use strict';
    if($(this).val()==1){
        var url = $('#url').val();
            url = url.replace('https','http');
            $('#url').val(url);
    }
    else{
        var url = $('#url').val();
            url = url.replace('http','https');
            $('#url').val(url);
    }
});

    $(function () {
        'use strict';

        $('.bd-sidebar .with-sub').on('click', function (e) {
            e.preventDefault();
            $(this).parent().toggleClass('show');
            $(this).parent().siblings().removeClass('show');
        });

        $(document).on('click touchstart', function (e) {
            e.stopPropagation();
            // closing of sidebar menu when clicking outside of it
            if (!$(e.target).closest('.bd-header-menu-icon').length) {
                var sidebarTarg = $(e.target).closest('.bd-sidebar').length;
                if (!sidebarTarg) {
                    $('body').removeClass('bd-sidebar-show');
                }
            }
        });
        $('#sidebarToggle').on('click', function (e) {
            e.preventDefault();

            if (window.matchMedia('(min-width: 992px)').matches) {
                $('body').toggleClass('bd-sidebar-hide');
            } else {
                $('body').toggleClass('bd-sidebar-show');
            }
        });
        new PerfectScrollbar('.sidebar-body', {
            suppressScrollX: true
        });
        var emt = $("#emtycheck").val();
    if(emt){
            if(emt=="home"){
        new PerfectScrollbar('.message_widgets', {
            suppressScrollX: true
        });
        new PerfectScrollbar('.message_widgets2', {
            suppressScrollX: true
        });
        new PerfectScrollbar('.message_widgets3', {
            suppressScrollX: true
        });
        }
    }
    });
//search text
        $(document).ready(function () {
            'use strict';
            $('[data-toggle="tooltip"]').tooltip();
            $("body").on("focus", ".search__text", function () {
                $(this).closest(".search").addClass("search--focus");
            }), $("body").on("blur", ".search__text", function () {
                $(this).val(""), $(this).closest(".search").removeClass("search--focus");
            });
             //select2
            $(".basic-single").select2({
                placeholder: "Select Option",
            });
        });

//calendar 
$(document).ready(function () {
    'use strict';
    if ($(".bd-clock")[0]) {
        var a = new Date;
        a.setDate(a.getDate()), setInterval(function () {
            var a = (new Date).getSeconds();
            $(".time__sec").html((a < 10 ? "0" : "") + a)
        }, 1e3), setInterval(function () {
            var a = (new Date).getMinutes();
            $(".time__min").html((a < 10 ? "0" : "") + a)
        }, 1e3), setInterval(function () {
            var a = (new Date).getHours();
            $(".time__hours").html((a < 10 ? "0" : "") + a)
        }, 1e3)
    }
})
'use strict';
var date = new Date();
date.setDate(date.getDate()-1);
var findate = $("#findate").val();
$('.datepickers').bootstrapMaterialDatePicker({
format: 'YYYY-MM-DD',
startDate: new Date(),
shortTime: false,
date: true,
time: false,
monthPicker: false,
year: false,
switchOnClick: true,
maxDate: findate,
});
date.setDate(date.getDate()-1);
$('.datepickerwithoutprevdate').bootstrapMaterialDatePicker({
format: 'YYYY-MM-DD',
startDate: new Date(),
shortTime: false,
date: true,
time: false,
monthPicker: false,
year: false,
switchOnClick: true,
maxDate: findate,
minDate:new Date(),
});
'use strict';
$('.datepickerwithoutprevdate').on('change',function () {
$('.datepickerwithoutprevdates').bootstrapMaterialDatePicker({
format: 'YYYY-MM-DD',
startDate: new Date(),
shortTime: false,
date: true,
time: false,
monthPicker: false,
year: false,
maxDate: findate,
switchOnClick: true,
});
date = $(this).val(); 
$('.datepickerwithoutprevdates').bootstrapMaterialDatePicker('setMinDate', date);
});
//time picker
$('.timepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    startDate: new Date(),
    shortTime: true,
    date: false,
    time: true,
    monthPicker: false,
    year: false,
    switchOnClick: true,
    });
//attendance time picker
$('.atttimepicker').bootstrapMaterialDatePicker({
    format: 'hh:mm:ss a',
    startDate: new Date(),
    shortTime: true,
    date: false,
    time: true,
    monthPicker: false,
    year: false,
    switchOnClick: true,
    });

 //datetime picker
 'use strict';
    var date = new Date();
    date.setDate(date.getDate()-1);
    $('.datetimepickers').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        startDate: new Date(),
        shortTime: false,
        date: true,
        time: true,
        monthPicker: false,
        year: false,
        switchOnClick: true,
    });   

    
//base
var base = $('#base').val();
var baseurl = base;
//Active Menu
$(document).ready(function(){
    "use strict";
    $(this).find('.secondl li.active').parent().addClass("mm-show");
    $(this).find('.secondl li.active').parent().parent().addClass("mm-active");       
});

//Notification for custeomer
$(document).ready(function(){
"use strict";
var a = new Date;
var nfcheck = $("#nfcheck").val();
if(nfcheck){
a.setDate(a.getDate()), setInterval(function () {
    var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var myurl=base+"customer/Customer_info/checkwaupcall";
	$.ajax({
		url: myurl,
        dataType: "json",
		 type: "POST",
		 data: {csrf_test_name: csrf},
		 success: function(data) {
             if(data){
               
                toastrInfoMsg("Call Customer : "+data.cust_name+"<br> Phone : "+data.cust_phone+"<br>Call Time : "+
                data.call_time+"<br>Remark : "+data.remark);
                return false;
            }
			
			  
		} 
	});

}, 50000);
}
});
"use strict";
function toastrInfoMsg(r) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right", 
        "preventDuplicates": false,
        "onclick": 1,
        "extendedTimeOut": 0,
        "timeOut": 0,
        "tapToDismiss": false,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    }
    toastr.info(r);
}
//Disable enter to submitting form
$('form input').on('keypress', function(e) {
    return e.which !== 13;
});

//financial year date
'use strict';
var fin_date = new Date();
fin_date.setFullYear(fin_date.getFullYear() + 2);
$('.fin_datepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    startDate: new Date(),
    shortTime: false,
    date: true,
    time: false,
    monthPicker: false,
    year: false,
    switchOnClick: true,
    maxDate: fin_date,
});