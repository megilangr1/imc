<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @yield('css')
    @stack('css')
</head>

<body class="font-sans antialiased min-h-screen flex flex-col bg-base-200 text-base-content">
    <main class="w-full">
        @yield('content')

        {{ $slot ?? '' }}
    </main>

    @livewireScripts
    @yield('js')
    @stack('js')
</body>

</html>
