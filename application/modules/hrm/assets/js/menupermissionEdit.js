$(document).ready(function(){
    'use strict';
    var data = $('#menuItem').val();
    document.forms['myform'].elements['parent_menu'].value=parseInt(data);
});