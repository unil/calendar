<?php
?>
	<!-- style exceptions for IE 6 -->
	<!--[if IE 6]>
	<style type="text/css">
		.fg-menu-ipod .fg-menu li { width: 95%; }
		.fg-menu-ipod .ui-widget-content { border:0; }
	</style>
	<![endif]-->	
    <script type="text/javascript">    
    $(document).ready(function(){
    	// BUTTONS
    	$('.fg-button').hover(
    		function(){ $(this).removeClass('ui-state-default').addClass('ui-state-focus'); },
    		function(){ $(this).removeClass('ui-state-focus').addClass('ui-state-default'); }
    	);
    	
    	// MENUS    	
		$('#building-choose').menu({ 
			content: $('#building-choose').next().html(), // grab content from this page
			showSpeed: 400 
		});
		$('#room-choose').menu({ 
			content: $('#room-choose').next().html(), // grab content from this page
			showSpeed: 400 
		});

    });
    </script>
<div id="calendar">
	<div id="toolbar"> 

	<div id="goTo">
	<button type="button" class="btn"><span><span>Aujourd'hui</span></span></button>
	</div>
	<div id="action">
	<button type="button" class="btn pill-l"><span><span><img id="previous" src="html/img/previous1.gif" alt="previous" /></span></span></button><button type="button" class="btn pill-c primary"><span><span>Semaine</span></span></button><button type="button" class="btn pill-c"><span><span>Mois</span></span></button><button type="button" class="btn pill-r"><span><span><img id="next" src="html/img/next1.gif" alt="next" /></span></span></button>
	</div>
			
	<div id="name" class="jquery-gray">		<a tabindex="0" href="#search-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="building-choose"><span class="ui-icon ui-icon-triangle-1-s"></span>Bugnon 27</a>
		<div id="search-engines" class="hidden">
		<ul>
			<li><a href="#">Google</a></li>
			<li><a href="#">Yahoo</a></li>
			<li><a href="#">MSN</a></li>
			<li><a href="#">Ask</a></li>
			<li><a href="#">AOL</a></li>
		</ul>
		</div>
		<a tabindex="0" href="#search-engines2" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="room-choose"><span class="ui-icon ui-icon-triangle-1-s"></span>Sous-sol - Animalerie - flux 1b</a>
		<div id="search-engines2" class="hidden">
		<ul>
			<li><a href="#">Google</a></li>
			<li><a href="#">Yahoo</a></li>
			<li><a href="#">MSN</a></li>
			<li><a href="#">Ask</a></li>
			<li><a href="#">AOL</a></li>
		</ul>
		</div>
		</div>
	<div id="calendar-information">juillet 2011</div> 
	</div>
	<div>
		<div id="view">
			<!-- BEGIN VIEW -->
			<table id="monthview">
				<thead>
					<tr>
						<th id="day1">Monday</th>
						<th id="day2">Tuesday</th>
						<th id="day3">Wednesday</th>
						<th id="day4">Thursday</th>
						<th id="day5">Friday</th>
						<th id="day6">Saturday</th>
						<th id="day7">Sunday</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="empty_day_cell">
							<!--before--></td>
						<td class="empty_day_cell">
							<!--before--></td>
						<td class="empty_day_cell">
							<!--before--></td>
						<td class="empty_day_cell">
							<!--before--></td>
						<td class="day_cell"><a class="psf" id="1-13"
							onclick="newEvent('2011-07-01')"><span class="day_number">1</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="2-13"
							onclick="newEvent('2011-07-02')"><span class="week-end">2</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="3-13"
							onclick="newEvent('2011-07-03')"><span class="week-end">3</span>
						</a> <br>
						</td>
					</tr>
					<tr>
						<td class="day_cell"><a class="psf" id="4-13"
							onclick="newEvent('2011-07-04')"><span class="day_number">4</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="5-13"
							onclick="newEvent('2011-07-05')"><span class="day_number">5</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="6-13"
							onclick="newEvent('2011-07-06')"><span class="day_number">6</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="7-13"
							onclick="newEvent('2011-07-07')"><span class="day_number">7</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="8-13"
							onclick="newEvent('2011-07-08')"><span class="day_number">8</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="9-13"
							onclick="newEvent('2011-07-09')"><span class="week-end">9</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="10-13"
							onclick="newEvent('2011-07-10')"><span class="week-end">10</span>
						</a> <br>
						</td>
					</tr>
					<tr>
						<td class="day_cell"><a class="psf" id="11-13"
							onclick="newEvent('2011-07-11')"><span class="day_number">11</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="12-13"
							onclick="newEvent('2011-07-12')"><span class="day_number">12</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="13-13"
							onclick="newEvent('2011-07-13')"><span class="day_number">13</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="14-13"
							onclick="newEvent('2011-07-14')"><span class="day_number">14</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="15-13"
							onclick="newEvent('2011-07-15')"><span class="day_number">15</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="16-13"
							onclick="newEvent('2011-07-16')"><span class="week-end">16</span>
						</a> <br>
						</td>
						<td class="day_cell" id="today"><a class="psf" id="17-13"
							onclick="newEvent('2011-07-17')"><span class="week-end">17</span>
						</a> <br>
						</td>
					</tr>
					<tr>
						<td class="day_cell"><a class="psf" id="18-13"
							onclick="newEvent('2011-07-18')"><span class="day_number">18</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="19-13"
							onclick="newEvent('2011-07-19')"><span class="day_number">19</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="20-13"
							onclick="newEvent('2011-07-20')"><span class="day_number">20</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="21-13"
							onclick="newEvent('2011-07-21')"><span class="day_number">21</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="22-13"
							onclick="newEvent('2011-07-22')"><span class="day_number">22</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="23-13"
							onclick="newEvent('2011-07-23')"><span class="week-end">23</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="24-13"
							onclick="newEvent('2011-07-24')"><span class="week-end">24</span>
						</a> <br>
						</td>
					</tr>
					<tr>
						<td class="day_cell"><a class="psf" id="25-13"
							onclick="newEvent('2011-07-25')"><span class="day_number">25</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="26-13"
							onclick="newEvent('2011-07-26')"><span class="day_number">26</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="27-13"
							onclick="newEvent('2011-07-27')"><span class="day_number">27</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="28-13"
							onclick="newEvent('2011-07-28')"><span class="day_number">28</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="29-13"
							onclick="newEvent('2011-07-29')"><span class="day_number">29</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="30-13"
							onclick="newEvent('2011-07-30')"><span class="week-end">30</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="31-13"
							onclick="newEvent('2011-07-31')"><span class="week-end">31</span>
						</a> <br>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- END VIEW -->
		</div>
	</div>
</div>
