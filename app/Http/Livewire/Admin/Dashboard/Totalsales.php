<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Totalsales extends Component
{
    public function render()
    {
        $TotalSales = Order::where('status', 'Pick-up')->sum('total');
        $TodaySales = Order::where('status', 'Pick-up')->whereDay('created_at', Carbon::today())->sum('total');
        $YesterdaySales = Order::where('status', 'Pick-up')->whereDay('created_at', Carbon::yesterday())->sum('total');
        $MonthySales = Order::where('status', 'Pick-up')->whereMonth('created_at', Carbon::now()->month)->sum('total');
        $YearSales = Order::where('status', 'Pick-up')->whereYear('created_at', Carbon::now()->year)->sum('total');
        return view('livewire.admin.dashboard.totalsales', [
            'TotalSales' => $TotalSales,
            'TodaySales' => $TodaySales,
            'YesterdaySales' => $YesterdaySales,
            'MonthySales' => $MonthySales,
            'YearSales' => $YearSales,

            ]);
    }
}
