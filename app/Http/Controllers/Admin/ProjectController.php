<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $brands = \App\Models\Brand::where('status', 1)->get();
        $cities = \App\Models\City::where('status', 1)->get();
        $projectTypes = \App\Models\ProjectType::where('status', 1)->get();
        return view('admin.projects.create', compact('brands', 'cities', 'projectTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (empty($data['slug']) && !empty($data['project_name'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['project_name']);
        }

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'project_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug',
            'brand_id' => 'required|exists:brands,id',
            'project_type' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'locality' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'price_label' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
            'rera_number' => 'nullable|string|max:255',
            'rera_qr' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'location_map_image' => 'nullable|image|max:2048',
            'site_plan_image' => 'nullable|image|max:2048',
            'payment_plan_image' => 'nullable|image|max:2048',
            'payment_plan_text' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
            'brochure' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'floor_plans' => 'nullable|array',
            'floor_plans.*' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Handle File Uploads for Project
        if ($request->hasFile('featured_image')) {
            $validatedData['featured_image'] = $request->file('featured_image')->store('projects/featured_images', 'public');
        }
        if ($request->hasFile('rera_qr')) {
            $validatedData['rera_qr'] = $request->file('rera_qr')->store('projects/rera_qr', 'public');
        }
        if ($request->hasFile('location_map_image')) {
            $validatedData['location_map_image'] = $request->file('location_map_image')->store('projects/maps', 'public');
        }
        if ($request->hasFile('site_plan_image')) {
            $validatedData['site_plan_image'] = $request->file('site_plan_image')->store('projects/site_plans', 'public');
        }
        if ($request->hasFile('payment_plan_image')) {
            $validatedData['payment_plan_image'] = $request->file('payment_plan_image')->store('projects/payment_plans', 'public');
        }
        if ($request->hasFile('brochure')) {
            $validatedData['brochure'] = $request->file('brochure')->store('projects/brochures', 'public');
        }

        // Remove relation arrays from project data
        $faqsData = $validatedData['faqs'] ?? [];
        $floorPlansData = $validatedData['floor_plans'] ?? [];
        unset($validatedData['faqs'], $validatedData['floor_plans']);

        $project = Project::create($validatedData);

        // Store FAQs
        foreach ($faqsData as $faq) {
            $project->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer']
            ]);
        }

        // Store Floor Plans
        if ($request->hasFile('floor_plans')) {
            foreach ($request->file('floor_plans') as $file) {
                $path = $file->store('projects/floor_plans', 'public');
                $project->floorPlans()->create([
                    'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $brands = \App\Models\Brand::where('status', 1)->get();
        $cities = \App\Models\City::where('status', 1)->get();
        $projectTypes = \App\Models\ProjectType::where('status', 1)->get();
        return view('admin.projects.edit', compact('project', 'brands', 'cities', 'projectTypes'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->all();
        if (empty($data['slug']) && !empty($data['project_name'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['project_name']);
        }

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'project_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'brand_id' => 'required|exists:brands,id',
            'project_type' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'locality' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'price_label' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'location_map_image' => 'nullable|image|max:2048',
            'site_plan_image' => 'nullable|image|max:2048',
            'payment_plan_image' => 'nullable|image|max:2048',
            'payment_plan_text' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
            'brochure' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'floor_plans' => 'nullable|array',
            'floor_plans.*' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Handle File Uploads
        if ($request->hasFile('featured_image')) {
            $validatedData['featured_image'] = $request->file('featured_image')->store('projects/featured_images', 'public');
        }
        if ($request->hasFile('rera_qr')) {
            $validatedData['rera_qr'] = $request->file('rera_qr')->store('projects/rera_qr', 'public');
        }
        if ($request->hasFile('location_map_image')) {
            $validatedData['location_map_image'] = $request->file('location_map_image')->store('projects/maps', 'public');
        }
        if ($request->hasFile('site_plan_image')) {
            $validatedData['site_plan_image'] = $request->file('site_plan_image')->store('projects/site_plans', 'public');
        }
        if ($request->hasFile('payment_plan_image')) {
            $validatedData['payment_plan_image'] = $request->file('payment_plan_image')->store('projects/payment_plans', 'public');
        }
        if ($request->hasFile('brochure')) {
            $validatedData['brochure'] = $request->file('brochure')->store('projects/brochures', 'public');
        }

        $faqsData = $validatedData['faqs'] ?? [];
        unset($validatedData['faqs'], $validatedData['floor_plans']);

        $project->update($validatedData);

        // Update FAQs (replace old ones)
        $project->faqs()->delete();
        foreach ($faqsData as $faq) {
            $project->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer']
            ]);
        }

        // Update Existing Floor Plans
        if ($request->has('existing_floor_plans')) {
            foreach ($request->input('existing_floor_plans') as $id => $planData) {
                $project->floorPlans()->where('id', $id)->update([
                    'title' => $planData['title'] ?? null,
                    'type'  => $planData['type'] ?? null,
                    'area'  => $planData['area'] ?? null,
                ]);
            }
        }

        // Delete Floor Plans
        if ($request->has('delete_floor_plans')) {
            $floorPlansToDelete = $project->floorPlans()->whereIn('id', $request->input('delete_floor_plans'))->get();
            foreach ($floorPlansToDelete as $fp) {
                // Remove image from storage if needed
                // \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('/storage/', '', $fp->image));
                $fp->delete();
            }
        }

        // Store New Floor Plans
        if ($request->hasFile('floor_plans')) {
            foreach ($request->file('floor_plans') as $file) {
                $path = $file->store('projects/floor_plans', 'public');
                $project->floorPlans()->create([
                    'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function toggleStatus(Project $project)
    {
        $project->is_active = !$project->is_active;
        $project->save();
        return back()->with('success', 'Project status updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete related
        $project->faqs()->delete();
        $project->floorPlans()->delete();
        $project->delete();
        
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
