<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | {{ config('app.name', 'School Management System') }}</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            600: '#4f46e5',
                            500: '#6366f1',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        .bg-auth {
            background-image: url('https://source.unsplash.com/random/1920x1080/?education,school');
            background-size: cover;
            background-position: center;
        }
        @media (max-width: 640px) {
            .bg-auth {
                background-image: none;
            }
        }
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex">
        <!-- Left side with background image -->
        <div class="hidden lg:block w-1/2 bg-auth relative">
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30 dark:from-black/70 dark:to-black/40 flex items-center justify-center">
                <div class="text-center px-10">
                    <svg class="w-24 h-24 mx-auto mb-6 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white mb-4">Join Our Community</h1>
                    <p class="text-xl text-gray-200">Create an account to manage your school efficiently</p>
                    <div class="mt-8 grid grid-cols-3 gap-4 text-white">
                        <div class="text-center">
                            <div class="text-2xl font-bold">500+</div>
                            <div class="text-sm">Schools</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold">50K+</div>
                            <div class="text-sm">Students</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold">10K+</div>
                            <div class="text-sm">Teachers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right side with registration form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center py-8 px-4 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
                <a href="/" class="flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-primary-600 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                    </svg>
                    <span class="ml-2 text-2xl font-bold text-gray-900 dark:text-white">EduManage Pro</span>
                </a>
                
                <!-- Progress Steps -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-medium text-primary-600 dark:text-primary-500">Step 1: Account Details</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Step 2: School Information</div>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div id="progress-bar" class="bg-primary-600 dark:bg-primary-500 h-2 rounded-full w-1/2"></div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 py-8 px-4 shadow-xl sm:rounded-2xl sm:px-10 border border-gray-200 dark:border-gray-700">
                    <h2 class="text-center text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Create your account
                    </h2>
                    <p class="text-center text-sm text-gray-600 dark:text-gray-400 mb-8">
                        Start your journey with our school management system
                    </p>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Error Summary -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                            <div class="flex">
                                <svg class="h-5 w-5 text-red-400 dark:text-red-300 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-300">
                                        Please fix the following errors:
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700 dark:text-red-400">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="space-y-6" method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf

                        <!-- Step 1: Account Details -->
                        <div id="step1" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- First Name -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        First Name *
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input id="first_name" name="first_name" type="text" required 
                                            value="{{ old('first_name') }}"
                                            class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                    </div>
                                    @if ($errors->has('first_name'))
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                            {{ $errors->first('first_name') }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Last Name *
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input id="last_name" name="last_name" type="text" required 
                                            value="{{ old('last_name') }}"
                                            class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                            {{ $errors->first('last_name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Email Address *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input id="email" name="email" type="email" autocomplete="email" required 
                                        value="{{ old('email') }}"
                                        class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                </div>
                                @if ($errors->has('email'))
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Phone Number *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <input id="phone" name="phone" type="tel" required 
                                        value="{{ old('phone') }}"
                                        placeholder="+92 300 1234567"
                                        class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                </div>
                                @if ($errors->has('phone'))
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        {{ $errors->first('phone') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Password *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input id="password" name="password" type="password" required 
                                        class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                    <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eye-icon-password" class="h-5 w-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @if ($errors->has('password'))
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                                <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Must be at least 8 characters with uppercase, lowercase, number, and special character
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Confirm Password *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                                        class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eye-icon-confirm" class="h-5 w-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Next Button -->
                            <div>
                                <button type="button" onclick="nextStep()" 
                                    class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 dark:bg-primary-500 hover:bg-primary-700 dark:hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-primary-400 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                                    Next: School Information
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: School Information -->
                        <div id="step2" class="space-y-6 hidden">
                            <!-- School Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">
                                    How would you like to join?
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Existing School -->
                                    <div>
                                        <input type="radio" id="existing_school" name="registration_type" value="existing" 
                                            {{ old('registration_type') === 'existing' ? 'checked' : 'checked' }}
                                            class="hidden peer" onchange="toggleSchoolType()">
                                        <label for="existing_school" 
                                            class="flex flex-col p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 peer-checked:ring-1 peer-checked:ring-primary-500 transition-all duration-200">
                                            <div class="flex items-center mb-2">
                                                <div class="w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600 peer-checked:border-primary-500 peer-checked:bg-primary-500 flex items-center justify-center mr-3">
                                                    <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                                <span class="font-medium text-gray-900 dark:text-white">Join Existing School</span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 ml-9">
                                                I have a school code or invitation
                                            </p>
                                        </label>
                                    </div>

                                    <!-- New School -->
                                    <div>
                                        <input type="radio" id="new_school" name="registration_type" value="new"
                                            {{ old('registration_type') === 'new' ? 'checked' : '' }}
                                            class="hidden peer" onchange="toggleSchoolType()">
                                        <label for="new_school" 
                                            class="flex flex-col p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer peer-checked:border-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 peer-checked:ring-1 peer-checked:ring-primary-500 transition-all duration-200">
                                            <div class="flex items-center mb-2">
                                                <div class="w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600 peer-checked:border-primary-500 peer-checked:bg-primary-500 flex items-center justify-center mr-3">
                                                    <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                                <span class="font-medium text-gray-900 dark:text-white">Create New School</span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 ml-9">
                                                Register as a new school administrator
                                            </p>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Existing School Fields -->
                            <div id="existingSchoolFields" class="space-y-6">
                                <div>
                                    <label for="school_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        School Code *
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                            </svg>
                                        </div>
                                        <input id="school_code" name="school_code" type="text" 
                                            value="{{ old('school_code') }}"
                                            placeholder="Enter your school's unique code"
                                            class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                    </div>
                                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                        Get this code from your school administrator
                                    </div>
                                </div>

                                <!-- Role Selection -->
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        I am registering as *
                                    </label>
                                    <select id="role" name="role" 
                                        class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 rounded-lg">
                                        <option value="">Select your role</option>
                                        <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                                        <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                                        <option value="parent" {{ old('role') === 'parent' ? 'selected' : '' }}>Parent</option>
                                        <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff Member</option>
                                    </select>
                                </div>
                            </div>

                            <!-- New School Fields -->
                            <div id="newSchoolFields" class="space-y-6 hidden">
                                <div>
                                    <label for="school_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        School Name *
                                    </label>
                                    <input id="school_name" name="school_name" type="text" 
                                        value="{{ old('school_name') }}"
                                        placeholder="Enter your school's official name"
                                        class="appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                </div>

                                <div>
                                    <label for="school_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        School Address *
                                    </label>
                                    <textarea id="school_address" name="school_address" rows="2"
                                        placeholder="Full address of your school"
                                        class="appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm resize-none transition duration-150 ease-in-out">{{ old('school_address') }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="school_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            City *
                                        </label>
                                        <input id="school_city" name="school_city" type="text" 
                                            value="{{ old('school_city') }}"
                                            class="appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 text-sm transition duration-150 ease-in-out">
                                    </div>

                                    <div>
                                        <label for="school_country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Country *
                                        </label>
                                        <select id="school_country" name="school_country" 
                                            class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 dark:bg-gray-900 dark:text-gray-300 rounded-lg">
                                            <option value="">Select Country</option>
                                            <option value="Pakistan" {{ old('school_country') === 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                            <option value="India" {{ old('school_country') === 'India' ? 'selected' : '' }}>India</option>
                                            <option value="USA" {{ old('school_country') === 'USA' ? 'selected' : '' }}>USA</option>
                                            <option value="UK" {{ old('school_country') === 'UK' ? 'selected' : '' }}>UK</option>
                                            <option value="UAE" {{ old('school_country') === 'UAE' ? 'selected' : '' }}>UAE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="flex items-start">
                                <input id="terms" name="terms" type="checkbox" required
                                    class="h-4 w-4 text-primary-600 dark:text-primary-500 focus:ring-primary-500 dark:focus:ring-primary-400 border-gray-300 dark:border-gray-700 rounded mt-1 dark:bg-gray-900">
                                <label for="terms" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                    I agree to the
                                    <a href="#" class="text-primary-600 dark:text-primary-500 hover:text-primary-500 dark:hover:text-primary-400 font-medium">Terms of Service</a>
                                    and
                                    <a href="#" class="text-primary-600 dark:text-primary-500 hover:text-primary-500 dark:hover:text-primary-400 font-medium">Privacy Policy</a>
                                </label>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex space-x-4">
                                <button type="button" onclick="prevStep()" 
                                    class="flex-1 py-3 px-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-primary-400 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Back
                                </button>
                                <button type="submit" 
                                    class="flex-1 py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 dark:bg-primary-500 hover:bg-primary-700 dark:hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-primary-400 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                                    Create Account
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Already have account -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-medium text-primary-600 dark:text-primary-500 hover:text-primary-500 dark:hover:text-primary-400 ml-1">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Support Info -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Need help? Contact our support team at
                        <a href="mailto:support@edumanage.com" class="text-primary-600 dark:text-primary-500 hover:text-primary-500 dark:hover:text-primary-400">
                            support@edumanage.com
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Password toggle functionality
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(`eye-icon-${fieldId === 'password' ? 'password' : 'confirm'}`);
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                field.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }

        // Multi-step form functionality
        let currentStep = 1;

        function nextStep() {
            // Validate step 1
            const step1Inputs = document.querySelectorAll('#step1 input[required]');
            let isValid = true;
            
            step1Inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500', 'dark:border-red-400');
                    setTimeout(() => {
                        input.classList.remove('border-red-500', 'dark:border-red-400');
                    }, 3000);
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Information',
                    text: 'Please fill in all required fields',
                    confirmButtonColor: '#4f46e5',
                    confirmButtonText: 'OK',
                    background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#1f2937'
                });
                return;
            }

            // Move to step 2
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('progress-bar').style.width = '100%';
            document.querySelector('.text-sm.font-medium.text-primary-600').textContent = 'Step 2: School Information';
            document.querySelector('.text-sm.text-gray-500').textContent = 'Step 1: Account Details';
            currentStep = 2;
        }

        function prevStep() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('progress-bar').style.width = '50%';
            document.querySelector('.text-sm.font-medium.text-primary-600').textContent = 'Step 1: Account Details';
            document.querySelector('.text-sm.text-gray-500').textContent = 'Step 2: School Information';
            currentStep = 1;
        }

        // Toggle school type fields
        function toggleSchoolType() {
            const existingSchoolRadio = document.getElementById('existing_school');
            const existingSchoolFields = document.getElementById('existingSchoolFields');
            const newSchoolFields = document.getElementById('newSchoolFields');

            if (existingSchoolRadio.checked) {
                existingSchoolFields.classList.remove('hidden');
                newSchoolFields.classList.add('hidden');
                // Clear new school fields
                document.getElementById('school_name').value = '';
                document.getElementById('school_address').value = '';
            } else {
                existingSchoolFields.classList.add('hidden');
                newSchoolFields.classList.remove('hidden');
                // Clear existing school fields
                document.getElementById('school_code').value = '';
                document.getElementById('role').value = '';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleSchoolType();
            
            // Add real-time validation
            const password = document.getElementById('password');
            if (password) {
                password.addEventListener('input', function() {
                    const passwordValue = this.value;
                    const hasLength = passwordValue.length >= 8;
                    const hasUpperCase = /[A-Z]/.test(passwordValue);
                    const hasLowerCase = /[a-z]/.test(passwordValue);
                    const hasNumber = /\d/.test(passwordValue);
                    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
                    
                    if (!hasLength) {
                        this.setCustomValidity('Password must be at least 8 characters long');
                    } else if (!hasUpperCase || !hasLowerCase || !hasNumber || !hasSpecialChar) {
                        this.setCustomValidity('Password must include uppercase, lowercase, number, and special character');
                    } else {
                        this.setCustomValidity('');
                    }
                });
            }
        });
    </script>
</body>
</html>