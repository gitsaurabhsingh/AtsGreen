<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::orderBy('sort_order', 'asc')->get();
        return view('admin.hero-sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.hero-sliders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|max:4096',
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string',
            'target_url' => 'nullable|url|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data['image'] = $request->file('image')->store('hero-sliders', 'public');
        
        $data['status'] = $request->has('status');

        HeroSlider::create($data);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Slide created successfully.');
    }

    public function edit(HeroSlider $heroSlider)
    {
        return view('admin.hero-sliders.edit', compact('heroSlider'));
    }

    public function update(Request $request, HeroSlider $heroSlider)
    {
        $data = $request->validate([
            'image' => 'nullable|image|max:4096',
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string',
            'target_url' => 'nullable|url|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            if ($heroSlider->image) {
                Storage::disk('public')->delete($heroSlider->image);
            }
            $data['image'] = $request->file('image')->store('hero-sliders', 'public');
        }

        $data['status'] = $request->has('status');

        $heroSlider->update($data);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Slide updated successfully.');
    }

    public function destroy(HeroSlider $heroSlider)
    {
        if ($heroSlider->image) {
            Storage::disk('public')->delete($heroSlider->image);
        }
        $heroSlider->delete();
        return redirect()->route('admin.hero-sliders.index')->with('success', 'Slide deleted successfully.');
    }
}
