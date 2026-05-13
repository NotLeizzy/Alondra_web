<x-app-layout>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Stocks Management</h3>
            <p class="text-muted">Manage your product catalog</p>
        </div>
        <button class="btn btn-gradient d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createProductModal">
            <i class="bi bi-plus-lg"></i>
            Add Stock
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    @endif

    <div class="card p-0 overflow-hidden shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>STOCK ID</th>
                        <th>STOCK NAME</th>
                        <th>COST PRICE</th>
                        <th class="text-end">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="text-muted">#{{ $product->id }}</td>
                        <td class="fw-bold">{{ $product->products_name }}</td>
                        <td>₱{{ number_format($product->cost_price, 2) }}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-link text-primary p-0 border-0">
                                    <i class="bi bi-pencil fs-5"></i>
                                </button>
                                <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-danger p-0 border-0" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD PRODUCT MODAL -->
    <div class="modal fade" id="createProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Product Name *</label>
                            <input type="text" name="products_name" class="form-control rounded-3 p-3 bg-light border-0" placeholder="Enter product name" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Unit Code</label>
                                <input type="text" name="unit_code" class="form-control rounded-3 p-3 bg-light border-0" placeholder="e.g. PCS">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Color</label>
                                <input type="text" name="color" class="form-control rounded-3 p-3 bg-light border-0" placeholder="e.g. Black">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Cost Price *</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text border-0 bg-transparent ps-3">₱</span>
                                <input type="number" step="0.01" name="cost_price" class="form-control border-0 bg-transparent p-3" placeholder="0.00" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 d-flex gap-3">
                        <button type="submit" class="btn btn-gradient flex-grow-1 p-3">Save Product</button>
                        <button type="button" class="btn btn-light rounded-3 px-4 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>