<!DOCTYPE html>
<html>
<head>
<link href='http://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.css' rel='stylesheet' />
<link href='http://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href='http://qtip2.com/v/stable/jquery.qtip.css' rel='stylesheet' />
<script src="http://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js"></script>'>

<script src="http://support.nec.co.id/pi/fullcalc/lib/jquery.min.js"></script>'>
<script src='http://support.nec.co.id/pi/fullcalc/lib/jquery-ui.custom.min.js'></script>

<script src="http://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.min.js"></script>'>
<script src="http://qtip2.com/v/stable/jquery.qtip.js"></script>
<script>

$(document).ready(function() {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
	var tooltip = $('<div/>').qtip({
		id: 'fullcalendar',
		prerender: true,
		content: {
			text: ' ',
			title: {
				button: true
			}
		},
		position: {
			my: 'bottom center',
			at: 'top center',
			target: 'mouse',
			viewport: $('#fullcalendar'),
			adjust: {
				mouse: false,
				scroll: false
			}
		},
		show: false,
		hide: false,
		style: 'qtip-light'
	}).qtip('api');
                        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                        zIndex: 999,
                        revert: true,      // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                });

        });

        $('#calendar').fullCalendar({
        header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
                },
        loading: function(bool) {
                  if (bool) 
                    $('#loading').show();
                  else 
                    $('#loading').hide();
                },
        eventMouseover: function(data, event, view) {
			var content = '<h3>'+data.title+'</h3>' + 
				'<p><b>Start:</b> '+data.start+'<br />' + 
				(data.end && '<p><b>End:</b> '+data.end+'</p>' || '');

			tooltip.set({
				'content.text': content
			})
			.reposition(event).show(event);
		}
        });

    var curSource = new Array();
//           curSource[0] = '/hackyjson/cal?e1=' +  $('#e1').is(':checked') + '&e2='+ $('#e2').is(':checked');
//          curSource[0] = 'ISATMBSKAL_nms_event-boong.php';
//          curSource[1] = 'ISATMBSKAL_nms_event-boong.php';
//          curSource[2] = 'ISATMBSKAL_nms_event-boong.php';
    var newSource = new Array();

$("#e1, #e2, #e3, #e4, #e5, #e6, #x1, #x5, #x6, #x7").change(function() {
//                    newSource[0] = '/hackyjson/cal?e1=' +  $('#e1').is(':checked') + '&e2='+ $('#e2').is(':checked');
            newSource[0] = $('#e1').is(':checked') ? 'calendar/ds/bhsarab' : '';
            newSource[1] = $('#e2').is(':checked') ? 'calendar/ds/tahsin' : '';
            newSource[2] = $('#e3').is(':checked') ? 'calendar/ds/kajian' : '';
            newSource[3] = $('#e4').is(':checked') ? 'calendar/ds/kemakmuranMasjid' : '';
            newSource[4] = $('#x1').is(':checked') ? 'calendar/ds/eventPOM' : '';
            newSource[5] = $('#x5').is(':checked') ? 'calendar/ds/eskul' : '';
            newSource[6] = $('#x6').is(':checked') ? 'calendar/ds/rapatSekolah' : '';
            newSource[7] = $('#x7').is(':checked') ? 'calendar/ds/webcast' : '';


            $('#calendar').fullCalendar('removeEventSource', curSource[0]);
            $('#calendar').fullCalendar('removeEventSource', curSource[1]);
            $('#calendar').fullCalendar('removeEventSource', curSource[2]);
            $('#calendar').fullCalendar('removeEventSource', curSource[3]);
            $('#calendar').fullCalendar('removeEventSource', curSource[4]);
            $('#calendar').fullCalendar('removeEventSource', curSource[5]);
            $('#calendar').fullCalendar('removeEventSource', curSource[6]);
            $('#calendar').fullCalendar('removeEventSource', curSource[7]);

            $('#calendar').fullCalendar('refetchEvents');
            $('#calendar').fullCalendar('addEventSource', newSource[0]);
            $('#calendar').fullCalendar('addEventSource', newSource[1]);
            $('#calendar').fullCalendar('addEventSource', newSource[2]);
            $('#calendar').fullCalendar('addEventSource', newSource[3]);
            $('#calendar').fullCalendar('addEventSource', newSource[4]);
            $('#calendar').fullCalendar('addEventSource', newSource[5]);
            $('#calendar').fullCalendar('addEventSource', newSource[6]);
            $('#calendar').fullCalendar('addEventSource', newSource[7]);
            $('#calendar').fullCalendar('refetchEvents');

            curSource[0] = newSource[0];
            curSource[1] = newSource[1];
            curSource[2] = newSource[2];
            curSource[3] = newSource[3];
            curSource[4] = newSource[4];
            curSource[5] = newSource[5];
            curSource[6] = newSource[6];
            curSource[7] = newSource[7];
        });

});

function onMouseover(event, jsEvent, view) {
    console.log(event);
}
</script>
<style>

	body {
		margin-top: 10px;
		text-align: center;
		font-size: 12px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
	#wrap {
		width: 1100px;
		margin: 0 auto;
		}
		
	#external-events {
		float: left;
		width: 100px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: center;
		}
		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}
		
	.external-event { /* try to mimick the look of a real event */
		margin: 5px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		border-radius
		}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}
	.e1Div div {
		float: left;
	}

	#calendar {
		float: none;
		width: 900px;
		}
    .null,
    .null div,
    .null span {
        background-color: green; /* background color */
        border-color: green;     /* border color */
        color: yellow;           /* text color */
    }
    #menu {        
        background-color: rgba(58, 184, 62, 0.32);
        height: 50px;
        width: 82%;
    }



</style>
</head>
<body>

<div><a href="/">HOME</a></div>
<div id="loading" style="display: none; background-color: red;     font-size: large;">loading...<br>
    <img style="-webkit-user-select: none" src="http://bgallz.org/wp-content/uploads/2012/04/Loading-Animated-GIF.gif"></div>
<p>Plz check item to load data, blue background is has settlement date, green background for not settle yet date, click event to get detail info</p>
</div>
<div id="wrap">
    <div id="menu">
        <div class="e1Div" style="float: left;">
            <input type="checkbox"  name="e1" id="e1" />
            <label for="e1">Ummahat</label>
        </div>
        <div class="x1Div" style="float: left;">
            <input type="checkbox"  name="x1" id="x1" />
            <label for="x1">kelas-Tahsin</label>
        </div>
        <div class="e2Div" style="float: left;">
            <input type="checkbox"  name="e2" id="e2" />
            <label for="e2">Pembangunan Sekolah</label>
        </div>
        <div class="e3Div" style="float: left;">
            <input type="checkbox" name="e3" id="e3" />
            <label for="e3">Kemakmuran Masjid</label>
        </div>
        <div class="e4Div" style="float: left;">
            <input type="checkbox" name="e4" id="e4" />
            <label for="e4">Kegiatan POM</label>
        </div>
        <div class="x5Div" style="float: left;">
            <input type="checkbox"  name="x5" id="x5" />
            <label for="x5">Extra Kurikuler</label>
        </div>
        <div class="x6Div" style="float: left;">
            <input type="checkbox"  name="x6" id="x6" />
            <label for="x6">Rapat Sekolah</label>
        </div>
        <div class="x7Div" style="float: left;">
            <input type="checkbox"  name="x7" id="x7" />
            <label for="x7">WEBCAST / Teleconference</label>
        </div>

    </div>
    <div id='calendar'></div>
</div>
</body>

</html>
