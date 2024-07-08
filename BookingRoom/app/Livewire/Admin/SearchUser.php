<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User as ModelsUser;

class SearchUser extends Component
{
    public $search = '';
    public function render()
    {
        if ($this->search != '') 
        {
            $searchResults = ModelsUser::where('name', 'like', '%'.$this->search.'%')
            ->select(['id', 'name', 'phone', 'address'])
            ->simplePaginate(6);
        }
        return view('livewire.admin.search-user',
        [
            'searching' => $searchResults ?? null
        ]);
    }
}
