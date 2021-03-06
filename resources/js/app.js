/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import BootstrapVue from 'bootstrap-vue' //Importing
window.Vue = require('vue');
Vue.use(BootstrapVue) // Telling Vue to use this in whole application
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-to-stock-component', require('./components/AddToStockComponent').default);
Vue.component('sales-page', require('./pages/SalesPage.vue').default);
Vue.component('sale-grid-component', require('./components/SaleGridComponent.vue').default)
Vue.component('search-bar-component', require('./components/SearchbarComponent.vue').default)
Vue.component('modal', require('./components/ModalComponent').default)
Vue.component('date-picker', require('./components/DatepickerComponent.vue').default)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
