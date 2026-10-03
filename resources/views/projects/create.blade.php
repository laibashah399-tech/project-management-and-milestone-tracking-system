@extends('layouts.dashboard')

@section('title', 'Add Project')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-10">

        <div class="bg-white rounded-xl shadow-sm p-8">

            <h1 class="text-3xl font-bold text-slate-800">
                Add Project
            </h1>

            <p class="text-slate-500 mt-1 mb-8">
                Create a new project
            </p>

            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc ml-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('projects.store') }}" method="POST">

                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Project Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="100"
                        required
                        class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter project name"
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            value="{{ old('start_date') }}"
                            required
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            End Date
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            value="{{ old('end_date') }}"
                            required
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                </div>

                <div class="mt-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        required
                        class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Select Status</option>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="mt-6 flex items-center gap-2">
                    <input type="checkbox" id="generate_milestones" name="generate_milestones" value="1"
                           {{ old('generate_milestones', '1') ? 'checked' : '' }}
                           class="h-4 w-4 rounded border-slate-300">
                    <label for="generate_milestones" class="text-sm text-slate-700">
                        Generate standard milestones (26 milestones in 4 phases)
                    </label>
                </div>

                <div class="flex gap-3 mt-8">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                        Save Project
                    </button>

                    <a
                        href="{{ route('projects.index') }}"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-lg font-semibold">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
