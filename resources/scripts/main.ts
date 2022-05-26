import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { importPageComponent } from '@/scripts/vite/import-page-component'
import '@quasar/extras/roboto-font/roboto-font.css'
import '@quasar/extras/material-icons/material-icons.css'
import '@quasar/extras/material-icons-outlined/material-icons-outlined.css'

// Import Quasar css
import 'quasar/dist/quasar.css'
import {Dialog, Notify, Quasar} from "quasar";
import {InertiaProgress} from "@inertiajs/progress";

createInertiaApp({
	resolve: (name) => importPageComponent(name, import.meta.glob('../views/pages/**/*.vue')),
	setup({ el, app, props, plugin }) {
		createApp({ render: () => h(app, props) })
			.use(plugin)
            .use(Quasar,{
                plugins: [Notify,Dialog],
                config: {
                    brand: {
                        primary: '#b8952c',
                        // ... or all other brand colors
                    }
                }
            })
            .mixin({ methods: {route: window.route } }) // Add this
			.mount(el)
	},
})
InertiaProgress.init();
