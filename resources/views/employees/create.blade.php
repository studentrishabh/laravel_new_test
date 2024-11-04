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
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Crud Laravel</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('employees.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-3">
                    <form  action="{{ route('employees.store') }}" method="post">
                        @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label h5">Name</label>
                                <input value="{{old('name')}}" type="text" class=" @error('name') is-invalid @enderror form-control form-control-sm" name="name" id=""
                                    aria-describedby="helpId" placeholder="name" />
                                    @error('name')
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label h5">Email</label>
                                <input value="{{old('email')}}" type="text" class="  @error('email') is-invalid @enderror form-control form-control-sm" name="email" id="email"
                                    aria-describedby="helpId" placeholder="email" />
                                    @error('email')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label h5">Mobile</label>
                                <input value="{{old('mobile')}}" type="phone" class=" @error('mobile') is-invalid @enderror form-control form-control-sm" name="mobile" id=""
                                    aria-describedby="helpId" placeholder="mobile" />
                                    @error('mobile')
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label h5">Salary</label>
                                <input value="{{old('salary')}}" type="number" class=" @error('salary') is-invalid @enderror form-control form-control-sm" name="salary" id=""
                                    aria-describedby="helpId" placeholder="salary" />
                                    @error('salary')
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label h5">Status</label>
                            <select name="is_active" id="is_active" 
                                    class="form-select form-control-sm @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('is_active') == 'active' ? 'selected' : '' }}>Select</option>
                                <option value="active" {{ old('is_active') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('is_active') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-gird">
                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
