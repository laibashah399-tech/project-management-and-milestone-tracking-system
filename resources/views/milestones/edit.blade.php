@extends('layouts.dashboard')

@section('title', 'Edit Milestone')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-4">

        <div class="bg-white rounded-xl shadow-md p-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Edit Milestone
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Update milestone information
                    </p>
                </div>

                <a href="{{ route('milestones.index') }}"
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
            <form action="{{ route('milestones.update', $milestone->milestone_id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Milestone Id (read only) --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Milestone Id</label>
                    <input type="text" value="{{ $milestone->milestone_id }}" readonly
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
                                {{ old('project_id', $milestone->project_id) == $project->project_id ? 'selected' : '' }}>

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


                {{-- Milestone Title --}}
                <div class="mb-7">

                    <label for="title"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Milestone Title
                    </label>

                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title', $milestone->title) }}"
                           maxlength="100"
                           required
                           placeholder="Enter milestone title"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @error('title')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Phase --}}
                <div class="mb-7">
                    <label for="phase" class="block text-sm font-medium text-gray-700 mb-2">Phase</label>
                    <select name="phase" id="phase"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- None --</option>
                        @foreach (array_keys(config('milestone_templates')) as $ph)
                            <option value="{{ $ph }}" {{ old('phase', $milestone->phase) == $ph ? 'selected' : '' }}>{{ $ph }}</option>
                        @endforeach
                    </select>
                    @error('phase')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Buttons --}}
                <div class="flex gap-3">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                        Update Milestone
                    </button>

                    <a href="{{ route('milestones.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
