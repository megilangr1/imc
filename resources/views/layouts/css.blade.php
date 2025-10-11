@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles

<style>
    .ts-control {
        min-height: 40px !important;
        padding-left: 12px !important;
        vertical-align: middle !important;
        font-size: 14px !important;
        margin: 0 auto !important;
        line-height: inherit !important;
    }
</style>

@yield('css')
@stack('css')
