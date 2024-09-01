<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Blog') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('public\assets\images\favicon.ico') }}">

    <!-- App css -->
    <link href="{{ url('public\assets\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
    <link href="{{ url('public\assets/css\icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('public\assets/css\app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet">

</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Vendor js -->
    <script src="{{ url('public\assets/js\vendor.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ url('public\assets/js\app.min.js') }}"></script>
</body>
</html>
