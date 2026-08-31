@extends('layouts.admin')

@section('header', 'Manage Blogs')

@section('content')
@php
    $prefix = request()->is('admin*') ? 'admin' : 'blog-admin';
@endphp
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
        <h3 class="text-lg font-semibold text-gray-800">Blogs</h3>
        
        <div class="flex items-center gap-4 w-full md:w-auto">
            <form action="{{ route($prefix.'.blogs.index') }}" method="GET" class="w-full md:w-64">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blogs..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </form>

            <a href="{{ route($prefix.'.blogs.create') }}" class="bg-brand hover:bg-brand-dark text-white font-medium py-2 px-4 rounded transition inline-block whitespace-nowrap">
                Add New Blog
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $blog->id }}</td>
                    <td class="px-6 py-4">
                        @if($blog->featured_image)
                            <img src="{{ $blog->featured_image }}" alt="Featured Image" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 text-sm">{{ Str::limit($blog->title, 50) }}</td>
                    <td class="px-6 py-4">{{ $blog->blogCategory->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $blog->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($blog->is_rejected)
                            <span class="px-3 py-1 text-xs font-semibold rounded-full text-red-800 bg-red-100">
                                Rejected
                            </span>
                        @elseif($blog->status)
                            <span class="px-3 py-1 text-xs font-semibold rounded-full text-green-800 bg-green-100">
                                Published
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full text-yellow-800 bg-yellow-100">
                                Pending Approval
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('frontend.blog_detail', ['category_slug' => $blog->blogCategory->slug ?? 'uncategorized', 'slug' => $blog->slug]) }}" target="_blank" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md transition inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View
                            </a>
                            <a href="{{ route($prefix.'.blogs.edit', $blog) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md transition inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <form action="{{ route($prefix.'.blogs.destroy', $blog) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete
                                </button>
                            </form>
                            @if(!auth()->user()->hasRole('blog_admin'))
                                @if(!$blog->status && !$blog->is_rejected)
                                    <form action="{{ route('admin.blogs.approve', $blog) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-700 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-md transition inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.blogs.reject', $blog) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to reject this blog?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-orange-700 hover:text-orange-900 bg-orange-50 hover:bg-orange-100 px-3 py-1.5 rounded-md transition inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Reject
                                        </button>
                                    </form>
                                @elseif($blog->is_rejected)
                                    <form action="{{ route('admin.blogs.approve', $blog) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-700 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-md transition inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Approve
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center">No blogs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
