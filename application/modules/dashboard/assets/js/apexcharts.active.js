(function ($) {
    "use strict";
    var monthname = $('#monthname').val();
    var shortmonthname = $('#shortmonthname').val();
    var monthlytotalorder = $('#monthlytotalorder').val();
    var monthlytotalpending = $('#monthlytotalpending').val();
    var monthlytotal = $('#monthlytotal').val();
    var totalorder = $('#totalorder').val();
    var totalcheckin = $('#totalcheckin').val();
    var total_order = parseInt(totalorder);
    var total_checkin = parseInt(totalcheckin);
    var totalpending = $('#totalpending').val();
    var total_pending = parseInt(totalpending);
    var totalcancel = $('#totalcancel').val();
    var total_cancel = parseInt(totalcancel);
    var totalbooking = parseInt(totalorder)+parseInt(totalpending)+parseInt(totalcancel);
    var monthly_total_order = monthlytotalorder.split(",");
    var monthly_totalpending = monthlytotalpending.split(",");
    var monthly_total = monthlytotal.split(",");
    var month_name = monthname.split(",");
    var short_monthname = shortmonthname.split(",");
    var apexCharts = {
        initialize: function () {
            this.apexMixedChart();
            this.apexLineChart();
            this.apexPieCharts();
        },
        apexMixedChart: function () {
            var options = {
                colors: ['#FF8C00','#800080'],
                chart: {
                    height: 345,
                    type: 'line',
                },
                series: [{
                        name: 'Booking Confirmed',
                        type: 'column',
                        data: monthly_total_order
                    }, {
                        name: 'Booking Pending',
                        type: 'line',
                        data: monthly_totalpending
                    }],
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                title: {
                    align: 'center',
                    text: 'Customer Reservations'
                },
                labels: short_monthname,
                xaxis: {
                    type: 'MMM \'yy'
                },
                yaxis: [{
                        title: {
                            text: 'Booking Confirmed',
                        },
                    }, {
                        opposite: true,
                        title: {
                            text: 'Booking Pending'
                        }
                    }]

            }
            var chart = new ApexCharts(
                    document.querySelector("#apexMixedChart"),
                    options
                    );

            chart.render();
        },
        apexLineChart: function () {
            var options = {
                chart: {
                    height: 350,
                    type: 'line',
                    fontFamily: 'Nunito Sans, sans-serif',
                    zoom: {
                        enabled: false
                    },
                },
                colors: ['#37a000'],
                fill: {
                    type: "gradient"
                },
                stroke: {
                    width: 4,
                    curve: 'smooth'
                },
                series: [{
                        name: 'Total Bookings',
                        data: monthly_total
                    }],
                xaxis: {
                    tickPlacement: 'between',
                    categories: short_monthname,
                }
            }
            var chart = new ApexCharts(
                    document.querySelector("#apexLineChart"),
                    options
                    );

            chart.render();
        },
        apexPieCharts: function () {
            var options = {
                chart: {
                    type: 'donut',
                },
                labels: ['Checkin', 'Checkout','Pending', 'Canceled'],
                series: [total_checkin, total_order, total_pending, total_cancel],
                responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
            }

            var chart = new ApexCharts(
                    document.querySelector("#apexPieCharts"),
                    options
                    );

            chart.render();
        }
    };
    // Initialize
    $(document).ready(function () {
        "use strict";
        apexCharts.initialize();
    });
}(jQuery));