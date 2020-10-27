import Vue from 'vue'
window.vue = new Vue();

import store from './store.js';

//router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
let routes =[
  
  {path: '/users', component: require('./components/users.vue').default },

  {path: '/addToCart', component: require('./components/addToCart.vue').default },

  {path: '/miniCart', component: require('./components/miniCart.vue').default },

  {path: '/books', component: require('./components/books.vue').default },

  {path: '/categories', component: require('./components/categories.vue').default },

  {path: '/salesAndPurchase', component: require('./components/salesAndPurchase.vue').default },

  {path: '/discount', component: require('./components/discount.vue').default },

  {path: '/profile', component: require('./components/profile.vue').default },

  {path: '/dashboard', component: require('./components/dashboard.vue').default },

  {path: '/dashboard', component: require('./components/charts.vue').default },

  {path: '*', component: require('./components/notFound.vue').default },

]
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

//vform
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

require('./bootstrap');
require('admin-lte');
window.Vue = require('vue');

// gate 
import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

//sweetalert 2
import Swal from 'sweetalert2';
window.Swal = Swal;

window.Fire = new Vue();

//progress bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
  })
//end progress bar

//chart
//import { Bar } from 'vue-chartjs'

//vue bootstrap
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('notFound', require('./components/notFound.vue').default);

//pagination
 Vue.component('pagination', require('laravel-vue-pagination'));

 //moment
 import moment from 'moment';
 moment().format(); 
//filter

Vue.filter('upText', function(text){
  return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
  return moment(created).format('MMMM Do YYYY');
});


const app = new Vue({
    el: '#app',
    router,
    store,
    data:{
      search : '',
    },
    
    methods:{
      searchit: _.debounce(()=>{
        Fire.$emit('searching');
      } , 1000)
    }
    
});


