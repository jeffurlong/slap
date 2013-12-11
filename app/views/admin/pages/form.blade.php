@extends('admin.layouts.default')
@section('content')
    <h2>Page</h2>
    <form method="post" action="/admin/pages{{ ( $page->exists) ? '/'.$page->id : ''}}" novalidate>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" required class="form-control " id="title" name="title"
                value="{{ $page->title }}"placeholder="Title">
        </div>
        <div class="form-group">
            <label for="visible">Visibility</label>
            <input type="hidden" name="visible" value="0">
            <input type="checkbox" class="form-control" id="visible" name="visible" value="1"
                @if($page->visible)
                    checked
                @endif
                >
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="15">{{ $page->content }}</textarea>
        </div>
        <input name="id" type="hidden" value="{{ $page->id }}">
        <input name="_method" type="hidden" value="{{ ($page->exists) ? 'PUT' : 'POST' }}">
        <button type="submit">Save Page</button>
    </form>
@stop
