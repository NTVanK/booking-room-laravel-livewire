<?php

namespace App\Livewire\Admin\Booking;

use App\Models\Booking;
use App\Models\Check;
use App\Models\Rooms;
use Livewire\Component;

class HistoryBook extends Component
{
    public $detailRoom;
    public $search = '';
    public $searchKey = '';
    public $searchTitle = 'Tất cả';

    public function resetData()
    {
        $this->reset();
    }
    public function detail($id)
    {
        $this->detailRoom = Booking::where('id', $id)->first();
    }

    public function remove()
    {
        $this->detailRoom = '';
    }

    public function value($value)
    {
        $this->searchKey = $value;
        $titles = [
            'no confirm' => 'Chưa checkin',
            'confirm' => 'Đã checkin',
            'complete' => 'Hoàn thành',
            'payment' => 'Đợi thanh toán',
            'cancel' => 'Đã hủy'
        ];
        
        $this->searchTitle = $titles[$value] ?? '';        
    }

    public function searching($search)
    {
        if($search == '')
        {
            if($this->searchKey != '')
            {
                return Booking::where('status', $this->searchKey)->get();
            }
            return Booking::all();
        }

        if($search != '')
        {
            if($this->searchKey != '')
            {
                return Booking::where('status',$this->searchKey)
                ->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->get();
            }

            return Booking::whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->get();            
        }

        return Booking::all();
    }

    public function render()
    {
        return view('livewire.admin.booking.history-book',[
            'books' => $this->searching($this->search),
            'detailRoom' => $this->detailRoom
        ]);
    }
}
