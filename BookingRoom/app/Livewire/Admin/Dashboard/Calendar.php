<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Rooms;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public $month;
    public function getMonth()
    {
        if($this->month)
        {   
            return Carbon::parse($this->month)->month;
        }
        return Carbon::now()->month;   
    }

    public function getDay()
    {
        if($this->month)
        {   
            return Carbon::parse($this->month)->daysInMonth;
        }
        return Carbon::now()->daysInMonth;
    }

    public function getYear()
    {
        if($this->month)
        {   
            return Carbon::parse($this->month)->year;
        }
        return Carbon::now()->year;
    }
    public function render()
    {
        return view('livewire.admin.dashboard.calendar',
        [
            'rooms' => Rooms::all(),
            'month_is' => $this->getMonth(),
            'day_is' => $this->getDay(),
            'year_is' => $this->getYear()
        ]);
    }
}
