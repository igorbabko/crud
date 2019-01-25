<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simple PM App</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    </head>
    <body>
        <div id="app" class="container">
            @yield ('content')
        </div>

        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
