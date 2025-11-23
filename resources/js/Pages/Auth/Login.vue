<template>
    <GuestLayout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 text-center">{{ $page.props.appName || 'Laravel' }}</h2>
                </div>

                <div v-if="$page.props.errors && Object.keys($page.props.errors).length > 0" class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            <li v-for="(error, key) in $page.props.errors" :key="key">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div v-if="$page.props.flash?.status" class="mb-4 font-medium text-sm text-green-600">
                    {{ $page.props.flash.status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input 
                            v-model="form.email"
                            id="email" 
                            type="email" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required 
                            autofocus 
                            autocomplete="username"
                        >
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                        <input 
                            v-model="form.password"
                            id="password" 
                            type="password" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required 
                            autocomplete="current-password"
                        >
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <input 
                                v-model="form.remember"
                                id="remember_me" 
                                type="checkbox" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Forgot your password?
                        </Link>

                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="ms-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50"
                        >
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useRoute } from '@/composables/useRoute';

const { route } = useRoute();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login.store'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

