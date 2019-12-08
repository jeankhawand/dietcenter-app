<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = {csrToken: '{{csrf_token() }}'}</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="manifest" href="/manifest.json">
    <title>Diet Center - @yield('title')</title>
</head>


<body>
    <div id="app">
        <navbar-component></navbar-component>
        <login-component></login-component>
    </div>
</body>
<script src="{{asset('js/app.js')}}"></script>
</html>
