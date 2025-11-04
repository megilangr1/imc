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

<body class="font-sans antialiased min-h-screen flex flex-col bg-base-100 text-base-content">

    <div class="drawer drawer-end">
        <input id="main-menu" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <header class="navbar bg-base-100 shadow-sm sticky top-0 z-9">
                <div class="container mx-auto flex justify-between items-center px-4">
                    <a href="/" class="flex items-center justify-center text-xl font-bold gap-4">
                        <img src="{{ asset('img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="size-10">
                        <span class="hidden md:block">
                            {{ config('app.name') }}
                        </span>
                    </a>

                    <nav class="hidden md:flex flex-row gap-6 items-center justify-center">
                        <a href="#features" class="font-semibold hover:text-primary">Features</a>
                        <a href="#pricing" class="font-semibold hover:text-primary">Pricing</a>
                        <a href="#contact" class="font-semibold hover:text-primary">Contact</a>
                        <div class="border-r-1">&ensp;</div>
                        <a href="{{ route('login') }}" class="font-semibold hover:text-primary">Login</a>
                    </nav>

                    <div class="flex md:hidden items-center space-x-3">
                        <label for="main-menu" aria-label="open sidebar" class="btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block h-6 w-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                    </div>
                </div>
            </header>
        </div>

        <div class="drawer-side">
            <label for="main-menu" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="bg-base-200 min-h-full w-[90vw] sm:w-80 p-4">
                <div class="w-full flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('img/logo-full.png') }}" alt="{{ config('app.name') }}"
                            class="max-h-14 w-auto sm:max-h-18 mx-auto">
                    </div>

                    <hr class="w-full mx-auto border-t-2 border-slate-300">

                    <a href="{{ route('login') }}" class="btn btn-primary btn-block">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Navbar --}}

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
    @yield('js')
    @stack('js')
</body>

</html>
