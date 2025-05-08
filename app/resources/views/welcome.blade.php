<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Milestar Trade</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    </head>
    <body class="scroll-smooth" >
        <header >        
            @if (Route::has('login'))

<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
      <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="{{ asset('images/milestar_logo.jpg') }}" class="h-8" alt="Milestar Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Milestar</span>
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            @auth

          <li>
            <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"  aria-current="page">Dashboard</a>

          </li>

          @else

          <li>
            <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
          </li>

          

            @if (Route::has('register'))

          <li>
            <a href="{{ route('register') }}" class="block px-3 py-2 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
          </li>

          
            @endif


        </ul>
      </div>
    </div>
  </nav>               
                    @endauth
  
            @endif
        </header>


         
<!-- Ship Container -->
  <div id="ship-container" class="fixed z-50" style="width: 80px; height: 80px;">
    <!-- Ripple effect -->
    <div class="absolute inset-0 flex items-center justify-center">
      <div class="ripple-ring"></div>
    </div>
    <!-- Ship image -->
    <img id="ship" src="{{ asset('images/ship.svg') }}" alt="Ship" style="width: 100%; height: 100%;">
  </div>

  <style>
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
  

        <!--Hero Section-->
        @push('head')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
@endpush

<section class="relative overflow-hidden h-[85vh] sm:h-[80vh] md:h-[90vh] lg:h-[95vh] xl:h-screen">
    <div id="hero-carousel" class="relative w-full h-full" data-carousel="slide">
        <!-- Carousel wrapper (no rounded corners) -->
        <div class="relative h-full overflow-hidden">
            <!-- Item 1 (active) -->
            <div class="h-full transition-opacity duration-700 ease-in-out opacity-100" data-carousel-item="active">
                <img src="{{ asset('images/wheaty.webp') }}" loading="eager" alt="Wheat field"
                     class="absolute top-0 left-0 object-cover object-center w-full h-full pointer-events-none">
            </div>
            <!-- Other Items -->
            @foreach ([
                'wheat_blue.png',
                'wheat_marine.png',
                'wheat_broker.png',
                'wheat_one.png',
                'wheat_two.png'
            ] as $image)
            <div class="hidden h-full transition-opacity duration-700 ease-in-out opacity-0" aria-hidden="true" data-carousel-item>
                <img src="{{ asset('images/' . $image) }}" loading="eager" alt="Wheat background"
                     class="absolute top-0 left-0 object-cover object-center w-full h-full pointer-events-none">
            </div>
            @endforeach
        </div>

        <!-- Carousel controls -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </span>
        </button>
    </div>

    <!-- CTA BUTTON -->
    <div class="absolute inset-0 z-10 flex flex-col items-center justify-end pb-16">
        <a href="#services"
           data-aos="zoom-in" data-aos-delay="300"
           class="inline-block px-8 py-4 text-lg font-semibold text-white transition-transform duration-300 transform bg-yellow-600 shadow-lg rounded-xl hover:bg-yellow-700 hover:scale-105">
            Explore Our Services
        </a>
    </div>
</section>

<!-- Autoplay Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll('[data-carousel-item]');
        let current = 0;

        function showNextSlide() {
            items[current].classList.add('opacity-0', 'hidden');
            current = (current + 1) % items.length;
            items[current].classList.remove('hidden');
            requestAnimationFrame(() => {
                items[current].classList.remove('opacity-0');
                items[current].classList.add('opacity-100');
            });
        }

        setInterval(showNextSlide, 7000);
    });
</script>


<!-- Autoplay Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll('[data-carousel-item]');
        let current = 0;
    
        function showNextSlide() {
            items[current].classList.add('opacity-0', 'hidden');
            current = (current + 1) % items.length;
            items[current].classList.remove('opacity-0', 'hidden');
            items[current].classList.add('opacity-100');
        }
    
        setInterval(showNextSlide, 7000);
    });
    </script>
    





@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ once: true, duration: 900 });</script>
@endpush

        
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
        <section id="contact" class="px-6 py-20 bg-gradient-to-br from-white via-yellow-50 to-white dark:from-gray-900 dark:to-gray-800 lg:px-20">
            @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Message Sent!',
                    text: 'We’ll be in touch shortly.',
                    icon: 'success',
                    showConfirmButton: true,
                    timer: 3500,
                    confirmButtonText: 'Okay 👌',
                }).then(() => {
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
        
            <div class="max-w-2xl mx-auto text-center" data-aos="fade-up">
                <h2 class="mb-6 text-4xl font-extrabold text-yellow-700 dark:text-yellow-400">
                    Get In Touch
                </h2>
                <p class="mb-10 text-gray-600 dark:text-gray-300">
                    We'd love to connect with you. Whether you're a supplier, buyer, or curious partner — reach out to us today.
                </p>
        
                <form action="{{ route('contact.submit') }}" method="POST" class="p-8 space-y-6 text-left border border-gray-200 shadow-xl bg-white/60 dark:bg-gray-900/60 backdrop-blur-lg rounded-2xl dark:border-gray-800" data-aos="zoom-in">
                    @csrf
        
                    <div class="relative group">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" name="name" id="name" required
                               class="w-full px-5 py-3 mt-1 text-sm text-gray-800 bg-white dark:bg-gray-800 dark:text-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-sm transition-all duration-200 focus:ring-2 focus:ring-yellow-500 focus:outline-none focus:scale-[1.02]" />
                    </div>
        
                    <div class="relative group">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-5 py-3 mt-1 text-sm text-gray-800 bg-white dark:bg-gray-800 dark:text-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-sm transition-all duration-200 focus:ring-2 focus:ring-yellow-500 focus:outline-none focus:scale-[1.02]" />
                    </div>
        
                    <div class="relative group">
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                        <textarea name="message" id="message" rows="5" required
                                  class="w-full px-5 py-3 mt-1 text-sm text-gray-800 bg-white dark:bg-gray-800 dark:text-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-sm transition-all duration-200 focus:ring-2 focus:ring-yellow-500 focus:outline-none focus:scale-[1.02]"></textarea>
                    </div>
        
                    <div class="pt-4 text-center">
                        <button type="submit"
                                class="inline-block px-6 py-3 font-semibold text-white transition-transform duration-300 transform bg-yellow-600 shadow-md rounded-xl hover:bg-yellow-700 hover:shadow-lg hover:scale-105">
                            🚀 Send Message
                        </button>
                    </div>
                </form>
            </div>
        </section>
        



        

<footer class="bg-white shadow-sm dark:bg-gray-900">
    <div class="w-full max-w-screen-xl p-4 mx-auto md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="#" class="flex items-center mb-4 space-x-3 sm:mb-0 rtl:space-x-reverse">
                <img src="{{ asset('./images/milestar_logo.jpg') }}" class="h-8" alt="Milestar Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Milestar</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="#" class="hover:underline">Milestar™</a>. All Rights Reserved.</span>
    </div>
</footer>


        
        
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
          
              // Bobbing animation
              gsap.to("#ship-container", {
                y: "-=15",
                rotation: 3,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                duration: 2
                });

                
          
              // Sailing around the screen
              const screenWidth = window.innerWidth;
              const screenHeight = window.innerHeight;
          
              gsap.timeline({ repeat: -1, defaults: { ease: "power1.inOut" } })
                .to(ship, { x: screenWidth - 100, y: 50, duration: 6, rotation: 5 })
                .to(ship, { x: screenWidth - 100, y: screenHeight - 100, duration: 6, rotation: 10 })
                .to(ship, { x: 0, y: screenHeight - 80, duration: 6, rotation: -5 })
                .to(ship, { x: 0, y: 0, duration: 6, rotation: 0 });
          
              // Optional: smaller scale on mobile
              if (screenWidth < 768) {
                ship.style.transform = "scale(0.75)";
              }
            });
          </script>
          
        
    </body>
</html>
