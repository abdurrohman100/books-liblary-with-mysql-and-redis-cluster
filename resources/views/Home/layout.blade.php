<!DOCTYPE html>

<html class="no-js" lang="zxx">

<head>

    {{-- html head --}}
    @include('home.partials._head')

</head>

<body>
    
    {{-- body head --}}
    @include('home.headers._header')

    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    @if(Route::current()->getName() == 'login-welcome')
    
    @else
        @include('home.footers._footer')
    @endif
    
    {{-- portal's js's --}}
    @include('home.partials._javascripts')

    {{-- own's page js's --}}
    @yield('scripts')

</body>

</html>