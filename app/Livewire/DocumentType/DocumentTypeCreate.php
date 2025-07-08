<?php

namespace App\Livewire\DocumentType;

use App\Models\DocumentType;
use App\Models\Requirement;
use App\Models\Role;
use Livewire\Component;

class DocumentTypeCreate extends Component
{

    public $nombre, $descripcion, $selectedRequirements = [], $selectedRoles = [];
    public $allRequirements = [], $allRoles = [];

    public function mount()
    {
        $this->allRequirements = Requirement::all();
        $this->allRoles = Role::all();
    }

    public function render()
    {
        return view('livewire.document-type.document-type-create');
    }

    public function submit()
    {
        $this->validate([
            'nombre' => 'required|unique:document_types,nombre',
            'selectedRequirements' => 'required|array|min:1',
            'selectedRoles' => 'required|array|min:1',
        ]);

        $docType = DocumentType::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        $docType->requirements()->sync($this->selectedRequirements);
        $docType->roles()->sync($this->selectedRoles);

        return to_route('doctype.index')->with('success', 'Tipo de documento creado exitosamente.');
    }

}
