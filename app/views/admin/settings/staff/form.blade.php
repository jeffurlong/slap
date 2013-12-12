@extends('admin.layouts.default')
@section('content')
    <h2>New Staff Member</h2>
    <form method="post" novalidate>
        {{ Form::token() }}
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" required class="form-control" id="first_name" name="first_name"
                placeholder="First Name" >
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" required class="form-control" id="last_name" name="last_name"
                placeholder="Last Name" >
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" required class="form-control" id="email" name="email"
                placeholder="Email Address" >
        </div>

        <button type="submit">Save New Staff Member </button>
    </form>
@stop
