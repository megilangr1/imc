<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Company') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @yield('css')
    @stack('css')
</head>

<body class="antialiased bg-base-200 text-base-content">

    <div class="drawer drawer-end">
        <input id="main-menu" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <header class="navbar bg-base-100 shadow-sm sticky top-0 z-9">
                <div class="container mx-auto flex justify-between items-center px-4">
                    <a href="/" class="flex items-center justify-center text-xl font-bold gap-4">
                        <div class="bg-slate-100 lg:bg-slate-100/90 w-auto h-auto rounded-lg p-0.5 lg:p-2">
                            <img src="{{ asset('img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="size-10">
                        </div>
                        <span class="hidden md:block">
                            {{ config('app.name') }}
                        </span>
                    </a>

                    <nav class="hidden md:flex flex-row gap-6 items-center justify-center">
                        <a href="#about" class="font-semibold hover:text-primary">Tentang Kami</a>
                        <a href="#products" class="font-semibold hover:text-primary">Layanan Produk</a>
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

            <main>
                @yield('content')
                {{ $slot ?? '' }}
            </main>

            <footer class="bg-base-300 mt-16">
                <div class="container mx-auto px-4 pt-8 pb-3 grid md:grid-cols-6 gap-6">
                    <div class="md:col-span-3 flex flex-col gap-2">
                        <h3 class="font-bold">IMCOMPUTER</h3>
                        <p class="text-sm">
                            Solusi Digital Terpercaya untuk Bisnis Modern
                        </p>

                        <div class="w-full flex flex-col gap-1">
                            <span class="text-sm">
                                Teknologi Komputer & Layanan IT
                            </span>
                            <span class="text-sm">
                                <a href="mailto:imcomputer@gmail.com" class="link link-primary">
                                    imcomputer@gmail.com
                                </a>
                            </span>
                            <span class="text-sm">
                                Jl Garuda Kp Genteng
                            </span>
                            <span class="text-sm">
                                <a href="{{ route('main') }}" target="_blank" class="link link-primary">
                                    www.imcomputersmi.com
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="md:col-span-3 flex flex-col gap-2">
                        <h3 class="font-bold">GOOGLE MAPS</h3>
                        ////
                    </div>
                    <div class="md:col-span-6 flex items-center justify-end">
                        <a href="{{ route('login') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-cog-icon lucide-cog shrink-0 size-3">
                                <path d="M11 10.27 7 3.34" />
                                <path d="m11 13.73-4 6.93" />
                                <path d="M12 22v-2" />
                                <path d="M12 2v2" />
                                <path d="M14 12h8" />
                                <path d="m17 20.66-1-1.73" />
                                <path d="m17 3.34-1 1.73" />
                                <path d="M2 12h2" />
                                <path d="m20.66 17-1.73-1" />
                                <path d="m20.66 7-1.73 1" />
                                <path d="m3.34 17 1.73-1" />
                                <path d="m3.34 7 1.73 1" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="12" cy="12" r="8" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="text-center py-4 px-4 text-sm bg-base-200">
                    © {{ date('Y') }} Company. All rights reserved.
                </div>
            </footer>
        </div>

        <div class="drawer-side">
            <label for="main-menu" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="bg-base-200 min-h-full w-[90vw] sm:w-80 p-4">
                <div class="w-full flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <div class="bg-slate-100/90 w-auto h-auto rounded-lg p-2 mx-auto">
                            <img src="{{ asset('img/logo-full.png') }}" alt="{{ config('app.name') }}"
                                class="max-h-14 w-auto sm:max-h-18 mx-auto">
                        </div>
                    </div>

                    <hr class="w-full mx-auto border-t-2 border-slate-300">

                    <a href="{{ route('login') }}" class="btn btn-primary btn-block">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    @yield('js')
    @stack('js')
</body>

</html>
