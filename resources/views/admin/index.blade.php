<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Admin Panel</title>
    <link rel="stylesheet" href="{{ mix('css/admin/admin.css') }}"/>
</head>
<body>
{{--    @if (Auth::check())--}}
{{--        <script>--}}
{{--            window.user = {--}}
{{--                loggedIn: true,--}}
{{--                user: {!! Auth::user() !!}--}}
{{--            }--}}
{{--        </script>--}}
{{--    @else--}}
{{--        <script>--}}
{{--            window.user = {loggedIn: false}--}}
{{--        </script>--}}
{{--    @endif--}}
    <div id="app"></div>
    <script defer src="{{ mix('js/admin/admin.js') }}"></script>
</body>
</html>
