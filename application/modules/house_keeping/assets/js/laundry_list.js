$(document).ready(function() {
    "use strict";
    $('#product_id').SumoSelect({
        search: true,
        placeholder: 'Select Product',
        csvDispCount: 5
    });
});
$("#product_id").on("click", allproduct);

function allproduct() {
    "use strict";
    var product_id = $("#product_id").val();
    if (product_id == "" | product_id == null) {
        return false;
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "house_keeping/house_keeping/productlist";
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            product_id: product_id
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $("#product_list").val(obj.product);
            $("#all_checklist").val(obj.getchecklist);
        }
    });
};
"use strict";
$("#type").on("change", function() {
    var type = $("#type").find(":selected").val();
    if (type == "add") {
        $("#add_laundry").empty();
        $("#invoice_no").val('');
        var product_id = $("#product_id").val();
        $("#invoice").attr("hidden", true);
        $("#product").attr("hidden", false);
        if (product_id == "" | product_id == null) {
            swal({
                title: "Failed",
                text: "Please Select Product First",
                type: "error",
                confirmButtonColor: "#28a745",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            });
            $('#type option:eq(0)').prop('selected', true);
            $("#sbmtbtn").attr("hidden", true);
            return false;
        }
        $("#sbmtbtn").attr("hidden", false);
        var product = $("#product_list").val();
        var checklist = $("#all_checklist").val();
        var productlist = product.split(",");
        var allchecklist = checklist.split(",,");
        for (var j = 0; j < product_id.length; j++) {
            var singlechecklist = allchecklist[j];
            if (singlechecklist != null) {
                var check_list = singlechecklist.split(",");
            }
            var rows = "";
            rows +=
                '<div class="d-flex justify-content-between align-items-center"><div class="form-group row"><span for="type" class="col">' +
                (j + 1) + '.</span></div>' +
                '<div class="form-group row"><label for="type" class="col">' + productlist[j] +
                '</label></div>' +
                '<div class="form-group row"><div class="col-sm-12"><input type="number" id="quantity" required min="0" class="form-control" placeholder="Quantity" name="quantity[]" value="" required /></div></div>' +
                '<div class="form-group row"><div class="col-sm-12"><select name="stock" id="stock" class="form-control" required><option value="" selected="selected">Select Stock</option><option value="in_use">In Use</option><option value="ready">Ready</option></select></div></div>' +
                '<div class="form-group row"><div class="col-sm-12 customesl"><select multiple name="checklist_' +
                product_id[j] + '[]" id="checklist' + j +
                '" required class="form-control"></select></div></div>' +
                '<div class="form-group row"><div class="col-sm-12"><textarea rows="1" col="3" name="comments[]" placeholder="Comments"class="form-control"></textarea></div></div></div>';

            $("#add_laundry").append(rows);
            for (var k = 0; k < check_list.length; k++) {
                if (check_list[k] != '-') {
                    $('#checklist' + j).append('<option value="' + check_list[k] + '">' + check_list[k] +
                        '</option>');
                }
            }
            $('#checklist' + j).SumoSelect({
                search: true,
                placeholder: 'Select Checklist',
                csvDispCount: 5
            });
        }
        $("#sbmtbtn").text("Add");
    } else if (type == "recieve") {
        $('select#product_id')[0].sumo.unSelectAll();
        $("#invoice").attr("hidden", false);
        $("#product").attr("hidden", true);
        $("#add_laundry").empty();
        $("#sbmtbtn").attr("hidden", true);
        $("#sbmtbtn").text("Recieve");
    } else {
        $("#invoice").attr("hidden", true);
        $("#product").attr("hidden", true);
        $("#add_laundry").empty();
        $("#sbmtbtn").attr("hidden", true);
        $('select#product_id')[0].sumo.unSelectAll();
        $("#invoice_no").val('');
    }
});
$("#invoice_no").on("change", function() {
    var invoice_no = $("#invoice_no").val();
    if (invoice_no == "" | invoice_no == null) {
        return false;
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "house_keeping/house_keeping/productlist";
    $("#add_laundry").empty();
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
            invoice_no: invoice_no
        },
        success: function(data) {
            $("#add_laundry").html(data);
            'use strict';
            $('.checklist').SumoSelect({
                search: true,
                placeholder: 'Select Checklist',
                csvDispCount: 5
            });
            if (data.substring(29, 31) == "In") {
                $("#sbmtbtn").attr("hidden", true);
            } else {
                $("#sbmtbtn").attr("hidden", false);
            }
        }
    });
});
$("#category_id").on('change', getproduct);

function getproduct() {
    'use strict';
    var category_id = $("#category_id").find(":selected").val();
    if (category_id == "" | category_id == null) {
        return false;
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
            $(obj.list).each(function(index) {
                $('#product').append('<option value="' + obj.list[index].id + '">' + obj
                    .list[index]
                    .product_name + '</option>');
            });
        }
    });
}
$("#sbmtbtn").on("click", function() {
    var emp = $("#emp_id").find(":selected").val();
    if (emp == 0 | emp == "") {
        swal({
                title: "Failed",
                text: "Employee field is required",
                type: "error",
                confirmButtonColor: "#28a745",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            });
        return false;
    }
});