<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>UNIL - FBM CALENDAR</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" type="text/css" href="css/UNIL-FBM.css" />
<link rel="stylesheet" type="text/css" href="css/calendar.css" />
<link rel="stylesheet" type="text/css" href="css/button.css" />
<link rel="icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />
<link rel="shortcut icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />

<!-- BEGIN JQUERY -->
<link type="text/css" rel="StyleSheet"
	href="css/jquery-ui-orange.css" />
<link type="text/css" rel="StyleSheet"
	href="css/jquery-ui-gray.css" />


<link type="text/css" href="css/fg.menu.css" media="screen"
	rel="stylesheet" />
<script type="text/javascript" src="javascript/lib/jquery.js"></script>
<script type="text/javascript" src="javascript/lib/jquery.ui.core.js"></script>
<script type="text/javascript" src="javascript/lib/jquery.validate.js"></script>
<script type="text/javascript" src="javascript/lib/jquery.livequery.min.js"></script>
<script type="text/javascript" src="javascript/lib/fg.menu.js"></script>
<script type="text/javascript" src="javascript/lib/plugins.js"></script>
<!-- END JQUERY -->

<!-- BEGIN APPLICAITON -->
<script type="text/javascript" src="javascript/global.js"></script>
<script type="text/javascript" src="javascript/helper/DateHelper.js"></script>
<script type="text/javascript" src="javascript/controller/Controller.js"></script>
<script type="text/javascript" src="javascript/controller/CalendarController.js"></script>
<script type="text/javascript" src="javascript/application.js"></script>
<!-- END APPLICATION -->
</head>
<body>
	<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header">
			<img id="login" src="https://wwwfbm.unil.ch/html/img/login.gif"
				alt="login" />
			<div id="language">English | Français</div>
			<div id="bar">Room reservation system</div>
		</div>
		<!-- END HEADER -->
		<!-- BEGIN CONTENT -->
		<div id="content">
			<!-- BEGIN MAIN -->
			<div id="main">
				<!-- BEGIN CALENDAR -->
				<div id="toolbar"></div>
				<div id="calendar"></div>
				<!-- END CALENDAR -->
			</div>
			<!-- END MAIN -->
			<!-- BEGIN SIDEBAR -->
			<div id="sidebar">
				<!-- BEGIN ROOM-VIEW -->
				<div id="room"></div>
				<!-- END ROOM-VIEW -->
				<!-- BEGIN CONTROL-VIEW -->
				<div id="control"></div>
				<!-- END CONTROL-VIEW -->
			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN FOOTER -->
		<div id="footer">&copy; 2011 - Université de Lausanne - All right
			reserved</div>
		<!-- END FOOTER -->
	</div>
	<!-- END PAGE -->
</body>
</html>
