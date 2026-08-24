<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $projectTypes = ProjectType::latest()->paginate(10);
        return view('admin.project_types.index', compact('projectTypes'));
    }

    public function create()
    {
        return view('admin.project_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_types',
            'status' => 'boolean'
        ]);

        ProjectType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('admin.project-types.index')->with('success', 'Project Type created successfully.');
    }

    public function edit(ProjectType $projectType)
    {
        return view('admin.project_types.edit', compact('projectType'));
    }

    public function update(Request $request, ProjectType $projectType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_types,name,' . $projectType->id,
            'status' => 'boolean'
        ]);

        $projectType->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('admin.project-types.index')->with('success', 'Project Type updated successfully.');
    }

    public function destroy(ProjectType $projectType)
    {
        $projectType->delete();
        return redirect()->route('admin.project-types.index')->with('success', 'Project Type deleted successfully.');
    }
}
