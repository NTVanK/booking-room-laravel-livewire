<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\Payment as ModelsPayment;
use Livewire\Component;

class Payment extends Component
{
    public $search = '';
    public $detailRoom;

    public $searchKey = 'no confirm';

    public function resetData()
    {
        $this->reset();
    }

    public function value($key)
    {
        $this->searchKey = $key;
    }

    public function detail($id)
    {
        $this->detailRoom = Booking::where('id', $id)->first();
    }

    public function remove()
    {
        $this->detailRoom = '';
    }

    public function payment($id)
    {
        try
        {
            $payment = ModelsPayment::where('id', $id)->first();
            $payment->update([
                'status' => 'confirm'
            ]);
            Booking::where('id', $payment->book_id)
            ->first()
            ->update(['status' => 'complete']);
            return session()->flash('success', 'Thanh toán thành công!');
        }
        catch(\Exception $e)
        {
            return session()->flash('error', 'Lỗi! '.$e->getMessage());
        }
    }
    
    public function searching($search)
    {
        if($search == '')
        {
            if($this->searchKey == 'all')
            {
                return ModelsPayment::all();
            }

            return ModelsPayment::where('status',$this->searchKey)->get();
        }

        if($search != '')
        {
            if($this->searchKey == 'all')
            {
                return ModelsPayment::whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->get(); 
            }

            return ModelsPayment::where('status', $this->searchKey)->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->get();            
        }
    }
    public function render()
    {
        return view('livewire.admin.payment',[
            'payments' => $this->searching($this->search)
        ]);
    }
}
