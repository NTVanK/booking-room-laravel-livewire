<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required', message: 'Vui lòng điền vào ô trống!')]
    public $admin;
    
    #[Validate('required', message: 'Vui lòng điền vào ô trống!')]
    public $password;

    public function login(){
        $validated = $this->validate();

        if(Auth::guard('admin')->attempt(['admin' => $this->admin, 'password' => $validated['password']]))
        {
            return redirect()->route('admin.category.type');
        }

        session()->flash('error', 'Tài khoản hoặc mật khẩu bị sai!');
    }

    public function render()
    {
        return view('livewire.admin.login');
    }
}
