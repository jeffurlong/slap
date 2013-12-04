@extends('tenant.layouts.default')

@section('meta_title')
    {{ Session::get('tenant.name') }} Signup
@stop

@section('meta_description')
    {{ Session::get('tenant.name') }}  Signup
@stop

@section('content')
    <form method="post" novalidate>
        {{ Form::token() }}
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" required>
        <label for="email">Email Addres</label>
        <input required type="email" id="email" name="email">
        <label for="phone">Phone #</label>
        <input type="tel" id="phone" name="phone" required>
        <label for="password">Enter a New Password</label>
        <input type="password" id="password" name="password" required>
        <label for="password_confirmation">Confirm Your Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="/account/login">Log In</a></p>
@stop
