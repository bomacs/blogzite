<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="w-full min-h-screen grid place-items-center bg-gray-100">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('blogs.index')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >My Blogs</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >Register</Link
                >
            </template>
        </div>
        <div class="mx-auto flex flex-col items-center pb-12 sm:py-0">
            <div class="w-11/12 sm:w-2/3 lg:flex justify-center items-center flex-col sm:mb-4">
            <h1 class="text-4xl text-center text-gray-500 font-black leading-7 tracking-wider mb-4 md:text-6xl md:leading-10">
                BlogZite 
            </h1>
            <h3 class="text-xl text-gray-500 font-semibold text-center md:text-2xl" >
                Online Blogging Website
            </h3>
            <p class="text-gray-700 text-center text-md italic mt-5 lg:w-10/12 lg:text-lg ">Platform for connecting people. We matter your story... Your story is our story.</p>
            </div>
            <div class="flex justify-center items-center border-2 border-gray-500 rounded-md hover:opacity-50">
                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="px-6 py-2 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >Join us
                </Link>
                <Link
                    v-else="$page.props.auth.user"
                    :href="route('blogs.index')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >My Blogs
                </Link>
            </div>
        </div>
    </div>
</template>
