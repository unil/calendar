<?php
?>

<div id="calendar">
	<div id="toolbar">  
	<div id="goTo">
	<button type="button" class="btn"><span><span>Aujourd'hui</span></span></button>
	</div>
	<div id="action">
	<button type="button" class="btn pill-l"><span><span><img id="previous" src="html/img/previous1.gif" alt="previous" /></span></span></button><button type="button" class="btn pill-c primary"><span><span>Semaine</span></span></button><button type="button" class="btn pill-c"><span><span>Mois</span></span></button><button type="button" class="btn pill-r"><span><span><img id="next" src="html/img/next1.gif" alt="next" /></span></span></button>
	</div>
	<div id="name">asdf</div>
	<div id="calendar-information">Juillet 2011</div>
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
							onclick="newEvent('2011-07-02')"><span class="day_number">2</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="3-13"
							onclick="newEvent('2011-07-03')"><span class="day_number">3</span>
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
							onclick="newEvent('2011-07-09')"><span class="day_number">9</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="10-13"
							onclick="newEvent('2011-07-10')"><span class="day_number">10</span>
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
						<td class="day_cell" id="today"><a class="psf" id="13-13"
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
							onclick="newEvent('2011-07-16')"><span class="day_number">16</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="17-13"
							onclick="newEvent('2011-07-17')"><span class="day_number">17</span>
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
							onclick="newEvent('2011-07-23')"><span class="day_number">23</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="24-13"
							onclick="newEvent('2011-07-24')"><span class="day_number">24</span>
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
							onclick="newEvent('2011-07-30')"><span class="day_number">30</span>
						</a> <br>
						</td>
						<td class="day_cell"><a class="psf" id="31-13"
							onclick="newEvent('2011-07-31')"><span class="day_number">31</span>
						</a> <br>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- END VIEW -->
		</div>
	</div>
</div>
