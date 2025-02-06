function Payment(salpayid,employee_id,TotalSalary,WorkHour,Period){
  'use strict';
  var base = $('#base_url').val();
  var csrf = $('#csrf_token').val();
  var sal_id = salpayid;
  var employee_id = employee_id;
     $.ajax({
     url:base+'hrm/Employees/EmployeePayment/',
     method:'post',
     dataType:'json',
     data:{
       csrf_test_name: csrf,
      'sal_id':sal_id,
      'employee_id':employee_id,
      'totalamount':TotalSalary,
     },
     success:function(data){
  document.getElementById('employee_name').value = data.Ename;
  document.getElementById('employee_id').value = data.employee_id;
  document.getElementById('salType').value = salpayid;
  document.getElementById('finyear').value = data.finyear;
  document.getElementById('total_salary').value = TotalSalary;
  document.getElementById('total_working_minutes').value = WorkHour;
  document.getElementById('working_period').value = Period;
    $("#PaymentMOdal").modal('show');
    $("#dayClose").trigger('click');
     },
     error:function(jqXHR, textStatus, errorThrown)
         {
          swal({
            title: "Failed",
            text: "Error get data from ajax",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
         }
 
     });
 }