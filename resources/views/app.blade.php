<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title inertia>RafEvent</title>
    @vite(['resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 text-gray-900">
    @inertia
</body>
</html>
