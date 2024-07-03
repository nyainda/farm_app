
<x-app-layout title="Animal Treatments">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <div class="bg-gray-200 dark:bg-gray-700 mt-2  ml-2 mr-2 border border-gray-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <nav class="flex font-serif " aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
              <li class="inline-flex items-center">
                <a href="{{route("index")}}" class="inline-flex dark:text-gray-200 items-center text-sm font-medium text-gray-700 hover:text-blue-600  dark:hover:text-white">
                  <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                  </svg>
                  Animal
                </a>
              </li>
              <li>
                <div class="flex items-center">
                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
                  <a href="" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{$animal->name}}</a>
                </div>
              </li>
              <li aria-current="page">
                <div class="flex items-center">
                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
                  <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">suppliers</span>
                </div>
              </li>
            </ol>
          </nav>
        </div>
        @if(session('success'))
        <div
          class="font-regular relative mt-4 mx-auto block w-full max-w-screen-md rounded-lg bg-green-500 px-4 py-4 text-base text-white"
          data-dismissible="alert"
          data-dismissible-id="success-message"
        >
          <div class="absolute top-4 left-4">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              aria-hidden="true"
              class="mt-px h-6 w-6"
            >
              <path
                fill-rule="evenodd"
                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </div>
          <div class="ml-8 mr-12">
            <h5 class="block font-sans text-xl font-semibold leading-snug tracking-normal text-white antialiased">
              Success
            </h5>
            <p class="mt-2 block font-sans text-base font-normal leading-relaxed text-white antialiased">
              {{ session('success') }}
            </p>
          </div>
          <div
            data-dismissible-target="alert"
            data-ripple-dark="true"
            class="absolute top-3 right-3 w-max rounded-lg transition-all hover:bg-white hover:bg-opacity-20"
          >
            <div role="button" class="w-max rounded-lg p-1">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                ></path>
              </svg>
            </div>
          </div>
        </div>
    @endif
    <div class="container mx-auto p-6 space-y-6">
        <div class="flex font-serif items-center space-x-4">
            <div class="w-12 h-12 md:w-10 md:h-10 lg:w-12 lg:h-12 dark:text-gray-100 font-serif rounded-full bg-gradient-to-br from-blue-500 to-purple-500 text-white flex items-center justify-center text-2xl font-bold">
                {{ substr($animal->name, 0, 1) }}
            </div>
            <!-- Name and Status as clickable link -->
            <div class="ml-4 flex flex-col">
                <a href="{{ route('index') }}" class="text-2xl font-serif font-semibold text-gray-800 hover:text-blue-500 transition duration-300">{{ $animal->name }}</a>
                <div class="flex">
                    <p class="text-sm text-blue-500">{{ $animal->type }}</p>
                    <p class="text-sm ml-4 text-blue-500">Id: {{ $animal->internal_id }}</p>
                    <p class="text-sm ml-4 text-blue-500">By:{{$user->name}}</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <a
                    href="{{ route('Supplier.supplier', ['animal_id' => $animal->id]) }}"
                    class="px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold transition duration-300 ease-in-out flex items-center"
                    data-remote="true"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    New Supplier Record
                </a>

                <button
                    type="button"
                    onclick="batchDelete()"
                    class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold transition duration-300 ease-in-out flex items-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Delete Selected
                </button>
            </div>
        </div>

        @if (count($suppliers) > 0)

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
       {{--}} <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <div class="mb-4 flex flex-col font-serif sm:flex-row justify-between items-center">
                <div class="mb-2 sm:mb-0">
                    <a class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300 ease-in-out" data-remote="true" href="{{ route('animals.feeding', ['animal_id' => $animal->id]) }}">New Feeding Record</a>
                </div>
                <div class="sm:ml-2">
                    <button id="printButton" class="btn btn-default hidden sm:inline-block" title="Print">
                        <i class="fas fa-print" aria-hidden="true"></i> Print
                    </button>
                </div>
            </div>
        </caption>--}}
        <thead class="text-xs font-serif text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <label class="inline-flex items-center">
                        <input
                            type="checkbox"
                            onclick="toggleCheckboxes(this)"
                            class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        />
                    </label>
                </th>
               {{--<th scope="col" class="px-6 py-3">
                   email
                </th>--}}
                <th scope="col" class="px-6 py-3">
                    name
                </th>
                <th scope="col" class="px-6 py-3">
                    delivery_options
                </th>
                <th scope="col" class="px-6 py-3">
                    product_type
                </th>

                  <th scope="col" class="px-6 py-3">
                    type
                  </th>
                  <th scope="col" class="px-6 py-3">
                    shop/company
                  </th>
                  <th scope="col" class="px-6 py-3">
                    serial_number
                  </th>



                <th scope="col" class="px-6 py-3">
                    Action
                </th>

            </tr>

        </thead>
        <tbody>


            @foreach ($suppliers as $supplier)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                    <input
                        type="checkbox"
                        class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        name="supplier_ids[]"
                        value="{{ $supplier->id }}"
                    />
                </td>
             {{--  <th scope="row" class="px-6 py-4 font-medium font-serif text-gray-900 dark:text-white">
                    <div class="truncate max-w-xs">
                        {{$supplier->email ?: 'N/A'}}
                    </div>
                </th>--}}


                <td class="px-6 font-serif py-4">

                    {{$supplier->name?: 'N/A'}}

                </td>
                <td class="px-6 font-serif py-4">
                    {{$supplier->delivery_options ?: 'N/A'}}



                </td>

                <td class="px-6 font-serif py-4">

                    {{$supplier->product_type?: 'N/A'}}
                </td>


                <td class="px-6 font-serif py-4">
                    @if($supplier->type == 1)
                        {{ 'Distributor' }}
                    @elseif($supplier->type == 2)
                        {{ 'Whole Seller' }}
                    @elseif($supplier->type == 3)
                        {{ 'Brochure' }}
                    @elseif($supplier->type == 4)
                        {{ 'Manufacturer' }}
                    @elseif($supplier->type == 5)
                        {{ 'Importer' }}
                    @elseif($supplier->type == 6)
                        {{ 'Exporter' }}
                    @elseif($supplier->type == 7)
                        {{ 'Retailer' }}
                    @elseif($supplier->type == 8)
                        {{ 'Agent' }}
                    @else
                        {{ 'None' }}
                    @endif
                </td>

                <td class="px-6 font-serif py-4">
                    {{$supplier->shop_name?: 'N/A'}}

                </td>
                <td class="px-6 font-serif py-4">
                    {{$supplier->identifier?: 'N/A'}}

                </td>

                <td class="px-6 font-serif py-4">
                    <a href="{{ route('Supplier.Supplieredit', ['animal_id' => $animal->id, 'supplier_id' => $supplier->id]) }}" class="inline-flex items-center px-1 py-1 bg-green-100 text-green-800 rounded-md hover:bg-green-200 transition duration-300 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('Supplier.delete', ['animal_id' => $animal->id, 'supplier_id' => $supplier->id]) }}" class="inline-flex items-center px-1 py-1 bg-red-100 text-red-800 rounded-md hover:bg-red-200 transition duration-300 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800 ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </a>
                </td>

            </tr>


            @endforeach
        </tbody>
    </table>
    {{ $suppliers->links() }}
</div>

        @else
        <div id="animals" class="p-4  mx-8">
            <div class="content-wrapper font-serif dark:bg-gray-700 nothing mt-4 bg-gray-100 rounded-md p-4">
                <div class="text-muted dark:text-gray-200 text-center text-4xl">
                    <i class="far fas fa-tag" aria-hidden="true"></i>
                </div>
                <div class="text-center font-serif dark:text-gray-200  text-gray-900 text-xl font-semibold mt-4">
                    No new suppliers  yet?
                </div>
                <div class="text-center dark:text-gray-200 font-serif text-gray-600 mt-2">
                    Add a new suppliers and they'll show up here.
                </div>

            </div>
        </div>
        @endif
    </div>

    <p class="mb-4 text-gray-600 font-serif text-center dark:text-gray-400"> Displaying all <span class="text-red-500 font-serif ">{{ count($suppliers) }}</span> records</p>
</x-app-layout>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const printButton = document.getElementById("printButton");

        printButton.addEventListener("click", function () {
            // Hide elements with the 'print-hidden' class when printing
            const hiddenElements = document.querySelectorAll(".print-hidden");
            hiddenElements.forEach(function (element) {
                element.style.display = "none";
            });

            // Trigger the browser's print functionality
            window.print();

            // Restore the display property for hidden elements after printing
            hiddenElements.forEach(function (element) {
                element.style.display = "";
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the success message element
        var successMessage = document.querySelector('[data-dismissible-id="success-message"]');

        // If the success message element exists, add a click event listener to dismiss it
        if (successMessage) {
            successMessage.addEventListener('click', function() {
                successMessage.style.display = 'none';
            });
        }
    });
</script>



{{--<livewire:calendar />--}}
<script>
    function batchDelete() {
        var checkboxes = document.querySelectorAll('input[name="supplier_ids[]"]:checked');

        // Check if at least one checkbox is checked
        if (checkboxes.length === 0) {
            alert("Please select at least one batch to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected items?")) {
            var selectedIds = [];

            // Extract ids of selected feedings
            checkboxes.forEach(function(checkbox) {
                selectedIds.push(checkbox.value);
            });

            // Prepare form for batch delete
            var form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', '{{ route("suppliers.batchDelete") }}');
            form.innerHTML = '@csrf @method("DELETE")' +
                '<input type="hidden" name="selected_ids" value="' + selectedIds.join(',') + '">';

            // Append form to body and submit it
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
<script>
    function toggleCheckboxes(checkbox) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(cb) {
            cb.checked = checkbox.checked;
        });
    }
    </script>
