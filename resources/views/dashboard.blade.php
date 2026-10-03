@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Dashboard
        </h1>

        <p class="mt-1 text-slate-500">
            Welcome to your Project Management System
        </p>
    </div>


    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

        <!-- Total Projects -->
        <div class="rounded-xl bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Projects
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $totalProjects }}
                    </h2>
                </div>

                <div class="rounded-lg bg-blue-100 px-4 py-3 text-2xl">
                    📁
                </div>

            </div>

            <a href="{{ route('projects.index') }}"
               class="mt-5 inline-block text-sm font-medium text-blue-600 hover:underline">
                View Projects →
            </a>

        </div>


        <!-- Total Milestones -->
        <div class="rounded-xl bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Milestones
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $totalMilestones }}
                    </h2>
                </div>

                <div class="rounded-lg bg-green-100 px-4 py-3 text-2xl">
                    🎯
                </div>

            </div>

            <a href="{{ route('milestones.index') }}"
               class="mt-5 inline-block text-sm font-medium text-green-600 hover:underline">
                View Milestones →
            </a>

        </div>


        <!-- Total Assignments -->
        <div class="rounded-xl bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Assignments
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $totalAssignments }}
                    </h2>
                </div>

                <div class="rounded-lg bg-purple-100 px-4 py-3 text-2xl">
                    📋
                </div>

            </div>

            <a href="{{ route('assignments.index') }}"
               class="mt-5 inline-block text-sm font-medium text-purple-600 hover:underline">
                View Assignments →
            </a>

        </div>


        <!-- Total Employees -->
        <div class="rounded-xl bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Employees
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $totalEmployees }}
                    </h2>
                </div>

                <div class="rounded-lg bg-orange-100 px-4 py-3 text-2xl">
                    👥
                </div>

            </div>

            <a href="{{ route('employees.index') }}"
               class="mt-5 inline-block text-sm font-medium text-orange-600 hover:underline">
                View Employees →
            </a>

        </div>

    </div>


    <!-- Quick Actions -->
    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">

        <h2 class="text-xl font-bold text-slate-800">
            Quick Actions
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Quickly access the main sections of the system.
        </p>


        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <a href="{{ route('projects.create') }}"
               class="rounded-lg border border-slate-200 p-5 transition hover:border-blue-400 hover:bg-blue-50">

                <div class="text-2xl">
                    📁
                </div>

                <h3 class="mt-3 font-semibold text-slate-800">
                    Add Project
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Create a new project
                </p>

            </a>


            <a href="{{ route('milestones.create') }}"
               class="rounded-lg border border-slate-200 p-5 transition hover:border-green-400 hover:bg-green-50">

                <div class="text-2xl">
                    🎯
                </div>

                <h3 class="mt-3 font-semibold text-slate-800">
                    Add Milestone
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Create a project milestone
                </p>

            </a>


            <a href="{{ route('assignments.create') }}"
               class="rounded-lg border border-slate-200 p-5 transition hover:border-purple-400 hover:bg-purple-50">

                <div class="text-2xl">
                    📋
                </div>

                <h3 class="mt-3 font-semibold text-slate-800">
                    Add Assignment
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Assign work to an employee
                </p>

            </a>


            <a href="{{ route('employees.create') }}"
               class="rounded-lg border border-slate-200 p-5 transition hover:border-orange-400 hover:bg-orange-50">

                <div class="text-2xl">
                    👥
                </div>

                <h3 class="mt-3 font-semibold text-slate-800">
                    Add Employee
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Register a new employee
                </p>

            </a>

        </div>

    </div>
        <!-- Recent Projects -->
    <div class="mt-8 rounded-xl bg-white p-6 shadow-sm">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Recent Projects
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Latest projects added to the system
                </p>
            </div>

            <a href="{{ route('projects.index') }}"
               class="text-sm font-medium text-blue-600 hover:underline">
                View All
            </a>

        </div>


        <div class="mt-6 overflow-x-auto">

            <table class="w-full text-left">

                <thead>
                    <tr class="border-b border-slate-200 text-sm text-slate-500">
                        <th class="px-4 py-3">Project ID</th>
                        <th class="px-4 py-3">Project Name</th>
                        <th class="px-4 py-3">Start Date</th>
                        <th class="px-4 py-3">End Date</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentProjects as $project)

                        <tr class="border-b border-slate-100 hover:bg-slate-50">

                            <td class="px-4 py-4">
                                {{ $project->project_id }}
                            </td>

                            <td class="px-4 py-4 font-medium text-slate-800">
                                {{ $project->name }}
                            </td>

                            <td class="px-4 py-4 text-slate-600">
                                {{ $project->start_date }}
                            </td>

                            <td class="px-4 py-4 text-slate-600">
                                {{ $project->end_date }}
                            </td>

                            <td class="px-4 py-4">
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                                    {{ $project->status }}
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5"
                                class="px-4 py-8 text-center text-slate-500">
                                No projects found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

<!-- Recent Assignments -->
<div class="mt-8 rounded-xl bg-white p-6 shadow-sm">

    <div class="flex items-center justify-between">

        <div>
            <h2 class="text-xl font-bold text-slate-800">
                Recent Assignments
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Latest assignments in the system
            </p>
        </div>

        <a href="{{ route('assignments.index') }}"
           class="text-sm font-medium text-blue-600 hover:underline">
            View All
        </a>

    </div>


    <div class="mt-6 overflow-x-auto">

        <table class="w-full text-left">

            <thead>
                <tr class="border-b border-slate-200 text-sm text-slate-500">

                    <th class="px-4 py-3">
                        Assignment ID
                    </th>

                    <th class="px-4 py-3">
                        Project
                    </th>

                    <th class="px-4 py-3">
                        Milestone
                    </th>

                    <th class="px-4 py-3">
                        Employee
                    </th>

                    <th class="px-4 py-3">
                        Due Date
                    </th>

                    <th class="px-4 py-3">
                        Status
                    </th>

                </tr>
            </thead>


            <tbody>

                @forelse($recentAssignments as $assignment)

                    <tr class="border-b border-slate-100 hover:bg-slate-50">

                        <td class="px-4 py-4">
                            {{ $assignment->assignment_id }}
                        </td>

                        <td class="px-4 py-4 font-medium text-slate-800">
                            {{ $assignment->project->name ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-4 text-slate-600">
                            {{ $assignment->milestone->title ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-4 text-slate-600">
                            {{ $assignment->employee->name ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-4 text-slate-600">
                            {{ $assignment->due_date }}
                        </td>

                        <td class="px-4 py-4">

                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                                {{ $assignment->status }}
                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-4 py-8 text-center text-slate-500">

                            No assignments found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection