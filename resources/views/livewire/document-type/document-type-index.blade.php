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
                {{ __('TIPOS DE DOCUMENTO') }}
            </flux:heading>
            <flux:text class="text-white text-sm lg:text-base font-semibold opacity-90">
                {{ __('Gestiona los tipos de documento disponibles en el sistema') }}
            </flux:text>
        </div>
    </div>

    <div>
        @session('success')
            <div class="animate-fadeIn">
                <flux:callout variant="success" icon="check-circle" heading="{{ $value }}" 
                    class="border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 rounded-r-lg shadow-lg transform transition-all duration-300 hover:scale-[1.02]" />
            </div>
        @endsession


        @can('crear-documento')
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden mt-6">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>
            
            <div class="flex-1 relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                        {{-- Icono representativo de documentos --}}
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#0D0D0D] dark:text-white">Gestión de Tipos de Documento</h3>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-12">Administra las categorías de documentos disponibles en el sistema</p>
            </div>

            <a href="{{ route('doctype.create') }}"
               class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-[#0477BF] to-[#002D64] hover:from-[#002D64] hover:to-[#0477BF] focus:ring-4 focus:outline-none focus:ring-[#0477BF]/50 dark:focus:ring-[#002D64]/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl relative z-10">
                <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="relative">Crear Tipo de Documento</span>
            </a>
        </div>
        @endcan
        
        <div class="bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-6 relative overflow-hidden mt-6">
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
                {{-- Filtro por Rol --}}
                <div class="min-w-[150px] flex-grow">
                    <label for="filterRole" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filtrar por Rol:</label>
                    <select wire:model.live="filterRole" id="filterRole" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-[#0477BF] focus:border-[#0477BF] sm:text-sm rounded-md shadow-sm transition-colors duration-200">
                        <option value="">Todos los Roles</option>
                        {{-- Asegúrate de que $roles se pasa desde el componente Livewire --}}
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Botón Limpiar Filtros --}}
                <div class="flex-shrink-0 mt-4 sm:mt-1">
                    <button wire:click="clearFilters"
                            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0477BF] transition-all duration-200 hover:scale-105 hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Limpiar Filtros
                    </button>
                </div>
            </div>
        </div>




        <div class="bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-800 mt-6">
            <div class="bg-gradient-to-r from-[#002D64] to-[#0F3D59] px-6 py-4 relative">
                <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-2 right-8 w-16 h-16 bg-[#F2CB05] rounded-full blur-2xl"></div>
                </div>
                
                <h4 class="text-lg font-semibold text-white flex items-center relative z-10">
                    Lista de Tipos de Documento
                </h4>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-[#0F3D59] text-[#002D64] dark:text-white border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-semibold">ID</th>
                            <th class="px-6 py-4 font-semibold">Nombre</th>
                            <th class="px-6 py-4 font-semibold">Requisitos</th>
                            <th class="px-6 py-4 font-semibold">Roles Permitidos</th>
                            <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($documentTypes as $docType) {{-- Cambiado de @foreach a @forelse para el mensaje de "no resultados" --}}
                        <tr class="hover:bg-gradient-to-r hover:from-[#F2CB05]/5 hover:to-[#B88900]/5 dark:hover:bg-[#0F3D59]/20 transition-all duration-300 transform hover:translate-x-1">
                            <td class="px-6 py-4 font-medium text-[#0D0D0D] dark:text-white">{{ $docType->id }}</td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $docType->nombre }}</td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($docType->requirements as $req)
                                        <flux:badge class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#F2C84B] to-[#F2CB05] text-[#0D0D0D] shadow-sm transform transition-all duration-300 hover:scale-105">{{ $req->nombre }}</flux:badge>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($docType->roles as $role)
                                        <flux:badge class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#0477BF] to-[#002D64] text-white shadow-sm transform transition-all duration-300 hover:scale-105">{{ $role->name }}</flux:badge>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2 justify-center">
                                    @can('editar-documento')
                                    <a href="{{ route('doctype.edit', $docType->id) }}"
                                       class="text-white bg-[#0477BF] hover:bg-[#002D64] focus:ring-4 focus:outline-none focus:ring-blue-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                        Editar
                                    </a>
                                    @endcan
                                    @can('eliminar-documento')
                                        <button wire:click="delete({{ $docType->id }})"
                                            wire:confirm="¿Estás seguro de eliminar?"
                                            type="button"
                                            class="text-white bg-[#F20519] hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                        Eliminar
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                    No hay tipos de documento que coincidan con los criterios de búsqueda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>