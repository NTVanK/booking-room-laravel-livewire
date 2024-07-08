<?php

namespace App\Livewire\Admin;

use App\Models\User as ModalUser;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddUser extends Component
{
    #[validate('required')]
    public $phone, $name, $address;

    #[validate('unique:users,email', message: 'Địa chỉ email này đã tồn tại!')]
    #[Validate('email', message: 'Vui lòng nhập đúng định dạng email!')]
    public $email;

    public $event = true;

    protected $listeners = ['editUser'];

    public function editUser($id)
    {
        $user = ModalUser::where('id', $id)->first();
        if($user)
        {
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->name = $user->name;
            $this->address = $user->address;
            $this->event = false;
        }
    }

    public function mout($email)
    {
        $this->email = $email;
    }

    public function resetData()
    {
        $this->reset();
    }

    public function save()
    {
        $validated = $this->validate();
        try
        {
            $user = new ModalUser();
            if($user)
            {
                $user = $user->updateOrCreate(
                    ['email' => $validated['email']],
                    [
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'password' => rand(100000, 999999),
                        'phone' => $validated['phone'],
                        'address' => $validated['address']
                    ]
                );
                $this->dispatch('updateData', id: $user->id);
                $this->reset();
                session()->flash('success', 'Tạo tài khoản thành công!');
            }
        }
        catch(\Exception $e)
        {
            session()->flash('error', 'Lỗi! '.$e->getMessage());
        }
        
    }
    public function render()
    {
        return view('livewire.admin.add-user');
    }
}
