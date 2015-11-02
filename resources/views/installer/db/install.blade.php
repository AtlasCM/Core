@extends('atlas.installer::layouts.page')

@section('heading')
    <h1 class="text/title">Connect to the database.</h1>
@stop

@section('content')
    <form class="form" method="post" action="{{ route(Route::currentRouteName()) }}">
        {!! csrf_field() !!}
        <section id="db_config__db_type" class="text/center">
            <div class="form/group">
                <h2 class="text/center">Please select a database type below.</h2>
            </div>
            
            <div class="form/group">
                <div class="select" data-name="DB_CONNECTION">
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_sqlite" value="sqlite">
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_mysql" value="mysql" checked>
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_pgsql" value="pgsql">
                    <input class="select/selection" type="radio" name="DB_CONNECTION" id="db_type_sqlsrv" value="sqlsrv">
                    
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
                <a class="btn" data-action="install_details+close_section:db_config__db_type+open_section:db_config__db_details">Configure <i class="icn --angle-right"></i></a>
            </div>
        </section>
        <section id="db_config__db_details" class="hidden">
            <section id="db_config_db_details_lite" class="hidden">
                <div class="form/input-group">
                    <input type="text" class="form/control" id="db_file" name="DB_FILE" placeholder="database.sqlite" tabindex="1">
                    <label class="form/label" for="db_file">SQLite filename</label>
                </div>
            </section>
            
            <section id="db_config_db_details_full">
                <div class="grid">
                    <section class="grid/sm/one/half">
                        <div class="form/input-group">
                            <input type="text" class="form/control" id="db_host" name="DB_HOST" placeholder="localhost" value="localhost" tabindex="1">
                            <label class="form/label" for="db_host">Hostname</label>
                        </div>
                        
                        <div class="form/input-group">
                            <input type="text" class="form/control" id="db_username" name="DB_USERNAME" placeholder="homestead" tabindex="3">
                            <label class="form/label" for="db_username">Username</label>
                        </div>
                    </section>
                    <section class="grid/sm/one/half">
                        <div class="form/input-group">
                            <input type="text" class="form/control" id="db_database" name="DB_DATABASE" placeholder="homestead" tabindex="2">
                            <label class="form/label" for="db_database">Database name</label>
                        </div>
                        
                        <div class="form/input-group">
                            <input type="password" class="form/control" id="db_password" name="DB_PASSWORD" placeholder="secret" tabindex="4">
                            <label class="form/label" for="db_password">Password</label>
                        </div>
                    </section>
                </div>
            </section>
            
            <div class="form/submit text/center">
                <button type="submit" class="btn">Connect <i class="icn --angle-right"></i></button>
            </div>
        </section>
    </form>
@stop
