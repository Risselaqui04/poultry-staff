@extends('layouts.sidebar')
@section('title', 'Revenue')

@section('content')

    <div class="revenue-page">
        <h3 class="page-title mb-4">
            Revenue Overview
        </h3>

        <!-- SUMMARY CARDS -->

        <div class="row g-4 mb-4">

            <div class="col-lg-3 col-md-6">

                <div class="summary-card">

                    <span class="summary-label">
                        TODAY
                    </span>

                    <h2>
                        ₱{{ number_format($todayRevenue ?? 0, 2) }}
                    </h2>

                    <small>
                        Today's Total
                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="summary-card">

                    <span class="summary-label">
                        THIS WEEK
                    </span>

                    <h2>
                        ₱{{ number_format($weekRevenue ?? 0, 2) }}
                    </h2>

                    <small>
                        7-day Total
                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="summary-card">

                    <span class="summary-label">
                        THIS MONTH
                    </span>

                    <h2>
                        ₱{{ number_format($monthRevenue ?? 0, 2) }}
                    </h2>

                    <small>
                        Monthly Revenue
                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="summary-card warning">

                    <span class="summary-label">
                        PENDING
                    </span>

                    <h2>
                        ₱{{ number_format($pendingRevenue ?? 0, 2) }}
                    </h2>

                    <small>
                        Awaiting Payment
                    </small>

                </div>

            </div>

        </div>

        <!-- CHART + FORM -->

        <div class="row g-4 mb-4">

            <!-- CHART -->

            <div class="col-lg-7">

                <div class="revenue-card chart-card">

                    <h5 class="card-title mb-4">
                        Weekly Revenue
                    </h5>
                    <canvas id="revenueChart" height="140"></canvas>

                </div>

            </div>

            <!-- FORM -->

            <div class="col-lg-5">

                <div class="revenue-card">

                    <h6 class="form-title mb-4">

                        RECORD NEW REVENUE

                    </h6>

                    <form method="POST" action="{{ route('owner.revenue.store') }}">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Customer

                            </label>

                            <input type="text" name="customer_name" class="form-control" placeholder="Customer Name"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Dispatch

                            </label>

                            <select name="dispatch_id" class="form-select">

                                <option value="">

                                    Select Dispatch

                                </option>

                                @foreach($dispatches ?? [] as $dispatch)

                                    <option value="{{ $dispatch->dispatch_id }}">

                                        Dispatch #{{ $dispatch->dispatch_id }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Date

                            </label>

                            <input type="date" name="transaction_date" class="form-control" value="{{ date('Y-m-d') }}">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Payment Status

                            </label>

                            <select class="form-select" name="status">

                                <option>

                                    Paid

                                </option>

                                <option>

                                    Pending

                                </option>

                            </select>

                        </div>

                        <div class="total-box">

                            <span>

                                Total Amount

                            </span>

                            <strong>

                                ₱0.00

                            </strong>

                        </div>

                        <button class="btn-save mt-4">

                            Save Revenue

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- TRANSACTIONS -->
        <div class="revenue-card">

            <div class="transactions-header">

                <h5>
                    Transactions
                </h5>

                <div class="transactions-tools">

                    <input type="text" class="search-box" placeholder="Search customer...">

                    <select class="sort-box">

                        <option>
                            Newest First
                        </option>

                        <option>
                            Oldest First
                        </option>

                    </select>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table revenue-table align-middle">

                    <thead>

                        <tr>

                            <th>Customer</th>

                            <th>Dispatch</th>

                            <th>Total</th>

                            <th>Date</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($revenues ?? [] as $revenue)

                            <tr>

                                <td>

                                    {{ $revenue->customer_name }}

                                </td>

                                <td>

                                    #{{ $revenue->dispatch_id }}

                                </td>

                                <td>

                                    ₱{{ number_format($revenue->total_amount, 2) }}

                                </td>

                                <td>

                                    {{ \Carbon\Carbon::parse($revenue->transaction_date)->format('M d, Y') }}

                                </td>

                                <td>

                                    @if(($revenue->status ?? 'Paid') == 'Paid')

                                        <span class="badge bg-success">

                                            Paid

                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">

                                            Pending

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center text-muted py-5">

                                    No Revenue Records Found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="pagination-area">

                Showing Revenue Records

            </div>

        </div>

    </div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/revenue.css') }}">
    @endpush
@endsection

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const ctx = document.getElementById('revenueChart');

        if (ctx) {

            new Chart(ctx, {

                type: 'line',

                data: {

                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],

                    datasets: [{

                        label: 'Revenue',

                        data: [1200, 1500, 1800, 1600, 2400, 2100, 2800],

                        borderColor: '#2E7D32',

                        backgroundColor: 'rgba(46,125,50,.12)',

                        fill: true,

                        tension: .4

                    }]

                },

                options: {

                    responsive: true,

                    plugins: {

                        legend: {

                            display: false

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true

                        }

                    }

                }

            });

        }

    </script>
    

    <script>

        const ctx = document.getElementById('revenueChart');

        if (ctx) {


            const gradient = context.createLinearGradient(0, 0, 0, 350);

            gradient.addColorStop(0, 'rgba(46,125,50,.35)');
            gradient.addColorStop(1, 'rgba(46,125,50,0)');

            new Chart(context, {

                type: 'line',

                data: {

                    labels: @json(collect($chartData)->pluck('day')),

                    datasets: [{

                        label: 'Revenue',

                        data: @json(collect($chartData)->pluck('amount')),

                        borderColor: '#2E7D32',

                        backgroundColor: gradient,

                        fill: true,

                        tension: .4,

                        pointRadius: 5,

                        pointHoverRadius: 7,

                        pointBackgroundColor: '#2E7D32',

                        pointBorderColor: '#fff',

                        pointBorderWidth: 2,

                        borderWidth: 3

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {
                            display: false
                        }

                    },

                    scales: {

                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280'
                            }
                        },

                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#eef2f7'
                            },
                            ticks: {
                                color: '#6b7280',
                                callback: function (value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        }

                    }

                }

            });

        }

    </script>
@endpush