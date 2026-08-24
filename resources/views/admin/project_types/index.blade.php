@extends('layouts.admin')
@section('header', 'Manage Project Types')
@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Project Types</h3>
        <a href="{{ route('admin.project-types.create') }}" class="bg-brand hover:bg-brand-dark text-white font-medium py-2 px-4 rounded transition inline-block">
            Add New Project Type
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projectTypes as $projectType)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $projectType->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $projectType->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold {{ $projectType->status ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full">
                            {{ $projectType->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.project-types.edit', $projectType) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        <form action="{{ route('admin.project-types.destroy', $projectType) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this project type?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center">No Project Types found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $projectTypes->links() }}
    </div>
</div>
@endsection
