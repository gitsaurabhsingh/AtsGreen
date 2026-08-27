@extends('layouts.admin')

@section('header', 'Create New Blog Post')

@section('content')
@php
    $prefix = request()->is('admin*') ? 'admin' : 'blog-admin';
@endphp
<div class="max-w-7xl mx-auto">
    <form action="{{ route($prefix.'.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col lg:flex-row gap-6">
            
            <!-- Main Content Area -->
            <div class="flex-1 space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                        <h3 class="text-base font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Post Details
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Post Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" required placeholder="Enter a catchy title..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-brand/20 focus:border-brand text-lg py-3 transition-colors">
                            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>



                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Content</label>
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <textarea name="content" id="editor" rows="15" class="w-full border-none focus:ring-0">{{ old('content') }}</textarea>
                            </div>
                            @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-80 space-y-6">
                <!-- Publish Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                        <h3 class="text-base font-semibold text-gray-800">Publish</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            @if(auth()->user()->hasRole('blog_admin'))
                                <input type="hidden" name="status" value="0">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <p class="text-sm text-yellow-700 bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Your post will be submitted for Admin approval.
                                </p>
                            @else
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                                <select name="status" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-brand/20 focus:border-brand transition-colors">
                                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Published</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft</option>
                                </select>
                                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            @endif
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                            <a href="{{ route($prefix.'.blogs.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Cancel</a>
                            <button type="submit" class="bg-brand hover:bg-brand-dark text-white font-medium py-2.5 px-5 rounded-lg shadow-sm hover:shadow transition-all duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Save Post
                            </button>
                        </div>
                    </div>
                </div>



                <!-- Meta Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                        <h3 class="text-base font-semibold text-gray-800">Organization</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                            <select name="blog_category_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-brand/20 focus:border-brand transition-colors">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('blog_category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                            <input type="text" name="author" value="{{ old('author', Auth::user()->name ?? '') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-brand/20 focus:border-brand transition-colors">
                            @error('author')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Image Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                        <h3 class="text-base font-semibold text-gray-800">Featured Image</h3>
                    </div>
                    <div class="p-6">
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-brand transition-colors group cursor-pointer relative" id="image-drop-area">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-brand transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="featured_image" class="relative cursor-pointer bg-white rounded-md font-medium text-brand hover:text-brand-dark focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand">
                                        <span>Upload a file</span>
                                        <input id="featured_image" name="featured_image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                        </div>
                        <div id="image-preview" class="mt-4 hidden rounded-lg overflow-hidden border border-gray-200"></div>
                        @error('featured_image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Banner Image Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                        <h3 class="text-base font-semibold text-gray-800">Banner Image</h3>
                    </div>
                    <div class="p-6">
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-brand transition-colors group cursor-pointer relative" id="banner-drop-area">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-brand transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="banner_image" class="relative cursor-pointer bg-white rounded-md font-medium text-brand hover:text-brand-dark focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand">
                                        <span>Upload a file</span>
                                        <input id="banner_image" name="banner_image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                        </div>
                        <div id="banner-preview" class="mt-4 hidden rounded-lg overflow-hidden border border-gray-200"></div>
                        @error('banner_image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<!-- Add CKEditor script for rich text editing -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
        })
        .catch(error => {
            console.error(error);
        });

    // Simple image preview logic
    const imageInput = document.getElementById('featured_image');
    const imagePreview = document.getElementById('image-preview');
    const dropArea = document.getElementById('image-drop-area');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = '<img src="' + e.target.result + '" class="w-full h-auto object-cover" />';
                imagePreview.classList.remove('hidden');
                dropArea.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    const bannerInput = document.getElementById('banner_image');
    const bannerPreview = document.getElementById('banner-preview');
    const bannerDropArea = document.getElementById('banner-drop-area');

    bannerInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                bannerPreview.innerHTML = '<img src="' + e.target.result + '" class="w-full h-auto object-cover" />';
                bannerPreview.classList.remove('hidden');
                bannerDropArea.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        border-bottom-left-radius: 0.5rem !important;
        border-bottom-right-radius: 0.5rem !important;
    }
    .ck-toolbar {
        border-top-left-radius: 0.5rem !important;
        border-top-right-radius: 0.5rem !important;
        background-color: #f9fafb !important;
        border-color: #e5e7eb !important;
    }
</style>
@endsection
