@extends('layouts.dashboard')

@section('title', 'Milestone List')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Milestone List
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage project milestones
                </p>
            </div>

            <a href="{{ route('milestones.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-medium">
                + Add Milestone
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


        {{-- Milestone Table --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-800 text-white">

                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold">
                                Milestone ID
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Project
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Milestone Title
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Phase
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-center">
                                Actions
                            </th>
                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        @forelse ($milestones as $milestone)

                            <tr class="hover:bg-gray-50">

                                {{-- Milestone ID --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $milestone->milestone_id }}
                                </td>


                                {{-- Project --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $milestone->project->name ?? 'N/A' }}
                                </td>


                                {{-- Title --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $milestone->title }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $milestone->phase ?? '-' }}
                                </td>


                                {{-- Actions --}}
                                <td class="px-6 py-4">

                                    <div class="flex justify-center items-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('milestones.edit', $milestone->milestone_id) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                                            Edit
                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('milestones.destroy', $milestone->milestone_id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this milestone?');">

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
                                <td colspan="5"
                                    class="px-6 py-10 text-center text-gray-500">
                                    No milestones found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
