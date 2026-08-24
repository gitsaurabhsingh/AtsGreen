@extends('layouts.admin')

@section('header')
    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
        <svg class="w-6 h-6 mr-2 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Add New Category
    </h2>
@endsection

@section('content')
@php
    $prefix = request()->is('admin*') ? 'admin' : 'blog-admin';
@endphp
<div class="max-w-2xl mx-auto mt-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
            <h3 class="text-base font-semibold text-gray-800">Category Details</h3>
        </div>
        <form action="{{ route($prefix.'.blog-categories.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Market Trends" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-brand/20 focus:border-brand transition-colors py-2.5">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-brand/20 focus:border-brand transition-colors py-2.5">
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex items-center justify-between mt-8 pt-5 border-t border-gray-100">
                <a href="{{ route($prefix.'.blog-categories.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Cancel</a>
                <button type="submit" class="bg-brand hover:bg-brand-dark text-white font-medium py-2.5 px-6 rounded-lg shadow-sm hover:shadow transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
