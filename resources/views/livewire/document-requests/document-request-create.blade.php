<div>
    {{-- 🎯 Encabezado de la Página --}}
    <div class="bg-gradient-to-r from-[#002D64] via-[#0F3D59] to-[#002D64] p-6 rounded-xl shadow-lg mb-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>

        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-4 right-4 w-24 h-24 bg-[#F2CB05] rounded-full blur-3xl"></div>
            <div class="absolute bottom-4 left-4 w-16 h-16 bg-[#B88900] rounded-full blur-2xl"></div>
        </div>

        <div class="relative z-10">
            <flux:heading class="text-[#F2CB05] text-3xl lg:text-4xl uppercase drop-shadow-md">
                {{ __('Solicitar Documento') }}
            </flux:heading>
            <flux:subheading class="text-white text-sm lg:text-base font-semibold opacity-90 mt-2">
                {{ __('Completa los pasos para solicitar un documento.') }}
            </flux:subheading>
        </div>
    </div>

    {{-- 🎯 Contenedor del formulario --}}
    <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#0477BF]/10 to-[#002D64]/10 rounded-full blur-xl"></div>

        <div class="relative z-10">
            <form wire:submit.prevent="{{ $currentStep === 1 ? 'goToStep2' : 'submit' }}" enctype="multipart/form-data" class="space-y-6">
                {{-- Paso 1: Selección del tipo de documento --}}
                @if ($currentStep === 1)
                    <div>
                        <flux:heading size="md" class="text-[#002D64] dark:text-white mb-4">Paso 1: Selecciona un tipo de documento</flux:heading>
                        <flux:select wire:model="document_type_id" label="Tipo de Documento">
                            <option value="">Selecciona un documento</option>
                            @foreach ($availableDocuments as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->nombre }}</option>
                            @endforeach
                        </flux:select>

                        @error('document_type_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="group inline-flex items-center px-6 py-2 text-sm font-semibold text-white bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-xl hover:from-[#002D64] hover:to-[#0477BF] transition-all duration-300 transform hover:scale-105 shadow-md">
                                <svg class="w-5 h-5 mr-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Siguiente
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Paso 2: Mostrar requisitos y subir archivos --}}
                @if ($currentStep === 2)
                    <div>
                        <flux:heading size="md" class="text-[#002D64] dark:text-white mb-4">Paso 2: Sube los requisitos</flux:heading>

                        @foreach ($requirements as $req)
                            <div class="mb-4">
                                <label class="block mb-1 font-medium text-[#0D0D0D] dark:text-white">{{ $req->nombre }}</label>
                                <input type="file" wire:model="files.{{ $req->id }}" class="block w-full text-sm text-gray-500 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                @error('files.' . $req->id)
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach

                        <div class="mt-6 flex justify-between">
                            <button type="button" wire:click="goBack" class="group inline-flex items-center px-6 py-2 text-sm font-semibold text-white bg-gray-500 rounded-xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Atrás
                            </button>

                            <button type="submit" class="group inline-flex items-center px-6 py-2 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-700 rounded-xl hover:from-green-700 hover:to-green-600 transition-all duration-300 transform hover:scale-105 shadow-md">
                                <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Enviar Solicitud
                            </button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
