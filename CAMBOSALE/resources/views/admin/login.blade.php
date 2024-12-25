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

    <div class="bg-white shadow-lg rounded-lg flex flex-col md:flex-row w-full max-w-4xl overflow-hidden">
        
        <!-- Left Image Section -->
        <div class="hidden md:flex bg-gray-50 items-center justify-center w-full md:w-1/2 p-8">
            <img src="{{ asset('backend/assets/images/LoginAdmin.jpg') }}" alt="Login Illustration" class="max-w-full h-auto">
        </div>

        <!-- Right Login Form Section -->
        <div class="w-full md:w-1/2 p-8">
            <h1 class="text-3xl font-semibold text-center mb-6">Admin Dashboard</h1>
            <p class="text-center text-gray-500 mb-6">សូមបញ្ចូលព័ត៌មានខាងក្រោម</p>

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

            <form action="{{ route('admin.login_submit') }}" method="post">
                @csrf

                <!-- Email input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Username</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Your email"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required>
                </div>

                <!-- Password input -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Your password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required>
                </div>

                <!-- Forgot password link -->
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ route('admin.forget_password') }}" class="text-sm text-indigo-600 hover:underline">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit button -->
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Login
                </button>
            </form>
        </div>

    </div>

</body>
</html>
