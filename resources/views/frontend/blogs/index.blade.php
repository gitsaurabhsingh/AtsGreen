@extends('frontend.layout')

@section('title', 'Insights & Updates')

@section('content')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden bg-brand-dark">
    <div class="absolute inset-0 brand-gradient opacity-40"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-black text-white mb-6 tracking-tight leading-tight opacity-0 translate-y-8" x-intersect.once="$el.classList.add('opacity-100', 'translate-y-0', 'transition-all', 'duration-1000', 'ease-out')">
            Insights & <span class="text-brand-accent italic font-serif">Updates</span>
        </h1>
        <p class="text-gray-300 max-w-2xl mx-auto text-lg md:text-xl font-light tracking-wide opacity-0 translate-y-8" x-intersect.once="$el.classList.add('opacity-100', 'translate-y-0', 'transition-all', 'duration-1000', 'delay-300', 'ease-out')">
            Discover the latest trends, news, and insights from the world of premium real estate.
        </p>
    </div>
</section>

<!-- Blog Listing -->
<section class="py-20 md:py-32 bg-[#fdfbf7] dark:bg-[#050505] relative z-20 -mt-10 rounded-t-3xl border-t border-brand-accent/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
                <article class="bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-800 group hover:shadow-2xl hover:shadow-brand-accent/10 transition-all duration-500 hover:-translate-y-2 flex flex-col h-full">
                    <a href="{{ route('frontend.blog_detail', ['category_slug' => $blog->blogCategory->slug ?? 'uncategorized', 'slug' => $blog->slug]) }}/" class="block relative overflow-hidden h-60">
                        @if($blog->featured_image)
                            <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                        @else
                            <div class="w-full h-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center">
                                <span class="text-gray-400 font-heading tracking-widest uppercase">ATS</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @if($blog->blogCategory)
                            <div class="absolute top-4 left-4 bg-brand-accent text-brand-dark text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-sm">
                                {{ $blog->blogCategory->name }}
                            </div>
                        @endif
                    </a>
                    
                    <div class="p-6 md:p-8 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-bold text-brand-accent uppercase tracking-widest">{{ $blog->created_at->format('M d, Y') }}</span>
                            @if($blog->author)
                                <span class="text-[11px] text-gray-500 dark:text-gray-400">By {{ $blog->author }}</span>
                            @endif
                        </div>
                        
                        <h2 class="text-xl md:text-2xl font-heading font-bold text-gray-900 dark:text-white mb-4 line-clamp-2 group-hover:text-brand-accent transition-colors">
                            <a href="{{ route('frontend.blog_detail', ['category_slug' => $blog->blogCategory->slug ?? 'uncategorized', 'slug' => $blog->slug]) }}/">{{ $blog->title }}</a>
                        </h2>
                        
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 line-clamp-3 font-light leading-relaxed flex-1 text-justify">
                            {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}
                        </p>
                        
                        <div class="mt-auto pt-6 border-t border-gray-100 dark:border-gray-800">
                            <a href="{{ route('frontend.blog_detail', ['category_slug' => $blog->blogCategory->slug ?? 'uncategorized', 'slug' => $blog->slug]) }}/" class="inline-flex items-center text-sm font-bold text-brand-dark dark:text-white group/btn hover:text-brand-accent transition-colors uppercase tracking-widest">
                                Read More
                                <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="w-20 h-20 bg-brand-accent/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white mb-2">No Articles Yet</h3>
                    <p class="text-gray-500 dark:text-gray-400">Check back later for updates and insights.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-16 flex justify-center">
            {{ $blogs->links() }}
        </div>
    </div>
</section>

@endsection
