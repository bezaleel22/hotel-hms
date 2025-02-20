"use strict";
$(document).ready(function(){
  $('#razorpay').trigger('click');
});
var base_url = $("#base_url").val();
var csrf_token = $("#csrf_token").val();
$('body').on('click', '#razorpay', function(e){
  var order_id = $("#orderid").val();
  var payment_id = $("#paymentid").val();
  var favicon = $("#favicon").val();
  var totalprice = $("#totalprice").val();
  var marchantid = $("#marchantid").val();
  var title = $("#title").val();
  var storename = $("#storename").val();
  var options = {
  "key": marchantid,
  "amount": totalprice, // 2000 paise = INR 20
  "name": title,
  "description": storename,
  "image": favicon,
  "handler": function (response){
  $.ajax({
  url: base_url + 'hotel/successful/' + order_id + '/' + payment_id,
  type: 'post',
  dataType: 'json',
  data: {
    csrf_token: csrf_token,
    razorpay_payment_id: response.razorpay_payment_id,
  }, 
  success: function (msg) {
    if(msg.text==="whatsapp"){
      window.location.href = base_url+'hotel/orderdelevered/'+order_id;
    }else{
      window.location.href = base_url+'hotel/orderdelevered';
    }
  },
  "modal": {
    "ondismiss": function(){
        window.location.replace(base_url+"hotel/cancilorder/"+$order_id);
    }
  }
  });
  },
  "theme": {
  "color": "#528FF0"
  }
  };
  var rzp1 = new Razorpay(options);
  rzp1.on('payment.failed', function (response){
    alert(response.error.description);
  });
  rzp1.open();
  e.preventDefault();
});