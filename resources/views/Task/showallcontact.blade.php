<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="container mx-auto mt-8 p-4 mb-4 dark:bg-gray-800 dark:rounded-lg font-serif bg-white rounded-lg shadow-lg">

       <h1 class="text-4xl font-bold mb-6 dark:text-gray-200 text-center">
        <a class="hover:text-yellow-300 flex items-center justify-center" href="{{ route('index') }}">
            <i class="fas fa-paw text-2xl mr-2"></i> Contacts
        </a>
        <div class="overflow-x-auto">
            <div class="min-w-full">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th class="border-r px-4 py-3">Animal</th>
                            <th class="border-r px-4 py-3">Animal_ID</th>
                            <th class="border-r px-4 py-3">Status</th>
                            <th class="px-4 text-xs  text-center py-3">Contacts </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($animals as $animal)

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            {{--<td class="whitespace-nowrap border-r px-4 py-3 font-medium dark:border-neutral-500">{{ $loop->index + 1 }}</td>--}}
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->name }}</td>
                            <td class="whitespace-nowrap border-r px-4 py-3 dark:border-neutral-500">{{ $animal->internal_id }}</td>
                            <td class="whitespace-nowrap px-4 py-3 dark-border-neutral-500">{{ $animal->status }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if (isset($animalcontacts[$animal->id]))
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th class="border-r px-4 py-2"> county </th>
                                                <th class="border-r px-4 py-2">F_name</th>

                                                <th class="border-r px-4 py-2"> L_name</th>
                                                <th class="border-r px-4 py-2"> city</th>
                                                <th class="border-r px-4 py-2">Cont_type</th>
                                                <th class="border-r px-4 py-2">Email</th>
                                                <th class="border-r px-4 py-2">Country </th>
                                                <th class="border-r px-4 py-2"> phone</th>
                                                <th class="border-r px-4 py-2"> Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($animalcontacts[$animal->id] as $contact)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500"> {{ $contact->county ?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500"> {{ $contact->first_name ?: 'N/A' }}</td>

                                               <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{$contact->last_name?: 'N/A'}}</td>
                                               <td class="whitespace-nowrap px-4 py-2 dark:border-neutral-500"> {{ $contact->city?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500"> {{ $contact->contact_type?: 'N/A' }}</td>
                                                <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{$contact->email?: 'N/A'}}</td>
                                               <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{$contact->country?: 'N/A'}}</td>
                                               <td class="whitespace-nowrap px-4 py-2 dark-border-neutral-500">{{$contact->mobile_phone?: 'N/A'}}</td>
                                                <td class="whitespace-nowrap px-4 py-2">

                                                    @if ($animal->status !== 'Solid')
                                                    <a href="{{ route('Contacts.contactedit', ['animal_id' => $animal->id, 'contact_id' => $contact->id]) }}" class="text-blue-600 hover:underline mr-2 print-hidden">Edit</a>
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
                                <p class="text-gray-500 dark:text-gray-400 text-center">No Contact Records for this animal.</p>


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
    <div class="mb-4 text-center text-gray-600 font-serif dark:text-gray-400">
        <p class="mb-2">Created By:
            <span class="text-red-500 font-bold capitalize">{{$user->name}}</span>
        </p>
    </div>













</x-app-layout>

