<?php

namespace App\Livewire\Requirements;

use App\Models\Requirement;
use Livewire\Component;

class RequirementCreate extends Component
{

    public $nombre;
    public $descripcion;

    public function render()
    {
        return view('livewire.requirements.requirement-create');
    }

    public function submit()
    {
        $this->validate([
            'nombre' => 'required|unique:requirements,nombre',
            'descripcion' => 'nullable|string'
        ]);

        Requirement::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        return to_route('requirements.index')->with('success', 'Requisito creado correctamente');
    }
}
