  $( function() {
      'use strict';
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  } );
  //application form
 $(function(){
     'use strict';
        $("#f").datepicker({ dateFormat:'yy-mm-dd' });
        $("#e").datepicker({ dateFormat:'yy-mm-dd' });
        $("#a").datepicker({ dateFormat:'yy-mm-dd' });
        $("#c").datepicker({ dateFormat:'yy-mm-dd' });
        $("#d").datepicker({ dateFormat:'yy-mm-dd' });
        $("#b").datepicker({ dateFormat:'yy-mm-dd' });
    });
$(document).ready(function(e) {
    'use strict'
function calculation(){
  var date1 =new Date($('.leave_aprv_strt_date').val());
  var date2 =new Date($('.leave_aprv_end_date').val());
  var timeDiff = Math.abs(date2.getTime() - date1.getTime());
  var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        $('.num_aprv_day').val(diffDays);
  }
  $('.leave_aprv_strt_date,.leave_aprv_end_date,.num_aprv_day').keyup(calculation);

});

function myFunction() {
    'use strict';
    window.print();
    function hide(){
    document.getElementById('pr').style.display="none";
}
}

