<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>To-Do List</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">

    <div class="relative min-h-screen overflow-hidden">

        {{-- Navigation --}}
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8">

                {{-- Application name --}}
                <div class="flex lg:flex-1">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">
                        To-Do List
                    </a>
                </div>

                {{-- Login / Register --}}
                <div class="flex items-center gap-6">

                    @auth

                        <a href="{{ route('tasks.index') }}" class="text-sm font-semibold text-gray-900">
                            My Tasks →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Register
                            </a>
                        @endif

                    @endauth

                </div>
            </nav>
        </header>


        {{-- Hero Section --}}
        <main class="relative isolate px-6 pt-14 lg:px-8">

            {{-- Background colour effect --}}
            <div aria-hidden="true"
                class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-pink-400 to-indigo-500 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72rem]">
                </div>
            </div>


            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">

                <div class="text-center">

                    <p class="mb-6 text-sm font-semibold text-indigo-600">
                        Simple task management
                    </p>

                    <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                        Organise your tasks.
                        Stay on top of your day.
                    </h1>

                    <p class="mt-8 text-lg font-medium text-gray-500 sm:text-xl">
                        Create, manage and complete your tasks all in one place.
                        Keep track of deadlines and see what you've accomplished.
                    </p>


                    <div class="mt-10 flex items-center justify-center gap-x-6">

                        @auth

                            <a href="{{ route('tasks.index') }}"
                                class="rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                View My Tasks
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Get Started
                            </a>

                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900">
                                Log in →
                            </a>

                        @endauth

                    </div>

                </div>

            </div>


            {{-- Bottom background colour effect --}}
            <div aria-hidden="true"
                class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                    class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36rem] -translate-x-1/2 bg-gradient-to-tr from-pink-400 to-indigo-500 opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72rem]">
                </div>
            </div>

        </main>

    </div>

</body>

</html>
