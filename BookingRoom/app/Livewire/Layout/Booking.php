<?php

namespace App\Livewire\Layout;

use App\Models\User as ModalUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Booking extends Component
{
    public $tab = true;

    public $email;
    public $password;
    protected $listeners = ['loginData'];

    public function logout()
    {
        session()->forget('logUser');
    }

    public function loginData($id)
    {
        $checkLogin = ModalUser::where('id', $id)->first();
        session(['logUser' => $checkLogin]);
        if(session('logUser'))
        {
            $this->tab = false;
        }
        else
        {
            session()->destroy();
        }
    }

    public function login()
    {
        $checkLogin = ModalUser::where(['email' => $this->email, 'password' => $this->password])->first();
        if($checkLogin)
        {
            session(['logUser' => $checkLogin]);
            return redirect()->route('home');
        }
        return session()->flash('error','Đăng nhập thất bại!');
    }
    
    public function render()
    {
        $this->tab = session('logUser') ? false : true;
        return view('livewire.layout.booking');
    }
}
