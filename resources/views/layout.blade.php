<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRUD</title>
        <link rel="icon" type="image/png" href="/favicon.png" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        @include ('partials.nav')

        <div id="app" class="container">
            @yield ('content')
        </div>

        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
