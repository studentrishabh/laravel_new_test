<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>laravel crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Crud Laravel</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{route('employees.create')}}" class="btn btn-dark">Create</a>
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
                        <table class="table">
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Salary</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                          
                            @foreach ($employees as $data_emp)
                            <tr>
                                <td>{{ $data_emp->id }}</td>
                                <td>{{ $data_emp->name }}</td>
                                <td>{{ $data_emp->email }}</td>
                                <td>{{ $data_emp->mobile }}</td>
                                <td>{{ $data_emp->salary }}</td>
                                <td>{{ $data_emp->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $data_emp->id) }}" class="btn btn-dark">Edit</a>
                                    <a href="{{ route('employees.view', $data_emp->id) }}" class="btn btn-primary">view</a>
                                    <button type="button" class="btn btn-danger delete_emp" data-id="{{ $data_emp->id }}">Delete</button>
                                    <form id="delete-employee-{{ $data_emp->id }}" action="{{ route('employees.destroy', $data_emp->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>                                    
                                    
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>



<script>
$(document).on('click', '.delete_emp', function (e) {
    e.preventDefault();
    var emp_id = $(this).data('id'); 
    
    if (confirm('Are you sure you want to delete this employee?')) {
        $.ajax({
            url: '/employees/${emp_id}', 
            type: 'DELETE',
            data: {
                
            },
            success: function (response) {
                alert(response.message); 
                location.reload(); 
            },
         
        });
    }
});
</script>

