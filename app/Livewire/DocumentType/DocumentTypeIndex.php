<?php

namespace App\Livewire\DocumentType;

use App\Models\DocumentType;
use Livewire\Component;

class DocumentTypeIndex extends Component
{
    public $documentTypes;

    protected $listeners = ['delete' => 'delete'];

    public function mount()
    {
        $this->documentTypes = DocumentType::with(['requirements','roles'])->get();
    }

    public function delete($id)
    {
        $docType = DocumentType::findOrFail($id);
        $docType->requirements()->detach();
        $docType->roles()->detach();
        $docType->delete();

        $this->documentTypes = DocumentType::with(['requirements','roles'])->get();
        session()->flash('success', 'Tipo de documento eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.document-type.document-type-index');
    }
}


