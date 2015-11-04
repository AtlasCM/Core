@extends('atlas.installer::layouts.modes')

@section('heading')
    <h1 class="text/title">Environment Configuration</h1>
@stop

@section('dev')
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

@section('simple')
    <section>
        <p class="text/lead text/center">Are you a running this site as a testing site or as a live site?</p>
    </section>
    <section class="+horizontal-spread">
        <form method="post" action="{{ route(Route::currentRouteName()) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="env" value="staging">
            
            <button type="submit" class="btn +click-area --before">I'm just testing</button>
        </form>
        
        <form method="post" action="{{ route(Route::currentRouteName()) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="env" value="production">
            
            <button type="submit" class="btn +click-area --before">This is a live site</button>
        </form>
    </section>
@stop
