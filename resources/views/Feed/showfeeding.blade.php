<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <div class="bg-gray-100 dark:bg-gray-800 mt-2 mx-2 border border-gray-300 dark:border-gray-600 text-red-700 dark:text-red-500 px-4 py-3 rounded-lg relative">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-1 md:space-x-3">
                <li class="flex items-center">
                    <a href="{{ route('index') }}" class="flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Animal
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('Feed.showfeeding', $animal->id) }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">{{ $animal->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Feed</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
        @if(session('success'))
        <div class="relative mx-auto mt-4 max-w-screen-md rounded-lg bg-green-500 px-4 py-4 text-white">
            <div class="absolute top-4 left-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-6 w-6">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-8 mr-12">
                <h5 class="font-semibold leading-snug tracking-normal">Success</h5>
                <p class="mt-2 font-normal leading-relaxed">{{ session('success') }}</p>
            </div>
            <button type="button" class="absolute top-3 right-3 p-1 rounded-lg transition-all hover:bg-white hover:bg-opacity-20" data-dismiss="alert" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        @endif
        <div class="container mx-auto p-6 space-y-6">
            <div class="flex font-serif items-center space-x-4">
                <div class="relative">
                    <div class="w-12 h-12 md:w-10 md:h-10 lg:w-12 lg:h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center text-2xl font-bold">
                        {{ substr($animal->name, 0, 1) }}
                    </div>
                    <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-500 border-2 border-white"></span>
                </div>

                <div class="flex flex-col">
                    <a href="{{ route('index') }}" class="text-lg md:text-xl font-semibold text-gray-800 hover:text-indigo-600 transition duration-300">{{ $animal->name }}</a>
                    <div class="flex items-center mt-1">
                        <span class="text-sm text-gray-600 mr-2">{{ $animal->type }}</span>
                        <span class="text-sm text-gray-600 mr-2">ID: {{ $animal->internal_id }}</span>
                        <span class="text-sm text-gray-600">By: {{ $user->name }}</span>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-6 space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <a
                            href="{{ route('Feed.feeding', ['animal_id' => $animal->id]) }}"
                            class="px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold transition duration-300 ease-in-out flex items-center"
                            data-remote="true"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            New Feeding Record
                        </a>
                        {{--@if(session('feedEfficiency'))
                        <div class="alert alert-info bg-blue-200 text-blue-800 rounded-lg p-4 mr-2" role="alert">
                            Feed Efficiency: {{ session('feedEfficiency') }}
                        </div>
                        @endif--}}
                        <button
                            type="button"
                            onclick="batchDelete()"
                            class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold transition duration-300 ease-in-out flex items-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Delete Selected
                        </button>
                    </div>
                </div>


        @if (count($feedings) > 0)

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full font-serif  text-sm text-left text-gray-500 dark:text-gray-400">

            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox" onclick="toggleCheckboxes(this)" class="form-checkbox h-5 w-5  dark:bg-gray-700 dark:text-gray-400 text-blue-500">
                        </label>
                    </th>

                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Feeding Amount</th>
                    <th scope="col" class="px-6 py-3">Estimated Cost</th>
                    <th scope="col" class="px-6 py-3">Feed Details</th>
                    <th scope="col" class="px-6 py-3">Feed type</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedings as $feeding)
                <tr class="bg-white border-b font-serif dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        <input type="checkbox" class=" dark:bg-gray-700 dark:text-gray-400" name="feeding_ids[]" value="{{ $feeding->id }}">
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $feeding->feeding_date ?: 'N/A'}}
                    </td>
                    <td class="px-6 font-serif py-4">
                        {{ $feeding->amount ?: 'N/A'}}/ <span class="text-red-500">{{ $feeding->unit}}</span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $feeding->estimated_cost ?: 'N/A'}}/ <span class="text-red-500">{{$feeding->feeding_currency ?: 'N/A'}}</span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $feeding->feed_details ?: 'N/A'}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $feeding->food_type ?: 'N/A'}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2 items-center">
                            <a href="{{ route('Feed.feedingedit', ['animal_id' => $animal->id, 'feeding_id' => $feeding->id]) }}" class="inline-flex items-center px-2.5 py-1.5 bg-green-100 text-green-800 rounded-md hover:bg-green-200 transition duration-300 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <div class="flex ">
                                <a href="{{ route('feeding.delete', ['animal_id' => $animal->id, 'feeding_id' => $feeding->id]) }}" class="inline-flex items-center px-2.5 py-1.5 bg-red-100 text-red-800 rounded-md hover:bg-red-200 transition duration-300 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    {{ $feedings->links() }}
</div>

        @else
        <div id="animals" class="p-4  mx-8">
            <div class="content-wrapper font-serif dark:bg-gray-700 nothing mt-4 bg-gray-100 rounded-md p-4">
                <div class="text-muted dark:text-gray-200 text-center text-4xl">
                    <i class="far fas fa-tag" aria-hidden="true"></i>
                </div>
                <div class="text-center font-serif dark:text-gray-200  text-gray-900 text-xl font-semibold mt-4">
                    No new Feeding  yet?
                </div>
                <div class="text-center dark:text-gray-200 font-serif text-gray-600 mt-2">
                    Add a new animal Feeding and they'll show up here.
                </div>

            </div>
        </div>
        @endif
    </div>
    <p class="mb-4 text-gray-600 font-serif text-center dark:text-gray-400"> Displaying all <span class="text-red-500">{{ count($feedings) }}</span> records</p>
</form>
</x-app-layout>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const printButton = document.getElementById("printButton");

        printButton.addEventListener("click", function () {
            // Hide elements with the 'print-hidden' class when printing
            const hiddenElements = document.querySelectorAll(".print-hidden");
            hiddenElements.forEach(function (element) {
                element.style.display = "none";
            });

            // Trigger the browser's print functionality
            window.print();

            // Restore the display property for hidden elements after printing
            hiddenElements.forEach(function (element) {
                element.style.display = "";
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the success message element
        var successMessage = document.querySelector('[data-dismissible-id="success-message"]');

        // If the success message element exists, add a click event listener to dismiss it
        if (successMessage) {
            successMessage.addEventListener('click', function() {
                successMessage.style.display = 'none';
            });
        }
    });
</script>
<script>
    function toggleCheckboxes(checkbox) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(cb) {
            cb.checked = checkbox.checked;
        });
    }
    </script>
<script>
    function batchDelete() {
        var checkboxes = document.querySelectorAll('input[name="feeding_ids[]"]:checked');

        // Check if at least one checkbox is checked
        if (checkboxes.length === 0) {
            alert("Please select at least one batch to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected items?")) {
            var selectedIds = [];

            // Extract ids of selected feedings
            checkboxes.forEach(function(checkbox) {
                selectedIds.push(checkbox.value);
            });

            // Prepare form for batch delete
            var form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', '{{ route("feedings.batchDelete") }}');
            form.innerHTML = '@csrf @method("DELETE")' +
                '<input type="hidden" name="selected_ids" value="' + selectedIds.join(',') + '">';

            // Append form to body and submit it
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

