<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold mb-0">
            Suppliers
        </h2>
    </x-slot>

    <div class="container-fluid">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">

            {{-- HEADER --}}
            <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="fw-bold mb-1">Supplier Management</h4>
                    <small class="text-muted">Manage supplier records</small>
                </div>

                <button class="btn btn-primary rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#supplierModal">
                    + Add Supplier
                </button>

            </div>

            {{-- SEARCH --}}
            <div class="px-4 pb-3">

                <form method="GET" action="{{ route('suppliers.index') }}">
                    <div class="d-flex gap-2">

                        <input type="text"
                            name="search"
                            class="form-control rounded-pill"
                            placeholder="Search supplier..."
                            value="{{ request('search') }}">

                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Search
                        </button>

                    </div>
                </form>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="table align-middle mb-0 table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Supplier Name</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($suppliers as $supplier)

                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->supplier_name }}</td>
                            <td>{{ $supplier->contact_number ?? '-' }}</td>
                            <td>{{ $supplier->address ?? '-' }}</td>

                            <td class="text-center">

                                {{-- EDIT (simple route-based approach) --}}
                                <button type="button"
                                    class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editSupplierModal"
                                    onclick="fillEditModal({{ $supplier }})">
                                    Edit
                                </button>

                                {{-- DELETE --}}
                                <form method="POST"
                                    action="{{ route('suppliers.destroy', $supplier->id) }}"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this supplier?')">
                                        Delete
                                    </button>

                                </form>

                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center p-4">
                                No suppliers found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>

    {{-- ADD MODAL --}}
    <div class="modal fade" id="supplierModal">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">

                <form method="POST" action="{{ route('suppliers.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Add Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="text"
                            name="supplier_name"
                            class="form-control mb-3"
                            placeholder="Supplier Name"
                            required>

                        <input type="text"
                            name="contact_number"
                            class="form-control mb-3"
                            placeholder="Contact Number">

                        <input type="text"
                            name="address"
                            class="form-control"
                            placeholder="Address">

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="btn btn-primary">
                            Save
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editSupplierModal">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">

                <form method="POST" id="editSupplierForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="text"
                            name="supplier_name"
                            id="edit_supplier_name"
                            class="form-control mb-3"
                            required>

                        <input type="text"
                            name="contact_number"
                            id="edit_contact_number"
                            class="form-control mb-3">

                        <input type="text"
                            name="address"
                            id="edit_address"
                            class="form-control">

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="btn btn-primary">
                            Update
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        function fillEditModal(supplier) {
            document.getElementById('edit_supplier_name').value = supplier.supplier_name;
            document.getElementById('edit_contact_number').value = supplier.contact_number || '';
            document.getElementById('edit_address').value = supplier.address || '';
            document.getElementById('editSupplierForm').action = `/suppliers/${supplier.id}`;
        }
    </script>


</x-app-layout>