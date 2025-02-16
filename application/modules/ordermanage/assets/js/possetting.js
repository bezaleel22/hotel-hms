// JavaScript Document
$(document).ready(function () {
	"use strict";
	// select 2 dropdown 
	$("select.form-control:not(.dont-select-me)").select2({
		placeholder: lang.sl_option,
		allowClear: true
	});

	$('.product-list').slimScroll({
		size: '3px',
		height: '345px',
		allowPageScroll: true,
		railVisible: true
	});

	$('.product-grid').slimScroll({
		size: '3px',
		height: 'calc(100vh - 180px)',
		allowPageScroll: true,
		railVisible: true
	});

	var audio = new Audio(baseurl+'assets/beep-08b.mp3');
});

"use strict";
function getslcategory(carid){
	var product_name = $('#product_name').val();
	var csrf = $('#csrfhashresarvation').val();
	var category_id = carid;
	var myurl= $('#posurl').val();
	$.ajax({
		type: "post",
		async: false,
		url: myurl,
		data: {product_name: product_name,category_id:category_id,isuptade:0,csrf_test_name:csrf},
		success: function(data) {
			if (data == '420') {
				$("#product_search").html('Product not found !');
			}else{
				$("#product_search").html(data); 
			}
		},
		error: function() {
		swal({
			title: "Failed",
			text: lang.req_failed,
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
		}
	});
}

//Product search button js
$('body').on('click', '#search_button', function(){
	var product_name = $('#product_name').val();
	var category_id = $('#category_id').val();
	var csrf = $('#csrfhashresarvation').val();
	var myurl= $('#posurl').val();
	$.ajax({
		type: "post",
		async: false,
		url: myurl,
		data: {product_name: product_name,category_id:category_id,csrf_test_name:csrf},
		success: function(data) {
			if (data == '420') {
				$("#product_search").html('Product not found !');
			}else{
				$("#product_search").html(data); 
			}
		},
		error: function() {
		swal({
			title: "Failed",
			text: lang.req_failed,
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
		}
	});
});    

//Product search button js
$('body').on('click', '.select_product', function(e){
	e.preventDefault();
	var card = $(this);
	var pid = card.find('.card-body input[name=select_product_id]').val();
	var sizeid = card.find('.card-body input[name=select_product_size]').val();
	var totalvarient = card.find('.card-body input[name=select_totalvarient]').val();
	var customqty = card.find('.card-body input[name=select_iscustomeqty]').val();
	var isgroup = card.find('.card-body input[name=select_product_isgroup]').val();
	var catid = card.find('.card-body input[name=select_product_cat]').val();
	var itemname= card.find('.card-body input[name=select_product_name]').val();
	var varientname=card.find('.card-body input[name=select_varient_name]').val();
	var qty=1;
	var price=card.find('.card-body input[name=select_product_price]').val();
	var hasaddons=card.find('.card-body input[name=select_addons]').val();
	var csrf = $('#csrfhashresarvation').val();
	if(hasaddons==0 && totalvarient==1 && customqty==0){
		/*check production*/
			var productionsetting = $('#production_setting').val();
			if(productionsetting == 1){
				
				var isselected = $('#productionsetting-'+pid+'-'+sizeid).length;
			
				if(isselected ==1 ){

					var checkqty = parseInt($('#productionsetting-'+pid+'-'+sizeid).text())+qty;

											
				}
				else{
					var checkqty = qty;
				}

				var checkvalue = checkproduction(pid,sizeid,checkqty);

					if(checkvalue == false){
						return false;
					}
				
			}
		/*end checking*/
	var mysound=baseurl+"assets/";
	var audio =["beep-08b.mp3"];
	new Audio(mysound + audio[0]).play();
	var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&isgroup='+isgroup+'&csrf_test_name='+csrf;
	var myurl= $('#carturl').val();
	$.ajax({
		type: "POST",
		url: myurl,
		data: dataString,
		success: function(data) {
			$('#addfoodlist').html(data);
			var total=$('#grtotal').val();
			var totalitem=$('#totalitem').val();
			$('#item-number').text(totalitem);
			$('#getitemp').val(totalitem);
			var tax=$('#tvat').val();
			$('#vat').val(tax);
			var discount=$('#tdiscount').val();
			var tgtotal=$('#tgtotal').val();
			$('#calvat').text(tax);
			$('#invoice_discount').val(discount);
			var sc=$('#sc').val();
			$('#service_charge').val(sc);
			$('#caltotal').text(tgtotal);
			$('#grandtotal').val(tgtotal);
			$('#orggrandTotal').val(tgtotal);
			$('#orginattotal').val(tgtotal);
		} 
	});
	}
else{
		var geturl=$("#addonexsurl").val();
		var myurl =geturl+'/'+pid;
		var dataString = "pid="+pid+"&sid="+sizeid+'&csrf_test_name='+csrf;
		$.ajax({
		type: "POST",
		url: geturl,
		data: dataString,
		success: function(data) {
			$('.addonsinfo').html(data);
			$('#edit').modal('show');
			var totalitem=$('#totalitem').val();
			var tax=$('#tvat').val();
			var discount=$('#tdiscount').val();
			var tgtotal=$('#tgtotal').val();
			$('#vat').val(tax);
			$('#calvat').text(tax);
			$('#getitemp').val(totalitem);
			$('#invoice_discount').val(discount);
			$('#caltotal').text(tgtotal);
			$('#grandtotal').val(tgtotal);
			$('#orggrandTotal').val(tgtotal);
			$('#orginattotal').val(tgtotal);
		} 
	});
	}
});
$(document).ready(function(){
	"use strict";

		$("#nonthirdparty").show();
		$("#thirdparty").hide();
		$("#delivercom").prop('disabled', true);
		$("#waiter").prop('disabled', false);
		$("#tableid").prop('disabled', false);
		$("#cookingtime").prop('disabled', false);
		$("#cardarea").hide();
		
		
		$("#paidamount").on('keyup', function(){ 
			var maintotalamount=$("#maintotalamount").val();
			var paidamount=$("#paidamount").val();
			var restamount=(parseFloat(paidamount))-(parseFloat(maintotalamount));
			var changes=restamount.toFixed(2);
			$("#change").val(changes);
		});
		
		$(".payment_button").click(function(){
			$(".payment_method").toggle();

			//Select Option
			$("select.form-control:not(.dont-select-me)").select2({
				placeholder: lang.sl_option,
				allowClear: true
			});
		});
		
		$("#card_typesl").on('change', function(){ 
			var cardtype=$("#card_typesl").val();
			
			$("#card_type").val(cardtype);
			if(cardtype==4){
			$("#isonline").val(0);
			$("#cardarea").hide();
			$("#assigncard_terminal").val('');
			$("#assignbank").val('');
			$("#assignlastdigit").val('');
			}
			else if(cardtype==1){
			$("#isonline").val(0);
			$("#cardarea").show();
			}
			else{
				$("#isonline").val(1);
				$("#cardarea").hide();
				$("#assigncard_terminal").val('');
				$("#assignbank").val('');
				$("#assignlastdigit").val('');
				}
		
		});
		$("#ctypeid").on('change', function(){ 
			var customertype=$("#ctypeid").val();
			if(customertype==3){
			$("#delivercom").prop('disabled', false);
			$("#waiter").prop('disabled', true);
			$("#tableid").prop('disabled', true);
			$("#cookingtime").prop('disabled', true);
			$("#nonthirdparty").hide();
			$("#thirdparty").show();
			}
			else if(customertype==4){
				$("#nonthirdparty").show();
				$("#thirdparty").hide();
				$("#tblsec").hide();
				$("#tblsecp").hide();
				$("#delivercom").prop('disabled', true);
				$("#waiter").prop('disabled', false);
				$("#tableid").prop('disabled', true);
				$("#cookingtime").prop('disabled', true);
			}
			else if(customertype==2){
				$("#nonthirdparty").show();
				$("#tblsecp").hide();
				$("#tblsec").hide();
				$("#thirdparty").hide();
				$("#waiter").prop('disabled', false);
				$("#tableid").prop('disabled', false);
				$("#cookingtime").prop('disabled', false);
				$("#delivercom").prop('disabled', true);
			}
			else{
				$("#nonthirdparty").show();
				$("#tblsecp").show();
				$("#tblsec").show();
				$("#thirdparty").hide();
				$("#waiter").prop('disabled', false);
				$("#tableid").prop('disabled', false);
				$("#cookingtime").prop('disabled', false);
				$("#delivercom").prop('disabled', true);
				
				}
		});
		$('[data-toggle="popover"]').popover({
		container: 'body' });
		/*place order*/
		Mousetrap.bind('shift+p', function() {
			
			placeorder();
			});
		/*quick order*/
		Mousetrap.bind('shift+q',function(){
			quickorder();
		});
		/*select customer name*/
		Mousetrap.bind('shift+c',function(){
			$("#customer_name").select2('open');
		});

		/*select customer type*/
		Mousetrap.bind('shift+y',function(){
			$("#ctypeid").select2('open');
		});

		/*focus on discount*/
		Mousetrap.bind('shift+d',function(){
			$("#invoice_discount").focus();
			return false;
		});
		/*focus service charge*/
		Mousetrap.bind('shift+r',function(){
			$("#service_charge").focus();
			return false;
		});
				/*go ongoing order tab*/
		Mousetrap.bind('shift+g',function(){
			$(".ongord").trigger( "click" );
		});
		/*go total order tab*/
		Mousetrap.bind('shift+t',function(){
			$(".torder").trigger( "click" );
		});
		/*go online order tab*/
		Mousetrap.bind('shift+o',function(){
			$(".comorder").trigger( "click" );
		});
		/*go new order tab*/
		Mousetrap.bind('shift+n',function(){
			$(".home").trigger( "click" );
		});

		/*search unique product for cart*/
		Mousetrap.bind('shift+s',function(){
					$("#product_name").select2('open');
						});
		/*select item qty on addons modal*/
		Mousetrap.bind('alt+q',function(){
					$('#itemqty_1').focus();
					return false;
						});
			/*add to cart on addons modal*/
		Mousetrap.bind('shift+a',function(){
					$("#add_to_cart").trigger( "click" );
						});
			/*edit on going order*/
		Mousetrap.bind('shift+e',function(e){
					$('[id*=table-]').focus();
				
						});
		
		/*table search*/
		Mousetrap.bind('shift+x',function(e){
			$("input[aria-controls=onprocessing]").focus();
			return false;
		});
		/*table search*/
		Mousetrap.bind('shift+v',function(e){
			$("input[aria-controls=Onlineorder]").focus();
			return false;
		});
		/*edit on going order*/
		Mousetrap.bind('shift+m',function(e){
			$('[id*=table-today-]').focus();
				
						});
		/*select cooking time*/
		Mousetrap.bind('alt+k',function(){
					$('#cookedtime').focus();
					return false;
						});
		/*select waiter*/
		Mousetrap.bind('shift+w',function(){
					$('#waiter').select2('open');
					return false;
						});
		/*select table*/
		Mousetrap.bind('shift+b',function(){
					$('#tableid').select2('open');
					return false;
						});
		/*select uniqe table on going order*/
		Mousetrap.bind('alt+t',function(){
				$("#ongoingtable_name").select2('open');
						});
		/*update srotcut*/
		/*select update order list*/
		Mousetrap.bind('alt+s',function(){
					$("#update_product_name").select2('open');
						});
		/*select customer name*/
		Mousetrap.bind('alt+c',function(){
			$("#customer_name_update").select2('open');
		});

		/*select customer type*/
		Mousetrap.bind('alt+y',function(){
			$("#ctypeid_update").select2('open');
		});
		/*select waiter*/
		Mousetrap.bind('alt+w',function(){
					$('#waiter_update').select2('open');
					return false;
						});
		/*select table*/
		Mousetrap.bind('alt+b',function(){
					$('#tableid_update').select2('open');
					return false;
						});
			/*focus on discount*/
		Mousetrap.bind('alt+d',function(){
			$("#invoice_discount_update").focus();
			return false;
		});
		/*focus service charge*/
		Mousetrap.bind('alt+r',function(){
			$("#service_charge_update").focus();
			return false;
		});
		/*submit  update order*/
		Mousetrap.bind('alt+u',function(){
					$("#update_order_confirm").trigger( "click" );
						});
		/*end update sort cut*/
		/*quick paid modal*/
		/*select payment type name*/
		Mousetrap.bind('alt+m',function(){
			$(".card_typesl").select2('open');
		});
		/*type paid amount*/
		Mousetrap.bind('alt+a',function(){
			$('.number').focus();
			return false;
		});
		/*print bill paid amount*/
		Mousetrap.bind('alt+p',function(){
			$('#pay_bill').trigger( "click" );
		});
		/*print bill paid amount*/
		Mousetrap.bind('alt+x',function(){
			$('.close').trigger( "click" );
		});

	
		
		$('.search-field').select2({
			placeholder: lang.sl_product,
				minimumInputLength: 1,
			ajax: {
				url: baseurl+'ordermanage/order/getitemlistdroup',
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
				return {
					results:  $.map(data, function (item) {
						return {
							text: item.text+'-'+item.variantName,
							id: item.id+'-'+item.variantid
						}
					})
				};
				},
				cache: true
			}
			});

			
		});
		$('.search-field').on('keyup',function(){
			
			var csrf = $('#csrfhashresarvation').val();
			$.ajax({
				url: baseurl+'ordermanage/order/getitemlistdroup',
				type: "GET",
				dataType: 'json',
				delay: 250,
				data:{csrf_test_name:csrf},
				processResults: function (data) {
				return {
					results:  $.map(data, function (item) {
						return {
							text: item.text+'-'+item.variantName,
							id: item.id+'-'+item.variantid
						}
					})
				};
				},
				cache: true
			});
			});

function ongoingclick(){
		
	var url= baseurl+"ordermanage/order/getongoingorder";
	
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
		$('#onprocesslist').html(data);
	}

	}); 
	}

/*all ongoingorder product as ajax*/
$(document).on('click','#kitchenorder',function(){
	var url= baseurl+"ordermanage/order/kitchenstatus";
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
		$('#kitchen').html(data);
	}

	}); 


	});
/*all todayorder product as ajax*/

function todayorderclick(){

	var url=baseurl+"ordermanage/order/showtodayorder";
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
		$('#messages').html(data);
	}

	}); 


}

/*all todayorder product as ajax function todayonlieorderfun()*/
function todayonlieorderclick(){

	var url=baseurl+"ordermanage/order/showonlineorder";
	
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
		$('#settings').html(data);
	}

	}); 


}

/*all todayorder product as ajax*/
$(document).on('click','#todayqrorder',function(){

	var url= baseurl+"ordermanage/order/showqrorder";
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
		$('#qrorder').html(data);
	}

	}); 


});

	
/*unique table data*/
"use strict";
function ongoingtable_namesrc(){
		var id = $('#ongoingtable_name').val();
		var url= baseurl+"ordermanage/order/getongoingorder"+"/"+id;
		var csrf = $('#csrfhashresarvation').val();
		$.ajax({
			type: "GET",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			$('#onprocesslist').html(data);

		}

		}); 
		$('#table-'+id).focus();

}

function ongoingtable_srch(){
	var id = $('#ongoingtable_sr').val();
	var url= baseurl+"ordermanage/order/getongoingorder"+"/"+id+"/table";
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
		$('#onprocesslist').html(data);

	}

	}); 
	$('#table-'+id).focus();

}
/*select product from list*/
function productsrcname(){

		var tid = $("#product_name").val();
		var idvid=tid.split("-");
		var id=idvid[0];
		var vid=idvid[1];
		var url= baseurl+"ordermanage/order/srcposaddcart"+"/"+id;
		var csrf = $('#csrfhashresarvation').val();
		/*check production*/
		/*please fixt count total counting*/
			var productionsetting = $('#production_setting').val();
			if(productionsetting == 1){
					var checkqty = 1;
				var checkvalue = checkproduction(id,vid,checkqty);

					if(checkvalue == false){
						$('#product_name').html('');
						return false;
					}
				
			}
		/*end checking*/
		$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {

			var myurl =baseurl+"ordermanage/order/adonsproductadd"+'/'+id;
			$.ajax({
		type: "GET",
		url: myurl,
		data:{csrf_test_name:csrf},
		success: function(data) {
				$('.addonsinfo').html(data);
				$('#edit').modal('show');
				var totalitem=$('#totalitem').val();
				var tax=$('#tvat').val();
				var discount=$('#tdiscount').val();
				var tgtotal=$('#tgtotal').val();
				$('#vat').val(tax);
				$('#calvat').text(tax);
				var sc=$('#sc').val();
				$('#service_charge').val(sc);
				$('#getitemp').val(totalitem);
				$('#invoice_discount').val(discount);
				$('#caltotal').text(tgtotal);
				$('#grandtotal').val(tgtotal);
				$('#orggrandTotal').val(tgtotal);
				$('#orginattotal').val(tgtotal);
				$('#product_name').html('');
				
			} 
			});
		} 
	});

}

function printRawHtml(view) {
	printJS({
		printable: view,
		type: 'raw-html',
		
	});
}

function placeorder(){
	var finyear = $("#finyear").val();
	if(finyear<=0){
		swal({
			title: "Failed",
			text: "Please Create Financial Year First",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
		return false;
	}
	var ctypeid=$("#ctypeid").val();
	var waiter="";
	var isdelivary="";
	var thirdinvoiceid="";
	var tableid="";
	var customer_name=$("#order_cust").val();
	
	var cardtype=4;
	var isonline=0;
	var order_date=$("#order_date").val();
	var grandtotal=$("#grandtotal").val();
	var customernote="";
	var invoice_discount=$("#invoice_discount").val();
	var service_charge=$("#service_charge").val();
	var vat=$("#vat").val();
	var orggrandTotal=$("#subtotal").val();
	var isonline=$("#isonline").val();
	var isitem=$("#totalitem").val();
	var cookedtime=$("#cookedtime").val();
	var multiplletaxvalue = $('#multiplletaxvalue').val();
	var csrf = $('#csrfhashresarvation').val();
	var errormessage = '';
		if(customer_name == ''){ errormessage = errormessage+'<span>Please Select Customer Name.</span>';
		swal({
			title: "Failed",
			text: "Please Select Customer Name!!!",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
			return false;
		}
		if(ctypeid == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
		swal({
			title: "Failed",
			text: "Please Select Customer Type!!!",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
			return false;
		}
		if(isitem == '' || isitem==0){ errormessage = errormessage+'<span>Please add Some Food</span>';
		swal({
			title: "Failed",
			text: "Please add Some Food!!!",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
			return false;
		}
		if(ctypeid==3){
				var isdelivary=$("#delivercom").val();
				var thirdinvoiceid=$("#thirdinvoiceid").val();
				if(isdelivary == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
				swal({
				title: "Failed",
				text: "Please Select Delivar Company!!!",
				type: "warning",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
			});
					return false;
				}
			}
		else if(ctypeid==4 || ctypeid==2){
			if(possetting.waiter==1){
				var waiter=$("#waiter").val();
				if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
				swal({
				title: "Failed",
				text: "Please Select Waiter!!!",
				type: "warning",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
				});
					return false;
				}
				}
			}
		else{
			var waiter=$("#waiter").val();
			var tableid=$("#tableid").val();
			var table_member_multi = $('#table_member_multi').val();
			var table_member_multi_person = $('#table_member_multi_person').val();
			var table_member=$("#table_member").val();//table member 02/11
			if(possetting.waiter==1){
				if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
					$("#waiter").select2('open');
					return false;
				}
			} 
			if(possetting.tableid==1){
				if(tableid == ''){
					$("#tableid").select2('open');
					toastr.warning("Please Select Table", 'Warning');
					return false;
				}
				if(possetting.tablemaping==1){
				
				if(tableid == ''||!$.isNumeric($('#table_person').val())){ 	toastr.warning("Please Select Table or number person", 'Warning');
						return false;
					}
				} } 
			}
		if(errormessage==''){
			order_date=encodeURIComponent(order_date);
			customernote=encodeURIComponent(customernote);
			var errormessage = '<span style="color:#060;">Signup Completed Successfully.</span>';
			var dataString = 'customer_name='+customer_name+'&ctypeid='+ctypeid+'&waiter='+waiter+'&tableid='+tableid+'&card_type='+cardtype+'&isonline='+isonline+'&order_date='+order_date+'&grandtotal='+grandtotal+'&customernote='+customernote+'&invoice_discount='+invoice_discount+'&service_charge='+service_charge+'&vat='+vat+'&subtotal='+orggrandTotal+'&assigncard_terminal=&assignbank=&assignlastdigit=&delivercom='+isdelivary+'&thirdpartyinvoice='+thirdinvoiceid+'&cookedtime='+cookedtime+'&tablemember='+table_member+'&table_member_multi='+table_member_multi+'&table_member_multi_person='+table_member_multi_person+'&multiplletaxvalue='+multiplletaxvalue+'&csrf_test_name='+csrf;
					$.ajax({
						type: "POST",
						url: baseurl+"ordermanage/order/pos_order",
						data: dataString,
						success: function(data){
							$("#order_cust").val('');
							$('#customer_name').val(null).trigger('change');
							$('.cust_is_add').html('');
							$('.cust_is_add').addClass("ti-plus");
							$('#addfoodlist').empty();
							$("#getitemp").val('0');
							$('#calvat').text('0');
							$('#vat').val('0');
							$('#invoice_discount').val('0');
							$('#caltotal').text('');
							$('#grandtotal').val('');
							$('#thirdinvoiceid').val('');
							$('#orggrandTotal').val('');
							$('#waiter').select2('data', null);
							$('#tableid').select2('data', null);
							$('#waiter').val('');
						
							$('#table_member').val('');
							$('#table_person').val(lang.person);
							$('#table_member_multi').val(0);
							$('#table_member_multi_person').val(0);
							$("#customer_name").prop('disabled', false);
							$(".newclient").prop('disabled', false);

							var err = data;
							if(err=="error"){
								swal({
								title: lang.ord_failed,
								text: lang.failed_msg,
								type: "warning",
								showCancelButton: false,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes, Cancel!",
								closeOnConfirm: true
								},
								function () {
							
								});
								}
							else{
							swal({
								title: lang.ord_succ,
								text: "Do you Want to Print Token No.???",
								type: "success",
								showCancelButton: true,
								confirmButtonColor: "#28a745",
								confirmButtonText: "Yes",
								cancelButtonText: "No",
								closeOnConfirm: true,
								closeOnCancel: true
							},
							function (isConfirm) {
								if (isConfirm) {
									printRawHtml(data);							   
								} else {
									$('#waiter').select2('data', null);
									$('#tableid').select2('data', null);
									$('#waiter').val('');
									$('#tableid').val('');
								}
							});
							}
						}
					});
			}
	}
function postokenprint(id){
	var csrf = $('#csrfhashresarvation').val();
	var url= baseurl+"ordermanage/order/paidtoken"+"/"+id+"/";
	$.ajax({
			type: "POST",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			printRawHtml(data);
		}
	});
}

function editposorder(id,view){
		var url= baseurl+"ordermanage/order/updateorder"+"/"+id;
		var csrf = $('#csrfhashresarvation').val();
		if(view == 1){
			var vid = $("#onprocesslist");
		}
		else if(view == 2){
			var vid = $("#messages");
		}
		else if(view == 4){
			var vid = $("#qrorder");
			}
		else{
			var vid = $("#settings");
		}
		$.ajax({
			type: "GET",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			vid.html(data);
		}
	});
}

function givefocus(element){
	window.prevFocus = $(element);
}

function quickorder(){
	var finyear = $("#finyear").val();
	if(finyear<=0){
		swal({
			title: "Failed",
			text: "Please Create Financial Year First",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
		return false;
	}
	var ctypeid=$("#ctypeid").val();
	var waiter="";
	var isdelivary="";
	var thirdinvoiceid="";
	var tableid="";
	var customer_name=$("#order_cust").val();
	var cardtype=4;
	var isonline=0;
	var order_date=$("#order_date").val();
	var grandtotal=$("#grandtotal").val();
	var customernote="";
	var invoice_discount=$("#invoice_discount").val();
	var service_charge=$("#service_charge").val();
	var vat=$("#vat").val();
	var orggrandTotal=$("#subtotal").val();
	
	var isitem=$("#totalitem").val();
	var cookedtime=$("#cookedtime").val();
	var multiplletaxvalue = $('#multiplletaxvalue').val();
	var csrf = $('#csrfhashresarvation').val();
	var errormessage = '';
		if(customer_name == ''){ errormessage = errormessage+'<span>Please Select Customer Name.</span>';
		swal({
		title: "Failed",
		text: "Please Select Customer Name!!!",
		type: "warning",
		confirmButtonColor: "#28a745",
		confirmButtonText: "Ok",
		closeOnConfirm: true
		});
			return false;
		}
		if(ctypeid == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
		swal({
		title: "Failed",
		text: "Please Select Customer Type!!!",
		type: "warning",
		confirmButtonColor: "#28a745",
		confirmButtonText: "Ok",
		closeOnConfirm: true
		});
			return false;
		}
		if(isitem == '' || isitem==0){ errormessage = errormessage+'<span>Please add Some Food</span>';
		swal({
		title: "Failed",
		text: "Please add Some Food!!!",
		type: "warning",
		confirmButtonColor: "#28a745",
		confirmButtonText: "Ok",
		closeOnConfirm: true
		});
			return false;
		}
		if(ctypeid==3){
				var isdelivary=$("#delivercom").val();
				var thirdinvoiceid=$("#thirdinvoiceid").val();
				if(isdelivary == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
				swal({
				title: "Failed",
				text: "Please Select Delivar Company!!",
				type: "warning",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
				});
					return false;
				}
			}
		else if(ctypeid==4 || ctypeid==2){
				var waiter=$("#waiter").val();
				if(quickordersetting.waiter==1){
				if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
				$("#waiter").select2('open');
					
					return false;
				}
				} 
			}
		else{
			var waiter=$("#waiter").val();
			var tableid=$("#tableid").val();
			var table_member_multi = $('#table_member_multi').val();
			var table_member_multi_person = $('#table_member_multi_person').val();
			var table_member=$("#table_member").val();//table member 02/11
			if(quickordersetting.waiter==1){
				if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
					$("#waiter").select2('open');
					return false;
				}
			}
			if(quickordersetting.tableid==1){             
				if(tableid == ''){
					$("#tableid").select2('open');
					toastr.warning("Please Select Table", 'Warning');
					return false;
				}
				if(quickordersetting.tablemaping==1){ 				
				if(tableid == ''||!$.isNumeric($('#table_person').val())){ 	toastr.warning("Please Select Table or number person", 'Warning');
						return false;
					}
				} }
			}
			
		
		if(errormessage==''){
			order_date=encodeURIComponent(order_date);
			customernote=encodeURIComponent(customernote);
			var errormessage = '<span style="color:#060;">Signup Completed Successfully.</span>';
			var dataString = 'customer_name='+customer_name+'&ctypeid='+ctypeid+'&waiter='+waiter+'&tableid='+tableid+'&card_type='+cardtype+'&isonline='+isonline+'&order_date='+order_date+'&grandtotal='+grandtotal+'&customernote='+customernote+'&invoice_discount='+invoice_discount+'&service_charge='+service_charge+'&vat='+vat+'&subtotal='+orggrandTotal+'&assigncard_terminal=&assignbank=&assignlastdigit=&delivercom='+isdelivary+'&thirdpartyinvoice='+thirdinvoiceid+'&cookedtime='+cookedtime+'&tablemember='+table_member+'&table_member_multi='+table_member_multi+'&table_member_multi_person='+table_member_multi_person+'&multiplletaxvalue='+multiplletaxvalue+'&csrf_test_name='+csrf;
				
					$.ajax({
						type: "POST",
						url: baseurl+"ordermanage/order/pos_order/1",
						data: dataString,
						success: function(data){
							$("#order_cust").val('');
							$('#customer_name').val(null).trigger('change');
							$('.cust_is_add').html('');
							$('.cust_is_add').addClass("ti-plus");
							$('#addfoodlist').empty();
							$("#getitemp").val('0');
							$('#calvat').text('0');
							$('#vat').val('0');
							$('#invoice_discount').val('0');
							$('#caltotal').text('');
							$('#grandtotal').val('');
							$('#thirdinvoiceid').val('');
							$('#orggrandTotal').val('');
							$('#waiter').select2('data', null);
							$('#tableid').select2('data', null);
							$('#waiter').val('');
						
							$('#table_member').val('');
							$('#table_person').val(lang.person);
							$('#table_member_multi').val(0);
							$('#table_member_multi_person').val(0);
							$("#customer_name").prop('disabled', false);
							$(".newclient").prop('disabled', false);
							var err = data;
							if(err=="error"){
								swal({
								title: lang.ord_failed,
								text: lang.failed_msg,
								type: "warning",
								showCancelButton: false,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes, Cancel!",
								closeOnConfirm: true
								},
								function () {
							
								});
								}
							else{
							swal({
								title: lang.ord_places,
								text: lang.do_print_in,
								type: "success",
								showCancelButton: true,
								confirmButtonColor: "#28a745",
								confirmButtonText: "Yes",
								cancelButtonText: "No",
								closeOnConfirm: true,
								closeOnCancel: true
							},
							function (isConfirm) {
								if (isConfirm) {
								createMargeorder(data,1)
								
								} else {
									$('#waiter').select2('data', null);
									$('#tableid').select2('data', null);
									$('#waiter').val('');
									$('#tableid').val('');
								
								}
							});
							}
						}
					});
			}
	}

function printJobComplete() {
	$("#kotenpr").empty();
}	 

function printRawHtmlupdate(view,id) {
	printJS({
		printable: view,
		type: 'raw-html',
		onPrintDialogClose: function () {
			$.ajax({
			type: "GET",
			url: "tokenupdate/"+id,
			data:{csrf_test_name:csrftokeng},
			success: function(data) {
					console.log("done");
			}
		});
		}
	});
}

function postupdateorder_ajax(){
	var form = $('#insert_purchase');
	var url = form.attr('action');
	var data = form.serialize();
	
	$.ajax({
			url:url,
			type:'POST',
			data:data,
			dataType: 'json',
		
			beforeSend:function(xhr){
			
			$('span.error').html('');
			},
		
			success:function(result){
				swal({
				title: result.msg,
				text: result.tokenmsg,
				type: "success",
				showCancelButton: true,
				confirmButtonColor: "#28a745",
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				closeOnConfirm: true,
				closeOnCancel: true
			},
		function (isConfirm) {
				if (isConfirm) {
					$.ajax({
			type: "GET",
			url: baseurl+"ordermanage/order/postokengenerateupdate/"+result.orderid+"/1",
			success: function(data) {
					printRawHtml(data);
			} 
		});
				} else {
				
					$.ajax({
						type: "GET",
						url: baseurl+"ordermanage/order/tokenupdate/"+result.orderid,
						success: function(data) {
								console.log("done");
						}
					});
				}
			});
			setTimeout(function () {
				toastr.options = {
				closeButton: true,
				progressBar: true,
				showMethod: 'slideDown',
				timeOut: 4000,
					
		};
		toastr.success(result.msg, 'Success');
		prevsltab.trigger("click");


	}, 300);         
			},error:function(a){
				
			}
		});
}
function payorderbill(status,orderid,totalamount){
	$('#paidbill').attr('onclick','orderconfirmorcancel('+status+','+orderid+')');
	$('#maintotalamount').val(totalamount);
	$('#totalamount').val(totalamount);
	$('#paidamount').attr("max", totalamount);
	$('#payprint').modal('show');
}

function onlinepay(){
	$("#onlineordersubmit").submit();
}   

function orderconfirmorcancel(status,orderid){
	mystatus=status;
	if(status==9 || status==10){
		status=4;
		var pval=$("#paidamount").val();
		if(pval<1 ||pval==''){
		swal({
			title: "Failed",
			text: "Please Insert Paid Amount!!!",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
			});
			return false;
		}
	}
	var carttype='';
	var cterminal='';
	var mybank='';
	var mydigit='';
	var paid='';
	if(status==4){
		var carttype=$("#card_typesl").val();
		var cterminal=$("#card_terminal").val();
		var mybank=$("#bank").val();
		var mydigit=$("#last4digit").val();
		var paid=$('#paidamount').val();
		
		if(carttype==''){
		swal({
			title: "Failed",
			text: "Please Select Payment Method!!!",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
			});
			return false;
			}
			if(carttype==1){
			if(cterminal==''){
				swal({
					title: "Failed",
					text: "Please Select Card Terminal!!!",
					type: "warning",
					confirmButtonColor: "#28a745",
					confirmButtonText: "Ok",
					closeOnConfirm: true
					});
					return false;
				}
			}
		}
	var csrf = $('#csrfhashresarvation').val();
	var dataString = 'status='+status+'&orderid='+orderid+'&paytype='+carttype+'&cterminal='+cterminal+'&mybank='+mybank+'&mydigit='+mydigit+'&paid='+paid+'&csrf_test_name='+csrf;
	$.ajax({
			type: "POST",
			url: baseurl+"ordermanage/order/changestatus",//workingnow
			data: dataString,
			success: function(data){
				$("#onprocesslist").html(data);
				if(mystatus=="9"){
					window.location.href=baseurl+"ordermanage/order/orderinvoice/"+orderid;
					}
				else if(mystatus=="10"){
				$('#payprint').modal('hide');
			
				prevsltab.trigger( "click" );
				}
				else if(mystatus==4){
							swal({
								title: lang.ord_complte,
								text: lang.ord_com_sucs,
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#28a745",
								confirmButtonText: "Yes",
								closeOnConfirm: true
								},
							function () {
								prevsltab.trigger( "click" );
								$('#paidamount').val('');
								$('#payprint').modal('hide');
								});
					}
			}
		});
}

function paysound(){
	var filename=baseurl+nofitysound;
	var audio = new Audio(filename);
	audio.play();
}

function load_unseen_notification(view = ''){   
			var baseurl = $('#base_url').val();
			var csrf = $('#csrfhashresarvation').val();			
			var myAudio = document.getElementById("myAudio");
			var soundenable=possetting.soundenable;
			$.ajax({
				url: baseurl+"ordermanage/order/notification",
				method:"POST",
				data:{csrf_test_name:csrf,view:view},
				dataType:"json",
				success:function(data)
				{
				if(data.unseen_notification > 0)
				{
					$('.count').html(data.unseen_notification);
					if(soundenable==1){
					myAudio.play();
					}
				}else{
					if(soundenable==1){
						myAudio.pause();
						}
					$('.count').html(data.unseen_notification);
					}
				
				}
			});
}

var intervalc=0;
setInterval(function(){ 
	load_unseen_notification(intervalc); 
}, 700);

function load_unseen_notificationqr(view = ''){

	var baseurl = $('#base_url').val();
	var csrf = $('#csrfhashresarvation').val();	
	var myAudio = document.getElementById("myAudio");
	var soundenable=possetting.soundenable;
	$.ajax({
		url: baseurl+"ordermanage/order/notificationqr",
		method:"POST",
		data:{csrf_test_name:csrf,view:view},
		dataType:"json",
		success:function(data)
		{
		if(data.unseen_notificationqr > 0)
		{
			$('.count2').html(data.unseen_notificationqr);
			if(soundenable==1){
			myAudio.play();
			}
		}
		else{
			if(soundenable==1){
				myAudio.pause();
			}
		$('.count2').html(data.unseen_notification);
		}
		}
	});
}
setInterval(function(){ 
	$('li.active').trigger('click');
	load_unseen_notificationqr(); 
}, 700);

function detailspop(orderid){
	var csrf = $('#csrfhashresarvation').val();
	var myurl=baseurl+'ordermanage/order/orderdetailspop/'+orderid;
		var dataString = "orderid="+orderid+'&csrf_test_name='+csrf;
		$.ajax({
			type: "POST",
			url: myurl,
			data: dataString,
			success: function(data) {
				$('.orddetailspop').html(data);
				$('#orderdetailsp').modal('show');
			} 
		});
	
}

function pospageprint(orderid){
	var csrf = $('#csrfhashresarvation').val();
	var datavalue = 'customer_name='+customer_name+'&csrf_test_name='+csrf;
	$.ajax({
		type: "POST",
		url: baseurl+"ordermanage/order/posprintview/"+orderid,
		data: datavalue,
		success: function(printdata){											
			$("#kotenpr").html(printdata);
			const style = '@page { margin:0px;font-size:18px; }';
			printJS({
				printable: 'kotenpr',
				onPrintDialogClose: printJobComplete,
				type: 'html',
				font_size: '25px',
				style: style,
				scanStyles: false												
			})
		}
	});
}
function printPosinvoice(id){
	var csrf = $('#csrfhashresarvation').val();
	var url = baseurl+"ordermanage/order/posorderinvoice/"+id;
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
			printRawHtml(data);

		}

	});
}
function pos_order_invoice(id){
	var csrf = $('#csrfhashresarvation').val();
	var url= baseurl+"ordermanage/order/pos_order_invoice/"+id;
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
			$('#messages').html(data);
		}

	}); 

}

function orderdetails_post(id){
	var csrf = $('#csrfhashresarvation').val();
	var url= baseurl+"ordermanage/order/orderdetails_post/"+id;
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
			$('#messages').html(data);
		}

	}); 

}

function orderdetails_onlinepost(id){
	var url= baseurl+"ordermanage/order/orderdetails_post/"+id;
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
		type: "GET",
		url: url,
		data:{csrf_test_name:csrf},
		success: function(data) {
		$('#settings').html(data);
	}

	}); 

}

function createMargeorder(orderid,value=null){
	var csrf = $('#csrfhashresarvation').val();
	var url = baseurl+"ordermanage/order/showpaymentmodal/"+orderid;
	callback = function(a){
		$("#modal-ajaxview").html(a);
		$('#get-order-flag').val('2');
	};
	if(value == null){
		
	getAjaxModal(url);
	}
	else{
		getAjaxModal(url,callback); 
	}
}

function addtomaininvoice(){
	var finyear = $("#finyear").val();

	if(finyear<=0){
		
		setTimeout(function () {
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
				
	};
	toastr.error("Please Create Financial Year First ", 'Error');
	}, 100);
		return false;
	}
	var hc_order_id = $('#hc_order_id').val();
	var csrf = $('#csrfhashresarvation').val();
	var url= baseurl+"ordermanage/order/addtomaininvoice";
	$.ajax({
			type: "POST",
			url: url,
			data:{csrf_test_name:csrf,
			hc_order_id:hc_order_id
		},
			success: function(data) {
			
			if (data != ''){
			$('#payprint_marge').modal('hide');
			$('#modal-ajaxview').empty();
			prevsltab.trigger( "click" );
			swal({
				title: "Succsess",
				text: "Bill is Added in Main Invoice !!",
				type: "success",
				confirmButtonColor: "#28a745",
				confirmButtonText: "Ok",
				closeOnConfirm: true
				
			});
				
			}
				
		}
	}); 
	
}

/*all ongoingorder product as ajax*/
$(document).on('click','#add_new_payment_type',function(){
	var gtotal=$("#grandtotal").val();
	var total = 0;
			$( ".pay" ).each( function(){
				total += parseFloat( $( this ).val() ) || 0;
			});
	if(total==gtotal){
		swal({
			title: "Failed",
			text: "Paid amount is exceed to Total amount.",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
			});
		$("#pay-amount").text('0'); 
		return false;
		}
	var orderid = $('#get-order-id').val();
	var csrf = $('#csrfhashresarvation').val();
		var url= baseurl+"ordermanage/order/showpaymentmodal/"+orderid+"/1";
		$.ajax({
			type: "GET",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			$('#add_new_payment').append(data);
			var length = $(".number").length;
			$(".number:eq("+(length-1)+")").val(parseFloat($("#pay-amount").text()));
			
			
		}
	}); 
});
$(document).on('click','.close_div',function(){
	$(this).parent('div').remove();
	changedueamount();
});
/*show due invoice*/
$(document).on('click','.due_print',function(){
		var id = $(this).children("option:selected").val();
		var url= $(this).attr("data-url");
		var csrf = $('#csrfhashresarvation').val();
		$.ajax({
			type: "GET",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			printRawHtml(data);
		}
	}); 
});
$(document).on('click','.due_mergeprint',function(){
		var id = $(this).children("option:selected").val();
		var url= $(this).attr("data-url");
		var csrf = $('#csrfhashresarvation').val();
		$.ajax({
			type: "GET",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			printRawHtml(data);
		}
	}); 
});
	function printmergeinvoice(id){
	var id=atob(id);
	var csrf = $('#csrfhashresarvation').val();
	var url = baseurl+'ordermanage/order/checkprint/'+id;
		$.ajax({
			type: "GET",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			printRawHtml(data);

	}

	});
}

function showhidecard(element){
	var cardtype = $(element).val();
	var data = $(element).closest('div.row').next().find('div.cardarea');
	
	if(cardtype==4){
	$("#isonline").val(0);
	$(element).closest('div.row').next().find('div.cardarea').addClass("display-none");
	$(element).closest('div.row').next().find('div.cardarea3').addClass("display-none");
	$(element).closest('div.row').next().find('div.cardarea2').addClass("display-none");
	$("#assigncard_terminal").val('');
	$("#assignbank").val('');
	$("#assignlastdigit").val('');
	$("#account_number").val('');
	
	}
	else if(cardtype==6){
	$("#isonline").val(0);
	$(element).closest('div.row').next().find('div.cardarea').addClass("display-none");
	$(element).closest('div.row').next().find('div.cardarea2').removeClass("display-none");
	$(element).closest('div.row').next().find('div.cardarea3').addClass("display-none");
	$("#assigncard_terminal").val('');
	$("#assignbank").val('');
	$("#assignlastdigit").val('');
	$("#account_number").val('');
	}
	else if(cardtype==1){
		$("#isonline").val(0);
		$(element).closest('div.row').next().find('div.cardarea').addClass("display-none");
		$(element).closest('div.row').next().find('div.cardarea2').addClass("display-none");
		$(element).closest('div.row').next().find('div.cardarea3').removeClass("display-none");
		$("#assigncard_terminal").val('');
		$("#assignbank").val('');
		$("#assignlastdigit").val('');
		$("#account_number").val('');
		}
	else {
	$("#isonline").val(0);
	$(element).closest('div.row').next().find('div.cardarea').removeClass("display-none");
	$(element).closest('div.row').next().find('div.cardarea3').addClass("display-none");
	$(element).closest('div.row').next().find('div.cardarea2').addClass("display-none");
	}
		
}

function submitmultiplepay(){
	var finyear = $("#finyear").val();
	var thisForm = $('#paymodal-multiple-form');
	var inputval = parseFloat(0);
	var maintotalamount = $('#due-amount').text();
	
	$(".number").each(function(){
		var inputdata= parseFloat($(this).val());
		inputval = inputval+inputdata;

	});
	
	if(finyear<=0){
		setTimeout(function () {
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
			};
			toastr.error("Please Create Financial Year First ", 'Error');
		}, 100);
		return false;
	}
	if(inputval<parseFloat(maintotalamount)){
		
		setTimeout(function () {
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
				
	};
	toastr.error("Pay full amount ", 'Error');
	}, 100); 
	return false;
	}
	var formdata = new FormData(thisForm[0]);
	
		$.ajax({
		type: "POST",
		url:baseurl+"ordermanage/order/paymultiple",
		data: formdata,
		processData: false,
		contentType: false,
		success:function(data){
			var value = $('#get-order-flag').val();
			if(value ==1){
				setTimeout(function () {
				toastr.options = {
				closeButton: true,
				progressBar: true,
				showMethod: 'slideDown',
				timeOut: 4000
				
		};
		toastr.success("payment taken successfully", 'Success');
		$('#payprint_marge').modal('hide');
		$('#modal-ajaxview').empty();
		prevsltab.trigger( "click" );


	}, 100); }
				else{
					$('#payprint_marge').modal('hide');
					$('#modal-ajaxview').empty();
					printRawHtml(data);
					prevsltab.trigger( "click" );
				}
			
		},

	});
}
function changedueamount(){
	var inputval = parseFloat(0);
	var maintotalamount = $('#due-amount').text();
	
	$(".number").each(function(){
		var inputdata= parseFloat($(this).val());
		inputval = inputval+inputdata;

	});
	
		restamount=(parseFloat(maintotalamount))-(parseFloat(inputval));
		var changes=restamount.toFixed(3);
		if(changes <=0){
			$("#change-amount").text(Math.abs(changes));
			$("#pay-amount").text(0);
		}
		else{
			$("#change-amount").text(0);
			$("#pay-amount").text(changes);
		}
		
}
function mergeorderlist(){
var values = $('input[name="margeorder"]:checked').map(function() {
		return $(this).val();
	}).get().join(',');
	var csrf = $('#csrfhashresarvation').val();
	var dataString = 'orderid='+values+'&csrf_test_name='+csrf;
	$.ajax({
		url:baseurl+"ordermanage/order/mergemodal",
		method:"POST",
		data: dataString,
		success:function(data){
		$("#payprint_marge").modal('show');
		$("#modal-ajaxview").html(data);
		$('#get-order-flag').val('2');
		}
		});
}
function duemergeorder(orderid,mergeid){
var allorderid=$("#allmerge_"+mergeid).val();
var csrf = $('#csrfhashresarvation').val();
var dataString = 'orderid='+orderid+'&mergeid='+mergeid+'&allorderid='+allorderid+'&csrf_test_name='+csrf;
	$.ajax({
		url: baseurl+"ordermanage/order/duemergemodal",
		method:"POST",
		data: dataString,
		success:function(data){
		$("#payprint_marge").modal('show');
		$("#modal-ajaxview").html(data);
		$('#get-order-flag').val('2');
		}
		});
}
function margeorderconfirmorcancel(){
var finyear = $("#finyear").val();
	if(finyear<=0){
		setTimeout(function () {
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
			};
			toastr.error("Please Create Financial Year First ", 'Error');
		}, 100);
		return false;
	}

var thisForm = $('#paymodal-multiple-form');
var formdata = new FormData(thisForm[0]);

	$.ajax({
	type: "POST",
	url: baseurl+"ordermanage/order/changeMargeorder",
	data: formdata,
	processData: false,
	contentType: false,
	success:function(data){
		$('#payprint_marge').modal('hide');
		printRawHtml(data);
		prevsltab.trigger( "click" );
	},

});
}
function duemargebill(){

var thisForm = $('#paymodal-multiple-form');
var formdata = new FormData(thisForm[0]);

	$.ajax({
	type: "POST",
	url: baseurl+"ordermanage/order/changeMargedue",
	data: formdata,
	processData: false,
	contentType: false,
	success:function(data){
		$('#payprint_marge').modal('hide');
		printRawHtml(data);
		prevsltab.trigger( "click" );
	},

});
}
function margeorder(){
	var totaldue = 0;
	$(".marg-check").each(function() {
		if ($(this).is(":checked")){
			var id = $(this).val();
			totaldue = parseFloat($('#due-'+id).text())+totaldue;
			
		}
		$('#due-amount').text(totaldue);
		$('#totalamount_marge').text(totaldue); 
		$('#paidamount_marge').val(totaldue);
		});
	}
function checktable(id=null){

	if(id !=null){
	var select = '#person-'+id;
	var valu =  $(select).val();
			$('#table_member').val(valu);
			
			var url= baseurl+"ordermanage/order/checktablecap/"+id;
			}
			else{
				idd = $('#tableid').val();
				var url= baseurl+"ordermanage/order/checktablecap/"+idd;
			}
			var order_person = $('#table_member').val();
			
		
			if(order_person != ""){
		var csrf = $('#csrfhashresarvation').val(); 
		$.ajax({
			type: "GET",
			url: url,
			data:{csrf_test_name:csrf},
			success: function(data) {
			if(order_person > data ){
				
		setTimeout(function () {
				
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000,
				
				};
	toastr.warning('table capacity overflow', 'Warning');
	


}, 300);
	}
	else{
		if(id !=null){
		$('#tableid').val(id).trigger('change');
			$('#table_member_multi').val(0);
		$('#table_member_multi_person').val(0);
		$('#table_person').val(order_person);
		$('#tablemodal').modal('hide');
		}
	
		return false;

	}
			
	}

	}); 
	}
	else{
	
		setTimeout(function () {
			$("#table_member").focus();
		
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000,
				
				};
	toastr.error('Please type Number of person', 'Error');
	


}, 300);
		

	}
	}

function showTablemodal(){

var url = base+"ordermanage/order/showtablemodal";

getAjaxModal(url,false,'#table-ajaxview','#tablemodal');

}
function showfloor(floorid){
		var csrf = $('#csrfhashresarvation').val();

		var geturl=base+"ordermanage/order/fllorwisetable";
		var dataString = "floorid="+floorid+'&csrf_test_name='+csrf;

		$.ajax({
			type: "POST",
			url: geturl,
			data: dataString,
			success: function(data) {
				$('#floor'+floorid).html(data);
			} 
	});
}
function deleterow_table(id,tableid=null)
{
var csrf = $('#csrfhashresarvation').val();
	var dataString = 'csrf_test_name='+csrf;
if(tableid==null){
var url = base+"ordermanage/order/delete_table_details/"+id;
$.ajax({
			type: "GET",
			url: url,
			data:dataString,
			success: function(data) {
			if(data ==1){
				$('#table-tr-'+id).remove(); 
			}
			}
	}); 
}
else{
		var url = base+"ordermanage/order/delete_table_details_all/"+tableid;
$.ajax({
			type: "GET",
			url: url,
			data:dataString,
			success: function(data) {
			if(data ==1){
				$('#table-tbody-'+tableid).empty();

			}
			}
	});
}

}

function multi_table(){
	var arr =  $('input[name="add_table[]"]:checked').map(function() {
return this.value;
		}).get();
	$('#table_member_multi').val(arr);
	var value =[];
	var order_person_t =0;
	for(i=0; i < arr.length; i++){
		value[i] = $('#person-'+arr[i]).val();
		order_person_t +=parseInt($('#person-'+arr[i]).val());
	}
	
	
		$('#table_member').val($('#person-'+arr[0]).val());
	$('#table_person').val(order_person_t);
	$('#table_member_multi_person').val(value);
	
	$('#tablemodal').modal('hide');
	$('#tableid').val(arr[0]).trigger('change');
}
	function update_product_namesrc(){
		var tid = $('#update_product_name').val();
		var idvid=tid.split('-');
		var id=idvid[0];
		var vid=idvid[1];
		var csrf = $('#csrfhashresarvation').val();
		var updateid=$("#saleinvoice").val();
		var url= base+'ordermanage/order/addtocartupdate_uniqe'+'/'+id+'/'+updateid;
		var dataString = 'csrf_test_name='+csrf;
			/*check production*/
			/*please fixt cart total counting*/
			var productionsetting = $('#production_setting').val();
			if(productionsetting == 1){
				
				var checkqty = 1;
				var checkvalue = checkproduction(id,vid,checkqty);

					if(checkvalue == false){
							$('#update_product_name').html('');
						return false;
					}
				
			}
		/*end checking*/
		$.ajax({
			type: "GET",
			url: url,
			data:dataString,
			success: function(data) {
		
				var myurl =base+"ordermanage/order/adonsproductadd"+'/'+id;
				$.ajax({
				type: "GET",
				url: myurl,
				data:dataString,
				success: function(data) {
						$('.addonsinfo').html(data);
						$('#edit').modal('show');
						var tax=$('#tvat').val();
					var discount=$('#tdiscount').val();
					var tgtotal=$('#tgtotal').val();
					$('#vat').val(tax);
					$('#calvat').text(tax);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
					$('#invoice_discount').val(discount);
					$('#caltotal').text(tgtotal);
					$('#grandtotal').val(tgtotal);
					$('#orggrandTotal').val(tgtotal);
					$('#orginattotal').val(tgtotal);
						$('#update_product_name').html('');

				} 
				});

			} 
	});


}
$(function($){
var barcodeScannerTimer;
var barcodeString = '';

$('#customer_name').on("select2:open", function () { 
document.getElementsByClassName('select2-search__field')[0].onkeypress = function(evt) { 
barcodeString = barcodeString + String.fromCharCode(evt.charCode);
clearTimeout(barcodeScannerTimer);
barcodeScannerTimer = setTimeout(function () {
	processbarcodeGui();
}, 300);
}
});
function processbarcodeGui() {
if (barcodeString != '') {
	var customerid = Number(barcodeString).toString();
	if(Math.floor(customerid) == customerid && $.isNumeric(customerid)){ 
	$("#customer_name").select2().val(customerid).trigger('change');
	}
	$('#customer_name').val(customerid);
} else {
	alert('barcode is invalid: ' + barcodeString);
}

barcodeString = ''; 
}
});

/*for split order js*/
	function showsplitmodal(orderid,option=null){
		var url = base+"ordermanage/order/showsplitorder/"+orderid;
callback = function(a){
	$("#modal-ajaxview").html(a);
	
};
if(option == null){
	
	getAjaxModal(url,false,'#table-ajaxview','#tablemodal');
}
else{
	getAjaxModal(url,callback); 
}
	}

function showsuborder(element){
	var val = $(element).val();
	var url = $(element).attr('data-url')+val;
	var orderid = $(element).attr('data-value');
	var csrf = $('#csrfhashresarvation').val();
	var datavalue = 'orderid='+orderid;
	getAjaxView(url,"show-sub-order",false,datavalue,'post');

} 

function getAjaxView(url,ajaxclass,callback=false,data='',method='get')
{
	var csrf = $('#csrfhashresarvation').val();
	var fulldata=data+'&csrf_test_name='+csrf;
	$.ajax({
		url:url,
		type:method,
		data:fulldata,
		beforeSend:function(xhr){
			
		},
		success:function(result){
			if(callback){
				callback(result);
			return;
			}
			$('#'+ajaxclass).html(result);
		},
		error:function(a){
		}
	});
	return false;
}

function selectelement(element){

	$( ".split-item" ).each(function( index ) {
		
	$(this).removeClass('split-selected');
});
		$(element).toggleClass('split-selected');
}

function addintosuborder(menuid,orderid,element){
	var presentvalue = $(element).find("td:eq(1)").text();
	var isselected = $('.split-selected').length;
	if(presentvalue != 0 && isselected == 1){
	var suborderid = $('.split-selected').attr('data-value');
	var service_chrg = $('#service-'+suborderid).val();
	var csrf = $('#csrfhashresarvation').val();
	var datavalue = 'orderid='+orderid+'&menuid='+menuid+'&suborderid='+suborderid+'&qty='+1+'&service_chrg='+service_chrg;
	var url = $(element).attr('data-url');
	var id = 'table-tbody-'+orderid+'-'+suborderid;
	getAjaxView(url,id,false,datavalue,'post');
	
	var nowvalue = parseInt(presentvalue)-1;
	$(element).find("td:eq(1)").text(nowvalue);
}


}

function paySuborder(element){
		var id = $(element).attr('id').replace('subpay-','');
		var url = $(element).attr('data-url');
	var vat = $('#vat-'+id).val();
		if($('#vat-'+id).length){
		
		var service = $('#service-'+id).val();
		var total = $('#total-sub-'+id).val();
		var customerid = $('#customer-'+id).val();
			$('#tablemodal').modal('hide');
			$("#modal-ajaxview").empty();
		var data = 'sub_id='+id+'&vat='+vat+'&service='+service+'&total='+total+'&customerid='+customerid;
	getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split',data,'post')
		}
	else{
	return false;
	}
}

function submitmultiplepaysub(subid){
	var finyear = $("#finyear").val();
	if(finyear<=0){
		setTimeout(function () {
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
			};
			toastr.error("Please Create Financial Year First ", 'Error');
		}, 100);
		return false;
	}
		var thisForm = $('#paymodal-multiple-form');
			var inputval = parseFloat(0);
	var maintotalamount = $('#due-amount').text();
	
	$(".number").each(function(){
		var inputdata= parseFloat($(this).val());
		inputval = inputval+inputdata;

	});
	if(inputval<parseFloat(maintotalamount)){
		
		setTimeout(function () {
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
				
	};
	toastr.error("Pay full amount ", 'Error');
	}, 100); 
	return false;
}
	var formdata = new FormData(thisForm[0]);
	$.ajax({
	type: "POST",
	url: baseurl+"ordermanage/order/paymultiplsub",
	data: formdata,
	processData: false,
	contentType: false,
	success:function(data){
		var value = $('#get-order-flag').val();
		
				setTimeout(function () {
			toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
				
	};
	toastr.success("payment taken successfully", 'Success');
	$('#payprint_split').modal('hide');
		$('#subpay-'+subid).hide();
					$("#modal-ajaxview-split").empty();
			printRawHtml(data);
				prevsltab.trigger( "click" );

}, 100); 
				
		
	},

});

}

function showsplit(orderid){
	var url = baseurl+'ordermanage/order/showsplitorderlist/'+orderid;
	getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split');
}

function possubpageprint(orderid){
				var csrf = $('#csrfhashresarvation').val();
				$.ajax({
						type: "GET",
						url: baseurl+"ordermanage/order/posprintdirectsub/"+orderid,
						data:{csrf_test_name:csrf},
						success: function(printdata){                                           
								printRawHtml(printdata);
							}
								});
	}
/*end split order js*/
function itemnote(rowid,notes,qty,isupdate,isgroup=null){
		$("#foodnote").val(notes);
		$("#foodqty").val(qty);
		$("#foodcartid").val(rowid);
		$("#foodgroup").val(isgroup);
		if(isupdate==1){
			$("#notesmbt").text("Update Note");
			$("#notesmbt").attr("onclick","addnotetoupdate()");
		}
		else{
			$("#notesmbt").text("Update Note");
			$("#notesmbt").attr("onclick","addnotetoitem()");
			}
		$('#vieworder').modal('show');
}

function addnotetoitem(){
		var rowid=$("#foodcartid").val();
		var note=$("#foodnote").val();
		var foodqty=$("#foodqty").val();
		var csrf = $('#csrfhashresarvation').val();
		var geturl=baseurl+'ordermanage/order/additemnote';
		var dataString = "foodnote="+note+'&rowid='+rowid+'&qty='+foodqty+'&csrf_test_name='+csrf;
		$.ajax({
			type: "POST",
			url: geturl,
			data: dataString,
			success: function(data) {
				setTimeout(function () {
				toastr.options = {
				closeButton: true,
				progressBar: true,
				showMethod: 'slideDown',
				timeOut: 4000
				};
			toastr.success("Note Added Successfully", 'Success');
			$('#addfoodlist').html(data);
			$('#vieworder').modal('hide');
			}, 100); 
				
			} 
	});
}
function addnotetoupdate(){
		var rowid=$("#foodcartid").val();
		var note=$("#foodnote").val();
		var orderid=$("#foodqty").val();
		var group=$("#foodgroup").val();
		var csrf = $('#csrfhashresarvation').val();
		var geturl=baseurl+'ordermanage/order/addnotetoupdate';
		var dataString = "foodnote="+note+'&rowid='+rowid+'&orderid='+orderid+'&group='+group+'&csrf_test_name='+csrf;
		$.ajax({
			type: "POST",
			url: geturl,
			data: dataString,
			success: function(data) {
				setTimeout(function () {
				toastr.options = {
				closeButton: true,
				progressBar: true,
				showMethod: 'slideDown',
				timeOut: 4000
				};
			toastr.success("Note Added Successfully", 'Success');
			$('#updatefoodlist').html(data);
			$('#vieworder').modal('hide');
			}, 100); 
				
			} 
	});
}
function opencashregister(){
var form = $('#cashopenfrm')[0];
	var formdata = new FormData(form);
	$.ajax({
	type: "POST",
	url: baseurl+"ordermanage/order/addcashregister",
	data: formdata,
	processData: false,
	contentType: false,
	success:function(data){
		if(data==1){
		$("#openregister").modal('hide');
		}
		else{
			alert("Something Wrong!!! .Please Select Counter Number!!");
			}
	}

});
}
function closeopenresister(){
var closeurl=baseurl+"ordermanage/order/cashregisterclose";
var csrf = $('#csrfhashresarvation').val();
$.ajax({
		type: "GET",
		async: false,
		url: closeurl,
		data:{csrf_test_name:csrf},
		success: function(data) {
			$('#openclosecash').html(data);
			var htitle=$("#rpth").text();
			var counter=$("#pcounter").val();
			var puser=$("#puser").val();
			var fullheader = "Cash Register In"+htitle+"\n" + "Counter:"+counter+"\n"+puser;
			$("#openregister").modal('show');
			$('#RoleTbl').DataTable({ 
			responsive: true, 
			paging: true,
			dom: 'Bfrtip',
			"lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
			buttons: [  
				{extend: 'csv', title: 'Open-Close Cash Register', className: 'btn-sm',footer: true,header: true,orientation: 'landscape',messageTop: fullheader}, 
				{extend: 'excel', title: 'Open-Close Cash Register', className: 'btn-sm', title: 'exportTitle',messageTop: fullheader,footer: true,header: true,orientation: 'landscape'}, 
				{extend: 'pdfHtml5', title: 'Open-Close Cash Register',className: 'btn-sm',footer: true,header: true,orientation: 'landscape',messageTop: fullheader,customize: function (doc) {
					doc.defaultStyle.alignment = 'center';
					doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}
				} 
			],
			"searching": true,
				"processing": true,
			
				});
		}
	});
	
}
function closecashregister(){
	var form = $('#cashopenfrm')[0];
	var formdata = new FormData(form);
	$.ajax({
	type: "POST",
	url: baseurl+"ordermanage/order/closecashregister",
	data: formdata,
	processData: false,
	contentType: false,
	success:function(data){
		if(data==1){
		$("#openregister").modal('hide');
		window.location.href=baseurl+"dashboard/home";
		}else{
			alert("Something Wrong On Cash Closing!!!");
			}
	}

});
}

$('.lang_box').on('click', function(event) {
	var submenu = $(this).next('.lang_options');
		submenu.slideToggle(400, function(){
	
});
});

$(document).on('click', '.cancelorder', function(){ 
var ordid= $(this).attr("data-id");
$("#cancelord").modal('show');
$("#canordid").html(ordid);
$("#mycanorder").val(ordid);
}); 

$(document).on('click', '#cancelreason', function(){ 
$("#cancelord").modal('hide');
var ordid=$("#mycanorder").val();
var reason=$("#canreason").val();
var csrf = $('#csrfhashresarvation').val();
var dataString = 'status=1&onprocesstab=1&acceptreject=0&reason='+reason+'&orderid='+ordid+'&csrf_test_name='+csrf;
$.ajax({
		type: "POST",
		url: baseurl+"ordermanage/order/acceptnotify",
		data: dataString,
		success: function(data){
			$("#onprocesslist").html(data);
			
			
			swal("Rejected", "Your Order is Cancel", "success");
			prevsltab.trigger('click');
				
		}
	});
});

function newcastsubmit(){ 

"use strict";
var base 		  = $('#base_url').val();
var csrf 		  = $('#csrfhashresarvation').val();
var customer_type = $('#newcustomer_typeres').val();
var cust_idold    = $('#cust_idold').val();
var nameold 	  = $('#nameold').val();
var customer_name = $('#name').val();
var mobile 		  = $('#mobile').val();
var email 		  = $('#email').val();
var umobile_count = $('#unique_mobile_count').val();
if (customer_type == "newcust") {
	if (customer_name != '' && mobile != '' && umobile_count == 0) {
		$.ajax({
			type: "POST",
			url: base+"ordermanage/order/insert_customer",
			data:{
				csrf_test_name:csrf,
				customer_name:customer_name,
				email:email,
				mobile:mobile,
				
			},
		
			success: function(data) {
				
				if (data>  0) {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
						};
					toastr.success("Customer Added Successfully", 'Success');
					
				}
				$('#order_cust').val(data);
				$('.cust_is_add').removeClass("ti-plus");
				$('.cust_is_add').html('1');
				$('#cust_idold').val('');
				$('#nameold').val('');
				$('#name').val('');
				$('#mobile').val('');
				$('#email').val('');
				$('#newcustomer_typeres').val(null).trigger('change');
				$('#cust_idold').val(null).trigger('change');
				$('#client-info').modal('hide');
				$("#customer_name").prop('disabled', true);
				$("#old_cust_data").prop('hidden', true);
				$("#new_cust_data").prop('hidden', true);
			} 
		});
			
	}else{
		swal({
			title: "Failed",
			text: "Please Provide New Customer Information",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
	}
}
else if (customer_type == "oldcust") {
	if (cust_idold != '' && nameold != '') {
		toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 4000
			};
		toastr.success("Customer Added Successfully", 'Success');
			
		$('#order_cust').val(cust_idold);
		$('.cust_is_add').removeClass("ti-plus");
		$('.cust_is_add').html('1');
		$('#nameold').val('');
		$('#name').val('');
		$('#mobile').val('');
		$('#email').val('');
		$('#newcustomer_typeres').val(null).trigger('change');
		$('#cust_idold').val(null).trigger('change');
		$('#client-info').modal('hide');
		$("#customer_name").prop('disabled', true);
		$("#old_cust_data").prop('hidden', true);
		$("#new_cust_data").prop('hidden', true);

	}else{
		swal({
			title: "Failed",
			text: "Please Provide Old Customer Information",
			type: "warning",
			confirmButtonColor: "#28a745",
			confirmButtonText: "Ok",
			closeOnConfirm: true
		});
	}
	
}else{

}
	
}
function ordercust(){ 
var order_cust = $('#customer_name').val();
$('#order_cust').val(order_cust);
$(".newclient").prop('disabled', true);


}

function checkishotel(){ 
var ctypeid = $('#ctypeid').val();
var order_cust = $('#customer_name').val();
if (ctypeid == 6) {
	
	$(".newclient").prop('disabled', true);
}else{
	$(".newclient").prop('disabled', false);

}
if(ctypeid != 6 && order_cust != '' ){
	
	$(".newclient").prop('disabled', true);
}


}
function ordercust2(){ 
var order_cust = $('#customer_name_update').val();
$('#order_cust').val(order_cust);
$(".newclientupdate").prop('disabled', true);


}

function checkishotel2(){ 
var ctypeid = $('#ctypeid_update').val();
var order_cust = $('#customer_name_update').val();
if (ctypeid == 6) {
	
	$(".newclientupdate").prop('disabled', true);
}else{
	$(".newclientupdate").prop('disabled', false);

}
if(ctypeid != 6 && order_cust != '' ){
	
	$(".newclientupdate").prop('disabled', true);
}


}


function newcustdatares(){

var newcustomer_typeres = $('#newcustomer_typeres').val();
	
if (newcustomer_typeres == "newcust") {
	
	$("#new_cust_data").prop('hidden', false);
	$("#old_cust_data").prop('hidden', true);
}

if (newcustomer_typeres == "oldcust") {
	$("#old_cust_data").prop('hidden', false);
	$("#new_cust_data").prop('hidden', true);
	
} 
}

function oldcustdatalistrestaurent() {
"use strict";
var baseurl = $('#base_url').val();
var csrf = $('#csrfhashresarvation').val();
var cust_idold = $('#cust_idold').val();

$.ajax({
	type: "POST",
	dataType: 'json',
	url: baseurl+"ordermanage/order/check_registered_customer",
	data:{
		csrf_test_name:csrf,
		cust_idold:cust_idold,
		
	},
	success: function(data) {
		if (data != null) {
			$('#nameold').val(data.firstname);
		}
	} 
	});
}

$('body').on('keyup', '#mobile', function(){
"use strict";
var baseurl = $('#base_url').val();
var csrf = $('#csrfhashresarvation').val();
var mobile = $('#mobile').val();

$.ajax({
	type: "POST",
	url: baseurl+"ordermanage/order/check_duplicate_customer",
	data:{
		csrf_test_name:csrf,
		mobile:mobile,
		
	},
	success: function(data) {
		$('#unique_mobile_count').val(data);
		console.log(data);
		if (data > 0) {
			$('#mobile_msg').addClass('text-danger');
			$('#mobile_msg').removeClass('text-success');
		}else{
			$('#mobile_msg').addClass('text-success');
			$('#mobile_msg').removeClass('text-danger');
			
		}
	} 
	});

});

