<x-splade-toggle>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-14">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link href="/">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        {{-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link> --}}
                        @can('user_access')
                        <x-nav-link :href="route('reporte.index')" :active="request()->routeIs('reporte.index')">
                            Reporte
                        </x-nav-link>
                        @endcan
                        @can('misclases_access')
                            @if(Auth::id()!=1)
                            <x-nav-link :href="route('mis_clases.index')" :active="request()->routeIs('mis_clases.index')">
                                {{ __('Mis Clases') }}
                            </x-nav-link>
                            @endif
                        @endcan
                        @can('ciclos_access')
                        <x-nav-link :href="route('ciclos.index')" :active="request()->routeIs('ciclos.index')">
                            {{ __('Ciclos') }}
                        </x-nav-link>
                        @endcan
                        @can('cursos_access')
                        <x-nav-link :href="route('cursos.index')" :active="request()->routeIs('cursos.index')">
                            {{ __('Cursos') }}
                        </x-nav-link>
                        @endcan
                        @can('clases_access')
                        <x-nav-link :href="route('clases.index')" :active="request()->routeIs('clases.index')">
                            {{ __('Clases') }}
                        </x-nav-link>
                        @endcan
                        @can('role_show')
                        <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                            {{ __('Roles') }}
                        </x-nav-link>
                        @endcan
                        @can('user_access')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                            {{ __('Usuarios') }}
                        </x-nav-link>
                        @endcan
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown placement="bottom-end" class="pt-2">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                <div class="flex items-center">
                                    @if(Auth::user()->avatar)
                                    <img class="rounded-full object-cover h-8 w-8 me-2" src="{{ Auth::user()->avatar }} " alt="">
                                    @endif
                                    {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                                    {{-- {{Auth::id()}}
                                    {{ Auth::user()->role[0]->title }} --}}
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link as="a" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="toggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path v-bind:class="{ hidden: toggled, 'inline-flex': !toggled }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-bind:class="{ hidden: !toggled, 'inline-flex': toggled }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div v-bind:class="{ block: toggled, hidden: !toggled }" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link> --}}
                @can('user_access')
                <x-responsive-nav-link :href="route('reporte.index')" :active="request()->routeIs('reporte.index')">
                    Reporte
                </x-responsive-nav-link>
                @endcan
                @can('misclases_access')
                    @if(Auth::id()!=1)
                    <x-responsive-nav-link :href="route('mis_clases.index')" :active="request()->routeIs('mis_clases.index')">
                        {{ __('Mis Clases') }}
                    </x-responsive-nav-link>
                    @endif
                @endcan
                @can('ciclos_access')
                <x-responsive-nav-link :href="route('ciclos.index')" :active="request()->routeIs('ciclos.index')">
                    {{ __('Ciclos') }}
                </x-responsive-nav-link>
                @endcan
                @can('cursos_access')
                <x-responsive-nav-link :href="route('cursos.index')" :active="request()->routeIs('cursos.index')">
                    {{ __('Cursos') }}
                </x-responsive-nav-link>
                @endcan
                @can('clases_access')
                <x-responsive-nav-link :href="route('clases.index')" :active="request()->routeIs('clases.index')">
                    {{ __('Clases') }}
                </x-responsive-nav-link>
                @endcan
                @can('role_show')
                <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                    {{ __('Roles') }}
                </x-responsive-nav-link>
                @endcan
                @can('user_access')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ __('Usuarios') }}
                </x-responsive-nav-link>
                @endcan
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link as="a" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</x-splade-toggle>
