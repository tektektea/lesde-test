<template>
    <BackLayout #content>
        <q-page class="row">
            <div class="col-xs-12 col-sm-3 bg-white">
                <q-list separator>
                    <q-item @click="navigate('privacy.read')"
                            :active="route().current()==='privacy.read'"
                            clickable>
                        <q-item-section>
                            <q-item-label>Privacy policy</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item @click="navigate('term.read')"
                            :active="route().current()==='term.read'"
                            clickable>
                        <q-item-section>
                            <q-item-label>Term and condition</q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>
            </div>
            <div class="col-xs-12 col-sm-9">
                <slot name="page"/>
            </div>


        </q-page>
    </BackLayout>
</template>

<script setup>
import {Inertia} from "@inertiajs/inertia";
import BackLayout from "./BackLayout.vue";

const navigate=name=>Inertia.get(route(name));


</script>
