<?php

namespace App\Livewire\Admin\Booking;

use App\Models\Booking;
use App\Models\Check;
use App\Models\Payment;
use App\Models\Rooms;
use Carbon\Carbon;
use Livewire\Component;

class BookingManagement extends Component
{
    public $active;
    public $detailRoom;
    public $search = '';
    public $searchKey = '';
    public $searchTitle = 'Số phòng';
    public $searchText = 'Nhập số phòng';

    public function resetData()
    {
        $this->reset();
    }

    public function check($id)
    {
        $this->active = $id == $this->active ? null : $id;
    }

    public function order()
    {
        if($this->active == '')
        {
            return session()->flash('error', 'Vui lòng chọn phòng trước khi thực hiện đặt phòng!');
        }
        $room = Rooms::where('id', $this->active)->first();
        if ($room->checkRoom() === 'no confirm'){
            return redirect()->route('admin.booking', ['room' => $room->id]);
        } elseif ($room->checkRoom() === 'waite'){
            return session()->flash('error', 'Phòng này đang được đặt');
        } elseif ($room->checkRoom() === 'confirm'){
            return session()->flash('error', 'Phòng này đang có người ở');
        }
    }

    public function detail()
    {
        if($this->active == '')
        {
            return session()->flash('error', 'Vui lòng chọn phòng trước khi thực hiện đặt phòng!');
        }
        
        $this->detailRoom = Booking::where('room_id', $this->active)->first();

        if(!$this->detailRoom)
        {
            return session()->flash('error', 'Phòng trống, không có thông tin!');
        }
    }

    public function checkin()
    {
        if($this->active == '')
        {
            return session()->flash('error', 'Vui lòng chọn phòng trước khi thực hiện đặt phòng!');
        }
        try
        {
            $room = Booking::where('room_id', $this->active)
                    ->whereNotIn('status', ['payment', 'cancel','complete','confirm'])
                    ->first();
            if($room)
            {
                if($room->check)
                {
                    if($room->status != 'cancel')
                    {
                        $room->update(['status' => 'confirm']);
                        if($room->status == 'confirm')
                        {
                            Check::where('id', $room->check_id)->update([
                                'checkin' => Carbon::now('Asia/Ho_Chi_Minh'), 
                                'checkout' => null
                            ]);
                            $this->active = '';
                            $this->detailRoom = '';
                            return session()->flash('success', 'Checkin thành công!');
                        }
                    }
                    $this->active = '';
                    return session()->flash('error', 'Phòng này đã được checkin!');
                }
                $this->active = '';
                return session()->flash('error', 'Phòng này đã được checkin!');
            }
            else
            {
                $this->active = '';
                return session()->flash('error', 'Phòng trống không thể thực hiện chức năng này!');
            }
        }
        catch(\Exception $e)
        {
            return session()->flash('error', 'Lỗi! '.$e->getMessage());
        }
    }

    public function checkout()
    {
        if($this->active == '')
        {
            return session()->flash('error', 'Vui lòng chọn phòng trước khi thực hiện đặt phòng!');
        }
        try
        {
            $room = Booking::where('room_id', $this->active)
                    ->whereNotIn('status', ['payment', 'cancel','complete','no confirm'])
                    ->first();
            if($room)
            {
                if($room->check->checkin != null && $room->check->checkout == null)
                {
                    $check = Check::where('id', $room->check_id)->first();
                    if($check)
                    {
                        $room->update(['status' => 'payment']);
                        if($room->status == 'payment')
                        {
                            $check->update([ 
                                'checkout' => Carbon::now('Asia/Ho_Chi_Minh')
                            ]);
                            Payment::create([
                                'user_id' => $check->user_id,
                                'book_id' => $room->id, 
                                'status' => 'no confirm', 
                                'total_amount' => $room->total_amount, 
                                'profit_amount' => ($room->total_amount * 0.6)
                            ]);
                            $this->active = '';
                            $this->detailRoom = '';
                            return session()->flash('success', 'Checkout thành công!');
                        }
                    }
                    $this->active = '';
                    return session()->flash('error', 'Phòng này chưa được checkin!');
                }
                $this->active = '';
                return session()->flash('error', 'Phòng này chưa được checkin!');
            }
            else
            {
                $this->active = '';
                return session()->flash('error', 'Phòng trống không thể thực hiện chức năng này!');
            }
        }
        catch(\Exception $e)
        {
            return session()->flash('error', 'Lỗi! '.$e->getMessage());
        }
    }

    public function cancel()
    {
        if($this->active == '')
        {
            return session()->flash('error', 'Vui lòng chọn phòng trước khi thực hiện đặt phòng!');
        }
        try
        {
            $room = Booking::where('room_id', $this->active)
                    ->whereNotIn('status', ['payment', 'cancel','complete','confirm'])
                    ->first();
            if($room)
            {
                if($room->status == 'no confirm')
                {
                    $room->update([
                        'status' => 'cancel'
                    ]);

                    return session()->flash('error', 'Hủy thành công!');
                }

                $this->active = '';
                return session()->flash('error', 'Phòng trong quá trình đợi checkin mới sử dụng được chức năng này!');
            }
            else
            {
                $this->active = '';
                return session()->flash('error', 'Phòng trống không thể thực hiện chức năng này!');
            }
        }
        catch(\Exception $e)
        {
            return session()->flash('error', 'Lỗi! '.$e->getMessage());
        }
    }
    public function remove()
    {
        $this->detailRoom = null;
        $this->active = null;
    }

    public function value($value)
    {
        if($value == 'noofroom')
        {
            $this->searchTitle='Số phòng';
            $this->searchText='Nhập số phòng';
        }

        if($value == 'name')
        {
            $this->searchTitle='Khách hàng';
            $this->searchText='Khách hàng đã đặt';
        }

        if($value == 'noroom')
        {
            $this->searchTitle='Phòng trống';
            $this->searchText='Nhập số phòng';
        }
    }

    public function searching($search)
    {
        if($search == '')
        {
            if($this->searchTitle == 'Khách hàng')
            {
                $rooms = [];
                $room = Rooms::all();
                foreach ($room as $ro)
                {
                    if($ro->checkRoom() != 'no confirm')
                    {
                        $rooms[] = $ro; 
                    }
                }
                return $rooms;
            }

            if($this->searchTitle == 'Phòng trống')
            {
                $rooms = [];
                $room = Rooms::all();
                foreach ($room as $ro)
                {
                    if($ro->checkRoom() == 'no confirm')
                    {
                        $rooms[] = $ro; 
                    }
                }
                return $rooms;
            }

            return Rooms::all();
        }

        if($search != '')
        {
            if($this->searchTitle == 'Khách hàng')
            {
                $rooms = [];
                $allRooms = Rooms::all();
                foreach ($allRooms as $room)
                {
                    if($room->checkRoom() != 'no confirm' && $room->checkName($search))
                    {
                        $rooms[] = $room; 
                    }
                }
                return $rooms;
            }

            if($this->searchTitle == 'Phòng trống')
            {
                $rooms = [];
                $room = Rooms::where('noofroom', 'like', '%'.$search.'%')->get();
                foreach ($room as $ro)
                {
                    if($ro->checkRoom() == 'no confirm')
                    {
                        $rooms[] = $ro; 
                    }
                }
                return $rooms;
            }

            return Rooms::where('noofroom', 'like', '%'.$search.'%')->get();
        }
        return [];
    }

    public function render()
    {
        return view('livewire.admin.booking.booking-management',
        [
            'rooms' => $this->searching($this->search)
        ]);
    }
}
