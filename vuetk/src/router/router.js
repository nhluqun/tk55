
 //import index from '../views/index.vue';
const routers = [
     {  path:'/',
    	  name: 'index',
        auth:false,
        component:resolve=>{require(['@/views/index.vue'],resolve)}
      //component:index
      },
     { path:'/login',
    	name: 'login',
      auth:false,
    	component:resolve=> {
    		require(['../views/login.vue'], resolve);
    	}
    },
    ]

    // '/register': {
    // 	name: 'register',
    // 	component(resolve) {
    // 		require(['../views/register.vue'], resolve);
    // 	},
    //     auth: false
    // },
    // '/forgetpass': {
    // 	name: 'findpass',
    // 	component(resolve) {
    // 		require(['../views/findpass.vue'], resolve);
    // 	},
    //     auth: false
    // },
    // '/account': {
    // 	name: 'account',
    // 	component(resolve) {
    // 		require(['../views/account.vue'], resolve);
    // 	},
    //     auth: true
    // },
    //
    // '/user/changepass': {
    // 	name: 'user.changepass',
		// component(resolve) {
		// 	require(['../views/user/changepass.vue'], resolve);
		// },
    //     auth: true
    // },


export default routers;
