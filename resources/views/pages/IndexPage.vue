<template>
    <FrontLayout>
        <template #content>
            <div class="w-full mt-4 grid grid-cols-3 xs:grid-cols-1">
                <p class="text-lg bg-red-100 ">One</p>
                <p class="text-lg bg-green-100 col-span-2">Two</p>
            </div>
            <div class="md:container mx-auto  w-full bg-white p-6 rounded-lg my-8">
                CTA
            </div>
            <div class="md:container mx-auto  w-full bg-white p-6 rounded-lg my-8">
                FAQ
            </div>

            <div class="w-full  p-6 rounded-lg my-8">
                LINKs
            </div>
        </template>
    </FrontLayout>
</template>
<script setup>
import FrontLayout from "../layouts/FrontLayout.vue";
</script>
