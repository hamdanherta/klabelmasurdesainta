@extends('layouts.app')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>
    <div x-data="{ showResetModal: false }"
        class="flex flex-col items-center justify-center w-full min-h-screen pt-5 pb-10">

        <!-- Top Logo -->
        <div class="text-center mb-16 md:mb-24">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo"
                    class="h-20 md:h-28 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <!-- Notification Message -->
        @if (session('success'))
            <div class="w-full max-w-4xl mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="w-full max-w-4xl mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"
                role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Main Content Area -->
        <div class="w-full flex flex-col md:flex-row justify-between items-start px-4 md:px-12 gap-8 md:gap-12">

            <!-- Left Side: Welcome & Stats & Logout -->
            <div
                class="flex flex-col items-center md:items-start w-full md:w-5/12 mb-10 md:mb-0 space-y-8 gap-6 sticky top-10">

                <div>
                    <h2 class="text-5xl md:text-7xl font-bold text-pink-500 leading-none mb-2 text-center md:text-left">
                        Selamat</h2>
                    <h2 class="text-5xl md:text-7xl font-bold text-pink-500 leading-none mb-2 text-center md:text-left">
                        Datang.</h2>
                    <h2 class="text-5xl md:text-7xl font-bold text-gray-600 leading-none text-center md:text-left">
                        {{ auth()->user()->name }}
                    </h2>
                </div>

                <!-- Data Count Info -->
                <div class="w-full bg-pink-50 rounded-xl p-6 border border-pink-200 text-center md:text-left shadow-sm">
                    <p class="text-gray-600 font-bold text-lg">Jumlah Responden :</p>
                    <p class="text-4xl font-extrabold text-pink-600 mb-2">{{ $responseCount }} <span
                            class="text-lg text-pink-400 font-medium">Orang</span></p>

                    @if($responseCount > 0)
                        <div class="mt-4 pt-4 border-t border-pink-200">
                            <p class="text-sm text-gray-500 font-semibold mb-1">Responden Terakhir:</p>
                            <p class="text-xl font-bold text-gray-800">{{ $lastRespondentName }}</p>
                            <p class="text-sm text-gray-500">{{ $lastRespondentTime }}</p>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="w-full flex flex-col items-center md:items-start space-y-4">
                    <a href="{{ route('welcome') }}"
                        class="w-full bg-green-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-xl text-lg shadow-lg transition duration-300 transform hover:scale-105 text-center flex items-center justify-center gap-2">
                        Ke Beranda
                    </a>

                    <a href="{{ route('admin.download') }}"
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-xl text-lg shadow-lg transition duration-300 transform hover:scale-105 text-center flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Hasil
                    </a>

                    <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-3 px-6 rounded-xl text-lg shadow-md transition duration-300 transform hover:scale-105">
                            Logout
                        </button>
                    </form>
                </div>

                <!-- Recent Respondents Block -->
                @if(isset($allNames) && count($allNames) > 0)
                    <div class="w-full bg-pink-50 h-dvh rounded-xl p-6 border border-pink-200 text-center shadow">

                        <p class="text-gray-600 font-bold text-lg mb-4">
                            Special Thanks to <br /> (Para Responden)
                        </p>

                        <!-- Marquee Container -->
                        <div class="relative h-full overflow-hidden w-full">

                            <div class="flex flex-col items-center gap-3 animate-marquee-vertical">

                                @foreach($allNames as $name)
                                    <span class="text-pink-600 font-bold text-xl px-4 py-1 bg-white rounded-full shadow">
                                        {{ $name }}
                                    </span>
                                @endforeach

                                @foreach($allNames as $name)
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

            <!-- Right Side: Respondent Table -->
            <div class="w-full md:w-7/12">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="p-6 bg-pink-100 border-b border-pink-200 flex flex-col justify-between items-center gap-6">
                        <div class="flex flex-col items-center gap-3 w-full md:w-auto">
                            <h3 class="text-2xl text-center font-bold text-pink-600">Daftar Responden</h3>
                            <span
                                class="bg-white text-pink-500 text-xs font-bold px-4 py-1.5 rounded-full px-4 border border-pink-200 whitespace-nowrap shadow-sm">
                                Bagian {{ $respondents->currentPage() }}
                            </span>
                        </div>

                        <form action="{{ route('admin.dashboard') }}" method="GET" class="w-full md:w-full">
                            <div class="relative w-full">
                                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari Nama..."
                                    class="w-full px-4 pr-10 py-3 rounded-full border border-pink-200 focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-200 text-base shadow-sm transition-all duration-300">
                                <button type="submit"
                                    class="absolute inset-y-0 right-0 px-4 pr-0 flex items-center hover:text-pink-600 focus:outline-none transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-center gap-4 border-collapse">
                            <thead class="bg-gray-50 mb-2">
                                <tr>
                                    <th class="py-4 px-6 font-bold text-sm text-gray-500 border-b border-gray-200">Nama Nama
                                        Responden</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-400">
                                @if(isset($respondents) && count($respondents) > 0)
                                    @foreach($respondents as $respondent)
                                        <tr class="hover:bg-pink-50 transition duration-150 group">
                                            <td
                                                class="py-6 px-6 text-gray-800 font-bold  text-lg group-hover:text-pink-600 transition-colors">
                                                {{ $respondent['nama'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="py-12 text-center text-gray-400 italic">Tidak Ada Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="p-4 border-t border-gray-200 mt-4  bg-gray-50 flex justify-center">
                        {{ $respondents->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Reset Confirmation Modal -->
        <div x-show="showResetModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Backdrop with Blur -->
            <div class="fixed inset-0 bg-gray-900/30 backdrop-blur-md transition-opacity" aria-hidden="true"
                @click="showResetModal = false"></div>

            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white rounded-4xl p-6 md:p-10 max-w-sm md:max-w-md w-full shadow-2xl transform transition-all relative">

                    <div class="text-center">
                        <h3 class="text-2xl md:text-4xl font-bold text-pink-500 mb-6 md:mb-10 leading-snug">
                            Yakin ingin<br>Menghapus ?
                        </h3>

                        <div class="flex flex-col sm:flex-row justify-center gap-3 md:gap-4">
                            <!-- Batal Button -->
                            <button @click="showResetModal = false"
                                class="bg-pink-200 hover:bg-pink-300 text-white font-bold py-2 px-6 md:py-3 md:px-10 rounded-xl text-lg md:text-xl transition duration-300 w-full sm:w-auto">
                                Batal
                            </button>

                            <!-- Oke Button (Submit Form) -->
                            <form action="{{ route('admin.reset') }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit"
                                    class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 md:py-3 md:px-12 rounded-xl text-lg md:text-xl transition duration-300 w-full">
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