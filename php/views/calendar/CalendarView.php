<table id="monthview">
<thead>
<tr>
<th>Monday</th>
<th>Tuesday</th>
<th>Wednesday</th>
<th>Thursday</th>
<th>Friday</th>
<th>Saturday</th>
<th>Sunday</th>
</tr>
</thead>
<tbody>
<?php
date_default_timezone_set('Europe/Zurich');
include_once("model/MonthCalendar.php");
include_once("model/class/Room.php");
include_once("model/class/Building.php");
include_once("helpers/System.php");

session_start();


$month = 7;
$year = 2011;

$currentDate = "";

$room = new Room(13);

$monthCalendar = new MonthCalendar($room, $month, $year);
$weekpos = $monthCalendar->getStartpos();
$events = $monthCalendar->getEvents();

$roomId = $room->getId();
// get user permission level
$auth = System::authLevel();

// get number of days in month
$days = $monthCalendar->getMaxDays();
$day = 0;
// initialize day variable to zero, unless $weekpos is zero
if ($weekpos == 0) {
	$day = 1;
}
// initialize today's date variables for color change
$timestamp = time();
$d = date('j', $timestamp);
$m = date('n', $timestamp);
$y = date('Y', $timestamp);


while ($day <= $days) {

	echo"\t<tr>\n";

	for ($weekDay = 0; $weekDay < 7; $weekDay++) {

		if ($day > 0 && $day <= $days) {
			$currentDate = $year . "-" . $month . "-" . $day;
			$array_index = $day;
			if ($array_index < 10) {
				$array_index = "0" . (String)$day;
			}

			$longMonth = $month;
			if ($month < 10) {
				$longMonth = "0" . (String)$month;
			}
			$currentDate = $year . "-" . $longMonth . "-" . $array_index;

			echo "\t\t<td class=\"day_cell\" ";

			if (($day == $d) && ($month == $m) && ($year == $y)) {
				echo "id=\"active\"";
			} 


			if ($auth > 0) {
				echo "\t\t<a class=\"psf\" id=\"$day-$roomId\" onClick=\"newEvent('$currentDate')\">\n";
				echo "<span class=\"";
				
				if ($weekDay >= 5) {
					echo "week-end";
				}
				else {
					echo "day_number";
				}
				
				echo "\">$day</span></a>";
				
			} else {
				echo "$day";
			}

			echo "\t\t<br />\n";

			$events = null;

			if (isset($events[$array_index])) {
				$events = $events[$array_index];
			}

			//s'il existe au moins un événément pour ce jour
			if ($events != null) {
				$posY = 0;
				$posX = $array_index;
				foreach ($events as $e) {
					$begin = $e->getHBegin();
					$end = $e->getHEnd();
					if ($e->getHBegin() == "00:00" && $e->getHEnd() == "00:00") {
						$end = "24:00";
					}

					$title = $e->getTitle();
					$description = $e->getDescription();

					echo "\t\t<a class=\"psf\" onClick=\"editEvent('$posX', '$posY', '$currentDate')\">\n";

					echo "\t\t\t<span class=\"event_entry\">";
					echo "$begin - $end";
					echo "<br/>";

					echo "$title $description";
					echo "</span>\n";
					echo "\t\t</a><br>\n";
					$posY++;
				}
			}

			echo "\t\t</td>\n";
			$day++;
		} elseif ($day == 0) {
			echo "\t\t<td class=\"empty_day_cell\"><!--before--></td>\n";
			$weekpos--;
			if ($weekpos == 0) {
				$day++;
			}
		} else {
			echo "\t\t<td class=\"empty_day_cell\"><!--after--></td>\n";
		}
	}
	echo "\t</tr>\n";
}

?>
</tbody>
</table>

<!-- BEGIN VIEW -->
<?php /*
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
				onclick="newEvent('2011-07-01')"><span class="day_number">1</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="2-13"
				onclick="newEvent('2011-07-02')"><span class="week-end">2</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="3-13"
				onclick="newEvent('2011-07-03')"><span class="week-end">3</span> </a>
				<br>
			</td>
		</tr>
		<tr>
			<td class="day_cell"><a class="psf" id="4-13"
				onclick="newEvent('2011-07-04')"><span class="day_number">4</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="5-13"
				onclick="newEvent('2011-07-05')"><span class="day_number">5</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="6-13"
				onclick="newEvent('2011-07-06')"><span class="day_number">6</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="7-13"
				onclick="newEvent('2011-07-07')"><span class="day_number">7</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="8-13"
				onclick="newEvent('2011-07-08')"><span class="day_number">8</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="9-13"
				onclick="newEvent('2011-07-09')"><span class="week-end">9</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="10-13"
				onclick="newEvent('2011-07-10')"><span class="week-end">10</span> </a>
				<br>
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
				onclick="newEvent('2011-07-16')"><span class="week-end">16</span> </a>
				<br>
			</td>
			<td class="day_cell" id="today"><a class="psf" id="17-13"
				onclick="newEvent('2011-07-17')"><span class="week-end">17</span> </a>
				<br>
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
				onclick="newEvent('2011-07-23')"><span class="week-end">23</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="24-13"
				onclick="newEvent('2011-07-24')"><span class="week-end">24</span> </a>
				<br>
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
				onclick="newEvent('2011-07-30')"><span class="week-end">30</span> </a>
				<br>
			</td>
			<td class="day_cell"><a class="psf" id="31-13"
				onclick="newEvent('2011-07-31')"><span class="week-end">31</span> </a>
				<br>
			</td>
		</tr>
	</tbody>
</table> 
*/?>
<!-- END VIEW -->
