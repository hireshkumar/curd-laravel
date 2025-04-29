@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h2>Hello, {{ $user->name }}!</h2>
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('user.profile') }}">My Profile</a></li>
                <li class="list-group-item"><a href="{{ route('cart.page') }}">Cart</a></li>
                <li class="list-group-item"><a href="{{ route('logout') }}">Logout</a></li>
                <li class="list-group-item"><a href="">My Orders</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <p></p>
        </div>
    </div>
</div>
@endsection
