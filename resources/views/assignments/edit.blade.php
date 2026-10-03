@extends('layouts.dashboard')

@section('title', 'Edit Assignment')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-4">

        <div class="bg-white rounded-xl shadow-md p-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Edit Assignment
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Update assignment information
                    </p>
                </div>

                <a href="{{ route('assignments.index') }}"
                   class="text-gray-600 hover:text-gray-900">
                    ← Back
                </a>

            </div>


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">

                    <ul class="list-disc list-inside">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Edit Form --}}
            <form action="{{ route('assignments.update', $assignment->assignment_id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Assignment Id (read only) --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Assignment Id</label>
                    <input type="text" value="{{ $assignment->assignment_id }}" readonly
                           class="w-full border border-gray-200 bg-gray-100 text-gray-500 rounded-lg px-4 py-3 cursor-not-allowed">
                </div>



                {{-- Project --}}
                <div class="mb-5">

                    <label for="project_id"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Project
                    </label>

                    <select name="project_id"
                            id="project_id"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">
                            Select Project
                        </option>

                        @foreach ($projects as $project)

                            <option value="{{ $project->project_id }}"
                                {{ old('project_id', $assignment->project_id) == $project->project_id ? 'selected' : '' }}>

                                {{ $project->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('project_id')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Milestone --}}
                <div class="mb-5">

                    <label for="milestone_id"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Milestone
                    </label>

                    <select name="milestone_id"
                            id="milestone_id"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">
                            Select Milestone
                        </option>

                        @foreach ($milestones as $milestone)

                            <option value="{{ $milestone->milestone_id }}"
                                data-project="{{ $milestone->project_id }}"
                                {{ old('milestone_id', $assignment->milestone_id) == $milestone->milestone_id ? 'selected' : '' }}>

                                {{ $milestone->title }}
                                -
                                {{ $milestone->project->name ?? 'N/A' }}

                            </option>

                        @endforeach

                    </select>

                    @error('milestone_id')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Employee --}}
                <div class="mb-5">

                    <label for="employee_id"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Employee
                    </label>

                    <select name="employee_id"
                            id="employee_id"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">
                            Select Employee
                        </option>

                        @foreach ($employees as $employee)

                            <option value="{{ $employee->employee_id }}"
                                {{ old('employee_id', $assignment->employee_id) == $employee->employee_id ? 'selected' : '' }}>

                                {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('employee_id')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Due Date --}}
                <div class="mb-5">

                    <label for="due_date"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Due Date
                    </label>

                    <input type="date"
                           name="due_date"
                           id="due_date"
                           value="{{ old('due_date', $assignment->due_date) }}"
                           required
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @error('due_date')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-7">

                    <label for="status"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>

                    <select name="status"
                            id="status"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">
                            Select Status
                        </option>

                        <option value="Pending"
                            {{ old('status', $assignment->status) == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Completed"
                            {{ old('status', $assignment->status) == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                    </select>

                    @error('status')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="flex gap-3">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                        Update Assignment
                    </button>

                    <a href="{{ route('assignments.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const project = document.getElementById('project_id');
    const milestone = document.getElementById('milestone_id');

    function filterMilestones() {
        let selectedStillValid = false;
        Array.from(milestone.options).forEach(function (opt) {
            if (!opt.value) return;
            const show = opt.dataset.project === project.value;
            opt.hidden = !show;
            opt.disabled = !show;
            if (show && opt.selected) selectedStillValid = true;
        });
        if (!selectedStillValid) milestone.value = '';
    }

    project.addEventListener('change', filterMilestones);
    filterMilestones();
});
</script>

@endsection
