<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app"></div>

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <!-- Configs -->
    <script>
        window.configs = <?php echo json_encode($configs); ?>;
    </script>

    <!-- Authenticated Session -->
    <script>
        window.currentUser = <?php echo json_encode($currentUser); ?>;
        window.isLoggedin = <?php echo json_encode($isLoggedin); ?>;
    </script>
</body>

</html>