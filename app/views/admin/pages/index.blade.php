@extends('admin.layouts.default')
@section('content')
    <h2>Pages</h2>
    <a title="New Page" href="/admin/pages/create">New Page</a>
    <table>
        <thead>
            <tr>
                <th>Page</ht>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
            <tr>
                <td>
                    <div>
                        <a href="/admin/pages/{{ $page->id }}/edit">
                            {{ $page->title }}
                        </a>
                    </div>
                    <div>{{ $page->meta_description }}</div>
                </td>
                <td>{{ $page->updated_at->toFormattedDateString() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
