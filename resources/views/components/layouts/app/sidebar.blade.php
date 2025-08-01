<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:sidebar sticky stashable style="background-color: white;" class="border-e-4 border-[#0477BF] bg-[#FFFFFC] text-[#0477BF] dark:bg-[#000000] dark:text-[#0477BF]">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Plataforma')" class="grid font-bold">
                <flux:navlist.item icon="academic-cap" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    <span class="font-bold">{{ __('Dashboard') }}</span>
                </flux:navlist.item>

                @can('ver-usuarios')
                    <flux:navlist.item icon="users" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>
                        <span class="font-bold">{{ __('Usuarios') }}</span>
                    </flux:navlist.item>
                @endcan

                @can('ver-requisitos')
                <flux:navlist.item icon="clipboard-document-list" :href="route('requirements.index')" :current="request()->routeIs('requirements.index')" wire:navigate>
                    <span class="font-bold">{{ __('Requisitos') }}</span>
                </flux:navlist.item>
                @endcan

                @can('ver-documentos')
                <flux:navlist.item icon="document-chart-bar" :href="route('doctype.index')" :current="request()->routeIs('doctype.index')" wire:navigate>
                    <span class="font-bold">{{ __('Documentos Disponibles') }}</span>
                </flux:navlist.item>
                @endcan

                @can('ver-mis-solicitudes')
                <flux:navlist.item icon="document-text" :href="route('solicitudes.index')" :current="request()->routeIs('solicitudes.index')" wire:navigate>
                    <span class="font-bold">{{ __('Mis Solicitudes') }}</span>
                </flux:navlist.item>
                @endcan

                @can('ver-solicitudes')
                <flux:navlist.item icon="building-library" :href="route('documentreviews.index')" :current="request()->routeIs('documentreviews.index')" wire:navigate>
                    <span class="font-bold">{{ __('Administracion') }}</span>
                </flux:navlist.item>
                @endcan

                @can('administrar-roles')
                <flux:navlist.item icon="link-slash" :href="route('roles.index')" :current="request()->routeIs('roles.index')" wire:navigate>
                    <span class="font-bold">{{ __('Roles') }}</span>
                </flux:navlist.item>
                @endcan
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        {{-- Menú usuario escritorio --}}
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()" icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @stack('scripts')
    @fluxScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>