<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Project Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center px-6">

    <div class="w-full max-w-md">

        <div class="rounded-2xl bg-white p-8 shadow-lg">

            <!-- Heading -->
            <div class="text-center mb-8">

                <h1 class="text-2xl font-bold text-slate-800">
                    Project<span class="text-blue-500">Manager</span>
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Login to your account
                </p>

            </div>


            <!-- Error Message -->
            @if ($errors->any())

                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3">

                    @foreach ($errors->all() as $error)

                        <p class="text-sm text-red-600">
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            @endif


            <!-- Login Form -->
            <form action="{{ route('login.authenticate') }}" method="POST">

                @csrf


                <!-- Email -->
                <div class="mb-5">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>


                <!-- Password -->
                <div class="mb-6">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>


                <!-- Button -->
                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700"
                >
                    Login
                </button>

            </form>

        </div>

    </div>

</body>

</html>