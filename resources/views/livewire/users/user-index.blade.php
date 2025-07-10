<div class="w-full space-y-6">
    {{-- 🎯 Encabezado de Usuarios con estilo de Dashboard --}}
    <div class="bg-gradient-to-r from-[#002D64] via-[#0F3D59] to-[#002D64] p-6 rounded-xl shadow-lg mb-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-4 right-4 w-24 h-24 bg-[#F2CB05] rounded-full blur-3xl"></div>
            <div class="absolute bottom-4 left-4 w-16 h-16 bg-[#B88900] rounded-full blur-2xl"></div>
        </div>

        <div class="relative z-10"> {{-- Asegura que el texto esté sobre los patrones --}}
            <flux:heading class="text-[#F2CB05] text-3xl lg:text-4xl font-bold drop-shadow-md">
                USUARIOS
            </flux:heading>
            <flux:text class="text-white text-sm lg:text-base font-semibold opacity-90">
                Maneja todos tus Usuarios
            </flux:text>
        </div>
    </div>

    @session('success')
        <div class="animate-fadeIn">
            <flux:callout variant="success" icon="check-circle" heading="{{ $value }}" 
                class="border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 rounded-r-lg shadow-lg transform transition-all duration-300 hover:scale-[1.02]" />
        </div>
    @endsession

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>
        
        <div class="flex-1 relative z-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#0D0D0D] dark:text-white">Gestión de Usuarios</h3>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 ml-12">Administra los usuarios del sistema de forma eficiente</p>
        </div>
        
        <a href="{{ route('users.create') }}"
           class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-[#B88900] to-[#F2C84B] hover:from-[#B88900] hover:to-[#F2CB05] focus:ring-4 focus:outline-none focus:ring-[#F2CB05]/50 dark:focus:ring-[#B88900]/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl relative z-10">
            <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span class="relative">Crear Usuario</span>
        </a>
    </div>

    <div class="bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-800">
        <div class="bg-gradient-to-r from-[#002D64] to-[#0F3D59] px-6 py-4 relative">
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-2 right-8 w-16 h-16 bg-[#F2CB05] rounded-full blur-2xl"></div>
            </div>
            
            <h4 class="text-lg font-semibold text-white flex items-center relative z-10">
                Lista de Usuarios
            </h4>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-300">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-[#0F3D59] text-[#002D64] dark:text-white border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold">ID</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Nombre</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Correo</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Rol</th>
                        <th scope="col" class="px-6 py-4 font-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gradient-to-r hover:from-[#F2CB05]/5 hover:to-[#B88900]/5 dark:hover:bg-[#0F3D59]/20 transition-all duration-300 transform hover:translate-x-1">
                            <td class="px-6 py-4 font-medium text-[#0D0D0D] dark:text-white">{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-[#B88900] to-[#F2C84B] rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-lg transform transition-all duration-300 hover:scale-110">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-[#0D0D0D] dark:text-white">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Usuario #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if ($user->roles)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($user->roles as $role)
                                            <flux:badge class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#F2C84B] to-[#F2CB05] text-[#0D0D0D] shadow-sm transform transition-all duration-300 hover:scale-105">{{ $role->name }}</flux:badge>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2 justify-center">
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="text-white bg-[#002D64] hover:bg-[#0F3D59] focus:ring-4 focus:outline-none focus:ring-[#0477BF]/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                        Mostrar
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="text-white bg-[#0477BF] hover:bg-[#002D64] focus:ring-4 focus:outline-none focus:ring-blue-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                        Editar
                                    </a>
                                    <button wire:click="delete({{ $user->id }})"
                                            wire:confirm="Estas seguro de eliminar?"
                                            type="button"
                                            class="text-white bg-[#F20519] hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>