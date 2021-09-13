<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body{
            margin-top:20px;
            background: #f8f8f8;
        }

        .todo-nav {
            margin-top: 10px
        }

        .todo-list {
            margin: 10px 0
        }

        .todo-list .todo-item {
            padding: 15px;
            margin: 5px 0;
            border-radius: 0;
            background: #f7f7f7
        }

        div.checker {
            width: 18px;
            height: 18px
        }

        div.checker input,
        div.checker span {
            width: 18px;
            height: 18px
        }

        div.checker span {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            text-align: center;
            background-position: 0 -260px;
        }

        div.checker, div.checker input, div.checker span {
            width: 19px;
            height: 19px;
        }

        div.checker, div.radio, div.uploader {
            position: relative;
        }

        div.button, div.button *, div.checker, div.checker *, div.radio, div.radio *, div.selector, div.selector *, div.uploader, div.uploader * {
            margin: 0;
            padding: 0;
        }

        div.button, div.checker, div.radio, div.selector, div.uploader {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            vertical-align: middle;
        }

        .card {
            padding: 25px;
            margin-bottom: 20px;
            border: initial;
            background: #fff;
            border-radius: calc(.15rem - 1px);
            box-shadow: 0 1px 15px rgba(0,0,0,0.04), 0 1px 6px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-white">
                <div class="card-body">
                    <ul class="nav nav-pills todo-nav">
                        <li role="presentation" class="nav-item all-task "><a href="/alltasks" class="nav-link">All</a></li>
                        <li role="presentation" class="nav-item deleted-task"><a href="/deletedtaskslist" class="nav-link">Deleted</a></li>
                        <li role="presentation" class="nav-item"><a href="/download" class="nav-link">Download Tasks</a></li>
                        <li role="presentation" class="nav-item pull-right"><a href="/logout" class="nav-link">LogOut</a></li>
                    </ul>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
