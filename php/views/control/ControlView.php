<script type="text/javascript">  

	function setCalendarDate(date) {
	    $('#calendar-datepicker').datepicker('setDate', date);
	}
    $(document).ready(function(){
    	$( "#calendar-datepicker" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
			showWeek: true,
			firstDay: 1,
			dateFormat: 'yyyy-mm-dd'
		});
       
        setCalendarDate(stringToDate("2011-11-04"));                 

    });
</script>
<!-- BEGIN DATE-SELECTOR -->

<div id="calendar-datepicker"
	class="jquery-gray" style="clear: both; margin-right: 6px;"></div>

<!-- END DATE SELECTOR -->
