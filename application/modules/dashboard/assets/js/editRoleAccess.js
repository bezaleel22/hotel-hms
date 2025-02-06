$(document).ready(function(){
    'use strict';
    var user_id = $('#fk_user').val();
    var role_id = $('#fk_role').val();
    document.forms['role_acc'].elements['user_id'].value=parseInt(user_id);
    document.forms['role_acc'].elements['role_id'].value=parseInt(role_id);
});
 