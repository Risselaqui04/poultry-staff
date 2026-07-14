
@extends('layouts.dashboard')
@section('title','Inventory')
@section('content')
<div class="inventory-page">

    @if($feed && $feed->current_stock < $feed->min_level)
        <div class="alert-low">
            ⚠ <strong>Feed stock below reorder point</strong>
            — Current: {{ $feed->current_stock }} {{ $feed->unit }} | Minimum: {{ $feed->min_level }} {{ $feed->unit }}. Immediate reorder suggested.
        </div>
    @endif

    <div class="stat-grid">
        <div class="stat-card">
            <span class="stat-label">EGGS STOCK</span>
            <div class="stat-value">{{ number_format($eggsStock) }}</div>
            <span class="stat-sub">pcs — {{ $eggsStock > 0 ? 'OK' : 'No Data' }}</span>
        </div>

        <div class="stat-card {{ $feed && $feed->current_stock < $feed->min_level ? 'stat-card-alert' : '' }}">
            <span class="stat-label">FEED</span>
            <div class="stat-value {{ $feed && $feed->current_stock < $feed->min_level ? 'text-danger' : '' }}">
                {{ $feed->current_stock ?? 0 }} {{ $feed->unit ?? '' }}
            </div>
            <span class="stat-sub {{ $feed && $feed->current_stock < $feed->min_level ? 'text-danger' : '' }}">
                Min: {{ $feed->min_level ?? 0 }} — {{ $feed && $feed->current_stock < $feed->min_level ? 'LOW' : 'OK' }}
            </span>
        </div>

        <div class="stat-card">
            <span class="stat-label">SUPPLEMENTS</span>
            <div class="stat-value">{{ $supplements->current_stock ?? 0 }}</div>
            <span class="stat-sub">{{ $supplements->unit ?? 'pack' }} — OK</span>
        </div>

        <div class="stat-card">
            <span class="stat-label">EGG TRAYS</span>
            <div class="stat-value">{{ $eggTrays->current_stock ?? 0 }}</div>
            <span class="stat-sub">pcs — Watch</span>
        </div>
    </div>

    
<div>
<button class="btn-update">+ Update Stock</button>
    </div>
</div>
    <table class="inventory-table">
        <thead>
            <tr>
                <th>ITEM</th>
                <th>CURRENT STOCK</th>
                <th>MIN LEVEL</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->item_name }} ({{ $item->unit }})</td>
                <td class="{{ $item->status === 'LOW' ? 'text-danger fw-bold' : '' }}">
                    {{ $item->current_stock }}
                </td>
                <td>{{ $item->min_level }}</td>
                <td class="{{ $item->status === 'LOW' ? 'text-danger fw-bold' : 'text-success' }}">
                    {{ $item->status }}
                </td>
                <td>
                    <a href="#" class="{{ $item->status === 'LOW' ? 'text-danger' : '' }}">
                        {{ $item->status === 'LOW' ? 'Reorder' : 'Update' }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="section-title">Egg Production</h2>
    <table class="inventory-table">
        <thead>
            <tr>
                <th>BATCH</th>
                <th>SMALL</th>
                <th>MEDIUM</th>
                <th>LARGE</th>
                <th>EXTRA LARGE</th>
                <th>CRACKED</th>
                <th>TOTAL</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eggProduction as $prod)
            <tr>
                <td>{{ $prod->batch }}</td>
                <td>{{ $prod->small }}</td>
                <td>{{ $prod->medium }}</td>
                <td>{{ $prod->large }}</td>
                <td>{{ $prod->extra_large }}</td>
                <td>{{ $prod->cracked }}</td>
                <td><strong>{{ $prod->small + $prod->medium + $prod->large + $prod->extra_large }}</strong></td>
                <td>{{ \Carbon\Carbon::parse($prod->created_at)->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<style>
.inventory-page { padding: 24px; }
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
.breadcrumb { font-size: 13px; color: #888; }
.page-header h1 { font-size: 22px; margin: 4px 0 0; }
.btn-update { background: #2e7d32; color: #fff; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer; }

.alert-low { background: #fdf3e2; border: 1px solid #f0c987; color: #7a5b1a; padding: 10px 16px; border-radius: 6px; margin-bottom: 16px; font-size: 14px; }

.stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
.stat-card { background: #fff; border: 1px solid #e5e5e5; border-radius: 8px; padding: 16px; }
.stat-card-alert { border: 2px solid #d32f2f; }
.stat-label { font-size: 12px; color: #999; letter-spacing: .5px; }
.stat-value { font-size: 28px; font-weight: 700; margin: 4px 0; }
.stat-sub { font-size: 12px; color: #999; }
.text-danger { color: #d32f2f !important; }
.text-success { color: #2e7d32; }
.fw-bold { font-weight: 700; }

.section-title { margin: 24px 0 12px; font-size: 18px; }

.inventory-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; }
.inventory-table th { text-align: left; font-size: 12px; color: #888; padding: 12px 16px; border-bottom: 1px solid #eee; }
.inventory-table td { padding: 12px 16px; border-bottom: 1px solid #f2f2f2; font-size: 14px; }
</style>
@endsection