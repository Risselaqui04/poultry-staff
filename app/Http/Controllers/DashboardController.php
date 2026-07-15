<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index()
{
    /*
    |--------------------------------------------------------------------------
    | Latest Production Date
    |--------------------------------------------------------------------------
    */

    $latestDate = Production::max('production_date');

    /*
    |--------------------------------------------------------------------------
    | Dashboard Cards
    |--------------------------------------------------------------------------
    */

    // Total Eggs Today
    $todayProduction = Production::whereDate('production_date', $latestDate)
        ->sum('eggs_produced');

    // Active Batches
    $activeBatches = Production::whereDate('production_date', $latestDate)
        ->distinct('batch_id')
        ->count('batch_id');

    // Feeds Available
    $feeds = Inventory::where('item_type', 'Feed')
        ->sum('quantity');

    // Egg Trays Available
    $eggTrays = Inventory::where('item_type', 'Egg Tray')
        ->sum('quantity');

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
        'activeBatches',
        'feeds',
        'eggTrays',
        'weeklyProduction'
    ));
}
}