function showinvoice(){
    'use strict';
    var geturl=$("#invoiceurl").val();
    var status=$("#status").val();
    var start_date=$("#start_date").val();
    var to_date=$("#to_date").val();
       var dataString = "status="+status+'&startdate='+start_date+'&to_date='+to_date;
        $.ajax({
        type: "POST",
        url: geturl,
        data: dataString,
        success: function(data) {
            $('#itemlist').html(data);
        } 
   });
   
   }
   $("#detail_report").click(function(){
    $("div").hide();
  });