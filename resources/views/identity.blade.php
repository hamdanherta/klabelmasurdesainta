@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center w-full max-w-4xl mx-auto px-4">
        <!-- Logo Section -->
        <div class="text-center mb-8 md:mb-12">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-16 md:h-24 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Form Section -->
        <div class="w-full max-w-md">
            <form action="{{ route('identity.store') }}" method="POST" class="flex flex-col space-y-6 md:space-y-8">
                @csrf
                
                <!-- Nama Input -->
                <div class="text-center">
                    <label for="nama" class="block text-xl md:text-2xl font-bold text-pink-500 mb-2">Masukkan Nama Anda</label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           required 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-base md:text-lg focus:outline-none focus:border-pink-500 transition-colors text-center"
                           placeholder="">
                </div>

                <!-- WA Input -->
                <div class="text-center">
                    <label for="nowa" class="block text-xl md:text-2xl font-bold text-pink-500 mb-2">Masukan Nomor WhatsApp</label>
                    <input type="tel" 
                           id="nowa" 
                           name="nowa" 
                           required 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-base md:text-lg focus:outline-none focus:border-pink-500 transition-colors text-center"
                           placeholder="">
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-10 md:py-3 md:px-16 rounded-3xl text-xl md:text-3xl shadow-lg transition duration-300 transform hover:scale-105 w-full md:w-auto">
                        Mulai!
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
