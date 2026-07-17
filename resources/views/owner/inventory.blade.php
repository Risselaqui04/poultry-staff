@extends('layouts.sidebar')
@section('title', 'Inventory')
@section('content')

@push('styles')
@vite('resources/css/inventory.css')
@endpush

    <div class="inventory-page">

        @if($feed && $feed->current_stock < $feed->min_level)
            <div class="alert-low">
                ⚠ <strong>Feed stock below reorder point</strong>
                — Current: {{ $feed->current_stock }}
                Immediate reorder suggested.
            </div>
        @endif

        <div class="stat-grid">

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-left">
                <span class="stat-label">EGGS<br>STOCK</span>
            </div>

            <div class="stat-right">
                <div class="stat-value">{{ number_format($eggsStock) }}</div>
                <span class="stat-sub">pcs — {{ $eggsStock > 0 ? 'OK' : 'No Data' }}</span>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-left">
                <span class="stat-label">OVERALL<br>EGGS</span>
            </div>

            <div class="stat-right">
                <div class="stat-value">{{ number_format($overallEggs) }}</div>
                <span class="stat-sub">Total eggs available</span>
            </div>
        </div>
    </div>

    <div class="stat-card {{ $feed && $feed->current_stock < $feed->min_level ? 'stat-card-alert' : '' }}">
        <div class="stat-content">
            <div class="stat-left">
                <span class="stat-label">FEED</span>
            </div>

            <div class="stat-right">
                <div class="stat-value {{ $feed && $feed->current_stock < $feed->min_level ? 'text-danger' : '' }}">
                    {{ $feed->current_stock ?? 0 }}
                </div>

                <span class="stat-sub {{ $feed && $feed->current_stock < $feed->min_level ? 'text-danger' : '' }}">
                    Min: {{ $feed->min_level ?? 0 }} — {{ $feed && $feed->current_stock < $feed->min_level ? 'LOW' : 'OK' }}
                </span>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-left">
                <span class="stat-label">SUPPLEMENTS</span>
            </div>

            <div class="stat-right">
                <div class="stat-value">{{ $supplements->current_stock ?? 0 }}</div>
                <span class="stat-sub">{{ $supplements->unit ?? 'ML' }} — OK</span>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-left">
                <span class="stat-label">EGG<br>TRAYS</span>
            </div>

            <div class="stat-right">
                <div class="stat-value">{{ $eggTrays->current_stock ?? 0 }}</div>
                <span class="stat-sub">Trays — Watch</span>
            </div>
        </div>
    </div>

</div>

        <div>
            <button class="btn-update" data-bs-toggle="modal" data-bs-target="#addItemModal">

                + Add Stock

            </button>
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
                    <td>{{ $item->item_name }}</td>
                    <td class="{{ $item->status === 'LOW' ? 'text-danger fw-bold' : '' }}">
                        {{ $item->quantity }}
                    </td>
                    <td>{{ $item->minimum_stock }}</td>
                    <td class="{{ $item->status === 'LOW' ? 'text-danger fw-bold' : 'text-success' }}">
                        {{ $item->status }}
                    </td>
                    <td>

                        <form action="{{ route('owner.inventory.destroy', $item->inventory_id) }}" method="POST"
                            class="d-inline deleteForm">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">

                                <i class="fas fa-trash"></i>

                                Delete

                            </button>

                        </form>

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
                    <td><strong>{{ number_format($prod->eggs_produced) }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($prod->created_at)->format('M d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>



    <!-- UPDATE STOCK MODAL -->

    <div class="modal fade" id="updateStockModal">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" id="updateForm">

                    @csrf

                    <div class="modal-header bg-success text-white">

                        <h5 class="modal-title">

                            Update Stock

                        </h5>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="fw-bold">

                                Item

                            </label>

                            <input type="text" id="item_name" class="form-control" readonly>

                        </div>

                        <div class="mb-3">

                            <label class="fw-bold">

                                Current Stock

                            </label>

                            <input type="text" id="current_stock" class="form-control" readonly>

                        </div>

                        <div class="mb-3">

                            <label class="fw-bold">

                                Operation

                            </label>

                            <select name="operation" class="form-select">

                                <option value="add">

                                    Add Stock

                                </option>

                                <option value="deduct">

                                    Deduct Stock

                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="fw-bold">

                                Quantity

                            </label>

                            <input type="number" name="quantity" min="1" class="form-control" required>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button class="btn btn-success">

                            Save

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <!-- ADD ITEM MODAL -->

    <div class="modal fade" id="addItemModal">

        <div class="modal-dialog">

            <form action="{{ route('owner.inventory.store') }}" method="POST">

                @csrf

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">

                            Add Inventory Item

                        </h5>

                        <button class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">

                                Item Name

                            </label>

                            <input type="text" name="item_name" class="form-control" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Item Type</label>

                            <select name="item_type" class="form-select" required>

                                <option value="">Select Type</option>
                                <option value="Feed">Feed</option>
                                <option value="Supplement">Supplement</option>
                                <option value="Egg Tray">Egg Tray</option>
                                <option value="Other">Other</option>

                            </select>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Current Stock

                            </label>

                            <input type="number" name="quantity" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Minimum Stock

                            </label>

                            <input type="number" name="minimum_stock" class="form-control" required>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-secondary" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button class="btn btn-success">

                            Save

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <script>

        document.querySelectorAll('.deleteForm').forEach(form => {

            form.addEventListener('submit', function (e) {

                e.preventDefault();

                Swal.fire({

                    title: 'Delete Item?',

                    text: 'This action cannot be undone.',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#d33',

                    cancelButtonColor: '#6c757d',

                    confirmButtonText: 'Delete'

                }).then((result) => {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });


    </script>
@endsection