@extends('atlas.installer::layouts.page')

@section('heading')
    <h1 class="text/title">First things first.</h1>
@stop

@section('content')
    <section>
        <p class="text/lead text/center">Are you a developer, or are you a user setting up Atlas?</p>
    </section>
    <section class="+horizontal-spread">
        <form method="post" action="{{ route(Route::currentRouteName()) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="mode" value="dev">
            
            <button type="submit" class="btn +click-area --before">I'm a developer</button>
        </form>
        
        <form method="post" action="{{ route(Route::currentRouteName()) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="mode" value="simple">
            
            <button type="submit" class="btn +click-area --before">I'm a user</button>
        </form>
    </section>
@stop
