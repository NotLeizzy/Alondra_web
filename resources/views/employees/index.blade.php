<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold mb-0">
            Employees
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
                    <h4 class="fw-bold mb-1">Employee Management</h4>
                    <small class="text-muted">Manage staff records</small>
                </div>

                <button class="btn btn-primary rounded-pill px-4"
                        data-bs-toggle="modal"
                        data-bs-target="#employeeModal">
                    + Add Employee
                </button>

            </div>

            {{-- SEARCH --}}
            <div class="px-4 pb-4">

                <form method="GET" action="{{ route('employees.index') }}">
                    <div class="input-group">

                        <input type="text"
                               name="search"
                               class="form-control rounded-pill"
                               placeholder="Search employees..."
                               value="{{ request('search') }}">

                        <button type="submit" class="btn btn-primary rounded-pill ms-2 px-4">
                            Search
                        </button>

                    </div>
                </form>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Middle</th>
                            <th>Last Name</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($employees as $employee)

                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->middle_name ?? '-' }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->contact_number ?? '-' }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $employee->role }}
                                </span>
                            </td>

                            <td>

                                {{-- EDIT BUTTON --}}
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary"
                                        data-employee='@json($employee)'
                                        onclick="fillEmployeeEdit(this)">
                                    Edit
                                </button>

                                {{-- DELETE --}}
                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete employee?')">
                                        Delete
                                    </button>

                                </form>

                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center p-4">
                                No employees found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>

    {{-- ADD EMPLOYEE MODAL --}}
    <div class="modal fade" id="employeeModal">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">

                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5>Add Employee</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input name="first_name" class="form-control mb-3" placeholder="First Name">
                        <input name="middle_name" class="form-control mb-3" placeholder="Middle Name">
                        <input name="last_name" class="form-control mb-3" placeholder="Last Name">
                        <input name="contact_number" class="form-control mb-3" placeholder="Contact Number">
                        <input name="role" class="form-control" placeholder="Role">

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-primary">
                            Save
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- EDIT EMPLOYEE MODAL --}}
    <div class="modal fade" id="editEmployeeModal">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">

                <form method="POST" id="editEmployeeForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5>Edit Employee</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input name="first_name" id="edit_first_name" class="form-control mb-3">
                        <input name="middle_name" id="edit_middle_name" class="form-control mb-3">
                        <input name="last_name" id="edit_last_name" class="form-control mb-3">
                        <input name="contact_number" id="edit_contact_number" class="form-control mb-3">
                        <input name="role" id="edit_role" class="form-control">

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-primary">
                            Update
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        function fillEmployeeEdit(button) {

            const employee = JSON.parse(button.getAttribute('data-employee'));

            document.getElementById('editEmployeeForm').action =
                '/employees/' + employee.id;

            document.getElementById('edit_first_name').value = employee.first_name;
            document.getElementById('edit_middle_name').value = employee.middle_name ?? '';
            document.getElementById('edit_last_name').value = employee.last_name;
            document.getElementById('edit_contact_number').value = employee.contact_number ?? '';
            document.getElementById('edit_role').value = employee.role;

            new bootstrap.Modal(document.getElementById('editEmployeeModal')).show();
        }
    </script>

</x-app-layout>