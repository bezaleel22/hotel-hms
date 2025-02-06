function cmbCode_onchange(){
    'use strict';
    var Sel=$('#cmbCode').val();
    var Text=$('#cmbCode').text();
    var select= $("option:selected", $("#cmbCode")).text()
      $("#txtName").val(select);
      $("#txtCode").val(Sel);
  }