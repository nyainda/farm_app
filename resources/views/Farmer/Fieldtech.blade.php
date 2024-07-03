<x-app-layout title="Cards">
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Cards
        </h2>

        <!-- Big section cards -->
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Big section cards
        </h4>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Large, full width sections goes here
            </p>
        </div>

        <!-- Responsive cards -->
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Responsive cards
        </h4>
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total clients
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        6389
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Account balance
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        $ 46,760.89
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        New sales
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        376
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Pending contacts
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        35
                    </p>
                </div>
            </div>
        </div>

        <!-- Cards with title -->
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Cards with title
        </h4>
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Revenue
                </h4>
                <p class="text-gray-600 dark:text-gray-400">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Fuga, cum commodi a omnis numquam quod? Totam exercitationem
                    quos hic ipsam at qui cum numquam, sed amet ratione! Ratione,
                    nihil dolorum.
                </p>
            </div>
            <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                <h4 class="mb-4 font-semibold">
                    Colored card
                </h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Fuga, cum commodi a omnis numquam quod? Totam exercitationem
                    quos hic ipsam at qui cum numquam, sed amet ratione! Ratione,
                    nihil dolorum.
                </p>
            </div>
        </div>
    </div>

</x-app-layout>






<form class="space-y-4 grid grid-cols-1 md:grid-cols-2 gap-4" id="new_contact" action="/contacts" accept-charset="UTF-8" method="post">

    <div class="flex flex-col">
        <label for="contact_first_name" class="dark:text-gray-200 mb-2">First name</label>
        <input class="w-full border dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="contact[first_name]" id="contact_first_name">
    </div>

    <div class="flex flex-col">
        <label for="contact_last_name" class="dark:text-gray-200 mb-2">Last name</label>
        <input class="w-full border border-gray-300 dark:bg-gray-800 dark:text-gray-200 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="contact[last_name]" id="contact_last_name">
    </div>

    <div class="flex flex-col">
        <label for="contact_email" class="dark:text-gray-200 mb-2">Email</label>
        <input class="w-full border border-gray-300 rounded-md p-2 dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="contact[email]" id="contact_email">
    </div>

    <div class="flex flex-col">
        <label for="contact_type" class="dark:text-gray-200 mb-2">Contact type</label>
        <select class="w-full border border-gray-300 rounded-md p-2 dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring focus:ring-blue-300" name="contact[type]" id="contact_type">
            <option value="" label=" "></option>
            <option value="Auditor">Auditor</option>
            <!-- ... (other options) ... -->
        </select>
    </div>

    <div class="flex flex-col">
        <label for="contact_label" class="dark:text-gray-200 mb-2">Keywords</label>
        <input class="w-full border border-gray-300 dark:bg-gray-800 dark:text-gray-200 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" placeholder="example: Vet, mechanic, etc" type="text" name="contact[label]" id="contact_label">
    </div>

    <div class="flex flex-col">
        <label for="contact_phone" class="dark:text-gray-200 mb-2">Primary Phone</label>
        <input class="w-full border border-gray-300 dark:bg-gray-800 dark:text-gray-200 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="contact[phone]" id="contact_phone">
    </div>

    <div class="flex flex-col">
        <label for="contact_cell" class="dark:text-gray-200 mb-2">Mobile Phone</label>
        <input class="w-full border border-gray-300 dark:bg-gray-800 dark:text-gray-200 rounded-md p-2 focus:outline-none focus:ring focus:ring-blue-300" type="text" name="contact[cell]" id="contact_cell">
    </div>

    <!-- ... (similar structure for other input fields) ... -->

    <hr class="col-span-full">

    <div class="flex flex-col md:flex-row items-center md:items-end justify-end mt-6">
        <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100 tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
            <a href="{{ route('index') }}" class="btn btn-gray-500">Cancel</a>
        </button>
        <button type="submit" name="action" value="save" class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
            Save
        </button>
    </div>
</form>
</div>
</div>
<!-- component -->
<div class="min-h-screen flex items-center justify-center">
    <div class="relative group">
      <button id="dropdown-button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
        <span class="mr-2">Open Dropdown</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
      <div id="dropdown-menu" class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1">
        <!-- Search input -->
        <input id="search-input" class="block w-full px-4 py-2 text-gray-800 border rounded-md  border-gray-300 focus:outline-none" type="text" placeholder="Search items" autocomplete="off">
        <!-- Dropdown content goes here -->
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Uppercase</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Lowercase</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Camel Case</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Kebab Case</a>
      </div>
    </div>
  </div>
  <script>
  // JavaScript to toggle the dropdown
      const dropdownButton = document.getElementById('dropdown-button');
      const dropdownMenu = document.getElementById('dropdown-menu');
      const searchInput = document.getElementById('search-input');
      let isOpen = false; // Set to true to open the dropdown by default

      // Function to toggle the dropdown state
      function toggleDropdown() {
        isOpen = !isOpen;
        dropdownMenu.classList.toggle('hidden', !isOpen);
      }

      // Set initial state
      toggleDropdown();

      dropdownButton.addEventListener('click', () => {
        toggleDropdown();
      });

      // Add event listener to filter items based on input
      searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();
        const items = dropdownMenu.querySelectorAll('a');

        items.forEach((item) => {
          const text = item.textContent.toLowerCase();
          if (text.includes(searchTerm)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
  </script>




