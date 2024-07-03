

<form action="{{ route('breed.storebreeding', ['animal_id' => $animal->id]) }}" method="POST" id="breedingForm">
    @csrf

<div class="grid grid-cols-2 gap-4" >
<div class="mb-4">
    <label for="type " class="block text-sm dark:text-gray-200 font-medium text-gray-600">Animal type</label>
    <select name="type" id="type"  class="mt-1 p-2 border dark:text-gray-200 dark:bg-gray-800 rounded-md w-full">
        <option value="{{$animal->type}}">{{$animal->type}}</option>
    </select>
</div>
<div class="mb-4">
    <label for="type " class="block text-sm dark:text-gray-200 font-medium text-gray-600">Gender</label>
    <select name="type" id="type"  class="mt-1 p-2 border dark:text-gray-200 dark:bg-gray-800 rounded-md w-full">
        <option value="{{$animal->gender}}">{{$animal->gender}}</option>
    </select>
</div>
<div class="mb-4">
    <label for="health_status" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Health Status</label>
    <select name="health_status" id="health_status" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
        <option value="healthy">Healthy</option>
        <option value="sick">Sick</option>
        <option value="unknown">Unknown</option>
    </select>
</div>
<div class="mb-4">
    <label for="offspring_ids" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Offspring IDs</label>
    <input type="text" name="offspring_ids" id="offspring_ids" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full">
</div>
<!-- Heat Date -->
<div class="mb-4">
    <label for="breeding_history" class="block text-sm font-medium dark:text-gray-200 text-gray-600">Breeding_history</label>
    <textarea  name="breeding_history" id="breeding_history" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full"></textarea>
</div>

<!-- Breeding Date -->
<div class="mb-4">
    <label for="genetic_details" class="block text-sm dark:text-gray-200 font-medium text-gray-600">Genetic_details</label>
    <textarea name="genetic_details"  id="genetic_details" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full"></textarea>
</div>

<!-- Due Date -->


<!-- Number of Offspring -->
<div class="mb-4">
    <label for="breeding_recommendations" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Breeding_recommendations</label>
    <textarea  name="breeding_recommendations" id="breeding_recommendations" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full"></textarea>
</div>

<!-- Offspring IDs -->
<div class="mb-4">
    <label for="future_breeding_plans" class="block text-sm  dark:text-gray-200 font-medium text-gray-600">Future_breeding_plans</label>
    <textarea name="future_breeding_plans" id="future_breeding_plans" class="mt-1 dark:text-gray-200 dark:bg-gray-800 p-2 border rounded-md w-full"></textarea>
</div>

<hr class="mt-4  col-span-2">
<div class="flex col-span-2 justify-end mt-6">
    <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">

        <a href="{{ route('index') }}" class="btn btn-gray-500">Cancel</a>
    </button>
    <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
        Save
    </button>
</div>
</form>
</div>
