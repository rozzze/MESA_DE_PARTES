<div class="w-full space-y-6">
    <div class="bg-gradient-to-r from-[#002D64] via-[#0F3D59] to-[#002D64] p-6 rounded-xl shadow-lg mb-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-4 right-4 w-24 h-24 bg-[#F2CB05] rounded-full blur-3xl"></div>
            <div class="absolute bottom-4 left-4 w-16 h-16 bg-[#B88900] rounded-full blur-2xl"></div>
        </div>

        <div class="relative z-10">
            <flux:heading class="text-[#F2CB05] text-3xl lg:text-4xl uppercase drop-shadow-md">
                {{ __('Requerimientos') }}
            </flux:heading>
            <flux:text class="text-white text-sm lg:text-base font-semibold opacity-90">
                {{ __('Maneja todos tus Requerimientos') }}
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

        @can('crear-requisito')
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden mt-6">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>
            
            <div class="flex-1 relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    {{-- MODIFICACIÓN AQUÍ: Cambiado el color de fondo del ícono a azul --}}
                    <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                        {{-- Icono representativo de requerimientos --}}
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#0D0D0D] dark:text-white">Gestión de Requerimientos</h3>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-12">Visualiza y gestiona todos los requerimientos del proyecto</p>
            </div>

            <a href="{{ route("requirements.create") }}"
               class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-[#0477BF] to-[#002D64] hover:from-[#002D64] hover:to-[#0477BF] focus:ring-4 focus:outline-none focus:ring-[#0477BF]/50 dark:focus:ring-[#002D64]/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl relative z-10">
                <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="relative">Crear Requerimiento</span>
            </a>
        </div>
        @endcan


        <div class="bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-800 mt-6">
            <div class="bg-gradient-to-r from-[#002D64] to-[#0F3D59] px-6 py-4 relative">
                <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-2 right-8 w-16 h-16 bg-[#F2CB05] rounded-full blur-2xl"></div>
                </div>
                
                <h4 class="text-lg font-semibold text-white flex items-center relative z-10">
                    Lista de Requerimientos
                </h4>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-[#0F3D59] text-[#002D64] dark:text-white border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold">
                                Descripción
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($requirements as $requirement)
                            <tr class="hover:bg-gradient-to-r hover:from-[#F2CB05]/5 hover:to-[#B88900]/5 dark:hover:bg-[#0F3D59]/20 transition-all duration-300 transform hover:translate-x-1">
                                <td class="px-6 py-4 font-medium text-[#0D0D0D] dark:text-white">{{ $requirement->id }}</td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $requirement->nombre }}</td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $requirement->descripcion }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2 justify-center">
                                        @can('editar-requisito')
                                        <a href="{{ route('requirements.edit', $requirement->id) }}"
                                           class="text-white bg-[#0477BF] hover:bg-[#002D64] focus:ring-4 focus:outline-none focus:ring-blue-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                            Editar
                                        </a>
                                        @endcan

                                        @can('eliminar-requisito')
                                        <button wire:click="delete({{ $requirement->id }})"
                                                wire:confirm="¿Estás seguro de eliminar?"
                                                type="button"
                                                class="text-white bg-[#F20519] hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                            Eliminar
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>