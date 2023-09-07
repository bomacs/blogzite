<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Blog from '@/Components/Blog.vue';
import { Head } from '@inertiajs/vue3';

defineProps(['blogs']);

</script>

<template>
    <Head title="My Blogs" />

    <AuthenticatedLayout>
      
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Blogs</h2>
            </template>
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <Blog
                        v-for="blog in blogs"
                        :key="blog.id"
                        :blog="blog"
                    />
                </div>
            </div>
    </AuthenticatedLayout>
</template>