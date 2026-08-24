@extends('layouts.admin')

@section('header')
    Hero Sliders
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Manage Hero Sliders</h2>
    <a href="{{ route('admin.hero-sliders.create') }}" class="bg-brand hover:bg-brand-light text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Add New Slide</a>
</div>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heading</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($sliders as $slider)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <img src="{{ $slider->image }}" alt="Slide" class="h-16 w-32 object-cover rounded shadow-sm">
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 font-medium">{{ strip_tags($slider->heading) ?: 'N/A' }}</div>
                    <div class="text-xs text-gray-500 truncate w-48">{{ $slider->subheading }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $slider->sort_order }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($slider->status)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.hero-sliders.edit', $slider) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                    <form action="{{ route('admin.hero-sliders.destroy', $slider) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No slides found. Create one to get started.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
