//all js 
'use strict';
function editunit(unitid){
	   var myurl =baseurl+'units/unitmeasurement/updateunitfrm/'+unitid;
	    var dataString = "unitid="+unitid;
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editunit').html(data);
			 $('#edit').modal('show');
		 } 
	});
	}
'use strict';
function editingredient(inid){
	   var myurl =baseurl+'units/products/updateintfrm/'+inid;
	    var dataString = "unitid="+inid;
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editunit').html(data);
			 $('select').selectpicker();
			 $('#edit').modal('show');
		 } 
	});
	}
	function payinfo(id){
		'use strict';
		   var geturl=$("#urls_"+id).val();
		   var myurl =geturl+'/'+id;
			var dataString = "id="+id;
			 $.ajax({
			 type: "GET",
			 url: myurl,
			 data: dataString,
			 success: function(data) {
				 $('.paymentinfo').html(data);
				 $('#payment').modal('show');
				 $('select').selectpicker();
				 $('#dayClose').trigger('click');
			 } 
		});
		}		