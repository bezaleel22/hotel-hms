function getinvoice(){
    'use strict';
    var csrf = $('#csrf_token').val();
    var geturl=$("#invoiceurl").val();
    var suplierid=$("#supplier_id").val();
        $.ajax({
        type: "POST",
        url: geturl,
        data: {csrf_test_name: csrf, id: suplierid},
        success: function(data) {
            $('#invoicelist').html(data);
             $('select').selectpicker();
        } 
   });
   
   }
   
function showinvoice(){
    'use strict';
    var csrf = $('#csrf_token').val();
    var geturl=$("#serachurl").val();
    var suplierid=$("#supplier_id").val();
    var invoice=$("#invoice").val();
    if(invoice==''){
      swal({
        title: "Failed",
        text: "Please Select Invoice",
        type: "error",
        confirmButtonColor: "#28a745",
        confirmButtonText: "Ok",
        closeOnConfirm: true
    });
        return false;
        }
        $('#purchase_div').show()
    var myurl= geturl+"/"+invoice;
        $.ajax({
        type: "POST",
        url: myurl,
        data: {csrf_test_name: csrf, invoice: invoice},
        success: function(data) {
            $('#itemlist').html(data);
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
        } 
   });
   }
function calculate_store(sl) {
    'use strict';
       var gr_tot = 0;
       var item_ctn_qty    = $("#quantity_"+sl).val();
       var vendor_rate = $("#product_rate_"+sl).val();
       var discount    = $("#discount_"+sl).val();
       var total_price     = (item_ctn_qty * vendor_rate)-discount;
       $("#total_price_"+sl).val(total_price.toFixed(2));

       //Total Price
       $(".total_price").each(function() {
           isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
       });

       $("#grandTotal").val(gr_tot.toFixed(2,2));
   }
function checkboxcheck(sl){
    'use strict';
       var check_id    ='check_id_'+sl;
       var total_qntt  ='quantity_'+sl;
       var product_rate ='product_rate_'+sl;
       var store_id ='store_id_'+sl;
       var product_id ='product_id_'+sl;
      var grandTotal ='grandTotal';
       if($('#'+check_id).prop("checked") == true){
           document.getElementById(total_qntt).setAttribute("required","required");
           document.getElementById(total_qntt).setAttribute("name","total_qntt[]");
           document.getElementById(product_rate).setAttribute("name","product_rate[]");
           document.getElementById(product_id).setAttribute("name","product_id[]");
           document.getElementById(grandTotal).setAttribute("name","grand_total_price");
       }
       else if($('#'+check_id).prop("checked") == false){
           document.getElementById(total_qntt).removeAttribute("required");
           document.getElementById(total_qntt).removeAttribute("name");
           document.getElementById(product_id).removeAttribute("name");
           document.getElementById(product_rate).removeAttribute("name");
            document.getElementById(grandTotal).removeAttribute("name");
       }
   };
function checkrequird(sl) {
    'use strict';
  var  quantity=$('#total_qntt_'+sl).val();
  var check_id    ='check_id_'+sl;
   if (quantity == null || quantity == 0 || quantity == ''){
   document.getElementById(check_id).removeAttribute("required");
   }else{
      
        document.getElementById(check_id).setAttribute("required","required");
   }
}
function checkqty(sl)
{
    'use strict';
  var order_qty = $('#orderqty_'+sl).val();
 var quant=$('#quantity_'+sl).val();
 var vendor_rate =$("#product_rate_"+sl).val();
 var discount    = $("#discount_"+sl).val();
 var total_price     = (quant * vendor_rate)-discount;
 var diductprice= total_price.toFixed(2);  
 var grtotal=$("#grandTotal").val();
 var tretqty=0;
 $('.retqty').each(function() {
     tretqty+=+$( this ).val();
         });
 if(tretqty>0){
  $("#add_return").show();
 }
 else{
      $("#add_return").hide();
     }
 
 if (isNaN(quant)) 
 {
  swal({
    title: "Failed",
    text: "Must input numbers",
    type: "error",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
    closeOnConfirm: true
});
   document.getElementById("quantity_"+sl).value = '';
   document.getElementById("total_price_"+sl).value = '';
   return false;
 }
 if (parseFloat(quant) <= 0) 
 {
  swal({
    title: "Failed",
    text: "You Can Not Return Less than 0",
    type: "error",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
    closeOnConfirm: true
});
     document.getElementById("quantity_"+sl).value = '';
       document.getElementById("total_price_"+sl).value = '';
   return false;
 }
 if (parseFloat(quant) > parseFloat(order_qty)) 
 {
      var diductprice= total_price.toFixed(2);  
      var grtotal=$("#grandTotal").val();
      if(grtotal>0){
      var restprice=parseFloat(grtotal)-parseFloat(diductprice);
      $("#grandTotal").val(restprice.toFixed(2));
      }
    
    setTimeout(function(){
      swal({
        title: "Failed",
        text: "You Can Not return More than Order quantity",
        type: "error",
        confirmButtonColor: "#28a745",
        confirmButtonText: "Ok",
        closeOnConfirm: true
    });
      document.getElementById("quantity_"+sl).value = '';
      document.getElementById("total_price_"+sl).value = '';
     }, 500);
   return false;
 }
 
}
