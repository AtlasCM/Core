@extends('atlas.installer::layouts.modes')

@var($connection_failed = array_get(array_keys(session()->get('failed.DB_DATABASE', session()->get('failed.DB_FILE', []))), 0) == 'Database')

@section('heading')
    <h1 class="text/title">Connect to the database.</h1>
@stop

@section('form_errors')
    @if($connection_failed)
        <section class="alert --danger text/center">Atlas {{ $errors->first('DB_DATABASE')  }} {{ $errors->first('DB_FILE') }}</section>
    @endif
@stop

@section('form_db_details')
    <div class="grid">
        <section class="grid/sm/one/half">
            <div class="form/input-group">
                <input type="text" class="form/control{{ $errors->has('DB_HOST') ? ' --error' : '' }}" id="db_host" name="DB_HOST" placeholder="localhost" value="{{ old('DB_HOST') ?: 'localhost' }}" tabindex="1">
                <label class="form/label --required" for="db_host">Hostname</label>
                @if($errors->has('DB_HOST'))
                    <span class="form/error">{{ $errors->first('DB_HOST') }}</span>
                @endif
            </div>

            <div class="form/input-group">
                <input type="text" class="form/control{{ $errors->has('DB_USERNAME') ? ' --error' : '' }}" id="db_username" name="DB_USERNAME" placeholder="homestead" tabindex="3"{!! old('DB_USERNAME') ? 'value="' . e(old('DB_USERNAME')) . '"' : '' !!}}>
                <label class="form/label --required" for="db_username">Username</label>
                @if($errors->has('DB_USERNAME'))
                    <span class="form/error">{{ $errors->first('DB_USERNAME') }}</span>
                @endif
            </div>

            <div class="form/input-group">
                <input type="text" class="form/control{{ $errors->has('DB_PREFIX') ? ' --error' : '' }}" id="db_prefix" name="DB_PREFIX" tabindex="5"{!! old('DB_PREFIX') ? 'value="' . e(old('DB_PREFIX')) . '"' : '' !!}}>
                <label class="form/label" for="db_prefix">Table Prefix</label>
                @if($errors->has('DB_PREFIX'))
                    <span class="form/error">{{ $errors->first('DB_PREFIX') }}</span>
                @endif
                <span class="form/help">Defaults to Atlas_</span>
            </div>
        </section>
        <section class="grid/sm/one/half">
            <div class="form/input-group">
                <input type="text" class="form/control{{ ! $connection_failed && $errors->has('DB_DATABASE') ? ' --error' : '' }}" id="db_database" name="DB_DATABASE" placeholder="homestead" tabindex="2"{!! old('DB_DATABASE') ? 'value="' . e(old('DB_DATABASE')) . '"' : '' !!}}>
                <label class="form/label --required" for="db_database">Database name</label>
                @if(! $connection_failed && $errors->has('DB_DATABASE'))
                    <span class="form/error">{{ $errors->first('DB_DATABASE') }}</span>
                @endif
            </div>

            <div class="form/input-group">
                <input type="password" class="form/control{{ $errors->has('DB_PASSWORD') ? ' --error' : '' }}" id="db_password" name="DB_PASSWORD" placeholder="secret" tabindex="4">
                <label class="form/label --required" for="db_password">Password</label>
                @if($errors->has('DB_PASSWORD'))
                    <span class="form/error">{{ $errors->first('DB_PASSWORD') }}</span>
                @endif
            </div>
        </section>
    </div>
@stop

@section('dev')
    <form class="form" method="post" action="{{ route(Route::currentRouteName()) }}">
        {!! csrf_field() !!}
        
        @yield('form_errors')
        
        <section id="db_config__db_type" class="text/center{{ old('DB_CONNECTION') ? ' hidden' : '' }}">
            <div class="form/group">
                <h2 class="text/center">Please select a database type below.</h2>
            </div>
            
            <div class="form/group">
                <div class="select">
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_sqlite" value="sqlite"{{ old('DB_CONNECTION') == 'sqlite' ? 'checked' : '' }}>
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_mysql" value="mysql"{{ old('DB_CONNECTION') == 'mysql' || ! old('DB_CONNECTION') ? ' checked' : '' }}>
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_pgsql" value="pgsql"{{ old('DB_CONNECTION') == 'pgsql' ? 'checked' : '' }}>
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_sqlsrv" value="sqlsrv"{{ old('DB_CONNECTION') == 'sqlsrv' ? 'checked' : '' }}>
                    
                    <input class="select/toggle" type="radio" name="DB_CONNECTION" id="db_type__open" value="null">
                    <input type="radio" name="DB_CONNECTION" id="db_type__close" value="null">
                    
                    <label class="select/open" for="db_type__open">Database Type</label>
                    <label class="select/close" for="db_type__close"></label>
                    <div class="select/options">
                        <label class="select/option" for="db_type_sqlite" data-value="SQLite">SQLite</label>
                        <label class="select/option" for="db_type_mysql" data-value="MySQL">MySQL</label>
                        <label class="select/option" for="db_type_pgsql" data-value="PostgreSQL">PostgreSQL</label>
                        <label class="select/option" for="db_type_sqlsrv" data-value="SQL Server">SQL Server</label>
                    </div>
                </div>
            </div>
            
            <div class="form/submit text/center">
                <a class="btn" data-action="install_details;close_section:db_config__db_type+open_section:db_config__db_details">Configure <i class="icn --angle-right"></i></a>
            </div>
        </section>
        <section id="db_config__db_details"{!! old('DB_CONNECTION') ? '' : ' class="hidden"' !!}>
            <section id="db_config_db_details_lite"{!! old('DB_CONNECTION') != 'sqlite' ? ' class="hidden"' : '' !!}>
                <div class="form/input-group">
                    <input type="text" class="form/control{{ ! $connection_failed && $errors->has('DB_FILE') ? ' --error' : '' }}" id="db_file" name="DB_FILE" placeholder="database.sqlite" tabindex="1"{!! old('DB_FILE') ? ' value="' . e(old('DB_FILE')) . '"' : '' !!}>
                    <label class="form/label --required" for="db_file">SQLite filename</label>
                    @if(! $connection_failed && $errors->has('DB_FILE'))
                        <span class="form/error">{{ $errors->first('DB_FILE') }}</span>
                    @endif
                </div>
            </section>
            
            <section id="db_config_db_details_full"{!! old('DB_CONNECTION') == 'sqlite' ? ' class="hidden"' : '' !!}>
                @yield('form_db_details')
            </section>
            
            <div class="form/submit text/center">
                <button type="submit" class="btn">Connect <i class="icn --angle-right"></i></button>
            </div>
        </section>
    </form>
@stop

@section('simple')
    <form class="form" method="post" action="{{ route(Route::currentRouteName()) }}">
        {!! csrf_field() !!}
        <input type="hidden" name="DB_CONNECTION" value="mysql">
        
        @yield('form_errors')
        
        <section id="db_config__db_details">
            @yield('form_db_details')
            <div class="form/submit text/center">
                <button type="submit" class="btn">Connect <i class="icn --angle-right"></i></button>
            </div>
        </section>
    </form>
@stop
