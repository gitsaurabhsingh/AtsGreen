<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', enquiryModalOpen: false, enquiryProjectName: '', captchaInput: '', isSubmitting: false, formErrors: {} }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" @open-enquiry.window="enquiryModalOpen = true; enquiryProjectName = $event.detail?.projectName || 'General Enquiry'; captchaInput = ''; formErrors = {};" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Premium Real Estate') | ATS Greens & ATS Homekraft</title>
    <meta name="description" content="@yield('meta_description', 'ATS Greens and ATS Homekraft offer premium luxury real estate, apartments, and commercial properties redefining modern living.')">
    <meta name="keywords" content="@yield('meta_keywords', 'ATS Greens, ATS Homekraft, luxury apartments, real estate, commercial properties, buy flat')">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Premium Real Estate') | ATS Greens">
    <meta property="og:description" content="@yield('meta_description', 'ATS Greens and ATS Homekraft offer premium luxury real estate, apartments, and commercial properties redefining modern living.')">
    <meta property="og:image" content="{{ asset('favicon.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Premium Real Estate') | ATS Greens">
    <meta property="twitter:description" content="@yield('meta_description', 'ATS Greens and ATS Homekraft offer premium luxury real estate, apartments, and commercial properties redefining modern living.')">
    <meta property="twitter:image" content="{{ asset('favicon.png') }}">

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <!-- Fonts Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|outfit:300,400,500,600,700,900|playfair-display:400,500,600,700,800" rel="stylesheet" />
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        brand: {
                            light: '#1f3d2d',
                            DEFAULT: '#0a2214', // Ultra deep luxury emerald/black
                            dark: '#030c07',
                            accent: '#D4AF37', // Premium Gold
                            accentLight: '#f3e5ab' // Light gold/champagne
                        }
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Advanced Animations */
        @keyframes kenBurns {
            0% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.15) translate(-1%, -1%); }
            100% { transform: scale(1) translate(0, 0); }
        }
        .hero-bg-zoom {
            animation: kenBurns 30s ease-in-out infinite;
        }
        @keyframes scrollBounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        .animate-scroll-bounce {
            animation: scrollBounce 2s infinite;
        }

        .glass-nav {
            background: rgba(10, 34, 20, 0.85); /* Deep emerald transparent */
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1); /* Gold subtle border */
        }
        .dark .glass-nav {
            background: rgba(3, 12, 7, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .hero-overlay {
            background: linear-gradient(to bottom, rgba(3, 12, 7, 0.4) 0%, rgba(3, 12, 7, 0.8) 100%);
        }
        .dark .hero-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.95) 100%);
        }
        .brand-gradient {
            background: linear-gradient(rgba(10, 34, 20, 0.7), rgba(3, 12, 7, 0.95)), url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center/cover;
        }
        
        /* Custom Scrollbar for premium feel */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        .dark ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #b5952f; }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-[#fdfbf7] dark:bg-[#050505] dark:text-gray-200 transition-colors duration-500 overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] transform" 
         x-data="{ mobileMenuOpen: false, scrolled: false, isLoaded: false }" 
         x-init="setTimeout(() => isLoaded = true, 50)"
         @scroll.window="scrolled = (window.pageYOffset > 50)"
         :class="{ 
            'glass-nav py-3 shadow-[0_8px_32px_rgba(0,0,0,0.25)] translate-y-0 opacity-100': scrolled && isLoaded, 
            'bg-gradient-to-b from-black/80 via-black/40 to-transparent py-8 translate-y-0 opacity-100': !scrolled && isLoaded,
            '-translate-y-full opacity-0': !isLoaded 
         }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-500" :class="{ 'h-16': scrolled, 'h-20': !scrolled }">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="transition-transform duration-700 ease-out hover:scale-105 flex items-center origin-left" aria-label="Home">
                        @if(isset($siteSetting) && $siteSetting->header_logo)
                            <img src="{{ $siteSetting->header_logo }}" alt="ATS Logo" width="150" height="60" class="h-16 md:h-20 lg:h-24 w-auto object-contain transition-all duration-700 ease-out drop-shadow-2xl filter hover:brightness-110">
                        @else
                            <span class="font-heading font-black tracking-tighter text-white transition-all duration-700 ease-out drop-shadow-[0_2px_10px_rgba(212,175,55,0.3)]" :class="{ 'text-3xl': scrolled, 'text-5xl': !scrolled }">ATS<span class="text-brand-accent">.</span></span>
                        @endif
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 lg:space-x-10" :class="{ 'opacity-100 translate-y-0': isLoaded, 'opacity-0 translate-y-4': !isLoaded }" style="transition: all 1s cubic-bezier(0.25,1,0.5,1) 0.3s;">
                    <a href="/" class="relative group text-[13px] font-heading font-semibold text-gray-200 hover:text-white transition-colors duration-300 tracking-[0.2em] uppercase hover:text-shadow-glow">
                        Home
                        <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-brand-accent transition-all duration-500 ease-out group-hover:w-full group-hover:shadow-[0_0_10px_rgba(212,175,55,0.8)]"></span>
                    </a>
                    <a href="{{ route('frontend.about') }}" class="relative group text-[13px] font-heading font-semibold text-gray-200 hover:text-white transition-colors duration-300 tracking-[0.2em] uppercase hover:text-shadow-glow">
                        About Us
                        <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-brand-accent transition-all duration-500 ease-out group-hover:w-full group-hover:shadow-[0_0_10px_rgba(212,175,55,0.8)]"></span>
                    </a>
                    
                    <!-- Dynamic Brands -->
                    @php
                        $globalProjectTypes = \App\Models\ProjectType::where('status', 1)->pluck('name');
                    @endphp
                    @if(isset($brands))
                        @foreach($brands as $navBrand)
                            <div class="relative group">
                                <a href="{{ route('frontend.dynamic', $navBrand->slug) }}" class="inline-flex items-center gap-1.5 text-[13px] font-heading font-semibold text-gray-200 hover:text-white transition-colors duration-300 tracking-[0.2em] uppercase hover:text-shadow-glow">
                                    {{ $navBrand->name }}
                                    @if($globalProjectTypes->count() > 0)
                                    <svg class="w-3.5 h-3.5 text-brand-accent group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    @endif
                                    <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-brand-accent transition-all duration-500 ease-out group-hover:w-full group-hover:shadow-[0_0_10px_rgba(212,175,55,0.8)]"></span>
                                </a>
                                @if($globalProjectTypes->count() > 0)
                                    <div class="absolute left-1/2 -translate-x-1/2 top-full mt-4 w-56 bg-brand-dark/95 backdrop-blur-xl rounded-lg shadow-[0_10px_40px_rgba(0,0,0,0.5)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-brand-accent/30 overflow-hidden z-[100] py-2 transform origin-top scale-95 group-hover:scale-100">
                                        <!-- Decorative top border -->
                                        <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-brand-accent to-transparent opacity-70"></div>
                                        
                                        @foreach($globalProjectTypes as $type)
                                            <a href="{{ route('frontend.dynamic.type', ['slug' => $navBrand->slug, 'type' => strtolower($type)]) }}" class="flex items-center gap-3 px-5 py-3 text-xs tracking-[0.15em] uppercase text-gray-300 hover:bg-white/5 hover:text-brand-accent transition-all duration-300 group/item">
                                                <svg class="w-4 h-4 text-brand-accent/70 group-hover/item:text-brand-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if(stripos($type, 'commercial') !== false || stripos($type, 'retail') !== false)
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-3 4H2v-2h5v2zm9-2h-3v2h3v-2z"></path>
                                                    @elseif(stripos($type, 'plot') !== false || stripos($type, 'land') !== false)
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                    @endif
                                                </svg>
                                                <span class="transform group-hover/item:translate-x-1 transition-transform duration-300 font-medium">{{ $type }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    
                    <a href="{{ route('frontend.contact') }}" class="relative group text-[13px] font-heading font-semibold text-gray-200 hover:text-white transition-colors duration-300 tracking-[0.2em] uppercase hover:text-shadow-glow">
                        Contact
                        <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-brand-accent transition-all duration-500 ease-out group-hover:w-full group-hover:shadow-[0_0_10px_rgba(212,175,55,0.8)]"></span>
                    </a>
                    
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode" class="text-brand-accent/80 hover:text-brand-accent transition-all p-2 rounded-full border border-transparent hover:border-brand-accent/40 ml-2 focus:outline-none transform hover:scale-110 hover:shadow-[0_0_15px_rgba(212,175,55,0.4)] duration-500 ease-out bg-black/10 backdrop-blur-sm" aria-label="Toggle Dark Mode">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" x-cloak style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>

                    <a href="#" @click.prevent="$dispatch('open-enquiry', { projectName: 'ATS Real Estate' })" class="ml-4 relative overflow-hidden group inline-flex items-center justify-center px-8 py-3 border border-brand-accent/80 text-[13px] font-heading font-semibold text-white transition duration-500 ease-out tracking-[0.2em] uppercase rounded-sm hover:border-brand-accent hover:shadow-[0_0_20px_rgba(212,175,55,0.5)] bg-black/20 backdrop-blur-sm">
                        <span class="absolute inset-0 w-0 bg-brand-accent transition-all duration-700 ease-out group-hover:w-full opacity-20"></span>
                        <span class="relative group-hover:text-brand-accent transition-colors duration-500">Enquire Now</span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="darkMode = !darkMode" class="text-brand-accent mr-4 focus:outline-none p-2" aria-label="Toggle Dark Mode Mobile">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" x-cloak style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-brand-accent focus:outline-none transition-colors" aria-label="Toggle Mobile Menu">
                        <svg class="h-8 w-8" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-8 w-8" x-show="mobileMenuOpen" x-cloak style="display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Backdrop -->
        <div x-show="mobileMenuOpen" 
             @click="mobileMenuOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="md:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[55]" 
             x-cloak style="display: none;"></div>

        <!-- Mobile Menu Sidebar -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             x-cloak style="display: none;" 
             class="md:hidden glass-nav fixed top-0 right-0 w-[80%] max-w-sm h-screen shadow-2xl border-l border-white/10 flex flex-col pt-20 z-[60] overflow-y-auto">
            
            <!-- Close Button -->
            <button @click="mobileMenuOpen = false" class="absolute top-5 right-5 text-white hover:text-brand-accent p-2 focus:outline-none transition-colors rounded-full bg-white/5 border border-white/10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="px-6 pt-4 pb-8 space-y-4">
                <a href="/" class="block text-sm font-medium tracking-[0.15em] uppercase text-white hover:text-brand-accent border-b border-white/5 pb-2 transition-colors">Home</a>
                <a href="{{ route('frontend.about') }}" class="block text-sm font-medium tracking-[0.15em] uppercase text-white hover:text-brand-accent border-b border-white/5 pb-2 transition-colors">About Us</a>
                <!-- Dynamic Brands -->
                @if(isset($brands))
                    @foreach($brands as $navBrand)
                        <div x-data="{ open: false }" class="border-b border-white/5 pb-2">
                            <div class="flex justify-between items-center">
                                <a href="{{ route('frontend.dynamic', $navBrand->slug) }}" class="block text-sm font-medium tracking-[0.15em] uppercase text-white hover:text-brand-accent transition-colors">{{ $navBrand->name }}</a>
                                @if($globalProjectTypes->count() > 0)
                                    <button @click="open = !open" class="text-white hover:text-brand-accent p-1 focus:outline-none">
                                        <svg class="w-4 h-4 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                @endif
                            </div>
                            @if($globalProjectTypes->count() > 0)
                                <div x-show="open" x-collapse class="pl-4 mt-3 mb-2 space-y-1 border-l border-brand-accent/20 ml-2">
                                    @foreach($globalProjectTypes as $type)
                                        <a href="{{ route('frontend.dynamic.type', ['slug' => $navBrand->slug, 'type' => strtolower($type)]) }}" class="flex items-center gap-3 py-2 text-sm font-light tracking-[0.1em] uppercase text-gray-400 hover:text-brand-accent transition-colors pl-2">
                                            <svg class="w-3.5 h-3.5 text-brand-accent/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if(stripos($type, 'commercial') !== false || stripos($type, 'retail') !== false)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-3 4H2v-2h5v2zm9-2h-3v2h3v-2z"></path>
                                                @elseif(stripos($type, 'plot') !== false || stripos($type, 'land') !== false)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                @endif
                                            </svg>
                                            {{ $type }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif

                <a href="{{ route('frontend.contact') }}" class="block text-sm font-medium tracking-[0.15em] uppercase text-white hover:text-brand-accent border-b border-white/5 pb-2 transition-colors">Contact</a>
                <a href="#" @click.prevent="$dispatch('open-enquiry', { projectName: 'ATS Real Estate' }); mobileMenuOpen = false" class="inline-block mt-4 text-center w-full px-6 py-4 border border-brand-accent text-xs font-bold tracking-[0.2em] uppercase text-brand-accent hover:bg-brand-accent hover:text-brand-dark transition-colors">Enquire Now</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contact" class="bg-brand-dark text-white pt-24 pb-12 border-t border-brand-accent/20 relative overflow-hidden">
        <!-- Subtle background glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent opacity-50"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-brand-accent/5 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-12 gap-y-16 mb-20">
                <!-- Brand Column -->
                <div class="col-span-1 lg:col-span-1 pr-4">
                    @if(isset($siteSetting) && $siteSetting->footer_logo)
                        <a href="/" class="mb-4 block hover:opacity-80 transition-opacity -mt-10">
                            <img src="{{ $siteSetting->footer_logo }}" alt="Footer Logo" class="h-20 object-contain object-left">
                        </a>
                    @else
                        <a href="/" class="font-heading font-black text-4xl tracking-tighter text-white mb-8 block hover:text-brand-accent transition-colors">ATS<span class="text-brand-accent">.</span></a>
                    @endif
                    <p class="text-gray-400 text-sm leading-loose mb-10 font-light tracking-wide text-justify">
                        {{ isset($siteSetting) && $siteSetting->footer_description ? $siteSetting->footer_description : 'Redefining luxury living. Building trust through unparalleled quality, transparency, and architectural brilliance.' }}
                    </p>
                    <div class="flex space-x-5">
                        <!-- Facebook -->
                        @if(isset($siteSetting) && $siteSetting->social_facebook)
                        <a href="{{ $siteSetting->social_facebook }}" target="_blank" aria-label="Facebook" class="w-11 h-11 rounded border border-white/10 flex items-center justify-center hover:border-brand-accent transition-all duration-500 hover:-translate-y-1 hover:bg-brand-accent/5 hover:shadow-[0_0_15px_rgba(212,175,55,0.2)] group">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-accent transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        @endif
                        <!-- YouTube -->
                        @if(isset($siteSetting) && $siteSetting->social_youtube)
                        <a href="{{ $siteSetting->social_youtube }}" target="_blank" aria-label="YouTube" class="w-11 h-11 rounded border border-white/10 flex items-center justify-center hover:border-brand-accent transition-all duration-500 hover:-translate-y-1 hover:bg-brand-accent/5 hover:shadow-[0_0_15px_rgba(212,175,55,0.2)] group">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-accent transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>
                        @endif
                        <!-- Instagram -->
                        @if(isset($siteSetting) && $siteSetting->social_instagram)
                        <a href="{{ $siteSetting->social_instagram }}" target="_blank" aria-label="Instagram" class="w-11 h-11 rounded border border-white/10 flex items-center justify-center hover:border-brand-accent transition-all duration-500 hover:-translate-y-1 hover:bg-brand-accent/5 hover:shadow-[0_0_15px_rgba(212,175,55,0.2)] group">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-accent transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-xs font-bold mb-8 font-heading tracking-[0.25em] uppercase text-white flex items-center gap-4">
                        <span class="w-8 h-[1px] bg-brand-accent/50"></span>
                        Portfolio
                    </h4>
                    <ul class="space-y-5 text-sm text-gray-400 font-light tracking-wide">
                        @if(isset($brands))
                            @foreach($brands as $navBrand)
                                <li><a href="{{ route('frontend.dynamic', $navBrand->slug) }}" class="hover:text-brand-accent hover:translate-x-2 transition-all duration-300 inline-block flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-brand-accent/0 group-hover:bg-brand-accent transition-colors"></span>{{ $navBrand->name }}</a></li>
                            @endforeach
                        @endif
                        <li><a href="/#projects" class="hover:text-brand-accent hover:translate-x-2 transition-all duration-300 inline-block flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-brand-accent/0 group-hover:bg-brand-accent transition-colors"></span>All Projects</a></li>
                        <li><a href="{{ route('frontend.blogs') }}" class="hover:text-brand-accent hover:translate-x-2 transition-all duration-300 inline-block flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-brand-accent/0 group-hover:bg-brand-accent transition-colors"></span>Blog</a></li>
                        <li><a href="{{ url('sitemap.xml') }}" class="hover:text-brand-accent hover:translate-x-2 transition-all duration-300 inline-block flex items-center gap-2 group" target="_blank"><span class="w-1.5 h-1.5 rounded-full bg-brand-accent/0 group-hover:bg-brand-accent transition-colors"></span>Sitemap</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-xs font-bold mb-8 font-heading tracking-[0.25em] uppercase text-white flex items-center gap-4">
                        <span class="w-8 h-[1px] bg-brand-accent/50"></span>
                        Contact
                    </h4>
                    <ul class="space-y-6 text-sm text-gray-400 font-light tracking-wide">
                        <li class="flex items-start group cursor-pointer">
                            <div class="p-2 border border-white/10 rounded mr-4 group-hover:border-brand-accent transition-colors">
                                <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <span class="group-hover:text-white transition-colors mt-1">{{ isset($siteSetting) && $siteSetting->footer_phone ? $siteSetting->footer_phone : '+91 98765 43210' }}</span>
                        </li>
                        <li class="flex items-start group cursor-pointer">
                            <div class="p-2 border border-white/10 rounded mr-4 group-hover:border-brand-accent transition-colors">
                                <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="group-hover:text-white transition-colors mt-1">{{ isset($siteSetting) && $siteSetting->footer_email ? $siteSetting->footer_email : 'luxury@ats-greens.co.in' }}</span>
                        </li>
                        <li class="flex items-start group cursor-pointer">
                            <div class="p-2 border border-white/10 rounded mr-4 group-hover:border-brand-accent transition-colors mt-1">
                                <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="group-hover:text-white transition-colors mt-1 leading-relaxed">{!! isset($siteSetting) && $siteSetting->footer_address ? nl2br(e($siteSetting->footer_address)) : 'ATS Tower, Sector 135,<br/>Noida, UP 201305' !!}</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-span-1 lg:col-span-1">
                    <h4 class="text-xs font-bold mb-8 font-heading tracking-[0.25em] uppercase text-white flex items-center gap-4">
                        <span class="w-8 h-[1px] bg-brand-accent/50"></span>
                        Exclusive
                    </h4>
                    <p class="text-gray-400 text-sm mb-8 font-light tracking-wide leading-relaxed text-justify">Subscribe to receive exclusive access to new launches and premium offers before anyone else.</p>
                    <form class="flex flex-col gap-5" x-data="{ email: '', isSubmitting: false, message: '', error: '' }" @submit.prevent="
                        isSubmitting = true; message = ''; error = '';
                        fetch('{{ route('frontend.subscribe') }}', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ email: email })
                        }).then(res => res.json()).then(data => {
                            isSubmitting = false;
                            if(data.success) { message = data.message; email = ''; }
                            else { error = data.errors ? Object.values(data.errors)[0][0] : data.message; }
                        }).catch(() => { isSubmitting = false; error = 'An error occurred. Please try again.'; });
                    ">
                        <div class="relative">
                            <input type="email" x-model="email" required placeholder="Your email address" class="w-full bg-transparent border-b border-white/20 px-0 py-3 text-sm text-white focus:outline-none focus:border-brand-accent transition-colors placeholder-gray-500">
                        </div>
                        <button type="submit" :disabled="isSubmitting" class="w-full bg-brand-accent text-brand-dark font-bold uppercase tracking-widest text-xs py-4 hover:bg-white transition-all duration-300 disabled:opacity-50 flex justify-between items-center px-6 group rounded-sm">
                            <span x-text="isSubmitting ? 'Subscribing...' : 'Subscribe'"></span>
                            <svg x-show="!isSubmitting" class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                        <p x-show="message" x-text="message" class="text-brand-accent text-xs" style="display: none;"></p>
                        <p x-show="error" x-text="error" class="text-red-400 text-xs" style="display: none;"></p>
                    </form>
                </div>
            </div>                
            
            <!-- Bottom Bar -->
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-[10px] text-gray-500 tracking-[0.2em] uppercase font-bold">
                <p>&copy; {{ date('Y') }} ATS Real Estate. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                </div>
            </div>
        </div>
    </footer>
    <!-- Enquiry Modal (Global) -->
    <div x-show="enquiryModalOpen" 
         x-transition.opacity.duration.300ms
         x-cloak 
         style="display: none;"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-black/60 backdrop-blur-sm">
        
        <div @click.away="enquiryModalOpen = false" 
             x-show="enquiryModalOpen"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl w-full max-w-md overflow-hidden relative border border-gray-100 dark:border-gray-800">
            
            <!-- Modal Header -->
            <div class="bg-brand-dark p-5 sm:p-6 text-center relative">
                <button @click="enquiryModalOpen = false" class="absolute top-4 right-4 text-white/50 hover:text-white transition focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <span class="text-brand-accent text-[10px] font-bold uppercase tracking-widest block mb-1">Register Interest</span>
                <h3 class="text-xl font-heading font-black text-white" x-text="enquiryProjectName"></h3>
            </div>

            <!-- Modal Body -->
            <div class="p-5 sm:p-6">
                <form class="space-y-3" @submit.prevent="isSubmitting = true; formErrors = {}; fetch('{{ route('frontend.enquire') }}', { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ name: $refs.name.value, email: $refs.email.value, phone: $refs.countryCode.value + ' ' + $refs.phone.value, project_name: enquiryProjectName, captcha: captchaInput }) }).then(res => res.json()).then(data => { if(data.message && data.success) { enquiryModalOpen = false; alert(data.message); $refs.name.value=''; $refs.email.value=''; $refs.phone.value=''; captchaInput=''; document.getElementById('captchaImg').src='{{ captcha_src('flat') }}'+Math.random(); } else { formErrors = data.errors || {}; if(data.message && !data.errors) alert(data.message); document.getElementById('captchaImg').src='{{ captcha_src('flat') }}'+Math.random(); captchaInput=''; } }).catch(err => alert('An error occurred. Please try again.')).finally(() => isSubmitting = false)">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Full Name</label>
                        <input type="text" x-ref="name" required class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition">
                        <template x-if="formErrors.name"><p class="text-red-500 text-xs mt-1" x-text="formErrors.name[0]"></p></template>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Email Address</label>
                        <input type="email" x-ref="email" required class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition">
                        <template x-if="formErrors.email"><p class="text-red-500 text-xs mt-1" x-text="formErrors.email[0]"></p></template>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Phone Number</label>
                        <div class="flex">
                            <select x-ref="countryCode" class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 border-r-0 rounded-l-lg px-2 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition w-24">
                                <option value="+91">+91 (IN)</option>
                                <option value="+92">+92 (PK)</option>
                                <option value="+1">+1 (US)</option>
                                <option value="+44">+44 (UK)</option>
                                <option value="+971">+971 (UAE)</option>
                                <option value="+61">+61 (AU)</option>
                            </select>
                            <input type="tel" x-ref="phone" required pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="15" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-r-lg px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition">
                        </div>
                        <template x-if="formErrors.phone"><p class="text-red-500 text-xs mt-1" x-text="formErrors.phone[0]"></p></template>
                    </div>
                    
                    <!-- Image Captcha -->
                    <div>
                        <label class="block text-[10px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Security Check</label>
                        <div class="flex items-center gap-3 mb-2">
                            <img src="{{ captcha_src('flat') }}" alt="captcha" class="rounded h-10 cursor-pointer" onclick="this.src='{{ captcha_src('flat') }}'+Math.random()" id="captchaImg">
                            <button type="button" onclick="document.getElementById('captchaImg').src='{{ captcha_src('flat') }}'+Math.random()" class="text-xs text-brand-accent hover:underline focus:outline-none">Reload</button>
                        </div>
                        <input type="text" x-model="captchaInput" placeholder="Enter code" required class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition">
                        <template x-if="formErrors.captcha"><p class="text-red-500 text-xs mt-1" x-text="formErrors.captcha[0]"></p></template>
                    </div>

                    <button type="submit" :disabled="isSubmitting" class="w-full bg-brand-accent text-brand-dark font-bold uppercase tracking-widest py-3 text-sm rounded-lg hover:bg-brand-dark hover:text-white transition-colors duration-300 mt-2 shadow-[0_4px_14px_0_rgba(212,175,55,0.39)] disabled:opacity-50">
                        <span x-show="!isSubmitting">Request Callback</span>
                        <span x-show="isSubmitting">Sending...</span>
                    </button>
                </form>
                <p class="text-[9px] text-center text-gray-400 mt-4 uppercase tracking-wider">Your info is secure.</p>
            </div>
        </div>
    </div>
</body>
</html>
