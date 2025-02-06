'use strict';
var date = new Date();
date.setDate(date.getDate()-1);
$('.datetimepickers2').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    startDate: new Date(),
    shortTime: false,
    date: true,
    time: true,
    monthPicker: false,
    year: false,
    switchOnClick: true,
});  