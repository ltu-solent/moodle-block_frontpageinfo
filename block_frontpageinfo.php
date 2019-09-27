<?php
class block_frontpageinfo extends block_base {
    public function init() {
        $this->title = get_string('frontpageinfo', 'block_frontpageinfo');
    }

	  public function get_content() {
  		if ($this->content !== null) {
  		  return $this->content;
  		}

      function create_computers_table () {

        $url = 'https://mypc.solent.ac.uk/MyPC/Front.aspx?page=getResourceStatesAPI';
        $computers = json_decode(file_get_contents($url, true));
        $table = '
        <div><table><tr>
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

  		//remove unrequired elements and code that causes errors
  		$librarytimes = file_get_contents('http://portal.solent.ac.uk/site-elements/templates/sub-templates/library-opening-hours-iframe-template-for-mycourse/library-opening-hours.aspx');
  		$librarytimes = str_replace('<link href="/site-elements/css/site-styles2.css" rel="stylesheet" type="text/css" />',"", $librarytimes);
  		$librarytimes = str_replace('<link href="/site-elements/css/site-styles.css" rel="stylesheet" type="text/css" />',"", $librarytimes);
  		$librarytimes = str_replace('<script src="/WebResource.axd?d=i128VoJtYp5a3QfcsHdbjMb2lfd7MH6uE1mCXhb2uJ-jMBgO3g7cW0MDBaEb3LPnBhK0zUwf7AqT-Prdr0oTug-5EKe4gzDYs5jmKusperk1&amp;t=634976343818095796" type="text/javascript"></script><noscript><p>Browser does not support script.</p></noscript>',"", $librarytimes);
  		$librarytimes = str_replace('theForm.submit = WebForm_SaveScrollPositionSubmit;',"", $librarytimes);
  		$librarytimes = str_replace('theForm.onsubmit = WebForm_SaveScrollPositionOnSubmit;',"", $librarytimes);
  		$librarytimes = str_replace('<script src="/ScriptResource.axd?d=Vj7KwkszshaerC1sAgbpx81vmKpJmyvkMX1hpTuMqpA2EiQoOmVVsvFj9VZ6mHWOV09kaOTLj_Ktoei5reXponZ_5xCxrscEZ_zstlIsCrHO6NJmNz701rIXfPJGUnJx1Tu_Xqfr5TdEoeFtF2oAtgYghHEHnC5t9plRzY9vmm01&amp;t=ffffffff940d030f" type="text/javascript"></script><noscript><p>Browser does not support script.</p></noscript>',"", $librarytimes);
  		$librarytimes = str_replace("<h3>Today's opening times</h3>","", $librarytimes);
  		//replace relative urls with full path
  		$librarytimes = str_replace('href="/library/essential-info/opening-hours/opening-hours.aspx">','href="http://portal.solent.ac.uk/library/essential-info/opening-hours/opening-hours.aspx" target="_blank">', $librarytimes);
  		$librarytimes = str_replace('href="/library/services-for/warsash-students/opening-hours.aspx">','href="http://portal.solent.ac.uk/library/services-for/warsash-students/opening-hours.aspx" target="_blank">', $librarytimes);

  		$pcbooking = '<a href="https://mypc.solent.ac.uk/cire/login.aspx">Make a booking</a>
                    <br>
                    <a href="https://learn.solent.ac.uk/course/view.php?id=27658">myPC help and information</a>';
      $pcbooking .= '<div class="refresh"></div>';
      $pcbooking .= '<div id="computer_availability">';
      $pcbooking .= create_computers_table();
      $pcbooking .= '</div><p id="refresh_info">This table refreshes every 30 seconds</p>';


  		$table = '<div class="container">
  							<div class="col-sm frontpage-block-library">
  								<h5 class=frontpage-heading>Library</h5>' .
  								$librarytimes .
                  '</div>' .
                  '<div class="col-sm frontpage-block-pc">' .
                  '<h5 class=frontpage-heading>MyPC</h5>' .
                  $pcbooking .'
                  </div>
                </div>
  						</div>
  					</div>';



  		$this->content = new stdClass;
  		$this->content->text = $table;

  		return $this->content;
	}
}
