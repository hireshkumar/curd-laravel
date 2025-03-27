<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Student Form - Laravel 9 CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2> Edit Register Form </h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('records') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{url('update_data',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf 
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Name:</strong>
                        <input type="text" name="name" value="{{old('name',$data->name)}}" class="form-control" placeholder="Student Name">
                        @error('name') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Email:</strong>
                        <input type="email" name="email" value="{{old('email',$data->email)}}" class="form-control" placeholder="Student Email">
                        @error('email') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Password:</strong>
                        <input type="password" name="password" value="{{old('password',$data->password)}}" class="form-control" placeholder="Student password">
                        @error('password') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Number:</strong>
                        <input type="tel" name="number" value="{{old('number',$data->number)}}" class="form-control" placeholder="Student number">
                        @error('number') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Gender:</strong><br>
                        <input type="radio" <?php if($data->gender == "male"){ ?>checked="checked"<?php } ?> value="M" id="M" name="gender">
                        <label for="male">Male</label><br>
                        <input type="radio" <?php if($data->gender == "female"){ ?>checked="checked"<?php } ?> value="M" id="F" name="gender">
                        <label for="female">Female</label><br>
                        <input type="radio" <?php if($data->gender == "other"){ ?>checked="checked"<?php } ?> value="other" id="other" name="gender">
                        <label for="other">Other</label><br><br>
                        @error('gender') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student City:</strong>
                        <input type="text" name="city" value="{{old('city',$data->city)}}" class="form-control" placeholder="Student city">
                        @error('city') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student State:</strong>
                        <input type="text" name="state_id" value="{{old('state_id',$data->state_id)}}" class="form-control" placeholder="Student state">
                        @error('state') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Profile_photo:</strong>
                        <input type="file" id="profile_photo" name="profile_photo" value="{{old('profile_photo',$data->profile_photo)}}" accept="image/*"><br><br>
                        @error('address') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>
