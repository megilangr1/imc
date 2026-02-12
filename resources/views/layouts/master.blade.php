<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @include('layouts.css')
</head>

<body class="font-sans antialiased min-h-screen flex flex-col bg-base-200 text-base-content">
    <main class="w-full" id="main-content">
        <div class="drawer lg:drawer-open">
            <input id="sidebar" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content w-full h-screen max-h-screen overflow-y-auto flex flex-col">
                @include('layouts.navbar')

                <div class="w-full flex-1 px-4 py-3">
                    @yield('content')

                    {{ $slot ?? '' }}
                </div>
            </div>
            <div class="drawer-side border-r-2 border-r-slate-200">
                <label for="sidebar" aria-label="close sidebar" class="drawer-overlay"></label>

                @include('layouts.sidebar')
            </div>
        </div>
    </main>


    @include('layouts.script')
</body>

</html>
