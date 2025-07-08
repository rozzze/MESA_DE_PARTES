<?php

namespace App\Livewire\DocumentReviews;

use App\Models\DocumentRequest;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentReviewsShow extends Component
{
    use WithFileUploads;

    public $documentRequest;
    public $estado;
    public $descripcion;
    public $pdf_respuesta;

    public function mount($id)
    {
        $this->documentRequest = DocumentRequest::with(['user', 'documentType', 'files.requirement'])->findOrFail($id);
        $this->estado = $this->documentRequest->estado;
        $this->descripcion = $this->documentRequest->observaciones;
    }

    public function aprobar()
    {
        $this->validate([
            'pdf_respuesta' => 'required|file|mimes:pdf|max:10240',
        ]);

        $userId = $this->documentRequest->user_id;
        $fecha = now()->format('Ymd_His');
        $docTypeSlug = Str::slug($this->documentRequest->documentType->nombre);
        $fileName = "respuesta_{$docTypeSlug}_usuario{$userId}_{$fecha}." . $this->pdf_respuesta->getClientOriginalExtension();

        // Guarda el archivo y obtiene la ruta
        $path = $this->pdf_respuesta->storeAs("document_responses/{$userId}", $fileName, 'public');

        // Actualiza el modelo, incluyendo la nueva columna 'respuesta_path'
        $this->documentRequest->update([
            'estado' => 'aprobado',
            'observaciones' => $this->descripcion,
            'respuesta_path' => $path, // <--- ¡ASEGÚRATE DE QUE ESTA LÍNEA ESTÉ AQUÍ Y SIN COMENTAR!
        ]);

        session()->flash('success', 'Solicitud aprobada y archivo cargado.');
        return redirect()->route('documentreviews.index');
    }

    public function rechazar()
    {
        $this->documentRequest->update([
            'estado' => 'rechazado',
            'observaciones' => $this->descripcion,
            'respuesta_path' => null, // Opcional: Si rechazas, podrías limpiar el path si se había establecido antes.
        ]);

        session()->flash('success', 'Solicitud rechazada.');
        return redirect()->route('documentreviews.index');
    }

    public function render()
    {
        return view('livewire.document-reviews.document-reviews-show');
    }
}