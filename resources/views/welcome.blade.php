@extends('frontend.layout')

@section('content')
    <!-- Hero Slider Section -->
    <div class="relative flex content-center items-center justify-center min-h-[100vh] overflow-hidden" 
         x-data="{ 
            currentSlide: 0, 
            slides: {{ $heroSliders->count() > 0 ? $heroSliders->count() : 1 }},
            init() {
                if (this.slides > 1) {
                    setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.slides;
                    }, 6000);
                }
            }
         }">
        
        <!-- Slider Images -->
        <div class="absolute inset-0 z-0">
            @if(isset($heroSliders) && $heroSliders->count() > 0)
                @foreach($heroSliders as $index => $slider)
                    <div class="absolute inset-0"
                         x-show="currentSlide === {{ $index }}"
                         x-transition.opacity.duration.1500ms>
                        @if($slider->target_url)
                            <a href="{{ $slider->target_url }}" class="absolute inset-0 z-20 cursor-pointer block"></a>
                        @endif
                        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat hero-bg-zoom" style="background-image: url('{{ $slider->image }}');"></div>
                        <div class="absolute inset-0 hero-overlay z-10 pointer-events-none"></div>
                    </div>
                @endforeach
            @else
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat hero-bg-zoom" style="background-image: url('{{ (isset($siteSetting) && $siteSetting->hero_bg_image) ? $siteSetting->hero_bg_image : 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80' }}');"></div>
                <div class="absolute inset-0 hero-overlay transition-colors duration-500 z-10"></div>
            @endif
        </div>

        <div class="container mx-auto px-4 mt-64 md:mt-80 relative z-40">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-10/12 mx-auto text-center">
                    
                    <!-- Slider Text Content -->
                    <div class="grid w-full place-items-center">
                        @if(isset($heroSliders) && $heroSliders->count() > 0)
                            @foreach($heroSliders as $index => $slider)
                                <div class="col-start-1 row-start-1 w-full"
                                     x-show="currentSlide === {{ $index }}"
                                     x-transition:enter="transition ease-out duration-700 delay-700 transform"
                                     x-transition:enter-start="opacity-0 translate-y-8"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-700 transform"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 -translate-y-8" style="display: none;">
                                    
                                    <!-- Date Element for this Slide -->
                                    <div class="mb-4 inline-flex items-center justify-center space-x-2 px-5 py-2 rounded-full bg-black/20 backdrop-blur-sm border border-white/20 shadow-lg drop-shadow-md">
                                        <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-white/95 text-xs sm:text-sm font-semibold tracking-widest uppercase shadow-sm">
                                            {{ $slider->start_date ? $slider->start_date->format('l, d M Y') : ($slider->end_date ? $slider->end_date->format('l, d M Y') : \Carbon\Carbon::now()->format('l, d M Y')) }}
                                        </span>
                                    </div>
                                    
                                    <h1 class="text-white font-serif font-bold text-2xl sm:text-3xl md:text-5xl lg:text-6xl tracking-wide leading-[1.15] drop-shadow-2xl mb-4 md:mb-6">
                                        {!! $slider->heading ?: 'A Legacy of <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-accent to-[#f3e5ab]">Excellence.</span>' !!}
                                    </h1>
                                    
                                    <p class="text-sm md:text-lg text-gray-200 max-w-3xl mx-auto drop-shadow font-light tracking-wide">
                                        {{ $slider->subheading ?: 'Discover world-class luxury residences and commercial spaces crafted by ATS and ATS Homekraft.' }}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <div class="w-full transition-all duration-1000 transform translate-y-0 opacity-100">
                                <h1 class="text-white font-heading font-black text-3xl sm:text-4xl md:text-6xl lg:text-7xl tracking-tighter leading-[1.1] drop-shadow-2xl mb-4 md:mb-6">
                                    {!! isset($siteSetting) && $siteSetting->hero_heading ? $siteSetting->hero_heading : 'A Legacy of <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-accent to-[#f3e5ab]">Excellence.</span>' !!}
                                </h1>
                                <p class="text-sm md:text-lg text-gray-200 max-w-3xl mx-auto drop-shadow font-light tracking-wide">
                                    {{ isset($siteSetting) && $siteSetting->hero_subheading ? $siteSetting->hero_subheading : 'Discover world-class luxury residences and commercial spaces crafted by ATS and ATS Homekraft.' }}
                                </p>
                            </div>
                        @endif
                    </div>
                    

                    <!-- Scroll Indicator -->
                    <div class="mt-20 flex flex-col items-center">
                        <span class="text-white/70 text-[10px] uppercase tracking-[0.3em] mb-3">Scroll</span>
                        <div class="w-6 h-10 border border-white/30 rounded-full flex justify-center p-1 backdrop-blur-sm">
                            <div class="w-1 h-2 bg-brand-accent rounded-full animate-scroll-bounce"></div>
                        </div>
                    </div>

                    <!-- Slider Indicators -->
                    @if(isset($heroSliders) && $heroSliders->count() > 1)
                        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-50">
                            @foreach($heroSliders as $index => $slider)
                                <button @click="currentSlide = {{ $index }}" 
                                        class="w-3 h-3 rounded-full transition-all duration-300 border border-white/50"
                                        :class="currentSlide === {{ $index }} ? 'bg-brand-accent w-8' : 'bg-transparent hover:bg-white/50'"></button>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Premium Brands Section -->
    <section class="pt-20 pb-10 bg-transparent relative -mt-24 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-8">
                @if(isset($brands) && $brands->count() > 0)
                    @foreach($brands as $brand)
                    <a href="{{ route('frontend.dynamic', $brand->slug) }}" class="block w-full sm:w-[45%] lg:w-[40%] group">
                        <div class="rounded-3xl shadow-xl dark:shadow-2xl hover:shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2 h-[400px] flex flex-col justify-center items-center relative overflow-hidden group/card">
                            
                            <!-- Background Image -->
                            @if($brand->banner_image)
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 ease-out group-hover/card:scale-110" style="background-image: url('{{ $brand->banner_image }}');"></div>
                            @else
                                <div class="absolute inset-0 bg-brand transition-transform duration-1000 ease-out group-hover/card:scale-110"></div>
                            @endif
                            
                            <!-- Dark Gradient Overlay for readability -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/30 group-hover/card:bg-black/40 transition-colors duration-500"></div>

                            <div class="relative z-10 flex flex-col items-center p-8 w-full h-full justify-between text-center">
                                <div class="flex flex-col items-center mt-4">
                                    <!-- Brand Initial or Logo -->
                                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-2xl mb-6 border border-white/20 group-hover/card:border-brand-accent transition-colors duration-500 transform group-hover/card:-translate-y-1">
                                        @if($brand->logo)
                                            <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" class="w-12 h-12 object-contain filter brightness-0 invert drop-shadow-lg">
                                        @else
                                            <span class="font-heading font-black text-3xl text-white group-hover/card:text-brand-accent transition-colors drop-shadow-lg">{{ substr($brand->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Content -->
                                    <h3 class="text-2xl font-bold font-heading text-white mb-3 group-hover/card:text-brand-accent transition-colors drop-shadow-lg">{{ $brand->name }}</h3>
                                    <p class="text-gray-300 text-sm mb-6 line-clamp-2 leading-relaxed max-w-sm drop-shadow-md px-4">
                                        {{ $brand->description ?? 'Discover our exclusive and highly curated collection of properties developed by ' . $brand->name . '.' }}
                                    </p>
                                </div>
                                
                                <!-- CTA -->
                                <div class="mt-auto flex items-center text-white font-bold uppercase tracking-[0.15em] text-xs group-hover/card:text-brand-accent transition-colors">
                                    Explore Collection 
                                    <span class="ml-3 bg-white/10 backdrop-blur-sm p-2.5 rounded-full group-hover/card:bg-brand-accent group-hover/card:text-brand-dark transition-all duration-300 border border-white/20 group-hover/card:border-brand-accent shadow-[0_0_15px_rgba(255,255,255,0.1)] group-hover/card:shadow-[0_0_20px_rgba(212,175,55,0.4)]">
                                        <svg class="w-4 h-4 transform group-hover/card:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="bg-white/90 dark:bg-gray-900/90 backdrop-blur shadow-xl rounded-2xl p-8 w-full max-w-lg text-center text-gray-500 dark:text-gray-400 border border-transparent dark:border-gray-800 italic">
                        Premium brands will be showcased here dynamically.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section id="projects" class="pt-10 pb-24 scroll-mt-24 bg-[#fdfbf7] dark:bg-[#050505] transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 border-b border-gray-200 dark:border-gray-800 pb-8">
                <div>
                    <span class="text-brand-accent font-bold tracking-[0.3em] uppercase text-[10px] mb-3 block flex items-center gap-4">
                        <span class="w-8 h-[1px] bg-brand-accent"></span>
                        Curated Selection
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold text-brand-dark dark:text-white tracking-wide transition-colors leading-tight">Signature <span class="italic text-brand-accent font-light">Projects</span></h2>
                </div>
                <a href="#projects" class="mt-8 md:mt-0 inline-flex items-center text-brand dark:text-gray-300 font-bold uppercase tracking-[0.2em] text-xs hover:text-brand-accent dark:hover:text-brand-accent transition-colors group">
                    View All Portfolio
                    <span class="ml-3 p-2 border border-brand-accent/30 rounded-full group-hover:bg-brand-accent group-hover:text-brand-dark transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredProjects as $project)
                <!-- Ultra Premium Project Card -->
                <div class="relative group overflow-hidden shadow-xl hover:shadow-[0_30px_60px_rgba(0,0,0,0.15)] h-[500px] cursor-pointer rounded-2xl border border-gray-100 dark:border-gray-800 transition-all duration-700">
                    <a href="{{ route('frontend.dynamic', $project->slug) }}" class="absolute inset-0 z-10"></a>
                    <img src="{{ $project->featured_image ? $project->featured_image : 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $project->project_name }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2s] ease-out group-hover:scale-105 z-0 filter brightness-90 group-hover:brightness-100">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-700 z-0"></div>
                    
                    <div class="absolute inset-0 p-8 flex flex-col justify-end z-0 pointer-events-none">
                        <div class="transform translate-y-8 group-hover:translate-y-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)]">
                            <div class="flex gap-2 mb-4">
                                <span class="bg-brand-dark/60 border border-brand-accent/30 backdrop-blur-md text-brand-accent text-[10px] font-bold px-4 py-1.5 uppercase tracking-[0.2em] rounded-full">{{ $project->brand->name ?? 'ATS' }}</span>
                                @if($project->status)
                                    <span class="bg-white/10 border border-white/20 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 uppercase tracking-[0.2em] rounded-full">{{ $project->status }}</span>
                                @endif
                            </div>
                            <h3 class="text-3xl font-serif font-bold text-white mb-2 leading-tight">{{ $project->project_name }}</h3>
                            <p class="text-gray-300 text-sm mb-6 font-light tracking-wide flex items-center gap-2">
                                <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                {{ collect([$project->locality, $project->city])->filter()->join(', ') ?: 'Location on Request' }}
                            </p>
                            
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-700 delay-100 flex justify-between items-center border-t border-white/10 pt-6 mt-4 pointer-events-auto">
                                <div>
                                    <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] mb-1 font-bold">Starting Price</p>
                                    <p class="font-serif font-bold text-brand-accent text-xl">{{ $project->price_label ?? 'On Request' }}</p>
                                </div>
                                <a href="{{ route('frontend.dynamic', $project->slug) }}" class="bg-brand-accent text-brand-dark px-6 py-2.5 rounded-full text-[10px] font-bold hover:bg-white transition-colors uppercase tracking-[0.2em] relative z-20 flex items-center gap-2">
                                    Explore
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm transition-colors duration-500">
                    <h3 class="text-2xl text-gray-400 dark:text-gray-500 font-light mb-2 font-heading">No signature projects available at the moment.</h3>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
