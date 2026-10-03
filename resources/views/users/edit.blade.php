@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">

            <a href="{{ route('users.index') }}"
               class="text-sm font-medium text-slate-600 hover:text-slate-900">
                ← Back to User List
            </a>

            <h1 class="text-3xl font-bold text-slate-800 mt-4">
                Edit User
            </h1>

            <p class="text-slate-500 mt-1">
                Update user information and employee assignment.
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

            <form action="{{ route('users.update', $user->id) }}" method="POST">

                @csrf
                @method('PUT')


                {{-- User ID --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        User ID
                    </label>

                    <input
                        type="text"
                        value="{{ $user->id }}"
                        readonly
                        class="w-full rounded-lg border border-slate-200
                               bg-slate-100 px-4 py-3 text-slate-500
                               cursor-not-allowed">

                </div>


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
                        value="{{ old('name', $user->name) }}"
                        maxlength="255"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-3 outline-none
                               focus:border-slate-500 focus:ring-2
                               focus:ring-slate-200">

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
                        value="{{ old('email', $user->email) }}"
                        maxlength="255"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-3 outline-none
                               focus:border-slate-500 focus:ring-2
                               focus:ring-slate-200">

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
                                {{ old('employee_id', $user->employee_id) == $employee->employee_id ? 'selected' : '' }}>

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


                {{-- Password Information --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>

                    <div class="w-full rounded-lg border border-slate-200
                                bg-slate-100 px-4 py-3 text-slate-500
                                tracking-widest">
                        *****
                    </div>

                    <p class="mt-2 text-xs text-slate-500">
                        Password can be changed from Change Password.
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
                            {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="Inactive"
                            {{ old('status', $user->status) == 'Inactive' ? 'selected' : '' }}>
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
                        Update User
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
