<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Friends Fun</title>
    @vite('resources/sass/app.scss')

</head>
<body>
    <div id="app">
        <router-view/>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
