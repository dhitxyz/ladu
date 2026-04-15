<body>

    @vite('resources/css/app.css')
    @include('partials.styles')

    @include('components.navbar')

    @yield('content')

    @include('components.footer')

    @include('partials.scripts')
</body>

