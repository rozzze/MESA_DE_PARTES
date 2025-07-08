<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-10 w-100 flex-1 flex-col gap-4 rounded-xl">
        <flux:heading>Bienvenido, {{ auth()->user()->name }}</flux:heading>

        @foreach (auth()->user()->getRoleNames() as $role)
            <flux:text class="mt-2">Tu rol es: {{ $role }}</flux:text>
        @endforeach
    </div>

    {{-- Botones de acceso rápido --}}
    <div class="flex flex-wrap gap-4 mt-6">
        <a href="{{ route('docrequest.create') }}" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                Crear Solicitud
            </span>
        </a>

        @if(auth()->user()->hasRole('ADMIN'))
            <a href="{{ route('documentreviews.index') }}" class="inline-block text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-lg font-medium">
                Revisión de Solicitudes
            </a>
        @endif
    </div>

    {{-- Tarjetas de resumen --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
            <p class="text-sm text-gray-500 dark:text-gray-400">Solicitudes Totales</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ \App\Models\DocumentRequest::count() }}
            </p>
        </div>
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
            <p class="text-sm text-gray-500 dark:text-gray-400">Aprobadas</p>
            <p class="text-2xl font-bold text-green-600">
                {{ \App\Models\DocumentRequest::where('estado', 'aprobado')->count() }}
            </p>
        </div>
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
            <p class="text-sm text-gray-500 dark:text-gray-400">Rechazadas</p>
            <p class="text-2xl font-bold text-red-600">
                {{ \App\Models\DocumentRequest::where('estado', 'rechazado')->count() }}
            </p>
        </div>
    </div>

{{-- Gráfico de Solicitudes por Estado --}}
    {{-- Asegúrate de que este div está dentro de tu contenedor principal del dashboard, por ejemplo, dentro de 'container mx-auto px-4 py-8' --}}
    <div class="grid grid-cols-1 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Distribución de Solicitudes por Estado</h2>
            <canvas id="solicitudesChart" class="max-h-96"></canvas>
        </div>
    </div>

    {{-- Script de Chart.js --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Función para inicializar o actualizar el gráfico
            function initializeChart() {
                const ctx = document.getElementById('solicitudesChart');

                if (ctx) {
                    // Destruir cualquier instancia de Chart.js existente en este canvas
                    if (window.solicitudesChartInstance) {
                        window.solicitudesChartInstance.destroy();
                    }

                    const data = {
                        pendiente: {{ \App\Models\DocumentRequest::where('user_id', auth()->id())->where('estado', 'pendiente')->count() }},
                        aprobado: {{ \App\Models\DocumentRequest::where('user_id', auth()->id())->where('estado', 'aprobado')->count() }},
                        rechazado: {{ \App\Models\DocumentRequest::where('user_id', auth()->id())->where('estado', 'rechazado')->count() }}
                    };

                    window.solicitudesChartInstance = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Pendiente', 'Aprobado', 'Rechazado'],
                            datasets: [{
                                label: 'Cantidad de Solicitudes',
                                data: [data.pendiente, data.aprobado, data.rechazado],
                                backgroundColor: [
                                    'rgba(255, 206, 86, 0.8)',
                                    'rgba(75, 192, 192, 0.8)',
                                    'rgba(255, 99, 132, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        boxWidth: 20
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed !== null) {
                                                label += context.parsed + ' solicitudes';
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            // 1. Ejecutar cuando el DOM está completamente cargado (para la primera carga de la página)
            document.addEventListener('DOMContentLoaded', initializeChart);

            // 2. Ejecutar cuando Livewire navega (para navegaciones SPA)
            document.addEventListener('livewire:navigated', initializeChart);
        </script>
    @endpush

    {{-- Lista de últimas solicitudes --}}
    <div class="mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Últimas Solicitudes</h2>
        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
            @foreach (\App\Models\DocumentRequest::latest()->take(5)->get() as $solicitud)
                <li class="border-b pb-2">
                    {{ $solicitud->user->name }} solicitó <strong>{{ $solicitud->documentType->nombre }}</strong>
                    <span class="text-sm text-gray-500">({{ $solicitud->created_at->format('d/m/Y H:i') }})</span>
                </li>
            @endforeach
        </ul>
    </div>

</x-layouts.app>
