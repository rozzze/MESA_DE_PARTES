<?php

namespace App\Livewire\Solicitudes;

use App\Models\DocumentRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SolicitudesIndex extends Component
{
    public $solicitudes;

    public function mount()
    {
    $this->solicitudes = DocumentRequest::with('documentType')
        ->select('id', 'user_id', 'document_type_id', 'estado', 'created_at', 'respuesta_path','observaciones') // 👈 Aquí incluimos la ruta
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
    }

    public function render()
    {
        return view('livewire.solicitudes.solicitudes-index');
    }

    public function delete($id)
    {
        // Busca la solicitud del usuario autenticado, que esté pendiente
        $solicitud = DocumentRequest::where('user_id', Auth::id())
            ->where('estado', 'pendiente')
            ->find($id);

        if ($solicitud) {
            $solicitud->delete();
            session()->flash('success', 'Solicitud eliminada correctamente.');
        } else {
            session()->flash('success', 'No se pudo eliminar. Solo puedes eliminar solicitudes pendientes.');
        }

        // Recargar solicitudes después de eliminar
        $this->solicitudes = DocumentRequest::with('documentType')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }
}
