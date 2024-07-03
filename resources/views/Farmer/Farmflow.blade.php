<x-app-layout title="Animal Management">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="bg-gray-100 font-serif dark:bg-gray-900 min-h-screen">
        <div class="container font-serif mx-auto px-4 py-8">
            <!-- Header -->
            <header class="mb-8">

                <a class="hover:text-yellow-300 font-bold text-gray-800  dark:text-gray-200  flex items-center mb-4 justify-center" href="{{ route('index') }}">
                    <i class="fas fa-paw text-2xl mr-2"></i> Animal Management
                </a>
                <div class="flex justify-between dark:text-gray-200 items-center">
                    <div class="space-x-2">
                        <a href="{{ route('Next') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Add Group
                        </a>
                    </div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="btn btn-outline">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-10">
                            <li><a href="{{ route('animals.import') }}" class="dropdown-item"><i class="fas fa-file-import mr-2"></i>Imports Records</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fas fa-file-upload mr-2"></i>Bulk Update from File</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fas fa-file-download mr-2"></i>Download Records</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fas fa-file-download mr-2"></i>Download All Records</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fas fa-print mr-2"></i>Print</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Animals</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $recordCount }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        100% of <a href="{{ route('Farmflow') }}" class="text-blue-500">{{ $recordCount }}</a>
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Type</h3>
                    <p class="text-3xl font-bold text-blue-600">
                        <a href="{{ route('Farmflow') }}" class="text-blue-500">{{ $recordCount }}</a>
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        100% of {{ $recordCount }}
                    </p>
                </div>
            </div>

            <!-- Animal Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Animals</h2>
                    <div x-data="{ showSold: false }">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" x-model="showSold">
                            <span class="ml-2 dark:text-gray-100">Show sold animals</span>
                        </label>
                    </div>
                </div>
                <table class="w-full">
                    <thead class="bg-blue-500 dark:bg-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Animal</th>
                            <th class="py-3 px-4 text-left">Gender</th>
                            <th class="py-3 px-4 text-left">Breed</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left">Created At</th>
                            <th class="py-3 px-4 text-left">Internal ID</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($animalsData as $animalData)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" x-show="showSold || '{{ $animalData->status }}' !== 'Sold'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-lg font-bold">
                                        {{ substr($animalData->name, 0, 1) }}
                                    </div>
                                    <a href="#" class="ml-2 font-medium text-gray-900 dark:text-gray-100 {{ $animalData->status === 'Sold' ? 'line-through text-gray-500 dark:text-gray-500' : '' }}">{{ $animalData->name }}</a>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-gray-800 dark:text-gray-300">{{ $animalData->gender }}</td>
                            <td class="py-3 px-4 text-gray-800 dark:text-gray-300">{{ $animalData->breed }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $animalData->status === 'Sold' ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100' : 'bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-100' }}">
                                    {{ $animalData->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-gray-800 dark:text-gray-300">{{ $animalData->created_at->format('Y-m-d') }}</td>
                            <td class="py-3 px-4 text-gray-800 dark:text-gray-300">{{ $animalData->internal_id }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $animalsData->links() }}
            </div>

            <!-- No Animals Message (Hidden by default) -->
            <div id="noAnimals" class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center" style="display: none;">
                <i class="fas fa-tag text-4xl text-gray-400 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">No animals yet?</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Add a new animal and they'll show up here.</p>
                <p class="text-gray-800 dark:text-gray-300">
                    <strong>Need help getting started?</strong>
                    Check out this <a href="https://help.farmbrite.com/help/getting-started-with-livestock" class="text-blue-600 hover:underline dark:text-blue-400">livestock getting started guide</a>.
                </p>
            </div>
        </div>
    </div>

    <style>
        .btn {
            @apply px-4 py-2 rounded-md text-sm font-medium transition-colors duration-150;
        }
        .btn-primary {
            @apply bg-green-500 text-white hover:bg-green-600;
        }
        .btn-outline {
            @apply border border-gray-300 text-gray-700 dark:border-gray-600 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700;
        }
        .dropdown-item {
            @apply block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700;
        }
    </style>


</x-app-layout>
