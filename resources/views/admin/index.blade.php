<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Admin Panel</title>
    <link rel="stylesheet" href="{{ mix('css/admin/admin.css') }}"/>
</head>
<body>
    <div id="app"></div>
    <script src="{{ mix('js/admin/admin.js') }}"></script>
</body>
</html>
