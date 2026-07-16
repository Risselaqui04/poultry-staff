<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\InventoryItem;
use App\Models\Dispatch;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $eggsToday = Production::whereDate('production_date', today())
            ->sum('eggs_produced');

        $eggsYesterday = Production::whereDate(
            'production_date',
            today()->subDay()
        )->sum('eggs_produced');

        $eggsChange = $eggsYesterday > 0
            ? round((($eggsToday - $eggsYesterday) / $eggsYesterday) * 100, 1)
            : 0;

        $feedStock = InventoryItem::where('item_name', 'Feeds')
            ->sum('current_stock');

        $feedMin = InventoryItem::where('item_name', 'Feeds')
            ->sum('min_level');

        $feedLow = $feedStock <= $feedMin;

        $supplements = InventoryItem::where('item_name', 'Supplement')
            ->sum('current_stock');

        $eggTrays = InventoryItem::where('item_name', 'Egg Tray')
            ->sum('current_stock');

        $eggsTotal = Production::sum('eggs_produced');

        $dispatchedTrays = DB::table('dispatch_items')
            ->sum('quantity');

        $pendingDeliveries = Dispatch::whereIn('status', [
            'Pending',
            'On Transit'
        ])->count();

        $revenueToday = Transaction::whereDate(
            'transaction_date',
            today()
        )->sum('price');

        $lowStockAlert = InventoryItem::whereColumn(
            'current_stock',
            '<=',
            'min_level'
        )->count();

        $weekly = Production::selectRaw("
        DATE(production_date) as production_date,
        SUM(eggs_produced) as total
    ")
            ->whereBetween('production_date', [
                now()->subDays(6)->startOfDay(),
                now()->endOfDay()
            ])
            ->groupBy(DB::raw('DATE(production_date)'))
            ->orderBy('production_date')
            ->get();

        $eggChartLabels = [];
        $eggChartData = [];

        foreach ($weekly as $day) {
            $eggChartLabels[] = Carbon::parse($day->production_date)->format('D');
            $eggChartData[] = $day->total;
        }

        return view('owner.dashboard', compact(
            'eggsToday',
            'eggsChange',
            'feedStock',
            'feedMin',
            'feedLow',
            'dispatchedTrays',
            'pendingDeliveries',
            'revenueToday',
            'eggsTotal',
            'eggTrays',
            'supplements',
            'lowStockAlert',
            'eggChartLabels',
            'eggChartData'
        ));
    }
}