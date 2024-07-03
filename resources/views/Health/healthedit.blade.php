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
        <form action="{{ route('health.update', ['animal_id' => $animal->id, 'health_id' => $health->id]) }}" method="POST">
            @csrf <!-- Add CSRF token -->
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="font-serif  flex flex-col">
            <label for="vaccination_status" class="dark:text-gray-200 font-medium mt-2  mb-2">Vaccination Status:</label>
            <select id="vaccination_status" name="vaccination_status" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
                value="{{$health->vaccination_status}}"
                <option  value="not_vaccinated">Not Vaccinated</option>
                <option value="partially_vaccinated">Partially Vaccinated</option>
                <option value="fully_vaccinated">Fully Vaccinated</option>
            </select>
        </div>


        <div class="flex flex-col">
            <label for="vaccine_name" class="dark:text-gray-200 font-medium mt-2 mb-2">Vaccine Name:<span class="text-red-800">*</span></label>
            <input type="text" value="{{$health->vaccine_name}}" id="vaccine_name" name="vaccine_name" class="border-2 dark:text-gray-200 dark:bg-gray-800 border-gray-200 p-2 rounded-md" required>
        </div>

        <div class="flex flex-col">
            <label for="date_administered" class="dark:text-gray-200 font-medium mt-2 mb-2">Date Administered:<span class="text-red-800">*</span></label>
            <input type="date" id="date_administered" value="{{$health->date_administered}}" name="date_administered" class="border-2 dark:text-gray-200 dark:bg-gray-800 border-gray-200 p-2 rounded-md" required>
        </div>

        <div class="flex flex-col">
            <label for="dosage" class="dark:text-gray-200 font-medium mt-2 mb-2">Dosage:</label>
            <div class="flex items-center">
                <input type="text" value="{{$health->dosage}}" id="dosage" name="dosage" class="border-2 dark:text-gray-200 dark:bg-gray-800 border-gray-200 w-full p-2 rounded-md mr-2">
                <select id="dosage_unit" name="dosage_unit" class="border-2 dark:text-gray-200 dark:bg-gray-800 border-gray-200 w-full p-2 rounded-md">
                    value="{{$health->dosage_unit}}"
                    <option value="mg">mg</option>
                    <option value="g">g</option>
                    <option value="ml">ml</option>
                    <!-- Add more units as needed -->
                </select>
            </div>
        </div>


        <div class="flex flex-col">
            <label for="administered_by" class="dark:text-gray-200 font-medium mt-2 mb-2">Administered by (vet or self):<span class="text-red-800">*</span></label>
            <input type="text" value="{{$health->administered_by}}" id="administered_by" name="administered_by" class="border-2 dark:text-gray-200 dark:bg-gray-800 border-gray-200 p-2 rounded-md" required>
        </div>



        <div class="flex flex-col">
            <label for="dietary_restrictions" class="dark:text-gray-200 font-medium mt-2 mb-2">Dietary Restrictions:</label>
            <input type="text" id="dietary_restrictions" value="{{$health->dietary_restrictions}}" name="dietary_restrictions" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" id="neutered_spayed" name="neutered_spayed" class="form-checkbox mt-4 mb-4 h-5 w-5 text-blue-600">
            <label for="neutered_spayed" value="{{$health->neutered_spayed}}" class="dark:text-gray-200 font-medium ">Neutered/Spayed:</label>
        </div>

        <div class="flex flex-col">
            <label for="regular_medication" class="dark:text-gray-200 font-medium  mt-2 mb-2">Regular Medication:</label>
            <input type="text" id="regular_medication" value="{{$health->regular_medication}}" name="regular_medication" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex flex-col">
            <label for="last_vet_visit" class="dark:text-gray-200 font-medium  mt-2 mb-2">Last Vet Visit:<span class="text-red-800">*</span></label>
            <input type="date" id="last_vet_visit" value="{{$health->last_vet_visit}}" name="last_vet_visit" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md" required>
        </div>

        <div class="flex flex-col">
            <label for="insurance_details" class="dark:text-gray-200 font-medium mt-2 mb-2">Insurance Details:</label>
            <input type="text" id="insurance_details" value="{{$health->insurance_details}}" name="insurance_details" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
        </div>

        <div class="flex flex-col">
            <label for="exercise_requirements" class="dark:text-gray-200 font-medium mt-2 mb-2">Exercise Requirements:</label>
            <select id="exercise_requirements" name="exercise_requirements" class="border-2 dark:text-gray-200 dark:bg-gray-800 border-gray-200 p-2 rounded-md">
                value="{{$health->exercise_requirements}}"
                <option value="low">Low</option>
                <option value="moderate">Moderate</option>
                <option value="high">High</option>
            </select>
        </div>

        <div class="flex flex-col">
            <label for="medical_history" class="dark:text-gray-200 font-medium mt-2 mb-2">Medical History:</label>
            <textarea id="medical_history" name="medical_history" value="{{$health->medical_history}}" class="border-2 dark:text-gray-200  dark:bg-gray-800  border-gray-200 p-2 rounded-md"></textarea>
        </div>

        <div class="flex flex-col">
            <label for="parasite_prevention" class="dark:text-gray-200 font-medium mt-2 mb-2">Parasite Prevention:</label>
            <select id="parasite_prevention" value="{{$health->parasite_prevention}}" name="parasite_prevention" class="border-2 dark:text-gray-200  dark:bg-gray-800 border-gray-200 p-2 rounded-md">
                <option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>

      <hr class="mt-4  col-span-2">
                                <div class="flex col-span-2 justify-end mt-6">
                                    <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">

                                        <a href="{{route('animals.showhealth',['animal_id' => $animal->id])}}" class="btn btn-gray-500">Cancel</a>
                                    </button>
                                    <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                        Save
                                    </button>
                                </div>
    </form>
    </div>



</x-app-layout>
