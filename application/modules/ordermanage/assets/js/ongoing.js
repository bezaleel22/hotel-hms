// JavaScript Document
$(document).ready(function(){
  
    $('[data-toggle="tooltip"]').tooltip();
});

  "use strict";
  var csrf    = $('#csrfhashresarvation').val();

  $('.search-table-field').select2({
      placeholder: lang.type_slorder,
        minimumInputLength: 1,
    ajax: {
      url: baseurl+"ordermanage/order/ongoingtable_name",
      dataType: 'json',
      delay: 250,
      data:{csrf_test_name:csrf},
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.text,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
  $('.search-tablesr-field').select2({
      placeholder: lang.type_table,
        minimumInputLength: 1,
    ajax: {
      url: baseurl+"ordermanage/order/ongoingtablesearch",
      dataType: 'json',
      delay: 250,
      data:{csrf_test_name:csrf},
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.text,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
