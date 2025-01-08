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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Main Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">
        <livewire:styles />
    </head>
    <body>
        {{ $slot }}

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
        <script>
            window.addEventListener('swal:modal', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                });
            });

            const el = document.createElement('div')
            el.innerHTML = "Here's a <a href={{ route('account') }}>link</a>"
            window.addEventListener('swal:modal2', event => {
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    content: el,
                });
            });
        </script>
        <script>
            window.addEventListener('hide-form', event => {
                $('#modalORderform').modal('hide');
                swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    timer: 3000,
                });
                $('#OrderDetail').modal('show'); 
            })
            window.addEventListener('show-form', event => {
                $('#modalORderform').modal('show'); 
            })
        </script>
        <livewire:scripts />
    </body>
</html>