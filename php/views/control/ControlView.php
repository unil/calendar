<script type="text/javascript">    
    $(document).ready(function(){
    	$( "#calendar-datepicker" ).datepicker({
    		changeMonth: true,
    		changeYear: true,
			showWeek: true,
			firstDay: 1,
			showButtonPanel: true,
			dateFormat: 'yyyy-mm-dd'
		});
    	queryDate = '2010-11-01',
        dateParts = queryDate.match(/(\d+)/g);
        realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);  
                                        // months are 0-based!
	    $('#calendar-datepicker').datepicker('setDate', realDate);
    });
</script>
<!-- BEGIN DATE-SELECTOR -->

<div id="calendar-datepicker"
	class="jquery-gray" style="clear: both; margin-right: 6px;"></div>

<!-- END DATE SELECTOR -->
