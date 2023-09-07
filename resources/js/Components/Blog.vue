<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps(['blog']);
 
const form = useForm({
    post_title: props.blog.post_title,
    post_body: props.blog.post_body,
});

const form2 = useForm({
    blog_id: props.blog.id,
    comment: '',
});
 
const editing = ref(false);
</script>
 
<template>
    <div class="p-6 flex space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800">{{ blog.user.name }}</span>
                    <small class="ml-2 text-sm text-gray-600">{{ new Date(blog.created_at).toLocaleString() }}</small>
                      <small v-if="blog.created_at !== blog.updated_at" class="text-sm text-gray-600"> &middot; edited</small>
                </div>
                <Dropdown v-if="blog.user.id === $page.props.auth.user.id">
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <button class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out" @click="editing = true">
                            Edit
                        </button>
                        <DropdownLink as="button" :href="route('blogs.destroy', blog.id)" method="delete">
                            Delete
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <form v-if="editing" @submit.prevent="form.put(route('blogs.update', blog.id), { onSuccess: () => editing = false })">
                <div>
                    <InputLabel for="post_title" value="Title" />

                    <TextInput
                        id="post_title"
                        name="post_title"
                        type="text"
                        class="mt-1 block w-full"
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
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <div v-else class="mt-4 text-lg text-gray-900">
                <h3 class="text-lg font-semibold mb-4"> {{ blog.post_title }} </h3>
                <p class="text-sm"> {{ blog.post_body }} </p>
            </div>
            <div>
                <form @submit.prevent="form2.post(route('comments.blog', blog.id), { onSuccess: () => form2.reset() })">
                    <div class="mt-6 py-4 border-t-2 border-dotted">
                        <textarea
                        id="comment"
                        name="comment"
                        v-model="form2.comment"
                        placeholder="Share your thoughts..."
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        ></textarea>
                        <button type="submit" class="mt-4 text-sm bg-blue-500 px-4 py-2 border-2 border-gray-400 rounded-md">Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>