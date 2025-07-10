<div class="w-full space-y-6">
    <div class="bg-gradient-to-r from-[#002D64] via-[#0F3D59] to-[#002D64] p-6 rounded-xl shadow-lg mb-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-4 right-4 w-24 h-24 bg-[#F2CB05] rounded-full blur-3xl"></div>
            <div class="absolute bottom-4 left-4 w-16 h-16 bg-[#B88900] rounded-full blur-2xl"></div>
        </div>

        <div class="relative z-10">
            {{-- Título principal en MAYÚSCULAS, sin negrita --}}
            <flux:heading class="text-[#F2CB05] text-3xl lg:text-4xl uppercase drop-shadow-md">
                {{ __('REVISIÓN DE SOLICITUDES') }}
            </flux:heading>
            <flux:text class="text-white text-sm lg:text-base font-semibold opacity-90">
                {{ __('Lista de todas las solicitudes realizadas por los usuarios, con opciones de filtrado.') }}
            </flux:text>
        </div>
    </div>

    {{-- Área de Filtros --}}
    <div class="bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>

        <div class="flex items-center gap-3 mb-4">
            <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                {{-- Icono representativo de filtros/busqueda --}}
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01.293.707l3 3A1 1 0 0121 10v6a1 1 0 01-1 1h-3.414a1 1 0 01-.707.293l-3 3A1 1 0 0113 20h-2a1 1 0 01-1-1v-2.586a1 1 0 01-.293-.707l-3-3A1 1 0 013 10V4z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-[#0D0D0D] dark:text-white">Opciones de Filtrado</h3>
        </div>

        <div class="flex flex-wrap items-end gap-4 relative z-10">
            {{-- Filtro por Estado --}}
            <div class="min-w-[150px] flex-grow">
                <label for="filterEstado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado:</label>
                <select wire:model.live="filterEstado" id="filterEstado" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-[#0477BF] focus:border-[#0477BF] sm:text-sm rounded-md shadow-sm transition-colors duration-200">
                    <option value="">Todos los Estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="aprobado">Aprobado</option>
                    <option value="rechazado">Rechazado</option>
                </select>
            </div>

            {{-- Filtro por Fecha Desde --}}
            <div class="min-w-[150px] flex-grow">
                <label for="filterDateFrom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Desde:</label>
                <input type="date" wire:model.live="filterDateFrom" id="filterDateFrom"
                       class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-[#0477BF] focus:border-[#0477BF] sm:text-sm rounded-md shadow-sm transition-colors duration-200">
            </div>

            {{-- Filtro por Fecha Hasta --}}
            <div class="min-w-[150px] flex-grow">
                <label for="filterDateTo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Hasta:</label>
                <input type="date" wire:model.live="filterDateTo" id="filterDateTo"
                       class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-[#0477BF] focus:border-[#0477BF] sm:text-sm rounded-md shadow-sm transition-colors duration-200">
            </div>

            {{-- Botón Limpiar Filtros --}}
            <div class="flex-shrink-0 mt-4 sm:mt-1"> {{-- Adjusted margin for alignment --}}
                <button wire:click="clearFilters"
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0477BF] transition-all duration-200 hover:scale-105 hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Limpiar Filtros
                </button>
            </div>
        </div>
    </div>

    {{-- Tabla de Solicitudes --}}
    <div class="bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-800 mt-6">
        <div class="bg-gradient-to-r from-[#002D64] to-[#0F3D59] px-6 py-4 relative">
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-2 right-8 w-16 h-16 bg-[#F2CB05] rounded-full blur-2xl"></div>
            </div>
            
            <h4 class="text-lg font-semibold text-white flex items-center relative z-10">
                Lista de Solicitudes de Revisión
            </h4>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-[#0F3D59] text-[#002D64] dark:text-white border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold">#</th>
                        <th class="px-6 py-4 font-semibold">Usuario</th>
                        <th class="px-6 py-4 font-semibold">Documento</th>
                        <th class="px-6 py-4 font-semibold">Estado</th>
                        <th class="px-6 py-4 font-semibold">Fecha</th>
                        <th class="px-6 py-4 font-semibold text-center">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($solicitudes as $solicitud)
                        <tr class="hover:bg-gradient-to-r hover:from-[#F2CB05]/5 hover:to-[#B88900]/5 dark:hover:bg-[#0F3D59]/20 transition-all duration-300 transform hover:translate-x-1">
                            {{-- Numera correctamente con paginación --}}
                            <td class="px-6 py-4 font-medium text-[#0D0D0D] dark:text-white">{{ $solicitudes->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $solicitud->user->name }}</td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $solicitud->documentType->nombre }}</td>
                            <td class="px-6 py-4">
                                {{-- Usando estilos de badge consistentes --}}
                                @switch($solicitud->estado)
                                    @case('pendiente')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#F2C84B] to-[#F2CB05] text-[#0D0D0D] shadow-sm transform transition-all duration-300 hover:scale-105">
                                            {{ ucfirst($solicitud->estado) }}
                                        </span>
                                        @break
                                    @case('aprobado')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#0477BF] to-[#002D64] text-white shadow-sm transform transition-all duration-300 hover:scale-105">
                                            {{ ucfirst($solicitud->estado) }}
                                        </span>
                                        @break
                                    @case('rechazado')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#F20519] to-red-600 text-white shadow-sm transform transition-all duration-300 hover:scale-105">
                                            {{ ucfirst($solicitud->estado) }}
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('documentreviews.show', $solicitud->id) }}"
                                   class="text-white bg-[#0477BF] hover:bg-[#002D64] focus:ring-4 focus:outline-none focus:ring-blue-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                    Mostrar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                No hay solicitudes que coincidan con los criterios de búsqueda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Enlaces de Paginación de Livewire --}}
        <div class="mt-6 px-6 py-4 bg-gray-50 dark:bg-[#0F3D59] rounded-b-2xl border-t border-gray-200 dark:border-gray-700">
            {{ $solicitudes->links() }}
        </div>
    </div>
</div>