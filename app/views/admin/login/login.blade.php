@extends('admin.layouts.login')

@section('content')

    <form method="post" novalidate>

        {{ Form::token() }}

        <label for="email">Email Address</label>
        <input required type="email" id="email" name="email" value="{{ Input::old('email') }}">

        <label for="password">Password</label>
        <input required type="password" id="password" name="password">

        <button type="submit">Log In</button>

    </form>

    <p><a href="/admin/login/remind">Forgot your password?</a></p>

@stop
