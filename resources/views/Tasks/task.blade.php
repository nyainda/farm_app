<x-app-layout title="Forms">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <div class="container mx-auto font-serif mt-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">Create New Task</h2>
        <!-- Modal Header -->
        <form action="{{ route('Tasks.storetask', ['animal_id' => $animal->id]) }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-full">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Task Title</label>
                    <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                </div>

                <div>
                    <label for="startDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                    <input type="date" id="startDate" name="start_date" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                <div>
                    <label for="startTime" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Time</label>
                    <div class="flex space-x-2">
                        <select id="startHour" name="start_hour" class="w-1/2 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
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
                        <input type="number" id="startMinute" name="start_minute" class="w-1/2 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" min="0" max="59" placeholder="MM">
                    </div>
                </div>

                <div>
                    <label for="endDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
                    <input type="date" id="endDate" name="end_date" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label for="endTime" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Time</label>
                    <div class="flex space-x-2">
                        <select id="endHour" name="end_hour" class="w-1/2 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
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
                        <input type="number" id="endMinute" name="end_minute" class="w-1/2 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" min="0" max="59" placeholder="MM">
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                        <option disabled="disabled" value="──────────">──────────</option>
                        <option value="Incomplete">Incomplete</option>
                        <option value="Missed">Missed</option>
                        <option value="Skipped">Skipped</option></select>
                    </select>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Priority</label>
                    <select id="priority" name="priority" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="highest">Highest</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                        <option value="lowest">Lowest</option></select>
                    </select>
                </div>

                <div class="col-span-full">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                </div>

                <div>
                    <label for="associatedTo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Associated To</label>
                    <input type="text" id="associatedTo" value="{{$animal->type}}" name="associated_to" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Color</label>
                    <div class="flex flex-wrap gap-3">
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



