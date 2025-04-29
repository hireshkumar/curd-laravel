@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="d-flex align-items-center mb-4">
            <h2 class="mr-3"></h2>
            <div>
                           <!-- yaha per user ki image show kar rhe hai  -->
                @if(!empty($user->profile_photo))
                    <img src="{{ asset('images/' . $user->profile_photo) }}" class="rounded-circle"
                         width="60" height="60" alt="Profile Photo">
                @else
                    <img src="{{ asset('images/dummy-user.png') }}" class="rounded-circle"
                         width="60" height="60" alt="Default Profile Photo">
                @endif
            </div>
            <p class="lead">Hello,
             </br>  
            {{ $user->name }}</p>
        </div>

        </br>
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">Number</label>
                <input type="tel" class="form-control" id="number" name="number" value="{{ $user->number }}">
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Save Profile</button>
        </form>
    </div>
</div>
@endsection