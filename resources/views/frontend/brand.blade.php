@extends('frontend.layout')

@section('title', $brand->name . ' Projects')

@section('content')
    <!-- Advanced Brand Hero Section -->
    <div class="relative pt-32 pb-32 flex content-center items-center justify-center min-h-screen bg-[#050505] overflow-hidden group" x-data="{ scrolled: 0 }" @scroll.window="scrolled = window.pageYOffset">
        <!-- Parallax Background -->
        <div class="absolute inset-0 z-0 overflow-hidden" :style="'transform: translateY(' + (scrolled * 0.4) + 'px)'">
            @if(isset($brand) && $brand->banner_image)
                <img src="{{ $brand->banner_image }}" alt="{{ $brand->name }}" class="w-full h-full object-cover opacity-60 filter brightness-75 scale-105">
            @elseif(isset($siteSetting) && $siteSetting->hero_image)
                <img src="{{ $siteSetting->hero_image }}" alt="{{ $brand->name }}" class="w-full h-full object-cover opacity-60 filter brightness-75 scale-105">
            @else
                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="{{ $brand->name }}" class="w-full h-full object-cover opacity-60 filter brightness-75 scale-105">
            @endif
            <!-- Fixed Overlay: Deep cinematic dark gradient instead of white wash -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black/80"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center" x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">
            @if($brand->logo)
                <div x-show="show" x-transition.opacity.duration.1000ms class="inline-block mb-6 bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20 shadow-2xl transform hover:scale-105 transition-transform duration-500">
                    <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" class="h-14 md:h-16 object-contain drop-shadow-xl filter brightness-0 invert">
                </div>
            @endif

            <span x-show="show" x-transition.opacity.duration.1000ms.delay.200ms class="text-brand-accent font-bold tracking-[0.4em] uppercase text-[10px] mb-4 block flex items-center justify-center gap-4">
                <span class="w-8 h-[1px] bg-brand-accent"></span>
                Exclusive Collection
                <span class="w-8 h-[1px] bg-brand-accent"></span>
            </span>

            <h1 x-show="show" x-transition.opacity.translate-y.duration.1000ms class="text-white font-serif font-bold text-3xl md:text-4xl lg:text-5xl tracking-wide leading-tight mb-4 drop-shadow-2xl">
                {{ $brand->name }} <span class="italic text-brand-accent font-light">Residences</span>
            </h1>

            <p x-show="show" x-transition.opacity.translate-y.duration.1000ms.delay.300ms class="text-gray-300 max-w-2xl mx-auto text-base md:text-lg font-light tracking-wide">
                {{ $brand->description ?? 'Discover unparalleled luxury and architectural brilliance with our handpicked ' . $brand->name . ' properties.' }}
            </p>
        </div>
    </div>

    <!-- Projects Grid Area -->
    <section id="projects" class="py-24 bg-[#fdfbf7] dark:bg-[#050505] transition-colors duration-500 relative z-20">
        <!-- Abstract BG Elements -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-accent/5 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/4 hidden lg:block"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-8">
                <div>
                    <h2 class="text-3xl md:text-5xl font-serif font-bold text-brand-dark dark:text-white mb-4">Featured <span class="italic text-brand-accent font-light">Projects</span></h2>
                    <div class="w-20 h-1 bg-brand-accent"></div>
                </div>
                
                @if(isset($cities) && $cities->count() > 0)
                <div class="flex flex-wrap gap-3">
                    <a href="{{ request()->fullUrlWithQuery(['city' => null, 'page' => null]) }}" class="px-5 py-2 rounded-full border {{ !request('city') ? 'bg-brand-accent text-brand-dark font-bold border-brand-accent shadow-md' : 'border-gray-300 text-gray-600 dark:border-gray-700 dark:text-gray-300 hover:border-brand-accent dark:hover:border-brand-accent' }} transition-all text-xs tracking-wider uppercase">All</a>
                    @foreach($cities as $city)
                        <a href="{{ request()->fullUrlWithQuery(['city' => $city, 'page' => null]) }}" class="px-5 py-2 rounded-full border {{ request('city') == $city ? 'bg-brand-accent text-brand-dark font-bold border-brand-accent shadow-md' : 'border-gray-300 text-gray-600 dark:border-gray-700 dark:text-gray-300 hover:border-brand-accent dark:hover:border-brand-accent' }} transition-all text-xs tracking-wider uppercase">{{ $city }}</a>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($projects as $project)
                <!-- Luxury Project Card -->
                <div class="bg-white dark:bg-[#0a0a0a] rounded-3xl overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.05)] dark:shadow-[0_10px_30px_rgba(0,0,0,0.5)] border border-gray-100 dark:border-gray-800 hover:border-brand-accent/50 dark:hover:border-brand-accent/50 transition-all duration-500 group relative flex flex-col h-full hover:-translate-y-2">
                    
                    <a href="{{ route('frontend.dynamic', $project->slug) }}" class="absolute inset-0 z-10"></a>
                    
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $project->featured_image ? $project->featured_image : 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $project->project_name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                        
                        <!-- Badges -->
                        <div class="absolute top-5 left-5 flex flex-col gap-2 z-20">
                            <span class="bg-brand-dark/80 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-[0.2em] border border-white/10">{{ $brand->name }}</span>
                            @if($project->status)
                                <span class="bg-brand-accent/90 backdrop-blur-md text-brand-dark text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg">{{ $project->status }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-8 relative flex-grow flex flex-col">
                        <h3 class="text-2xl font-serif font-bold text-brand-dark dark:text-white mb-3 group-hover:text-brand-accent transition-colors">{{ $project->project_name }}</h3>
                        
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-6 flex items-center font-light tracking-wide">
                            <svg class="w-4 h-4 mr-2 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ collect([$project->locality, $project->city])->filter()->join(', ') ?: 'Location on Request' }}
                        </p>
                        
                        <div class="flex justify-between items-center mb-8 border-t border-b border-gray-100 dark:border-gray-800 py-4 mt-auto">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Configuration</p>
                                <p class="font-medium text-brand-dark dark:text-white text-sm">{{ $project->project_type ?? 'Luxury Residences' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Starting Price</p>
                                <p class="font-bold text-brand-accent text-lg">{{ $project->price_label ?? 'On Request' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 relative z-20">
                            <a href="{{ route('frontend.dynamic', $project->slug) }}" class="flex-1 bg-transparent hover:bg-gray-50 dark:hover:bg-[#111] text-brand-dark dark:text-white border border-gray-200 dark:border-gray-700 font-bold tracking-wider py-3.5 rounded-xl transition-all text-xs uppercase text-center block shadow-sm hover:shadow">Explore</a>
                            <button @click.prevent="$dispatch('open-enquiry', { projectName: '{{ addslashes($project->project_name) }}' })" class="flex-1 bg-brand-accent hover:bg-brand-dark hover:text-white text-brand-dark font-bold tracking-wider py-3.5 rounded-xl transition-all shadow-[0_4px_14px_rgba(212,175,55,0.3)] hover:shadow-xl text-xs uppercase cursor-pointer block border border-brand-accent hover:border-brand-dark">Enquire</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-2xl font-serif text-brand-dark dark:text-white mb-2">No Projects Currently Available</h3>
                    <p class="text-gray-500 dark:text-gray-400 font-light tracking-wide">Please check back soon for our upcoming exclusive launches in this category.</p>
                </div>
                @endforelse
            </div>
            
            <div class="mt-16">
                {{ $projects->links() }}
            </div>
        </div>
    </section>
@endsection
