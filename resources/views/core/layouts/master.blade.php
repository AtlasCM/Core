<!DOCTYPE html>
<html id="atlas">
<head>
    <title>Atlas CM</title>
    
    <base href="{{ url() }}">
    
    <meta name="application-name" content="Atlas Installer">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    @include('atlas.core::resources.favicons')
    @include('atlas.core::resources.styles')
</head>
<body class="@home --env-{{ env('APP_ENV') }}">
    <div id="container">
        @yield('header')
        
        <main>
            @yield('content')
        </main>
        
        @yield('footer')
    </div>
    
    @include('atlas.core::resources.scripts')
</body>
</html>
