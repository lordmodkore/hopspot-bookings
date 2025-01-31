import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import '../css/app.css'; // Import Tailwind CSS
import { ZiggyVue } from 'ziggy';

createInertiaApp({
  resolve: async name => {

    const pages = import.meta.glob('./Pages/**/*.vue')
    const page = await pages[`./Pages/${name}.vue`]()
    page.default.layout = page.default.layout || MainLayout

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(ZiggyVue)
        .mount(el)
  },
})
