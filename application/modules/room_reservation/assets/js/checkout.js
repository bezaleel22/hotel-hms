"use strict";

// Tax toggle handler
$(document).ready(function() {
    // Set initial state to tax inclusive (default)
    $("#taxToggle").prop("checked", false);
    $("#taxOperation").text("(-)");
    calculateTax();

    $("#taxToggle").on("change", function() {
        var isExclusive = $(this).is(":checked");
        $("#taxOperation").text(isExclusive ? "(+)" : "(-)");
        calculateTax();
    });
});

// Calculate tax based on toggle state
function calculateTax() {
    var totalAmount = parseFloat($("#totalroomrentamount").text()) || 0;
    var taxPercent = parseFloat($("#tax_percent").val()) || 0;
    var schargePercent = parseFloat($("#service_percent").val()) || 0;
    var scharge = (totalAmount * schargePercent) / 100;
    
    // Initialize variables
    var baseAmount = 0;
    var taxAmount = 0;
    
    // Update room details table calculations
    $("table.tr-background tbody tr").each(function() {
        var row = $(this);
        var ratePerDay = parseFloat(row.find("td:nth-child(5)").text()) || 0;
        var numDays = parseFloat(row.find("td:nth-child(4)").text()) || 0;
        var rowTotal = ratePerDay * numDays;

        // Handle tax cells
        var taxCells = row.find("td:contains('tax')");
        
        if (taxPercent <= 0) {
            // No tax case
            taxCells.each(function() {
                $(this).text("0.00");
            });
            row.find("td:nth-last-child(3)").text(rowTotal.toFixed(2));
            row.find("td:last-child").text(rowTotal.toFixed(2));
        } else if ($("#taxToggle").is(":checked")) {
            // Tax Exclusive Mode
            if (taxCells.length > 1) {
                // Multiple tax rates
                var taxPerRate = taxPercent / taxCells.length;
                taxCells.each(function() {
                    var singleTaxAmount = (rowTotal * taxPerRate) / 100;
                    $(this).html("+" + singleTaxAmount.toFixed(2));
                });
            } else {
                // Single tax
                var rowTax = (rowTotal * taxPercent) / 100;
                row.find("td:nth-last-child(2)").html("+" + rowTax.toFixed(2));
            }
            row.find("td:nth-last-child(3)").text(rowTotal.toFixed(2));
            row.find("td:last-child").text((rowTotal * (1 + taxPercent/100)).toFixed(2));
        } else {
            // Tax Inclusive Mode
            if (taxCells.length > 1) {
                var baseAmount = (rowTotal * 100) / (100 + taxPercent);
                var totalTaxAmount = rowTotal - baseAmount;
                var singleTaxAmount = totalTaxAmount / taxCells.length;
                taxCells.each(function() {
                    $(this).text(singleTaxAmount.toFixed(2));
                });
            } else {
                var baseAmount = (rowTotal * 100) / (100 + taxPercent);
                var rowTax = rowTotal - baseAmount;
                row.find("td:nth-last-child(2)").text(rowTax.toFixed(2));
            }
            row.find("td:nth-last-child(3)").text(baseAmount.toFixed(2));
            row.find("td:last-child").text(rowTotal.toFixed(2));
        }
    });
    
    // Calculate total base amount and tax
    var tableTotal = 0;
    var tableTax = 0;
    $("table.tr-background tbody tr").each(function() {
        tableTotal += parseFloat($(this).find("td:nth-last-child(3)").text()) || 0;
        tableTax += parseFloat($(this).find("td:nth-last-child(2)").text().replace("+", "")) || 0;
    });
    
    // Update summary totals based on tax mode
    if ($("#taxToggle").is(":checked")) {
        // Tax Exclusive Mode
        $("#booking_charge").text(tableTotal.toFixed(2));
        $("#tax_charge").html("+" + tableTax.toFixed(2));
        var totalExclusive = tableTotal + tableTax + scharge;
        $("#total_charge").text(totalExclusive.toFixed(2));
        $("#totalamount").val(totalExclusive.toFixed(2));
    } else {
        // Tax Inclusive Mode (default)
        var totalInclusive = parseFloat($("#allroomrent").text()) || 0;
        var baseAmount = (totalInclusive * 100) / (100 + taxPercent);
        var taxAmount = totalInclusive - baseAmount;
        
        $("#booking_charge").text(baseAmount.toFixed(2));
        $("#tax_charge").text(taxAmount.toFixed(2));
        $("#total_charge").text((totalInclusive + scharge).toFixed(2));
        $("#totalamount").val((totalInclusive + scharge).toFixed(2));
    }

    // Update other dependent amounts with current totals
    updatePayableAmount();
}

// Print handler
$('.print-btn').on('click', function() {
    var isExclusive = $("#taxToggle").is(":checked");
    var taxPercent = parseFloat($("#tax_percent").val()) || 0;
    var schargePercent = parseFloat($("#service_percent").val()) || 0;

    // Update room details table in print view
    $("#printArea table.invp-17 tbody tr").each(function() {
        var row = $(this);
        // Get initial values
        var ratePerDay = parseFloat(row.find("td.invp-20").eq(0).text()) || 0;
        var numDays = parseInt(row.find("td.invp-19").text()) || 0;
        var subtotal = ratePerDay * numDays;
        
        // Get tax cells
        var taxCells = row.find("td.invp-20:contains('tax')");

        if (taxPercent <= 0) {
            // No tax case
            taxCells.each(function() {
                $(this).text("0.00");
            });
            row.find("td.invp-20").eq(4).text(subtotal.toFixed(2));
            row.find("td.invp-21").text(subtotal.toFixed(2));
        } else if (isExclusive) {
            // Tax Exclusive Mode
            row.find("td.invp-20").eq(4).text(subtotal.toFixed(2));  // Tot. Rent
            
            if (taxCells.length > 1) {
                // Multiple tax rates
                var taxPerRate = taxPercent / taxCells.length;
                var totalTaxAmount = 0;
                taxCells.each(function() {
                    var singleTaxAmount = (subtotal * taxPerRate) / 100;
                    $(this).html("+" + singleTaxAmount.toFixed(2));
                    totalTaxAmount += singleTaxAmount;
                });
                row.find("td.invp-21").text((subtotal + totalTaxAmount).toFixed(2));
            } else {
                // Single tax rate
                var taxAmount = (subtotal * taxPercent) / 100;
                row.find("td.invp-20:contains('tax')").html("+" + taxAmount.toFixed(2));
                row.find("td.invp-21").text((subtotal + taxAmount).toFixed(2));
            }
        } else {
            // Tax Inclusive Mode
            var baseAmount = (subtotal * 100) / (100 + taxPercent);
            row.find("td.invp-20").eq(4).text(baseAmount.toFixed(2));  // Tot. Rent
            
            if (taxCells.length > 1) {
                // Multiple tax rates
                var totalTaxAmount = subtotal - baseAmount;
                var taxPerCell = totalTaxAmount / taxCells.length;
                taxCells.each(function() {
                    $(this).text(taxPerCell.toFixed(2));
                });
            } else {
                // Single tax rate
                var taxAmount = subtotal - baseAmount;
                row.find("td.invp-20:contains('tax')").text(taxAmount.toFixed(2));
            }
            row.find("td.invp-21").text(subtotal.toFixed(2));
        }
    });

    // Calculate summary totals from table rows
    var totalRent = 0;
    var totalTax = 0;
    var schargeTotal = parseFloat($("#scharge").text()) || 0;

    $("#printArea table.invp-17 tbody tr").each(function() {
        // Sum total rent from each row
        totalRent += parseFloat($(this).find("td.invp-20").eq(4).text()) || 0;
        
        // Sum all tax cells in the row
        $(this).find("td.invp-20:contains('tax')").each(function() {
            totalTax += parseFloat($(this).text().replace("+", "")) || 0;
        });
    });

    // Format currency values
    var currencyPosition = parseInt($("#position").val()) || 1;
    var currencySymbol = $("#currency").val() || "";
    
    function formatCurrency(amount) {
        return currencyPosition == 1 ?
            currencySymbol + amount.toFixed(2) :
            amount.toFixed(2) + currencySymbol;
    }

    // Update summary section
    if (isExclusive) {
        // Tax Exclusive Mode
        $("#printArea .invp-24 tbody tr:eq(0) td:eq(1) small").text(formatCurrency(totalRent));
        $("#printArea .invp-24 tbody tr:eq(1) td:eq(1) small").html("+" + formatCurrency(totalTax));
        $("#printArea .invp-24 tbody tr:eq(2) td:eq(1) small").text(formatCurrency(schargeTotal));
        var grandTotal = totalRent + totalTax + schargeTotal;
    } else {
        // Tax Inclusive Mode
        $("#printArea .invp-24 tbody tr:eq(0) td:eq(1) small").text(formatCurrency(totalRent));
        $("#printArea .invp-24 tbody tr:eq(1) td:eq(1) small").text(formatCurrency(totalTax));
        $("#printArea .invp-24 tbody tr:eq(2) td:eq(1) small").text(formatCurrency(schargeTotal));
        var grandTotal = totalRent + schargeTotal;
    }

    // Update grand total with proper currency formatting
    $("#printArea .invp-24 tbody tr:last td:eq(1)")
        .html("<strong>" + formatCurrency(grandTotal) + "</strong>");

    $.print(".print-content");
});

// Update payable amount when tax or other charges change
function updatePayableAmount() {
    var total = parseFloat($("#totalamount").val()) || 0;
    var advance = parseFloat($("#alladvanceamount").text()) || 0;
    var complementary = parseFloat($("#allcomplementarycharge").text()) || 0;
    var bpccharge = parseFloat($("#allbpccharge").text()) || 0;
    var promocode = parseFloat($("#disamount").text()) || 0;
    
    var payable = total + complementary + bpccharge - advance - promocode;
    $("#payableamount").text(payable.toFixed(2));
    $("#payableamt").text(payable.toFixed(2));
}

$("#chroomno").on("click",function(){
    var chform = $("#chroomno").val();
    if(chform){
        $("#go").attr("disabled",false);
    }else{
        $("#go").attr("disabled",true);
    }
});
function checkoutinfo(){
    "use strict";
    $("#dayClose").trigger("click");
    $(".sidebar-mini").addClass('sidebar-collapse');
    $("#checkoutdetail").attr("hidden",false);
    var chroomno = $("#chroomno").val();
    if(chroomno == null){
        $("#cmsg").attr("hidden",false);
        $("#cmsg").text("Checkout Room No is required");
        return false;
    }else{
        $("#cmsg").attr("hidden",true);
    }
    var csrf = $('#csrf_token').val();
    var myurl = baseurl + "room_reservation/room_reservation/checkoutall/"+chroomno;
    $.ajax({
        url: myurl,
        type: "POST",
        data: {
            csrf_test_name: csrf,
        },
        success: function(data) {
            $("#checkoutdetail").html(data);
        }
    });
}