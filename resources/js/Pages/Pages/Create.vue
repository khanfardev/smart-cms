<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ page? `Edit Page "${page.title}"` : 'Create a new page' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-5" v-if="!page">
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
    },

    props: {
        page: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                title: this.page? this.page.title : null,
                description: this.page? this.page.description : null,
            })
        };
    },
    methods: {
        submit() {
            if (this.page) {
                this.form.patch(this.route('pages.update', this.page.id));
            } else {
                this.form.post(this.route('pages.store'));
            }
        },
    },
}
</script>
