
// Standard license block omitted.
/*
* @package    block_frontpageinfo
* @copyright  2019 Solent University
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

/**
* @module block_frontpageinfo/main
*/
define(['jquery', 'block_frontpageinfo/main'], function($) {

  return {
      init: function() {

          var container = document.getElementById("computer_availability");
          //Build table on page load
          getTable();

          if (container) {
            setInterval(function () {
              container.innerHTML= '';
              $(".refresh").addClass("spinner fa fa-circle-o-notch fa-spin");
              setTimeout(function () {
                getTable();
              }, 1000);
            }, 30000);
          }

          function getTable(){
            $.ajax({
              url: '../blocks/frontpageinfo/externallib.php',
              type: 'post',
              data: { "callTableFunc": "1"},
              success: function(response) {
                container.innerHTML= response;
                if (response == '') {
                  container.innerHTML = "Error getting availability";
                }
              },
              error: function() {
                container.innerHTML= "Error getting availability";
              },
              complete: function () {
                $(".refresh").removeClass("spinner fa fa-circle-o-notch fa-spin");
              }
            });
          }
        }
    };
});
