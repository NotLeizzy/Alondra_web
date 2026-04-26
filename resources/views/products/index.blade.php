<x-app-layout>

    <x-slot name="header">
        <h5>Products</h5>
    </x-slot>

    <div class="container">

        <!-- CREATE FORM -->
        <div class="card mb-4">
            <div class="card-body">

                <form method="POST" action="{{ route('products.store') }}">
                    @csrf

                    <div class="mb-2">
                        <label>Product Name</label>
                        <input type="text" name="products_name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Unit <Code></Code></label>
                        <input type="text" name="unit_code" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Color</label>
                        <input type="text" name="color" class="form-control" required>

                        <div class="mb-2">
                            <label>Cost Price</label>
                            <input type="number" name="cost_price" class="form-control" step="0.01" required>
                        </div>

                        <button class="btn btn-primary">Add Stock</button>
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
                            <th>Product Name</th>
                            <th>Unit Code</th>
                            <th>Cost Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->products_name }}</td>
                            <td>{{ $product->unit_code }}</td>
                            <td>{{ $product->cost_price }}</td>
                            <td>

                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>

</x-app-layout>