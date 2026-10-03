@extends('layouts.dashboard')

@section('title', 'Change Password')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- Header -->
    <div class="mb-8">

        <a href="{{ route('dashboard') }}"
           class="text-sm font-medium text-slate-600 hover:text-slate-900">
            ← Back to Dashboard
        </a>

        <h1 class="text-3xl font-bold text-slate-800 mt-4">
            Change Password
        </h1>

        <p class="text-slate-500 mt-1">
            Update your account password securely.
        </p>

    </div>


    <!-- Success Message -->
    @if(session('success'))

        <div class="mb-6 rounded-lg border border-green-200
                    bg-green-50 px-5 py-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif


    <!-- Validation Errors -->
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


    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200 p-6 sm:p-8">

        <form action="{{ route('users.update-password') }}" method="POST">

            @csrf
            @method('PUT')


            <!-- Login Username -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Login Username
                </label>

                <input
                    type="text"
                    value="{{ $user->name }}"
                    readonly
                    class="w-full rounded-lg border border-slate-200
                           bg-slate-100 px-4 py-3 text-slate-500
                           cursor-not-allowed"
                >

            </div>


            <!-- Old Password -->
            <div class="mb-6">

                <label for="old_password"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Old Password
                </label>

                <input
                    type="password"
                    id="old_password"
                    name="old_password"
                    required
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-3 outline-none
                           focus:border-blue-500 focus:ring-2
                           focus:ring-blue-100"
                    placeholder="Enter old password"
                >

                @error('old_password')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            <!-- New Password -->
            <div class="mb-8">

                <label for="new_password"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    New Password
                </label>

                <input
                    type="password"
                    id="new_password"
                    name="new_password"
                    required
                    minlength="8"
                    maxlength="255"
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-3 outline-none
                           focus:border-blue-500 focus:ring-2
                           focus:ring-blue-100"
                    placeholder="Enter new password"
                >

                @error('new_password')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

                <p class="mt-2 text-xs text-slate-500">
                    New password must be at least 8 characters.
                </p>

            </div>


            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">

                <a href="{{ route('dashboard') }}"
                   class="w-full sm:w-auto px-6 py-3 rounded-lg
                          border border-slate-300 text-slate-700
                          font-semibold text-center
                          hover:bg-slate-50 transition">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="w-full sm:w-auto px-6 py-3 rounded-lg
                           bg-blue-600 text-white
                           font-semibold
                           hover:bg-blue-700 transition">
                    Change Password
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

