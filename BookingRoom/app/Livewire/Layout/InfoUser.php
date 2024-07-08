<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use App\Models\Booking;
use App\Models\User as ModalUser;

class InfoUser extends Component
{
    public $name, $phone, $email, $address;

    public $user;
    public $detailRoom;

    public $event = true;

    public function mount()
    {
        if(session('logUser'))
        {
            $this->user = ModalUser::where('id', session('logUser')->id)->first();
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->phone = $this->user->phone;
            $this->address = $this->user->address;
        }
    }

    public function resetData()
    {
        $this->reset();
    }

    public function change()
    {
        if(session('logUser'))
        {
            $this->user = ModalUser::where('id', session('logUser')->id)->first();
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->phone = $this->user->phone;
            $this->address = $this->user->address;
        }
        $this->event = $this->event == true ? false : true;
    }

    public function save()
    {
        $user = ModalUser::whereNot('email', $this->user->email)->get();
        foreach($user as $u)
        {
            if($this->email == $u->email)
            {
                return session()->flash('error', 'Email này đã tồn tại!');
            }
        }
        try
        {
            (new ModalUser)->updateOrCreate(
                ['id' => $this->user->id],
                [
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address
                ]
            );
            $this->event = true;
            return session()->flash('success','Cập nhật thành công!');
        }
        catch(\Exception $e)
        {
            return session()->flash('error',$e->getMessage());
        }
        
    }
    public function detail($id)
    {
        $this->detailRoom = Booking::where('id', $id)->first();
    }

    public function remove()
    {
        $this->detailRoom = '';
    }

    public function render()
    {
        return view('livewire.layout.info-user',[
            'books' => Booking::where('user_id', session('logUser')->id)->get(),
            'detailRoom' => $this->detailRoom
        ]);
    }
}
