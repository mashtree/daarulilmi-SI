<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/lib/fullcalendar.min.css' rel='stylesheet' />
<link href='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/lib/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/scheduler.min.css' rel='stylesheet' />
<script src='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/lib/jquery.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/lib/jquery-ui.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/lib/fullcalendar.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-scheduler-1.0.2/scheduler.min.js'></script>
<script>

	$(function() { // document ready


		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		$('#calendar').fullCalendar({
			schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
			now: '2015-08-07',
			editable: true, // enable draggable events
			droppable: true, // this allows things to be dropped onto the calendar
			aspectRatio: 1.8,
			scrollTime: '00:00', // undo default 6am scrollTime
			header: {
				left: 'today prev,next',
				center: 'title',
				right: 'timelineDay,timelineThreeDays,agendaWeek,month'
			},
			defaultView: 'timelineDay',
			views: {
				timelineThreeDays: {
					type: 'timeline',
					duration: { days: 3 }
				}
			},
			resourceLabelText: 'Rooms',
			resources: [
				{ id: 'a', title: 'Kelas I' },
				{ id: 'b', title: 'Kelas II', eventColor: 'green' },
				{ id: 'c', title: 'Kelas TK-A', eventColor: 'orange' },
				{ id: 'c1', title: 'Kelas TK-B', eventColor: 'orange' },
				{ id: 'd', title: 'Auditorium D', children: [
					{ id: 'd1', title: 'Room D1' },
					{ id: 'd2', title: 'Room D2' }
				] },
				{ id: 'e', title: 'Masjid' },
				{ id: 'f', title: 'Ruang Rapat 1', eventColor: 'red' },
				{ id: 'g', title: 'Ruang Rapat 2' },
				{ id: 'm', title: 'Motor 1' },
				{ id: 'n', title: 'Motor 2' },
				{ id: 'o', title: 'Motor 3' },
				{ id: 'h', title: 'Pos Keamanan' },
				{ id: 'i', title: 'Tempat Parkir' },
				{ id: 'j', title: 'Mobil Dinas 1' },
				{ id: 'k', title: 'Mobil Dinas 2' },
				{ id: 'p', title: 'Auditorium P' },
				{ id: 'q', title: 'Auditorium Q' }
				],
			events: [
				{ id: '1', resourceId: 'b', start: '2015-08-07T02:00:00', end: '2015-08-07T07:00:00', title: 'event 1' },
				{ id: '2', resourceId: 'c', start: '2015-08-07T05:00:00', end: '2015-08-07T22:00:00', title: 'event 2' },
				{ id: '3', resourceId: 'd', start: '2015-08-06', end: '2015-08-08', title: 'event 3' },
				{ id: '4', resourceId: 'e', start: '2015-08-07T03:00:00', end: '2015-08-07T08:00:00', title: 'event 4' },
				{ id: '5', resourceId: 'f', start: '2015-08-07T00:30:00', end: '2015-08-07T02:30:00', title: 'event 5' }
			],
			drop: function() {
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Bawalah ke tanggal" list
					$(this).remove();
				}
			},
			eventReceive: function(event) { // called when a proper external event is dropped
				console.log('eventReceive', event);
			},
			eventDrop: function(event) { // called when an event (already on the calendar) is moved
				console.log('eventDrop', event);
			}
		});

	});

</script>
<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
	}
		
	#wrap {
		width: 1100px;
		margin: 0 auto;
	}
		
	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
	}
		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}
		
	#external-events .fc-event {
		margin: 10px 0;
		cursor: pointer;
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

	#calendar {
		float: right;
		width: 900px;
	}

</style>
</head>
<body>
	<div id='wrap'>

		<div id='external-events'>
			<h4>Bawalah Event ke tanggal</h4>
			<div class='fc-event'>Guru 1 [Pelajaran 1]</div>
			<div class='fc-event'>Guru 2 [Pelajaran 2]</div>
			<div class='fc-event'>Muroja'ah [Surat:Ayat]</div>
			<div class='fc-event'>Rapat [Agenda]</div>
			<div class='fc-event'>Guru 1</div>
			<div class='fc-event'>Guru 2</div>
			<div class='fc-event'>Guru 3</div>
			<div class='fc-event'>Guru 4</div>
			<div class='fc-event'>Kepala Sekolah</div>
			<div class='fc-event'>Driver 1</div>
			<div class='fc-event'>Driver 2</div>
			<div class='fc-event'>Event Lain</div>

			<p>
				<input type='checkbox' id='drop-remove' />
				<label for='drop-remove'>remove after drop</label>
			</p>
		</div>

		<div id='calendar'></div>

		<div style='clear:both'></div>

	</div>
</body>
</html>
