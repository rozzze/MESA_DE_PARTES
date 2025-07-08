<?php

namespace App\Livewire\DocumentReviews;

use Livewire\Component;
use App\Models\DocumentRequest;
use Livewire\WithPagination; // Importar el trait de paginación
use Carbon\Carbon; // Para manejar fechas

class DocumentReviewsIndex extends Component
{
    use WithPagination; // Habilitar la paginación en Livewire

    // Propiedades públicas para los filtros
    public $filterEstado = ''; // 'pendiente', 'aprobado', 'rechazado' o vacío para todos
    public $filterDateFrom = ''; // Formato YYYY-MM-DD
    public $filterDateTo = '';   // Formato YYYY-MM-DD

    // Propiedad para la paginación (opcional, puedes cambiar el nombre si prefieres)
    protected $paginationTheme = 'tailwind'; // Usa el tema de paginación de Tailwind CSS

    // Escuchar cambios en las propiedades de filtro y resetear la paginación
    public function updated($propertyName)
    {
        // Si alguna de las propiedades de filtro cambia, resetea la paginación a la primera página
        if (in_array($propertyName, ['filterEstado', 'filterDateFrom', 'filterDateTo'])) {
            $this->resetPage();
        }
    }

    // El método mount ya no es necesario si la lógica de consulta está en render
    // public function mount()
    // {
    //     $this->solicitudes = DocumentRequest::with('user', 'documentType')->latest()->get();
    // }

    public function render()
    {
        // Iniciar la consulta base de DocumentRequest
        $query = DocumentRequest::with(['user', 'documentType']);

        // Aplicar filtro por estado si se ha seleccionado uno
        if (!empty($this->filterEstado)) {
            $query->where('estado', $this->filterEstado);
        }

        // Aplicar filtro por rango de fechas
        if (!empty($this->filterDateFrom)) {
            // Asegúrate de que la fecha de inicio sea el comienzo del día
            $query->whereDate('created_at', '>=', Carbon::parse($this->filterDateFrom)->startOfDay());
        }

        if (!empty($this->filterDateTo)) {
            // Asegúrate de que la fecha de fin sea el final del día
            $query->whereDate('created_at', '<=', Carbon::parse($this->filterDateTo)->endOfDay());
        }

        // Obtener las solicitudes paginadas, ordenadas por la más reciente
        $solicitudes = $query->latest()->paginate(10); // 10 elementos por página

        return view('livewire.document-reviews.document-reviews-index', [
            'solicitudes' => $solicitudes, // Pasar la colección paginada a la vista
        ]);
    }

    // Método para limpiar todos los filtros y resetear la paginación
    public function clearFilters()
    {
        $this->reset(['filterEstado', 'filterDateFrom', 'filterDateTo']); // Resetea las propiedades de filtro
        $this->resetPage(); // Resetea la paginación a la primera página
    }
}