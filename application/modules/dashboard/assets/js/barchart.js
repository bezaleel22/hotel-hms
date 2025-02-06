// home/home
$(document).ready(function(){
	'use strict';
    //bar chart
    var monthlytotalamount = $('#monthlytotalamount').val();
    var monthlytotalorder = $('#monthlytotalorder').val();
    var monthname = $('#monthname').val();
    var monthly_total_report = monthlytotalamount.split(",");
	var monthly_total_order = monthlytotalorder.split(",");
    var month_name = monthname.split(",");
    var ctx = document.getElementById("barChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: month_name,
            datasets: [
                {
                    label: "Total Amount",
                    data: monthly_total_report,
                    borderColor: "rgba(55, 160, 0, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(55, 160, 0, 0.5)"
                },
                {
                    label: "Confirmed Booking",
                    data: monthly_total_order,
                    borderColor: "rgba(0,0,0,0.09)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0,0,0,0.07)"
                },
                
            ]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });
	});