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
	        $('#calendar').html(data);
	    });
		break;
	case "control":
	    $.get("php/views/control/CalendarControl.php", {
	        //"id": building
	    },
	    function(data){
	        $('#toolbar').html(data);
	    });
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

function init() {
	load("calendar");
	load("room");
	load("control");
}