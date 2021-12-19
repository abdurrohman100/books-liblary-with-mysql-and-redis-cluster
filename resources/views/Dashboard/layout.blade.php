<!DOCTYPE html>
<html>

<head>

    {{-- html head --}}
    @include('dashboard.partials._head')

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

    {{-- navbar --}}
    @include('dashboard.navbars._navbar')

    {{-- sidebar --}}

    @include('dashboard.navbars.sidebars._student')
    {{-- @elseif( session('role') == 'mentor')
        @include('dashboard.navbars.sidebars._mentor')
    @endif --}}


    {{-- content --}}
    <div class="content-wrapper">
        {{-- @include('partials._messages') --}}
        @yield('content')
    </div>

    {{-- sidebar control --}}

    {{-- footer --}}
     @include('dashboard.footers._footer')

</div>

    {{-- dashboard's js's --}}
    @include('dashboard.partials._javascripts')

    {{-- own's page js's --}}
    @yield('scripts')

</body>

</html>
