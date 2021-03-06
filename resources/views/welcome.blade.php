<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Url shortener</title>

        <!-- Stylesheet -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

        <script>
            window.user = @json(auth()->user());
            window.loggedIn = @json(auth()->check());
        </script>

    </head>
    <body>
        <div id="app">
            <main-component />
            <!-- Script -->
            <script type="application/javascript" src="{{ asset('js/app.js') }}"></script>
        </div>
    </body>
</html>
