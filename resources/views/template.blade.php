<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>

    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/Logo1.png') }}">

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('authentication/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('authentication/css/style.css') }}">
</head>
<body>

    <div class="main">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('authentication/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('authentication/js/main.js') }}"></script>
</body>
</html>