@extends('layouts.admin')

@section('header', 'Manage Leads')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Leads</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $lead->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $lead->name }}</td>
                    <td class="px-6 py-4">{{ $lead->email }}</td>
                    <td class="px-6 py-4">{{ $lead->phone }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">New</span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center">No leads found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $leads->links() }}
    </div>
</div>
@endsection
