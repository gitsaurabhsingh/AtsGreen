@extends('frontend.layout')

@section('title', 'Contact Us')

@section('content')
    <!-- Advanced Hero Section -->
    <div class="relative pt-32 pb-32 flex content-center items-center justify-center min-h-[70vh] bg-[#050505] overflow-hidden group" x-data="{ scrolled: 0 }" @scroll.window="scrolled = window.pageYOffset">
        <!-- Parallax Background -->
        <div class="absolute inset-0 z-0 overflow-hidden" :style="'transform: translateY(' + (scrolled * 0.4) + 'px)'">
            @if(isset($siteSetting) && $siteSetting->contact_image)
                <img src="{{ $siteSetting->contact_image }}" alt="Contact Us" class="w-full h-full object-cover opacity-50 filter brightness-75 scale-105">
            @else
                <img src="https://images.unsplash.com/photo-1577979749830-f1d742b96791?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Contact Us" class="w-full h-full object-cover opacity-50 filter brightness-75 scale-105">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#fdfbf7] dark:from-[#050505] via-transparent to-black/50 transition-colors duration-500"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 pt-16 text-center"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">
            <span x-show="show" x-transition.opacity.duration.1000ms.delay.200ms class="text-brand-accent font-bold tracking-[0.4em] uppercase text-[10px] mb-6 block flex items-center justify-center gap-4">
                <span class="w-12 h-[1px] bg-brand-accent"></span>
                Connect With Us
                <span class="w-12 h-[1px] bg-brand-accent"></span>
            </span>
            <h1 x-show="show" x-transition.opacity.translate-y.duration.1000ms class="text-white dark:text-white font-serif font-bold text-5xl md:text-7xl lg:text-8xl tracking-wide leading-[1.1] mb-6 drop-shadow-2xl">
                Get In <span class="italic text-brand-accent font-light relative inline-block">
                    Touch
                    <span class="absolute inset-0 blur-[12px] opacity-40 bg-brand-accent rounded-full -z-10 animate-pulse"></span>
                </span>
            </h1>
            <p x-show="show" x-transition.opacity.translate-y.duration.1000ms.delay.300ms class="text-gray-300 max-w-2xl mx-auto text-lg md:text-xl font-light tracking-wider">
                Experience bespoke service and exclusive consultations for your next luxury investment.
            </p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="bg-[#fdfbf7] dark:bg-[#050505] py-24 relative z-20 transition-colors duration-500">
        <!-- Abstract BG Elements -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-accent/5 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col lg:flex-row gap-16 lg:gap-24">
                
                <!-- Contact Details -->
                <div class="w-full lg:w-5/12 space-y-12">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-brand-dark dark:text-white mb-6 leading-tight">Reach Out to <br/>Our <span class="italic text-brand-accent font-light">Experts</span></h2>
                        <div class="w-20 h-1 bg-brand-accent mb-6"></div>
                        <p class="text-gray-600 dark:text-gray-400 font-light leading-relaxed text-lg">
                            Whether you're inquiring about our signature projects or looking to schedule a private viewing, our dedicated team is at your service.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Office Card -->
                        <div class="group relative bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                            <div class="absolute inset-0 bg-brand-accent/0 group-hover:bg-brand-accent/5 transition-colors duration-500"></div>
                            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-brand-accent/20 to-transparent rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-150 duration-700"></div>
                            
                            <div class="flex items-start relative z-10">
                                <div class="flex-shrink-0 w-14 h-14 bg-gray-50 dark:bg-gray-800 rounded-2xl flex items-center justify-center text-brand-accent shadow-inner border border-gray-100 dark:border-gray-700 group-hover:border-brand-accent/50 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div class="ml-6">
                                    <h4 class="text-[10px] font-bold tracking-[0.2em] uppercase text-gray-500 dark:text-gray-400 mb-2 group-hover:text-brand-accent transition-colors">Real Estate</h4>
                                    <p class="text-brand-dark dark:text-white font-medium leading-relaxed text-sm">
                                        {!! isset($siteSetting) && $siteSetting->footer_address ? nl2br(e($siteSetting->footer_address)) : 'ATS Tower, Sector 135,<br/>Noida, UP 201305' !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Direct Line Card -->
                        <div class="group relative bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                            <div class="absolute inset-0 bg-brand-accent/0 group-hover:bg-brand-accent/5 transition-colors duration-500"></div>
                            
                            <div class="flex items-start relative z-10">
                                <div class="flex-shrink-0 w-14 h-14 bg-gray-50 dark:bg-gray-800 rounded-2xl flex items-center justify-center text-brand-accent shadow-inner border border-gray-100 dark:border-gray-700 group-hover:border-brand-accent/50 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div class="ml-6">
                                    <h4 class="text-[10px] font-bold tracking-[0.2em] uppercase text-gray-500 dark:text-gray-400 mb-2 group-hover:text-brand-accent transition-colors">Direct Line</h4>
                                    <p class="text-brand-dark dark:text-white font-medium leading-relaxed text-sm">
                                        {{ isset($siteSetting) && $siteSetting->footer_phone ? $siteSetting->footer_phone : '+91 98765 43210' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div class="group relative bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                            <div class="absolute inset-0 bg-brand-accent/0 group-hover:bg-brand-accent/5 transition-colors duration-500"></div>
                            
                            <div class="flex items-start relative z-10">
                                <div class="flex-shrink-0 w-14 h-14 bg-gray-50 dark:bg-gray-800 rounded-2xl flex items-center justify-center text-brand-accent shadow-inner border border-gray-100 dark:border-gray-700 group-hover:border-brand-accent/50 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="ml-6">
                                    <h4 class="text-[10px] font-bold tracking-[0.2em] uppercase text-gray-500 dark:text-gray-400 mb-2 group-hover:text-brand-accent transition-colors">Email Address</h4>
                                    <p class="text-brand-dark dark:text-white font-medium leading-relaxed text-sm">
                                        {{ isset($siteSetting) && $siteSetting->footer_email ? $siteSetting->footer_email : 'luxury@ats-greens.co.in' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($siteSetting) && $siteSetting->contact_content)
                    <div class="mt-12 prose prose-lg prose-headings:font-serif prose-headings:font-bold prose-headings:text-brand-dark dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-400 prose-p:leading-relaxed max-w-none transition-colors">
                        {!! $siteSetting->contact_content !!}
                    </div>
                    @endif
                </div>

                <!-- Contact Form (Solid Premium Style) -->
                <div class="w-full lg:w-7/12 relative">
                    <div class="bg-white dark:bg-[#0a0a0a] rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-gray-100 dark:border-gray-800 p-8 sm:p-14 relative overflow-hidden" x-data="{ isSubmitting: false, formErrors: {}, captchaInput: '', focused: null }">
                        
                        <!-- Top Accent Line -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-accent to-transparent"></div>
                        
                        <div class="mb-10 text-center">
                            <h3 class="text-3xl font-serif font-bold text-brand-dark dark:text-white mb-3">Send a Message</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm tracking-wide">Please fill out the form below and our experts will contact you shortly.</p>
                        </div>
                        
                        <form class="space-y-6" @submit.prevent="isSubmitting = true; formErrors = {}; fetch('{{ route('frontend.enquire') }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ name: $refs.name.value, email: $refs.email.value, phone: $refs.phone.value, project_name: 'Contact Page Enquiry', captcha: captchaInput }) }).then(res => res.json()).then(data => { if(data.message && data.success) { alert(data.message); $refs.name.value=''; $refs.email.value=''; $refs.phone.value=''; captchaInput=''; document.getElementById('contactCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random(); } else { formErrors = data.errors || {}; if(data.message && !data.errors) alert(data.message); document.getElementById('contactCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random(); captchaInput=''; } }).finally(() => isSubmitting = false)">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Full Name</label>
                                    <input type="text" x-ref="name" required class="w-full bg-[#f9f9f9] dark:bg-[#111] border border-gray-200 dark:border-gray-800 rounded-xl px-5 py-4 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-brand-accent focus:border-brand-accent transition-all">
                                    <template x-if="formErrors.name"><p class="text-red-500 text-xs mt-1" x-text="formErrors.name[0]"></p></template>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
                                    <input type="tel" x-ref="phone" required class="w-full bg-[#f9f9f9] dark:bg-[#111] border border-gray-200 dark:border-gray-800 rounded-xl px-5 py-4 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-brand-accent focus:border-brand-accent transition-all">
                                    <template x-if="formErrors.phone"><p class="text-red-500 text-xs mt-1" x-text="formErrors.phone[0]"></p></template>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Email Address</label>
                                <input type="email" x-ref="email" required class="w-full bg-[#f9f9f9] dark:bg-[#111] border border-gray-200 dark:border-gray-800 rounded-xl px-5 py-4 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-brand-accent focus:border-brand-accent transition-all">
                                <template x-if="formErrors.email"><p class="text-red-500 text-xs mt-1" x-text="formErrors.email[0]"></p></template>
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Security Verification</label>
                                <div class="flex items-center gap-4 mb-3">
                                    <img src="{{ captcha_src('flat') }}" alt="captcha" class="rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer h-12" onclick="this.src='{{ captcha_src('flat') }}'+Math.random()" id="contactCaptchaImg">
                                    <button type="button" onclick="document.getElementById('contactCaptchaImg').src='{{ captcha_src('flat') }}'+Math.random()" class="text-[10px] text-brand-accent hover:text-brand-dark dark:hover:text-white font-bold uppercase tracking-widest focus:outline-none transition-colors">Refresh</button>
                                </div>
                                <input type="text" x-model="captchaInput" placeholder="Enter security code" required class="w-full bg-[#f9f9f9] dark:bg-[#111] border border-gray-200 dark:border-gray-800 rounded-xl px-5 py-4 text-sm text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-brand-accent focus:border-brand-accent transition-all">
                                <template x-if="formErrors.captcha"><p class="text-red-500 text-xs mt-1" x-text="formErrors.captcha[0]"></p></template>
                            </div>
                            
                            <div class="pt-6">
                                <button type="submit" :disabled="isSubmitting" class="w-full bg-brand-accent text-brand-dark font-bold uppercase tracking-[0.2em] py-5 text-sm rounded-xl hover:bg-brand-dark hover:text-white transition-all duration-300 shadow-[0_10px_20px_rgba(212,175,55,0.2)] disabled:opacity-50 border border-brand-accent">
                                    <span x-show="!isSubmitting">Submit Enquiry</span>
                                    <span x-show="isSubmitting">Processing...</span>
                                </button>
                                <p class="text-[10px] text-center text-gray-400 mt-4 uppercase tracking-wider font-medium">Your information is strictly confidential.</p>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
