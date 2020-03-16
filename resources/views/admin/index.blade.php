<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | Admin Panel | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/admin/vendor.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}"/>
</head>
<body>



<script src="{{ asset('js/admin/manifest.js') }}"></script>
<script src="{{ asset('js/admin/vendor.js') }}"></script>
<script src="{{ asset('js/admin/admin.js') }}"></script>

</body>
</html>
