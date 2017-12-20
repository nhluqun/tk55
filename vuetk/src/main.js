// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router/index.js'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
// import  VueResource  from 'vue-resource'

// Vue.use(VueResource)

Vue.use(ElementUI)
import axios from 'axios'

Vue.prototype.$ajax=axios

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
//  el: '#app',
  router,
//  template: '<App/>',
// components: { App
//   //   // 'passport-clients':passport-client,
//   //   // 'passport-authorized-clients':passport-authorized-clients,
//   //   // 'passport-personal-access-tokens':passport-personal-access-tokens
//    }
render:h=>h(App)
}).$mount('#app')
