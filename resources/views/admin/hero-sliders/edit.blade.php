@extends('layouts.admin')

@section('header')
    <div class="flex items-center space-x-3">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Edit Banner</h2>
    </div>
@endsection

@section('content')
<div class="mb-6 flex items-center">
    <a href="{{ route('admin.hero-sliders.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-brand transition-colors group">
        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Sliders
    </a>
</div>

<div class="max-w-4xl">
    <form action="{{ route('admin.hero-sliders.update', $heroSlider) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-md shadow-sm border border-gray-100 p-6 space-y-6">
        @csrf
        @method('PUT')
        
        @if($heroSlider->image)
        <div>
            <label class="block text-sm font-bold text-gray-800 mb-2">Current Banner Image</label>
            <img src="{{ $heroSlider->image }}" alt="Banner Image" class="h-32 object-cover rounded-md border border-gray-200">
        </div>
        @endif

        <div>
            <label class="block text-sm font-bold text-gray-800 mb-2">Replace Image</label>
            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md
                file:mr-4 file:py-2 file:px-4
                file:border-0 file:border-r file:border-gray-300
                file:text-sm file:font-semibold
                file:bg-gray-50 file:text-gray-700
                hover:file:bg-gray-100 cursor-pointer" accept="image/*">
            <p class="mt-1 text-xs text-gray-500">Leave empty to keep the current image.</p>
            @error('image') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="target_url" class="block text-sm font-bold text-gray-800 mb-2">Target URL</label>
            <input type="url" name="target_url" id="target_url" value="{{ old('target_url', $heroSlider->target_url) }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3" placeholder="https://">
            <p class="mt-1 text-xs text-gray-500">Where should users go when they click the banner?</p>
            @error('target_url') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="start_date" class="block text-sm font-bold text-gray-800 mb-2">Start Time</label>
                <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', $heroSlider->start_date ? $heroSlider->start_date->format('Y-m-d\TH:i') : '') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                <p class="mt-1 text-xs text-gray-500">Leave empty to show immediately.</p>
                @error('start_date') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="end_date" class="block text-sm font-bold text-gray-800 mb-2">End Time</label>
                <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $heroSlider->end_date ? $heroSlider->end_date->format('Y-m-d\TH:i') : '') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                <p class="mt-1 text-xs text-gray-500">Banner will hide automatically after this time.</p>
                @error('end_date') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <label class="flex items-start cursor-pointer">
                <div class="relative flex items-center h-5">
                    <input type="checkbox" name="status" value="1" class="sr-only peer" {{ old('status', $heroSlider->status) ? 'checked' : '' }}>
                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                </div>
                <div class="ml-3">
                    <span class="block text-sm font-bold text-gray-800">Active Banner</span>
                    <span class="block text-xs text-gray-500 mt-1">If unchecked, the banner will be hidden regardless of the scheduled time.</span>
                </div>
            </label>
        </div>

        <!-- Optional fields hidden in this view but kept for data integrity if needed, or we just submit without them -->
        <div class="hidden">
            <input type="number" name="sort_order" value="{{ old('sort_order', $heroSlider->sort_order) }}">
            <input type="text" name="heading" value="{{ old('heading', $heroSlider->heading) }}">
            <textarea name="subheading">{{ old('subheading', $heroSlider->subheading) }}</textarea>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-6 rounded-md shadow-sm focus:outline-none transition-colors">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
