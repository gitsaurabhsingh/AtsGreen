<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::latest();
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        if (auth()->user()->hasRole('blog_admin')) {
            $query->where('user_id', auth()->id());
        }

        $blogs = $query->paginate(5)->withQueryString();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'author' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->except(['featured_image', 'banner_image', '_token', '_method']);
        
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }
        
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('blogs/banners', 'public');
        }

        $data['user_id'] = auth()->id();

        if (auth()->user()->hasRole('blog_admin')) {
            $data['status'] = 0;
            $data['is_rejected'] = 0;
        } else if ($data['status'] == 1) {
            $data['published_at'] = now();
        }

        $blog = Blog::create($data);

        $mailFailed = false;
        if (auth()->user()->hasRole('blog_admin')) {
            try {
                \Illuminate\Support\Facades\Mail::send('emails.blog_pending', [
                    'action_text' => 'A blog post titled "'.$request->title.'" has been created by '.auth()->user()->name.' and is currently pending approval.',
                    'title' => $request->title,
                    'author' => $request->author,
                    'submitter_name' => auth()->user()->name,
                    'heading' => 'A Blog was created and requires your approval'
                ], function($message) {
                    $message->to('blogenquiriesim@gmail.com')->subject('New Blog Pending Approval');
                });
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
                $mailFailed = true;
            }
        }

        $prefix = request()->is('admin*') ? 'admin' : 'blog-admin';
        
        if ($mailFailed) {
            return redirect()->route($prefix . '.blogs.index')->with('warning', 'Blog created, but failed to send email to admin. Please check server SMTP settings.');
        }
        
        return redirect()->route($prefix . '.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        if (auth()->user()->hasRole('blog_admin') && $blog->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        if (auth()->user()->hasRole('blog_admin') && $blog->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'author' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->except(['featured_image', 'banner_image', '_token', '_method']);
        
        if ($request->title !== $blog->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($blog->banner_image) {
                Storage::disk('public')->delete($blog->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('blogs/banners', 'public');
        }

        if (auth()->user()->hasRole('blog_admin')) {
            $data['status'] = 0;
            $data['is_rejected'] = 0;
        } else if ($data['status'] == 1 && !$blog->published_at) {
            $data['published_at'] = now();
        }

        $blog->update($data);

        $mailFailed = false;
        if (auth()->user()->hasRole('blog_admin')) {
            try {
                \Illuminate\Support\Facades\Mail::send('emails.blog_pending', [
                    'action_text' => 'A blog post titled "'.$request->title.'" has been updated by '.auth()->user()->name.' and is currently pending approval.',
                    'title' => $request->title,
                    'author' => $request->author,
                    'submitter_name' => auth()->user()->name,
                    'heading' => 'A Blog was updated and requires your approval'
                ], function($message) {
                    $message->to('blogenquiriesim@gmail.com')->subject('Updated Blog Pending Approval');
                });
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
                $mailFailed = true;
            }
        }

        $prefix = request()->is('admin*') ? 'admin' : 'blog-admin';
        
        if ($mailFailed) {
            return redirect()->route($prefix . '.blogs.index')->with('warning', 'Blog updated, but failed to send email to admin. Please check server SMTP settings.');
        }
        
        return redirect()->route($prefix . '.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if (auth()->user()->hasRole('blog_admin') && $blog->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        if ($blog->banner_image) {
            Storage::disk('public')->delete($blog->banner_image);
        }
        $blog->delete();
        $prefix = request()->is('admin*') ? 'admin' : 'blog-admin';
        return redirect()->route($prefix . '.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function approve(Blog $blog)
    {
        $blog->update([
            'status' => 1,
            'is_rejected' => 0,
            'published_at' => $blog->published_at ?? now()
        ]);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog approved successfully.');
    }

    public function reject(Blog $blog)
    {
        $blog->update([
            'status' => 0,
            'is_rejected' => 1
        ]);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog rejected successfully.');
    }
}
