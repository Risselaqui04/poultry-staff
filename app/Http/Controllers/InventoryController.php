<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Production;

class InventoryController extends Controller
{
    public function index()
    {
        // Inventory items
        $items = Inventory::orderBy('item_name')->get();

        // Summary Cards
        $feed = Inventory::where('item_name', 'Feeds')->first();
        $supplements = Inventory::where('item_name', 'Supplements')->first();
        $eggTrays = Inventory::where('item_name', 'Egg Trays')->first();

        // Total Eggs
        $eggsStock = 0;

        // Production records
        $eggProduction = collect();

        // Uncomment kapag mayroon nang Production model/table
        /*
        $eggsStock = Production::sum('total');
        $eggProduction = Production::latest()->get();
        */

        return view('inventory', compact(
            'items',
            'feed',
            'supplements',
            'eggTrays',
            'eggsStock',
            'eggProduction'
        ));
    }
}