<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Production;

class InventoryController extends Controller
{
    public function index()
    {
        // Inventory Items
        $items = Inventory::orderBy('item_name')->get();

        // Summary Cards
        $feed = (object) [
            'current_stock' => Inventory::where('item_type', 'Feed')->sum('quantity'),
            'min_level' => Inventory::where('item_type', 'Feed')->sum('minimum_stock'),
        ];
        $supplements = (object) [
            'current_stock' => Inventory::where('item_type', 'Supplement')->sum('quantity'),
            'min_level' => Inventory::where('item_type', 'Supplement')->sum('minimum_stock'),
        ];
        $eggTrays = (object) [
            'current_stock' => Inventory::where('item_type', 'Egg Tray')->sum('quantity'),
            'min_level' => Inventory::where('item_type', 'Egg Tray')->sum('minimum_stock'),
        ];
        // Latest Production Date

        $latestDate = Production::max('production_date');

        // Total Eggs Stock
        $eggsStock = Production::whereDate('production_date', $latestDate)
            ->sum('eggs_produced');

        // Egg Production Table
        $eggProduction = Production::whereDate('production_date', $latestDate)
            ->orderBy('batch_id')
            ->get([
                'batch_id as batch',
                'small_eggs as small',
                'medium_eggs as medium',
                'large_eggs as large',
                'extra_large_eggs as extra_large',
                'cracked_eggs as cracked',
                'eggs_produced',
                'production_date as created_at'
            ]);

        // Update Status Automatically
        foreach ($items as $item) {

            $item->status =
                $item->quantity <= $item->minimum_stock
                ? 'LOW'
                : 'OK';
        }

        return view('inventory', compact(
            'items',
            'feed',
            'supplements',
            'eggTrays',
            'eggsStock',
            'eggProduction'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | ADD ITEM
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
       $request->validate([
    'item_name' => 'required|string|max:255',
    'item_type' => 'required|string',
    'quantity' => 'required|integer|min:0',
    'minimum_stock' => 'required|integer|min:0',
]);

        Inventory::create([
    'item_name' => $request->input('item_name'),
    'item_type' => $request->input('item_type'),
    'quantity' => (int) $request->input('quantity'),
    'minimum_stock' => (int) $request->input('minimum_stock'),
]);
        return back()->with('success', 'Item added successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STOCK
    |--------------------------------------------------------------------------
    */

   public function update(Request $request, $id)
{
    $request->validate([
        'operation' => 'required|in:add,deduct',
        'quantity' => 'required|integer|min:1',
    ]);

    $item = Inventory::findOrFail($id);

    if ($request->operation == 'add') {
        $item->quantity += $request->quantity;
    } else {
        if ($item->quantity < $request->quantity) {
            return back()->with('error', 'Insufficient stock.');
        }

        $item->quantity -= $request->quantity;
    }

    $item->save();

    return back()->with('success', 'Stock updated successfully.');
}

    /*
    |--------------------------------------------------------------------------
    | DELETE ITEM
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);

        $item->delete();

        return redirect()
            ->route('inventory')
            ->with('success', 'Item deleted successfully.');
    }
}