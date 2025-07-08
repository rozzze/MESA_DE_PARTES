<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Mostrar Rol') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Aqui Podra ver su Rol') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div>

        <a href="{{ route("roles.index") }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
            Regresar
        </span>
        </a>

        <div class="w-150 mt-6 space-y-6">

            <flux:input disabled label="Nombre" placeholder="{{ $role->name }}"/>

            <flux:heading>Permisos</flux:heading>
            
                @if ($role->permissions)
                {{-- Contenedor flexbox para los badges de permisos --}}
                    <div class="flex flex-wrap gap-2"> 
                    @foreach ($role->permissions as $permission)
                        <flux:badge>{{ $permission->name }}</flux:badge>
                    @endforeach
                    </div>
                @endif
        
        </div>
        
    </div>
</div>
