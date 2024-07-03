<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="container mx-auto mt-8 p-4 mb-4 dark:bg-gray-800 dark:rounded-lg font-serif bg-white rounded-lg shadow-lg">

        <h1 class="text-4xl font-bold mb-6 dark:text-gray-200 text-center">
            <a class="hover:text-yellow-300 flex items-center justify-center" href="{{ route('index') }}">
                <i class="fas fa-paw text-2xl mr-2"></i> Health of Animals
            </a>
        <div class="overflow-x-auto">
            <div class="min-w-full">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th class="border-r px-4 py-3">Animal</th>
                            <th class="border-r px-4 py-3">Ani_ID</th>
                            <th class="border-r px-4 py-3">Status</th>
                            <th class="px-4 text-center py-3">healths</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($animals as $animal)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->name }}{{$animal->purchasePrice}}</td>
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->internal_id }}</td>
                            <td class="whitespace-nowrap px-4 py-3 dark-border-neutral-500">{{ $animal->status }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if (isset($animalHealths[$animal->id]))
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th class="border-r px-4 py-2">Vac_status </th>
                                                <th class="border-r px-4 py-2">administered </th>
                                                <th class="border-r px-4 py-2">regular_medic</th>
                                                <th class="border-r px-4 py-2">vet_visit</th>
                                                <th class="border-r px-4 py-2">insurance</th>
                                                <th class="border-r px-4 py-2">parasite</th>
                                                <th class="border-r px-4 py-2">exe_req</th>
                                                <th class="border-r px-4 py-2">vac_name</th>
                                                <th class="border-r px-4 py-2">dosage</th>
                                                <th class="border-r px-4 py-2">Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($animalHealths[$animal->id] as $health)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500">{{ $health->vaccination_status ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->date_administered?: 'N/A' }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->regular_medication ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->last_vet_visit?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->insurance_details?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->parasite_prevention ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->exercise_requirements?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->vaccine_name ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{ $health->dosage ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2">

                                                    @if ($animal->status !== 'Solid')
                                                    <a href="{{ route('Health.healthedit', ['animal_id' => $animal->id, 'health_id' => $health->id]) }}" class="text-blue-600 hover:underline mr-2 print-hidden">Edit</a>
                                                @else
                                                    <span class="text-red-500">Cannot be edited</span>
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else

                                <p class="text-gray-500 dark:text-gray-400 text-center">No healths recorded for this animal.</p>


                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $animals->links() }}
            </div>
        </div>
    </div>











</x-app-layout>

