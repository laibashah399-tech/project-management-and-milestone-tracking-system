<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'Project name is required.',
            'name.max' => 'Project name cannot exceed 100 characters.',

            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Please enter a valid start date.',

            'end_date.required' => 'End date is required.',
            'end_date.date' => 'Please enter a valid end date.',
            'end_date.after' => 'End date must be after start date.',

            'status.required' => 'Status is required.',
            'status.in' => 'Status must be Active or Inactive.',
        ]);

        DB::transaction(function () use ($request) {
            $project = Project::create([
                'name' => $request->name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
            ]);

            // Create the 26 standard milestones (PPT slides 6-7)
            if ($request->boolean('generate_milestones')) {
                foreach (config('milestone_templates') as $phase => $titles) {
                    foreach ($titles as $title) {
                        Milestone::create([
                            'project_id' => $project->project_id,
                            'title' => $title,
                            'phase' => $phase,
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project added successfully.');
    }

    public function edit($project_id)
    {
        $project = Project::findOrFail($project_id);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $project_id)
    {
        $project = Project::findOrFail($project_id);

        $request->validate([
            'name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'Project name is required.',
            'name.max' => 'Project name cannot exceed 100 characters.',

            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Please enter a valid start date.',

            'end_date.required' => 'End date is required.',
            'end_date.date' => 'Please enter a valid end date.',
            'end_date.after' => 'End date must be after start date.',

            'status.required' => 'Status is required.',
            'status.in' => 'Status must be Active or Inactive.',
        ]);

        $project->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy($project_id)
    {
        $project = Project::findOrFail($project_id);

        if ($project->milestones()->exists()) {
            return redirect()
                ->route('projects.index')
                ->with('error', 'This project cannot be deleted because milestones are linked to it.');
        }

        if ($project->assignments()->exists()) {
            return redirect()
                ->route('projects.index')
                ->with('error', 'This project cannot be deleted because assignments are linked to it.');
        }

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}