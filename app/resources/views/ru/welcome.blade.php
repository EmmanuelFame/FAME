<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Milestar Trade</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/milestar_logo.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- External Libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

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
            animation: spinner .8s ease infinite alternate;
        }

        @keyframes spinner {
            from { transform: rotate(1turn) scale(1.2); }
        }

        .loader-container.hidden {
            opacity: 0;
            visibility: hidden;
        }

        #page-content {
            opacity: 0;
            transform: translateY(-1rem);
            transition: opacity .6s ease-in-out, transform .6s ease-in-out;
        }

        #page-content.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .ripple-ring {
            width: 100%;
            height: 100%;
            border: 2px solid rgba(234, 233, 233, 0.4);
            border-radius: 50%;
            animation: rippleAnim 3s infinite ease-in-out;
            position: absolute;
            z-index: -1;
        }

        @keyframes rippleAnim {
            0% {
                transform: scale(1);
                opacity: 0.4;
            }
            100% {
                transform: scale(1.8);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="scroll-smooth">

    <!-- Page Loader -->
    <div class="loader-container" id="loader">
        <div class="loader"></div>
    </div>

<!-- Main Content -->
<div id="page-content">
    <!-- Navbar -->
    <header>
   <nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex items-center justify-between max-w-screen-xl p-4 mx-auto">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/milestar_logo.jpg') }}" class="h-8" alt="Milestar Logo" />
            <span class="self-center text-2xl font-semibold dark:text-white">Milestar</span>
        </a>

        <!-- Right Side: Nav Links -->
        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-1.5 text-sm text-[#1b1b18] dark:text-[#EDEDEC] border rounded-sm border-[#19140035] dark:border-[#3E3E3A] hover:border-[#1915014a] dark:hover:border-[#62605b]">
                    {{ __('dashboard') }}
                </a>

                <div class="relative group">
                    <button class="text-sm font-medium text-gray-700 dark:text-gray-300 focus:outline-none">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="absolute right-0 hidden w-40 py-2 mt-2 space-y-1 bg-white border border-gray-200 rounded-md shadow-lg group-hover:block dark:bg-gray-800 dark:border-gray-700">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('profile') }}
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full px-4 py-2 text-sm text-left text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ __('logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm text-gray-900 rounded-sm hover:bg-gray-100 md:hover:text-blue-700 dark:text-white dark:hover:text-blue-500 dark:hover:bg-gray-700">
                    {{ __('login') }}
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 text-sm text-gray-900 rounded-sm hover:bg-gray-100 md:hover:text-blue-700 dark:text-white dark:hover:text-blue-500 dark:hover:bg-gray-700">
                        {{ __('register') }}
                    </a>
                @endif
            @endauth

            <!-- Language Switcher -->
            <div>
                @include('components.lang-switch')
            </div>
        </div>
    </div>
</nav>


    </header>
<!-- Floating Ship Icon -->
        <div id="ship-container" class="fixed z-50" style="width: 80px; height: 80px; top: 0; left: 0;">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="ripple-ring"></div>
            </div>
            <img id="ship" src="{{ asset('images/ship.svg') }}" alt="Ship" class="w-full h-full">
        </div>

<!-- Раздел героев -->
<section x-data="carousel()" x-init="start()" class="relative overflow-hidden h-[85vh] sm:h-[80vh] md:h-[90vh] lg:h-[95vh] xl:h-screen">
<div class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-t from-black/60 to-transparent"></div>

<!-- Изображения -->
<div class="relative w-full h-full">
<template x-for="(image, index) in images" :key="index">
<div x-show="active === index"
x-transition:enter="transition-opacity duration-1000"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition-opacity duration-1000"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0"
class="absolute inset-0 w-full h-full">
<img :src="image" alt="Слайд-изображение"
class="w-full h-full объект-покрытие объект-центр переход-трансформация длительность-[5000мс] масштаб-100 наведение:масштаб-105">
</div>
</template>
</div>

<!-- Ручное управление -->
<button @click="prev()" class="absolute z-30 p-2 transform -translate-y-1/2 rounded-full top-1/2 left-4 bg-white/20 наведение:bg-white/40 backdrop-blur-sm">
<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
</svg>
</button>
<button @click="next()" class="absolute z-30 p-2 transform -translate-y-1/2 rounded-full top-1/2 right-4 bg-white/20 hover:bg-white/40 backdrop-blur-sm">
<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
</svg>
</button>

<!-- Призыв к действию -->
<div class="absolute inset-0 z-20 flex flex-col items-center justify-end pb-16">
<a href="#services" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"
class="inline-block px-8 py-4 text-lg font-semibold text-white transition-transform bg-yellow-600 shadow-lg rounded-xl hover:bg-yellow-700 hover:scale-105">
Изучите наши услуги
</a>
</div>
</section>
<!-- Скрипт AlpineJS -->
<script>
function carousel() {
return {
images: [
'{{ asset('images/wheaty.webp') }}',
'{{ asset('images/wheat_blue.webp') }}',
'{{ asset('images/wheat_marine.webp') }}',
'{{ asset('images/wheat_broker.webp') }}',
'{{ asset('images/wheat_one.webp') }}',
'{{ asset('images/wheat_two.webp') }}',
],
active: 0,
interval: null,
start() {
this.interval = setInterval(() => {
this.next();
}, 5000); // 5 секунд на слайд
},
next() {
this.active = (this.active + 1) % this.images.length;
},
prev() {
this.active = (this.active - 1 + this.images.length) % this.images.length;
}
};
}
</script>
<!-- О разделе -->
<section id="about" class="px-6 py-20 bg-white dark:bg-gray-900 lg:px-20">
<div class="max-w-5xl p-3 mx-auto text-center">
<h2 class="mb-6 text-3xl font-bold text-yellow-700 lg:text-4xl dark:text-yellow-500">
О Milestar
</h2>

<p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
<strong>Milestar Trade and Export Limited</strong> — зарегистрированная нигерийская компания с ограниченной ответственностью (ООО), специализирующаяся на брокерских операциях с пшеницей.
</p>

<p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
Наша миссия — сократить разрыв в поставках, способствуя бесперебойной торговле между <strong>российскими поставщиками пшеницы</strong> и <strong>нигерийскими покупателями</strong>, обеспечивая надежность, экономическую эффективность и бесперебойную логистику.
</p>

<p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
Поскольку спрос на пшеницу в Нигерии продолжает расти, а Россия является мировым лидером в производстве пшеницы, Milestar предоставляет надежный канал для эффективных, безопасных и прибыльных транзакций.
</p>

<p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
Используя прямые отношения с поставщиками, надежные финансовые системы и отраслевой опыт, мы снижаем риски и оптимизируем процесс торговли пшеницей для всех заинтересованных сторон.
</p>

<p class="text-lg text-gray-700 dark:text-gray-300">
Наша модель на основе комиссионных приносит процент за тонну проданной пшеницы, что выравнивает наш успех с успехом наших партнеров. Благодаря структурированным операциям, соблюдению требований и сети агентов по всей Нигерии Milestar позиционирует себя как крупного игрока на рынке импорта пшеницы в стране.
</p>
</div>
</section>
<!--Раздел услуг-->
<section id="services" class="py-20 bg-white dark:bg-gray-900">
<div class="max-w-screen-xl px-4 mx-auto lg:px-6">
<div class="max-w-screen-md mx-auto mb-16 text-center" data-aos="fade-down">
<h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
Наши услуги и ценностное предложение
</h2>
<p class="text-gray-500 sm:text-xl dark:text-gray-400">
Milestar Trade and Export Limited ликвидирует разрыв в торговле пшеницей между Россией и Нигерией. Наши услуги призваны обеспечивать эффективность, прозрачность и безопасность каждой транзакции.
</p>
</div>

<div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
@php
$services = [
['icon' => '🌾', 'title' => 'Брокерские услуги', 'desc' => 'Связь российских поставщиков пшеницы с нигерийскими покупателями, включая мукомольные предприятия, переработчиков и дистрибьюторов.'],
['icon' => '📄', 'title' => 'Содействие заключению контрактов', 'desc' => 'Структурирование торговых сделок, обеспечение конкурентоспособных цен и обеспечение соответствия международным нормам.'],
['icon' => '🚚', 'title' => 'Логистика и координация', 'desc' => 'Управление транспортировкой, финансовыми потоками и таможенным оформлением для бесперебойных импортных операций.'],
['icon' => '🛡️', 'title' => 'Снижение рисков', 'desc' => 'Внедрение правовых гарантий, таких как аккредитивы и неконвертируемые неразглашаемые данные, для защиты обеих сторон каждой транзакции.'],
['icon' => '💰', 'title' => 'Конкурентное ценообразование', 'desc' => 'Работая напрямую с поставщиками и исключая посредников, мы обеспечиваем более выгодные сделки для нигерийских покупателей.'],
['icon' => '📝', 'title' => 'Юридическая и финансовая безопасность', 'desc' => 'Соглашения о необходимости, неразглашении и структурированные контракты защищают всех заинтересованных лиц.'],
];
@endphp

@foreach ($services as $i => $service)
<div class="p-6 transition duration-500 transform border border-gray-200 group hover:-translate-y-2 hover:shadow-xl bg-white/80 dark:bg-gray-800/70 dark:border-gray-700 rounded-xl backdrop-blur-sm"
data-aos="fade-up"
data-aos-delay="{{ 100 * $i }}">
<div class="flex items-center justify-center w-12 h-12 mb-4 text-2xl bg-yellow-100 rounded-full dark:bg-yellow-900">
{{ $service['icon'] }}
</div>
<h3 class="mb-2 text-xl font-bold transition dark:text-white group-hover:text-yellow-700">
{{ $service['title'] }}
</h3>
<p class="text-gray-600 dark:text-gray-300">
{{ $service['desc'] }}
</p>
</div>
@endforeach
</div>
</div>
</section>
<!--Как это работает раздел-->
@push('head')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush
<section id="how-it-works" class="py-20 bg-[#FCFAF5] dark:bg-gray-800 px-6 lg:px-20">
<div class="max-w-5xl mx-auto text-center">
<h2 class="mb-6 text-3xl font-extrabold text-yellow-700 lg:text-4xl dark:text-yellow-400">
Как это работает
</h2>
<p class="max-w-2xl mx-auto mb-12 text-lg text-gray-600 dark:text-gray-300">
Наш брокерский процесс структурирован так, чтобы сделать торговлю пшеницей бесперебойной, прозрачной и безопасной как для покупателей, так и для поставщиков.
</p>

<!-- Индикатор выполнения -->
<div class="flex items-center justify-center mb-12 space-x-4 text-yellow-700 dark:text-yellow-400">
<div class="flex items-center space-x-2">
<span class="font-bold">Подключить</span>
<span>➡</span>
</div>
<div class="flex items-center space-x-2">
<span class="font-bold">Торговать</span>
<span>➡</span>
</div>
<span class="font-bold">Доставить</span>
</div>

<div class="grid grid-cols-1 gap-10 text-left md:grid-cols-3">
<!-- Шаг 1: Подключить -->
<div data-aos="fade-up" data-aos-delay="100" class="p-6 bg-white rounded-lg shadow dark:bg-gray-900">
<div class="mb-4 text-4xl text-yellow-700 dark:text-yellow-500">🔌</div>
<h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Подключиться</h3>
<p class="text-gray-600 dark:text-gray-300">
Мы привлекаем нигерийских покупателей и проверяем надежных российских поставщиков пшеницы, устанавливая безопасные и прямые каналы связи.
</p>
</div>

<!-- Шаг 2: Торговля -->
<div data-aos="fade-up" data-aos-delay="200" class="p-6 bg-white rounded-lg shadow dark:bg-gray-900">
<div class="mb-4 text-4xl text-yellow-700 dark:text-yellow-500">💼</div>
<h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Торговля</h3>
<p class="text-gray-600 dark:text-gray-300">
Мы занимаемся ценовыми переговорами, содействием в заключении контрактов, соблюдением требований и финансовыми механизмами, такими как аккредитивы (LC).
</p>
</div>

<!-- Шаг 3: Доставка -->
<div data-aos="fade-up" data-aos-delay="300" class="p-6 bg-white rounded-lg shadow dark:bg-gray-900">
<div class="mb-4 text-4xl text-yellow-700 dark:text-yellow-500">🚚</div>
<h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Доставка</h3>
<p class="text-gray-600 dark:text-gray-300">
Мы координируем доставку, документацию и таможенное оформление, обеспечивая бесперебойную доставку пшеницы от поставщика к покупателю.
</p>
</div>
</div>
</div>
</section>
<!-- CTA section -->
<section id="contact" class="px-6 py-20 bg-white dark:bg-gray-900 lg:px-20">
@if(session('success'))
<script>
// Основное модальное окно подтверждения
Swal.fire({
title: 'Сообщение отправлено!',
text: 'Мы свяжемся с вами в ближайшее время.',
icon: 'success',
showConfirmButton: true,
timer: 3500,
firmButtonText: 'Хорошо 👌',
}).then(() => {
// Уведомление появляется после того, как пользователь нажимает "Хорошо" или таймер заканчивается
Swal.fire({
toast: true,
position: 'top-end',
icon: 'success',
title: 'Сообщение отправлено!',
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
});
});
</script>
@endif
<div class="max-w-2xl mx-auto text-center">
<h2 class="mb-6 text-3xl font-extrabold text-yellow-700 lg:text-4xl dark:text-yellow-400">
Свяжитесь с нами
</h2>
<p class="mb-10 text-gray-600 dark:text-gray-300">
Мы будем рады связаться с вами. Если вы поставщик, покупатель или просто любопытный партнер — свяжитесь с нами сегодня.
</p>

<form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 text-left">
@csrf

<div>
<label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Полное имя</label>
<input type="text" name="name" id="name" required
class="w-full px-4 py-3 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-yellow-500 focus:border-yellow-500" />
</div>

<div>
<label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Электронная почта</label>
<input type="email" name="email" id="email" обязательно
class="w-full px-4 py-3 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-yellow-500 focus:border-yellow-500" />
</div>

<div>
<label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Сообщение</label>
<textarea name="message" id="message" rows="5" обязательно
class="w-full px-4 py-3 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-yellow-500 focus:border-yellow-500"></textarea>
</div>

<div class="text-center">
<button type="submit"
class="px-6 py-3 font-semibold text-white transition bg-yellow-600 rounded-md shadow-md hover:bg-yellow-700">
Отправить сообщение
</button>
</div>
</form>
</div>
</section>
<footer class="bg-white shadow-sm dark:bg-gray-900">
    <div class="w-full max-w-screen-xl p-4 mx-auto md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ url(request()->is('ru*') ? '/ru' : '/') }}" class="flex items-center mb-4 space-x-3 sm:mb-0 rtl:space-x-reverse">
                <img src="{{ asset('images/milestar_logo.jpg') }}" class="h-8" alt="Логотип Milestar" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Milestar</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li><a href="{{ url(request()->is('ru*') ? '/ru#about' : '/#about') }}" class="hover:underline me-4 md:me-6">О нас</a></li>
                <li><a href="{{ url(request()->is('ru*') ? '/ru#contact' : '/#contact') }}" class="hover:underline me-4 md:me-6">Контакты</a></li>
                <li>
                    <a href="{{ url(request()->is('ru*') ? '/ru/privacy' : '/privacy') }}" class="hover:underline me-4 md:me-6">
                        {{ request()->is('ru*') ? 'Политика конфиденциальности' : 'Privacy Policy' }}
                    </a>
                </li>
                <li>
                    <a href="{{ url(request()->is('ru*') ? '/ru/terms' : '/terms') }}" class="hover:underline me-4 md:me-6">
                        {{ request()->is('ru*') ? 'Условия и положения' : 'Terms and Conditions' }}
                    </a>
                </li>
                <li>
                    @include('components.lang-switch')
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © 2025 <a href="{{ url(request()->is('ru*') ? '/ru' : '/') }}" class="hover:underline">Milestar™</a>. Все права защищены.
        </span>
    </div>
</footer>




</div>

   <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                once: true,
            });
        </script>
         
      <script>
document.addEventListener("DOMContentLoaded", function () {
  const ship = document.getElementById("ship-container");

  // Get center of screen
  const centerX = window.innerWidth / 2 - 40; // 40 = half of ship width
  const centerY = window.innerHeight / 2 - 40;

  // Bobbing effect
  gsap.to(ship, {
    y: "-=5",
    rotation: 3,
    repeat: -1,
    yoyo: true,
    ease: "sine.inOut",
    duration: 1.5
  });

  // Centered gentle floating loop
  gsap.timeline({ repeat: -1, defaults: { ease: "sine.inOut", duration: 3 } })
    .to(ship, { x: centerX + 30, y: centerY - 10, rotation: 5 })
    .to(ship, { x: centerX + 30, y: centerY + 30, rotation: 10 })
    .to(ship, { x: centerX - 30, y: centerY + 30, rotation: -5 })
    .to(ship, { x: centerX - 30, y: centerY - 10, rotation: 0 });
});
</script>


          
          <script>
        const loaderContainer = document.querySelector('.loader-container');
        const pageContent = document.querySelector('#page-content');

        window.addEventListener('load', () => {
            loaderContainer.classList.add('hidden');
            pageContent.classList.add('visible');
        })
    </script>
    

    <!-- AOS Init -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>
</body>
</html>
