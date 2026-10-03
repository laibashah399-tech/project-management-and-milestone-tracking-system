@extends('layouts.dashboard')

@section('title', 'Assignment List')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Assignment List
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage project assignments
                </p>
            </div>

            <a href="{{ route('assignments.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-medium">
                + Add Assignment
            </a>

        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif


        {{-- Error Message --}}
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif


        {{-- Assignment Table --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-800 text-white">

                        <tr>

                            <th class="px-6 py-4">
                                Assignment ID
                            </th>

                            <th class="px-6 py-4">
                                Project
                            </th>

                            <th class="px-6 py-4">
                                Milestone
                            </th>

                            <th class="px-6 py-4">
                                Employee
                            </th>

                            <th class="px-6 py-4">
                                Due Date
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        @forelse ($assignments as $assignment)

                            <tr class="hover:bg-gray-50">

                                {{-- Assignment ID --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $assignment->assignment_id }}
                                </td>


                                {{-- Project --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $assignment->project->name ?? 'N/A' }}
                                </td>


                                {{-- Milestone --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $assignment->milestone->title ?? 'N/A' }}
                                </td>


                                {{-- Employee --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $assignment->employee->name ?? 'N/A' }}
                                </td>


                                {{-- Due Date --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $assignment->due_date }}
                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                        {{ $assignment->status }}
                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td class="px-6 py-4">

                                    <div class="flex justify-center items-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('assignments.edit', $assignment->assignment_id) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                                            Edit
                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('assignments.destroy', $assignment->assignment_id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this assignment?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="px-6 py-10 text-center text-gray-500">

                                    No assignments found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
