<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Rooms;
use Livewire\Component;

class Statistic extends Component
{
    public function sales()
    {
        return Payment::where('status', 'confirm')->sum('total_amount');
    }

    public function salesProfit()
    {
        return Payment::where('status', 'confirm')->sum('profit_amount');
    }

    public function render()
    {
        return view('livewire.admin.dashboard.statistic',
        [
            'sales' => $this->sales(),
            'salesProfit' => $this->salesProfit(),
            'noroom' => Rooms::doesntHave('bookings')->count(),
            'room' => Rooms::Has('bookings')->count(),
            'confirm' => Booking::where('status','no confirm')->count()
        ]);
    }
}
