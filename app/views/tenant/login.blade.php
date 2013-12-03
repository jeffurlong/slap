@extends('tenant.layouts.default')

@section('meta_title')
    {{ Session::get('tenant.name') }} Login
@stop

@section('meta_description')
    {{ Session::get('tenant.name') }}  Login
@stop

@section('content')
    
    <form method="post" novalidate>

        {{ Form::token() }}
    
        <label for="email">Email Addres</label>
        <input required type="email" id="email" name="email" value="{{ Input::old('email') }}">

        <label for="password">Password</label>
        <input required type="password" id="password" name="password">
            
        <button type="submit">Log In</button>
    
    </form>

    <p><a href="/account/forgot">Forgot your password?</a></p>

    <p>Don't have an account? <a href="/account/signup">Sign Up</a></p>

@stop
