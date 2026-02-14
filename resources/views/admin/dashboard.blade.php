@extends('layouts.app')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>
    <div x-data="{ showResetModal: false }" class="flex flex-col items-center justify-start w-full max-w-7xl mx-auto px-4 min-h-screen pt-5 pb-10">
        
        <!-- Top Logo -->
        <div class="text-center mb-16 md:mb-24">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-20 md:h-28 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Notification Message -->
        @if (session('success'))
            <div class="w-full max-w-4xl mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="w-full max-w-4xl mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Main Content Area -->
        <div class="w-full flex flex-col md:flex-row justify-between items-center px-4 md:px-12">
            
            <!-- Left Side: Welcome Message -->
            <div class="flex flex-col items-center md:items-start w-full md:w-1/2 mb-10 md:mb-0">
                <h2 class="text-5xl md:text-7xl font-bold text-pink-500 leading-none mb-2 text-center md:text-left">Selamat</h2>
                <h2 class="text-5xl md:text-7xl font-bold text-pink-500 leading-none mb-2 text-center md:text-left">Datang.</h2>
                <h2 class="text-5xl md:text-7xl font-bold text-gray-600 leading-none text-center md:text-left">{{ auth()->user()->name }}</h2>
                
                <!-- Data Count Info -->
                <div class="mt-6 bg-pink-50 rounded-xl p-4 border border-pink-200 text-center md:text-left shadow-sm">
                    <p class="text-gray-600 font-bold text-lg">Total Data Masuk:</p>
                    <p class="text-4xl font-extrabold text-pink-600 mb-2">{{ $responseCount }} <span class="text-lg text-pink-400 font-medium">Responden</span></p>
                    
                    @if($responseCount > 0)
                        <div class="mt-2 pt-2 border-t border-pink-200">
                            <p class="text-sm text-gray-500 font-semibold">Responden Terakhir:</p>
                            <p class="text-lg font-bold text-gray-800">{{ $lastRespondentName }}</p>
                            <p class="text-xs text-gray-500">{{ $lastRespondentTime }}</p>
                        </div>
                    @endif
                </div>

                 <!-- Logout Button -->
                <div class="mt-8 w-full flex justify-center md:justify-start">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-8 md:py-3 md:px-12 rounded-full text-lg md:text-xl shadow-md transition duration-300 transform hover:scale-105">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Action Buttons -->
            <div class="text-center md:text-right w-full md:w-1/2 flex flex-col items-center md:items-end space-y-4">
                <a href="{{ route('admin.download') }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 md:py-4 md:px-12 rounded-full text-lg md:text-xl shadow-lg transition duration-300 transform hover:scale-105 w-full md:w-auto text-center">
                    Download Hasil Kusioner
                </a>

                <!-- <button @click="showResetModal = true" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 md:py-4 md:px-12 rounded-full text-lg md:text-xl shadow-lg transition duration-300 transform hover:scale-105 w-full md:w-auto text-center">
                    Reset Data CSV
                </button> -->
            </div>
        </div>

        <!-- Reset Confirmation Modal -->
        <div x-show="showResetModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <!-- Backdrop with Blur -->
            <div class="fixed inset-0 bg-gray-900/30 backdrop-blur-md transition-opacity" aria-hidden="true" @click="showResetModal = false"></div>

            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="bg-white rounded-[2rem] p-6 md:p-10 max-w-sm md:max-w-md w-full shadow-2xl transform transition-all relative">
                    
                    <div class="text-center">
                        <h3 class="text-2xl md:text-4xl font-bold text-pink-500 mb-6 md:mb-10 leading-snug">
                            Yakin ingin<br>Menghapus ?
                        </h3>
                        
                        <div class="flex flex-col sm:flex-row justify-center gap-3 md:gap-4">
                            <!-- Batal Button -->
                            <button @click="showResetModal = false" class="bg-pink-200 hover:bg-pink-300 text-white font-bold py-2 px-6 md:py-3 md:px-10 rounded-xl text-lg md:text-xl transition duration-300 w-full sm:w-auto">
                                Batal
                            </button>

                            <!-- Oke Button (Submit Form) -->
                             <form action="{{ route('admin.reset') }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 md:py-3 md:px-12 rounded-xl text-lg md:text-xl transition duration-300 w-full">
                                    Oke
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
