<?php

//this file will echo a response to post requests for regenerating the library computers table

function create_computers_table () {

  $url = 'https://mypc.solent.ac.uk/MyPC/Front.aspx?page=getResourceStatesAPI';
  $computers = json_decode(file_get_contents($url, true));
  $table = '
  <div>
  <table><tr>
  <th>' . $computers[1]->name . '</th>
  <th class="pc_availability">Availability</th></tr>';

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
      <td class="pc_location">' . $locations->name . '</td>
      <td class="pc_availability">' . $available . '/' . $total . '</td>
    </tr>';
  }
  $table .= '
  </table></div>';
  return $table;
}

if (isset($_POST['callTableFunc'])) {
  create_computers_table();
}
