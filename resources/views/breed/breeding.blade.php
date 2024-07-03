
<x-app-layout title="breeding">
    <div class="container font-serif mx-auto mt-8 p-4 mb-8 bg-white dark:bg-gray-700 dark:rounded-lg dark:shadow-lg">
        <div class="md:flex md:items-center md:justify-between md:p-4 md:mb-4 md:rounded-lg p-2 mb-2 rounded-lg text-center">
            <h1 class="text-lg md:text-2xl dark:text-white font-semibold mb-2 md:mb-0 md:mr-4">Record <span class="text-blue-400 ">{{$animal->type}}</span> Breeding</h1>
            <span class="px-2 py-1 text-xs md:text-sm text-blue-400 bg-gray-600 rounded-full">{{$animal->internal_id}}</span>
        </div>


        <hr class="mb-4">
        @if(strtolower($animal->gender) === 'male')
        @include('breed.male')
@else
        <form action="{{ route('breed.storebreeding', ['animal_id' => $animal->id]) }}" method="POST" id="breedingForm">
            @csrf

            <!-- Animal Type -->
            <div class="mb-4">
                <label for="type " class="block text-sm dark:text-gray-200 font-medium text-gray-600">Animal</label>
                <select name="type" id="animalType" class="mt-1 p-2 border dark:text-gray-200 dark:bg-gray-800 rounded-md w-full " >
<option value="{{$animal->type}}">{{$animal->type}}</option>
                </select>
            </div>

            <!-- Common Breeding Fields -->
            <div class="mb-4">
                <label for="health_status" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Health Status</label>
                <select name="health_status" id="health_status" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
                    <option value="healthy">Healthy</option>
                    <option value="sick">Sick</option>
                    <option value="unknown">Unknown</option>
                </select>
            </div>

            <!-- Additional Fields Container -->
            <div id="additionalFieldsContainer" class="mb-4"></div>

            <!-- Common Breeding Fields -->


            <hr class="mt-4 col-span-2">
            <div class="flex col-span-2 justify-end mt-6">
                <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100 tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    <a href="{{ route('index') }}" class="btn btn-gray-500">Cancel</a>
                </button>
                <button type="submit" name="action" value="save" class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    Save
                </button>
            </div>

        </form>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Trigger the updateFormFields function on page load
            updateFormFields();
        });

        function updateFormFields() {
            var selectedAnimalType = document.getElementById("animalType").value;
            var additionalFieldsContainer = document.getElementById("additionalFieldsContainer");

            // Clear existing additional fields
            additionalFieldsContainer.innerHTML = "";

            // Create and append fields based on the selected animal type
            if (isPoultry(selectedAnimalType)) {
                additionalFieldsContainer.innerHTML += `
                <div class="grid grid-cols-2 gap-4">
  <!-- Hatching -->
  <div class="mb-4">
    <label for="mating_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hatching Date</label>
    <input
      type="date"
      name="hatching_date"
      id="mating_date"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
    />
  </div>

  <!-- Egg-laying Start Date -->
  <div class="mb-4">
    <label for="egg_laying_start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date of Egg-laying</label>
    <input
      type="date"
      name="egg_laying_start_date"
      id="egg_laying_start_date"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
    />
  </div>

  <!-- Egg-laying End Date -->
  <div class="mb-4">
    <label for="egg_laying_end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date of Egg-laying</label>
    <input
      type="date"
      name="egg_laying_end_date"
      id="egg_laying_end_date"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
    />
  </div>

  <!-- Number of Eggs -->
  <div class="mb-4">
    <label for="egg_count" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Eggs</label>
    <input
      type="number"
      name="no_eggs"
      id="egg_count"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter number of eggs"
    />
  </div>

  <!-- Temperature -->
  <div class="mb-4">
    <label for="temp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Temperature (°C)</label>
    <input
      type="number"
      name="temp"
      id="temp"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter temperature"
    />
  </div>

  <!-- Incubation Period -->
  <div class="mb-4">
    <label for="incubation_period" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Incubation Period (days)</label>
    <input
      type="number"
      name="period_day"
      id="incubation_period"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter incubation period"
    />
  </div>

  <!-- Humidity -->
  <div class="mb-4">
    <label for="humidity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Humidity (%)</label>
    <input
      type="number"
      name="humidity"
      id="humidity"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter humidity"
    />
  </div>

  <!-- Nesting Material -->
  <div class="mb-4">
    <label for="nesting_material" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nesting Material</label>
    <input
      type="text"
      name="nesting_material"
      id="nesting_material"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter nesting material"
    />
  </div>

  <!-- Light Conditions -->
  <div class="mb-4">
    <label for="light_condition" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Light Conditions</label>
    <select
      name="light_condition"
      id="light_condition"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
    >
      <option>Natural</option>
      <option>Artificial</option>
      <option>Both</option>
    </select>
  </div>

  <!-- Number of Chicks Hatched -->
  <div class="mb-4">
    <label for="number_of_chicks" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Eggs Hatched</label>
    <input
      type="number"
      name="number_of_chicks"
      id="number_of_chicks"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter number of chicks hatched"
    />
  </div>


  <!-- Number of Chicks -->
  <div class="mb-4">
    <label for="number_of_chicks" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Chicks</label>
    <input
      type="number"
      name="number_of_chicks"
      id="number_of_chicks"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter number of chicks"
    />
  </div>
  <!-- Environmental Conditions -->
  <div class="mb-4">
    <label for="environmental_conditions" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Environmental Conditions</label>
    <textarea
      name="environmental_conditions"
      id="environmental_conditions"
      class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
      placeholder="Enter environmental conditions"
    ></textarea>
  </div>

</div>
                `;
            } else if (isFish(selectedAnimalType)) {
                additionalFieldsContainer.innerHTML += `
                <div class="grid grid-cols-2 gap-4" >
                    <div class="mb-4">
                <label for="date_of_breeding" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Date of Breeding</label>
                <input type="date" name="date_of_breeding" id="date_of_breeding" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
                <div class="mb-4">
                <label for="temperature" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Water Temperature(°C)</label>
                <input type="number" name="temp" id="temp" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="water_ph" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Water pH{0-14}</label>
                <input type="number" name="water_ph" id="water_ph" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="tank_size" class="block text-sm font-medium dark:text-gray-200 text-gray-600">tank/pond size</label>
                <input type="number" name="tank_size" id="tank_size" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
    <label for="spawning_behavior" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Spawning Behavior</label>
    <select name="spawning_behavior" id="spawning_behavior" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
        <option value="broadcast_spawning">Broadcast Spawning</option>
        <option value="nest_building">Nest Building</option>
        <option value="mouthbrooding">Mouthbrooding</option>
        <option value="no_parental_care">No Parental Care</option>
        <option value="male_parental_care">Male Parental Care</option>
        <option value="female_parental_care">Female Parental Care</option>
        <option value="both_parents_care">Both Parents Provide Care</option>
        <option value="temperature">Temperature</option>
        <option value="photoperiod">Photoperiod (Day Length)</option>
        <option value="water_flow">Water Flow</option>
    </select>
</div>
<div class="mb-4">
    <label for="breeding_fish" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Number of Breeding Fish:</label>
    <input type="number" id="breeding_fish" name="no_eggs" min="0" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
</div>
<div class="mb-4">
    <label for="breeding_fish_size" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Breeding Fish Size{cm}:</label>
    <input type="text" id="breeding_fish_size" name="tankSize" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
</div>

<div class="mb-4">
    <label for="breeding_fish_color" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Breeding Fish Color:</label>
    <select id="breeding_fish_color" name="color" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
        <option value="red">Red</option>
        <option value="orange">Orange</option>
        <option value="yellow">Yellow</option>
        <option value="green">Green</option>
        <option value="blue">Blue</option>
        <option value="purple">Purple</option>
        <option value="white">White</option>
        <option value="black">Black</option>
        <option value="brown">Brown</option>
        <option value="silver">Silver</option>
        <!-- Add more color options as needed -->
    </select>
</div>

<div class="mb-4">
    <label for="spawning_substrate" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Spawning Substrate</label>
    <select name="spawning_substrate" id="spawning_substrate" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
        <option value="gravel">Gravel</option>
        <option value="sand">Sand</option>
        <option value="rocks">Rocks</option>
        <option value="vegetation">Vegetation</option>
        <option value="moss">Moss</option>
        <option value="clay">Clay</option>
        <option value="branches">Branches</option>
        <option value="logs">Logs</option>
        <option value="leaves">Leaves</option>
        <option value="shells">Shells</option>
    </select>
</div>

<div class="mb-4">
    <label for="fry_feeding" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Fry Feeding</label>
    <select name="fry_feeding" id="fry_feeding" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
        <option value="live_food">Live Food</option>
        <option value="microparticles">Microparticles</option>
        <option value="brine_shrimp">Brine Shrimp</option>
        <option value="algae">Algae</option>
        <option value="pelleted_food">Pelleted Food</option>
        <option value="flakes">Flakes</option>
        <option value="mosquito_larvae">Mosquito Larvae</option>
        <option value="daphnia">Daphnia</option>
        <option value="infusoria">Infusoria</option>
        <option value="rotifers">Rotifers</option>
        <option value="bloodworms">Bloodworms</option>
        <option value="cyclops">Cyclops</option>
        <option value="fruit_flies">Fruit Flies</option>
        <option value="moina">Moina</option>
        <option value="tubifex_worms">Tubifex Worms</option>
        <option value="grindal_worms">Grindal Worms</option>
        <option value="white_worms">White Worms</option>
        <option value="micro_worms">Micro Worms</option>
        <option value="krill">Krill</option>
        <option value="arthemis">Arthemis</option>
        <!-- Add more fry feeding options as needed -->
    </select>
</div>

            <div class="mb-4">
                <label for="fry_tank_setup" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Fry Tank Setup</label>
                <input type="text" name="fry_tank_setup" id="fry_tank_setup" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
    <label for="water_quality_monitoring" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Water Quality Monitoring</label>
    <select name="water_quality_monitoring" id="water_quality_monitoring" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
        <option value="pH_levels">pH Levels</option>
        <option value="temperature">Temperature</option>
        <option value="dissolved_oxygen">Dissolved Oxygen</option>
        <option value="ammonia_levels">Ammonia Levels</option>
        <option value="nitrate_levels">Nitrate Levels</option>
        <option value="nitrite_levels">Nitrite Levels</option>
        <option value="phosphate_levels">Phosphate Levels</option>
        <option value="turbidity">Turbidity</option>
        <option value="conductivity">Conductivity</option>
        <option value="total_dissolved_solids">Total Dissolved Solids</option>
        <option value="bioindicators">Bioindicators</option>
        <!-- Add more water quality monitoring options as needed -->
    </select>
</div>

            </div>
                `;

            } else if (isInsect(selectedAnimalType)) {
                additionalFieldsContainer.innerHTML += `
                <div class="grid grid-cols-2 gap-4" >
                    <div class="mb-4">
        <label for="enclosure_type" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Type of Enclosure</label>
        <input type="text" name="enclosure_type" id="enclosure_type" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
    </div>
            <div class="mb-4">
                <label for="temperature" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Temperature (°C)</label>
                <input type="number" name="temp" id="heat_date" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="humidity" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Humidity (%)</label>
                <input type="number" name="humidity" id="humidity" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="light_condition" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Light Conditions</label>
                <input type="text" name="light_condition" id="heat_date" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="egg_stage" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Duration of Egg Stage</label>
                <input type="number" name="egg_stage" id="egg_stage" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="pupal_stage" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Duration of Pupal Stage</label>
                <input type="number" name="pupal_stage" id="pupal_stage" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="adult_stage" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Duration of Adult Stage</label>
                <input type="number" name="adult_stage" id="adult_stage" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="nesting_material" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Monitoring Tools Used</label>
                <input type="text" name="nesting_material" id="nesting_material" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="environmental_conditions" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Diet and Feeding Schedule</label>
                <textarea name="environmental_conditions" id="environmental_conditions" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full"></textarea>
            </div>
            </div>
                `;
            } else if (isCattle(selectedAnimalType)) {
                // Additional Fields for Cattle
                additionalFieldsContainer.innerHTML += `
                <div class="grid grid-cols-2 gap-4" >
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
            <div class="mb-4">
                <label for="age" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Age</label>
                <input type="number" name="age" id="age" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>
            <div class="mb-4">
                <label for="height" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Height</label>
                <input type="number" name="height" id="height" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>

            <div>
                <label for="color" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Color</label>
                <input type="text" name="color" id="color"
                class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="weight" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Weight</label>
                <input type="number" name="weight" id="weight" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
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
            </div>

                `;

            } else if (isAmphibians(selectedAnimalType)) {
                additionalFieldsContainer.innerHTML += `
                <div class="grid grid-cols-2 gap-4 dark:text-gray-300" >
    <div>
        <label for="species" class="block text-sm font-medium">Species</label>
        <input type="text" name="species" id="species"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>
    <div>
        <label for="habitat" class="block text-sm font-medium">Habitat</label>
        <select name="habitat" id="habitat" class="mt-1 dark:text-gray-200 focus:ring-indigo-500 dark:bg-gray-800 p-2 border  dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 rounded-md w-full">
            <option value="forest">Forest</option>
        <option value="desert">Desert</option>
        <option value="wetland">Wetland</option>
        <option value="aquatic">Aquatic</option>
        <option value="grassland">Grassland</option>
        <option value="urban">Urban</option>
        <option value="other">Other</option>
                </select>
    </div>
    <div>
        <label for="temperature" class="block text-sm font-medium">Temperature (in Celsius)</label>
        <input type="number" name="temp" id="temperature"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>
    <div>
        <label for="humidity" class="block text-sm font-medium">Humidity (%)</label>
        <input type="number" name="humidity" id="humidity"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>
    <div>
        <label for="tankSize" class="block text-sm font-medium">Tank Size (in liters)</label>
        <input type="number" name="tankSize" id="tankSize"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>
    <div>
        <label for="feedingSchedule" class="block text-sm font-medium">Feeding Schedule</label>
        <input type="text" name="feedingSchedule" id="feedingSchedule"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>
    <div>
        <label for="healthCondition" class="block text-sm font-medium">Health Condition</label>
        <input type="text" name="healthCondition" id="healthCondition"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>
    <div>
        <label for="age" class="block text-sm font-medium">Age</label>
        <input type="text" name="age" id="age"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>
    <div>
        <label for="incubationTemperature" class="block text-sm font-medium">Incubation Temperature</label>
        <input type="number" name="temp" id="incubationTemperature"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
    </div>

<div class="mb-4">
                <label for="genetic_details" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Breeding Method</label>
                <select name="genetic_details" id="genetic_details" class="mt-1 dark:text-gray-200 focus:ring-indigo-500 dark:bg-gray-800 p-2 border  dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 rounded-md w-full">
                    <option value="natural">Natural Breeding</option>
        <option value="artificial_insemination">Artificial Insemination</option>
        <option value="incubation">Incubation</option>
        <option value="other">Other</option>
                </select>
            </div>
    <div>
        <label for="remarks" class="block dark:text-gray-200 text-sm font-medium">Remarks</label>
        <textarea name="remarks" id="remarks" rows="3"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"></textarea>
    </div>
</div>
                `;
            }


        }


        function isPoultry(animalType) {
            const poultryTypes = ["Chicken", "Duck", "Goose", "Ostrich", "Partridge", "Guineafowl",  "Peafowl", "Pheasant", "Pigeon", "Quail", "Turkey","Hen","Cock"];
            return poultryTypes.includes(animalType);
        }

        function isFish(animalType) {
            const fishTypes = ["Shrimp", "Crab", "Lobster", "Mollusk","Salmon", "Trout","Fish", "Catfish","Tilapia"];
            return fishTypes.includes(animalType);
        }
        function isInsect(animalType) {
    const insectTypes = ["Bees", "Butterflies", "Crickets", "Mealworms", "Silkworms", "Waxworms"];
    return insectTypes.includes(animalType);
}

        function isCattle(animalType) {
            const cattleTypes = [ "Bison", "Buffalo", "Camel",
            "Cattle", "Deer",  "Donkey","Gayal", "Goat",   "Muskox",
            "Rabbit", "Reindeer", "Rhea", "Horse", "Donkey", "Mule","Dog","Cat",
            "Alpaca", "Llama", "Emu","Elk",
            "Pig","Swine",
            "Cow","Bull", "Sheep", "Water buffalo", "Yak"];
            return cattleTypes.includes(animalType);
        }


        function isAmphibians(animalType) {
            const cattleTypes = ["Frog", "Toad",
            "Turtle", "Snake", "Lizard"
        ];
            return cattleTypes.includes(animalType);
        }

        // Add more functions for other animal types as needed
    </script>

<div id="routes"
    data-poultry-route=""
    data-fish-route="{{ route('breed.display', ['animal_id' => $animal->id]) }}"
    data-insect-route="{{ route('breed.showinsect', ['animal_id' => $animal->id]) }}"
    data-cattle-route="{{ route('breed.showbreeding', ['animal_id' => $animal->id]) }}"
    data-equine-route=""
    data-default-route="{{ route('breed.showbreeding', ['animal_id' => $animal->id]) }}">
</div>

<script>
    function saveAnimalType() {
        var selectedAnimalType = document.getElementById("animalType").value;
        var routes = document.getElementById("routes");

        // Access the data attributes to get the routes
        var poultryRoute = routes.getAttribute('data-poultry-route');
        var fishRoute = routes.getAttribute('data-fish-route');
        var insectRoute = routes.getAttribute('data-insect-route');
        var cattleRoute = routes.getAttribute('data-cattle-route');
        var equineRoute = routes.getAttribute('data-equine-route');
        var defaultRoute = routes.getAttribute('data-default-route');

        // Check if the selected animal type is insect or cattle
        if (isInsect(selectedAnimalType)) {
            window.location.href = insectRoute; // Redirect to the insect page
        } else if (isCattle(selectedAnimalType)) {
            window.location.href = cattleRoute; // Redirect to the cattle page
        } else {
            // If it's not insect or cattle, proceed with other types
            switch (selectedAnimalType) {
                case "Poultry":
                    window.location.href = poultryRoute; // Redirect to the poultry page
                    break;
                case "Fish":
                    window.location.href = fishRoute; // Redirect to the fish page
                    break;
                case "Equine":
                    window.location.href = equineRoute; // Redirect to the equine page
                    break;
                default:
                    // Redirect to a default page if the selected animal type doesn't match any case
                    window.location.href = defaultRoute;
                    break;
            }
        }
    }

    function isInsect(animalType) {
        const insectTypes = ["Bees", "Butterflies", "Crickets", "Mealworms", "Silkworms", "Waxworms"];
        return insectTypes.includes(animalType);
    }

    function isCattle(animalType) {
        const cattleTypes = ["Bison", "Buffalo", "Camel", "Cattle", "Deer", "Donkey", "Gayal", "Goat", "Muskox", "Rabbit", "Reindeer", "Rhea", "Cow", "Bull", "Sheep", "Water buffalo", "Yak"];
        return cattleTypes.includes(animalType);
    }
</script>



</x-app-layout>
