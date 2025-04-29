<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student - Laravel 9 CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2 style="text-align:center;">Student Login</h2>
                </div>
                
            </div>
        </div>

        @if(session('status'))
            <div class="alert alert-success mt-2">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ url('variable_data') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Name Field -->
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>email:</strong>
                        <input type="text" name="email" class="form-control" placeholder="Enter Email">
                        @error('email') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                        @error('password') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-12" style="text-align:center;">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

                
        </form>
    </div>
   
</body>
</html>
