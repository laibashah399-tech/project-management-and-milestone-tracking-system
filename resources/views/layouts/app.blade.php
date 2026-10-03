
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'EmployeeHub')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <nav class="bg-slate-900 text-white shadow">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">

            <a href="{{ route('employees.index') }}"
               class="text-xl font-bold">
                Employee<span class="text-blue-400">Hub</span>
            </a>

            <span class="text-sm text-slate-300">
                Management System
            </span>

        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-6 py-10">
        @yield('content')
    </main>

</body>
</html>

