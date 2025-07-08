<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Usuarios') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Maneja todos tus Usuarios') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div>

        @session('success')

            <div class="mt-4 py-6">
                <flux:callout variant="success" icon="check-circle" heading="{{ $value }}" />
            </div>

        @endsession

        <a href="{{ route("users.create") }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
            Create User
        </span>
        </a>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rol
                        </th>
                        <th scope="col" class="px-6 py-3 w-100">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">{{ $user->id }}</td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $user->name }}</td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>

                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            @if ($user->roles)
                                {{-- Contenedor flexbox para los badges de permisos --}}
                                <div class="flex flex-wrap gap-2"> 
                                    @foreach ($user->roles as $role)
                                        <flux:badge>{{ $role->name }}</flux:badge>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-2">

                            <a href="{{ route('users.show', $user->id) }}" type="button" class="mr-2 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Mostrar
                            </a>

                            <a href="{{ route('users.edit', $user->id) }}" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                                Editar
                            </a>

                            <button wire:click="delete({{ $user->id }})" wire:confirm="Estas seguro de eliminar?" type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
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
