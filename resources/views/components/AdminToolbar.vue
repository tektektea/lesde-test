<template>
    <q-toolbar class="flex full-height justify-center justify-between">
        <div class="flex q-gutter-5">
            <slot name="brand">
                <q-btn color="dark" label="Brand"/>
            </slot>
        </div>
        <div class="flex q-gutter-4">
            <q-btn-dropdown color="dark" flat :label="$page.props?.user?.name || 'guest'">
                <q-list>
                    <q-item clickable @click="logout">
                        <q-item-section>
                            <q-item-label>Logout</q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>
            </q-btn-dropdown>
            <q-btn :href="route('privacy.read')" flat round color="primary"  icon="settings"/>
        </div>

    </q-toolbar>
</template>
<script setup>
import {Inertia} from "@inertiajs/inertia";


const logout=e=>{
    Inertia.post(route('logout'));
}
</script>
