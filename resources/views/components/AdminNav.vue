<template>
    <q-list class="rounded-borders q-ma-lg q-py-lg shadow-4  bg-dark" separator>

        <div class="q-pa-md flex justify-center items-center">
            <q-avatar>
                <img style="width: 90px" src="images/test.svg"/>
            </q-avatar>
        </div>

        <q-expansion-item class="text-bold nav-item"
                          default-opened
                          v-for="(item,i) in Object.keys(menu)"
                          :key="i"
                          :label="item.toString()"
        >
            <q-item clickable
                    class="full-width menu-item"
                    v-for="(menu_item,inner) in menu[item].items"
                    :key="inner"
                    @click="handleRouting(menu_item)"

            >
                <q-item-section avatar>
                    <q-icon class="q-mr-sm" :size="24" :name="menu_item.icon"/>
                </q-item-section>
                <q-item-section>
                    <q-item-label>{{ menu_item.label }}</q-item-label>
                </q-item-section>

            </q-item>


        </q-expansion-item>
    </q-list>
</template>
<script setup>
import {Inertia} from "@inertiajs/inertia";

const menu = {

    'Administrator': {
        items: [
            {route_name: 'privacy.read', label: 'Privacy Policy', icon: 'manage_accounts'},
            {route_name: 'term.read', label: 'Terms and Conditions', icon: 'manage_accounts'},
            {route_name: 'faq.index', label: 'FAQ', icon: 'manage_accounts'},
            {route_name: 'state.index', label: 'Master Data', icon: 'manage_accounts'},
        ]
    }
}

const handleRouting=item=>Inertia.get(route(item.route_name));

</script>
