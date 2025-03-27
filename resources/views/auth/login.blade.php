<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login Page</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <div class="forget-password">
                        <a href="{{ route('auth.forgetpassword') }}">forgot password</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
