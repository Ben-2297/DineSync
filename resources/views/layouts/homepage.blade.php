<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>

        <!-- favicon -->
        <link rel="icon" type="image/png" href="{{ asset('logo/Logo1.png') }}">

        <!-- icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!-- Main Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">

        <script type="text/javascript" src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        @livewireStyles
    </head>
    <body>
        <livewire:homepage.home-nav />
        <livewire:homepage.home-section />
        <livewire:homepage.menu-section />
        <livewire:homepage.team-section />
        <livewire:homepage.order-section />
        <livewire:homepage.contact-section />

        <script type="text/javascript" src="{{ asset('home/js/script.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            window.addEventListener('swal:modal', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    timer: 3000,
                });
            });
        </script>
        @livewireScripts
    </body>
</html>