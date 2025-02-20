"use strict";
$("#sbmit").attr("hidden", true);
var i = 0;
$("input[type='checkbox']").on("change", function() {
    
    if (this.checked) {
        i++;
        
    } else {
        i--;
    }
    if (i > 0) {
        
         $("#sbmit").attr("hidden", false);
    } else {
        $("#sbmit").attr("hidden", true);
    }
});
