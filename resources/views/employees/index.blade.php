<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>laravel crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Crud Laravel</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('employees.create') }}" class="btn btn-dark">Create</a>
            </div>
            <div class="row d-flex justify-content-center">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-3">
                        <div class="card-body">
                            <table id="users-table" class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('employees.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'salary', name: 'salary' },
                    { data: 'is_active', render: function(data) {
                        return data ? 'Active' : 'Inactive';
                    }},
                    { data: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
</body> 
</html>

    
    <script>
        $(document).on('click', '.btn-danger', function() {
    const emp_id = $(this).data('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const button = this;

    if (confirm('Are you sure you want to delete this record?')) {
        $.ajax({
            url: '/employees/' + emp_id,
            type: 'DELETE',
            data: {
                _token: csrfToken,  // CSRF token
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $(button).closest('tr').remove(); 
                } else {
                    alert('Error: ' + response.message);
                }
            },
          
        });
    }
});

    </script>



