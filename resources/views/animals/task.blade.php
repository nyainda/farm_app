<x-app-layout title="Forms">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <div class="container font-serif mx-auto mt-8 p-4 mb-4 bg-gray-100 dark:bg-gray-700 dark:rounded-lg rounded-lg shadow-lg">
        <div class="modal-header mb-4 flex justify-between items-center">
            <h3 class="text-2xl dark:text-gray-200 font-serif text-gray-800 font-semibold">New Task</h3>
        </div>
        <!-- Modal Header -->
        <form action="{{ route('animals.storetask', ['animal_id' => $animal->id]) }}" method="POST"class="grid grid-cols-2 gap-4">
            @csrf
            <div class="col-span-2">
                <label for="title" class="block font-serif dark:text-gray-200 text-gray-600">Title</label>
                <input type="text" id="title" name="title" class="form-input dark:text-gray-200 dark:bg-gray-700 w-full" required>
            </div>

            <div>
                <label for="startDate" class="block dark:text-gray-200 text-gray-600">Start Date</label>
                <input type="date" id="startDate" name="start_date" class="form-input dark:text-gray-200 dark:bg-gray-700   w-full">
            </div>
            <div>
                <label for="startTime" class="block dark:text-gray-200 text-gray-600">Start Time</label>
                <div class="flex space-x-2">

                    <select id="startHour" name="start_hour" class="form-select dark:text-gray-200 dark:bg-gray-700 w-1/2">
                        <option value="1">1 AM</option>
                        <option value="2">2 AM</option>
                        <option value="3">3 AM</option>
                        <option value="4">4 AM</option>
                        <option value="5">5 AM</option>
                        <option value="6">6 AM</option>
                        <option value="7">7 AM</option>
                        <option  value="8">8 AM</option>
                        <option value="9">9 AM</option>
                        <option value="10">10 AM</option>
                        <option value="11">11 AM</option>
                        <option value="12">12 PM</option>
                        <option value="13">1 PM</option>
                        <option value="14">2 PM</option>
                        <option value="15">3 PM</option>
                        <option value="16">4 PM</option>
                        <option value="17">5 PM</option>
                        <option value="18">6 PM</option>
                        <option value="19">7 PM</option>
                        <option value="20">8 PM</option>
                        <option value="21">9 PM</option>
                        <option value="22">10 PM</option>
                        <option value="23">11 PM</option>
                    </select>
                    <span>:</span> <!-- Add a colon separator -->
                    <input type="number" id="startMinute" name="start_minute" class="form-input dark:text-gray-200 dark:bg-gray-700 w-1/2" min="0" max="59" placeholder="MM">

                </div>
            </div>




            <div>
                <label for="endDate" class="block dark:text-gray-200 text-gray-600">End Date</label>
                <input type="date" id="endDate" name="end_date" class="form-input dark:text-gray-200 dark:bg-gray-700   w-full">
            </div>

            <div>
                <label for="endTime" class="block dark:text-gray-200 text-gray-600">End Time</label>
                <div class="flex space-x-2">
                   {{-- <input type="number" id="endHour" name="end_hour" class="form-input dark:text-gray-200 dark:bg-gray-700 w-1/2" min="0" max="23" placeholder="HH">--}}

                    <select id="endHour" name="end_hour" class="form-select dark:text-gray-200 dark:bg-gray-700 w-1/2">
                        <option value="1">1 AM</option>
                        <option value="2">2 AM</option>
                        <option value="3">3 AM</option>
                        <option value="4">4 AM</option>
                        <option value="5">5 AM</option>
                        <option value="6">6 AM</option>
                        <option value="7">7 AM</option>
                        <option  value="8">8 AM</option>
                        <option value="9">9 AM</option>
                        <option value="10">10 AM</option>
                        <option value="11">11 AM</option>
                        <option value="12">12 PM</option>
                        <option value="13">1 PM</option>
                        <option value="14">2 PM</option>
                        <option value="15">3 PM</option>
                        <option value="16">4 PM</option>
                        <option value="17">5 PM</option>
                        <option value="18">6 PM</option>
                        <option value="19">7 PM</option>
                        <option value="20">8 PM</option>
                        <option value="21">9 PM</option>
                        <option value="22">10 PM</option>
                        <option value="23">11 PM</option>
                    </select>

                    <span>:</span> <!-- Add a colon separator -->

                    <input type="number" id="endMinute" name="end_minute" class="form-input dark:text-gray-200 dark:bg-gray-700 w-1/2" min="0" max="59" placeholder="MM">
                </div>
            </div>



            <div class="col-span-2 grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block dark:text-gray-200 text-gray-600">Status</label>
                    <select id="status" name="status" class="form-select dark:text-gray-200 dark:bg-gray-700  w-full">
                        <option value="In Progress">In Progress</option>
<option value="Done">Done</option>
<option disabled="disabled" value="──────────">──────────</option>
<option value="Incomplete">Incomplete</option>
<option value="Missed">Missed</option>
<option value="Skipped">Skipped</option></select>
                    </select>
                </div>
                <div>
                    <label for="priority" class="block dark:text-gray-200 text-gray-600">Priority</label>
                    <select id="priority" name="priority" class="form-select dark:text-gray-200 dark:bg-gray-700  w-full">
                        <option value="highest">Highest</option>
<option value="high">High</option>
<option value="medium">Medium</option>
<option value="low">Low</option>
<option value="lowest">Lowest</option></select>
                    </select>
                </div>
            </div>
            <div class="col-span-2">
                <label for="description" class="block dark:text-gray-200 text-gray-600">Description</label>
                <textarea id="description" name="description" class="form-textarea dark:text-gray-200 dark:bg-gray-700   w-full" rows="3"></textarea>
            </div>

            <div class="col-span-2">


                <label for="associatedTo" class="block dark:text-gray-200 text-gray-600">Associated To</label>
                <input type="text" id="associatedTo"  value="{{$animal->type}}" name="associated_to" class="form-input dark:text-gray-200 dark:bg-gray-700 w-full" >
            </div>


            <div>
                <label for="color" class="block dark:text-gray-200 text-gray-600">Color</label>
                <div class="flex space-x-2">
                    <div class="color-option bg-red-500 rounded-full w-8 h-8 cursor-pointer" data-color="red"></div>
                    <div class="color-option bg-green-500 rounded-full w-8 h-8 cursor-pointer" data-color="#008000"></div>
                    <div class="color-option bg-blue-500 rounded-full w-8 h-8 cursor-pointer" data-color="#0000FF"></div>
                    <div class="color-option bg-yellow-500 rounded-full w-8 h-8 cursor-pointer" data-color="#FFFF00"></div>
                    <div class="color-option bg-purple-500 rounded-full w-8 h-8 cursor-pointer" data-color="#800080"></div>
                    <div class="color-option bg-pink-500 rounded-full w-8 h-8 cursor-pointer" data-color="#FFC0CB"></div>
                    <div class="color-option bg-gray-500 rounded-full w-8 h-8 cursor-pointer" data-color="#808080"></div>
                    <div class="color-option bg-red-500 rounded-full w-8 h-8 cursor-pointer" data-color="#FF0000"></div>
                    <div class="color-option bg-green-500 rounded-full w-8 h-8 cursor-pointer" data-color="#008000"></div>
                    <div class="color-option bg-blue-500 rounded-full w-8 h-8 cursor-pointer" data-color="#0000FF"></div>
                    <div class="color-option bg-yellow-500 rounded-full w-8 h-8 cursor-pointer" data-color="#FFFF00"></div>
                    <div class="color-option bg-purple-500 rounded-full w-8 h-8 cursor-pointer" data-color="#800080"></div>
                    <div class="color-option bg-pink-500 rounded-full w-8 h-8 cursor-pointer" data-color="#FFC0CB"></div>

                </div>
                <input type="hidden" id="color" name="color">
            </div>

            <div class="col-span-2">
                <label for="repeats" class="block dark:text-gray-200 text-gray-600">Repeats</label>
                <select id="repeats" name="repeats" class="form-select dark:text-gray-200 dark:bg-gray-700 w-full">
                    <option value="no-repeat">No Repeat</option>
                    <option value="daily">Daily</option>
                    <option value="daily">weekly</option>
                    <option value="daily">monthly</option>
                    <option value="daily">yearly</option>
                </select>
            </div>



            <div id="repeatFields" class="grid grid-cols-2 gap-4 mt-4">
                <div class="flex items-center">
                    <label for="repeatFrequency" class="block dark:text-gray-200 text-gray-600">days</label>
                    <input type="number" id="repeatFrequency" name="repeat_frequency" class="form-input dark:text-gray-200 dark:bg-gray-700 ml-2" min="1">
                </div>

                <div class="flex items-center">
                    <label for="endDate" class="block dark:text-gray-200 text-gray-600">End Date</label>
                    <input type="date" id="endDate" name="end_repeat_date" class="form-input dark:text-gray-200 dark:bg-gray-700 ml-2">
                </div>
            </div>

<hr class="mt-4  col-span-2">
            <div class="flex col-span-2 justify-end mt-6">
                <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">

                    <a href="{{route('index')}}" class="btn btn-gray-500">Cancel</a>
                </button>
                <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    Save
                </button>
            </div>
        </div>
        </form>




    <script>
        const repeatsSelect = document.getElementById('repeats');
    const repeatFields = document.getElementById('repeatFields');

    // Function to show or hide the "Day" and "End Date" fields based on the selected option
    function toggleRepeatFields() {
        if (repeatsSelect.value === 'daily') {
            repeatFields.style.display = 'grid';
        } else {
            repeatFields.style.display = 'none';
        }
    }

    // Add an event listener for the "change" event on the select element
    repeatsSelect.addEventListener('change', toggleRepeatFields);

    // Check the selected option on page load
    toggleRepeatFields();


        const colorOptions = document.querySelectorAll('.color-option');
        colorOptions.forEach(option => {
            option.addEventListener('click', () => {
                const colorInput = document.getElementById('color');
                colorInput.value = option.getAttribute('data-color');
            });
        });
    </script>
</x-app-layout>
