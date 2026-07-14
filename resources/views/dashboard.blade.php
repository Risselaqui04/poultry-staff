@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<!-- Summary Cards -->
<div class="cards">

    <div class="card-box">
        <div class="card-icon green">
            <i class="fas fa-egg"></i>
        </div>

        <div class="card-info">
            <h5>Total Eggs Today</h5>
            <h2>0</h2>
        </div>
    </div>

    <div class="card-box">
        <div class="card-icon blue">
            <i class="fas fa-industry"></i>
        </div>

        <div class="card-info">
            <h5>Production Records</h5>
            <h2>0</h2>
        </div>
    </div>

    <div class="card-box">
        <div class="card-icon orange">
            <i class="fas fa-boxes"></i>
        </div>

        <div class="card-info">
            <h5>Inventory Items</h5>
            <h2>0</h2>
        </div>
    </div>

    <div class="card-box">
        <div class="card-icon red">
            <i class="fas fa-truck"></i>
        </div>

        <div class="card-info">
            <h5>Dispatch Today</h5>
            <h2>0</h2>
        </div>
    </div>

    <div class="card-box">
        <div class="card-icon purple">
            <i class="fas fa-money-bill-wave"></i>
        </div>

        <div class="card-info">
            <h5>Revenue</h5>
            <h2>₱0.00</h2>
        </div>
    </div>

    <div class="card-box">
        <div class="card-icon teal">
            <i class="fas fa-users"></i>
        </div>

        <div class="card-info">
            <h5>Workers</h5>
            <h2>0</h2>
        </div>
    </div>

</div>

<!-- Dashboard Bottom -->
<div class="dashboard-grid">

    <!-- Left -->
    <div class="dashboard-card">

        <div class="card-header">
            <h4>Today's Production</h4>
        </div>

        <table class="table-dashboard">

            <thead>

                <tr>

                    <th>Batch</th>
                    <th>Eggs</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Batch 1</td>
                    <td>0</td>
                    <td>
                        <span class="badge success">
                            Ready
                        </span>
                    </td>

                </tr>

                <tr>

                    <td>Batch 2</td>
                    <td>0</td>
                    <td>
                        <span class="badge warning">
                            Pending
                        </span>
                    </td>

                </tr>

                <tr>

                    <td>Batch 3</td>
                    <td>0</td>
                    <td>
                        <span class="badge danger">
                            No Record
                        </span>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <!-- Right -->
    <div class="dashboard-card">

        <div class="card-header">

            <h4>Quick Menu</h4>

        </div>

        <div class="quick-actions">

            <a href="{{ route('production') }}" class="quick-btn">

                <i class="fas fa-industry"></i>

                <span>Production</span>

            </a>

            <a href="{{ route('inventory') }}" class="quick-btn">

                <i class="fas fa-boxes"></i>

                <span>Inventory</span>

            </a>

            <a href="{{ route('forecast') }}" class="quick-btn">

                <i class="fas fa-chart-line"></i>

                <span>Forecast</span>

            </a>

            <a href="{{ route('dispatch') }}" class="quick-btn">

                <i class="fas fa-truck"></i>

                <span>Dispatch</span>

            </a>

            <a href="{{ route('revenue') }}" class="quick-btn">

                <i class="fas fa-money-bill-wave"></i>

                <span>Revenue</span>

            </a>

            <a href="{{ route('users') }}" class="quick-btn">

                <i class="fas fa-users"></i>

                <span>Users</span>

            </a>

        </div>

    </div>

</div>

@endsection