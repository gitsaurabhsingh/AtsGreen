@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
@unless(auth()->user()->hasRole('blog_admin'))
<div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card 1 -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-3 mr-4 text-brand bg-brand-light bg-opacity-20 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">Total Projects</p>
            <p class="text-lg font-semibold text-gray-700">{{ $totalProjects }}</p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-3 mr-4 text-brand bg-brand-light bg-opacity-20 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">Active Brands</p>
            <p class="text-lg font-semibold text-gray-700">{{ $activeBrands }}</p>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-3 mr-4 text-brand bg-brand-light bg-opacity-20 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">Total Leads</p>
            <p class="text-lg font-semibold text-gray-700">{{ $totalLeads }}</p>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-3 mr-4 text-brand bg-brand-light bg-opacity-20 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">Website Views</p>
            <p class="text-lg font-semibold text-gray-700">{{ number_format($websiteViews) }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Leads</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3">Project</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLeads as $lead)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $lead->name }}</td>
                    <td class="px-6 py-4">{{ $lead->phone }}</td>
                    <td class="px-6 py-4">{{ $lead->project ? $lead->project->project_name : ($lead->source ?? 'General') }}</td>
                    <td class="px-6 py-4">{{ $lead->created_at->format('M d, Y h:i A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        No recent leads found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@else
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-8">
    <h3 class="text-xl font-semibold text-gray-800 mb-2">Welcome, {{ auth()->user()->name }}!</h3>
    <p class="text-gray-600">Here is a quick overview of your blog contributions.</p>
</div>

<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    <!-- Total Blogs -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-3 mr-4 text-brand bg-brand-light bg-opacity-20 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">Total Blogs Posted</p>
            <p class="text-2xl font-bold text-gray-700">{{ $blogStats['total'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Active Blogs -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-green-100">
        <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">Active Blogs</p>
            <p class="text-2xl font-bold text-green-700">{{ $blogStats['active'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Inactive Blogs -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-red-100">
        <div class="p-3 mr-4 text-red-600 bg-red-100 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600">Inactive / Draft Blogs</p>
            <p class="text-2xl font-bold text-red-700">{{ $blogStats['inactive'] ?? 0 }}</p>
        </div>
    </div>
</div>
@endunless
@endsection
