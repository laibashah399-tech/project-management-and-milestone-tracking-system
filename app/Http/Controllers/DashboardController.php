<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalMilestones = Milestone::count();
        $totalAssignments = Assignment::count();
        $totalEmployees = Employee::count();

        $recentProjects = Project::latest('project_id')
            ->take(5)
            ->get();

        $recentAssignments = Assignment::with([
            'project',
            'milestone',
            'employee'
        ])
            ->latest('assignment_id')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProjects',
            'totalMilestones',
            'totalAssignments',
            'totalEmployees',
            'recentProjects',
            'recentAssignments'
        ));
    }
}