<x-app-layout title="Forms">


    <script src="vendors/fullcalendar/main.min.js"></script>

    <!-- Calendar Event -->
    <script>
    const fullcalendars = document.getElementById('calendar');
    if ( fullcalendars != null) {
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var date = new Date();
        var dates = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          initialDate: dates,
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          events: [
            {
              title: 'All Day Event',
              start: '2021-10-01'
            },
            {
              title: 'Long Event',
              start: '2021-10-03',
              end: '2021-10-06'
            },
            {
              groupId: '999',
              title: 'Repeating Event',
              start: '2021-10-09T16:00:00'
            },
            {
              groupId: '999',
              title: 'Repeating Event',
              start: '2021-10-16T16:00:00'
            },
            {
              title: 'Conference',
              start: '11',
              end: '2021-10-13'
            },
            {
              title: 'Meeting',
              start: '2021-10-12T10:30:00',
              end: '2021-10-12T12:30:00'
            },
            {
              title: 'Lunch',
              start: '2021-10-12T12:00:00'
            },
            {
              title: 'Meeting',
              start: '2021-10-12T14:30:00'
            },
            {
              title: 'Birthday Party',
              start: '2021-10-20T07:00:00'
            },
            {
              title: 'Evant with link',
              url: 'http://google.com/',
              start: '2021-10-28'
            }
          ]
        });
        calendar.render();

      });
    }
    </script>

<div id="calendar"></div>


</x-app-layout>
