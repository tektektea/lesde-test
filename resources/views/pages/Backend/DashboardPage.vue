<template>
    <BackLayout>
        <template #content>

            <q-page>
                <p v-for="item in 100">{{item}}</p>
            </q-page>
        </template>
    </BackLayout>

</template>
<script setup>
import BackLayout from "../../layouts/BackLayout.vue";
</script>
