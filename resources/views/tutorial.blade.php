@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center w-full max-w-4xl mx-auto px-2">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-16 md:h-24 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Heading -->
        <div class="text-center mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-pink-500 mb-1">Oke Terima Kasih.</h2>
            <p class="text-lg md:text-xl text-gray-700">Berikut adalah Tutorial Cara Mengisi Kuisioner ini.</p>
        </div>

        <!-- Tutorial List -->
        <div class="w-full max-w-4xl text-left space-y-4 mb-12 pl-0 md:pl-0">
            <!-- Item 1 -->
            <p class="text-lg md:text-xl font-bold text-gray-800">Setelah Meng-Klik "Oke, Saya Paham" dan "Saya Siap!" Masukkan Nama & No WA Anda</p>
            
            <!-- Item 2 -->
            <p class="text-lg md:text-xl font-bold text-gray-800">Klik Mulai.</p>
            
            <!-- Item 3 (Complex Formatting) -->
            <div class="text-base md:text-lg text-gray-800 leading-relaxed">
                <p>Anda akan di Berikan <span class="text-pink-500 font-bold not-italic">10 Kombinasi Warna</span>,</p>
                <p>Anda Cukup Menjawab Kombinasi Warnanya "<span class="text-pink-500 font-bold not-italic">Cocok</span>" atau "<span class="text-pink-500 font-bold not-italic">Tidak</span>".</p>
                <p>( Menurut Pandangan Anda Sendiri )</p>
            </div>
            
            <!-- Item 4 -->
            <p class="text-lg md:text-xl font-bold text-gray-800 mt-4">Jika sudah Klik "Cocok" atau "Tidak",  Klik Lanjut. Sampai ke Kombinasi 10</p>

            <p class="text-lg md:text-xl font-bold text-gray-800 mt-4">Jika Sudah sampai ke Kombinasi 10, Maka Anda Dapat Melihat Tombol Simpan.</p>

        </div>

        <!-- Button -->
        <div class="mb-8 text-center md:text-right w-full max-w-2xl">
            <a href="{{ route('ready') }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-8 md:px-12 rounded-full text-lg md:text-xl shadow-lg transition duration-300 transform hover:scale-105 w-full md:w-auto">
                Oke, Saya Paham
            </a>
        </div>
    </div>
@endsection
