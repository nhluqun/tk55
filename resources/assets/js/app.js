
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 // Vue.component(
 //     'passport-clients',
 //     require('./components/passport/Clients.vue')
 // );
 //
 // Vue.component(
 //     'passport-authorized-clients',
 //     require('./components/passport/AuthorizedClients.vue')
 // );
 //
 // Vue.component(
 //     'passport-personal-access-tokens',
 //     require('./components/passport/PersonalAccessTokens.vue')
 // );
 import axios from 'axios'

// Vue.prototype.$ajax=axios
// Vue.component('example', require('./components/ExampleComponent.vue'));
import example from './components/ExampleComponent.vue'
import Hello from './components/Hello.vue' // 引入Hello 组件
import clients from './components/passport/Clients.vue'
import Author from './components/passport/AuthorizedClients.vue'
import access from './components/passport/PersonalAccessTokens.vue'
import sendcodefield from './components/SendCodeField.vue'
//Vue.component('send-code-field', require('./components/SendCodeField.vue'));

const app = new Vue({
    el: '#app',
    components:{
      Hello,
      clients,
      sendcodefield
    }

  })
