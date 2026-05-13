<x-app-layout>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Stock In</h3>
            <p class="text-muted">Record incoming stock from suppliers</p>
        </div>
        <button class="btn btn-gradient d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createStockInModal">
            <i class="bi bi-plus-lg"></i>
            Add Stock In
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    @endif

    <div class="card p-0 overflow-hidden shadow-sm">
        <!-- SEARCH -->
        <div class="p-4 border-bottom bg-white">
            <form method="GET" action="{{ route('stock-in.index') }}">
                <div class="position-relative" style="max-width: 100%;">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" name="search" class="form-control rounded-pill ps-5 border-light-subtle shadow-sm" placeholder="Search by stock name, supplier, or employee..." value="{{ request('search') }}" style="height: 50px;">
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">STOCK NAME</th>
                        <th>SUPPLIER</th>
                        <th>QUANTITY</th>
                        <th>SELLING PRICE</th>
                        <th>TOTAL COST</th>
                        <th>DATE RECEIVED</th>
                        <th>PROCESSED BY</th>
                        <th class="text-end pe-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockins as $item)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $item->products_name }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-building text-muted"></i>
                                {{ $item->supplier ?? 'N/A' }}
                            </div>
                        </td>
                        <td><span class="badge-unit">{{ number_format($item->quantity) }} units</span></td>
                        <td class="text-success fw-medium">₱{{ number_format($item->selling_price, 2) }}</td>
                        <td class="fw-bold text-danger">₱{{ number_format($item->total_cost_value, 2) }}</td>
                        <td>
                            <div class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($item->date_received)->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1 fw-normal">
                                <i class="bi bi-person me-1"></i>{{ $item->processed_by }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <form method="POST" action="{{ route('stock-in.destroy', $item->transaction_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <span class="text-muted">No stock-in records found.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL (Redesigned to match Image 5 style) -->
    <div class="modal fade" id="createStockInModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <form method="POST" action="{{ route('stock-in.store') }}">
                    @csrf
                    <div class="modal-header border-0 p-4">
                        <h5 class="fw-bold mb-0">Add Stock In</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Select Stock *</label>
                                <select name="product_id" class="form-select rounded-3 p-3 bg-light border-0" required>
                                    <option value="">Choose a stock item...</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->products_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Select Supplier</label>
                                <select name="supplier_id" class="form-select rounded-3 p-3 bg-light border-0">
                                    <option value="">Choose a supplier...</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Processed By *</label>
                                <select name="employee_id" class="form-select rounded-3 p-3 bg-light border-0" required>
                                    <option value="">Choose employee...</option>
                                    @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Quantity *</label>
                                <div class="input-group bg-light rounded-3 overflow-hidden">
                                    <span class="input-group-text border-0 bg-transparent ps-3"><i class="bi bi-box text-primary"></i></span>
                                    <input type="number" name="quantity" class="form-control border-0 bg-transparent p-3" placeholder="0" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Selling Price (per unit) *</label>
                                <div class="input-group bg-light rounded-3 overflow-hidden">
                                    <span class="input-group-text border-0 bg-transparent ps-3"><i class="bi bi-tag text-success"></i></span>
                                    <input type="number" step="0.01" name="selling_price" class="form-control border-0 bg-transparent p-3" placeholder="0.00" min="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 d-flex gap-3">
                        <button type="submit" class="btn btn-gradient flex-grow-1 p-3">Submit Stock In</button>
                        <button type="button" class="btn btn-light rounded-3 px-4 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>