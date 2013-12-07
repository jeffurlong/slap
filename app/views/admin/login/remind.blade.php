@extends('admin.layouts.login')

@section('content')
    <form method="post" novalidate>
        {{ Form::token() }}
        <label for="email">Email Address</label>
        <input required type="email" id="email" name="email" value="{{ Input::old('email') }}">
        <button type="submit">Send Email</button>
    </form>
@stop
