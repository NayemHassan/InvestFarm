<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorldBank - Home Banking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{asset('backend')}}/assets/images/favicon-32x32.png" type="image/png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ $pageTitle ?? 'World Bank - Your Financial Partner' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Manage your savings and investments securely.' }}">
    <meta name="keywords" content="bank, savings, investment, financial management">
    <meta name="robots" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph (OG) for Social Media -->
    <meta property="og:title" content="{{ $pageTitle ?? 'World Bank' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Your trusted investment platform.' }}">
    <meta property="og:image" content="{{ asset('backend/assets/images/seo-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle ?? 'World Bank' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Secure and reliable financial solutions.' }}">
    <meta name="twitter:image" content="{{ asset('backend/assets/images/seo-image.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .bank-pattern {
            background-image: url('data:image/svg+xml,<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path fill="rgba(255,255,255,0.1)" d="M50 18.35L12.5 37.65v4.7h75v-4.7L50 18.35zm-1.25 12.5v6.25h2.5V30.85h-2.5zm-18.75 6.25h6.25v25h-6.25v-25zm12.5 0h6.25v25h-6.25v-25zm12.5 0h6.25v25h-6.25v-25zm12.5 0h6.25v25h-6.25v-25zM12.5 68.85v-18.7h75v18.7H12.5z"/></svg>');
            background-size: 80px;
        }

        .slide-in-left {
            animation: slideInLeft 1s ease-out;
        }

        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .hover-effect {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .hover-effect:hover {
            transform: scale(1.05);
            background-color: #3b82f6;
        }

        .social-icons a:hover {
            color: #3b82f6;
        }

        .input-field {
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            transition: border-color 0.3s;
        }
        .input-field:focus {
            border-color: #3b82f6;
            outline: none;
        }

        .login-button {
            background-color: #3b82f6;
            color: white;
            padding: 14px;
            border-radius: 8px;
            width: 100%;
            font-size: 1.125rem;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #2563eb;
            transform: scale(1.05);
        }

        /* Dollar Rain Animation */
        @keyframes fall {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(100vh);
            }
        }

        .dollar {
            position: absolute;
            top: -50px;
            font-size: 24px;
            color: #4CAF50;
            animation: fall linear infinite;
        }
    </style>
</head>
<body class="h-screen overflow-hidden bg-gray-100">
    <!-- Dollar Rain -->
    <div id="dollarRain"></div>

    <div class="flex h-full">
        <!-- Bank Information Section -->
        <div class="w-1/2 bg-blue-900 text-white bank-pattern relative hidden lg:flex justify-center items-center h-screen mx-auto slide-in-left">
    <div class="p-12 text-center">
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-2">Welcome to World Bank</h1>
            <p class="text-xl opacity-75">Your Trusted Financial Partner</p>
        </div>

        <div class="grid grid-cols-2 gap-6 justify-center">
            <div class="flex items-center justify-center">
                <!-- <i class="fas fa-coins text-2xl mr-3 text-blue-300"></i> -->
                <!-- <div>
                    <p class="text-sm opacity-75">Current Rate</p>
                    <p class="text-lg">1 USD = ৳110.50</p>
                </div> -->
            </div>
            
            <div class="flex items-center justify-center">
                <!-- <i class="fas fa-phone-volume text-2xl mr-3 text-blue-300"></i> -->
                <!-- <div>
                    <p class="text-sm opacity-75">24/7 Support</p>
                    <p class="text-lg">16200</p>
                </div> -->
            </div>
        </div>

   
    </div>
</div>


        <!-- Login Section -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 fade-in">
            <div class="max-w-md w-full">
                <div class="text-center mb-10">
                <img src="{{ asset('logo-icon.png') }}" alt="World Bank" class="h-16 mx-auto mb-4"> 

                    <h2 class="text-2xl font-bold text-gray-800">World Bank Login</h2>
                </div>


                    
    <form method="POST" class="space-y-6" action="{{ route('login') }}">
        @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email ID</label>
                        <input type="text" 
                               class="input-field w-full"  name="email" :value="old('email')" required autofocus autocomplete="username"
                               placeholder="Enter your user ID">
                               <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" >Password</label>
                        <input type="password"    name="password"   required autocomplete="current-password" 
                               class="input-field w-full" 
                               placeholder="••••••••">
                               <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500" name="remember">
                            <label class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
                        </div>
                    </div>

                    <button class="login-button">
                        Sign In
                    </button>

                  
                </form>

                <div class="mt-10 text-center">
                    <div class="inline-flex items-center space-x-4 text-gray-500">
                        <i class="fas fa-lock text-sm"></i>
                        <span class="text-sm">256-bit SSL Encrypted</span>
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to create dollar rain
        function createDollarRain() {
            const dollarRain = document.getElementById('dollarRain');
            const numberOfDollars = 20;

            for (let i = 0; i < numberOfDollars; i++) {
                const dollar = document.createElement('div');
                dollar.innerHTML = '💰'
                dollar.classList.add('dollar');
                dollar.style.left = `${Math.random() * 100}vw`;
                dollar.style.animationDuration = `${Math.random() * 2 + 3}s`;
                dollar.style.animationDelay = `${Math.random() * 5}s`;
                dollarRain.appendChild(dollar);
            }
        }

        // Start the dollar rain
        createDollarRain();
    </script>
</body>
</html>