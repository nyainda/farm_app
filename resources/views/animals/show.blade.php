<!-- resources/views/animals/show.blade.php -->
<x-app-layout title="Animals with {{ ucfirst($status) }} Vaccination">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl text-center font-bold dark:text-gray-200 text-gray-800 mb-8"> {{ ucfirst($status) }} Animals</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($animals as $animal)
                <div class="bg-white dark:bg-gray-800  font-serif dark:text-gray-200 overflow-hidden shadow-lg rounded-lg p-4 transition duration-300 transform hover:scale-105">

                    <a href="{{ route('index') }}">
                        <h2 class="text-xl hover:text-blue-800 capitalize lowercase font-serif dark:hover:text-blue-800 font-semibold dark:text-gray-200 text-gray-800">{{ $animal->name }}</h2>
                    </a>
                    <div class="text-sm font-serif lowercase capitalize text-gray-500 mt-2">
                        <p><span class="font-semibold ml-2">Reference ID:</span> {{ $animal->internal_id }}</p>
                        <p><span class="font-semibold ml-2">Birth Weight:</span> {{ $animal->weight }}kg</p>
                        <p><span class="font-semibold ml-2">Breed:</span> {{ $animal->breed }}</p>
                        <p><span class="font-semibold ml-2">Status:</span> {{ $animal->status }}</p>
                        <p><span class="font-semibold ml-2">raised_purchased:</span> {{ $animal->raised_purchased }}</p>
                    </div>
                    <div class="mt-4 font-serif">
                        @foreach ($animal->health as $health)
                            <div class="text-sm">
                                <p>
                                    <span class="font-semibold underline text-gray-500">Vaccination Status:</span>
                                    <span class="{{ $health->vaccination_status === 'Complete' ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $health->vaccination_status }}
                                    </span>
                                </p>
                                <p class="mt-1  ml-2">Dosage: {{ $health->dosage  ?: 'not available'}}</p>
                                <p class="mt-1 ml-2">Administered_by: {{ $health->administered_by }}</p>
                                <p class="mt-1 ml-2">vaccine_name: {{ $health->vaccine_name }}</p>
                                <p class="mt-1 ml-2">Date Administered: {{ $health->date_administered }}</p>
                                <p class="mt-1 ml-2">Amount_Cost: ${{ $health->dietary_restrictions }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>






