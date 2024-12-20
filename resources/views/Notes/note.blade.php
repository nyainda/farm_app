<x-app-layout title="Forms">


    <div class="container mx-auto p-6">
        <div class="bg-white font-serif dark:bg-gray-800 rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="md:flex md:items-center md:justify-between md:p-4 md:mb-4 md:rounded-lg p-2 mb-2 rounded-lg text-center">
                    <h1 class="text-lg md:text-2xl dark:text-white font-semibold mb-2 md:mb-0 md:mr-4">Record <span class="text-blue-400 "></span> New Notes</h1>
                    <span class="px-2 py-1 text-xs md:text-sm text-blue-400 bg-gray-600 rounded-full">{{$animal->internal_id}}</span>
                </div>

                <form action="{{ route('Notes.storenote', ['animal_id' => $animal->id]) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class=" dark:text-gray-200  mb-4 text-gray-600">Content <span class="text-red-500"></span></label>
                            <textarea name="content" class="w-full h-40 border dark:bg-gray-700 border-gray-300 rounded-lg p-2" placeholder="Add notes or comments" id="content" required></textarea>
                        </div>


                        <div class="col-span-1">
                            <label class="dark:text-gray-200 mb-4  text-gray-600" for="note_date">Date</label>
                            <input class="w-full p-2 dark:bg-gray-700 dark:text-gray-200 border border-gray-300 rounded-lg" value="" type="date" name="date" id="note_date">
                        </div>

                        <div class="col-span-1">
                            <label class="dark:text-gray-200  mb-4 text-gray-600" for="note_category">Category</label>
                            <select class="w-full p-2 border dark:bg-gray-700 dark:text-gray-200  border-gray-300 rounded-lg" name="category" id="note_category">
                                <option value=""></option>
                                <option value="Breeding">Breeding</option>
<option value="Deworming">Deworming</option>
<option value="General">General</option>
<option value="Grazing">Grazing</option>
<option value="Grooming">Grooming</option>
<option value="Injury">Injury</option>
<option value="Medication">Medication</option>
<option value="Moved">Moved</option>
<option value="Pregnancy Check">Pregnancy Check</option>
<option value="Supplement">Supplement</option>
<option value="Vaccination">Vaccination</option>
<option value="Veterinarian">Veterinarian</option>
<option value="Other">Other</option></select>
                                <!-- Add other options here -->
                            </select>
                        </div>

                        <div class="col-span-1">
                            <label class="dark:text-gray-200  mb-4 text-gray-600" for="note_keywords">Keywords</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-tag text-muted" aria-hidden="true"></i>
                                </span>
                                <input class="w-full p-2 dark:bg-gray-700 dark:text-gray-200 border border-gray-300 rounded-lg" maxlength="100" size="100" type="text" name="name_{{ auth()->user()->id }}" name="keywords" id="note_keywords">
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="dark:text-gray-200  mb-4 text-gray-600" for="note_time">Time</label>
                            <input class="w-full p-2 dark:bg-gray-700 dark:text-gray-200 border border-gray-300 rounded-lg" type="time" name="time" id="note_time">
                        </div>
                        <div class="col-span-1">
                            <label class="dark:text-gray-200 mb-4  text-gray-600" for="file">Attach File</label>
                            <input class="w-full p-2 dark:bg-gray-700 dark:text-gray-200 border border-gray-300 rounded-lg" type="file" name="file" id="file">
                        </div>


                        <div class="col-span-2">
                            <label class="dark:text-gray-200  mb-4 text-gray-600">Add to Calendar</label>
                            <input type="checkbox" name="add_to_calendar" id="add_to_calendar">
                        </div>






                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">

                            <a href="{{route('index')}}" class="btn btn-gray-500">Cancel</a>
                        </button>
                        <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'content' );
</script>

</x-app-layout>

@section('content')
    <h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
    <div class="card">
        <div class="card-header">
            {{ trans('global.systemCalendar') }}
        </div>

        <div class="card-body">
            <link rel='stylesheet'
                  href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>

            <div id='calendar'></div>


        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

@stop
