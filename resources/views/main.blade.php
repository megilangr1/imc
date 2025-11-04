@extends('layouts.frontend')

@section('content')
    {{-- Hero Section --}}
    <div class="bg-base-200">
        <section class="container mx-auto hero min-h-[90vh]">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <img src="https://placehold.co/500x350" class="sm:max-w-sm rounded-lg shadow-2xl" alt="Hero Image" />
                <div>
                    <h1 class="text-5xl font-bold leading-tight">
                        Build better web apps with <span class="text-primary">{{ config('app.name') }}</span>
                    </h1>
                    <p class="py-6">
                        A modern Laravel 12 + Livewire + DaisyUI starter kit designed for simplicity and speed.
                    </p>
                    <a href="/register" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </section>
    </div>

    {{-- Features Section --}}
    <section id="features" class="py-20 container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Why Choose Us?</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="card bg-base-100 shadow-md p-6">
                <div class="text-primary text-4xl mb-3">⚡</div>
                <h3 class="text-xl font-semibold mb-2">Fast & Lightweight</h3>
                <p>Powered by Laravel 12, Livewire 4, and DaisyUI for seamless performance.</p>
            </div>

            <div class="card bg-base-100 shadow-md p-6">
                <div class="text-primary text-4xl mb-3">🎨</div>
                <h3 class="text-xl font-semibold mb-2">Beautiful UI</h3>
                <p>DaisyUI components let you create elegant interfaces effortlessly.</p>
            </div>

            <div class="card bg-base-100 shadow-md p-6">
                <div class="text-primary text-4xl mb-3">🔒</div>
                <h3 class="text-xl font-semibold mb-2">Secure & Scalable</h3>
                <p>Built with best practices in authentication, validation, and deployment.</p>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="bg-base-200 py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
            <p class="mb-8">We’d love to hear from you. Drop us a message anytime!</p>

            <form class="max-w-lg mx-auto space-y-4">
                <input type="text" placeholder="Your Name" class="input input-bordered w-full" />
                <input type="email" placeholder="Your Email" class="input input-bordered w-full" />
                <textarea class="textarea textarea-bordered w-full" placeholder="Your Message"></textarea>
                <button class="btn btn-primary w-full">Send Message</button>
            </form>
        </div>
    </section>
@endsection
