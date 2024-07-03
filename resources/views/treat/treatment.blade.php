<x-app-layout title="Forms">
    <div class="container mx-auto mt-8 p-4 mb-4 dark:bg-gray-700 dark:rounded-lg font-serif bg-gray-20 rounded-lg shadow-lg">
        <div class="md:flex md:items-center md:justify-between md:p-4 md:mb-4 md:rounded-lg p-2 mb-2 rounded-lg text-center">
            <h1 class="text-lg md:text-2xl dark:text-white font-semibold mb-2 md:mb-0 md:mr-4">Record <span class="text-blue-400 "></span> New Treatment</h1>
            <span class="px-2 py-1 text-xs md:text-sm text-blue-400 bg-gray-600 rounded-full">{{$animal->internal_id}}</span>
        </div>

        <div class="modal-body">

            <form action="{{ route('treat.storetreament', ['animal_id' => $animal->id]) }}"  method="POST">

                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="col-span-1 mt-4">
                        <label for="treatment_type" class="block mb-1  dark:text-gray-100 font-serif text-sm font-medium dark:bg-gray-700 text-gray-700">Treatment Type</label>
                        <select class="form-select dark:bg-gray-700 dark:text-gray-200 w-full " required="required" name="type" id="treatment_type">
                            <option value=""></option>

                            <option value="Alternative Therapy">Alternative Therapy</option>
                            <option value="Artificial Insemination">Artificial Insemination</option>
                            <option value="Branding">Branding</option>
                            <option value="Castration">Castration</option>
                            <option value="Dehorning">Dehorning</option>
                            <option value="Dental Procedure">Dental Procedure</option>
                            <option value="Deworming">Deworming</option>
                            <option value="Ear Notching">Ear Notching</option>
                            <option value="Euthanasia">Euthanasia</option>
                            <option value="Fly Treatment">Fly Treatment</option>
                            <option value="Grooming">Grooming</option>
                            <option value="Hoof Trim">Hoof Trim</option>
                            <option value="Medication">Medication</option>
                            <option value="Mites">Mites</option>
                            <option value="Parasite Treatment">Parasite Treatment</option>
                            <option value="Surgical Procedure">Surgical Procedure</option>
                            <option value="Tagging">Tagging</option>
                            <option value="Tattoo">Tattoo</option>
                            <option value="Vaccination">Vaccination</option>
                            <option value="Wound Care">Wound Care</option>
                            <option value="Diagnostics">Diagnostics</option>
                            <option value="Behavioral Training">Behavioral Training</option>
                            <option value="Nutritional Consultation">Nutritional Consultation</option>
                            <option value="Reproductive Services">Reproductive Services</option>
                            <option value="Breeding Assistance">Breeding Assistance</option>
                            <option value="Genetic Testing">Genetic Testing</option>
                            <option value="Emergency Care">Emergency Care</option>
                            <option value="Endoscopy">Endoscopy</option>
                            <!-- Add more options as needed -->

                                <option value="Other Procedure">Other Procedure</option></select>

                            <!-- Add your options here -->
                        </select>
                    </div>

                    <div class="col-span-1 mt-4 ">
                        <label for="treatment_product" class="block  dark:text-gray-100 text-sm font-medium text-gray-700 light:text-gray-700">Details/Product</label>
                        <input class="form-input mt-1 dark:bg-gray-700 dark:text-gray-200 w-full"  name="name_{{ auth()->user()->id }}" type="text" name="product" id="treatment_product">
                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="col-span-1 mt-4">
                        <label for="treatment_batch" class="block text-sm dark:text-gray-100 font-medium text-gray-700">Batch #</label>
                        <input class="form-input dark:bg-gray-700 dark:text-gray-200 mt-1 w-full"  name="name_{{ auth()->user()->id }}"  max="1000000" type="text" name="batch" id="treatment_batch">
                    </div>
                    <div class="col-span-1 mt-4 md:mt-0">
                        <label for="treatment_amount" class="block dark:text-gray-100 text-sm font-medium text-gray-700">Dosage/Amount</label>
                        <input class="form-input dark:bg-gray-700 dark:text-gray-200 mt-1 w-full"  name="name_{{ auth()->user()->id }}" type="text" name="amount" id="treatment_amount">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label for="veterinarian_id" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-100">
                            Veterinarian Contact
                        </label>
                        <div class="flex items-center space-x-4">
                            <select id="veterinarian_id" name="veterinarian_id" class="form-select w-full dark:bg-gray-700 dark:text-gray-200">
                                <option value="">Select a veterinarian</option>
                                @foreach($Contacts as $Contact)
                                    <option value="{{ $Contact->id }}">{{ $Contact->first_name }} {{ $Contact->last_name }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('Contacts.contact', ['animal_id' => $animal->id]) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                <span class="hidden sm:inline">New Vet</span> <!-- Hidden on small screens for compactness -->
                            </a>

                        </div>
                    </div>

                <!-- Inventory -->

                    <div class="col-span-1">
                        <label for="treatment_inventory_amount" class="block text-sm dark:bg-gray-700 dark:text-gray-100 font-medium text-gray-700">Inventory Amount Used</label>
                        <div class="flex dark:bg-gray-700 dark:text-gray-200 mt-1">
                            <input class="form-input dark:bg-gray-700 dark:text-gray-200  flex-grow" placeholder="" step="any" type="number" max="10000000" name="inventory_amount" id="treatment_inventory_amount">
                            <select class="form-select dark:bg-gray-700 dark:text-gray-200 ml-2" name="unit" id="treatment_unit">
                                <option value="" label=" "></option>
                                <option value="bales">bales</option>
<option value="fluid ounces">fluid ounces</option>
<option value="gallons">gallons</option>
<option value="milliliter">milliliter</option>
<option value="ounces">ounces</option>
<option value="pounds">pounds</option>
<option value="quantity">quantity</option>
<option value="quarts">quarts</option>
<option value="tons">tons</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="col-span-1">
                        <label for="treatment_mode" class="block dark:text-gray-100 text-sm font-medium text-gray-700">Application Method</label>
                        <select class="form-select dark:bg-gray-700 dark:text-gray-200 w-full mt-1" name="mode" id="treatment_mode">
                            <option value=""></option>
                            <option value="Intramuscular (in the muscle)">Intramuscular (in the muscle)</option>
<option value="Intramammary (in the udder)">Intramammary (in the udder)</option>
<option value="Intrauterine (in the uterus)">Intrauterine (in the uterus)</option>
<option value="Intravenous (in the vein)">Intravenous (in the vein)</option>
<option value="Oral (in the mouth)">Oral (in the mouth)</option>
<option value="Subcutaneous (under the skin)">Subcutaneous (under the skin)</option>
<option value="Topical (on the skin)">Topical (on the skin)</option>
<option value="Intradermal (in the skin)">Intradermal (in the skin)</option>
<option value="Intraarticular (in the joint)">Intraarticular (in the joint)</option>
<option value="Intranasal (in the nose)">Intranasal (in the nose)</option>
<option value="Intrathecal (in the spinal canal)">Intrathecal (in the spinal canal)</option>
<option value="Intravesical (in the bladder)">Intravesical (in the bladder)</option>
<option value="Intraocular (in the eye)">Intraocular (in the eye)</option>
<option value="Intracardiac (in the heart)">Intracardiac (in the heart)</option>
<option value="Intraperitoneal (in the abdominal cavity)">Intraperitoneal (in the abdominal cavity)</option>
<option value="Intratympanic (in the ear)">Intratympanic (in the ear)</option>
<option value="Inhalation (through inhaler)">Inhalation (through inhaler)</option>
<option value="Rectal (in the rectum)">Rectal (in the rectum)</option>
<option value="Transdermal (through the skin)">Transdermal (through the skin)</option>
<option value="Intraosseous (into the bone)">Intraosseous (into the bone)</option>
<option value="Sublingual (under the tongue)">Sublingual (under the tongue)</option>
<option value="Buccal (between the cheek and gum)">Buccal (between the cheek and gum)</option>
<option value="Intrapericardial (in the pericardial sac)">Intrapericardial (in the pericardial sac)</option>
<option value="Intracavernous (in the penis)">Intracavernous (in the penis)</option>
<option value="Intradermal (in the skin)">Intradermal (in the skin)</option>
<option value="Vaginal (in the vagina)">Vaginal (in the vagina)</option>
<option value="Nasogastric (through the nose into the stomach)">Nasogastric (through the nose into the stomach)</option>
<option value="Intraluminal (in the lumen of a tubular organ)">Intraluminal (in the lumen of a tubular organ)</option>
<option value="Intrahepatic (in the liver)">Intrahepatic (in the liver)</option>
<option value="Epicutaneous (on the skin, e.g., patch)">Epicutaneous (on the skin, e.g., patch)</option>
<option value="Intracerebral (in the brain)">Intracerebral (in the brain)</option>

<option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="treatment_site" class="block text-sm dark:bg-gray-700 dark:text-gray-100 font-medium text-gray-700">Treatment Location</label>
                        <select class="form-input dark:bg-gray-700 dark:text-gray-200 mt-1 w-full" name="site" id="treatment_site">
                          <option value="">Select Treatment Location</option>
                          <option value="rump">Rump</option>
                          <option value="flank">Flank</option>
                          <option value="neck">Neck</option>
                          <option value="shoulder">Shoulder</option>
                          <option value="hip">Hip</option>
                          <option value="leg">Leg</option>
                          <option value="foot">Foot</option>
                          <option value="hoof">Hoof</option>
                          <option value="udder">Udder</option>
                          <option value="teat">Teat</option>
                          <option value="eye">Eye</option>
                          <option value="ear">Ear</option>
                          <option value="nose">Nose</option>
                          <option value="mouth">Mouth</option>
                          <option value="throat">Throat</option>
                          <option value="back">Back</option>
                          <option value="abdomen">Abdomen</option>
                          <option value="chest">Chest</option>
                          <option value="tail">Tail</option>
                          <option value="head">Head</option>
                          <option value="neck">Neck</option>
                          <option value="muzzle">Muzzle</option>
                          <option value="snout">Snout</option>
                          <option value="horn">Horn</option>
                          <option value="hoof">Hoof</option>
                          <option value="wound">Wound</option>
                          <option value="injection_site">Injection Site</option>
                          <option value="other">Other</option>
                        </select>
                      </div>
                </div>
                <div class="flex flex-wrap mt-4">
                    <div class="w-full md:w-1/2 md:pr-4 mb-4 md:mb-0">
                        <label for="days_to_withdrawal" class="block text-smd dark:text-gray-100 dark:bg-gray-700 font-medium text-gray-700">Days until Withdrawal Date</label>
                        <input type="number" name="days_to_withdrawal" id="days_to_withdrawal" value="" class="form-input dark:bg-gray-700 dark:text-gray-200 w-full mt-1" min="0" max="9999">
                    </div>
                    <div class="w-full md:w-1/2 md:pr-4 mb-4 md:mb-0 ">
                        <label for="treatment_retreat_date" class="block dark:text-gray-100 text-sm font-medium ml-4 text-gray-700">Booster Date</label>
                        <input class="form-input dark:bg-gray-700 dark:text-gray-200 w-full ml-4 mt-1" type="date" name="retreat_date" id="treatment_retreat_date">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- First column -->
                    <div class="col-span-1 md:mt-0 flex flex-col">
                        <label for="treatment_technician" class="block dark:text-gray-100 text-sm font-medium text-gray-700">Technician</label>
                        <input class="form-input dark:bg-gray-700 dark:text-gray-200 w-full mt-1"  name="name_{{ auth()->user()->id }}" placeholder="Example: Alpine Vet, etc" maxlength="63" size="63" type="text" name="technician" id="treatment_technician">
                    </div>

                    <!-- Second column -->
                    <div class="col-span-1 md:mt-0 flex flex-col">
                        <label for="treatment_cost" class="block dark:text-gray-100 text-sm font-medium text-gray-700">Treatment Total Cost</label>
                        <div class="mt-1 dark:bg-gray-700 dark:text-gray- flex items-center">
                            <select class="form-select dark:bg-gray-700 dark:text-gray-200 mr-2" name="currency" id="treatment_currency">
                                <option value="USD">$ USD</option>
                                <option value="EUR">€ EUR</option>
                                <option value="GBP">£ GBP</option>
                                <option value="JPY">¥ JPY</option>
                                <option value="KES">KES Ksh</option>
                                <!-- Add more currency options as needed -->
                            </select>
                            <input class="form-input dark:bg-gray-700 dark:text-gray-200 w-full mt-1 md:mt-0" step=".1" min="0" max="1000000" type="number" name="cost" id="treatment_cost">
                            <label for="record_transaction" class="ml-2">
                                <input type="checkbox" name="record_transaction" id="record_transaction" checked="checked">
                                <span class=" dark:bg-gray-700 dark:text-gray-100 ">Record Expense</span>
                            </label>
                        </div>
                    </div>
                </div>




                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="col-span-2 md:col-span-1">
                        <label for="treatment_description" class="block dark:text-gray-100 text-sm font-medium text-gray-700">Description</label>
                        <textarea rows="3"  name="name_{{ auth()->user()->id }}" class="form-textarea dark:bg-gray-700 dark:text-gray-200 w-full mt-1" name="treatment_description" id="treatment_description"></textarea>
                    </div>

                    <div class="col-span-2 md:col-span-1 mt-4">
                        <label for="treatment_date" class="block text-sm dark:text-gray-100 font-medium text-gray-700">Treatment Date</label>
                        <input class="form-input dark:bg-gray-700 dark:text-gray-200 w-full mt-1" type="date" name="dates" id="treatment_date">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="col-span-2 md:col-span-1">
                        <label for="treatment_keywords" class="block text-sm dark:text-gray-100 font-medium text-gray-700">Keywords</label>
                        <div class="mt-1 flex items-center">
                            <i class="fas fa-tag text-muted" aria-hidden="true"></i>
                            <input class="form-input dark:bg-gray-700 dark:text-gray-200 flex-grow w-full ml-2"  name="name_{{ auth()->user()->id }}" placeholder="Example: monthly application, etc" maxlength="20" size="20" type="text" name="treatment_keywords" id="treatment_keywords">
                        </div>
                    </div>
                </div>

                <hr class="mt-4 ">
                <div class="flex justify-end mt-6">
                    <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                        <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
                    </button>
                    <button type="submit" name="action" value="new_save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                        Save
                    </button>


                </div>

              <!--  <div class="mt-4">
                    <div class="flex justify-end">
                        <a class="btn btn-gray-500" data-dismiss="modal">Cancel</a>
                        <input type="submit" name="commit" value="Save" class="btn btn-primary ml-3">
                    </div>
                </div>-->
            </form>
        </div>
    </div>




</x-app-layout>
