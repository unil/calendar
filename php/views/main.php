<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>UNIL - FBM CALENDAR</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" type="text/css" href="html/css/UNIL-FBM.css" />
<link rel="stylesheet" type="text/css" href="html/css/calendar.css" />

<link rel="icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />
<link rel="shortcut icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />
</head>
<body>
	<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header">
			<img id="login"src="https://wwwfbm.unil.ch/html/img/login.gif" alt="login" />
			<div id="language">English | French</div>
			<div id="bar">Room reservation system </div>
		</div>
		<!-- END HEADER -->
		<!-- BEGIN CONTENT -->
		<div id="content">
			<!-- BEGIN MAIN -->
			<div id="main">
				<!-- BEGIN CALENDAR-VIEW -->
				<?php require("views/calendar/CalendarView.php"); ?>
				<!-- END CALENDAR-VIEW -->
			</div>
			<!-- END MAIN -->
			<!-- BEGIN SIDEBAR -->
			<div id="sidebar">
				<!-- BEGIN ROOM-VIEW -->
					<?php require("views/room/RoomView.php"); ?>
				<!-- END ROOM-VIEW -->
				<!-- BEGIN ROOM-VIEW -->
					<?php require("views/control/ControlView.php"); ?>
				<!-- END ROOM-VIEW -->
			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN FOOTER -->
		<div id="footer">&copy; 2011 - Université de Lausanne - All right reserved</div>
		<!-- END FOOTER -->
	</div>
	<!-- END PAGE -->
</body>
</html>