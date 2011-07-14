function load(view, param) {
	switch (view) {
	case "room":
	    $.get("php/views/room/RoomView.php", {
	        //"id": building
	    },
	    function(data){
	    	$('#room').html(data);
	    });
		break;
	case "calendar":
	    $.get("php/views/calendar/CalendarView.php", {
	        //"id": building
	    },
	    function(data){
	        $('#main').html(data);
	    });
		break;
	case "control":
	    $.get("php/views/control/ControlView.php", {
	        //"id": building
	    },
	    function(data){
	        $('#control').html(data);
	    });
		break;
	default:
		break;
	}
	

}

$(document).ready(function() {
	load("calendar");
	load("room");
	load("control");
});