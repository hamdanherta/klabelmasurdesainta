@extends('layouts.app')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="w-full max-w-4xl mx-auto px-2 md:px-4" x-data="{ 
        currentStep: 1, 
        totalSteps: 10,
        answers: {},
        selectAnswer(step, value) {
            this.answers['kom_' + step] = value;
        },
        nextStep() {
            if (this.currentStep < this.totalSteps) {
                this.currentStep++;
            } else {
                this.$refs.form.submit();
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

        <form x-ref="form" action="{{ route('questionnaire.store') }}" method="POST">
            @csrf

            @foreach($items as $index => $item)
                <div x-show="currentStep === {{ $loop->iteration }}" class="bg-white p-4 md:p-8 rounded-xl w-full" style="display: none;">
                    
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 md:mb-8 text-left">Kombinasi {{ $loop->iteration }}</h3>
                    
                    <!-- Color Preview Boxes -->
                    <div class="flex flex-col md:flex-row justify-center items-center gap-4 mb-8 md:mb-10 w-full">
                         <!-- Box 1: Color Pair Block -->
                        <div class="flex h-32 md:h-40 w-full md:w-1/3 shadow-md rounded-lg overflow-hidden">
                            <div class="w-1/2 h-full" style="background-color: {{ $item->warna_dominan_1 }};"></div>
                            <div class="w-1/2 h-full" style="background-color: {{ $item->warna_kombinasi }};"></div>
                        </div>

                        <!-- Box 2: Background Dominant, Text Kombinasi -->
                        <div class="h-32 md:h-40 w-full md:w-1/3 flex items-center justify-center shadow-md rounded-lg" style="background-color: {{ $item->warna_dominan_1 }};">
                            <span class="text-xl md:text-2xl font-bold" style="color: {{ $item->warna_kombinasi }};">Contoh Teks</span>
                        </div>

                         <!-- Box 3: Background Kombinasi, Text Dominant -->
                        <div class="h-32 md:h-40 w-full md:w-1/3 flex items-center justify-center shadow-md rounded-lg" style="background-color: {{ $item->warna_kombinasi }};">
                            <span class="text-xl md:text-2xl font-bold" style="color: {{ $item->warna_dominan_1 }};">Contoh Teks</span>
                        </div>
                    </div>

                    <!-- Question & Options -->
                    <div class="w-full flex flex-col md:flex-row flex-wrap items-center md:items-center justify-between mb-8 md:mb-12 gap-4">
                        <div class="flex flex-col md:flex-row items-center md:items-center space-y-4 md:space-y-0 md:space-x-6 w-full md:w-auto">
                            <p class="text-gray-600 text-lg">Apakah Kombinasi ini ...</p>
                            
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
                        <div class="text-gray-700 font-medium text-lg flex items-center whitespace-nowrap flex-shrink-0 ml-0 md:ml-4 self-end md:self-auto" x-show="isAnswered({{ $loop->iteration }})">
                            Status : <span x-text="answers['kom_{{ $loop->iteration }}'] === 'cocok' ? 'Cocok' : 'Tidak Cocok'" class="ml-1 font-bold"></span> 
                            <div class="bg-green-500 text-white rounded-md p-0.5 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Footer: Progress & Button -->
                    <div class="w-full flex flex-col-reverse md:flex-row items-end justify-between mt-auto pt-6 md:pt-8 border-t border-gray-100 gap-4 md:gap-0">
                        <div class="w-full md:w-2/3">
                            <p class="text-gray-600 mb-2 font-medium">Kombinasi <span x-text="currentStep"></span>/10</p>
                            <div class="w-full bg-yellow-100 h-3 rounded-full overflow-hidden">
                                <div class="bg-pink-500 h-full transition-all duration-500 ease-out" :style="'width: ' + ((currentStep / 10) * 100) + '%'"></div>
                            </div>
                        </div>

                        <button type="button" 
                                @click="nextStep()" 
                                :disabled="!isAnswered({{ $loop->iteration }})"
                                class="flex items-center justify-center space-x-2 border-2 border-pink-500 text-pink-500 font-bold py-2 px-8 rounded-full text-xl hover:bg-pink-500 hover:text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-transparent disabled:hover:text-pink-500 transform hover:scale-105 w-full md:w-auto">
                            <span x-text="currentStep === 10 ? 'Simpan' : 'Lanjut'">Lanjut</span>
                            <span class="text-2xl" x-show="currentStep !== 10">></span>
                        </button>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
@endsection
