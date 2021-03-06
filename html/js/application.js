/**
 * @author:     Stefan Meier
 * @version:    20110710
 * 
 * This script holds the application params
 */

var lang = 'en';
var resourceBundle = new Array();
var dialogTitle = '';
var caldate = '';
var view = '';
var eventMode = 'add';
var eventPosX;
var eventPosY;
var eventSalle;
var month = new Date().getMonth() + 1;
var year = new Date().getFullYear();
var room;
var building;

var maxYearOffset = 3; //date max. dans le futur

function init() {
    /*Fonction pour réécrire le buttonpane afin de pouvoir
     *définir l'id, la classe et le titre. Dévleoppée par
     * http://blog.mynotiz.de/programmieren/jquery-ui-dialog-buttons-anpassen-945/
     *
     *Utilisation:
     *
     *          "MonButton" : $.extend(function() {
                    actions à faire
                }, {
                    classes : 'maclasse',
                    title : 'montittre',
                    id : 'monid'
                }),
     */
    (function() {
        var dialogPrototype = $.ui.dialog.prototype;
        var originalButtons = dialogPrototype._createButtons;
        dialogPrototype._createButtons = function(buttons) {

            originalButtons.apply(this, arguments);

            var $buttons = this.element.siblings('.ui-dialog-buttonpane').find('button');

            var i = 0;
            for ( var label in buttons) {
                var button = buttons[label];
                var $button = $buttons.eq(i);

                if (button.title) {
                    $button.attr('title', button.title);
                }

                if (button.classes) {
                    $button.addClass(button.classes);
                }

                if (button.id) {
                    $button.attr('id', button.id);
                }

                i += 1;
            }
        }

    })();
    
	$.getJSON('php/application/ip.php', function(data){
	    	subdomain = parseInt(data.subdomain);
	    	 switch (subdomain) {
	    	 //DEC
	    	 case 194 :
	    		 room = 53;
	    		 building = 21;
	    		 break;
	    	 //DP
	    	 case 201 :
	    		 room = 44;
	    		 building = 7;
	    		 break;
             	 case 200 :
                 	 room = 44;
                 	 building = 7;
                 	 break;
             	 case 197 :
                 	 room = 44;
                 	 building = 7;
                 	 break;
	    	 //DB, Etat de Vaud
	    	 case 210 :
	    	 	 room = 61;
	    	 	 building = 72;
	    	 	 break;
             	 case 221 :
                 	 room = 61;
                 	 building = 72;
                 	 break;
	    	 //LICR
	    	 case 211 :
	    		 room = 54;
	    		 building = 1;
	    		 break;
	         //DPT
	    	 default: 
	    		 room = 13;
	    	 	 building = 27;
	    	 	 break;
	    	 }
	    	 
	    	if ($.cookie("building") != null) {
        		building = $.cookie("building");

		    }
		    if ($.cookie("room") != null) {
		        room = $.cookie("room");
		
		    }
		    if ($.cookie("year") != null) {
		        year = $.cookie("year");
		    }
		    if ($.cookie("month") != null) {
		        month = $.cookie("month");
		    }
		    if ($.cookie("lang") == null) {
			    if (browserLang() != null && browserLang() != 'undefined' && browserLang() != "") {
			        tlang = browserLang();
			        
			        if (tlang == 'fr' || tlang == 'en' || tlang == 'ja') {
			        	lang = tlang;
			        	$.cookie("lang", lang);
			        }
			    }
			}
		    appUI();
	});

    
    setTimeout('sessionTimeout()', 3600001);
}

function newEvent(caldate) {
    this.dialogTitle = "<span class=\"dialog-title\" id=\"new\">" + resourceBundle["calendar-event-new"] + "</span>";
    this.eventMode = 'add';
    this.caldate = caldate;
}

function editEvent(posX, posY, caldate) {
    this.dialogTitle = "<span class=\"dialog-title\" id=\"edit\">" + resourceBundle["calendar-event-edit"] + "</span>";
    this.eventMode = 'edit';
    this.eventPosX = posX;
    this.eventPosY = posY;
    this.caldate = caldate;
}

function appUI() {
	if ($.cookie("lang") != null) {
		this.lang = $.cookie("lang");
	}

    $('.language').css('font-weight', 'normal');
    $('#' + lang).css('font-weight', 'bold');

    $.ajax({
        type: "GET",
        url: "php/controller/ApplicationController.php?lang=" + lang,
        success: function(msg) {
        	 $.ajax({
        	 	   type: "GET",
        	 	   url: "html/js/lang.php",
        	 	   dataType: "script",
        	 	  success: function(msg){
        	 		$('#page-title').html(resourceBundle["application-title"]);
        	 		$('#todayLabel').html(resourceBundle["today"]);

        	 	    $('#information-title').html(resourceBundle["calendar-information"]);
        	 	    $('#calendar-choice').html(resourceBundle["calendar-choice"]);
        	 	    $('#go-to').html(resourceBundle["calendar-goTo"]);
        	 	    

        	       $('#month').html('');
        	       for (i = 1; i <= 12; i++) {
        	           $('#month').append('<option value=\"' + i + '\">' + resourceBundle["month-" + i + "-full"] + '</option>');
        	       }

        	       buildings();
        	       calendar();
        	 	    
        	 	  }
        	 	 });
        }
    });
}

function buildings() {
    $.get("php/views/buildings.php", {
        "id": building
    },
    function(data){
        $('#rooms').html(data);
        $('#buildings [value=' + building + ']').attr('selected', true);
        $('#room [value=' + room + ']').attr('selected', true);
    });
}

function calendar() {
    $.get("php/views/calendar.php", {
        "view": view,
        "room": room,
        "year" : year,
        "month" : month,
        "building" : building
    },
    function(data){
        $('#calendar').html(data);

        //importation du code html plutôt que de la balise
        $('#roomName').html($('#cal_roomName').html());
        $('#roomDescription').html($('#cal_roomDescription').html());
        $('#cal_roomName').remove();
        $('#cal_roomDescription').remove();

        for (i = 1; i <= 7; i++) {
            $("#day" + i).html(resourceBundle["day-" + (i+1) + "-full"]);
        }
        $("#day" +7).html(resourceBundle["day-" + 1 + "-full"]);
    });
    $("#monthname").html(resourceBundle["month-" + (parseInt(month)) + "-full"]);
    $("#yearName").html(year);

    if (lang == 'ja') {
        $("#yearName").append(' 年');
    }


    $("#month").val(month);
    $("#year").html('');

    var y = new Date().getFullYear();
    for (i = 0; i <= maxYearOffset; i++) {
        $('#year').append('<option value=\"' + (y + i) + '\">' + (y + i) + '</option>');
    }

    $("#year").val(year);
}

function browserLang() {
    var lct="fr";
    if (navigator.language) {
        lct=navigator.language.toLowerCase().substring(0, 2);
    } else if (navigator.userLanguage) {
        lct=navigator.userLanguage.toLowerCase().substring(0, 2);
    } else if (navigator.userAgent.indexOf("[")!=-1) {
        var debut=navigator.userAgent.indexOf("[");
        var fin=navigator.userAgent.indexOf("]");
        lct=navigator.userAgent.substring(debut+1, fin).toLowerCase();
    }
    return lct;
}

//Initialisation de JQuery
$(document).ready(function() {
	init();
    $(".language").click(function() {

        lang = $(this).attr('id');
        $.cookie("lang", lang);
        appUI();
    });

    $("#today").click(function() {
    	month = new Date().getMonth() + 1;
    	year = new Date().getFullYear();;

       $.cookie("year", year);
       $.cookie("month", month);

       calendar();

    });
    
    $("#prev").click(function() {
        y = parseInt(year);
        m = parseInt(month);

        if(!((new Date().getFullYear() == year) && (month == 1))) {
            prevYear = (m != 1) ? y : (y - 1);
            prevMonth = (m == 1) ? 12 : (m - 1);

            year = prevYear;
            month = prevMonth;

            $.cookie("year", year);
            $.cookie("month", month);

            calendar();
        }
    });

    $("#next").click(function() {
        y = parseInt(year);
        m = parseInt(month);

        if(!(((new Date().getFullYear() + maxYearOffset) == year) && (month == 12)))
        {
            nextYear = (m != 12) ? y : (y + 1);
            nextMonth = (m == 12) ? 1 : (m + 1);

            year = nextYear;
            month = nextMonth;
            $.cookie("year", year);
            $.cookie("month", month);
            calendar();
        }
    });

});
