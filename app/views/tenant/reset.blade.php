@extends('tenant.layouts.default')

@section('content')
    <h1>Reset Your Password</h1>

    <form method="post" novalidate>
        {{ Form::token() }}
        <input type="hidden" name="token" value="{{ $token }}">

        <label for="email">Your Email Address</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Enter a New Password</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirm Your Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>


        <button type="submit">Reset Password and Sign In</button>
    </form>
@stop
