define(['jquery']);

setInterval(function () {
  var container = document.getElementById("computer_availability");
  var content = container.innerHTML;
  container.innerHTML= '';
  $("#computer_availability").addClass("spinner fa fa-circle-o-notch fa-spin");

  setTimeout(function () {
    $.ajax({
        url: '../blocks/frontpageinfo/externallib.php',
        type: 'post',
        data: { "callTableFunc": "1"},
        success: function(response) {
          container.innerHTML= response;
        },
       complete: function () {
         $("#computer_availability").removeClass("spinner fa fa-circle-o-notch fa-spin");
       }
    });

  }, 1000);

}, 30000);