$(document).ready(function() {
    'use strict';
    var info = $('table tbody tr');
         info.click(function(e) {
             var email    = $(this).children().first().text();
             var password = $(this).children().first().next().text();

             $("input[type=email]").val(email);
             $("input[type=password]").val(password);
             [].slice.call(document.querySelectorAll('input.input__field')).forEach(function (inputEl) {
                 // in case the input is already filled..
                 if (inputEl.value.trim() !== '') {
                     classie.add(inputEl.parentNode, 'input--filled');
                 }

                 // events:
                 inputEl.addEventListener('focus', onInputFocus);
                 inputEl.addEventListener('blur', onInputBlur);
             });
         });
         if (!String.prototype.trim) {
             (function () {
                 // Make sure we trim BOM and NBSP
                 var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                 String.prototype.trim = function () {
                     return this.replace(rtrim, '');
                 };
             })();
         }

         [].slice.call(document.querySelectorAll('input.input__field')).forEach(function (inputEl) {
             // in case the input is already filled..
             if (inputEl.value.trim() !== '') {
                 classie.add(inputEl.parentNode, 'input--filled');
             }

             // events:
             inputEl.addEventListener('focus', onInputFocus);
             inputEl.addEventListener('blur', onInputBlur);
         });

         function onInputFocus(ev) {
             classie.add(ev.target.parentNode, 'input--filled');
         }

         function onInputBlur(ev) {
             if (ev.target.value.trim() === '') {
                 classie.remove(ev.target.parentNode, 'input--filled');
             }
         }
 });