<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>File Import</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <h4 class="text-center mt-5">Excel File Import in Laravel </h4>
            <div class="col md-10 offset-1 mt-5">
                <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                  @csrf
                    <input type="file" name="file" class="form-control">
                    <button type="submit" class="btn btn-info mt-2">Upload</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Excel File Import</title>
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
        <h2 class="text-3xl font-bold text-center text-indigo-600 mb-8">Excel File Import</h2>
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="bg-gray-50 p-4 rounded-xl">
                <label for="file-upload" class="block text-sm font-medium text-gray-700 mb-2">
                    Choose Excel File
                </label>
                <div class="relative">
                    <input id="file-upload" name="file" type="file" accept=".xlsx,.xls,.csv" required
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100
                        cursor-pointer">
                </div>
            </div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-xl transition duration-300 flex items-center justify-center shadow-md hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                Upload and Import
            </button>
        </form>
    </div>
</body>
</html>
