<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Tipos de Documento') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gestiona los tipos de documento disponibles en el sistema') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div>
        @session('success')
            <div class="mt-4 py-6">
                <flux:callout variant="success" icon="check-circle" heading="{{ $value }}" />
            </div>
        @endsession

        <a href="{{ route('doctype.create') }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                Crear Tipo de Documento
            </span>
        </a>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800">ID</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Requisitos</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Roles Permitidos</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentTypes as $docType)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">{{ $docType->id }}</td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $docType->nombre }}</td>

                        <!-- Requisitos -->
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($docType->requirements as $req)
                                    <flux:badge>{{ $req->nombre }}</flux:badge>
                                @endforeach
                            </div>
                        </td>

                        <!-- Roles -->
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($docType->roles as $role)
                                    <flux:badge variant="secondary">{{ $role->name }}</flux:badge>
                                @endforeach
                            </div>
                        </td>

                        <td class="px-6 py-2 flex flex-wrap gap-2">
                            <a href="{{ route('doctype.edit', $docType->id) }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Editar
                            </a>
                            <button wire:click="delete({{ $docType->id }})" wire:confirm="¿Estás seguro de eliminar?" type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
