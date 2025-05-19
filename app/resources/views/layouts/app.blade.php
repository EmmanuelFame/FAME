<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <style>
    .loader-container {
        position: fixed;
        inset: 0;
        z-index: 999;
        background-color: #0c0603;
        display: grid;
        place-content: center;
        transition: opacity .4s ease-in-out, visibility .4s ease-in-out;
    }

    .loader {
        width: 4rem;
        height: 4rem;
        border: .4rem solid #3b82f6;
        border-left-color: transparent;
        border-right-color: transparent;
        border-radius: 50%;
        animation: .8s ease infinite alternate spinner;
    }

    .loader-container.hidden {
        opacity: 0;
        visibility: hidden;
    }
    #page-content {
        opacity: 0;
        transform: translate3d(0, -1rem, 0);
        transition: opacity .6s ease-in-out, transform .6s ease-in-out;
    }

    #page-content.visible {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }

    @keyframes spinner {
        /* default values
         from{
            transform: rotate(0deg) scale(1);
        } */
        from{
            transform: rotate(1turn) scale(1.2);
        }
    }

</style>
    <body class="font-sans antialiased">
        <div class="loader-container">
        <div class="loader"></div>
    </div>

    <div id="page-content">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
        <script>
        const loaderContainer = document.querySelector('.loader-container');
        const pageContent = document.querySelector('#page-content');

        window.addEventListener('load', () => {
            loaderContainer.classList.add('hidden');
            pageContent.classList.add('visible');
        })
    </script>
    </body>
</html>
