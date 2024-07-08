<?php

namespace App\Livewire\Admin\Category;

use App\Models\Categories;
use App\Models\Rooms;
use Livewire\Component;

class NoofRoom extends Component
{
    public $noofroom, $amount, $category, $note;
    public $event = true;

    public function resetData()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $room = Rooms::where('id', $id)->first();
        if($room)
        {
            $this->category = $room->category->id;
            $this->amount = $room->amount;
            $this->note = $room->note ?? null;
            $this->noofroom = $room->noofroom;
            $this->event = false;
        }
    }

    public function delete($id)
    {
        $room = Rooms::where('id', $id)->first();
        $name = $room->noofroom;
        $room->delete();
        $this->reset();
        session()->flash('success', 'Xóa '. $name .' thành công!');
    }

    public function save()
    {
        try
        {
            $room = new Rooms();
            if($room)
            {
                $room->updateOrCreate([
                    'noofroom' => $this->noofroom
                ],[
                    'noofroom' => $this->noofroom,
                    'category_id' => $this->category,  
                    'amount' => $this->amount, 
                    'note' => $this->note ?? null
                ]);
                $this->reset();
                session()->flash('success', 'Thêm thành công!');
            }
        }
        catch (\Exception $e)
        {
            session()->flash('error', 'Lỗi! '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.category.noof-room',
        [
            'rooms' => (new Rooms())::all(),
            'catgories' => (new Categories())::all()
        ]);
    }
}
