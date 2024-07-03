


<x-app-layout title="Cards">

    <div class="container font-serif mx-auto mt-8 p-4 mb-8 bg-white dark:bg-gray-700 dark:rounded-lg dark:shadow-lg">
        <h1 class="text-2xl font-serif dark:text-gray-200 font-semibold mb-4">Create Supplier</h1>
        <hr class="mb-4">

        <!-- form start -->
        <form role="form" action="{{ route('Supplier.storesupplier', ['animal_id' => $animal->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="flex flex-col mb-4">
                    <label for="name" class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Name<span class="text-red-900">*</span></label>
                    <input type="text" id="name" name="name" class="w-full dark:bg-gray-800 dark:text-gray-200 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" list="veterinarians" placeholder="Enter Name" required>
                    <datalist id="veterinarians">
                        <option value="" disabled>Select Veterinarian</option>
                        @foreach($contacts as $contact)
                            @if(in_array($contact->first_name . ' ' . $contact->last_name, $contactNames))
                                <option value="{{ $contact->first_name }} {{ $contact->last_name }}">
                                    {{ $contact->first_name }} {{ $contact->last_name }}
                                </option>
                            @endif
                        @endforeach
                    </datalist>
                </div>
               {{--}} <div class="flex flex-col mb-4">
                    <label for="supplier" class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Supplier<span class="text-red-900">*</span></label>
                    <select id="supplier" name="supplier" class="w-full dark:bg-gray-800 dark:text-gray-200 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                        <option value="" disabled>Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->name }}
                                {{$supplier->delivery_options}}
                            </option>
                        @endforeach
                    </select>
                </div>--}}


                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Email<span class="text-red-900">*</span></label>
                    <input type="email" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                </div>

                <!-- Add more fields here -->
                <div class="mb-4">
                    <label class="blockd dark:text-gray-200  text-gray-700 text-sm font-bold mb-2">Phone<span class="text-red-900">*</span></label>
                    <input type="text" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200   text-sm font-bold mb-2">Address</label>
                    <input type="text" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="address" value="{{ old('address') }}" placeholder="Enter Address">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200  text-sm font-bold mb-2">City</label>
                    <input type="text" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="city" value="{{ old('city') }}" placeholder="Enter City">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200  text-sm font-bold mb-2">Type<span class="text-red-900">*</span></label>
                    <select name="type" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                        <option value="" disabled selected>Select Type</option>
                        <option value="1">Distributor</option>
                        <option value="2">Whole Seller</option>
                        <option value="3">Brochure</option>
                        <option value="4">Manufacturer</option>
                        <option value="5">Importer</option>
                        <option value="6">Exporter</option>
                        <option value="7">Retailer</option>
                        <option value="8">Agent</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200  text-sm font-bold mb-2">Shop Name<span class="text-red-900">*</span></label>
                    <input type="text" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="shop_name" value="{{ old('shop_name') }}" placeholder="Enter Shop Name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Photo</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="photo" class=" dark:text-gray-200 custom-file-input" id="exampleInputFile">
                            <label class="dark:text-gray-200 custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Serial Number</label>
                    <input type="text" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" disabled name="serial_number" value="{{ old('serial_number') }}" placeholder="Serial Number will be generated automatically">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Account Holder</label>
                    <input type="text" class="w-full dark:bg-gray-800 dark:text-gray-200 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="account_holder" value="{{ old('account_holder') }}" placeholder="Enter Account Holder">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Account Number</label>
                    <input type="text" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="account_number" value="{{ old('account_number') }}" placeholder="Enter Account Number">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Bank Name</label>
                    <input type="text" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="bank_name" value="{{ old('bank_name') }}" placeholder="Enter Bank Name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Bank Branch</label>
                    <input type="text" class="w-full dark:bg-gray-800 dark:text-gray-200 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="bank_branch" value="{{ old('bank_branch') }}" placeholder="Enter Bank Branch">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Product Type<span class="text-red-900">*</span></label>
                    <select name="product_type" class="w-full border rounded-md dark:bg-gray-800 dark:text-gray-200 py-2 px-3 focus:outline-none focus:border-blue-500" required>
                        <option value="" disabled selected>Select Product Type</option>
                        <option value="Poultry Feed">Poultry Feed</option>
                        <option value="Livestock Feed">Livestock Feed</option>
                        <option value="Pet Food">Pet Food</option>
                        <option value="Animal Medications">Animal Medications</option>
                        <option value="Animal Supplements">Animal Supplements</option>
                        <option value="Animal Equipment">Animal Equipment</option>
                        <option value="Animal Bedding">Animal Bedding</option>
                        <option value="Farm Animal Vaccines">Farm Animal Vaccines</option>
                        <option value="Horse Care Products">Horse Care Products</option>
                        <option value="Poultry Incubators">Poultry Incubators</option>
                        <option value="Aquarium Supplies">Aquarium Supplies</option>
                        <option value="Cattle Tags">Cattle Tags</option>
                        <option value="Rat Traps">Rat Traps</option>
                        <option value="Beekeeping Supplies">Beekeeping Supplies</option>
                        <option value="Hatchery Equipment">Hatchery Equipment</option>
                        <option value="Fish Food">Fish Food</option>
                        <option value="Riding Gear">Riding Gear</option>
                        <option value="Rabbit Hutches">Rabbit Hutches</option>
                        <option value="Sheep Shears">Sheep Shears</option>
                        <option value="Goat Milking Machines">Goat Milking Machines</option>
                        <option value="Reptile Terrariums">Reptile Terrariums</option>
                        <option value="Bird Cages">Bird Cages</option>
                        <option value="Equestrian Grooming Kits">Equestrian Grooming Kits</option>
                        <option value="Dog Crates">Dog Crates</option>
                        <option value="Cat Litter">Cat Litter</option>
                        <option value="Small Animal Carriers">Small Animal Carriers</option>
                        <option value="Pig Feed">Pig Feed</option>
                        <option value="Rodent Repellents">Rodent Repellents</option>
                        <option value="Insecticides for Livestock">Insecticides for Livestock</option>
                        <option value="Beehive Frames">Beehive Frames</option>
                        <option value="Pet Grooming Supplies">Pet Grooming Supplies</option>
                        <option value="Deer Feed">Deer Feed</option>
                        <option value="Terrarium Plants">Terrarium Plants</option>
                        <option value="Riding Helmets">Riding Helmets</option>
                        <option value="Farm Animal Diapers">Farm Animal Diapers</option>
                        <option value="Bird Toys">Bird Toys</option>
                        <option value="Cattle Prods">Cattle Prods</option>
                        <option value="Hay Racks">Hay Racks</option>
                        <option value="Incubator Thermostats">Incubator Thermostats</option>
                        <option value="Poultry Nipple Drinkers">Poultry Nipple Drinkers</option>
                        <option value="Alpaca Shearing Tools">Alpaca Shearing Tools</option>
                        <option value="Turtle Tanks">Turtle Tanks</option>
                        <option value="Fish Tank Filters">Fish Tank Filters</option>
                        <option value="Horse Blankets">Horse Blankets</option>
                        <option value="Pest Control for Poultry Houses">Pest Control for Poultry Houses</option>
                        <option value="Veterinary Wound Care">Veterinary Wound Care</option>
                        <option value="Poultry Egg Incubators">Poultry Egg Incubators</option>
                        <option value="Rabbit Feed">Rabbit Feed</option>
                        <option value="Aquarium Heaters">Aquarium Heaters</option>
                        <option value="Chicken Coop Supplies">Chicken Coop Supplies</option>
                        <option value="Livestock Fencing">Livestock Fencing</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm dark:text-gray-200  font-bold mb-2">Delivery Options</label>
                    <select name="delivery_options" class="w-full border dark:bg-gray-800 dark:text-gray-200 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                        <option value="" disabled selected>Select Delivery Option</option>
                        <option value="Doorstep Delivery">Doorstep Delivery</option>
                        <option value="Pickup Points">Pickup Points</option>
                        <option value="Farmers' Markets">Farmers' Markets</option>
                        <option value="Local Stores">Local Stores</option>
                        <option value="Postal Delivery">Postal Delivery</option>
                        <option value="Freight Services">Freight Services</option>
                        <option value="Express Courier">Express Courier</option>
                        <option value="Distributor Network">Distributor Network</option>
                    </select>
                </div>
            </div>
            <hr class="mt-4 col-span-full">
            <div class="flex justify-end mt-6">
                <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100 tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    <a href="{{route('Supplier.show',['animal_id' => $animal->id])}}" class="btn btn-gray-500">Cancel</a>
                </button>
                <button type="submit" name="action" value="save" class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>


