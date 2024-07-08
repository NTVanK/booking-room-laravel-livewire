<?php

namespace App\Livewire\Admin\Category;

use App\Models\Categories;
use Livewire\Component;

class TypeRoom extends Component
{
    public $category;
    public $number;

    public $event = true;

    public function resetData()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $type = Categories::where('id', $id)->first();
        if($type)
        {
            $this->category = $type->category;
            $this->number = $type->number_people;
            $this->event = false;
        }
    }

    public function delete($id)
    {
        $type = Categories::where('id', $id)->first();
        $name = $type->category;
        $type->delete();
        $this->reset();
        session()->flash('success', 'Xóa '. $name .' thành công!');
    }

    public function save()
    {
        try
        {
            $categories = new Categories();
            if($categories)
            {
                $categories->updateOrCreate([
                    'category' => $this->category
                ],[
                    'category' => $this->category,
                    'number_people' => $this->number
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
        return view('livewire.admin.category.type-room',
        ['categories' => (new Categories())::all()]);
    }
}
