<x-app-layout>

    <x-slot name="header">
        <h5>Stock In</h5>
    </x-slot>

    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <div class="card mb-4">
            <div class="card-body">

                <form method="POST" action="{{ route('stock-in.store') }}">
                    @csrf

                    <!-- PRODUCT -->
                    <div class="mb-2">
                        <label>Product</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->products_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- SUPPLIER -->
                    <div class="mb-2">
                        <label>Supplier (optional)</label>
                        <select name="supplier_id" class="form-control">
                            <option value="">None</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- EMPLOYEE -->
                    <div class="mb-2">
                        <label>Employee (optional)</label>
                        <select name="employee_id" class="form-control">
                            <option value="">None</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->employee_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- QUANTITY -->
                    <div class="mb-2">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>

                    <!-- SELLING PRICE -->
                    <div class="mb-2">
                        <label>Selling Price</label>
                        <input type="number" step="0.01" name="selling_price" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">
                        Add Stock In
                    </button>

                </form>

            </div>
        </div>

        <!-- TABLE -->
        <div class="card">
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Employee</th>
                            <th>Quantity</th>
                            <th>Selling Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($stockins as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->product->products_name }}</td>
                                <td>{{ optional($item->supplier)->supplier_name ?? 'N/A' }}</td>
                                <td>{{ optional($item->employee)->employee_name ?? 'N/A' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->selling_price }}</td>

                                <td>
                                    <form method="POST" action="{{ route('stock-in.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </div>

</x-app-layout>