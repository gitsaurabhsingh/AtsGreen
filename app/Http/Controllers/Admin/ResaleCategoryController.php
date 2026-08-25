<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResaleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResaleCategoryController extends Controller
{
    public function index()
    {
        $categories = ResaleCategory::latest()->get();
        return view('admin.resale_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.resale_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:resale_categories',
            'status' => 'boolean'
        ]);

        ResaleCategory::create([
            'name' => $request->name,
            'status' => $request->status ?? 1
        ]);

        return redirect()->route('admin.resale-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ResaleCategory $resaleCategory)
    {
        return view('admin.resale_categories.edit', compact('resaleCategory'));
    }

    public function update(Request $request, ResaleCategory $resaleCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:resale_categories,name,' . $resaleCategory->id,
            'status' => 'boolean'
        ]);

        $resaleCategory->update([
            'name' => $request->name,
            'status' => $request->has('status') ? $request->status : 0
        ]);

        return redirect()->route('admin.resale-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ResaleCategory $resaleCategory)
    {
        $resaleCategory->delete();
        return redirect()->route('admin.resale-categories.index')->with('success', 'Category deleted successfully.');
    }
}
