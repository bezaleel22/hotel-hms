"use strict";
$("#category_id").on('change', getproduct);
function getproduct() {
    'use strict';
    var category_id = $("#category_id").find(":selected").val();
    if (category_id == "") {
        $('#product').find('option').not(':first').remove();
        $('#queue').find('option[value=laundry]').remove();
        $('#queue').find('option[value=in_use]').remove();
        return false;
    }
    if(category_id==501){
        $('#queue').append('<option value="laundry">Laundry</option>');
        $('#queue').append('<option value="in_use">In Use</option>');
    }else{
        $('#queue').find('option[value=laundry]').remove();
        $('#queue').find('option[value=in_use]').remove();
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "units/products/productlist";
    if ($('#product')[0].options.length > 1)
        $('#product').find('option').not(':first').remove();
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            category_id: category_id
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $(obj.list).each(function(index){
                $('#product').append('<option value="' + obj.list[index].id + '">' + obj.list[index].product_name + '</option>');
            });
        }
    });
}
$("#chargediv").attr("hidden", true);
"use strict";
$("#queue").on("change", function(){
    var queue = $("#queue").find(":selected").val();
    if(queue=="in_use"){
        $("#dayClose").trigger("click");
        $("#chargediv").attr("hidden", false);
    }
    else if(queue=="laundry"){
        $("#dayClose").trigger("click");
        $("#chargediv").attr("hidden", false);
    }else{
        $("#chargediv").attr("hidden", true);
    }
});
