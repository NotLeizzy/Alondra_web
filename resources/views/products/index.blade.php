<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold mb-0">
            Products
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
                    <h4 class="fw-bold mb-1">Product Management</h4>
                    <small class="text-muted">Manage product inventory</small>
                </div>

                <button class="btn btn-primary rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#createProductModal">
                    + Add Product
                </button>

            </div>

            <!-- SEARCH -->
            <div class="px-4 pb-4">

                <form method="GET" action="{{ route('products.index') }}">
                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            class="form-control rounded-pill"
                            placeholder="Search products..."
                            value="{{ request('search') }}">

                        <button type="submit" class="btn btn-primary rounded-pill ms-2 px-4">
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
                            <th>Product Name</th>
                            <th>Unit Code</th>
                            <th>Color</th>
                            <th>Cost Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($products as $product)

                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->products_name }}</td>
                            <td>{{ $product->unit_code }}</td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->cost_price }}</td>

                            <td>
                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
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
                            <td colspan="6" class="text-center p-4">
                                No products found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- MODAL -->
    <div class="modal fade" id="createProductModal">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">

                <form method="POST" action="{{ route('products.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5>Add Product</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input name="products_name" class="form-control mb-3" placeholder="Product Name">
                        <input name="unit_code" class="form-control mb-3" placeholder="Unit Code">
                        <input name="color" class="form-control mb-3" placeholder="Color">
                        <input name="cost_price" class="form-control" placeholder="Cost Price">

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