<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Kuisioner Kecocokan Warna - Hamdani Research') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('/fonts/inter_font.ttf') format('truetype');
            font-weight: 100 900; /* Supports variable weight if applicable, or just defaults */
            font-style: normal;
        }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full bg-white text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center p-4">
        <div class="w-full max-w-4xl text-gray-800 p-8 text-center flex flex-col justify-center items-center">
            @yield('content')
        </div>
        <footer class="mt-8 text-gray-500 text-sm text-center">
            &copy; {{ date('Y') }} Desainta - Hamdani
        </footer>
    </div>
</body>
</html>
