
$(document).ready(function(e) {
    'use strict'
  $('.selectpicker').selectpicker();
  $('.hrmtimepicker2').bootstrapMaterialDatePicker({
    format: ' HH:mm',
    startDate: new Date(),
    shortTime: false,
    date: false,
    time: true,
    monthPicker: false,
    year: false,
    switchOnClick: true,
    });
});
