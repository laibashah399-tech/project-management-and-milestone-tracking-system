
@extends('layouts.dashboard')

@section('title', 'Add Employee | EmployeeHub')

@section('content')

    <div class="mx-auto max-w-2xl">

        <a href="{{ route('employees.index') }}"
           class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-blue-600">
            ← Back to Employees
        </a>


        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <!-- Header -->
            <div class="border-b border-slate-200 px-6 py-6 sm:px-8">

                <h1 class="text-2xl font-bold text-slate-900">
                    Add New Employee
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Enter the employee details below.
                </p>

            </div>


            <!-- Form -->
            <form action="{{ route('employees.store') }}" method="POST">

                @csrf

                <div class="space-y-6 px-6 py-7 sm:px-8">

                    <!-- Name -->
                    <div>

                        <label for="name"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Employee Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            maxlength="100"
                            value="{{ old('name') }}"
                            placeholder="Enter employee name"
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- Role -->
                    <div>

                        <label for="role"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Employee Role
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="role"
                            name="role"
                            maxlength="50"
                            value="{{ old('role') }}"
                            placeholder="e.g. Developer, Designer, Manager"
                            class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >

                        @error('role')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                <!-- Footer -->
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:justify-end sm:px-8">

                    <a href="{{ route('employees.index') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                    >
                        + Add Employee
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection

