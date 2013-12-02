@extends('tenant.layouts.default')

@section('meta_title')
    {{ $page->meta_title }}
@stop

@section('meta_description')
    {{ $page->meta_description }}
@stop

@section('content')
    <h1>{{ $page->title }}</h1>
    <p>{{ $page->content }}</p>
@stop
