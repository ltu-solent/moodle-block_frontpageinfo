<?php
class block_frontpageinfo extends block_base {
    public function init() {
        $this->title = get_string('frontpageinfo', 'block_frontpageinfo');
    }

	  public function get_content() {
  		if ($this->content !== null) {
  		  return $this->content;
  		}

$this->page->requires->js_call_amd('block_frontpageinfo/main', 'init', array());

  		$helpdesk = '<h5 class=frontpage-heading>Learning Technologies Helpdesk</h5>
  		<p>Find us on Floor 2 of the Library</p>
  		<a class="twitter-timeline" data-height="600" data-link-color="#E81C4F" href="https://twitter.com/SolentLThelp?ref_src=twsrc%5Etfw"></a>
  		<script async="" src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';

  		$succeed = '<h5 class=frontpage-heading>Succeed@Solent</h5>
  					<div id="succeed-container">
  					<a href="https://learn.solent.ac.uk/course/view.php?id=90">Succeed Home Page</a>
  					<br><br>
  					<h5>The Assignment Process:</h6>
  					<ul class="succeed-list">
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31627">Starting Assignments</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31629">Finding Sources</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31628">Using Sources</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31630">Critical Thinking and Planning</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31631">Writing an Assignment</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31632">Referencing</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31636">Feedback and Reflection</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31634">Dissertations and Major Projects</a></li>
  					</ul>

  					<h5>Professional Skills:</h6>
  					<ul class="succeed-list">
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31690">Group Work</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31635">Managing Time and Stress</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31637">Giving Presentations</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31649">Grammar and Language Skills</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31689">Maths and Statistics</a></li>
  						<li><a href="https://learn.solent.ac.uk/course/view.php?id=31691">Professional Presence</a></li>
  					</ul></div>';

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
      $pcbooking .= '</div><p id="refresh_info">This table refreshes every 30 seconds</p>';


  		$table = '	<div class="container">
  						<div class="row">
  							<div class="col-sm frontpage-block-left">' .
  								$helpdesk .'
  							</div>
  							<div class="col-sm frontpage-block-center">
  								<h5 class=frontpage-heading>Library</h5>' .
  								$librarytimes . '<hr>' . '<h5 class=frontpage-heading>MyPC</h5>' .
                  $pcbooking .'
  							</div>
  							<div class="col-sm frontpage-block-right">' .
  								$succeed .'
  							</div>
  						</div>
  					</div>';



  		$this->content = new stdClass;
  		$this->content->text = $table;

  		return $this->content;
	}
}
