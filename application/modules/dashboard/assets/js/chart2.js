//search chart
$(document).ready(function(){
	'use strict';
	var monthlytotalamount = $('#monthlysaleamount').val();
	var monthlytotalorder = $('#monthlysaleorder').val();
	var month_name = $('#month_name').val();
	var monthly_sale_report = monthlytotalamount.split(",");
	var monthly_sale_order = monthlytotalorder.split(",");
	var monthName = month_name.split(",");
    //line chart
    var ctx = document.getElementById("lineChart2");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthName,
            datasets: [
                {
                    label: "Sale Amount",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: monthly_sale_report
                },
                {
                    label: "Order number",
                    borderColor: "rgba(55, 160, 0, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(55, 160, 0, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: monthly_sale_order
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });
});
