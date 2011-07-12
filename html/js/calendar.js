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
                error += resourceBundle["calendar-error-unavailable"];
                error += "<ul>";
                $.each(val, function(key, val) {
                    start =  val["start"].substring(0,5);
                    end = val["end"].substring(0,5);
                    
                    error += "<li>" + key + " " + start +  "-" + end + "</li>";
                    i++;
                });
                error += "</ul>";
                if (i> 1) {
                    $('#dialog-alerte-indisponibilite').html(error);
                    alerteIndisponibilite();
                }
                else {
                    errorMessage += resourceBundle["calendar-error-unavailable"];
                }
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

    setTimeout('sessionTimeout()', 3600001);
    init();
    buttonsOpts = {}
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
        //sendForm('');
            
            
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

