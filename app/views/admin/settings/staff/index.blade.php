@extends('admin.layouts.default')
@section('content')
    <h2>Staff Members</h2>
    <a title="New Staff Member" href="/admin/settings/staff/create">New Staff Member</a>
    <table>
       <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->first_name.' '.$admin->last_name }}</td>
                <td>{{ $admin->email }}</td>
                <td><a href="/admin/settings/staff/{{ $admin->id }}/delete">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
