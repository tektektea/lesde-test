<template>
    <q-layout>
        <q-page-container>
            <q-page class="row">
                <div class="col-xs-12 col-sm-5 flex justify-center items-center">
                    <q-form class="q-pa-md" @submit="submit" style="width:420px">
                        <p class="my-title">Login</p>
                        <q-separator class="full-width q-my-sm"/>
                        <label for="email" class="label">Email</label>
                        <q-input outlined
                                 class="full-width"
                                 id="email"
                                 :error="form.errors.email"
                                 :error-message="form.errors.email"
                                 v-model="form.email"
                                 :rules="[
                                     val=>!!val || 'Email is required'
                                 ]"
                                 dense/>
                        <label for="password" class="label">Password</label>
                        <q-input outlined
                                 class="full-width"
                                 id="password"
                                 :type="localState.inputType"
                                 dense
                                 v-model="form.password"
                                 :rules="[
                                     val=>!!val || 'Email is required'
                                 ]"
                                 >
                            <template #append>
                                <div>
                                    <q-btn flat
                                           @click="togglePassword"
                                           round
                                           :icon="localState.inputType==='password'?'visibility_off':'visibility_on'">
                                    </q-btn>
                                </div>

                            </template>
                        </q-input>
                        <q-btn :disabled="form.processing" type="submit" color="primary" class="full-width" label="LOGIN"/>
                    </q-form>
                </div>

                <div class="col-xs-12 col-sm-7 bg-blue">
                    iamges
                </div>

            </q-page>
        </q-page-container>
    </q-layout>
</template>
<script setup>
import {onMounted, reactive, toRef, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import {useQuasar} from "quasar";
import {InertiaProgress} from "@inertiajs/progress";

const props=defineProps({
    errors:Object
})
const q = useQuasar();
const form=useForm({
    email:'',
    password:'',
})
const localState=reactive({
    inputType: 'password'
})
const submit=e=>{
    form.post(route('login:store'),{
        preserveScroll: true,
        onStart: () => q.loading.show(),
        onSuccess: () => {
            q.notify({type:'positive',message:'Yayy'})
        },
        onError:()=> q.notify({type:'negative',message:'Nay'}),
        onFinish: () => q.loading.hide()
    })

}
const togglePassword=e=>localState.inputType= localState.inputType === 'text' ? 'password' : 'text';

</script>
