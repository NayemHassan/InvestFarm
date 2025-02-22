<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Default styles for all devices */
        .bank-pattern {
            background-image: url('data:image/svg+xml,<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="3" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: 20px;
        }

        /* Animation for small devices only */
        @media (max-width: 640px) {
            .bank-pattern {
                animation: dotFlow 10s linear infinite;
            }

            @keyframes dotFlow {
                0% {
                    background-position: 0 0;
                }
                100% {
                    background-position: 200px 200px;
                }
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg bank-pattern">
        <!-- Bank Logo -->
        <div class="text-center mb-8">
        <img src="{{ asset('logo-icon.png') }}" alt="World Bank" class="h-16 mx-auto mb-4"> 
            <h1 class="text-3xl font-bold mt-4 text-blue-600">World Bank</h1>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Email</label>
                <input 
                    type="email" 
                    name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- Password Input -->
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Password</label>
                <input 
                    type="password" 
                    name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="••••••••"
                    required
                >
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                    <span class="ml-2 text-gray-600">Remember me</span>
                </label>
               
            </div>

            <!-- Login Button -->
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Sign In
            </button>
        </form>

        <!-- Additional Links -->
       
    </div>
</body>
</html>