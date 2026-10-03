@extends('layouts.dashboard')

@section('title', 'Project Milestone Details')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="mb-6 flex items-center justify-between print:hidden">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Project Milestone Details</h1>
            <p class="text-slate-500 mt-1">Milestones of every project with assigned employee, due date and status.</p>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="window.print()"
                    class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50">Print</button>
            <a href="{{ route('reports.project-milestones.export', request()->query()) }}"
               class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Export CSV</a>
        </div>
    </div>

    <h1 class="hidden print:block text-2xl font-bold mb-4">Project Milestone Details</h1>

    {{-- Filters --}}
    <form method="GET" action="{{ route('reports.project-milestones') }}"
          class="mb-6 grid gap-4 rounded-xl border border-slate-200 bg-white p-5 sm:grid-cols-4 print:hidden">

        <select name="project_id" class="rounded-lg border border-slate-300 bg-white px-3 py-2">
            <option value="">All Projects</option>
            @foreach($projects as $p)
                <option value="{{ $p->project_id }}" {{ request('project_id') == $p->project_id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>

        <select name="employee_id" class="rounded-lg border border-slate-300 bg-white px-3 py-2">
            <option value="">All Employees</option>
            @foreach($employees as $e)
                <option value="{{ $e->employee_id }}" {{ request('employee_id') == $e->employee_id ? 'selected' : '' }}>
                    {{ $e->name }}
                </option>
            @endforeach
        </select>

        <select name="status" class="rounded-lg border border-slate-300 bg-white px-3 py-2">
            <option value="">All Status</option>
            @foreach(['Pending', 'Completed'] as $s)
                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>

        <button type="submit" class="rounded-lg bg-slate-800 px-4 py-2 text-white hover:bg-slate-700">Filter</button>
    </form>

    {{-- Summary --}}
    <div class="mb-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach(['Total' => 'total', 'Completed' => 'completed', 'Pending' => 'pending', 'Overdue' => 'overdue'] as $label => $key)
            <div class="rounded-xl border border-slate-200 bg-white p-4">
                <p class="text-sm text-slate-500">{{ $label }}</p>
                <p class="text-2xl font-bold {{ $key === 'overdue' && $summary[$key] > 0 ? 'text-red-600' : '' }}">{{ $summary[$key] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="px-4 py-3">S/L</th>
                    <th class="px-4 py-3">Project</th>
                    <th class="px-4 py-3">Milestone</th>
                    <th class="px-4 py-3">Employee</th>
                    <th class="px-4 py-3">Due Date</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse($rows as $i => $r)
                @php($overdue = $r->due_date && $r->due_date < $today && $r->status !== 'Completed')
                <tr class="border-t border-slate-100 {{ $overdue ? 'bg-red-50' : '' }}">
                    <td class="px-4 py-3">{{ $i + 1 }}</td>
                    <td class="px-4 py-3">{{ $r->project }}</td>
                    <td class="px-4 py-3">
                        {{ $r->milestone }}
                        @if($r->phase)
                            <span class="block text-xs text-slate-400">{{ $r->phase }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $r->employee ?? 'Not assigned' }}</td>
                    <td class="px-4 py-3">{{ $r->due_date ?? '-' }}</td>
                    <td class="px-4 py-3">
                        {{ $r->status ?? '-' }}
                        @if($overdue)
                            <span class="ml-1 text-xs font-semibold text-red-600">Overdue</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">No records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
