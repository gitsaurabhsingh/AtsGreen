@extends('frontend.layout')

@section('title', $blog->title)
@section('meta_description', Str::limit(strip_tags($blog->content), 160))
@section('meta_keywords', 'ATS Greens, real estate blog, ' . $blog->title)

@section('content')

<!-- Blog Main Section -->
@if($blog->banner_image)
<div class="w-full h-64 md:h-96 lg:h-[30rem] mt-24 md:mt-28 relative overflow-hidden">
    <img src="{{ $blog->banner_image }}" alt="{{ $blog->title }} Banner" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/20"></div>
</div>
<section class="pt-12 pb-16 md:pb-24 bg-[#fcfcfc]">
@else
<section class="pt-32 pb-16 md:pt-40 md:pb-24 bg-[#fcfcfc]">
@endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left Content Column -->
            <div class="lg:col-span-2">
                <!-- Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-heading font-extrabold text-[#0f172a] mb-8 leading-[1.3] tracking-tight">
                    {{ $blog->title }}
                </h1>
                
                <!-- Featured Image -->
                @if($blog->featured_image)
                    <div class="mb-10 rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                        <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-auto aspect-video object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                @endif
                
                <!-- Content -->
                <article class="prose prose-lg max-w-none text-justify text-gray-700 prose-headings:font-heading prose-headings:font-bold prose-headings:text-[#0f172a] prose-a:text-brand prose-img:rounded-xl">
                    {!! $blog->content !!}
                </article>
            </div>
            
            <!-- Right Sidebar Column -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 space-y-8">
                    
                    <!-- Article Details Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h3 class="text-xl font-bold font-heading text-[#0f172a] mb-6 border-b border-gray-100 pb-4">Article Details</h3>
                        
                        <div class="space-y-6">
                            <!-- Author -->
                            <div class="flex items-center">
                                @php
                                    $authorName = $blog->author ?: 'Admin';
                                    $initials = collect(explode(' ', $authorName))->map(function($segment) { return strtoupper(substr($segment, 0, 1)); })->take(2)->join('');
                                @endphp
                                <div class="w-12 h-12 rounded-full bg-[#3b5bdb] text-white flex items-center justify-center font-bold text-lg shadow-md mr-4 flex-shrink-0">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-0.5">Posted by</p>
                                    <p class="text-sm font-bold text-[#0f172a]">{{ $authorName }}</p>
                                </div>
                            </div>
                            
                            <!-- Published Date -->
                            <div class="flex items-center">
                                <div class="w-12 flex justify-center mr-4 text-blue-500 flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-0.5">Published on</p>
                                    <p class="text-sm font-bold text-[#0f172a]">{{ $blog->created_at->format('F d, Y') }}</p>
                                </div>
                            </div>
                            
                            <!-- Total Views -->
                            <div class="flex items-center">
                                <div class="w-12 flex justify-center mr-4 text-yellow-500 flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-0.5">Total Views</p>
                                    <p class="text-sm font-bold text-[#0f172a]">{{ number_format($blog->views) }} Views</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Latest Articles Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h3 class="text-xl font-bold font-heading text-[#0f172a] mb-6 border-b border-gray-100 pb-4">Latest Articles</h3>
                        
                        <div class="space-y-6">
                            @foreach($latestBlogs as $latest)
                                <div class="flex items-start group">
                                    <a href="{{ route('frontend.blog_detail', ['category_slug' => $latest->blogCategory->slug ?? 'uncategorized', 'slug' => $latest->slug]) }}/" class="block w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden mr-4 border border-gray-100">
                                        @if($latest->featured_image)
                                            <img src="{{ $latest->featured_image }}" alt="{{ $latest->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </a>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-[#0f172a] mb-2 line-clamp-2 group-hover:text-brand transition-colors">
                                            <a href="{{ route('frontend.blog_detail', ['category_slug' => $latest->blogCategory->slug ?? 'uncategorized', 'slug' => $latest->slug]) }}/">{{ $latest->title }}</a>
                                        </h4>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $latest->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection
