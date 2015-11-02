@extends('atlas.installer::layouts.page')

@section('heading')
    <h1 class="text/title">Database connection available.</h1>
@stop

@section('content')
    <section class="text/center">
        <p class="text/lead text/center">
            It appears you already have a database configured.
            Would you like to use the database named <code>{{ DB::connection()->getDatabaseName() }}</code> for Atlas, or would you rather configure a different connection?
        </p>
    </section>
    <section class="+horizontal-spread">
        <a href="{{ route('atlas.installer::db.install') }}" class="btn">Use this database.</a>
        <a href="{{ route('atlas.installer::db.create', ['reconfigure' => 'reconfigure']) }}" class="btn">Configure a different database.</a>
    </section>
@stop
