<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('header-assets')
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased dark:bg-slate-800 bg-white">

<main class="py-16 lg:py-20 mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="container mx-auto">
        @yield('content')
    </div>
</main>

@yield('footer-assets')
@livewireScripts
</body>
</html>
