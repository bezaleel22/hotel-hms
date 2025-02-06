function promo_code(){
    'use strict';
	var promocode= $("#promo_code").val();
	var roomid= $("#roomid").val();
	var currency_possition= $("#currency_possition").val();
	var currency_icon= $("#currency_icon").val();
	var pricetext= $("#pricetext").val();
	var total_discount= $("#total_discount").val();
	var total_amount= $("#total_amount").val();
	if(promocode==''){
		swal({
            title: "Failed",
            text: "Please Input Promo Code First!!",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
		$(".sa-clicon").on("click", function(){
			swal.close();
		});
		return false;
		}
	var base = $('#base_url').val();
	var csrf = $('#csrf_token').val();
	var myurl=base+"hotel/promocode";
	$.ajax({
		url: myurl,
		 type: "POST",
		 data: {csrf_test_name: csrf, promocode: promocode, currency_possition: currency_possition, currency_icon: currency_icon, 
            total_discount: total_discount, total_amount: total_amount, pricetext:pricetext, roomid:roomid},
		 success: function(data) {
			 $('#promocodeinfo').html(data);
             $("#promo_code").val('');
		 } 
	  });
}