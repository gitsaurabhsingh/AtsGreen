@extends('frontend.layout')

@section('title', 'About Us')

@section('content')
    <!-- Advanced Hero Section -->
    <div class="relative pt-32 pb-32 flex content-center items-center justify-center min-h-[70vh] bg-[#050505] overflow-hidden group" x-data="{ scrolled: 0 }" @scroll.window="scrolled = window.pageYOffset">
        <!-- Parallax Background -->
        <div class="absolute inset-0 z-0 overflow-hidden" :style="'transform: translateY(' + (scrolled * 0.4) + 'px)'">
            @if(isset($siteSetting) && $siteSetting->about_image)
                <img src="{{ $siteSetting->about_image }}" alt="About Us" class="w-full h-full object-cover opacity-50 filter brightness-75 scale-105">
            @else
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="About Us" class="w-full h-full object-cover opacity-50 filter brightness-75 scale-105">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#fdfbf7] dark:from-[#050505] via-transparent to-black/50 transition-colors duration-500"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 pt-16 text-center"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">
            <span x-show="show" x-transition.opacity.duration.1000ms.delay.200ms class="text-brand-accent font-bold tracking-[0.4em] uppercase text-[10px] mb-6 block flex items-center justify-center gap-4">
                <span class="w-12 h-[1px] bg-brand-accent"></span>
                The ATS Legacy
                <span class="w-12 h-[1px] bg-brand-accent"></span>
            </span>
            <h1 x-show="show" x-transition.opacity.translate-y.duration.1000ms class="text-white dark:text-white font-serif font-bold text-5xl md:text-7xl lg:text-8xl tracking-wide leading-[1.1] mb-6 drop-shadow-2xl">
                About <span class="italic text-brand-accent font-light relative inline-block">
                    Us
                    <span class="absolute inset-0 blur-[12px] opacity-40 bg-brand-accent rounded-full -z-10 animate-pulse"></span>
                </span>
            </h1>
            <p x-show="show" x-transition.opacity.translate-y.duration.1000ms.delay.300ms class="text-gray-300 max-w-2xl mx-auto text-lg md:text-xl font-light tracking-wider">
                A relentless pursuit of architectural perfection and unparalleled luxury.
            </p>
        </div>
    </div>

    <!-- Main Dynamic Content Area -->
    <div class="bg-[#fdfbf7] dark:bg-[#050505] py-24 relative z-20 transition-colors duration-500">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                
                <!-- Decorative Side -->
                <div class="hidden lg:block lg:col-span-4 relative sticky top-32 animate-[float_6s_ease-in-out_infinite]">
                    <div class="aspect-[3/4] rounded-t-full overflow-hidden border-8 border-white dark:border-gray-900 shadow-2xl relative">
                        @if(isset($siteSetting) && $siteSetting->about_side_image)
                            <img src="{{ $siteSetting->about_side_image }}" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" alt="Legacy">
                        @else
                            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" alt="Legacy">
                        @endif
                        <div class="absolute inset-0 bg-brand-accent/20 mix-blend-overlay"></div>
                    </div>
                    <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-[#f3e5ab] dark:bg-brand-accent/20 rounded-full blur-2xl z-[-1] animate-pulse"></div>
                </div>

                <!-- Rich Text Editor Content -->
                <div class="lg:col-span-8">
                    <div class="prose prose-lg md:prose-xl 
                        prose-headings:font-serif prose-headings:font-bold prose-headings:text-brand-dark dark:prose-headings:text-white prose-headings:tracking-wide
                        prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-p:leading-relaxed prose-p:font-light prose-p:tracking-wide
                        prose-a:text-brand-accent prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-brand-dark dark:prose-strong:text-brand-accent prose-strong:font-semibold
                        prose-blockquote:border-l-4 prose-blockquote:border-brand-accent prose-blockquote:pl-6 prose-blockquote:italic prose-blockquote:text-gray-500 dark:prose-blockquote:text-gray-400 prose-blockquote:bg-gray-50 dark:prose-blockquote:bg-gray-900/50 prose-blockquote:py-2 prose-blockquote:pr-4 prose-blockquote:rounded-r-xl
                        max-w-none transition-colors duration-500 custom-prose-styling">
                        @if(isset($siteSetting) && $siteSetting->about_content)
                            {!! $siteSetting->about_content !!}
                        @else
                            <h2 class="text-4xl text-brand-dark dark:text-white">Redefining Urban Living</h2>
                            <p class="first-letter:text-7xl first-letter:font-serif first-letter:font-bold first-letter:text-brand-accent first-letter:mr-3 first-letter:float-left">
                                ATS Greens stands at the pinnacle of luxury real estate development. With decades of unyielding commitment to architectural brilliance, we don't just build homes—we curate lifestyles for the discerning elite.
                            </p>
                            <p>Every ATS property is a testament to our philosophy of harmonizing avant-garde design with nature, ensuring an oasis of tranquility amidst the urban rush.</p>
                            <blockquote>"Architecture should speak of its time and place, but yearn for timelessness."</blockquote>
                            <p>We pride ourselves on our meticulous attention to detail, from the selection of premium materials to the masterful execution of visionary floor plans.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vision & Mission / Stats Section -->
    <div class="relative py-24 bg-brand dark:bg-[#020804] border-t border-brand-accent/20 border-b overflow-hidden transition-colors duration-500">
        <!-- Abstract BG -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[140%] bg-brand-accent/5 blur-[100px] rounded-full pointer-events-none transform rotate-12"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center divide-y md:divide-y-0 md:divide-x divide-white/10">
                <!-- Stat 1 -->
                <div class="p-4" x-data="{ count: 0 }" x-intersect.once="let interval = setInterval(() => { if(count < {{ isset($siteSetting) && $siteSetting->stat_1_number ? (int)$siteSetting->stat_1_number : 25 }}) count++; else clearInterval(interval); }, 40)">
                    <p class="text-5xl md:text-7xl font-serif font-black text-white mb-2"><span x-text="count">0</span><span class="text-brand-accent">{{ isset($siteSetting) && $siteSetting->stat_1_number && !is_numeric($siteSetting->stat_1_number) ? preg_replace('/[0-9]/', '', $siteSetting->stat_1_number) : '+' }}</span></p>
                    <p class="text-brand-accent uppercase tracking-[0.3em] text-xs font-bold">{{ isset($siteSetting) && $siteSetting->stat_1_label ? $siteSetting->stat_1_label : 'Years of Excellence' }}</p>
                </div>
                <!-- Stat 2 -->
                <div class="p-4" x-data="{ count: 0 }" x-intersect.once="let interval = setInterval(() => { if(count < {{ isset($siteSetting) && $siteSetting->stat_2_number ? (int)$siteSetting->stat_2_number : 50 }}) count++; else clearInterval(interval); }, 20)">
                    <p class="text-5xl md:text-7xl font-serif font-black text-white mb-2"><span x-text="count">0</span><span class="text-brand-accent">{{ isset($siteSetting) && $siteSetting->stat_2_number && !is_numeric($siteSetting->stat_2_number) ? preg_replace('/[0-9]/', '', $siteSetting->stat_2_number) : '+' }}</span></p>
                    <p class="text-brand-accent uppercase tracking-[0.3em] text-xs font-bold">{{ isset($siteSetting) && $siteSetting->stat_2_label ? $siteSetting->stat_2_label : 'Signature Projects' }}</p>
                </div>
                <!-- Stat 3 -->
                <div class="p-4" x-data="{ count: 0 }" x-intersect.once="let interval = setInterval(() => { if(count < {{ isset($siteSetting) && $siteSetting->stat_3_number ? (int)$siteSetting->stat_3_number : 100 }}) count += 2; else clearInterval(interval); }, 10)">
                    <p class="text-5xl md:text-7xl font-serif font-black text-white mb-2"><span x-text="count">0</span><span class="text-brand-accent">{{ isset($siteSetting) && $siteSetting->stat_3_number && !is_numeric($siteSetting->stat_3_number) ? preg_replace('/[0-9]/', '', $siteSetting->stat_3_number) : '+' }}</span></p>
                    <p class="text-brand-accent uppercase tracking-[0.3em] text-xs font-bold">{{ isset($siteSetting) && $siteSetting->stat_3_label ? $siteSetting->stat_3_label : 'Happy Families' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra Styles for this page -->
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .custom-prose-styling p:first-of-type::first-letter {
            font-size: 5rem;
            font-weight: 700;
            line-height: 1;
            float: left;
            margin-right: 0.75rem;
            color: #D4AF37; /* brand-accent */
            font-family: 'Playfair Display', serif;
        }
    </style>
    
@endsection
