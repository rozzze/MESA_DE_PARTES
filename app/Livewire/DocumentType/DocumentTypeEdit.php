<?php

namespace App\Livewire\DocumentType;

use App\Models\DocumentType;
use App\Models\Requirement;
use App\Models\Role;
use Livewire\Component;

class DocumentTypeEdit extends Component
{
    public $documentType;
    public $nombre;
    public $descripcion;
    public $selectedRequirements = [];
    public $selectedRoles = [];

    public $allRequirements = [];
    public $allRoles = [];

    public function mount($id)
    {
        $this->documentType = DocumentType::findOrFail($id);
        $this->nombre = $this->documentType->nombre;
        $this->descripcion = $this->documentType->descripcion;
        $this->selectedRequirements = $this->documentType->requirements->pluck('id')->toArray();
        $this->selectedRoles = $this->documentType->roles->pluck('id')->toArray();

        $this->allRequirements = Requirement::all();
        $this->allRoles = Role::all();
    }

    public function render()
    {
        return view('livewire.document-type.document-type-edit');
    }

    public function submit()
    {
        $this->validate([
            'nombre' => 'required|unique:document_types,nombre,' . $this->documentType->id,
            'selectedRequirements' => 'required|array|min:1',
            'selectedRoles' => 'required|array|min:1',
        ]);

        $this->documentType->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        $this->documentType->requirements()->sync($this->selectedRequirements);
        $this->documentType->roles()->sync($this->selectedRoles);

        return to_route('doctype.index')->with('success', 'Tipo de documento actualizado.');
    }
}
