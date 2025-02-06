//atnview
// abdullah add date to  #13-11-2024#
$(document).on('click', '#sign_in', function (e) {
  e.preventDefault();
  // Get CSRF token, base URL, and employee ID
  var csrf = $('#csrf_token').val();
  var baseurl = $('#base_url').val() + 'hrm/Home/create_atten';
  var employee_id = $('#employee_id').val();

  // Check if employee ID is provided
  if (employee_id == '') {
    alert('Employee ID is required.');
    return false;
  }

  // First AJAX request to check attendance status
  $.ajax({
    url: baseurl,
    type: "POST",
    data: {
      csrf_test_name: csrf,
      employee_id: employee_id,
      sign_out: 1,
    },
    dataType: "json", // Assuming the server returns JSON
    success: function (response) {
      if (response.status === 'checked') {
        // Show confirmation prompt
        swal({
            title: "Confirmation",
            text: "Are you sure you want to submit?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function (isConfirm) {
            if (isConfirm) {
              submitAttendance(csrf, employee_id, baseurl);
            } else {
              // Reload the page to reset the form
              window.location.reload();
            }
          });
      }
    },
    error: function (xhr, status, error) {
      console.error('First AJAX Error:', error);
      alert('Something went wrong during the check. Please try again.');
    }
  });
});

function signoutmodal(id, signin) {
  'use strict';
  $("#signout").modal('show');
  document.getElementById('att_id').value = id;
  document.getElementById('sign_in').value = signin;
}

$(document).ready(function () {
  'use strict';

  // choose text for the show/hide link - can contain HTML (e.g. an image)
  var showText = 'ADD More';
  var hideText = 'Hide';

  // initialise the visibility check
  var is_visible = false;

  // append show/hide links to the element directly preceding the element with a class of "toggle"
  $('.toggle').prev().append(' (<a href="#" class="toggleLink">' + showText + '</a>)');

  // hide all of the elements with a class of 'toggle'
  $('.toggle').hide();

  // capture clicks on the toggle links
  $('a.toggleLink').click(function () {

    // switch visibility
    is_visible = !is_visible;

    // change the link depending on whether the element is shown or hidden
    $(this).html((!is_visible) ? showText : hideText);

    // toggle the display - uncomment the next line for a basic "accordion" style
    $(this).parent().next('.toggle').toggle('slow');

    // return false so any link destination is not followed
    return false;

  });
});

function checkTime(i) {
  'use strict';
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function startTime() {
  'use strct';
  var time = $('#timezone').val();
  var indianTimeZoneVal = new Date().toLocaleString('en-US', {
    timeZone: time
  });
  var today = new Date(indianTimeZoneVal);
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  var ap = "AM";
  if (h > 11) {
    ap = "PM";
  }
  if (h > 12) {
    h = h - 12;
  }
  if (h == 0) {
    h = 12;
  }
  if (h < 10) {
    h = "0" + h;
  }
  if (m < 10) {
    m = "0" + m;
  }
  if (s < 10) {
    s = s;
  }

  // add a zero in front of numbers<10
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('clock').innerHTML = h + ":" + m + ":" + s + " " + ap;
  t = setTimeout(function () {
    startTime()
  }, 500);
}
startTime();
// abdullah add date to  #13-11-2024# Function to handle the second AJAX request
function submitAttendance(csrf, employee_id, baseurl) {
  $.ajax({
    url: baseurl,
    type: "POST",
    data: {
      csrf_test_name: csrf,
      employee_id: employee_id,
    },
    dataType: "json", // Assuming the server returns JSON
    success: function (res) {
      if (res.status === 'success') {
        swal({
          title: "Successfully",
          text: "Attendance has been submitted successfully.",
          type: "success",
          confirmButtonColor: "#28a745",
          confirmButtonText: "Ok",
          closeOnConfirm: true
        });
        window.location.reload();
      } else {
        swal({
          title: "Failed",
          text: "Failed to submit attendance. Please try again.",
          type: "error",
          confirmButtonColor: "#28a745",
          confirmButtonText: "Ok",
          closeOnConfirm: true
        });
        window.location.reload();
      }
    },
    error: function (xhr, status, error) {
      console.error('Second AJAX Error:', error);
      alert('Something went wrong during submission. Please try again.');
    }
  });
}