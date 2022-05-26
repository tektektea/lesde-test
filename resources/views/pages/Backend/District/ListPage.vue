<template>
    <MasterDataLayout #content>
        <q-page padding>
            <div class="flex justify-between items-center">
                <div>
                    <div class="my-title">List of district</div>
                    <div class="text-caption">List of district of India</div>
                </div>
                <q-breadcrumbs active-color="primary" class="text-gray-500 text-sm">
                    <q-breadcrumbs-el :href="route('dashboard')" icon="dashboard" label="Dashboard"/>
                    <q-breadcrumbs-el icon="feed" label="State"/>
                </q-breadcrumbs>
            </div>


            <div class="flex justify-between items-center q-my-md">
                <q-input v-model="localState.search"
                         dense
                         outlined
                         placeholder="Search"
                         rounded
                         @keyup="handleSearch"
                >
                    <template #append>
                        <q-icon name="search"/>
                    </template>
                </q-input>
                <q-btn :href="route('district.create')" color="primary" label="New district" rounded/>
            </div>
            <q-separator class="full-width q-my-sm"/>
            <div class="col-12">
                <q-list separator>
                    <q-item class="q-pa-none" v-for="(item,index) in listData.data"
                            :key="item.id"
                            @click="onMessageClick(item)">
                        <q-item-section avatar>
                            <q-chip :label="index+1" square/>
                        </q-item-section>
                        <q-item-section>
                            <q-item-label>{{ item?.name }}<span class="text-sm">( Code: {{item?.code}})</span></q-item-label>
                            <q-item-label caption>{{ item?.description || 'NA' }}</q-item-label>
                        </q-item-section>
                        <q-item-section side>
                            <!--                            <p class="q-ma-none text-caption text-center">{{formatDateTime(item.created_at)}}</p>-->

                            <div class="flex flex-inline justify-center q-gutter-sm">
                                <q-btn :href="route('district.edit',item.id)" icon="edit" outline round />
                                <q-btn color="negative" icon="delete" outline round @click="handleDelete(item)"/>

                            </div>
                        </q-item-section>
                    </q-item>
                </q-list>
            </div>
            <q-pagination
                v-model="listData.current_page"
                :max="pageCount"
                input
                @update:model-value="updatePagination"
            />
        </q-page>
    </MasterDataLayout>
</template>
<script setup>
import {computed, onMounted, reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {useQuasar} from "quasar";
import useUtils from "../../../util/useUtils";
import {usePage} from "@inertiajs/inertia-vue3";
import MasterDataLayout from "../../../layouts/MasterDataLayout.vue";

const q = useQuasar();
const {formatDateTime} = useUtils();
const listData = computed(() => usePage().props.value.list);

const localState = reactive({
    selected: null,
    search: '',
    listData: {
        per_page: 15,
        data: [],
        current_page: 1,
        total: 1
    },
})

const handleDelete = (item) => {
    q.dialog({
        title: 'Confirm',
        message: 'Would you like to delete?',
        cancel: true,
        persistent: true
    }).onOk(() => {
        Inertia.delete(route('district.destroy', item.id),{
            onSuccess: () => q.notify({type: 'positive', message: usePage().props.value.flash.success}),
            onError: () => q.notify({type: 'negative', message: usePage().props.value.flash?.error || 'Something went wrong! Please try again'}),
        })
    }).onCancel(() => {
        // console.log('>>>> Cancel')
    }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
    })
}

const onMessageClick = item => {
    localState.selected = item;
}

const handleSearch = e => {
    localState.search = e.target.value;
    if (e.keyCode === 13)
        fetchMessage(1);
}
const updatePagination = (value) => {
    fetchMessage(value)
}

//
const fetchMessage = (page) => {
    Inertia.get(route('state.index'), {
        page,
        search: localState.search
    }, {preserveState: true, replace: true})
}
onMounted(() => {
    const page = usePage();
    const {current_page, total, per_page, data} = page.props.value?.list
    localState.listData.current_page = current_page;
    localState.listData.data = data;
    localState.listData.total = total;
    localState.listData.per_page = per_page;
});
const pageCount = computed(() => Math.ceil(listData.value.total / listData.value.per_page));

</script>
