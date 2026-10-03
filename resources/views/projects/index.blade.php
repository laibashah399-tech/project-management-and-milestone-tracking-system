@extends('layouts.dashboard')

@section('title', 'Project List')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Project List
                </h1>

                <p class="text-slate-500 mt-1">
                    Manage all projects
                </p>
            </div>

            <a href="{{ route('projects.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold">
                + Add Project
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-slate-800 text-white">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Project Name</th>
                            <th class="px-6 py-4">Start Date</th>
                            <th class="px-6 py-4">End Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        @forelse($projects as $project)

                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-4 text-slate-700">
                                    {{ $project->project_id }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $project->name }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $project->start_date }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $project->end_date }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                        {{ $project->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('projects.edit', $project->project_id) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                                            Edit
                                        </a>

                                        <form action="{{ route('projects.destroy', $project->project_id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this project?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="px-6 py-10 text-center text-slate-500">
                                    No projects found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
