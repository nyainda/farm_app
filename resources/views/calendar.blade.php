<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id='calendar'></div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: '/calendar/events',
                plugins: [ 'dayGrid' ]
            });
            calendar.render();
        });
    </script>
</body>
</html>

