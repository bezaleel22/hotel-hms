function getfacility(){
    'use strict';
    var base = $('#base_url').val();
    var id=$("#room_name").val();
    var csrf = $('#csrf_token').val();
     var myurl = base+"hall_room/hallroom/getfacilities"+'/'+id;
     $.ajax({
     type: "POST",
     url: myurl,
     data:{csrf_test_name: csrf, id: id},
     success: function(data) {
         $('#facilitiandroom').html(data);
         $('[data-toggle="tooltip"]').tooltip();   
     } 
  });
}