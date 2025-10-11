<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased min-h-screen flex flex-col bg-base-100 text-base-content">

    {{-- Navbar --}}
    <header class="navbar bg-base-100 shadow-sm sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="/" class="text-xl font-bold">{{ config('app.name') }}</a>

            <nav class="hidden md:flex space-x-6">
                <a href="#features" class="hover:text-primary">Features</a>
                <a href="#pricing" class="hover:text-primary">Pricing</a>
                <a href="#contact" class="hover:text-primary">Contact</a>
            </nav>

            <div class="flex items-center space-x-3">
                <a href="/login" class="btn btn-ghost btn-sm" wire:navigate>Login</a>
                <a href="/register" class="btn btn-primary btn-sm">Get Started</a>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main id="main-content" class="flex-grow">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    <footer class="footer footer-center bg-base-200 text-base-content p-6 mt-10">
        <aside>
            <p>© {{ date('Y') }} {{ config('app.name') }} — All rights reserved.</p>
        </aside>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>

</html>
