"use strict";
$('#status').attr("disabled", true);

$("input[type='checkbox']").on("change", function() {
    if (this.checked) {
        var id = $(this).val();
        $('#hkproduct_qty' + id).attr("disabled", false);
        $('#hkproduct_qty' + id).val(1);
    } else {
        var id = $(this).val();
        $('#hkproduct_qty' + id).val(0);
        $('#hkproduct_qty' + id).attr("disabled", true);
    }
});