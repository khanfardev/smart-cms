<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ post? `Edit Post "${post.title}"` : 'Create a new Post' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-5" v-if="!post">
                    <div class="md:col-start-2 md:col-span-3 p-2 mb-3">

                    </div>
                </div>
                <jet-form-section @submitted="submit">
                    <template #form>

                        <div class="col-span-6">
                            <jet-label for="title" value="Title" />
                            <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title"/>
                            <jet-input-error :message="form.errors.title" class="mt-2" />
                        </div>
                        <div class="col-span-6">
                            <jet-label for="description" value="Description" />
                            <jet-input id="description" type="text" class="mt-1 block w-full" v-model="form.description"/>
                            <jet-input-error :message="form.errors.description" class="mt-2" />
                        </div>
                        <div class="col-span-6">
                            <jet-label for="post_type" value="Post Type" />
                            <jet-input id="post_type" type="text" class="mt-1 block w-full" v-model="form.post_type"/>
                            <jet-input-error :message="form.errors.post_type" class="mt-2" />
                        </div>
                        <div class="col-span-6" >
                            <jet-label for="category" value="Tags" />
                            <div dir="ltr">
                                <multiselect mode="tags" v-model="form.tags" :options="tags" valueProp="id" label="name"/>
                            </div>
                            <jet-input-error class="mt-2" :message="form.errors.tags"/>
                        </div>
                        <div class="col-span-6">
                            <jet-label for="category_type" value="Category Type"/>
                            <select id="category_type" v-model="form.category_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option v-for="i in categories" :value="i.id">{{ i.name }}</option>
                            </select>
                            <jet-input-error :message="form.errors.category_id" class="mt-2"/>
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </jet-button>
                    </template>
                </jet-form-section>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import Multiselect from '@vueform/multiselect'

export default {
    components: {
        AppLayout,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetActionMessage,
        JetSecondaryButton,
        Multiselect,

    },

    props: {
        post: Object,
        categories: Array,
        tags :Object
    },

    data() {
        return {
            form: this.$inertia.form({
                title: this.post? this.post.title : null,
                description: this.post? this.post.description : null,
                post_type: this.post? this.post.post_type : null,
                tags: this.post? this.post.tags.map(i => i.id) : [],

                category_id : this.post? this.post.category_id :1,
            })
        };
    },
    methods: {
        submit() {
            if (this.post) {
                this.form.patch(this.route('posts.update', this.post.id));
            } else {
                this.form.post(this.route('posts.store'));
            }
        },
    },
}

</script>
<style src="@vueform/multiselect/themes/default.css"></style>

