/**
 * @author:     Stefan Meier
 * @version:    20110711
 * 
 * This script is a listener for all eventdialog events
 */

function disableForm() {
    $("#eventform :input").each(function() {
        $(this).attr('disabled', true);
    });
    $(".ui-dialog-buttonpane").remove();
}

function wholeDay() {
    if ($('#whole_day').is(':checked')) {

        $("#start").hide();
        $("#start_hour option[text=00]").attr('selected', true);
        $("#start_min option[text=00]").attr('selected', true);

        $("#end").hide();
        $("#end_hour option[text=00]").attr('selected', true);
        $("#end_min option[text=00]").attr('selected', true);

    }
    else {
        $("#start").show();
        $("#end").show();

    }
}

function updateConfirm() {
	buttonsOpts = {}
    buttonsOpts[resourceBundle["calendar-event-cancel"]] = function() {
        $("#modifyall").val("");
        $( this ).dialog( "close" );
    };
    buttonsOpts[resourceBundle["calendar-message-confirm-button-yes"]] = function() {
        $("#modifyall").val("true");
        sendForm('edit');
        $( this ).dialog( "close" );
    };
	$("#dialog-confirm-repeat").html("<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" + resourceBundle["calendar-message-confirm-repeat-update"] + "</p>");
    $("#dialog-confirm-repeat").dialog({
        resizable: false,
        height:130,
        width: 550,
        modal: true,
        buttons: buttonsOpts
    });
}

function confirmChanges(action) {
    buttonsOpts = {}
    buttonsOpts[resourceBundle["calendar-event-cancel"]] = function() {
        $("#modifyall").val("");
        $( this ).dialog( "close" );
    };
    buttonsOpts[resourceBundle["calendar-message-confirm-button-allFuture"]] = function() {
        $("#modifyall").val("true");
        sendForm(action);
        $( this ).dialog( "close" );
    };
    buttonsOpts[resourceBundle["calendar-message-confirm-button-thisEvent"]] =  function() {
        $("#modifyall").val("false");
        sendForm(action);
        $( this ).dialog( "close" );
    };
    $("#dialog-confirm-repeat").html("<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" + resourceBundle["calendar-message-confirm-repeat-update"] + "</p>");
    $("#dialog-confirm-repeat").dialog({
        resizable: false,
        height:130,
        width: 550,
        modal: true,
        buttons: buttonsOpts
    });
}

function alerteIndisponibilite() {
	buttonsOpts = {}
    buttonsOpts[resourceBundle["calendar-message-confirm-button-ok"]] = function() {
        $( this ).dialog( "close" );
    };
    $("#dialog-alerte-indisponibilite").dialog({
        resizable: false,
        width: 350,
        modal: true,
        buttons: buttonsOpts
            /*"OK": function() {
                $( this ).dialog( "close" );
            },
            "Insérer évéenemts disponibles": function() {
                sendForm('insert-available');
                $( this ).dialog( "close" );
            }*/
    });
}

function repeatSelector() {
    if ($("#repeat :selected").val() == 'n') {
        $("#repeat_date").hide();
        $("#repeat_end").removeClass('required');
    }
    else {
        $("#repeat_date").show();
        $("#repeat_end").addClass('required');
    }
}

$(document).ready(function() {
    $('#name').focus();

    if ($("#edate").val() == '') {

        $("#edate").val(caldate);
    }
    if ($("#repeat_end").val() == '') {
        $("#repeat_end").val(caldate);
    }
    /*$("#edate").change(function() {

        edate = $("#edate").val();
        $("#repeat_end").val(edate);
    });*/

    $("#start_hour").change(function() {
        start = $("#start_hour").val();
        
        $("#end_hour").val("23");
        if (start < 23) {
            value =  parseInt(start)+ 1;
            if (start < 10) {
                value = '0' + value;
            }
            $("#end_hour").val(value);
        }
        

        
    });

    $("#repeat_date").hide();
    // Datepicker
    $(".datepicker").datepicker({
        dayNamesMin: [resourceBundle["day-1-short"], resourceBundle["day-2-short"], resourceBundle["day-3-short"], resourceBundle["day-4-short"], resourceBundle["day-5-short"], resourceBundle["day-6-short"], resourceBundle["day-7-short"]],
        monthNames: [resourceBundle["month-1-full"],resourceBundle["month-2-full"],resourceBundle["month-3-full"],resourceBundle["month-4-full"],resourceBundle["month-5-full"],resourceBundle["month-6-full"],resourceBundle["month-7-full"],resourceBundle["month-8-full"],resourceBundle["month-9-full"],resourceBundle["month-10-full"],resourceBundle["month-11-full"],resourceBundle["month-12-full"]],
        firstDay: 1,
        maxDate: (new Date().getFullYear() + maxYearOffset) + '-12-31',
        minDate: new Date().getFullYear() + '-1-1',
        dateFormat: 'yy-mm-dd'
    });

    wholeDay();

    $('#whole_day').change(function() {
        wholeDay();
    });
    repeatSelector();
    $('#repeat').change(function() {
        repeatSelector();
    });
});
