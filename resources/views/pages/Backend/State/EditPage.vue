<template>
    <MasterDataLayout>
        <template #content>
            <q-page padding>
                <div class="flex justify-between items-center">
                    <div class="my-title">Edit State</div>
                    <q-breadcrumbs active-color="primary" class="text-gray-500 text-sm">
                        <q-breadcrumbs-el :href="route('state.index')" label="States" icon="feed" />
                        <q-breadcrumbs-el label="Edit State" icon="edit"/>
                    </q-breadcrumbs>
                </div>
                <q-separator class="full-width q-my-md"/>
                <q-form @submit="submit" class="row q-col-gutter-xs">
                    <div class="col-xs-12">
                        <q-input v-model="form.code"
                                 outlined
                                 :error="!!$page.props.errors?.code"
                                 :error-message="$page.props.errors?.code"
                                 label="Question"
                                 :rules="[
                                     val=>!!val || 'Code is required'
                                 ]"/>
                    </div>
                    <div class="col-xs-12">
                        <q-input v-model="form.name"
                                 outlined
                                 :error="!!$page.props.errors?.name"
                                 :error-message="$page.props.errors?.name"
                                 label="Answer"
                                 :rules="[
                                     val=>!!val || 'Name is required'
                                 ]"/>
                    </div>
                    <div class="col-xs-12">
                        <q-input v-model="form.description"
                                 type="textarea"
                                 outlined
                                 :error="!!$page.props.errors?.description"
                                 :error-message="$page.props.errors?.description"
                                 label="Description"
                                 :rules="[
                                     val=>!!val || 'Description is required'
                                 ]"/>
                    </div>

                    <div class="col-xs-12 q-gutter-md">
                        <q-btn :disable="form.processing" class="sized-btn" type="submit" rounded color="primary" label="Save"/>
                        <q-btn class="sized-btn" type="reset" rounded color="negative" label="Reset"/>
                    </div>
                </q-form>
            </q-page>
        </template>
    </MasterDataLayout>
</template>
<script setup>
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import {useQuasar} from "quasar";
import {onMounted} from "vue";
import MasterDataLayout from "../../../layouts/MasterDataLayout.vue";

const q = useQuasar();

const {data,errors}=defineProps({
    data: Object,
    errors: Object
})
const form = useForm({
    id: data.id,
    name:data.name,
    code:data.code,
    description:data.description
});

const submit=e=>{
    form.put(route('state.update',form.id),{
        onSuccess: () => q.notify({type: 'positive', message: usePage().props.value.flash.success}),
        onError: () => q.notify({type: 'negative', message: usePage().props.value.flash?.error || 'Something wrong!! Please try again'}),
    })
}

</script>
