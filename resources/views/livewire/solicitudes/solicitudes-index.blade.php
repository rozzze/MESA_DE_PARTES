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
                {{ __('SOLICITUDES DISPONIBLES') }}
            </flux:heading>
            <flux:text class="text-white text-sm lg:text-base font-semibold opacity-90">
                {{ __('Aquí puedes ver el estado de tus solicitudes enviadas') }}
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

        <div class="bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-800 mt-6">
            <div class="bg-gradient-to-r from-[#002D64] to-[#0F3D59] px-6 py-4 relative">
                <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#F2CB05] via-[#B88900] to-[#F2CB05]"></div>
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-2 right-8 w-16 h-16 bg-[#F2CB05] rounded-full blur-2xl"></div>
                </div>
                
                <h4 class="text-lg font-semibold text-white flex items-center relative z-10">
                    Lista de Solicitudes
                </h4>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-[#0F3D59] text-[#002D64] dark:text-white border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-semibold">#</th>
                            <th class="px-6 py-4 font-semibold">Tipo de Documento</th>
                            <th class="px-6 py-4 font-semibold">Estado</th>
                            <th class="px-6 py-4 font-semibold">Fecha</th>
                            <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($solicitudes as $index => $solicitud)
                            <tr class="hover:bg-gradient-to-r hover:from-[#F2CB05]/5 hover:to-[#B88900]/5 dark:hover:bg-[#0F3D59]/20 transition-all duration-300 transform hover:translate-x-1">
                                <td class="px-6 py-4 font-medium text-[#0D0D0D] dark:text-white">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                                    {{ $solicitud->documentType->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    @switch($solicitud->estado)
                                        @case('pendiente')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#F2C84B] to-[#F2CB05] text-[#0D0D0D] shadow-sm transform transition-all duration-300 hover:scale-105">
                                                Pendiente
                                            </span>
                                            @break
                                        @case('aprobado')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#0477BF] to-[#002D64] text-white shadow-sm transform transition-all duration-300 hover:scale-105">
                                                Aprobado
                                            </span>
                                            @break
                                        @case('rechazado')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[#F20519] to-red-600 text-white shadow-sm transform transition-all duration-300 hover:scale-105">
                                                Rechazado
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                                    {{ $solicitud->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2 justify-center">
                                        {{-- Botón Eliminar --}}
                                        <button wire:click="delete({{ $solicitud->id }})" wire:confirm="¿Estás seguro de eliminar?"
                                            type="button"
                                            class="text-white bg-[#F20519] hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                            Eliminar
                                        </button>

                                        {{-- Botón Ver Respuesta solo si está aprobado --}}
                                        @if ($solicitud->estado === 'aprobado' && $solicitud->respuesta_path)
                                            <a href="{{ Storage::url($solicitud->respuesta_path) }}" target="_blank"
                                                class="text-white bg-[#0477BF] hover:bg-[#002D64] focus:ring-4 focus:outline-none focus:ring-blue-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                                Ver Respuesta
                                            </a>
                                        @endif

                                        @if ($solicitud->estado === 'aprobado' || $solicitud->estado === 'rechazado')
                                        <button
                                            onclick="Swal.fire({
                                                icon: 'info',
                                                title: 'Observación del Administrador',
                                                text: '{{ addslashes($solicitud->observaciones) }}',
                                                confirmButtonText: 'Cerrar'
                                            })"
                                            type="button"
                                            class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300/50 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                            Ver Observación
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                    No has realizado solicitudes aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>