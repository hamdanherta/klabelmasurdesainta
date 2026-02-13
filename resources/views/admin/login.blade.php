@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row items-center justify-center w-full max-w-7xl mx-auto px-2 md:px-4 h-full gap-8 md:gap-24">
        <!-- Left Side: Logo -->
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center md:items-end mb-10 md:mb-0">
            <div class="text-center md:text-right">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-24 md:h-32 hover:opacity-80 transition duration-300">
                </a>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 flex flex-col justify-center md:px-0">
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-5xl md:text-6xl font-bold text-pink-500 inline-block">Login.</h2>
                <span class="text-2xl md:text-3xl font-bold text-pink-500 ml-2">Admin</span>
            </div>

            <form action="{{ route('login') }}" method="POST" class="flex flex-col space-y-6 max-w-lg w-full mx-auto md:mx-0">
                @csrf
                
                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xl font-bold text-pink-500 mb-2">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required 
                           class="w-full px-6 py-3 border-2 border-gray-200 rounded-lg text-lg focus:outline-none focus:border-pink-500 transition-colors"
                           placeholder="">
                </div>

                <!-- Password Input -->
                <script src="//unpkg.com/alpinejs" defer></script>
                <div x-data="{ show: false }">
                    <label for="password" class="block text-xl font-bold text-pink-500 mb-2">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" 
                               id="password" 
                               name="password" 
                               required 
                               class="w-full px-6 py-3 border-2 border-gray-200 rounded-lg text-lg focus:outline-none focus:border-pink-500 transition-colors pr-12"
                               placeholder="">
                        
                        <button type="button" 
                                @click="show = !show" 
                                class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-500 hover:text-pink-500 focus:outline-none">
                            <!-- Eye Icon (Show) -->
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Off Icon (Hide) -->
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-12 rounded-full text-2xl shadow-md transition duration-300 transform hover:scale-105 w-full md:w-auto">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
