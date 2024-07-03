<x-app-layout title="Record Sale">
    <div class="min-h-screen bg-white font-serif dark:bg-gray-800">
        <div class="p-10 mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden">
                <div class="px-6 py-8 bg-gray-700 dark:bg-gray-700">
                    <h1 class="text-3xl font-extrabold text-white text-center">Record Sale </h1>
                </div>

                @if($errors->hasBag('requiredFields'))
                    <div class="bg-red-50 dark:bg-red-900/50 border-l-4 border-red-500 p-4 m-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Required fields are missing:</h3>
                                <ul class="mt-1 list-disc list-inside text-xs text-red-700 dark:text-red-300">
                                    @foreach($errors->requiredFields->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('Sale.storebill', ['animal_id' => $animal->id]) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8">
                    @csrf
                    <div class="space-y-8">
                        <!-- Sale Information -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-5">Sale Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="bill_of_sale_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bill of Sale #</label>
                                    <input type="text" name="bill_of_sale_id" id="bill_of_sale_id" value="#{{ $billOfSaleId }}" class="mt-1 block w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                                </div>

                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Sale</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <!-- Buyer Information -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-5">Buyer Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="sold_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" placeholder="Enter Name" name="sold_to" id="sold_to" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>

                                <div>
                                    <label for="buyer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                                    <input type="tel" name="buyer_phone" placeholder="Enter phone number {0723...}" id="buyer_phone" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="buyer_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                <input type="email" name="buyer_email" placeholder="Enter Email {oyugi@gmail.com}" id="buyer_email" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="buyer_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mailing Address</label>
                                    <textarea name="buyer_address" id="buyer_address" rows="3" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-5">Animal Details</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="animal_age" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Animal-id</label>
                                    <input type="text" name="animal_age" value="{{$animal->internal_id}}" id="animal_age" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                                </div>

                                <div>
                                    <label for="animal_sex" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sex</label>
                                    <input type="text" name="animal_sex" id="animal_sex" value="{{ $animal->gender }}" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                                </div>

                                <div>
                                    <label for="electronic_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Electronic_ID</label>
                                    <input type="text" name="electronic_id" value="{{$animal->electronic_id ?? 'N/A'}}" id="microchip_id" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                                </div>
                                <div>
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birth_Date</label>
                                    <input type="text" name="birth_date" value="{{$animal->birth_date ?? 'N/A'}}" id="microchip_id" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                                </div>

                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Weight</label>
                                    <input type="text" name="weight" value="{{ $animal->weight ?? 'N/A' }}" id="microchip_id" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                                </div>

                                <div>
                                    <label for="breed" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Breed</label>
                                    <input type="text" name="breed" value="{{$animal->breed}}" id="microchip_id" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-6 mb-5">Transaction Details</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="sale_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Sale Price</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="text" name="sale_price" id="sale_price" placeholder="0.00" class="block w-full pl-7 pr-12 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                </div>



                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="mt-1 block w-full pl-3 pr-10 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select a method</option>
                                        <option value="cash">Cash</option>
                                        <option value="check">Check</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="wire_transfer">Wire Transfer</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="microchip_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Microchip ID</label>
                                    <input type="text" name="microchip_id" id="microchip_id" placeholder="Enter microchip ID (if applicable)" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="registration_papers" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Registration Papers</label>
                                    <select name="registration_papers" id="registration_papers" class="mt-1 block w-full pl-3 pr-10 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select status</option>
                                        <option value="transferred">Transferred</option>
                                        <option value="retained">Retained</option>
                                        <option value="not_applicable">Not Applicable</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="keyword" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keywords</label>
                                    <input type="text" name="keyword" id="keyword" placeholder="E.g., auction, private sale (comma-separated)" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="descriptions" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Additional Notes</label>
                                    <textarea name="descriptions" id="descriptions" rows="4" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Any additional information about the sale..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <a href="{{ route('index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Record Sale
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

