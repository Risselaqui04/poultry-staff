<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index(Request $request)
{
    $stats = [
        'today' => 12450,
        'week' => 65320,
        'month' => 245000,
        'pending' => 18300,
    ];

    $chartData = [
        ['day'=>'Mon','amount'=>12000],
        ['day'=>'Tue','amount'=>18000],
        ['day'=>'Wed','amount'=>14000],
        ['day'=>'Thu','amount'=>21000],
        ['day'=>'Fri','amount'=>25000],
        ['day'=>'Sat','amount'=>17000],
        ['day'=>'Sun','amount'=>19500],
    ];

    $transactions = collect([
        (object)[
            'customer'=>'Juan Dela Cruz',
            'quantity'=>50,
            'price'=>17500,
            'transaction_date'=>now(),
            'status'=>'Paid',
        ],
        (object)[
            'customer'=>'ABC Poultry',
            'quantity'=>35,
            'price'=>12250,
            'transaction_date'=>now()->subDay(),
            'status'=>'Pending',
        ],
        (object)[
            'customer'=>'Maria Santos',
            'quantity'=>20,
            'price'=>7000,
            'transaction_date'=>now()->subDays(2),
            'status'=>'Paid',
        ],
        (object)[
            'customer'=>'Golden Farm',
            'quantity'=>15,
            'price'=>5250,
            'transaction_date'=>now()->subDays(3),
            'status'=>'Partial',
        ],
    ]);

    return view('owner.revenue', compact(
        'stats',
        'chartData',
        'transactions'
    ));
}

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'customer'         => ['required', 'string', 'max:255'],
            'transaction_date' => ['required', 'date'],
            'quantity'         => ['required', 'integer', 'min:1'],
            'price_per_tray'   => ['required', 'numeric', 'min:0.01'],
            'status'           => ['required', 'in:Paid,Pending,Partial'],
        ]);

        $validated['total_amount'] =
            $validated['quantity'] * $validated['price_per_tray'];

        Transaction::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Transaction saved successfully!',
            ], 201);
        }

        $role = strtolower(trim(auth()->user()->role));

        if ($role === 'farm owner') {
            $role = 'owner';
        }

        if ($role === 'farm manager') {
            $role = 'manager';
        }

        if ($role === 'poultry staff') {
            $role = 'staff';
        }

        return redirect()
            ->route($role . '.revenue')
            ->with('success', 'Transaction saved successfully!');
    }

    public function search(Request $request): JsonResponse
    {
        $term = $request->query('term');

        $results = Transaction::search($term)
            ->orderByDesc('transaction_date')
            ->limit(20)
            ->get([
                'id',
                'customer',
                'transaction_date',
                'quantity',
                'price',
                'status',
            ]);

        return response()->json([
            'results' => $results
        ]);
    }

 private function buildStats(): array
{
    return [
        'today'   => 0,
        'week'    => 0,
        'month'   => 0,
        'pending' => 0,
    ];
}
    private function filteredTransactions(Request $request)
    {
        $query = Transaction::search($request->query('search'));

        switch ($request->query('sort', 'date_desc')) {

            case 'date_asc':
                $query->orderBy('transaction_date')
                      ->orderBy('id');
                break;

            case 'name_asc':
                $query->orderBy('customer');
                break;

            case 'name_desc':
                $query->orderByDesc('customer');
                break;

            default:
                $query->orderByDesc('transaction_date')
                      ->orderByDesc('id');
                break;
        }

        return $query->paginate(10)
                     ->withQueryString();
    }
}