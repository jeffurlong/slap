<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

    <h1>Welcome to {{ $tenant }}!</h1>
    <h2>Your account has been created. Below is your account information.</h2>
    <p>Your account login page:
        <a href="{{ $login }}">
            {{ $login }}
        </a>
    </p>
    <p>Your email address: {{ $email }}</p>
    <p>Your password: ******** (<a href="{{ forgot }}">Forgot it?</a>)</p>
    <p>
        Thanks,<br />
        {{ $tenant }}
    </p>
 </body>
</html>
