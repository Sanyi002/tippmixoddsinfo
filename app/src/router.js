import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/contact',
      name: 'contact',
      component: (resolve) => require(['./views/Contact.vue'], resolve)
    },
    {
      path: '/help',
      name: 'help',
      component: (resolve) => require(['./views/Help.vue'], resolve)
    }
  ]
})
