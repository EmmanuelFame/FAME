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
        body {
  overflow: hidden;
}

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


       <!-- Hero Section -->
        <section x-data="carousel()" x-init="start()" class="relative overflow-hidden h-[85vh] sm:h-[80vh] md:h-[90vh] lg:h-[95vh] xl:h-screen">
            <div class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-t from-black/60 to-transparent"></div>

            <!-- Images -->
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
                        <img :src="image" alt="Slide image"
                            class="w-full h-full object-cover object-center transition-transform duration-[5000ms] scale-100 hover:scale-105">
                    </div>
                </template>
            </div>

            <!-- Manual Controls -->
            <button @click="prev()" class="absolute z-30 p-2 transform -translate-y-1/2 rounded-full top-1/2 left-4 bg-white/20 hover:bg-white/40 backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="next()" class="absolute z-30 p-2 transform -translate-y-1/2 rounded-full top-1/2 right-4 bg-white/20 hover:bg-white/40 backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Call to Action -->
            <div class="absolute inset-0 z-20 flex flex-col items-center justify-end pb-16">
                <a href="#services" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"
                class="inline-block px-8 py-4 text-lg font-semibold text-white transition-transform bg-yellow-600 shadow-lg rounded-xl hover:bg-yellow-700 hover:scale-105">
                    Explore Our Services
                </a>
            </div>
        </section>

        <!-- AlpineJS Script -->
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
                        }, 5000); // 5 seconds per slide
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
         <!-- About section -->
         <section id="about" class="px-6 py-20 bg-white dark:bg-gray-900 lg:px-20">
            <div class="max-w-5xl p-3 mx-auto text-center">
                <h2 class="mb-6 text-3xl font-bold text-yellow-700 lg:text-4xl dark:text-yellow-500">
                    About Milestar
                </h2>
        
                <p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
                    <strong>Milestar Trade and Export Limited</strong> is a registered Nigerian Limited Liability Company (LLC) specializing in wheat brokerage.
                </p>
        
                <p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
                    Our mission is to bridge the supply gap by facilitating seamless trade between <strong>Russian wheat suppliers</strong> and <strong>Nigerian buyers</strong>, ensuring reliability, cost-effectiveness, and smooth logistics.
                </p>
        
                <p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
                    As Nigeria's demand for wheat continues to rise, and with Russia's global leadership in wheat production, Milestar provides a trusted channel for efficient, secure, and profitable transactions.
                </p>
        
                <p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
                    By leveraging direct supplier relationships, robust financial systems, and industry expertise, we reduce risks and streamline the wheat trade process for all stakeholders.
                </p>
        
                <p class="text-lg text-gray-700 dark:text-gray-300">
                    Our commission-based model earns a percentage per ton of wheat traded, aligning our success with that of our partners. With structured operations, compliance, and a network of agents across Nigeria, Milestar is positioned to become a major player in the nation’s wheat import market.
                </p>
            </div>
        </section>
        <!--Service Section-->
        <section id="services" class="py-20 bg-white dark:bg-gray-900">
            <div class="max-w-screen-xl px-4 mx-auto lg:px-6">
                <div class="max-w-screen-md mx-auto mb-16 text-center" data-aos="fade-down">
                    <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        Our Services & Value Proposition
                    </h2>
                    <p class="text-gray-500 sm:text-xl dark:text-gray-400">
                        Milestar Trade and Export Limited bridges the wheat trade gap between Russia and Nigeria. Our services are designed to deliver efficiency, transparency, and security across every transaction.
                    </p>
                </div>
        
                <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                    @php
                        $services = [
                            ['icon' => '🌾', 'title' => 'Brokerage Services', 'desc' => 'Connecting Russian wheat suppliers with Nigerian buyers including flour mills, processors, and distributors.'],
                            ['icon' => '📄', 'title' => 'Contract Facilitation', 'desc' => 'Structuring trade deals, securing competitive pricing, and ensuring compliance with international regulations.'],
                            ['icon' => '🚚', 'title' => 'Logistics & Coordination', 'desc' => 'Managing transportation, financial flows, and customs clearance for smooth import operations.'],
                            ['icon' => '🛡️', 'title' => 'Risk Mitigation', 'desc' => 'Implementing legal safeguards such as LCs and NCNDAs to secure both sides of every transaction.'],
                            ['icon' => '💰', 'title' => 'Competitive Pricing', 'desc' => 'By working directly with suppliers and eliminating middlemen, we ensure better deals for Nigerian buyers.'],
                            ['icon' => '📝', 'title' => 'Legal & Financial Security', 'desc' => 'Non-Circumvention, Non-Disclosure Agreements and structured contracts protect all stakeholders.'],
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
        <!--How it works section-->
        @push('head')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        @endpush
    
        <section id="how-it-works" class="py-20 bg-[#FCFAF5] dark:bg-gray-800 px-6 lg:px-20">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="mb-6 text-3xl font-extrabold text-yellow-700 lg:text-4xl dark:text-yellow-400">
                    How It Works
                </h2>
                <p class="max-w-2xl mx-auto mb-12 text-lg text-gray-600 dark:text-gray-300">
                    Our brokerage process is structured to make wheat trade seamless, transparent, and secure for both buyers and suppliers.
                </p>
        
                <!-- Progress Bar -->
                <div class="flex items-center justify-center mb-12 space-x-4 text-yellow-700 dark:text-yellow-400">
                    <div class="flex items-center space-x-2">
                        <span class="font-bold">Connect</span>
                        <span>➡</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="font-bold">Trade</span>
                        <span>➡</span>
                    </div>
                    <span class="font-bold">Deliver</span>
                </div>
        
                <div class="grid grid-cols-1 gap-10 text-left md:grid-cols-3">
                    <!-- Step 1: Connect -->
                    <div data-aos="fade-up" data-aos-delay="100" class="p-6 bg-white rounded-lg shadow dark:bg-gray-900">
                        <div class="mb-4 text-4xl text-yellow-700 dark:text-yellow-500">🔌</div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Connect</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            We onboard Nigerian buyers and verify reliable Russian wheat suppliers, establishing secure and direct communication channels.
                        </p>
                    </div>
        
                    <!-- Step 2: Trade -->
                    <div data-aos="fade-up" data-aos-delay="200" class="p-6 bg-white rounded-lg shadow dark:bg-gray-900">
                        <div class="mb-4 text-4xl text-yellow-700 dark:text-yellow-500">💼</div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Trade</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            We handle price negotiation, contract facilitation, compliance, and financial mechanisms like Letters of Credit (LCs).
                        </p>
                    </div>
        
                    <!-- Step 3: Deliver -->
                    <div data-aos="fade-up" data-aos-delay="300" class="p-6 bg-white rounded-lg shadow dark:bg-gray-900">
                        <div class="mb-4 text-4xl text-yellow-700 dark:text-yellow-500">🚚</div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Deliver</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            We coordinate shipping, documentation, and customs clearance, ensuring smooth delivery of wheat from supplier to buyer.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA section -->
        <section id="contact" class="px-6 py-20 bg-white dark:bg-gray-900 lg:px-20">
            @if(session('success'))
            <script>
                // Primary confirmation modal
                Swal.fire({
                    title: 'Message Sent!',
                    text: 'We’ll be in touch shortly.',
                    icon: 'success',
                    showConfirmButton: true,
                    timer: 3500,
                    confirmButtonText: 'Okay 👌',
                }).then(() => {
                    // Toast comes after user clicks "Okay" or timer ends
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Message sent!',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                });
            </script>
            @endif
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="mb-6 text-3xl font-extrabold text-yellow-700 lg:text-4xl dark:text-yellow-400">
                    Get In Touch
                </h2>
                <p class="mb-10 text-gray-600 dark:text-gray-300">
                    We'd love to connect with you. Whether you're a supplier, buyer, or curious partner — reach out to us today.
                </p>
        
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 text-left">
                    @csrf
        
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" name="name" id="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-yellow-500 focus:border-yellow-500" />
                    </div>
        
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-yellow-500 focus:border-yellow-500" />
                    </div>
        
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                        <textarea name="message" id="message" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-yellow-500 focus:border-yellow-500"></textarea>
                    </div>
        
                    <div class="text-center">
                        <button type="submit"
                                class="px-6 py-3 font-semibold text-white transition bg-yellow-600 rounded-md shadow-md hover:bg-yellow-700">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </section>


        <footer class="bg-white shadow-sm dark:bg-gray-900">
            <div class="w-full max-w-screen-xl p-4 mx-auto md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href="{{ url('/') }}" class="flex items-center mb-4 space-x-3 sm:mb-0 rtl:space-x-reverse">
                        <img src="{{ asset('images/milestar_logo.jpg') }}" class="h-8" alt="Milestar Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Milestar</span>
                    </a>
                    <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                        <li><a href="#about" class="hover:underline me-4 md:me-6">About</a></li>
                        <li><a href="#contact" class="hover:underline me-4 md:me-6">Contact</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:underline me-4 md:me-6">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:underline me-4 md:me-6">Terms & Conditions</a></li>
                    </ul>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
                    © 2025 <a href="{{ url('/') }}" class="hover:underline">Milestar™</a>. All rights reserved.
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

  // Define your safe animation box
  const floatBox = {
    xMin: window.innerWidth - 200, // 200px from left edge (near bottom-right)
    xMax: window.innerWidth - 100, // stays within 100px horizontally
    yMin: window.innerHeight - 200,
    yMax: window.innerHeight - 100
  };

  // Bobbing animation
  gsap.to(ship, {
    y: "-=10",
    rotation: 3,
    repeat: -1,
    yoyo: true,
    ease: "sine.inOut",
    duration: 2
  });

  // Constrained sailing animation (small loop)
  gsap.timeline({ repeat: -1, defaults: { ease: "sine.inOut", duration: 4 } })
    .to(ship, { x: floatBox.xMax, y: floatBox.yMin, rotation: 5 })
    .to(ship, { x: floatBox.xMax, y: floatBox.yMax, rotation: 10 })
    .to(ship, { x: floatBox.xMin, y: floatBox.yMax, rotation: -5 })
    .to(ship, { x: floatBox.xMin, y: floatBox.yMin, rotation: 0 });

  // Optional: smaller on mobile
  if (window.innerWidth < 768) {
    ship.style.transform = "scale(0.75)";
  }
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
