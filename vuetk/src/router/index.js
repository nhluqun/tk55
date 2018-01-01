//import index from '../views/index.vue'
const routers=[
    {
      path: '/',
      name: 'index',
      component:resolve=> {
        require(['@/views/index.vue'], resolve);
    }
  },

    { path:'/login',
     name: 'login',
     auth:false,
     component:resolve=> {
       require(['@/views/login.vue'], resolve);
     }
   },
    {path:'/register',
   	name: 'register',
   	component:resolve=> {
   		require(['@/views/register.vue'], resolve);
   	},
       auth: false
   },
   // {path:'/forgetpass',
   // 	name: 'findpass',
   // 	component(resolve) {
   // 		require(['../views/findpass.vue'], resolve);
   // 	},
   //     auth: false
   // },
   // {path:'/account',
   // 	name: 'account',
   // 	component(resolve) {
   // 		require(['../views/account.vue'], resolve);
   // 	},
   //     auth: true
   // },

  // {
  //    path:'/usr/changepass',
  //  	name: 'user.changepass',
  //  component(resolve) {
  //  	require(['../views/user/changepass.vue'], resolve);
  //  },
  //      auth: true
  //  },

]

export default routers
