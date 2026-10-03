<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Project Management System')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <nav class="bg-slate-900 text-white shadow">

        <div class="mx-auto flex min-h-16 max-w-7xl items-center justify-between px-6 py-3">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}"
               class="text-xl font-bold">
                Project<span class="text-blue-400">Manager</span>
            </a>


            <!-- Navigation -->
            <div class="flex items-center gap-6 text-sm">

                <a href="{{ route('dashboard') }}" class="hover:text-blue-400">Dashboard</a>

                {{-- Maintenance --}}
                <div class="relative group">
                    <button type="button" class="py-2 hover:text-blue-400">Maintenance &#9662;</button>
                    <div class="absolute left-0 top-full z-50 hidden min-w-48 rounded-lg bg-slate-800 py-2 shadow-lg group-hover:block">
                        <a href="{{ route('employees.index') }}" class="block px-4 py-2 hover:bg-slate-700">Employee List</a>
                        <a href="{{ route('projects.index') }}" class="block px-4 py-2 hover:bg-slate-700">Project List</a>
                        <a href="{{ route('milestones.index') }}" class="block px-4 py-2 hover:bg-slate-700">Milestone List</a>
                    </div>
                </div>

                {{-- Input / Task --}}
                <div class="relative group">
                    <button type="button" class="py-2 hover:text-blue-400">Input / Task &#9662;</button>
                    <div class="absolute left-0 top-full z-50 hidden min-w-48 rounded-lg bg-slate-800 py-2 shadow-lg group-hover:block">
                        <a href="{{ route('assignments.index') }}" class="block px-4 py-2 hover:bg-slate-700">Assignment</a>
                    </div>
                </div>

                {{-- User Security --}}
                <div class="relative group">
                    <button type="button" class="py-2 hover:text-blue-400">User Security &#9662;</button>
                    <div class="absolute left-0 top-full z-50 hidden min-w-48 rounded-lg bg-slate-800 py-2 shadow-lg group-hover:block">
                        <a href="{{ route('users.create') }}" class="block px-4 py-2 hover:bg-slate-700">New User</a>
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 hover:bg-slate-700">User List</a>
                        <a href="{{ route('users.change-password') }}" class="block px-4 py-2 hover:bg-slate-700">Change Password</a>
                    </div>
                </div>

                {{-- Reports --}}
                <div class="relative group">
                    <button type="button" class="py-2 hover:text-blue-400">Reports &#9662;</button>
                    <div class="absolute left-0 top-full z-50 hidden min-w-56 rounded-lg bg-slate-800 py-2 shadow-lg group-hover:block">
                        <a href="{{ route('reports.project-milestones') }}" class="block px-4 py-2 hover:bg-slate-700">Project Milestone Details</a>
                    </div>
                </div>

            </div>


            <!-- User Section -->
            <div class="flex items-center gap-4">

                <span class="text-sm text-slate-300">
                    {{ auth()->user()->name }}
                </span>

                <a href="{{ route('users.change-password') }}"
                   class="rounded-lg bg-slate-700 px-3 py-2 text-sm font-medium hover:bg-slate-600">
                    Change Password
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-lg bg-red-600 px-3 py-2 text-sm font-medium hover:bg-red-700">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </nav>


    <main class="mx-auto max-w-7xl px-6 py-10">

        @yield('content')

    </main>

</body>

</html>