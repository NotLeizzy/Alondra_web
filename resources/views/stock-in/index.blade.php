<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold mb-0">
            Stock In
        </h2>
    </x-slot>

    <div class="container-fluid">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">

            <!-- HEADER -->
            <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="fw-bold mb-1">Stock In Management</h4>
                    <small class="text-muted">Manage incoming inventory</small>
                </div>

                <button class="btn btn-primary rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#createStockInModal">
                    + Add Stock In
                </button>

            </div>

            <!-- SEARCH -->
            <div class="px-4 pb-4">

                <form method="GET" action="{{ route('stock-in.index') }}">
                    <div class="d-flex gap-2">

                        <input
                            type="text"
                            name="search"
                            class="form-control rounded-pill"
                            placeholder="Search stock in (product or employee)..."
                            value="{{ request('search') }}">

                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Search
                        </button>

                    </div>
                </form>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Employee</th>
                            <th>Quantity</th>
                            <th>Selling Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($stockins as $item)

                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->products_name }}</td>
                            <td>{{ optional($item->supplier)->supplier_name ?? 'N/A' }}</td>
                            <td>{{ $item->employee->full_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->selling_price }}</td>

                            <td>
                                <form method="POST" action="{{ route('stock-in.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center p-4">
                                No records found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- MODAL -->
    <div class="modal fade" id="createStockInModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-4">

                <form method="POST" action="{{ route('stock-in.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5>Add Stock In</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <select name="product_id" class="form-control mb-3">
                            <option>Select Product</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->products_name }}
                            </option>
                            @endforeach
                        </select>

                        <select name="supplier_id" class="form-control mb-3">
                            <option value="">Supplier (optional)</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->supplier_name }}
                            </option>
                            @endforeach
                        </select>

                        <select name="employee_id" class="form-control mb-3">
                            <option>Select Employee</option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->full_name }}
                            </option>
                            @endforeach
                        </select>

                        <input name="quantity" class="form-control mb-3" placeholder="Quantity">
                        <input name="selling_price" class="form-control" placeholder="Selling Price">

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>