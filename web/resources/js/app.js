/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
import Index from './components/IndexComponent.vue'
import router from './router'
import VueProgressBar from 'vue-progressbar'
import VuePageTransition from 'vue-page-transition'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import VueIziToast from 'vue-izitoast'
import 'izitoast/dist/css/iziToast.min.css'
import Vuelidate from 'vuelidate'
import { EditIcon, Trash2Icon } from "vue-feather-icons"
import VueTippy, { TippyComponent } from "vue-tippy"

Vue.use(VueGoodTablePlugin)
Vue.use(VueIziToast)
Vue.use(Vuelidate)
Vue.use(VueTippy);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('index', Index)
Vue.component('EditIcon', EditIcon)
Vue.component('Trash2Icon', Trash2Icon)
Vue.component("tippy", TippyComponent)

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

const options = {
  color: '#3182ce',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}

Vue.use(VueProgressBar, options)
Vue.use(VuePageTransition)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
