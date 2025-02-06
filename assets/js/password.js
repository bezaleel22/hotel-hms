//Password Show
function passShow() {
    "use strict";
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
      $("i").addClass("fa fa-eye-slash");
      x.type = "text";
    } else {
      $("i").removeClass("fa fa-eye-slash");
      $("i").addClass("fa fa-eye");
      x.type = "password";
    }
  }