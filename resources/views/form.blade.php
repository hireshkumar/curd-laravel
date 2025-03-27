<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Register Form</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary mb-3" href="{{ route('records') }}">Back</a>

                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Student Name --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Student Name:</strong></label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Student Name">
                                        @error('name') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Student Email --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Student Email:</strong></label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Student Email">
                                        @error('email') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Student Password --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Password:</strong></label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        @error('password') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Student Number --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Student Number:</strong></label>
                                        <input type="tel" name="number" value="{{ old('number') }}" class="form-control" placeholder="Student Number">
                                        @error('number') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                       @enderror
                                    </div>
                                </div>

                                {{-- Student Gender --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Student Gender:</strong></label><br>
                                        <input type="radio" value="M" id="male" name="gender" {{ old('gender') == 'M' ? 'checked' : '' }}>
                                        <label for="male">Male</label>

                                        <input type="radio" value="F" id="female" name="gender" {{ old('gender') == 'F' ? 'checked' : '' }}>
                                        <label for="female">Female</label>

                                        <input type="radio" value="Other" id="other" name="gender" {{ old('gender') == 'Other' ? 'checked' : '' }}>
                                        <label for="other">Other</label>

                                        @error('gender') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- State Selection --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>State:</strong></label>
                                        <select name="state_id" id="state" class="form-control">
                                            <option value="">Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- City Selection (Dependent on State) --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>City:</strong></label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="">Select City</option>
                                        </select>
                                        @error('city') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div> 
                                        @enderror
                                    </div>
                                </div>

                                {{-- Student Profile Photo --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Profile Photo:</strong></label>
                                        <input type="file" id="profile_photo" name="profile_photo" class="form-control" accept="image/*">
                                        @error('profile_photo') 
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Submit Button --}}
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery AJAX Script for Dynamic City Selection --}}
    <script>
        $(document).ready(function () {
            $('#state').on('change', function () {                
                var state_id = this.value;                
                $('#city').html('<option value="">Select City</option>'); 

                if (state_id) {
                    $.get("/get-cities/" + state_id, function(data) {
                        $.each(data, function (key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>
