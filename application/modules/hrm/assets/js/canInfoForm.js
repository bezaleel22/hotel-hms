  $('.btnPrevious').click(function(){
      'use strict';
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
  var prev = $('.nav-tabs > .active').removeClass('active').prev('li');
	if (!prev.length) prev = prev.prevObject.siblings(':first');
    prev.addClass('active');
});

$("#first_name").on('keyup', function() {
    var inpfirstname = document.getElementById('first_name');
  if (inpfirstname.value.length === 0) return;
$("#first_name").css("border-color", "green");
});

  $("#email").on('keyup', function() {
    var email = document.getElementById('email');
  if (email.value.length === 0) return;
$("#email").css("border-color", "green");
});

  $("#phone").on('keyup', function() {
    var phone = document.getElementById('phone');
  if (phone.value.length === 0) return;
$("#phone").css("border-color", "green");
});

$("#degree_name").on('keyup', function() {
  var degree_name = document.getElementById('degree_name');
if (degree_name.value.length === 0) return;
$("#degree_name").css("border-color", "green");
});

$("#university_name").on('keyup', function() {
  var university_name = document.getElementById('university_name');
if (university_name.value.length === 0) return;
$("#university_name").css("border-color", "green");
});

$("#cgp").on('keyup', function() {
  var cgp = document.getElementById('cgp');
if (cgp.value.length === 0) return;
$("#cgp").css("border-color", "green");
});
$("#company_name").on('keyup', function() {
  var company_name = document.getElementById('company_name');
if (company_name.value.length === 0) return;
$("#company_name").css("border-color", "green");
});

$("#working_period").on('keyup', function() {
  var working_period = document.getElementById('working_period');
if (working_period.value.length === 0) return;
$("#working_period").css("border-color", "green");
});

$("#duties").on('keyup', function() {
  var duties = document.getElementById('duties');
if (duties.value.length === 0) return;
$("#duties").css("border-color", "green");
});
$("#supervisor").on('keyup', function() {
  var supervisor = document.getElementById('supervisor');
if (supervisor.value.length === 0) return;
$("#supervisor").css("border-color", "green");
});


  function validation1() {
      'use strict';    
    var f_name = $('#first_name').val();
      if (f_name == "") {
        $("#first_name").css("border-color", "red");
    }
    var email = $('#email').val();
      if (email == "") {
        $("#email").css("border-color", "red");
    }

var phone = $('#phone').val();
      if (phone == "") {
        $("#phone").css("border-color", "red");
    }
if(f_name !== "" && email !=="" && phone !==""){
     $('.nav-tabs > .active').next('li').find('a').trigger('click');
	 var next = $('.nav-tabs > .active').removeClass('active').next('li');
	if (!next.length) next = next.prevObject.siblings(':first');
    next.addClass('active');
}
}
function validation2() {
    'use strict';

    var degree_name = $('#degree_name').val();
      if (degree_name == "") {
        $("#degree_name").css("border-color", "red");
    } 

    var university_name = $('#university_name').val();
      if (university_name == "") {
        $("#university_name").css("border-color", "red");
    }
    var cgp = $('#cgp').val();
      if (cgp == "") {
        $("#cgp").css("border-color", "red");
    }


  if(degree_name !== "" && university_name !=="" && cgp !==""){
      $('.nav-tabs > .active').next('li').find('a').trigger('click');
    	var next = $('.nav-tabs > .active').removeClass('active').next('li');
    	if (!next.length) next = next.prevObject.siblings(':first');
        next.addClass('active');
  }


}

function validation3() {
    'use strict';

    var company_name = $('#company_name').val();
      if (company_name == "") {
        $("#company_name").css("border-color", "red");
    } 

    var working_period = $('#working_period').val();
      if (working_period == "") {
        $("#working_period").css("border-color", "red");
    }
    var duties = $('#duties').val();
      if (duties == "") {
        $("#duties").css("border-color", "red");
    }
    var supervisor = $('#supervisor').val();
      if (supervisor == "") {
        $("#supervisor").css("border-color", "red");
    }

}

$(document).ready(function(){
  $("body").on('click', '#checkcendidata', function () {
    var supervisor = $('#supervisor').val();
    var company_name = $('#company_name').val();
    var working_period = $('#working_period').val();
    var duties = $('#duties').val();
      if (supervisor !== "" && company_name !=="" && working_period !=="" && duties !=="") { 
        return true;
      }else{
        return false;
      }
  });



});

$(document).ready(function() {
    'use strict';
// choose text for the show/hide link - can contain HTML (e.g. an image)
var showText='Add more Info';
var hideText='Hide';
 
// initialise the visibility check
var is_visible = false;
 
// append show/hide links to the element directly preceding the element with a class of "toggle"
$('.toggle').prev().append(' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a href="#" class="toggleLink">'+showText+'</a>)');
 
// hide all of the elements with a class of 'toggle'
$('.toggle').hide();
 
// capture clicks on the toggle links
$('a.toggleLink').click(function() {
 
// switch visibility
is_visible = !is_visible;
 
// change the link depending on whether the element is shown or hidden
$(this).html( (!is_visible) ? showText : hideText);
 
// toggle the display - uncomment the next line for a basic "accordion" style
$(this).parent().next('.toggle').toggle('slow');
 
// return false so any link destination is not followed
return false;
 
});
});