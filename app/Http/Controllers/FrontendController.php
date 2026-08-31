<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Project;
use App\Models\Blog;

class FrontendController extends Controller
{
    public function home()
    {
        $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
        $featuredProjects = Project::with('brand')->where('is_active', 1)->take(6)->get();
        $heroSliders = \App\Models\HeroSlider::where('status', true)
            ->where(function($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->orderBy('sort_order', 'asc')
            ->get();
        return view('welcome', compact('brands', 'featuredProjects', 'heroSliders'));
    }

    public function sitemap()
    {
        $brands = Brand::where('status', 1)->get();
        $projects = Project::where('is_active', 1)->get();
        $projectTypes = \App\Models\ProjectType::where('status', 1)->get();
        $blogs = Blog::with('blogCategory')->whereHas('blogCategory')->where('status', 1)->get();

        return response()->view('frontend.sitemap', [
            'brands' => $brands,
            'projects' => $projects,
            'projectTypes' => $projectTypes,
            'blogs' => $blogs
        ])->header('Content-Type', 'text/xml');
    }

    public function about()
    {
        $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
        return view('frontend.about', compact('brands'));
    }

    public function contact()
    {
        $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
        return view('frontend.contact', compact('brands'));
    }

    public function blogs()
    {
        $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
        $blogs = Blog::where('status', 1)->latest('published_at')->paginate(9);
        return view('frontend.blogs.index', compact('brands', 'blogs'));
    }

    public function blogDetail($category_slug, $slug)
    {
        $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
        $query = Blog::where('slug', $slug);
        
        if (auth()->check()) {
            if (auth()->user()->hasRole('blog_admin')) {
                $query->where(function($q) {
                    $q->where('status', 1)->orWhere('user_id', auth()->id());
                });
            }
        } else {
            $query->where('status', 1);
        }
        
        $blog = $query->firstOrFail();
        
        // Increment views
        $blog->increment('views');
        
        $latestBlogs = Blog::where('status', 1)->where('id', '!=', $blog->id)->latest('created_at')->take(4)->get();
        
        return view('frontend.blogs.show', compact('brands', 'blog', 'latestBlogs'));
    }

    public function dynamicSlug($slug)
    {
        $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
        
        // Try to find a project first
        $project = Project::with(['brand', 'floorPlans', 'faqs'])->where('slug', $slug)->where('is_active', 1)->first();
        if ($project) {
            return view('frontend.project', compact('brands', 'project'));
        }

        // If not a project, try to find a brand
        $brand = Brand::where('slug', $slug)->where('status', 1)->first();
        if ($brand) {
            $cities = Project::where('brand_id', $brand->id)->where('is_active', 1)->whereNotNull('city')->pluck('city')->unique()->sort()->filter();
            
            $query = Project::where('brand_id', $brand->id)->where('is_active', 1);
            if (request()->has('city') && request()->city != '') {
                $query->where('city', request()->city);
            }
            $projects = $query->latest()->paginate(12)->withQueryString();
            
            return view('frontend.brand', compact('brands', 'brand', 'projects', 'cities'));
        }

        // If neither, 404
        abort(404);
    }

    public function resalePropertyDetail($category_slug, $slug)
    {
        $query = \App\Models\ResaleProperty::with('project.brand', 'resaleCategory')
            ->where('is_active', 1)
            ->where('slug', $slug);

        if ($category_slug === 'uncategorized') {
            $query->whereNull('resale_category_id');
        } else {
            $query->whereHas('resaleCategory', function($q) use ($category_slug) {
                $q->where('slug', $category_slug);
            });
        }
        
        $resaleProperty = $query->first();

        if ($resaleProperty) {
            $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
            return view('frontend.resale_property', compact('brands', 'resaleProperty'));
        }

        return $this->dynamicSlugWithType($category_slug, $slug);
    }

    public function dynamicSlugWithType($slug, $type)
    {
        $brands = Brand::with(['projects' => function($q) { $q->where('is_active', 1)->select('id', 'brand_id', 'project_type'); }])->where('status', 1)->get();
        
        $brand = Brand::where('slug', $slug)->where('status', 1)->first();
        if ($brand) {
            $cities = Project::where('brand_id', $brand->id)->where('is_active', 1)->where('project_type', 'like', $type)->whereNotNull('city')->pluck('city')->unique()->sort()->filter();
            
            $query = Project::where('brand_id', $brand->id)
                ->where('is_active', 1)
                ->where('project_type', 'like', $type);
                
            if (request()->has('city') && request()->city != '') {
                $query->where('city', request()->city);
            }
                
            $projects = $query->latest()->paginate(12)->withQueryString();
                
            return view('frontend.brand', compact('brands', 'brand', 'projects', 'cities'));
        }

        abort(404);
    }

    public function submitEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'project_name' => 'nullable|string|max:255',
            // 'captcha' => 'required|captcha'
        ], [
            // 'captcha.captcha' => 'Invalid security code. Please try again.',
            // 'captcha.required' => 'Please enter the security code.'
        ]);

        $projectId = null;
        if ($request->project_name) {
            $project = Project::where('project_name', $request->project_name)->first();
            if ($project) {
                $projectId = $project->id;
            }
        }

        \App\Models\Lead::create([
            'project_id' => $projectId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'source' => $request->project_name ? 'Project: ' . $request->project_name : 'Website',
            'status' => 'New'
        ]);

        try {
            \Illuminate\Support\Facades\Mail::send('emails.enquiry', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'project_name' => $request->project_name
            ], function($message) {
                $message->to('blogenquiriesim@gmail.com')->subject('New Website Enquiry');
            });
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Thank you for your interest! Our team will contact you shortly.']);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:subscribers,email'
        ], [
            'email.unique' => 'This email is already subscribed.'
        ]);

        \App\Models\Subscriber::create([
            'email' => $request->email
        ]);

        return response()->json(['success' => true, 'message' => 'Successfully subscribed!']);
    }

    public function downloadBrochure($id)
    {
        $project = Project::findOrFail($id);
        
        if (!$project->brochure || !\Illuminate\Support\Facades\Storage::disk('public')->exists($project->brochure)) {
            abort(404, 'Brochure not found.');
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download(
            $project->brochure, 
            \Illuminate\Support\Str::slug($project->project_name) . '-brochure.pdf'
        );
    }
}
