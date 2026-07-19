@extends('layouts.sidebar')

@section('title', 'Manager Dashboard')
@section('page-label', 'Dashboard')

@section('content')

    @php
        $eggsToday = $eggsToday ?? 0;
        $eggsChange = $eggsChange ?? 0;

        $feedStock = $feedStock ?? 0;
        $feedMin = $feedMin ?? 0;
        $feedLow = $feedLow ?? false;

        $pendingDeliveries = $pendingDeliveries ?? 0;
        $dispatchedTrays = $dispatchedTrays ?? 0;

        $eggTrays = $eggTrays ?? 0;
        $supplements = $supplements ?? 0;
        $lowStockAlert = $lowStockAlert ?? null;

        $eggChartLabels = $eggChartLabels ?? [];
        $eggChartData = $eggChartData ?? [];
        $eggForecastLabels = $eggForecastLabels ?? [];
        $eggForecastData = $eggForecastData ?? [];
    @endphp
@push('styles')
    @vite('resources/css/manager.dashboard.css')
@endpush
    <div class="container-fluid">

        <!-- Header -->
        <div class="dashboard-header mb-4">

            <div>

                <h2 class="fw-bold">
                    Manager Dashboard
                </h2>

                <p class="text-muted mb-0">
                    Welcome back! Here's today's poultry farm overview.
                </p>

            </div>

        </div>

        @if($lowStockAlert)

            <div class="alert alert-warning border-0 rounded-4 shadow-sm">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <strong>Low Stock Alert</strong>

                {{ $lowStockAlert }}

            </div>

        @endif

        <!-- Cards -->

        <div class="row g-4">

            <!-- Eggs -->

            <div class="col-xl-3 col-md-6">

                <div class="card dashboard-card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <span class="text-muted small">
                                    Today's Production
                                </span>

                                <h2 class="fw-bold mt-2">
                                    {{ number_format($eggsToday) }}
                                </h2>

                                <small class="text-success">

                                    {{ $eggsChange >= 0 ? '+' : '-' }}

                                    {{ abs($eggsChange) }}%

                                    from yesterday

                                </small>

                            </div>

                            <div class="card-icon bg-success-subtle">

                                <i class="bi bi-egg-fill text-success"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Feed -->

            <div class="col-xl-3 col-md-6">

                <div class="card dashboard-card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <span class="text-muted small">

                                    Feed Stock

                                </span>

                                <h2 class="fw-bold mt-2">

                                    {{ number_format($feedStock) }}

                                </h2>

                                <small class="{{ $feedLow ? 'text-danger' : 'text-warning' }}">

                                    {{ $feedLow ? 'Low Stock' : 'Bags Available' }}

                                </small>

                            </div>

                            <div class="card-icon bg-warning-subtle">

                                <i class="bi bi-box-seam-fill text-warning"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Dispatch -->

            <div class="col-xl-3 col-md-6">

                <div class="card dashboard-card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <span class="text-muted small">

                                    Pending Dispatch

                                </span>

                                <h2 class="fw-bold mt-2">

                                    {{ number_format($pendingDeliveries) }}

                                </h2>

                                <small class="text-primary">

                                    {{ $dispatchedTrays }} trays dispatched

                                </small>

                            </div>

                            <div class="card-icon bg-primary-subtle">

                                <i class="bi bi-truck text-primary"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Egg Trays -->

            <div class="col-xl-3 col-md-6">

                <div class="card dashboard-card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <span class="text-muted small">

                                    Empty Egg Trays

                                </span>

                                <h2 class="fw-bold mt-2">

                                    {{ number_format($eggTrays) }}

                                </h2>

                                <small class="text-info">

                                    Available

                                </small>

                            </div>

                            <div class="card-icon bg-info-subtle">

                                <i class="bi bi-grid-fill text-info"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Graph + Inventory -->

        <div class="row mt-4 g-4">

            <div class="col-lg-8">

                <div class="card shadow-sm border-0 rounded-4">

                    <div class="card-header bg-white">

                        <strong>

                            Egg Production (Last 7 Days + Forecast)

                        </strong>

                    </div>

                    <div class="card-body">

                        <div style="height:350px;">

                            <canvas id="eggChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card shadow-sm border-0 rounded-4">

                    <div class="card-header bg-white">

                        <strong>

                            Inventory Overview

                        </strong>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <div class="d-flex justify-content-between">

                                <span>Feeds</span>

                                <strong>{{ $feedStock }}</strong>

                            </div>

                            <div class="progress mt-2">

                                <div class="progress-bar bg-success"
                                    style="width:{{ min(100, ($feedStock / max($feedMin, 1)) * 50) }}%">

                                </div>

                            </div>

                        </div>

                        <div class="mb-4">

                            <div class="d-flex justify-content-between">

                                <span>Egg Trays</span>

                                <strong>{{ $eggTrays }}</strong>

                            </div>

                            <div class="progress mt-2">

                                <div class="progress-bar bg-info" style="width:{{ min(100, $eggTrays) }}%">

                                </div>

                            </div>

                        </div>

                        <div>

                            <div class="d-flex justify-content-between">

                                <span>Supplements</span>

                                <strong>{{ $supplements }}</strong>

                            </div>

                            <div class="progress mt-2">

                                <div class="progress-bar bg-warning" style="width:{{ min(100, $supplements) }}%">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <style>
        .dashboard-card {

            border-radius: 20px;

            transition: .3s;

        }

        .dashboard-card:hover {

            transform: translateY(-5px);

        }

        .card-icon {

            width: 60px;

            height: 60px;

            border-radius: 16px;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 28px;

        }

        .progress {

            height: 8px;

            border-radius: 10px;

        }
    </style>

@endsection

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const ctx = document.getElementById('eggChart');

        const actualLabels = @json($eggChartLabels);

        const forecastLabels = @json($eggForecastLabels);

        const labels = [...actualLabels, ...forecastLabels];

        const actual = @json($eggChartData);

        const forecast = @json($eggForecastData);

        new Chart(ctx, {

            data: {

                labels: labels,

                datasets: [

                    {

                        type: 'bar',

                        label: 'Actual',

                        data: [...actual, ...Array(forecast.length).fill(null)],

                        backgroundColor: '#2E7D32',

                        borderRadius: 8

                    },

                    {

                        type: 'line',

                        label: 'Forecast',

                        data: [

                            ...Array(actual.length - 1).fill(null),

                            actual[actual.length - 1],

                            ...forecast

                        ],

                        borderColor: '#ff9800',

                        borderDash: [6, 6],

                        fill: false,

                        tension: .4

                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {

                        position: 'top'

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true

                    }

                }

            }

        });

    </script>

@endpush