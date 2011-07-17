/**
 * Loads view with specified param via ajax
 * 
 * @param view (View to load)
 * @param param (Params to transmit to view)
 */
function load(view, param) {
	viewURL = null;
	target = null;
	switch (view) {
	case "room":
		viewURL = "php/views/room/RoomView.php";
		target = "#room";
		break;
	case "calendar":
		viewURL = "php/views/calendar/CalendarView.php";
		target = "#calendar";
		break;
	case "control":
		viewURL = "php/views/control/ControlView.php";
		target = "#control";
		break;
	case "toolbar":
		viewURL = "php/views/control/CalendarControl.php";
		target = "#toolbar";
		break;
	default:
		break;
	}

	if (viewURL != null) {
		if (param != null) {
			viewURL = viewURL + "?" + param;
		}
		$(target).load(viewURL);
	}
}
/**
 * Saves global vars to cookie
 */
function saveCurrentState() {
    $.cookie("currentDate", currentDate);
}

/**
 * Inits all views with default values;
 */
function init() {
	load("toolbar");
	load("control");
	load("room");
	load("calendar");
}