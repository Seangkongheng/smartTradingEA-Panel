@extends('apifrontend::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('apifrontend.name') !!}</p>
@endsection
