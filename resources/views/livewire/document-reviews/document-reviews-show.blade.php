{{-- Este div es el ÚNICO elemento raíz que Livewire espera en este archivo Blade. --}}
<div>
    {{-- 🎯 Encabezado de la Página --}}
    <div class="bg-gradient-to-r from-[#002D64] via-[#0F3D59] to-[#002D64] p-6 rounded-xl shadow-lg mb-6 relative overflow-hidden">
        {{-- Línea decorativa superior --}}
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>

        {{-- Patrones de fondo sutiles --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-4 right-4 w-24 h-24 bg-[#F2CB05] rounded-full blur-3xl"></div>
            <div class="absolute bottom-4 left-4 w-16 h-16 bg-[#B88900] rounded-full blur-2xl"></div>
        </div>

        <div class="relative z-10">
            <flux:heading class="text-[#F2CB05] text-3xl lg:text-4xl uppercase drop-shadow-md">
                {{ __('Revisión de Solicitud') }}
            </flux:heading>
            <flux:subheading class="text-white text-sm lg:text-base font-semibold opacity-90 mt-2">
                {{ __('Administra y revisa los detalles de la solicitud de documento.') }}
            </flux:subheading>
        </div>
    </div>

    {{-- 🎯 Botón de Regreso --}}
    <div class="mb-6">
        <a href="{{ route('documentreviews.index') }}"
           class="group relative inline-flex items-center justify-center px-6 py-2 overflow-hidden text-sm font-semibold rounded-xl text-[#002D64] dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-105 shadow-md">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>{{ __('Regresar a Revisiones') }}</span>
        </a>
    </div>

    {{-- 🎯 Contenedor de Detalles de la Solicitud --}}
    <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden mb-6">
        {{-- Patrón de fondo sutil --}}
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#0477BF]/10 to-[#002D64]/10 rounded-full blur-xl"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-[#0D0D0D] dark:text-white">{{ __('Detalles de la Solicitud') }}</h2>
                </div>
            </div>

            <flux:separator variant="subtle" class="mb-6" />

            <div class="space-y-4">
                {{-- Información del usuario --}}
                <div>
                    <flux:input 
                        label="Usuario" 
                        value="{{ $documentRequest->user->name }}" 
                        readonly />
                </div>

                <div>
                    <flux:input 
                        label="Correo" 
                        value="{{ $documentRequest->user->email }}" 
                        readonly />
                </div>

                <div>
                    <flux:input 
                        label="Tipo de Documento" 
                        value="{{ $documentRequest->documentType->nombre }}" 
                        readonly />
                </div>

                <div>
                    <flux:input 
                        label="Fecha de Solicitud" 
                        value="{{ $documentRequest->created_at->format('d/m/Y H:i') }}" 
                        readonly />
                </div>

                <div>
                    <flux:input 
                        label="Estado Actual" 
                        value="{{ ucfirst($documentRequest->estado) }}" 
                        readonly />
                </div>
            </div>
        </div>
    </div>

    {{-- 🎯 Contenedor de Archivos Adjuntos --}}
    <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden mb-6">
        {{-- Patrón de fondo sutil --}}
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#0477BF]/10 to-[#002D64]/10 rounded-full blur-xl"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-[#0D0D0D] dark:text-white">{{ __('Archivos Adjuntos') }}</h2>
            </div>

            <flux:separator variant="subtle" class="mb-6" />

            @if ($documentRequest->files->isNotEmpty())
                <div class="space-y-3">
                    @foreach ($documentRequest->files as $file)
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gradient-to-r from-[#F2CB05] to-[#B88900] rounded-lg shadow-sm">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium text-[#0D0D0D] dark:text-white">{{ $file->requirement->nombre }}</span>
                                </div>
                            </div>
                            <a href="{{ Storage::url($file->file_path) }}" target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] text-white text-sm font-medium rounded-lg hover:from-[#002D64] hover:to-[#0477BF] transition-all duration-300 transform hover:scale-105 shadow-md">
                                <span>{{ __('Ver archivo') }}</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-full w-16 h-16 mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('No hay archivos adjuntos para esta solicitud.') }}</p>
                </div>
            @endif
        </div>
    </div>

    {{---
    | IMPORTANTE: Esta es la sección que debes controlar.
    | Sólo debe mostrarse si la solicitud está en estado 'pendiente'.
    ---}}
    @if ($documentRequest->estado === 'pendiente')
        <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
            {{-- Patrón de fondo sutil --}}
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#0477BF]/10 to-[#002D64]/10 rounded-full blur-xl"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-[#0D0D0D] dark:text-white">{{ __('Acciones de Revisión') }}</h2>
                </div>

                <flux:separator variant="subtle" class="mb-6" />

                <div class="space-y-6">
                    {{-- Campo de observaciones --}}
                    <div>
                        <flux:textarea 
                            wire:model.defer="descripcion" 
                            label="Observaciones (opcional)" 
                            placeholder="Añade cualquier observación o comentario sobre la revisión..." 
                            rows="4" />
                    </div>

                    {{-- Campo de subida de archivo --}}
                    <div>
                        <flux:input 
                            wire:model="pdf_respuesta" 
                            type="file" 
                            label="Subir Documento de Respuesta (PDF)" />
                        @error('pdf_respuesta') 
                            <span class="mt-2 text-red-600 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Botones de acción --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button wire:click="aprobar" 
                                class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:ring-4 focus:outline-none focus:ring-green-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ __('Aprobar Solicitud') }}</span>
                        </button>

                        <button wire:click="rechazar" 
                                class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:outline-none focus:ring-red-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ __('Rechazar Solicitud') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Mensaje para solicitudes ya procesadas --}}
        <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden text-center">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>
            <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-full w-16 h-16 mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400 dark:text-gray-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-400 font-medium text-lg">
                {{ __('Esta solicitud ya ha sido ') }}
                <span class="font-semibold @if($documentRequest->estado === 'aprobado') text-green-600 @else text-red-600 @endif">
                    {{ ucfirst($documentRequest->estado) }}
                </span>
                {{ __('. No se requieren más acciones.') }}
            </p>
            @if($documentRequest->pdf_respuesta)
                <div class="mt-4">
                    <a href="{{ Storage::url($documentRequest->pdf_respuesta) }}" target="_blank"
                       class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] text-white text-base font-medium rounded-lg hover:from-[#002D64] hover:to-[#0477BF] transition-all duration-300 transform hover:scale-105 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        {{ __('Ver Documento de Respuesta') }}
                    </a>
                </div>
            @endif
        </div>
    @endif


    {{-- 🎯 Mensajes de Sesión --}}
    @if (session()->has('success'))
        <div class="mt-6 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-4 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-green-400 to-green-500"></div>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-500 rounded-lg shadow-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif
</div>