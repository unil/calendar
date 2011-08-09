function showCalendar(type, date) {
	switch (type) {
	case "month":
		calendarStart = dateToString(date);
		load("calendar", "view=month&date=" + calendarStart);
		break;
	case "week":
		break;
	default:
		type = null;
		break;
	}
	
}

function goToNextMonth() {
	currentDate = getNextMonth(currentDate);

	saveCurrentState();
    showCalendar("month", currentDate);
}

function goToPreviousMonth() {
	currentDate = getPreviousMonth(currentDate);

	saveCurrentState();
    showCalendar("month", currentDate);
}

function goToToday() {
	currentDate = getToday();

	saveCurrentState();
    showCalendar("month", currentDate);
}