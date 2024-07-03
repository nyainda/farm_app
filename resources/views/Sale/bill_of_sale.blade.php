<x-app-layout title="Bill of Sale">
    <div class="min-h-screen bg-gray-100 font-serif dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="p-10 mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-8">
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Bill of Sale
                        </h1>
                        <span class="text-lg text-gray-600 dark:text-gray-400">#{{ $billOfSaleId }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Seller Information -->
                        <div class="space-y-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white border-b pb-2">Seller</h2>
                            <div>
                                <label for="seller_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="seller_name" id="seller_name" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="text" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                                <input type="text" name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="seller_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <input type="text" name="seller_address" id="seller_address" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                        </div>

                        <!-- Buyer Information -->
                        <div class="space-y-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white border-b pb-2">Buyer</h2>
                            <div>
                                <label for="buyer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="buyer_name" id="buyer_name" value="{{ $soldTo }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="buyer_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="text" name="buyer_email" id="buyer_email" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="buyer_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                                <input type="text" name="buyer_city" id="buyer_city" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="buyer_phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                                <input type="text" name="buyer_phone_number" id="buyer_phone_number" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            <div>
                                <label for="buyer_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                <input type="text" name="buyer_address" id="buyer_address" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Livestock Information -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white border-b mb-4 mt-4 pb-2">Livestock Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col">
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Name</span>
                                <span class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $animal->name }}</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col">
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">ID</span>
                                <span class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $animal->internal_id }}</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col">
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Status</span>
                                <span class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $animal->raised_purchased }}</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col">
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Weight</span>
                                <span class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $animal->weight }} kg</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col">
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Breed</span>
                                <span class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $animal->breed }}</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col">
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Electronic ID</span>
                                <span class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $animal->electronic_id ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col md:col-span-2">
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Type</span>
                                <span class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $animal->type }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sale Price -->
                    <div class="mt-10">
                        <label for="sale_price" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Sale Price</label>
                        <div class="mt-2 relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-lg">$</span>
                            </div>
                            <input type="text" name="sale_price" id="sale_price" value="{{ $salePrice }}" class="block w-full rounded-md border-0 py-3 pl-10 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 dark:bg-gray-700 dark:text-white dark:ring-gray-600 sm:text-lg sm:leading-6" readonly>
                        </div>
                    </div>

                    <!-- Signatures -->
                    <div class="col-span-full mt-8">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white border-b pb-2 mb-6">Signatures</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="seller_signature" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seller's Signature</label>
                                <div class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm h-20 bg-white dark:bg-gray-600"></div>
                            </div>
                            <div>
                                <label for="buyer_signature" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buyer's Signature</label>
                                <div class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm h-20 bg-white dark:bg-gray-600"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Print Button -->
                    <div class="fixed bottom-6 right-6">
                        <button onclick="printBillOfSale()" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-full p-3 shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printBillOfSale() {
            window.print();
        }
    </script>
</x-app-layout>
