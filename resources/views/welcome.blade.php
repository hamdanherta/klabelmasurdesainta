@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-start w-full max-w-7xl mx-auto px-4 min-h-screen pt-5 pb-5">
        <!-- Logo Section -->
        <div class="text-center mb-10 md:mb-16">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-16 md:h-24 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Main Content (Split Layout) -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-10 md:gap-20 w-full mb-12">
            
            <!-- Left Side: Illustration -->
            <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                <img src="{{ asset('images/welcome_image.png') }}" alt="Welcome Illustration" class="w-3/4 md:w-full max-w-md"> 
            </div>

            <!-- Right Side: Text & Actions -->
            <div class="w-full md:w-1/2 text-center md:text-left">
                
                <!-- Halo & Welcome Message -->
                <div class="mb-6">
                    <h1 class="text-6xl md:text-7xl font-extrabold text-pink-500 mb-2">Halo.</h1>
                    <h2 class="text-xl md:text-2xl font-bold text-pink-500 leading-tight">Terima Kasih telah</h2>
                    <h2 class="text-xl md:text-2xl font-bold text-pink-500 leading-tight">Membuka Aplikasi</h2>
                    <h2 class="text-xl md:text-2xl font-bold text-pink-500 leading-tight">Kuisioner ini.</h2>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <p class="text-gray-800 text-lg md:text-xl leading-relaxed mb-4">
                        Apakah Anda Bersedia untuk Membantu <strong class="font-bold">Hamdani</strong><br class="hidden md:block">
                        dalam Menyelesaikan Penelitian Skripsi nya ?
                    </p>

                    <p class="text-pink-500 text-base md:text-lg font-medium">
                        Klik Lanjutkan Jika Anda Bersedia.
                    </p>
                </div>

                <!-- Button -->
                <a href="{{ route('tutorial') }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-12 md:px-16 rounded-full text-xl md:text-2xl shadow-lg transition duration-300 transform hover:scale-105">
                    Lanjutkan
                </a>

                <!-- Running Text of Respondents -->
                @if(isset($names) && count($names) > 0)
                    <div class="mt-8 w-full max-w-lg overflow-hidden relative">
                        <p class="text-sm text-gray-500 mb-2 font-medium">Beberapa Orang yang telah Mengisi Kuesioner ini :</p>
                        <div class="relative w-full overflow-hidden bg-pink-50 rounded-full py-3 shadow-sm">
                            <div class="whitespace-nowrap inline-block animate-marquee hover:[animation-play-state:paused]">
                                @foreach($names as $name)
                                    <span class="mx-4 text-pink-500 font-bold">{{ $name }}</span>
                                    <span class="text-gray-300"> • </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <style>
                        .animate-marquee {
                            display: inline-block;
                            padding-left: 100%;
                            animation: marquee 45s linear infinite;
                        }

                        @keyframes marquee {
                            0% { transform: translate(0, 0); }
                            100% { transform: translate(-100%, 0); }
                        }
                    </style>
                @endif

            </div>
        </div>

        <!-- Footer: Thesis Title -->
        <div class="text-center mt-12">
            <p class="text-pink-500 text-xs font-bold mb-1">Judul Skripsi :</p>
            <p class="text-pink-500 text-[10px] md:text-xs italic leading-relaxed px-2">
                Perancangan Aplikasi Multiplatform Ekstraksi dan Rekomendasi Warna Desain Grafis<br class="hidden md:block">
                Menggunakan Algoritma Mean Shift, DBSCAN dan Gradient Boosting.
            </p>
        </div>
    </div>
@endsection
