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
                <h2 class="text-5xl md:text-6xl font-bold text-pink-500 leading-none">Terima<br class="hidden md:block"> Kasih.</h2>
            </div>

            <!-- Right Side: Message -->
            <div class="text-center md:text-left w-full md:w-1/2 leading-none">
                <p class="text-lg md:text-xl font-bold text-pink-500 mb-1">Atas Waktu dan Jawabannya</p>
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

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-9999 px-4 items-center justify-center bg-gray-900/60 backdrop-blur-md hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-3xl p-8 md:p-12 w-full max-w-2xl text-center shadow-2xl transform scale-95 transition-transform duration-300" id="modalContent">
            
            <!-- Success Icon/Heading -->
            <!-- Success Icon/Heading -->
            <div class="flex items-center justify-center gap-4 mb-6">
                <!-- Animated Check Icon -->
                <div class="w-12 h-12 relative flex items-center justify-center">
                    <svg class="checkmark-animated w-full h-full text-pink-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                <h3 class="text-4xl md:text-5xl font-bold text-pink-500 tracking-tight">Berhasil!</h3>
            </div>

            <style>
                .checkmark-animated {
                    border-radius: 50%;
                    display: block;
                    stroke-width: 6;
                    stroke: #FF0492;
                    stroke-miterlimit: 10;
                    animation: scale .3s ease-in-out .9s both;
                }
                
                .checkmark-circle {
                    stroke-dasharray: 166;
                    stroke-dashoffset: 166;
                    stroke-width: 8;
                    stroke-miterlimit: 10;
                    stroke: #FF0492;
                    fill: none;
                    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
                }
                
                .checkmark-check {
                    transform-origin: 50% 50%;
                    stroke-dasharray: 48;
                    stroke-dashoffset: 48;
                    stroke: #FF0492;
                    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
                }
                
                @keyframes stroke {
                    100% { stroke-dashoffset: 0; }
                }
                @keyframes scale {
                    0%, 100% { transform: none; }
                    50% { transform: scale3d(1.1, 1.1, 1); }
                }
            </style>

            <hr class="border-gray-200 mb-8 mx-auto w-3/4">

            <!-- Message -->
            <h4 class="text-2xl md:text-3xl font-bold text-gray-700 mb-3">Sukses Selalu</h4>
            <div class="text-4xl md:text-5xl font-extrabold text-pink-500 mb-10 wrap-break-word leading-tight drop-shadow-sm">
                {{ $nama ?? 'Teman' }}
            </div>

            <!-- Button -->
            <button onclick="closeModal()" class="bg-pink-500 hover:bg-pink-600 text-white text-xl font-bold py-3 px-10 rounded-xl shadow-lg transition duration-300 transform hover:scale-105 outline-none focus:outline-none focus:ring-4 focus:ring-pink-300">
                Oke
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('successModal');
            const modalContent = document.getElementById('modalContent');
            
            // Show modal with fade-in effect
            setTimeout(() => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                // Trigger reflow
                void modal.offsetWidth; 
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 500); // Small delay for better UX
        });

        function closeModal() {
            const modal = document.getElementById('successModal');
            const modalContent = document.getElementById('modalContent');
            
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300); // Wait for transition
        }
    </script>
@endsection
