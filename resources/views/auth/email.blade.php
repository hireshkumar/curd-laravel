<h1>Password Reset Request</h1>
<p>You recently requested to reset your password. Click the link below to reset it:</p>
<p>

    <a href="{{ route('password.reset', ['token' => $token]) }}">Reset Password</a>
       style="background-color:#007bff; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;">
       Reset Password
    </a>
</p>
<p>If you did not request this, please ignore this email.</p>
