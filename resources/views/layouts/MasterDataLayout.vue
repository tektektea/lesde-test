<template>
    <BackLayout>
        <template #content>
           <div class="row">
               <div class="col-xs-12 col-sm-3 bg-gray-50">
                   <q-list separator class="text-gray-500 font-semibold">
                       <q-item clickable
                               :href="route('state.index')"
                           :active="route().current()==='state.index'">
                           <q-item-section>
                               <q-item-label>State</q-item-label>
                           </q-item-section>
                       </q-item>
                       <q-item clickable
                               :href="route('district.index')"
                           :active="route().current()==='district.index'">
                           <q-item-section>
                               <q-item-label>District</q-item-label>
                           </q-item-section>
                       </q-item>
                   </q-list>
               </div>
               <div class="col-xs-12 col-sm-9">
                   <slot name="content"/>
               </div>
           </div>
        </template>
    </BackLayout>
</template>
<script setup>
import BackLayout from "./BackLayout.vue";

</script>
