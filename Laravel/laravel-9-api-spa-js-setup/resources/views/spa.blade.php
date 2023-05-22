<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app"></div>
    <!-- Scripts -->
    <script>
        window.config = <?php echo json_encode($configs); ?>;
        window.ActiveXObject = <?php echo json_encode($AuthenticatedSession); ?>;
    </script>
    <script type="module" src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>