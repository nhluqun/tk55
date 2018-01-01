// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import Vuex from 'vuex';
import App from './App';
import VueRouter from 'vue-router' //引入路由
import routes from './router/index.js';//引入路由数组
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
// import  VueResource  from 'vue-resource'
// Vue.use(VueResource)
Vue.use(ElementUI);
Vue.use(Vuex);
Vue.use(VueRouter);
import axios from 'axios';
Vue.prototype.$ajax=axios;
Vue.config.productionTip = false;

const config = {
    errorBagName: 'errors', // change if property conflicts.
    delay: 0,
    locale: 'zh_CN',
    messages: null,
    strict: true
};

// Vuex定义
const store = new Vuex.Store({
	state: {
		isLogin: false,
		user: {},
		access_token: ''
	},
	mutations: {
		setAccessToken(state, access_token) {
			state.access_token = access_token;
		},
		login(state) {
			state.isLogin = true;
		},
		logout(state) {
			state.isLogin = false;
			state.user = {};
			state.access_token = '';
		},
		setUser(state, user) {
			state.user = user;
		}
	}
});
const router=new VueRouter({
    // 是否开启History模式的路由,默认开发环境开启,生产环境不开启。如果生产环境的服务端没有进行相关配置,请慎用
    //history: Config.env != 'production'
    //history: false
    history:true,
    routes
});

//router.map(Routers);//vue1.0中的写法

// router.beforeEach(({to, next, redirect}) => {
//     // 还原滚动条
//     window.scrollTo(0, 0);
//     // Auth验证
//     if (to.auth) {
//     	if (!store.state.isLogin) {
//     		if (localStorage.access_token) {
//     			// 自动登录
//     			store.commit('setAccessToken', localStorage.access_token);
//     			store.commit('login');
//     			// 获取用户信息
//     			Vue.http.get(server.api.user, {
//     				headers: {
//     					'Authorization': 'Bearer ' + store.state.access_token
//     				}
//     			}).then((response) => {
//     				store.commit('setUser', response.body.data);
//     			}, (error) => {
//     				redirect({name: 'login'});
//     			});
//     			return true;
//     		}
//     		redirect({name: 'login'});
//     	}
//     }
//     return true;
// });

// router.redirect({
//     '*': '/'
// });

// 绑定Vuex
App.store = store;

//router.start(App, '#app');
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
