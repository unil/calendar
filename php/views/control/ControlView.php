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
		$('#building-choose').menu({ 
			content: $('#building-choose').next().html(), // grab content from this page
			showSpeed: 400 
		});
		$('#room-choose').menu({ 
			content: $('#room-choose').next().html(), // grab content from this page
			showSpeed: 400 
		});

		$( "#datepicker" ).datepicker();
    });
    </script>

<!-- BEGIN ROOM-SELECTOR -->
<div class="box">
	<h1>Calendrier</h1>
	<div>
		<a tabindex="0" href="#search-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="building-choose"><span class="ui-icon ui-icon-triangle-1-s"></span>Choose</a>
		<div id="search-engines" class="hidden">
		<ul>
			<li><a href="#">Google</a></li>
			<li><a href="#">Yahoo</a></li>
			<li><a href="#">MSN</a></li>
			<li><a href="#">Ask</a></li>
			<li><a href="#">AOL</a></li>
		</ul>
		</div>
		<a tabindex="0" href="#search-engines2" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="room-choose"><span class="ui-icon ui-icon-triangle-1-s"></span>Choose</a>
		<div id="search-engines2" class="hidden">
		<ul>
			<li><a href="#">Google</a></li>
			<li><a href="#">Yahoo</a></li>
			<li><a href="#">MSN</a></li>
			<li><a href="#">Ask</a></li>
			<li><a href="#">AOL</a></li>
		</ul>
		</div>
	</div>
</div>
<!-- END ROOM SELECTOR -->
<!-- BEGIN DATE-SELECTOR -->
<div class="box">
	<div>
	<div id="datepicker" style="clear: both;"></div>
	</div>
</div>
<!-- END DATE SELECTOR -->