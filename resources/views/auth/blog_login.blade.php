<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <!-- Logo / Title -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-white tracking-tight drop-shadow-lg mb-2">ATS Blog Admin</h1>
            <p class="text-white/90 font-medium tracking-wide">Enter your credentials to access the blog dashboard</p>
        </div>

        <div class="glass-panel rounded-3xl overflow-hidden">
            <div class="p-8 sm:p-10">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('blog-user.login.submit') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-4 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition-all duration-300 bg-white/60 backdrop-blur-sm text-gray-900 shadow-sm" placeholder="blog@ats.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm font-medium" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-gray-800">{{ __('Password') }}</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-700 hover:text-blue-900 font-bold transition-colors">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-4 focus:ring-blue-500/30 focus:border-blue-600 outline-none transition-all duration-300 bg-white/60 backdrop-blur-sm text-gray-900 shadow-sm" placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm font-medium" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-8">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 transition-colors cursor-pointer" name="remember">
                            <span class="ml-3 text-sm text-gray-700 font-medium group-hover:text-gray-900 transition-colors">{{ __('Remember me for 30 days') }}</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                        {{ __('Sign In to Blog Dashboard') }}
                    </button>
                </form>
            </div>
            
            <div class="bg-gray-100/50 px-8 py-5 border-t border-gray-200/50 text-center">
                <p class="text-xs text-gray-600 font-semibold">&copy; {{ date('Y') }} ATS Real Estate. All rights reserved.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
