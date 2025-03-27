<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Reset Password</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label>New Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
