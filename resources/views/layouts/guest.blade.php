<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FOLKTALES') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styling -->
    <style>
        .form-container {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Shadow */
            border-radius: 15px; /* Rounded corners */
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased background">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="logo mb-6">
            <h1 class="text-4xl font-bold text-amber-600">FOLKTALES CMS</h1>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white form-container overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
