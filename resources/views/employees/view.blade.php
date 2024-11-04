<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>laravel crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('employees.index')}}" class="btn btn-dark">Back</a>

        </div>
    </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white text-center">view</h3>
                    </div>
                    <form action="{{ route('employees.view', $employee->id) }}" method="get">
                        @csrf
                        @method('get')                       
                    
                        <div class="card-body">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label h5">Name</label>
                                <input value="{{ old('name', $employee->name) }}" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" />
                              
                            </div>
                    
                            <div class="mb-3">
                                <label for="email" class="form-label h5">Email</label>
                                <input value="{{ old('email', $employee->email) }}" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="helpId" placeholder="email" />
                               
                            </div>
                    
                            
                            <div class="mb-3">
                                <label for="mobile" class="form-label h5">Mobile</label>
                                <input value="{{ old('mobile', $employee->mobile) }}" type="text" class="form-control form-control-sm @error('mobile') is-invalid @enderror" name="mobile" id="mobile" aria-describedby="helpId" placeholder="mobile" />
                               
                            </div>
                    
                         
                            <div class="mb-3">
                                <label for="salary" class="form-label h5">Salary</label>
                                <input value="{{ old('salary', $employee->salary) }}" type="number" class="form-control form-control-sm @error('salary') is-invalid @enderror" name="salary" id="salary" aria-describedby="helpId" placeholder="salary" />
                             
                            </div>
                
                            <div class="mb-3">
                                <label for="is_active" class="form-label h5">Status</label>
                                <select name="is_active" id="is_active" class="form-control form-control-sm @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ $employee->is_active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $employee->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                              
                            </div>
                    
                        </div>
                    </form>
                                      
                </div>
            </div>
        </div>
    </div>
</body>
</html>
