<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account Settings UI Design</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.css') }}">
	<script type="text/javascript" src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
	@livewireStyles
</head>
<body>
    {{ $slot }}

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@livewireScripts
	<script>
		window.addEventListener('swal:modal', event => {
			swal({
				title: event.detail.title,
				text: event.detail.text,
				icon: event.detail.type,
			});
		});
	</script>
</body>
</html>