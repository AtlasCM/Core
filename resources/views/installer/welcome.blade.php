@extends('atlas.installer::layouts.master')

@section('header')
    <header class="text/center">
        <h1 class="text/title">Welcome to</h1>
        <i class="icn --logo_full --white --title"></i>
    </header>
@stop

@section('content')
    <section class="text/center">
        <a class="get-started h3 +click-area --before" href="{{ route('atlas.installer::' . $route) }}">Get Started <i class="icn --angle-right"></i></a>
    </section>
@stop
