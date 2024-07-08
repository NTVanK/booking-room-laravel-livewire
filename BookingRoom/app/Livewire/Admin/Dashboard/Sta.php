<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;

class Sta extends Component
{
    public $date;

    public function resetData()
    {
        $this->reset();
    }

    public function sales(?string $date = null): array
    {
        $totals = [];
        
        $currentDate = Carbon::parse($date ?? Carbon::now());
        
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();

        $sum = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->where('status', 'confirm')
        ->sum('total_amount');

        $sum2 = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->where('status', 'confirm')
        ->sum('profit_amount');

        $totals[] = $sum ?? 0;
        $totals[] = $sum2 ?? 0;

        return $totals;
    }

    public function lastsales(?string $date = null): array
    {
        $totals = [];

        $currentDate = Carbon::parse($date ?? Carbon::now());

        $startOfMonth = $currentDate->copy()->subMonth()->startOfMonth();
        $endOfMonth = $currentDate->copy()->subMonth()->endOfMonth();

        $sum = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                    ->where('status', 'confirm')
                    ->sum('total_amount');

        $sum2 = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->where('status', 'confirm')
        ->sum('profit_amount');

        $totals[] = $sum ?? 0;
        $totals[] = $sum2 ?? 0;

        return $totals;
    }

    public function people(?string $date = null): array
    {
        $totals = [];

        $currentDate = Carbon::parse($date ?? Carbon::now());

        $startNowOfMonth = $currentDate->copy()->startOfMonth();
        $endOfNowMonth = $currentDate->copy()->endOfMonth();

        $startLastOfMonth = $currentDate->copy()->subMonth()->startOfMonth();
        $endLastOfMonth = $currentDate->copy()->subMonth()->endOfMonth();

        $sum = Booking::whereBetween('created_at', [$startNowOfMonth, $endOfNowMonth])
                    ->sum('people');

        $sum2 = Booking::whereBetween('created_at', [$startLastOfMonth, $endLastOfMonth])
                    ->sum('people');

        $totals[] = $sum ?? 0;
        $totals[] = $sum2 ?? 0;

        return $totals;
    }
    
    public function render()
    {
        $sales = $this->sales($this->date);
        $lastsales = $this->lastsales($this->date);
        $people = $this->people($this->date);
        // $this->dispatch('dateUpdated', [
        //     'sales' => [$sales[0], $sales[1]],
        //     'lastsales' => [$lastsales[0], $lastsales[1]],
        //     'people' => [$people[0], $people[1]]
        // ]);

        return view('livewire.admin.dashboard.sta',
        [
            'sales' => $sales,
            'lastsales' => $lastsales,
            'people' => $people
        ]);

    }

    public function rendered()
    {
        $sales = $this->sales($this->date);
        $lastsales = $this->lastsales($this->date);
        $people = $this->people($this->date);
        $this->dispatch('dateUpdated', [
            'sales' => [$sales[0], $sales[1]],
            'lastsales' => [$lastsales[0], $lastsales[1]],
            'people' => [$people[0], $people[1]]
        ]);

    }
}
