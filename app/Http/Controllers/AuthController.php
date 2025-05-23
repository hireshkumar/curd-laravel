<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Cart;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $student = Student::where('email', $request->email)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            
            $request->session()->put('uid', $student->id);

           
            if ($request->session()->has('redirect_after_login_product_id')) {
                $productId = $request->session()->pull('redirect_after_login_product_id');

               
                Cart::firstOrCreate([
                    'user_id' => $student->id,
                    'product_id' => $productId,
                ], [
                    'quantity' => 1,
                ]);

                return redirect()->route('cart.page')->with('success', 'Product added to cart!');
            }

            return redirect()->route('home')->with('success', 'Login successful!');
        }
        return redirect()->route('login')->with('error', 'Invalid Username or Password');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('uid');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function showForgetPassword()
    {
        return view('auth.forgetpassword');
    }

    public function submitForgetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Password reset link sent to your email.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPassword($token)
{
    return view('auth.resetpassword', ['token' => $token]);
}

public function submitResetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
        'token' => 'required'
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {  
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', 'Password reset successful!')
        : back()->withErrors(['email' => __($status)]);
}


}
    







