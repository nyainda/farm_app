
<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <div class="bg-gray-200 dark:bg-gray-700 mt-2  ml-2 mr-2 border border-gray-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <nav class="flex font-serif " aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
              <li class="inline-flex items-center">
                <a href="{{route("index")}}" class="inline-flex dark:text-gray-200 items-center text-sm font-medium text-gray-700 hover:text-blue-600  dark:hover:text-white">
                  <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                  </svg>
                  Animal
                </a>
              </li>
              <li>
                <div class="flex items-center">
                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
                  <a href="{{route('breed.showbreeding', $animal->id)}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{$animal->name}}</a>
                </div>
              </li>
              <li aria-current="page">
                <div class="flex items-center">
                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
                  <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">breedings</span>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        @if(session('success'))
        <div
          class="font-regular relative mt-4 mx-auto block w-full max-w-screen-md rounded-lg bg-green-500 px-4 py-4 text-base text-white"
          data-dismissible="alert"
          data-dismissible-id="success-message"
        >
          <div class="absolute top-4 left-4">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              aria-hidden="true"
              class="mt-px h-6 w-6"
            >
              <path
                fill-rule="evenodd"
                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </div>
          <div class="ml-8 mr-12">
            <h5 class="block font-sans text-xl font-semibold leading-snug tracking-normal text-white antialiased">
              Success
            </h5>
            <p class="mt-2 block font-sans text-base font-normal leading-relaxed text-white antialiased">
              {{ session('success') }}
            </p>
          </div>
          <div
            data-dismissible-target="alert"
            data-ripple-dark="true"
            class="absolute top-3 right-3 w-max rounded-lg transition-all hover:bg-white hover:bg-opacity-20"
          >
            <div role="button" class="w-max rounded-lg p-1">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                ></path>
              </svg>
            </div>
          </div>
        </div>
    @endif
    <div class="container mx-auto p-6 space-y-6">
        <div class="flex font-serif items-center space-x-4">
            <div class="w-12 h-12 md:w-10 md:h-10 lg:w-12 lg:h-12 dark:text-gray-100 font-serif rounded-full bg-gradient-to-br from-blue-500 to-purple-500 text-white flex items-center justify-center text-2xl font-bold">
                {{ substr($animal->name, 0, 1) }}
            </div>
            <!-- Name and Status as clickable link -->
            <div class="ml-4 flex flex-col">
                <a href="{{ route('index') }}" class="text-2xl font-serif font-semibold text-gray-800 hover:text-blue-500 transition duration-300">{{ $animal->name }}</a>
                <div class="flex">
                    <p class="text-sm text-blue-500">{{ $animal->type }}</p>
                    <p class="text-sm ml-4 text-blue-500">Id: {{ $animal->internal_id }}</p>
                    <p class="text-sm ml-4 text-blue-500">By:{{$user->name}}</p>
                </div>
            </div>
        </div>
        <div class="mb-4 flex flex-col font-serif sm:flex-row justify-between items-center">
            <div class="mb-2 sm:mb-0">
                <a class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 font-serif  transition duration-300 ease-in-out" data-remote="true" href="{{ route('breed.breeding', ['animal_id' => $animal->id]) }}">New breedings</a>
            </div>
            <div class="sm:ml-2">
                <button id="printButton" class="btn btn-default hidden sm:inline-block" title="Print">
                    <i class="fas fa-print" aria-hidden="true"></i> Print
                </button>
            </div>
        </div>
        <div id="tableContainer">
            <!-- Your table containers will be dynamically added here -->
          </div>


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

    // Function to determine if the animal type is poultry
    function isPoultry(animalType) {
        const poultryTypes = ["Chicken", "Duck", "Goose", "Ostrich", "Partridge", "Guineafowl",  "Peafowl", "Pheasant", "Pigeon", "Quail", "Turkey","Hen","Cock"];
        return poultryTypes.includes(animalType);
    }

    // Function to determine if the animal type is fish
    function isFish(animalType) {
        const fishTypes = ["Shrimp", "Crab", "Lobster", "Mollusk", "Salmon", "Trout", "Fish", "Catfish", "Tilapia"];
        return fishTypes.includes(animalType);
    }

    // Function to determine if the animal type is insect
    function isInsect(animalType) {
        const insectTypes = ["Bees", "Butterflies", "Crickets", "Mealworms", "Silkworms", "Waxworms"];
        return insectTypes.includes(animalType);
    }

    // Function to determine if the animal type is cattle
    function isCattle(animalType) {
        const cattleTypes = ["Bison", "Buffalo", "Camel", "Cattle", "Deer", "Donkey", "Gayal", "Goat", "Muskox", "Rabbit", "Reindeer", "Rhea", "Horse", "Donkey", "Mule", "Dog", "Cat", "Alpaca", "Llama", "Emu", "Elk", "Pig", "Swine", "Cow", "Bull", "Sheep", "Water buffalo", "Yak"];
        return cattleTypes.includes(animalType);
    }

    // Function to determine if the animal type is amphibians
    function isAmphibians(animalType) {
        const amphibianTypes = ["Frog", "Toad", "Turtle", "Snake", "Lizard"];
        return amphibianTypes.includes(animalType);
    }

    // Function to retrieve the animal type from the database using Laravel
    function getAnimalTypeFromDatabase() {
        // Use Laravel's Blade templating to pass the animal type from the backend to JavaScript
        return "{{ $animal->type }}";
    }

    // Function to dynamically create and display the table based on the retrieved animal type
    function displayTable() {
        const selectedAnimalType = getAnimalTypeFromDatabase(); // Retrieve the animal type

        // Clear the container
        document.getElementById("tableContainer").innerHTML = "";

        // Create and display the table for the retrieved animal type
        if (isPoultry(selectedAnimalType)) {
            createTableForPoultry();
        } else if (isFish(selectedAnimalType)) {
            createTableForFish();
        } else if (isInsect(selectedAnimalType)) {
            createTableForInsect();
        } else if (isCattle(selectedAnimalType)) {
            createTableForCattle();
        } else if (isAmphibians(selectedAnimalType)) {
            createTableForAmphibians();
        } else {
            // Handle other animal types
        }
    }

    // Function to create and display the table for poultry
    function createTableForPoultry() {
        const tableHTML = `@if (count($breedings) > 0)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs font-serif text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Hatching Date</th>
                            <th scope="col" class="px-6 py-3">Incubation Time</th>
                            <th scope="col" class="px-6 py-3">Number of Eggs</th>
                            <th scope="col" class="px-6 py-3">Temperature (°C)</th>
                            <th scope="col" class="px-6 py-3">Humidity (%)</th>
                            <th scope="col" class="px-6 py-3">Eggs Hatched</th>
                            <th scope="col" class="px-6 py-3">Light Conditions</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breedings as $breeding)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium font-serif text-gray-900 whitespace-nowrap dark:text-white">{{$breeding->hatching_date ?: 'N/A'}}</th>
                                <td class="px-6 font-serif py-4">{{$breeding->period_day ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->no_eggs ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->temp ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->humidity ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->number_of_chicks ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->light_condition ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">
                                    <a href="{{ route('breed.breedingedit', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium font-serif text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="{{ route('breeding.delete', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium text-red-600 font-serif dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $breedings->links() }}
            </div>
        @else
            <div id="animals" class="p-4 mx-8">
                <div class="content-wrapper font-serif dark:bg-gray-700 nothing mt-4 bg-gray-100 rounded-md p-4">
                    <div class="text-muted dark:text-gray-200 text-center text-4xl">
                        <i class="far fas fa-tag" aria-hidden="true"></i>
                    </div>
                    <div class="text-center font-serif dark:text-gray-200 text-gray-900 text-xl font-semibold mt-4">
                        No new notes yet?
                    </div>
                    <div class="text-center dark:text-gray-200 font-serif text-gray-600 mt-2">
                        Add a new notes and they'll show up here.
                    </div>
                </div>
            </div>
        @endif
        <p class="mb-4 text-gray-600 font-serif text-center dark:text-gray-400"> Displaying all <span class="text-red-500 font-serif">{{ count($breedings) }}</span> records</p>`;
        document.getElementById("tableContainer").innerHTML = tableHTML;
    }

    // Function to create and display the table for fish
    function createTableForFish() {
        const tableHTML = `@if (count($breedings) > 0)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs font-serif text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Date of Breeding</th>
                            <th scope="col" class="px-6 py-3">Temperature(°C)</th>
                            <th scope="col" class="px-6 py-3">Water pH</th>
                            <th scope="col" class="px-6 py-3">Pond Size</th>
                            <th scope="col" class="px-6 py-3">Spawning Behavior</th>
                            <th scope="col" class="px-6 py-3">Spawning Substrate</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breedings as $breeding)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium font-serif text-gray-900 whitespace-nowrap dark:text-white">{{$breeding->date_of_breeding ?: 'N/A'}}</th>
                                <td class="px-6 font-serif py-4">{{$breeding->temp ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->water_ph ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->tank_size ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->spawning_behavior ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->spawning_substrate ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">
                                    <a href="{{ route('breed.breedingedit', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium font-serif text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="{{ route('breeding.delete', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium text-red-600 font-serif dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $breedings->links() }}
            </div>
        @else
            <div id="animals" class="p-4 mx-8">
                <div class="content-wrapper font-serif dark:bg-gray-700 nothing mt-4 bg-gray-100 rounded-md p-4">
                    <div class="text-muted dark:text-gray-200 text-center text-4xl">
                        <i class="far fas fa-tag" aria-hidden="true"></i>
                    </div>
                    <div class="text-center font-serif dark:text-gray-200 text-gray-900 text-xl font-semibold mt-4">
                        No new notes yet?
                    </div>
                    <div class="text-center dark:text-gray-200 font-serif text-gray-600 mt-2">
                        Add a new notes and they'll show up here.
                    </div>
                </div>
            </div>
        @endif
        <p class="mb-4 text-gray-600 font-serif text-center dark:text-gray-400"> Displaying all <span class="text-red-500 font-serif">{{ count($breedings) }}</span> records</p>`;
        document.getElementById("tableContainer").innerHTML = tableHTML;
    }

    // Function to create and display the table for insect
    function createTableForInsect() {
        const tableHTML = `@if (count($breedings) > 0)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs font-serif text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Temperature</th>
                            <th scope="col" class="px-6 py-3">Humidity</th>
                            <th scope="col" class="px-6 py-3">Egg_Stage</th>
                            <th scope="col" class="px-6 py-3">Pupal_Stage</th>
                            <th scope="col" class="px-6 py-3">Adult_Stage</th>
                            <th scope="col" class="px-6 py-3">Animal type</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breedings as $breeding)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium font-serif text-gray-900 whitespace-nowrap dark:text-white">{{$breeding->temp ?: 'N/A'}}</th>
                                <td class="px-6 font-serif py-4">{{$breeding->humidity ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->egg_stage ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->pupal_stage ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->adult_stage ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->type ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">
                                    <a href="{{ route('breed.breedingedit', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium font-serif text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="{{ route('breeding.delete', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium text-red-600 font-serif dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $breedings->links() }}
            </div>
        @else
            <div id="animals" class="p-4 mx-8">
                <div class="content-wrapper font-serif dark:bg-gray-700 nothing mt-4 bg-gray-100 rounded-md p-4">
                    <div class="text-muted dark:text-gray-200 text-center text-4xl">
                        <i class="far fas fa-tag" aria-hidden="true"></i>
                    </div>
                    <div class="text-center font-serif dark:text-gray-200 text-gray-900 text-xl font-semibold mt-4">
                        No new notes yet?
                    </div>
                    <div class="text-center dark:text-gray-200 font-serif text-gray-600 mt-2">
                        Add a new notes and they'll show up here.
                    </div>
                </div>
            </div>
        @endif
        <p class="mb-4 text-gray-600 font-serif text-center dark:text-gray-400"> Displaying all <span class="text-red-500 font-serif">{{ count($breedings) }}</span> records</p>`;
        document.getElementById("tableContainer").innerHTML = tableHTML;
    }

    // Function to create and display the table for cattle
    function createTableForCattle() {
        const tableHTML = `@if (count($breedings) > 0)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs font-serif text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Heat Date</th>
                            <th scope="col" class="px-6 py-3">Breeding Date</th>
                            <th scope="col" class="px-6 py-3">Due Date</th>
                            <th scope="col" class="px-6 py-3">Age</th>
                            <th scope="col" class="px-6 py-3">Weight</th>
                            <th scope="col" class="px-6 py-3">Pregnancy Status</th>
                            <th scope="col" class="px-6 py-3">Number of Offspring</th>
                            <th scope="col" class="px-6 py-3">Animal type</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breedings as $breeding)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium font-serif text-gray-900 whitespace-nowrap dark:text-white">{{$breeding->heat_date ?: 'N/A'}}</th>
                                <td class="px-6 font-serif py-4">{{$breeding->breeding_date ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->due_date ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->age ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->weight ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->pregnancy_status ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->offspring_count ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->type ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">
                                    <a href="{{ route('breed.breedingedit', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium font-serif text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="{{ route('breeding.delete', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium text-red-600 font-serif dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $breedings->links() }}
            </div>
        @else
            <div id="animals" class="p-4 mx-8">
                <div class="content-wrapper font-serif dark:bg-gray-700 nothing mt-4 bg-gray-100 rounded-md p-4">
                    <div class="text-muted dark:text-gray-200 text-center text-4xl">
                        <i class="far fas fa-tag" aria-hidden="true"></i>
                    </div>
                    <div class="text-center font-serif dark:text-gray-200 text-gray-900 text-xl font-semibold mt-4">
                        No new notes yet?
                    </div>
                    <div class="text-center dark:text-gray-200 font-serif text-gray-600 mt-2">
                        Add a new notes and they'll show up here.
                    </div>
                </div>
            </div>
        @endif
        <p class="mb-4 text-gray-600 font-serif text-center dark:text-gray-400"> Displaying all <span class="text-red-500 font-serif">{{ count($breedings) }}</span> records</p>`;
        document.getElementById("tableContainer").innerHTML = tableHTML;
    }

    // Function to create and display the table for amphibians
    function createTableForAmphibians() {
        const tableHTML = `@if (count($breedings) > 0)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs font-serif text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Habitat</th>
                            <th scope="col" class="px-6 py-3">Temperature (in Celsius)</th>
                            <th scope="col" class="px-6 py-3">Humidity (%)</th>
                            <th scope="col" class="px-6 py-3">
Breeding Method</th>
                            <th scope="col" class="px-6 py-3">Age</th>
                            <th scope="col" class="px-6 py-3">Health Condition</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breedings as $breeding)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium font-serif text-gray-900 whitespace-nowrap dark:text-white">{{$breeding->habitat ?: 'N/A'}}</th>
                                <td class="px-6 font-serif py-4">{{$breeding->temp ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->humidity ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->genetic_details ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->age ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">{{$breeding->healthCondition ?: 'N/A'}}</td>
                                <td class="px-6 font-serif py-4">
                                    <a href="{{ route('breed.breedingedit', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium font-serif text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="{{ route('breeding.delete', ['animal_id' => $animal->id, 'breeding_id' => $breeding->id]) }}" class="font-medium text-red-600 font-serif dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $breedings->links() }}
            </div>
        @else
            <div id="animals" class="p-4 mx-8">
                <div class="content-wrapper font-serif dark:bg-gray-700 nothing mt-4 bg-gray-100 rounded-md p-4">
                    <div class="text-muted dark:text-gray-200 text-center text-4xl">
                        <i class="far fas fa-tag" aria-hidden="true"></i>
                    </div>
                    <div class="text-center font-serif dark:text-gray-200 text-gray-900 text-xl font-semibold mt-4">
                        No new notes yet?
                    </div>
                    <div class="text-center dark:text-gray-200 font-serif text-gray-600 mt-2">
                        Add a new notes and they'll show up here.
                    </div>
                </div>
            </div>
        @endif
        <p class="mb-4 text-gray-600 font-serif text-center dark:text-gray-400"> Displaying all <span class="text-red-500 font-serif">{{ count($breedings) }}</span> records</p>`;
        document.getElementById("tableContainer").innerHTML = tableHTML;
    }

    // Call the displayTable function to initially display the table
    displayTable();
</script>


{{--<livewire:calendar />--}}
