<template>
    <q-layout  @scroll="onScroll" class="bg-gray-100" view="lHh LpR fFf">

        <q-header bordered style="height: 70px" :class="headerClass">
            <AdminToolbar>
                <template #brand>
                    <q-btn @click="localState.openDrawer=!localState.openDrawer" flat text-color="dark" icon="menu"/>
                </template>
            </AdminToolbar>
        </q-header>

        <q-drawer class="bg-gray-100" bordered show-if-above v-model="localState.openDrawer" side="left">
            <!-- drawer content -->
            <AdminNav/>
        </q-drawer>

        <q-page-container>
            <slot  name="content"></slot>
        </q-page-container>

        <q-footer elevated class="bg-grey-8 ">
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                    </q-avatar>
                    <div>Title</div>
                </q-toolbar-title>
            </q-toolbar>
        </q-footer>

    </q-layout>
</template>

<script setup>
import {computed, onMounted, reactive, ref, watch} from 'vue'
import AdminNav from "../components/AdminNav.vue";
import AdminToolbar from "../components/AdminToolbar.vue";
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-vue3";
import {useQuasar} from "quasar";


const q = useQuasar();
const localState=reactive({
    position:0,
    openDrawer:false
})
const user = computed(() => usePage().props?.value?.auth)
const leftDrawerOpen = ref(false)
const toggleLeftDrawer = () => {
    localState.openDrawer = !localState.openDrawer
}
const onScroll=({position})=>{
    localState.position = position;
}
const headerClass=computed(()=>localState.position>5?['bg-white shadow-sm']:['bg-white shadow-sm'])

onMounted(()=>{
    if (usePage().props?.value?.auth) {
        console.log("user found",user?.value);
    }else {
        Inertia.get(route('access-denied'))
    }
})

</script>
