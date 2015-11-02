@extends('atlas.installer::layouts.page')

@section('heading')
    <h1 class="text/title">First things first.</h1>
@stop

@section('content')
    <section class="text/center">
        <form class="form" method="post" action="{{ route(Route::currentRouteName()) }}">
            {!! csrf_field() !!}
            
            <div class="form/group">
                <h2 class="text/center">Please select an environment below.</h2>
            </div>
            
            <div class="form/group">
                <div class="select">
                    <input class="select/selection" type="radio" name="env" id="env_local" value="local">
                    <input class="select/selection" type="radio" name="env" id="env_testing" value="testing">
                    <input class="select/selection" type="radio" name="env" id="env_staging" value="staging">
                    <input class="select/selection" type="radio" name="env" id="env_production" value="production">
                    
                    <input class="select/toggle" type="radio" name="env" id="env__open" value="null">
                    <input type="radio" name="env" id="env__close" value="null">
                    
                    <label class="select/open" for="env__open">Pick Environment</label>
                    <label class="select/close" for="env__close"></label>
                    <div class="select/options">
                        <label class="select/option" for="env_local" data-value="Local">Local</label>
                        <label class="select/option" for="env_testing" data-value="Testing">Testing</label>
                        <label class="select/option" for="env_staging" data-value="Staging">Staging</label>
                        <label class="select/option" for="env_production" data-value="Production">Production</label>
                    </div>
                </div>
            </div>
            
            <div class="form/group">
                <button type="submit" class="btn +click-area --before">Continue <i class="icn --angle-right"></i></button>
            </div>
        </form>
    </section>
@stop
