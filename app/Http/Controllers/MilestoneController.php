<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::with('project')->get();

        return view('milestones.index', compact('milestones'));
    }

    public function create()
    {
        $projects = Project::all();

        return view('milestones.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'title' => 'required|string|max:100',
            'phase' => 'nullable|in:' . implode(',', array_keys(config('milestone_templates'))),
        ], [
            'project_id.required' => 'Project is required.',
            'project_id.exists' => 'Selected project does not exist.',
            'title.required' => 'Milestone title is required.',
            'title.max' => 'Milestone title cannot exceed 100 characters.',
            'phase.in' => 'Please select a valid phase.',
        ]);

        Milestone::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'phase' => $request->phase,
        ]);

        return redirect()
            ->route('milestones.index')
            ->with('success', 'Milestone added successfully.');
    }

    public function edit($milestone_id)
    {
        $milestone = Milestone::findOrFail($milestone_id);
        $projects = Project::all();

        return view('milestones.edit', compact('milestone', 'projects'));
    }

    public function update(Request $request, $milestone_id)
    {
        $milestone = Milestone::findOrFail($milestone_id);

        $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'title' => 'required|string|max:100',
            'phase' => 'nullable|in:' . implode(',', array_keys(config('milestone_templates'))),
        ], [
            'project_id.required' => 'Project is required.',
            'project_id.exists' => 'Selected project does not exist.',
            'title.required' => 'Milestone title is required.',
            'title.max' => 'Milestone title cannot exceed 100 characters.',
            'phase.in' => 'Please select a valid phase.',
        ]);

        $milestone->update([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'phase' => $request->phase,
        ]);

        return redirect()
            ->route('milestones.index')
            ->with('success', 'Milestone updated successfully.');
    }

    public function destroy($milestone_id)
    {
        $milestone = Milestone::findOrFail($milestone_id);

        if ($milestone->assignments()->exists()) {
            return redirect()
                ->route('milestones.index')
                ->with(
                    'error',
                    'This milestone cannot be deleted because assignments are linked to it.'
                );
        }

        $milestone->delete();

        return redirect()
            ->route('milestones.index')
            ->with('success', 'Milestone deleted successfully.');
    }
}
