<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini ERP | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SB Admin CSS --}}
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body id="page-top">

<div id="wrapper">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

        {{-- Topbar --}}
            @include('partials.navbar')

            <div class="container-fluid mt-4">

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
            @yield('content')
            </div>
        </div>

        <footer class="bg-white text-center py-3">
            <small>© {{ date('Y') }} Mini ERP System</small>
        </footer>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
@stack('scripts')

</body>
</html>
