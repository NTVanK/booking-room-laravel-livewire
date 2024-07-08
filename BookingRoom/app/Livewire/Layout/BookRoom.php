<?php

namespace App\Livewire\Layout;

use App\Models\Booking as Book;
use App\Models\Categories;
use App\Models\Check;
use App\Models\Rooms;
use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Livewire\Component;

class BookRoom extends Component
{
    public $user;
    public $before, $after,$daysDifference;
    public $roomID = [];
    public $createUser = false;
    // protected $listeners = ['updateData'];
    public function mount()
    {
        $this->user = session('logUser');
    }

    public function addRoom($id)
    {
        foreach ($this->roomID as $room) {
            if ($room['id'] == $id) {
                return session()->flash('error', 'Phòng này đã được thêm!');
            }
        }

        $this->roomID[] = Rooms::where('id', $id)->first();
    }

    public function deleteRoom($id)
    {
        foreach ($this->roomID as $key=>$room) {
            if ($room['id'] == $id) {
                unset($this->roomID[$key]);
                $this->roomID = array_values($this->roomID);
                return session()->flash('success', 'Phòng đã được xóa!');
            }
        }

        return session()->flash('error', 'Phòng này không tồn tại!');
    }

    public function save()
    {
        if(count($this->roomID) == 0)
        {
            return session()->flash('error','Vui lòng chọn phòng!');
        }

        if(!$this->user)
        {
            return session()->flash('error','Vui lòng nhập thông tin khách hàng!');
        }

        if(!$this->before || !$this->after)
        {
            return session()->flash('error','Vui lòng nhập thời gian đặt phòng!');
        }

        if(Carbon::parse($this->before) < Carbon::now())
        {
            return session()->flash('error','Vui lòng nhập thời gian đặt từ lớn hơn thời gian hiện tại!');
        }

        if(Carbon::parse($this->before) > Carbon::parse($this->after))
        {
            return session()->flash('error','Vui lòng nhập thời gian đặt từ lớn hơn thời gian đặt đến!');
        }

        if(Carbon::parse($this->before) == Carbon::parse($this->after))
        {
            return session()->flash('error','Vui lòng nhập thời gian đặt từ lớn hơn 1 ngày so với thời gian đặt đến!');
        }

        try
        {
            if(Book::where('user_id', $this->user->id)->whereNotIn('status', ['payment', 'cancel','complete'])->count() == 0)
            {
                foreach($this->roomID as $room)
                {
                    $check = Check::create([
                        'user_id' => $this->user->id,
                        'checkin' => null,
                        'checkout' => null
                    ]);
                    Book::create([ 
                        'user_id' => $this->user->id, 
                        'room_id' => $room->id,
                        'check_id' => $check->id, 
                        'people' => $room->category->number_people, 
                        'total_amount' => $room->amount * $this->total_day()  * (-1), 
                        'status' => 'no confirm', 
                        'updated_at' => Carbon::parse($this->before), 
                        'created_at' => Carbon::parse($this->after)
                    ]);
                }

                return session()->flash('success','Đặt phòng thành công!');
            }
            return session()->flash('error','Khách hàng đã dặt phòng rồi!');
        }
        catch(\Exception $e)
        {
            return session()->flash('error', 'Lỗi! '.$e->getMessage());
        }
    }

    public function total_day()
    {
        if($this->before && $this->after)
        {
            $before = Carbon::parse($this->before);
            $after = Carbon::parse($this->after);
            return  $before < $after ? $after->diffInDays($before) : 1;  
        }
        else
        {
            return 1;
        }
    }
    public function render()
    {
        return view('livewire.layout.book-room',
        [
            'categories' => Categories::all(),
            'rooms' => Rooms::all(),
            'ro' => Rooms::where('id', $this->roomID)->first(),
            'day' => $this->total_day()
        ]);
    }
}
