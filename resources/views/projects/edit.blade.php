@extends('layouts.dashboard')

@section('title', 'Edit Project')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-4">

        <div class="bg-white rounded-xl shadow-md p-8">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Edit Project
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Update project information
                    </p>
                </div>

                <a href="{{ route('projects.index') }}"
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


            <form action="{{ route('projects.update', $project->project_id) }}"
                  method="POST">

                @csrf
                @method('PUT')


                {{-- Project ID --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Project ID
                    </label>

                    <input type="text"
                           value="{{ $project->project_id }}"
                           readonly
                           class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-gray-600">
                </div>


                {{-- Project Name --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Project Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $project->name) }}"
                           maxlength="100"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter project name">

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Start Date --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Start Date
                    </label>

                    <input type="date"
                           name="start_date"
                           value="{{ old('start_date', $project->start_date) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @error('start_date')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- End Date --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        End Date
                    </label>

                    <input type="date"
                           name="end_date"
                           value="{{ old('end_date', $project->end_date) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @error('end_date')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Status --}}
                <div class="mb-7">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>

                    <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">Select Status</option>

                        <option value="Active"
                            {{ old('status', $project->status) == 'Active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="Inactive"
                            {{ old('status', $project->status) == 'Inactive' ? 'selected' : '' }}>
                            Inactive
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
                        Update Project
                    </button>

                    <a href="{{ route('projects.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
