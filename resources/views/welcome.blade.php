@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-start w-full max-w-7xl mx-auto px-4 min-h-screen pt-5 pb-5">
        <!-- Logo Section -->
        <div class="text-center mb-10 md:mb-16">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo"
                    class="h-16 md:h-24 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Main Content (Split Layout) -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-10 md:gap-20 w-full mb-12">

            <!-- Left Side: Illustration -->
            <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                <img src="{{ asset('images/welcome_image.png') }}" alt="Welcome Illustration"
                    class="w-3/4 md:w-full max-w-md">
            </div>

            <!-- Right Side: Text & Actions -->
            <div class="w-full md:w-1/2 text-center md:text-left">

                <!-- Data Count Info -->
                <div class="w-full bg-pink-50 rounded-xl p-6 border border-pink-200 text-center md:text-left shadow-sm">
                    <p class="text-gray-600 font-bold text-lg">Jumlah Responden :</p>
                    <p class="text-4xl font-extrabold text-pink-600 mb-2">{{ $responseCount }} <span
                            class="text-lg text-pink-400 font-medium">Orang</span></p>
                </div>

                <!-- Halo & Welcome Message -->
                <div class="mb-6 mt-6 h-fit leading-medium">
                    <h1 class="text-5xl md:text-7xl font-extrabold text-pink-500 mb-2 leading-tight">KUESIONER <p
                            class="text-gray-600 text-3xl"> telah</p>SELESAI!</h1>
                    <h2 class="text-xl md:text-2xl font-bold text-pink-500 leading-tight">Terima Kasih telah menjadi Bagian
                        dari Penelitian ini.</h2>
                </div>

                <div class="mb-6 h-fit leading-medium">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-500 leading-tight">Jika Nama Kamu Tertera di bawah ..
                        SELAMAT! Kamu telah Berkontribusi dalam Pembangunan <br /> Masjid Nur Hasanah Kampung Nelayan <br />
                        Kuala Tungkal</h2>
                </div>

                <!-- Responsive Image -->
                <div class="mb-8 mt-4 flex justify-center md:justify-start w-full">
                    <img src="{{ asset('images/masjid-nh.png') }}" alt="Masjid Nur Hasanah"
                        class="w-full max-w-xs md:max-w-md h-auto object-cover rounded-2xl">
                </div>
                <!-- Button -->
                <!-- <a href="{{ route('tutorial') }}"
                            class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-12 md:px-16 rounded-full text-xl md:text-2xl shadow-lg transition duration-300 transform hover:scale-105">
                            Lanjutkan
                        </a> -->



                @if(isset($names) && count($names) > 0)
                    <div class="w-full bg-pink-50 h-36 mt-10 rounded-xl p-6 border border-pink-200 text-center shadow">

                        <p class="text-gray-600 font-bold text-lg mb-4">
                            Special Thanks to <br /> ( Seluruh Responden ) <br /> Panjang Lebar <br /> Orang Baik :)
                        </p>

                        <!-- Marquee Container -->
                        <div class="relative h-fit overflow-hidden w-full">

                            <div class="flex flex-col items-center gap-3 animate-marquee-vertical">

                                @foreach($names as $name)
                                    <span class="text-pink-600 font-bold text-xl px-4 py-1 bg-white rounded-full shadow">
                                        {{ $name }}
                                    </span>
                                @endforeach

                                @foreach($names as $name)
                                    <span class="text-pink-600 font-bold text-xl px-4 py-1 bg-white rounded-full shadow">
                                        {{ $name }}
                                    </span>
                                @endforeach

                            </div>
                        </div>

                    </div>

                    <style>
                        .animate-marquee-vertical {
                            animation: marquee-vertical 30s linear infinite;
                        }

                        @keyframes marquee-vertical {
                            0% {
                                transform: translateY(0);
                            }

                            100% {
                                transform: translateY(-50%);
                            }
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