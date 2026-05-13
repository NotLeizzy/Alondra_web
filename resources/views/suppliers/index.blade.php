<x-app-layout>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Suppliers Management</h3>
            <p class="text-muted">Manage your supplier information</p>
        </div>
        <button class="btn btn-gradient d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#supplierModal">
            <i class="bi bi-plus-lg"></i>
            Add Supplier
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
                        <th>SUPPLIER ID</th>
                        <th>SUPPLIER NAME</th>
                        <th>CONTACT</th>
                        <th>ADDRESS</th>
                        <th class="text-end">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td class="text-muted">#{{ $supplier->id }}</td>
                        <td class="fw-bold">{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->contact_number ?? '-' }}</td>
                        <td class="text-muted small" style="max-width: 250px;">{{ $supplier->address ?? '-' }}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-link text-primary p-0 border-0" data-bs-toggle="modal" data-bs-target="#editSupplierModal" onclick="fillEditModal({{ $supplier }})">
                                    <i class="bi bi-pencil fs-5"></i>
                                </button>
                                <form method="POST" action="{{ route('suppliers.destroy', $supplier->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-danger p-0 border-0" onclick="return confirm('Delete this supplier?')">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No suppliers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="supplierModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <form method="POST" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">Add Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Company Name *</label>
                            <input type="text" name="supplier_name" class="form-control rounded-3 p-3 bg-light border-0" placeholder="Enter company name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control rounded-3 p-3 bg-light border-0" placeholder="+63 000 000 0000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Address</label>
                            <textarea name="address" class="form-control rounded-3 p-3 bg-light border-0" placeholder="Enter full address" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 d-flex gap-3">
                        <button type="submit" class="btn btn-gradient flex-grow-1 p-3">Save Supplier</button>
                        <button type="button" class="btn btn-light rounded-3 px-4 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editSupplierModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <form method="POST" id="editSupplierForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">Edit Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Company Name *</label>
                            <input type="text" name="supplier_name" id="edit_supplier_name" class="form-control rounded-3 p-3 bg-light border-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" name="contact_number" id="edit_contact_number" class="form-control rounded-3 p-3 bg-light border-0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Address</label>
                            <textarea name="address" id="edit_address" class="form-control rounded-3 p-3 bg-light border-0" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 d-flex gap-3">
                        <button type="submit" class="btn btn-gradient flex-grow-1 p-3">Update Supplier</button>
                        <button type="button" class="btn btn-light rounded-3 px-4 py-3" data-bs-dismiss="modal">Cancel</button>
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