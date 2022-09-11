import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { InertiaProgress } from '@inertiajs/progress'
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import { useToast } from 'vue-toastification'

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Toast, {
        timeout: 5000,
        position: 'bottom-right',
        hideProgressBar: true,
        shareAppContext: true,
      })
      .mixin({
        methods: {
          showToast: function (message, type) {
            const toast = useToast()
            toast(message, {
              type: type,
            })
          },
        },
      })
      .component('Link', Link)
      .component('Head', Head)
      .mount(el)
  },
  title: title => `Happy Lines | ${title}`
})

InertiaProgress.init({ 
  color: '#0185c6' ,
  showSpinner: true,
 })