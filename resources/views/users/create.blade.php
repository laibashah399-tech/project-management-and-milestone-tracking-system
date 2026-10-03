@extends('layouts.dashboard')

@section('title', 'Add User')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">

            <a href="{{ route('users.index') }}"
               class="text-sm font-medium text-slate-600 hover:text-slate-900">
                ← Back to User List
            </a>

            <h1 class="text-3xl font-bold text-slate-800 mt-4">
                Add User
            </h1>

            <p class="text-slate-500 mt-1">
                Create a new user and assign an employee.
            </p>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="mb-6 rounded-lg border border-red-200
                        bg-red-50 px-5 py-4">

                <p class="font-semibold text-red-700 mb-2">
                    Please fix the following errors:
                </p>

                <ul class="list-disc ml-5 text-sm text-red-600">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8">

            <form action="{{ route('users.store') }}" method="POST">

                @csrf


                {{-- User Name --}}
                <div class="mb-6">

                    <label for="name"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        User Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="255"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-3 outline-none
                               focus:border-slate-500 focus:ring-2
                               focus:ring-slate-200"
                        placeholder="Enter user name">

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Email --}}
                <div class="mb-6">

                    <label for="email"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        maxlength="255"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-3 outline-none
                               focus:border-slate-500 focus:ring-2
                               focus:ring-slate-200"
                        placeholder="Enter email address">

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Employee --}}
                <div class="mb-6">

                    <label for="employee_id"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Employee
                    </label>

                    <select
                        id="employee_id"
                        name="employee_id"
                        required
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-4 py-3 outline-none
                               focus:border-slate-500 focus:ring-2
                               focus:ring-slate-200">

                        <option value="">
                            Select Employee
                        </option>

                        @foreach($employees as $employee)

                            <option
                                value="{{ $employee->employee_id }}"
                                {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>

                                {{ $employee->name }} — {{ $employee->role }}

                            </option>

                        @endforeach

                    </select>

                    @error('employee_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Password --}}
                <div class="mb-6">

                    <label for="password"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        maxlength="255"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-3 outline-none
                               focus:border-slate-500 focus:ring-2
                               focus:ring-slate-200"
                        placeholder="Enter password">

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <p class="mt-2 text-xs text-slate-500">
                        Password must be at least 8 characters.
                    </p>

                </div>


                {{-- Status --}}
                <div class="mb-8">

                    <label for="status"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-4 py-3 outline-none
                               focus:border-slate-500 focus:ring-2
                               focus:ring-slate-200">

                        <option value="">
                            Select Status
                        </option>

                        <option value="Active"
                            {{ old('status') == 'Active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="Inactive"
                            {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3">

                    <a href="{{ route('users.index') }}"
                       class="w-full sm:w-auto px-6 py-3 rounded-lg
                              border border-slate-300 text-slate-700
                              font-semibold text-center
                              hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-6 py-3 rounded-lg
                               bg-slate-800 text-white
                               font-semibold
                               hover:bg-slate-700 transition">
                        Save User
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
