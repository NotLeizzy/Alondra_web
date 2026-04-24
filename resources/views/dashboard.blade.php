<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold">
            Dashboard
        </h2>
    </x-slot>

    <div class="d-flex min-vh-100">

        <!-- LEFT NAVBAR -->
        <aside class="border-end" style="width: 240px;">
            <div class="p-3">

                <h6 class="mb-3">Navigation</h6>

                <a href="{{ route('dashboard') }}" class="d-block mb-2">
                    Dashboard
                </a>

                <a href="{{ route('stock-in.index') }}" class="d-block mb-2">
                    Stock In
                </a>

                <a href="{{ route('stocks.index') }}" class="d-block mb-2">
                    Stocks
                </a>

                <a href="{{ route('employees.index') }}" class="d-block mb-2">
                    Employees
                </a>

                <a href="{{ route('suppliers.index') }}" class="d-block mb-2">
                    Suppliers
                </a>

            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="flex-grow-1 p-4">

            <div class="border p-4">
                You're logged in!
            </div>

        </div>

    </div>

</x-app-layout>