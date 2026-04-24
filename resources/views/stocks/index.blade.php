<x-app-layout>

    <x-slot name="header">
        <h5>Stocks</h5>
    </x-slot>

    <div class="container">

        <!-- CREATE FORM -->
        <div class="card mb-4">
            <div class="card-body">

                <form method="POST" action="{{ route('stocks.store') }}">
                    @csrf

                    <div class="mb-2">
                        <label>Stock Name</label>
                        <input type="text" name="stocks_name" class="form-control" required>
                    </div>

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
                            <th>Stock Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($stocks as $stock)
                        <tr>
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->stocks_name }}</td>
                            <td>{{ $stock->cost_price }}</td>
                            <td>

                                <form method="POST" action="{{ route('stocks.destroy', $stock->id) }}">
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