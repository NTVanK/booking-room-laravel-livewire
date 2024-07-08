<?php

namespace App\Livewire\Admin;

use App\Models\User as ModalUser;
use Livewire\Component;

class User extends Component
{
    protected $listeners = ['updateData'];

    public function updateData($id)
    {
        $this->render();
    }

    public function edit($id)
    {
        $this->dispatch('editUser', id: $id);
    }

    public function delete($id)
    {
        $user = ModalUser::where('id', $id)->first();
        $name = $user->name;
        $user->delete();

        session()->flash('success', 'Xóa '.$name.' thành công!');
    }
    public function render()
    {
        return view('livewire.admin.user',
        [
            'users' => (new ModalUser())::all()
        ]);
    }
}
