"use strict";
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

  function clrimage(){
 
    $("#room_name").val($("#room_name option:first").val());
		$('.selectpicker').selectpicker('refresh');
    $('.jsclrimg').attr('src', baseurl+'assets/img/room-setting/room_images.png');
  }
