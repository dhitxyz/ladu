<body>

    @vite('resources/css/app.css')
    @include('partials.styles')

    @yield('content')

    @include('partials.scripts')
</body>
