"use strict";
$("#stsbmit").prop("disabled", true);
var i = 0;
$("input[type='checkbox']").on("change", function() {
    if (this.checked) {
        i++;
    } else {
        i--;
    }
    if (i > 0) {
        $("#stsbmit").prop('disabled', false);
    } else {
        $("#stsbmit").prop("disabled", true);
    }
});