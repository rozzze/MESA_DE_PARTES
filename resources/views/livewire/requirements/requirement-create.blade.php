<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Crear Requerimiendo') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Formulario para crear nuevo Requerimiendo') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div>

        <a href="{{ route("requirements.index") }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
            Regresar
        </span>
        </a>

        <div class="w-150">
            <form wire:submit="submit" class="mt-6 space-y-6">
                <flux:input wire:model="nombre" label="Nombre" placeholder="Nombre" />
                <flux:input wire:model="descripcion" label="Descripcion" placeholder="Descripcion" />

                <button type="submit" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Enviar
                </button>

            </form>

        </div>
        
    </div>
</div>

