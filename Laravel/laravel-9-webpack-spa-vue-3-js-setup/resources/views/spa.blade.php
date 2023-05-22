<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('dist/css/app.styles.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script type="module" src="{{ asset('dist/js/bootstrap.bundle.js') }}" defer></script>
    <script type="module" src="{{ asset('dist/js/vendors.bundle.js') }}" defer></script>
</head>

<body>
    <div id="app"></div>
    <script>
        window.config = <?php echo json_encode($configs); ?>;
        window.ActiveXObject = <?php echo json_encode($AuthenticatedSession); ?>;
    </script>
    <script type="module" src="{{ asset('dist/js/app.bundle.js') }}" defer></script>
</body>

</html>