<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Employee CRUD</h2>
        <a href="{{route('employees.create')}}" class="btn btn-primary" id="addEmployee">Add record</a>
        <table class="table table-bordered" id="employeeTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal for Adding/Editing Employee -->
    <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="employeeForm" method="post" action="{{route('employees.store')}}">
                        @csrf

                        <input type="hidden" id="employeeId">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" required>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" class="form-control" name="salary" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    <div id="errorMessages" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const employeeTable = $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employees.store') }}",
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'mobile' },
                    { data: 'salary' },
                    { data: 'status' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            // Open modal for adding employee
            $('#addEmployee').on('click', function() {
                $('#employeeModal').modal('show');
                $('#employeeForm')[0].reset();
                $('#employeeId').val('');
                $('#modalTitle').text('Add Employee');
                $('#errorMessages').html('');
            });

            // Submit form for add/edit
            $('#employeeForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#employeeId').val();
                const url = id ? `employees/${id}` : 'employees/store'; // Set URL based on ID
                const method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#employeeModal').modal('hide');
                        employeeTable.ajax.reload();
                        alert(response.success);
                    },
                    error: function(xhr) {
                        $('#errorMessages').html('');
                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('#errorMessages').append(`<div class="alert alert-danger">${value}</div>`);
                            });
                        }
                    }
                });
            });

            // Edit employee
            $(document).on('click', '.edit', function() {
                const id = $(this).data('id');
                $.get(`employees/${id}`, function(employee) {
                    $('#employeeId').val(employee.id);
                    $('input[name="name"]').val(employee.name);
                    $('input[name="email"]').val(employee.email);
                    $('input[name="mobile"]').val(employee.mobile);
                    $('input[name="salary"]').val(employee.salary);
                    $('select[name="status"]').val(employee.status);
                    $('#modalTitle').text('Edit Employee');
                    $('#employeeModal').modal('show');
                });
            });
        });
    </script>
</body>
</html>
