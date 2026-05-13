<x-app-layout>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Employee Management</h3>
            <p class="text-muted">Manage staff records and roles</p>
        </div>
        <button class="btn btn-gradient d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#employeeModal">
            <i class="bi bi-plus-lg"></i>
            Add Employee
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
                        <th>EMPLOYEE ID</th>
                        <th>FULL NAME</th>
                        <th>CONTACT</th>
                        <th>ROLE</th>
                        <th class="text-end">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td class="text-muted">#{{ $employee->id }}</td>
                        <td class="fw-bold">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->contact_number ?? '-' }}</td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary border-0 rounded-pill px-3">{{ $employee->role }}</span></td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-link text-primary p-0 border-0" data-employee='@json($employee)' onclick="fillEmployeeEdit(this)">
                                    <i class="bi bi-pencil fs-5"></i>
                                </button>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-danger p-0 border-0" onclick="return confirm('Delete employee?')">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No employees found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="employeeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">First Name *</label>
                                <input type="text" name="first_name" class="form-control rounded-3 p-3 bg-light border-0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Last Name *</label>
                                <input type="text" name="last_name" class="form-control rounded-3 p-3 bg-light border-0" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control rounded-3 p-3 bg-light border-0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control rounded-3 p-3 bg-light border-0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Role *</label>
                            <input type="text" name="role" class="form-control rounded-3 p-3 bg-light border-0" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 d-flex gap-3">
                        <button type="submit" class="btn btn-gradient flex-grow-1 p-3">Save Employee</button>
                        <button type="button" class="btn btn-light rounded-3 px-4 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <form method="POST" id="editEmployeeForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">First Name *</label>
                                <input type="text" name="first_name" id="edit_first_name" class="form-control rounded-3 p-3 bg-light border-0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Last Name *</label>
                                <input type="text" name="last_name" id="edit_last_name" class="form-control rounded-3 p-3 bg-light border-0" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Middle Name</label>
                            <input type="text" name="middle_name" id="edit_middle_name" class="form-control rounded-3 p-3 bg-light border-0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" name="contact_number" id="edit_contact_number" class="form-control rounded-3 p-3 bg-light border-0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Role *</label>
                            <input type="text" name="role" id="edit_role" class="form-control rounded-3 p-3 bg-light border-0" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 d-flex gap-3">
                        <button type="submit" class="btn btn-gradient flex-grow-1 p-3">Update Employee</button>
                        <button type="button" class="btn btn-light rounded-3 px-4 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function fillEmployeeEdit(button) {
            const employee = JSON.parse(button.getAttribute('data-employee'));
            document.getElementById('editEmployeeForm').action = '/employees/' + employee.id;
            document.getElementById('edit_first_name').value = employee.first_name;
            document.getElementById('edit_middle_name').value = employee.middle_name ?? '';
            document.getElementById('edit_last_name').value = employee.last_name;
            document.getElementById('edit_contact_number').value = employee.contact_number ?? '';
            document.getElementById('edit_role').value = employee.role;
            new bootstrap.Modal(document.getElementById('editEmployeeModal')).show();
        }
    </script>

</x-app-layout>