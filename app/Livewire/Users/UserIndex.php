<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserIndex extends Component
{
    public function render()
    {

        $users = User::get();

        return view('livewire.users.user-index', compact("users"));
    }

    public function delete($id)
    {
        //dd($id);
        $user = User::find($id);
        $user ->delete();

        session()->flash("success","Usuario eliminado");

    }

}
