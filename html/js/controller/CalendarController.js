function showCalendar(type, date) {
	switch (type) {
	case "month":
		calendarStart = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
		load(calendar, "view=month&date=" + calendarStart);
		break;
	case "week":
		break;
	default:
		type = null;
		break;
	}
	
}