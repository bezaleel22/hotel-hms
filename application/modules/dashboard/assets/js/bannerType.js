function edittype(typename,typeid){
    'use strict';
    var base = $('#base_url').val();
	$("#bannertype").val(typename);
	$("#btnchnage").text("Update");
	$('#typeurl').attr('action', base+"dashboard/web_setting/edittype/"+typeid);
	}