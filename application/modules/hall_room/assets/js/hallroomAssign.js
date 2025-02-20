function getroom(){
    'use strict';
    var base = $('#base_url').val();
    var id=$("#room_name").val();
    var csrf = $('#csrf_token').val();
     var myurl = base+"hall_room/hallroom/getfloorwithroom"+'/'+id;
     var dataString = "id="+id;
     $.ajax({
     type: "POST",
     url: myurl,
     data: {csrf_test_name: csrf, dataString},
     success: function(data) {
         $('#floorandroom').html(data);
         $('[data-toggle="tooltip"]').tooltip();   
     } 
  });
}