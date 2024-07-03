
<x-app-layout title="Cards">


    <div class="container font-serif mx-auto mt-8 p-4 mb-8 bg-white dark:bg-gray-700 dark:rounded-lg dark:shadow-lg">
        <h1 class="text-2xl dark:text-gray-200 font-semibold mb-4">Create Employee</h1>
<hr class="mb-4"

                        <!-- form start -->
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                    <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                    <input type="email" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                                    <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                    <select name="role" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                                        <option value="employee">Employee</option>
                                        <option value="manager">Manager</option>
                                        <option value="admin">Admin</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="assistant">Assistant</option>
                                        <option value="analyst">Analyst</option>
                                        <!-- Add more roles as needed -->
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                                    <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="address" value="{{ old('address') }}" placeholder="Enter Address">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">City</label>
                                    <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="city" value="{{ old('city') }}" placeholder="Enter City">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Salary</label>
                                    <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="salary" value="{{ old('salary') }}" placeholder="Enter salary">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">NID No</label>
                                    <input type="text" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="nid_no" value="{{ old('nid_no') }}" placeholder="nid_no">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Photo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
                                    <input type="date" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" name="start_date" value="{{ old('start_date') }}" placeholder="Select Start Date">
                                </div>

                                <hr class="mt-4  col-span-2">
                                <div class="flex col-span-2 justify-end mt-6">
                                    <button type="button" class="px-3 py-2 text-sm mr-4 mb-4 dark:text-gray-100  tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">

                                        <a href="" class="btn btn-gray-500">Cancel</a>
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
