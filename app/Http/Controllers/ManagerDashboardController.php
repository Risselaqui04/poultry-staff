<?php

namespace App\Http\Controllers;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $eggsToday = 0;
        $feedStock = 0;
        $pendingDeliveries = 0;

        return view('manager.dashboard', compact(
            'eggsToday',
            'feedStock',
            'pendingDeliveries'
        ));
    }
}