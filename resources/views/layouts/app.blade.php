<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased m-0">
        <div class="flex flex-col min-h-screen">
            <x-banner />
            <div class="mb-5">
                @livewire('navigation-menu')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white">
                        <div class="max-w-7xl mx-auto py-6 px-20 sm:px-22 lg:px-22">
                            {{ $header }}
                            <hr class="mt-2">
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="bg-white">
                    {{ $slot }}
                </main>
            </div>
            <div class="flex-1"></div>
            <footer class="bg-gray-200 h-20">
                <div class="grid grid-cols-3">
                    <div>
                        <div class="px-18 sm:px-20 lg:px-20">
                            <a href="https://tas.ac.uk/" target="_blank">
                                <img src="{{\Illuminate\Support\Facades\Storage::url('tas-logo.png')}}" width="128" height="128">
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="mt-12">
                            <p class="items-center text-center text-sm font-semibold text-slate-500">
                                {!! nl2br($footer_text) !!}
                            </p>
                            <p class="items-center text-center text-sm font-semibold text-slate-500">
                                Developed by
                                <a target="_blank" class="hover:text-sky-400" href="https://www.kcl.ac.uk/research/facilities/e-research">e-Research</a>
                                at <a target="_blank" class="hover:text-sky-400" href="https://www.kcl.ac.uk/">King's College London</a>
                            </p>
                        </div>
                    </div>
                    <div>
                        <div class="mt-7 relative">
                            <div class="absolute right-32">
                                <x-contact-us-modal wire:model="showingModal"></x-contact-us-modal>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <x-create-use-case></x-create-use-case>
        @stack('modals')
        @livewireScripts
        @stack('scripts')
        <script type="module">
            $(document).ready(function () {
                window.addEventListener('initLoginModal', event => {
                    var loginModalBtn = document.getElementById('loginModalBtn');
                    if (loginModalBtn != null) {
                        loginModalBtn.click();
                    }
                });

                window.addEventListener('initCreateUseCaseModal', event => {
                    var createUseCaseBtn = document.getElementById('createUseCaseBtn');
                    if (createUseCaseBtn != null) {
                        createUseCaseBtn.click();
                    }
                });
            });
        </script>
    </body>
</html>
