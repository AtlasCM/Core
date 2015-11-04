<!DOCTYPE html>
<html id="atlas">
<head>
    <title>Atlas CM</title>
    
    <base href="{{ url() }}">
    
    <meta name="application-name" content="Atlas Installer">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    @include('atlas.installer::resources.favicons')
    @include('atlas.installer::resources.styles')
</head>
<body class="{{ '@' . str_replace(['atlas.installer::', '.'], ['', '__'], Route::currentRouteName()) }} --env-{{ env('APP_ENV') }}">
    <div id="container">
        <a id="logo" href="{{ Atlas::homepage() }}" target="_blank"></a>
        
        @yield('header')
        
        <main class="container">
            @yield('content')
        </main>
        
        @yield('footer')
    </div>
    
    @include('atlas.installer::resources.scripts')
</body>
</html>
