<x-app-layout title="Cards">


    <div class="container mx-auto mt-8 p-4 font-serif dark:bg-gray-700 dark:shadow-md">
        <form action="{{ route('AnimalContent.update', $animal->id) }}" method="POST" class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md">
            @csrf <!-- Add CSRF token -->
            @method('PUT')
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <fieldset>
                <legend class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">Basic Information</legend>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Identification -->
                    <div class="flex flex-col">
                        <label for="name" class="dark:text-gray-200 text-gray-700">Identification</label>
                        <input type="text" name="name" id="name" value="{{$animal -> name}}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>



                    <!-- Species -->
                    <div class="relative">
                        <label for="animal_type" class="text-gray-700 dark:text-gray-200">Species</label>
                        <div class="relative">
                            <label for="animal_name" class="dark:text-gray-200 text-gray-700"></label>
                            <input type="text" name="type" id="animal_type" value="{{$animal ->type }}" value="" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 w-full dark:text-gray-200 dark:bg-gray-700"
                                onclick="toggleAnimalDropdown()">
                            <div id="animalDropdown" class="absolute mt-2 bg-white dark:bg-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg w-full max-h-32 overflow-y-auto" style="display: none;">
                                <ul class="divide-y divide-gray-200" id="animal_list">
                                    <!-- JavaScript will populate the list of animals here -->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Breed -->
                    <div class="flex flex-col">
                        <label for="animal_breed" class="text-gray-700 dark:text-gray-200">Breed</label>
                        <input type="text" name="breed" id="animal_breed" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700" value="{{ $animal->breed }}">
                    </div>


                    <!-- Gender -->
                    <div class="flex flex-col">
                        <label for="animal_gender" class="text-gray-700 dark:text-gray-200">Gender</label>
                        <select name="gender" id="animal_gender" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            <option value="" {{ $animal->gender == '' ? 'selected' : '' }} label=" "></option>
                            <option value="Male" {{ $animal->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $animal->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>


                    <!-- Labels/Keywords -->
                    <div class="flex flex-col">
                        <label for="animal_keywords" class="text-gray-700 dark:text-gray-200">Labels/Keywords</label>
                        <input type="text" name="keywords" id="animal_keywords" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700" value="{{ $animal->keywords }}" placeholder="Calf, Steer, Dairy, Stud, Fiber, Broiler, etc">
                    </div>

                    <!-- Reference Number -->
                    <div class="flex flex-col">
                        <label for="animal_internal_id" class="text-gray-700 dark:text-gray-200">Reference Number</label>
                        <input type="text" name="internal_id" id="animal_internal_id" value="{{ $animal->internal_id }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700" placeholder="Example: A001" disabled>
                    </div>

                    <!-- Status -->
                    <div class="flex flex-col">
                        <label for="animal_status" class="text-gray-700 font-serif dark:text-gray-200">Status</label>
                        <select name="status" id="animal_status" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            <option value="Active" {{ $animal->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Butchered" {{ $animal->status == 'Butchered' ? 'selected' : '' }}>Butchered</option>
                            <option value="Culled" {{ $animal->status == 'Culled' ? 'selected' : '' }}>Culled</option>
                            <option value="Deceased" {{ $animal->status == 'Deceased' ? 'selected' : '' }}>Deceased</option>
                            <option value="Dry" {{ $animal->status == 'Dry' ? 'selected' : '' }}>Dry</option>
                            <option value="Finishing" {{ $animal->status == 'Finishing' ? 'selected' : '' }}>Finishing</option>
                            <option value="For Sale" {{ $animal->status == 'For Sale' ? 'selected' : '' }}>For Sale</option>
                            <option value="Lactating" {{ $animal->status == 'Lactating' ? 'selected' : '' }}>Lactating</option>
                            <option value="Lost" {{ $animal->status == 'Lost' ? 'selected' : '' }}>Lost</option>
                            <option value="Off Farm" {{ $animal->status == 'Off Farm' ? 'selected' : '' }}>Off Farm</option>
                            <option value="Quarantined" {{ $animal->status == 'Quarantined' ? 'selected' : '' }}>Quarantined</option>
                            <option value="Reference" {{ $animal->status == 'Reference' ? 'selected' : '' }}>Reference</option>
                            <option value="Sick" {{ $animal->status == 'Sick' ? 'selected' : '' }}>Sick</option>
                            <option value="Sold" {{ $animal->status == 'Sold' ? 'selected' : '' }}>Sold</option>
                            <option value="Weaning" {{ $animal->status == 'Weaning' ? 'selected' : '' }}>Weaning</option>
                            <option value="Archived" {{ $animal->status == 'Archived' ? 'selected' : '' }}>Archived</option>
                            <!-- ... (other options) ... -->
                        </select>
                    </div>


                    <!-- Date Deceased -->
                    <div id="dateDeceasedSection" class="mt-6" style="display: none;">
                        <div class="flex flex-col">
                            <label for="animal_death_date" class="text-gray-700 dark:text-gray-200">Date Deceased</label>
                            <input type="date" value="{{$animal->death_date}}" name="death_date" id="animal_death_date" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:bg-gray-800">
                        </div>

                        <div class="mt-4">
                            <label for="animal_deceased_reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deceased Reason</label>
                            <textarea rows="4" value="{{$animal->deceased_reason}}" name="deceased_reason" id="animal_deceased_reason" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the reason for deceased..."></textarea>
                        </div>
                    </div>
            </fieldset>
        </div>
            <div class="container mx-auto mt-8 p-4 font-serif  bg-white shadow-md dark:bg-gray-700 dark:shadow-md">

                    <fieldset>
                        <legend class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">Physical Characteristics</legend>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Identification -->
                            <div class="flex flex-col">
                                <label for="animal_is_neutered" class="dark:text-gray-200 text-gray-700">Neutered</label>
                                <div class="checkbox">
                                    <label class="inline-flex items-center">
                                        <input type="hidden" name="is_neutered" value="0"> <!-- Hidden input for unchecked value -->
                                        <input type="checkbox" name="is_neutered" id="animal_is_neutered" value="1" {{ $animal->is_neutered ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-gray-600 border-gray-300 rounded">
                                        <span class="ml-2 dark:text-gray-200">Neutered</span>
                                    </label>
                                </div>
                            </div>


                            <!-- Is Breeding Stock -->
                            <div class="flex flex-col">
                                <label for="animal_is_breeding_stock" class="dark:text-gray-200 text-gray-700">Is Breeding Stock</label>
                                <div class="checkbox">
                                    <label class="inline-flex items-center">
                                        <input type="hidden" name="is_breeding_stock" value="0"> <!-- Hidden input for unchecked value -->
                                        <input type="checkbox" name="is_breeding_stock" id="animal_is_breeding_stock" value="1" {{ $animal->is_breeding_stock ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-gray-600 border-gray-300 rounded">
                                        <span class="ml-2 dark:text-gray-200">Is Breeding Stock</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="grid grid-cols-1 mt-4 md:grid-cols-2 gap-6">
                            <!-- Coloring -->
                            <div class="flex flex-col">
                                <label for="animal_coloring" class="dark:text-gray-200 text-gray-700">Coloring</label>
                                <input type="text"  placeholder="Brown, white, Black, etc" value="{{$animal ->coloring}}" name="coloring" id="animal_coloring" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Retention Score -->
                            <div class="flex flex-col">
                                <label for="animal_retention_score" class="dark:text-gray-200 text-gray-700">Retention Score</label>
                                <input class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700" step="1" min="0" max="10" value="{{$animal ->retention_score}}" type="number" name="retention_score" id="animal_retention_score">
                            </div>
                        </div>



                        <!-- Additional Physical Characteristics -->
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Weight -->
                            <div class="flex flex-col">
                                <label for="animal_weight" class="dark:text-gray-200 text-gray-700">Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" value="{{$animal ->weight}}"  id="animal_weight" placeholder="Enter weight in kg" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Height -->
                            <div class="flex flex-col">
                                <label for="animal_height" class="dark:text-gray-200 text-gray-700">Height (cm)</label>
                                <input type="number" step="0.01" name="height" value="{{$animal ->height}}"  id="animal_height" placeholder="Enter height in cm" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Body Condition Score -->
                            <div class="flex flex-col">
                                <label for="animal_body_condition_score" class="dark:text-gray-200 text-gray-700">Body Condition Score</label>
                                <input type="number" step="0.1" name="body_condition_score" value="{{$animal ->body_condition_score}}"  id="animal_body_condition_score" placeholder="Enter body condition score" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Horn/Tusk Length -->
                            <div class="flex flex-col">
                                <label for="animal_horn_length" class="dark:text-gray-200 text-gray-700">Horn/Tusk Length (cm)</label>
                                <input type="number" step="0.01" name="horn_length" value="{{$animal ->horn_length}}"  id="animal_horn_length" placeholder="Enter horn/tusk length in cm" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Tail Length/Shape -->
                            <div class="flex flex-col">
                                <label for="animal_tail" class="dark:text-gray-200 text-gray-700">Tail Length/Shape</label>
                                <input type="text" name="tail_length_shape" value="{{$animal ->tail_length_shape}}" id="animal_tail" placeholder="Describe tail length/shape" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Fur/Feather/Scale Type -->
                            <div class="flex flex-col">
                                <label for="animal_fur_type" class="dark:text-gray-200 text-gray-700">Fur/Feather/Scale Type</label>
                                <input type="text" name="fur_feather_scale_type" value="{{$animal ->fur_feather_scale_type}}"  id="animal_fur_type" placeholder="Describe fur/feather/scale type" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Eye Color -->
                            <div class="flex flex-col">
                                <label for="animal_eye_color" class="dark:text-gray-200 text-gray-700">Eye Color</label>
                                <input type="text" name="eye_color" value="{{$animal ->eye_color}}" id="animal_eye_color" placeholder="Enter eye color" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Beak Shape (for birds) -->
                            <div class="flex flex-col">
                                <label for="animal_beak_shape" class="dark:text-gray-200 text-gray-700">Beak Shape (for birds)</label>
                                <input type="text" name="beak_shape" value="{{$animal ->beak_shape}}" id="animal_beak_shape" placeholder="Describe beak shape" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Tail Feather Pattern (for birds) -->
                            <div class="flex flex-col">
                                <label for="animal_tail_feather_pattern" class="dark:text-gray-200 text-gray-700">Tail Feather Pattern (for birds)</label>
                                <input type="text" name="tail_feather_pattern" value="{{$animal ->tail_feather_pattern}}" id="animal_tail_feather_pattern" placeholder="Describe tail feather pattern" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Saddle/Markings -->
                            <div class="flex flex-col">
                                <label for="animal_saddle_markings" class="dark:text-gray-200 text-gray-700">Saddle/Markings</label>
                                <input type="text" name="saddle_markings" value="{{$animal ->saddle_markings}}" id="animal_saddle_markings" placeholder="Describe saddle/markings" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Hoof Type (for livestock) -->
                            <div class="flex flex-col">
                                <label for="animal_hoof_type" class="dark:text-gray-200 text-gray-700">Hoof Type (for livestock)</label>
                                <input type="text" name="hoof_type" id="animal_hoof_type" value="{{$animal ->hoof_type}}" placeholder="Describe hoof type" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>

                            <!-- Gait or Movement -->
                            <div class="flex flex-col">
                                <label for="animal_gait" class="dark:text-gray-200 text-gray-700">Gait or Movement</label>
                                <input type="text" name="gait_or_movement" value="{{$animal ->gait_or_movement}}" id="animal_gait" placeholder="Describe gait or movement" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Teeth Characteristics -->
                            <div class="flex flex-col">
                                <label for="animal_teeth_characteristics" class="dark:text-gray-200 text-gray-700">Teeth Characteristics</label>
                                <input type="text" name="teeth_characteristics" value="{{$animal ->teeth_characteristics}}"  id="animal_teeth_characteristics" placeholder="Describe teeth characteristics" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            </div>
                        </div>
                            <!-- Additional Physical Characteristics -->
                            <div class="flex mt-4 flex-col">
                                <label for="animal_description" class="dark:text-gray-200 text-gray-700">Description</label>
                                <textarea rows="4" name="description" id="animal_description" value="{{$animal ->description}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write a description..."></textarea>
                            </div>
                    </fieldset>

            </div>
            <div class="container mx-auto mt-8 p-4 font-serif   shadow-md bg-white dark:bg-gray-700 dark:shadow-md">


                <fieldset>
                    <legend class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">Identification
                    </legend>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Tag Number(s) -->
                        <div class="flex flex-col">
                            <label for="animal_tag_number" class="dark:text-gray-200 text-gray-700">Tag Number(s)</label>
                            <input type="text" name="tag_number" id="animal_tag_number" value="{{ $animal->tag_number }}" placeholder="e.g., ABC123, XYZ456" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>

                        <!-- Color -->
                        <div class="flex flex-col">
                            <label for="animal_color" class="dark:text-gray-200 text-gray-700">Color</label>
                            <input type="text" name="color" id="animal_color" value="{{ $animal->color }}" placeholder="e.g., Brown, White, Black" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>
                        <!-- Location -->
                        <div class="flex flex-col">
                            <label for="animal_location" class="dark:text-gray-200 text-gray-700">Location</label>
                            <select name="location" id="animal_location" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                                <option value="" disabled>Select Location</option>
                                <option value="Left Ear" {{ $animal->location === 'Left Ear' ? 'selected' : '' }}>Left Ear</option>
                                <option value="Right Ear" {{ $animal->location === 'Right Ear' ? 'selected' : '' }}>Right Ear</option>
                            </select>
                        </div>

                        <!-- Electronic ID -->
                        <div class="flex flex-col">
                            <label for="animal_electronic_id" class="dark:text-gray-200 text-gray-700">Electronic ID</label>
                            <input type="text" name="electronic_id" id="animal_electronic_id" value="{{ $animal->electronic_id }}" placeholder="e.g., EID123456" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-4 font-serif md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Other Tag Number/Label -->
                        <div class="flex flex-col">
                            <label for="animal_other_tag" class="dark:text-gray-200 text-gray-700">Other Tag Number/Label</label>
                            <input type="text" name="other_tag" id="animal_other_tag" value="{{ $animal->other_tag }}" placeholder="e.g., DEF789, GHI012" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>

                        <!-- Other Color -->
                        <div class="flex flex-col">
                            <label for="animal_other_color" class="dark:text-gray-200 text-gray-700">Other Color</label>
                            <input type="text" name="other_color" id="animal_other_color" value="{{ $animal->other_color }}" placeholder="e.g., Gray, Spotted, Red" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>

                        <!-- Other Location -->
                        <div class="flex flex-col">
                            <label for="animal_other_location" class="dark:text-gray-200 text-gray-700">Other Location</label>
                            <select name="other_location" id="animal_other_location" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                                <option value="" disabled>Select Location</option>
                                <option value="Left Ear" {{ $animal->other_location === 'Left Ear' ? 'selected' : '' }}>Left Ear</option>
                                <option value="Right Ear" {{ $animal->other_location === 'Right Ear' ? 'selected' : '' }}>Right Ear</option>
                            </select>
                        </div>

                        <!-- Registry Number -->
                        <div class="flex flex-col">
                            <label for="animal_registry_number" class="dark:text-gray-200 text-gray-700">Registry Number</label>
                            <input type="text" name="registry_number" id="animal_registry_number" value="{{ $animal->registry_number }}" placeholder="e.g., REG789012" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>
                    </div>

                    <div class="grid mt-4 grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Tattoo -->
                        <div class="flex flex-col">
                            <label for="animal_tattoo_left" class="dark:text-gray-200 text-gray-700">Tattoo (Left)</label>
                            <input type="text" name="tattoo_left" id="animal_tattoo_left" value="{{ $animal->tattoo_left }}" placeholder="e.g., ABC123" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>

                        <!-- Right Tattoo -->
                        <div class="flex flex-col">
                            <label for="animal_tattoo_right" class="dark:text-gray-200 text-gray-700">Tattoo (Right)</label>
                            <input type="text" name="tattoo_right" id="animal_tattoo_right" value="{{ $animal->tattoo_right }}" placeholder="e.g., XYZ456" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>
                    </div>

                    <div class="grid mt-4 grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Photographs -->
                        <div class="flex flex-col">
                            <label for="animal_photographs" class="dark:text-gray-200 text-gray-700">Photographs</label>
                            <input type="file" name="photographs[]" id="animal_photographs" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700" multiple>
                        </div>

                        <!-- DNA Profile -->
                        <div class="flex flex-col">
                            <label for="animal_dna_profile" class="dark:text-gray-200 text-gray-700">DNA Profile</label>
                            <input type="text" name="dna_profile" id="animal_dna_profile" value="{{ $animal->dna_profile }}" placeholder="e.g., DNA12345" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                        </div>

                        <!-- Scars -->
                        <div class="flex flex-col">
                            <label for="animal_scars" class="dark:text-gray-200 text-gray-700">Scars</label>
                            <textarea rows="3" name="scars" id="animal_scars" placeholder="Enter any scars or marks..." class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">{{ $animal->scars }}</textarea>
                        </div>
                    </div>



                </fieldset>

        </div>
        <div class="container mx-auto mt-8 font-serif p-4 mb-4 shadow-md bg-white dark:bg-gray-700 dark:shadow-md">

            <fieldset>
                <legend class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">Birth Information</legend>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Birth Date -->
                    <div class="flex flex-col">
                        <label for="birth_date" class="dark:text-gray-200 text-gray-700">Birth Date</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ $animal->birth_date }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>

                    <!-- Dam (Maternity) -->
                    <div class="flex flex-col">
                        <label for="dam" class="dark:text-gray-200 text-gray-700">Dam (Maternity)</label>
                        <input type="text" name="dam" id="dam" value="{{ $animal->dam }}" placeholder="Enter dam's name" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sire (Paternity) -->
                    <div class="flex mt-4 flex-col">
                        <label for="sire" class="dark:text-gray-200 text-gray-700">Sire (Paternity)</label>
                        <input type="text" name="sire" id="sire" value="{{ $animal->sire }}" placeholder="Enter sire's name" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>

                    <!-- Birth Weight -->
                    <div class="flex mt-4 flex-col">
                        <label for="birth_weight" class="dark:text-gray-200 text-gray-700">Birth Weight</label>
                        <div class="flex items-center">
                            <input type="number" step="0.01" name="birth_weight" id="birth_weight" value="{{ $animal->birth_weight }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark-text-gray-200 dark:bg-gray-700">
                            <select name="weight_unit" id="weight_unit" class="border rounded-lg px-2 py-2 ml-2 focus:outline-none focus:border-blue-400 dark-text-gray-200 dark:bg-gray-700">
                                <option value="lbs">lbs</option>
                                <option value="kg">kg</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Age to Wean -->
                    <div class="flex mt-4 flex-col">
                        <label for="age_to_wean" class="dark:text-gray-200 text-gray-700">Age to Wean (Days)</label>
                        <input type="number" name="age_to_wean" id="age_to_wean" value="{{ $animal->age_to_wean }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>

                    <!-- Date Weaned -->
                    <div class="flex mt-4 flex-col">
                        <label for="date_weaned" class="dark:text-gray-200 text-gray-700">Date Weaned</label>
                        <input type="date" name="date_weaned" id="date_weaned" value="{{ $animal->date_weaned }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Birth Time -->
                    <div class="flex mt-4 flex-col">
                        <label for="birth_time" class="dark:text-gray-200 text-gray-700">Birth Time</label>
                        <input type="time" name="birth_time" id="birth_time" value="{{ $animal->birth_time }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>

                    <!-- Birth Status -->
                    <div class="flex mt-4 flex-col">
                        <label for="birth_status" class="dark:text-gray-200 text-gray-700">Birth Status</label>
                        <select name="birth_status" id="birth_status" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            <option value="Natural" {{ $animal->birth_status == 'Natural' ? 'selected' : '' }}>Natural</option>
                            <option value="Assisted" {{ $animal->birth_status == 'Assisted' ? 'selected' : '' }}>Assisted</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Colostrum Intake -->
                    <div class="flex mt-4 flex-col">
                        <label for="colostrum_intake" class="dark:text-gray-200 text-gray-700">Colostrum Intake (ml)</label>
                        <input type="number" name="colostrum_intake" id="colostrum_intake" value="{{ $animal->colostrum_intake }}" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>

                    <!-- Health at Birth -->
                    <div class="flex mt-4 flex-col">
                        <label for="health_at_birth" class="dark:text-gray-200 text-gray-700">Health at Birth</label>
                        <select name="health_at_birth" id="health_at_birth" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                            <option value="Healthy" {{ $animal->health_at_birth == 'Healthy' ? 'selected' : '' }}>Healthy</option>
                            <option value="Sick" {{ $animal->health_at_birth == 'Sick' ? 'selected' : '' }}>Sick</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Milk Feeding -->
                    <div class="flex mt-4 flex-col">
                        <label for="milk_feeding" class="dark:text-gray-200 text-gray-700">Milk Feeding</label>
                        <input type="text" name="milk_feeding" id="milk_feeding" value="{{ $animal->milk_feeding }}" placeholder="Type and quantity of milk/formula" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>

                    <!-- Vaccinations -->
                    <div class="flex mt-4 flex-col">
                        <label for="vaccinations" class="dark:text-gray-200 text-gray-700">Vaccinations</label>
                        <input type="text" name="vaccinations" id="vaccinations" value="{{ $animal->vaccinations }}" placeholder="List any vaccinations given" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                    </div>
                </div>

                <!-- Breeder Information -->
                <div class="flex mt-4 flex-col">
                    <label for="breeder_info" class="dark:text-gray-200 text-gray-700">Breeder Information</label>
                    <input type="text" name="breeder_info" id="breeder_info" value="{{ $animal->breeder_info }}" placeholder="Enter breeder information" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                </div>

                <!-- Birth Photos -->
                <div class="flex mt-4 flex-col">
                    <label for="birth_photos" class="dark:text-gray-200 text-gray-700">Birth Photos</label>
                    <input type="file" name="birth_photos[]" id="birth_photos" accept="image/*" multiple class="border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-400 dark:text-gray-200 dark:bg-gray-700">
                </div>

                <!-- Raised or Purchased -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white">Raised or Purchased</label>
                    <div class="flex">
                        <div class="mr-4">
                            <input class="form-radio" type="radio" name="raised_purchased" id="raisedRadio" value="Raised" {{ $animal->raised_purchased == 'Raised' ? 'checked' : '' }}>
                            <label class="ml-2" for="raisedRadio">Raised</label>
                        </div>
                        <div>
                            <input class="form-radio" type="radio" name="raised_purchased" id="purchasedRadio" value="Purchased" {{ $animal->raised_purchased == 'Purchased' ? 'checked' : '' }}>
                            <label class="ml-2" for="purchasedRadio">Purchased</label>
                        </div>
                    </div>
                </div>

                <div id="purchasedForm" class="mt-4" style="display: none;">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Purchased Animal Details</h3>

                    <div class="mb-4">
                        <label for="purchaseDate" class="block text-sm font-medium text-gray-700 dark:text-white">Date of Purchase</label>
                        <input type="date" class="form-input dark:bg-gray-700 dark:text-gray-200 w-full" id="purchaseDate" name="purchaseDate" value="{{ $animal->purchaseDate }}">
                    </div>

                    <div class="mb-4">
                        <label for="purchasePrice" class="block text-sm font-medium text-gray-700 dark:text-white">Purchase Price</label>
                        <input type="number" class="form-input dark:bg-gray-700 dark:text-gray-200 w-full" id="purchasePrice" name="purchasePrice" value="{{ $animal->purchasePrice }}" placeholder="Enter purchase price">
                    </div>

                    <div class="mb-4">
                        <label for="vendor" class="block text-sm font-medium text-gray-700 dark:text-white">Vendor Name</label>
                        <input type="text" class="form-input dark:bg-gray-700 dark:text-gray-200 w-full" id="vendor" name="vendor" value="{{ $animal->vendor }}" placeholder="Enter vendor name">
                    </div>

                    <div class="mb-4">
                        <label for="treatments" class="block text-sm font-medium text-gray-700 dark:text-white">Treatments</label>
                        <select id="treatments" name="treatments" class="form-select dark:bg-gray-700 dark:text-gray-200 w-full">
                            <option value="Artificial Insemination" {{ $animal->treatments == 'Artificial Insemination' ? 'selected' : '' }}>Artificial Insemination</option>
                            <option value="Branding" {{ $animal->treatments == 'Branding' ? 'selected' : '' }}>Branding</option>
                            <option value="Castration" {{ $animal->treatments == 'Castration' ? 'selected' : '' }}>Castration</option>
                            <option value="Dehorning" {{ $animal->treatments == 'Dehorning' ? 'selected' : '' }}>Dehorning</option>
                            <option value="Dental Procedure" {{ $animal->treatments == 'Dental Procedure' ? 'selected' : '' }}>Dental Procedure</option>
                            <option value="Deworming" {{ $animal->treatments == 'Deworming' ? 'selected' : '' }}>Deworming</option>
                            <option value="Ear Notching" {{ $animal->treatments == 'Ear Notching' ? 'selected' : '' }}>Ear Notching</option>
                            <option value="Euthanasia" {{ $animal->treatments == 'Euthanasia' ? 'selected' : '' }}>Euthanasia</option>
                            <option value="Fly Treatment" {{ $animal->treatments == 'Fly Treatment' ? 'selected' : '' }}>Fly Treatment</option>
                            <option value="Grooming" {{ $animal->treatments == 'Grooming' ? 'selected' : '' }}>Grooming</option>
                            <option value="Hoof Trim" {{ $animal->treatments == 'Hoof Trim' ? 'selected' : '' }}>Hoof Trim</option>
                            <option value="Medication" {{ $animal->treatments == 'Medication' ? 'selected' : '' }}>Medication</option>
                            <option value="Mites" {{ $animal->treatments == 'Mites' ? 'selected' : '' }}>Mites</option>
                            <option value="Parasite Treatment" {{ $animal->treatments == 'Parasite Treatment' ? 'selected' : '' }}>Parasite Treatment</option>
                            <option value="Surgical Procedure" {{ $animal->treatments == 'Surgical Procedure' ? 'selected' : '' }}>Surgical Procedure</option>
                            <option value="Tagging" {{ $animal->treatments == 'Tagging' ? 'selected' : '' }}>Tagging</option>
                            <option value="Tattoo" {{ $animal->treatments == 'Tattoo' ? 'selected' : '' }}>Tattoo</option>
                            <option value="Vaccination" {{ $animal->treatments == 'Vaccination' ? 'selected' : '' }}>Vaccination</option>
                            <option value="Other Procedure" {{ $animal->treatments == 'Other Procedure' ? 'selected' : '' }}>Other Procedure</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="deficts" class="block text-sm font-medium text-gray-700 dark:text-white">Health Status</label>
                        <select id="deficts" name="deficts" class="form-select dark:bg-gray-700 dark:text-gray-200 w-full">
                            <option value="Healthy" {{ $animal->deficts == 'Healthy' ? 'selected' : '' }}>Healthy</option>
                            <option value="Sick" {{ $animal->deficts == 'Sick' ? 'selected' : '' }}>Sick</option>
                        </select>
                    </div>
                </div>


                <script>
                    const purchasedRadio = document.getElementById('purchasedRadio');
const purchasedForm = document.getElementById('purchasedForm');

purchasedRadio.addEventListener('click', () => {
purchasedForm.style.display = 'block';
});

const raisedRadio = document.getElementById('raisedRadio');
raisedRadio.addEventListener('click', () => {
purchasedForm.style.display = 'none';
});

// Add an event listener to the submit button of your form
const submitButton = document.getElementById('submitButton'); // Replace 'submitButton' with your actual submit button ID or selector

submitButton.addEventListener('click', () => {
if (purchasedRadio.checked) {
// Gather form data
const formData = {
    animalType: document.getElementById('purchasedAnimal').value,
    purchaseDate: document.getElementById('purchaseDate').value,
    purchasePrice: document.getElementById('purchasePrice').value,
    vendor: document.getElementById('vendor').value,
    treatments: document.getElementById('treatments').value,
    deficits: document.getElementById('deficits').value,
    //healthStatus: document.getElementById('healthStatus').value
};

// Send the data to the server using Axios
axios.post('/record-purchased', formData)
    .then(response => {
        // Handle the response from the server
        if (response.status === 200) {
            // Data was successfully recorded in the database
            alert('Data recorded successfully');
        } else {
            // Handle errors if any
            alert('Failed to record data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
});

                </script>
            </fieldset>
            <div class="flex col-flex-2  justify-end mt-6">

                    <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                        <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
                    </button>
                    <button type="submit" class="px-3 mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                        Update
                    </button>
                </div>
    </div>




        </form>


        <!-- Add a hidden input field to store the animal's ID -->

    </div>


    <!-- JavaScript code -->
    <script>
        // List of animals
        const animalTypeList = [
            "Alpaca", "Bees", "Bison", "Buffalo", "Butterflies", "Camel", "Cat", "Catfish",
            "Cattle", "Chicken", "Crickets", "Deer", "Dog", "Donkey", "Duck", "Elk",
            "Emu", "Fish", "Gayal", "Goat", "Goose", "Guineafowl", "Horse", "Llama",
            "Mealworms", "Mollusk", "Mule", "Muskox", "Ostrich", "Partridge", "Peafowl",
            "Pheasant", "Pig", "Pigeon", "Pony", "Quail", "Rabbit", "Reindeer", "Rhea",
            "Salmon", "Sheep", "Shellfish", "Silkworms", "Swine", "Tilapia", "Trout",
            "Turkey", "Water buffalo", "Waxworms", "Yak", "Zebu"
        ];

        // Populate the animal dropdown with the list of animals
        const animalList = document.getElementById("animal_list");
        const animalTypeInput = document.getElementById("animal_type");
        const animalDropdown = document.getElementById("animalDropdown");

        animalTypeInput.addEventListener("click", function () {
            if (animalDropdown.style.display === "none" || animalDropdown.style.display === "") {
                animalDropdown.style.display = "block";
            } else {
                animalDropdown.style.display = "none";
            }
        });

        animalTypeList.forEach(animal => {
            const listItem = document.createElement("li");
            listItem.textContent = animal;
            listItem.className = "px-4 py-2 cursor-pointer hover:bg-blue-500";
            listItem.addEventListener("click", function () {
                animalTypeInput.value = animal;
                animalDropdown.style.display = "none";
            });
            animalList.appendChild(listItem);
        });
    </script>

<script>
    const animalStatusSelect = document.getElementById("animal_status");
    const dateDeceasedSection = document.getElementById("dateDeceasedSection");

    animalStatusSelect.addEventListener("change", function () {
        if (animalStatusSelect.value === 'Deceased') {
            dateDeceasedSection.style.display = 'block';
        } else {
            dateDeceasedSection.style.display = 'none';
        }
    });
</script>
</x-app-layout>
