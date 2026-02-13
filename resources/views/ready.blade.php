@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center w-full max-w-4xl mx-auto h-full px-4">
        <!-- Logo Section -->
        <div class="text-center mb-12 md:mb-24">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-16 md:h-24 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Main Content -->
        <div class="text-center">
            <h2 class="text-xl md:text-3xl font-bold text-gray-800 mb-8">Apakah Anda Siap ?</h2>
            
            <a href="{{ route('identity') }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-10 md:py-2 md:px-10 rounded-full text-2xl md:text-2xl shadow-lg transition duration-300 transform hover:scale-105">
                Saya Siap!
            </a>
        </div>
    </div>
@endsection
