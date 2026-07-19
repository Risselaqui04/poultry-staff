<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->role;
        $search = $request->search;
        $status = $request->status;

        $users = User::query();

        // Filter by role
        if ($role) {
            $users->where('role', $role);
        }

        // Search
        if ($search) {
            $users->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($status) {
            $users->where('status', $status);
        }

        $users = $users->latest()->paginate(10);

        return view('owner.users', compact(
            'users',
            'role',
            'search',
            'status'
        ));
    }
}