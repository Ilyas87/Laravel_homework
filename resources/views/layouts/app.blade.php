<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <div class="px-6 py-2 bg-white border-b border-gray-200">
                            <div class="flex justify-between h-16">
                                <div class="flex">
                                    <!-- Logo -->
                                    <div class="flex-shrink-0 flex items-center align-bottom">
                                        <a href="{{ route('home') }}">
                                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                                        </a>
                                    </div>

                                    <!-- Navigation Links -->
                                    <div class="flex-shrink-0 flex items-center sm:ml-10">
                                        <form action="">
                                            <x-input id="search" class="block mt-1 w-full" type="text" name="search" :value="old('search')" />
                                        </form>
                                    </div>
                                </div>

                                <!-- Right side menu -->
                                @guest
                                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                                        <div align="right" width="48">
                                            <a href="{{ route('login') }}" class="text-lg text-gray-500 hover:text-black focus:outline-none no-underline">Вход</a>
                                            <a href="{{ route('register') }}" class="ml-4 text-lg text-gray-500 hover:text-black focus:outline-none no-underline">Регистрация</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="sm:flex sm:items-center sm:ml-6 fixed right-96 top-7">
                                        <div>
                                            <a href="{{ route('cars.create') }}" class="text-decoration-none text-lg mr-5 text-gray-500 hover:text-black">Подать объявление</a>
                                        </div>
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button class="text-lg flex items-center text-gray-500 hover:text-black hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <div>{{ Auth::user()->name }}</div>

                                                    <div class="ml-1">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <!-- Authentication -->
                                                <x-dropdown-link :href="route('profile.show', Auth::user())" :active="request()->routeIs('profile.show', Auth::user())" class="no-underline text-gray-500 hover:text-black focus:outline-none">
                                                    Профиль
                                                </x-dropdown-link>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <x-dropdown-link :href="route('logout')"
                                                                     onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="text-decoration-none text-gray-500 hover:text-black no-underline">
                                                        Выйти
                                                    </x-dropdown-link>
                                                </form>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                @endauth
                            </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                <div class="py-2">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
