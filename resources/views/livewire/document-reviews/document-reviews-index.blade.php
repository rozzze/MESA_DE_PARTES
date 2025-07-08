<div class="max-w-7xl mx-auto p-6 bg-white shadow-xl rounded-lg my-8">
    <div class="relative mb-6 w-full">
        {{-- Encabezado usando componentes Flux --}}
        <flux:heading size="xl" level="1">{{ __('Revisión de Solicitudes') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Lista de todas las solicitudes realizadas por los usuarios, con opciones de filtrado.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Área de Filtros --}}
    <div class="mb-6 p-4 bg-gray-50 rounded-lg shadow-sm flex flex-wrap items-end gap-4">
        {{-- Filtro por Estado --}}
        <div>
            <label for="filterEstado" class="block text-sm font-medium text-gray-700 mb-1">Filtrar por Estado:</label>
            <select wire:model.live="filterEstado" id="filterEstado" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                <option value="">Todos los Estados</option>
                <option value="pendiente">Pendiente</option>
                <option value="aprobado">Aprobado</option>
                <option value="rechazado">Rechazado</option>
            </select>
        </div>

        {{-- Filtro por Fecha Desde --}}
        <div>
            <label for="filterDateFrom" class="block text-sm font-medium text-gray-700 mb-1">Fecha Desde:</label>
            <input type="date" wire:model.live="filterDateFrom" id="filterDateFrom"
                   class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
        </div>

        {{-- Filtro por Fecha Hasta --}}
        <div>
            <label for="filterDateTo" class="block text-sm font-medium text-gray-700 mb-1">Fecha Hasta:</label>
            <input type="date" wire:model.live="filterDateTo" id="filterDateTo"
                   class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
        </div>

        {{-- Botón Limpiar Filtros --}}
        <div class="flex-grow flex justify-end">
            <button wire:click="clearFilters"
                    class="ml-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Limpiar Filtros
            </button>
        </div>
    </div>

    {{-- Tabla de Solicitudes --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Usuario</th>
                    <th class="px-6 py-3">Documento</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($solicitudes as $solicitud)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        {{-- Numera correctamente con paginación --}}
                        <td class="px-6 py-2">{{ $solicitudes->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-2">{{ $solicitud->user->name }}</td>
                        <td class="px-6 py-2">{{ $solicitud->documentType->nombre }}</td>
                        <td class="px-6 py-2">
                            {{-- Usando flux:badge para el estado --}}
                            <flux:badge variant="{{ $solicitud->estado == 'aprobado' ? 'success' : ($solicitud->estado == 'rechazado' ? 'destructive' : 'warning') }}">
                                {{ ucfirst($solicitud->estado) }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-2">{{ $solicitud->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-2">
                            <a href="{{ route('documentreviews.show', $solicitud->id) }}"
                                class="text-white bg-gradient-to-r from-purple-500 to-purple-700 hover:from-purple-600 hover:to-purple-800 font-medium rounded-lg text-sm px-4 py-2">
                                Show
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
    <div class="mt-6">
        {{ $solicitudes->links() }}
    </div>
</div>