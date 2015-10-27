@extends('atlas.installer::layouts.master')

@section('header')
    <header class="text/center">
        <h1 class="text/title">Welcome to</h1>
        <i class="icn --logo_full --white --title"></i>
    </header>
@stop

@section('content')
    <section class="text/center">
        @if($env_configured && $db_configured && $db_installed)
            <a class="get-started h3 +click-area --before" href="{{ route('atlas.installer::home') }}">Get Started <i class="icn --angle-right"></i></a>
        @else
            <a class="get-started h3 +click-area --before" href="{{ route('atlas.installer::home') }}?env_configured={{ $env_configured ? 'true' : 'false' }}&db_configured={{ $db_configured ? 'true' : 'false' }}&db_installed={{ $db_installed ? 'true' : 'false' }}">Get Started <i class="icn --angle-right"></i></a>
        @endif
    </section>
@stop
