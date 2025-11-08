<div class="flex flex-col min-h-screen bg-base-200 w-72 lg:w-72 px-2 pt-0 pb-3">
    <div
        class="w-full flex items-center lg:items-start justify-between lg:gap-2 pl-3 pr-1 lg:pr-3 pt-3 pb-3 border-b-1 border-slate-300">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-start gap-x-4 cursor-pointer">
            <img src="{{ asset('img/logo.png') }}" class="max-h-12 lg:max-h-16 border border-slate-300 rounded-lg"
                alt="{{ env('APP_NAME', 'Laravel') }}">
        </a>

        <div
            class="flex-auto flex flex-col items-center lg:items-start justify-center gap-0.5 lg:ps-2 text-center lg:text-start">
            <h1 class="text-xs lg:text-sm">{{ config('app.name') }}</h1>
            <h2 class="text-[10px] underline underline-offset-4">Chiro IT Solution</h2>
        </div>

        <label for="sidebar" class="btn btn-square btn-ghost drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="inline-block h-5 w-5 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </label>
    </div>

    <ul class="menu text-base-content w-full gap-1">
        <li>
            <a href="{{ route('dashboard') }}" wire:current="menu-active" wire:navigate>
                Dashboard
            </a>
        </li>
        @if (auth()->user()->hasAnyRole(['MeGGi', 'Administrator']))
            <li>
                <details {{ request()->is('master-data/*') ? 'open' : '' }}>
                    <summary class="{{ request()->is('master-data/*') ? 'bg-neutral text-white' : '' }}">
                        Master Data
                    </summary>
                    <ul class="mt-1">
                        <li>
                            <a href="{{ route('pengguna.index') }}" wire:current="menu-active" wire:navigate>
                                Akun Pengguna
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
        @endif

        <li>
            <a href="{{ route('dummy') }}" wire:current="menu-active" wire:navigate>
                Dummy
            </a>
        </li>
    </ul>

    <div class="border-t border-slate-300 p-3 mt-auto flex flex-col gap-2">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" alt="avatar"
                class="w-10 h-10 rounded-full border border-slate-300" />

            <div class="flex flex-col">
                <span class="font-semibold text-sm">{{ auth()->user()->name }}</span>
                <span class="text-xs text-slate-500">{{ auth()->user()->email }}</span>
            </div>
        </div>
        <div class="mt-2">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-neutral w-full">Logout</button>
            </form>
        </div>
    </div>
</div>
