@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center w-full max-w-4xl mx-auto px-4">
        <!-- Logo Section -->
        <div class="text-center mb-8 md:mb-12">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-16 md:h-24 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Main Content -->
        <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6 md:gap-8 mb-8 md:mb-12">
            <!-- Left Side: Terima Kasih -->
            <div class="text-center md:text-right w-full md:w-1/2">
                <h2 class="text-5xl md:text-6xl font-extrabold text-pink-500 leading-tight">Terima<br class="hidden md:block"> Kasih.</h2>
            </div>

            <!-- Right Side: Message -->
            <div class="text-center md:text-left w-full md:w-1/2">
                <p class="text-lg md:text-xl font-bold text-pink-500 mb-1">Atas Waktu dan</p>
                <p class="text-lg md:text-xl font-bold text-pink-500 mb-1">Pendapatnya.</p>
                <p class="text-lg md:text-xl font-bold text-gray-600 leading-snug mt-4 md:mt-2">Senang Bisa Melibatkan<br class="hidden md:block"> Anda dalam Penelitian ini.</p>
            </div>
        </div>

        <!-- Lucky Draw Info -->
        <div class="text-center mb-8 md:mb-10 px-4">
            <p class="text-gray-700 text-base md:text-lg">
                3 Orang Beruntung akan di undi untuk<br class="hidden md:block">
                Mendapatkan Saldo Total 300K.<br class="hidden md:block">
                Semoga Kamu Beruntung ya!
            </p>
        </div>

        <!-- Footer Info -->
        <div class="text-center mb-8 md:mb-10 px-4">
            <p class="text-gray-500 text-[10px] md:text-xs">
                Para Pemenang Akan di Hubungi langsung via WhatsApp pada Juli 2026.
            </p>
        </div>

        <!-- Button -->
        <div class="mb-4 text-center">
            <a href="{{ route('welcome') }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-8 md:py-3 md:px-12 rounded-full text-lg md:text-xl shadow-lg transition duration-300 transform hover:scale-105">
                Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
