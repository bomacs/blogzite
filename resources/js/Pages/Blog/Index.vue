<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Blog from '@/Components/Blog.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['blogs']);
 
const form = useForm({
    post_title: '',
    post_body: '',
});

</script>
 
<template>
    <Head title="Blogs" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('blogs.store'), { onSuccess: () => form.reset() })">
                <div>
                    <InputLabel for="post_title" value="Title" />

                    <TextInput
                        id="post_title"
                        name="post_title"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Title of your post."
                        v-model="form.post_title"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.post_title" />
                </div>
                <div class="mt-4">
                    <InputLabel for="post_body" value="Body" />
                    <textarea
                        id="post_body"
                        name="post_body"
                        v-model="form.post_body"
                        placeholder="Share your thoughts..."
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></textarea>
                    <InputError :message="form.errors.post_body" class="mt-2" />
                </div>
                <button type="submit" class="mt-4 text-sm bg-blue-500 px-4 py-2 border-2 border-gray-400 rounded-md">Post</button>
            </form>

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