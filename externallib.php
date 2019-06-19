<?php

//this file will echo a response to post requests for regenerating the library computers table

function create_computers_table () {

  $url = 'https://mypc.solent.ac.uk/MyPC/Front.aspx?page=getResourceStatesAPI';
  $computers = json_decode(file_get_contents($url, true));
  $table = '
  <div id="computer_availability">
    <a href="https://mypc.solent.ac.uk/cire/login.aspx">Make a booking</a>
    <br>
    <a href="https://learn.solent.ac.uk/course/view.php?id=27658">myPC help and information</a>
    <table>
      <tr>
        <th>' . $computers[1]->name . '</th>
        <th class="pc_availability">Availability</th>
        <tr>';
  foreach ($computers[1]->locations as $locations) {
    $total = 0;
    $available = 0;
    foreach($locations->resources as $resources) {
      $total++;
      if ($resources->state == "AVAILABLE") {
        $available++;
      }
    }
           $table .=
                '<tr>
                    <tr>
                      <td class="pc_location">' . $locations->name . '</td>
                      <td class="pc_availability">' . $available . '/' . $total . '</td>
                    </tr>';
          }
          $table .= '
          </table>
          <p id="refresh_info">This table refreshes every 30 seconds</p>
          </div>';
  return $table;
}

if (isset($_POST['callTableFunc'])) {
 echo create_computers_table();
}
