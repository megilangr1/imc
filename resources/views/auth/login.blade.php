@extends('layouts.base')

@section('content')
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-sm md:max-w-3xl">
            <div class="flex flex-col gap-6">
                <div class="card overflow-hidden grid p-0 md:grid-cols-2 border border-slate-300">
                    <div class="lg:min-h-[70vh] flex items-center justify-center pt-6 pb-6">
                        <div class="w-full grid grid-cols-1 items-center justify-center gap-2 px-6 md:px-8">
                            <div class="w-full grid grid-cols-1 items-center text-center gap-1">
                                <h1 class="text-lg font-bold">
                                    {{ config('app.name') ?? 'Laravel' }}
                                </h1>
                                <p class="text-[10px] sm:text-xs text-muted-foreground text-balance">
                                    Silahkan Login Untuk Mengakses Aplikasi
                                </p>
                                <hr class="w-full mt-2 border-t-1" />
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="flex flex-col gap-2 py-2">
                                    <div class="w-full flex flex-col gap-2">
                                        <label for="email" class="text-sm font-semibold">Email :</label>
                                        <div class="relative">
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                placeholder="example@mail.com" required aria-describedby="email-helper"
                                                class="input @error('email') input-error @enderror">

                                            @error('email')
                                                <div
                                                    class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                                    <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="12" y1="8" x2="12" y2="12">
                                                        </line>
                                                        <line x1="12" y1="16" x2="12.01" y2="16">
                                                        </line>
                                                    </svg>
                                                </div>
                                            @enderror
                                        </div>

                                        @error('email')
                                            <p class="text-xs text-red-600" id="email-helper">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full flex flex-col gap-2">
                                        <label for="password" class="text-sm font-semibold">Password :</label>
                                        <div class="relative">
                                            <input type="password" id="password" name="password"
                                                value="{{ old('password') }}" placeholder="*******" required
                                                aria-describedby="password-helper"
                                                class="input @error('password') input-error @enderror">

                                            @error('password')
                                                <div
                                                    class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                                    <svg class="shrink-0 size-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="12" y1="8" x2="12" y2="12">
                                                        </line>
                                                        <line x1="12" y1="16" x2="12.01" y2="16">
                                                        </line>
                                                    </svg>
                                                </div>
                                            @enderror
                                        </div>

                                        @error('password')
                                            <p class="text-xs text-red-600" id="password-helper">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <hr class="w-full border-t-1 border-slate-300 my-2">

                                    <button type="submit" class="btn btn-neutral w-full">
                                        Login
                                    </button>
                                </div>
                            </form>

                            <a href="{{ route('main') }}">
                                <div class="divider text-xs font-semibold text-slate-600 my-1">
                                    Kembali Ke Halaman Utama
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bg-muted relative hidden md:block">
                        <img src="/img/login-banner.jpg" alt="Image"
                            class="absolute inset-0 h-full w-full object-cover " />
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
