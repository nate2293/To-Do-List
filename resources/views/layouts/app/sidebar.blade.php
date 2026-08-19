<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    {{-- Sidebar --}}
    <flux:sidebar sticky collapsible class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

        {{-- Sidebar Header --}}
        <flux:sidebar.header>

            <x-app-logo :sidebar="true" href="{{ route('tasks.index') }}" />

            {{-- Desktop / Mobile Collapse Button --}}
            <flux:sidebar.collapse />

        </flux:sidebar.header>


        {{-- Main Navigation --}}
        <flux:sidebar.nav>

            <flux:sidebar.group :heading="__('Platform')" class="grid">

                <flux:sidebar.item icon="home" :href="route('tasks.index')" :current="request()->routeIs('tasks.*')">
                    {{ __('To-Do-list') }}
                </flux:sidebar.item>

            </flux:sidebar.group>

        </flux:sidebar.nav>


        {{-- Push User Menu To Bottom --}}
        <flux:spacer />


        {{-- Desktop User Menu --}}
        <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />

    </flux:sidebar>


    {{-- Mobile Header --}}
    <flux:header class="lg:hidden">

        {{-- Opens Sidebar On Mobile --}}
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />


        {{-- Mobile User Dropdown --}}
        <flux:dropdown position="top" align="end">

            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>

                {{-- User Information --}}
                <flux:menu.radio.group>

                    <div class="p-0 text-sm font-normal">

                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">

                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">

                                <flux:heading class="truncate">
                                    {{ auth()->user()->name }}
                                </flux:heading>

                                <flux:text class="truncate">
                                    {{ auth()->user()->email }}
                                </flux:text>

                            </div>

                        </div>

                    </div>

                </flux:menu.radio.group>


                <flux:menu.separator />


                {{-- Settings --}}
                <flux:menu.radio.group>

                    <flux:menu.item :href="route('profile.edit')" icon="cog">
                        {{ __('Settings') }}
                    </flux:menu.item>

                </flux:menu.radio.group>


                <flux:menu.separator />


                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf

                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log out') }}
                    </flux:menu.item>

                </form>

            </flux:menu>

        </flux:dropdown>

    </flux:header>


    {{-- Page Content --}}
    {{ $slot }}


    {{-- Toast Notifications --}}
    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist


    {{-- Flux Javascript --}}
    @fluxScripts

</body>

</html>
