<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

    <h1>Welcome to {{ Session::get('tenant.name') }}!</h1>
    <h2>Your account has been created. Below is your account information.</h2>
    <p>Your account login page:
        <a href="{{ Request::server('SERVER_NAME') }}/account/login">
            {{ Request::server('SERVER_NAME') }}/account/login
        </a>
    </p>
    <p>Your email address: {{$email}}</p>
    <p>Your password: ******** (<a href="{{ Request::server('SERVER_NAME') }}/account/forgot">Forgot it?</a>)</p>
    <p>
        Thanks,<br />
        {{ Session::get('tenant.name') }}
    </p>
 </body>
</html>
