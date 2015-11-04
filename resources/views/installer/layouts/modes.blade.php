@extends('atlas.installer::layouts.page')

@section('heading')
    @yield('heading.' . Session::get('atlas.installer::mode'))
@stop

@section('content')
    @yield(Session::get('atlas.installer::mode'))
@stop
