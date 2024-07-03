<x-app-layout title="Cards">
    <div class="container mx-auto mt-8 p-4 font-serif">
        @if($errors->hasBag('requiredFields'))
            <div class="alert alert-danger">
                <strong class="dark:text-gray-100">Oops! Some required fields are missing:</strong>
                <ul class="list-disc ml-5">
                    @foreach($errors->requiredFields->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container font-serif mx-auto mt-8 p-4 mb-4 bg-gray-100 dark:bg-gray-700 dark:rounded-lg rounded-lg shadow-lg">
        <div class="modal-header mb-4 flex justify-between items-center">
            <h3 class="text-2xl dark:text-gray-200 font-serif text-gray-800 font-semibold">New Health Info</h3>
        </div>
        <hr class="mt-2 mb-4">
        <form action="{{ route('animals.storehealth', ['animal_id' => $animal->id]) }}" method="POST">
            @csrf

        <div class="font-serif  flex flex-col">
            <label for="vaccination_status" class="dark:text-gray-200 font-medium mt-2  mb-2">Vaccination Status:</label>
            <select id="vaccination_status" name="vaccination_status" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">


                <option  value="not_vaccinated">Not Vaccinated</option>
                <option value="partially_vaccinated">Partially Vaccinated</option>
                <option value="fully_vaccinated">Fully Vaccinated</option>
            </select>
        </div>

<!-- Your HTML code -->
<div class="flex flex-col">
    <label for="vet_contact_id" class="dark:text-gray-200 font-medium mt-2 mb-2">Veterinarian:</label>
    <select id="vet_contact_id" name="vet_contact_id" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        <option value="">Select Veterinarian</option>
        @foreach($Contacts as $Contact)
            <option value="{{ $Contact->id }}">{{ $Contact->first_name }}{{$Contact->last_name}}</option>
        @endforeach

    </select>
</div>


        <div class="flex flex-col">
            <label for="medical_history" class="dark:text-gray-200 font-medium mt-2 mb-2">Medical History:</label>
            <textarea id="medical_history" name="medical_history" class="border-2 dark:text-gray-200  dark:bg-gray-800  border-gray-200 p-2 rounded-md"></textarea>
        </div>

        <div class="flex flex-col">
            <label for="dietary_restrictions" class="dark:text-gray-200 font-medium mt-2 mb-2">Dietary Restrictions:</label>
            <input type="text" id="dietary_restrictions" name="dietary_restrictions" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" id="neutered_spayed" name="neutered_spayed" class="form-checkbox mt-4 mb-4 h-5 w-5 text-blue-600">
            <label for="neutered_spayed" class="dark:text-gray-200 font-medium ">Neutered/Spayed:</label>
        </div>

        <div class="flex flex-col">
            <label for="regular_medication" class="dark:text-gray-200 font-medium  mt-2 mb-2">Regular Medication:</label>
            <input type="text" id="regular_medication" name="regular_medication" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex flex-col">
            <label for="last_vet_visit" class="dark:text-gray-200 font-medium  mt-2 mb-2">Last Vet Visit:</label>
            <input type="date" id="last_vet_visit" name="last_vet_visit" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex flex-col">
            <label for="insurance_details" class="dark:text-gray-200 font-medium mt-2 mb-2">Insurance Details:</label>
            <input type="text" id="insurance_details" name="insurance_details" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex flex-col">
            <label for="exercise_requirements" class="dark:text-gray-200 font-medium mt-2 mb-2">Exercise Requirements:</label>
            <input type="text" id="exercise_requirements" name="exercise_requirements" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex flex-col">
            <label for="parasite_prevention" class="dark:text-gray-200 font-medium mt-2 mb-2">Parasite Prevention:</label>
            <select id="parasite_prevention" name="parasite_prevention" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
                <option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>

        <hr class="mt-4 ">
        <div class="flex justify-end mt-6">
            <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"">

                <a href="{{ route('index') }}" class="btn btn-gray-500">Cancel</a>
            </button>
            <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                Save
            </button>


        </div>
    </form>
    </div>



</x-app-layout>
