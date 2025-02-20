"use strict";
$("#lsbmit").prop("disabled", true);
var i = 0;
$("input[type='checkbox']").on("change", function() {
    if (this.checked) {
        i++;
    } else {
        i--;
    }
    if (i > 0) {
        $("#lsbmit").prop('disabled', false);
    } else {
        $("#lsbmit").prop("disabled", true);
    }
});