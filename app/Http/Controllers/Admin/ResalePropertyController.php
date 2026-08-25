<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResaleProperty;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResalePropertyController extends Controller
{
    public function index()
    {
        $resaleProperties = ResaleProperty::with(['project', 'resaleCategory', 'brand'])->latest()->paginate(10);
        return view('admin.resale_properties.index', compact('resaleProperties'));
    }

    public function create()
    {
        $projects = Project::where('is_active', 1)->get();
        $categories = \App\Models\ResaleCategory::where('status', 1)->get();
        $brands = \App\Models\Brand::where('status', 1)->get();
        $cities = \App\Models\City::where('status', 1)->get();
        $projectTypes = \App\Models\ProjectType::where('status', 1)->get();
        return view('admin.resale_properties.create', compact('projects', 'categories', 'brands', 'cities', 'projectTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        }

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:resale_properties,slug',
            'project_id' => 'required|exists:projects,id',
            'resale_category_id' => 'nullable|exists:resale_categories,id',

            'locality' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'price_label' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
            'rera_number' => 'nullable|string|max:255',
            'rera_qr' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'location_map_image' => 'nullable|image|max:2048',
            'site_plan_image' => 'nullable|image|max:2048',
            'payment_plan_image' => 'nullable|image|max:2048',
            'payment_plan_text' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
            'floor_plans' => 'nullable|array',
            'floor_plans.*' => 'image|max:2048',
            // Old fields
            'price' => 'nullable|string|max:100',
            'area' => 'nullable|string|max:100',
            'bedrooms' => 'nullable|string|max:50',
            'bathrooms' => 'nullable|string|max:50',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Handle File Uploads
        if ($request->hasFile('featured_image')) {
            $validatedData['featured_image'] = $request->file('featured_image')->store('resale_properties/featured_images', 'public');
        }
        if ($request->hasFile('rera_qr')) {
            $validatedData['rera_qr'] = $request->file('rera_qr')->store('resale_properties/rera_qr', 'public');
        }
        if ($request->hasFile('location_map_image')) {
            $validatedData['location_map_image'] = $request->file('location_map_image')->store('resale_properties/maps', 'public');
        }
        if ($request->hasFile('site_plan_image')) {
            $validatedData['site_plan_image'] = $request->file('site_plan_image')->store('resale_properties/site_plans', 'public');
        }
        if ($request->hasFile('payment_plan_image')) {
            $validatedData['payment_plan_image'] = $request->file('payment_plan_image')->store('resale_properties/payment_plans', 'public');
        }

        // Remove relation arrays
        $faqsData = $validatedData['faqs'] ?? [];
        $floorPlansData = $validatedData['floor_plans'] ?? [];
        unset($validatedData['faqs'], $validatedData['floor_plans']);

        $resaleProperty = ResaleProperty::create($validatedData);

        // Store FAQs
        foreach ($faqsData as $faq) {
            $resaleProperty->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer']
            ]);
        }

        // Store Floor Plans
        if ($request->hasFile('floor_plans')) {
            foreach ($request->file('floor_plans') as $file) {
                $path = $file->store('resale_properties/floor_plans', 'public');
                $resaleProperty->floorPlans()->create([
                    'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.resale-properties.index')->with('success', 'Resale property created successfully.');
    }

    public function edit(ResaleProperty $resaleProperty)
    {
        $projects = Project::where('is_active', 1)->get();
        $categories = \App\Models\ResaleCategory::where('status', 1)->get();
        $brands = \App\Models\Brand::where('status', 1)->get();
        $cities = \App\Models\City::where('status', 1)->get();
        $projectTypes = \App\Models\ProjectType::where('status', 1)->get();
        return view('admin.resale_properties.edit', compact('resaleProperty', 'projects', 'categories', 'brands', 'cities', 'projectTypes'));
    }

    public function update(Request $request, ResaleProperty $resaleProperty)
    {
        $data = $request->all();
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        }

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:resale_properties,slug,' . $resaleProperty->id,
            'project_id' => 'required|exists:projects,id',
            'resale_category_id' => 'nullable|exists:resale_categories,id',

            'locality' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'price_label' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
            'rera_number' => 'nullable|string|max:255',
            'rera_qr' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'location_map_image' => 'nullable|image|max:2048',
            'site_plan_image' => 'nullable|image|max:2048',
            'payment_plan_image' => 'nullable|image|max:2048',
            'payment_plan_text' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
            'floor_plans' => 'nullable|array',
            'floor_plans.*' => 'image|max:2048',
            // Old fields
            'price' => 'nullable|string|max:100',
            'area' => 'nullable|string|max:100',
            'bedrooms' => 'nullable|string|max:50',
            'bathrooms' => 'nullable|string|max:50',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Handle File Uploads
        if ($request->hasFile('featured_image')) {
            $validatedData['featured_image'] = $request->file('featured_image')->store('resale_properties/featured_images', 'public');
        }
        if ($request->hasFile('rera_qr')) {
            $validatedData['rera_qr'] = $request->file('rera_qr')->store('resale_properties/rera_qr', 'public');
        }
        if ($request->hasFile('location_map_image')) {
            $validatedData['location_map_image'] = $request->file('location_map_image')->store('resale_properties/maps', 'public');
        }
        if ($request->hasFile('site_plan_image')) {
            $validatedData['site_plan_image'] = $request->file('site_plan_image')->store('resale_properties/site_plans', 'public');
        }
        if ($request->hasFile('payment_plan_image')) {
            $validatedData['payment_plan_image'] = $request->file('payment_plan_image')->store('resale_properties/payment_plans', 'public');
        }

        $faqsData = $validatedData['faqs'] ?? [];
        unset($validatedData['faqs'], $validatedData['floor_plans']);

        $resaleProperty->update($validatedData);

        // Update FAQs (replace old ones)
        $resaleProperty->faqs()->delete();
        foreach ($faqsData as $faq) {
            $resaleProperty->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer']
            ]);
        }

        // Store Floor Plans
        if ($request->hasFile('floor_plans')) {
            foreach ($request->file('floor_plans') as $file) {
                $path = $file->store('resale_properties/floor_plans', 'public');
                $resaleProperty->floorPlans()->create([
                    'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.resale-properties.index')->with('success', 'Resale Property updated successfully.');
    }

    public function destroy(ResaleProperty $resaleProperty)
    {
        $resaleProperty->faqs()->delete();
        $resaleProperty->floorPlans()->delete();
        if ($resaleProperty->image) {
            Storage::disk('public')->delete($resaleProperty->image);
        }
        if ($resaleProperty->featured_image) {
            Storage::disk('public')->delete($resaleProperty->featured_image);
        }
        $resaleProperty->delete();

        return redirect()->route('admin.resale-properties.index')->with('success', 'Resale Property deleted successfully.');
    }
}
