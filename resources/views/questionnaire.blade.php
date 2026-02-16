@extends('layouts.app')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="w-full max-w-4xl mx-auto px-2 md:px-4" x-data="{ 
        currentStep: 1, 
        totalSteps: 10,
        answers: {},
        showModal: false,
        selectAnswer(step, value) {
            this.answers['kom_' + step] = value;
        },
        nextStep() {
            if (this.currentStep < this.totalSteps) {
                this.currentStep++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                this.showModal = true;
                setTimeout(() => {
                    this.$refs.form.submit();
                }, 1500); // 1.5s delay to show the modal
            }
        },
        isAnswered(step) {
            return this.answers['kom_' + step] !== undefined;
        }
    }">
        <div class="text-center mb-6 md:mb-10">
            <a href="{{ route('welcome') }}" @click="if(!confirm('Apakah Anda yakin ingin ke halaman depan? Data yang belum disimpan mungkin hilang.')) { $event.preventDefault(); }">
                <img src="{{ asset('images/desainta_logo.png') }}" alt="DESAINITA Logo" class="h-12 md:h-16 mx-auto hover:opacity-80 transition duration-300">
            </a>
        </div>

        <div class="w-full flex flex-col-reverse items-center justify-between mt-auto pt-6 md:pt-8 border-t border-gray-100 gap-4 md:gap-0">
                        <div class="w-full md:w-2/3">
                            <p class="text-gray-600 mb-2 font-medium">Kombinasi ke <span x-text="currentStep"></span> dari 10</p>
                            <div class="w-full bg-yellow-100 h-3 rounded-full overflow-hidden">
                                <div class="bg-pink-500 h-full transition-all duration-500 ease-out" :style="'width: ' + ((currentStep / 10) * 100) + '%'"></div>
                            </div>
                        </div>

                        <!-- Button Moved to Top -->
                    </div>

        <form x-ref="form" action="{{ route('questionnaire.store') }}" method="POST">
            @csrf

            @foreach($items as $index => $item)
                <div x-show="currentStep === {{ $loop->iteration }}" class="bg-white p-4 md:p-8 rounded-xl w-full " style="display: none;">
                    
                    <div class="flex items-center justify-center mb-6 md:mb-8 gap-4 ">
                        <h3 class="text-xl md:text-3xl font-bold text-pink-500 text-left">Kombinasi {{ $loop->iteration }}</h3>
                    </div>
                    
                    <!-- Color Preview Boxes -->
                    <div class="flex flex-col md:flex-row justify-center items-center gap-2 mb-6 md:mb-10 w-full">
                         <!-- Box 1: Color Pair Block -->
                        <div class="flex h-32 md:h-40 w-full md:w-1/3 shadow-md rounded-lg overflow-hidden">
                            <div class="w-1/2 h-full" style="background-color: {{ $item->warna_dominan_1 }};"></div>
                            <div class="w-1/2 h-full" style="background-color: {{ $item->warna_kombinasi }};"></div>
                        </div>

                        <!-- Box 2: Background Dominant, Text Kombinasi -->
                        <div class="h-16 md:h-40 w-full md:w-1/3 flex items-center justify-center shadow-md rounded-lg" style="background-color: {{ $item->warna_dominan_1 }};">
                            <span class="text-xl md:text-2xl font-bold" style="color: {{ $item->warna_kombinasi }};">Contoh Teks</span>
                        </div>

                         <!-- Box 3: Background Kombinasi, Text Dominant -->
                        <div class="h-16 md:h-40 w-full md:w-1/3 flex items-center justify-center shadow-md rounded-lg" style="background-color: {{ $item->warna_kombinasi }};">
                            <span class="text-xl md:text-2xl font-bold" style="color: {{ $item->warna_dominan_1 }};">Contoh Teks</span>
                        </div>
                    </div>

                    <!-- Question & Options -->
                    <div class="w-full flex flex-col md:flex-row flex-wrap items-center md:items-center justify-center mb-8 md:mb-12 gap-4">
                        <div class="flex flex-col md:flex-row items-center md:items-center space-y-4 md:space-y-0 md:space-x-6 w-full md:w-auto">
                            <p class="text-gray-600 text-md">Apakah Kombinasi Warna ini ...</p>
                            
                            <div class="flex items-center justify-center space-x-4 w-full md:w-auto">
                                <label class="cursor-pointer group flex-1 md:flex-none">
                                    <input type="radio" name="kom_{{ $loop->iteration }}" value="cocok" class="hidden" @click="selectAnswer({{ $loop->iteration }}, 'cocok')">
                                    <div class="px-6 md:px-8 py-2 rounded-lg font-bold text-white text-center transition-all duration-200 transform group-hover:scale-105"
                                          :class="answers['kom_{{ $loop->iteration }}'] === 'cocok' ? 'bg-pink-500 shadow-lg scale-105' : 'bg-pink-400 hover:bg-pink-500'">
                                        Cocok
                                    </div>
                                </label>

                                <span class="text-gray-500 text-lg">atau</span>

                                <label class="cursor-pointer group flex-1 md:flex-none">
                                    <input type="radio" name="kom_{{ $loop->iteration }}" value="tidak_cocok" class="hidden" @click="selectAnswer({{ $loop->iteration }}, 'tidak_cocok')">
                                    <div class="px-6 md:px-8 py-2 rounded-lg font-bold text-white text-center transition-all duration-200 transform group-hover:scale-105"
                                          :class="answers['kom_{{ $loop->iteration }}'] === 'tidak_cocok' ? 'bg-gray-600 shadow-lg scale-105' : 'bg-gray-500 hover:bg-gray-600'">
                                        Tidak Cocok
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Status Indicator -->
                        <div class="text-gray-700 font-medium text-lg flex items-center justify-center whitespace-nowrap shrink-0 ml-0 md:ml-4 self-end md:self-auto" x-show="isAnswered({{ $loop->iteration }})">
                            Status : <span x-text="answers['kom_{{ $loop->iteration }}'] === 'cocok' ? 'Cocok' : 'Tidak Cocok'" class="ml-1 font-bold"></span> 
                            <div class="rounded-md p-0.5 ml-2" :class="answers['kom_{{ $loop->iteration }}'] === 'cocok' ? 'bg-green-500' : 'bg-red-500'">
                                <template x-if="answers['kom_{{ $loop->iteration }}'] === 'cocok'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                                <template x-if="answers['kom_{{ $loop->iteration }}'] === 'tidak_cocok'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </div>
                        </div>

                        
                    </div>
                    <div class="w-full h-fit flex items-center justify-center">
                        <button type="button" 
                                @click="nextStep()" 
                                :disabled="!isAnswered({{ $loop->iteration }})"
                                class="flex items-center justify-center space-x-2 border-2 border-pink-500 text-pink-500 font-bold py-2 px-12 md:py-3 mt-4 md:px-8 rounded-full text-lg md:text-xl hover:bg-pink-500 hover:text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-transparent disabled:hover:text-pink-500 transform hover:scale-105 shrink-0">
                            <span x-text="currentStep === 10 ? 'Simpan' : 'Lanjut'">Lanjut</span>
                            <span class="text-xl" x-show="currentStep !== 10">></span>
                        </button>
                    </div>
                </div>
            @endforeach


            <!-- Loading Modal -->
            <div x-show="showModal" 
                 class="fixed inset-0 z-9999 px-4 flex items-center justify-center bg-gray-900/60 backdrop-blur-md transition-opacity duration-300"
                 style="display: none;"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                
                <div class="bg-white rounded-3xl p-8 md:p-12 w-full max-w-2xl text-center shadow-2xl transform transition-transform duration-300"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100">
                    
                    <!-- Spinner Container -->
                    <div class="mb-8 w-20 h-20 mx-auto relative shrink-0">
                         <div class="loading-spinner">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                         </div>
                    </div>

                    <!-- Text Content -->
                    <div class="flex flex-col gap-2">
                        <h2 class="text-3xl font-bold text-gray-700 leading-tight">Proses Menyimpan</h2>
                        <p class="text-gray-500 text-xl font-medium">Tunggu Sebentar</p>
                    </div>
                </div>
            </div>

            <style>
                .loading-spinner {
                    color: #ec4899;
                    display: inline-block;
                    position: relative;
                    width: 80px;
                    height: 80px;
                }
                .loading-spinner div {
                    transform-origin: 40px 40px;
                    animation: loading-spinner 1.2s linear infinite;
                }
                .loading-spinner div:after {
                    content: " ";
                    display: block;
                    position: absolute;
                    top: 3px;
                    left: 37px; /* (80-6)/2 = 37 centered horizontally relative to axis? width is 6. 37+3=40. yes. */
                    width: 6px;
                    height: 18px;
                    border-radius: 20%;
                    background: #ec4899;
                }
                .loading-spinner div:nth-child(1) { transform: rotate(0deg); animation-delay: -1.1s; }
                .loading-spinner div:nth-child(2) { transform: rotate(45deg); animation-delay: -1.0s; }
                .loading-spinner div:nth-child(3) { transform: rotate(90deg); animation-delay: -0.9s; }
                .loading-spinner div:nth-child(4) { transform: rotate(135deg); animation-delay: -0.8s; }
                .loading-spinner div:nth-child(5) { transform: rotate(180deg); animation-delay: -0.7s; }
                .loading-spinner div:nth-child(6) { transform: rotate(225deg); animation-delay: -0.6s; }
                .loading-spinner div:nth-child(7) { transform: rotate(270deg); animation-delay: -0.5s; }
                .loading-spinner div:nth-child(8) { transform: rotate(315deg); animation-delay: -0.4s; }
                @keyframes loading-spinner {
                    0% { opacity: 1; }
                    100% { opacity: 0; }
                }
            </style>

        </form>
    </div>
@endsection
