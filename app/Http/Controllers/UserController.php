<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function index()
{
    $user = Student::find(session('uid'));
    return view('user.dashboard', compact('user'));
}

public function profile()
{
    $user = Student::find(session('uid'));
    return view('user.profile', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Student::find(session('uid'));
    $user->update($request->only('name', 'email', 'phone', 'address'));
    return back()->with('success', 'Profile updated!');
}

public function orders()
{
    
}


   














}