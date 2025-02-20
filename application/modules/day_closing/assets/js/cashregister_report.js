 
 "use strict"; 
function getreportcash(){
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();
	var user = $('#user').val();
	var counterno = $('#counterno').val();
	
	if(from_date!=''){
		 if(to_date==''){
			alert("Please select To date");
			return false;
		 }
		}
		if(to_date!=''){
			if(from_date==''){
				alert("Please select From date");
				return false;
			}
		}
	if(from_date=='' && to_date=='' && user=='' && counterno==''){
		alert("Please select at least one fields");
		return false;
		}
	var myurl =baseurl+'day_closing/cashregister/getcashregister';
	var csrf = $('#csrfhashresarvation').val();
	    var dataString = "from_date="+from_date+'&to_date='+to_date+'&user='+user+'&counter='+counterno+"&csrf_test_name="+csrf;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('#getresult2').html(data);
			$('#respritbl').DataTable({ 
        responsive: true, 
        paging: true,
        dom: 'Bfrtip', 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true}, 
            {extend: 'csv', title: 'Report', className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm prints',exportOptions:{columns: ':visible'}, title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true,customize: function (doc) {
    					doc.defaultStyle.alignment = 'center';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}}, 
            {extend: 'print', className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true},
			{extend: 'colvis', className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true}  
        ],
		"searching": true,
		  "processing": true,
		
    		}); 
		 } 
		});
		 } 
	function detailscash(startdate,enddate,uid){
      var myurl=baseurl+'day_closing/cashregister/getcashregisterorder';
	  var csrf = $('#csrfhashresarvation').val();
		 var dataString = "startdate="+startdate+'&enddate='+enddate+'&uid='+uid+"&csrf_test_name="+csrf;
		  $.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {
				 $('.orddetailspop').html(data);
				 $('#orderdetailsp').modal('show');
				 $('#billorder').DataTable({ 
        responsive: true, 
        paging: true,
		"searching": false,
        dom: 'Bfrtip', 
		order: [[ 0, "desc" ]],
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'csv', title: 'Report', className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm prints',exportOptions:{columns: ':visible'}, title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm prints',exportOptions:{columns: ':visible'},footer: true,customize: function (doc) {
    					doc.defaultStyle.alignment = 'center';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}}
        ],
		  "processing": true,
    		});
			 } 
		});
     
 }