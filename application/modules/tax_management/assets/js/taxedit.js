"use strict";
$('input[name="isactive"]').on("click", function(){
    if(this.checked==true){
        $('input[name="isactive"]').val("1");
    }else{
        $('input[name="isactive"]').val("0");
    }
});