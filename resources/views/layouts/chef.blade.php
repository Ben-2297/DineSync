<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>

  <!-- favicon -->
  <link rel="icon" type="image/png" href="{{ asset('logo/Logo1.png') }}">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

  <!-- Toastr -->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">

  <script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

  <!-- Alpine Plugins -->
  <script type="text/javascript" src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js" defer></script>
  <!-- Alpine Core -->
  <script type="text/javascript" src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
    .profile-user-img:hover {
        background-color: blue;
        cursor: pointer;
    }
  </style>
  @livewireStyles
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini {{ setting('sidebar_collapse') ? 'sidebar-collapse' : '' }}">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.partials.navbar')

  <!-- Main Sidebar Container -->
  @include('layouts.partials.aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    {{ $slot }}
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <!-- Main Footer -->
  @include('layouts.partials.footer')
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>

<script>
  $(document).ready(function () {
    toastr.options = {
      "positionClass": "toast-bottom-right",
      "progressBar": true,
    }
    window.addEventListener('hide-form', event => {
    $('#form').modal('hide');
    toastr.success(event.detail.message, 'Success!');
  })
  })
</script>
<script>
  window.addEventListener('show-form', event => {
    $('#form').modal('show'); 
  })
  window.addEventListener('show-delete-modal', event => {
    $('#confirmationModal').modal('show');
  })
  window.addEventListener('hide-delete-modal', event => {
    $('#confirmationModal').modal('hide');
    toastr.success(event.detail.message, 'Success!');
  })
  window.addEventListener('alert', event => {
    toastr.success(event.detail.message, 'Success!');
  })
  window.addEventListener('updated', event => {
    toastr.success(event.detail.message, 'Success!');
  })
</script>
<script>
  $(document).ready(function () {
      Livewire.on('nameChanged', (changedName) => {
          $('[x-ref="username"]').text(changedName);
      })
  });
</script>
<script>
  $('[x-ref="chefProfileLink"]').on('click', function() {
    localStorage.setItem('_x_currentTab', '"chefProfile"');
  });
  $('[x-ref="chefProfileInfoLink"]').on('click', function() {
    localStorage.setItem('_x_currentTab', '"chefProfileInfo"');
  });
</script>
<script>
  function showData(){
    $('#data').show();
  }
</script>
@stack('js')
@livewireScripts
</body>
</html>
