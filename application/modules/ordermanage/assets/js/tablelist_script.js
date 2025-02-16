    "use strict"; 
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
$(function(){
  $('#filename').change(function(){
   	var fileInput = $('#filename')[0];
	   var uploadurl= $('#uploadurl').val();
	   if( fileInput.files.length > 0 ){
            var formData = new FormData();
            var CSRF_TOKEN = $('#csrf_token').val();
			formData.append('csrf_test_name', CSRF_TOKEN);
			 $.each(fileInput.files, function(k,file){
                formData.append('file_source[]', file);
            });
            $.ajax({
                method: 'post',
                url:uploadurl,
                data: formData,
                dataType: 'POST',
                contentType: false,
                processData: false,
                success: function(data){
					$("#filemanager").modal(hide);
					
                }
            });
        }else{
            console.log('No Files Selected');
        }
	   viewallfile();
  });

});
function viewallfile(){
    window.location.href= baseurl+'ordermanage/restauranttable?table';
	var csrf = $('#csrf_token').val();
	var datastring="test=test&csrf_test_name="+csrf
	 $.ajax({
                method: 'post',
                url: baseurl+'ordermanage/restauranttable/showfile',
                data: datastring,
                dataType: 'POST',
                success: function(data){
					$(".newtable").text(data);
					$("#filemanager").modal(show);
                }
            });
	}

$(document).ready(function(){
    $(".file-man-box").click(function(){
	$(".file-man-box").css("border","1px solid #e3eaef")
    $(this).css("border", "1px solid red");
	var imageurl=$(this).find('img').attr('data-scr');
	$('#pictureurl').val(imageurl);
	$('#pictureurl2').val(imageurl);
	$('#filemanager').modal('hide');
});
});
$(function(){   
	var url      = window.location.href; 
    var pieces = url.split("?");
	if(pieces[1]=='table'){
		$("#add0").modal('show');
		$("#filemanager").modal('show');
		}

});