<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $table = 'inventory_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'item_name',
        'current_stock',
        'min_level',
        'unit'
    ];
}