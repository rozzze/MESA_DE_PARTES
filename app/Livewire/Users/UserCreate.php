<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Compilers\Mount;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{

    public $name, $email, $password, $confirm_password, $allRoles;

    public $roles = [];

    public function mount()
    {
        $this->allRoles = Role::all();
    }


    public function render()
    {
        return view('livewire.users.user-create');
    }

    public function submit()
    {
        $this->validate([
            "name" => "required",
            "email" => "required|email",
            "roles" => "required",
            "password" => "required|same:confirm_password",
        ]);

        $user = User::create([
            "name" =>$this->name,
            "email" => $this->email,
            "password" => Hash::make($this->password)
        ]);

        $user->syncRoles($this->roles);
        
        return to_route("users.index")->with("success", "Usuario Creado"); 

    }

}
