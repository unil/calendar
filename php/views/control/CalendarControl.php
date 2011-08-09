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
    		function(){
        		 $(this).removeClass('ui-state-default').addClass('ui-state-focus'); 
        	},
    		function(){ 
        		$(this).removeClass('ui-state-focus').addClass('ui-state-default'); 
        	}
    	);
    	
    	// MENUS    	
		$.get('php/views/control/BuildingControl.php', function(data){ // grab content from another page
			$('#buildingChooser').menu({ 
				content: data, 
				flyOut: true,
				width: 100 });
		});

		$.get('php/views/control/RoomControl.php', function(data){ // grab content from another page
			$('#roomChooser').menu({ 
				content: data, 
				flyOut: true,
				width: 300 });
		});

		 $("#today").click(function() {
					goToToday();
		    });

		 $("#previous").click(function() {
		        if(!((new Date().getFullYear() == currentDate.getFullYear()) && (new Date().getMonth() == currentDate.getMonth())))
		        {
					goToPreviousMonth();
		        }

		    });

		 $("#next").click(function() {
		        if(!(((new Date().getFullYear() + maxYearOffset) == currentDate.getFullYear()) && (currentDate.getMonth() == 12)))
		        {
					goToNextMonth();
		        }
		    });

		 el = $("#roomChooser");
		 el.watch("href", function (data, i) {
			console.log("sd");
			 setTimeout(function () { console.log("asdfasdf"); },10);
		    });
    });
    </script>

<div id="goTo">
	<button type="button" class="btn" id="today" style="width: 100px;">
		<span><span>Aujourd'hui</span> </span>
	</button>
</div>
<div id="action">
	<button type="button" id="previous" class="btn pill-l"><span><span><img src="img/previous.gif"alt="previous" /></span></span></button><button type="button" id="weekView" class="btn pill-c"><span><span>Semaine</span></span></button><button type="button"  id="monthView" class="btn pill-c primary"><span><span>Mois</span></span></button><button type="button" class="btn pill-r" style="width: 50px;" id="next"><span><span><img src="img/next.gif" alt="next" /> </span></span></button>
</div>

<div id="name" class="jquery-gray" style="text-align: right">
	<a tabindex="0" href="default"
		class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all"
		id="buildingChooser"><span class="ui-icon ui-icon-triangle-1-s"></span><span id="current-building">Bugnon
		27</span></a> <a tabindex="0" href="default"
		class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all"
		id="roomChooser"><span class="ui-icon ui-icon-triangle-1-s"></span><span id="current-room">Sous-sol
		- animalerie - flux 1b</span></a>
</div>
<div id="calendar-information">juillet 2011</div>

