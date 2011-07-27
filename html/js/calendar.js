/**
 * @author:     Stefan Meier
 * @version:    20110710
 * 
 * This script is a listener for all calendar events
 */
function sendForm(action) {
    actionURL = "php/controller/event_verify.php";
    if (action == 'delete') {
        $("#action").val("delete");
    }
    else if(action == 'insert-available') {
        actionURL = "php/controller/event_verify.php?insert-available=true";
    }
    $('.ui-dialog').block({ 
        message: '<img src="html/img/loading.gif" />', 
        css: { border: 'none' } 
    }); 
    dataString = $('form').serialize();
    $.ajax({
        type: "POST",
        url: actionURL,
        data: dataString,
        dataType: "json",
        success: function(msg){

            res = eval(msg);
            if (res["success"]) {
                $('#dialog').dialog("close");
            }
            else {
                $('#message').html(getErrors(res));
                $('#message').css("color", "red");
            }
            $('.ui-dialog').unblock(); 
        }

    });

}

function getErrors(errors) {
    errorMessage = "";
    $.each(errors, function(key, val) {
        switch(key) {
            case 'unavailable' :
                i = 0;
                error = "";
                /*console.log(val);*/
                error += "<ul>";
                $.each(val, function(key2, date) {
                	$.each(date, function(key3, val2) {
                    start =  val2["start"].substring(0,5);
                    end = val2["end"].substring(0,5);
                    if (start == end && start == "00:00") {
                    	end = "24:00";
                    }
	                if (i < 5) {
	                    error += "<li>" + key2 + " " + start +  "-" + end + "</li>";
	                }
                    i++;
                	});
                });
                if (i >= 4) {
                	error += "<li>etc.</li>";
                }
                
                error += "</ul>";
                $('#dialog-alerte-indisponibilite').html(resourceBundle["calendar-error-unavailable"] + error);
                	
                alerteIndisponibilite();
                break;
            case 'time' :
                errorMessage += resourceBundle["calendar-error-time"];
                break;
            case 'auth' :
                errorMessage += resourceBundle["calendar-error-access"];
                break;
            case 'room' :
                errorMessage += resourceBundle["calendar-error-room"];
                break;
            case 'action' :
                errorMessage += resourceBundle["calendar-error-action"];
                break;
            case 'eventname' :
                errorMessage += resourceBundle["calendar-error-invalid"];
                break;
            case 'dateformat' :
                errorMessage += resourceBundle["calendar-error-dateFormat"];
                break;
            default :
                if (key != "success") {
                    errorMessage += resourceBundle["calendar-error-system"] + key + " " + val;
                }
                break;
        }

    });
    //errormsg = errormsg;
    return errorMessage;
}


//Initialisation de JQuery
$(document).ready(function() {
    buttonsOpts = {};
    buttonsOpts[resourceBundle["calendar-event-cancel"]] = $.extend(function() {
        $(this).dialog("close");
    },{
        id : 'cancel'
    });
    buttonsOpts[resourceBundle["calendar-event-delete"]] = $.extend(function() {                    
        if($('#original_repeat_mode').val() != 'n' && $('#original_repeat_mode').val() != "") {
            confirmChanges('delete');
        /*if($("#modifyall").val() != "" && $("#modifyall").val() != null) {
                sendForm('delete');
            }*/
        }
        else {
            sendForm('delete');
        }
    }, {
        id : 'delete'
    });       
    buttonsOpts[resourceBundle["calendar-event-save"]] = $.extend(function() {
        var errors = 0;
        $("#eventform :input").each(function() {
            if($(this).val() == '' && $(this).hasClass('required') ){
                $(this).prev().css("color", "red");
                $('#message').html("<span style=\"color:red\">" +resourceBundle["calendar-message-check"] + "</span>");
                errors++;
            } else {
                $(this).prev().css("color", "black");
            }
        });

        if (errors == 0){       
            if($('#original_repeat_mode').val() != 'n' && $('#original_repeat_mode').val() != "" && $('#action').val() == "edit") {
                updateConfirm();
            }
            else {
                sendForm('edit');
            }
        }
    },{
        id : 'save'
    });
    
    
    $('.psf').click(function() {
        var $dialog = $('<div id=\"dialog\"></div>')
        .load('./php/views/eventdialog.php?mode=' + eventMode + '&posX=' + eventPosX + "&posY=" + eventPosY)
        .dialog({
            title: dialogTitle,
            autoOpen: false,
            width: 280,
            buttons: buttonsOpts,
            close: function(ev, ui) {
                calendar();
                $(this).remove();
                $('#dialog-confirm').remove();
            },
            resizable: false,
            modal: true,
            closeOnEscape: true,
            position: 'center'
        });

        $dialog.dialog('open');

        if (eventMode != 'edit') {
            $("#delete").hide();
        }
        return false;
    });
});

