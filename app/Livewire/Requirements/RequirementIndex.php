<?php

namespace App\Livewire\Requirements;

use App\Models\Requirement;
use Livewire\Component;

class RequirementIndex extends Component
{

    public $requirements;

    public function mount()
    {
        $this->requirements = Requirement::all();
    }

    public function render()
    {
        return view('livewire.requirements.requirement-index');
    }

    public function delete($id)
    {
        Requirement::find($id)?->delete();
        $this->requirements = Requirement::all();
        session()->flash('success', 'Requisito eliminado.');
    }

}
