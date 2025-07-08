<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{

    public $name;
    public $allPermissions = [];
    public $permissions = [];

    public function mount()
    {
        $this->allPermissions = Permission::get();
    }

    public function render()
    {
        return view('livewire.roles.role-create');
    }

    public function submit()
    {
        $this->validate([
            "name" => "required|unique:roles,name",
            "permissions" => "required",
        ]);

        $role = Role::create([
            'name' => $this->name
        ]);

        $role->syncPermissions($this->permissions);

        return to_route("roles.index")->with("success", "Rol Creado"); 

    }
}
