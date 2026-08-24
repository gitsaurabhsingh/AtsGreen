@extends('layouts.admin')

@section('header', 'Users Management')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-lg font-semibold text-gray-800">All Users</h3>
    <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-brand text-white rounded-md hover:bg-brand-dark transition">Add User</a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Role</th>
                <th scope="col" class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="bg-white border-b">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    @if($user->roles->count() > 0)
                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">{{ $user->roles->first()->name }}</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">Super Admin</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.users.edit', $user) }}" class="font-medium text-blue-600 hover:underline mr-3">Edit</a>
                    @if(auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
