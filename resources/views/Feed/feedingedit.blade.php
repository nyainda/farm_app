

<x-app-layout title="Feeding">
    <div id="error-message-wrapper" class="container font-serif mx-auto mt-8 p-4 mb-4 bg-white dark:bg-gray-700 dark:rounded-lg dark:shadow-lg">
        <form action="{{ route('feeding.update', ['animal_id' => $animal->id, 'feeding_id' => $feeding->id]) }}" method="POST">
            @csrf <!-- Add CSRF token -->
            @method('PUT')
            <h3 class="text-2xl font-serif dark:text-gray-100 font-semibold text-gray-800 mb-4">Edit {{$animal->type}} Feeding</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label for="feeding_Subtract from Inventory" class="block font-serif text-sm font-medium text-gray-700">Subtract from Inventory</label>
                    <div class="mt-2">
                        <a href="/inventories" class="font-serif text-blue-500">No Available Inventory</a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1 mb-4 mt-4">
                    <label for="feeding_Amount Fed" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">Amount Fed</label>
                    <input class="mt-1 block  py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full font-serif form-select"  value="{{$feeding->amount}}" placeholder="Enter Amount Fed" step="any" max="1000000" required="required" type="number" name="amount" id="feeding_amount" />
                </div>
                <div class="col-span-1 mb-4 mt-4">
                    <label for="feeding_unit" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">Unit</label>
                    <select class="mt-1 block  py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full font-serif form-select"  value="{{$feeding->unit}}" required="required" name="unit" id="feeding_unit">
                        <option value="" label=" "></option>
                        <option value="bales">Bales</option>
                        <option value="ounces">Ounces</option>
                        <option selected="selected" value="pounds">Pounds</option>
                        <option value="quantity">Quantity</option>
                        <option value="tons">Tons</option>
                        <!-- Add more unit options as needed -->
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div class="col-span-1 mt-4 mb-2">
                    <label for="feeding_Feed Details" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">Feed Details</label>
                    <input class="mt-1 block  w-full py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm  font-serif form-select" value="{{$feeding->feed_details}}" type="text" placeholder="Enter Feed Details" name="feed_details" id="feeding_type" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2 mt-4 mb-4 ">
                    <label for="feeding_Feed Weight" class="block text-sm font-medium text-gray-700 mt-2 dark:text-gray-300">Feed Weight</label>
                    <div class="flex ">
                        <input class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step=".1" min="0" max="100000" type="number" placeholder="Enter Feed Weight"  value="{{$feeding->feed_weight}}" name="feed_weight" id="feeding_weight" />
                        <select class="mt-1 block w-30 ml-2 py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="weight_unit" id="feeding_weight_unit">
                            <option value="lbs">lbs</option>
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                            <option value="oz">oz</option>
                            <!-- Add more weight unit options as needed -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2 mb-4 mt-4">
                    <label for="feeding_Estimated Cost" class="block mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">Estimated Cost</label>
                    <div class="flex ">
                        <select class="mt-1 block  py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-25 font-serif form-select" value="{{$feeding->feeding_currency}}"  name="feeding_currency" id="feeding_currency">
                            <option value="USD">$ KSH</option>
                            <option value="EUR">€ KSH</option>
                            <option value="GBP">£ KSH</option>
                            <option value="JPY">¥ KSH</option>
                            <option value="KES">KES Ksh</option>
                            <!-- Add more currency options as needed -->
                        </select>
                        <input class="mt-1 block py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-full ml-2" step=".1" min="0" max="100000000" type="number" placeholder="Enter Estimated Cost" value="{{$feeding->estimated_cost}}"  name="estimated_cost" id="feeding_cost" />
                    </div>
                </div>
            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1 mt-4 mb-4">
                    <label for="feeding_Feeding Date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Feeding Date</label>
                    <input class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="date" value="{{$feeding->feeding_date}}" name="feeding_date" id="feeding_date" />
                </div>
                <div class="col-span-1 mt-4 mb-4">
                    <label for="status" class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <div class="flex">
                        <div class="flex items-center mr-4">
                            <input id="completed" type="radio" value="completed" name="status" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="completed" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Completed
                            </label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="in_progress" type="radio" value="in_progress" name="status" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="in_progress" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                In Progress
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="pending" type="radio" value="pending" name="status" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="pending" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Pending
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4 mt-4">
                    <label for="feeding_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Feeding Time</label>
                    <input type="time" value="{{$feeding->feeding_time}}" id="feeding_time" name="feeding_time" class="mt-1 dark:text-gray-200 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4 mt-4">
                    <label for="feeder_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Feeder's Name</label>
                    <input type="text" id="feeder_name" value="{{$feeding->feeder_name}}" name="feeder_name" class="mt-1 block  dark:text-gray-200 w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="food_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type of Food</label>
                    <select id="food_type" name="food_type" class="mt-1 dark:text-gray-200 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Food Type</option>
                        <!-- Natural Food -->
                        <optgroup label="Natural Food">
                            <option value="Grass">Grass</option>
    <option value="Hay">Hay</option>
    <option value="Alfalfa">Alfalfa</option>
    <option value="Clover">Clover</option>
    <option value="Pasture">Pasture</option>
    <option value="Forage">Forage</option>
    <option value="Silage">Silage</option>
    <option value="Corn stalks">Corn stalks</option>
    <option value="Wheat straw">Wheat straw</option>
    <option value="Oat straw">Oat straw</option>
    <option value="Barley straw">Barley straw</option>
    <option value="Rye grass">Rye grass</option>
    <option value="Timothy hay">Timothy hay</option>
    <option value="Bermuda grass">Bermuda grass</option>
    <option value="Orchard grass">Orchard grass</option>
    <option value="Ryegrass">Ryegrass</option>
    <option value="Fescue">Fescue</option>
    <option value="Legumes">Legumes (e.g., peas, lentils)</option>
    <option value="Sorghum">Sorghum</option>
    <option value="Millet">Millet</option>
    <option value="Buckwheat">Buckwheat</option>
    <option value="Sunflower">Sunflower</option>
    <option value="Soybean">Soybean</option>
    <option value="Flaxseed">Flaxseed</option>
    <option value="Canola">Canola</option>
    <option value="Cottonseed">Cottonseed</option>
    <option value="Rice bran">Rice bran</option>
    <option value="Beet pulp">Beet pulp</option>
    <option value="Molasses">Molasses</option>
    <option value="Seaweed">Seaweed</option>
                            <!-- Add more natural food options here -->
                        </optgroup>
                        <!-- Processed Food -->
                        <optgroup label="Processed Food">
                            <option value="Pelleted feed">Pelleted feed</option>
                            <option value="Mixed grain feed">Mixed grain feed</option>
                            <option value="Complete feed">Complete feed</option>
                            <option value="Concentrate feed">Concentrate feed</option>
                            <option value="Cubed feed">Cubed feed</option>
                            <option value="Crumble feed">Crumble feed</option>
                            <option value="Liquid feed">Liquid feed</option>
                            <option value="Silage">Silage</option>
                            <option value="Haylage">Haylage</option>
                            <option value="Molasses blocks">Molasses blocks</option>
                            <option value="Protein blocks">Protein blocks</option>
                            <option value="Mineral blocks">Mineral blocks</option>
                            <option value="Salt blocks">Salt blocks</option>
                            <option value="Vitamin-enriched pellets">Vitamin-enriched pellets</option>
                            <option value="High-energy pellets">High-energy pellets</option>
                            <option value="High-protein pellets">High-protein pellets</option>
                            <option value="Pre-starter pellets">Pre-starter pellets</option>
                            <option value="Starter pellets">Starter pellets</option>
                            <option value="Grower pellets">Grower pellets</option>
                            <option value="Finisher pellets">Finisher pellets</option>
                            <option value="Layer pellets">Layer pellets</option>
                            <option value="Broiler pellets">Broiler pellets</option>
                            <option value="Fish meal pellets">Fish meal pellets</option>
                            <option value="Soybean meal pellets">Soybean meal pellets</option>
                            <option value="Alfalfa meal pellets">Alfalfa meal pellets</option>
                            <option value="Corn gluten meal pellets">Corn gluten meal pellets</option>
                            <option value="Enzyme-treated pellets">Enzyme-treated pellets</option>
                            <option value="Probiotic-treated pellets">Probiotic-treated pellets</option>
                            <option value="Organic pellets">Organic pellets</option>
                            <option value="Non-GMO pellets">Non-GMO pellets</option>
                            <!-- Add more processed food options here -->
                        </optgroup>
                        <!-- Special Food -->
                        <optgroup label="Special Food">
                            <option value="Medicinal feed additives">Medicinal feed additives</option>
                            <option value="Prebiotic supplements">Prebiotic supplements</option>
                            <option value="Probiotic supplements">Probiotic supplements</option>
                            <option value="Antibiotic supplements">Antibiotic supplements</option>
                            <option value="Hormonal supplements">Hormonal supplements</option>
                            <option value="Enzyme supplements">Enzyme supplements</option>
                            <option value="Vitamin supplements">Vitamin supplements</option>
                            <option value="Mineral supplements">Mineral supplements</option>
                            <option value="Electrolyte supplements">Electrolyte supplements</option>
                            <option value="Digestive health supplements">Digestive health supplements</option>
                            <option value="Immune system boosters">Immune system boosters</option>
                            <option value="Weight gain enhancers">Weight gain enhancers</option>
                            <option value="Milk replacers">Milk replacers</option>
                            <option value="Colostrum supplements">Colostrum supplements</option>
                            <option value="Omega-3 fatty acid supplements">Omega-3 fatty acid supplements</option>
                            <option value="Choline supplements">Choline supplements</option>
                            <option value="Calcium supplements">Calcium supplements</option>
                            <option value="Phosphorus supplements">Phosphorus supplements</option>
                            <option value="Magnesium supplements">Magnesium supplements</option>
                            <option value="Zinc supplements">Zinc supplements</option>
                            <option value="Selenium supplements">Selenium supplements</option>
                            <option value="Copper supplements">Copper supplements</option>
                            <option value="Iron supplements">Iron supplements</option>
                            <option value="Manganese supplements">Manganese supplements</option>
                            <option value="Cobalt supplements">Cobalt supplements</option>
                            <option value="Iodine supplements">Iodine supplements</option>
                            <option value="Biotin supplements">Biotin supplements</option>
                            <option value="Folic acid supplements">Folic acid supplements</option>
                            <option value="Vitamin E supplements">Vitamin E supplements</option>
                            <option value="Vitamin D supplements">Vitamin D supplements</option>
                        </optgroup>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="feeding_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Feeding Method</label>
                    <select class="mt-1 block w-full py-2 px-3 dark:text-gray-200 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$feeding->feeding_method}}" name="feeding_method" id="feeding_method">
                        <option value="" label=" "></option>
                        <option value="hand-feeding">Hand Feeding</option>
                        <option value="automated-feeder">Automated Feeder</option>
                        <option value="other">Other</option>
                        <!-- Add more feeding method options as needed -->
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="col-span-1 mt-4 mb-4">
                    <label for="feeding_Details/Notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Details/Notes</label>
                    <textarea rows="3" class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:text-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm placeholder="Enter Details/Notes" value="{{$feeding->feeding_description}}"  name="feeding_description" id="feeding_description"></textarea>
                </div>
            </div>
            <hr class="mt-4">

            <div class="flex justify-end mt-6">
                <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100 tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    <a href="{{ route('Feed.showfeeding',['animal_id' => $animal->id]) }}" class="btn btn-gray-500">Cancel</a>
                </button>
                <button type="submit" name="action" value="save" class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    Save
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

   {{--}} <script>
        CKEDITOR.replace('feeding_description');
    </script>--}}
</x-app-layout>
