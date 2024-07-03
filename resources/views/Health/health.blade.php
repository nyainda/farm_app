<x-app-layout title="Animal Health Information">
    <div class="container mx-auto mt-8 p-4 font-serif">
        @if($errors->hasBag('requiredFields'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Oops! Some required fields are missing:</p>
                <ul class="mt-2 ml-5 list-disc">
                    @foreach($errors->requiredFields->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="container mx-auto font-serif  p-4 mb-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="modal-header mb-4 flex justify-between items-center">
            <h3 class="text-2xl dark:text-gray-200 font-serif text-gray-800 font-semibold">New Health Information</h3>
        </div>
        <hr class="mt-2 mb-4">
        <form action="{{ route('Health.storehealth', ['animal_id' => $animal->id]) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="font-serif flex flex-col">
                    <label for="vaccination_status" class="dark:text-gray-200 font-medium mt-2 mb-2">Vaccination Status:</label>
                    <select id="vaccination_status" name="vaccination_status" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md">
                        <option value="not_vaccinated">Not Vaccinated</option>
                        <option value="partially_vaccinated">Partially Vaccinated</option>
                        <option value="fully_vaccinated">Fully Vaccinated</option>
                    </select>
                </div>

                <div x-data="{ veterinarians: {{ json_encode($Contacts) }} }" class="md:col-span-2">
                    <div class="flex flex-col">
                        <label for="vet_contact_id" class="dark:text-gray-200 font-medium mt-2 mb-2">Veterinarian:</label>
                        <select x-model="selectedVet" name="vet_contact_id" id="vet_contact_id" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md">
                            <option value="">Select Veterinarian</option>
                            @foreach($Contacts as $Contact)
                                <option value="{{ $Contact->id }}">{{ $Contact->first_name }} {{ $Contact->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="selectedVet === 'register_vet'" class="mt-2">
                        <p class="text-gray-500 dark:text-gray-200">
                            If you don't see your veterinarian in the list, you can <a href="{{ route('Contacts.contact', ['animal_id' => $animal->id]) }}" class="text-blue-500 underline">register a new vet</a>.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="vaccine_name" class="dark:text-gray-200 font-serif font-medium mt-2 mb-2">Vaccine Name:<span class="text-red-500">*</span></label>
                    <input type="text" id="vaccine_name" name="vaccine_name" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md" required>
                </div>

                <div class="flex flex-col">
                    <label for="date_administered" class="dark:text-gray-200 font-medium mt-2 mb-2">Date Administered:<span class="text-red-500">*</span></label>
                    <input type="date" id="date_administered" name="date_administered" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md" required>
                </div>

                <div class="flex flex-col">
                    <label for="dosage" class="dark:text-gray-200 font-medium mt-2 mb-2">Dosage:</label>
                    <div class="flex items-center">
                        <input type="text" id="dosage" name="dosage" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 w-full p-2 rounded-md mr-2">
                        <select id="dosage_unit" name="dosage_unit" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 w-full p-2 rounded-md">
                            <option value="mg">mg</option>
                            <option value="g">g</option>
                            <option value="ml">ml</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="administered_by" class="dark:text-gray-200 font-medium mt-2 mb-2">Administered by (vet or self):<span class="text-red-500">*</span></label>
                    <input type="text" id="administered_by" name="administered_by" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md" required>
                </div>

                <div class="flex flex-col">
                    <label for="dietary_restrictions" class="dark:text-gray-200 font-medium mt-2 mb-2">Amount Cost:</label>
                    <input type="text" id="dietary_restrictions" name="dietary_restrictions" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md" placeholder="$">
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="neutered_spayed" name="neutered_spayed" class="form-checkbox mt-4 mb-4 h-5 w-5 text-blue-600">
                    <label for="neutered_spayed" class="dark:text-gray-200 font-medium">Neutered/Spayed:</label>
                </div>

                <div class="flex flex-col">
                    <label for="regular_medication" class="dark:text-gray-200 font-medium mt-2 mb-2">Regular Medication:</label>
                    <input type="text" id="regular_medication" name="regular_medication" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md">
                </div>

                <div class="flex flex-col">
                    <label for="last_vet_visit" class="dark:text-gray-200 font-medium mt-2 mb-2">Last Vet Visit:<span class="text-red-500">*</span></label>
                    <input type="date" id="last_vet_visit" name="last_vet_visit" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md" required>
                </div>

                <div class="flex flex-col">
                    <label for="insurance_details" class="dark:text-gray-200 font-medium mt-2 mb-2">Insurance Details:</label>
                    <select id="insurance_details" name="insurance_details" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md">
                        <option value="basic">Basic Insurance</option>
                        <option value="premium">Premium Insurance</option>
                        <option value="comprehensive">Comprehensive Insurance</option>
                        <option value="accident_only">Accident Only Insurance</option>
                        <option value="lifetime_coverage">Lifetime Coverage Insurance</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="exercise_requirements" class="dark:text-gray-200 font-medium mt-2 mb-2">Exercise Requirements:</label>
                    <select id="exercise_requirements" name="exercise_requirements" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md">
                        <option value="low">Low</option>
                        <option value="moderate">Moderate</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="flex flex-col col-span-3">
                    <label for="medical_history" class="dark:text-gray-200 font-medium mt-2 mb-2">Medical History:</label>
                    <textarea id="medical_history" name="medical_history" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md"></textarea>
                </div>

                <div class="flex flex-col">
                    <label for="parasite_prevention" class="dark:text-gray-200 font-medium mt-2 mb-2">Parasite Prevention:</label>
                    <select id="parasite_prevention" name="parasite_prevention" class="border dark:border-gray-600 dark:text-gray-200 dark:bg-gray-700 border-gray-200 p-2 rounded-md">
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>

                <hr class="mt-4 col-span-3">
                <div class="flex col-span-3 justify-end mt-6">
                    <button type="button" class="px-4 py-2 text-sm mr-4 mb-4 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                        <a href="{{ route('index') }}">Cancel</a>
                    </button>
                    <button type="submit" name="action" value="save" class="px-4 py-2 text-sm mr-4 mb-4 text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
 </x-app-layout>
