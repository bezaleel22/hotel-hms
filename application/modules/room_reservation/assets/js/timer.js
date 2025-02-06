$(document).ready(function () {
    "use strict";
    var x;
    function getTimer(endDate, display) {
        x = setInterval(function() {
        var countDownDate = new Date(endDate).getTime();
        // Get today's date and time
        var now = new Date().getTime();
        
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
            
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Output the result in an element with id="demo" 

        if(document.getElementById("time_"+display)){
            document.getElementById("time_"+display).innerHTML = (days>0 ? days + "d " : "") + (hours>0 ? hours + "h " : "") + minutes + "m " + seconds + "s ";
        }
        //If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("time_"+display).innerHTML = "Refresh";
        }
        }, 1000);
    }

    window.onload = function() {
        var sl = document.getElementsByClassName("sl");
        for(var i=0; i<sl.length; i++){
            var endDate = sl[i].value;
            var display = sl[i].id;
            getTimer(endDate, display);
        }
    };
    $("#exdatatable_paginate,.search__text,select[name='exdatatable_length']").on("click input", function(){
        var sl = document.getElementsByClassName("sl");
        for(var i=0; i<sl.length; i++){
            var endDate = sl[i].value;
            var display = sl[i].id;
            getTimer(endDate, display);
        }
    });
});