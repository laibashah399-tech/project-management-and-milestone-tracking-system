<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private function rows(Request $request)
    {
        return DB::table('milestones as m')
            ->join('projects as p', 'p.project_id', '=', 'm.project_id')
            ->leftJoin('assignments as a', 'a.milestone_id', '=', 'm.milestone_id')
            ->leftJoin('employees as e', 'e.employee_id', '=', 'a.employee_id')
            ->select(
                'p.name as project',
                'm.phase',
                'm.title as milestone',
                'e.name as employee',
                'a.due_date',
                'a.status'
            )
            ->when($request->project_id, fn ($q, $v) => $q->where('p.project_id', $v))
            ->when($request->employee_id, fn ($q, $v) => $q->where('e.employee_id', $v))
            ->when($request->status, fn ($q, $v) => $q->where('a.status', $v))
            ->orderBy('p.name')
            ->orderBy('m.milestone_id')
            ->get();
    }

    public function projectMilestones(Request $request)
    {
        $rows = $this->rows($request);
        $today = now()->toDateString();

        $summary = [
            'total'     => $rows->count(),
            'completed' => $rows->where('status', 'Completed')->count(),
            'pending'   => $rows->where('status', 'Pending')->count(),
            'overdue'   => $rows->filter(
                fn ($r) => $r->due_date && $r->due_date < $today && $r->status !== 'Completed'
            )->count(),
        ];

        return view('reports.project-milestones', [
            'rows'      => $rows,
            'summary'   => $summary,
            'today'     => $today,
            'projects'  => Project::orderBy('name')->get(),
            'employees' => Employee::orderBy('name')->get(),
        ]);
    }

    public function export(Request $request)
    {
        $rows = $this->rows($request);

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['S/L', 'Project', 'Phase', 'Milestone', 'Employee', 'Due Date', 'Status']);
            foreach ($rows as $i => $r) {
                fputcsv($out, [
                    $i + 1, $r->project, $r->phase, $r->milestone,
                    $r->employee ?? 'Not assigned', $r->due_date, $r->status ?? '-',
                ]);
            }
            fclose($out);
        }, 'project-milestone-details.csv', ['Content-Type' => 'text/csv']);
    }
}
