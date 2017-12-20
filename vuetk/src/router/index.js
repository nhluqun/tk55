import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import XianzhetiList from '@/components/XianzhetiList'
import Clients from '@/components/passport/Clients.vue'
 import Author from '@/components/passport/AuthorizedClients.vue'
 import Access from '@/components/passport/PersonalAccessTokens.vue'
Vue.use(Router)

// const routes=[
//   {path:'/',component:Clients},
//   {path:'/Author',component:Author},
//   {path:'/Access',component:Access}
// ]

const router= new Router({
  mode:'history',
  base:__dirname,
  routes:[
    {
      path: '/',
      name: 'XianzhetiList',
      component:XianzhetiList
    },
    {
      path: '/Clients',
      name: 'Clients',
      component:Clients
    },
    {
      path: '/Author',
      name: 'Author',
      component:Author
    },
    {
      path: '/Access',
      name: 'Access',
      component:Access
    }
]
})
export default router
