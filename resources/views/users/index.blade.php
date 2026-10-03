@extends('layouts.dashboard')

@section('title', 'User List')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    User List
                </h1>

                <p class="text-slate-500 mt-1">
                    Manage registered users and their employees.
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-lg
                      bg-slate-800 text-white font-semibold
                      hover:bg-slate-700 transition">
                + Add User
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('error'))
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))

            <div class="mb-6 rounded-lg bg-green-50 border border-green-200
                        px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="mb-6 rounded-lg bg-red-50 border border-red-200
                        px-4 py-3 text-red-700">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- User Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-slate-800 text-white">

                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold">
                                ID
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                User Name
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Email
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Employee
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Password
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Status
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold">
                                Actions
                            </th>
                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-200">

                        @forelse($users as $user)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-4 text-slate-700">
                                    {{ $user->id }}
                                </td>

                                <td class="px-6 py-4 font-medium text-slate-800">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">

                                    @if($user->employee)
                                        {{ $user->employee->name }}
                                    @else
                                        <span class="text-red-500">
                                            Not Assigned
                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4 text-slate-600 tracking-widest">
                                    *****
                                </td>

                                <td class="px-6 py-4">

                                    @if($user->status === 'Active')

                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-xs font-semibold
                                                     bg-green-100 text-green-700">
                                            Active
                                        </span>

                                    @else

                                        <span class="inline-flex px-3 py-1 rounded-full
                                                     text-xs font-semibold
                                                     bg-red-100 text-red-700">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="px-3 py-2 rounded-lg bg-blue-50
                                                  text-blue-600 hover:bg-blue-100
                                                  text-sm font-medium">
                                            Edit
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="px-3 py-2 rounded-lg bg-red-50
                                                           text-red-600 hover:bg-red-100
                                                           text-sm font-medium">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="px-6 py-12 text-center text-slate-500">

                                    No users found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
