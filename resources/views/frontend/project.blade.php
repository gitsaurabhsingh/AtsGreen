@extends('frontend.layout')

@section('title', $project->project_name . ' - ' . ($project->brand->name ?? 'Project Details'))
@section('meta_description', Str::limit(strip_tags($project->description), 160))
@section('meta_keywords', 'ATS Greens, ' . $project->project_name . ', ' . ($project->locality ?? '') . ', ' . ($project->city ?? ''))

@section('content')
    <!-- Ultra Premium Hero Section -->
    <div class="relative pt-32 pb-32 flex content-center items-center justify-center min-h-[75vh] bg-[#050505] overflow-hidden group" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
        
        <!-- Animated Background -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="{{ $project->featured_image ? $project->featured_image : 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80' }}" alt="{{ $project->project_name }}" class="w-full h-full object-cover opacity-80 transform transition-transform duration-[10s] ease-out scale-110 group-hover:scale-100">
            <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#050505]/50 via-transparent to-[#050505]/50"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 pt-16">
            <div class="flex flex-col items-center text-center">
                
                <!-- Animated Badges -->
                <div class="flex space-x-3 mb-8 transition-all duration-1000 transform translate-y-10 opacity-0" :class="{ 'translate-y-0 opacity-100': loaded }">
                    <span class="bg-brand-accent/10 border border-brand-accent/30 backdrop-blur-md text-brand-accent text-xs font-bold px-5 py-2 uppercase tracking-[0.2em] rounded-none">
                        {{ $project->brand->name ?? 'Premium Project' }}
                    </span>
                    @if($project->status)
                    <span class="bg-white/5 border border-white/10 backdrop-blur-md text-white text-xs font-bold px-5 py-2 uppercase tracking-[0.2em] rounded-none">
                        {{ $project->status }}
                    </span>
                    @endif
                </div>
                
                <!-- Main Title -->
                <h1 class="text-white font-serif font-bold text-3xl md:text-4xl lg:text-5xl tracking-wide leading-[1.1] mb-6 drop-shadow-2xl transition-all duration-1000 delay-200 transform translate-y-10 opacity-0 relative" :class="{ 'translate-y-0 opacity-100': loaded }">
                    {{ $project->project_name }}
                    <span class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-24 h-1 bg-brand-accent"></span>
                </h1>
                
                <!-- Location & Type -->
                <p class="text-base md:text-2xl text-gray-300 font-light tracking-[0.1em] mt-6 md:mt-8 mb-10 md:mb-12 transition-all duration-1000 delay-400 transform translate-y-10 opacity-0 flex flex-col md:flex-row items-center justify-center gap-2 md:gap-4 text-center" :class="{ 'translate-y-0 opacity-100': loaded }">
                    <span class="flex items-center justify-center text-center">
                        <svg class="w-5 h-5 mr-2 text-brand-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        <span class="break-words">{{ collect([$project->locality, $project->city])->filter()->join(', ') ?: 'Location on Request' }}</span>
                    </span>
                    <span class="hidden md:block w-1.5 h-1.5 rounded-full bg-brand-accent"></span>
                    <span class="text-brand-accent md:text-gray-300">{{ $project->project_type ?? 'Residential' }}</span>
                </p>

                <!-- Quick Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-white/10 backdrop-blur-sm border border-white/20 p-px rounded-2xl w-full max-w-4xl transition-all duration-1000 delay-600 transform translate-y-10 opacity-0" :class="{ 'translate-y-0 opacity-100': loaded }">
                    <div class="bg-black/40 backdrop-blur-md p-4 md:p-6 text-center rounded-tl-2xl md:rounded-bl-2xl">
                        <p class="text-[9px] md:text-[10px] text-gray-400 uppercase tracking-[0.15em] md:tracking-[0.2em] mb-2 font-bold">Starting Price</p>
                        <p class="text-base md:text-2xl font-heading font-black text-brand-accent">{{ $project->price_label ?? 'On Request' }}</p>
                    </div>
                    <div class="bg-black/40 backdrop-blur-md p-4 md:p-6 text-center rounded-tr-2xl md:rounded-tr-none">
                        <p class="text-[9px] md:text-[10px] text-gray-400 uppercase tracking-[0.15em] md:tracking-[0.2em] mb-2 font-bold">Configuration</p>
                        <p class="text-base md:text-2xl font-heading font-black text-white">{{ $project->project_type ?? 'Luxury' }}</p>
                    </div>
                    <div class="bg-black/40 backdrop-blur-md p-4 md:p-6 text-center rounded-bl-2xl md:rounded-bl-none overflow-hidden">
                        <p class="text-[9px] md:text-[10px] text-gray-400 uppercase tracking-[0.15em] md:tracking-[0.2em] mb-2 font-bold">Registration</p>
                        <p class="text-xs md:text-lg font-heading font-black text-white truncate w-full" title="{{ $project->rera_number ?: 'Awaited' }}">{{ $project->rera_number ?: 'Awaited' }}</p>
                    </div>
                    <div class="bg-black/40 backdrop-blur-md p-4 md:p-6 text-center rounded-br-2xl flex flex-col justify-center items-center">
                        <a href="#enquire" class="text-xs md:text-sm font-bold uppercase tracking-widest text-brand-dark bg-brand-accent hover:bg-white transition-colors px-4 md:px-6 py-2.5 md:py-3 rounded-none w-full">Enquire</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center transition-opacity duration-1000 delay-1000" :class="{ 'opacity-100': loaded, 'opacity-0': !loaded }">
            <span class="text-white/50 text-[10px] uppercase tracking-[0.3em] mb-3">Discover</span>
            <div class="w-px h-16 bg-gradient-to-b from-brand-accent to-transparent"></div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="bg-[#fdfbf7] dark:bg-[#050505] py-24 relative z-20 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                
                <!-- Left Content: Description & Galleries -->
                <div class="w-full lg:w-2/3 space-y-24">
                    
                    <!-- Overview -->
                    <div x-data="{ showQr: false, showBrochureModal: false, expandedDesc: false }">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 md:mb-10 gap-4 border-b border-gray-200 dark:border-gray-800 pb-6">
                            <div class="flex-grow">
                                <span class="text-brand-accent font-bold tracking-[0.2em] uppercase text-[10px] md:text-xs mb-2 block">Project Overview</span>
                                <h2 class="text-xl md:text-3xl font-heading font-black text-brand-dark dark:text-white leading-tight transition-colors">About <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand to-brand-accent">{{ $project->project_name }}</span></h2>
                            </div>
                            @if($project->brochure)
                            <button @click="showBrochureModal = true" class="inline-flex items-center justify-center bg-[#0a0a0a] text-white hover:bg-brand-accent hover:text-brand-dark font-bold uppercase tracking-[0.15em] px-6 py-3 md:px-8 md:py-4 text-xs md:text-sm transition-all duration-300 flex-shrink-0 shadow-xl rounded-lg border border-gray-800 self-start sm:self-auto">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Download Brochure
                            </button>
                            @endif
                        </div>
                        
                        <div class="relative prose prose-sm md:prose-lg text-justify prose-headings:font-heading prose-headings:font-bold prose-headings:text-brand-dark dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-400 prose-p:leading-relaxed prose-p:font-light max-w-none transition-colors">
                            <div :class="{ 'line-clamp-4 overflow-hidden relative': !expandedDesc, 'pb-12': !expandedDesc }">
                                @if($project->description)
                                    {!! $project->description !!}
                                @else
                                    <p>Welcome to {{ $project->project_name }}, where luxury meets convenience. Experience world-class amenities and meticulously crafted spaces designed for the modern elite. Please contact our sales team for detailed information regarding this magnificent property.</p>
                                @endif
                                
                                <div x-show="!expandedDesc" class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-[#fdfbf7] dark:from-[#050505] to-transparent pointer-events-none flex items-end justify-center pb-2">
                                </div>
                            </div>
                            
                            <button @click="expandedDesc = !expandedDesc" class="w-full mt-2 text-brand-accent font-bold uppercase tracking-widest text-xs hover:text-brand-dark transition-colors flex justify-center items-center gap-2 focus:outline-none border-t border-gray-100 dark:border-gray-800 pt-4">
                                <span x-text="expandedDesc ? 'Read Less' : 'Read More'"></span>
                                <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': expandedDesc }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </div>
                        
                        <!-- Brochure Modal -->
                        @if($project->brochure)
                        <template x-teleport="body">
                            <div x-show="showBrochureModal" class="fixed inset-0 z-[999999] flex items-center justify-center p-4" x-cloak>
                                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="showBrochureModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
                                
                                <div class="relative bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100 dark:border-gray-800" 
                                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-8 scale-95" 
                                    x-data="{ isSubmitting: false, formErrors: {}, captchaInput: '' }">
                                    
                                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-accent/10 rounded-bl-full pointer-events-none"></div>
                                    
                                    <button @click="showBrochureModal = false" class="absolute top-4 right-4 z-10 text-gray-400 hover:text-brand-dark dark:hover:text-white transition-colors bg-white/50 dark:bg-black/50 rounded-full p-2 backdrop-blur-md">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                    
                                    <div class="p-8 sm:p-10 relative z-10">
                                        <span class="text-brand-accent text-[10px] font-bold uppercase tracking-[0.3em] block mb-2 text-center">Exclusive Access</span>
                                        <h3 class="text-2xl font-heading font-black text-brand-dark dark:text-white mb-2 text-center">Download Brochure</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-8 text-center leading-relaxed">Please verify your details below to instantly access the official project brochure.</p>
                                        
                                        <form @submit.prevent="isSubmitting = true; formErrors = {}; fetch('{{ route('frontend.enquire') }}', { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ name: $refs.bname.value, email: $refs.bemail.value, phone: $refs.bphone.value, project_name: '{{ addslashes($project->project_name) }} (Brochure Download)', captcha: captchaInput }) }).then(res => res.json()).then(data => { if(data.message && data.success) { showBrochureModal = false; window.location.href = '{{ route('frontend.download_brochure', $project->id) }}'; $refs.bname.value=''; $refs.bemail.value=''; $refs.bphone.value=''; captchaInput=''; } else { formErrors = data.errors || {}; document.getElementById('modalCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random(); captchaInput=''; } }).catch(err => alert('An error occurred. Please try again.')).finally(() => isSubmitting = false)">
                                            <div class="space-y-4">
                                                <div>
                                                    <input type="text" x-ref="bname" placeholder="Full Name *" required class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent transition-all">
                                                    <template x-if="formErrors.name"><p class="text-red-500 text-xs mt-1" x-text="formErrors.name[0]"></p></template>
                                                </div>
                                                <div>
                                                    <input type="email" x-ref="bemail" placeholder="Email Address *" required class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent transition-all">
                                                    <template x-if="formErrors.email"><p class="text-red-500 text-xs mt-1" x-text="formErrors.email[0]"></p></template>
                                                </div>
                                                <div>
                                                    <input type="tel" x-ref="bphone" placeholder="Phone Number *" required class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent transition-all">
                                                    <template x-if="formErrors.phone"><p class="text-red-500 text-xs mt-1" x-text="formErrors.phone[0]"></p></template>
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-4 mb-3">
                                                        <img src="{{ captcha_src('flat') }}" alt="captcha" class="rounded h-10 border border-gray-200 dark:border-gray-800 cursor-pointer" onclick="this.src='{{ captcha_src('flat') }}'+Math.random()" id="modalCaptchaImg">
                                                        <button type="button" onclick="document.getElementById('modalCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random()" class="text-[10px] text-brand-accent font-bold uppercase tracking-widest hover:text-brand-dark transition-colors">Refresh</button>
                                                    </div>
                                                    <input type="text" x-model="captchaInput" placeholder="Enter security code *" required class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-accent transition-all">
                                                    <template x-if="formErrors.captcha"><p class="text-red-500 text-xs mt-1" x-text="formErrors.captcha[0]"></p></template>
                                                </div>
                                                <button type="submit" :disabled="isSubmitting" class="w-full bg-brand-accent text-brand-dark font-bold uppercase tracking-[0.2em] mt-6 py-4 text-sm rounded-xl hover:bg-brand-dark hover:text-white transition-colors duration-300 shadow-[0_10px_20px_rgba(212,175,55,0.2)] disabled:opacity-50">
                                                    <span x-show="!isSubmitting">Download File</span>
                                                    <span x-show="isSubmitting">Authenticating...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </template>
                        @endif

                        <!-- RERA Box -->
                        <div class="mt-8 md:mt-12 bg-white dark:bg-gray-900/50 p-5 md:p-8 rounded-none border-l-4 border-brand-accent shadow-[0_10px_40px_rgba(0,0,0,0.04)] dark:shadow-none border-r border-t border-b border-transparent dark:border-gray-800 flex flex-col sm:flex-row items-center sm:justify-between gap-4 sm:gap-6 transition-colors">
                            <div class="text-center sm:text-left w-full sm:w-auto flex flex-col items-center sm:items-start">
                                <p class="text-[10px] md:text-xs text-gray-400 uppercase tracking-widest font-bold mb-2">Official Registration</p>
                                <p class="text-brand-dark dark:text-white font-black text-sm md:text-xl flex items-center justify-center sm:justify-start gap-2 md:gap-3 transition-colors break-all">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-brand-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    RERA: {{ $project->rera_number ?: 'Awaited' }}
                                </p>
                            </div>
                            @if($project->rera_qr)
                            <button @click="showQr = !showQr" class="w-full sm:w-auto justify-center px-4 md:px-6 py-2.5 md:py-3 bg-brand-dark dark:bg-brand-accent text-white dark:text-brand-dark text-[10px] md:text-sm font-bold uppercase tracking-widest hover:bg-brand-accent dark:hover:bg-white hover:text-brand-dark transition-colors flex items-center gap-2 md:gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                <span x-text="showQr ? 'Hide QR' : 'View QR'"></span>
                            </button>
                            @endif
                        </div>
                        
                        <!-- RERA QR Hidden -->
                        @if($project->rera_qr)
                        <div x-show="showQr" x-collapse x-cloak>
                            <div class="mt-4 p-8 bg-white dark:bg-gray-900/50 shadow-[0_10px_40px_rgba(0,0,0,0.04)] dark:shadow-none border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center transition-colors">
                                <img src="{{ $project->rera_qr }}" alt="RERA QR Code" loading="lazy" class="w-56 h-56 object-contain bg-white p-2 rounded">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-6 max-w-sm uppercase tracking-widest leading-loose transition-colors">Scan this QR code using your smartphone to view the official RERA registration details.</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Floor Plans with Lightbox Gallery -->
                    @if($project->floorPlans->count() > 0)
                    <div x-data="{
                            lightboxOpen: false,
                            activeIndex: 0,
                            plans: [
                                @foreach($project->floorPlans as $plan)
                                { image: '{{ $plan->image }}', title: '{{ addslashes($plan->title) }}', type: '{{ addslashes($plan->type) }}', area: '{{ addslashes($plan->area) }}' }{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            ],
                            next() {
                                this.activeIndex = (this.activeIndex + 1) % this.plans.length;
                            },
                            prev() {
                                this.activeIndex = (this.activeIndex === 0) ? this.plans.length - 1 : this.activeIndex - 1;
                            }
                        }" 
                        @keydown.escape.window="lightboxOpen = false" 
                        @keydown.right.window="lightboxOpen && next()" 
                        @keydown.left.window="lightboxOpen && prev()"
                        class="relative">
                        
                        <span class="text-brand-accent font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 md:mb-4 block">Spatial Design</span>
                        <h2 class="text-2xl md:text-3xl font-heading font-black text-brand-dark dark:text-white mb-6 md:mb-10 transition-colors">Floor Plans</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($project->floorPlans as $index => $plan)
                            <div class="border border-gray-200 dark:border-gray-800 flex flex-col bg-white dark:bg-[#0a0a0a] transition-shadow duration-300 hover:shadow-lg">
                                
                                <!-- Image Section -->
                                <div class="p-3 md:p-4 cursor-pointer" @click="activeIndex = {{ $index }}; lightboxOpen = true">
                                    <div class="border-[3px] border-[#FFCC00] p-2 flex items-center justify-center relative min-h-[300px]">
                                        <div class="absolute inset-0 bg-black/5 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center z-10">
                                            <svg class="w-10 h-10 text-brand-dark drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                        </div>
                                        <img src="{{ $plan->image }}" alt="{{ $plan->title }}" loading="lazy" class="w-full h-auto max-h-[400px] object-contain mix-blend-multiply dark:mix-blend-normal relative z-0">
                                    </div>
                                </div>
                                
                                <!-- Details Box -->
                                <div class="bg-[#EFEFEF] dark:bg-gray-900 p-6 md:px-10 md:py-8 border-t border-gray-200 dark:border-gray-800 flex flex-col justify-center flex-grow">
                                    <div class="space-y-4">
                                        @if($plan->type)
                                        <div class="flex items-center text-[#2A2A2A] dark:text-gray-200 font-medium text-base md:text-lg">
                                            <svg class="w-5 h-5 mr-3 flex-shrink-0 text-[#4A4A4A] dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            {{ $plan->type }}
                                        </div>
                                        @endif
                                        
                                        @if($plan->area)
                                        <div class="flex items-center text-[#2A2A2A] dark:text-gray-200 font-medium text-base md:text-lg">
                                            <svg class="w-5 h-5 mr-3 flex-shrink-0 text-[#4A4A4A] dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $plan->area }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Lightbox Modal Overlay -->
                        <div x-show="lightboxOpen" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/95 p-4 md:p-8 backdrop-blur-sm" x-cloak>
                            
                            <!-- Close Button (Top Right, moved down to avoid navbar overlap) -->
                            <button @click="lightboxOpen = false" class="absolute top-24 right-4 md:top-32 md:right-12 z-[100000] p-4 text-white hover:text-brand-accent bg-black/80 hover:bg-black rounded-full transition-all duration-300 focus:outline-none border-2 border-white/20 shadow-[0_0_30px_rgba(0,0,0,0.5)] cursor-pointer pointer-events-auto flex items-center justify-center">
                                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            
                            <!-- Previous Button -->
                            <button @click.stop="prev()" class="absolute left-4 md:left-10 z-[110] p-3 text-white/50 hover:text-white bg-white/5 hover:bg-brand-accent/50 rounded-full transition-all duration-300 focus:outline-none backdrop-blur-md border border-white/10" x-show="plans.length > 1">
                                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>

                            <!-- Gallery Slider -->
                            <div class="w-full max-w-6xl h-full flex items-center justify-center relative mt-12 pointer-events-none" @click.self="lightboxOpen = false">
                                <template x-for="(plan, i) in plans" :key="i">
                                    <div x-show="activeIndex === i" 
                                         x-transition:enter="transition ease-out duration-300 transform"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-200 transform absolute inset-0"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95"
                                         class="w-full h-full flex flex-col items-center justify-center relative pointer-events-auto"
                                         @click.self="lightboxOpen = false">
                                         
                                        <div class="relative w-full h-[70vh] flex items-center justify-center p-4">
                                            <img :src="plan.image" :alt="plan.title" loading="lazy" class="max-w-full max-h-full object-contain rounded-lg bg-white p-4 shadow-[0_0_50px_rgba(255,255,255,0.1)] border border-white/20">
                                        </div>
                                        
                                        <div class="mt-6 text-center">
                                            <h3 x-text="plan.title" class="text-white text-2xl font-bold font-heading mb-3"></h3>
                                            
                                            <div class="flex items-center justify-center gap-6 text-gray-300 text-sm font-medium">
                                                <template x-if="plan.type">
                                                    <span class="flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                        <span x-text="plan.type"></span>
                                                    </span>
                                                </template>
                                                <template x-if="plan.area">
                                                    <span class="flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <span x-text="plan.area"></span>
                                                    </span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Next Button -->
                            <button @click.stop="next()" class="absolute right-4 md:right-10 z-[110] p-3 text-white/50 hover:text-white bg-white/5 hover:bg-brand-accent/50 rounded-full transition-all duration-300 focus:outline-none backdrop-blur-md border border-white/10" x-show="plans.length > 1">
                                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Master Plan -->
                    @if($project->site_plan_image)
                    <div>
                        <span class="text-brand-accent font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 md:mb-4 block">Master Planning</span>
                        <h2 class="text-2xl md:text-3xl font-heading font-black text-brand-dark dark:text-white mb-6 md:mb-10 transition-colors">Site Layout</h2>
                        <div class="relative group cursor-pointer shadow-[0_20px_50px_rgba(0,0,0,0.1)] dark:shadow-none">
                            <div class="absolute -inset-2 bg-gradient-to-r from-brand-accent/0 via-brand-accent/20 to-brand-accent/0 blur-xl opacity-0 group-hover:opacity-100 transition duration-1000"></div>
                            <img src="{{ $project->site_plan_image }}" alt="Site Plan" loading="lazy" class="w-full relative z-10 border border-gray-200 dark:border-gray-800 transition-colors">
                        </div>
                    </div>
                    @endif

                    <!-- Location Map -->
                    @if($project->location_map_image)
                    <div>
                        <span class="text-brand-accent font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 md:mb-4 block">Connectivity</span>
                        <h2 class="text-2xl md:text-3xl font-heading font-black text-brand-dark dark:text-white mb-6 md:mb-10 transition-colors">Location Map</h2>
                        <div class="bg-white dark:bg-gray-900/50 p-4 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-none border border-gray-100 dark:border-gray-800 relative group overflow-hidden transition-colors">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-brand-accent/5 rounded-bl-full z-0 transition-transform group-hover:scale-150 duration-700"></div>
                            <img src="{{ $project->location_map_image }}" alt="Location Map" loading="lazy" class="w-full relative z-10 transform group-hover:scale-[1.01] transition-transform duration-700 mix-blend-multiply dark:mix-blend-normal">
                        </div>
                    </div>
                    @endif

                    <!-- Payment Plan -->
                    @if($project->payment_plan_image || $project->payment_plan_text)
                    <div>
                        <span class="text-brand-accent font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 md:mb-4 block">Investment</span>
                        <h2 class="text-2xl md:text-3xl font-heading font-black text-brand-dark dark:text-white mb-6 md:mb-10 transition-colors">Payment Plan</h2>
                        
                        <div class="bg-white dark:bg-gray-900/50 p-10 shadow-[0_20px_50px_rgba(0,0,0,0.03)] dark:shadow-none border-t-4 border-brand-accent dark:border-gray-800 transition-colors">
                            @if($project->payment_plan_text)
                            <div class="prose prose-sm md:prose-lg text-justify text-gray-600 dark:text-gray-400 mb-8 max-w-none font-light leading-relaxed transition-colors">
                                {!! nl2br(e($project->payment_plan_text)) !!}
                            </div>
                            @endif
                            
                            @if($project->payment_plan_image)
                            <img src="{{ $project->payment_plan_image }}" alt="Payment Plan" loading="lazy" class="w-full border border-gray-100 dark:border-gray-800 transition-colors">
                            @endif
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Right Sidebar: Fixed Enquiry Form -->
                <div class="w-full lg:w-1/3 lg:sticky lg:top-32" id="enquire">
                    <div class="bg-white rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.08)] border border-gray-100 relative overflow-hidden" x-data="{ isSubmitting: false, formErrors: {}, captchaInput: '' }">
                        <!-- Decorative bg -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-accent/5 rounded-bl-full"></div>
                        
                        <div class="p-8 sm:p-10 relative z-10">
                            <span class="text-brand-accent text-[10px] font-bold uppercase tracking-[0.3em] block mb-4 text-center">Exclusive Access</span>
                            <h3 class="text-3xl font-heading font-black text-center mb-8 text-brand-dark">Register Interest</h3>
                            
                            <form class="space-y-5" @submit.prevent="isSubmitting = true; formErrors = {}; fetch('{{ route('frontend.enquire') }}', { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ name: $refs.name.value, email: $refs.email.value, phone: $refs.phone.value, project_name: '{{ addslashes($project->project_name) }}', captcha: captchaInput }) }).then(res => res.json()).then(data => { if(data.message && data.success) { alert(data.message); $refs.name.value=''; $refs.email.value=''; $refs.phone.value=''; captchaInput=''; document.getElementById('sidebarCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random(); } else { formErrors = data.errors || {}; if(data.message && !data.errors) alert(data.message); document.getElementById('sidebarCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random(); captchaInput=''; } }).catch(err => alert('An error occurred. Please try again.')).finally(() => isSubmitting = false)">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Full Name</label>
                                    <input type="text" x-ref="name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition-all">
                                    <template x-if="formErrors.name"><p class="text-red-500 text-xs mt-1" x-text="formErrors.name[0]"></p></template>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Email Address</label>
                                    <input type="email" x-ref="email" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition-all">
                                    <template x-if="formErrors.email"><p class="text-red-500 text-xs mt-1" x-text="formErrors.email[0]"></p></template>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Phone Number</label>
                                    <input type="tel" x-ref="phone" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition-all">
                                    <template x-if="formErrors.phone"><p class="text-red-500 text-xs mt-1" x-text="formErrors.phone[0]"></p></template>
                                </div>
                                
                                <!-- Image Captcha -->
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Security Verification</label>
                                    <div class="flex items-center gap-4 mb-3">
                                        <img src="{{ captcha_src('flat') }}" alt="captcha" class="rounded h-10 border border-gray-200 cursor-pointer" onclick="this.src='{{ captcha_src('flat') }}'+Math.random()" id="sidebarCaptchaImg">
                                        <button type="button" onclick="document.getElementById('sidebarCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random()" class="text-xs text-brand-accent hover:text-brand-dark font-bold uppercase tracking-widest focus:outline-none transition-colors">Refresh</button>
                                    </div>
                                    <input type="text" x-model="captchaInput" placeholder="Enter security code" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-accent focus:border-transparent transition-all placeholder-gray-400">
                                    <template x-if="formErrors.captcha"><p class="text-red-500 text-xs mt-1" x-text="formErrors.captcha[0]"></p></template>
                                </div>
                                
                                <div class="pt-4">
                                    <button type="submit" :disabled="isSubmitting" class="w-full bg-brand-accent text-brand-dark font-bold uppercase tracking-[0.2em] py-4 text-sm rounded-xl hover:bg-brand-dark hover:text-white transition-colors duration-300 shadow-[0_10px_20px_rgba(212,175,55,0.2)] disabled:opacity-50">
                                        <span x-show="!isSubmitting">Request Call Back</span>
                                        <span x-show="isSubmitting">Processing...</span>
                                    </button>
                                </div>
                            </form>
                            <p class="text-[9px] text-center text-gray-400 mt-6 uppercase tracking-[0.2em] leading-relaxed">By submitting, you agree to our privacy policy. Your data is 100% secure.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Resale Properties Section -->
    @if($project->resaleProperties && $project->resaleProperties->where('is_active', true)->count() > 0)
    <section class="py-24 bg-white dark:bg-[#0a0a0a] border-t border-gray-100 dark:border-gray-900 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-brand-accent font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 md:mb-4 block">Exclusive Listings</span>
                <h2 class="text-2xl md:text-4xl font-heading font-black text-brand-dark dark:text-white transition-colors duration-500">Resale Properties</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($project->resaleProperties->where('is_active', true) as $resale)
                <a href="{{ route('frontend.resale_detail', ['category_slug' => $resale->resaleCategory ? $resale->resaleCategory->slug : 'uncategorized', 'slug' => $resale->slug]) }}" class="block bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 hover:border-brand-accent transition-all duration-300 rounded-lg overflow-hidden flex flex-col hover:shadow-lg hover:-translate-y-1 cursor-pointer">
                    @if($resale->image)
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ Storage::url($resale->image) }}" alt="{{ $resale->title }}" loading="lazy" class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-700">
                    </div>
                    @endif
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-heading font-bold text-gray-900 dark:text-white mb-2">{{ $resale->title }}</h3>
                        @if($resale->price)
                            <p class="text-brand-accent font-black text-lg mb-4">{{ $resale->price }}</p>
                        @endif
                        
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400 mb-4 font-medium">
                            @if($resale->area)
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                                {{ $resale->area }}
                            </span>
                            @endif
                            @if($resale->bedrooms)
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                {{ $resale->bedrooms }} Beds
                            </span>
                            @endif
                            @if($resale->bathrooms)
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                {{ $resale->bathrooms }} Baths
                            </span>
                            @endif
                        </div>
                        
                        @if($resale->description)
                            <div class="text-gray-500 dark:text-gray-400 text-sm mb-6 flex-grow line-clamp-3">{!! $resale->description !!}</div>
                        @endif
                        
                        <div class="mt-auto pt-4 border-t border-gray-200 dark:border-gray-800">
                            <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Contact for this property</p>
                            <div class="flex items-center justify-between">
                                <p class="text-brand-dark dark:text-white font-bold flex items-center gap-2">
                                    <svg class="w-4 h-4 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    {{ $resale->contact_name ?? 'Sales Team' }} @if($resale->contact_phone) - {{ $resale->contact_phone }} @endif
                                </p>
                                <span class="text-brand-accent text-xs font-bold uppercase tracking-widest">Enquire &rarr;</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- FAQs Section (Fixed Scope & Dark Mode Ready) -->
    @if($project->faqs->count() > 0)
    <section class="py-24 md:py-32 bg-[#fdfbf7] dark:bg-[#050505] transition-colors duration-500 border-t border-gray-200 dark:border-white/10" x-data="{ activeFaq: null }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <span class="text-brand-accent font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 md:mb-4 block">Knowledge Base</span>
                <h2 class="text-2xl md:text-4xl font-heading font-black text-brand-dark dark:text-white transition-colors duration-500">Frequently Asked Questions</h2>
            </div>
            
            <div class="space-y-4">
                @foreach($project->faqs as $index => $faq)
                <div class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:border-brand-accent/50 dark:hover:border-brand-accent/50 transition-colors duration-300 overflow-hidden shadow-sm dark:shadow-none rounded-xl dark:rounded-none">
                    <button @click="activeFaq = (activeFaq === {{ $index }} ? null : {{ $index }})" class="w-full px-5 py-4 md:px-8 md:py-6 text-left flex justify-between items-center focus:outline-none group">
                        <span class="font-bold text-base md:text-lg text-gray-900 dark:text-white group-hover:text-brand-accent transition-colors pr-4 md:pr-8">{{ $faq->question }}</span>
                        <span class="flex-shrink-0 flex items-center justify-center w-8 h-8 md:w-12 md:h-12 rounded-full border border-gray-200 dark:border-white/20 group-hover:border-brand-accent transition-colors bg-gray-50 dark:bg-transparent">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-brand-accent transform transition-transform duration-500" :class="{ 'rotate-180': activeFaq === {{ $index }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div x-show="activeFaq === {{ $index }}" x-collapse x-cloak>
                        <div class="px-5 pb-5 md:px-8 md:pb-8 pt-0 text-gray-600 dark:text-gray-400 text-sm md:text-lg text-justify leading-relaxed font-light">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
