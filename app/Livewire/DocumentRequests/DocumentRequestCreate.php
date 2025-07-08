<?php

namespace App\Livewire\DocumentRequests;

use App\Models\DocumentRequest;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentRequestCreate extends Component
{
    use WithFileUploads;

    public $document_type_id;
    public $availableDocuments;
    public $requirements;

    public $files = [];
    public $observaciones;

    public $currentStep = 1;

    public function mount()
    {
        $user = Auth::user();

        if ($user) {
            $userRoleIds = $user->roles->pluck('id')->toArray();

            $this->availableDocuments = DocumentType::whereHas('roles', function ($query) use ($userRoleIds) {
                $query->whereIn('roles.id', $userRoleIds);
            })->get();
        } else {
            $this->availableDocuments = collect();
        }

        $this->requirements = collect();
    }

    public function goToStep2()
    {
        $this->validate([
            'document_type_id' => 'required|exists:document_types,id',
        ], [
            'document_type_id.required' => 'Debes seleccionar un tipo de documento.',
            'document_type_id.exists' => 'El tipo de documento seleccionado no es válido.',
        ]);

        $this->loadRequirements();

        if ($this->requirements->isEmpty()) {
            session()->flash('error', 'El documento seleccionado no tiene requisitos definidos.');
            return;
        }

        $this->files = [];
        $this->currentStep = 2;
    }

    public function goBack()
    {
        $this->currentStep = 1;
        $this->files = [];
    }

    public function loadRequirements()
    {
        if ($this->document_type_id) {
            $documentType = DocumentType::with('requirements')->find($this->document_type_id);
            $this->requirements = $documentType ? $documentType->requirements : collect();
        } else {
            $this->requirements = collect();
        }
    }

    public function submit()
    {
        $rules = [
            'observaciones' => 'nullable|string|max:500',
            'files' => 'required_if:requirements,array|array',
        ];

        foreach ($this->requirements as $req) {
            $rules['files.' . $req->id] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5000';
        }

        $messages = [
            'files.required_if' => 'Debes adjuntar todos los archivos requeridos.',
            'files.*.required' => 'El archivo para :attribute es obligatorio.',
            'files.*.file' => 'El campo :attribute debe ser un archivo.',
            'files.*.mimes' => 'El archivo para :attribute debe ser de tipo PDF, JPG, JPEG o PNG.',
            'files.*.max' => 'El tamaño del archivo para :attribute no debe exceder los 5 MB.',
        ];

        $this->validate($rules, $messages);

        try {
            $documentRequest = DocumentRequest::create([
                'user_id' => Auth::id(),
                'document_type_id' => $this->document_type_id,
                'estado' => 'pendiente',
                'observaciones' => $this->observaciones,
            ]);

            $userId = Auth::id();
            $fecha = now()->format('Ymd_His');

            foreach ($this->requirements as $req) {
                if (isset($this->files[$req->id]) && $this->files[$req->id] instanceof \Illuminate\Http\UploadedFile) {
                    $uploadedFile = $this->files[$req->id];
                    $reqSlug = Str::slug($req->nombre);
                    $fileName = "requisito_{$reqSlug}_usuario{$userId}_{$fecha}." . $uploadedFile->getClientOriginalExtension();

                    $path = $uploadedFile->storeAs("document_requests/{$userId}", $fileName, 'public');

                    $documentRequest->files()->create([
                        'requirement_id' => $req->id,
                        'file_path' => $path,
                    ]);
                } else {
                    Log::warning("Archivo no encontrado para el requisito ID: {$req->id} en la solicitud ID: {$documentRequest->id}");
                }
            }

            return to_route('dashboard')->with('success', 'Solicitud enviada con éxito.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'Error al procesar la solicitud: ' . $e->getMessage());
            Log::error('Error en submit de DocumentRequestCreate: ' . $e->getMessage(), ['exception' => $e]);
        }
    }

    public function render()
    {
        return view('livewire.document-requests.document-request-create');
    }
}
