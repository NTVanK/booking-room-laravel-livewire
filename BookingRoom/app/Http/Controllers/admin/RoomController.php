<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        return view('admin.room',[
            'catgories'=>Categories::all(),
            'rooms' => Rooms::all()
        ]);
    }

    public function roomCreate(Request $request, Rooms $rooms)
    {
        $request->validate([
            'room' => 'required|unique:rooms,room',
            'category_id' => 'required'
        ], [
            'room.required' => 'Vui lòng nhập vào ô trống!',
            'room.unique' => 'Phòng này đã tồn tại!'
        ]);

        if($rooms->create(['category_id' => $request->category_id, 'room' => $request->room]))
        {
            session()->flash('alert',[
                'type' => 'success',
                'message' => 'Thêm phòng thành công!'
            ]);

            return redirect()->route('admin.room');
        }

        session()->flash('alert',[
            'type' => 'error',
            'message' => 'Thêm phòng không thành công!'
        ]);

        return redirect()->back();
    }

    public function roomDelete($id)
    {
        $room = Rooms::where('id', $id)->first();
        if($room->delete())
        {
            session()->flash('alert',[
                'type' => 'success',
                'message' => 'Xóa phòng thành công!'
            ]);

            return redirect()->back();
        }

        session()->flash('alert',[
            'type' => 'error',
            'message' => 'Xóa phòng không thành công!'
        ]);

        return redirect()->back();
    }

    public function category(Categories $categories)
    {
        return view('admin.category',
        ['categories' => $categories->all()]);
    }

    public function categoryCreate(Request $request, Categories $categories)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ], [
            'name.required' => 'Vui lòng nhập vào ô trống!',
            'name.unique' => 'Danh mục đã tồn tại!'
        ]);

        if($categories->create(['name' => $request->name]))
        {
            session()->flash('alert',[
                'type' => 'success',
                'message' => 'Thêm danh mục thành công!'
            ]);

            return redirect()->route('admin.category');
        }

        session()->flash('alert',[
            'type' => 'error',
            'message' => 'Thêm danh mục không thành công!'
        ]);

        return redirect()->back();
    }

    public function categoryDelete($id)
    {
        $room = Categories::where('id', $id)->first();
        if($room->delete())
        {
            session()->flash('alert',[
                'type' => 'success',
                'message' => 'Xóa danh mục thành công!'
            ]);

            return redirect()->back();
        }

        session()->flash('alert',[
            'type' => 'error',
            'message' => 'Xóa danh mục không thành công!'
        ]);

        return redirect()->back();
    }
}
