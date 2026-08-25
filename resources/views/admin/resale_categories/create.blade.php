@extends('layouts.admin')

@section('header', 'Add Resale Category')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-2xl">
    
    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded relative">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.resale-categories.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50" required>
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-brand shadow-sm focus:border-brand focus:ring focus:ring-brand focus:ring-opacity-50" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-600">Active</span>
            </label>
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.resale-categories.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 text-sm font-medium">Cancel</a>
            <button type="submit" class="bg-brand hover:bg-brand-dark text-white font-medium py-2 px-6 rounded transition">
                Save Category
            </button>
        </div>
    </form>
</div>
@endsection
