<?php

namespace App\Livewire\Requirements;

use App\Models\Requirement;
use Livewire\Component;

class RequirementEdit extends Component
{

    public $requirement;
    public $nombre;
    public $descripcion;

    public function mount($id)
    {
        $this->requirement = Requirement::findOrFail($id);
        $this->nombre = $this->requirement->nombre;
        $this->descripcion = $this->requirement->descripcion;
    }

    public function render()
    {
        return view('livewire.requirements.requirement-edit');
    }

    public function submit()
    {
        $this->validate([
            'nombre' => 'required|unique:requirements,nombre,' . $this->requirement->id,
            'descripcion' => 'nullable|string'
        ]);

        $this->requirement->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        return to_route('requirements.index')->with('success', 'Requisito actualizado.');
    }

}
