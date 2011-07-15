
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
    		function(){ $(this).removeClass('ui-state-default').addClass('ui-state-focus'); },
    		function(){ $(this).removeClass('ui-state-focus').addClass('ui-state-default'); }
    	);
    	
    	// MENUS    	
		$.get('php/views/control/BuildingControl.php', function(data){ // grab content from another page
			$('#buildingChooser').menu({ 
				content: data, 
				flyOut: true });
		});

		$.get('php/views/control/RoomControl.php', function(data){ // grab content from another page
			$('#roomChooser').menu({ 
				content: data, 
				flyOut: true });
		});

		 $("#next").click(function() {
		        if(!(((new Date().getFullYear() + maxYearOffset) == currentDate.getFullYear()) && (currentDate.getMonth() == 12)))
		        {
		        	if (currentDate.getMonth() == 11) {
		        	    currentDate = new Date(currentDate.getFullYear() + 1, 0, 1);
		        	} else {
		        	    currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
		        	}

		            $.cookie("currentDate", currentDate);

		        }
		        alert(currentDate);
		    });

    });
    </script>

<div id="goTo">
	<button type="button" class="btn">
		<span><span>Aujourd'hui</span> </span>
	</button>
</div>
<div id="action">
	<button type="button" id="previous" class="btn pill-l"><span><span><img src="html/img/previous1.gif"alt="previous" /></span></span></button><button type="button" id="weekView" class="btn pill-c"><span><span>Semaine</span></span></button><button type="button"  id="monthView" class="btn pill-c primary"><span><span>Mois</span></span></button><button type="button" class="btn pill-r" id="next"><span><span><img src="html/img/next1.gif" alt="next" /> </span></span></button>
</div>

<div id="name" class="jquery-gray">
	<a tabindex="0" href="#buildings"
		class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all"
		id="buildingChooser"><span class="ui-icon ui-icon-triangle-1-s"></span>Bugnon
		27</a> <a tabindex="0" href="#rooms"
		class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all"
		id="roomChooser"><span class="ui-icon ui-icon-triangle-1-s"></span>Sous-sol
		- animalerie - flux 1b</a>
</div>
<div id="calendar-information">juillet 2011</div>

