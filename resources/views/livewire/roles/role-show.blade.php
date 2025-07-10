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
                {{ __('Detalles del Rol') }}
            </flux:heading>
            <flux:subheading class="text-white text-sm lg:text-base font-semibold opacity-90 mt-2">
                {{ __('Aquí podrá ver la información completa y los permisos asignados a este rol.') }}
            </flux:subheading>
        </div>
    </div>

    {{-- 🎯 Contenedor principal para mostrar los datos --}}
    <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
        {{-- Patrón de fondo sutil --}}
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#0477BF]/10 to-[#002D64]/10 rounded-full blur-xl"></div>

        <div class="relative z-10"> {{-- Contenido de los datos --}}
            <div class="flex items-center justify-between mb-6">
                {{-- Título de la sección de visualización --}}
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-2 8a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-[#0D0D0D] dark:text-white">{{ __('Información del Rol') }}</h2>
                </div>

                {{-- Botón de Regresar --}}
                <a href="{{ route('roles.index') }}"
                   class="group relative inline-flex items-center justify-center px-6 py-2 overflow-hidden text-sm font-semibold rounded-xl text-[#002D64] dark:text-white bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-105 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>{{ __('Regresar') }}</span>
                </a>
            </div>

            <flux:separator variant="subtle" class="mb-6" />

            <div class="mt-6 space-y-6">
                {{-- Campo de nombre del rol --}}
                {{-- Usamos `value` en lugar de `placeholder` para mostrar el dato real --}}
                <flux:input disabled label="{{ __('Nombre del Rol') }}" value="{{ $role->name }}" />

                {{-- Sección de Permisos --}}
                <h3 class="text-lg font-semibold text-[#0D0D0D] dark:text-white mt-8 mb-4">{{ __('Permisos Asignados') }}</h3>
                
                @if ($role->permissions && $role->permissions->isNotEmpty())
                    {{-- Contenedor flexbox para los badges de permisos --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach ($role->permissions as $permission)
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-[#F2CB05]/20 text-[#B88900] dark:bg-[#B88900]/20 dark:text-[#F2CB05]">{{ $permission->name }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Este rol no tiene permisos asignados.') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
