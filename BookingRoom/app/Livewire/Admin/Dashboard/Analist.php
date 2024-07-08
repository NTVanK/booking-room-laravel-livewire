<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;

class Analist extends Component
{
    public $date;

    public function totalsForLastFourMonths($date)
    {
        $totals = [];

        $currentDate = Carbon::parse($date);

        for ($i = 0; $i < 4; $i++) {
            $startOfMonth = $currentDate->copy()->subMonths($i)->startOfMonth();
            $endOfMonth = $currentDate->copy()->subMonths($i)->endOfMonth();

            $sum = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->where('status', 'confirm')
                        ->sum('total_amount');

            $sum2 = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('status', 'confirm')
            ->sum('profit_amount');

            $totals[$startOfMonth->format('Y-m')][0] = $sum;
            $totals[$startOfMonth->format('Y-m')][1] = $sum2;
        }

        return $totals;
    }

    // public function profitsForLastFourMonths($date)
    // {
    //     $totals = [];

    //     $currentDate = Carbon::parse($date);

    //     for ($i = 0; $i < 4; $i++) {
    //         $startOfMonth = $currentDate->copy()->subMonths($i)->startOfMonth();
    //         $endOfMonth = $currentDate->copy()->subMonths($i)->endOfMonth();

    //         $sum = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])
    //                     ->where('status', 'confirm')
    //                     ->sum('profit_amount');

    //         $totals[$i] = $sum;
    //     }

    //     return $totals;
    // }
    public function render()
    {
        return view('livewire.admin.dashboard.analist',
        [
            'products' => Payment::all(),
            'fourTotal' => $this->totalsForLastFourMonths($this->date)
        ]);
    }
}
