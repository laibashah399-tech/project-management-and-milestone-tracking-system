
@extends('layouts.dashboard')

@section('title', 'Employees | EmployeeHub')

@section('content')

    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Employees
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage your employees and their roles.
            </p>
        </div>

        <a href="{{ route('employees.create') }}"
           class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            + Add Employee
        </a>

    </div>


    @if(session('error'))
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            ✓ {{ session('success') }}
        </div>

    @endif


    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

            <h2 class="font-semibold text-slate-900">
                Employee List
            </h2>

            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                {{ $employees->count() }} Employees
            </span>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">

                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Employee Name</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($employees as $employee)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-4 font-semibold text-slate-500">
                                #{{ $employee->employee_id }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $employee->name }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
                                    {{ $employee->role }}
                                </span>

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex gap-2">

                                    <a href="{{ route('employees.edit', $employee->employee_id) }}"
                                       class="rounded-md bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form action="{{ route('employees.destroy', $employee->employee_id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this employee?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-md bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">

                                <div class="text-4xl">
                                    👥
                                </div>

                                <p class="mt-3 font-semibold text-slate-700">
                                    No employees found
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Add your first employee to get started.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection

