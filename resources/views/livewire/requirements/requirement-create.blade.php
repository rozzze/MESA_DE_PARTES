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
                {{ __('Crear Requerimiento') }}
            </flux:heading>
            <flux:subheading class="text-white text-sm lg:text-base font-semibold opacity-90 mt-2">
                {{ __('Formulario para crear un nuevo requerimiento en el sistema.') }}
            </flux:subheading>
        </div>
    </div>

    {{-- 🎯 Contenedor principal del formulario --}}
    <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
        {{-- Patrón de fondo sutil --}}
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#0477BF]/10 to-[#002D64]/10 rounded-full blur-xl"></div>

        <div class="relative z-10"> {{-- Contenido del formulario --}}
            <div class="flex items-center justify-between mb-6">
                {{-- Título de la sección del formulario --}}
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-[#0D0D0D] dark:text-white">{{ __('Datos del Requerimiento') }}</h2>
                </div>

                {{-- Botón de Regresar --}}
                <a href="{{ route('requirements.index') }}"
                   class="group relative inline-flex items-center justify-center px-6 py-2 overflow-hidden text-sm font-semibold rounded-xl text-[#002D64] dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-105 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>{{ __('Regresar') }}</span>
                </a>
            </div>

            <flux:separator variant="subtle" class="mb-6" />

            <form wire:submit="submit" class="mt-6 space-y-6">
                {{-- Campos de formulario --}}
                <flux:input wire:model="nombre" label="{{ __('Nombre del Requerimiento') }}" placeholder="{{ __('Ej: Solicitud de certificado') }}" />
                <flux:input wire:model="descripcion" label="{{ __('Descripción') }}" placeholder="{{ __('Detalles del requerimiento, propósito, etc.') }}" />

                {{-- Botón de Envío --}}
                <div class="flex justify-end pt-4">
                    <button type="submit"
                            class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-[#0477BF] to-[#002D64] hover:from-[#002D64] hover:to-[#0477BF] focus:ring-4 focus:outline-none focus:ring-[#0477BF]/50 dark:focus:ring-[#002D64]/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('Guardar Requerimiento') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
