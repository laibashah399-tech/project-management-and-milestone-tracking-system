<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    private function rules(Request $request): array
    {
        return [
            'project_id'   => 'required|exists:projects,project_id',
            'milestone_id' => [
                'required',
                Rule::exists('milestones', 'milestone_id')
                    ->where('project_id', $request->project_id),
            ],
            'employee_id'  => 'required|exists:employees,employee_id',
            'due_date'     => 'required|date',
            'status'       => 'required|in:Pending,Completed',
        ];
    }

    private function messages(): array
    {
        return [
            'project_id.required'   => 'Project is required.',
            'project_id.exists'     => 'Selected project does not exist.',
            'milestone_id.required' => 'Milestone name (title) is required.',
            'milestone_id.exists'   => 'Selected milestone does not belong to the selected project.',
            'employee_id.required'  => 'Employee is required.',
            'employee_id.exists'    => 'Selected employee does not exist.',
            'due_date.required'     => 'Milestone due date is required.',
            'due_date.date'         => 'Please enter a valid due date.',
            'status.required'       => 'Milestone status is required.',
            'status.in'             => 'Status must be Pending or Completed.',
        ];
    }

    public function index()
    {
        $assignments = Assignment::with([
            'project',
            'milestone',
            'employee'
        ])->get();

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $projects = Project::all();
        $milestones = Milestone::with('project')->get();
        $employees = Employee::all();

        return view('assignments.create', compact(
            'projects',
            'milestones',
            'employees'
        ));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules($request), $this->messages());

        Assignment::create([
            'project_id' => $request->project_id,
            'milestone_id' => $request->milestone_id,
            'employee_id' => $request->employee_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment added successfully.');
    }

    public function edit($assignment_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);

        $projects = Project::all();
        $milestones = Milestone::with('project')->get();
        $employees = Employee::all();

        return view('assignments.edit', compact(
            'assignment',
            'projects',
            'milestones',
            'employees'
        ));
    }

    public function update(Request $request, $assignment_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);

        $request->validate($this->rules($request), $this->messages());

        $assignment->update([
            'project_id' => $request->project_id,
            'milestone_id' => $request->milestone_id,
            'employee_id' => $request->employee_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment updated successfully.');
    }

    public function destroy($assignment_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);

        $assignment->delete();

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }
}