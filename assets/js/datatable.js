$(document).ready(function() {
    'use strict';
    $("#exdatatable").DataTable({
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
            title: "List",
            className: "btn-sm prints",
            exportOptions:
                {
                    columns: ':visible'
                }
        },
        {
            extend: "pdf",
            title: "List",
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
    ]
    }),

	$('.dataTables_filter').addClass('');  
	$('.dataTables_filter label').addClass('search__inner');  
	$('.dataTables_filter input').addClass('search__text');
	});