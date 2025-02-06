$(document).ready(function(){
    'use strict';
    var base = $('#base_url').val();
    var edit = $(".edit");
    edit.click(function()
    {
        var template = $(this).parent().prev().text();
        var type = $(this).parent().prev().prev().text();
        var name = $(this).parent().prev().prev().prev().text();
        var id = $(this).data('id');


        $("#id").val(id);
        $("#template_name").val(name); 
        $('select#type option[value='+type+']').attr("selected", "selected");  
        $("#message").html(template);

        $(".tit").text('Sms Template Setup');
        $("#MyForm").attr("action", base+'dashboard/smsetting/template_update');
        $(".sav_btn").text('Update'); 
    });
});