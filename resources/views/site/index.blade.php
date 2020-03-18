<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #333333;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .header-top {
            padding: 20px 50px;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-top .search {
            margin-left: auto;
        }

        .header-top .search input {
            width: 1000px;
            margin: 0;
            height: 40px;
            border: 1px solid #333333;
            box-sizing: border-box;
            outline: none;
        }

        .header-top .search button {
            width: 42px;
            height: 42px;
            margin: 0;
            background-color: #333333;
            color: white;
        }

        .header-top .links {

        }

        .header-top .links i {
            font-size: 30px;
        }

        .header-menu {
            display: flex;
            background-color: #f8efeb;
            padding: 10px 50px;
        }

        .header-menu a {
            display: block;
            color: #333333;
            font-size: 20px;
            font-weight: 600;
            text-decoration: none;
            padding: 10px 15px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-weight: 600;
            font-size: 44px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="header-top">
        <div class="search">
            <input type="text">
            <button disabled><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>

        <div class="links">
            <a href=""><i class="fa fa-user-o" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="header-menu">
        @foreach(\App\Models\Category::query()->whereNull('parent_id')->get() as $category)
            <a href="{{ $category->slug }}">{{ $category->name }}</a>
        @endforeach
    </div>
</div>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title">
            Welcome to our store
        </div>
    </div>
</div>
</body>
</html>
