<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ mix('css/admin/admin.css') }}"/>
</head>

<body>
    <script>
      window.user = @json([
        'user' => Auth::user()
      ])
    </script>
    <div id="app"></div>
    <script defer src="{{ mix('js/admin/admin.js') }}"></script>
</body>
</html>
