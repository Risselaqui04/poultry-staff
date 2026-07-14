<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = today();

        /*
        |--------------------------------------------------------------------------
        | Today's Production
        |--------------------------------------------------------------------------
        */

        $todayProduction = Production::whereDate('production_date', today())
            ->sum('eggs_produced');

        /*
        |--------------------------------------------------------------------------
        | Summary Cards
        |--------------------------------------------------------------------------
        */

        $totalEggs = Production::sum('eggs_produced');

        $feeds = Inventory::where('item_name', 'Feeds')->value('quantity');

        $eggTrays = Inventory::where('item_name', 'Egg Trays')->value('quantity');

        /*
        |--------------------------------------------------------------------------
        | Weekly Production Chart
        |--------------------------------------------------------------------------
        */

        $weeklyProduction = Production::selectRaw("
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

        return view('dashboardview', compact(
            'todayProduction',
            'totalEggs',
            'feeds',
            'eggTrays',
            'weeklyProduction'
        ));
    }
}