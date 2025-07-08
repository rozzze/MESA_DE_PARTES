<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Mis Solicitudes') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Aquí puedes ver el estado de tus solicitudes enviadas') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @session('success')
        <div class="mt-4 py-6">
            <flux:callout variant="success" icon="check-circle" heading="{{ $value }}" />
        </div>
    @endsession

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Tipo de Documento</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($solicitudes as $index => $solicitud)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-2 text-gray-700 dark:text-gray-300">
                            {{ $solicitud->documentType->nombre }}
                        </td>
                        <td class="px-6 py-2">
                            @switch($solicitud->estado)
                                @case('pendiente')
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded dark:bg-yellow-800 dark:text-yellow-100">
                                        Pendiente
                                    </span>
                                    @break
                                @case('aprobado')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded dark:bg-green-800 dark:text-green-100">
                                        Aprobado
                                    </span>
                                    @break
                                @case('rechazado')
                                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded dark:bg-red-800 dark:text-red-100">
                                        Rechazado
                                    </span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-2 text-gray-700 dark:text-gray-300">
                            {{ $solicitud->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-2 flex flex-wrap gap-2">
                            {{-- Botón Eliminar --}}
                            <button wire:click="delete({{ $solicitud->id }})" wire:confirm="¿Estás seguro de eliminar?"
                                type="button"
                                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Eliminar
                            </button>

                            {{-- Botón Ver Respuesta solo si está aprobado --}}
                            @if ($solicitud->estado === 'aprobado' && $solicitud->respuesta_path)
                                <a href="{{ Storage::url($solicitud->respuesta_path) }}" target="_blank"
                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Ver Respuesta
                                </a>
                            @endif

                            @if ($solicitud->estado === 'aprobado' | $solicitud->estado === 'rechazado')
                            <button
                                onclick="Swal.fire({
                                    icon: 'info',
                                    title: 'Observación del Administrador',
                                    text: '{{ addslashes($solicitud->observaciones) }}',
                                    confirmButtonText: 'Cerrar'
                                })"
                                type="button"
                                class="text-white bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 shadow-lg shadow-gray-500/50 dark:shadow-lg dark:shadow-gray-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Ver Observación
                            </button>

                            @endif
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
