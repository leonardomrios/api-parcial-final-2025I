<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
                            <ApplicationMark class="block h-9 w-auto" />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <NavLink :href="route('dashboard')" :active="$page.url === '/dashboard'">
                            Dashboard
                        </NavLink>
                        <NavLink :href="route('web.categories.index')" :active="$page.url.startsWith('/categories')">
                            Categorías
                        </NavLink>
                        <NavLink :href="route('web.computers.index')" :active="$page.url.startsWith('/computers')">
                            Computadoras
                        </NavLink>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span v-if="$page.props.auth.user" class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ $page.props.auth.user.name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>

                                <DropdownLink :href="route('profile.show')">
                                    Profile
                                </DropdownLink>

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                        Log Out
                                    </button>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('dashboard')" :active="$page.url === '/dashboard'">
                    Dashboard
                </ResponsiveNavLink>
                <ResponsiveNavLink :href="route('web.categories.index')" :active="$page.url.startsWith('/categories')">
                    Categorías
                </ResponsiveNavLink>
                <ResponsiveNavLink :href="route('web.computers.index')" :active="$page.url.startsWith('/computers')">
                    Computadoras
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user?.name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user?.email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink :href="route('profile.show')" :active="$page.url.startsWith('/user/profile')">
                        Profile
                    </ResponsiveNavLink>

                    <form @submit.prevent="logout">
                        <button type="submit" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { useRoute } from '@/composables/useRoute';

const { route } = useRoute();
const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'), {}, {
        preserveState: false,
        preserveScroll: false,
        onFinish: () => {
            window.location.href = '/login';
        }
    });
};
</script>

