@component('mail::message')
    <h1>Forget Password Email</h1>

    You can reset password from bellow link:
    <a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
    Thanks,<br>
USOF backend Team,<br>
@endcomponent
