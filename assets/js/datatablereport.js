$(document).ready(function() {
    'use strict';
    $("#rexdatatable").DataTable({
        dom:"<'row m-0'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
        lengthMenu:[[10,25,50,-1],[10,25,50,"All"]],
        buttons: [{
            extend: "copy",
            className: "btn-sm prints",
            exportOptions:
                {
                    columns: ':visible'
                }
        },
        {
            extend: "csv",
            title: "Report",
            className: "btn-sm prints",
            exportOptions:
                {
                    columns: ':visible'
                }
        },
        {
            extend: "pdf",
            title: "Report",
            className: "btn-sm prints",
            exportOptions:
                {
                    columns: ':visible'
                }
        },
        {
            extend: "print",
            className: "btn-sm prints",
            exportOptions:
                {
                    columns: ':visible'
                }
        },
        {
                extend:"colvis",
                className:"btn-sm prints"
        }
    ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            var total = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            var pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
                var dueTotal = api
                .column(10, {
                    page: 'current'
                })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                });
            // Update footer
            $( api.column( 8 ).footer() ).html(
                Number(pageTotal).toFixed(2)
            );
            $( api.column( 10 ).footer() ).html(
                dueTotal.toFixed(2)
            );
        }
    }),

	$('.dataTables_filter').addClass('');  
	$('.dataTables_filter label').addClass('search__inner');  
	$('.dataTables_filter input').addClass('search__text');
	});