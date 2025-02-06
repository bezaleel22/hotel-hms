'use strict';
function printContent(el)
{
    var divName="printArea";
    var printContents=document.getElementById(divName).innerHTML;
    var originalContents=document.body.innerHTML;
    document.body.innerHTML=printContents;
    window.print();
    document.body.innerHTML=originalContents;
    location.reload();
}