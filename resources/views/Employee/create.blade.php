
<x-app-layout title="Cards">


    <div class="container mx-auto font-serif mt-8 p-4 bg-white dark:bg-gray-700 dark:rounded-lg dark:shadow-lg">
        <h1 class="text-2xl dark:text-gray-200 font-semibold mb-4">Create Employee</h1>
        <hr class="mb-4">

                        <!-- form start -->
                        <form role="form" action="{{ route('Employee.storeemployee', ['animal_id' => $animal->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-4">
                                    <label class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Name</label>
                                    <input type="text" class="w-full border dark:text-gray-200 dark:bg-gray-700 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                </div>
                                <div class="mb-4">
                                    <label class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Email</label>
                                    <input type="email" class="w-full border dark:text-gray-200 dark:bg-gray-700 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                </div>

                                <div class="mb-4">
                                    <label class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Phone</label>
                                    <input type="text" class="w-full dark:text-gray-200 dark:bg-gray-700  border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone">
                                </div>
                                <div class="mb-4">
                                    <label class="block  dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Role</label>
                                    <select name="role" class="w-full border dark:text-gray-200 dark:bg-gray-700 dark:text-gray-200  rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                                        <option value="employee">Employee</option>
                                        <option value="manager">Manager</option>
                                        <option value="admin">Admin</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="assistant">Assistant</option>
                                        <option value="analyst">Analyst</option>
                                        <option value="animal caregiver">Animal Caregiver</option>
<option value="herd manager">Herd Manager</option>
<option value="pasture supervisor">Pasture Supervisor</option>
<option value="feed manager">Feed Manager</option>
<option value="breeding specialist">Breeding Specialist</option>
<option value="health technician">Health Technician</option>
<option value="veterinary assistant">Veterinary Assistant</option>
<option value="milker">Milker</option>
<option value="farrier">Farrier</option>
<option value="livestock handler">Livestock Handler</option>
<option value="animal nutritionist">Animal Nutritionist</option>
<option value="farm supervisor">Farm Supervisor</option>
<option value="farm manager">Farm Manager</option>
<option value="livestock inspector">Livestock Inspector</option>
<option value="animal behaviorist">Animal Behaviorist</option>
<option value="farm educator">Farm Educator</option>
<option value="animal welfare officer">Animal Welfare Officer</option>
<!-- Add more roles as needed -->

                                        <!-- Add more roles as needed -->
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block dark:text-gray-200  text-gray-700 text-sm font-bold mb-2">Address</label>
                                    <input type="text" class="w-full dark:text-gray-200 dark:bg-gray-700 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="address" value="{{ old('address') }}" placeholder="Enter Address">
                                </div>
                                <div class="mb-4">
                                    <label class="block  dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">City</label>
                                    <input type="text" class="w-full dark:text-gray-200 dark:bg-gray-700 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="city" value="{{ old('city') }}" placeholder="Enter City">
                                </div>
                                <div class="mb-4">
                                    <label class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Salary</label>
                                    <input type="text" class="w-full dark:text-gray-200 dark:bg-gray-700 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="salary" value="{{ old('salary') }}" placeholder="Enter salary">
                                </div>
                                <div class="mb-6">
                                    <label for="department" class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Department:</label>
                                    <select id="department" name="department" class="shadow dark:text-gray-200 dark:bg-gray-700 dark:text-gray-200  appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                        <option value="Livestock Management">Livestock Management</option>
                                        <option value="Dairy Production">Dairy Production</option>
                                        <option value="Poultry Management">Poultry Management</option>
                                        <option value="Herd Health">Herd Health</option>
                                        <option value="Animal Nutrition">Animal Nutrition</option>
                                        <option value="Reproduction Management">Reproduction Management</option>
                                        <option value="Veterinary Services">Veterinary Services</option>
                                        <option value="Pasture Management">Pasture Management</option>
                                        <option value="Animal Welfare">Animal Welfare</option>
                                        <option value="Breeding Program">Breeding Program</option>
                                        <option value="Feedlot Operations">Feedlot Operations</option>
                                        <option value="Farm Infrastructure">Farm Infrastructure</option>
                                        <option value="Farm Administration">Farm Administration</option>
                                        <option value="Animal Genetics">Animal Genetics</option>
                                        <option value="Farm Research">Farm Research</option>
                                        <option value="Farm Safety">Farm Safety</option>
                                        <option value="Environmental Management">Environmental Management</option>
                                        <option value="Agribusiness Development">Agribusiness Development</option>
                                        <option value="Animal Behavior">Animal Behavior</option>
                                        <option value="Animal Training">Animal Training</option>
                                        <option value="Waste Management">Waste Management</option>
                                        <option value="Farm Technology">Farm Technology</option>
                                        <option value="Farm Education">Farm Education</option>
                                        <option value="Farm Marketing">Farm Marketing</option>
                                        <option value="Other">Other</option>

                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label  class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">NID No</label>
                                    <input type="text" class="w-full dark:text-gray-200 dark:bg-gray-700 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="nid_no" value="{{ old('nid_no') }}" placeholder="this will be automatically generated " readonly>
                                </div>
                                <div class="mb-4">
                                    <label class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Photo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="dark:text-gray-200 custom-file-input" id="exampleInputFile">
                                            <label class="dark:text-gray-200 dark:text-gray-200 custom-file-label"  for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Start Date</label>
                                    <input type="date" class="w-full dark:text-gray-200 dark:bg-gray-700 dark:text-gray-200 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="start_date" value="{{ old('start_date') }}" placeholder="Select Start Date">
                                </div>
                                <div class="mb-4">
                                    <label class="block dark:text-gray-200 text-gray-700 text-sm font-bold mb-2">Task for Animal</label>
                                    <textarea name="task_for_animal" class="w-full dark:text-gray-200 dark:bg-gray-700 border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="Describe the tasks this employee will perform for the animal">{{ old('task_for_animal') }}</textarea>
                                </div>
                                <hr class="mt-4  col-span-2">
                                <div class="flex col-span-2 justify-end mt-6">
                                    <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">

                                        <a href="{{route('index')}}" class="btn btn-gray-500">Cancel</a>
                                    </button>
                                    <button type="submit" name="action" value="save"  class="px-3 btn btn-success mb-4 py-2 text-sm mr-4 tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                        Save
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>


</div>
</x-app-layout>
