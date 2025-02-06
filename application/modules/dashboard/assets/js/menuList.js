function editmenu(status,parent,menuid){
	'use strict';
	var menu_name=$("#menu_name-"+menuid).text().trim();
	var menu_slug=$("#menu_slug-"+menuid).text().trim();
    var base = $('#base_url').val();
	$("#menuname").val(menu_name);
	$("#Menuurl").val(menu_slug);
	if(parent!=0)
	$("#menuid").val(parent).trigger('change');
	$("#btnchnage").text("Update");
	$("#upbtn").show();
	$("#top_upbtn").show();
	$('#menuurl').attr('action', base+"dashboard/web_setting/editmenu/"+menuid);
	}