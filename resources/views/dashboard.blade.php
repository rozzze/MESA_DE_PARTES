<x-layouts.app :title="__('Dashboard')">
    {{-- 🎯 Header de bienvenida --}}
    <div class="bg-gradient-to-r from-[#002D64] via-[#0F3D59] to-[#002D64] p-6 rounded-xl shadow-lg mb-6 relative overflow-hidden">
        {{-- Se eliminó la línea amarilla superior --}}
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-4 right-4 w-24 h-24 bg-[#F2CB05] rounded-full blur-3xl"></div>
            <div class="absolute bottom-4 left-4 w-16 h-16 bg-[#B88900] rounded-full blur-2xl"></div>
        </div>

        <div class="relative z-10">
            <flux:heading class="text-[#F2CB05] text-3xl lg:text-4xl uppercase drop-shadow-md">
                BIENVENID@, {{ auth()->user()->name }}
            </flux:heading>
            @foreach (auth()->user()->getRoleNames() as $role)
                <flux:text class="text-white text-sm lg:text-base font-semibold opacity-90">
                    Tu rol es: {{ $role }}
                </flux:text>
            @endforeach
        </div>
    </div>

    
    <div class="flex flex-col sm:flex-row gap-4 mb-6 p-6 bg-white dark:bg-[#0D0D0D] rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>
        
        <div class="flex-1 flex flex-col sm:flex-row gap-4 relative z-10 items-center justify-start">
            <h3 class="text-lg font-semibold text-[#0D0D0D] dark:text-white mr-4 hidden sm:block">Acciones Rápidas:</h3>

            @can('crear-solicitud')
            <a href="{{ route('docrequest.create') }}" 
               class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-[#0477BF] to-[#002D64] hover:from-[#002D64] hover:to-[#0477BF] focus:ring-4 focus:outline-none focus:ring-[#0477BF]/50 dark:focus:ring-[#002D64]/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span>Nueva Solicitud</span>
            </a>
            @endcan

            @if(auth()->user()->hasRole('ADMIN'))
                <a href="{{ route('documentreviews.index') }}" 
                   class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-[#0F3D59] to-[#002D64] hover:from-[#002D64] hover:to-[#0F3D59] focus:ring-4 focus:outline-none focus:ring-[#0F3D59]/50 dark:focus:ring-[#002D64]/50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Revisar Solicitudes</span>
                </a>
            @endif
        </div>
    </div>

    {{-- 📊 Estadísticas principales --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Tarjeta de Solicitudes Totales --}}
        <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border-l-4 border-[#F2CB05] hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02] relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-4 right-4 w-20 h-20 bg-[#F2CB05] rounded-full blur-xl"></div>
            </div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Solicitudes Totales</p>
                    <p class="text-4xl font-bold text-[#F2CB05] mt-2">
                        {{ \App\Models\DocumentRequest::count() }}
                    </p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-[#F2C84B] to-[#F2CB05] rounded-full flex items-center justify-center shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Tarjeta de Aprobadas --}}
        <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border-l-4 border-[#0477BF] hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02] relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-4 right-4 w-20 h-20 bg-[#0477BF] rounded-full blur-xl"></div>
            </div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Aprobadas</p>
                    <p class="text-4xl font-bold text-[#0477BF] mt-2">
                        {{ \App\Models\DocumentRequest::where('estado', 'aprobado')->count() }}
                    </p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-[#0477BF] to-[#002D64] rounded-full flex items-center justify-center shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Tarjeta de Rechazadas --}}
        <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border-l-4 border-[#F20519] hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02] relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-4 right-4 w-20 h-20 bg-[#F20519] rounded-full blur-xl"></div>
            </div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Rechazadas</p>
                    <p class="text-4xl font-bold text-[#F20519] mt-2">
                        {{ \App\Models\DocumentRequest::where('estado', 'rechazado')->count() }}
                    </p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-[#F20519] to-red-600 rounded-full flex items-center justify-center shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- 📈 Gráfico y actividad reciente --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Gráfico de distribución --}}
        <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>
            <div class="flex items-center gap-3 mb-6 relative z-10">
                <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-[#0D0D0D] dark:text-white">Distribución de Solicitudes</h2>
            </div>
            <div class="relative h-64">
                <canvas id="solicitudesChart" class="w-full h-full"></canvas>
            </div>
        </div>

        {{-- Actividad reciente --}}
        <div class="bg-white dark:bg-[#0D0D0D] p-6 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 relative overflow-hidden">
             <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-[#F2CB05]/10 to-[#B88900]/10 rounded-full blur-xl"></div>
            <div class="flex items-center gap-3 mb-6 relative z-10">
                <div class="p-2 bg-gradient-to-r from-[#0477BF] to-[#002D64] rounded-lg shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-[#0D0D0D] dark:text-white">Actividad Reciente</h2>
            </div>
            
            <div class="space-y-4 max-h-64 overflow-y-auto relative z-10">
                @foreach (\App\Models\DocumentRequest::latest()->take(5)->get() as $solicitud)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all duration-200 transform hover:scale-[1.01]">
                        {{-- Icono según estado de la solicitud --}}
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                            @switch($solicitud->estado)
                                @case('aprobado') bg-gradient-to-br from-[#0477BF]/20 to-[#002D64]/20 text-[#0477BF] @break
                                @case('rechazado') bg-gradient-to-br from-[#F20519]/20 to-red-600/20 text-[#F20519] @break
                                @default bg-gradient-to-br from-[#F2CB05]/20 to-[#B88900]/20 text-[#F2CB05] @break
                            @endswitch">
                            @switch($solicitud->estado)
                                @case('aprobado')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @break
                                @case('rechazado')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @break
                                @default
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    @break
                            @endswitch
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-[#0D0D0D] dark:text-white truncate">
                                {{ $solicitud->user->name }}
                            </p>
                            <p class="text-xs font-semibold 
                                @switch($solicitud->estado)
                                    @case('aprobado') text-[#0477BF] @break
                                    @case('rechazado') text-[#F20519] @break
                                    @default text-[#B88900] @break
                                @endswitch">
                                Solicitó: {{ $solicitud->documentType->nombre }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $solicitud->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 🎨 Scripts mejorados --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            function initializeChart() {
                const ctx = document.getElementById('solicitudesChart');
                if (ctx) {
                    if (window.solicitudesChartInstance) {
                        window.solicitudesChartInstance.destroy();
                    }

                    // Datos para el gráfico del usuario actual (solo sus solicitudes)
                    const data = {
                        pendiente: {{ \App\Models\DocumentRequest::where('user_id', auth()->id())->where('estado', 'pendiente')->count() }},
                        aprobado: {{ \App\Models\DocumentRequest::where('user_id', auth()->id())->where('estado', 'aprobado')->count() }},
                        rechazado: {{ \App\Models\DocumentRequest::where('user_id', auth()->id())->where('estado', 'rechazado')->count() }}
                    };

                    window.solicitudesChartInstance = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Pendientes', 'Aprobadas', 'Rechazadas'],
                            datasets: [{
                                label: 'Solicitudes',
                                data: [data.pendiente, data.aprobado, data.rechazado],
                                backgroundColor: [
                                    '#F2CB05', // Amarillo para Pendiente
                                    '#0477BF', // Azul para Aprobado
                                    '#F20519'  // Rojo para Rechazado
                                ],
                                borderColor: [
                                    '#F2CB05',
                                    '#0477BF',
                                    '#F20519'
                                ],
                                borderWidth: 2,
                                cutout: '60%'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 15,
                                        padding: 15,
                                        font: {
                                            size: 12,
                                            family: 'Inter'
                                        }
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 45, 100, 0.9)',
                                    titleColor: '#F2CB05',
                                    bodyColor: '#FFFFFF',
                                    borderColor: '#F2CB05',
                                    borderWidth: 1,
                                    callbacks: {
                                        label: function(context) {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', initializeChart);
            // Asegura que el gráfico se reinicialice si Livewire actualiza la página
            document.addEventListener('livewire:navigated', initializeChart); 
        </script>
    @endpush
</x-layouts.app>