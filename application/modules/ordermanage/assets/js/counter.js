// JavaScript Document
var urlajax= $("#base").val();
$(document).ready(function(){
		"use strict";
		
	var reloadtime=$("#reloadordtime").val();
 setInterval(function(){ 
  window.location.href = baseurl+"ordermanage/order/counterboard";
 }, reloadtime);
});
"use strict";
function oredrready(orderid){
	var csrf = $('#csrf_token').val();
	var dataString = 'orderid='+orderid+'&csrf_test_name='+csrf;
	 $.ajax({
			type: "POST",
			url: baseurl+"ordermanage/order/checkorder",
			data: dataString,
			success: function(data){
				$('.addonsinfo').html(data);
				$('#edit').modal('show');
			}
		});
	}
function oredrisready(orderid){
	var csrf = $('#csrf_token').val();
	var dataString = 'orderid='+orderid+'&csrf_test_name='+csrf;
	 $.ajax({
			type: "POST",
			url: baseurl+"ordermanage/order/orderisready",
			data: dataString,
			success: function(data){
				$('#kitchenload').html(data);
				$('#edit').modal('hide');
			}
		});
	}
 
 
 load_unseen_notification();
 setInterval(function(){ 
  load_unseen_notification(); 
 }, 700);
 function load_unseen_notification(view = ''){
	 var csrf = $('#csrf_token').val();
  $.ajax({
   url: urlajax+"ordermanage/order/notification",
   method:"POST",
   data:{view:view,csrf_test_name:csrf},
   dataType:"json",
   success:function(data)
   {
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
	