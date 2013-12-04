@extends('tenant.layouts.default')

@section('meta_title')
    {{ Session::get('tenant.name') }} Forgot Password
@stop

@section('meta_description')
    {{ Session::get('tenant.name') }}  Forgot Password
@stop

@section('content')
    <form method="post" novalidate>
        {{ Form::token() }}
        <label for="email">Email Addres</label>
        <input required type="email" id="email" name="email" value="{{ Input::old('email') }}">
        <button type="submit">Send Email</button>
    </form>
    <p>Don't have an account? <a href="/account/signup">Sign Up</a></p>
@stop
