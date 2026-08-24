<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;
use App\Models\Project;
use App\Models\Brand;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProjects = Project::count();
        $activeBrands = Brand::where('status', 1)->count();
        $totalLeads = Lead::count();
        $recentLeads = Lead::with('project')->latest()->take(5)->get();
        $websiteViews = \App\Models\SiteSetting::first()->total_views ?? 0;
        
        $blogStats = [];
        $user = auth()->user();
        if ($user && $user->hasRole('blog_admin')) {
            $blogStats = [
                'total' => \App\Models\Blog::where('user_id', $user->id)->count(),
                'active' => \App\Models\Blog::where('user_id', $user->id)->where('status', 1)->count(),
                'inactive' => \App\Models\Blog::where('user_id', $user->id)->where('status', 0)->count(),
            ];
        }

        return view('admin.dashboard', compact('totalProjects', 'activeBrands', 'totalLeads', 'recentLeads', 'websiteViews', 'blogStats'));
    }
}
