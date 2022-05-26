<template>
    <SettingLayout #page>
                <div class="flex justify-between items-center p-6">
                    <div class="my-title">Privacy Policy</div>
                    <q-btn :href="route('web-resource.edit',data.type)" flat icon="edit" round/>
                </div>
        <q-separator class="w-full my-8"/>
        <div class="p-6" v-html="data.content">

        </div>
    </SettingLayout>

</template>
<script setup>
import SettingLayout from "../../../layouts/SettingLayout.vue";

const props=defineProps({
    data:Object
})
const {data} = props;

</script>
