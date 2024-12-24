<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

        <h1 class="text-3xl font-semibold text-center mb-6">Forget Password</h1>

        <!-- Display errors -->
        @if ($errors->any())
            <ul class="text-red-500 mb-4" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Display session message -->
        @if (Session::has('error'))
            <ul class="text-red-500 mb-4" role="alert">
                <li>{{ Session::get('error') }}</li>
            </ul>
        @endif

        <form action="{{ route('admin.password_submit') }}" method="post">
            @csrf

            <!-- Email input -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                    required
                    aria-describedby="emailHelp">
            </div>

            <!-- Submit button -->
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                EMAIL PASSWORD REST LINK
            </button>
        </form>

    </div>

</body>
</html>
