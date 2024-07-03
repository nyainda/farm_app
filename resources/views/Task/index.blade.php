<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Calendar js</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>


  <!-- Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Booking title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" id="title">
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays) {
                    $('#bookingModal').modal('toggle');

                    $('#saveBtn').click(function() {
                        var title = $('#title').val();
                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date = moment(end).format('YYYY-MM-DD');

                        $.ajax({
                            url:"{{ route('calendar.store') }}",
                            type:"POST",
                            dataType:'json',
                            data:{ title, start_date, end_date  },
                            success:function(response)
                            {
                                $('#bookingModal').modal('hide')
                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'start' : response.start,
                                    'end'  : response.end,
                                    'color' : response.color
                                });

                            },
                            error:function(error)
                            {
                                if(error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON.errors.title);
                                }
                            },
                        });
                    });
                },
                editable: true,
                eventDrop: function(event) {
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD');
                    var end_date = moment(event.end).format('YYYY-MM-DD');

                    $.ajax({
                            url:"{{ route('calendar.update', '') }}" +'/'+ id,
                            type:"PATCH",
                            dataType:'json',
                            data:{ start_date, end_date  },
                            success:function(response)
                            {
                                swal("Good job!", "Event Updated!", "success");
                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                },
                eventClick: function(event){
                    var id = event.id;

                    if(confirm('Are you sure want to remove it')){
                        $.ajax({
                            url:"{{ route('calendar.destroy', '') }}" +'/'+ id,
                            type:"DELETE",
                            dataType:'json',
                            success:function(response)
                            {
                                $('#calendar').fullCalendar('removeEvents', response);
                                // swal("Good job!", "Event Deleted!", "success");
                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                    }

                },
                selectAllow: function(event)
                {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                },



            });


            $("#bookingModal").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
            });

            $('.fc-event').css('font-size', '13px');
            $('.fc-event').css('width', '20px');
            $('.fc-event').css('border-radius', '50%');


        });
    </script>
</body>
</html>
<x-app-layout title="Cards">

    <div class="container font-serif mx-auto mt-8 p-4 mb-8 bg-white dark:bg-gray-700 dark:rounded-lg dark:shadow-lg">
        <h1 class="text-2xl dark:text-gray-200 font-semibold mb-4">Record Breeding</h1>
<hr class="mb-4" >
<form action="{{ route('breed.storebreeding', ['animal_id' => $animal->id]) }}" class="grid grid-cols-2 gap-4"  method="POST">

    @csrf

            <!-- Animal ID - You might want to fetch and display a list of animals here -->
            <div class="mb-4">
                <label for="type " class="block text-sm dark:text-gray-200 font-medium text-gray-600">Animal Type[{{$animal->internal_id}}]</label>
                <select name="type" id="type" class="mt-1 p-2 border dark:text-gray-200 dark:bg-gray-800 rounded-md w-full " >
<option value="{{$animal->type}}">{{$animal->type}}</option>
                </select>
            </div>

            <!-- Heat Date -->
            <div class="mb-4">
                <label for="heat_date" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Heat Date</label>
                <input type="date" name="heat_date" id="heat_date" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>

            <!-- Breeding Date -->
            <div class="mb-4">
                <label for="breeding_date" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Breeding Date</label>
                <input type="date" name="breeding_date" id="breeding_date" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>

            <!-- Due Date -->
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>

            <!-- Pregnancy Status -->
            <div class="mb-4">
                <label for="pregnancy_status" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Pregnancy Status</label>
                <select name="pregnancy_status" id="pregnancy_status" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
                    <option value="not_pregnant">Not Pregnant</option>
                    <option value="pregnant">Pregnant</option>
                    <option value="unknown" selected>Unknown</option>
                </select>
            </div>

            <!-- Number of Offspring -->
            <div class="mb-4">
                <label for="offspring_count" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Number of Offspring</label>
                <input type="number" name="offspring_count" id="offspring_count" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>

            <!-- Offspring IDs -->
            <div class="mb-4">
                <label for="offspring_ids" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Offspring IDs</label>
                <input type="text" name="offspring_ids" id="offspring_ids" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <hr class="mt-4  col-span-2">
            <div class="flex col-span-2 justify-end mt-6">
                <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">

                    <a href="{{ route('breed.showbreeding', ['animal_id' => $animal->id]) }}" class="btn btn-gray-500">Cancel</a>
                </button>
                <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    Save
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
