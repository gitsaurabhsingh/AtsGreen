@extends('layouts.admin')
@section('header', 'Edit Project Type')
@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-4xl">
    <form action="{{ route('admin.project-types.update', $projectType) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Project Type Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50 px-3 py-2 border" value="{{ old('name', $projectType->name) }}">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center mt-6">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $projectType->status) ? 'checked' : '' }} class="h-4 w-4 text-brand focus:ring-brand border-gray-300 rounded">
                <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-8 border-t pt-4">
            <a href="{{ route('admin.project-types.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-brand text-white rounded-md hover:bg-brand-dark transition">Update Project Type</button>
        </div>
    </form>
</div>
@endsection
